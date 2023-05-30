<?php 

session_start();
require('../database/database.php');
global $database;

unset($_SESSION['errors']);
$_SESSION['errors'] = [];

if(isset($_POST)) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $number_phone = $_POST['number_phone'];

    list($first_name, $middle_name, $last_name) = explode(" ", $full_name);
    
    if(empty($first_name) 
    || empty($middle_name) 
    || empty($number_phone)
    || empty($email)) $_SESSION['errors'][] = "Вы не заполнили все строки";

    if(empty($last_name)) $last_name = NULL;
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) $_SESSION['errors'][] = "Неверно введена почта";
    
    $arr = [
        'first_name'=>$first_name,
        'middle_name'=>$middle_name,
        'last_name'=>$last_name,
        'email'=>$email,
        'phone_number'=>$number_phone,
        
    ];
    
    if(count($_SESSION['errors']) === 0) {

        $insert_profile_data = $database->prepare("UPDATE `bank_users` SET 
        `first_name` = :first_name, 
        `middle_name` = :middle_name, 
        `last_name` = :last_name, 
        `email` = :email,
        `phone_number` = :phone_number
        WHERE `id_user` = {$_SESSION['USER']}");

        $insert_profile_data->execute($arr);

        $insert_profile_data->fetch(PDO::FETCH_ASSOC);

        header('Location: ../?page=profile');
        // $database->query("UPDATE `bank_users` SET 
        // `first_name` = '$first_name', 
        // `middle_name` = '$middle_name', 
        // `last_name` = '$last_name', 
        // `email` = '$email',
        // `phone_number` = '$number_phone'
        // WHERE `id_user` = {$_SESSION['USER']}")->fetch(PDO::FETCH_ASSOC);

    }
    header('Location: ../?page=profile');
}
