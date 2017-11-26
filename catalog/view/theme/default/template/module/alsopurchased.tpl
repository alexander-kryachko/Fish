
<?php if (isset($products)) { ?>
<div class="cart-recommend">
<div class="rec-heading">Возможно, вам пригодится</div>
  <div class="rec-content">
    <div class="rec-products">
      <?php foreach ($products as $product) { ?>
      <table class="rec-product">
        <?php if ($product['thumb']) { ?>
        <td class="image"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></td>
        <?php } ?>
        <td class="name"><?php echo $product['name']; ?>
		<br>
			<?php if($product['attribute_groups']) { ?>
			<?php foreach($product['attribute_groups'] as $attribute_group) { 
					foreach($attribute_group['attribute'] as $attribute) { ?>
				<?php echo $attribute['name']; ?>:  
				<?php echo $attribute['text']; ?>,	
				<?php } ?>
			<?php } ?>
		<?php } ?>
		</td>
		<td class="add-button">
		<input type="button" value="Добавить" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button" />
		</td>
			<?php if ($product['price']) { ?>
			<td class="price">
			  <?php if (!$product['special']) { ?>
			  <?php echo $product['price']; ?>
			  <?php } else { ?>
			  <?php echo $product['special']; ?>
			  <?php } ?>
			</td>
			<?php } ?>
      </table>
      <?php } ?>
    </div>
  </div>
</div>
<?php } ?>