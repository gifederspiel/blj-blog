
<?php
$dbuser = "d041e_listuder";
$dbpass = "12345_Db!!!";

$pdo = new PDO("mysql:host=mysql2.webland.ch;dbname=d041e_listuder", $dbuser, $dbpass, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
]);
echo '<div class="links">';
$sqlQuery = $pdo->query("SELECT * FROM `blog_url`");
foreach ($sqlQuery->fetchAll() as $x){
    ?>
    <a href="<?php echo "$x[2]"?>" class="name">Blog von: <?php echo "$x[1]"?></a><br><br>
    
    <?php
}
echo '</div>';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Links</title>
    <button type="button" class="topbutton">
    <a href="login.php"></a>Login
    </button>
</head>
<body class="wrapper">
    <div>
        <h1 class="title">Links zu anderen BLJ Blogs</h1>
        
    </div>
    <?php include 'standart.php' ?>  
</body>
</html>