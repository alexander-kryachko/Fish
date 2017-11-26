<?php
// Heading
$_['heading_title'] = 'Новые поступления за N дней';

// Text
$_['text_module']             = 'Модули';
$_['text_success']            = 'Настройки модуля обновлены!';
$_['text_list']               = 'Список';
$_['text_grid']               = 'Сетка';
if (version_compare(VERSION, '2.0', '>=')) {
  $_['text_edit']               = 'Редактирование модуля';
}
$_['text_select_display']     = 'Выберите вид отображения';
$_['text_breadcrumbs_main']   = 'В основыне крошки';
$_['text_breadcrumbs_single'] = 'Отдельные крошки';
$_['text_yes']                = 'Да';
$_['text_no']                 = 'Нет';

// Entry
$_['entry_image']                   = 'Изображение (Ширина x Высота):';
$_['entry_days']                    = 'Новые поступления за, дней:';
$_['entry_limit']                   = 'Товаров на странице:';
$_['entry_product_count']           = 'Отображать количество товаров у категорий:';
$_['entry_hide_categories']         = 'Скрыть категории:';
$_['entry_only_main_categories']    = 'Отображать только главные категории:';
$_['help_only_main_categories']     = "Игнорируется параметр 'Показывать в категориях' и выводятся только категории указанные в 'Категория'";
$_['entry_only_main_categories_h1'] = 'Отображать в место названия HTML-тег H1:';
$_['help_only_main_categories_h1']  = 'Доступно только при отображении только главных категорий, H1 выводится если заполнено, иначе название';
$_['entry_show_category_images']    = 'Отображать иконки категорий';
$_['entry_display']                 = 'Вид:';
$_['entry_layout']                  = 'Схема:';
$_['entry_name']                    = 'Название:';
$_['entry_seo_h1']                  = 'HTML-тег H1:';
$_['entry_seo_title']               = 'HTML-тег Title:';
$_['entry_meta_keyword']            = 'Мета-тег Keywords:';
$_['entry_meta_description']        = 'Мета-тег Description:';
$_['entry_description']             = 'Описание:';
$_['entry_hide_outofstock']         = 'Скрывать товары которых нет:';
$_['help_hide_outofstock']          = 'Будут скрыты товары у которых остаток равен нулю';
$_['entry_seo_url']                 = 'SEO URL:';
$_['entry_breadcrumbs_separate']    = 'Отдельные хлебные крошки:';

//Buttons
$_['button_save'] = 'Сохранить';
$_['button_cancel'] = 'Отменить';

// Error
$_['error_warning']       = 'Внимательно проверьте форму на ошибки!';
$_['error_permission']    = 'У Вас нет прав для управления этим модулем!';
$_['error_image']         = 'Введите размеры изображения!';
$_['error_image_value']   = 'Размер изображения должен содержать только цифры и быть целым числом!';
$_['error_days']          = 'Укажите за какое количество дней выводить товары!';
$_['error_days_value']    = 'Значение может содержать только цифры и должно быть целым!';
$_['error_limit']         = 'Укажите количество товаров на странице!';
$_['error_limit_value']   = 'Значение может содержать только цифры и должно быть целым!';
$_['error_name']          = 'Название должно быть от 2 до 32 символов!';

?>