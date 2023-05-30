<?php
session_start();

require('../database/database.php');
global $database;

unset($_SESSION['errors']);
$_SESSION['errors'] = [];



if(isset($_GET['edit_id'])) {
    $id_product = $_GET['edit_id'];
    // $product_info = $database->query("SELECT * FROM `bank_card-product` WHERE `id_product` = '$id_product'")->fetch(PDO::FETCH_ASSOC);
    if(isset($_POST)) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $type_card = $_POST['type_card'];
        $past_images = [];
        // Поиск ранее загруженных фотографий
        $query_preview_img = $database->query("SELECT * FROM `bank_card-product` WHERE `id_product`='$id_product'")->fetch(PDO::FETCH_ASSOC);
        $past_preview_img = $query_preview_img['preview_image'];

        $query_images = $database->query("SELECT * FROM `bank_card_image-path` WHERE `id_card`='$id_product'")->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($query_images as $img) {
            $past_images[] = $img['image-path'];
        }

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

        var_dump($_FILES);
        var_dump($_FILES['design_images']);
    
        // ----
    
        if(empty($name)
        || empty($description)
        || empty($category)
        || empty($type_card)) $_SESSION['errors'][] = "Вы не заполнили все строки";
    
        $getPreviewFile = $_FILES['preview_img']['name'];
        $getDesignFile = $_FILES['design_images'];
    

      

    
        if(count($_SESSION['errors']) === 0) {
            $file_name = $_FILES["preview_img"]["name"];
            $tmp_name = $_FILES["preview_img"]["tmp_name"];
            
            $preview_time = time();
            $object_img = '../img/cards/SinglePage/Adding/'.$preview_time.'_'.$file_name;
            if(empty($getPreviewFile)) {
                $load_preview_img = $past_preview_img;
            } else {
                $load_preview_img = 'img/cards/SinglePage/Adding/'.$preview_time.'_'.$file_name;
                move_uploaded_file($tmp_name, $object_img);
            }
            
    
  
            
            $product_arr = [
                'name'=>$name,
                'description'=>$description,
                'category'=>$category_card_id,
                'type_card'=>$type_card,
                'preview_image'=>$load_preview_img,
            ];
    
            $edit_product = $database->prepare("UPDATE `bank_card-product` 
            SET `name`=:name, `description`=:description, `preview_image`=:preview_image, `id_category`=:category, `type_card`=:type_card 
            WHERE `id_product` = '$id_product'");
    
            $edit_product->execute($product_arr);
            $edit_product->fetch(PDO::FETCH_ASSOC);
            
    
            $query_image_path = $database->query("SELECT * FROM `bank_card_image-path` WHERE `id_card`='$id_product'")->fetchALL(PDO::FETCH_ASSOC);
            // var_dump($getDesignFile);
            // var_dump($query_image_path[0]['id_card_image-path']);
            if($getDesignFile[0]['name'] === '') {
                for ($i = 0; $i < count($past_images); $i++) {

                    $load_images = $past_images[$i];

                    $images_arr = [
                        'image_path'=>$load_images,
                        'id_card'=>$id_product,
                    ];
            
                    $edit_images_product = $database->prepare("UPDATE `bank_card_image-path` SET
                    `image-path`=:image_path, `id_card`=:id_card WHERE `id_card_image-path`={$query_image_path[$i]['id_card_image-path']}");
        
                    $edit_images_product->execute($images_arr);
                    $edit_images_product->fetch(PDO::FETCH_ASSOC);

                }
            } else {
                for($i = 0; $i < count($_FILES['design_images']); $i++) {
                    $files_names = $_FILES['design_images'][$i]['name'];
                    $tmp_name = $_FILES['design_images'][$i]['tmp_name'];

                    $images_time = time();
                    $objects_img = '../img/cards/CardIcon/Adding/'.$images_time.'_'.$files_names;
                    
                    // if(empty($getDesignFile)) {
                    //     $load_images = $past_images[$i];
                    // } else {
                    //     $load_images = 'img/cards/CardIcon/Adding/'.$images_time.'_'.$files_names;
                    //     move_uploaded_file($_FILES['design_images'][$i]['tmp_name'], $objects_img);
                    // }

                    $load_images = 'img/cards/CardIcon/Adding/'.$images_time.'_'.$files_names;
                    move_uploaded_file($_FILES['design_images'][$i]['tmp_name'], $objects_img);
                    
        

                    $images_arr = [
                        'image_path'=>$load_images,
                        'id_card'=>$id_product,
                    ];
            
                    $edit_images_product = $database->prepare("UPDATE `bank_card_image-path` SET
                    `image-path`=:image_path, `id_card`=:id_card WHERE `id_card_image-path`={$query_image_path[$i]['id_card_image-path']}");
        
                    $edit_images_product->execute($images_arr);
                    $edit_images_product->fetch(PDO::FETCH_ASSOC);
                }
            }
            
            header('Location: ../../?page=debit_cards');
        } else {
            header('Location: ../../?page=edit_card&edit_id='.$id_product.'');
        }
       
    }
    
}
