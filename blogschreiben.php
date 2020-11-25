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
    <title>Document</title>
</head>
<body class="wrapper">
    <div>
        <h1 class="title">BLOG erfassen</h1>
    </div>
    <?php include 'standart.php' ?>

    <form action="blogschreiben.php" method="post" class="formular">
        <lable for="title"></lable><br>
        <input type="text" id="title" name="title"placeholder="Title:" require>
        <lable for="username"></lable>
        <input type="text" id="username" name="username" placeholder="Created by:" require>
        <lable for="createdat"></lable>
        <input type="datetime-local" id="createdat" name="createdat" placeholder="Created at:" require>
        <label for="bild"></label>
        <input type="text" id="bild" name="bild" placeholder="Picture url: "><br>
        <label for="content" class="contentinput"></label>
        <textarea id="content" name="content" rows="30" cols="163"placeholder="Content:" require></textarea><br>
        <button type="submit" value="submit">Submit</button>
    </form>
    
    <div>
        <?php 
        /*var_dump($pdo);
        $stmt = $pdo->query('SELECT * FROM `blog`');
        foreach($stmt->fetchAll()as $input){
            var_dump($input);
        }*/   
        /*foreach($stmt->fetchAll()as $task){
            echo '<p>' .$task . '</p>';
        }*/
        echo '<dl>';
        if (count($errors)>0){
            for($i=0;$i<count($errors);$i++){
            echo "<li class='error-box'>$errors[$i]</li>";
            }
        }
        echo '</dl>';
        ?>
    </div>
</body>
</html>