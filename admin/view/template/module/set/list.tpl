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
			<a onclick="location = '<?php echo $module; ?>';" class="button"><span><?php echo $button_module; ?></span></a>
			<a onclick="location = '<?php echo $insert; ?>'" class="button"><span><?php echo $button_insert; ?></span></a>
			<a onclick="$('#form').submit();" class="button"><span><?php echo $button_delete; ?></span></a>
		</div>
    </div>
    <div class="content">
    
		<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
    	<input hidden id="sort" value="<?php echo $sort ?>">
    	<input hidden id="order" value="<?php echo $order ?>">
        <table class="list">
			<thead>
            <tr>
				<td width="1" align="center"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
				<td class="left">
                    <?php if ($sort == 'sd.name') { ?>
                        <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_title; ?></a>
                    <?php } else { ?>
                        <a href="<?php echo $sort_name; ?>"><?php echo $column_title; ?></a>
                    <?php } ?>
                </td>
				<td class="left"><?php echo $column_product_in_set; ?></td>
				<!--td class="left"><?php echo $column_price; ?></td-->
				<td class="left"><?php echo $column_status; ?></td>
				<td class="right"><?php echo $column_action; ?></td>
            </tr>
			</thead>
			<tbody>
            
            <tr class="filter">
              <td></td>
              <td><input type="text" name="filter_name" value="<?php echo $filter_name; ?>" /></td>
              <td>
                <input type="text" name="filter_product" value="<?php echo $filter_product; ?>" />
                <input type="hidden" name="filter_product_id" value="<?php echo $filter_product_id; ?>" />
              </td>
              <!--td></td-->
              <td><select name="filter_status">
                  <option value="*"></option>
                  <?php if ($filter_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <?php } ?>
                  <?php if (!is_null($filter_status) && !$filter_status) { ?>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="0"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select></td>
              <td align="right">
                <a onclick="filter();" class="button"><?php echo $button_filter; ?></a>
                <a onclick="clear_filter();" class="button"><?php echo $button_clearfilter; ?></a>
              </td>
            </tr>            
            
            
            
            <?php if ($sets) { ?>
				<?php $class = 'odd'; ?>
				<?php foreach ($sets as $set) { ?>
				<?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
				<tr class="<?php echo $class; ?>">
					<td align="center">
						<?php if ($set['selected']) { ?>
							<input type="checkbox" name="selected[]" value="<?php echo $set['set_id']; ?>" checked="checked" />
						<?php } else { ?>
							<input type="checkbox" name="selected[]" value="<?php echo $set['set_id']; ?>" />
						<?php } ?>
					</td>
					<td class="left"><?php echo $set['title']; ?></td>
					<td class="left">
                        <?php if($set['products']){?>
                            <?php foreach($set['products'] as $product){?>
                                <?php echo $product['name']; ?><br />
                                    <?php if($product['options']){?>
                                        <?php foreach($product['options'] as $koption=>$voption){?>
                                            <small> - <?php echo $koption; ?>: <?php echo $voption; ?></small><br />
                                        <?php } ?>
                                    <?php } ?>                                
                            <?php } ?>
                        <?php } ?>
                    </td>
					<!--td class="left"><?php echo $set['price']; ?></td-->
					<td class="left"><?php echo $set['status']; ?></td>
					<td class="right">
						<?php foreach ($set['action'] as $action) { ?> [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ] <?php } ?>
					</td>
				</tr>
				<?php } ?>
            <?php } else { ?>
				<tr class="even">
					<td class="center" colspan="7"><?php echo $text_no_results; ?></td>
				</tr>
            <?php } ?>
          </tbody>
        </table>
		</form>
        
        <div class="pagination"><?php echo $pagination; ?></div>
    </div>
	</div>
</div>




<script type="text/javascript"><!--
function filter() {
	url = 'index.php?route=module/set/listing&token=<?php echo $token; ?>';

	if ($('#sort').val()) {
		url += '&sort=' + $('#sort').val();
	}
	if ($('#order').val()) {
		url += '&order=' + $('#order').val();
	}
	
	var filter_name = $('input[name=\'filter_name\']').attr('value');
	
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}

	var filter_product = $('input[name=\'filter_product\']').attr('value');
	
	if (filter_product) {
		url += '&filter_product=' + encodeURIComponent(filter_product);
	}
	
	var filter_product_id = $('input[name=\'filter_product_id\']').attr('value');
	
	if (filter_product_id) {
		url += '&filter_product_id=' + encodeURIComponent(filter_product_id);
	}
	
	var filter_status = $('select[name=\'filter_status\']').attr('value');
	
	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}	

    location = url;
}
function clear_filter() {
	$('tr.filter select option:selected').prop('selected', false);
	$('tr.filter input').val('');
	filter();
	return false;
}
//--></script> 

<script type="text/javascript"><!--
$('input[name=\'filter_name\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=module/set/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.set_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('input[name=\'filter_name\']').val(ui.item.label);
						
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});
$('input[name=\'filter_product\']').autocomplete({
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
		$('input[name=\'filter_product\']').val(ui.item.label);
		$('input[name=\'filter_product_id\']').val(ui.item.value);				
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});

$('#form input').keydown(function(e) {
	if (e.keyCode == 13) {
		filter();
	}
});

</script>

<?php echo $footer; ?>