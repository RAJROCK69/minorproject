<?php
if (isset($_POST["submit"])) {
    header('Location:ourplans.php');
}
$name = isset($_POST['name']) ? $_POST['name'] : '';
    
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    

?>
<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Track OTP and payment states
$otp_verified = false;
$payment_successful = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_otp'])) {
    $email = $_POST['email'];
    $_SESSION['otp'] = rand(100000, 999999); // Generate OTP
    $_SESSION['email'] = $email;

    // Send OTP email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Gmail's SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'crackthecode25@gmail.com'; // Admin email
        $mail->Password   = 'gazu lear jjcj lltx'; // App password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('crackthecode25@gmail.com', 'Cipher Site'); // Sender
        $mail->addAddress($email); // Recipient

        $mail->Subject = 'Cipher Site OTP Verification';
        $mail->Body    = "Dear User,\n\nYour OTP for verification is: " . $_SESSION['otp'] . "\n\nThank you for using Cipher Site.";

        $mail->send();
        $otp_sent = true;
    } catch (Exception $e) {
        $error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['verify_otp'])) {
    $user_otp = $_POST['otp'];

    if ($_SESSION['otp'] == $user_otp) {
        // OTP validated
        $otp_verified = true;
    } else {
        $otp_error = "Invalid OTP. Please try again.";
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_payment'])) {
    // Payment processing logic here (placeholder)
    $payment_successful = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('https://img.freepik.com/fotos-premium/bloqueo-codigo-binario-big-data-ciberseguridad-conceptual-ia-generativa_438099-21539.jpg');
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .payment-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input:focus {
            border-color: #007bff;
            outline: none;
        }

        .btn-submit {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

        .success-message {
            color: green;
            text-align: center;
        }

        .error-message {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        
        <?php if (isset($otp_error)) echo "<p class='error-message'>$otp_error</p>"; ?>
        <?php if (isset($error)) echo "<p class='error-message'>$error</p>"; ?>

        <!-- Step 1: OTP Verification -->
        <?php if (!$otp_verified && !$payment_successful): ?>
            <h1> OTP Verification</h1>
            <form method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo $email ?>" required>
                </div>
                <?php if (isset($otp_sent)): ?>
                    <div class="form-group">
                        <label for="otp">Enter OTP</label>
                        <input type="text" id="otp" name="otp" maxlength="6" pattern="\d{6}" required>
                    </div>
                    <button type="submit" name="verify_otp" class="btn-submit">Verify OTP</button>
                <?php else: ?>
                    <button type="submit" name="send_otp" class="btn-submit">Send OTP</button>
                <?php endif; ?>
            </form>
        <?php endif; ?>

        <!-- Step 2: Payment Form -->
   
        <?php if ($otp_verified && !$payment_successful): ?>
            <h1> Card Details</h1>
            <form action="dataConcealed2.php" method="POST">
            <div class="form-group">
            <label for="name">Name on Card</label>
            <input type="text" id="name" name="name_on_card" required>
        </div>
        <div class="form-group">
            <label for="card-number">Card Number</label>
            <input type="text" id="card-number" name="card_number" pattern="\d{16}" maxlength="16" required placeholder="Enter 16-digit card number">
        </div>
        <div class="form-group">
    <label for="expiry-date">Expiry Date (MM/YY)</label>
    <input type="text" id="expiry-date" name="expiry_date" pattern="\d{2}/\d{2}" maxlength="5" required placeholder="MM/YY">
</div>
        <div class="form-group">
            <label for="cvv">CVV</label>
            <input type="text" id="cvv" name="cvv" pattern="\d{3}" maxlength="3" required placeholder="3-digit CVV">
        </div>
                <button type="submit" name="submit_payment" class="btn-submit">Pay Now</button>
        
        <?php endif; ?>

        <!-- Step 3: Payment Success -->
        <?php if ($payment_successful): ?>
            <p class="success-message">Payment Successful! Thank you for your purchase.</p>
                <?php header('Location:dataConcealed2.php'); ?>

        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>
    
</body>
</html>