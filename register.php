<?php 
$user = 'root';
$passwd = '';

$pdo = new PDO('mysql:host=localhost;dbname=blog_users', $user, $passwd,[
    PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION, 
    PDO::MYSQL_ATTR_INIT_COMMAND    => 'SET NAMES utf8',
]);

$errors[]="";
$formsent= false;

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$username = $_POST["username"];
$password = $_POST["password"]

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = trim($username);

    if ($fname === ''){
        array_push($errors "First Name not valid")
    }
    if ($lname === ''){
        array_push($errors "Last Name not valid")
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="register.css">
    <title>Register</title>
</head>
<body>
    <div class="wrapper">
        <header>
            <h1 class="title">Register</h1>
            <?php include 'standart2.php' ?>
        </header>
        
        <?php include 'standart.php' ?>
    
        <div class="registerform">  
            <form action="register.inc.php" method="post">
                <div class="container">
                    <p>Please fill in this form to create an account.</p>

                    <label for="text"><b>First Name</b></label>
                    <input type="text" placeholder="Enter First Name" name="fname" id="fname" require>

                    <label for="text"><b>Last Name</b></label>
                    <input type="text" placeholder="Enter Last Name" name="lname" id="lname" require>

                    <label for="email"><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="username" id="username" required>

                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password" id="password" required>

                    <label for="psw-repeat"><b>Repeat Password</b></label>
                    <input type="password" placeholder="Repeat Password" name="psw-repeat" id="psw-repeat" required>
                    <hr>
                    <button type="submit" class="registerbtn">Register</button>
                </div>

                <div class="container">
                    <p>Already have an account? <a href="login.php">Log in</a>.</p>
                </div>
            </form>
        </div> 
    </div>
</body>
</html>