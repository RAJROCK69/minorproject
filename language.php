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
        if ($stmt_result->num_rows > 0) {
            $data = $stmt_result->fetch_assoc();
            if ($data['password'] === $password) {
                if(isset($_POST["submit"]))
                {
                    header('Location:lang.php');
                }
            } else {
                echo "<h2>Invalid Email or password</h2>";
            }
        } else {
            echo "<h2>Invalid Email or password</h2>";
        }
    }
} 
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Language Selection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <style>
        .card{
    height: 100px ;
    line-height: 100px;
    width: 100%;
    background-image: url("./cipher.png");
    background-size: 500px;
    background-position: fixed;
}
.hindi
{
    background-color: #000;
  color: #fff;
  opacity: 0.8;
   
   
}

.english
{
    background-color: #000;
  color: #fff;
  opacity: 0.8;
   
}

.bengali
{
    background-color: #000;
  color: #fff;
  opacity: 0.8;
    
}
.marathi
{
    background-color: #000;
  color: #fff;
  opacity: 0.8;
   
}
.punjabi
{
    background-color: #000;
  color: #fff;
  opacity: 0.8;
   
}
.tamil
{
    background-color: #000;
  color: #fff;
  opacity: 0.8;
    
}
.gujrati
{
    background-color: #000;
  color: #fff;
  opacity: 0.8;
  
}
.malayalam
{
    background-color: #000;
  color: #fff;
  opacity: 0.8;
  
}
.telugu
{
    background-color: #000;
  color: #fff;
  opacity: 0.8;
   
}
a{
    text-decoration: none;
    color: white !important;
}
body {
    background-image: url("./log4.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
}
.topspacing
{
    margin-top: 130px;
}
.text {
   
    color:#FFFFFF;
   
}
    </style>
<body>
    <div class="text">
  <h1><u><center>SELECT LANGUAGE :</center></u></h1>
  </div>
    <div class="container text-center">
        <!-- Display selected language -->
        <?php
if (isset($_POST['language'])) {
    echo '<div class="alert alert-success">
            <strong>Selected Language: </strong>' . htmlspecialchars($_POST['language']) . '
          </div>';
}
if(isset($_POST['submit'])){
    header('Location:txt.php');
}
?>

        <form action="encrypt.php" method="POST">
            <div class="topspacing">
                <div class="row">
                    <div class="col-md-4">
                        <label>
                            <input type="radio" name="language" value="Hindi" style="display: none;">
                            <div class="card hindi" style="width: 16rem;">
                                <div class="card-body">
                                    <h5 class="card-title">हिन्दी</h5>
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label>
                            <input type="radio" name="language" value="Bengali" style="display: none;">
                            <div class="card bengali" style="width: 16rem;">
                                <div class="card-body">
                                    <h5 class="card-title">বাংলা</h5>
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label>
                            <input type="radio" name="language" value="English" style="display: none;">
                            <div class="card english" style="width: 16rem;">
                                <div class="card-body">
                                    <h5 class="card-title">English</h5>
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <label>
                            <input type="radio" name="language" value="Marathi" style="display: none;">
                            <div class="card marathi" style="width: 16rem;">
                                <div class="card-body">
                                    <h5 class="card-title">मराठी</h5>
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label>
                            <input type="radio" name="language" value="Punjabi" style="display: none;">
                            <div class="card punjabi" style="width: 16rem;">
                                <div class="card-body">
                                    <h5 class="card-title">ਪੰਜਾਬੀ</h5>
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label>
                            <input type="radio" name="language" value="Tamil" style="display: none;">
                            <div class="card tamil" style="width: 16rem;">
                                <div class="card-body">
                                    <h5 class="card-title">தமிழ்</h5>
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <label>
                            <input type="radio" name="language" value="Gujarati" style="display: none;">
                            <div class="card gujrati" style="width: 16rem;">
                                <div class="card-body">
                                    <h5 class="card-title">ગુજરાતી</h5>
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label>
                            <input type="radio" name="language" value="Malayalam" style="display: none;">
                            <div class="card malayalam" style="width: 16rem;">
                                <div class="card-body">
                                    <h5 class="card-title">മലയാളം</h5>
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="col-md-4">
                        <label>
                            <input type="radio" name="language" value="Telugu" style="display: none;">
                            <div class="card telugu" style="width: 16rem;">
                                <div class="card-body">
                                    <h5 class="card-title">తెలుగు</h5>
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            <br>
            <center>
                <button type="submit" style="width: 200px; height: 50px;">SUBMIT LANGUAGE PREFERENCE</button>
            </center>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</body>
</html>
