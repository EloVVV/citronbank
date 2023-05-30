<?php
session_start();

require('../database/database.php');
global $database;

unset($_SESSION['errors']);
$_SESSION['errors'] = [];


if(isset($_POST)) {
    $name = $_POST['name'];

    if(empty($name)) $_SESSION['errors'][] = "Вы не заполнили все строки";

    if(count($_SESSION['errors']) === 0) {
        $category_arr = [
            'name'=>$name,
        ];

        $insert_category = $database->prepare("INSERT INTO `bank_card-category` 
        (`name`) VALUES (:name)");

        $insert_category->execute($category_arr);
        $insert_category->fetch(PDO::FETCH_ASSOC);

        header('Location: ../?page=debit_cards');
    }
}

header('Location: ../?page=create_category');