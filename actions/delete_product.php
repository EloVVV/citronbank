<?php

session_start();
require('database/database.php');
global $database;


if(isset($_GET['id'])) {
    $id_product = $_GET['id'];

    $database->query("DELETE FROM `bank_card_image-path` WHERE `id_card` = '$id_product'")->fetch(PDO::FETCH_ASSOC);

    $product = [
        'id_product'=>$id_product,
    ];

    $delete = $database->prepare("DELETE FROM `bank_card-product` WHERE `id_product` = :id_product");
    $delete->execute($product);

    header('Location: ../?page=debit_cards');
}
// header('Location: ../?page=debit_cards');


