<?php
// Database connection
$host = 'localhost';
$dbname = 'face_recognition';
$db_user = 'root';
$db_pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Encryption functions
function encrypt_image($imageData, $key) {
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-128-cbc'));
    $encrypted = openssl_encrypt($imageData, 'aes-128-cbc', $key, OPENSSL_RAW_DATA, $iv);
    return $iv . $encrypted;
}

function decrypt_image($encryptedData, $key) {
    $iv_length = openssl_cipher_iv_length('aes-128-cbc');
    $iv = substr($encryptedData, 0, $iv_length);
    $encrypted = substr($encryptedData, $iv_length);
    $decrypted = openssl_decrypt($encrypted, 'aes-128-cbc', $key, OPENSSL_RAW_DATA, $iv);
    return $decrypted;
}

$key = '1234567890abcdef'; // AES key
$uploadDir = 'encrypted_images/';
if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);

// Handle form actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';

    if (isset($_POST['encrypt']) && !empty($username)) {
        $data = $_POST['image_data'] ?? '';
        $image = str_replace('data:image/png;base64,', '', $data);
        $image = base64_decode($image);

        $encryptedData = encrypt_image($image, $key);
        $fileName = uniqid($username . '_') . '.enc';
        $filePath = $uploadDir . $fileName;
        file_put_contents($filePath, $encryptedData);

        // Store in DB
        $stmt = $pdo->prepare("INSERT INTO encrypted_faces (username, encrypted_file_path) VALUES (:username, :path)");
        $stmt->execute(['username' => $username, 'path' => $filePath]);

        // For display
        $encryptedBase64 = base64_encode($encryptedData);

        echo "<h3 class='success-message'>🔒 Image Encrypted Successfully!</h3>";
        echo "<p class='encrypted-info'>Encrypted image stored securely in the system.</p>";
        echo "<img src='data:image/png;base64,$encryptedBase64' alt='Encrypted Image' class='encrypted-image'><br><br>";
        echo "<a href='$filePath' class='download-button' download>Download Encrypted Image</a><br><br>";
        echo "<form method='post'><input type='hidden' name='username' value='$username'><button type='submit' name='decrypt' class='decrypt-button'>Decrypt Image</button></form><hr>";

    } elseif (isset($_POST['decrypt']) && !empty($username)) {
        $stmt = $pdo->prepare("SELECT encrypted_file_path FROM encrypted_faces WHERE username = :username ORDER BY id DESC LIMIT 1");
        $stmt->execute(['username' => $username]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && file_exists($result['encrypted_file_path'])) {
            $encryptedData = file_get_contents($result['encrypted_file_path']);
            $decryptedImage = decrypt_image($encryptedData, $key);
            $decryptedBase64 = base64_encode($decryptedImage);

            echo "<h3>Decrypted Face of <span style='color:green'>$username</span></h3>";
            echo "<img src='data:image/png;base64,$decryptedBase64' style='max-width:320px; height:auto;'><hr>";
        } else {
            echo "<p style='color:red;'>No encrypted image found for <b>$username</b>.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Face Encryption & Decryption</title>
    <style>
        /* Basic Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        h2 {
            color: #4CAF50;
        }

        .success-message {
            color: #4CAF50;
            font-size: 1.5em;
            font-weight: bold;
        }

        .encrypted-info {
            font-size: 1.2em;
            color: #444;
        }

        .encrypted-image {
            max-width: 200px; /* Adjusted for smaller image */
            height: auto;
            margin-top: 20px;
            border: 2px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .download-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .download-button:hover {
            background-color: #45a049;
        }

        .decrypt-button {
            background-color: #ff9800;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .decrypt-button:hover {
            background-color: #e68900;
        }

        .clear-button {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .clear-button:hover {
            background-color: #e53935;
        }

        form {
            margin-top: 20px;
        }

        input[type="text"] {
            padding: 10px;
            width: 200px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1em;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        video {
            border: 2px solid #ccc;
            border-radius: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <h2>Live Face Encryption and Decryption</h2>

    <form method="post" id="imageForm">
        <label>Enter Username:</label>
        <input type="text" name="username" id="username" required><br><br>

        <video id="video" width="640" height="480" autoplay></video><br>
        <button type="button" onclick="capture()">Capture & Encrypt</button>

        <input type="hidden" name="image_data" id="image_data">
        <input type="hidden" name="encrypt" value="1">
    </form>

    <button class="clear-button" onclick="clearForm()">Clear</button>

    <script>
        const video = document.getElementById('video');
        const imageInput = document.getElementById('image_data');

        // Access the camera
        navigator.mediaDevices.getUserMedia({ video: { width: 100, height: 100 } })
            .then(stream => video.srcObject = stream)
            .catch(err => alert("Camera access denied: " + err.message));

        // Capture image and send for encryption
        function capture() {
            const username = document.getElementById('username').value;
            if (!username.trim()) {
                alert("Please enter a username.");
                return;
            }

            const canvas = document.createElement('canvas');
            canvas.width = 640;
            canvas.height = 480;
            const ctx = canvas.getContext('2d');
            ctx.drawImage(video, 0, 0);
            imageInput.value = canvas.toDataURL('image/png');
            document.getElementById('imageForm').submit();
        }

        // Clear form and video
        function clearForm() {
            document.getElementById('imageForm').reset();
            document.getElementById('video').srcObject.getTracks().forEach(track => track.stop()); // Stop video
            document.getElementById('video').srcObject = null; // Clear the video
        }
    </script>
</body>
</html>
