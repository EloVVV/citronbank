<div class="popup popup_operation">
    <div class="popup_body">
        <div class="popup_container">
            <div class="popup_header">
                <p class="header_title">
                    Платёж от:
                </p>
                <p class="header_date">
                    12.10.2022 12:13:00
                </p>
            </div>
            <div class="popup_content">
                <div class="popup_main_info">
                    <div class="transaction_block">
                        <div class="transaction_image-box">
                            <img src="img/profile/Glass_Logo_Render-5.png" alt="" class="transacton_image">
                        </div>
                        <p class="transaction_company_name">
                            Пятёрочка
                        </p>
                        <p class="transaction_category">
                            Супермаркеты
                        </p>
                    </div>
                    <div class="transaction_price">
                        379 ₽
                    </div>
                </div>
                <div class="popup_card_info">
                    <p class="popup_card-title">
                        Покупка с карты:
                    </p>
                    <div class="popup_card_content">
                        <div class="card_info_box">
                            <div class="card_info_image-box">
                                <img src="img/cards/On-Front/Glass-Card_Front-view-19.png" alt="" class="card_info_image">
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
                                12.20.2022
                            </p>
                            <p class="transaction_value">
                                349 ₽
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="popup_area"></div>
    </div>
</div>
<?php
    if(!isset($_SESSION['USER'])) {
        // $_SESSION['errors'][] = "Тебе туда нельзя";
        header('Location: ./?page=404');
    }

    if(isset($_GET['id'])) {
        $cardID = $_GET['id'];

        if($cardID === 0 || empty($cardID)) {
            header('Location: ./?page=404');
        } else {
            $card = $database->query("SELECT * FROM `bank_card` WHERE `id_card`='$cardID'")->fetch(PDO::FETCH_ASSOC);
            $currencyID = $card['currency_id'];

            $userID = $_SESSION['USER'];

            $paymentInfo = $database->query("SELECT * FROM `bank_payment-account` WHERE `id_user`='$userID'")->fetchAll(PDO::FETCH_ASSOC);

        }
    }
?>
        <section class="card_info_block">
            <div class="payment_info_block_container container">
                <!-- <div class="payment_info_header_menu">
                    <a href="?page=payment_main" class="payment_info_link">Обзор</a>
                    <a href="?page=payment_setting" class="payment_info_link">Настройки</a>
                    <a href="?page=payment_info" class="payment_info_link">О счёте</a>
                </div> -->
                <div class="payment_info_content">
                    <div class="payment_text-content">
                        <div class="card_image_box image_box">
                            <img src="<?=$card['image_path']?>" alt="" class="card_img">
                        </div>
                        <div class="card_actions_block">
                            <div class="card_text_info_block">
                                <div class="payment_text-label">
                                    <p class="payment_text-label_title">
                                        Баланс дебетового счёта
                                    </p>
                                    <p class="payment_text-label_value">
                                        <?php
                                           if($currencyID === 1) {
                                                echo '
                                                <p class="card_amount">
                                                '.numberFormat($card['balance']).' ₽
                                                </p>
                                                ';
                                            } elseif ($currencyID === 2) {
                                                echo '
                                                <p class="card_amount">
                                                $ '.numberFormat($card['balance']).'
                                                </p>
                                                ';
                                            } elseif ($currencyID === 3) {
                                                echo '
                                                <p class="card_amount">
                                                € '.numberFormat($card['balance']).'
                                                </p>
                                                ';
                                            }
                                        ?>
                                    </p>
                                </div>
                                <div class="payment_text-label">
                                    <p class="payment_text-label_title">
                                        Кэшбэк
                                    </p>
                                    <p class="payment_text-label_value">
                                        152 ₽
                                    </p>
                                </div>
                                <div class="payment_text-label">
                                    <p class="payment_text-label_title">
                                        Ставка
                                    </p>
                                    <p class="payment_text-label_value">
                                        6%
                                    </p>
                                </div>
                            </div>
                            <div class="card_buttons_block">
                                <div class="card_buttons_content">
                                    <a href="#" class="card_button">
                                        <p>Установить пин-код</p>
                                        <div class="card_button_image_box image_box">
                                            <img src="img/icons/pin-code-icon.svg" alt="" class="card_button_img">
                                        </div>
                                    </a>
                                    <a href="#" class="card_button">
                                        <p>Привязать к другому счёту</p>
                                        <div class="card_button_image_box image_box">
                                            <img src="img/icons/Other-payment-icon.svg" alt="" class="card_button_img">
                                        </div>
                                    </a>
                                </div>
                                <a href="#" class="visible-more_button">
                                    Показать ещё
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="operations" class="events_payment">
         
            <div class="events_payment_container container">
                <h2>События</h1>
                <div class="events_payment_search">
                    <div class="events_payment_calendar">
                        <div class="swiper events_payment_calendar-swiper">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                              <!-- Slides -->
                              <div class="swiper-slide">
                                <div class="events_payment_calendar_icon_box">
                                    <svg class="calendar-icon" width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 9H4V11H6V9ZM10 9H8V11H10V9ZM14 9H12V11H14V9ZM16 2H15V0H13V2H5V0H3V2H2C0.89 2 0.00999999 2.9 0.00999999 4L0 18C0 18.5304 0.210714 19.0391 0.585786 19.4142C0.960859 19.7893 1.46957 20 2 20H16C17.1 20 18 19.1 18 18V4C18 2.9 17.1 2 16 2ZM16 18H2V7H16V18Z" fill="black"/>
                                    </svg>
                                </div>
                                <p>Январь</p>
                              </div>
                              <div class="swiper-slide">
                                <div class="events_payment_calendar_icon_box">
                                    <svg class="calendar-icon" width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 9H4V11H6V9ZM10 9H8V11H10V9ZM14 9H12V11H14V9ZM16 2H15V0H13V2H5V0H3V2H2C0.89 2 0.00999999 2.9 0.00999999 4L0 18C0 18.5304 0.210714 19.0391 0.585786 19.4142C0.960859 19.7893 1.46957 20 2 20H16C17.1 20 18 19.1 18 18V4C18 2.9 17.1 2 16 2ZM16 18H2V7H16V18Z" fill="black"/>
                                    </svg>
                                </div>
                                <p>Февраль</p>
                              </div>
                              <div class="swiper-slide">
                                <div class="events_payment_calendar_icon_box">
                                    <svg class="calendar-icon" width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 9H4V11H6V9ZM10 9H8V11H10V9ZM14 9H12V11H14V9ZM16 2H15V0H13V2H5V0H3V2H2C0.89 2 0.00999999 2.9 0.00999999 4L0 18C0 18.5304 0.210714 19.0391 0.585786 19.4142C0.960859 19.7893 1.46957 20 2 20H16C17.1 20 18 19.1 18 18V4C18 2.9 17.1 2 16 2ZM16 18H2V7H16V18Z" fill="black"/>
                                    </svg>
                                </div>
                                <p>Март</p>
                              </div>
                            </div>

                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>

                        </div>
                       
                    </div>
                    <form method="POST" class="events_payment_input_block">
                        <button type="submit" class="events_payment_input_icon_box image_box">
                            <?php icons('search', 30, '#000');?>
                            <!-- <img src="img/icons/search-icon.svg" alt="" class="search-icon"> -->
                        </button>
                        <input name="search" type="text" class="events_payment_input" placeholder="Найди любые события или операции">
                    </form>
                </div>
                <div class="events_payment_content">
                    <div class="events_payment_header">
                        <div class="events_payment_filter">
                            <a href="?page=profile_card&id=<?=$cardID?>&filterOperations=income" class="events_filter_link">Доходы</a>
                            <a href="?page=profile_card&id=<?=$cardID?>&filterOperations=expense" class="events_filter_link">Расходы</a>
                            <?php
                                if(isset($_GET['filterOperations'])) {
                                    echo '   <a href="?page=profile_card&id='.$cardID.'" class="events_filter_link clear_filteres">Сбросить фильтры</a>';
                                }
                            ?>
                        </div>
                        <div class="sum_payment">
                            <p>Статистика за этот месяц:</p>
                            <?php
                                // $transactionsDate = $database->query("SELECT * FROM `bank_transactions` WHERE `to_id`={$_SESSION['USER']}")->fetchAll(PDO::FETCH_ASSOC);
                                // foreach($transactionsDate)

                                require('utils/getSortedOperations.php');
                            ?>
                        </div>
                    </div>
                    <div class="last-statistic_content">
                        <?php 
                            // Сбор всех карт пользователя
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
                           

                            // echo $getSearch;
                            

                                // Проверка на поисковый запрос
                                if(isset($_POST['search'])) {
                                    $getSearch = $_POST['search'];
                                    
    
                                    if(!empty($getSearch)) {
                                        $sqlSearch = "AND (`created_at` LIKE '%".$getSearch."%')";
                                    } else {
                                        $sqlSearch = '';
                                    }
                                } else {
                                    $sqlSearch = '';
                                }

                                // Проверка на фильтрацию по доходам и расходам
    
                                // income - Доход
                                // expense - Расход
                                $cardsTransactionsArray = [];

                                
                            foreach($userCards as $card) {

                                    $getTransactions = $database->query("SELECT * FROM `bank_transactions` WHERE (`from_id`={$card['id_card']} OR `to_id`={$card['id_card']}) ORDER BY `id_transaction` DESC")->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($getTransactions as $transaction) {
                                        array_push($cardsTransactionsArray, $transaction);
                                    }
                                    // printData($cardsTransactionsArray);

                                    


                                    // if(isset($_GET['filterOperations'])) {
                                    //     $getFilter = $_GET['filterOperations'];
        
                                    //     if(!empty($getFilter)) {
                                    //         if($getFilter === 'income') {
                                    //             $sqlFilter = "WHERE `to_id`={$card['id_card']}";
                                                
                                    //         } elseif($getFilter === 'expense') {
                                    //             $sqlFilter = "WHERE `from_id`={$card['id_card']}";
                                    //         } else {
                                    //             $sqlFilter = "WHERE (`from_id`={$card['id_card']} OR `to_id`={$card['id_card']})";
                                                
                                    //         }
                                    //     } else {
                                    //         $sqlFilter = "WHERE (`from_id`={$card['id_card']} OR `to_id`={$card['id_card']})";
                                    //     }
                                    // } else {
                                    //     $sqlFilter = "WHERE (`from_id`={$card['id_card']} OR `to_id`={$card['id_card']})";
                                    // }
                                

                                // var_dump($sqlFilter);

                                // Вывод транзакций от новых к старым
                
                                // $transactionsDate = $database->query("SELECT * FROM `bank_transactions` $sqlFilter $sqlSearch ORDER BY `created_at` DESC")->fetchAll(PDO::FETCH_ASSOC);
                                

                                
                                // var_dump($transactionsDate);

                            }

                            // Сортировка транзакций по картам и избавление от дубликатов по столбцу ID

                            $temp = array_unique(array_column($cardsTransactionsArray, 'id_transaction'));
                            $transactionsDate = array_intersect_key($cardsTransactionsArray, $temp);

                            // Сортировка транзакций по дате (от недавних к прошлым), чтобы вычесть дубликаты дат
                            $dates  = array_column($transactionsDate, 'created_at');
                            array_multisort($dates, SORT_DESC, $transactionsDate);
                            
                            

                            if($transactionsDate === '') {
                                $transactionsDate = [];
                                
                            }

                            
                            if(isset($_GET['filterOperations'])) {
                                $getFilter = $_GET['filterOperations'];
        
                                
                                if(!empty($getFilter)) {
                                    // $transactionDate = [];
                                    $filteredTransaction = [];
                                    if($getFilter === 'income') {
                                        // $sqlFilter = "WHERE `to_id`={$card['id_card']}";
                                        foreach($userCards as $card) {
                                            foreach($transactionsDate as $transaction) {
                                                if($transaction['to_id'] === $card['id_card']) {
                                                    array_push($filteredTransaction, $transaction);
                                                }
                                            }
                                        }
                                        
                                    } elseif($getFilter === 'expense') {
                                        // $sqlFilter = "WHERE `from_id`={$card['id_card']}";
                                        foreach($userCards as $card) {
                                            foreach($transactionsDate as $transaction) {
                                                if($transaction['from_id'] === $card['id_card']) {
                                                    array_push($filteredTransaction, $transaction);
                                                }
                                            }
                                        }
                                    } else {

                                    }
                                    $transactionsDate = $filteredTransaction;
                                    
                                } else {
                                    
                                }

                                $dates  = array_column($transactionsDate, 'created_at');
                                array_multisort($dates, SORT_DESC, $transactionsDate);
                                // printData($transactionsDate);
                            }

                            // printData($dates);

                            if(!empty($transactionsDate)) {
                                

                                // Сбор дат без повторений
                                $dates['key'] = [];

                                $today = time();

                                $otherDay = time() - (3 * 24 * 60 * 60);
                                $dates['key'][] = date('Y-m-d', strtotime($transactionsDate[0]['created_at']));
        
                                // Отсечение повторяющихся дат и добавление в массив
                                foreach($transactionsDate as $date) {
                                    $dateItem = date('Y-m-d', strtotime($date['created_at'])); 

                                    $k = count($dates['key']) - 1;


                                    if ($dates['key'][$k] !== $dateItem) {
                                        $dates['key'][] = $dateItem;
                                        // echo 'Записалось:'.$dateItem;
                                    }
                                    // echo '</br>';
                                    // echo 'Последняя дата:';
                                    // var_dump($dates['key'][$k]);
                                    // echo '</br>';
                                    // echo 'Дата в транзакции:';
                                    // var_dump($dateItem);
                                    // echo '</br>';
                                }

                                // printData($dates['key']);

                                $transactionsSorted = [];

                                // Добавление в массив дат, для распределения операций по дням
                                
                                foreach($dates['key'] as $dateFiltered) {
                                    $daysArray = [];
                                    foreach($transactionsDate as $date) {
                                        $dateItem = date('Y-m-d', strtotime($date['created_at'])); 

                                        if($dateItem === $dateFiltered) $daysArray[] = $date;
                                    }
                                    $transactionsSorted[] = $daysArray;
                                }

                                // printData($transactionsSorted);
                            

                            

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
                                                    // printData($dayData);
                                                    foreach($dayData as $transaction) {
                                                         // Переборка карт пользователя для вывода данных
                                                         
                                                        foreach($userCards as $card) {
                                                            // Если карта совпадает с транзакцией, то производится вывод информации
                                                            if(isset($_GET['filterOperations'])) {
                                                                $getFilter = $_GET['filterOperations'];
                                                                if(!empty($getFilter)) {
                                                                    if($getFilter === 'income') {
                                                                        // $sqlFilter = "WHERE `to_id`={$card['id_card']}";
                                                                        if($card['id_card'] === $transaction['to_id']) {
                                                                            $operationTypeClass = 'income';
                                                                            $operationSymbol = '+';
                                                                        } else {
                                                                            continue;
                                                                        }

                                                                    } elseif ($getFilter === 'expense') {
                                                                        // $sqlFilter = "WHERE `from_id`={$card['id_card']}";
                                                                        if($card['id_card'] === $transaction['from_id']) {
                                                                            $operationTypeClass = 'expense';
                                                                            $operationSymbol = '-';
                                                                        } else {
                                                                            continue;
                                                                        }
                                                                    } 
                                                                }
                                                            } else {
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
                                                                echo '
                                                                <a cardID='.$card['id_card'].' type='.$operationTypeClass.' transactionID="'.$transaction['id_transaction'].'" class="statistic '.$operationTypeClass.'">
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
                                                                                    
                                                                                    // if($transaction['from_id'] === $card['id_card']) {
                                                                                    //     echo $operationSymbol.numberFormat($transaction['summary_from']);
                                                                                    // } elseif ($transaction['to_id'] === $card['id_card']) {
                                                                                    //     echo $operationSymbol.numberFormat($transaction['summary_to']);
                                                                                    // } else {
                                                                                    //     echo 'Ошибка';
                                                                                    // }
                                                                                    
                                                                                echo'
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
                                                } else {
                                                    echo '<h3>Нет операций</h3>';
                                                }
                                            echo '
                    
                                        </div>
                                    </div>
                                    ';
                                }
                            
                            }

                            if(isset($_POST['search'])) {

                                if(empty($transactionsDate)) {
                                    echo 'По вашему запросу ничего не найдено';
                                    return;
                                }
                                return;
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
                    <!-- <div class="last-statistic_content">
                        <div class="last-statistic_box">
                            <div class="statistic_header">
                                <p>Сегодня</p>
                            </div>
                            <div class="statistic_info_box">
                                <a href="#" class="statistic">
                                    <div class="statistic_image_box">
                                        <img src="img/statistic/magint.png" alt="" class="statistic_image">
                                    </div>
                                    <div class="statistic_text-content">
                                        <div class="statistic_upper-text-content">
                                            <p class="statistic-info_type">
                                                Дебетовая карта
                                            </p>
                                            <div class="statistic-info_price">
                                                54,24
                                            </div>
                                        </div>
                                        <div class="statistic_bottom-text-content">
                                            <p class="statistic-info_name">
                                                Магнит
                                            </p>
                                            <p class="statistic-info_category">
                                                Категория
                                            </p>
                                        </div>

                                    </div>
                                </a>

                                <a href="#" class="statistic">
                                    <div class="statistic_image_box">
                                        <img src="img/statistic/magint.png" alt="" class="statistic_image">
                                    </div>
                                    <div class="statistic_text-content">
                                        <div class="statistic_upper-text-content">
                                            <p class="statistic-info_type">
                                                Дебетовая карта
                                            </p>
                                            <div class="statistic-info_price">
                                                54,24
                                            </div>
                                        </div>
                                        <div class="statistic_bottom-text-content">
                                            <p class="statistic-info_name">
                                                Магнит
                                            </p>
                                            <p class="statistic-info_category">
                                                Категория
                                            </p>
                                        </div>

                                    </div>
                                </a>

                                <a href="#" class="statistic">
                                    <div class="statistic_image_box">
                                        <img src="img/statistic/magint.png" alt="" class="statistic_image">
                                    </div>
                                    <div class="statistic_text-content">
                                        <div class="statistic_upper-text-content">
                                            <p class="statistic-info_type">
                                                Дебетовая карта
                                            </p>
                                            <div class="statistic-info_price">
                                                54,24
                                            </div>
                                        </div>
                                        <div class="statistic_bottom-text-content">
                                            <p class="statistic-info_name">
                                                Магнит
                                            </p>
                                            <p class="statistic-info_category">
                                                Категория
                                            </p>
                                        </div>

                                    </div>
                                </a>

                                <a href="#" class="statistic">
                                    <div class="statistic_image_box">
                                        <img src="img/statistic/magint.png" alt="" class="statistic_image">
                                    </div>
                                    <div class="statistic_text-content">
                                        <div class="statistic_upper-text-content">
                                            <p class="statistic-info_type">
                                                Дебетовая карта
                                            </p>
                                            <div class="statistic-info_price">
                                                54,24
                                            </div>
                                        </div>
                                        <div class="statistic_bottom-text-content">
                                            <p class="statistic-info_name">
                                                Магнит
                                            </p>
                                            <p class="statistic-info_category">
                                                Категория
                                            </p>
                                        </div>

                                    </div>
                                </a>

                                <a href="#" class="statistic">
                                    <div class="statistic_image_box">
                                        <img src="img/statistic/magint.png" alt="" class="statistic_image">
                                    </div>
                                    <div class="statistic_text-content">
                                        <div class="statistic_upper-text-content">
                                            <p class="statistic-info_type">
                                                Дебетовая карта
                                            </p>
                                            <div class="statistic-info_price">
                                                54,24
                                            </div>
                                        </div>
                                        <div class="statistic_bottom-text-content">
                                            <p class="statistic-info_name">
                                                Магнит
                                            </p>
                                            <p class="statistic-info_category">
                                                Категория
                                            </p>
                                        </div>

                                    </div>
                                </a>
                            </div>
                        </div>

                    </div> -->
                </div>
            </div>
        </section>

