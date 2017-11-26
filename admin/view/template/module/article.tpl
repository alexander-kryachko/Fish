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
      <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
          <div id="languages" class="htabs">
            <?php foreach ($languages as $language) { ?>
            <a href="#language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
            <?php } ?>
          </div>
          <?php foreach ($languages as $language) { ?>
          <div id="language<?php echo $language['language_id']; ?>">
	<table class="form">
          <tr>
            <td><?php echo $entry_heading; ?></td>
            <td><input type="text" name="article_module_heading_<?php echo $language['language_id']; ?>" value="<?php echo isset(${'article_module_heading_' . $language['language_id']}) ? ${'article_module_heading_' . $language['language_id']} : ''; ?>" />
            </td>
          </tr>
	   <tr>
            <td><?php echo $entry_articles_title; ?></td>
            <td><input style="width: 300px" type="text" name="article_module_title_<?php echo $language['language_id']; ?>" value="<?php echo isset(${'article_module_title_' . $language['language_id']}) ? ${'article_module_title_' . $language['language_id']} : ''; ?>" />
            </td>
          </tr>
          <tr>
            <td><?php echo $entry_articles_metadescription; ?></td>
            <td><textarea style="width: 300px; height: 50px" name="article_module_metadescription_<?php echo $language['language_id']; ?>" cols="40" rows="5"><?php echo isset(${'article_module_metadescription_' . $language['language_id']}) ? ${'article_module_metadescription_' . $language['language_id']} : ''; ?></textarea>
            </td>
          </tr>
	<tr>
            <td><?php echo $entry_description; ?></td>
            <td><textarea id="description<?php echo $language['language_id']; ?>" name="articles_description_<?php echo $language['language_id']; ?>" cols="80" rows="10"><?php echo isset(${'articles_description_' . $language['language_id']}) ? ${'articles_description_' . $language['language_id']} : ''; ?></textarea>
              <img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" style="vertical-align: top;" /><br />
	   </td>
          </tr>
	</div>
	</table>
        </div>
        <?php } ?>

	<table class="form">
	  <tr>
            <td><?php echo $entry_article_thumb_category; ?></td>
            <td><input type="text" name="article_thumb_category_width" value="<?php echo $article_thumb_category_width; ?>" size="3" /> x <input type="text" name="article_thumb_category_height" value="<?php echo $article_thumb_category_height; ?>" size="3" />
           </td>
          </tr>
	  <tr>
            <td><?php echo $entry_article_thumb; ?></td>
            <td><input type="text" name="article_thumb_width" value="<?php echo $article_thumb_width; ?>" size="3" /> x <input type="text" name="article_thumb_height" value="<?php echo $article_thumb_height; ?>" size="3" />
           </td>
          </tr>
	  <tr>
            <td><?php echo $entry_article_image; ?></td>
            <td><input type="text" name="article_image_width" value="<?php echo $article_image_width; ?>" size="3" /> x <input type="text" name="article_image_height" value="<?php echo $article_image_height; ?>" size="3" />
           </td>
          </tr>
	<tr>
	    <td><?php echo $entry_show_date; ?></td>
            <td>
		<?php if ($article_show_date) { ?>
		       <input type="checkbox" name="article_show_date" value="1" checked="checked" />
		<?php } else { ?>
		       <input type="checkbox" name="article_show_date" value="1" />
		<?php } ?>
            </td>
          </tr>
	<tr>
	    <td><?php echo $entry_show_views; ?></td>
            <td>
		<?php if ($article_show_views) { ?>
		       <input type="checkbox" name="article_show_views" value="1" checked="checked" />
		<?php } else { ?>
		       <input type="checkbox" name="article_show_views" value="1" />
		<?php } ?>
            </td>
          </tr>
	<tr>
	    <td><?php echo $entry_show_readmore; ?></td>
            <td>
		<?php if ($article_show_readmore) { ?>
		       <input type="checkbox" name="article_show_readmore" value="1" checked="checked" />
		<?php } else { ?>
		       <input type="checkbox" name="article_show_readmore" value="1" />
		<?php } ?>
            </td>
          </tr>
	<tr>
	    <td><?php echo $entry_show_latest; ?></td>
            <td>
		<?php if ($article_show_latest) { ?>
		       <input type="checkbox" name="article_show_latest" value="1" checked="checked" />
		<?php } else { ?>
		       <input type="checkbox" name="article_show_latest" value="1" />
		<?php } ?>
            </td>
          </tr>
          <tr>
            <td><?php echo $entry_show_root; ?></td>
            <td><select name="article_show_root">
                <?php foreach ($articles_root_types as $type_id => $name) { ?>
                <?php if ($type_id == $article_show_root) { ?>
                <option value="<?php echo $type_id; ?>" selected="selected"><?php echo $name; ?></option>
                <?php } else { ?>
                <option value="<?php echo $type_id; ?>"><?php echo $name; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
	  <tr>
            <td><?php echo $entry_article_limit; ?></td>
            <td><input type="text" name="article_page_limit" value="<?php echo $article_page_limit; ?>" size="3" />
            </td>
          </tr>
          <tr>
            <td><?php echo $entry_social; ?></td>
            <td><textarea name="article_social" cols="80" rows="5"><?php echo $article_social; ?></textarea>
            </td>
          </tr>
        </table>

	<br />
	<h2><?php echo $text_module_articles; ?></h2>
        <table id="module" class="list">
          <thead>
            <tr>
              <td class="left"><?php echo $entry_layout; ?></td>
              <td class="left"><?php echo $entry_position; ?></td>
              <td class="left"><?php echo $entry_status; ?></td>
              <td class="right"><?php echo $entry_sort_order; ?></td>
              <td></td>
            </tr>
          </thead>
          <?php $module_row = 0; ?>
          <?php foreach ($modules as $module) { ?>
          <tbody id="module-row<?php echo $module_row; ?>">
            <tr>
              <td class="left"><select name="article_module[<?php echo $module_row; ?>][layout_id]">
                  <?php foreach ($layouts as $layout) { ?>
                  <?php if ($layout['layout_id'] == $module['layout_id']) { ?>
                  <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                  <?php } else { ?>
                  <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                  <?php } ?>
                  <?php } ?>
                </select></td>
              <td class="left"><select name="article_module[<?php echo $module_row; ?>][position]">
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
                </select></td>
              <td class="left"><select name="article_module[<?php echo $module_row; ?>][status]">
                  <?php if ($module['status']) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
              <td class="right"><input type="text" name="article_module[<?php echo $module_row; ?>][sort_order]" value="<?php echo $module['sort_order']; ?>" size="3" /></td>
              <td class="left"><a onclick="$('#module-row<?php echo $module_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
            </tr>
          </tbody>
          <?php $module_row++; ?>
          <?php } ?>
          <tfoot>
            <tr>
              <td colspan="4"></td>
              <td class="left"><a onclick="addModule();" class="button"><?php echo $button_add_module; ?></a></td>
            </tr>
          </tfoot>
        </table>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
var module_row = <?php echo $module_row; ?>;

function addModule() {	
	html  = '<tbody id="module-row' + module_row + '">';
	html += '  <tr>';
	html += '    <td class="left"><select name="article_module[' + module_row + '][layout_id]">';
	<?php foreach ($layouts as $layout) { ?>
	html += '      <option value="<?php echo $layout['layout_id']; ?>"><?php echo addslashes($layout['name']); ?></option>';
	<?php } ?>
	html += '    </select></td>';
	html += '    <td class="left"><select name="article_module[' + module_row + '][position]">';
	html += '      <option value="content_top"><?php echo $text_content_top; ?></option>';
	html += '      <option value="content_bottom"><?php echo $text_content_bottom; ?></option>';
	html += '      <option value="column_left"><?php echo $text_column_left; ?></option>';
	html += '      <option value="column_right"><?php echo $text_column_right; ?></option>';
	html += '    </select></td>';
	html += '    <td class="left"><select name="article_module[' + module_row + '][status]">';
    html += '      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>';
    html += '      <option value="0"><?php echo $text_disabled; ?></option>';
    html += '    </select></td>';
	html += '    <td class="right"><input type="text" name="article_module[' + module_row + '][sort_order]" value="" size="3" /></td>';
	html += '    <td class="left"><a onclick="$(\'#module-row' + module_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#module tfoot').before(html);
	
	module_row++;
}
//--></script>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
CKEDITOR.replace('description<?php echo $language['language_id']; ?>', {
	filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
});
<?php } ?>
//--></script>
<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs();
//--></script> 
<?php echo $footer; ?>