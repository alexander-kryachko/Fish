<?php
echo '<div class="top-seller bg-orange cnt-box w-slides">';
echo '<div class="cnt-box-h">';
echo '<div class="h">Хит продаж</div>';
echo '<div class="controls">';
echo '<a href="" class="prev"></a>';
echo '<a href="" class="next"></a>';
echo '</div>';
echo '</div>';
echo '<ul class="items-slider slider">';
		foreach ($products as $product) { 
        echo '<li>';
            echo '<div class="item-card item-card-slim">';
                echo '<figure>';
					    if ($product['thumb']) {
					        ?><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a><?php
						} else { 
							?><a href="<?php echo $product['href']; ?>"><img src="/image/no_image.jpg" width="240" height="240" alt="<?php echo $product['name']; ?>" /></a><?php 
						}  
                echo '</figure>';
                echo '<div class="item-h">';
                	?><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a><?
                echo '</div>';
                echo '<div class="item-card-footer">';
                	if (!$product['special']) {
                    ?>
                        <span class="price"><?php echo $product['price'];?></span><?

                    }
                    else{
                    ?><span class="price price-old"><?php echo $product['price'];?></span>
                    <span class="price"><?php echo $product['special'];?></span><?
                    }
                    //<span class="btn-place"><a href="" class="btn btn-red btn-small">КУПИТЬ</a></span>
                echo '</div>';
            echo '</div>';
        echo '</li>';
       }
echo '</ul>';
echo '</div>';
?>