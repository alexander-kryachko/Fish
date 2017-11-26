<!-- similar -->
<?php if($products) { ?>
	<div class="box">
	  <div class="box-heading"></div>
	  <div>
		<div class="product-list" style="width:100%;">
		  <?php foreach ($products as $product) { ?>
		  <div class="product-item" style="width:235px;height:40px;">
		  <div class="product-layout" style="border: 0px;">
			<?php if ($product['thumb']) { ?>
			<?php } ?>
			<div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
			<?php if ($product['price']) { ?>
		
			<?php } ?>
			<?php if ($product['rating']) { ?>
	
			<?php } ?>
			
		  </div>
		  </div>
		  <?php } ?>
		</div>
	  </div>
	</div>
<?php } ?>