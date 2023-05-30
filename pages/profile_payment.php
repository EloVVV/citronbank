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

<div class="popup popup_operation">
    <div class="popup_body">
        <div class="popup_container">
            <div class="popup_header">
                <p class="header_title">
                    Платёж от:
                </p>
                <p class="header_date">
                    12.10.2022 12:13:00
                </p>
            </div>
            <div class="popup_content">
                <div class="popup_main_info">
                    <div class="transaction_block">
                        <div class="transaction_image-box">
                            <img src="img/profile/Glass_Logo_Render-5.png" alt="" class="transacton_image">
                        </div>
                        <p class="transaction_company_name">
                            Пятёрочка
                        </p>
                        <p class="transaction_category">
                            Супермаркеты
                        </p>
                    </div>
                    <div class="transaction_price">
                        379 ₽
                    </div>
                </div>
                <div class="popup_card_info">
                    <p class="popup_card-title">
                        Покупка с карты:
                    </p>
                    <div class="popup_card_content">
                        <div class="card_info_box">
                            <div class="card_info_image-box">
                                <img src="img/cards/On-Front/Glass-Card_Front-view-19.png" alt="" class="card_info_image">
                            </div>
                            <div class="card_info_box_text-content">
                                <p class="card_info_category">
                                    Дебетовая карта
                                </p>
                                <p class="card_info_name">
                                    Citron Карта
                                </p>
                            </div>
                        </div>
                        <div class="transaction_info_box">
                            <p class="transaction_date">
                                12.20.2022
                            </p>
                            <p class="transaction_value">
                                349 ₽
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="popup_area"></div>
    </div>
</div>

<?php
    if(!isset($_SESSION['USER'])) {
        // $_SESSION['errors'][] = "Тебе туда нельзя";
        header('Location: ./?page=404');
    }
?>
    <main>
        <section class="payment_info_block">
            <div class="payment_info_block_container container">
                <?php require('actions/get_payment-header-content.php')?>
            </div>
        </section>
        <section class="events_payment">
            <div class="events_payment_container container">
                <h2>События</h1>
                <div class="events_payment_search">
                    <div class="events_payment_calendar">
                        <div class="swiper events_payment_calendar-swiper">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                              <!-- Slides -->
                              <div class="swiper-slide">
                                <div class="events_payment_calendar_icon_box">
                                    <svg class="calendar-icon" width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 9H4V11H6V9ZM10 9H8V11H10V9ZM14 9H12V11H14V9ZM16 2H15V0H13V2H5V0H3V2H2C0.89 2 0.00999999 2.9 0.00999999 4L0 18C0 18.5304 0.210714 19.0391 0.585786 19.4142C0.960859 19.7893 1.46957 20 2 20H16C17.1 20 18 19.1 18 18V4C18 2.9 17.1 2 16 2ZM16 18H2V7H16V18Z" fill="black"/>
                                    </svg>
                                </div>
                                <p>Январь</p>
                              </div>
                              <div class="swiper-slide">
                                <div class="events_payment_calendar_icon_box">
                                    <svg class="calendar-icon" width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 9H4V11H6V9ZM10 9H8V11H10V9ZM14 9H12V11H14V9ZM16 2H15V0H13V2H5V0H3V2H2C0.89 2 0.00999999 2.9 0.00999999 4L0 18C0 18.5304 0.210714 19.0391 0.585786 19.4142C0.960859 19.7893 1.46957 20 2 20H16C17.1 20 18 19.1 18 18V4C18 2.9 17.1 2 16 2ZM16 18H2V7H16V18Z" fill="black"/>
                                    </svg>
                                </div>
                                <p>Февраль</p>
                              </div>
                              <div class="swiper-slide">
                                <div class="events_payment_calendar_icon_box">
                                    <svg class="calendar-icon" width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 9H4V11H6V9ZM10 9H8V11H10V9ZM14 9H12V11H14V9ZM16 2H15V0H13V2H5V0H3V2H2C0.89 2 0.00999999 2.9 0.00999999 4L0 18C0 18.5304 0.210714 19.0391 0.585786 19.4142C0.960859 19.7893 1.46957 20 2 20H16C17.1 20 18 19.1 18 18V4C18 2.9 17.1 2 16 2ZM16 18H2V7H16V18Z" fill="black"/>
                                    </svg>
                                </div>
                                <p>Март</p>
                              </div>
                            </div>

                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>

                        </div>
                       
                    </div>
                    <div class="events_payment_input_block">
                        <div class="events_payment_input_icon_box">
                            <img src="img/icons/search-icon.svg" alt="" class="search-icon">
                        </div>
                        <input type="text" class="events_payment_input" placeholder="Найди любые события или операции">
                    </div>
                </div>
                <div class="events_payment_content">
                    <div class="events_payment_filter">
                        <a href="#" class="events_filter_link">Доходы</a>
                        <a href="#" class="events_filter_link">Расходы</a>
                    </div>
                    <div class="last-statistic_content">
                        <div class="last-statistic_box">
                            <div class="statistic_header">
                                <p>Сегодня</p>
                            </div>
                            <div class="statistic_info_box">
                                <a href="#" class="statistic">
                                    <div class="statistic_image_box image_box">
                                        <img src="img/statistic/magint.png" alt="" class="statistic_image">
                                    </div>
                                    <div class="statistic_text-content">
                                        <div class="statistic_upper-text-content">
                                            <p class="statistic-info_type">
                                                Дебетовая карта
                                            </p>
                                            <div class="statistic-info_price">
                                                54,24
                                            </div>
                                        </div>
                                        <div class="statistic_bottom-text-content">
                                            <p class="statistic-info_name">
                                                Магнит
                                            </p>
                                            <p class="statistic-info_category">
                                                Категория
                                            </p>
                                        </div>

                                    </div>
                                </a>
                            </div>
                        </div>

                        <a href="#" class="more-statistic_button">
                            <p>Показать ещё</p>
                            <div class="more-statistic-icon-box">
                                <svg class="arrow-icon" width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M8.83824 1.62443L5.32362 5.1609C5.10794 5.37791 4.75827 5.37791 4.54259 5.1609L1.02797 1.62443C0.812292 1.40741 0.812292 1.05556 1.02797 0.838543C1.24364 0.621527 1.59332 0.621527 1.809 0.838543L4.60959 3.65655L5.25662 3.65655L8.05722 0.838543C8.27289 0.621527 8.62257 0.621527 8.83824 0.838543C9.05392 1.05556 9.05392 1.40741 8.83824 1.62443Z" fill=""/>
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

<!-- </body>
</html> -->