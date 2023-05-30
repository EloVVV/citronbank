<?php
session_start();

require('database/database.php');
global $database;

$query_users = $database->query("SELECT * FROM `bank_users` WHERE `role`!='admin'")->fetchAll(PDO::FETCH_ASSOC);

$capitals = $database->query("SELECT * FROM `bank_capital`")->fetchAll(PDO::FETCH_ASSOC);

echo '
    <div class="main_statistic">
        <div class="info-block">
            <h2 class="info-title">
            Кол-во пользователей:
            </h2>
            <p class="info-content">
            '.count($query_users).'
            </p>
        </div>

        ';
        foreach($capitals as $item) {
            $currencyInfo = $database->query("SELECT * FROM `bank_currency` WHERE `id_currency`={$item['currency']}")->fetch(PDO::FETCH_ASSOC);
            if($currencyInfo['name_id'] === 'USD') {
                $valute = '$';
            } elseif($currencyInfo['name_id'] === 'RUB') {
                $valute = '₽';
            } else {
                $valute = '';
            }
            echo '
            <div class="info-block">
                <h2 class="info-title">
                Основной капитал ('.$currencyInfo['name_id'].'):
                </h2>
                <p class="info-content">
                '.numberFormat($item['amount']).' '.$valute.' 
                </p>
            </div>
            ';
        }
        echo '

        <div class="info-block">
            <h2 class="info-title">
            Кол-во пользователей:
            </h2>
            <p class="info-content">
            '.count($query_users).'
            </p>
        </div>
    </div>
';