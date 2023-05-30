<?php
    if(!isset($_SESSION['USER'])) {
        if($user['role'] !== 'admin') {
            // $_SESSION['errors'][] = "Тебе туда нельзя";
            header('Location: ./?page=404');
        }
    }
?>
<link rel="stylesheet" href="css/dropInBoxStyles.css">
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
                <!-- <div class="card_input_box">
                    <p class="input_title">Основное изображение</p>
                    <input type="file" name="preview_img" id="create_product_input_preview-img" class="input_style card_form_input"> 
                </div> -->

                <!-- <div class="content">
                    
                    
                </div> -->
                <!-- Область для перетаскивания -->
                <!-- <div id="drop-files" ondragover="return false">
                    
                    <label class="input-file">
                        <div class="image-content">
                            <div class="image_box">
                                <?php icons('upload', 80, 'var(--other-text-color)')?>
                            </div>
                            <p>Перетащите изображение сюда</p>
                        </div>
                                            
                    </label>
                </div> -->

                <div id="drop-files" class="drop-files" ondragover="return false">
                            
                    <label id="frm" class="frm input-file">
                        <div class="image-content">
                            <div class="image_box">
                                <?php icons('upload', 80, 'var(--other-text-color)')?>
                            </div>
                            <p>Перетащите изображение сюда</p>
                            
                        </div>
                        <input type="file" id="uploadbtn" class="input-file file uploadbtn card_form_input" name="image_path">
                        <!-- <input type="file" id="uploadbtn" name="file" multiple=""> -->
                        
                    </label>
                </div>
                <!-- <label id="frm" class="input-file">
                    <input type="file" id="uploadbtn" name="image_path">
                    <span class="input-file-btn ">Выберите файл</span>           
                    <span class="input-file-text">Максимум 1 файл</span>
                </label> -->
                <!-- Область предпросмотра -->
                <!-- <div id="uploaded-holder"> 
                    <div id="dropped-files">
                        <div id="upload-button">
                            <center>
                                <span>0 Файлов</span>
                                <a href="#" class="upload">Загрузить</a>
                                <a href="#" class="delete">Удалить</a>
                                <div id="loading">
                                    <div id="loading-bar">
                                        <div class="loading-color"></div>
                                    </div>
                                    <div id="loading-content"></div>
                                </div>
                            </center>
                        </div>  
                    </div>
                </div> -->
                <div id="uploaded-holder" class="uploaded-holder"> 
                    <div id="dropped-files" class="dropped-files">
                        <!-- Кнопки загрузить и удалить, а также количество файлов -->
                        <div id="upload-button" id="upload-button">
                            <center>
                                <span>0 Файлов</span>
                                <a href="#" class="upload">Загрузить</a>
                                <a href="#" class="delete">Удалить все</a>
                                <!-- Прогресс бар загрузки -->
                                <div id="loading" class="loading">
                                    <div id="loading-bar" class="loading-bar">
                                        <div class="loading-color"></div>
                                    </div>
                                    <div id="loading-content" class="loading-content"></div>
                                </div>
                            </center>
                        </div>  
                    </div>
                </div>

                <!-- Список загруженных файлов -->
                <!-- <div id="file-name-holder">
                    <ul id="uploaded-files" style="display: none;">
                        <h1>Загруженные файлы</h1>
                    </ul>
                </div> -->
                <div id="file-name-holder" class="file-name-holder">
                    <ul id="uploaded-files" class="uploaded-files" style="display: none;">
                        <h1>Загруженные файлы</h1>
                    </ul>
                </div>
                
               
            </div>
            <button class="button-form button_style" name="create_product">Добавить</button>
        </form>
        <a href="?page=main_page" class="close">Вернуться</a>
    </div>
    
</div>