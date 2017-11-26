function AddToCartSet(set_id){
	$.ajax({
		url: 'index.php?route=module/set/add_to_cart',
		type: 'post',
		data: $('#set-' + set_id + ' input[type=\'text\'], #set-' + set_id + ' input[type=\'hidden\'], #set-' + set_id + ' input[type=\'radio\']:checked, #set-' + set_id + ' input[type=\'checkbox\']:checked, #set-' + set_id + ' select, #set-' + set_id + ' textarea'),
		dataType: 'json',
        error: function(json){alert('No contact')},
		success: function(json) {
			$('.success, .warning, .attention, information, .error').remove();
			$('.option').css('border','none');
            
			if (json['error']) {
				if (json['error']['option']) {
					for (i in json['error']['option']) {
                        $('#set-'+json['error']['option'][i]['set_id']+' #product-' + json['error']['option'][i]['sort_in_set']+' #option-'+json['error']['option'][i]['product_option_id']+'-'+set_id +'-'+json['error']['option'][i]['sort_in_set']).css('border','1px red solid').after('<span class="error">'+json['error']['option'][i]['text_error']+'</span>');
					}
				}
			}
			
			if (json['success']){
                $('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
                //change 311013
                $('#cart').addClass('active');
                $('#cart').load('index.php?route=module/cart #cart > *');
                $('#cart').live('mouseleave', function() {
                    $(this).removeClass('active');
                });
                $('.success').fadeIn('slow');
                $('#cart-total').html(json['total']);
                $('html, body').animate({ scrollTop: 0 }, 'slow');
			
				//$('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
				//$('.success').fadeIn('slow');
				//$('#cart-total').html(json['total']);
				//$('html, body').animate({ scrollTop: 0 }, 'slow'); 
			}
		}
	});
}
