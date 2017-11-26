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
      <div class="buttons">
		<a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a>
		<a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a>
	  </div>
    </div>
    <div class="content">

	<?

	if (!empty($rows)){
		echo '<form id="form" method="post" action="'.$action.'">';
		echo '<table class="list">';
		echo '<tbody><tr style="background-color: rgb(244, 244, 248);">
			  <td class="center"><b>Предпочтение:</b></td>
			  <td class="center"><b>Значение:</b></td>
			  <td class="left"><b>Категории:</b></td>
			  <td class="left"><b>Производитель:</b></td>
			  <td></td>
		</tr><tbody>';
		
		foreach($rows as $row){
			echo '<tr>';
			echo '<td class="center">'.$row['name'].'</td>';
			echo '<td class="center">'.$row['value'].'</td>';
			
			// categories
			echo '<td><div style="margin:.5em 1em;"><div class="scrollbox" style="width:450px;">';
			$class = 'odd';
			$pref_category_ids = !empty($row['categories']) ? $row['categories'] : array();
			foreach ($categories as $category){
				$class = ($class == 'even' ? 'odd' : 'even');
				echo '<div class="'. $class .'">';
				if (in_array($category['category_id'], $pref_category_ids)) {
					echo '<input type="checkbox" name="product_category['.$row['pref_id'].'][]" value="'. $category['category_id'] .'" checked="checked" />';
					echo $category['name'];
				} else {
					echo '<input type="checkbox" name="product_category['.$row['pref_id'].'][]" value="'. $category['category_id'] .'" />';
					echo $category['name'];
				}
				echo '</div>';
			}
			echo '</div>';
			echo '<a onclick="$(this).parent().find(\':checkbox\').attr(\'checked\', true);">Выделить всё</a> / <a onclick="$(this).parent().find(\':checkbox\').attr(\'checked\', false);">Снять выделение</a></td>';
			
			// BOF: manufacturer
			echo '<td><div style="margin:.5em 1em;"><div class="scrollbox" style="width:250px;">';
			$class = 'odd';
			//$pref_category_ids = !empty($row['categories']) ? $row['categories'] : array();
			foreach ($manufacturers as $k => $v){
				$class = ($class == 'even' ? 'odd' : 'even');
				echo '<div class="'. $class .'">';
				if (in_array($k, $pref_manufacturer_ids)) {
					echo '<input type="checkbox" name="product_manufacturer['.$row['pref_id'].'][]" value="'. $k .'" checked="checked" />';
					echo $v;
				} else {
					echo '<input type="checkbox" name="product_manufacturer['.$row['pref_id'].'][]" value="'. $k .'" />';
					echo $v;
				}
				echo '</div>';
			}
			echo '</div>';
			echo '<a onclick="$(this).parent().find(\':checkbox\').attr(\'checked\', true);">Выделить всё</a> / <a onclick="$(this).parent().find(\':checkbox\').attr(\'checked\', false);">Снять выделение</a></td>';
			// EOF: manufacturer
			
			echo '</div>';
			echo '<td class="center"><a onclick="removeClientPref('.$row['pref_id'].');" class="button">Удалить</a></td>';
			echo '</tr>';
		}
		echo '</tbody></table></form>';
	}
	
	echo '<p><strong>Добавить предпочтение:</strong></p>';
	echo '<form id="addClientPrefForm">';
	echo 'Предпочтение: <input type="text" value="" name="prefType" /> &nbsp;&nbsp;&nbsp; ';
	echo 'Значение: <input type="text" value="" name="prefValue" /> &nbsp;&nbsp;&nbsp; ';
	echo '<a onclick="addClientPref(this);" class="button">Добавить</a>';
	echo '</form>';
	?>

	</div>
  </div>
</div>
<?php echo $footer; ?>