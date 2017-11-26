
	<?php
	
	////////////////////////////////////////////////////////////////////////////////
	// Внешний модуль для обработки интеграции 1С:Предприятие 
	// Дата Создания 09.06.2011
	// Дата последнего изменения  31.03.2012
	// Разработчик: Ефимов Сергей Николаевич
	// Сайт www.1c-mart.ru
	////////////////////////////////////////////////////////////////////////////////
	
	define( '_JEXEC', 1 );

	define('JPATH_BASE', dirname(__FILE__) );
	
	define('DS', DIRECTORY_SEPARATOR);

    error_reporting(0);  // ошибки офф    
    
	include_once("config.php"); 											  // Загружаем конфигурациионый файл для  Opencart 1.4.x
			
    $login = DB_USERNAME; 		  	// Пользователь
    $password = DB_PASSWORD; 		// Пароль
    $db = DB_DATABASE; 			  	// База данных
	$host = DB_HOSTNAME; 		 	// Сервер
	$Prefix 		= DB_PREFIX; 	// Префикс Opencart	

	$queryDo 	= $_POST['data'];	
	$er = null;
	$query = str_replace('www_1c_mart_ru',$Prefix, $queryDo); // Заменяем текст из dll на префикс
	$query = str_replace('\\','', $query );

	// Проверяем соеденение с сервером	ПРИМЕР= http://magazin.ru/tunnel.php?check
    $link = mysql_connect($host, $login, $password) OR $er = "";
	
    mysql_select_db($db, $link) or $er .= "0";
    
	// Проверка соеденения	
    if(isset($_GET['check'])) {
        if($er===null) echo "1"; 
          else echo $er;
    }
    
	// Конец проверки соеденния с сервером
	$result = mysql_query("set names cp1251", $link); 
	
	// Выполняем запрос
    $result = mysql_query($query, $link);    
   
   	// Если есть результат запроса

	if ( $result != null ){
		// проверим что не 0 записей
		if ( mysql_num_rows($result) >= 0 ){

			echo "START_CONTENT\x0D\x0A";
			for ( $i = 0; $i < mysql_num_fields($result); $i++ ){
				echo mysql_field_name($result,$i) ;
				echo "\x09";	
			}
			// Перевод строки 
			echo "\x0D\x0A";
			
			// Теперь значение
			while ($row = mysql_fetch_row($result) ){
				foreach ($row as $value){
					echo base64_encode( strval($value) ) . "\x09";
				}
				echo "\x0D\x0A";				
			}
			echo "END_CONTENT";
		}
	}       
    //echo $csv;
    
    mysql_close($link);
	
    ?>