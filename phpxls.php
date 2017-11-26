<?php
include 'system/PHPExcel/Classes/PHPExcel/IOFactory.php';

$objReader = PHPExcel_IOFactory::createReader('CSV');

// If the files uses a delimiter other than a comma (e.g. a tab), then tell the reader
$objReader->setDelimiter(";");
// If the files uses an encoding other than UTF-8 or ASCII, then tell the reader
$objReader->setInputEncoding('UTF-8');

$objPHPExcel = $objReader->load('primanka.csv');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('primanka.xls');
?>