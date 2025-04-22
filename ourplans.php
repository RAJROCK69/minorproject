<?php
    session_start();

    $firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
    $lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $number = isset($_POST['number']) ? $_POST['number'] : '';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription Page - easy tutorials</title>
    <link rel="stylesheet" href="style.css">
</head>

    <style>
       body {
            background-image:rgb(109, 245, 109);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            
        }

        body {
            font-family: Arial, sans-serif;
            background-image: url('https://img.freepik.com/fotos-premium/bloqueo-codigo-binario-big-data-ciberseguridad-conceptual-ia-generativa_438099-21539.jpg');
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative;
        }
        *{
    margin: 0;
    padding: 0;
    font-family: 'poppins', sans-serift;
    box-sizing: border-box;
}
.container{
    width: 100%;
    min-width: 100%;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
}
.co-1{
    flex-basis: 50%;
    flex-grow: 1;
    background-image:linear-gradient(rgba(0,0,0,.8),rgba(0,0,0,.8)),url("D:\html\html program\images\photo_2024-08-30_11-06-10.jpg");
    background-size: cover;
    background-position: center;
    min-width: inherit;
    padding: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    color: white;
}
.co-2{
    width: 50%;
    padding: 50px 80px;
    margin: 0 auto;
    border-radius: 10px;

}
.co-1 ul{
    list-style: none;
}

.co-1 ul li{
    display: flex;
    align-items: center;
    margin: 12px 0;
}

.co-1 ul li img{
    width: 20px;
    margin-right: 15px;
}


h2 img{
    width: 26px;
    margin-right: 10px;
}
form{
    width: 600px;
    color: #333;
    font-weight: 500;
    font-size: 14px;
}
label span{
    flex: 1;
    margin-left: 15px;
    font-size: 19px;
    font-weight: 600;
    color: #333;
}

label span small{
    font-size: 18px;
}
input[type="radio"]:checked + span{
    color: red;
}
input[type="text"],input[type="email"]{
    width: 100%;
    background: transparent;
    padding: 7px 10px;
    outline: none;
    border: 1px solid #333;
    border-radius: 4px;
    margin: 14px 0;
}
form button{
    background: #ff004f;
    color: #fff;
    font-size: 16px;
    padding: 12px 50px;
    margin: 20px 0;
    border: 0;
    outline: none;border-radius: 5px;
    cursor: pointer;
    transition: 0.5s;
}
form button:hover{
    transform: translate(-5px);
}
.f {
            background: rgb(22, 143, 0);
            color: #fff;
            font-size: 16px;
            padding: 12px 50px;
            margin: 5px 0;
            border: 0;
            outline: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.5s;
            text-align: center;
        }
       
        
       
    </style>
    <body>
    <div class="container" style="background-image: url(image/bg.jpg); height: 100vh; background-repeat: no-repeat; background-size: cover; background-position: center center; ">
        <!-- <div class="co-1">
            <img src="D:\html\html program\images\photo_2024-08-30_11-06-10.jpg" class="logo">
            
            <ul>
                <li><img src="D:\html\html program\images\photo_2024-08-30_11-06-49.jpg"style="width: 70px;">unlimited movies and shows</li>
                <li><img src="D:\html\html program\images\photo_2024-08-30_11-06-49.jpg"style="width: 70px;">unlimited movies and shows</li>
                <li><img src="D:\html\html program\images\photo_2024-08-30_11-06-49.jpg"style="width: 70px;">unlimited movies and shows</li>
                <li><img src="D:\html\html program\images\photo_2024-08-30_11-06-49.jpg"style="width: 70px;">unlimited movies and shows</li>
                <li><img src="D:\html\html program\images\photo_2024-08-30_11-06-49.jpg"style="width: 70px;">unlimited movies and shows</li>
                <li><img src="D:\html\html program\images\photo_2024-08-30_11-06-49.jpg"style="width: 70px;">unlimited movies and shows</li>
            </ul>
        </div> -->
     <div class="co-2" style="background-color: rgba(255, 255, 255, 0.747); width: 50%;">
        <h1 style="text-align: center; font-size: 48px;">Our Plans</h1>
       
        <form action="payment.php" method="post">
         
            
            
            </label>
            <label for="paid"><br>
            <input type="radio" name="Plans" id="paids" value="100">
            <span>100/FOR</span>1MONTH
            </label>
            <label for="paid"><br>
                <input type="radio" name="Plans" id="paids" value="250">
                <span>250<small>/FOR</small></span>3MONTHS
            </label>
            <label for="paid"><br>
                <input type="radio" name="Plans" id="paids" value="500">
                <span>500<small>/FOR</small></span>6MONTHS
            </label>
            <br>
            <p>YOUR NAME</p>
            <input type="text" name="name" placeholder="Enter Your Name" value="<?php echo $firstName." ".$lastName ?>">
            <p>EMAIL ADDRESS</p>
            <input type="email" name="email" placeholder="Enter Your Email Id" value="<?php echo $email ?>">
            
    <button type="submit" class="btn-submit">Subscribe
        <br>(i.e.Text and Image Both)
    </button>
    
</form>

<form action="encrypt.php">
    <button type="submit" class="f">
        <span style="font-size: 18px;">Free Trial
        <br>(i.e.Text and Image Both)
    </span>
    </button>
    
</form>

       
    </div>
</div>
</body>
</html>