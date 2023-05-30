<div class="registration_container container">
    <div class="registration_block">
        <h2>Добавление паспортных данных</h2>
        <form action="actions/addPasport.php" method="POST" name="reg">
            
            <div class="profile_input_box form_input_style">
                <input 
                oninput="maxLengthCheck(this)"
                maxlength = "4"
                type="number" 
                name="serial"  
                id="auth_input_password" 
                class="profile_input_style" 
                autocomplete="off" 
                value="" 
                aria-labelledby="placeholder-fname">
                <label for="auth_input_password" id="placeholder-password" class="placeholder-text">
                    <span class="text">Серия</span>
                </label>
            </div>
            <div class="profile_input_box form_input_style">
                <input 
                oninput="maxLengthCheck(this)"
                maxlength = "6"
                type="number" 
                name="number"
                id="auth_input_password" 
                class="profile_input_style" 
                autocomplete="off" 
                value="" 
                aria-labelledby="placeholder-fname">
                <label for="auth_input_password" id="placeholder-password" class="placeholder-text">
                    <span class="text">Номер</span>
                </label>
            </div>

            <button class="button-form button_style" name="auth">Добавить</button>
        </form>
    </div>
        
</div><script>
  // This is an old version, for a more recent version look at
  // https://jsfiddle.net/DRSDavidSoft/zb4ft1qq/2/
  function maxLengthCheck(object)
  {
    if (object.value.length > object.maxLength)
      object.value = object.value.slice(0, object.maxLength)
  }
</script>