<?php
/*
 * Скрипт для запуска автоматического обновления товаров в альбомах вконтакте(модуль vkExport)
 */
 
include '/var/www/admin/www/fisherway.com.ua/admin/config.php';

$logfile = 'vkExport_cron_update.txt';
$route = 'autoupdate';

include	'vk_export_cron.php';

?>
