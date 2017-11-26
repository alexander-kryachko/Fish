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
                <td><span class="required">*</span> <?php echo $promotion_name; ?></td>
                <td><input type="text" name="promotion_description[<?php echo $language['language_id']; ?>][name]" size="100" value="<?php echo isset($promotion_description[$language['language_id']]['name']) ? $promotion_description[$language['language_id']]['name'] : ''; ?>" />
                  <?php if (isset($error_name[$language['language_id']])) { ?>
                  <span class="error"><?php echo $error_name[$language['language_id']]; ?></span>
                  <?php } ?>
                </td>
              </tr>
              
              <tr>
                <td><?php echo $promotion_products; ?></td>
                <td><input type="text" name="promotion_description[<?php echo $language['language_id']; ?>][product]" value="" /></td>
              </tr>
              <tr>
                <td><?php echo $promotion_category_products; ?></td>
                <td><input type="text" name="promotion_description[<?php echo $language['language_id']; ?>][category]" value="" /></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><div id="products<?php echo $language['language_id']; ?>" class="scrollbox">
                    <?php $class = 'odd'; ?>
                    <?php if (isset($promotion_description[$language['language_id']]['products']) && is_array($promotion_description[$language['language_id']]['products'])) { ?>
                      <?php foreach ($promotion_description[$language['language_id']]['products'] as $promotion_product_id => $promotion_product_name) { ?>
                      <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                      <div id="promotion-roduct<?php echo $language['language_id']; ?><?php echo $promotion_product_id; ?>" class="<?php echo $class; ?>"><?php echo $promotion_product_name; ?><img src="view/image/delete.png" alt="" /><input type="hidden" name="promotion_description[<?php echo $language['language_id']; ?>][products][]" value="<?php echo $promotion_product_id; ?>" />
                      </div>
                      <?php } ?>
                    <?php } ?>
                  </div>
                </td>
              </tr>
              
              <tr>               
                <td><?php echo $promotion_gift; ?></td>
                <td><input type="text" name="promotion_description[<?php echo $language['language_id']; ?>][gift_name]" value="<?php echo isset($promotion_description[$language['language_id']]['gift_name']) ? $promotion_description[$language['language_id']]['gift_name'] : ''; ?>" id="gift_name<?php echo $language['language_id']; ?>" />
                <input type="hidden" name="promotion_description[<?php echo $language['language_id']; ?>][gift_id]" value="<?php echo isset($promotion_description[$language['language_id']]['gift_id']) ? $promotion_description[$language['language_id']]['gift_id'] : ''; ?>" id="gift_id<?php echo $language['language_id']; ?>" />
                <a onclick="delete_gift(<?php echo $language['language_id']; ?>); return false;"><?php echo $button_delete; ?></a>
                </td>
              </tr>
              
              <tr>
                <td><?php echo $promotion_image; ?></td>
                <td valign="top"><div class="image"><img src="<?php echo $thumb[$language['language_id']]; ?>" alt="" id="thumb<?php echo $language['language_id']; ?>" />
                  <input type="hidden" name="promotion_description[<?php echo $language['language_id']; ?>][image]" value="<?php echo isset($promotion_description[$language['language_id']]['image']) ? $promotion_description[$language['language_id']]['image'] : ''; ?>" id="image<?php echo $language['language_id']; ?>" />
                  <br />
                  <a onclick="image_upload('image<?php echo $language['language_id']; ?>', 'thumb<?php echo $language['language_id']; ?>');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb<?php echo $language['language_id']; ?>').attr('src', '<?php echo $no_image; ?>'); $('#image<?php echo $language['language_id']; ?>').attr('value', '');"><?php echo $text_clear; ?></a></div>
                  <?php if (isset($error_image[$language['language_id']])) { ?>
                  <span class="error"><?php echo $error_image[$language['language_id']]; ?></span>
                  <?php } ?>  
                </td>
              </tr>

              <tr>
                <td><?php echo $promotion_date_start; ?></td>
                <td><input type="text" name="promotion_description[<?php echo $language['language_id']; ?>][date_start]" value="<?php echo isset($promotion_description[$language['language_id']]['date_start']) ? $promotion_description[$language['language_id']]['date_start'] : ''; ?>" id="date-start<?php echo $language['language_id']; ?>" size="12" />
                </td>
              </tr>
              
              <tr>
                <td><?php echo $promotion_date_end; ?></td>
                <td><input type="text" name="promotion_description[<?php echo $language['language_id']; ?>][date_end]" value="<?php echo isset($promotion_description[$language['language_id']]['date_end']) ? $promotion_description[$language['language_id']]['date_end'] : ''; ?>" id="date-end<?php echo $language['language_id']; ?>" size="12" />
                </td>
              </tr>

              <tr>
                <td><?php echo $promotion_status; ?></td>
                <td>
                  <select name="promotion_description[<?php echo $language['language_id']; ?>][status]">
                    <option value="0" <?php echo !isset($promotion_description[$language['language_id']]['status']) || !$promotion_description[$language['language_id']]['status'] ? 'selected="selected"' : ''; ?>><?php echo $promotion_disable; ?></option>
                    <option value="1" <?php echo isset($promotion_description[$language['language_id']]['status']) && $promotion_description[$language['language_id']]['status'] ? 'selected="selected"' : ''; ?>><?php echo $promotion_enable; ?></option>
                  </select>  
                  
                </td>
              </tr>

              <tr>
                <td><?php echo $promotion_description_text; ?></td>
                <td><textarea name="promotion_description[<?php echo $language['language_id']; ?>][description]" id="description<?php echo $language['language_id']; ?>" style="visibility: hidden_; display: none_;" ><?php echo isset($promotion_description[$language['language_id']]['description']) ? $promotion_description[$language['language_id']]['description'] : ''; ?></textarea>
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

function giftautocomplete(attribute_row) {
	$('input[name=\'promotion_description[' + attribute_row + '][gift_name]\']').autocomplete({
		delay: 500,
		source: function(request, response) {
			$.ajax({
				url: 'index.php?route=catalog/product/autocomplete&token&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
				dataType: 'json',
				success: function(json) {	
					response($.map(json, function(item) {
						return {
							label: item.name,
							value: item.product_id
						}
					}));
				}
			});
		}, 
		select: function(event, ui) {
			$('input[name=\'promotion_description[' + attribute_row + '][gift_name]\']').attr('value', ui.item.label);
			$('input[name=\'promotion_description[' + attribute_row + '][gift_id]\']').attr('value', ui.item.value);
			
			return false;
		},
		focus: function(event, ui) {
      		return false;
   		}
	});
}
function delete_gift(language_id) {
	$('input[name=\'promotion_description[' + language_id + '][gift_name]\']').attr('value', '');
	$('input[name=\'promotion_description[' + language_id + '][gift_id]\']').attr('value', '');
}

// Products
function productsautocomplete(language_id) {

  $('input[name=\'promotion_description[' + language_id + '][product]\']').autocomplete({
    delay: 500,
    source: function(request, response) {
      $.ajax({
        url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
        dataType: 'json',
        success: function(json) {		
          response($.map(json, function(item) {
            return {
              label: item.name,
              value: item.product_id
            }
          }));
        }
      });
    }, 
    select: function(event, ui) {
  
      $('#promotion-product' + language_id + ui.item.value).remove();

      $('#products' + language_id).append('<div id="promotion-product' + language_id + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="promotion_description[' + language_id + '][products][]" value="' + ui.item.value + '" /></div>');

      $('#products' + language_id + ' div:odd').attr('class', 'odd');
      $('#products' + language_id + ' div:even').attr('class', 'even');
      
      $('input[name=\'promotion_description[' + language_id + '][product]\']').attr('value', '');
  
      return false;
    },
    focus: function(event, ui) {
        return false;
     }
  });
}
// Category Products
function category_products_autocomplete(language_id) {

  $('input[name=\'promotion_description[' + language_id + '][category]\']').autocomplete({
    delay: 500,
    source: function(request, response) {
      $.ajax({
        url: 'index.php?route=catalog/category/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
        dataType: 'json',
        success: function(json) {		
          response($.map(json, function(item) {
            return {
              label: item.name,
              value: item.category_id
            }
          }));
        }
      });
    }, 
    select: function(event, ui) {
      
      $.ajax({
        url: 'index.php?route=module/promotion/productsAutocomplete&token=<?php echo $token; ?>&filter_category_id=' +  encodeURIComponent(ui.item.value),
        dataType: 'json',
        success: function(data) {          
          $.each(data, function(index, item) {
            $('#promotion-product' + language_id + item.product_id).remove();

            $('#products' + language_id).append('<div id="promotion-product' + language_id + item.product_id + '">' + item.name + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="promotion_description[' + language_id + '][products][]" value="' + item.product_id + '" /></div>');

            $('#products' + language_id + ' div:odd').attr('class', 'odd');
            $('#products' + language_id + ' div:even').attr('class', 'even');

          });  
        }
      });
  
      $('input[name=\'promotion_description[' + language_id + '][category]\']').attr('value', '');
      
      return false;
  
    },
    focus: function(event, ui) {
        return false;
     }
  });
}
  
function delete_product(language_id) {
  $('#products' + language_id + ' div img').live('click', function() {
	  $(this).parent().remove();
	
	  $('#products' + language_id + ' div:odd').attr('class', 'odd');
	  $('#products' + language_id + ' div:even').attr('class', 'even');	
  });  
}

function delete_gift(language_id) {
	$('input[name=\'promotion_description[' + language_id + '][gift_name]\']').attr('value', '');
	$('input[name=\'promotion_description[' + language_id + '][gift_id]\']').attr('value', '');
}
  
//--></script> 

<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script>

<?php foreach ($languages as $language) { ?>

<script type="text/javascript"><!--
  giftautocomplete(<?php echo $language['language_id']; ?>);

  productsautocomplete(<?php echo $language['language_id']; ?>);
  delete_product(<?php echo $language['language_id']; ?>);
  
  category_products_autocomplete(<?php echo $language['language_id']; ?>);
  
  $('#date-start<?php echo $language['language_id']; ?>').datepicker({dateFormat: 'yy-mm-dd'});
  $('#date-end<?php echo $language['language_id']; ?>').datepicker({dateFormat: 'yy-mm-dd'});


  CKEDITOR.replace('description<?php echo $language['language_id']; ?>', {
    filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
    filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
    filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
    filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
    filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
    filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
  });

//--></script> 

<?php } ?>

<?php echo $footer; ?>