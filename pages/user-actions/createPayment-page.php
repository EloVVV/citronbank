<div class="registration_container container">
    <div class="registration_block">
        <h2>Создание счёта</h2>
        <form action="actions/createPayment.php" method="POST" name="reg">


            <div class="profile_input_box form_input_style">
                <!-- <select name="currency" id="">
                    <?php
                    
                        // $currency = $database->query("SELECT * FROM `bank_currency`")->fetchAll(PDO::FETCH_ASSOC);
                        // foreach($currency as $item) {
                        //     echo '<option value="'.$item['id_currency'].'">'.$item['name'].'</option>';
                        // }
                    ?>
                </select> -->

                <div class="card_input_box">
                    <!-- <p class="input_title">Валюта</p> -->
                    <div class="select">
                        <div class="select__header">
                            <span class="select__current">Валюта</span>
                            <input value="<?=$currencyID?>" name="currency" class="select__current-input"/>
                            <div class="select__icon arrow_image-box">
                                <svg class="arrow_img" width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.83824 1.62443L5.32362 5.1609C5.10794 5.37791 4.75827 5.37791 4.54259 5.1609L1.02797 1.62443C0.812292 1.40741 0.812292 1.05556 1.02797 0.838543C1.24364 0.621527 1.59332 0.621527 1.809 0.838543L4.60959 3.65655L5.25662 3.65655L8.05722 0.838543C8.27289 0.621527 8.62257 0.621527 8.83824 0.838543C9.05392 1.05556 9.05392 1.40741 8.83824 1.62443Z" fill="black"/>
                                </svg>
                                    
                            </div>
                        </div>
                    
                        <div class="select__body">
                            <?php
                                $currencies = $database->query("SELECT * FROM `bank_currency`")->fetchAll(PDO::FETCH_ASSOC);

                                foreach($currencies as $item) {
                                    echo '<div value="'.$item['id_currency'].'" class="select__item">'.$item['name'].'</div>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <button class="button-form button_style" name="auth">Открыть</button>
        </form>
    </div>
        
</div>