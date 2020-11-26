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
$createdat = $_POST['createdat'] ?? '';
$createdby =$_POST['username'] ?? '';
$picture =$_POST['bild']?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    $title = trim($title);
    $content =trim($content);

    if ($title === ''){
        array_push($errors, "The title is invalid");
    }
    if ($content === ''){
        array_push($errors, "Content not valid");
    }
    if ($createdat === ''){
        array_push($errors, "Date is invalid");
    }
    if ($createdby === ''){
        array_push($errors, "Author is invalid");
    }

}

//Daten in Datenbank speichern
if ($title !== ''){


    $dbconnection = new PDO('mysql:hostJ=localhost;dbname=blog', $user, $password);
    $stmt = $dbconnection->prepare("INSERT INTO blog (created_by, created_at, post_title, post_text, picture) VALUES (:created_by, now(), :post_title, :post_text, :picture)");
    $stmt->execute(["created_by" => "$createdby", ":post_title" => "$title", ":post_text" => "$content", ":picture" => "$picture"]);
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
                <input type="text" id="title" name="title"placeholder="Title:" class="title"require>
                <lable for="username"></lable>
                <input type="text" id="username" name="username" placeholder="Created by:" class="author" require>
                <lable for="createdat"></lable>
                <input type="datetime-local" id="createdat" name="createdat" placeholder="Created at:" class="date" require>
                <label for="bild"></label>
                <input type="text" id="bild" name="bild" placeholder="Picture url: " class="picture"><br>
                <label for="content" class="contentinput"></label>
                <textarea id="content" name="content" placeholder="Content:" require class="content"></textarea><br>
                <button type="submit" value="submit">Submit</button>
            </form>
        </main>
        
        <div>
            <?php 
            echo '<dl>';
            if (count($errors)>0){
            for($i=0;$i<count($errors);$i++){
            echo "<li class='error-box'>$errors[$i]</li>";
                }
            }
            echo '</dl>';
            ?>
        </div>
    </div>
</body>
</html>