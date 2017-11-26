<?php
//print_r($_SERVER);
if ($_SERVER['REQUEST_URI'] == '/index.php?route=checkout/cart') {
?>
<?php if (isset($products)) { ?>
<div class="cart-recommend">
  <div class="rec-heading">Рекомендуем добавить в заказ</div>
  <div class="rec-content">
    <div class="rec-products">
      <?php foreach ($products as $product) { ?>
      <div>
        <?php if ($product['thumb']) { ?>
        <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
        <?php } ?>
        <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
		<br>
			<?php if($product['attribute_groups']) { ?>
			<?php foreach($product['attribute_groups'] as $attribute_group) { 
					foreach($attribute_group['attribute'] as $attribute) { ?>
				<?php echo $attribute['name']; ?>:  
				<?php echo $attribute['text']; ?>,	
				<?php } ?>
			<?php } ?>
		<?php } ?>
		</div>
		<input type="button" value="Добавить" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button" />
			<?php if ($product['price']) { ?>
			<div class="price">
			  <?php if (!$product['special']) { ?>
			  <?php echo $product['price']; ?>
			  <?php } else { ?>
			  <?php echo $product['special']; ?>
			  <?php } ?>
			</div>
			<?php } ?>
      </div>
      <?php } ?>
    </div>
  </div>
</div>
<?php } } else { ?>
<?php if (isset($products)) { ?>
<div class="box">
  <div class="box-heading">Предложение дня</div>
  <div class="box-content">
    <div class="box-product">
      <?php foreach ($products as $product) { ?>
      <div>
        <?php if ($product['thumb']) { ?>
        <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
        <?php } ?>
        <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
        <?php if ($product['price']) { ?>
        <div class="price">
          <?php if (!$product['special']) { ?>
          <?php echo $product['price']; ?>
          <?php } else { ?>
          <?php echo $product['special']; ?>
          <?php } ?>
        </div>
        <?php } ?>
      </div>
      <?php } ?>
    </div>
  </div>
</div>

<?php } } ?>
