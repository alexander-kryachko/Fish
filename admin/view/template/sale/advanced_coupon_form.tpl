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
      <h1><img src="view/image/customer.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <div id="tabs" class="htabs">
      	<a href="#tab-general"><?php echo $tab_general; ?></a>
        <a href="#tab-option"><?php echo $tab_option; ?></a>        
        <a href="#tab-errors"><?php echo $tab_errors; ?></a>
        <?php if ($advanced_coupon_id) { ?>
        	<a href="#tab-history"><?php echo $tab_advanced_coupon_history; ?></a>        
        <?php } ?>
      </div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general">
        
          <table class="form">
          	<?php foreach ($languages as $language) { ?>
          	<div id="language<?php echo $language['language_id']; ?>"> 
	            <tr>
	              <td><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <span class="required">*</span> <?php echo $entry_name; ?></td>
	              <td><input type="text" name="advanced_coupon[<?php echo $language['language_id']; ?>][name]" value="<?php if(isset($advanced_coupon[$language['language_id']])) { if($advanced_coupon[$language['language_id']]['name'] != '') { echo $advanced_coupon[$language['language_id']]['name'];  } } else { echo ''; } ?>" size="50"/>
	                <?php if (isset($error_name[$language['language_id']])) { ?>
	                  	<span class="error"><?php echo $error_name[$language['language_id']]; ?></span>
	                  <?php } ?></td>
	           </tr>
           </div>
          <?php } ?>
            <tr>
              <td><span class="required">*</span> <?php echo $entry_code; ?></td>
              <td><input name="code" value="<?php echo $code; ?>" />
                <?php if ($error_code) { ?>
                <span class="error"><?php echo $error_code; ?></span>
                <?php } ?></td>
            </tr>
            <tr>
              <td><?php echo $entry_type; ?></td>
              <td><select name="type">
                  <?php if ($type == 'P') { ?>
                  	<option value="P" selected="selected"><?php echo $text_percent; ?></option>
                  <?php } else { ?>
                  	<option value="P"><?php echo $text_percent; ?></option>
                  <?php } ?>
                  <?php if ($type == 'F') { ?>
                  	<option value="F" selected="selected"><?php echo $text_amount; ?></option>
                  <?php } else { ?>
                  	<option value="F"><?php echo $text_amount; ?></option>
                  <?php } ?>
                  <?php if($type == 'FP') { ?>
                  	<option value="FP" selected="selected"><?php echo $text_fixed_price; ?></option>
                  <?php } else { ?>
                  	<option value="FP"><?php echo $text_fixed_price; ?></option>
                  <?php } ?>
                  </select></td>
            </tr>
            <tr>
              <td><?php echo $entry_discount; ?></td>
              <td><input type="text" name="discount" value="<?php echo $discount; ?>" />
              <?php if ($error_discount) { ?>
                <span class="error"><?php echo $error_discount; ?></span>
                <?php } ?>
              </td>
            </tr>
            
            <tr>
              <td><?php echo $entry_quantity_total; ?></td>
              <td><input type="text" name="quantity_total" value="<?php echo $quantity_total; ?>" />
              <?php if ($error_quantity_total) { ?>
                <span class="error"><?php echo $error_quantity_tota; ?></span>
                <?php } ?>
              </td>
            </tr>
            
            <tr>
              <td><?php echo $entry_total; ?></td>
              <td><input type="text" name="total" value="<?php echo $total; ?>" />
              <?php if ($error_total) { ?>
                <span class="error"><?php echo $error_total; ?></span>
                <?php } ?>
              </td>
            </tr>
            
            <tr>
              <td><?php echo $entry_quantity_sale; ?></td>
              <td><input type="text" name="quantity_sale" value="<?php echo $quantity_sale; ?>" />
              <?php if ($error_quantity_sale) { ?>
                <span class="error"><?php echo $error_quantity_sale; ?></span>
                <?php } ?>
              </td>
            </tr>
            
            <tr>
              <td><?php echo $entry_quantity_types; ?></td>
              <td>
              		<select name="product_type">
						<option value="1" <?php if($product_type == 1) { echo "selected='selected'"; } ?>><?php echo $entry_everyone; ?></option>
						<option value="0" <?php if($product_type == 0) { echo "selected='selected'"; } ?>><?php echo $entry_anyone; ?></option>
               		</select>
              </td>
            </tr>
            
            <tr>
              <td><?php echo $entry_product; ?></td>
              <td>
              <table><tr><td>
              <?php echo $entry_category; ?><br/>
              <div class="scrollbox">
                  <?php $class = 'odd'; ?>
                  <?php foreach ($categories as $category) { ?>
                  	<?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  	<div class="<?php echo $class; ?>">
					
                    	<input type="checkbox" name="category[]" value="<?php echo $category['category_id']; ?>" <?php if(isset($category_ids)) { for($i=0; $i<count($category_ids); $i++) { if($category_ids[$i] == $category['category_id']) { echo "checked='checked'"; } } } ?> />                    
                    	<?php echo $category['name']; ?> 
                    </div>
                  <?php } ?>
                </div>
                <a onclick="$(this).parent().find(':checkbox').attr('checked', true);">
                	<?php echo $text_select_all; ?>
                </a> 
                / 
                <a onclick="$(this).parent().find(':checkbox').attr('checked', false);">
                	<?php echo $text_unselect_all; ?>
                </a>
               </td>
                </td>
                <td>&nbsp;</td>
                <td><?php echo $entry_manufacturer; ?><br/>
                  <div class="scrollbox">
                  <?php $class = 'odd'; ?>
                  <?php foreach ($manufacturers as $manufacturer) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div class="<?php echo $class; ?>">
					
                    <input type="checkbox" name="manufacturer[]" value="<?php echo $manufacturer['manufacturer_id']; ?>" <?php if(isset($manufacturer_ids)) { for($i=0; $i<count($manufacturer_ids); $i++) { if($manufacturer_ids[$i] == $manufacturer['manufacturer_id']) { echo "checked='checked'"; } } } ?> />                    
                    <?php echo $manufacturer['name']; ?> </div>
                  <?php } ?>
                </div><a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a>
                </td>
            </tr>
            <td>&nbsp;</td>
            <tr>
              <td><?php echo $entry_product_product; ?><br/>
              <input type="text" name="product_suggest" value="" />
              </td>
              <td>&nbsp;</td>
              <td><div class="scrollbox" id="advanced_coupon-product">
                  <?php $class = 'odd'; ?>
                  <?php foreach ($advanced_coupon_product as $advanced_coupon_product) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div id="advanced_coupon-product<?php echo $advanced_coupon_product['product_id']; ?>" class="<?php echo $class; ?>"> <?php echo $advanced_coupon_product['name']; ?><img src="view/image/delete.png" />
                    <input type="hidden" name="product[]" value="<?php echo $advanced_coupon_product['product_id']; ?>" />
                  </div>
                  <?php } ?>
                </div>
               </td>
            </tr>
            </table>
           </td>
           </tr> 
           
            <tr>
              <td><?php echo $entry_quantity_buy; ?></td>
              <td><input type="text" name="quantity_buy" value="<?php echo $quantity_buy; ?>" />
              <?php if ($error_quantity_buy) { ?>
                <span class="error"><?php echo $error_quantity_buy; ?></span>
              <?php } ?>
              </td>
            </tr>
             
            <tr>
              <td><?php echo $entry_quantity_buy_type; ?></td>
              <td>
              		<select name="product_buy_type">
						<option value="1" <?php if($product_buy_type == 1) { echo "selected='selected'"; } ?>><?php echo $entry_everyone; ?></option>
						<option value="0" <?php if($product_buy_type == 0) { echo "selected='selected'"; } ?>><?php echo $entry_anyone; ?></option>
               		</select>
              </td>
            </tr>
                       
            <tr>
              <td><?php echo $entry_product_buy; ?></td>
              <td><table><tr><td>
              <?php echo $entry_category; ?><br/>
              <div class="scrollbox">
                  <?php $class = 'odd'; ?>
                  <?php foreach ($categories as $category_buy) { ?>
	                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
	                  <div class="<?php echo $class; ?>">					
	                  	<input type="checkbox" name="category_buy[]" value="<?php echo $category_buy['category_id']; ?>" <?php if(isset($category_buy_ids)){ for($i=0; $i<count($category_buy_ids); $i++) { if($category_buy_ids[$i] == $category_buy['category_id']) { echo "checked='checked'"; } } } ?> />                    
	                  	<?php echo $category_buy['name']; ?> 
	                  </div>
                  <?php } ?>
              </div>
                <a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a>
                </td>
            	<td>&nbsp;</td>
                <td><?php echo $entry_manufacturer; ?><br/>
                  <div class="scrollbox">
	                  <?php $class = 'odd'; ?>
	                  <?php foreach ($manufacturers as $manufacturer_buy) { ?>
		                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
		                  <div class="<?php echo $class; ?>">
		                  	<input type="checkbox" name="manufacturer_buy[]" value="<?php echo $manufacturer_buy['manufacturer_id']; ?>" <?php if(isset($manufacturer_buy_ids)) { for($i=0; $i<count($manufacturer_buy_ids); $i++) { if($manufacturer_buy_ids[$i] == $manufacturer_buy['manufacturer_id']) { echo "checked='checked'"; } } } ?> />                    
		                    <?php echo $manufacturer_buy['name']; ?>
		                  </div>
	                  <?php } ?>
                </div>
                <a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a>
                </td>
            </tr>
            <td>&nbsp;</td>
            <tr>
              <td><?php echo $entry_product_product; ?><br/>
              <input type="text" name="product_buy_suggest" value="" />
              </td>
              <td>&nbsp;</td>
              <td>
              	<div class="scrollbox" id="advanced_coupon-product_buy">
                  <?php $class = 'odd'; ?>
                  <?php foreach ($advanced_coupon_product_buy as $advanced_coupon_product_buy) { ?>
	                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
	                  <div id="advanced_coupon-product_buy<?php echo $advanced_coupon_product_buy['product_id']; ?>" class="<?php echo $class; ?>"> <?php echo $advanced_coupon_product_buy['name']; ?><img src="view/image/delete.png" />
	                    <input type="hidden" name="product_buy[]" value="<?php echo $advanced_coupon_product_buy['product_id']; ?>" />
	                  </div>
                  <?php } ?>
               </div>
            </td>
            </tr>
            </table>
           </td> 
            </tr>                                     
            
            <tr>
              <td><?php echo $entry_quantity_type; ?></td>
              <td><select name="quantity_type">
                  <?php if ($quantity_type == 'P') { ?>
                  <option value="P" selected="selected"><?php echo $text_proportional; ?></option>
                  <?php } else { ?>
                  <option value="P"><?php echo $text_proportional; ?></option>
                  <?php } ?>
                  <?php if ($quantity_type == 'F') { ?>
                  <option value="F" selected="selected"><?php echo $text_fixed; ?></option>
                  <?php } else { ?>
                  <option value="F"><?php echo $text_fixed; ?></option>
                  <?php } ?>
                  </select>
                  </td>
            </tr>
            
            
            <tr>
              <td><?php echo $entry_date_start; ?></td>
              <td><input type="text" name="date_start" value="<?php echo $date_start; ?>" size="12" id="date-start" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_date_end; ?></td>
              <td><input type="text" name="date_end" value="<?php echo $date_end; ?>" size="12" id="date-end" /></td>
            </tr>
            <tr>
              <td><?php echo $entry_uses_total; ?></td>
              <td><input type="text" name="uses_total" value="<?php echo $uses_total; ?>" />
              <?php if ($error_uses_total) { ?>
                <span class="error"><?php echo $error_uses_total; ?></span>
                <?php } ?>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_uses_customer; ?></td>
              <td><input type="text" name="uses_customer" value="<?php echo $uses_customer; ?>" />
              <?php if ($error_uses_customer) { ?>
                <span class="error"><?php echo $error_uses_customer; ?></span>
                <?php } ?>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_status; ?></td>
              <td><select name="status">
                  <?php if ($status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
            </tr>
          </table>
        </div>
              
        <div id="tab-option">
          <table class="form">
            <!-- hardik upgreadation code start 
            <tr>
            	<td><?php echo $entry_rules_type; ?></td>
            	<td>
	            	<select name="discount_rules_type">
	                  <?php if ($discount_rules_type == 'P') { ?>
	                  <option value="P" selected="selected"><?php echo $text_percent; ?></option>
	                  <?php } else { ?>
	                  <option value="P"><?php echo $text_percent; ?></option>
	                  <?php } ?>
	                  <?php if ($discount_rules_type == 'F') { ?>
	                  <option value="F" selected="selected"><?php echo $text_amount; ?></option>
	                  <?php } else { ?>
	                  <option value="F"><?php echo $text_amount; ?></option>
	                  <?php } ?>
                	</select>
                </td>
            </tr>
            <tr>
            	<td><?php echo $entry_rules; ?></td>
            	<td><input type="text" name="discount_rules" value="<?php echo $discount_rules; ?>" /></td>
            </tr>
            
            <tr>
            	<td><?php echo $entry_rules_value; ?></td>
            	<td><input type="text" name="discount_rules_value" value="<?php echo $discount_rules_value; ?>" /></td>
            </tr>
            
            
            <?php foreach ($languages as $language) { ?>
          		<div id="language<?php echo $language['language_id']; ?>"> 
            		<tr>
            			<td><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $entry_rules_message; ?></td>
            			<td><textarea name="advanced_coupon[<?php echo $language['language_id']; ?>][discount_rules_message]"><?php if(isset($advanced_coupon[$language['language_id']])) { echo $advanced_coupon[$language['language_id']]['discount_rules_message']; } else { echo ''; } ?></textarea></td>            			
            		</tr>
            	</div>
            <?php } ?>
          	-->
            <!-- hardik upgreadation code end -->
            <tr>
              <td><?php echo $entry_logged; ?></td>
              <td><?php if ($logged) { ?>
                <input type="radio" name="logged" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="logged" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="logged" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="logged" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?></td>
            </tr>
            <tr>
              <td><?php echo $entry_shipping; ?></td>
              <td><?php if ($shipping) { ?>
                <input type="radio" name="shipping" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="shipping" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="shipping" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="shipping" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?></td>
            </tr>
            <tr>
              <td><?php echo $entry_coupon_combine; ?></td>
              <td><?php if ($coupon_combine) { ?>
                <input type="radio" name="coupon_combine" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="coupon_combine" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="coupon_combine" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="coupon_combine" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?></td>
            </tr>
            
            <tr>
              <td><?php echo $entry_special_combine; ?></td>
              <td><?php if($special_combine) { ?>
                <input type="radio" name="special_combine" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="special_combine" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="special_combine" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="special_combine" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?></td>
            </tr>
            
            <tr>
              <td><?php echo $entry_discount_combine; ?></td>
              <td><?php if ($discount_combine) { ?>
                <input type="radio" name="discount_combine" value="1" checked="checked" />
                <?php echo $text_yes; ?>
                <input type="radio" name="discount_combine" value="0" />
                <?php echo $text_no; ?>
                <?php } else { ?>
                <input type="radio" name="discount_combine" value="1" />
                <?php echo $text_yes; ?>
                <input type="radio" name="discount_combine" value="0" checked="checked" />
                <?php echo $text_no; ?>
                <?php } ?></td>
            </tr>
            
            <tr>
              <td><?php echo $entry_store; ?></td>
              <td><div class="scrollbox">
                  <?php $class = 'even'; ?>
                  <div class="<?php echo $class; ?>">
                    <?php if (in_array(0, $advanced_coupon_store)) { ?>
                    <input type="checkbox" name="store[]" value="0" checked="checked" />
                    <?php echo $text_default; ?>
                    <?php } else { ?>
                    <input type="checkbox" name="store[]" value="0" />
                    <?php echo $text_default; ?>
                    <?php } ?>
                  </div>
                  <?php foreach ($stores as $store) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div class="<?php echo $class; ?>">
                    <?php if (in_array($store['store_id'], $advanced_coupon_store)) { ?>
                    <input type="checkbox" name="store[]" value="<?php echo $store['store_id']; ?>" checked="checked" />
                    <?php echo $store['name']; ?>
                    <?php } else { ?>
                    <input type="checkbox" name="store[]" value="<?php echo $store['store_id']; ?>" />
                    <?php echo $store['name']; ?>
                    <?php } ?>
                  </div>
                  <?php } ?>
                </div>
                <a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a>
                <?php if ($error_store) { ?>
                <span class="error"><?php echo $error_store; ?></span>
                <?php } ?>
                </td>
            </tr>
           
            <tr>
              <td><?php echo $entry_customer_group; ?></td>
              <td><div class="scrollbox">
                 <?php if ($advanced_coupon_customer_group) { ?> 
                  <?php foreach ($customer_groups as $customer_group) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div class="<?php echo $class; ?>">
                    <?php if (in_array($customer_group['customer_group_id'], $advanced_coupon_customer_group)) { ?>
                    <input type="checkbox" name="customer_group[]" value="<?php echo $customer_group['customer_group_id']; ?>" checked="checked" />
                    <?php echo $customer_group['name']; ?>
                    <?php } else { ?>
                    <input type="checkbox" name="customer_group[]" value="<?php echo $customer_group['customer_group_id']; ?>" />
                    <?php echo $customer_group['name']; ?>
                    <?php } ?>
                  </div>
                  <?php } ?>
                  <?php } else { ?>
                  <?php foreach ($customer_groups as $customer_group) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div class="<?php echo $class; ?>">
                    <input type="checkbox" name="customer_group[]" value="<?php echo $customer_group['customer_group_id']; ?>" checked="checked" />
                    <?php echo $customer_group['name']; ?>
                  </div>
                  <?php } ?>
                  <?php } ?>
                </div>
                <a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a>
                <br/>
                <?php if ($error_customer_group) { ?>
                <span class="error"><?php echo $error_customer_group; ?></span>
                <?php } ?>
                </td>
            </tr> 
          
            <tr>
              <td><?php echo $entry_currency; ?></td>
              <td><div class="scrollbox">
                   <?php if ($advanced_coupon_currency) { ?> 
                  <?php foreach ($currencies as $currency) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div class="<?php echo $class; ?>">
                    <?php if (in_array($currency['currency_id'], $advanced_coupon_currency)) { ?>
                    <input type="checkbox" name="currency[]" value="<?php echo $currency['currency_id']; ?>" checked="checked" />
                    <?php echo $currency['title']; ?>
                    <?php } else { ?>
                    <input type="checkbox" name="currency[]" value="<?php echo $currency['currency_id']; ?>" />
                    <?php echo $currency['title']; ?>
                    <?php } ?>
                  </div>
                  <?php } ?>
                  <?php } else { ?>
                   <?php foreach ($currencies as $currency) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div class="<?php echo $class; ?>">
                    <input type="checkbox" name="currency[]" value="<?php echo $currency['currency_id']; ?>" checked="checked" />
                    <?php echo $currency['title']; ?>
                  </div>
                  <?php } ?>
                  <?php } ?>
                </div><a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a>
                <br/>
            <?php if ($error_currency) { ?>
                <span class="error"><?php echo $error_currency; ?></span>
                <?php } ?>
                </td>
            </tr>               
            
            <tr>
              <td><?php echo $entry_language; ?></td>
              <td><div class="scrollbox">
                  <?php if ($advanced_coupon_language) { ?> 
                  <?php foreach ($languages as $language) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div class="<?php echo $class; ?>">
                    <?php if (in_array($language['language_id'], $advanced_coupon_language)) { ?>
                    <input type="checkbox" name="language[]" value="<?php echo $language['language_id']; ?>" checked="checked" />
                    <?php echo $language['name']; ?>
                    <?php } else { ?>
                    <input type="checkbox" name="language[]" value="<?php echo $language['language_id']; ?>" />
                    <?php echo $language['name']; ?>
                    <?php } ?>
                  </div>
                  <?php } ?>
                  <?php } else { ?>
                   <?php foreach ($languages as $language) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div class="<?php echo $class; ?>">
                    <input type="checkbox" name="language[]" value="<?php echo $language['language_id']; ?>" checked="checked" />
                    <?php echo $language['name']; ?>
                  </div>
                  <?php } ?>
                  <?php } ?>
                </div><a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a>
                <br/>
            <?php if ($error_language) { ?>
                <span class="error"><?php echo $error_language; ?></span>
                <?php } ?>
                </td>
            </tr> 
            
            <tr>
              <td><?php echo $entry_day; ?></td>
              <td><div class="scrollbox">
                   <?php if ($advanced_coupon_day) { ?> 
                  <?php foreach ($days as $day) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div class="<?php echo $class; ?>">
                    <?php if (in_array($day, $advanced_coupon_day)) { ?>
                    <input type="checkbox" name="day[]" value="<?php echo $day; ?>" checked="checked"  />
                    <?php echo $day; ?>
                    <?php } else { ?>
                    <input type="checkbox" name="day[]" value="<?php echo $day; ?>" />
                    <?php echo $day; ?>
                    <?php } ?>
                  </div>
                  <?php } ?>
                  <?php } else { ?>
                  <?php foreach ($days as $day) { ?>
                  <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                  <div class="<?php echo $class; ?>">
                    <input type="checkbox" name="day[]" value="<?php echo $day; ?>" checked="checked"  />
                    <?php echo $day; ?>
                  </div>
                  <?php } ?>
                  <?php } ?>
                </div><a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo $text_unselect_all; ?></a>
                <br/>
            <?php if ($error_day) { ?>
                <span class="error"><?php echo $error_day; ?></span>
                <?php } ?>
                </td>
            </tr>                                  
            
          </table>
        </div>
        
       <div id="tab-errors">        
	   	<div id="languages" class="htabs">
	    	<?php foreach ($languages as $language) { ?>
	        	<a href="#language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
	        <?php } ?>
	   	</div>
        <?php foreach ($languages as $language) { ?>
        	<div id="language<?php echo $language['language_id']; ?>">	       
          		<table class="form">      	
	      			<!-- <tr>
	      			 <td><span class="required">*</span> <?php echo $entry_error_blank; ?></td>
	      			 <td><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <textarea name="advanced_coupon[<?php echo $language['language_id']; ?>][error_blank]"><?php if(isset($advanced_coupon[$language['language_id']])) { echo $advanced_coupon[$language['language_id']]['error_blank']; } else { echo ''; } ?></textarea></td>
	      			</tr>
	      			
	      			<tr>
	      			 <td><span class="required">*</span> <?php echo $entry_error_not_found; ?></td>
	      			 <td><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <textarea name="advanced_coupon[<?php echo $language['language_id']; ?>][error_not_found]"><?php if(isset($advanced_coupon[$language['language_id']])) { echo $advanced_coupon[$language['language_id']]['error_not_found']; } else { echo ''; } ?></textarea></td>
	      			</tr>
	      			-->
	      			<tr>
	      			 <td><span class="required">*</span> <?php echo $entry_error_total_quantity_range; ?></td>
	      			 <td><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <textarea name="advanced_coupon[<?php echo $language['language_id']; ?>][error_total_quantity_range]"><?php if(isset($advanced_coupon[$language['language_id']])) { echo $advanced_coupon[$language['language_id']]['error_total_quantity_range']; } else { echo ''; } ?></textarea></td>
	      			</tr>
	      		
	      			<tr>
	      			 <td><span class="required">*</span> <?php echo $entry_error_total_quantity; ?></td>
	      			 <td><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <textarea name="advanced_coupon[<?php echo $language['language_id']; ?>][error_total_quantity]"><?php if(isset($advanced_coupon[$language['language_id']])) { echo $advanced_coupon[$language['language_id']]['error_total_quantity']; } else { echo ''; } ?></textarea></td>
	      			</tr>
	      			
	      			<tr>
	      			 <td><span class="required">*</span> <?php echo $entry_error_total_amount_range; ?></td>
	      			 <td><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <textarea name="advanced_coupon[<?php echo $language['language_id']; ?>][error_total_amount_range]"><?php if(isset($advanced_coupon[$language['language_id']])) { echo $advanced_coupon[$language['language_id']]['error_total_amount_range']; } else { echo ''; } ?></textarea></td>
	      			</tr>
	      			
	      			<tr> 
	      			 <td><span class="required">*</span> <?php echo $entry_error_total_amount; ?></td>
	      			 <td><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <textarea name="advanced_coupon[<?php echo $language['language_id']; ?>][error_total_amount]"><?php if(isset($advanced_coupon[$language['language_id']])) { echo $advanced_coupon[$language['language_id']]['error_total_amount']; } else { echo ''; } ?></textarea></td>
	      			</tr>
	      		
	      			<tr>
	      			 <td><span class="required">*</span> <?php echo $entry_error_login; ?></td>
	      			 <td><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <textarea name="advanced_coupon[<?php echo $language['language_id']; ?>][error_login]"><?php if(isset($advanced_coupon[$language['language_id']])) { echo $advanced_coupon[$language['language_id']]['error_login']; } else { echo ''; } ?></textarea></td>
	      			</tr>
	      			
	      			<tr> 
	      			 <td><span class="required">*</span> <?php echo $entry_error_other_coupon; ?></td>
	      			 <td><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <textarea name="advanced_coupon[<?php echo $language['language_id']; ?>][error_other_coupon]"><?php if(isset($advanced_coupon[$language['language_id']])) { echo $advanced_coupon[$language['language_id']]['error_other_coupon']; } else { echo ''; } ?></textarea></td>
	      			</tr>
	      			
	      			<tr>
	      			 <td><span class="required">*</span> <?php echo $entry_error_special_product; ?></td>
	      			 <td><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <textarea name="advanced_coupon[<?php echo $language['language_id']; ?>][error_special_product]"><?php if(isset($advanced_coupon[$language['language_id']])) { echo $advanced_coupon[$language['language_id']]['error_special_product']; } else { echo ''; } ?></textarea></td>
	      			</tr>
	      			
	      			<tr>
	      			 <td><span class="required">*</span> <?php echo $entry_error_discount_product; ?></td>
	      			 <td><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <textarea name="advanced_coupon[<?php echo $language['language_id']; ?>][error_discount_product]"><?php if(isset($advanced_coupon[$language['language_id']])) { echo $advanced_coupon[$language['language_id']]['error_discount_product']; } else { echo ''; } ?></textarea></td>
	      			</tr>
	      			
	      			<tr>
	      			 <td><span class="required">*</span> <?php echo $entry_error_total_uses_sale; ?></td>
	      			 <td><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <textarea name="advanced_coupon[<?php echo $language['language_id']; ?>][error_total_usage_sale]"><?php if(isset($advanced_coupon[$language['language_id']])) { echo $advanced_coupon[$language['language_id']]['error_total_usage_sale']; } else { echo ''; } ?></textarea></td>
	      			</tr>
	      			
	      			<tr>
	      			 <td><span class="required">*</span> <?php echo $entry_error_total_uses_customer; ?></td>
	      			 <td><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <textarea name="advanced_coupon[<?php echo $language['language_id']; ?>][error_total_usage_customer]"><?php if(isset($advanced_coupon[$language['language_id']])) { echo $advanced_coupon[$language['language_id']]['error_total_usage_customer']; } else { echo ''; } ?></textarea></td>
	      			</tr>
	      		
	      			<tr>
	      			 <td><span class="required">*</span> <?php echo $entry_error_set_disable; ?></td>
	      			 <td><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <textarea name="advanced_coupon[<?php echo $language['language_id']; ?>][error_status_disable]"><?php if(isset($advanced_coupon[$language['language_id']])) { echo $advanced_coupon[$language['language_id']]['error_status_disable']; } else { echo ''; } ?></textarea></td>         			 
	      			</tr>
	      		          			 	
				</table>
		     </div>         		
      	  <?php } ?>
     	</div>
        
         <?php if ($advanced_coupon_id) { ?>
       	<div id="tab-history">
          <div id="history"></div>
        </div>
       <?php } ?>
        
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--

$('input[name=\'product_suggest\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=sale/advanced_coupon/autocompleteAdvancedCoupon&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
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
		$('#advanced_coupon-product' + ui.item.value).remove();
		
		$('#advanced_coupon-product').append('<div id="advanced_coupon-product' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" /><input type="hidden" name="product[]" value="' + ui.item.value + '" /></div>');

		$('#advanced_coupon-product div:odd').attr('class', 'odd');
		$('#advanced_coupon-product div:even').attr('class', 'even');
		
		$('input[name=\'product_suggest\']').val('');
		
		return false;
	}
});

$('#advanced_coupon-product div img').live('click', function() {
	$(this).parent().remove();
	
	$('#advanced_coupon-product div:odd').attr('class', 'odd');
	$('#advanced_coupon-product div:even').attr('class', 'even');	
});
//--></script> 

<script type="text/javascript"><!--

	
$('input[name=\'product_buy_suggest\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=sale/advanced_coupon/autocompleteAdvancedCoupon&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
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
		$('#advanced_coupon-product_buy' + ui.item.value).remove();
		
		$('#advanced_coupon-product_buy').append('<div id="advanced_coupon-product_buy' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" /><input type="hidden" name="product_buy[]" value="' + ui.item.value + '" /></div>');

		$('#advanced_coupon-product_buy div:odd').attr('class', 'odd');
		$('#advanced_coupon-product_buy div:even').attr('class', 'even');
		
		$('input[name=\'product_buy_suggest\']').val('');
		
		return false;
	}
});

$('#advanced_coupon-product_buy div img').live('click', function() {
	$(this).parent().remove();
	
	$('#advanced_coupon-product_buy div:odd').attr('class', 'odd');
	$('#advanced_coupon-product_buy div:even').attr('class', 'even');	
});
//--></script> 


<script type="text/javascript"><!--
$('#date-start').datepicker({dateFormat: 'yy-mm-dd'});
$('#date-end').datepicker({dateFormat: 'yy-mm-dd'});
//--></script>
<?php if ($advanced_coupon_id) { ?>
<script type="text/javascript"><!--
$('#history .pagination a').live('click', function() {
	$('#history').load(this.href);
	
	return false;
});			

$('#history').load('index.php?route=sale/advanced_coupon/history&token=<?php echo $token; ?>&advanced_coupon_id=<?php echo $advanced_coupon_id; ?>');
//--></script>
<?php } ?>
<script type="text/javascript"><!--
$('#tabs a').tabs();
$('#languages a').tabs(); 
//--></script> 

<?php echo $footer; ?>