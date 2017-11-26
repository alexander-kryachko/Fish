<?php header('Content-type: text/html; charset=utf-8 BOM')?> 
<p style="text-align: center"><input type='button' onclick='javascript:history.go(-1)' value="Назад"></p><hr/>
<?php

// Функция чтения файла
function read_file_func($file)
    {
// Открываем файл если он существует
    if(file_exists($file))
        {
        $f=fopen($file, "r+t") or die("Невозможно открыть файл");
// Блокируем файл (разделяемая блокировка)
        flock($f, LOCK_SH);    // ждём завершения процесса записи
// В файл теперь никто не пишет, можно читать
        $cont=explode("\n",fread($f,filesize($file)));    // считываем файл
        fclose($f);        // закрываем файл
        }
    else
        {
        $cont="Файл не существует";
        }
// Возвращаем значение
    return $cont;
    }
?> 
<?php $q = 1; ?>

<?php
    $mass=read_file_func($_SERVER['DOCUMENT_ROOT'] . '/admin/uploads/sos.tmp');
	if ($mass != 'Файл не существует') {
		foreach($mass as $value) {
			if($q & 1) $color="0000FF";
			else $color="CC3333";	
			echo "<font color=\"336633\">".$q."  |"."</font>"."<font color=\"".$color."\">"."   ".$value."</font>"."<br>"."<hr/>";
			$q=$q+1;
		}
	}	else echo "Файл не существует";
?>





<p style="text-align: center"><input type='button' onclick='javascript:history.go(-1)' value="Назад"></p>
<br/><br/><br/><br/>