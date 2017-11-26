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
   <div class="buttons">
    <a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a>
    <a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a>
   </div>
  </div>
  <div class="content">
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
	<table class="form">
    <tr>
      <td width="25%"><?php echo $entry_seo_url; ?></td>
      <td width="75%"><input type="text" name="seo_url" value="<?php echo $seo_url; ?>"  size="50" /></td>
    </tr>
		<tr>
        <td width="25%"><span class="required">*</span> <?php echo $entry_image; ?></td>
        <td width="75%">
        <input type="text" name="latests_in_recent[image_width]" value="<?php echo $latests_in_recent['image_width']; ?>" size="3" />&nbsp;x
        <input type="text" name="latests_in_recent[image_height]" value="<?php echo $latests_in_recent['image_height']; ?>" size="3" />
          <?php if ($error_image) { ?>
              <span class="error"><?php echo $error_image; ?></span>
          <?php } ?>
      </td>
		</tr>
    	<tr>
     		<td width="25%"><span class="required">*</span> <?php echo $entry_days; ?></td>
     		<td width="75%">
      			<input type="text" name="latests_in_recent[days]" value="<?php echo $latests_in_recent['days']; ?>" size="3"/>
      			<?php if ($error_days) { ?>
      				<span class="error"><?php echo $error_days; ?></span>
      			<?php } ?>
     		</td>
    	</tr>
    	<tr>
     		<td width="25%"><span class="required">*</span> <?php echo $entry_limit; ?></td>
     		<td width="75%">
      			<input type="text" name="latests_in_recent[limit]" value="<?php echo $latests_in_recent['limit']; ?>" size="3"/>
      			<?php if ($error_limit) { ?>
      				<span class="error"><?php echo $error_limit; ?></span>
      			<?php } ?>
     		</td>
    	</tr>
    	<tr>
     		<td width="25%"><?php echo $entry_hide_categories; ?></td>
     		<td width="75%">
      			<input type="checkbox" name="latests_in_recent[hide_categories]" value="1" <?php if (isset($latests_in_recent['hide_categories']) && $latests_in_recent['hide_categories']) { ?> checked="checked" <?php } ?> />
     		</td>
    	</tr>
    	<tr>
     		<td width="25%"><?php echo $entry_only_main_categories; ?><span class="help"><?php echo $help_only_main_categories; ?></span></td>
     		<td width="75%">
      			<input type="checkbox" name="latests_in_recent[main_categories]" value="1" <?php if ($latests_in_recent['main_categories']) { ?> checked="checked" <?php } ?> />
     		</td>
    	</tr>
    	<tr>
     		<td width="25%"><?php echo $entry_only_main_categories_h1; ?><span class="help"><?php echo $help_only_main_categories_h1; ?></span></td>
     		<td width="75%">
      			<input type="checkbox" name="latests_in_recent[main_show_h1]" value="1" <?php if ($latests_in_recent['main_show_h1']) { ?> checked="checked" <?php } ?> />
     		</td>
    	</tr>
      <?php if (version_compare(VERSION, '1.5.5', '>=')) { ?>
    	<tr>
     		<td width="25%"><?php echo $entry_show_category_images; ?></td>
     		<td width="75%">
      		<input type="checkbox" name="latests_in_recent[category_images]" value="1" <?php if ($latests_in_recent['category_images']) { ?> checked="checked" <?php } ?> />
     		</td>
    	</tr>
      <?php } else { ?>
        <input type="hidden" name="latests_in_recent[category_images]" value="0" />
      <?php } ?>
    	<tr>
     		<td width="25%"><?php echo $entry_product_count; ?></td>
     		<td width="75%">
      			<input type="checkbox" 
					<?php if ($latests_in_recent['product_count'] == 1) { ?> CHECKED <?php } ?> name="latests_in_recent[product_count]" value="1"/>
     		</td>
    	</tr>
      <tr>
        <td width="25%"><?php echo $entry_hide_outofstock; ?><span class="help"><?php echo $help_hide_outofstock; ?></span></td>
        <td width="75%"><input type="checkbox" name="latests_in_recent[hide_outofstock]" value="1" <?php if ($latests_in_recent['hide_outofstock']) { ?>checked="checked" <?php } ?> /></td>
      </tr>
      <tr>
        <td width="25%"><?php echo $entry_breadcrumbs_separate; ?></td>
        <td width="75%"><input type="checkbox" name="latests_in_recent[breadcrumbs_separate]" value="1" <?php if (isset($latests_in_recent['breadcrumbs_separate']) && $latests_in_recent['breadcrumbs_separate']) { ?>checked="checked" <?php } ?> /></td>
      </tr>
    	<tr>
     		<td width="25%"><?php echo $entry_display; ?></td>
     		<td width="75%">
				<select name="latests_in_recent[display]" style="width: 70px;">
					<?php foreach ($displays as $display) { ?>
						<?php if ($display['value'] == $latests_in_recent['display']) { ?>
		  					<option selected value="<?php echo $display['value']; ?>"><?php echo $display['text']; ?></option>
						<?php } else { ?>
		  					<option value="<?php echo $display['value']; ?>"><?php echo $display['text']; ?></option>
						<?php } ?>
					<?php } ?>
				</select>      			
     		</td>
    	</tr>
	</table>
	<div id="tab-general">
	  <div id="languages" class="htabs">
		<?php foreach ($languages as $language) { ?>
		<a href="#language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
		<?php } ?>
	  </div>
		<?php foreach ($languages as $language) { ?>
		  <div id="language<?php echo $language['language_id']; ?>">
			<table class="form">
			  <tr>
				<td><span class="required">*</span> <?php echo $entry_name; ?></td>
				<td><input type="text" name="latests_in_recent[description][<?php echo $language['language_id']; ?>][name]" maxlength="255" size="100" value="<?php echo isset($latests_in_recent['description'][$language['language_id']]) ? $latests_in_recent['description'][$language['language_id']]['name'] : ''; ?>" />
				  <?php if (isset($error_name[$language['language_id']])) { ?>
				  <span class="error"><?php echo $error_name[$language['language_id']]; ?></span>
				  <?php } ?></td>
			  </tr>
			  <tr>
				<td><?php echo $entry_seo_h1; ?></td>
				<td><input type="text" name="latests_in_recent[description][<?php echo $language['language_id']; ?>][seo_h1]" maxlength="255" size="100" value="<?php echo isset($latests_in_recent['description'][$language['language_id']]['seo_h1']) ? $latests_in_recent['description'][$language['language_id']]['seo_h1'] : ''; ?>" /></td>
			  </tr>
			  <tr>
				<td><?php echo $entry_seo_title; ?></td>
				<td><input type="text" name="latests_in_recent[description][<?php echo $language['language_id']; ?>][seo_title]" maxlength="255" size="100" value="<?php echo isset($latests_in_recent['description'][$language['language_id']]['seo_title']) ? $latests_in_recent['description'][$language['language_id']]['seo_title'] : ''; ?>" /></td>
			  </tr>
			  <tr>
				<td><?php echo $entry_meta_keyword; ?></td>
				<td><input type="text" name="latests_in_recent[description][<?php echo $language['language_id']; ?>][meta_keyword]" maxlength="255" size="100" value="<?php echo isset($latests_in_recent['description'][$language['language_id']]['meta_keyword']) ? $latests_in_recent['description'][$language['language_id']]['meta_keyword'] : ''; ?>" /></td>
			  </tr>
			  <tr>
				<td><?php echo $entry_meta_description; ?></td>
				<td><textarea name="latests_in_recent[description][<?php echo $language['language_id']; ?>][meta_description]" cols="100" rows="2"><?php echo isset($latests_in_recent['description'][$language['language_id']]['meta_description']) ? $latests_in_recent['description'][$language['language_id']]['meta_description'] : ''; ?></textarea></td>
			  </tr>
			  <tr>
				<td><?php echo $entry_description; ?></td>
				<td><textarea name="latests_in_recent[description][<?php echo $language['language_id']; ?>][description]" id="description<?php echo $language['language_id']; ?>"><?php echo isset($latests_in_recent['description'][$language['language_id']]['description']) ? $latests_in_recent['description'][$language['language_id']]['description'] : ''; ?></textarea></td>
			  </tr>
			</table>
		  </div>
		<?php } ?>
	</div>
   </form>
  </div>
 </div>
</div>
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