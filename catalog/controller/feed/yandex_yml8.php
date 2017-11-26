<?php
/**
* Yandex.YML data feed for OpenCart (ocStore) 1.5.5.x
*
* Main class to create YML
*
* @author Yesvik http://opencartforum.ru/user/6876-yesvik/
* @author Alexander Toporkov <toporchillo@gmail.com>
* @copyright (C) 2013- Alexander Toporkov
* @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
*
* Extended version of this module: http://opencartforum.ru/files/file/670-eksport-v-iandeksmarket/
*/

/**
 * Класс YML экспорта
 * YML (Yandex Market Language) - стандарт, разработанный "Яндексом"
 * для принятия и публикации информации в базе данных Яндекс.Маркет
 * YML основан на стандарте XML (Extensible Markup Language)
 * описание формата YML http://partner.market.yandex.ru/legal/tt/
 */

require_once(dirname(__FILE__).'/yandex_yml.php');

class ControllerFeedYandexYml8 extends ControllerFeedYandexYml {
//++++ Config section ++++
	//Из какого поля брать описание товара (description, meta_description)
	protected $DESCRIPTION_FIELD = 'description';
	//До какой длины укорачивать описание товара. 0 - не укорачивать
	protected $SHORTER_DESCRIPTION = 0;
	//Отдавать ли Яндексу оригиналы фотографий товаров. Если false - то всегда масштабировать
	protected $ORIGINAL_IMAGES = true;
//---- Config section ----
	protected $CONFIG_PREFIX = 'yandex_yml8_';
}
?>
