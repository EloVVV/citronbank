<?php
session_start();

require('../database/database.php');
global $database;

unset($_SESSION['errors']);
$_SESSION['errors'] = [];


// Все загруженные файлы помещаются в эту папку
$uploaddir = '../img/cards/SinglePage/Adding/';

// Вытаскиваем необходимые данные
$file = $_POST['value'];
$name = $_POST['name'];






// Получаем расширение файла
$getMime = explode('.', $name);
$mime = end($getMime);

// Выделим данные
$data = explode(',', $file);

// Декодируем данные, закодированные алгоритмом MIME base64
$encodedData = str_replace(' ','+',$data[1]);
$decodedData = base64_decode($encodedData);

// Вы можете использовать данное имя файла, или создать произвольное имя.
// Мы будем создавать произвольное имя!
$randomName = substr_replace(sha1(microtime(true)), '', 12).'.'.$mime;

$endFileName = $uploaddir.$randomName;

// Создаем изображение на сервере
if(file_put_contents($uploaddir.$randomName, $decodedData)) {
	// Записываем данные изображения в БД
	if($_POST['type'] === '0') {
		$edit_product = $database->query("UPDATE `bank_card-product` 
		SET `preview_image`='$endFileName' WHERE `id_product` = '18'")->fetch(PDO::FETCH_ASSOC);
		
		echo $randomName.":загружен успешно";
	} else {
		$edit_product = $database->query("UPDATE `bank_card_image-path`
		SET `image-path`='$endFileName' WHERE `id_card` = '18'")->fetch(PDO::FETCH_ASSOC);

		echo $randomName.":загружен успешно";
	}
	
	var_dump($_POST);
}
else {
	// Показать сообщение об ошибке, если что-то пойдет не так.
	echo "Что-то пошло не так. Убедитесь, что файл не поврежден!";
}
?>