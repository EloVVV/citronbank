<?php 

session_start();

require('../database/database.php');
global $database;

unset($_SESSION['errors']);
$_SESSION['errors'] = [];

if (isset($_POST)) {
    $email = trim($_POST['email']);
    $arr_log = [
        'email' => $email,
    ];

    $search_email = $database->query("SELECT * FROM `bank_feedback` WHERE `email` = '$email'")->fetch(PDO::FETCH_ASSOC);

    if($search_email == '' ) {
        $search_email = [];
    }
    if(!empty($search_email)) $_SESSION['errors'][] = "Данная почта уже подписана на рассылку";

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) $_SESSION['errors'][] = "Неправильный формат почты";

    $error = $_SESSION['errors'];
    if(count($_SESSION['errors']) === 0){
        $insert_feedback = $database->prepare("INSERT INTO `bank_feedback` (`email`) VALUES (:email)");
        $insert_feedback->execute($arr_log);
        $insert_feedback->fetch(PDO::FETCH_ASSOC);

        echo json_encode([
            'type' => 'success',
            'body' => 'Вы подписались на рассылку!'
        ]);
    }else{
        echo json_encode([
            'type' => 'error',
            'body' => $error
        ]);
    }
}