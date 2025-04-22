
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
         body {
            background-image:rgb(109, 245, 109);
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            
        }

        body {
            font-family: Arial, sans-serif;
            background-image: url('lock.jpg');
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative;
        }
        body::after
        {
            position: absolute;
    content: '';
    background-color: #000000c7;
    width: 100%;
    height: 100%;
    z-index: -1;
        }
        .container {
            width: 300px;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #0056b3;;
        }
        .toggle-link {
            display: block; 
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container" id="auth-container">
        <div id="login-form">
        <form action="dataConcealed.php" method="POST">
    <div class="form-group">
        <label for="login-email">Email:</label>
        <input type="email" id="login-email" name="email" required>
    </div>
    <div class="form-group">
        <label for="login-password">Password:</label>
        <input type="password" id="login-password" name="password" required>
    </div>
    <div class="form-group">  
    <form action="dataConcealed.php" method="POST"> <button type="submit" class="submit">Log In</button></form>
    </div>
    <div><p>Not registered yet <a href="registration.php">Register Here</a></p></div>
</form>

              
</body>
</html>