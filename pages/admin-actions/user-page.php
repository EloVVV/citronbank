<?php
    if(!isset($_SESSION['USER'])) {
        // $_SESSION['errors'][] = "Тебе туда нельзя";
        header('Location: ./?page=404');
    }

   
    if(isset($_GET['id'])) {
        $userID = $_GET['id'];
        // echo $userID;
        // $userID = $_SESSION['USER'];
        $paymentInfo = $database->query("SELECT * FROM `bank_payment-account` WHERE `id_user`='$userID'")->fetchAll(PDO::FETCH_ASSOC);
        // var_dump( $paymentInfo);
    }
    
?>

<section class="payment-info">
    <div class="payment-info_container container">
        <article class="payment_block">
            <h2>Счета</h2>
            <?php

                if($paymentInfo) {
                    foreach($paymentInfo as $payment) {
                        $currencyID = $payment['currency'];
                        $cardInfo = $database->query("SELECT * FROM `bank_card` WHERE `user_id` = '$userID' AND `currency_id`='$currencyID' ")->fetchAll(PDO::FETCH_ASSOC);
                        // printData($cardInfo);

                        // $paymentAmount = [];
                        $amount = 0;

                        $currencyInfo = $database->query("SELECT * FROM `bank_currency` WHERE `id_currency`='$currencyID'")->fetch(PDO::FETCH_ASSOC);
                        
                        $userCards = $database->query("SELECT * FROM `bank_card` WHERE `user_id`='$userID' AND `currency_id`={$payment['currency']}")->fetchAll(PDO::FETCH_ASSOC);
                        
                        foreach($userCards as $card) {
                            $amount += $card['balance'];
                        }

                        // array_push($paymentAmount, $amount);
                    
                        

                        // Блок открытого счёта

                            echo '
                            <div class="payment_box">
                                <div class="payment_header">
                                    <a href="?page=payment" class="header_text-content">
                                    
                                        ';
                                            if($currencyInfo['name_id'] === 'RUB') {
                                                echo '
                                                <div class="payment_image_box">
                                                    '; icons('RUB', 16, '#000'); echo '                                    
                                                </div>
                                                ';
                                            } elseif ($currencyInfo['name_id'] === 'USD') {
                                                echo '
                                                <div class="payment_image_box">
                                                    '; icons('USD', 16, '#000'); echo '
                                                </div>
                                                ';
                                            } elseif ($currencyInfo['name_id'] === 'EUR') {
                                                echo '
                                                <div class="payment_image_box">

                                                </div>
                                                ';
                                            }
                                        echo '
                                        <div class="header_info">
                                            ';
                                        
                                        if($currencyID === 1) {
                                            echo '
                                            <p class="payment_amount">
                                            '.numberFormat($amount).' ₽
                                            </p>
                                            ';
                                        } elseif ($currencyID === 2) {
                                            echo '
                                            <p class="payment_amount">
                                            $ '.numberFormat($amount).'
                                            </p>
                                            ';
                                        } elseif ($currencyID === 3) {
                                            echo '
                                            <p class="payment_amount">
                                            € '.numberFormat($amount).'
                                            </p>
                                            ';
                                        }

                                            echo '
                                            <div class="payment_name">
                                                Citron Premium
                                            </div>
                                        </div>
                                    </a>
                                    <div class="header_image-content">
                                        <div class="arrow_image_box">
                                            <img src="img/icons/Arrow-icon.svg" alt="" class="arrow_img">
                                        </div>
                                        <div class="header_card_images">
                                        '; 
                    
                                        echo '
                                            <div class="card_image_box">
                                                ';
                                                    if(!empty($cardInfo)) {
                                                        echo '<img src="'.$cardInfo[0]['image_path'].'" alt="" class="card_image">';
                                                    } else {
                                                        echo '<img src="img/cards/On-Front/default-img-card.png" alt="" class="card_image">';
                                                    }
                                                echo'
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="payment_cards">
                                    ';
                                   
                                    if(!empty($cardInfo)) {
                                       foreach($cardInfo as $item) {
                                            echo '
                                            <a href="?page=profile_card&id='.$item['id_card'].'" class="card">
                                                <div class="card_image_box">
                                                    <img src="'.$item['image_path'].'" alt="'.$item['name'].'" class="card_image">
                                                </div>
                                                <div class="card_info_content">
                                                    <p class="card_type">
                                                        '.$item['type_card'].' карта
                                                    </p>';
                                                    if($currencyID === 1) {
                                                        echo '
                                                        <p class="card_amount">
                                                        '.numberFormat($item['balance']).' ₽
                                                        </p>
                                                        ';
                                                    } elseif ($currencyID === 2) {
                                                        echo '
                                                        <p class="card_amount">
                                                        $ '.numberFormat($item['balance']).'
                                                        </p>
                                                        ';
                                                    } elseif ($currencyID === 3) {
                                                        echo '
                                                        <p class="card_amount">
                                                        € '.numberFormat($item['balance']).'
                                                        </p>
                                                        ';
                                                    }
                                                    echo '
                                                   
                                                </div>
                                            </a>
                                            ';
                                       }
                                    } 
                                    echo '
                
                                </div>
                            </div>
                        ';
                        
                        // Блок открытого счёта
                        
                    }
                }
            ?>
            <?php
                if($user['id_pasport'] !== NULL) {
                    $hrefCreatePayment = "?page=createPayment";
                } else {
                    $hrefCreatePayment = "?page=addPasportData";
                }
            ?>
        </article>
        <article class="last-statistic_block">
            <h2>Последние операции</h2>
            <div class="last-statistic_content">
                <?php 
                    $userCard = $database->query("SELECT * FROM `bank_card` WHERE `user_id`='$userID'")->fetchAll(PDO::FETCH_ASSOC);

                    // Перебор всех транзакий пользователя
                    $transactionsArray = [];
                    $userCards = [];
                    foreach($userCard as $card) {
                        $transactionsDate = $database->query("SELECT * FROM `bank_transactions` WHERE `from_id`={$card['id_card']} OR `to_id`={$card['id_card']} ORDER BY `created_at` DESC")->fetchAll(PDO::FETCH_ASSOC);
                        foreach($transactionsDate as $data) {
                            array_push($transactionsArray, $data);
                        }
                        array_push($userCards, $card);
                    }

                    // Проверка на количество транзакций
                    if(count($transactionsArray) !== 5 && count($transactionsArray) < 5) {
                        $countFunc = count($transactionsArray);
                    } else {
                        $countFunc = 5;
                    }

                    // Вывод последних транзакций
                    $limitedTransactions = [];
                    for($i = 0; $i < $countFunc; $i++) {
                        array_push($limitedTransactions, $transactionsArray[$i]);
                    }

                    // printData($transactionsArray);


                    $transactionsDate = $limitedTransactions;
                        
                    if($transactionsDate === '') {
                        $transactionsDate = [];
                    }

                    if(!empty($transactionsDate)) {

                        $dates['key'] = [];

                        $today = time();

                        $otherDay = time() - (3 * 24 * 60 * 60);
                        $dates['key'][] = date('Y-m-d', strtotime($transactionsDate[0]['created_at']));
    

                        foreach($transactionsDate as $date) {
                            $dateItem = date('Y-m-d', strtotime($date['created_at'])); 

                            $k = count($dates['key']) - 1;
                            if ($dates['key'][$k] !== $dateItem) $dates['key'][] = $dateItem;
                        }

                        $transactionsSorted = [];
                        
                        foreach($dates['key'] as $dateFiltered) {
                            $daysArray = [];
                            foreach($transactionsDate as $date) {
                                $dateItem = date('Y-m-d', strtotime($date['created_at'])); 

                                if($dateItem === $dateFiltered) $daysArray[] = $date;
                            }
                            $transactionsSorted[] = $daysArray;
                        }

                        // printData($transactionsSorted);

                        // printData($userCards);
                        foreach($transactionsSorted as $dayData) {
                            echo '
                            <div class="last-statistic_box">
                    
                                <div class="statistic_header">
                                    <p>';
                                    // printData($dayData);
                                    if(date('Y-m-d', strtotime($dayData[0]['created_at'])) === date('Y-m-d', time())) {
                                        echo 'Сегодня';
                                    } elseif(date('Y-m-d', strtotime($dayData[0]['created_at'])) === date('Y-m-d', time() - (24 * 60 * 60))) {
                                        echo 'Вчера';
                                    } else {
                                        echo date('d M', strtotime($dayData[0]['created_at']));
                                    }
                                    echo '</p>
                                </div>
                                <div class="statistic_info_box">
                                    ';
                                        if($paymentInfo) {
                                            // printData($dayData);

                                            // Income - Доход
                                            // Expense - Расход
                                            // Сбор недавних транзакций
                                                foreach($dayData as $transaction) {
                                                    // Переборка карт пользователя для вывода данных
                                                    foreach($userCards as $card) {
                                                        // Если карта совпадает с транзакцией, то производится вывод информации
                                                        if($card['id_card'] === $transaction['from_id'] 
                                                        || $card['id_card'] === $transaction['to_id']) {
                                                            if($transaction['from_id'] === $card['id_card']) {
                                                                $operationTypeClass = 'expense';
                                                                $operationSymbol = '-';
                                                            } elseif ($transaction['to_id'] === $card['id_card']) {
                                                                $operationTypeClass = 'income';
                                                                $operationSymbol = '+';
                                                            } else {
                                                                $operationTypeClass = '';
                                                                $operationSymbol = '';
                                                            }
    
                                                            // echo '</br>'.'Отправитель:'.'</br>';
                                                            // echo '</br>'.$transaction['from_id'].'</br>';
                                                            // echo '</br>'.'ID карты'.'</br>';
                                                            // echo '</br>'.$card['id_card'].'</br>';
                                                            // echo '</br>'.'Получатель:'.'</br>';
                                                            // echo '</br>'.$transaction['to_id'].'</br>';
                                                            
                                                            if(empty($transaction['organizationID'])) {
                                                                $typeInfo = [
                                                                    'img'=>'img/icons/transactions/Transaction-Cards-icon.svg',
                                                                    'name'=>'Имя пользователя',
                                                                    'color'=>'F88C28',
                                                                    'category'=>'Перевод'
                                                                ];
                                                            } else {
            
                                                                $organizationInfo = $database->query("SELECT * FROM `bank_organizations` WHERE `organizationID`={$transaction['organizationID']}")->fetch(PDO::FETCH_ASSOC);
                                                                $typeInfo = [
                                                                    'img'=>$organizationInfo['image_path'],
                                                                    'name'=>$organizationInfo['name'],
                                                                    'color'=>$organizationInfo['color'],
                                                                    'category'=>$organizationInfo['categoryID'],
                                                                ];
                                                            }
                                                            
                                                           
                                                            // href="?page=profile&id='.$userID.'&transaction='.$transaction['id_transaction'].'"
                                                            echo '
                                                            <a cardID='.$card['id_card'].' type='.$operationTypeClass.' transactionID="'.$transaction['id_transaction'].'"  class="statistic '.$operationTypeClass.'">
                                                                <div style="background-color:#'.$typeInfo['color'].'" class="statistic_image_box image_box">
                                                                    <img src="'.$typeInfo['img'].'" alt="'.$typeInfo['name'].'"  class="statistic_image">
                                                                </div>
                                                                <div class="statistic_text-content">
                                                                    <div class="statistic_upper-text-content">
                                                                        <p class="statistic-info_type">
                                                                            Дебетовая карта
                                                                        </p>
                                                                        <div class="statistic-info_price">
                                                                            '; 
                                                                                
                                                                                if($transaction['from_id'] === $card['id_card']) {

                                                                                    // Проверка валюты
                                                                                    $currencyTransaction= $database->query("SELECT * FROM `bank_currency` WHERE `id_currency`={$card['currency_id']}")->fetch(PDO::FETCH_ASSOC);
                                                                                    if($currencyTransaction['name_id'] === 'USD') {
                                                                                        $money = '$';
                                                                                    } elseif ($currencyTransaction['name_id'] === 'RUB') {
                                                                                        $money = '₽';
                                                                                    }
                                                                                    echo $operationSymbol.numberFormat($transaction['summary_from']).' '.$money;
                                                                                } elseif ($transaction['to_id'] === $card['id_card']) {
                                                                                    $currencyTransaction= $database->query("SELECT * FROM `bank_currency` WHERE `id_currency`={$card['currency_id']}")->fetch(PDO::FETCH_ASSOC);
                                                                                    if($currencyTransaction['name_id'] === 'USD') {
                                                                                        $money = '$';
                                                                                    } elseif ($currencyTransaction['name_id'] === 'RUB') {
                                                                                        $money = '₽';
                                                                                    }
                                                                                    echo $operationSymbol.numberFormat($transaction['summary_to']).' '.$money;
                                                                                } else {
                                                                                    echo 'Ошибка';
                                                                                }
                                                                                
                                                                            echo ' 
                                                                        </div>
                                                                    </div>
                                                                    <div class="statistic_bottom-text-content">
                                                                        <p class="statistic-info_name">
                                                                            '.$typeInfo['name'].'
                                                                        </p>
                                                                        <p class="statistic-info_category">
                                                                            '.$typeInfo['category'].'
                                                                        </p>
                                                                    </div>
                                    
                                                                </div>
                                                            </a>
                                                            ';
                                                        }
                                                        
                                                    }
                                                }
                                            
                                            
                                        } else {
                                            echo '<h3>Нет операций</h3>';
                                        }
                                    echo '
            
                                </div>

                                
                            </div>
                            ';
                        }
                    } 

                    foreach($userCard as $card) {
                        // $transactionsDate = $database->query("SELECT * FROM `bank_transactions` WHERE `from_id`={$card['id_card']} OR `to_id`={$card['id_card']} ORDER BY `created_at` DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
                        
                        // return;
                        // continue;
                        
                    } 

                    function printData($data)
                    {
                        print_r('<pre><p style="background-color: beige; color: maroon; padding: 10px; margin: 5px; border: 1px maroon solid;">');
                        print_r($data);
                        print_r('</p></pre>');
                    }

                    // foreach($transactionsDate as $transactionsSorted) {
                    //     $today = date('d.m.Y', time());

                        


                    // }
                ?>
                
            </div>
            <a href="?page=profile_card&id=2#operations" class="more-statistic_button">
                <p>Показать ещё</p>
                <div class="more-statistic-icon-box">
                    <svg class="arrow-icon" width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.83824 1.62443L5.32362 5.1609C5.10794 5.37791 4.75827 5.37791 4.54259 5.1609L1.02797 1.62443C0.812292 1.40741 0.812292 1.05556 1.02797 0.838543C1.24364 0.621527 1.59332 0.621527 1.809 0.838543L4.60959 3.65655L5.25662 3.65655L8.05722 0.838543C8.27289 0.621527 8.62257 0.621527 8.83824 0.838543C9.05392 1.05556 9.05392 1.40741 8.83824 1.62443Z" fill=""/>
                    </svg>
                </div>
            </a>
        </article>
    </div>
</section>
<section class="statistic-info">
    <div class="statistic-info_container container">
        <h2>Статистика за октябрь</h2>
        <div class="statistic-info_box">
            <div class="statistic_image_visualisation">

            </div>
            <div class="statistic_text-content">
                <div class="statistic_text-content_header">
                    <a href="#" class="statistic_type">Расходы</a>
                    <a href="#" class="statistic_type">Поступления</a>
                </div>
                <div class="statistic_content">
                    <div class="statistic_label">
                        <div class="statistic_name_box">
                            <span class="statistic_color"></span>
                            <p class="statistic_name">
                                Такси
                            </p>
                        </div>
                        <p class="statistic_amount">
                            2 953 ₽
                        </p>
                    </div>

                    <div class="statistic_label">
                        <div class="statistic_name_box">
                            <span class="statistic_color"></span>
                            <p class="statistic_name">
                                Такси
                            </p>
                        </div>
                        <p class="statistic_amount">
                            2 953 ₽
                        </p>
                    </div>

                    <div class="statistic_label">
                        <div class="statistic_name_box">
                            <span class="statistic_color"></span>
                            <p class="statistic_name">
                                Такси
                            </p>
                        </div>
                        <p class="statistic_amount">
                            2 953 ₽
                        </p>
                    </div>

                    <div class="statistic_label">
                        <div class="statistic_name_box">
                            <span class="statistic_color"></span>
                            <p class="statistic_name">
                                Питание
                            </p>
                        </div>
                        <p class="statistic_amount">
                            2 953 ₽
                        </p>
                    </div>

                    <div class="statistic_label">
                        <div class="statistic_name_box">
                            <span class="statistic_color"></span>
                            <p class="statistic_name">
                                Красота
                            </p>
                        </div>
                        <p class="statistic_amount">
                            29 423 ₽
                        </p>
                    </div>

                    <div class="statistic_label">
                        <div class="statistic_name_box">
                            <span class="statistic_color"></span>
                            <p class="statistic_name">
                                Другое
                            </p>
                        </div>
                        <p class="statistic_amount">
                            100 003 ₽
                        </p>
                    </div>
                </div>
                <div class="statistic_button_box">
                    <a href="#" class="statistic_button">
                        <p>Вся статистика</p>
                        <div class="statistic_arrow_image_box">
                            <img src="img/icons/Arrow-icon.svg" alt="" class="statistic_arrow-icon">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

