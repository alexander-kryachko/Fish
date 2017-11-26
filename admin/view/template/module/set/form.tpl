<?php echo $header; ?>
<style>
table.products_sets {
    border: 1px solid #000;
    width: 100%;
    border-collapse: collapse;
}
table.products_sets thead{
    background: #eee;
}
table.products_sets thead td{
    text-align: center;
    font-weight: bold;
}

table.products_sets td {
    border-left: 1px #000 solid;
    border-top: 1px #000 solid;
    padding: 5px;
    text-align: center; 
}

table.products_sets tbody td:first-child {
    text-align: left;
}
table.products_sets  .price-in-set {
    width: 15%;
    
}

table.products_sets tfoot td {
    text-align: left;
}
.info {
    color: #248847;
    font-size: 11px;
}

</style>

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
			<a onclick="showCostSet(); $('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a>
			<a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a>
		</div>
    </div>
    <div class="content">
		<div id="main-tabs" class="htabs"><a href="#tab-set"><?php echo $tab_set; ?></a>
		<!--a href="#tab-product"><?php echo $tab_product; ?></a-->
		</div>
        
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
            <div id="tab-set">
    			<div id="languages" class="htabs">
                <?php foreach ($languages as $language) { ?>
    				<a href="#language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                <?php } ?>
    			</div>
    			<?php foreach ($languages as $language) { ?>
    			<div id="language<?php echo $language['language_id']; ?>">
    				<table class="form">
    				<tr>
    					<td><span class="required">*</span> <?php echo $entry_setname; ?></td>
    					<td><input name="set_description[<?php echo $language['language_id']; ?>][name]" size="80" value="<?php echo isset($set_description[$language['language_id']]) ? $set_description[$language['language_id']]['name'] : ''; ?>" />
    						<?php if (isset($error_name[$language['language_id']])) { ?>
    							<span class="error"><?php echo $error_name[$language['language_id']]; ?></span>
    						<?php } ?>
    					</td>
    				</tr>
    				<!--tr>
    					<td><?php echo $entry_setdescription; ?></td>
    					<td>
                            <textarea name="set_description[<?php echo $language['language_id']; ?>][description]" id="description<?php echo $language['language_id']; ?>"><?php echo isset($set_description[$language['language_id']]) ? $set_description[$language['language_id']]['description'] : ''; ?></textarea>
    					</td>
    				</tr-->
    				</table>
    			</div>
    			<?php } ?>
                <table class="form">
                    <!--tr>
                        <td>
                            <?php echo $entry_setimage; ?>
                        </td>
                        <td>
                            <div class="image"><img src="<?php echo $set_thumb; ?>" alt="" id="set_thumb" /><br />
                                <input type="hidden" name="set_image" value="<?php echo $set_image; ?>" id="set_image" />
                                <a onclick="image_upload('set_image', 'set_thumb');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#set_thumb').attr('src', '<?php echo $no_image; ?>'); $('#set_image').attr('value', '');"><?php echo $text_clear; ?></a>
                            </div>                            
                        </td>
                    </tr-->
                    <tr>
                      <td><?php echo $entry_setcategory; ?></td>
                      <td><div class="scrollbox">
                          <?php $class = 'odd'; ?>
                          <?php foreach ($categories as $category) { ?>
                          <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                          <div class="<?php echo $class; ?>">
                            <?php if (in_array($category['category_id'], $set_categories)) { ?>
                            <input type="checkbox" name="set_category[]" value="<?php echo $category['category_id']; ?>" checked="checked" />
                            <?php echo $category['name']; ?>
                            <?php } else { ?>
                            <input type="checkbox" name="set_category[]" value="<?php echo $category['category_id']; ?>" />
                            <?php echo $category['name']; ?>
                            <?php } ?>
                          </div>
                          <?php } ?>
                        </div>
                        <a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a></td>
                    </tr>                    
                </table>
                
                <table class="form">
                <tr><td colspan="2"><?php echo $info_set_product; ?></td></tr>          
                <tr>
                  <td>
                    <?php echo $entry_choosecat; ?>
                  </td>
                  <td>
                    <select id="category" style="margin-bottom: 5px;" onchange="getProducts();">
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
                    <?php } ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td>
                    <?php echo $entry_product_set; ?>
                  </td>
                  <td>
                    <select multiple="multiple" id="product" size="10" style="width: 350px;">
                    </select>
                    <table style="display: inline; margin-left: 15px; vertical-align: top;">
                        <tr>
                          <td>
                            <?php echo $entry_product_set_search; ?>
                          </td>
                          <td>
                            <input type="text" name="product_set_search" value="" />
                          </td>
                        </tr>                    
                    </table>
                    
                    
                    <br />
                    <br />
                    <a  style="vertical-align: middle;" class="button" onclick="addProducts();" ><?php echo $button_add; ?></a>
                  </td>
                </tr>
    
    
                <tr>
                    <td colspan="2">
                        <table id="products_in_set" class="products_sets" style="display:none;"> 
                            <thead>
                                <tr><td><?php echo $column_name; ?></td><td><?php echo $column_current_price; ?></td><td class="price-in-set"><?php echo $column_price_in_set; ?>, %</td><td><?php echo $column_present; ?></td><td><?php echo $column_show_in_product; ?></td><td><?php echo $column_quantity; ?></td><td><?php echo $column_sort_order; ?></td><td><?php echo $column_remove; ?></td></tr>
                            </thead>
                            <?php $product_row = 0; ?>
                            <?php if($products) { ?>
                                <?php foreach ($products as $product) { ?>
                                <tbody id="product-row<?php echo $product_row; ?>">
                                    <tr>
                                        <td>
                                            <input type="hidden" class="product_id" name="product[<?php echo $product_row; ?>][product_id]" value="<?php echo $product['product_id']; ?>" /><input type="hidden" class="product_name" name="product[<?php echo $product_row; ?>][name]" value="<?php echo $product['name']; ?>" />
                                            <span class="name">
                                                <?php echo $product['name']; ?>
                                                <?php if($product['options']){?>
                                                    <br />
                                                    <?php foreach($product['options'] as $koption=>$voption){?>
                                                        <small> - <?php echo $koption; ?>: <?php echo $voption; ?></small><br />
                                                    <?php } ?>
                                                    
                                                <?php } ?>
                                            </span>
                                        </td>
                                        <td><input type="hidden" class="product_price" name="product[<?php echo $product_row; ?>][price]" value="<?php echo $product['price']; ?>" /><?php echo $product['price']; ?></td>
                                        <td class="price-in-set">
                                            <div class="priceset-block"  <?php if($product['present']){?> style="display:none;" <?php } ?>>
                                                <span class="required">*</span> <input type="text" class="price_in_set" name="product[<?php echo $product_row; ?>][price_in_set]" onkeypress="$('#text_total_set').fadeOut();$('#show_cost_set').fadeIn();" value="<?php echo $product['price_in_set']; ?>"  />
                                                <?php if($product['error_price_in_set']){?><br /><span class="error"><?php echo $error_price; ?></span><?php } ?>
                                            </div>
                                        </td>
                                        <td><input type="checkbox" class="present" onchange="present(this);" name="product[<?php echo $product_row; ?>][present]" value="1" <?php if($product['present']){?> checked="checked" <?php } ?> /></td>
                                        <td><input type="checkbox" name="product[<?php echo $product_row; ?>][show_in_product]" value="1" <?php if($product['show_in_product']){?> checked="checked" <?php } ?> /></td>
                                        <td>
                                            <span class="required">*</span> <input type="text" class="quantity" size="2" name="product[<?php echo $product_row; ?>][quantity]" onkeypress="$('#text_total_set').fadeOut();$('#show_cost_set').fadeIn();" value="<?php echo $product['quantity']; ?>" />
                                            <?php if($product['error_quantity']){?><br /><span class="error"><?php echo $error_quantity; ?></span><?php } ?>
                                        </td>
                                        <td><input type="text" name="product[<?php echo $product_row; ?>][sort_order]" size="2" value="<?php echo $product['sort_order']; ?>" /></td>
                                        <td><a onclick="removeFromSet('#product-row<?php echo $product_row; ?>', '<?php echo $product['product_id']; ?>');"><?php echo $text_remove; ?></a></td>
                                    </tr>
                                </tbody>
                                <?php $product_row++; ?>
                                <?php } ?>
                            <?php } ?>                        
                            
                            <tfoot style="display:none;">
                                <tr>
                                    <td colspan="8">
                                        <span id="text_total_set" style="display:none;"><span style="display:none"><?php echo $text_total_set; ?> <span id="total_set"><?php echo $total_set; ?></span></span></span> 
                                        <input type="hidden" name="total_set" value="<?php echo $total_set; ?>" />
                                        <!--a class="button" id="show_cost_set" onclick="showCostSet();"><?php echo $button_cost_set; ?></a--> 
                                    </td>
                                </tr>
                                <tr id="error-total" <?php if(!$error_total){?> style="display:none;" <?php } ?> ><td colspan="8"><span class="error"><?php echo $error_total; ?></span></td></tr>
                                
                            </tfoot>
                        </table>
                        <?php if($error_no_products){?><span class="error"><?php echo $error_no_products; ?></span><?php } ?>
                    </td>
                </tr>
                <tr>
                  <td><?php echo $entry_store; ?></td>
                  <td><div class="scrollbox">
                      <?php $class = 'even'; ?>
                      <div class="<?php echo $class; ?>">
                        <?php if (in_array(0, $set_store)) { ?>
                        <input type="checkbox" name="set_store[]" value="0" checked="checked" />
                        <?php echo $text_default; ?>
                        <?php } else { ?>
                        <input type="checkbox" name="set_store[]" value="0" />
                        <?php echo $text_default; ?>
                        <?php } ?>
                      </div>
                      <?php foreach ($stores as $store) { ?>
                      <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                      <div class="<?php echo $class; ?>">
                        <?php if (in_array($store['store_id'], $set_store)) { ?>
                        <input type="checkbox" name="set_store[]" value="<?php echo $store['store_id']; ?>" checked="checked" />
                        <?php echo $store['name']; ?>
                        <?php } else { ?>
                        <input type="checkbox" name="set_store[]" value="<?php echo $store['store_id']; ?>" />
                        <?php echo $store['name']; ?>
                        <?php } ?>
                      </div>
                      <?php } ?>
                    </div></td>
                </tr>            
                <tr>
                  <td><?php echo $entry_tax_class; ?></td>
                  <td><select name="tax_class_id">
                      <option value="0"><?php echo $text_none; ?></option>
                      <?php foreach ($tax_classes as $tax_class) { ?>
                      <?php if ($tax_class['tax_class_id'] == $tax_class_id) { ?>
                      <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select></td>
                </tr>            
                <tr>
                  <td><?php echo $entry_status; ?></td>
                  <td><select name="status">
                      <?php if ($status==1) { ?>
                          <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                          <option value="0"><?php echo $text_disabled; ?></option>
                      <?php } elseif ($status==-1) { ?>
                          <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                          <option value="0"><?php echo $text_disabled; ?></option>                          
                      <?php } else { ?>
                          <option value="1"><?php echo $text_enabled; ?></option>
                          <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                      <?php } ?>
                    </select></td>
                </tr>
                <tr>
                  <td><?php echo $entry_sort_order; ?></td>
                  <td><input type="text" name="sort_order" value="<?php echo $sort_order; ?>" size="2" /></td>
                </tr>          
              </table>
          
          </div>
          
          
          <div id="tab-product">
          
            <!--br /-->
            <div class="enable-productcard">
                <!--input type="checkbox" name="enable_productcard" id="enable-productcard" value="1" <?php if($enable_productcard){?> checked="checked" <?php } ?> /><label for="enable-productcard"><?php echo $text_enable_productcard; ?> </label-->
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
            </div>
            <!--br /-->
<!--start productcard-content-->            
            <div id="productcard-content">
                  <div id="productcart-tabs" class="htabs">
                    <a href="#tab-general"><?php echo $tab_general; ?></a>
                    <a href="#tab-data"><?php echo $tab_data; ?></a>
                    <a href="#tab-links"><?php echo $tab_links; ?></a>
                    <a href="#tab-image"><?php echo $tab_image; ?></a>
                    <a href="#tab-design"><?php echo $tab_design; ?></a>
                  </div>
                    <div id="tab-general">
                      <div id="product-languages" class="htabs">
                        <?php foreach ($languages as $language) { ?>
                        <a href="#product-language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
                        <?php } ?>
                      </div>
                      <?php foreach ($languages as $language) { ?>
                      <div id="product-language<?php echo $language['language_id']; ?>">
                        <table class="form">
                          <tr>
                            <td>
                                <span class="required">*</span> <?php echo $entry_name; ?><div class="info"><?php echo $info_set_name; ?></div>
                            </td>
                            <td><input type="text" name="product_description[<?php echo $language['language_id']; ?>][name]" maxlength="255" size="100" value="<?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['name'] : ''; ?>" />
                              <?php if (isset($error_productname[$language['language_id']])) { ?>
                              <span class="error"><?php echo $error_productname[$language['language_id']]; ?></span>
                              <?php } ?></td>
                          </tr>
                          <tr>
                            <td><?php echo $entry_meta_keyword; ?></td>
                            <td><input type="text" name="product_description[<?php echo $language['language_id']; ?>][meta_keyword]" maxlength="255" size="100" value="<?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['meta_keyword'] : ''; ?>" /></td>
                          </tr>
                          <tr>
                            <td><?php echo $entry_meta_description; ?></td>
                            <td><textarea name="product_description[<?php echo $language['language_id']; ?>][meta_description]" cols="100" rows="2"><?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['meta_description'] : ''; ?></textarea></td>
                          </tr>
                          <tr>
                            <td><?php echo $entry_description; ?><div class="info"><?php echo $info_set_description; ?></div></td>
                            <td><textarea name="product_description[<?php echo $language['language_id']; ?>][description]" id="product-description<?php echo $language['language_id']; ?>"><?php echo isset($product_description[$language['language_id']]) ? $product_description[$language['language_id']]['description'] : ''; ?></textarea></td>
                          </tr>
                        </table>
                      </div>
                      <?php } ?>
                    </div>
                    <div id="tab-data">
                      <table class="form">
                        <tr>
                          <td><?php echo $entry_keyword; ?></td>
                          <td><input type="text" name="keyword" value="<?php echo $keyword; ?>" /></td>
                        </tr>
                        <tr>
                          <td><?php echo $entry_image; ?></td>
                          <td><div class="image"><img src="<?php echo $thumb; ?>" alt="" id="thumb" /><br />
                              <input type="hidden" name="image" value="<?php echo $image; ?>" id="image" />
                              <a onclick="image_upload('image', 'thumb');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb').attr('src', '<?php echo $no_image; ?>'); $('#image').attr('value', '');"><?php echo $text_clear; ?></a></div></td>
                        </tr>
                        <tr>
                          <td><?php echo $entry_sort_order; ?><div class="info">(<?php echo $info_sort_order; ?>)</div></td>
                          <td><input type="text" name="product_sort_order" value="<?php echo $product_sort_order; ?>" size="2" /></td>
                        </tr>
                      </table>
                    </div>
                    <div id="tab-links">
                      <table class="form">
                        <tr>
                          <td><?php echo $entry_manufacturer; ?></td>
                          <td><select name="manufacturer_id">
                              <option value="0" selected="selected"><?php echo $text_none; ?></option>
                              <?php foreach ($manufacturers as $manufacturer) { ?>
                              <?php if ($manufacturer['manufacturer_id'] == $manufacturer_id) { ?>
                              <option value="<?php echo $manufacturer['manufacturer_id']; ?>" selected="selected"><?php echo $manufacturer['name']; ?></option>
                              <?php } else { ?>
                              <option value="<?php echo $manufacturer['manufacturer_id']; ?>"><?php echo $manufacturer['name']; ?></option>
                              <?php } ?>
                              <?php } ?>
                            </select></td>
                        </tr>
                        <tr>
                          <td><?php echo $entry_category; ?></td>
                          <td><div class="scrollbox">
                              <?php $class = 'odd'; ?>
                              <?php foreach ($categories as $category) { ?>
                              <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                              <div class="<?php echo $class; ?>">
                                <?php if (in_array($category['category_id'], $product_category)) { ?>
                                <input type="checkbox" name="product_category[]" value="<?php echo $category['category_id']; ?>" checked="checked" />
                                <?php echo $category['name']; ?>
                                <?php } else { ?>
                                <input type="checkbox" name="product_category[]" value="<?php echo $category['category_id']; ?>" />
                                <?php echo $category['name']; ?>
                                <?php } ?>
                              </div>
                              <?php } ?>
                            </div>
                            <a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a></td>
                        </tr>
                        <tr>
                          <td><?php echo $entry_related; ?></td>
                          <td><input type="text" name="related" value="" /></td>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td><div id="product-related" class="scrollbox">
                              <?php $class = 'odd'; ?>
                              <?php foreach ($product_related as $product_related) { ?>
                              <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                              <div id="product-related<?php echo $product_related['product_id']; ?>" class="<?php echo $class; ?>"> <?php echo $product_related['name']; ?><img src="view/image/delete.png" />
                                <input type="hidden" name="product_related[]" value="<?php echo $product_related['product_id']; ?>" />
                              </div>
                              <?php } ?>
                            </div></td>
                        </tr>
                      </table>
                    </div>
                    <div id="tab-image">
                      <table id="images" class="list">
                        <thead>
                          <tr>
                            <td class="left"><?php echo $entry_image; ?></td>
                            <td class="right"><?php echo $entry_sort_order; ?></td>
                            <td></td>
                          </tr>
                        </thead>
                        <?php $image_row = 0; ?>
                        <?php foreach ($product_images as $product_image) { ?>
                        <tbody id="image-row<?php echo $image_row; ?>">
                          <tr>
                            <td class="left"><div class="image"><img src="<?php echo $product_image['thumb']; ?>" alt="" id="thumb<?php echo $image_row; ?>" />
                                <input type="hidden" name="product_image[<?php echo $image_row; ?>][image]" value="<?php echo $product_image['image']; ?>" id="image<?php echo $image_row; ?>" />
                                <br />
                                <a onclick="image_upload('image<?php echo $image_row; ?>', 'thumb<?php echo $image_row; ?>');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$('#thumb<?php echo $image_row; ?>').attr('src', '<?php echo $no_image; ?>'); $('#image<?php echo $image_row; ?>').attr('value', '');"><?php echo $text_clear; ?></a></div></td>
                            <td class="right"><input type="text" name="product_image[<?php echo $image_row; ?>][sort_order]" value="<?php echo $product_image['sort_order']; ?>" size="2" /></td>
                            <td class="left"><a onclick="$('#image-row<?php echo $image_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
                          </tr>
                        </tbody>
                        <?php $image_row++; ?>
                        <?php } ?>
                        <tfoot>
                          <tr>
                            <td colspan="2"></td>
                            <td class="left"><a onclick="addImage();" class="button"><?php echo $button_add_image; ?></a></td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                    <div id="tab-design">
                      <table class="list">
                        <thead>
                          <tr>
                            <td class="left"><?php echo $entry_store; ?></td>
                            <td class="left"><?php echo $entry_layout; ?></td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="left"><?php echo $text_default; ?></td>
                            <td class="left"><select name="product_layout[0][layout_id]">
                                <option value=""></option>
                                <?php foreach ($layouts as $layout) { ?>
                                <?php if (isset($product_layout[0]) && $product_layout[0] == $layout['layout_id']) { ?>
                                <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                                <?php } ?>
                                <?php } ?>
                              </select></td>
                          </tr>
                        </tbody>
                        <?php foreach ($stores as $store) { ?>
                        <tbody>
                          <tr>
                            <td class="left"><?php echo $store['name']; ?></td>
                            <td class="left"><select name="product_layout[<?php echo $store['store_id']; ?>][layout_id]">
                                <option value=""></option>
                                <?php foreach ($layouts as $layout) { ?>
                                <?php if (isset($product_layout[$store['store_id']]) && $product_layout[$store['store_id']] == $layout['layout_id']) { ?>
                                <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
                                <?php } else { ?>
                                <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
                                <?php } ?>
                                <?php } ?>
                              </select></td>
                          </tr>
                        </tbody>
                        <?php } ?>
                      </table>
                    </div>
            </div>
<!--finish productcard-content-->
          </div>
		</form>
    </div>
	</div>
    
    <div id="window-option">
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
CKEDITOR.replace('product-description<?php echo $language['language_id']; ?>', {
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
if($('#enable-productcard:checked').length){
    $('#productcard-content').css('display','block');    
} else {
    $('#productcard-content').css('display','none');
}       
$('#enable-productcard').change(function(){
    if($(this).prop('checked')){
        $('#productcard-content').css('display','block');
    } else {
        $('#productcard-content').css('display','none');    
    }
});

var product_row = <?php echo $product_row; ?>;
var products_set = [];
if($('#products_in_set tbody').length){
    $('#products_in_set').slideDown();
    $('#products_in_set tfoot').slideDown();
    $('#products_in_set #text_total_set').fadeIn();
    $('#show_cost_set').fadeOut();
    $('#products_in_set .product_id').each(function(){
       products_set[products_set.length] = $(this).attr('value');
    });
} 


function present(el){
    if($(el).attr("checked")){
      $(el).parent().parent().find('.price_in_set').attr('value','0');
      $(el).parent().parent().find('.priceset-block').css('display','none');
      $('#text_total_set').fadeOut();$('#show_cost_set').fadeIn();
    } else {
      $(el).parent().parent().find('.price_in_set').attr('value','0');
      $(el).parent().parent().find('.priceset-block').css('display','inline');
      $('#text_total_set').fadeOut();$('#show_cost_set').fadeIn();
    }    
}

 
function get_product(product_id){
    	$.ajax({
    		url: 'index.php?route=module/set/addproducts&token=<?php echo $token; ?>&product_id=' + product_id,
    		dataType: 'json',
    		success: function(data) {
                if(data['options'].length > 0){
                    $('#window-option').attr('title', '<?php echo $text_qoption; ?>');
                    $('#window-option').html('');
                    $('#window-option').dialog({
                        modal: true,
                        show: 'slide',
                        hide: 'slide',
                        buttons: {
    	                   "<?php echo $text_yes; ?>": function() {
	                           $(this).dialog("close");
                               showOptions(data);
	                       },
	                       "<?php echo $text_no; ?>": function() {
                               $(this).dialog("close");
                               add_to_set(data);
	                       } 
                        }  
                    });                     
                } else {
                    add_to_set(data);
                }               
    		}
    	});
}

function showOptions(data) {
                html = '';
                
                html += '<input type="hidden" name="product_id" value=' + data['product_id'] + '>';
                
                for(var i in data['options']) {
                    
                    if(data['options'][i]['type']=='select'){
                        html += '<div id="option-' + data['options'][i]['product_option_id'] + '" class="option">';
                        if (data['options'][i]['required']) {
                            html += '<span class="required">*</span>';
                        }
                        html += '<b>'+ data['options'][i]['name'] + '</b><br />';
                        html += '<select name="option[' + data['options'][i]['product_option_id'] + ']">'
                        html += '<option value=""><?php echo $text_select; ?></option>';
                        for(var o in data['options'][i]['product_option_value']){
                            html += '<option value="' + data['options'][i]['product_option_value'][o]['product_option_value_id'] + '">'+data['options'][i]['product_option_value'][o]['name'];
                            html += '</option>';    
                        }
                        html += '</select>';              
                        html += '</div><br />'
                    }                   
                    
                    if(data['options'][i]['type']=='radio'){
                        html += '<div id="option-' + data['options'][i]['product_option_id'] + '" class="option">';
                        if (data['options'][i]['required']) {
                            html += '<span class="required">*</span>';
                        }
                        html += '<b>'+ data['options'][i]['name'] + '</b><br />';
                        for(var o in data['options'][i]['product_option_value']){
                            html += '<input id="option-value-' + data['options'][i]['product_option_value'][o]['product_option_value_id'] + '"  type="radio" name="option[' + data['options'][i]['product_option_id'] + ']" value="' + data['options'][i]['product_option_value'][o]['product_option_value_id'] + '" />';
                            html += '<label for="option-value-' + data['options'][i]['product_option_value'][o]['product_option_value_id'] + '">' + data['options'][i]['product_option_value'][o]['name'];
                            html += '</label><br />';    
                        } 
                        html += '</div><br />'
                    }
                    
                    if(data['options'][i]['type']=='checkbox'){
                        html += '<div id="option-' + data['options'][i]['product_option_id'] + '" class="option">';
                        if (data['options'][i]['required']) {
                            html += '<span class="required">*</span>';
                        }
                        html += '<b>'+ data['options'][i]['name'] + '</b><br />';
                        for(var o in data['options'][i]['product_option_value']){
                            html += '<input id="option-value-' + data['options'][i]['product_option_value'][o]['product_option_value_id'] + '"  type="checkbox" name="option[' + data['options'][i]['product_option_id'] + '][]" value="' + data['options'][i]['product_option_value'][o]['product_option_value_id'] + '" />';
                            html += '<label for="option-value-' + data['options'][i]['product_option_value'][o]['product_option_value_id'] + '">' + data['options'][i]['product_option_value'][o]['name'];
                            html += '</label><br />';    
                        }                         
                        html += '</div><br />'
                    }
                    
                    if(data['options'][i]['type']=='image'){
                        html += '<div id="option-' + data['options'][i]['product_option_id'] + '" class="option">';
                        if (data['options'][i]['required']) {
                            html += '<span class="required">*</span>';
                        }
                        html += '<b>'+ data['options'][i]['name'] + '</b><br />';
                        html += '<table class="option-image">';
                        for(var o in data['options'][i]['product_option_value']){
                            html += '<tr>';
                            html += '<td style="width: 1px;"><input id="option-value-' + data['options'][i]['product_option_value'][o]['product_option_value_id'] + '"  type="radio" name="option[' + data['options'][i]['product_option_id'] + ']" value="' + data['options'][i]['product_option_value'][o]['product_option_value_id'] + '" /></td>';
                            html += '<td><label for="option-value-' + data['options'][i]['product_option_value'][o]['product_option_value_id'] + '"><img src="' + data['options'][i]['product_option_value'][o]['image'] + '" alt="" /></label></td>';
                            html += '<td><label for="option-value-' + data['options'][i]['product_option_value'][o]['product_option_value_id'] + '">' + data['options'][i]['product_option_value'][o]['name'];
                            html += '</label></td>';
                            html += '</tr>';    
                        }                 
                        html += '</table>';
                        html += '</div><br />';
                    }

                    if(data['options'][i]['type']=='text'){
                        html += '<div id="option-' + data['options'][i]['product_option_id'] + '" class="option">';
                        if (data['options'][i]['required']) {
                            html += '<span class="required">*</span>';
                        }
                        html += '<b>'+ data['options'][i]['name'] + '</b><br />';
                        html += '<input type="text" name="option[' + data['options'][i]['product_option_id'] + ']" value="' + data['options'][i]['option_value'] + '" />';
                        html += '</div><br />';
                    }

                    if(data['options'][i]['type']=='textarea'){
                        html += '<div id="option-' + data['options'][i]['product_option_id'] + '" class="option">';
                        
                        if (data['options'][i]['required']) {
                            html += '<span class="required">*</span>';
                        }
                        html += '<b>'+ data['options'][i]['name'] + '</b><br />';
                        html += '<textarea name="option[' + data['options'][i]['product_option_id'] + ']" cols="20" rows="5">' + data['options'][i]['option_value'] + '</textarea>';                        
                        
                        html += '</div><br />';
                    }
/*
                    if(data['options'][i]['type']=='file'){
                        html += '<div id="option-' + data['options'][i]['product_option_id'] + '" class="option">';
                        if (data['options'][i]['required']) {
                            html += '<span class="required">*</span>';
                        }
                        html += '<b>'+ data['options'][i]['name'] + '</b><br />';
                        html += '<input type="button" class="ajax-upload" value="Upload" id="button-option-' + data['options'][i]['product_option_id'] + '" class="button">';
                        html += '<input type="hidden" name="option[' + data['options'][i]['product_option_id'] + ']" value="" />';
                        html += '</div><br />';
                    }
*/                    
                    if(data['options'][i]['type']=='datetime'){
                        html += '<div id="option-' + data['options'][i]['product_option_id'] + '" class="option">';

                        if (data['options'][i]['required']) {
                            html += '<span class="required">*</span>';
                        }
                        html += '<b>'+ data['options'][i]['name'] + '</b><br />';
                        html += '<input type="text" name="option[' + data['options'][i]['product_option_id'] + ']" value="' + data['options'][i]['option_value'] + '" class="datetime" />';
                        html += '</div><br />';
                    }

                    if(data['options'][i]['type']=='time'){
                        html += '<div id="option-' + data['options'][i]['product_option_id'] + '" class="option">';
                        if (data['options'][i]['required']) {
                            html += '<span class="required">*</span>';
                        }
                        html += '<b>'+ data['options'][i]['name'] + '</b><br />';
                        html += '<input type="text" name="option[' + data['options'][i]['product_option_id'] + ']" value="' + data['options'][i]['option_value'] + '" class="time" />';                        
                        html += '</div>';
                    }
                    
                    if(data['options'][i]['type']=='date'){
                        html += '<div id="option-' + data['options'][i]['product_option_id'] + '" class="option">';
                        if (data['options'][i]['required']) {
                            html += '<span class="required">*</span>';
                        }
                        html += '<b>'+ data['options'][i]['name'] + '</b><br />';
                        html += '<input type="text" name="option[' + data['options'][i]['product_option_id'] + ']" value="' + data['options'][i]['option_value'] + '" class="date" />';                        
                        
                        html += '</div>';
                    }
                    
                   
                    
                                         
                }   


                    $('#window-option').html(html);
                    
            		$('.date').datepicker({dateFormat: 'yy-mm-dd'});
            		$('.datetime').datetimepicker({
            			dateFormat: 'yy-mm-dd',
            			timeFormat: 'h:m'
            		});	
            			
            		$('.time').timepicker({timeFormat: 'h:m'});	                    
                    
                    $('#window-option').dialog({
                        modal: true,
                        show: 'slide',
                        hide: 'slide',
                        buttons: {
                            "<?php echo $text_selected; ?>": function() {    
                            $('#window-option .error').remove();
                        	$.ajax({
                        		url: 'index.php?route=module/set/chooseoptions&token=<?php echo $token; ?>',
                        		type: 'post',
                        		data: $('#window-option input[type=\'text\'], #window-option input[type=\'hidden\'], #window-option input[type=\'radio\']:checked, #window-option input[type=\'checkbox\']:checked, #window-option select, #window-option textarea'),
                        		dataType: 'json',
                                error: function(){alert('no_connect')},
                        		success: function(json) {
                        			
                        			if (json['error']) {
                        				if (json['error']['option']) {
                        					for (i in json['error']['option']) {
                        						$('#option-' + i).after('<span class="error">' + json['error']['option'][i] + '</span>');
                        					}
                        				}
                        			} 
                        			
                        			if (json['new_product_id']&&json['new_product_name']) {
                        			    
                                        data['product_id'] =  json['new_product_id'];
                                        data['name'] =  json['new_product_name'];
                                                                                
                                        add_to_set(data);
                                        $("#window-option").dialog("close");
                        			}	
                        		}
                        	});                               
	                       } 
                        }     
                    });    
    
}




function add_to_set(data){
    if($.inArray(data['product_id'], products_set)==-1){
        html  = '<tbody id="product-row' + product_row + '">';
       	html += '  <tr>';
        html += '    <td><input type="hidden" class="product_id" name="product[' + product_row + '][product_id]" value="' + data['product_id'] + '" /><input type="hidden" class="product_name" name="product[' + product_row + '][name]" value="' + data['name'] + '" /><span class="name">' + data['name'] + '</span></td>';
       	html += '    <td><input type="hidden" class="product_price" name="product[' + product_row + '][price]" value="' + data['price'] + '" />' + data['price'] + '</td>';
       	html += '    <td class="price-in-set"><div class="priceset-block"><span class="required">*</span> <input type="text" class="price_in_set" name="product[' + product_row + '][price_in_set]" value="0" onkeypress="$(\'#text_total_set\').fadeOut();$(\'#show_cost_set\').fadeIn();"  /></div></td>';
        html += '    <td><input type="checkbox" class="present" onChange="present(this);" name="product[' + product_row + '][present]" value="1" /></td>';
       	html += '    <td><input type="checkbox" name="product[' + product_row + '][show_in_product]" value="1" checked="checked" /></td>';
       	html += '    <td><span class="required">*</span> <input type="text" class="quantity" size="2" name="product[' + product_row + '][quantity]" value="1" onkeypress="$(\'#text_total_set\').fadeOut();$(\'#show_cost_set\').fadeIn();" /></td>';
       	html += '    <td><input type="text" size="2" name="product[' + product_row + '][sort_order]" value="" /></td>';
        html += '    <td><a onclick="removeFromSet(\'#product-row' + product_row + '\', \'' + data['product_id'] + '\');"><?php echo $text_remove; ?></a></td>';
        html += '  </tr>';
       	html += '</tbody>';
       	$('#products_in_set tfoot').before(html);
        products_set[products_set.length] = data['product_id'];
        product_row++;
        $('#text_total_set').fadeOut();
        $('#show_cost_set').fadeIn();                    
    } else {
        $('#product').before('<span class="error" id="error_add"><?php echo $error_add; ?></span>');    
    }
}

$('input[name=\'product_set_search\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.product_id,
                        price: item.price
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
        $('.error').remove();
        $('#products_in_set').slideDown();
        $('#products_in_set tfoot').slideDown();    
        get_product(ui.item.value);        
		return false;
	},
	focus: function(event, ui) {
      return false;
	}
});

function addProducts() {
    $('.error').remove();
    if($('#product :selected').length){
        $('#products_in_set').slideDown();
        $('#products_in_set tfoot').slideDown();    
    } else {
        alert('<?php echo $error_select; ?>');
    }
	$('#product :selected').each(function() {
       get_product($(this).attr('value'));
	});
}

function removeFromSet(row, product_id) {
    $('#error_add').remove();
	$(row).remove();
    products_set.splice($.inArray(product_id, products_set),1);
    if($('#products_in_set .product_id').length<1){
        $('#products_in_set').slideUp();
    }
    $('#text_total_set').fadeOut(); 
    $('#show_cost_set').fadeIn();
}

function getProducts() {
    $('#error_add').remove();
	$('#product option').remove();
	$.ajax({
		url: 'index.php?route=module/set/category&token=<?php echo $token; ?>&category_id=' + $('#category').attr('value'),
		dataType: 'json',
		success: function(data) {
			for (i = 0; i < data.length; i++) {
	 			$('#product').append('<option value="' + data[i]['product_id'] + '">' + data[i]['name'] + ' (' + data[i]['model'] + ') </option>');
			}
		}
	});
}

function showCostSet(){
    var total_set = 0;
    var error = false;
    $('.error').remove();
    $('#error-total').fadeOut();
    
    if($('#products_in_set .product_id').length<2){
        $('#products_in_set').after('<span class="error"><?php echo $error_count; ?></span>');
        error = true;
    } else {
       $('#products_in_set tbody').each(function(){    
        if((parseFloat($(this).find('.price_in_set').attr('value'))<=0 && !$(this).find('.present').attr('checked')) || (parseFloat($(this).find('.price_in_set').attr('value')) > 100/*parseFloat($(this).find('.product_price').attr('value'))*/ )){
         $(this).find('.price_in_set').after('<span class="error"><?php echo $error_price; ?></span>');
         error = true;   
        }
        if($(this).find('.quantity').attr('value')<1){
         $(this).find('.quantity').after('<span class="error"><?php echo $error_quantity; ?></span>');
         error = true;   
        }
       });
        
    }
    if(!error){
       $('#products_in_set tbody').each(function(){
        current_total = 0;
        current_total = parseFloat($(this).find('.price_in_set').attr('value'))*parseFloat($(this).find('.quantity').attr('value'));
        total_set += current_total;
       });         
       $('#text_total_set').fadeIn();
      
       $('#show_cost_set').fadeOut();
       $('input[name=\'total_set\']').attr('value', total_set);
       $('#total_set').text(total_set);
       
       if (!total_set){
         $('#error-total').fadeIn();   
         $('#error-total td').html('<span class="error><?php echo $error_total; ?></span>');
       }
          
       
       
    }
}

getProducts();
//--></script>


<script type="text/javascript"><!--
$('#main-tabs a').tabs();
$('#languages a').tabs();
$('#productcart-tabs a').tabs();
$('#product-languages a').tabs();
//--></script> 

<script type="text/javascript"><!--
$('input[name=\'related\']').autocomplete({
	delay: 0,
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
		$('#product-related' + ui.item.value).remove();
		
		$('#product-related').append('<div id="product-related' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" /><input type="hidden" name="product_related[]" value="' + ui.item.value + '" /></div>');

		$('#product-related div:odd').attr('class', 'odd');
		$('#product-related div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      return false;
	}
});

$('#product-related div img').live('click', function() {
	$(this).parent().remove();
	
	$('#product-related div:odd').attr('class', 'odd');
	$('#product-related div:even').attr('class', 'even');	
});
//--></script> 


<script type="text/javascript"><!--
function image_upload(field, thumb) {
	$('#dialog').remove();
	
	$('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;"><iframe src="index.php?route=common/filemanager&token=<?php echo $token; ?>&field=' + encodeURIComponent(field) + '" style="padding:0; margin: 0; display: block; width: 100%; height: 100%;" frameborder="no" scrolling="auto"></iframe></div>');
	
	$('#dialog').dialog({
		title: '<?php echo $text_image_manager; ?>',
		close: function (event, ui) {
			if ($('#' + field).attr('value')) {
				$.ajax({
					url: 'index.php?route=common/filemanager/image&token=<?php echo $token; ?>&image=' + encodeURIComponent($('#' + field).attr('value')),
					dataType: 'text',
					success: function(text) {
						$('#' + thumb).replaceWith('<img src="' + text + '" alt="" id="' + thumb + '" />');
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

<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript"><!--
$('.date').datepicker({dateFormat: 'yy-mm-dd'});
$('.datetime').datetimepicker({
	dateFormat: 'yy-mm-dd',
	timeFormat: 'h:m'
});
$('.time').timepicker({timeFormat: 'h:m'});
//--></script> 

 
<script type="text/javascript"><!--
var image_row = <?php echo $image_row; ?>;

function addImage() {
    html  = '<tbody id="image-row' + image_row + '">';
	html += '  <tr>';
	html += '    <td class="left"><div class="image"><img src="<?php echo $no_image; ?>" alt="" id="thumb' + image_row + '" /><input type="hidden" name="product_image[' + image_row + '][image]" value="" id="image' + image_row + '" /><br /><a onclick="image_upload(\'image' + image_row + '\', \'thumb' + image_row + '\');"><?php echo $text_browse; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a onclick="$(\'#thumb' + image_row + '\').attr(\'src\', \'<?php echo $no_image; ?>\'); $(\'#image' + image_row + '\').attr(\'value\', \'\');"><?php echo $text_clear; ?></a></div></td>';
	html += '    <td class="right"><input type="text" name="product_image[' + image_row + '][sort_order]" value="" size="2" /></td>';
	html += '    <td class="left"><a onclick="$(\'#image-row' + image_row  + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#images tfoot').before(html);
	
	image_row++;
}
//--></script> 


<?php echo $footer; ?>