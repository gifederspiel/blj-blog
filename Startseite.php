<?php 
$user = 'root';
$password = '';

$pdo = new PDO('mysql:host=localhost;dbname=blog', $user, $password,[
    PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION, 
    PDO::MYSQL_ATTR_INIT_COMMAND    => 'SET NAMES utf8',
]);

$title = $_POST['title'] ?? '';
$content = $_POST['content'] ?? '';
$createdat = $_POST['createdat'] ?? '';
$createdby =$_POST['username'] ?? '';
$picture =$_POST['bild'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Document</title>
</head>
<body class="wrapper">
    <head>
        <h1 class="title">Gian's BLOG</h1>
    </head>
        <?php include 'standart.php' ?>
        <br>

    <?php
    $stmt = $pdo->query('SELECT * FROM `blog` ORDER BY `created_at`DESC');
    foreach($stmt->fetchAll() as $x) {
        ?>
    <h2 class="title1"><?php echo"$x[3]"?></h2>
    <h3 class="author1"><?php echo"$x[1]"?></h3>
    <h3 class="date1"><?php echo"$x[2]"?></h3>
    <p class="content1"><?php echo"$x[4]"?></p>
    <img src="<?php echo "$x[5]"?>" alt="" class="picture">
    <hr>
    
    <?php
    }
    ?>
    
</body>
</html>