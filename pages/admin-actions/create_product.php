<?php
    if(!isset($_SESSION['USER'])) {
        if($user['role'] !== 'admin') {
            // $_SESSION['errors'][] = "Тебе туда нельзя";
            header('Location: ./?page=404');
        }
    }
?>
<div class="create_container edit_product container">
    <div class="create_block">
        <h2>Создание продукта</h2>
        <form action="actions/add_product.php" enctype="multipart/form-data" method="POST" name="create_product">
            <div class="inputs_container">
                <div class="text-content">
                    <div class="card_input_box">
                        <p class="input_title">Наименование</p>
                        <input type="text" name="name" id="create_product_input_name" class="input_style card_form_input" placeholder="Введите наименование карты"> 
                    </div>
                    <div class="card_input_box">
                        <p class="input_title">Описание</p>
                        <textarea name="description" id="create_product_input_description" class="input_style card_form_input" placeholder="Введите описание карты"></textarea> 
                    </div>
                    <div class="card_input_box">
                        <p class="input_title">Категория</p>
                        <div class="select">
                            <div class="select__header">
                                <input type="text" name="category" id="create_product_input_category" class="select__current" value="" placeholder="Выберите категорию" readonly>
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
                                <input type="text" name="type_card" id="create_product_input_type-card" class="select__current" value="" placeholder="Выберите тип карты" readonly>
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
                    <div class="actions_block">
                        <button class="button-form button_style" name="create_product">Создать</button>
                        <a href="?page=main_page" class="close">Вернуться</a>
                    </div>
                </div>
                <div class="image-content">
                    <div class="preview_image">
                        <div class="images">
                            <div class="view-image image_box">
                                <img src="img/cards/SinglePage/Original/default.png" alt="" class="view_image">
                            </div>
                            
                            <label class="input-file">
                                <input type="file" name="preview_img">		
                                <span>Выберите файл</span>
                            </label>
                        </div>
                        <div class="images">
                            <div class="view-image image_box">
                                <img src="img/cards/CardIcon/Original/default.png" alt="" class="view_image">
                            </div>
                            <label class="input-file">
                                <input type="file" name="design_images[]">		
                                <span>Выберите файл</span>
                            </label>
                        </div>
                    </div>

                </div>
                
            </div>
           
        </form>
        
    </div>
    
</div>

<!-- <div class="card_input_box">
    <p class="input_title">Демонстрационное изображение</p>
    <label class="input-file">
        <input type="file" name="preview_img">		
        <span>Выберите файл</span>
    </label>
</div>
<div class="card_input_box">
    <p class="input_title">Вид спереди</p>
    <label class="input-file">
        <input type="file" name="design_images[]">		
        <span>Выберите файл</span>
    </label>
</div> -->