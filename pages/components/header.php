<?php
   if(isset($_SESSION['USER'])) {
    $userID = $_SESSION['USER'];
    $paymentInfo = $database->query("SELECT * FROM `bank_payment-account` WHERE `id_user`='$userID'")->fetchAll(PDO::FETCH_ASSOC);
    

    $paymentAmount = [];
    $amount = 0;
    foreach($paymentInfo as $payment) {
        $userCards = $database->query("SELECT * FROM `bank_card` WHERE `user_id`='$userID' AND `currency_id`={$payment['currency']}")->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($userCards as $card) {
            $amount += $card['balance'];
        }
        array_push($paymentAmount, $amount);

    }
   }

?>
<header class="header">
    <div class="header_container container">
        <a href="?page=main_page" class="logotype_box">
            <img src="img/logos/Citron-Bank_Full-Logotype.svg" alt="" class="logotype_img">
        </a>
        <ul class="menu">
            <!-- <li><a href="?page=credit_cards" class="menu_link">Кредитные карты</a></li> -->
            <li><a href="?page=debit_cards" class="menu_link">Дебетовые карты</a></li>
            <li><a href="?page=currency" class="menu_link">Валюта</a></li>
            <!-- <li><a href="#" class="menu_link">Премиум</a></li> -->
        </ul>
        <?php
            if(isset($_SESSION['USER'])) {
                echo '
                <div class="profile_menu">
                    <div class="profile_buttons">
                        <div class="user_payment">
                            ';
                            // '.numberFormat($paymentAmount[0]).' ₽
                            echo '
                        </div>
                        <div class="user_profile_box">
                            <div class="user_img_box">
                                <img src="'.$user['image_path'].'" alt="" class="user_img">
                            </div>
                            <svg class="profile_arrow arrow_icon" width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.83824 1.62443L5.32362 5.1609C5.10794 5.37791 4.75827 5.37791 4.54259 5.1609L1.02797 1.62443C0.812292 1.40741 0.812292 1.05556 1.02797 0.838543C1.24364 0.621527 1.59332 0.621527 1.809 0.838543L4.60959 3.65655L5.25662 3.65655L8.05722 0.838543C8.27289 0.621527 8.62257 0.621527 8.83824 0.838543C9.05392 1.05556 9.05392 1.40741 8.83824 1.62443Z" fill="black"/>
                            </svg>
                        </div>
                    </div>
                    <ul class="submenu_profile">
                        <li>
                            <a href="?page=profile&id='.$id_user.'" class="submenu_link">
                                <div class="submenu_image_box image_box">
                                    '; icons('profile', 26, '#000'); echo '
                                </div>
                                <p class="submenu_link-text">
                                    Личный кабинет
                                </p>
                            </a>
                        </li>

                        <li>
                            <a href="?page=settings&id='.$id_user.'" class="submenu_link">
                                <div class="submenu_image_box image_box">
                                    
                                    '; icons('setting', 26, '#000'); echo '
                                </div>
                                <p class="submenu_link-text">
                                    Настройки профиля
                                </p>
                            </a>
                        </li>
                      
                        <li>
                            <a href="?do=exit" class="submenu_link exit_link">
                                <div class="submenu_image_box image_box">
                                '; icons('exit', 26, '#000'); echo '
                                </div>
                                <p class="submenu_link-text">
                                    Выйти
                                </p>
                            </a>
                        </li>
                    </ul>
                </div>
                ';
            } else {
                echo '
                    <div class="header_actions">
                        <a href="?page=registration" class="menu_link">Регистрация</a>
                        <span>/</span>
                        <a href="?page=authentication" class="menu_link">Войти</a>
                    </div>
                ';
            }
        ?>
        <div class="burger-menu">
            <span></span>
        </div>
        <div class="popup modal_popup">
            <div class="popup_body">
                <div class="popup_container">
                    <div class="close_popup_btn">
                        <svg class="close-icon" width="188" height="188" viewBox="0 0 188 188" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M75.2052 93.9408L0.25 18.9855L18.9855 0.25L93.9408 75.2052L168.896 0.25L187.632 18.9855L112.676 93.9408L187.632 168.896L168.896 187.632L93.9408 112.676L18.9855 187.632L0.25 168.896L75.2052 93.9408Z" fill="black"/>
                        </svg>
                    </div>
                    <ul class="burger_menu_block">
                        <li><a href="?page=credit_cards" class="menu_link">Кредитные карты</a></li>
                        <li><a href="?page=debit_cards" class="menu_link">Дебетовые карты</a></li>
                        <!-- <li><a href="#" class="menu_link">Премиум</a></li> -->
                    </ul>
                    <?php
                        if(isset($_SESSION['USER'])) {
                            echo '
                            <div class="profile_menu profile_menu_modal">
                                <div class="profile_buttons">
                                    <div class="user_payment">
                                        00 000,00 ₽
                                    </div>
                                    <div class="user_profile_box">
                                        <div class="user_img_box">
                                            <img src="'.$user['image_path'].'" alt="" class="user_img">
                                        </div>
                                        <svg class="profile_arrow arrow_icon" width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8.83824 1.62443L5.32362 5.1609C5.10794 5.37791 4.75827 5.37791 4.54259 5.1609L1.02797 1.62443C0.812292 1.40741 0.812292 1.05556 1.02797 0.838543C1.24364 0.621527 1.59332 0.621527 1.809 0.838543L4.60959 3.65655L5.25662 3.65655L8.05722 0.838543C8.27289 0.621527 8.62257 0.621527 8.83824 0.838543C9.05392 1.05556 9.05392 1.40741 8.83824 1.62443Z" fill="black"/>
                                        </svg>
                                    </div>
                                </div>
                                <ul class="submenu_profile">
                                    <li>
                                        <a href="?page=profile&id='.$id_user.'" class="submenu_link">
                                            <div class="submenu_image_box image_box">
                                                <img src="img/icons/Profile-icon.svg" alt="" class="submenu_img">
                                            </div>
                                            <p class="submenu_link-text">
                                                Личный кабинет
                                            </p>
                                        </a>
                                    </li>
                                
                                    <li>
                                        <a href="?do=exit" class="submenu_link exit_link">
                                            <div class="submenu_image_box image_box">
                                                <svg class="submenu_img exit-icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1.77778 16H14.2222C15.2027 16 16 15.2027 16 14.2222V1.77778C16 0.797333 15.2027 0 14.2222 0H1.77778C0.797333 0 0 0.797333 0 1.77778V7.112H6.22044V3.55556L11.5538 8L6.22044 12.4444V8.88978H0V14.2222C0 15.2027 0.797333 16 1.77778 16Z" fill=""/>
                                                </svg>
                                            </div>
                                            <p class="submenu_link-text">
                                                Выйти
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            ';
                        } else {
                            echo '
                                <div class="header_actions">
                                    <a href="?page=registration" class="">Регистрация</a>
                                    <span>/</span>
                                    <a href="?page=auth">Войти</a>
                                </div>
                            ';
                        }
                    ?>

                            <!-- <div class="buttons_block">
                                <a href="?page=registration" class="button_style auth_btn auth_btn_modal">Войти</a>
                            </div> -->
                </div>
                <div class="popup_area"></div>
            </div>
        </div>
    </div>
</header>

<!-- <li>
    <a href="?page=" class="submenu_link">
        <div class="submenu_image_box">
            <img src="img/icons/setting-icon.svg" alt="" class="submenu_img">
        </div>
        <p class="submenu_link-text">
            Настройки
        </p>
    </a>
</li> -->