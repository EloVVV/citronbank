<?php
session_start();

require('../database/database.php');
global $database;

unset($_SESSION['errors']);
$_SESSION['errors'] = [];


if(isset($_GET['edit_id'])) {
    $id_category = $_GET['edit_id'];
    // $product_info = $database->query("SELECT * FROM `bank_card-product` WHERE `id_product` = '$id_product'")->fetch(PDO::FETCH_ASSOC);
    if(isset($_POST)) {
        $name = $_POST['name'];
    
        if(empty($name)) $_SESSION['errors'][] = "Вы не заполнили все строки";
    
        if(count($_SESSION['errors']) === 0) {

            $arr = [
                'name'=>$name,
            ];
    
            $edit_category = $database->prepare("UPDATE `bank_card-category` 
            SET `name`=:name WHERE `id_card-category` = '$id_category'");
            $edit_category->execute($arr);
            $edit_category->fetch(PDO::FETCH_ASSOC);
            
            header('Location: ../../?page=debit_cards');
        } else {
            header('Location: ../../?page=edit_card&edit_id='.$id_category.'');
        }
       
    }
    
}
