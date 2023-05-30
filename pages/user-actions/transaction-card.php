<?php
        $userID = $_SESSION['USER'];

        $cardInfo = $database->query("SELECT * FROM `bank_card` WHERE `user_id` = '$userID' ")->fetchAll(PDO::FETCH_ASSOC);
    
?>

<form action="actions/transaction-card.php" method="POST" class="user_action-block">
    <div class="user_action_container container">
        <h1>Перевод по карте</h1>

        <div class="card_input_box">
            <p class="input_title">Откуда</p>
            <div class="select">
                <div class="select__header">
                    <div class="select__header_header">
                        <div class="card_image_box image_box">
                            <img src="img/icons/transactions/Transaction-Cards-icon.svg" alt="" class="current__image">
                        </div>
                        <span class="select__current">Карта</span>
                    </div>
                    <input name="from_number_card" class="select__current-input"/>
                    <div class="select__icon arrow_image-box">
                        <svg class="arrow_img" width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.83824 1.62443L5.32362 5.1609C5.10794 5.37791 4.75827 5.37791 4.54259 5.1609L1.02797 1.62443C0.812292 1.40741 0.812292 1.05556 1.02797 0.838543C1.24364 0.621527 1.59332 0.621527 1.809 0.838543L4.60959 3.65655L5.25662 3.65655L8.05722 0.838543C8.27289 0.621527 8.62257 0.621527 8.83824 0.838543C9.05392 1.05556 9.05392 1.40741 8.83824 1.62443Z" fill="black"/>
                        </svg>
                            
                    </div>
                </div>
            
                <div class="select__body">
                    <?php
                    
                        foreach($cardInfo as $item) {
                            $currencyID = $item['currency_id'];
                            echo '<div value="'.$item['number_card'].'" class="select__item">';
                            echo '
                            
                                <div class="card">
                                    <div class="card_image_box image_box">
                                        <img src="'.$item['image_path'].'" alt="'.$item['name'].'" class="card_image">
                                    </div>
                                    <div class="card_info_content">';
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
                                </div>
                            ';
                            echo '</div>';
                        }
                    ?>
                </div>
            </div>
        </div>
      
        <div class="card_input_box">
            <p class="input_title">Номер карты</p>
            <input value="<?php if(isset($_POST['number_card'])) echo $_POST['number_card']; ?>" type="text" name="to_number_card" id="" class="card_input input_style card_form_input" placeholder="4444 0000 4444 0000"> 
        </div>

        <div class="card_input_box">
            <p class="input_title">Сумма</p>
            <input step='any' value="<?php if(isset($_POST['transaction_sum'])) echo $_POST['transaction_sum']; ?>" type="number" name="transaction_sum" id="" data-min="1" data-max="999999999" placeholder="Сумма от 1 до 999 999 999 ₽" class="sum_input input_style card_form_input"> 
        </div>
        <button type="submit" name="card" href="#" class="card_form_button button_style">
                    Отправить
        </button>
    </div>
</form>