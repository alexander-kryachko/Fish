<?php if ($sets) { ?>
	<h5 class="kit">Акционное предложение! <span>Купи комплект сейчас со скидкой на аксессуары:</span></h5>
    <div class="productpage-set-block set products-related">
		<div id="carousel_sets">
		  <ul class="jcarousel-skin-opencart">
			<?php foreach ($sets as $set) { ?>
			<li id="set-<?php echo $set['set_id']; ?>">
				<div class="wrap-set">
					<?php $i=1; foreach($set['products'] as $product){ ?>
						<? if ($i > 1){ ?><div class="plus">+</div><? } ?>
						<div class="product-block"><div class="wrap-product-item">
							<div class="product-item <?php if(!$product['active']){?>notactive<?php } ?>" id="product-<?php echo $i; ?>">
								<?php if ($product['thumb']) { ?>
									<div class="image">
										<?php if($product['present']){?><div class="present"><img src="image/present.png" class="present" alt="<?php echo $text_present; ?>" /></div><?php } ?>
										<?php if($product['sale_value']){?><div class="sale-value"> <?php echo $product['text_salevalue']; ?></div><?php } ?>
										<a href="<?php echo $product['href']; ?>" title="<?php echo $product['name']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a>
									</div>
								<?php } ?>                            
								<input type="hidden" class="quantity" name="quantity[<?php echo $product['product_id']; ?>]" value="<?php echo $product['quantity']; ?>" />
								<input type="hidden" class="product_id" name="product_id[<?php echo $i; ?>]" value="<?php echo $product['product_id']; ?>" />                            
								<div class="name"><a href="<?php echo $product['href']; ?>" title="<?php echo $product['name']; ?>"><?php echo $product['name']; ?></a></div>
								<?php if ($product['options']) { ?>
									  <div id="options-<?php echo $set['set_id']; ?>" class="options">
										<?php foreach ($product['options'] as $option) { ?>
											<?php if ($option['type'] == 'select') { ?>
												<div id="option-<?php echo $option['product_option_id']; ?>-<?php echo $set['set_id']; ?>-<?php echo $i; ?>" class="option">
												  <?php if ($option['required']) { ?>
												  <span class="required">*</span>
												  <?php } ?>
												  <b><?php echo $option['name']; ?>:</b><br />
												  <select name="option[<?php echo $product['product_id']; ?>][<?php echo $option['product_option_id']; ?>]" <?php if($option['selected']){?>disabled="disabled"<?php } ?>>
													<option value="0"><?php echo $text_select; ?></option>
													<?php foreach ($option['option_value'] as $option_value) { ?>
														<option value="<?php echo $option_value['product_option_value_id']; ?>" <?php if($option_value['selected']){?>selected="selected"<?php } ?> <?php if(!$option_value['active']){?>disabled="disabled"<?php } ?>>
															<?php echo $option_value['name']; ?>
														</option>
													<?php } ?>
												  </select>
												</div>
												<br />
											<?php } ?>
											<?php if ($option['type'] == 'radio') { ?>
											<div id="option-<?php echo $option['product_option_id']; ?>-<?php echo $set['set_id']; ?>-<?php echo $i; ?>" class="option">
											  <?php if ($option['required']) { ?>
											  <span class="required">*</span>
											  <?php } ?>
											  <b><?php echo $option['name']; ?>:</b><br />
											  <?php foreach ($option['option_value'] as $option_value) { ?>
												  <?php if($option['selected']){?>
													<?php if($option_value['selected']){?>
														<input type="radio" name="option[<?php echo $product['product_id']; ?>][<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>-<?php echo $product['product_id']; ?>-<?php echo $set['set_id']; ?>" checked="checked" disabled="disabled" />
														 <label for="option-value-<?php echo $option_value['product_option_value_id']; ?>-<?php echo $product['product_id']; ?>-<?php echo $set['set_id']; ?>">
															<?php echo $option_value['name']; ?>
														</label>
													<?php }else{ continue; }?>
												  <?php } else { ?>
													<input type="radio" name="option[<?php echo $product['product_id']; ?>][<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>-<?php echo $product['product_id']; ?>-<?php echo $set['set_id']; ?>" <?php if(!$option_value['active']){?>disabled="disabled"<?php } ?>  />
													<label for="option-value-<?php echo $option_value['product_option_value_id']; ?>-<?php echo $product['product_id']; ?>-<?php echo $set['set_id']; ?>">
														<?php echo $option_value['name']; ?>
													</label>
												  <?php } ?>
												  <br />
											  <?php } ?>
											</div>
											<br />
											<?php } ?>
											<?php if ($option['type'] == 'checkbox') { ?>
											<div id="option-<?php echo $option['product_option_id']; ?>-<?php echo $set['set_id']; ?>-<?php echo $i; ?>" class="option">
											  <?php if ($option['required']) { ?>
												<span class="required">*</span>
											  <?php } ?>
											  <b><?php echo $option['name']; ?>:</b><br />
											  <?php foreach ($option['option_value'] as $option_value) { ?>
												  <input type="checkbox" name="option[<?php echo $product['product_id']; ?>][<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>-<?php echo $product['product_id']; ?>-<?php echo $set['set_id']; ?>" <?php if($option_value['selected']){?>checked="checked" disabled="disabled"<?php } ?> <?php if(!$option_value['active']){?>disabled="disabled"<?php } ?> />
												  <label for="option-value-<?php echo $option_value['product_option_value_id']; ?>-<?php echo $product['product_id']; ?>-<?php echo $set['set_id']; ?>">
													<?php echo $option_value['name']; ?>
												  </label>
												  <br />
											  <?php } ?>
											</div>
											<br />
											<?php } ?>
											<?php if ($option['type'] == 'image') { ?>
											<div id="option-<?php echo $option['product_option_id']; ?>-<?php echo $set['set_id']; ?>-<?php echo $i; ?>" class="option">
											  <?php if ($option['required']) { ?>
											  <span class="required">*</span>
											  <?php } ?>
											  <b><?php echo $option['name']; ?>:</b><br />
											  <table class="option-image">
												<?php foreach ($option['option_value'] as $option_value) { ?>
												  <?php if($option['selected']){?>
													<?php if($option_value['selected']){?>
														<tr>
														  <td style="width: 1px;"><input type="radio" name="option[<?php echo $product['product_id']; ?>][<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>-<?php echo $product['product_id']; ?>-<?php echo $set['set_id']; ?>" checked="checked" disabled="disabled" /></td>
														  <td><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>-<?php echo $product['product_id']; ?>-<?php echo $set['set_id']; ?>"><img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name']; ?>" /></label></td>
														  <td>
															<label for="option-value-<?php echo $option_value['product_option_value_id']; ?>-<?php echo $product['product_id']; ?>-<?php echo $set['set_id']; ?>">
																<?php echo $option_value['name']; ?>
															</label>
														  </td>
														</tr>
													<?php } else { continue; }?>
												  <?php } else { ?>
													<tr>
													  <td style="width: 1px;"><input type="radio" name="option[<?php echo $product['product_id']; ?>][<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>-<?php echo $product['product_id']; ?>-<?php echo $set['set_id']; ?>" <?php if(!$option_value['active']){?>disabled="disabled"<?php } ?> /></td>
													  <td><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>-<?php echo $product['product_id']; ?>-<?php echo $set['set_id']; ?>"><img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name']; ?>" /></label></td>
													  <td>
														<label for="option-value-<?php echo $option_value['product_option_value_id']; ?>-<?php echo $product['product_id']; ?>-<?php echo $set['set_id']; ?>">
															<?php echo $option_value['name']; ?>
														</label>
													  </td>
													</tr>
												  <?php } ?>                                        
												<?php } ?>
											  </table>
											</div>
											<br />
											<?php } ?>
											<?php if ($option['type'] == 'text') { ?>
											<div id="option-<?php echo $option['product_option_id']; ?>-<?php echo $set['set_id']; ?>-<?php echo $i; ?>" class="option">
											  <?php if ($option['required']) { ?>
											  <span class="required">*</span>
											  <?php } ?>
											  <b><?php echo $option['name']; ?>:</b><br />
											  <?php if($option['selected']){?>
												<input type="text" name="option[<?php echo $product['product_id']; ?>][<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" disabled="disabled" />
											  <?php } else { ?>
												<input type="text" name="option[<?php echo $product['product_id']; ?>][<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" />
											  <?php } ?>
											</div>
											<br />
											<?php } ?>
											<?php if ($option['type'] == 'textarea') { ?>
											<div id="option-<?php echo $option['product_option_id']; ?>-<?php echo $set['set_id']; ?>" class="option">
											  <?php if ($option['required']) { ?>
											  <span class="required">*</span>
											  <?php } ?>
											  <b><?php echo $option['name']; ?>:</b><br />
											  <?php if($option['selected']){?>
												<textarea name="option[<?php echo $product['product_id']; ?>][<?php echo $option['product_option_id']; ?>]" disabled="disabled" ><?php echo $option['option_value']; ?></textarea>
											  <?php } else { ?>
												<textarea name="option[<?php echo $product['product_id']; ?>][<?php echo $option['product_option_id']; ?>]" ><?php echo $option['option_value']; ?></textarea>
											  <?php } ?>  
											</div>
											<br />
											<?php } ?>
											<?php if ($option['type'] == 'file') { ?>
												<div id="option-<?php echo $option['product_option_id']; ?>-<?php echo $set['set_id']; ?>-<?php echo $i; ?>" class="option">
												  <?php if ($option['required']) { ?>
												  <span class="required">*</span>
												  <?php } ?>
												  <b><?php echo $option['name']; ?>:</b><br />
												  <input type="button" value="<?php echo $button_upload; ?>" id="button-option-<?php echo $option['product_option_id']; ?>-<?php echo $set['set_id']; ?>-<?php echo $i; ?>" class="button" />
												  <input type="hidden" name="option[<?php echo $product['product_id']; ?>][<?php echo $option['product_option_id']; ?>]" value="" />
												</div>
												<br />
												<script type="text/javascript">
													new AjaxUpload('#button-option-<?php echo $option['product_option_id']; ?>-<?php echo $set['set_id']; ?>-<?php echo $i; ?>', {
														action: 'index.php?route=product/product/upload',
														name: 'file',
														autoSubmit: true,
														responseType: 'json',
														onSubmit: function(file, extension) {
															$('#button-option-<?php echo $option['product_option_id']; ?>-<?php echo $set['set_id']; ?>-<?php echo $i; ?>').after('<img src="/catalog/view/theme/default/image/loading.gif" class="loading" style="padding-left: 5px;" />');
															$('#button-option-<?php echo $option['product_option_id']; ?>-<?php echo $set['set_id']; ?>-<?php echo $i; ?>').attr('disabled', true);
														},
														onComplete: function(file, json) {
															$('#button-option-<?php echo $option['product_option_id']; ?>-<?php echo $set['set_id']; ?>-<?php echo $i; ?>').attr('disabled', false);
															$('.error').remove();
															if (json['success']) {
																$('#set-<?php echo $set['set_id']; ?> #product-<?php echo $i; ?> input[name=\'option[<?php echo $product['product_id']; ?>][<?php echo $option['product_option_id']; ?>]\']').attr('value', json['file']);
															}
															if (json['error']) {
																$('#option-<?php echo $option['product_option_id']; ?>-<?php echo $set['set_id']; ?>-<?php echo $i; ?>').after('<span class="error">' + json['error'] + '</span>');
															}
															$('.loading').remove();	
														}
													});
												</script>                                    
											<?php } ?>
											<?php if ($option['type'] == 'date') { ?>
											<div id="option-<?php echo $option['product_option_id']; ?>-<?php echo $set['set_id']; ?>-<?php echo $i; ?>" class="option">
											  <?php if ($option['required']) { ?>
											  <span class="required">*</span>
											  <?php } ?>
											  <b><?php echo $option['name']; ?>:</b><br />
											  <?php if($option['selected']){?>
												<input type="text" name="option[<?php echo $product['product_id']; ?>][<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="date" disabled="disabled" />
											  <?php } else { ?>
												<input type="text" name="option[<?php echo $product['product_id']; ?>][<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="date" />
											  <?php } ?>
											</div>
											<br />
											<?php } ?>
											<?php if ($option['type'] == 'datetime') { ?>
											<div id="option-<?php echo $option['product_option_id']; ?>-<?php echo $set['set_id']; ?>-<?php echo $i; ?>" class="option">
											  <?php if ($option['required']) { ?>
											  <span class="required">*</span>
											  <?php } ?>
											  <b><?php echo $option['name']; ?>:</b><br />
											  <?php if($option['selected']){?>
												<input type="text" name="option[<?php echo $product['product_id']; ?>][<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="datetime" disabled="disabled" />
											  <?php } else { ?>
												<input type="text" name="option[<?php echo $product['product_id']; ?>][<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="datetime" />
											  <?php } ?>
											</div>
											<br />
											<?php } ?>
											<?php if ($option['type'] == 'time') { ?>
											<div id="option-<?php echo $option['product_option_id']; ?>-<?php echo $set['set_id']; ?>-<?php echo $i; ?>" class="option">
											  <?php if ($option['required']) { ?>
											  <span class="required">*</span>
											  <?php } ?>
											  <b><?php echo $option['name']; ?>:</b><br />
											  <?php if($option['selected']){?>
												<input type="text" name="option[<?php echo $product['product_id']; ?>][<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="time" disabled = "disabled" />
											  <?php } else { ?>
												<input type="text" name="option[<?php echo $product['product_id']; ?>][<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="time" />
											  <?php } ?>
											</div>
											<br />
											<?php } ?>
										<?php } ?>
									  </div>
								<?php } ?>
								
								<? 
								if ((float)str_replace(',', '', $product['price']) != (float)str_replace(',', '', $product['price_in_set'])){
									echo '<div class="base-price"><span class="price-old">'.$product['price'].'</span></div>';
								} 
								?>
								<div class="set-price">
									<span class="price-set"><?php echo (float)$product['price_in_set'] != 0 ? $product['price_in_set'] : 'Бесплатно'; ?></span>
									<? if ($product['quantity'] > 1){ ?><span class="quantity-set">x <?php echo $product['quantity']; ?></span><? } ?>
								</div>
								
								<?php if(!$product['active']){?><span class="notavailable">Нет в наличии</span><?php } ?>
							</div>
						</div></div>
					<?php $i++; } ?>
					<div class="ravno">=</div>
					<div class="set-item">
						<div class="set-description">
							<div class="set-description-content">
								<div class="set-total">
									<span style="white-space:nowrap"><?php echo $set['price']; ?></span>
								</div>
							</div>
							<div class="button-block">
								<input type="hidden" name="set_id" value="<?php echo $set['set_id']; ?>" />
								<?php if($set['active']){?>
									<a class="button" onclick="AddToCartSet('<?php echo $set['set_id']; ?>');" href="javascript:void(0)">Купить комплект</a>
								<?php } else { ?>
									<div class="set-not-active"><?php echo $text_notactive; ?></div>
								<?php } ?>                                    
							</div>
						</div>
					</div>
				</div>
			</li>
			<?php } ?>
		  </ul>
		</div>



<?php if(count($sets)>1){?>
<script type="text/javascript">
	$('#carousel_sets ul').jcarousel({
		vertical: false,
		visible: 1,
		scroll: 1
	});
</script>
<?php } ?>
                
<script type="text/javascript">
$('.date').datepicker({dateFormat: 'yy-mm-dd'});
$('.datetime').datetimepicker({
	dateFormat: 'yy-mm-dd',
	timeFormat: 'h:m'
});
$('.time').timepicker({timeFormat: 'h:m'});
</script>                
                
                
    
    </div>


<?php } ?>                