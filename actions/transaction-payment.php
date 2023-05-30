<?
    session_start();

    require('../database/database.php');
    global $database;


    unset($_SESSION['errors']);
    $_SESSION['errors'] = [];

    // Функция для получения курса валюты на текущий момент
    function get_currency($currency_code, $format) {

        $date = date('d/m/Y'); // Текущая дата
        $cache_time_out = 14400; // Время жизни кэша в секундах
    
        $file_currency_cache = './currency.xml'; // Файл кэша
    
        if(!is_file($file_currency_cache) || filemtime($file_currency_cache) < (time() - $cache_time_out)) {
    
            $ch = curl_init();
    
            curl_setopt($ch, CURLOPT_URL, 'https://www.cbr.ru/scripts/XML_daily.asp?date_req='.$date);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
            curl_setopt($ch, CURLOPT_HEADER, 0);
    
            $out = curl_exec($ch);
    
            curl_close($ch);
    
            file_put_contents($file_currency_cache, $out);
    
        }
    
        $content_currency = simplexml_load_file($file_currency_cache);
        
        return $content_currency->xpath('Valute[CharCode="'.$currency_code.'"]');
        // return number_format(str_replace(',', '.', $content_currency->xpath('Valute[CharCode="'.$currency_code.'"]')[0]->Value), $format);
    
    }

    // echo get_currency('USD', 1)[0]->Value;

    $userID = $_SESSION['USER'];


    if(isset($_POST)){
        $from_number_card = $_POST['from_number_card'];
        $to_number_card = $_POST['to_number_card'];
        $transaction_sum = $_POST['transaction_sum'];

        if($transaction_sum < 0) $transaction_sum = $transaction_sum * -1;

        // Избавление от пробелов и лишних символов для проверки в БД
        $from_number_card = preg_replace('/\s+/', '', $from_number_card);
        $to_number_card = preg_replace('/\s+/', '', $to_number_card);


        // На всякий преобразование в целочисленное отображение
        $from_number_card = intval($from_number_card);
        $to_number_card = intval($to_number_card);

        // Данные по карте отправителя
        $fromUser = $database->query("SELECT * FROM `bank_card` WHERE `number_card`='$from_number_card'")->fetch(PDO::FETCH_ASSOC);


        if($from_number_card === $to_number_card) $_SESSION['errors'][] = "Нельзя перевести на одну и ту же карту";

        // $transaction_sum = $transaction_sum;

        if($transaction_sum === 0) $_SESSION['errors'][] = "Отправить можно от 1 до 1 000 000 ₽";

        // Поиск карты отправителя
        $searchFromCardCurrency = $database->query("SELECT * FROM `bank_card` WHERE `number_card` = '$from_number_card'")->fetch(PDO::FETCH_ASSOC);
        // Поиск карты получателя
        $searchCards = $database->query("SELECT * FROM `bank_card` WHERE `number_card` = '$to_number_card'")->fetch(PDO::FETCH_ASSOC);

        
        if($searchCards === '') {
            $searchCards = [];
        }

        if(empty($searchCards)) $_SESSION['errors'][] = "Такой карты не существует";
        

        if(empty($from_number_card) 
        || empty($to_number_card) 
        || empty($transaction_sum)) {
            $_SESSION['errors'][] = "Вы не заполнили все поля";
            header('Location: ../?page=transaction_for_card');
        }


        // Проверка на наличие средств, если есть, то производится рассчёт баланса после транзакции
        $fromBalanceNew = 0;
        if(!empty($transaction_sum)) $fromBalanceNew = $fromUser['balance'] - $transaction_sum;

        if($fromBalanceNew < 0) $_SESSION['errors'][] = "У вас недостаточно средств";
        // -----

        // Проверка на различие в валютах
        if($searchFromCardCurrency['currency_id'] !== $searchCards['currency_id']) {
            $fromCurrencyID = $searchFromCardCurrency['currency_id'];
            $toCurrencyID = $searchCards['currency_id'];

            // Получение валюты отправителя
            $fromCurrency = $database->query("SELECT * FROM `bank_currency` WHERE `id_currency` = '$fromCurrencyID'")->fetch(PDO::FETCH_ASSOC)['name_id'];
            // Получение валюты получателя
            $toCurrency = $database->query("SELECT * FROM `bank_currency` WHERE `id_currency` = '$toCurrencyID'")->fetch(PDO::FETCH_ASSOC)['name_id'];


// Изначальный баланс отправителя
            $fromBalance = $searchFromCardCurrency['balance'];
            // $key = '';

            // if($fromCurrency !== 'RUB') {
            //     $fromBalance = get_currency(strval($fromCurrency), 1)[0]->Value * $searchFromCardCurrency['balance'];
            //     $key = 'from';
            // }
// Конвертированный

// Изначальный баланс получателя
            $toBalance = $searchCards['balance'];

            // if($toCurrency !== 'RUB') {
            //     $toBalance = get_currency(strval($toCurrency), 1)[0]->Value * $searchCards['balance'];
            //     $key = 'to';
            // }
// Конвертированный

            // Если у отправителя счёт в рублях, то у получателя другая валюта
            // Отсюда конвертируется транзакция в формат валюты получателя
            // Если у отправителя счёт в другой валюте, то они конвертируются в валюту получателя

            if($fromCurrency === 'RUB') {
                $transaction_sum = $transaction_sum / get_currency(strval($toCurrency), 1)[0]->Value;
            } elseif(empty($fromCurrency)) {
                $_SESSION['errors'][] = 'Произошла ошибка, напишите в поддержку';
            } else {
                $transaction_sum = $transaction_sum * get_currency(strval($toCurrency), 1)[0]->Value;
            }



        }

        if(count($_SESSION['errors']) === 0) {

            // ID карты
            $fromCardID = $fromUser['id_card'];
            $toCardID = $searchCards['id_card'];

            // Баланс получателя после транзакции
            $toBalanceNew = floatval($searchCards['balance']) + $transaction_sum;

            // echo '</br> Сумма транзакции </br>';
            // echo $transaction_sum;

            // Обновление баланса в базе данных
            $updateToPayment = $database->query("UPDATE `bank_card` SET `balance`='$toBalanceNew'  WHERE `id_card`='$toCardID'")->fetch(PDO::FETCH_ASSOC);
            $updateFromPayment = $database->query("UPDATE `bank_card` SET `balance`='$fromBalanceNew'  WHERE `id_card`='$fromCardID'")->fetch(PDO::FETCH_ASSOC);

            // Сбор обновлённой информации по балансу
            $updatedToPayment = $database->query("SELECT * FROM `bank_card` WHERE  `number_card` = '$to_number_card'")->fetch(PDO::FETCH_ASSOC);
            $updatedFromPayment = $database->query("SELECT * FROM `bank_card` WHERE  `number_card` = '$from_number_card'")->fetch(PDO::FETCH_ASSOC);

            // Присваивание для проверки на ошибки
            $toBalanceUpdated = $updatedToPayment['balance'];
            $fromBalanceUpdated = $updatedFromPayment['balance'];

            // Избавление от плавающих чисел (4-х значныз)
            if(($fromBalanceNew % 10000) > 0) {
                $fromBalanceNew = intval($fromBalanceNew);
                $fromBalanceUpdated = intval($fromBalanceUpdated);

              
            }

            if(($toBalanceNew % 10000) > 0) {
                $toBalanceNew = floor($toBalanceNew);
                $toBalanceUpdated = floor($toBalanceUpdated);
            }
            // -----


            // echo '</br> Старый баланс отправителя </br>';
            // echo $fromBalance;
            // echo '</br> Новый баланс отправителя </br>';
            // echo $fromBalanceUpdated;

            // echo '</br> Старый баланс получателя </br>';
            // echo $toBalance;
            // echo '</br> Новый баланс получателя </br>';
            // echo $toBalanceUpdated;


            // echo '</br> Изменённый баланс отправителя </br>';
            // echo $fromBalanceNew;

            // echo '</br> Изменённый баланс получателя </br>';
            // echo $toBalanceNew;

            // Что-то на латышском
            if($fromBalanceNew !== $fromBalanceUpdated) echo 'Я ебал эти проверки';

          
            // Проверяется есть ли разница между обновлением данных в БД
            if($fromBalanceNew !== $fromBalanceUpdated OR $toBalanceNew !== $toBalanceUpdated) {
                $status = 'Ошибка транзакции';
            } else {
                $status = 'Отправлено';
            }
            // ----
            
            echo $status;

            // Если транзакция прошла, то она заносится в БД
            if($status === 'Отправлено') {
                $time = time();
                $transaction_sum_from = $_POST['transaction_sum'];

                // echo $transaction_sum_from;
                // echo '</br>';
                // echo $transaction_sum;

                $transaction = [
                    'from_id'=>$fromCardID,
                    'to_id'=>$toCardID,
                    'summary_from'=>$transaction_sum_from,
                    'summary_to'=>$transaction_sum,
                    'status'=>$status,
                    'organizationID'=>1,
                    'created_at'=>date("Y-m-d H:i:s", $time),
                    'updated_at'=>date("Y-m-d H:i:s", $time),
                ];

                

                $insertTransaction = $database->prepare("INSERT INTO `bank_transactions`
                 (`from_id`, `to_id`, `summary_from`, `summary_to`, `status`, `organizationID`,`created_at`, `updated_at`) 
                VALUES (:from_id, :to_id, :summary_from, :summary_to, :status, :organizationID,:created_at, :updated_at)");
                $insertTransaction->execute($transaction);
                $insertTransaction->fetch(PDO::FETCH_ASSOC);
            }
            header('Location: ../?page=profile');
            // echo 'успех';
        } else {
            header('Location: ../?page=transaction_for_card');
            // foreach($_SESSION['errors'] as $err) {
            //     echo $err;
            // }
        }


    }
    
?>
