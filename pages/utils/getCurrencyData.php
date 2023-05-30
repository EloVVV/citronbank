<?php

// Функция для получения курса валюты на текущий момент
function get_currency($currency_code, $format, $Rtime, $Ntime) {
   

    $date = date('d/m/Y', $Rtime);


    $cache_time_out = 14400; // Время жизни кэша в секундах

    $file_currency_cache = './currency.xml'; // Файл кэша
    if($Rtime !== $Ntime) {
        $file_currency_cache = './currencyPast.xml'; // Файл кэша
    }

    if(is_file($file_currency_cache)) {
        unlink($file_currency_cache);
    }
   

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

    if($currency_code !== '') {
        return $content_currency->xpath('Valute[CharCode="'.$currency_code.'"]');
    }
    
    return $content_currency->xpath('Valute');
    // return number_format(str_replace(',', '.', $content_currency->xpath('Valute[CharCode="'.$currency_code.'"]')[0]->Value), $format);

}


// foreach( $items as $item) {
//     echo $item;
// }

// var_dump();