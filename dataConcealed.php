<?php
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Database connection here
    $con = new mysqli("localhost", "root", "", "registration");
    if ($con->connect_error) {
        die("Failed to connect: " . $con->connect_error);
    } else {
        $stmt = $con->prepare("SELECT * FROM registration WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        
    }
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encryption Options</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-image: url("./pic.jpg");
            background-size: cover;
           
            color: #fff;
            text-align: center;
            
        }
        button {
            margin: 10px 0;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #45a049;
        }
        a {
            text-decoration: none;
            color: white;
        }
    </style>
</head>
<body>
<h1>Data Concealed</h1>
    <form action="language.php" method="POST" style="margin-top: 10px;">
        <button id="message-encryption" name="message-encryption">
        Message Encryption
    </button>
</form>
<form action="image.php" method="POST" style="margin-top: 10px;">
    <button id="image-encryption" name="image-encryption">
        Image Encryption
    </button></form>
</body>
</html>