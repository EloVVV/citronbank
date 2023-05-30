<?php
    session_start();

    require('database/database.php');
    global $database;

    $query_users = $database->query("SELECT * FROM `bank_users` WHERE `role`!='admin'")->fetchAll(PDO::FETCH_ASSOC);

    // echo 'Зарегистрированных пользователей:'.count($query_users);

    

    foreach($query_users as $user) {
        if($user['id_user'] === $_SESSION['USER']) continue;
        $user_full_name = "{$user['first_name']} {$user['middle_name']} {$user['last_name']}";
        echo '
            <div class="user">
                <div class="user_id">
                    <p class="user_id-title">ID:</p>
                    <p class="user_id-value">'.$user['id_user'].'</p>
                </div>
                <a href="?page=user&id='.$user['id_user'].'" class="user_image-box">
                    <span class="hover_box"></span>
                    <img src="'.$user['image_path'].'" alt="" class="user_img">
                </a>
                <div class="user_header">
                    
                    <div class="user_name">
                        <p class="user_name-title">ФИО:</p>
                        <p class="user_name-value">'.$user_full_name.'</p>
                    </div>
                </div>

                <div class="user_other-info">
                    <div class="user_other-info_block">
                        <p class="user_name-title">Номер телефона:</p>
                        <p class="user_name-value">'.$user['phone_number'].'</p>
                    </div>
                    <div class="user_other-info_block">
                        <p class="user_name-title">Номер телефона:</p>
                        <p class="user_name-value">'.$user['id_pasport'].'</p>
                    </div>
                    <div class="user_other-info_block">
                        <p class="user_name-title">Статус:</p>
                        <p class="user_name-value">'.$user['status'].'</p>
                    </div>
                </div>
                <div class="user_actions">
                    ';
                    if ($user['status'] === 'default') {
                        echo '
                            <a href="?ban='.$user['id_user'].'" class="user_action">
                                Забанить
                            </a>
                        ';

                    } elseif ($user['status'] === 'banned') {
                        echo '
                            <a href="?unban='.$user['id_user'].'" class="user_action">
                                Разбанить
                            </a>
                        ';

                    } elseif ($user['status'] === 'premium') {
                        echo '
                            <a href="?ban='.$user['id_user'].'" class="user_action">
                                Забанить
                            </a>
                        ';
                        echo '
                            <a href="?ban='.$user['id_user'].'" class="user_action">
                                Снять премиум
                            </a>
                        ';

                    }
                    echo '
                    
                    
                </div>
            </div>
        ';

    }




?>