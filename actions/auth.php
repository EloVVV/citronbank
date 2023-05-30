<?php 

session_start();

require('../database/database.php');

global $database;

unset($_SESSION['errors']);
$_SESSION['errors'] = [];

if (isset($_POST)) {
    $number_phone = $_POST['number_phone'];
    $password = $_POST['password'];

    $user = $database->query("SELECT * FROM `bank_users` WHERE `phone_number` = '$number_phone'")->fetch(PDO::FETCH_ASSOC);

    if($user == '') {
        $user = [];
    }

   
    
    if(empty($number_phone)
    || empty($password)) {
        $_SESSION['errors'][] = "Вы не заполнили все поля";
    } else {
        if(empty($user)) $_SESSION['errors'][] = "Пользователь с таким номером '{$number_phone}' не существует";
        $hash_password = md5($password);
        if ($hash_password !== $user['password']) $_SESSION['errors'][] = "Введён неверный пароль";
    }
    if(count($_SESSION['errors']) === 0) $_SESSION['USER'] = $user['id_user'];
    
}

header('Location: ../index.php');

