<div class="registration_container container">
    <div class="registration_block">
        <h2>Авторизация администратора</h2>
        <form action="actions/auth.php" method="POST" name="reg">
            <div class="profile_input_box form_input_style">
                <input type="tel" name="number_phone" id="auth_input_phone_number" class="profile_input_style" autocomplete="off" value="" aria-labelledby="placeholder-fname">
                <label for="auth_input_phone_number" id="placeholder-phone-number" class="placeholder-text">
                    <span class="text">Логин</span>
                </label>
            </div>

            <div class="profile_input_box form_input_style">
                <input type="password" name="password" id="auth_input_password" class="profile_input_style" autocomplete="off" value="" aria-labelledby="placeholder-fname">
                <label for="auth_input_password" id="placeholder-password" class="placeholder-text">
                    <span class="text">Пароль</span>
                </label>
            </div>

            <button class="button-form button_style" name="auth">Войти</button>
        </form>
        <a href="?page=registration" class="close">Нет аккаунта?</a>
    </div>
        
</div>