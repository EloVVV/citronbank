<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    
    <script src="js/script.js" defer></script>
    <script src="js/selectbox.js" defer></script>
    <script src="js/swiper.js" defer></script>
    <script src="js/accordion.js" defer></script>

    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
    />

    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

    <title>Citron Bank</title>
</head>
<body> -->
<?php
    if(!isset($_SESSION['USER'])) {
        // $_SESSION['errors'][] = "Тебе туда нельзя";
        header('Location: ./?page=404');
    }
?>
    <main>
        <section class="payment_info_block payment_settings_block">
            <article class="payment_info_block_container container">
                <?php require('actions/get_payment-header-content.php')?>
                <div class="payment-settings_buttons">
                    <a href="#" class="payment-settings_button card_button">
                        <p>Заморозить</p>
                        <div class="card_button_image_box image_box">
                            <img src="img/icons/Freeze-icon.svg" alt="" class="card_button_img">
                        </div>
                    </a>
                    <a href="#" class="payment-settings_button card_button">
                        <p>Скрыть</p>
                        <div class="card_button_image_box image_box">
                            <img src="img/icons/Invisible-icon.svg" alt="" class="card_button_img">
                        </div>
                    </a>
                </div>
                
            </article>

        </section>
    </main>

<!-- </body>
</html> -->