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
  <div class="heading"><h1><img src="view/image/category.png" alt="" /> <?php echo $heading_title; ?></h1></div>
    <div class="content">
	<div id="tabs" class="htabs"><a href="#tab-2">Список пунктов меню</a><a href="#tab-1">Настройки модулей</a></div>
	<div id="tab-1" class="tab-content">
      <div class="buttons">
	  <a onclick="$('#form_2 input[name=apply]').val(1); $('#form_2').submit();" class="button"><?php echo $button_apply; ?></a>
	  <a onclick="$('#form_2').submit();" class="button"><?php echo $button_save; ?></a>
	  <a href="<?php echo $cancel_mod; ?>" class="button"><?php echo $button_cancel; ?></a>
	  </div>
	    <div class="content">
      <form action="<?php echo $action_mod; ?>" method="post" enctype="multipart/form-data" id="form_2">
        <table id="module" class="list">
          <thead>
            <tr>
				<td class="left"><?php echo $entry_head; ?></td>
				<td class="left"><?php echo $entry_style; ?></td>
				<td class="left">Показывать в модуле эти пункты меню:</td>
				<td class="left"><?php echo $entry_layout; ?></td>
				<td class="left"><?php echo $entry_position; ?></td>
				<td class="left"><?php echo $entry_status; ?></td>
				<td class="right"><?php echo $entry_sort_order; ?></td>
				<td></td>
            </tr>
          </thead>
          <?php $module_row = 0; $module['in_module'] = 0; ?>
          <?php foreach ($modules as $module) { ?>
          <tbody id="module-row<?php echo $module_row; ?>">
            <tr>
			<td class="left" style="padding:16px 6px 0;">
			<?php foreach ($languages as $language) { ?>
			<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="display:inline-block; vertical-align:middle; float:left;" />
				<input type="text" name="custom_menu_module[<?php echo $module_row; ?>][<?php echo $language['code']; ?>][head]" value="<?php if(isset($module[$language['code']]['head'])) { echo $module[$language['code']]['head']; } ?>" size="15" />
				<br /><br />
			<?php } ?>
			</td>
			<td class="left">
			<select name="custom_menu_module[<?php echo $module_row; ?>][style]">
                <?php if ($module['style']) { ?>
                <option value="1" selected="selected"><?php echo $text_style_module; ?></option>
				<option value="0"><?php echo $text_style_template; ?></option>
                <?php } else { ?>
                <option value="0" selected="selected"><?php echo $text_style_template; ?></option>
				<option value="1"><?php echo $text_style_module; ?></option>
                <?php } ?>
             </select>
			 </td>
			 <td>
			 <div class="scrollbox" style="margin:6px 0;">
	<?php $class = 'odd'; ?>
	<?php if ($custom_menus1) { ?>
	<?php foreach ($custom_menus1 as $custom_menu) { ?>
	<?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
    <div class="<?php echo $class; ?>">
	<?php if (in_array($custom_menu['menu_id'], $module['in_module'])) { ?>
		<input type="checkbox" name="custom_menu_module[<?php echo $module_row; ?>][in_module][]" value="<?php echo $custom_menu['menu_id']; ?>" checked="checked" />
		<?php echo $custom_menu['name']; ?> 
	<?php } else { ?>
		<input type="checkbox" name="custom_menu_module[<?php echo $module_row; ?>][in_module][]" value="<?php echo $custom_menu['menu_id']; ?>" />
		<?php echo $custom_menu['name']; ?> 	
	<?php } ?>	
	</div>
	<?php } ?>		
<?php } ?>	
    </div>
	<a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a><div style="height:10px;"></div>
			 </td>
			
              <td class="left"><select name="custom_menu_module[<?php echo $module_row; ?>][layout_id]">
                  <?php foreach ($layouts as $layout) { ?>
                  <?php if ($layout['layout_id'] == $module['layout_id']) { ?>
                  <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
              <td class="left"><select name="custom_menu_module[<?php echo $module_row; ?>][position]">
                  <?php if ($module['position'] == 'column_left') { ?>
                  <option value="column_left" selected="selected"><?php echo $text_column_left; ?></option>
                  <?php } else { ?>
                  <option value="column_left"><?php echo $text_column_left; ?></option>
                  <?php } ?>
                  <?php if ($module['position'] == 'column_right') { ?>
                  <option value="column_right" selected="selected"><?php echo $text_column_right; ?></option>
                  <?php } else { ?>
                  <option value="column_right"><?php echo $text_column_right; ?></option>
                  <?php } ?>
				   <?php if ($module['position'] == 'header') { ?> 
 <option value="header" selected="selected"><?php echo $text_header; ?></option>
 <?php } else { ?>
 <option value="header"><?php echo $text_header; ?></option>
 <?php } ?>
                </select></td>
              <td class="left"><select name="custom_menu_module[<?php echo $module_row; ?>][status]">
                  <?php if ($module['status']) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
              <td class="right"><input type="text" name="custom_menu_module[<?php echo $module_row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" size="3" /></td>
              <td class="left"><a onclick="$('#module-row<?php echo $module_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
            </tr>
          </tbody>
          <?php $module_row++; ?>
          <?php } ?>
          <tfoot>
            <tr>
              <td colspan="7"></td>
              <td class="left"><a onclick="addModule();" class="button"><?php echo $button_add_module; ?></a></td>
            </tr>
          </tfoot>
        </table>
		<input type="hidden" name="apply" value="0" />
      </form>
    </div>
	</div>
	
	<div id="tab-2" class="tab-content">
      <div class="buttons">
	  <a href="<?php echo $insert; ?>" class="button"><?php echo $button_insert; ?></a>
	  <a onclick="$('#form').submit();" class="button"><?php echo $button_delete; ?></a>
	  </div>
    <div class="content">
      <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="left"><?php if ($sort == 'id.title') { ?>
                <a href="<?php echo $sort_title; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_title; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_title; ?>"><?php echo $column_title; ?></a>
                <?php } ?></td> 
				
              <td class="left"><?php if ($sort == 'i.sort_order') { ?>
                <a href="<?php echo $sort_sort_order; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_link; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_sort_order; ?>"><?php echo $column_link; ?></a>
                <?php } ?></td>
				<td class="left"><?php if ($sort == 'id.title') { ?>
                <a href="<?php echo $sort_sort_order; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_sort_order; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_title; ?>"><?php echo $column_sort_order; ?></a>
                <?php } ?></td>
				<td class="right"><?php echo $text_status; ?></td>
              <td class="right"><?php echo $column_action; ?></td>
            </tr>
          </thead>
          <tbody>
            <?php if ($custom_menus) { ?>
            <?php foreach ($custom_menus as $custom_menu) { ?>
            <tr>
              <td style="text-align: center;"><?php if ($custom_menu['selected']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $custom_menu['menu_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $custom_menu['menu_id']; ?>" />
                <?php } ?></td>
              <td class="left">
			  <?php echo $custom_menu['name']; ?> 
			  </td>
              <td class="left"><?php echo $custom_menu['link']; ?></td>
              <td class="right"><?php echo $custom_menu['sort_order']; ?></td>
			  <td class="right"><?php if($custom_menu['status']) { ?><?php echo $text_enabled; ?><?php } else { ?><?php echo $text_disabled; ?><?php } ?></td>
              <td class="right"><?php foreach ($custom_menu['action'] as $action) { ?>
                [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                <?php } ?></td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="6"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </form>
      <div class="pagination"><?php echo $pagination; ?></div>
    </div>
	</div>
	<br /><br />
	<div class="copyright"><a href="http://oc-dev.ru">Oc-Dev.ru © 2014-2015</a> | Mail: <a href="mailto:sergey@oc-dev.ru">sergey@oc-dev.ru</div>
  </div>
</div>
</div>
<style>
	.tab-content .buttons {margin:-5px 0 10px; text-align:right; }
	.list .left img + input{ display:inline-block !important; float:right !important; margin-top:-16px; margin-left:22px;}
	.scrollbox {padding: 4px 0 0;}
	</style>
<script type="text/javascript"><!--
var module_row = <?php echo $module_row; ?>;

function addModule() {	
	html  = '<tbody id="module-row' + module_row + '">';
	html += '  <tr>';
	html += '<td class="left">';
	<?php foreach ($languages as $language) { ?>
	html += '<img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="display:inline-block; vertical-align:middle; float:left;" />';
	html += '<input type="text" name="custom_menu_module[' + module_row + '][<?php echo $language['code']; ?>][head]" value="" size="15" />';
	<?php } ?>
	html += '</td>';
	html += '<td class="left"><select name="custom_menu_module[' + module_row + '][style]">';
    html += '<option value="1" selected="selected"><?php echo $text_style_module; ?></option>';
	html += '<option value="0"><?php echo $text_style_template; ?></option>';
    html += '</select></td>';
	html += '<td><div class="scrollbox" style="margin-bottom:6px;">';
	<?php $class = 'odd'; ?>
	<?php foreach ($custom_menus as $custom_menu) { ?>
	<?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
	html += '<div class="<?php echo $class; ?>">';
	html += '<input type="checkbox" name="custom_menu_module[' + module_row + '][in_module][]" value="<?php echo $custom_menu['menu_id']; ?>" /><?php echo $custom_menu['name']; ?>';
	html += '<input style="display:none" type="checkbox" name="custom_menu_module[<?php echo $module_row; ?>][in_module][]" value="0" checked="checked" />';
	html += '</div>';
	<?php } ?>
	html += '</div>';
	html += '<a onclick="$(this).parent().find(\':checkbox\').attr(\'checked\', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(\':checkbox\').attr(\'checked\', false);"><?php echo $text_unselect_all; ?></a></td>';
	html += '    <td class="left"><select name="custom_menu_module[' + module_row + '][layout_id]">';
	<?php foreach ($layouts as $layout) { ?>
	html += '      <option value="<?php echo $layout['layout_id']; ?>"><?php echo addslashes($layout['name']); ?></option>';
	<?php } ?>
	html += '    </select></td>';
	html += '    <td class="left"><select name="custom_menu_module[' + module_row + '][position]">';
	html += '      <option value="content_top"><?php echo $text_content_top; ?></option>';
	html += '      <option value="content_bottom"><?php echo $text_content_bottom; ?></option>';
	html += '      <option value="column_left"><?php echo $text_column_left; ?></option>';
	html += '      <option value="column_right"><?php echo $text_column_right; ?></option>';
	html += '      <option value="header"><?php echo $text_header; ?></option>';
	html += '    </select></td>';
	html += '    <td class="left"><select name="custom_menu_module[' + module_row + '][status]">';
    html += '      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>';
    html += '      <option value="0"><?php echo $text_disabled; ?></option>';
    html += '    </select></td>';
	html += '    <td class="right"><input type="text" name="custom_menu_module[' + module_row + '][sort_order]" value="" size="3" /></td>';
	html += '    <td class="left"><a onclick="$(\'#module-row' + module_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#module tfoot').before(html);
	
	module_row++;
}
//--></script> 
<script type="text/javascript"><!--
$('#tabs a').tabs(); 
var hash = window.location.hash
if (hash == 'tab') {
	$('#tabs a').last().trigger('click');
}
//--></script> 
<?php echo $footer; ?>