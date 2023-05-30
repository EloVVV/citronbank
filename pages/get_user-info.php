<?php
    if(!isset($_SESSION['USER'])) {
        // $_SESSION['errors'][] = "Тебе туда нельзя";
        header('Location: ./?page=404');
    }

    $userID = $_SESSION['USER'];
    $paymentInfo = $database->query("SELECT * FROM `bank_payment-account` WHERE `id_user`='$userID'")->fetchAll(PDO::FETCH_ASSOC);
    
    
?>
<section class="news_block">
    <div class="news_container">
        <div class="swiper news-swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper news-wrapper">
                <!-- Slides -->
                <?php
                    $news = $database->query("SELECT * FROM `bank_news` WHERE `status`='published'")->fetchAll(PDO::FETCH_ASSOC);
                    foreach($news as $item) {
                        echo '
                            <div class="swiper-slide news-slide">
                                <a newsID="'.$item['newsID'].'" class="news">
                                    <div class="news_text-content">
                                        <p class="news_title">
                                            '.$item['title'].'
                                        </p>
                                        <p class="news_description">
                                            '.mb_substr($item['description'], 0, 26, 'UTF-8').'...'.'
                                        </p>
                                    </div>
                                    <span class="bg"></span>
                                    <div class="news_image_box image_box">
                                        <img src="'.$item['image_path'].'" alt="" class="news_img">
                                    </div>
                                </a>
                            </div>
                        ';
                    }
                
                ?>
                
            </div>
            <!-- <div class="swiper-pagination"></div> -->
            
            <!-- <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div> -->
            
            <!-- <div class="swiper-scrollbar"></div> -->
            </div>
        <!-- <div class="news_swiper">
            <div class="swiper">
                <a href="#" class="news">
                    <div class="news_text-content">
                        <p class="news_title">
                            Lorem ipsum
                        </p>
                        <p class="news_description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vel sit ornare nisl,
                        </p>
                    </div>
                    <div class="news_image_box">
                        <img src="img/cards/Group 135-1.png" alt="" class="news_img">
                    </div>
                </a>

                <a href="#" class="news">
                    <div class="news_text-content">
                        <p class="news_title">
                            Lorem ipsum
                        </p>
                        <p class="news_description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vel sit ornare nisl,
                        </p>
                    </div>
                    <div class="news_image_box">
                        <img src="img/cards/Group 135-1.png" alt="" class="news_img">
                    </div>
                </a>

                <a href="#" class="news">
                    <div class="news_text-content">
                        <p class="news_title">
                            Lorem ipsum
                        </p>
                        <p class="news_description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vel sit ornare nisl,
                        </p>
                    </div>
                    <div class="news_image_box">
                        <img src="img/cards/Group 135-1.png" alt="" class="news_img">
                    </div>
                </a>

                <a href="#" class="news">
                    <div class="news_text-content">
                        <p class="news_title">
                            Lorem ipsum
                        </p>
                        <p class="news_description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vel sit ornare nisl,
                        </p>
                    </div>
                    <div class="news_image_box">
                        <img src="img/cards/Group 135-1.png" alt="" class="news_img">
                    </div>
                </a>

                <a href="#" class="news">
                    <div class="news_text-content">
                        <p class="news_title">
                            Lorem ipsum
                        </p>
                        <p class="news_description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vel sit ornare nisl,
                        </p>
                    </div>
                    <div class="news_image_box">
                        <img src="img/cards/Group 135-1.png" alt="" class="news_img">
                    </div>
                </a>

                <a href="#" class="news">
                    <div class="news_text-content">
                        <p class="news_title">
                            Lorem ipsum
                        </p>
                        <p class="news_description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vel sit ornare nisl,
                        </p>
                    </div>
                    <div class="news_image_box">
                        <img src="img/cards/Group 135-1.png" alt="" class="news_img">
                    </div>
                </a>

                <a href="#" class="news">
                    <div class="news_text-content">
                        <p class="news_title">
                            Lorem ipsum
                        </p>
                        <p class="news_description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vel sit ornare nisl,
                        </p>
                    </div>
                    <div class="news_image_box">
                        <img src="img/cards/Group 135-1.png" alt="" class="news_img">
                    </div>
                </a>

                <a href="#" class="news">
                    <div class="news_text-content">
                        <p class="news_title">
                            Lorem ipsum
                        </p>
                        <p class="news_description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vel sit ornare nisl,
                        </p>
                    </div>
                    <div class="news_image_box">
                        <img src="img/cards/Group 135-1.png" alt="" class="news_img">
                    </div>
                </a>
            </div>
        </div> -->
    </div>
</section>


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
                                                <div class="payment_image_box image_box">
                                                    '; icons('RUB', 16, '#000'); echo '                                    
                                                </div>
                                                ';
                                            } elseif ($currencyInfo['name_id'] === 'USD') {
                                                echo '
                                                <div class="payment_image_box image_box">
                                                    '; icons('USD', 16, '#000'); echo '
                                                </div>
                                                ';
                                            } elseif ($currencyInfo['name_id'] === 'EUR') {
                                                echo '
                                                <div class="payment_image_box image_box">

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
                                        <div class="arrow_image_box image_box">
                                            <img src="img/icons/Arrow-icon.svg" alt="" class="arrow_img">
                                        </div>
                                        <div class="header_card_images">
                                        '; 
                    
                                        echo '
                                            <div class="card_image_box image_box">
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
                                                <div class="card_image_box image_box">
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
                                    }  echo '
                                    <a href="?page=orderCard&currencyID='.$currencyID.'" class="card">
                                        <div class="create_payment_image_box image_box">
                                            <svg class="create_payment-icon" width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.38674 0.722656C8.52351 0.722656 7.82372 1.42245 7.82372 2.28568V8.53784H1.57163C0.708397 8.53784 0.00860596 9.23763 0.00860596 10.1009C0.00860596 10.9641 0.708399 11.6639 1.57163 11.6639H7.82372V17.9159C7.82372 18.7792 8.52351 19.479 9.38674 19.479C10.25 19.479 10.9498 18.7792 10.9498 17.9159V11.6639H17.2019C18.0651 11.6639 18.7649 10.9641 18.7649 10.1009C18.7649 9.23763 18.0651 8.53784 17.2019 8.53784H10.9498V2.28568C10.9498 1.42245 10.25 0.722656 9.38674 0.722656Z" fill=""/>
                                            </svg>
                                        </div>
                                        <div class="card_info_content">
                                            <p class="card_type">
                                                Заказать карту
                                            </p>
                                        </div>
                                    </a>
                                    ';
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
            <a href="<?=$hrefCreatePayment?>" class="payment_box create_payment">
                <div class="payment_header">
                    <div class="header_text-content">
                        <div class="create_payment_image_box image_box">
                            <svg class="create_payment-icon" width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.38674 0.722656C8.52351 0.722656 7.82372 1.42245 7.82372 2.28568V8.53784H1.57163C0.708397 8.53784 0.00860596 9.23763 0.00860596 10.1009C0.00860596 10.9641 0.708399 11.6639 1.57163 11.6639H7.82372V17.9159C7.82372 18.7792 8.52351 19.479 9.38674 19.479C10.25 19.479 10.9498 18.7792 10.9498 17.9159V11.6639H17.2019C18.0651 11.6639 18.7649 10.9641 18.7649 10.1009C18.7649 9.23763 18.0651 8.53784 17.2019 8.53784H10.9498V2.28568C10.9498 1.42245 10.25 0.722656 9.38674 0.722656Z" fill=""/>
                            </svg>
                        </div>
                        <div class="header_info">
                            <p class="payment_title">
                                Создайте счёт
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </article>
        <article class="last-statistic_block">
            <h2>Последние операции</h2>
            <div class="last-statistic_content">
                <?php 
                    $userCard = $database->query("SELECT * FROM `bank_card` WHERE `user_id`={$_SESSION['USER']}")->fetchAll(PDO::FETCH_ASSOC);

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
                                                $searchDublicate = [];
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
                                                        } else {
                                                            continue;
                                                        }

                                                       
                                                        $exit = false;

                                                        foreach($searchDublicate as $item) {
                                                            if($item['transactionID'] === $transaction['id_transaction']) {
                                                                if($item['from_id'] === $transaction['from_id']
                                                                && $item['to_id'] === $transaction['to_id']) {
                                                                    if($item['type'] === $operationTypeClass) $exit = true;
                                                                } else {
                                                                    $exit = false;
                                                                }
                                                            }  else {
                                                                $exit = false;
                                                            }
                                                        } 
                                                        $searchDublicate[] = [
                                                            'transactionID'=>$transaction['id_transaction'],
                                                            'from_id'=>$transaction['from_id'],
                                                            'to_id'=>$transaction['to_id'],
                                                            'type'=>$operationTypeClass,
                                                        ];
    
                                                            // echo '</br>'.'Отправитель:'.'</br>';
                                                            // echo '</br>'.$transaction['from_id'].'</br>';
                                                            // echo '</br>'.'ID карты'.'</br>';
                                                            // echo '</br>'.$card['id_card'].'</br>';
                                                            // echo '</br>'.'Получатель:'.'</br>';
                                                            // echo '</br>'.$transaction['to_id'].'</br>';
                                                            
                                                            if(!$exit) {
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
                                                            
                                                            $categoryName = $database->query("SELECT * FROM `bank_transactions-categories` WHERE `categoryID`={$typeInfo['category']}")->fetch(PDO::FETCH_ASSOC);
                                                           
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
                                                                            '.$categoryName['name'].'
                                                                        </p>
                                                                    </div>
                                    
                                                                </div>
                                                            </a>
                                                            ';
                                                            }
                                                        }
                                                      /// Вот тут была скобка  
                                                    
                                                }
                                            
                                            
                                        } else {
                                            echo '<h3>Нет операций</h3>';
                                        }
                                    echo '
            
                                </div>

                                
                            </div>
                            ';
                        }
                    } else {
                        echo '<div class="none-message">Транзакций не было...</div>';
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
            <?php
                if(!empty($transactionsDate)) {
                    echo '
                    <a href="?page=profile_card&id=2#operations" class="more-statistic_button">
                        <p>Показать ещё</p>
                        <div class="more-statistic-icon-box">
                            <svg class="arrow-icon" width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.83824 1.62443L5.32362 5.1609C5.10794 5.37791 4.75827 5.37791 4.54259 5.1609L1.02797 1.62443C0.812292 1.40741 0.812292 1.05556 1.02797 0.838543C1.24364 0.621527 1.59332 0.621527 1.809 0.838543L4.60959 3.65655L5.25662 3.65655L8.05722 0.838543C8.27289 0.621527 8.62257 0.621527 8.83824 0.838543C9.05392 1.05556 9.05392 1.40741 8.83824 1.62443Z" fill=""/>
                            </svg>
                        </div>
                    </a>
                    ';
                }
            
            ?>
        </article>
    </div>
</section>
<!-- <section class="statistic-info">
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
                        <div class="statistic_arrow_image_box image_box">
                            <img src="img/icons/Arrow-icon.svg" alt="" class="statistic_arrow-icon">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section> -->

<?php
    if($paymentInfo) {
        echo '
            <section class="actions_block">
                <div class="actions_container container">
                    <h2>Платежи и переводы</h2>
                    <div class="swiper actions_content">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper actions-wrapper">
                            <!-- Slides -->
                            <a href="?page=transaction_for_card" class="swiper-slide action-slide">
                            <div class="action_image_box image_box">
                                <svg class="action-icon" width="65" height="51" viewBox="0 0 65 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M62.6469 0.508057H3.21833C1.95405 0.508057 0.932617 1.52368 0.932617 2.78078V14.1444H64.9326V2.78078C64.9326 1.52368 63.9112 0.508057 62.6469 0.508057ZM0.932617 48.2353C0.932617 49.4924 1.95405 50.5081 3.21833 50.5081H62.6469C63.9112 50.5081 64.9326 49.4924 64.9326 48.2353V20.3944H0.932617V48.2353ZM42.2898 35.1671C42.2898 34.8546 42.5469 34.599 42.8612 34.599H54.6469C54.9612 34.599 55.2183 34.8546 55.2183 35.1671V40.2808C55.2183 40.5933 54.9612 40.849 54.6469 40.849H42.8612C42.5469 40.849 42.2898 40.5933 42.2898 40.2808V35.1671Z" fill=""/>
                                </svg>
                            </div>
                            <p class="action_name">
                                Перевод по карте
                            </p>
                            </a>
            
            
                            <a href="?page=transaction_for_payment" class="swiper-slide action-slide">
                            <div class="action_image_box image_box">
                                <svg class="action-icon" width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M32 0C14.3271 0 0 14.3269 0 32C0 49.6731 14.3271 64 32 64C49.6729 64 64 49.6731 64 32C64 14.3269 49.6729 0 32 0ZM29.4727 35.6465H33.8086C35.668 35.6465 37.2773 35.3379 38.6367 34.7207C39.9961 34.1035 41.043 33.2285 41.7773 32.0957C42.5117 30.9629 42.875 29.623 42.8672 28.0762C42.875 26.5996 42.5195 25.2793 41.8008 24.1152C41.082 22.9434 40.043 22.0215 38.6836 21.3496C37.332 20.6699 35.707 20.3301 33.8086 20.3301H24.4336V31.5801H21.0234V35.6465H24.4336V37.1934H21.0234V41.2598H24.4336V44.3301H29.4727V41.2598H34.7109V37.1934H29.4727V35.6465ZM29.4727 31.5801H33.668C34.6211 31.5801 35.4023 31.4395 36.0117 31.1582C36.6211 30.877 37.0703 30.4785 37.3594 29.9629C37.6484 29.4473 37.793 28.8379 37.793 28.1348C37.793 27.4473 37.6484 26.8262 37.3594 26.2715C37.0703 25.7168 36.6289 25.2754 36.0352 24.9473C35.4414 24.6191 34.6992 24.4551 33.8086 24.4551H29.4727V31.5801Z" fill=""/>
                                </svg>
                            </div>
                            <p class="action_name">
                                Перевод между счетами
                            </p>
                            </a>
            
                            <a href="#" class="swiper-slide action-slide">
                            <div class="action_image_box image_box">
                                <svg class="action-icon" width="122" height="112" viewBox="0 0 122 112" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M47.9596 54.5081L0.926764 27.5081L47.9596 0.508057L47.9596 13.4211H121.927V22.8315V32.1846V41.595H47.9596L47.9596 54.5081ZM74.8939 57.5081L121.927 84.5081L74.8939 111.508L74.8939 98.595L0.926758 98.595L0.926759 89.1846L0.926759 79.8315L0.92676 70.4211H74.8939V57.5081Z" fill=""/>
                                </svg>
                            </div>
                            <p class="action_name">
                                Перевод по реквизитам
                            </p>
                            </a>
            
                        </div>
                    
                        <div class="swiper-button-prev action-btn-prev"></div>
                        <div class="swiper-button-next action-btn-next"></div>
                        <span class="preview_gradient"></span>
                        </div>
                        
                </div>
            </section>
        ';
    }
?>
