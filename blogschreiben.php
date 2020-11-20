<?php 
$user = 'root';
$password = '';

$pdo = new PDO('mysql:host=localhost;dbname=blog', $user, $password,[
    PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION, 
    PDO::MYSQL_ATTR_INIT_COMMAND    => 'SET NAMES utf8',
]);


$errors = [];
$formSent = false;

$title = $_POST['title'] ?? '';
$content = $_POST['content'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    $title = trim($title);
    $content =trim($content);

    if ($name === ''){
        array_push($errors, "The title is invalid");
    }

}


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
    <div>
        <h1 class="title">BLOG erfassen</h1>
    </div>
    <?php include 'standart.php' ?>
    <form class="formular">
        <lable for="title"></lable><br>
        <input type="text" id="title" name="title"placeholder="Title:">
        <lable for="username"></lable>
        <input type="text" id="username" name="username" placeholder="Username:"><br>
        <label for="content" class="contentinput"></label><br>
        <textarea id="content" name="content" rows="30" cols="163"placeholder="Content:"></textarea><br>
        <button type="button">Submit</button>
    </form>
    <div>
        <?php 
        var_dump($pdo);
        $stmt = $pdo->query('SELECT * FROM `blog`');
        foreach($stmt->fetchAll()as $input){
            var_dump($input);
        }   
        foreach($stmt->fetchAll()as $task){
            echo '<p>' .$task . '</p>';
        }
        if (count($errors)>0){
            foreach($errors as $error){
                echo "$error";
            }
        }
        ?>
    </div>
</body>
</html>