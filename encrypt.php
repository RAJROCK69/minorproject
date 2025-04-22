<?php
session_start();

function generateKey() {
    return bin2hex(random_bytes(16));
}

function encryptText($text, $key) {
    $iv = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $encrypted = openssl_encrypt($text, 'aes-256-cbc', hex2bin($key), 0, $iv);
    return ['encrypted_text' => $encrypted, 'iv' => bin2hex($iv)];
}

function decryptText($text, $key, $iv) {
    return openssl_decrypt($text, 'aes-256-cbc', hex2bin($key), 0, hex2bin($iv));
}

$encrypted_text = null;
$decrypted_text = null;
$key = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $text = $_POST['en-text'] ?? '';
    if (!empty($text)) {
        $key = generateKey();
        $encryptionResult = encryptText($text, $key);
        $encrypted_text = $encryptionResult['encrypted_text'];
        $iv = $encryptionResult['iv'];
        $decrypted_text = decryptText($encrypted_text, $key, $iv);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Auto Encrypt & Decrypt</title>
    <style>
        body {
            background-image: url('sky-sunset.jpg');
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px); /* For Safari */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        h1 {
            font-size: 2rem;
            margin-bottom: 20px;
        }
        .container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            max-width: 80%;
            width: 100%;
        }
        form {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
            outline: none;
            background: #f4f4f4;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1rem;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #218838;
        }
        .result {
            margin: 20px auto;
            padding: 10px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            text-align: left;
        }
        .result strong {
            color: #ffdd57;
        }
        footer {
      position: fixed;
      bottom: 0;
      left: 0;
      background-color: rgba(36, 36, 88, 0.8);
      padding: 10px 20px;
      z-index: 1000;
      border-radius: 8px 0 0 0; /* Round top-left corner */
    }
    a {
      color: #ffdd57;
      text-decoration: none;
    }
    a:hover {
      text-decoration: underline;
    }
    header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      background-color: rgba(36, 36, 88, 0.8);
      padding: 10px 20px;
      z-index: 1000;
    }
    header h1 {
      margin: 0;
    }
    </style>
</head>
<body>
        <!-- Header -->
  <header class="py-4 px-3">
    <nav class="flex justify-between items-center">
      <h1 class="text-2xl font-bold text-grey-500">Message Encrypt</h1>
    </nav>
  </header>

    <h1 style="margin-top: 80px;">Auto Encryption & Decryption</h1>
    <div class="container">
        <form method="POST">
            <label for="en-text">Enter Text to Encrypt:</label>
            <input type="text" id="en-text" name="en-text" required>
            <button type="submit">Encrypt & Decrypt</button>

            <?php if ($encrypted_text && $decrypted_text): ?>
                <div class="result">
                    <p><strong>Encrypted Text:</strong> <?php echo htmlspecialchars($encrypted_text); ?></p>
                    <p><strong>Key:</strong> <?php echo htmlspecialchars($key); ?></p>
                    <p><strong>Decrypted Text:</strong> <?php echo htmlspecialchars($decrypted_text); ?></p>
                </div>
            <?php endif; ?>
        </form>
    </div>

    <!-- Clear Session Variables -->
    <form action="?page=clear-flask-vars" method="POST" style="margin-top: 10px;">
        
        <button type="submit">Clear Variables</button>
    </form>
     <!-- Logout Button -->
      
     <form action="logout.php" method="POST" style="margin-top: 10px;">
        <button type="submit" class="logout">Logout</button>
    </form>
    <footer >
     <!-- Left Content -->
     <div class="text-white">
       <p class="mb-2">&copy; 2025 Major Project</p>
       <p>Designed and Developed by <a  style="color: #ffdd57; text-decoration: none;">THE VANQUISHER</a></p>
     </div>
</footer>
</body>
</html>
