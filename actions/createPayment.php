<?php
session_start();

require('../database/database.php');
global $database;

unset($_SESSION['errors']);
$_SESSION['errors'] = [];


if(isset($_POST)) {
    $currency = $_POST['currency'];
    $userID = $_SESSION['USER'];
    
    $payment = $database->query("SELECT * FROM `bank_payment-account` WHERE `id_user`='$userID' AND `currency`='$currency'")->fetch(PDO::FETCH_ASSOC);

    if($payment === '') {
        $payment = [];
    }

    if(!empty($payment)) $_SESSION['errors'][] = "Счёт в данной валюте уже открыт";

    if(empty($currency)) $_SESSION['errors'][] = "Вы не заполнили все строки";

    if(count($_SESSION['errors']) === 0) {
        $date_create = date("Y-m-d H:i:s", time());
        $payment = [
            'currency'=>intval($currency),
            'id_user'=>intval($_SESSION['USER']),
            'date_create'=>$date_create,
        ];

        $insertPayment = $database->prepare("INSERT INTO `bank_payment-account` 
        (`currency`, `id_user`, `date_create`) 
        VALUES (:currency, :id_user, :date_create)");
        $insertPayment->execute($payment);
        $insertPayment->fetch(PDO::FETCH_ASSOC);

        header('Location: ../?page=profile');
    } else {
        header('Location: ../?page=createPayment');
    }
}

