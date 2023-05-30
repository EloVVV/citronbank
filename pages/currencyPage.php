<?php
    require("pages/utils/getCurrencyData.php");
    require("pages/utils/arrayStyle.php");


    $Ntime = time();
    $Rtime = $Ntime - (24 * 60 * 60);

    $format = 2;
    // Валюта сейчас
    $valutes = get_currency('', $format, $Ntime, $Ntime);

    // Валюта вчера
    $pastValutes = get_currency('', $format, $Rtime, $Ntime);

    $mainValutesNow = [];
    $mainValutesPast = [];

    foreach($valutes as $item) {
        if(strval($item->CharCode) === 'USD'
        || strval($item->CharCode) === 'EUR'
        || strval($item->CharCode) === 'CNY') array_push($mainValutesNow, $item);
    } 
    foreach($pastValutes as $item) {
        
        if(strval($item->CharCode) === 'USD'
        || strval($item->CharCode) === 'EUR'
        || strval($item->CharCode) === 'CNY') {
            array_push($mainValutesPast, $item);
        }
    } 


    



   
?>

<section class="currency">
    <div class="currency_container container">
        <div class="currency_header">
            <h1>Валюты</h1>
            <div class="date">
                <?php 
                icons('calendar', 20, 'var(--other-text-color)'); 
                echo date('d.m.Y', time());
                ?>
            </div>
        </div>
        <div class="main_valutes">
            <?php
                for($i = 0; $i < count($mainValutesNow); $i++) {
                    $valueNow = strval($mainValutesNow[$i]->Value);
                    $valuePast = strval($mainValutesPast[$i]->Value);

                    if($valueNow > $valuePast) {
                        $color = "var(--good-color)";
                        $nameIcon = "arrowUp";
                        // echo 'Поднялся курс';
                    } elseif ($valueNow < $valuePast) {
                        $color = "var(--ahtung-color)";
                        $nameIcon = "arrowDown";
                        // echo 'Упал курс';
                    } else {
                        $color = "var(--other-text-color)";
                        $nameIcon = "arrowDefault";
                        // echo 'Не поменялось нихера';
                    }

                    echo '
                    <div class="item">
                        <div class="currency_value">
                            '.number_format(str_replace(',', '.', $mainValutesNow[$i]->Value), $format).' <p>₽</p>
                        </div>
                        <div class="currency_footer">
                            <div class="name">
                                '.$mainValutesNow[$i]->CharCode.'
                            </div>
                            <div class="info_past">
                            <p class="">'.number_format(str_replace(',', '.', $mainValutesPast[$i]->Value), $format).'</p>
                            <div class="image_box">
                                '; icons($nameIcon, 12, $color); echo '
                            </div>
                        </div>
                        </div>
                    </div>
                    ';
                }
            ?>
        </div>
        <div class="items">
            <?php
                for($i = 0; $i < count($valutes); $i++) {
                    $valueNow = strval($valutes[$i]->Value);
                    $valuePast = strval($pastValutes[$i]->Value);

                    if(strval($valutes[$i]->CharCode) === 'USD'
                    || strval($valutes[$i]->CharCode) === 'EUR'
                    || strval($valutes[$i]->CharCode) === 'CNY') continue;

                    if($valueNow > $valuePast) {
                        $color = "var(--good-color)";
                        $nameIcon = "arrowUp";
                        // echo 'Поднялся курс';
                    } elseif ($valueNow < $valuePast) {
                        $color = "var(--ahtung-color)";
                        $nameIcon = "arrowDown";
                        // echo 'Упал курс';
                    } else {
                        $color = "var(--other-text-color)";
                        $nameIcon = "arrowDefault";
                        // echo 'Не поменялось нихера';
                    }

                    echo '
                    <div class="item">
                        <div class="currency_value">
                            '.number_format(str_replace(',', '.', $valutes[$i]->Value), $format).' <p>₽</p>
                        </div>
                        <div class="currency_footer">
                            <div class="name">
                                '.$valutes[$i]->CharCode.'
                            </div>
                            <div class="info_past">
                                <p class="">'.number_format(str_replace(',', '.', $pastValutes[$i]->Value), $format).'</p>
                                <div class="image_box">
                                    '; icons($nameIcon, 12, $color); echo '
                                </div>
                            </div>
                        </div>
                    </div>
                    ';
                }
                // foreach($valutes as $item) {
                //     // printData();
                    
                //     if($item->Value > )
                //     echo '
                //     <div class="item">
                //         <div class="currency_value">
                //             '.$item->Value.'
                //         </div>
                //         <div class="currency_footer">
                //             <div class="name">
                //                 '.$item->CharCode.'
                //             </div>
                //             <div class="image_box">
                //                 '.icons('arrowPoly', 20, $color).'
                //             </div>
                //         </div>
                //     </div>
                //     ';
                // }
            ?>
        </div>
    </div>
</section>