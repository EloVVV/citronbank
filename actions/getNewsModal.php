<?php
    session_start();

    require('../database/database.php');
    require('../pages/utils/number_format.php');
    require('../pages/components/icons.php');
    
    global $database;

    if(isset($_GET['id'])) {

        $newsInfo = $database->query("SELECT * FROM `bank_news` WHERE `newsID`={$_GET['id']}")->fetch(PDO::FETCH_ASSOC);
        // var_dump($newsInfo);
        echo '
        <div class="popup_header">
            <img src="'.$newsInfo['image_path'].'" alt="">
        </div>
        <div class="popup_text-content">
            <div class="popup_text-header">
                <h1>'.$newsInfo['title'].'</h1>
                <p class="date_publication">
                    '.date('d.m.Y', strtotime($newsInfo['created_at'])).'
                </p>
            </div>
            
            <div class="description">
                
                <p class="description-item">
                '.str_replace("\n","<br>",$newsInfo['description']).'
                </p>
               
            </div>
        </div>
        ';
    }

?>


<!-- <p class="description-item">
Sed cum rerum odit, animi, aperiam libero at itaque fuga in illo quisquam dicta nobis earum nemo blanditiis dolor dolorem ut quibusdam necessitatibus ducimus et? Laboriosam enim rerum blanditiis autem?
Eos, nihil iste eligendi officia explicabo labore magnam ipsam a provident perspiciatis autem cupiditate dolorum nemo doloremque quis dignissimos ducimus fugiat voluptate inventore eius dolor voluptas pariatur? Soluta, facilis? Sunt.
</p>
<p class="description-item">
Fugit quisquam beatae corrupti doloremque laudantium eum quaerat quae praesentium voluptates ex quas rem quibusdam consectetur, quasi suscipit, fugiat dicta, id consequatur! Doloribus optio molestias, saepe inventore voluptatem recusandae veritatis.
</p> -->


