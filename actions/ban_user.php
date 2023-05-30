<?php

if(isset($_GET['ban'])) {
    $id_user = $_GET['ban'];

    $database->query("UPDATE `bank_users` SET `status`='banned' WHERE id_user = '$id_user'")->fetch(PDO::FETCH_ASSOC);
    header('Location: ../?page=profile');
}