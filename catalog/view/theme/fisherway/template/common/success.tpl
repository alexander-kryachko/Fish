<?php 
echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <h1><?php echo $heading_title; ?></h1>
  

  
  <?php echo $text_message; ?>
  <div class="buttons">
    <div class="right"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
  </div>
  <?php echo $content_bottom; ?></div>
	<?php if (isset($ecommerce_tracking_status)) { ?>
					<?php if ($ecommerce_tracking_status && $order && $order_products) { ?>
						<?php echo $start_google_code; ?>

						<?php if ($ecommerce_global_object) { ?>
							<?php echo $ecommerce_global_object; ?>('require', 'ecommerce', 'ecommerce.js');

							<?php echo $ecommerce_global_object; ?>('ecommerce:addTransaction', {
								'id': "<?php echo $order['order_id']; ?>",
								'affiliation': "<?php echo $order['store_name']; ?>",
								'revenue': "<?php echo $order['order_total']; ?>",
								'shipping': "<?php echo $order['order_shipping']; ?>",
								'tax': "<?php echo $order['order_tax']; ?>",
								'currency': "<?php echo $order['currency_code']; ?>"
							});

							<?php foreach($order_products as $order_product) { ?>
							<?php echo $ecommerce_global_object; ?>('ecommerce:addItem', {
								'id': "<?php echo $order_product['order_id']; ?>",
								'name': "<?php echo $order_product['name']; ?>",
								'sku': "<?php echo $order_product['sku']; ?>",
								'category': "<?php echo $order_product['category']; ?>",
								'price': "<?php echo $order_product['price']; ?>",
								'quantity': "<?php echo $order_product['quantity']; ?>"
							});
							<?php } ?>

							<?php echo $ecommerce_global_object; ?>('ecommerce:send');
						<?php } else { ?>
							_gaq.push(['_set', 'currencyCode', '<?php echo $order['currency_code']; ?>']);

							_gaq.push(['_addTrans',
								"<?php echo $order['order_id']; ?>",
								"<?php echo $order['store_name']; ?>",
								"<?php echo $order['order_total']; ?>",
								"<?php echo $order['order_tax']; ?>",
								"<?php echo $order['order_shipping']; ?>",
								"<?php echo $order['payment_city']; ?>",
								"<?php echo $order['payment_zone']; ?>",
								"<?php echo $order['payment_country']; ?>"
							]);

							<?php foreach($order_products as $order_product) { ?>
							_gaq.push(['_addItem',
								"<?php echo $order_product['order_id']; ?>",
								"<?php echo $order_product['sku']; ?>",
								"<?php echo $order_product['name']; ?>",
								"<?php echo $order_product['category']; ?>",
								"<?php echo $order_product['price']; ?>",
								"<?php echo $order_product['quantity']; ?>"
							]);
							<?php } ?>

							_gaq.push(['_trackTrans']);
						<?php } ?>

						<?php echo $end_google_code; ?>
					<?php } else { ?>
						<?php echo $google_analytics; ?>
					<?php } ?>
				<?php } ?>
<!-- TMG START -->
<script type='text/javascript'>(function(t,r,f,m,g){m=t.createElement(r),g=t.getElementsByTagName(r)[0];m.async=1;m.src=(t.location.protocol=='https:'?'https:':'http:')+f;m.type='text/javascript';g.parentNode.insertBefore(m,g)})(document,'script','//t.trafmag.com/js/clear-fisherway.js');</script>
<!-- TMG END -->				
<?php echo $footer; ?>