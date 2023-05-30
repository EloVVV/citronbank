<?php
$userCard = $database->query("SELECT * FROM `bank_card` WHERE `user_id`={$_SESSION['USER']}")->fetchAll(PDO::FETCH_ASSOC);

foreach($userCard as $card) {
    
    // Вывод транзакций от новых к старым
        
    $transactionsDate = $database->query("SELECT * FROM `bank_transactions` WHERE (`from_id`={$card['id_card']} OR `to_id`={$card['id_card']}) ORDER BY `created_at` DESC")->fetchAll(PDO::FETCH_ASSOC);
                        

  

    if($transactionsDate === '') {
        $transactionsDate = [];
        
    }
                      
    // var_dump($transactionsDate[0]['created_at']);

    // Сбор дат без повторений
    $dates['key'] = [];

    // $today = time();

    // $otherDay = time() - (3 * 24 * 60 * 60);
    if(isset($transactionsDate[0])) {
        $dates['key'][] = date('Y-m', strtotime($transactionsDate[0]['created_at']));
    }

    // Отсечение повторяющихся дат и добавление в массив
    foreach($transactionsDate as $date) {
        $dateItem = date('Y-m', strtotime($date['created_at'])); 

        $k = count($dates['key']) - 1;
        if ($dates['key'][$k] !== $dateItem) $dates['key'][] = $dateItem;
    }

    $transactionsSorted = [];

    // Добавление в массив дат, для распределения операций по дням

    foreach($dates['key'] as $dateFiltered) {
        $daysArray = [];
        foreach($transactionsDate as $date) {
            $dateItem = date('Y-m', strtotime($date['created_at'])); 

            if($dateItem === $dateFiltered) $daysArray[] = $date;
        }
        $transactionsSorted[] = $daysArray;
    }

    foreach($transactionsSorted as $dayData) {
        $sumMounthIncome = 0;
        $sumMounthExpense = 0;
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

                // Income - Доход
                // Expense - Расход

                if($transaction['from_id'] === $card['id_card']) {
                    $sumMounthExpense += $transaction['summary_from'];
                } elseif ($transaction['to_id'] === $card['id_card']) {
                    $sumMounthIncome += $transaction['summary_to'];
                }
            }


            echo '
            <div class="income">
                <div class="statistic-info_price">
                    +'.numberFormat($sumMounthIncome).'
                </div>
            </div>';
            echo '
            <div class="expense">
                <div class="statistic-info_price">
                    -'.numberFormat($sumMounthExpense).'
                </div>
            </div>';
            return;
        } else {
            echo '<h3>Нет операций</h3>';
        }
    }
}