
<?php
$dbuser = "d041e_listuder";
$dbpass = "12345_Db!!!";

$pdo = new PDO("mysql:host=mysql2.webland.ch;dbname=d041e_listuder", $dbuser, $dbpass, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Links</title>
</head>
<body>
    <div class="wrapper">
        
    <header>
            <h1 class="title">Links to other blj member Blogs</h1>
            <?php include 'standart2.php' ?>
        </header>

        <?php include 'standart.php' ?>

        <?php echo '<div class="links">';
        $sqlQuery = $pdo->query("SELECT * FROM `blog_url`");
        ?><br><br><?php
        foreach ($sqlQuery->fetchAll() as $x){
            ?>
            <a href="<?php echo "$x[2]"?>" class="name">Blog from  <?php echo "$x[1]"?></a><br><br>
    
            <?php
        }
        echo '</div>';

            ?>
        
    </div>
</body>
</html>