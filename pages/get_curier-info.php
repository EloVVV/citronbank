<?php
    if(!isset($_SESSION['USER'])) {
        // $_SESSION['errors'][] = "Тебе туда нельзя";
        header('Location: ./?page=404');
    }

    $userID = $_SESSION['USER'];
?>

<section class="profile-info">
    <div class="profile-info_container container">
        <div class="profile-info_box">
            <div class="profile_image_content">
                <a href="#" class="profile_edit_button">
                    <svg class="edit_button" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.8667 4.78672L17.2134 1.13339C16.7366 0.685516 16.1117 0.428533 15.4578 0.411324C14.8039 0.394115 14.1664 0.617881 13.6667 1.04005L1.6667 13.0401C1.23572 13.4747 0.967369 14.0443 0.906696 14.6534L0.333363 20.2134C0.315401 20.4087 0.340742 20.6055 0.407578 20.7899C0.474413 20.9743 0.581099 21.1416 0.720029 21.2801C0.844616 21.4036 0.992371 21.5014 1.15482 21.5677C1.31727 21.6341 1.49122 21.6677 1.6667 21.6667H1.7867L7.3467 21.1601C7.95576 21.0994 8.52541 20.831 8.96003 20.4001L20.96 8.40005C21.4258 7.90801 21.6775 7.2514 21.66 6.5741C21.6425 5.8968 21.3572 5.25406 20.8667 4.78672ZM16.3334 9.24005L12.76 5.66672L15.36 3.00005L19 6.64005L16.3334 9.24005Z" fill=""/>
                    </svg>
                        
                </a>
                <div class="profile_image_box image_box">
                    <img src="<?php echo $user['image_path']?>" alt="" class="profile_image">
                </div>
            </div>
            <form action="actions/edit_profile.php" method="POST" class="profile_text-content">
                <h2>Личная информация</h2>
                <div id="profile_info_inputs" class="profile_inputs profile_info_inputs">
                    <div class="profile_input_box">
                        <?php 
                            $user_full_name = "{$user['first_name']} {$user['middle_name']} {$user['last_name']}";
                        ?>
                        <input type="text" name="full_name" id="profile_info_input_name" class="profile_input_style" autocomplete="off" value="<?php echo $user_full_name?>" aria-labelledby="profile_info_placeholder_name">
                        <label for="profile_info_input_name" id="profile_info_placeholder_name" class="placeholder-text">
                            <span class="text">Имя пользователя</span>
                        </label>
                    </div>

                    <div class="profile_input_box">
                        <input type="text" name="email" id="profile_info_input_email" class="profile_input_style" autocomplete="off" value="<?php echo $user['email']?>" aria-labelledby="profile_info_placeholder_email">
                        <label for="profile_info_input_email" id="profile_info_placeholder_email" class="placeholder-text">
                            <span class="text">Адрес электронной почты</span>
                        </label>
                    </div>

                    <div class="profile_input_box">
                        <input type="tel" name="number_phone" id="profile_info_input_phone_number" class="profile_input_style phone_input" autocomplete="off" value="<?php echo $user['phone_number']?>" aria-labelledby="profile_info_placeholder_phone_number">
                        <label for="profile_info_input_phone_number" id="profile_info_placeholder_phone_number" class="placeholder-text">
                            <span class="text">Номер телефона</span>
                        </label>
                    </div>
                </div>
                <div id="profile_edit_inputs" class="profile_inputs profile_edit_inputs">
                    <div class="profile_input_box">
                        <input type="text" name="full_name" id="profile_edit_input_name" class="profile_input_style" autocomplete="off" value="<?php echo $user_full_name?>" aria-labelledby="profile_edit_placeholder_name">
                        <label for="profile_edit_input_name" id="profile_edit_placeholder_name" class="placeholder-text">
                            <span class="text">Имя пользователя</span>
                        </label>
                    </div>

                    <div class="profile_input_box">
                        <input type="text" name="email" id="profile_edit_input_email" class="profile_input_style" autocomplete="off" value="<?php echo $user['email']?>" aria-labelledby="profile_edit_placeholder_email">
                        <label for="profile_edit_input_email" id="profile_edit_placeholder_email" class="placeholder-text">
                            <span class="text">Адрес электронной почты</span>
                        </label>
                    </div>

                    <div class="profile_input_box">
                        <input type="tel" name="number_phone" id="profile_edit_input_phone_number" class="profile_input_style phone_input" autocomplete="off" value="<?php echo $user['phone_number']?>" aria-labelledby="profile_edit_placeholder_phone_number">
                        <label for="profile_edit_input_phone_number" id="profile_edit_placeholder_phone_number" class="placeholder-text">
                            <span class="text">Номер телефона</span>
                        </label>
                    </div>
                </div>
                <div class="profile_buttons_block">
                    <a href="#" class="profile_button_content profile_edit_button">
                        <p>Редактировать профиль</p>
                        <div class="profile_edit_image_box image_box">
                            <svg  class="profile_edit-icon" width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.948 0.159096L13.8217 3.61591C14.0594 3.82804 14.0594 4.17196 13.8217 4.38409L9.948 7.8409C9.71029 8.05303 9.32489 8.05303 9.08718 7.8409C8.84947 7.62878 8.84947 7.28485 9.08718 7.07272L11.9218 4.54319H0V3.45681H11.9218L9.08718 0.927277C8.84947 0.715149 8.84947 0.371223 9.08718 0.159096C9.32489 -0.0530319 9.71029 -0.0530319 9.948 0.159096Z" fill=""/>
                            </svg>
                        </div>
                    </a>
                    <a href="#" class="profile_button_content profile_back_button">
                        <div class="profile_edit_image_box image_box">
                            <svg  class="profile_edit-icon" width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.948 0.159096L13.8217 3.61591C14.0594 3.82804 14.0594 4.17196 13.8217 4.38409L9.948 7.8409C9.71029 8.05303 9.32489 8.05303 9.08718 7.8409C8.84947 7.62878 8.84947 7.28485 9.08718 7.07272L11.9218 4.54319H0V3.45681H11.9218L9.08718 0.927277C8.84947 0.715149 8.84947 0.371223 9.08718 0.159096C9.32489 -0.0530319 9.71029 -0.0530319 9.948 0.159096Z" fill=""/>
                            </svg>
                        </div>
                        <p>Вернуться назад</p>
                    </a>
                    <!-- <a href="#" class=" profile_save_button">
                        <p>Сохранить изменения</p>
                    </a> -->
                    <button class="button-form button_style profile_save_button" name="save">Сохранить изменения</button>
                </div>
                <?php
                    $pasportID = $user['id_pasport'];
                    $pasportData = $database->query("SELECT * FROM `bank_user-pasport` WHERE `id_pasport`='$pasportID'")->fetch(PDO::FETCH_ASSOC);
                    
                    if($pasportID) {
                        echo '
                        <div class="pasport-data">
                            <h2>Паспортные данные</h2>
                            <div class="data-box">
                                <p class="data-title">Серия и номер:</p>
                                <p class="data-content">'.$pasportData['serial'].' '.$pasportData['number'].'</p>
                            </div>
                        </div>
                        ';
                    }
                ?>

            </form>
            
        </div>
    </div>
</section>