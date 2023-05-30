<?php
session_start();

require('database/database.php');
global $database;


if($_GET['page'] == 'credit_cards') {
    $link_category = "credit_cards";
}

if($_GET['page'] == 'debit_cards') {
    $link_category = "debit_cards";
}



$query_get_category = $database->query("SELECT * FROM `bank_card-category`")->fetchAll(PDO::FETCH_ASSOC);

echo '
        <a href="?page='.$link_category.'" class="category-link">Все карты</a>
    ';


foreach($query_get_category as $item) {

    if($item['id_card-category'] === 1) {
        $categoryClass = 'hover_category_1';
    } elseif($item['id_card-category'] === 2) {
        $categoryClass = 'hover_category_2';
    } elseif($item['id_card-category'] === 3) {
        $categoryClass = 'hover_category_main';
    } elseif($item['id_card-category'] === 4) {
        $categoryClass = 'hover_category_3';
    } elseif($item['id_card-category'] === 5) {
        $categoryClass = 'hover_category_4';
    } elseif($item['id_card-category'] === 6) {
        $categoryClass = 'hover_category_5';
    } else {
        $categoryClass = 'hover_category_main';
    }

    
    echo '
    <div class="category_box">
        
        ';
            if(isset($_SESSION['USER'])) {
                if($user['role'] === "admin") {
                    echo '
                    <div class="category_actions">
                        <a href="?delete_category='.$item['id_card-category'].'" class="card_action action_img_box delete_action">
                            <svg class="action_icon delete_icon" width="768" height="800" viewBox="0 0 768 800" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M736 144H608V64C608 28.7 579.3 0 544 0H224C188.7 0 160 28.7 160 64V144H32C14.3 144 0 158.3 0 176V208C0 212.4 3.6 216 8 216H68.4L93.1 739C94.7 773.1 122.9 800 157 800H611C645.2 800 673.3 773.2 674.9 739L699.6 216H760C764.4 216 768 212.4 768 208V176C768 158.3 753.7 144 736 144ZM536 144H232V72H536V144Z" fill=""/>
                            </svg>
                        </a>
                        <a href="?page=edit_category&edit_id='.$item['id_card-category'].'" class="card_action action_img_box edit_action">
                            <svg class="action_icon edit_icon" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.8667 4.78672L17.2134 1.13339C16.7366 0.685516 16.1117 0.428533 15.4578 0.411324C14.8039 0.394115 14.1664 0.617881 13.6667 1.04005L1.6667 13.0401C1.23572 13.4747 0.967369 14.0443 0.906696 14.6534L0.333363 20.2134C0.315401 20.4087 0.340742 20.6055 0.407578 20.7899C0.474413 20.9743 0.581099 21.1416 0.720029 21.2801C0.844616 21.4036 0.992371 21.5014 1.15482 21.5677C1.31727 21.6341 1.49122 21.6677 1.6667 21.6667H1.7867L7.3467 21.1601C7.95576 21.0994 8.52541 20.831 8.96003 20.4001L20.96 8.40005C21.4258 7.90801 21.6775 7.2514 21.66 6.5741C21.6425 5.8968 21.3572 5.25406 20.8667 4.78672ZM16.3334 9.24005L12.76 5.66672L15.36 3.00005L19 6.64005L16.3334 9.24005Z" fill=""/>
                            </svg>
                        </a>
                    </div>
                    ';
                }
            }
        echo '
        <a href="?page='.$link_category.'&category='.$item['id_card-category'].'" class="category-link '.$categoryClass.'">'.$item['name'].'</a>
    </div>
    ';
}

if(isset($_SESSION['USER'])) {
    if($user['role'] === "admin") {
        echo '
        <a href="?page=create_category" class="category-link create_category">
            <svg class="plus_icon" width="19" height="20" viewBox="0 0 19 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.38674 0.722656C8.52351 0.722656 7.82372 1.42245 7.82372 2.28568V8.53784H1.57163C0.708397 8.53784 0.00860596 9.23763 0.00860596 10.1009C0.00860596 10.9641 0.708399 11.6639 1.57163 11.6639H7.82372V17.9159C7.82372 18.7792 8.52351 19.479 9.38674 19.479C10.25 19.479 10.9498 18.7792 10.9498 17.9159V11.6639H17.2019C18.0651 11.6639 18.7649 10.9641 18.7649 10.1009C18.7649 9.23763 18.0651 8.53784 17.2019 8.53784H10.9498V2.28568C10.9498 1.42245 10.25 0.722656 9.38674 0.722656Z" fill=""/>
            </svg>
        </a>
        ';
    }
}



