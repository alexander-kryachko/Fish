<?php
/*
 * Скрипт для запуска автоматического экспорта товаров в альбомы вконтакте(модуль vkExport)
 */

include '../config.php';

$logfile = 'vkExport_cron.txt';
$route = 'autoexport';

include	'vk_export_cron.php';

?>
