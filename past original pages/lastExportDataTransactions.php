<?php 
                            // Сбор всех карт пользователя
                            $userCard = $database->query("SELECT * FROM `bank_card` WHERE `user_id`={$_SESSION['USER']}")->fetchAll(PDO::FETCH_ASSOC);
                         

                           

                            // echo $getSearch;
                            foreach($userCard as $card) {

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

                                if(isset($_GET['filterOperations'])) {
                                    $getFilter = $_GET['filterOperations'];
    
                                    if(!empty($getFilter)) {
                                        if($getFilter === 'income') {
                                            $sqlFilter = "WHERE `to_id`={$card['id_card']}";
                                            
                                        } elseif($getFilter === 'expense') {
                                            $sqlFilter = "WHERE `from_id`={$card['id_card']}";
                                        } else {
                                            $sqlFilter = "WHERE (`from_id`={$card['id_card']} OR `to_id`={$card['id_card']})";
                                            
                                        }
                                    } else {
                                        $sqlFilter = "WHERE (`from_id`={$card['id_card']} OR `to_id`={$card['id_card']})";
                                    }
                                } else {
                                    $sqlFilter = "WHERE (`from_id`={$card['id_card']} OR `to_id`={$card['id_card']})";
                                }

                                // Вывод транзакций от новых к старым
                
                                $transactionsDate = $database->query("SELECT * FROM `bank_transactions` $sqlFilter $sqlSearch ORDER BY `created_at` DESC")->fetchAll(PDO::FETCH_ASSOC);
                                

                                
                                // var_dump($transactionsDate);

                                if($transactionsDate === '') {
                                    $transactionsDate = [];
                                    
                                }

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
                                        if ($dates['key'][$k] !== $dateItem) $dates['key'][] = $dateItem;
                                    }

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
                                                        // Вывод всех операций по дням
                                                        foreach($dayData as $transaction) {
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

                                                          

                                                            echo '
                                                            <a href="#" class="statistic '.$operationTypeClass.'">
                                                                <div class="statistic_image_box">
                                                                    <img src="img/statistic/magint.png" alt="" class="statistic_image">
                                                                </div>
                                                                <div class="statistic_text-content">
                                                                    <div class="statistic_upper-text-content">
                                                                        <p class="statistic-info_type">
                                                                            Дебетовая карта
                                                                        </p>
                                                                        <div class="statistic-info_price">
                                                                             '; 
                                                                                if($transaction['from_id'] === $card['id_card']) {
                                                                                    echo $operationSymbol.numberFormat($transaction['summary_from']);
                                                                                } elseif ($transaction['to_id'] === $card['id_card']) {
                                                                                    echo $operationSymbol.numberFormat($transaction['summary_to']);
                                                                                }
                                                                            echo' ₽
                                                                        </div>
                                                                    </div>
                                                                    <div class="statistic_bottom-text-content">
                                                                        <p class="statistic-info_name">
                                                                            Тинькофф Банк
                                                                        </p>
                                                                        <p class="statistic-info_category">
                                                                            Категория
                                                                        </p>
                                                                    </div>
                                    
                                                                </div>
                                                            </a>
                                                            ';
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