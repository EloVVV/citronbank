<?php

session_start();

require('../database/database.php');
global $database;

unset($_SESSION['errors']);
$_SESSION['errors'] = [];

if(isset($_POST)) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $imageName = $_FILES['image_path']['name']; 
    $imageTmpName = $_FILES['image_path']['tmp_name']; 

    var_dump($_FILES['image_path']);

    $time = time();
    $pathForLoad = '../img/news/'.$time.'-'.$imageName;
    $pathForDatabase = 'img/news/'.$time.'-'.$imageName;

    if(empty($title)
    || empty($description)
    || empty($imageName)) $_SESSION['errors'][] = "Вы не заполнили пустые строки";

    // var_dump($_FILES['image_path']);
    // $_FILES['image_path']['type'] return(image/png)

    if(count($_SESSION['errors']) === 0) {
        move_uploaded_file($imageTmpName, $pathForLoad);
        $date_create = date("Y-m-d H:i:s", time());
        $news = [
            'title'=>$title,
            'description'=>$description,
            'image_path'=>$pathForDatabase,
            'created_at'=>$date_create,
            'updated_at'=>$date_create,
        ];

        $insertNews = $database->prepare("INSERT INTO `bank_news` (`title`, `description`, `image_path`, `created_at`, `updated_at`)
        VALUES (:title, :description, :image_path, :created_at, :updated_at)");
        $insertNews->execute($news);
        $insertNews->fetch(PDO::FETCH_ASSOC);

        header('Location: ../?page=profile#news');
    } else {
        // foreach($_SESSION['errors'] as $err) {
        //     echo $err;
        // }
        header('Location: ../?page=create-news');
    }
}