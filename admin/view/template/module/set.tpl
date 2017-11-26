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
    <?php if ($success) { ?>
        <div class="success"><?php echo $success; ?></div>
    <?php } ?>    
	<div class="box">
    <div class="heading">
		<h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
		<div class="buttons">
			<a onclick="location = '<?php echo $batch; ?>';" class="button"><span><?php echo 'Пакетное формирование'; ?></span></a>
			<a onclick="location = '<?php echo $sets; ?>';" class="button"><span><?php echo $button_sets; ?></span></a>
			<a onclick="buttonSave();" class="button"><?php echo $button_save_stay; ?></a>
			<a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a>
		</div>
    </div>
    
    
    <div class="content">
		
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form" name="setform">
            
            <table class="form">
                <tr>
                    <td><?php echo $entry_place; ?></td>
                    <td>
                        <select name="set_place_product_page">
                            <option value="before_tabs" <?php if($set_place_product_page=='before_tabs'){?>selected="selected"<?php } ?>><?php echo $text_before_tabs; ?></option>
                            <option value="in_tabs" <?php if($set_place_product_page=='in_tabs'){?>selected="selected"<?php } ?>><?php echo $text_in_tabs; ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $entry_image_size_product_page; ?></td>
                    <td>
                        <input type="text" name="set_product_page_image_width" value="<?php echo $set_product_page_image_width; ?>" size="3" /> x 
                        <input type="text" name="set_product_page_image_height" value="<?php echo $set_product_page_image_height; ?>" size="3" />                        
                    </td>
                </tr>
                <tr>
                    <td><?php echo $entry_image_size_product_page_card; ?></td>
                    <td>
                        <input type="text" name="set_product_page_card_image_width" value="<?php echo $set_product_page_card_image_width; ?>" size="3" /> x 
                        <input type="text" name="set_product_page_card_image_height" value="<?php echo $set_product_page_card_image_height; ?>" size="3" />                        
                    </td>
                </tr>                                 
            </table>
			
			<table id="module" class="list">
			<thead>
				<tr>
                    <td class="left"><?php echo $entry_image; ?></td>
					<td class="left"><?php echo $entry_layout; ?></td>
                    <td class="left"><?php echo $entry_checkcategory; ?></td>
                    <td class="left"><?php echo $entry_quantityshow; ?></td>
					<td class="left"><?php echo $entry_position; ?></td>
					<td class="left"><?php echo $entry_status; ?></td>	
					<td class="left"><?php echo $entry_sort_order; ?></td>
					<td></td>
				</tr>
			</thead>
            <?php $module_row = 0; ?>
            <?php foreach ($modules as $module) { ?>
            <tbody id="module-row<?php echo $module_row; ?>">
				<tr>
                <td class="left">
                    <input type="text" name="set_module[<?php echo $module_row; ?>][image_width]" value="<?php echo $module['image_width']; ?>" size="3" /> x 
                    <input type="text" name="set_module[<?php echo $module_row; ?>][image_height]" value="<?php echo $module['image_height']; ?>" size="3" />
                </td>
                <td class="left">
					<select name="set_module[<?php echo $module_row; ?>][layout_id]">
                    <?php foreach ($layouts as $layout) { ?>
                    <?php if ($layout['layout_id'] == $module['layout_id']) { ?>
						<option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                    <?php } else { ?>
						<option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                    <?php } ?>
                    <?php } ?>
					</select>
				</td>
                <td class="center">
                    <?php if(isset($module['check_category'])){ ?>
                        <input type="checkbox" name="set_module[<?php echo $module_row; ?>][check_category]" value="1" checked="checked" />
                    <?php } else { ?>
                        <input type="checkbox" name="set_module[<?php echo $module_row; ?>][check_category]" value="1" />
                    <?php }?>
                </td>
                <td class="center">
                    <input type="text" name="set_module[<?php echo $module_row; ?>][quantityshow]" value="<?php echo $module['quantityshow']; ?>" size="3" />
                </td>
                <td class="left">
					<select name="set_module[<?php echo $module_row; ?>][position]">
                    <?php if ($module['position'] == 'content_top') { ?>
                        <option value="content_top" selected="selected"><?php echo $text_content_top; ?></option>
                    <?php } else { ?>
                        <option value="content_top"><?php echo $text_content_top; ?></option>
                    <?php } ?>
                    <?php if ($module['position'] == 'content_bottom') { ?>
                        <option value="content_bottom" selected="selected"><?php echo $text_content_bottom; ?></option>
                    <?php } else { ?>
                        <option value="content_bottom"><?php echo $text_content_bottom; ?></option>
                    <?php } ?>
					</select>
				</td>
                <td class="left">
					<select name="set_module[<?php echo $module_row; ?>][status]">
                    <?php if ($module['status']) { ?>
						<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
						<option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
						<option value="1"><?php echo $text_enabled; ?></option>
						<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
					</select>
				</td>
                <td class="center"><input type="text" name="set_module[<?php echo $module_row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" size="3" /></td>
                <td class="center"><a onclick="$('#module-row<?php echo $module_row; ?>').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>
				</tr>
            </tbody>
            <?php $module_row++; ?>
            <?php } ?>
            <tfoot>
				<tr>
                <td colspan="7"></td>
                <td class="center"><a onclick="addModule();" class="button"><span><?php echo $button_add_module; ?></span></a></td>
				</tr>
            </tfoot>
        </table>
      </form>
    </div>
	</div>

</div>

<script type="text/javascript"><!--

    setTimeout(function() {
        $('.success').hide('slow');
    }, 2000);

var module_row = <?php echo $module_row; ?>;

function addModule() {	
	html  = '<tbody id="module-row' + module_row + '">';
	html += '  <tr>';
    html += '    <td class="left"><input type="text" name="set_module[' + module_row + '][image_width]" value="120" size="3" /> x <input type="text" name="set_module[' + module_row + '][image_height]" value="120" size="3" /></td>';
	html += '    <td class="left"><select name="set_module[' + module_row + '][layout_id]">';
	<?php foreach ($layouts as $layout) { ?>
	html += '      	<option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>';
	<?php } ?>
	html += '    </select></td>';
    html += '    <td class="center"><input type="checkbox" name="set_module[' + module_row + '][check_category]" value="1" /></td>';
    html += '    <td class="center"><input type="text" name="set_module[' + module_row + '][quantityshow]" value="5" size="3" /></td>';
	html += '    <td class="left"><select name="set_module[' + module_row + '][position]">';
	html += '      	<option value="content_top"><?php echo $text_content_top; ?></option>';
	html += '      	<option value="content_bottom"><?php echo $text_content_bottom; ?></option>';
	html += '    </select></td>';
	html += '    <td class="left"><select name="set_module[' + module_row + '][status]">';
    html += '      	<option value="1" selected="selected"><?php echo $text_enabled; ?></option>';
    html += '      	<option value="0"><?php echo $text_disabled; ?></option>';
    html += '    </select></td>';
	html += '    <td class="center"><input type="text" name="set_module[' + module_row + '][sort_order]" value="" size="3" /></td>';
	html += '    <td class="center"><a onclick="$(\'#module-row' + module_row + '\').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#module tfoot').before(html);
	
	module_row++;
}
//--></script>

<script type="text/javascript">
function buttonSave() {$('#form').submit();}
</script>

<?php echo $footer; ?>