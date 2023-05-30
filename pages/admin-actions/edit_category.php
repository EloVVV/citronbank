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
        $id_category = $_GET['edit_id'];

        $category_info = $database->query("SELECT * FROM `bank_card-category` WHERE `id_card-category` = '$id_category'")->fetch(PDO::FETCH_ASSOC);
    }

?>
<div class="create_container container">
    <div class="create_block">
        <h2>Редактирование категории</h2>
        <form action="actions/edit_category.php/?edit_id=<?php echo $id_category ?>" enctype="multipart/form-data" method="POST" name="edit_product">
        <div class="inputs_container">
                <div class="card_input_box">
                    <p class="input_title">Наименование</p>
                    <input value="<?php echo $category_info['name'] ?>" type="text" name="name" id="category_edit_input_name" class="input_style card_form_input" placeholder="Введите наименование категории"> 
                </div>
            </div>
            <button class="button-form button_style" name="edit_product">Изменить</button>
        </form>
        <a href="?page=main_page" class="close">Вернуться</a>
    </div>
    
</div>