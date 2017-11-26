        <?php $i = 0; foreach ($products as $product) { ?>
		
		<?
		//echo '<!--';
		//print_r($product);
		//echo '-->';
		$priceStr = '';
		if ($product['price']) {
			if (!$product['special']) {
				if (!empty($product['pds'])) {
					//$priceStr .= 'от ';
					$min = 999999; 
					foreach ($product['pds'] as $p) {
						//$p_all = $this->model_catalog_product->getProduct($p['all']['product_id']);
						if (!$p['all']['quantity']) continue;
						if (!$p['all']['special']) {
							$min = $p['all']['price'] < $min ? $p['all']['price']  : $min;
						} else {
							$min = $p['all']['special'] < $min ? $p['all']['special']  : $min; 
					  }
					}
					if ($min != 999999) $priceStr = number_format((float)$min, 2, '.', '').' <span>грн.</span>';
				} else {
					if ($product['quantity'] > 0) $priceStr = $product['price']; 
					
				}
			} else { 
				$priceStr = $product['special'];
				$priceStr .= '';
				$priceStr .= '';
				?>
				<?php 
			} 
		}
		?>		
		
        <div class="product-item">
            <div class="product-layout">
                <?php if ($product['thumb']) { ?>
                <div class="image">		
<?php echo $product['soldlabel']; ?>
<?php echo $product['newlabel']; ?>
<?php echo $product['popularlabel']; ?>
<?php echo $product['speciallabel']; ?>
                    <a rel="nofollow" href="<?php echo $product['href']; ?>#photo">
                        <?php /*foreach ($results as $result) { ?>
                        <?php if ($result['product_id'] == $product['product_id']) { ?>
       <!--                 <span class="latest-item"></span> -->
                        <?php } ?>
                        <?php }*/ ?>
                        <img src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" />
                    </a>
                </div>
                <?php } ?>
                <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
</div>

<? 
$priceStr = trim($priceStr);
if (strlen($priceStr)){
	if ($priceStr != $product['price']){
		?><div style="display: block;" class="special-oldprice" ><?php echo $product['price']; ?></div><?php 
	}
	if ($product['price']) { ?>
	<div class="price_">
		<div>
		<?php echo $priceStr; ?>
		</div>
	</div>
	<?php } ?>

<?php if ($product['special_percent']) { ?>
		<div class="special-percent" style="display: none"><?php echo $product['special_percent']; ?>%</div>
<?php } ?>

<?php } else {
	//echo $no_stock;
}?>

<div style="clear:both;"></div>
</div>
<?php $i++;/* if ($i%3 == 0) echo "<p></p>";*/} ?>