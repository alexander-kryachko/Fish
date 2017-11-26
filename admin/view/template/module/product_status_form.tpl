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
      <h1><img src="view/image/category.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
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
                <td><span class="required">*</span> <?php echo $status_image; ?></td>
                <td valign="top"><div class="image"><img src="<?php echo $thumb[$language['language_id']]; ?>" alt="" id="thumb<?php echo $language['language_id']; ?>" />
                  <input type="hidden" name="status_description[<?php echo $language['language_id']; ?>][image]" value="<?php echo $status_description[$language['language_id']]['image']; ?>" id="image<?php echo $language['language_id']; ?>" />
                  <br />
                  <a onclick="image_upload('image<?php echo $language['language_id']; ?>', 'thumb<?php echo $language['language_id']; ?>');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb<?php echo $language['language_id']; ?>').attr('src', '<?php echo $no_image; ?>'); $('#image').attr('value', '');"><?php echo $text_clear; ?></a></div>
                  <?php if (isset($error_image[$language['language_id']])) { ?>
                  <span class="error"><?php echo $error_image[$language['language_id']]; ?></span>
                  <?php } ?>  
                </td>
              </tr>

              <tr>
                <td><span class="required">*</span> <?php echo $status_name; ?></td>
                <td><input type="text" name="status_description[<?php echo $language['language_id']; ?>][name]" size="100" value="<?php echo isset($status_description[$language['language_id']]['name']) ? $status_description[$language['language_id']]['name'] : ''; ?>" />
                  <?php if (isset($error_name[$language['language_id']])) { ?>
                  <span class="error"><?php echo $error_name[$language['language_id']]; ?></span>
                  <?php } ?>
                </td>
              </tr>
              
              <tr>
                <td><?php echo $status_url; ?></td>
                <td><input type="text" name="status_description[<?php echo $language['language_id']; ?>][url]" size="100" value="<?php echo isset($status_description[$language['language_id']]['url']) ? $status_description[$language['language_id']]['url'] : ''; ?>" />
                </td>
              </tr>
              
              <tr>
                <td><?php echo $status_sticker; ?></td>
                <td>
                  <select name="status_description[<?php echo $language['language_id']; ?>][sticker]">
                    <option value="" <?php echo !isset($status_description[$language['language_id']]['sticker']) || $status_description[$language['language_id']]['sticker']  == '' ? 'selected="selected"' : ''; ?>><?php echo $sticker_disable; ?></option>
                    <option value="left-top" <?php echo isset($status_description[$language['language_id']]['sticker']) && $status_description[$language['language_id']]['sticker']  == 'left-top' ? 'selected="selected"' : ''; ?>><?php echo $sticker_left_top; ?></option>
                    <option value="left-center" <?php echo isset($status_description[$language['language_id']]['sticker']) && $status_description[$language['language_id']]['sticker']  == 'left-center' ? 'selected="selected"' : ''; ?>><?php echo $sticker_left_center; ?></option>
                    <option value="left-bottom" <?php echo isset($status_description[$language['language_id']]['sticker']) && $status_description[$language['language_id']]['sticker']  == 'left-bottom' ? 'selected="selected"' : ''; ?>><?php echo $sticker_left_bottom; ?></option>
                    <option value="right-top" <?php echo isset($status_description[$language['language_id']]['sticker']) && $status_description[$language['language_id']]['sticker']  == 'right-top' ? 'selected="selected"' : ''; ?>><?php echo $sticker_right_top; ?></option>
                    <option value="right-center" <?php echo isset($status_description[$language['language_id']]['sticker']) && $status_description[$language['language_id']]['sticker']  == 'right-center' ? 'selected="selected"' : ''; ?>><?php echo $sticker_right_center; ?></option>
                    <option value="right-bottom" <?php echo isset($status_description[$language['language_id']]['sticker']) && $status_description[$language['language_id']]['sticker']  == 'right-bottom' ? 'selected="selected"' : ''; ?>><?php echo $sticker_right_bottom; ?></option>
                    <option value="center-top" <?php echo isset($status_description[$language['language_id']]['sticker']) && $status_description[$language['language_id']]['sticker']  == 'center-top' ? 'selected="selected"' : ''; ?>><?php echo $sticker_center_top; ?></option>
                    <option value="center" <?php echo isset($status_description[$language['language_id']]['sticker']) && $status_description[$language['language_id']]['sticker']  == 'center' ? 'selected="selected"' : ''; ?>><?php echo $sticker_center; ?></option>
                    <option value="center-bottom" <?php echo isset($status_description[$language['language_id']]['sticker']) && $status_description[$language['language_id']]['sticker']  == 'center-bottom' ? 'selected="selected"' : ''; ?>><?php echo $sticker_center_bottom; ?></option>
                  </select>  
                  
                </td>
              </tr>
                            
              <tr>
                <td><?php echo $sort_order; ?></td>
                <td><input type="text" name="status_description[<?php echo $language['language_id']; ?>][sort_order]" size="100" value="<?php echo isset($status_description[$language['language_id']]['sort_order']) ? $status_description[$language['language_id']]['sort_order'] : ''; ?>" />
                </td>
              </tr>
              
              <tr>
                <td><b><?php echo $status_auto; ?></b></td>
                <td>
                </td>
              </tr>

              <tr>
                <td><?php echo $status_attribute; ?></td>
                <td>
                  <input type="text" name="status_description[<?php echo $language['language_id']; ?>][attribute_name]" value="<?php echo isset($status_description[$language['language_id']]['attribute_name']) ? $status_description[$language['language_id']]['attribute_name'] : ''; ?>" />
                  <input type="hidden" name="status_description[<?php echo $language['language_id']; ?>][attribute_id]" value="<?php echo isset($status_description[$language['language_id']]['attribute_id']) ? $status_description[$language['language_id']]['attribute_id'] : ''; ?>" />
                  <a onclick="delete_attribute(<?php echo $language['language_id']; ?>); return false;"><?php echo $button_delete; ?></a>
                </td>
              </tr>
              
              <tr>
                <td><?php echo $status_attribute_value; ?><br /><?php echo $status_attribute_value_help; ?></td>
                <td><input type="text" name="status_description[<?php echo $language['language_id']; ?>][attribute_value]" size="100" value="<?php echo isset($status_description[$language['language_id']]['attribute_value']) ? $status_description[$language['language_id']]['attribute_value'] : ''; ?>" />
                </td>
              </tr>
              
              <tr>
                <td><?php echo $status_manufacturer; ?></td>
                <td>
                  <select name="status_description[<?php echo $language['language_id']; ?>][manufacturer_id]">
                    <option value="0" selected="selected"><?php echo $text_none; ?></option>
                    <?php foreach ($manufacturers as $manufacturer) { ?>
                      <?php if (isset($status_description[$language['language_id']]['manufacturer_id']) && $manufacturer['manufacturer_id'] == $status_description[$language['language_id']]['manufacturer_id']) { ?>
                        <option value="<?php echo $manufacturer['manufacturer_id']; ?>" selected="selected"><?php echo $manufacturer['name']; ?></option>
                      <?php } else { ?>
                        <option value="<?php echo $manufacturer['manufacturer_id']; ?>"><?php echo $manufacturer['name']; ?></option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                </td>
              </tr>
              
              <tr>
                <td><?php echo $status_category; ?></td>
                <td>
                  <select name="status_description[<?php echo $language['language_id']; ?>][category_id]">
                    <option value="0" selected="selected"><?php echo $text_none; ?></option>
                    <?php foreach ($categories as $product_category) { ?>
                      <?php if (isset($status_description[$language['language_id']]['category_id']) && $product_category['category_id'] == $status_description[$language['language_id']]['category_id']) { ?>
                        <option value="<?php echo $product_category['category_id']; ?>" selected="selected"><?php echo $product_category['name']; ?></option>
                      <?php } else { ?>
                        <option value="<?php echo $product_category['category_id']; ?>"><?php echo $product_category['name']; ?></option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                </td>
              </tr>
              
              <tr>
                <td><?php echo $status_price; ?></td>
                <td><?php echo $status_price_from; ?>: <input type="text" name="status_description[<?php echo $language['language_id']; ?>][price_from]" size="20" value="<?php echo isset($status_description[$language['language_id']]['price_from']) ? $status_description[$language['language_id']]['price_from'] : ''; ?>" /> <?php echo $status_price_to; ?>: <input type="text" name="status_description[<?php echo $language['language_id']; ?>][price_to]" size="20" value="<?php echo isset($status_description[$language['language_id']]['price_to']) ? $status_description[$language['language_id']]['price_to'] : ''; ?>" />
                </td>
              </tr>
              
              <tr>
                <td><?php echo $status_stock; ?></td>
                <td><?php echo $status_stock_from; ?>: <input type="text" name="status_description[<?php echo $language['language_id']; ?>][stock_from]" size="20" value="<?php echo isset($status_description[$language['language_id']]['stock_from']) ? $status_description[$language['language_id']]['stock_from'] : ''; ?>" /> <?php echo $status_stock_to; ?>: <input type="text" name="status_description[<?php echo $language['language_id']; ?>][stock_to]" size="20" value="<?php echo isset($status_description[$language['language_id']]['stock_to']) ? $status_description[$language['language_id']]['stock_to'] : ''; ?>" />
                </td>
              </tr>
              
              <tr>
                <td><?php echo $status_new; ?></td>
                <td><input type="checkbox" name="status_description[<?php echo $language['language_id']; ?>][new]" value="1" <?php echo isset($status_description[$language['language_id']]['new']) && $status_description[$language['language_id']]['new'] ? 'checked="checked"' : ''; ?> />
                </td>
              </tr>

              <tr>
                <td><?php echo $status_bestseller; ?></td>
                <td><input type="checkbox" name="status_description[<?php echo $language['language_id']; ?>][bestseller]" value="1" <?php echo isset($status_description[$language['language_id']]['bestseller']) && $status_description[$language['language_id']]['bestseller'] ? 'checked="checked"' : ''; ?> />
                </td>
              </tr>
              
              <tr>
                <td><?php echo $status_popular; ?></td>
                <td><input type="checkbox" name="status_description[<?php echo $language['language_id']; ?>][popular]" value="1" <?php echo isset($status_description[$language['language_id']]['popular']) && $status_description[$language['language_id']]['popular'] ? 'checked="checked"' : ''; ?> />
                </td>
              </tr>

              <tr>
                <td><?php echo $status_special; ?></td>
                <td><input type="checkbox" name="status_description[<?php echo $language['language_id']; ?>][special]" value="1" <?php echo isset($status_description[$language['language_id']]['special']) && $status_description[$language['language_id']]['special'] ? 'checked="checked"' : ''; ?> />
                </td>
              </tr>
              
              <tr>
                <td><?php echo $status_promotion; ?><br/><?php echo $status_promotion_help; ?></td>
                <td><input type="checkbox" name="status_description[<?php echo $language['language_id']; ?>][promotion]" value="1" <?php echo isset($status_description[$language['language_id']]['promotion']) && $status_description[$language['language_id']]['promotion'] ? 'checked="checked"' : ''; ?> /> <br/> <?php echo $status_promotion_image; ?><input type="checkbox" name="status_description[<?php echo $language['language_id']; ?>][promotion_image]" value="1" <?php echo isset($status_description[$language['language_id']]['promotion_image']) && $status_description[$language['language_id']]['promotion_image'] ? 'checked="checked"' : ''; ?> />
                </td>
              </tr>

            </table>
          </div>
          <?php } ?>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
function image_upload(field, thumb) {
	$('#dialog').remove();
	
	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: '<?php echo $text_image_manager; ?>',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).val()),
					dataType: 'text',
					success: function(data) {
						$('#' + thumb).replaceWith('<img src="' + data + '" alt="" id="' + thumb + '" />');
					}
				});
			}
		},	
		bgiframe: false,
		width: 800,
		height: 400,
		resizable: false,
		modal: false
	});
};
//--></script> 
<script type="text/javascript"><!--
$('#languages a').tabs();
//--></script> 
<script type="text/javascript"><!--
$.widget('custom.catcomplete', $.ui.autocomplete, {
	_renderMenu: function(ul, items) {
		var self = this, currentCategory = '';
		
		$.each(items, function(index, item) {
			if (item.category != currentCategory) {
				ul.append('<li class="ui-autocomplete-category">' + item.category + '</li>');
				
				currentCategory = item.category;
			}
			
			self._renderItem(ul, item);
		});
	}
});
    
function attributeautocomplete(attribute_row) {

	$('input[name=\'status_description[' + attribute_row + '][attribute_name]\']').catcomplete({
		delay: 500,
		source: function(request, response) {
			$.ajax({
				url: 'index.php?route=catalog/attribute/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
				dataType: 'json',
				success: function(json) {	
					response($.map(json, function(item) {
						return {
							category: item.attribute_group,
							label: item.name,
							value: item.attribute_id
						}
					}));
				}
			});
		}, 
		select: function(event, ui) {
			$('input[name=\'status_description[' + attribute_row + '][attribute_name]\']').attr('value', ui.item.label);
			$('input[name=\'status_description[' + attribute_row + '][attribute_id]\']').attr('value', ui.item.value);
			
			return false;
		},
		focus: function(event, ui) {
      		return false;
   		}
	});
}
function delete_attribute(language_id) {
	$('input[name=\'status_description[' + language_id + '][attribute_name]\']').attr('value', '');
	$('input[name=\'status_description[' + language_id + '][attribute_id]\']').attr('value', '');
}
//--></script> 
<?php foreach ($languages as $language) { ?>
<script type="text/javascript"><!--
  attributeautocomplete(<?php echo $language['language_id']; ?>);
//--></script> 
<?php } ?>
  
<?php echo $footer; ?>