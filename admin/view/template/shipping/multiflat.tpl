<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/shipping.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
		  <input type="hidden" name="multiflat_status" value="1">
		  <table >
			  <tr>
				  <td><?php echo $text_multiflat_name; ?></td>
				  <td><input type="text" name="multiflat_name" value="<?php echo $multiflat_name?>"></td>
			  </tr>
			  <tr>
				  <td><?php echo $text_multiflat_sort_order?></td>
				  <td style="text-align: right;"><input type="text" size="3" name="multiflat_sort_order" value="<?php echo $multiflat_sort_order?>"></td>
			  </tr>
		  </table>
		  <table id="module" class="list">
			<thead>
			  <tr>
				<td class="left"><?php echo $entry_name; ?></td>
				<td class="left"><?php echo $entry_cost; ?></td>
				<td class="left"><?php echo $entry_tax_class; ?></td>
				<td class="left"><?php echo $entry_geo_zone; ?></td>
				<td class="right"><?php echo $entry_status; ?></td>
				<td class="right"><?php echo $entry_sort_order; ?></td>
				<td></td>
			  </tr>
			</thead>
			<?php $module_row = 0; ?>
			<?php foreach ($modules as $module) { ?>
			<tbody id="module-row<?php echo $module_row; ?>">
			  <tr>
			    <td class="left"><input type="text" name="multiflat[<?php echo $module_row; ?>][name]" value="<?php echo $module['name']; ?>" size="40" /></td>
			    <td class="left"><input type="text" name="multiflat[<?php echo $module_row; ?>][cost]" value="<?php echo $module['cost']; ?>" size="5" /></td>
				<td class="left"><select name="multiflat[<?php echo $module_row; ?>][tax_class_id]">
                  <option value="0"><?php echo $text_none; ?></option>
                  <?php foreach ($tax_classes as $tax_class) { ?>
                  <?php if ($tax_class['tax_class_id'] == $module['tax_class_id']) { ?>
                  <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
				<td class="left"><select name="multiflat[<?php echo $module_row; ?>][geo_zone_id]">
                <option value="0"><?php echo $text_all_zones; ?></option>
                <?php foreach ($geo_zones as $geo_zone) { ?>
                <?php if ($geo_zone['geo_zone_id'] == $module['geo_zone_id']) { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
				<td class="right"><select name="multiflat[<?php echo $module_row; ?>][status]">
                <?php if ($module['status']) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
				<td class="right"><input type="text" name="multiflat[<?php echo $module_row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" size="3" /></td>
				<td class="left"><a onclick="$('#module-row<?php echo $module_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
			  </tr>
			</tbody>
			<?php $module_row++; ?>
			<?php } ?>
			<tfoot>
			  <tr>
				<td colspan="6"></td>
				<td class="left"><a onclick="addModule();" class="button"><?php echo $button_add_module; ?></a></td>
			  </tr>
			</tfoot>
		  </table>
      </form>
    </div>
  </div>
	copyright &copy; <a href="mailto:ruslan.shv@gmail.com">Ruslan Shvarev</a>

</div>
<script type="text/javascript"><!--
var module_row = <?php echo $module_row; ?>;

function addModule() {
	html  = '<tbody id="module-row' + module_row + '">';
	html += '<tr>';
	html += '	<td class="left"><input type="text" name="multiflat[' + module_row + '][name]" size="40" /></td>';
	html += '	<td class="left"><input type="text" name="multiflat[' + module_row + '][cost]" size="5" /></td>';
	html += '	<td class="left"><select name="multiflat[' + module_row + '][tax_class_id]">';
	html += '	  <option value="0"><?php echo $text_none; ?></option>';
	<?php foreach ($tax_classes as $tax_class) { ?>
		html += '	  <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>';
    <?php } ?>
	html += '	</select></td>';
	html += '	<td class="left"><select name="multiflat[' + module_row + '][geo_zone_id]">';
	html += '	<option value="0"><?php echo $text_all_zones; ?></option>';
    <?php foreach ($geo_zones as $geo_zone) { ?>
		html += '	<option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>';
    <?php } ?>
	html += '	</select></td>';
	html += '	<td class="right"><select name="multiflat[' + module_row + '][status]">';
	html += '	<option value="1"><?php echo $text_enabled; ?></option>';
	html += '	<option value="0" selected="selected"><?php echo $text_disabled; ?></option>';
	html += '	</select></td>';
	html += '	<td class="right"><input type="text" name="multiflat[' + module_row + '][sort_order]" size="3" /></td>';
	html += '	<td class="left"><a onclick="$(\'#module-row' + module_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '	</tr>';
	html += '</tbody>';

	$('#module tfoot').before(html);

	module_row++;
}
//--></script>
<?php echo $footer; ?>