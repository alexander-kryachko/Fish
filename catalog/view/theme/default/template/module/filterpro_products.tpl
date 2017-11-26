	<?php 
	$i = 0; 
	$commentsShown = false;
	$nProducts = count($products);
	foreach ($products as $product) {

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
				if ($product['quantity'] > 0){
					$priceStr = $product['special'];
					//if (!empty($price)) $priceStr .= '<p class="old-price">&nbsp;&nbsp;'. $price .'&nbsp;&nbsp;</p>';
					//&& !empty($special) $priceStr .= '<p class="new-price">'.(!empty($is_master) ? 'от ' : ''). $special .'</p>';
				}
			} 
		}
		?>		
		
        <div class="product-item <?=empty($priceStr) ? '' : ' priceOK'?>">
            <div class="product-layout">
                <?php if ($product['thumb']) { ?>
                <div class="image">
<?php echo $product['soldlabel']; ?>
<?php echo $product['newlabel']; ?>
<?php echo $product['popularlabel']; ?>
<?php echo $product['speciallabel']; ?>
<script type="text/javascript">
//product impressions
$(document).ready(function(){
ga('send', 'event', {'eventCategory': 'Category_Product', 'eventAction': 'Impression', 'eventLabel': '<?php echo $product['product_id']; ?>','metric1':'1',  'dimension2': '<?php echo $product['product_id']; ?>'}, {'nonInteraction': 1});
//ga('send', 'event', {'metric1':'1',  'dimension2': '<?php echo $product['product_id']; ?>'}); 
});
</script>			
                    <a  onclick="ga('send', 'event', {'eventCategory': 'Category_Product', 'eventAction': 'Click', 'eventLabel': '<?php echo $product['product_id']; ?>','metric2':'1',  'dimension2': '<?php echo $product['product_id']; ?>'})" href="<?php echo $product['href']; ?>#photo">
                        <?php /*foreach ($results as $result) { ?>
                        <?php if ($result['product_id'] == $product['product_id']) { ?>
       <!--                 <span class="latest-item"></span> -->
                        <?php } ?>
                        <?php }*/ ?>
                        <img src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" />
                    </a>
                </div>
                <?php } ?>
                <div class="name"><a onclick="ga('send', 'event', {'eventCategory': 'Category_Product', 'eventAction': 'Click', 'eventLabel': '<?php echo $product['product_id']; ?>','metric2':'1',  'dimension2': '<?php echo $product['product_id']; ?>'}" href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>

				<? if (!empty($filter_ocfilter)){
					echo '<div class="productDescription">'.utf8::excerpt($product['description'], 200, '&hellip;').'</div>';
				}
				?>

                <?php if ($product['rating']) { ?>
                    <div class="rating" >
                       
                        <img src="catalog/view/theme/fisherway/image/stars-<?php echo round($product['rating']); ?>.png" title="<?php echo round($product['rating'],1); ?> (<?php echo $product['reviews']; ?>)"  alt="<?php echo $product['reviews']; ?>" />
                        <div class="rating-reviews">Отзывов ( <a href="<?php echo $product['href']; ?>#review-title"><?php echo $product['reviews']; ?></a> )</div>
						</div>
                <?php } ?>
                <!--BOF Product Series-->

                <!--EOF Product Series-->
                <div class="description">
					<?php 
					/*if($product['attribute_groups']) { $u = 0; ?>
					<?php foreach($product['attribute_groups'][0]['attribute'] as $attribute) { ?>
					<?php if($u < 3) { ?>
					<div class="product-attr">
						<span class="attr-name"><?php echo $attribute['name']; ?></span>
						<span class="attr-value"><?php echo $attribute['text']; ?></span>
						<div style="clear:both;"></div>
					</div>
					<?php } ?>
					<?php $u++; ?>
					<?php } ?>
					<?php }*/
					?>
				</div>
			</div>

			<? 
			$priceStr = trim($priceStr);
			if (strlen($priceStr)){
				?>
				<div class="cart c_">
					<?php if(!empty($product['pds'])){?>
						<a class="btn" href="<?php echo $product['href']; ?>">Купить</a> 
					<?php } else { ?>
						<a class="btn" rel="nofollow" onclick="addToCart('<?php echo $product['product_id']; ?>');" href="javascript:void(0)">Купить</a>
					<?php } ?>
				</div>
				<?php if ($product['price']) { ?>
				<div class="price_">
					<div>
					<?php echo $priceStr; ?>
					</div>
				</div>
				<?php } ?>
			<?php } else {
				//echo $no_stock;
			}?>

			<div style="clear:both;"></div>
			<div class="cart" style="display: none;">
				<?php if($product['is_set']){?>
					<a class="button" href="<?php echo $product['href']; ?>"><?php echo $button_cart; ?></a>
				<?php } else { ?>
					<input type="button" value="<?php echo $button_cart; ?>" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button" />
				<?php } ?>
			</div>
		</div>
		<?php 
		$i++;
		//if ($i%3 == 0) echo "<p></p>";

		if (!empty($reviews) && !empty($filter_ocfilter) && !$commentsShown && ($i == 12 || $i == $nProducts) && (!isset($_GET['page']) || $_GET['page'] == 1)){
		// $_SERVER['REMOTE_ADDR'] == '37.57.71.114'
			echo '<div class="aggregatedComments"><div class="aggregatedCommentsInner">';
			echo '<h2>'.$seo_h1.'&nbsp;&mdash; лучшие отзывы покупателей</h2>';
			
			foreach($reviews as $r){
				echo '<div class="comment">';
				echo '<a class="title" href="'.$r['href'].'">'.$r['product'].'</a>';
				
				echo '<div class="metadata">';
				echo '<span class="stars">';
				for($j=0;$j<$r['rating'];$j++)echo '<label class="full-label"></label>';
				echo '</span>';
				echo '<span class="stamp">'.date('d.m.Y H:i', strtotime($r['date_added'])).'</span>';
				echo '</div>';
				echo '<p>'.$r['text'].'</p>';
				echo '</div>';
			}
			
			echo '</div></div>';
			$commentsShown = true;
		}
	} 
?>