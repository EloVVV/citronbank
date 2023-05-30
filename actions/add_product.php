<?php
session_start();

require('../database/database.php');
global $database;

unset($_SESSION['errors']);
$_SESSION['errors'] = [];


if(isset($_POST)) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $type_card = $_POST['type_card'];


    // Присваивание условному секлектору ID категории
    $category_card_id;
    $query_category_card = $database->query("SELECT * FROM `bank_card-category`")->fetchAll(PDO::FETCH_ASSOC);

    foreach($query_category_card as $id_card) {
        if($category === $id_card['name']) $category_card_id = $id_card['id_card-category'];
    }

    // Перестраивание массива файлов

    $files = array();

    foreach($_FILES['design_images'] as $k => $l) {
        foreach($l as $i => $v) {
            $files[$i][$k] = $v;
        }
    }
    $_FILES['design_images'] = $files;

    // ----

    if(empty($name)
    || empty($description)
    || empty($category)
    || empty($type_card)) $_SESSION['errors'][] = "Вы не заполнили все строки";

    $getPreviewFile = $_FILES['preview_img']['name'];
    $getDesignFile = $_FILES['design_images'];

    if(empty($getPreviewFile) || empty($getDesignFile)) {
        $_SESSION['errors'][] = "Не были загружены файлы продукта";
    }

    if(count($_SESSION['errors']) === 0) {
        $file_name = $_FILES["preview_img"]["name"];
        $tmp_name = $_FILES["preview_img"]["tmp_name"];
        
        $preview_time = time();
        $object_img = '../img/cards/SinglePage/Adding/'.$preview_time.'_'.$file_name;
        $load_preview_img = 'img/cards/SinglePage/Adding/'.$preview_time.'_'.$file_name;

        move_uploaded_file($tmp_name, $object_img);
        
        $product_arr = [
            'name'=>$name,
            'description'=>$description,
            'category'=>$category_card_id,
            'type_card'=>$type_card,
            'preview_image'=>$load_preview_img,
        ];

        $insert_product = $database->prepare("INSERT INTO `bank_card-product` 
        (`name`, `description`, `preview_image`, `id_category`, `type_card`) 
        VALUES (:name, :description, :preview_image, :category, :type_card)");

        $insert_product->execute($product_arr);
        $insert_product->fetch(PDO::FETCH_ASSOC);

        $product_id = $database->lastInsertId();

        for($i = 0; $i < count($_FILES['design_images']); $i++) {
            $files_names = $_FILES['design_images'][$i]['name'];
            $tmp_name = $_FILES['design_images'][$i]['tmp_name'];

            $images_time = time();
            $objects_img = '../img/cards/CardIcon/Adding/'.$images_time.'_'.$files_names;
            $load_images = 'img/cards/CardIcon/Adding/'.$images_time.'_'.$files_names;
            
            
            // $objects_img = .time().$_FILES['design_images'][$i]['name'];
            // $load_images = .$images_time.$files_names;

            move_uploaded_file($tmp_name, $objects_img);

            $images_arr = [
                'image_path'=>$load_images,
                'id_card'=>$product_id,
            ];
    
            $insert_images_product = $database->prepare("INSERT INTO `bank_card_image-path`
            (`image-path`, `id_card`)
            VALUES (:image_path, :id_card)");

            $insert_images_product->execute($images_arr);
            $insert_images_product->fetch(PDO::FETCH_ASSOC);
        }

       
        header('Location: ../?page=debit_cards');
    }
}

header('Location: ../?page=create_product');