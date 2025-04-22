<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = ""; // Default password for local XAMPP
$dbname = "payment_system";

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture and sanitize form data
    $name_on_card = $_POST['name_on_card'] ?? null;
    $card_number = $_POST['card_number'] ?? null;
    $expiry_date = $_POST['expiry_date'] ?? null;
    $cvv = $_POST['cvv'] ?? null;

    // Validate inputs
    if (!$name_on_card || !$card_number || !$expiry_date || !$cvv) {
        die("<p style='color: red;'>All fields are required.</p>");
    }
    if (!preg_match('/^\d{16}$/', $card_number)) {
        die("<p style='color: red;'>Invalid card number. It must be 16 digits.</p>");
    }
    if (!preg_match('/^\d{3}$/', $cvv)) {
        die("<p style='color: red;'>Invalid CVV. It must be 3 digits.</p>");
    }
    if (!preg_match('/^\d{2}\/\d{2}$/', $expiry_date)) {
        die("<p style='color: red;'>Invalid expiry date format. Use MM/YY.</p>");
    }

    // Create database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("<p style='color: red;'>Connection failed: " . $conn->connect_error . "</p>");
    }

    // Insert payment data into the database
    $sql = "INSERT INTO payments (name_on_card, card_number, expiry_date, cvv, payment_status)
            VALUES ('$name_on_card', '$card_number', '$expiry_date', '$cvv', 'Successful')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>Payment Successful! Thank you for your purchase.</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }

    // Close the connection
    $conn->close();
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