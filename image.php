<?php
// ----- CONFIG -----
define('SECRET_KEY', 'your16bytekey123');  // Must be 16 bytes
define('IV', 'my_iv_secret_16b');          // Must be 16 bytes
$UPLOAD_FOLDER = 'uploads/';

$decrypted_image_base64 = '';
$encrypted_exists = false;
$encrypted_image = null;
$mime_type = 'image/png';  // default fallback

// Database connection
$host = 'localhost';
$dbname = 'face_recognition';
$username = 'root';
$password = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// ----- ENCRYPTION / DECRYPTION -----
function encrypt_image($input_path) {
    $data = file_get_contents($input_path);
    return openssl_encrypt($data, 'AES-128-CBC', SECRET_KEY, OPENSSL_RAW_DATA, IV);
}

function decrypt_image($encrypted_data) {
    return openssl_decrypt($encrypted_data, 'AES-128-CBC', SECRET_KEY, OPENSSL_RAW_DATA, IV);
}

// ----- HANDLE POST REQUEST -----
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_FILES["image"])) {
        $filename = basename($_FILES["image"]["name"]);
        $original_image_path = $UPLOAD_FOLDER . $filename;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $original_image_path)) {
            $encrypted_data = encrypt_image($original_image_path);

            // Detect mime type
            $mime_type = mime_content_type($original_image_path);

            // Store encrypted image
            $stmt = $pdo->prepare("INSERT INTO encrypted_images (filename, encrypted_data, mime_type) VALUES (?, ?, ?)");
            $stmt->execute([$filename, $encrypted_data, $mime_type]);

            // Fetch for display
            $encrypted_exists = true;
            $stmt = $pdo->prepare("SELECT * FROM encrypted_images ORDER BY uploaded_at DESC LIMIT 1");
            $stmt->execute();
            $encrypted_image = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($encrypted_image) {
                $decrypted_data = decrypt_image($encrypted_image['encrypted_data']);
                $decrypted_image_base64 = 'data:' . $encrypted_image['mime_type'] . ';base64,' . base64_encode($decrypted_data);
            }

            unlink($original_image_path);  // optional cleanup
        }
    }

    if (isset($_POST['clear'])) {
        $stmt = $pdo->prepare("DELETE FROM encrypted_images");
        $stmt->execute();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// ----- DOWNLOAD HANDLER -----
if (isset($_GET['download_id'])) {
    $download_id = $_GET['download_id'];
    $stmt = $pdo->prepare("SELECT * FROM encrypted_images WHERE id = ?");
    $stmt->execute([$download_id]);
    $image = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($image) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $image['filename'] . '.enc"');
        echo $image['encrypted_data'];
        exit;
    } else {
        echo "Image not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Encrypt & Decrypt Image</title>
    <style>
        body {
            background-image: url('sky-sunset.jpg');
            backdrop-filter: blur(10px);
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }
        form {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        input[type="file"] {
            padding: 10px;
            margin: 10px 0;
        }
        button, .download-btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }
        button {
            background-color: #28a745;
            color: white;
        }
        .download-btn {
            background-color: #007bff;
            color: white;
            text-decoration: none;
        }
        .download-btn:hover {
            background-color: #0056b3;
        }
        .clear-btn {
            background-color: red;
            color: white;
        }
        .result {
            background: rgba(100, 100, 100, 0.2);
            padding: 10px;
            border-radius: 8px;
            margin-top: 20px;
        }
        img {
            max-width: 500px;
            margin-top: 10px;
            border-radius: 8px;
        }
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            background-color: rgba(36, 36, 88, 0.8);
            padding: 10px 20px;
            border-radius: 8px 0 0 0;
        }
    </style>
</head>
<body>

<h2>Automatic Encrypt & Decrypt Image</h2>

<form method="post" enctype="multipart/form-data">
    <input type="file" name="image" accept="image/*" required>
    <br>
    <button type="submit">Upload & Encrypt</button>
</form>

<?php if ($encrypted_exists && $encrypted_image): ?>
    <p class="result">🔒 Image Encrypted Successfully!</p>
    <a href="?download_id=<?= $encrypted_image['id'] ?>" class="download-btn">Download Encrypted Image</a>
<?php endif; ?>

<?php if ($decrypted_image_base64): ?>
    <div class="result">
        <p>🔓 Decrypted Image:</p>
        <img src="<?= $decrypted_image_base64 ?>" alt="Decrypted Image">
        <form method="post">
            <button type="submit" name="clear" class="clear-btn">❌ Clear</button>
        </form>
    </div>
<?php endif; ?>
<!-- Logout Button -->
      
<form action="logout.php" method="POST" style="margin-top: 10px;">
        <button type="submit" class="logout">Logout</button>
    </form>

<footer>
    <p>&copy; 2025 Major Project</p>
    <p>Designed and Developed by <span style="color:#ffdd57;">THE VANQUISHER</span></p>
</footer>

</body>
</html>
