        <div class="tab">
            <div class="cnt-box-h show-on-mobile">
                <div class="h">
                    Новинки
                </div>
                <div class="controls">
                    <a href="" class="prev"></a>
                    <a href="" class="next"></a>
                </div>
            </div>
            <ul class="items-carusel slider">
            	<?php foreach ($products as $product) { ?>
                <li>
                    <div class="item-card">
                        <figure>
                            
                            <?php if($product['thumb']) { 
                        		?><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a><?php
                        	} else { 
                        		?><a href="<?php echo $product['href']; ?>"><img src="/image/no_image.jpg" width="240" height="240" alt="<?php echo $product['name']; ?>" /></a><?php } ?>

                        	<? if ($product['special']){ ?>
                            <span class="sticker sticker-red">SALE %</span>
                            <? } ?>
                        </figure>
                        <?/*
                        <div class="item-rate">
                            <div class="rate-stars">4.5</div>
                            <div class="rate-qty">Отзывы: 12</div>
                        </div>
                        */?>
                        <div class="item-h">
                        	<a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                        </div>

                        <div class="item-card-footer">
                        	<? if (!$product['special']){?>
                        	<span class="price">
                        		<?php echo $product['price'];?>
                        		</span>
                        		<?} else {?>
                        		<span class="price price-old">
                        			<?php echo $product['price'];?>
                        		</span>
                        		<span class="price">
                        			<?php echo $product['special'];?>
                        		</span>
                        	<?};?>

                            <div class="cart btn-place"><input type="button" value="<?php echo $button_cart; ?>" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="btn btn-red btn-small" /></div>

                        </div>
                    </div>
                </li>
                <?}?>
            </ul>
        </div>
    </div>
</div>