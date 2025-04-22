from flask import Flask,flash, render_template, request, jsonify, redirect, url_for, session
from flask_sqlalchemy import SQLAlchemy
import face_recognition
import numpy as np
import os
import json
import wave
import sounddevice as sd
import torchaudio
import pickle
from scipy.spatial.distance import cosine
import uuid

app = Flask(__name__)
app.secret_key = 'super_secret_key' # Required for flashing messages

# Configure Database
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+mysqlconnector://root:@localhost/face_recognition'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False

db = SQLAlchemy(app)

# ✅ Registration Model
class Registration(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    firstName = db.Column(db.String(100), nullable=False)
    lastName = db.Column(db.String(100), nullable=False)
    gender = db.Column(db.String(10), nullable=False)
    email = db.Column(db.String(100), unique=True, nullable=False)
    password = db.Column(db.String(100), nullable=False)
    number = db.Column(db.String(20), nullable=False)

    # ✅ Face Model
class Face(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(100), nullable=False)
    encoding = db.Column(db.Text, nullable=False)  # JSON format

    
# ✅ Voice Model

class User(db.Model):
    __tablename__ = 'user'  # ✅ explicitly bind to table name
    id = db.Column(db.Integer, primary_key=True)
    username = db.Column(db.String(255), unique=True, nullable=False)
    embedding = db.Column(db.LargeBinary, nullable=False)

# ✅ Initialize DB
with app.app_context():
    db.create_all()
# ✅ START
@app.route('/')
def home():
  return render_template('start.html')

# ✅ LOGIN OPTION
@app.route('/loginoption')
def loginoption():
  return render_template('loginoption.html')

# 🟢 Route: Home redirects to login
@app.route('/2')
def login_page():
    return redirect(url_for('login'))

# 🟢 Route: Registration
@app.route('/register', methods=['GET', 'POST'])
def register():
    if request.method == 'POST':
        data = request.form
        existing_user = Registration.query.filter_by(email=data['email']).first()
        if existing_user:
            flash("Email already registered. Please login.")
            return redirect(url_for('face'))

        new_user = Registration(
            firstName=data['firstName'],
            lastName=data['lastName'],
            gender=data['gender'],
            email=data['email'],
            password=data['password'],
            number=data['number']
        )
        db.session.add(new_user)
        db.session.commit()
        flash("Registration successful. Please log in.")
        return redirect(url_for('face'))

    return render_template('registration.html')

# 🟢 Route: Login
@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        email = request.form['email']
        password = request.form['password']
        user = Registration.query.filter_by(email=email).first()
        if user and user.password == password:
            return redirect(url_for("http://localhost/minorproject/ourplans.php"))
        else:
           flash("Invalid email or password.")
        return redirect(url_for('login'))

    return render_template('login.html')


# ✅ Home Page
@app.route('/face', methods=['GET', 'POST'])
def face():
    return render_template('face.html')


# ✅ Face Registration

@app.route('/register_face', methods=['POST'])
def register_face():
    if 'image' not in request.files or 'name' not in request.form:
        return jsonify({"status": "error", "message": "Image and name required"})

    file = request.files['image']
    name = request.form['name']

    image = face_recognition.load_image_file(file)
    encodings = face_recognition.face_encodings(image)

    if not encodings:
        return jsonify({"status": "error", "message": "No face detected."})

    encoding_json = json.dumps(encodings[0].tolist())

    # Check if user already exists to avoid duplicates
    existing_user = Face.query.filter_by(name=name).first()
    if existing_user:
        return jsonify({"status": "success", "message": f"{name} already registered!", "redirect": "http://localhost/minorproject/ourplans.php"})

    new_face = Face(name=name, encoding=encoding_json)
    db.session.add(new_face)
    db.session.commit()

    return jsonify({"status": "success", "message": "Face registered successfully!", "redirect": "/voice"})

@app.route('/recognize', methods=['POST'])
def recognize_face():
    if 'image' not in request.files:
        return jsonify({"status": "error", "message": "No image uploaded"})

    file = request.files['image']
    
    try:
        image = face_recognition.load_image_file(file)
        encodings = face_recognition.face_encodings(image)

        if not encodings:
            return jsonify({"status": "error", "message": "No face detected."})

        uploaded_encoding = encodings[0]
        registered_faces = Face.query.all()

        for face in registered_faces:
            stored_encoding = np.array(json.loads(face.encoding))
            match = face_recognition.compare_faces([stored_encoding], uploaded_encoding)

            if match[0]:
                return jsonify({
                    "status": "success",
                    "message": f"Access Granted! Welcome {face.name}.",
                    "redirect": "http://localhost/minorproject/ourplans.php"
                })

        return jsonify({
            "status": "error",
            "message": "Access Denied!"
        })

    except Exception as e:
        return jsonify({"status": "error", "message": f"Recognition error: {str(e)}"})

# 🎤 Voice Config
DURATION = 5  # seconds
SAMPLE_RATE = 16000

def record_audio(username):
    file_path = f"{username}.wav"
    print(f"🎤 Recording for {DURATION} seconds... Speak now!")
    audio_data = sd.rec(int(DURATION * SAMPLE_RATE), samplerate=SAMPLE_RATE, channels=1, dtype=np.int16)
    sd.wait()

    with wave.open(file_path, 'wb') as wf:
        wf.setnchannels(1)
        wf.setsampwidth(2)
        wf.setframerate(SAMPLE_RATE)
        wf.writeframes(audio_data.tobytes())

    print(f"✅ Recorded: {file_path}")
    return file_path

def extract_mfcc(file_path, n_mfcc=40, n_mels=40):
    waveform, sample_rate = torchaudio.load(file_path)
    mfcc = torchaudio.transforms.MFCC(
        sample_rate=sample_rate,
        n_mfcc=n_mfcc,
        melkwargs={'n_mels': n_mels}
    )(waveform)
    return mfcc.mean(dim=2).squeeze().numpy()

def save_embeddings(username, voice_features):
    embedding_blob = pickle.dumps(voice_features)
    existing_user = User.query.filter_by(username=username).first()
    if existing_user:
        existing_user.embedding = embedding_blob
    else:
        new_user = User(username=username, embedding=embedding_blob)
        db.session.add(new_user)

    db.session.commit()
    print(f"✅ Voice features stored for: {username}")

def load_embeddings():
    users = User.query.all()
    return {user.username: pickle.loads(user.embedding) for user in users}

def match_voice(input_features, stored_embeddings):
    best_match, min_distance = None, float("inf")
    for username, stored_features in stored_embeddings.items():
        distance = cosine(input_features, stored_features)
        if distance < min_distance:
            min_distance, best_match = distance, username
    return best_match if min_distance < 0.5 else "Unknown"

# ✅ Voice Authentication Page
@app.route('/voice')
def voice_page():
    return render_template('voice.html')



# ✅ Voice Registration Page
@app.route("/voice_registration", methods=['GET', 'POST'])  # ✅ CORRECT
  # ✅ Correct
def voice_registration():
    if request.method == "POST":
        username = request.form.get('username') or session.get('username')
        if not username:
            return render_template("voice_register.html", message="❌ No username found.")

        try:
            wav_path = record_audio(username)
            voice_features = extract_mfcc(wav_path)
            save_embeddings(username, voice_features)
            os.remove(wav_path)
        except Exception as e:
             return render_template("voice_register.html", message=f"❌ Recording failed: {str(e)}")

        return redirect("http://localhost/minorproject/ourplans.php")  # <-- Replace with your actual path

    return render_template('voice_register.html')


# ✅ Voice Authentication Page
@app.route("/authenticate", methods=["GET", "POST"])
def authenticate():
    if request.method == "POST":
        stored_embeddings = load_embeddings()
        if not stored_embeddings:
            return render_template("authenticate.html", message="❌ No registered users found!")

        temp_name = f"temp_{uuid.uuid4().hex}.wav"
        try:
            temp_wav = record_audio(temp_name)
            temp_features = extract_mfcc(temp_wav)
            matched_username = match_voice(temp_features, stored_embeddings)
            os.remove(temp_wav)
        except Exception as e:
            return render_template("authenticate.html", message=f"❌ Error: {str(e)}")

        if matched_username != "Unknown":
            return redirect("http://localhost/minorproject/dataConcealed.php")
        else:
            return render_template("authenticate.html", message="❌ Voice not recognized.")

    return render_template("authenticate.html", message=None)

if __name__ == '__main__':
    app.run(debug=True)
