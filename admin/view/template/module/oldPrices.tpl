<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  
	<?php if (!empty($error_warning)) { ?>
		<div class="warning"><?php echo $error_warning; ?></div>
	<?php } ?><?php if (!empty($success)) { ?>
		<div class="success"><?php echo $success; ?></div>
	<?php } ?>
	
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
	
	<p>Тестируем автоматическое обновление. Ручной режим отключен.</p>
	
	<?
	if ($_SERVER['REMOTE_ADDR'] == '77.122.73.103'){ ?>
		<h2>Запомнить текущие цены</h2>
		<p>Нажмите эту кнопку перед изменением цен, чтобы затем воспользоваться функцией автоматического генерирования &laquo;старых&raquo; цен.</p>
		<a onclick="location = '<?php echo $remember; ?>';" class="button">Запомнить текущие цены</a>
		<br /><br />
		
		<?php if (!empty($oldpricesaved)){ ?>
		<h2>Сгененировать &laquo;старые&raquo; цены</h2>
		<p>Нажмите эту кнопку после изменения цен, чтобы сгенерировать &laquo;старые&raquo; цены. При этом для новых цен будут созданы акции без срока действия</p>
		<a onclick="location = '<?php echo $update; ?>';" class="button">Сгенерировать старые цены</a>
		<br /><br />
		<?php } ?>

		<h2>Обновить цены товаров-серий</h2>
		<p>Нажмите, чтобы обновить цены товаров-серий. Будут использованы минимальные цены из товаров модельного ряда, которые есть в наличии.</p>
		<a onclick="location = '<?php echo $series; ?>';" class="button">Обновить цены серий</a>
		<br /><br />

		<h2>Очистка цен</h2>
		<p>Воспользуйтесь этой функцией, чтобы удалить акционные цены без срока действия. При этом &laquo;старые&raquo; цены станут действующими.</p>
		<a onclick="location = '<?php echo $clear; ?>';" class="button">Удалить акции без срока действия</a>
	<? } ?>

	</div>
  </div>
</div>
<?php echo $footer; ?>