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
  <form action="<?php echo $update; ?>" method="post" enctype="multipart/form-data" id="form"><div class="box">
    <div class="heading">
      <h1><img src="view/image/product.png" alt="" /> <?php echo $heading_title; ?> - <?php echo $name; ?></h1>
	  <div class="buttons"><input type="checkbox" name="multiway" /><?php echo $text_multiway; ?>&nbsp;<a onclick="$('form').submit();" class="button"><span><?php echo $button_update; ?></span></a><a href="<?php echo $reset; ?>" class="button"><span><?php echo $button_reset; ?></span></a><a href="<?php echo $product_relator; ?>" class="button"><span><?php echo $button_back; ?></span></a></div>
    </div>
    <div class="content">
	  <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
        <table class="list">
          <thead>
            <tr>
			  <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
              <td class="center"><?php echo $column_image; ?></td>
              <td class="left"><?php if ($sort == 'pd.name') { ?>
                <a href="<?php echo $sort_name; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_name; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_name; ?>"><?php echo $column_name; ?></a>
                <?php } ?></td>
              <td class="left"><?php if ($sort == 'p.model') { ?>
                <a href="<?php echo $sort_model; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_model; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_model; ?>"><?php echo $column_model; ?></a>
                <?php } ?></td>
              <td class="left"><?php echo $column_category; ?>
			  </td>
              <td class="left"><?php if ($sort == 'p.status') { ?>
                <a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
                <?php } ?></td>
				<td class="right"><?php echo $column_related; ?></td>
				<td></td>
            </tr>
          </thead>
          <tbody>
            <tr class="filter">
              <td></td>
			  <td></td>
              <td><input type="text" name="filter_name" value="<?php echo $filter_name; ?>" /></td>
              <td><input type="text" name="filter_model" value="<?php echo $filter_model; ?>" /></td>
              <td align="left">
			  <select name="filter_category_id">
			  <option value=""></option>
			  <?php foreach ($categories as $category) { ?>
			  <?php if($category['category_id'] == $filter_category_id) { ?>
			  <option selected="selected" value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
			  <?php } else { ?>
			  <option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
			  <?php } ?>
			  <?php } ?>
			  </select></td>
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
				<td align="left"></td>
              <td align="right"><a onclick="filter();" class="button"><span><?php echo $button_filter; ?></span></a></td>
            </tr>
            <?php if ($products) { ?>
            <?php foreach ($products as $product) { ?>
            <tr>
				<td style="text-align: center;"><?php if ($product['related_match']) { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $product['product_id']; ?>" checked="checked" />
                <?php } else { ?>
                <input type="checkbox" name="selected[]" value="<?php echo $product['product_id']; ?>" />
                <?php } ?></td>
              <td class="center"><img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" style="padding: 1px; border: 1px solid #DDDDDD;" /></td>
              <td class="left"><?php echo $product['name']; ?></td>
              <td class="left"><?php echo $product['model']; ?></td>
              <td class="left">
			  <?php foreach ($product['categories'] as $category_name) {
			  echo $category_name . "<br />";
			  } ?>
			  </td>
              <td class="left"><?php echo $product['status']; ?></td>
              <td class="right">
                <span style="color: #008000;"><?php echo $product['related']; ?></span>
              </td>
              <td></td>
            </tr>
            <?php } ?>
            <?php } else { ?>
            <tr>
              <td class="center" colspan="8"><?php echo $text_no_results; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
    </div>
  </div></form>
</div>
<script type="text/javascript"><!--
function filter() {
	url = 'index.php?route=catalog/product_relator/update&token=<?php echo $token; ?>&product_id=<?php echo $product_id; ?>';
	
	var filter_name = $('input[name=\'filter_name\']').attr('value');
	
	if (filter_name) {
		url += '&filter_name=' + encodeURIComponent(filter_name);
	}
	
	var filter_model = $('input[name=\'filter_model\']').attr('value');
	
	if (filter_model) {
		url += '&filter_model=' + encodeURIComponent(filter_model);
	}
	
	var filter_category_id = $('select[name=\'filter_category_id\']').attr('value');
	
	if (filter_category_id) {
		url += '&filter_category_id=' + encodeURIComponent(filter_category_id);
	}
	
	var filter_status = $('select[name=\'filter_status\']').attr('value');
	
	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}	

	location = url;
}
//--></script> 
<script type="text/javascript"><!--
$('#form input').keydown(function(e) {
	if (e.keyCode == 13) {
		filter();
	}
});
//--></script> 
<script type="text/javascript"><!--
$('input[name=\'filter_name\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product_relator/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
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
		$('input[name=\'filter_name\']').val(ui.item.label);
						
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});

$('input[name=\'filter_model\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product_relator/autocomplete&token=<?php echo $token; ?>&filter_model=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.model,
						value: item.product_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('input[name=\'filter_model\']').val(ui.item.label);
						
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});
//--></script> 
<?php echo $footer; ?>