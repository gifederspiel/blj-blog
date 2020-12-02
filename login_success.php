<?php
include 'standart.php';
include 'standart2.php';?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
<?php
session_start();
if(isset($_SESSION["username"])){
    echo "<h3>Login Success, Welcome - ".$_SESSION["username"]."</h3><br>";
    echo "<a href=\"logout.php\">Logout</a>";
    $_SESSION["loggedin"] = true;
    
}
else{
    header("location: login.php");
    $_SESSION["loggedin"] = false;
}