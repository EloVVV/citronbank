<?php
session_start();

require('../database/database.php');
global $database;

unset($_SESSION['errors']);
$_SESSION['errors'] = [];

if(isset($_POST)) {
    $search = trim($_POST['search']);

    if(strlen($search) <= 3) $_SESSION['errors'][] = "Запрос слишком маленький";
    if(strlen($search) > 20) $_SESSION['errors'][] = "Запрос слишком длинный";

    if(count($_SESSION['errors']) === 0) {
        
    }
}