<?php 
if ($products) { 
	echo '<div class="box slider-box">';
	echo '<div class="slider-heading">Предложение дня</div>';
	echo '<div class="slider-content">';
	echo '<div class="box-product product-slider">';
	echo '<div class="slides_container" id="slides_container">';
	foreach ($products as $product) { 
		echo '<div class="e-slide">';
        if ($product['thumb']) { 
			?><div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div><?php
		} else { 
			?><div class="image"><a href="<?php echo $product['href']; ?>"><img src="/image/no_image.jpg" width="240" height="240" alt="<?php echo $product['name']; ?>" /></a></div><?php 
		}  
		?><div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div><?php 
		if ($product['price']) { 
			echo '<div class="price">';
			echo '<span class="pr-left"></span>';
			echo '<span class="pr-center">';
			if (!$product['special']) { 
				echo $product['price'];
			} else {
			  echo $product['special'];
			} 
			echo '</span><span class="pr-right"></span><div style="clear:both;"></div></div>';
        } 
		echo '</div>';
    }
	echo '</div></div></div></div>';
 } 
 ?>

