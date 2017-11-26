<?php
/*
 * Скрипт для запуска автоматического экспорта товаров в альбомы вконтакте(модуль vkExport)
 */

include '/var/www/admin/www/fisherway.com.ua/admin/config.php';

$logfile = 'vkExport_cron.txt';
$route = 'autoexport';

include	'vk_export_cron.php';

?>
