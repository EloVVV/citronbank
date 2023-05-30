<div class="registration_container container">
    <div class="registration_block">
        <h2>Регистрация</h2>
        
        <form action="actions/reg.php" enctype="multipart/form-data" method="POST" name="reg">
        
            <div class="profile_input_box form_input_style">
                <input value="<?= isset($_POST['first_name']) ? $_POST['first_name'] : '' ?>" type="text" name="first_name" id="reg_input_first_name" class="profile_input_style" >
                <label for="reg_input_first_name" name="first_name" id="placeholder-fname" class="placeholder-text">
                    <span class="text">Имя</span>
                </label>
            </div>
        
            <div class="profile_input_box form_input_style">
                <input value="<?= $name = isset($_POST['middle_name']) ? $_POST['middle_name'] : '' ?>" type="text" name="middle_name" id="reg_input_middle_name" class="profile_input_style" autocomplete="off" value="" aria-labelledby="placeholder-fname">
                <label for="reg_input_middle_name" id="placeholder-sname" class="placeholder-text">
                    <span class="text">Фамилия</span>
                </label>
            </div>

            <div class="reg_input_box">
                <div class="profile_input_box form_input_style">
                    <input type="text" name="last_name" id="reg_input_third_name" class="profile_input_style third_name" autocomplete="off" value="" aria-labelledby="placeholder-fname">
                    <label for="reg_input_third_name" id="placeholder-tname" class="placeholder-text">
                        <span class="text">Отчество</span>
                    </label>
                    
                </div>
                <div class="select_input_box">
                    <div class="selector_box">
                        <input type="checkbox" id="highload1" name="highload1">
                        <label for="highload1" class="lb1"></label>
                    </div>
                    <div class="input_text">
                        Нет отчества по паспорту
                    </div>
                </div>
            </div>
            <div class="profile_input_box form_input_style">
                <input type="text" name="email" id="reg_input_email" class="profile_input_style" autocomplete="off" value="" aria-labelledby="placeholder-fname">
                <label for="reg_input_email" id="placeholder-email" class="placeholder-text">
                    <span class="text">Электронный адрес</span>
                </label>
            </div>

            <div class="profile_input_box form_input_style">
                <input type="tel" name="number_phone" id="reg_input_phone_number" class="profile_input_style phone_input" autocomplete="off" value="" aria-labelledby="placeholder-fname">
                <label for="reg_input_phone_number" id="placeholder-number-phone" class="placeholder-text">
                    <span class="text">Номер телефона</span>
                </label>
            </div>

            <div class="profile_input_box form_input_style">
                <input type="password" name="password" id="reg_input_password" class="profile_input_style" autocomplete="off" value="" aria-labelledby="placeholder-fname">
                <label for="reg_input_password" id="placeholder-password" class="placeholder-text">
                    <span class="text">Пароль</span>
                </label>
            </div>
        
            <div class="profile_input_box form_input_style">
                <input type="password" name="re_password" id="reg_input_re_password" class="profile_input_style" autocomplete="off" value="" aria-labelledby="placeholder-fname">
                <label for="reg_input_re_password" id="placeholder-re-password" class="placeholder-text">
                    <span class="text">Повторите пароль</span>
                </label>
            </div>
            <button type="submit" class="button-form button_style" name="reg">Зарегистрироваться</button>
        </form>
        <a href="?page=authentication" class="close">Уже есть аккаунт?</a>
    </div>
    
</div>