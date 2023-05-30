<?
    session_start();

    require('../database/database.php');
    global $database;

    unset($_SESSION['errors']);
    $_SESSION['errors'] = [];


    if(isset($_POST['reg'])){
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = trim($_POST['last_name']);
        $email = $_POST['email'];
        $number_phone = $_POST['number_phone'];
        $password = $_POST['password'];
        $re_password = $_POST['re_password'];

        $user = $database->query("SELECT * FROM `bank_users` WHERE `phone_number` = '$number_phone'")->fetch(PDO::FETCH_ASSOC);

        if($user == '' ) {
            $user = [];
        }

        if(!empty($user)) $_SESSION['errors'][] = "Пользователь с номером {$number_phone} уже существует";
        if(strlen($password) < 6) $_SESSION['errors'][] = "Минимальная длина пароля - 6 символов";
        if($password !== $re_password) $_SESSION['errors'][] = "Пароли не совпадают";

        if($last_name === '' 
        || $last_name === " " 
        || empty($last_name)) {
            $last_name = NULL;
        }
        

        
        if(empty($first_name) 
        || empty($middle_name)
        || empty($number_phone)
        || empty($password)
        || empty($re_password)) {
            $_SESSION['errors'][] = "Вы не заполнили все поля";
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['errors'][] = "Почтовый адрес введён неккоректно";
        }

        if(count($_SESSION['errors']) === 0) {
            $hash_password = md5($password);

            $user_arr = [
                'first_name'=>$first_name,
                'middle_name'=>$middle_name,
                'last_name'=>$last_name,
                'email'=>$email,
                'password'=>$hash_password,
                'id_pasport'=>NULL,
                'phone_number'=>$number_phone,
                'image_path'=>'img/profile/default_profile_img.png',
            ];
            $insert_user = $database->prepare("INSERT INTO `bank_users` (`first_name`, `middle_name`, `last_name`, `email`, `password`, `id_pasport`, `phone_number`, `image_path`) 
            VALUES (:first_name, :middle_name, :last_name, :email, :password, :id_pasport, :phone_number, :image_path)");
            $insert_user->execute($user_arr);
            $insert_user->fetch(PDO::FETCH_ASSOC);

            // $database->query("INSERT INTO `bank_users` (`first_name`, `middle_name`, `last_name`, `email`, `password`, `id_pasport`, `phone_number`, `image_path`) 
            // VALUES ('$first_name', '$middle_name', '$last_name', '$email', '$hash_password', NULL, '$number_phone', 'img/profile/default_profile_img.png')");

            $user_id = $database->lastInsertId();

            $_SESSION['USER'] = $user_id;
  

            // echo 'успех';
        }


    }
    
    header('Location: ../?page=registration');
?>
