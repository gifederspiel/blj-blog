<?php 
$user = 'd041e_gifederspiel';
$passwd = '12345_Db!!!';

$pdo = new PDO('mysql:host=mysql2.webland.ch;dbname=d041e_gifederspiel', $user, $passwd,[
    PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION, 
    PDO::MYSQL_ATTR_INIT_COMMAND    => 'SET NAMES utf8',
]);


$errors= [];
$formSent=false;

$fname = htmlspecialchars($_POST["fname"] ?? '');
$lname = htmlspecialchars($_POST["lname"] ?? '');
$username = htmlspecialchars($_POST["username"] ?? '');
$password = htmlspecialchars($_POST["password"] ?? '');

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    $username = trim($username);

    if ($fname === ''){
        array_push($errors, "First Name not valid");
    }
    if ($lname === ''){
        array_push($errors, "Last Name not valid");
    }
    if ($username === ''){
        array_push($errors, "Username not valid");
    }
    if ($password === ''){
        array_push($errors, "Passwort not valid");
    }
}
if (count($errors)===0){
    if(isset($_POST["register"])){
        var_dump($fname);
        $dbconnection = new PDO('mysql:host=mysql2.webland.ch;dbname=d041e_gifederspiel', $user, $passwd);
        $stmt = $dbconnection->prepare("INSERT INTO users (first_name, last_name, username, password) VALUES (:first_name, :last_name, :username, :password)");
        $stmt->execute([":first_name" => "$fname", ":last_name" => "$lname", ":username" => "$username", ":password" => "$password"]);
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
            <form action="register.php" method="post">
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
                    <?php 
                    
                    echo '<dl>';
                    if (count($errors)>0){
                        
                        for($i=1;$i<count($errors);$i++){
                            echo "<li class='error-box'>$errors[$i]</li>";
                            }
                        }
                    echo '</dl>';
                        
                    ?>
                    <hr>
                    <button type="submit" id="register" name="register"class="registerbtn">Register</button>
                </div>

                <div class="container">
                    <p>Already have an account? <a href="login.php">Log in</a>.</p>
                </div>
            </form>
            <div>
            
        </div>
        </div> 
    </div>
</body>
</html>