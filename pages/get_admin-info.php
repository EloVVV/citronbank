<?php
    if(!isset($_SESSION['USER'])) {
        // $_SESSION['errors'][] = "Тебе туда нельзя";
        header('Location: ./?page=404');
    }
?>
<section class="statistic">
    <div class="statistic_container container">
        <?php require('actions/get_statistic-info.php')?>
    </div>
</section>
<section class="users">
    <!-- <div class="users_container container">
        <h1>Пользователи</h1>
        <div class="user-info_header">
            <div class="user-info_id">
                ID
            </div>
            <div class="user-info_full-name">
                Имя пользователя
            </div>
            <div class="user-info_number-phone">
                Номер телефона
            </div>
            <div class="user-info_status">
                Статус
            </div>
            <div class="user-info_actions">
                Действия
            </div>
        </div>
        <div class="user-info_content">
            <div class="user-info_id">
                1
            </div>
            <div class="user-info_full-name">
                Имя Фамииля Отчество
            </div>
            <div class="user-info_number-phone">
                +7 900 000 00 00
            </div>
            <div class="user-info_status">
                default
            </div>
            <div class="user-info_actions">
                <a href="#" class="">Забанить</a>
                <a href="#" class="">Подробнее</a>
            </div>
        </div>
    </div> -->

    <div class="users_container container">
        <h1>Пользователи</h1>
        <div class="users_box">
            <? require('actions/get_users_info.php')?>
            <!-- <div class="user">
                <div class="user_id">
                    <p class="user_id-title">ID:</p>
                    <p class="user_id-value">1</p>
                </div>
                <div class="user_image-box">
                    <span class="hover_box"></span>
                    <img src="img/profile/Glass_Logo_Render 5.png" alt="" class="user_img">
                </div>
                <div class="user_header">
                    
                    <div class="user_name">
                        <p class="user_name-title">ФИО:</p>
                        <p class="user_name-value">Сержантов Павел Андреевич</p>
                    </div>
                </div>

                <div class="user_other-info">
                    <div class="user_other-info_block">
                        <p class="user_name-title">Номер телефона:</p>
                        <p class="user_name-value">+7 900 000 00 00</p>
                    </div>
                    <div class="user_other-info_block">
                        <p class="user_name-title">Номер телефона:</p>
                        <p class="user_name-value">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aliquid nam provident earum voluptatem quasi neque similique! Totam nihil deleniti, magnam dignissimos libero, officia nam magni perspiciatis repudiandae aliquid velit omnis.</p>
                    </div>
                    <div class="user_other-info_block">
                        <p class="user_name-title">Статус:</p>
                        <p class="user_name-value">Забанен</p>
                    </div>
                </div>
                <div class="user_actions">
                    <a href="#" class="user_action">
                        Забанить
                    </a>
                    <a href="#" class="user_action">
                        Действие
                    </a>
                </div>
            </div> -->
        </div>
    </div>
</section>

<section class="actions">
    <div class="actions_container container">
        <h1>Действия</h1>
        <a href="#" class="action_btn_style button_style">Добавить продукт (карту)</a>
        <a href="#" class="action_btn_style button_style">Сделать что-то</a>
        <a href="?page=create-news" class="action_btn_style button_style">Добавить новость</a>
    </div>
</section>

<section class="news-block">
    <div class="news_container container">
        <?php
            $news = $database->query("SELECT * FROM `bank_news`")->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <h1>Новости</h1>
        <div class="news_box">
            <?php
                foreach($news as $item) {
                    if($item['status'] === 'published') {
                        $link = '?page=profile&newsHidden='.$item['newsID'].'';
                        $text = 'Скрыть';
                    } elseif ($item['status'] === 'hidden') {
                        $link = '?page=profile&newsPublished='.$item['newsID'].'';
                        $text = 'Опубликовать';
                    }
                    echo '
                        <div class="news-item">
                            <a newsID="'.$item['newsID'].'" class="image_box news">
                                <img src="'.$item['image_path'].'" alt="" class="news_img">
                            </a>
                            <div class="text-content">
                                <p class="title">'.$item['title'].'</p>
                                <p class="description"'.$item['description'].'></p>
                            </div>
                            <div class="actions">
                                <a href="'.$link.'" class="">'.$text.'</a>
                                <a href="?page=profile&newsDelete='.$item['newsID'].'" class="">Удалить</a>
                            </div>
                        </div>
                    ';
                }

                if(isset($_GET['newsHidden'])) {
                    $newsID = $_GET['newsHidden'];
                    if(!empty($newsID)) {
                        $database->query("UPDATE `bank_news` SET `status`='hidden' WHERE `newsID`='$newsID'")->fetch(PDO::FETCH_ASSOC);
                        // header('Location: ?page=profile#news');
                        echo '<script>document.location.href="?page=profile#news"</script>';
                    }
                }
                if(isset($_GET['newsPublished'])) {
                    $newsID = $_GET['newsPublished'];
                    if(!empty($newsID)) {
                        $database->query("UPDATE `bank_news` SET `status`='published' WHERE `newsID`='$newsID'")->fetch(PDO::FETCH_ASSOC);
                        // header('Location: ?page=profile#news');
                        echo '<script>document.location.href="?page=profile#news"</script>';
                    }
                }
                if(isset($_GET['newsDelete'])) {
                    $newsID = $_GET['newsDelete'];
                    if(!empty($newsID)) {
                        $database->query("DELETE FROM `bank_news` WHERE `newsID`='$newsID'")->fetch(PDO::FETCH_ASSOC);
                        // header('Location: ?page=profile#news');
                        echo '<script>document.location.href="?page=profile#news"</script>';
                    }
                }
            
            ?>
        </div>
    </div>
</section>