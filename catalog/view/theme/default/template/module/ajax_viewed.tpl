<div id="load_container" style="display: none;"></div>
<script>
$(function() {
	var ajax_url = 'index.php?route=module/viewed/getproducts';
	if (<?php echo $product_id; ?> != 0) 
		ajax_url += '&product_id=' + <?php echo $product_id; ?>;
		
	ajax_url += '&setting=' + '<?php echo $module_setting; ?>' ;
	
	var ajax_container;
	
	$.get(ajax_url,	function(data){
		$('#load_container').replaceWith(data);
    })
});
</script>
