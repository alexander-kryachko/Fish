<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>

<div id="content" class="checkout-page">


	<?php echo $content_top; ?>
<style>
	.payment> .buttons {
		display: none;
	}
	.nofloat {
	  display: none;
	}
</style>
	<div class="checkout">
		<div id="checkout">
			<div class="checkout-content"  style="display: block">
				<form id="checkout_form" onsubmit="return false;">
				<input type="hidden" id="checkout-step" name="step" value="1" />
				<div class="checkout-registr">
				<div>
					<div class="left" id="checkout-content">
						<p class="info-title"><a class="title-link active" data-step="1">1. Заполните данные о себе <small>(редактировать)</small></a></p>
						<div id="checkout-container">
							<table class="form">
								<tr>
									<td class="labels">Имя:</td>
									<td><input type="text" name="firstname" value="<?php echo $firstname?>"
											   class="large-field"/></td>
								</tr>
								<tr>
									<td class="labels"><?php //echo $entry_lastname; ?>Фамилия:</td>
									<td><input type="text" name="lastname" value="<?php echo $lastname; ?>"
											   class="large-field"/></td>
								</tr>
								<tr>
									<td class="labels"><?php echo $entry_telephone; ?></td>
									<td><input type="tel" name="telephone" value="<?php echo $telephone?>"
											   class="large-field phone-number"/></td>
								</tr>
								
								<tr>
									<td class="labels"><?php echo $entry_email; ?></td>
									<td><input type="text" name="email" value="<?php echo $email?>" class="large-field"/>
									<br><span class="noproblem">(необязательно)</span>
									</td>
								</tr>
                                <?php /*



                                    */ ?>
								<tr style="display: none">
									<td class="labels"><?php echo $entry_country; ?></td>
									<td>
										<select name="country_id" class="large-field">
											<option value=""><?php echo $text_select; ?></option>
											<?php foreach ($countries as $country) { ?>
												<?php if ($country['country_id'] == $country_id) { ?>
													<option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
												<?php } else { ?>
													<option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
												<?php } ?>
											<?php } ?>
										</select>
									</td>
								</tr>
								<tr>
									<td class="labels"><?php echo $entry_zone; ?></td>
									<td><select type="text" name="zone_id" value="<?php echo $lastname; ?>"
												class="large-field"></select></td>
								</tr>
								<tr>
									<td class="labels"><?php //echo $entry_city; ?>Город:</td>
									<td><input type="text" name="city" value="<?php echo $city; ?>" class="large-field" /></td>
								</tr>
                                <?php /*
								<tr>
									<td class="labels"><?php echo $entry_postcode; ?></td>
									<td><input type="text" name="postcode" value="<?php echo $postcode; ?>" class="large-field" /></td>
								</tr>
                                */ ?>
							</table>
							<a class="button" style="margin-left:272px" data-step="2"><span>Продолжить</span></a>
						</div>
					</div>
					<div class="right">
						<div class="shipping-content" id="shipping-content" style="display: block">
						<p class="info-title"><a class="title-link" data-step="2">2. Доставка <small>(редактировать)</small></a></p>
						<div id="shipping-container" style="display: none">
							<?php if(count($shipping_methods) > 1) { ?>
							<p><?php echo $text_shipping_method; ?></p>
							
							<table class="form">

								
								<?php foreach($shipping_methods as $shipping_method) { ?>
                                    <?php /*
								<tr>
									<td colspan="3" style="text-align: center;"><b><?php echo $shipping_method['title']; ?></b></td>
								</tr>
                                */ ?>

								<?php if(!$shipping_method['error']) { ?>


                                <?php foreach($shipping_method['quote'] as $quote) { ?>
										<tr>
											<td style=""><?php if($quote['code'] == $shipping_code || !$shipping_code) { ?>
												<?php $shipping_code = $quote['code']; ?>
												
												<input type="radio" name="shipping_method"
													   value="<?php echo $quote['code']; ?>"
													   id="<?php echo $quote['code']; ?>" checked="checked"/>
												<?php } else { ?>
												<input type="radio" name="shipping_method"
													   value="<?php echo $quote['code']; ?>"
													   id="<?php echo $quote['code']; ?>"/>
												<?php } ?>
                                                <label for="<?php echo $quote['code']; ?>"><?php echo $quote['title']; ?></label>

                                                <?php /*
                                                    <br/>
                                                <span><?php echo $quote['text']; ?></span>
                                                */?>
                                            </td>
										</tr>
										<?php if ($quote['code'] == 'novaposhta.novaposhta') { ?>
										<tr class="hidd">
											<td>
												<table>
													<tr>
														<td class="labels"><?php //echo $entry_address_1; ?>№ Отделения Новой Почты</td></td>
													</tr>
													<tr>
														<td><input type="text" name="address_1" value="<?php echo $address_1; ?>" class="large-field" /></input></td>
													</tr>
												</table>
										</tr>
										<tr></tr>
										<?php } elseif($quote['code'] == 'UKRposhta.UKRposhta'){ ?>
										<tr class="hidd">
											<td></td>
										</tr>

										<?php }elseif($quote['code'] == 'multiflat.multiflat0') { ?>
										<tr class="hidd">
											<td>
											</td>
										</tr>

                                        <?php } ?>

										<tr height="20"></tr>						
						
										<?php } ?>

                                    <?php } else { ?>
									<tr>
										<td colspan="3">
											<div class="error"><?php echo $shipping_method['error']; ?></div>
										</td>
									</tr>
									<?php } ?>
								<?php } ?>

							</table>

							<?php } else if ($shipping_methods) { ?>

							<?php $shipping_method = array_shift($shipping_methods);?>

								<p><?php //echo $text_shipping_method; ?></p>
							<table class="form">
								<?php foreach($shipping_method['quote'] as $quote) { ?>
								<tr style="width: 340px;">
									<td>
										<?php if($quote['code'] == $shipping_code || !$shipping_code) { ?>
										<?php $shipping_code = $quote['code']; ?>
										<input type="radio" name="shipping_method" value="<?php echo $quote['code']; ?>" id="<?php echo $quote['code']; ?>" checked="checked"/>
										<?php } else { ?>
										<input type="radio" name="shipping_method" value="<?php echo $quote['code']; ?>" id="<?php echo $quote['code']; ?>"/>
										<?php } ?>
										<label for="<?php echo $quote['code']; ?>"><?php echo $quote['title']; ?></label>
									</td>
									<td style="text-align: right; display: none;">
										<label><?php echo $quote['text']; ?></label>
									</td>
								</tr>
                                    <tr><td class="labels"><?php //echo $entry_address_1; ?>№ Отделения Новой Почты</td> </tr>
                                    <tr><td><input type="text" name="address_1" value="<?php echo $address_1; ?>" class="large-field" /></input></td></tr>
								<?php } ?>
								</table>
							<?php } else { ?>
							
							<?php }?>
						<!--	<table>
							<tr>
									<td class="labels"><?php //echo $entry_city; ?>Город:</td>
									<td><input type="text" name="city" value="<?php echo $city; ?>" class="large-field" /></td>  
								</tr> 

									<td class="labels"><?php //echo $entry_address_1; ?>№ Отделения Новой Почты</td> 
									<td><input type="text" name="address_1" value="<?php echo $address_1; ?>" class="large-field" /></input></td> 
<?php if ($quote['code'] == 'novaposhta.novaposhta' && !empty($quote['period'])) { ?>
						<br/>
						//<?php echo $quote['text_period']; ?> - <?php echo $quote['period']; ?><?php } ?>									
								</tr>
							</table> -->
							<a class="button" style="margin-left:272px" data-step="3"><span>Продолжить</span></a>
						
						</div>
						</div>
						
						<div class="payment-content" id="payment-content">
							<p class="info-title"><a class="title-link" data-step="3">3. Оплата</a></p>
							<div id="payment-container" style="display: none">
								<?php echo $payment_data; ?>
								<a id="confirm" class="button" data-step="4"><span><?php //echo $button_confirm?></span></a>
							</div>
						</div>				
					</div>
					
					<div style="clear: both;">
					<?/*

					<?php if ($text_agree) { ?>
					<div class="buttons">
					  <div class="right"><?php echo $text_agree; ?>
						<?php if ($agree) { ?>
						<input type="checkbox" name="agree" value="1" checked="checked" />
						<?php } else { ?>
						<input type="checkbox" name="agree" value="1" />
						<?php } ?>
					  </div>
					</div>
						<script type="text/javascript"><!--
							<?php if(in_array(substr(VERSION, 0, 5), array('1.5.3', '1.5.4'))) { ?>
								$('.colorbox').colorbox({
									width: 640,
									height: 480
								});
							<?php } else { ?>
								$('.fancybox').fancybox({
									width: 560,
									height: 560,
									autoDimensions: false
								});
							<?php }?>
						//--></script>
					<?php } ?>
					*/?>
					</div>
				</div>
				</div>
				<div class="checkout-cart">
						<div class="checkout-product">
							<table>
								<tbody>
								<?php foreach($products as $product) { ?>
								<tr>
									<td class="image"><?php if ($product['thumb']) { ?>
									  <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" />
									  <?php } ?>
									</td>
									<td class="name" width="370"><?php echo $product['name']; ?>
									<?php foreach($product['option'] as $option) { ?>
											<br/>
											&nbsp;
											<small> - <?php echo $option['name']; ?>
												: <?php echo $option['value']; ?></small>
											<?php } ?>
										<span class="cart-attr"><?php if($product['attribute_groups']) { ?>
											<?php foreach($product['attribute_groups'][0]['attribute'] as $attribute) { ?>
												<?php echo $attribute['name']; ?>:  
												<?php echo $attribute['text']; ?>
												<span class="comma">,</span>&nbsp;	
												<?php } ?>
										<?php } ?></span>
										</td>
									<td class="quantity" width="70"><span class="qty-img"></span><?php echo $product['quantity']; ?></td>
									<td class=""></td>
									<td class=""></td>
									<td class="total" width="110"><?php echo $product['total_text']; ?></td>
								</tr>
									<?php } ?>
								</tbody>
								<tbody id="total_data">
									<?php echo $total_data?>
								</tbody>
							</table>
						</div>						
					</div>
				</form>
			</div>
		</div>
	</div>

<?php //echo $content_bottom; ?></div>
<script type="text/javascript" src="/catalog/view/javascript/jquery.maskedinput.min.js" ></script>
<script type="text/javascript">
    $(function () {
        getData('getWarehouses', $('input[name="city"]').val());
    });
	function checkoutStep(step){
		var step = parseInt(step);
		var current = parseInt($('#checkout-step').val());
		if (window.lockCheckout || current == step) return false;
		window.lockCheckout = true;

		/*switch(step){
			case 1:
				break;
			case 2:
				break;
			case 3:
				break;
		}*/

		$.ajax({
			url: 'index.php?route=checkout/checkout&from='+step,
			type: 'post',
			data: $('#checkout_form').serialize(),
			dataType: 'json',
			beforeSend: function(){
				//$('#confirm').bind('click', false);
				//$('#confirm').after('<span class="wait">&nbsp;<img src="/catalog/view/theme/default/image/loading.gif" alt="" /></span>');
			},
			complete: function(){
				//$('#confirm').unbind('click', false);
				$('.wait').remove();
			},
			error: function(json, json2, json3){
				//console.log('error:');
				//console.log(json);
				//alert(json2);
				//alert(json3);
				//for(var i in json) alert(i+' = '+json[i]);
			},
			success: function(json) {
				//if (current == 1){
				//alert(current);
				//for(var i in json) alert(i + ' = ' +json[i]);
					//alert(json);
				//}
				
				$('.warning').remove();
				$('.error').remove();
				//console.log(json);
				if (json['redirect']) location = json['redirect'];
				if (json.errors){
					for (var key in json.errors) {
						if (key == 'country_id' || key == 'zone_id' || key == 'city') {
						$('#checkout .checkout-content select[name=\'' + key + '\']').
								after('<span class="error" >' + json.errors[key] + '</span>');
						} else {
						$('#checkout .checkout-content input[name=\'' + key + '\']').
								after('<span class="error" >' + json.errors[key] + '</span>');
						}
					}
					var eTop = $('#checkout').offset().top;
					$('html, body').animate({scrollTop: eTop}, 'slow');
				} else {
					$('a[data-step]').each(function(){
						var s = parseInt($(this).attr('data-step'));
						if (step <= s) $(this).find('small').hide();
							else $(this).find('small').show();
					});

					switch(step){
						case 1:
							$('#checkout-step').val(1);
							$('.title-link').removeClass('active');
							$('#checkout-content .title-link').addClass('active');
							$('#checkout-container').show();
							$('#shipping-container').hide();
							$('#payment-container').hide();
							break;
						case 2:
							$('#checkout-step').val(2);
							$('.title-link').removeClass('active');
							$('#shipping-content .title-link').addClass('active');
							$('#checkout-container').hide();
							$('#shipping-container').show();
							$('#payment-container').hide();
							break;
						case 3:
							$('#checkout-step').val(3);
							$('.title-link').removeClass('active');
							$('#payment-content .title-link').addClass('active');
							$('#checkout-container').hide();
							$('#shipping-container').hide();
							$('#payment-container').show();
							break;
						case 4:
							//alert('success');
							if (json.result = "success") {
								/*
								$.ajax({
									type: 'get',
									url: 'index.php?route=payment/cod/confirm',
									success: function() {
										location = 'http://fisherway/index.php?route=checkout/success';
									}		
								});
								*/
								//location = ;
								
								/*
								var confirm_btn = $('#button-confirm');
								if (!confirm_btn){
									confirm_btn =$('.payment . buttons input.button')
								}
								alert(confirm_btn.parent().html());
								//confirm_btn.trigger('click');
								*/
							}
							break;
						
					}
				}
				window.lockCheckout = false;
			}
		});
	}

	$('a[data-step]').live('click', function(){
		checkoutStep($(this).attr('data-step'));
	});
	

	/*$('#confirm').live('click', function(){
		$.ajax({
			url: 'index.php?route=checkout/checkout',
			type: 'post',
			data: $('#checkout_form').serialize(),
			dataType: 'json',
			beforeSend: function() {
				$('#confirm').bind('click', false);
				$('#confirm').after('<span class="wait">&nbsp;<img src="/catalog/view/theme/default/image/loading.gif" alt="" /></span>');
			},
			complete: function() {
				$('#confirm').unbind('click', false);
				$('.wait').remove();
			},
			success: function(json) {
				$('.warning').remove();
				$('.error').remove();

				if (json['redirect']) {
					location = json['redirect'];
				}

				if (json.errors) {
					for (var key in json.errors) {
					    if (key == 'country_id') {
						$('#checkout .checkout-content select[name=\'' + key + '\']').
								after('<span class="error" >' + json.errors[key] + '</span>');
					    } else {
						$('#checkout .checkout-content input[name=\'' + key + '\']').
								after('<span class="error" >' + json.errors[key] + '</span>');
					    }
					}
					var eTop = $('#checkout').offset().top;
					$('html, body').animate({scrollTop: eTop}, 'slow');
				} else {
					if (json.result = "success") {
						var confirm_btn = $('#button-confirm');
						if (!confirm_btn){
							confirm_btn =$('.payment . buttons input.button')
						}
						confirm_btn.trigger('click');
					}
				}
			}
		});
	});*/

	$('input[name=payment_method]').live('change', function(){
		$(".checkout-product").mask();
		$.ajax({
			url: 'index.php?route=checkout/checkout/change_payment',
			type: 'post',
			data: 'payment_code='+$("input[name=payment_method]:checked").val(),
			dataType: 'json',
			success: function(json) {
				 if (json.payment){
					 $(".payment").html(json.payment);
				 }
				 $(".checkout-product").unmask();
			}
		})
	});

	$('input[name=shipping_method]').live('change', function(){
		$(".checkout-product").mask();
		$.ajax({
			url: 'index.php?route=checkout/checkout/change_shipping',
			type: 'post',
			data: 'shipping_method='+$("input[name=shipping_method]:checked").val(),
			dataType: 'json',
			success: function(json) {
				 $('#total_data').html(json['totals_data']);
				 $('.payment-content').html(json['payment_data']);
				 $(".checkout-product").unmask();
			}
		})
	});
	
	$("input.phone-number").inputmask("+38 (999) 999-99-99");
	//--></script>
<!-- Nova Poshta -->
<script type="text/javascript"><!--

//Selected shipping method
var shipping = $('input[name=shipping_method]:checked').val();

$(document).ajaxSuccess( function(ev, xhr, settings) {
	if(settings.url.indexOf('register') > -1 || settings.url.indexOf('guest') > -1 || settings.url.indexOf('payment_address') > -1) {
   		console.log('It was download address fields' + settings.url + '.');
   		
   		var company_id = $('input[name *= company_id], ').hide();
   		$('input[name = company], ').after(company_id);
   		
   		$('div#company-id-display').replaceWith('<div class="checkbox"><label><input type="checkbox" name="shipping_method" value="novaposhta.novaposhta"><?php echo $text_description; ?></label></div>');
   	}
} );

//Intercept event
document.body.addEventListener('change', 
	function(e) {
		console.info('Catch event "' + e.type + '" of element "' + e.target.name + '". Selected value: ' + e.target.value);
 		checkEvent(e);
 	}, 
	true
);	


	$(document).ready(function(){


		var shipp = '<table class="shipp-add">';
		shipp +=	'<tr><td class="labels" colspan="2">Укажите адрес доставки</td> </tr>';
		shipp +=	'<tr><td class="labels">Индекс</td><td><input type="text" name="postcode" value="" class="large-field" /></td></tr>';
		shipp +=	'<tr><td class="labels"> Улица</td><td><input type="text" name="street" value="" class="large-field" /></td></tr>';
		shipp +=	'<tr><td class="labels"> Дом</td><td><input type="text" name="house" value="" class="large-field" /></td></tr>';
		shipp +=	'<tr><td><span id="payment-flat"></span>Квартира</td> <td><input type="text" name="flat" value="" class="large-field" /><input type="hidden" name="hidd-inp" value="0"></td></tr>';
		shipp +=	'</table>';

		$('#shipping-container table.form tr').each(function(){
			var check = $(this).find('input[type="radio"]');
			if(check.prop('checked')){
				$(this).next().addClass('hidd-none');
				if(check.attr('id') == 'UKRposhta.UKRposhta' || check.attr('id') == 'multiflat.multiflat0'){
					$('.hidd-none td').append(shipp);
				}
			}
		});


		$('#shipping-container input[type="radio"]').on('click', function(){
			$('.shipp-add').remove();
			$('#shipping-container table tr').removeClass('hidd-none');
			var that = $(this);
			if(that.prop('checked')){
				that.parent().parent().next().addClass('hidd-none');
				if(that.attr('id') == 'UKRposhta.UKRposhta' || that.attr('id') == 'multiflat.multiflat0'){
					$('.hidd-none td').append(shipp);
				}
			}
		});

		$('a[data-step=3] ').on('click', function(){
			$('.hide-inp').val(0);
			$('#shipping-container table.form tr').each(function(){

				var check = $(this).find('input[type="radio"]');
				if(check.prop('checked')){
					if(check.attr('id') == 'UKRposhta.UKRposhta' || check.attr('id') == 'multiflat.multiflat0'){
						$('input[name="hidd-inp"]').val(1);
					}
				}
			});
		})
	});

function checkEvent(e) {
	console.log('-call method "checkEvent(e)"');
 	 	
 	if (e.target.name == 'shipping_method') {
 		console.log('-delivery method changed');
 		
 		var ch = $('input[name=shipping_method]:checkbox').prop('checked');
 		
 		if (ch) {
 			shipping = e.target.value;
 		}	
 		
 		if (e.target.value == 'novaposhta.novaposhta' && ch) {
 			$('label[for *= address_1] > span.text').html('<?php echo $entry_warehouses; ?>'); //change field`s name	
 			zone = $('select[name *= zone_id]').val();
 			
 			console.log('-selected method of delivery "Nova Poshta"');
 			console.log('-selected zone`s value: ' + zone);
 			
 			if (zone) {
 				console.log('-get "Nova Poshta" cities and cleaning the address field');

 				getData('getCities', zone);
 				//$('[name *= address_1], [name *= postcode]').val('');
 			}
 		} else {

 			console.log('-return default fields');
 			
 			var replacement_fields_address_1 = $('[name *= address_1]');
 			var replacement_fields_city = $('[name *= city]');
 			var new_input_address_1 = document.createElement('input');
 			var new_input_city = document.createElement('input');
 			
            new_input_address_1.setAttribute('type', 'text');
            new_input_city.setAttribute('type', 'text');
            	
            copyAttributes(replacement_fields_address_1[0], new_input_address_1);
            copyAttributes(replacement_fields_city[0], new_input_city);
            
            //replacement_fields_address_1.replaceWith(new_input_address_1.outerHTML);
            //replacement_fields_city.replaceWith(new_input_city.outerHTML);
            
            //$('[name *= postcode]').val('');
            $('label[for *= address-1]').html('<?php echo $entry_address_1; ?>'); //change field`s name 
 		}
 	} else if (e.target.name.indexOf('zone') > -1 && shipping == 'novaposhta.novaposhta') {
 		console.log('-changed zone. Selected value:' + e.target.value);
 		console.log('-get "Nova Poshta" cities');

 		getData('getCities', e.target.value);
 	} else if (e.target.name.indexOf('city') > -1 /*&& shipping == 'novaposhta.novaposhta'*/) {
 		console.log('-changed city. Selected value:' + e.target.value);
 		console.log('-get "Nova Poshta" warehouses');

 		getData('getWarehouses', e.target.value);
 		
 	} else if ((e.target.name.indexOf('account') > -1 || e.target.name.indexOf('register') > -1) && shipping == 'novaposhta.novaposhta') {
 		console.log('-changed account. Selected value:' + e.target.value);
 		
 		zone = $('select[name *= zone_id]').val();
 			
 		if (zone) {
 			console.log('-get "Nova Poshta" cities and cleaning the address field');

 			$(document).ajaxStop( function() { 
 				getData('getCities', zone);
 			});
 			$('[name *= address_1], [name *= postcode]').val('');
 		}
 	}	
} 			


function getData(method, filter) {
	var input;
	
	switch(method) {
		case 'getCities':
			input = 'city';
		break;
		
		case 'getWarehouses':
			input = 'address_1';
		break;	
	}
	
	$.ajax( {
		url: 'index.php?route=module/shippingdata/getData',
		type: 'GET',
		data: '&shipping=' + 'novaposhta.novaposhta'/*shipping*/ + '&method=' + method + '&filter=' + filter,
		dataType: 'json',
		async: false,
		global: false,
		success: function (json) {
			var html;
			var replacement_fields = $('[name *= ' + input + ']');
			var new_select = document.createElement('select');
				
			html = '<option value=""><?php echo $text_select; ?></option>';
			for (i = 0; i < json.length; i++) {	
				html += '<option value="' + json[i]['Description'] + '">' + json[i]['Description'] + '</option>';
            }
            	
            new_select.innerHTML = html;
            copyAttributes(replacement_fields[0], new_select);
            replacement_fields.replaceWith(new_select.outerHTML);            	
        }
	} );
}

function copyAttributes(from_element, to_element) {
	if (from_element != undefined) {
		var attrs = from_element.attributes;
		console.log('- copy attributes into a new element');
	
		for(var i = 0; i < attrs.length; i++) {
			if (attrs[i].name == 'type') {
				continue;
			}
			to_element.setAttribute(attrs[i].name, attrs[i].value);
		}
	}
}





//--></script>
<!-- Nova Poshta -->

<script type="text/javascript"><!--
$('#payment-address select[name=\'country_id\']').bind('change', function() {
	$.ajax({
		url: 'index.php?route=checkout/checkout/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('#payment-address select[name=\'country_id\']').after('<span class="wait">&nbsp;<img src="/catalog/view/theme/default/image/loading.gif" alt="" /></span>');
		},
		complete: function() {
			$('.wait').remove();
		},			
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('#payment-postcode-required').show();
			} else {
				$('#payment-postcode-required').hide();
			}
			
			html = '<option value=""><?php echo $text_select; ?></option>';
			
			if (json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
        			html += '<option value="' + json['zone'][i]['zone_id'] + '"';
	    			
					if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
	      				html += ' selected="selected"';
	    			}
	
	    			html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
			}
			
			$('#payment-address select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('#payment-address select[name=\'country_id\']').trigger('change');




	$('select[name=\'country_id\']').bind('change', function() {
		$.ajax({
			url: 'index.php?route=checkout/checkout/country&country_id=' + this.value,
			dataType: 'json',
			beforeSend: function() {
				$('select[name=\'country_id\']').after('<span class="wait">&nbsp;<img src="/catalog/view/theme/default/image/loading.gif" alt="" /></span>');
			},
			complete: function() {
				$('.wait').remove();
			},
			success: function(json) {
				if (json['postcode_required'] == '1') {
					$('#payment-postcode-required').show();
				} else {
					$('#payment-postcode-required').hide();
				}

				html = '<option value=""><?php echo $text_select; ?></option>';

				if (json['zone'] != '') {
					for (i = 0; i < json['zone'].length; i++) {
						html += '<option value="' + json['zone'][i]['zone_id'] + '"';

						if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
							html += ' selected="selected"';
						}

						html += '>' + json['zone'][i]['name'] + '</option>';
					}
				} else {
					html += '<option value="0" selected="selected"><?php echo $text_none; ?></option>';
				}

				$('select[name=\'zone_id\']').html(html);
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	});

	$('select[name=\'country_id\']').trigger('change');


//--></script>
	
<?php echo $footer; ?>
