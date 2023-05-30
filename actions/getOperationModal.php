<?php
session_start();

require('../database/database.php');
require('../pages/utils/number_format.php');
require('../pages/components/icons.php');

global $database;

    if(isset($_GET['id'])) {
        $getTransactionID = $_GET['id'];
        $transactionInfo = $database->query("SELECT * FROM `bank_transactions` WHERE `id_transaction`='$getTransactionID'")->fetch(PDO::FETCH_ASSOC);
        $cardID = $_GET['idCard'];

        $cardInfo = $database->query("SELECT * FROM `bank_card` WHERE `id_card`='$cardID'")->fetch(PDO::FETCH_ASSOC);

        $currencyTransaction= $database->query("SELECT * FROM `bank_currency` WHERE `id_currency`={$cardInfo['currency_id']}")->fetch(PDO::FETCH_ASSOC);

        if($_GET['type'] === 'expense') {
            $operationTypeClass = 'expense';

              // Проверка валюты
              if($currencyTransaction['name_id'] === 'USD') {
                $money = '$';
            } elseif ($currencyTransaction['name_id'] === 'RUB') {
                $money = '₽';
            }


            $sum = '-'.numberFormat($transactionInfo['summary_from']).' '.$money;
            // $cardID = $transactionInfo['from_id'];
            
        } elseif ($_GET['type'] === 'income') {
            $operationTypeClass = 'income';

            // Проверка валюты
            if($currencyTransaction['name_id'] === 'USD') {
                $money = '$';
            } elseif ($currencyTransaction['name_id'] === 'RUB') {
                $money = '₽';
            }
            
            $sum = '+'.numberFormat($transactionInfo['summary_to']).' '.$money;
            // $cardID = $transactionInfo['to_id'];
        } else {
            echo 'Ошибка';
        }


        if(empty($transactionInfo['organizationID'])) {
            // $image = icons('transactionCard', 60, '#000');
            $typeInfo = [
                'img'=>'',
                'name'=>'Имя пользователя',
                'color'=>'F88C28',
                'category'=>'Перевод'
            ];
        } else {

            $organizationInfo = $database->query("SELECT * FROM `bank_organizations` WHERE `organizationID`={$transactionInfo['organizationID']}")->fetch(PDO::FETCH_ASSOC);
            $typeInfo = [
                'img'=>'<img src="'.$organizationInfo['image_path'].'" alt="" class="transacton_image">',
                'name'=>$organizationInfo['name'],
                'color'=>$organizationInfo['color'],
                'category'=>$organizationInfo['categoryID'],
            ];
        }
    }
    echo '
    <div style="background-color:#'.$typeInfo['color'].'" class="popup_header">
        <p class="header_title">
            Платёж от:
        </p>
        <p class="header_date">
            '.date('d.m.Y h:m:s', strtotime($transactionInfo['created_at'])).'
        </p>
    </div>
    <div class="popup_content">
        <div class="popup_main_info">
            <div class="transaction_block">
                <div class="transaction_image-box">
                    '; 

                    if(!empty($transactionInfo['organizationID'])) {
                        echo $typeInfo['img'];
                    } else {
                        icons('transactionCard', 60, 'var(--other-text-color)');
                    }

                    echo '
                </div>
                <p class="transaction_company_name">
                    '.$typeInfo['name'].'
                </p>
                <p class="transaction_category">
                    '.$typeInfo['category'].'
                </p>
            </div>
            <div class="transaction_price">
                '.$sum.'
            </div>
        </div>
        <div class="popup_card_info">
            <p class="popup_card-title">
                Покупка с карты:
            </p>
            <div class="popup_card_content">
                <div class="card_info_box">
                    <div class="card_info_image-box">
                        <img src="'.$cardInfo['image_path'].'" alt="" class="card_info_image">
                    </div>
                    <div class="card_info_box_text-content">
                        <p class="card_info_category">
                            Дебетовая карта
                        </p>
                        <p class="card_info_name">
                            Citron Карта
                        </p>
                    </div>
                </div>
                <div class="transaction_info_box">
                    <p class="transaction_date">
                        '.date('d.m.Y', strtotime($transactionInfo['created_at'])).'
                    </p>
                    <p class="transaction_value">
                        '.numberFormat($cardInfo['balance']).' '.$money.'
                    </p>
                </div>
            </div>
        </div>
    </div>
    ';