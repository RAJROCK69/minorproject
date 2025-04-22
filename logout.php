<html>
    <style>
HTML CSSResult Skip Results Iframe
html {
  font-size: 16px;
  
}

body {
  padding: 0;
  margin: 0;
  font-family: system-ui, sans-serif;
  font-weight: normal;
  font-weight: 300; 
  line-height: 1.5;
  background-color: #566573;
  
}

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

.container {
  width: 25%;
  min-height: 40svh;
  display: flex;
  align-items: center;
  justify-content: auto ;
}

.accordions {
  width: 90%;
  max-width: 60ch;
  margin: 0 auto;
}

.accordion {
    border: 1px solid #ccc;
  margin-bottom: 1rem;
    overflow: hidden;
  transition: border-color .5s ease;
    background-color: #f1f1f1;

}

.accordion:hover {
  border-color: #000;
}

.accordion__header {
  cursor: pointer;
  font-weight: 500;
  font-size: 1.2rem;
  display: flex;
  align-items: center;
  position: relative;
  padding: 1rem;
  color: #666;

}
.accordion_header:after, .accordion_header:before {
  content: '';
  position: absolute;
  right: 1.5em;
  width: 2px;
  height: 0.75em;
  background-color: #666;
  transition: all 0.2s;
}
.accordion__header:after {
  transform: rotate(90deg);
}

.accordion:has(input:checked) .accordion__header {
  color: #000;
}

.accordion__content {
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.5s ease;
  * {
        padding: 0 1em 1em;
  }
}

.accordion input {
  display: none;
}

.accordion:has(input:checked) {
  border-color: #000;
  background-color: #fff;
  box-shadow: rgba(33, 35, 38, 0.1) 0px 10px 10px -10px;
}

.accordion input:checked ~ .accordion__header:before {
    transform: rotate(270deg) !important;
  background-color: #000;
 }

.accordion input:checked ~ .accordion__header:after {
    transform: rotate(270deg) !important;
  background-color: #000;
 }

.accordion input:checked ~ .accordion__content {
    max-height: 1000px; /* Adjust based on content length */
}
<?php
?>
<style>

footer {
    background-color: #000000 ; /* Dark background */
    color: #FFFFFF ;
    padding: 40px 20px;
    font-family: Arial, sans-serif;
}

.footer-container {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.footer-column {
    width: 23%;
    padding: 20px;
    color:#FFFFFF;
}

.footer-column h3 {
    color: #FFFFFF ; /* Light grey color for headings */
    margin-bottom: 15px;
}

.footer-column ul {
    list-style: none;
    padding-left: 0;
}

.footer-column ul li {
    margin-bottom: 10px;
}

.footer-column ul li a {
    text-decoration: none;
    color: #FFFFFF ;
    transition: .5s;
}

.footer-column ul li a:hover {
    color: #FC036B; /* Green color on hover */
}

.social-buttons {
    margin-top: 20px;
}

.social-icon {
    display: inline-block;
    background-color: #555;
    color: white;
    padding: 10px;
    margin-right: 10px;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    line-height: 25px;
    text-align: center;
    transition: background-color 0.3s ease;
}

.social-icon:hover {
    background-color: #28a745; 
}


.social-icon i {
    font-size: 18px; 
}

.social-icon.facebook {
    background-color: #3b5998; 
}

.social-icon.twitter {
    background-color: #1da1f2; 
}

.social-icon.instagram {
    background-color: #e1306c; 
}

.social-icon.linkedin {
    background-color: #0077b5; 
}

.footer-bottom {
    text-align: center;
    background-color: #222;
    padding: 10px 0;
}

.footer-bottom p {
    margin: 0;
    font-size: 14px;
}

@media (max-width: 768px) {
    .footer-column {
        width: 48%;  
        margin-bottom: 20px;
    }

    .social-icon {
        width: 35px;
        height: 35px;
        line-height: 35px;
    }
}
.h{
    color: #ccc;

}

</style>
 <div class="h">
<h1 > Help Us :</h1></div>
<div class="container">
  <div class="accordions">
    <div class="accordion">
        <input type="checkbox" id="question-1">
        <label for="question-1" class="accordion__header" id="question-1">How to Encrypted Text Message? </label>
        <div class="accordion__content">
            <p>Encrypt a text message using encryption algorithms like AES or RSA, with a secret key or public-private key pair.</p>
        </div>
    </div>

    <div class="accordion">
        <input type="checkbox" id="question-2">
        <label for="question-2" class="accordion__header">How to Encrypted a Image?</label>
        <div class="accordion__content">
          <p> Encrypt an image by converting it to binary data and applying encryption algorithms like AES with a secure key.</p>
        </div>
    </div>

    <div class="accordion">
        <input type="checkbox" id="question-3">
        <label for="question-3" class="accordion__header">How to Encrypted a message/image & how to Decrypted the data?</label>
        <div class="accordion__content">
            <p> To encrypt a message or image, convert it into binary data and apply an encryption algorithm like AES with a secure key. To decrypt, use the same key and algorithm to reverse the process, restoring the original data. Both encryption and decryption ensure data confidentiality during storage or transmission.</p>
        </div>
    </div>
</div>
  
</div>

<footer>
    <div class="footer-container">

    <div class="footer-column">
            <h3>About Chiper :</h3>
            <p> A cipher is a method used to encrypt and decrypt information, ensuring data security and confidentiality. It converts plain text (readable data) into ciphertext (unreadable format) using an algorithm and a key. Common types of ciphers include symmetric (e.g., AES) and asymmetric (e.g., RSA), differing in how keys are used for encryption and decryption.</p>
        </div>

        <div class="footer-column">
            <h3>Quick Links :</h3>
            <ul>
                <li><a href="http://127.0.0.1:5000/">Home</a></li>
                <li><a href="http://127.0.0.1:5000/loginoption">Login</a></li>
                <li><a href="http://127.0.0.1:5000/register">Registration</a></li>
                <li><a href="dataConcealed.php">Data Concealed </a></li>
                
                  
                <?php if (isset($_SESSION['user_id'])): ?>
                <!-- If the user is logged in, show profile and logout options -->
                <li><a href="../user/dashboard.php" >Dashboard</a></li>
                <li><a href="../auth/logout.php" >Logout</a></li>
            <?php else: ?>
            <!-- If the user is not logged in, show login and register options -->
            <?php endif; ?>
            </ul>
        </div>
        
        <div class="footer-column">
            <h3>Map :</h3>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3687.6191877399447!2d88.41285357475343!3d22.443354637696046!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a0272166e4cb263%3A0x27f12170efd9ddee!2sFuture%20Institute%20of%20Engineering%20and%20Management!5e0!3m2!1sen!2sin!4v1731876682474!5m2!1sen!2sin" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        

        <div class="footer-column">
            <h3>Contact & Social</h3>
            <p>Phone: +1 (234) 567-890</p>
            <p>Email: info@eventura.com</p>
            
            <!-- Social Media Links -->
            <div class="social-buttons">
                <a href="#" class="social-icon facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-icon twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-icon instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-icon linkedin"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>&copy; <?php echo date("Y"); ?> Eventura - All rights reserved.</p>

        <!-- Display login/logout links based on user role -->
        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- If the user is logged in -->
            <p>
                Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> 
                | <a href="../auth/logout.php">Logout</a>
            </p>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <!-- If logged-in user is an admin, display admin-specific link -->
                <p><a href="../admin/dashboard.php">Admin Dashboard</a></p>
            <?php endif; ?>
        <?php else: ?>
            <!-- If no user is logged in -->
            <p><a href="login.php" style="color: #fff">User Login</a> | <a href="contact.php" style="color: #fff">Admin Login</a></p>
        <?php endif; ?>
    </div>
</footer>

<!-- Font Awesome CDN for CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</html>