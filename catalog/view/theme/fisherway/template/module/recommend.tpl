<?php
//print_r($_SERVER);
if ($_SERVER['REQUEST_URI'] == '/index.php?route=checkout/cart' || substr($_SERVER['REQUEST_URI'], 0, 28) == '/index.php?route=module/cart') {
?>
<?php if (isset($products)) { ?>
<div class="cart-recommend">
  <div class="rec-heading">Рекомендуем добавить в заказ</div>
  <div class="rec-content">
    <div class="rec-products">
      <?php foreach ($products as $product) { ?>
      <table class="rec-product">
	    <tbody>
		<tr>
		<td class="image">
        <?php if ($product['thumb']) { ?>
        <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a>
		<?php } ?>
		</td>
        <td class="name"><span><b><?php echo $product['name']; ?></b></span>
		<span class="cart-attr"><?php if($product['attribute_groups']) { ?>
			<?php foreach($product['attribute_groups'][0]['attribute'] as $attribute) { ?>
				<?php echo $attribute['name']; ?>:  
				<?php echo $attribute['text']; ?>
				<span class="comma">,</span>&nbsp;	
				<?php } ?>
		<?php } ?></span>
		</td>
		 <td class="add-button">
			<input type="button" value="Добавить" onclick="addToCart('<?php echo $product['product_id']; ?>');ga('send', 'event', 'Related', 'Related-Cart', '<?php echo $product['name']; ?>');" class="button" rel="nofollow" />
		 </td>
		 <td class="price">
			<?php if ($product['price']) { ?>
			  <?php if (!$product['special']) { ?>
			  <?php echo $product['price']; ?>
			  <?php } else { ?>
			  <?php echo $product['special']; ?>
			  <?php } ?>
			<?php } ?>
		</td>
			</tr>
		</tbody>
      </table>
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
