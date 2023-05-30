var $ = jQuery.noConflict();

$(document).ready(function() {
	// В dataTransfer помещаются изображения которые перетащили в область div
	jQuery.event.props.push('dataTransfer');
	
	// Максимальное количество загружаемых изображений за одни раз
	var maxFiles = 2;
	
	// Оповещение по умолчанию
	var errMessage = 0;
	
	// Кнопка выбора файлов
	var defaultUploadBtn = $('#uploadbtn');
	
	// Массив для всех изображений
	var dataArray = [];
	var imgIndex = 0;

	
	// Область информер о загруженных изображениях - скрыта
	$('#uploaded-files').hide();
	
	// Метод при падении файла в зону загрузки
	$('#drop-files').on('drop', function(e) {	
		// Передаем в files все полученные изображения
		var files = e.dataTransfer.files;
		// Проверяем на максимальное количество файлов
		if (files.length <= maxFiles) {
			// Передаем массив с файлами в функцию загрузки на предпросмотр
			loadInView(files);
		} else {
			alert('Вы не можете загружать больше '+maxFiles+' изображений!'); 
			files.length = 0; return;
		}
	});

	// При нажатии на кнопку выбора файлов
    $('.input-file input[type=file]').on('change', function(){
        var files = $(this)[0].files;
   		// Проверяем на максимальное количество файлов
		if (files.length <= maxFiles) {
			// Передаем массив с файлами в функцию загрузки на предпросмотр
            $(this).closest('.input-file').find('.input-file-text').html(files.name);
			
			loadInView(files);
            
            
			// Очищаем инпут файл путем сброса формы
			// $("#uploadbtn").replaceWith( $("#uploadbtn").val('').clone( true ) );
            // $('.frm').each(function(){
	        // 	    this.reset();
			// });
		} else {
			alert('Вы не можете загружать больше '+maxFiles+' изображений!'); 
			files.length = 0;
		}
    });

	defaultUploadBtn.on('change', function() {
   		// Заполняем массив выбранными изображениями
	});
	
	
	// Функция загрузки изображений на предросмотр
	function loadInView(files) {
		// Показываем обасть предпросмотра
		$('#uploaded-holder').show();
		
		// Для каждого файла
		$.each(files, function(index, file) {
						
			// Несколько оповещений при попытке загрузить не изображение
			if (!files[index].type.match('image.*')) {
				
				if(errMessage == 0) {
					$('#drop-files p').html('Эй! только изображения!');
					++errMessage
				}
				else if(errMessage == 1) {
					$('#drop-files p').html('Стоп! Загружаются только изображения!');
					++errMessage
				}
				else if(errMessage == 2) {
					$('#drop-files p').html("Не умеешь читать? Только изображения!");
					++errMessage
				}
				else if(errMessage == 3) {
					$('#drop-files p').html("Хорошо! Продолжай в том же духе");
					errMessage = 0;
				}
				return false;
			}
			
			// Проверяем количество загружаемых элементов
			if((dataArray.length+files.length) <= maxFiles) {
				// показываем область с кнопками
				$('#upload-button').css({'display' : 'block'});
			} 
			else { alert('Вы не можете загружать больше '+maxFiles+' изображений!'); return; }
			
			// Создаем новый экземпляра FileReader
			
			var fileReader = new FileReader();
				
				// Инициируем функцию FileReader
				fileReader.onload = (function(file) {
					
					return function(e) {
						// Помещаем URI изображения в массив
						console.log(imgIndex);
						
						dataArray.push({name : file.name, value : this.result, type: imgIndex});
						
						
						addImage((dataArray.length-1));
						
					}; 
						
				})(files[index]);
			// Производим чтение картинки по URI
			fileReader.readAsDataURL(file);
		});
		return false;
	}
		
	// Процедура добавления эскизов на страницу
	function addImage(ind) {
		imgIndex++;
		// Если индекс отрицательный значит выводим весь массив изображений
		if (ind < 0 ) { 
		start = 0; end = dataArray.length; 
		} else {
		// иначе только определенное изображение 
		start = ind; end = ind+1; } 
		// Оповещения о загруженных файлах
		if(dataArray.length == 0) {
			// Если пустой массив скрываем кнопки и всю область
			$('#upload-button').hide();
			$('#uploaded-holder').hide();
		} else if (dataArray.length == 1) {
			$('#upload-button span').html("Был выбран 1 файл");
		} else {
			$('#upload-button span').html(dataArray.length+" файлов были выбраны");
		}
		// Цикл для каждого элемента массива
		for (i = start; i < end; i++) {
			// размещаем загруженные изображения
			if($('#dropped-files > .image').length <= maxFiles) { 
				$('#dropped-files').append('<div id="img-'+i+'" class="image image-box view-image load-img" style="background: url('+dataArray[i].value+'); background-size: cover;"><div class="drop-button-box"><a href="#" id="drop-'+i+'" class="drop-button">Удалить изображение</a></div></div>'); 
				// images = document.querySelectorAll('.load-img');
				// images.foreach((item) => {
				// 	itemAttr = item.getAttribute("id");
				// 	if(itemAttr === 'img-0') item.classList.add('preview');
				// })
			}
		}
		return false;
	}
	
	// Функция удаления всех изображений
	function restartFiles() {
	
		// Установим бар загрузки в значение по умолчанию
		$('#loading-bar .loading-color').css({'width' : '0%'});
		$('#loading').css({'display' : 'none'});
		$('#loading-content').html(' ');
		
		// Удаляем все изображения на странице и скрываем кнопки
		$('#upload-button').hide();
		$('#dropped-files > .image').remove();
		$('#uploaded-holder').hide();
	
		// Очищаем массив
		dataArray.length = 0;
		
		return false;
	}
	
	// Удаление только выбранного изображения 
	$("#dropped-files").on("click","a[id^='drop']", function() {
		// получаем название id
 		var elid = $(this).attr('id');
		// создаем массив для разделенных строк
		var temp = new Array();
		// делим строку id на 2 части
		temp = elid.split('-');
		// получаем значение после тире тоесть индекс изображения в массиве
		dataArray.splice(temp[1],1);
		// Удаляем старые эскизы
		$('#dropped-files > .image').remove();
		// Обновляем эскизи в соответсвии с обновленным массивом
		addImage(-1);		
	});
	
	// Удалить все изображения кнопка 
	$('#dropped-files #upload-button .delete').click(restartFiles);

	
	// Загрузка изображений на сервер
	$('#upload-button .upload').click(function() {
		
		

		// Показываем прогресс бар
		$("#loading").show();
		// переменные для работы прогресс бара
		var totalPercent = 100 / dataArray.length;
		var x = 0;
		
		$('#loading-content').html('Загружен '+dataArray[0].name);
		// Для каждого файла
		$.each(dataArray, function(index, file) {	
			// загружаем страницу и передаем значения, используя HTTP POST запрос 
			$.post('actions/upload.php', dataArray[index], function(data) {
			
				var fileName = dataArray[index].name;
				console.log(dataArray[index]);

				++x;
				
				// Изменение бара загрузки
				$('#loading-bar .loading-color').css({'width' : totalPercent*(x)+'%'});
				// Если загрузка закончилась
				if(totalPercent*(x) == 100) {
					// Загрузка завершена
					$('#loading-content').html('Загрузка завершена!');
					
					// Вызываем функцию удаления всех изображений после задержки 1 секунда
					setTimeout(restartFiles, 1000);
				// если еще продолжается загрузка	
				} else if(totalPercent*(x) < 100) {
					// Какой файл загружается
					$('#loading-content').html('Загружается '+fileName);
				}
				
				// Формируем в виде списка все загруженные изображения
				// data формируется в upload.php
				var dataSplit = data.split(':');
				console.log(dataSplit);
				if(dataSplit[1] == 'загружен успешно') {
					$('#uploaded-files').append('<li><a href="images/'+dataSplit[0]+'">'+fileName+'</a> загружен успешно</li>');
								
				} else {
					$('#uploaded-files').append('<li><a href="images/'+data+'. Имя файла: '+dataArray[index].name+'</li>');
				}
				
			});
		});
		// Показываем список загруженных файлов
		$('#uploaded-files').show();
		return false;
	});
	
	// Простые стили для области перетаскивания
	$('#drop-files').on('dragenter', function() {
		$(this).css({'box-shadow' : 'inset 0px 0px 2px rgba(0, 0, 0, 0.1)', 'border' : '4px dashed var(--main-color)'});
		return false;
	});
	
	$('#drop-files').on('drop', function() {
		$(this).css({'box-shadow' : 'none', 'border' : '2px dashed rgba(0,0,0,0.2)'});
		return false;
	});

	// let files = $('#file-input');

	// function formStart() {
	// 	const formLog = document.querySelector('.edit_product');
	// 	if (!formLog) return false;
	// 	const inputsLog = formLog.querySelectorAll('.card_form_input');
	// 	const buttonLog = formLog.querySelector('.button-form');
	// 	const errorLog = document.querySelector('.error-log');
	
	// 	let isSentLog = false;
	
	// 	const sendFormData = () => {
	// 		const logFormData = new FormData();
	// 		$(files).each(function(file) {
	// 			logFormData.append('image_path[]', file);
	// 			// console.log(logFormData);
	// 		})
	
	// 		inputsLog.forEach(input => {
	// 			logFormData.append(input.name, input.value);
	// 			console.log(input.value);
	// 		})

	// 		console.log(logFormData.json());
			
	// 		return logFormData;
	// 	}
	
	// 	async function sendServer(url) {
	// 		const responseLogServ = await fetch(url, {
	// 			method: 'POST',
	// 			body: sendFormData()
	// 		});
			
	// 		const dataLog = await responseLogServ.json();
	// 		return dataLog;
	// 	}
	
	// 	formLog.addEventListener('submit', async (event) => {
	// 		event.preventDefault();
	// 		if (isSentLog) return
	// 		isSentLog = true;
	// 		buttonLog.textContent = 'Отправка...'
	// 		const responseLog = await sendServer('actions/send_feedback.php');
	
			
	// 		if (responseLog.type === 'error') {
	// 			errorLog.textContent = responseLog.body;
	// 			errorLog.classList.add('active');
	// 		} else {
	// 			if (responseLog.type === 'success') {
	
	// 				errorLog.textContent = responseLog.body
	
	// 				errorLog.classList.add('active');
	// 				errorLog.classList.add('success');
	
	// 				inputsLog.forEach(el => {
	// 					el.value = "";
	// 				})
	
	// 				const link = () => {
	// 					return document.location.href = '?';
	// 				}
	// 				setTimeout(link, 3000);
	// 			}
	// 		}
	// 		isSentLog = false;
	// 		buttonLog.textContent = 'Отправить';
	// 	})
	// }
	
	// formStart();

	// var dropZone = $('#upload-container');

	// dropZone.on('submit', function() {
	// 	let files = dataArray;
	// 	sendFiles(files);
	// });

	// function sendFiles(files) {
	// 	let maxFileSize = 5242880;
	// 	let Data = new FormData();
	// 	$(files).each(function(index, file) {
	// 		if ((file.size <= maxFileSize) && ((file.type == 'image/png') || (file.type == 'image/jpeg'))) {
	// 			Data.append('design_images', file);
	// 		};
	// 	});

	// 	$.ajax({
	// 		url: dropZone.attr('action'),
	// 		type: dropZone.attr('method'),
	// 		data: Data,
	// 		contentType: false,
	// 		processData: false,
	// 		success: function(data) {
	// 			alert ('Файлы были успешно загружены!');
	// 		}
	// 	});
	// }

});


