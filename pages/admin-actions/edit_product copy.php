<?php
    if(!isset($_SESSION['USER'])) {
        if($user['role'] !== 'admin') {
            // $_SESSION['errors'][] = "Тебе туда нельзя";
            header('Location: ./?page=404');
        }
    }
?>
<?php
    if(isset($_GET['edit_id'])) {
        $id_product = $_GET['edit_id'];

        $product_info = $database->query("SELECT * FROM `bank_card-product` WHERE `id_product` = '$id_product'")->fetch(PDO::FETCH_ASSOC);
        $product_category = $database->query("SELECT * FROM `bank_card-category` WHERE `id_card-category` = {$product_info['id_category']}")->fetch(PDO::FETCH_ASSOC);
        $product_designs = $database->query("SELECT * FROM `bank_card_image-path` WHERE `id_card` = '$id_product'")->fetch(PDO::FETCH_ASSOC);

    }

?>
<!-- <script type="text/javascript" src="js/loadImages_PAST.js" defer></script> -->
<script type="text/javascript" src="js/loadDataProduct.js" defer></script>
<div class="create_container container">
    <div class="create_block edit_product">
        <h2>Редактирование продукта</h2>
        <form action="actions/edit_product.php/?edit_id=<?php echo $id_product ?>" enctype="multipart/form-data" method="POST" id="upload-container" name="edit_product" class="edit_product">
            <div class="inputs_container">
                <div class="text-content">
                    <div class="card_input_box">
                        <p class="input_title">Наименование</p>
                        <input value="<?php echo $product_info['name'] ?>" type="text" name="name" id="product_edit_input_name" class="input_style card_form_input" placeholder="Введите наименование карты"> 
                    </div>
                    <div class="card_input_box">
                        <p class="input_title">Описание</p>
                        <textarea name="description" id="product_edit_input_description" class="input_style card_form_input" placeholder="Введите описание карты"><?php echo $product_info['description'] ?></textarea> 
                    </div>
                    <div class="card_input_box">
                        <p class="input_title">Категория</p>
                        <div class="select">
                            <div class="select__header">
                                <input value="<?php echo $product_category['name'] ?>" type="text" name="category" id="product_edit_input_category" class="select__current card_form_input" placeholder="Выберите категорию" readonly>
                                <div class="select__icon arrow_image-box">
                                    <svg class="arrow_img" width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.83824 1.62443L5.32362 5.1609C5.10794 5.37791 4.75827 5.37791 4.54259 5.1609L1.02797 1.62443C0.812292 1.40741 0.812292 1.05556 1.02797 0.838543C1.24364 0.621527 1.59332 0.621527 1.809 0.838543L4.60959 3.65655L5.25662 3.65655L8.05722 0.838543C8.27289 0.621527 8.62257 0.621527 8.83824 0.838543C9.05392 1.05556 9.05392 1.40741 8.83824 1.62443Z" fill="black"/>
                                    </svg>
                                        
                                </div>
                            </div>
                        
                            <div class="select__body">
                                <?php
                                    $categories = $database->query("SELECT * FROM `bank_card-category`")->fetchAll(PDO::FETCH_ASSOC);

                                    foreach($categories as $item) {
                                        echo '<div value="'.$item['id_card-category'].'" class="select__item">'.$item['name'].'</div>';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="card_input_box">
                        <p class="input_title">Тип карты</p>
                        <div class="select">
                            <div class="select__header">
                                <input value="<?php echo $product_info['type_card'] ?>" type="text" name="type_card" id="product_edit_input_type-card" class="select__current card_form_input" placeholder="Выберите тип карты" readonly>
                                <div class="select__icon arrow_image-box">
                                    <svg class="arrow_img" width="9" height="6" viewBox="0 0 9 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.83824 1.62443L5.32362 5.1609C5.10794 5.37791 4.75827 5.37791 4.54259 5.1609L1.02797 1.62443C0.812292 1.40741 0.812292 1.05556 1.02797 0.838543C1.24364 0.621527 1.59332 0.621527 1.809 0.838543L4.60959 3.65655L5.25662 3.65655L8.05722 0.838543C8.27289 0.621527 8.62257 0.621527 8.83824 0.838543C9.05392 1.05556 9.05392 1.40741 8.83824 1.62443Z" fill="black"/>
                                    </svg>
                                        
                                </div>
                            </div>
                        
                            <div class="select__body">
                                <div class="select__item">Дебетовая</div>
                                <div class="select__item">Кредитная</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="image-content">
                    <div class="preview_image">
                        <div class="images">
                            <div class="view-image image_box">
                                <img src="<?=$product_info['preview_image']?>" alt="" class="view_image">
                            </div>
                            <div class="view-image image_box">
                                <img src="<?=$product_designs['image-path']?>" alt="" class="view_image">
                            </div>
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
                        </div>
                        <!-- <div class="card_input_box">
                            <p class="input_title">Основное изображение</p>
                            <input type="file" name="preview_img" id="product_edit_input_preview-img" class="input_style card_form_input"> 
                        </div> -->
                        <!-- Область для перетаскивания -->
                        <div id="drop-files" class="drop-files" ondragover="return false">
                            
                            <label id="frm" class="frm input-file">
                                <div class="image-content">
                                    <div class="image_box">
                                        <?php icons('upload', 80, 'var(--other-text-color)')?>
                                    </div>
                                    <p>Перетащите изображение сюда</p>
                                    
                                </div>
                                <input type="file" id="uploadbtn" class="uploadbtn card_form_input" multiple="" name="image_path[]">
                                <!-- <input type="file" id="uploadbtn" name="file" multiple=""> -->
                                
                            </label>
                        </div>
                        <!-- <label id="frm" class="frm input-file">
                            
                            <span class="input-file-btn ">Выберите файл</span>           
                            <span class="input-file-text">Максимум 1 файл</span>
                        </label> -->
                        <!-- Область предпросмотра -->
                        
                        <!-- Список загруженных файлов -->
                        <div id="file-name-holder" class="file-name-holder">
                            <ul id="uploaded-files" class="uploaded-files" style="display: none;">
                                <h1>Загруженные файлы</h1>
                            </ul>
                        </div>
                    </div>
                    <div class="front-content">
                        
                        <!-- <div class="card_input_box">
                            <p class="input_title">Виды дизайна</p>
                            <input type="file" name="design_images[]" multiple id="product_edit_input_design-images" class="input_style card_form_input" > 
                        </div> -->
                    </div>
                </div>
            </div>
            <button class="button-form button_style" name="edit_product">Изменить</button>
        </form>
        <a href="?page=main_page" class="close">Вернуться</a>
    </div>
    
</div>