<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="register.css">
    <title>Document</title>
    <button type="button" class="topbutton">
    <a href="login.php"></a>Login
    </button>
</head>
<body class="wrapper">
    <head>
        <h1 class="title">Gian's BLOG</h1>
    </head>
        <?php include 'standart.php' ?>
    <form action="myaccount.php">
    <div class="container">
        <h1>Login</h1>
        <p>Please fill in this form to login into ur account.</p>
        <hr>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter your Email" name="email" id="email" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter your Password" name="psw" id="psw" required>

        <hr>
        <button type="submit" class="registerbtn">Register</button>
    </div>
</form> 
</body>
</html>