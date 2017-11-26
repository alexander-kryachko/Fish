<?php

// Heading
$_['heading_title'] = 'Поиск с морфологией и релевантностью PRO [<a href="http://sv2109.com" target="_blank">sv2109.com</a>]';

// Text
$_['text_key'] = 'Ключ';
$_['text_module'] = 'Модули';
$_['text_success'] = 'Модуль удачно обновлен!';

$_['tab_general'] = 'Основные настройки';
$_['tab_relevance'] = 'Настройки релевантности';
$_['tab_support'] = 'Поддержка';
$_['tab_exclude_words'] = 'Исключить слова';
$_['tab_replace_words'] = 'Заменить слова';

$_['tab_general_help'] = 'Помощь:<br/>
    <ul>
      <li>отключите поиск по полям где он не нужен, это увеличит скорость поиска</li>
      <li>для полей Модель, SKU, UPC, EAN, JAN, ISBN, MPN и Название лучше использовать поиск или по началу слова или точное совпадение, тогда будет работать индекс это увеличит скорость поиска</li>
    </ul>';
$_['tab_relevance_help'] = 'Помощь:<br/>
    <ul>
      <li>чем меньше пунктов релевантности выбрано, тем выше скорость поиска но тем ниже его релевантность</li>
      <li>чтобы не использовать релевантность по какому-то полю, установите значение - 0</li>
      <li>вес вхождения в начало означает что поле начинается на искомую фразу или слово</li>
      <li>вес вхождения фразы означает что поле содержит точное вхождение этой фразы (актуально для фраз из нескольких слов)</li>
      <li>для полей Модель, SKU, UPC, EAN, JAN, ISBN, MPN и Название лучше использовать вес вхождени по началу, тогда будет работать индекс это увеличит скорость поиска</li>
    </ul>';
$_['tab_exclude_words_help'] = 'Одно слово на строку';
$_['tab_replace_words_help'] = 'Одна пара слов на строку, слова в паре разделены пробелом. Например: aple apple';

$_['name'] = 'Название';
$_['description'] = 'Описание';
$_['tags'] = 'Теги';
$_['attributes'] = 'Атрибуты';
$_['model'] = 'Модель';
$_['sku'] = 'SKU';
$_['upc'] = 'UPC';
$_['ean'] = 'EAN';
$_['jan'] = 'JAN';
$_['isbn'] = 'ISBN';
$_['mpn'] = 'MPN';

$_['fields_name'] = 'Поля';
$_['search'] = 'Где искать';
$_['search_equally'] = 'Точное совпадение';
$_['search_contains'] = 'Вхождение';
$_['search_start'] = 'Начало';
$_['search_dont_search'] = 'Не искать';
$_['phrase'] = 'Фраза из нескольких слов';
$_['phrase_cut'] = 'Разбивать на слова';
$_['phrase_dont_cut'] = 'Искать по целой фразе';
$_['use_morphology'] = 'Использовать морфологию';
$_['use_relevance'] = 'Использовать релевантность';
$_['search_logic'] = 'Логика поиска для фраз из нескольких слов';
$_['logic_or'] = 'ИЛИ';
$_['logic_and'] = 'И';
$_['min_word_length'] = 'Минимальная длина слова для поиска';
$_['exclude_characters'] = 'Исключить символы из поиска';

$_['relevance_start'] = 'Вес вхождения в начало';
$_['relevance_phrase'] = 'Вес вхождения целой фразы';
$_['relevance_word'] = 'Вес вхождения слова ';

// Error
$_['error_permission'] = 'Внимание: Вы не имеете права модифицировать модуль Поиск с морфологией и релевантностью!';

$_['support_text'] = '
<br />
<b>Если у вас возникли проблемы с установкой или использованием этого модуля, то вы можете:</b>
<ul>
  <li>Написать мне на <a href="mailto:sv2109@gmail.com?subject=Search MR module">sv2109@gmail.com</a></li>
  <li>Создать тикет на <a href="http://sv2109.com/ru/tickets">http://sv2109.com/ru/tickets</a></li>
  <li>Написать комментарий на странице модуля</li>
</ul>
<br/>
<b>Вы так же можете ко мне обратиться если:</b>
<ul>
  <li>вам нужна помощь с вашим OpenCart-ом</li>
  <li>вам нужно создать любой другой модуль для OpenCart</li> 
</ul>
<br/>
<div style="font-size: 150%;">Другие полезные модули вы можете найти <a href="http://sv2109.com/ru/modules">тут</a>:</div>
<br/>
<a href="http://sv2109.com/ru/modules"><img src="http://sv2109.com/i/ssb.png" alt=""><img src="http://sv2109.com/i/srb.png" alt=""><img src="http://sv2109.com/i/isb.png" alt=""><img src="http://sv2109.com/i/fcsb.png" alt="">
<br/><img src="http://sv2109.com/i/acb.png" alt=""><img src="http://sv2109.com/i/asb.png" alt=""><img src="http://sv2109.com/i/iocb.png" alt=""><img src="http://sv2109.com/i/tab.png" alt=""></a>
';
//author sv2109 (sv2109@gmail.com) license for 1 product copy granted for pinkovskiy (roman@pinkovskiy.com fisherway.com.ua)
