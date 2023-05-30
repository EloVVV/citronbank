<?php
session_start();

require('../database/database.php');
global $database;

unset($_SESSION['errors']);
$_SESSION['errors'] = [];


if(isset($_POST)) {
    $serial = $_POST['serial'];
    $number = $_POST['number'];
    

    if(empty($serial) ||
    empty($number)) $_SESSION['errors'][] = "Вы не заполнили все строки";

    if(count($_SESSION['errors']) === 0) {

        $pasport = [
            'serial'=>intval($serial),
            'number'=>intval($number),
            'user_id'=>intval($_SESSION['USER'])
        ];

        $insertPasport = $database->prepare("INSERT INTO `bank_user-pasport` 
        (`serial`, `number`, `user_id`) 
        VALUES (:serial, :number, :user_id)");
        $insertPasport->execute($pasport);
        $insertPasport->fetch(PDO::FETCH_ASSOC);

        $pasportID = $database->lastInsertId();
        $updateUser = $database->query("UPDATE `bank_users` 
        SET `id_pasport`='$pasportID' 
        WHERE `id_user` = {$_SESSION['USER']}")
        ->fetch(PDO::FETCH_ASSOC);

        header('Location: ../?page=profile');
    } else {
        header('Location: ../?page=addPasportData');
    }
} 