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
				<td class="left"><?php echo $entry_status; ?></td>
				<td class="left"><select name="free_gift_status">
				<?php if ($free_gift_status) {  ?>
					<option value="1" selected="selected"><?php echo $text_enabled; ?></option>			
					<option value="0"><?php echo $text_disabled; ?></option>			
				<?php } else { ?>
					<option value="1"><?php echo $text_enabled; ?></option>			
					<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
				<?php } ?>
				</select></td>
			</tr>
			<tr>
				<td class="left"><?php echo $entry_order_subtotal; ?></td>
				<td class="left"><input type="text" name="free_gift_order_subtotal" value="<?php echo $free_gift_order_subtotal; ?>" /></td>
			</tr>
			<tr>
				<td class="left"><?php echo $entry_required_cart_product; ?></td>
				<td class="left">
					<?php echo $entry_product; ?>
					<input type="text" name="required_product" value="" size="50" /> <br /><br />
					<div id="required-cart-product" class="scrollbox">
					<?php $class = 'odd'; ?>
					<?php foreach ($required_products as $product) { ?>
					<?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
					<div id="required-cart-product<?php echo $product['product_id']; ?>" class="<?php echo $class; ?>"><?php echo $product['name']; ?> <img src="view/image/delete.png" alt="" />
					  <input type="hidden" value="<?php echo $product['product_id']; ?>" />
					</div>
					<?php } ?>
				    </div>
				    <input type="hidden" name="free_gift_required_cart_product" value="<?php echo $free_gift_required_cart_product; ?>" />
				</td>
			</tr>
			<tr>
				<td class="left"><?php echo $entry_customer_groups; ?></td>
				<td>
					<div class="scrollbox">
					<?php $class = 'odd'; ?>
					<?php foreach($customer_groups as $customer_group) { ?>
					<?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
						<div class="<?php echo $class;?>">
						<?php   if (in_array($customer_group['customer_group_id'], $free_gift_allowed_groups)) { ?>
									<input type="checkbox" name="free_gift_allowed_groups[]" value="<?php echo $customer_group['customer_group_id']; ?>" checked="checked" /><?php echo $customer_group['name']; ?>
						<?php   } else { ?>
									<input type="checkbox" name="free_gift_allowed_groups[]" value="<?php echo $customer_group['customer_group_id']; ?>" /><?php echo $customer_group['name']; ?>
						<?php   } ?>
						</div>	
					<?php } ?>
					</div>
				</td>
			</tr>
			<tr>
				<td class="left"><?php echo $entry_gift_product; ?></td>
				<td class="left">
					<?php echo $entry_product; ?>
					<input type="text" name="gift_product" value="" size="50" /> <br /><br />
					<div id="gift-product" class="scrollbox">
					<?php $class = 'odd'; ?>
					<?php foreach ($gift_products as $product) { ?>
					<?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
					<div id="gift-product<?php echo $product['product_id']; ?>" class="<?php echo $class; ?>"><?php echo $product['name']; ?> <img src="view/image/delete.png" alt="" />
					  <input type="hidden" value="<?php echo $product['product_id']; ?>" />
					</div>
					<?php } ?>
				    </div>
				    <input type="hidden" name="free_gift_gift_product" value="<?php echo $free_gift_gift_product; ?>" />
				</td>
			</tr>			
			<tr>
				<td class="left"><?php echo $entry_sort_order; ?></td>
				<td class="left"><input type="text" name="free_gift_sort_order" value="<?php echo $free_gift_sort_order; ?>" /></td>
			</tr>
		</table>
    </form>
  </div>
</div>
<?php echo $footer; ?>
<script type="text/javascript"><!--
$('input[name=\'required_product\']').autocomplete({
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
		$('#required-cart-product' + ui.item.value).remove();
		
		$('#required-cart-product').append('<div id="required-cart-product' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" value="' + ui.item.value + '" /></div>');

		$('#required-cart-product div:odd').attr('class', 'odd');
		$('#required-cart-product div:even').attr('class', 'even');
		
		data = $.map($('#required-cart-product input'), function(element){
			return $(element).attr('value');
		});
						
		$('input[name=\'free_gift_required_cart_product\']').attr('value', data.join());
					
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});

$('#required-cart-product div img').live('click', function() {
	$(this).parent().remove();
	
	$('#required-cart-product div:odd').attr('class', 'odd');
	$('#required-cart-product div:even').attr('class', 'even');

	data = $.map($('#required-cart-product input'), function(element){
		return $(element).attr('value');
	});
					
	$('input[name=\'free_gift_required_cart_product\']').attr('value', data.join());	
});


$('input[name=\'gift_product\']').autocomplete({
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
		$('#gift-product' + ui.item.value).remove();
		
		$('#gift-product').append('<div id="gift-product' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" value="' + ui.item.value + '" /></div>');

		$('#gift-product div:odd').attr('class', 'odd');
		$('#gift-product div:even').attr('class', 'even');
		
		data = $.map($('#gift-product input'), function(element){
			return $(element).attr('value');
		});
						
		$('input[name=\'free_gift_gift_product\']').attr('value', data.join());
					
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});

$('#gift-product div img').live('click', function() {
	$(this).parent().remove();
	
	$('#gift-product div:odd').attr('class', 'odd');
	$('#gift-product div:even').attr('class', 'even');

	data = $.map($('#gift-product input'), function(element){
		return $(element).attr('value');
	});
					
	$('input[name=\'free_gift_gift_product\']').attr('value', data.join());	
});
//--></script> 
