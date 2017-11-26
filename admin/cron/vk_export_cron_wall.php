<?php
/*
 * Скрипт для запуска автоматического эксопрта товаров на стену вконтакте(модуль vkExport)
 */
 
include '/var/www/admin/www/fisherway.com.ua/admin/config.php';

$logfile = 'vkExport_cron_wall.txt';
$route = 'autowallpost';

include	'vk_export_cron.php';

?>
