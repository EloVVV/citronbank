<?php
$capitalInfo = $database->query("SELECT * FROM `bank_capital`")->fetchAll(PDO::FETCH_ASSOC);
// $endCapitalSum = 
foreach($capitalInfo as $capital) {
    $cardBalance = $database->query("SELECT * FROM `bank_card` WHERE `currency_id`={$capital['currency']}")->fetchAll(PDO::FETCH_ASSOC);
    $sumCapital = 0;
    foreach($cardBalance as $item) {
        $sumCapital += $item['balance'];
    } 

    $nowBalanceCapital = $capital['amount'];
    

    if($nowBalanceCapital !== $sumCapital) {
        $database->query("UPDATE `bank_capital` SET `amount`='$sumCapital' WHERE `currency`={$capital['currency']}")->fetch(PDO::FETCH_ASSOC);   
    }
}