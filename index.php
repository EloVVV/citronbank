<?php
    session_start();
    require("database/database.php"); 
    global $database;

    require('pages/utils/number_format.php');
    require('pages/components/icons.php');
    require('pages/utils/updateCapital.php');

    
    
    

    if(isset($_GET['delete_card'])) {
        $id_product = $_GET['delete_card'];
    
        $database->query("DELETE FROM `bank_card_image-path` WHERE `id_card` = '$id_product'")->fetch(PDO::FETCH_ASSOC);
    
        $product = [
            'id_product'=>$id_product,
        ];
    
        $delete = $database->prepare("DELETE FROM `bank_card-product` WHERE `id_product` = :id_product");
        $delete->execute($product);
    
        header('Location: ?page=debit_cards');
        
    }    

    if(isset($_GET['delete_category'])) {
        unset($_SESSION['errors']);
        $_SESSION['errors'] = [];
        $id_category = $_GET['delete_category'];

        $query_cards = $database->query("SELECT * FROM `bank_card-product` WHERE `id_category` = '$id_category'")->fetchAll(PDO::FETCH_ASSOC);
        
        if($query_cards == '') {
            $query_cards = [];
        }


        if(!empty($query_cards)) $_SESSION['errors'][] = "Сначала нужно удалить продукты, имеющие эту категорию";


    
        if(count($_SESSION['errors']) === 0) {
            $category = [
                'id_category'=>$id_category,
            ];
        
            $delete = $database->prepare("DELETE FROM `bank_card-category` WHERE `id_card-category` = :id_category");
            $delete->execute($category);

            header('Location: ?page=debit_cards');
        }
    }  

    if(isset($_GET['ban'])) {
        $id_user = $_GET['ban'];
    
        $database->query("UPDATE `bank_users` SET `status`='banned' WHERE id_user = '$id_user'")->fetch(PDO::FETCH_ASSOC);
        header('Location: ?page=profile');
    }
    if(isset($_GET['unban'])) {
        $id_user = $_GET['unban'];
    
        $database->query("UPDATE `bank_users` SET `status`='default' WHERE id_user = '$id_user'")->fetch(PDO::FETCH_ASSOC);
        header('Location: ?page=profile');
    }
    
    if(isset($_SESSION['errors'])) {
        if($_SESSION['errors'] === NULL) {

        } else {
            if(count($_SESSION['errors']) !== 0) {
                echo '<div class="error_message_block">';
                foreach ($_SESSION['errors'] as $error) {
                    echo '
                        <div class="error_message">
                        '.$error.'
                        </div>     
                    ';
                }
                echo '</div>';
            }
        }
    }
   
    
    if(isset($_SESSION['errors'])) unset($_SESSION['errors']);

    if(isset($_SESSION['USER'])) {
        $user = $database->query("SELECT * FROM `bank_users` WHERE `id_user` = '{$_SESSION['USER']}'")->fetch(PDO::FETCH_ASSOC);
        $id_user = $user['id_user'];

        if(isset($_REQUEST['do'])) {
            if($_REQUEST['do'] == 'exit') {
                session_unset();
            }
        }
    }

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/ico/Citron-Bank_Emblem-Logotype.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    
    
    <script src="js/script.js" defer></script>
    <script src="js/selectbox.js" defer></script>
    <script src="js/swiper.js" defer></script>
    <script src="js/accordion.js" defer></script>

    <title>Citron Bank</title>
</head>
<body>
    <?php
       

         // http://www.cbr.ru/scripts/XML_daily.asp?date_req=02/03/2002
        // $url = "http://www.cbr.ru/scripts/XML_daily.asp?date_req=02/03/2002";

        // function get_currency($currency_code, $format) {

        //     $date = date('d/m/Y'); // Текущая дата
        //     $cache_time_out = 14400; // Время жизни кэша в секундах
        
        //     $file_currency_cache = './currency.xml'; // Файл кэша
        
        //     if(!is_file($file_currency_cache) || filemtime($file_currency_cache) < (time() - $cache_time_out)) {
        
        //         $ch = curl_init();
        
        //         curl_setopt($ch, CURLOPT_URL, 'https://www.cbr.ru/scripts/XML_daily.asp?date_req='.$date);
        //         curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        //         curl_setopt($ch, CURLOPT_HEADER, 0);
        
        //         $out = curl_exec($ch);
        
        //         curl_close($ch);
        
        //         file_put_contents($file_currency_cache, $out);
        
        //     }
        
        //     $content_currency = simplexml_load_file($file_currency_cache);
            
        //     return $content_currency->xpath('Valute[CharCode="'.$currency_code.'"]')[0];
        //     // return number_format(str_replace(',', '.', $content_currency->xpath('Valute[CharCode="'.$currency_code.'"]')[0]->Value), $format);
        
        // }

        // echo get_currency('USD', 1)->Value;
        
        require('pages/components/header.php');
        if(isset($_GET['page'])) {
            if($_GET['page'] == '404') require('pages/warning.php');

            if($_GET['page'] == 'admin') require('pages/admin-actions/admin-auth.php');
            if($_GET['page'] == 'user') require('pages/admin-actions/user-page.php');
            
            if($_GET['page'] == 'profile') require('pages/profile.php');
            if($_GET['page'] == 'settings') require('pages/user_settings.php');
            if($_GET['page'] == 'payment') require('pages/profile_payment.php');
            if($_GET['page'] == 'payment-info') require('pages/profile_payment-info.php');
            if($_GET['page'] == 'payment-settings') require('pages/profile_payment-settings.php');
            if($_GET['page'] == 'registration') require('pages/registration.php');
            if($_GET['page'] == 'authentication') require('pages/authentication.html');

            if($_GET['page'] == 'debit_cards') require('pages/debit_cards.php');
            if($_GET['page'] == 'currency') require('pages/currencyPage.php');
            if($_GET['page'] == 'credit_cards') require('pages/credit_cards.php');
            
            if($_GET['page'] == 'card_page') require('pages/card_page.php');
            if($_GET['page'] == 'profile_card') require('pages/profile_card.php');

            if($_GET['page'] == 'main_page') require('pages/home.php');

            if($_GET['page'] == 'create_product') require('pages/admin-actions/create_product.php');
            if($_GET['page'] == 'create_category') require('pages/admin-actions/create_category.php');
            if($_GET['page'] == 'create-news') require('pages/admin-actions/createNewsPage.php');
            
            if($_GET['page'] == 'transaction_for_card') require('pages/user-actions/transaction-card.php');
            if($_GET['page'] == 'transaction_for_payment') require('pages/user-actions/transaction-payment.php');
            
            if($_GET['page'] == 'createPayment') require('pages/user-actions/createPayment-page.php');
            if($_GET['page'] == 'orderCard') require('pages/user-actions/orderCard-page.php');
            if($_GET['page'] == 'addPasportData') require('pages/user-actions/addPasportData-page.php');

            if($_GET['page'] == 'edit_card') require('pages/admin-actions/edit_product.php');
            if($_GET['page'] == 'edit_category') require('pages/admin-actions/edit_category.php');

            // if($_GET['page'] == 'edit_category') require('pages/edit_category.php');
        } else {
            require('pages/home.php');
        }

        require('pages/components/footer.html');


    
    ?>
    <script src="js/jquery-2.2.4.js"></script>
    <script src="js/jquery.maskedinput.min.js"></script>
    <link
    rel="stylesheet"
    href="css/swiper-bundle.min.css"
    />
    <script src="js/swiper-bundle.min.js"></script>
    <script src="js/popup.js" defer></script>
    <!-- <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
    />

    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script> -->
</body>
</html>