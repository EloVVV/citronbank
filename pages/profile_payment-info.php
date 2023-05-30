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
        <section class="payment_info_block payment-info_info-block">
            <div class="payment_info_block_container container">
                <?php require('actions/get_payment-header-content.php')?>
                <div class="payment-info_info-content">
                    <div class="payment-info_bank-info">
                        <div class="payment-info_info-box">
                            <p class="info-title">
                                Номер договора:
                            </p>
                            <div class="info-description">
                                0000 0000
                            </div>
                        </div>
                        <div class="payment-info_info-box">
                            <p class="info-title">
                                Банк-получатель:
                            </p>
                            <div class="info-description">
                                0000 0000
                            </div>
                        </div>
                        <div class="payment-info_info-box">
                            <p class="info-title">
                                Корр. счёт:
                            </p>
                            <div class="info-description">
                                0000 0000
                            </div>
                        </div>
                        <div class="payment-info_info-box">
                            <p class="info-title">
                                БИК:
                            </p>
                            <div class="info-description">
                                0000 0000
                            </div>
                        </div>
                    </div>

                    <div class="payment-info_user-info">
                        <div class="payment-info_info-box">
                            <p class="info-title">
                                Номер лицевого счёта:
                            </p>
                            <div class="info-description">
                                0000 0000
                            </div>
                        </div>
                        <div class="payment-info_info-box">
                            <p class="info-title">
                                Получатель:
                            </p>
                            <div class="info-description">
                                0000 0000
                            </div>
                        </div>
                        <div class="payment-info_info-box">
                            <p class="info-title">
                                Дата открытия:
                            </p>
                            <div class="info-description">
                                0000 0000
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>

    </main>
    
<!-- </body>
</html> -->