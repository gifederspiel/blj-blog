<?php 
$user = 'd041e_gifederspiel';
$password = '12345_Db!!!';
session_start();

$pdo = new PDO('mysql:host=mysql2.webland.ch;dbname=d041e_gifederspiel', $user, $password,[
    PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION, 
    PDO::MYSQL_ATTR_INIT_COMMAND    => 'SET NAMES utf8',
]);


$errors = [];
$formSent = false;

$title = htmlspecialchars($_POST['title'] ?? '');
$content = htmlspecialchars($_POST['content'] ?? '');
$createdat = htmlspecialchars($_POST['createdat'] ?? '');
$createdby = htmlspecialchars($_POST['username'] ?? '');
$picture = htmlspecialchars($_POST['bild']?? '');

$blacklist= array("alejandro","kkk", "bruh", "cringe","holdup","arch","gentoo","gento","mint","wolhusen", "racist", "ale","rouven");

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    $title = trim($title);

    if ($title === ''){
        array_push($errors, "The title is invalid");
    }
    if ($content === ''){
        array_push($errors, "Content not valid");
    }
    if ($createdby === ''){
        array_push($errors, "Author is invalid");
    }
    foreach ($blacklist as $z){
        $b_content = stripos($content, $z);
        $b_title = stripos($title,$z);
        $b_author = stripos($createdby,$z);
        if ($b_content===0 || $b_title===0 || $b_author===0){
        array_push($errors, "Be kind please!");
        }
    }

}


//Daten in Datenbank speichern
if (count($errors)===0 && isset($_POST['submit'])){

    $dbconnection = new PDO('mysql:host=mysql2.webland.ch;dbname=d041e_gifederspiel', $user, $password);
        $stmt = $dbconnection->prepare("INSERT INTO blog (created_by, created_at, post_title, post_text, picture) VALUES (:created_by, now(), :post_title, :post_text, :picture)");
        $stmt->execute([":created_by" => "$createdby", ":post_title" => "$title", ":post_text" => "$content", ":picture" => "$picture"]);
}

    


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Write Blog</title>
</head>
<body>
    <div class="wrapper">
        <header>
            
            <h1>Write Blog</h1>
            <?php include 'standart2.php' ?>
        
        </header>
        <?php include 'standart.php' ?> <!-- nav -->
        
        <main>
            <form action="blogschreiben.php" method="post" class="formular">
                <lable for="title"></lable><br>
                <input type="text" id="title" name="title"placeholder="Title:" class="title"required>
                <lable for="username"></lable>
                <input type="text" id="username" name="username" placeholder="Created by:" class="author" required>
                <lable for="createdat"></lable>
                <input type="datetime-local" id="createdat" name="createdat" placeholder="Created at:" class="date">
                <label for="bild"></label>
                <input type="text" id="bild" name="bild" placeholder="Picture url: " class="picture"><br>
                <label for="content" class="contentinput"></label>
                <textarea id="content" name="content" placeholder="Content:" required class="content"></textarea><br>
                <button type="submit" id="submit" name="submit">Submit</button>
            </form>

            <div>
                <?php 
                echo '<dl>';
                if (count($errors)>0){
                foreach ($errors as $i){
                echo "<li class=\"error-box\">$i</li>";
                    }
                }
                echo '</dl>';
            ?>
            </div>

        </main>
        
        
    </div>
</body>
</html>