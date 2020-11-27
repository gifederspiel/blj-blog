<?php
session_start();
$host ="mysql2.webland.ch";
$user="d041e_gifederspiel";
$passwd="12345_Db!!!";
$database="d041e_gifederspiel";
$message = "";



try
{
    $connect = new PDO ("mysql:host=$host; dbname=$database", $user, $passwd);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST["login"])){
        if(empty($_POST["username"]) || empty($_POST["password"])){
            $message = '<label>All fields are required</label>';
        }
        else{
            $query = "SELECT * FROM `users` WHERE username = :username AND password = :password";
            $statement = $connect->prepare($query);
            $statement->execute(
                array(
                    'username' => $_POST["username"],
                    'password' => $_POST["password"]
                )
            );
            $count = $statement->rowCount();
            if($count > 0){
                $_SESSION["username"] = $_POST["username"];
                header("location: login_success.php");
                
            }
            else{
                $message = '<label>Wrong Data</label>';
            }
        }
    }
}
catch(PDOEXCEPTION $error)
{
    $message = $error->getMESSAGE();
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="register.css">
    <title>Login</title>
    
    
</head>
<body>
    <div class="wrapper">

        <header>
            <h1 class="title">Login</h1>
            <?php include 'standart2.php' ?>
        </header>
            
        <?php include 'standart.php' ?>
    
        <div>
            <?php 
            if(isset($message)){
                echo '<label class="error-box">'.$message.'</label>';
            }
            ?>
            <form action="login.php" method="post">
                <div class="container">
                    <p>Please fill in this form to login into ur account.</p>

                    <label for="email"><b>Username</b></label>
                    <input type="text" placeholder="Enter your username" name="username" id="username" required>

                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter your Password" name="password" id="password" required>

                    <hr>
                    <button type="submit" name="login" value="login"class="registerbtn">Login</button>
                </div>
            </form> 
        </div>
    </div>
</body>
</html>