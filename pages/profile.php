<?php
    if(!isset($_SESSION['USER'])) {
        // $_SESSION['errors'][] = "Тебе туда нельзя";
        header('Location: ./?page=404');
    }
?>
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

<div class="popup popup_news">
    <div class="popup_body">
        <div class="popup_container">
            <div class="popup_header">
                <img src="img/cards/Group-135.png" alt="">
            </div>
            <div class="popup_text-content">
                <div class="popup_text-header">
                    <h1>Заголовк</h1>
                    <p class="date_publication">
                        12.04.2023
                    </p>
                </div>
                
                <div class="description">
                    <p class="description-item">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Harum facere odio perspiciatis asperiores amet unde natus corrupti veniam corporis, aperiam, voluptatum nihil dolorem numquam vel quasi magni voluptatem ipsa eligendi!
                    Assumenda non itaque natus, dignissimos quisquam id et neque suscipit rem animi minima facilis voluptatem sunt maxime in ad expedita, fugiat saepe magni nostrum modi ratione corporis quos! Laborum, consequatur!
                    </p>
                    <p class="description-item">
                    Sed cum rerum odit, animi, aperiam libero at itaque fuga in illo quisquam dicta nobis earum nemo blanditiis dolor dolorem ut quibusdam necessitatibus ducimus et? Laboriosam enim rerum blanditiis autem?
                    Eos, nihil iste eligendi officia explicabo labore magnam ipsam a provident perspiciatis autem cupiditate dolorum nemo doloremque quis dignissimos ducimus fugiat voluptate inventore eius dolor voluptas pariatur? Soluta, facilis? Sunt.
                    </p>
                    <p class="description-item">
                    Fugit quisquam beatae corrupti doloremque laudantium eum quaerat quae praesentium voluptates ex quas rem quibusdam consectetur, quasi suscipit, fugiat dicta, id consequatur! Doloribus optio molestias, saepe inventore voluptatem recusandae veritatis.
                    </p>
                </div>
            </div>
        </div>
        <div class="popup_area"></div>
    </div>
</div>
<main>
    <?php 
        if($user['role'] === 'user') {
            require('pages/get_user-info.php');
        } elseif($user['role'] === 'admin') {
            require('pages/get_admin-info.php');
        } elseif($user['role'] === 'curier') {
            require('pages/get_curier-info.php');
        } else {
            
        }
    
    ?>
</main>
