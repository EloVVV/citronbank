<?php
    if(!isset($_SESSION['USER'])) {
        if($user['role'] !== 'admin') {
            // $_SESSION['errors'][] = "Тебе туда нельзя";
            header('Location: ./?page=404');
        }
    }
?>
<div class="create_container container">
    <div class="create_block">
        <h2>Создание категории</h2>
        <form action="actions/add_category.php" enctype="multipart/form-data" method="POST" name="create_product">
            <div class="inputs_container">
                <div class="card_input_box">
                    <p class="input_title">Наименование</p>
                    <input type="text" name="name" id="create_category_input_name" class="input_style card_form_input" placeholder="Введите наименование категории"> 
                </div>
            </div>
            <button class="button-form button_style" name="create_product">Создать</button>
        </form>
        <a href="?page=main_page" class="close">Вернуться</a>
    </div>
    
</div>