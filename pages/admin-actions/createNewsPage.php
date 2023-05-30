<?php
    if(!isset($_SESSION['USER'])) {
        if($user['role'] !== 'admin') {
            // $_SESSION['errors'][] = "Тебе туда нельзя";
            header('Location: ./?page=404');
        }
    }
?>
<!-- <link rel="stylesheet" href="css/dropInBoxStyles.css"> -->
<!-- <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script> -->
<!-- <script type="text/javascript" src="js/loadImages_PAST.js" defer></script> -->
<script type="text/javascript" src="js/loadFileAgain.js" defer></script>
<div class="create_container container">
    <div class="create_block">
        <h2>Добавление новости</h2>
        <form action="actions/createNews.php" enctype="multipart/form-data" method="POST" name="create_product">
            <div class="inputs_container">
                <div class="card_input_box">
                    <p class="input_title">Заголовок</p>
                    <input type="text" name="title" id="create_product_input_name" class="input_style card_form_input" placeholder="Введите наименование карты"> 
                </div>
                <div class="card_input_box">
                    <p class="input_title">Описание</p>
                    <textarea name="description" id="create_product_input_description" class="input_style card_form_input" placeholder="Введите описание карты"></textarea> 
                </div>
                <div class="images">
                    <!-- <div class="view-image image_box">
                        <img src="img/cards/CardIcon/Original/default.png" alt="" class="view_image">
                    </div> -->
                    <label class="input-file">
                        <input type="file" name="image_path">		
                        <span>Выберите файл</span>
                    </label>
                </div>
               
            </div>
            <button class="button-form button_style" name="create_product">Добавить</button>
        </form>
        <a href="?page=main_page" class="close">Вернуться</a>
    </div>
    
</div>