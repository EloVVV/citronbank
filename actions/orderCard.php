<?php
session_start();

require('../database/database.php');
global $database;

unset($_SESSION['errors']);
$_SESSION['errors'] = [];


if(isset($_POST)) {
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $name_card = $_POST['name_card'];
    $cardPay = $_POST['cardPay'];
    $currency = $_POST['currency'];

    $start_date = time();
    $end_date = $start_date + (5 * 365 * 24 * 60 * 60);

    $cvc_code = random_int(1, 999);

    // var_dump($cvc_code);

    $number_card = '4412';

    for($i = 0; $i < 3; $i++) {
        $num_card_part = random_int(1, 9999);

        // echo '</br>'.$num_card_part.'</br>';
        // $procent = $num_card_part % 1000;
        // echo '</br>'.'Остаток от 1000:'.$procent.'</br>';
        // $procent = $num_card_part % 100;
        // echo '</br>'.'Остаток от 100:'.$procent.'</br>';
        // $procent = $num_card_part % 10;
        // echo '</br>'.'Остаток от 10:'.$procent.'</br>';
        
        if(($num_card_part % 10000) > 1000) {
            $num_card_part = strval($num_card_part);
            $num_card_part = $num_card_part;
            // echo '</br>'.'first'.'</br>';

        } elseif(($num_card_part % 1000) <= 10 AND ($num_card_part % 1000) < 100) {
            $num_card_part = strval($num_card_part);
            $num_card_part = '0'.$num_card_part;
            // echo '</br>'.'1'.'</br>';
        } elseif(($num_card_part % 1000) < 10) {
            strval($num_card_part);
            $num_card_part = '00'.$num_card_part;
            // echo '</br>'.'2'.'</br>';
        } elseif(($num_card_part % 1000) < 100) {
            strval($num_card_part);
            $num_card_part = '000'.$num_card_part;
            // echo '</br>'.'3'.'</br>';
        } elseif($num_card_part === 0) {
            strval($num_card_part);
            $num_card_part = '0000';
            // echo '</br>'.'4'.'</br>';
        } elseif(($num_card_part % 10000) < 1000) {
            $num_card_part = strval($num_card_part);
            $num_card_part = '0'.$num_card_part;
            // echo '</br>'.'5'.'</br>';
        }

        // if(($num_card_part / 1000) < 10 AND ($num_card_part / 1000) < 0.10) {
        //     $num_card_part = strval($num_card_part);
        //     $num_card_part = '0'.$num_card_part;
        //     echo '</br>'.'1'.'</br>';
        // } elseif (($num_card_part / 100) < 1 AND ($num_card_part) >= 0.10) {
        //     strval($num_card_part);
        //     $num_card_part = '00'.$num_card_part;
        //     echo '</br>'.'3'.'</br>';
        // } elseif (($num_card_part / 10))

        
        
        $number_card = $number_card.$num_card_part;

        // echo '</br>'.$num_card_part.'</br>';
        // echo '</br>'.$number_card.'</br>';
    }

    // echo '</br>'.strlen($number_card).'</br>';

   



    if(($cvc_code % 1000) >= 10 AND ($cvc_code % 1000) < 100) {
        $cvc_code = strval($cvc_code);
        $cvc_code = '0'.$cvc_code;
    }

    if(($cvc_code % 1000) < 10) {
        strval($cvc_code);
        $cvc_code = '00'.$cvc_code;
    }


    var_dump($cvc_code);

    if(empty($first_name) ||
    empty($middle_name) ||
    empty($name_card) ||
    empty($cardPay) ||
    empty($currency)) $_SESSION['errors'][] = "Вы не заполнили все строки";


    if(count($_SESSION['errors']) === 0) {

        $card = [
            'name' => $name_card,
            'cardPay' => $cardPay,
            'currency_id' => $currency,
            'userID' => $_SESSION['USER'],
            'type_card' => 'Дебетовая',
            'category' => 1,
            'status' => 'Неактивирована',
            'start_date' => date("Y-m-d H:i:s", $start_date),
            'end_date' => date("Y-m-d H:i:s", $end_date),
            'cvc_code' => $cvc_code,
            'number_card' => $number_card,
        ];

        $insertCard = $database->prepare("INSERT INTO `bank_card` 
        (`user_id`, `type_card`, `category`, `end_date`, `cvc_code`, `status`, `currency_id`, `start_date`, `name`, `type_pay`, `number_card`) 
        VALUES (:userID, :type_card, :category, :end_date, :cvc_code, :status, :currency_id, :start_date, :name, :cardPay, :number_card)");
        $insertCard->execute($card);
        $insertCard->fetch(PDO::FETCH_ASSOC);

        $cardID = $database->lastInsertID();

        // $order = [
        //     'first_name' => $first_name,
        //     'middle_name' => $middle_name,
        //     'last_name' => $last_name,
        //     'number_phone' => $number_phone,
        //     'id_card' => $cardID,
        //     'id_curier' => ,
        //     'date_order' => ,
        //     'date_delivery' => ,
        //     'address' => ,
        // ];

        // $updateUser = $database->query("UPDATE `bank_users` 
        // SET `id_pasport`='$pasportID' 
        // WHERE `id_user` = {$_SESSION['USER']}")
        // ->fetch(PDO::FETCH_ASSOC);

        header('Location: ../?page=profile');
    } else {
        if(isset($_SESSION['USER'])) {
            header('Location: ../?page=orderCard');
        } else {
            header('Location: ../?page=main_page#orderCard');
        }
    }
} 