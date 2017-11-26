<?php foreach ($products as $product) { ?>
<div class="product-layout product-grid">
<div class="product-thumb">
<div class="image">
 <?php if ($product['stickers']) { ?>
<div class="stickers">
 <?php foreach ($product['stickers'] as $sticker) { ?>
<div class="sticker text-left sticker-<?php echo $sticker['type']; ?>">
 <span class="fa-stack fa-<?php echo $moneymaker2_stickers_size_catalog; ?>" <?php if (!$moneymaker2_stickers_mode) { ?>data-toggle="tooltip" data-placement="right" title="<?php echo strip_tags($sticker['caption']); ?>"<?php } ?>>
 <i class="fa fa-circle fa-stack-2x"></i>
 <i class="fa fa-<?php echo $sticker['icon']; ?> fa-stack-1x fa-inverse"></i>
 </span><?php if ($moneymaker2_stickers_mode) { ?>

<div><?php echo $sticker['caption']; ?></div>

<?php } ?>
 </div>

 <?php } ?>
 </div>

 <?php } ?>
 <?php if ($product['rating']) { ?>

<div class="rating">
 <?php for ($i = 5; $i >= 1; $i--) { ?>
 <?php if ($product['rating'] < $i) { ?>
 <i class="fa fa-star"></i>
 <?php } else { ?>
 <i class="fa fa-star active"></i>
 <?php } ?>
 <?php } ?>
 </div>

 <?php } ?>
 <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" /></a>
 </div>

<div>

<div class="caption">
 <a href="<?php echo $product['href']; ?>"<?php if ($product['special']) { ?> class="text-special"<?php } ?>><?php echo $product['name']; ?></a>
 </div>

 <?php if ($moneymaker2_common_price_detached) { ?>
<div class="price-detached"><small><?php if ($product['price']) { ?><span class="price text-muted"><?php if (!$product['special']) { ?><?php echo $product['price']; ?><?php } else { ?><span class="price-new"><b><?php echo $product['special']; ?></b></span> <span class="price-old"><?php echo $product['price']; ?></span><?php } ?></span><?php } ?><?php if ($product['tax']) { ?><br /><span class="price-tax text-muted"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span><?php } ?></small></div>
 <?php } ?>

<div class="btn-group btn-group-sm">
 <?php if (!$moneymaker2_common_buy_hide) { ?>
 <button type="button" <?php if ($moneymaker2_common_cart_outofstock_disabled&&$product['quantity']<=0) { ?>disabled="disabled"<?php } ?> <?php if (!$moneymaker2_common_price_detached) { ?>data-toggle="tooltip" data-html="true" data-placement="bottom" title="<?php echo $button_cart; ?><?php if ($product['price']&&$product['special']) { ?><br /><?php echo $moneymaker2_text_old_price; ?>: <?php echo $product['price']; ?><?php } ?>"<?php } ?> class="btn <?php if (!$product['special']) { ?>btn-primary<?php } else { ?>btn-danger<?php } ?>" onclick="cart.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-fw fa-shopping-cart"></i> <?php if (!$moneymaker2_common_price_detached) { ?><?php if ($product['price']) { ?><span class="price"><?php if (!$product['special']) { ?><?php echo $product['price']; ?><?php } else { ?><span class="price-new"><?php echo $product['special']; ?></span><?php } ?></span><?php } ?><?php } else { ?><?php echo $button_cart; ?><?php } ?></button>
 <?php } ?>
 <?php if ($moneymaker2_modules_quickorder_enabled&&$moneymaker2_modules_quickorder_display_catalog) { ?>
 <button type="button" <?php if ($moneymaker2_common_cart_outofstock_disabled&&$product['quantity']<=0) { ?>disabled="disabled"<?php } ?> class="btn btn-default" data-toggle="modal" data-target="#orderModal" data-order-mode="catalog" data-order-product-id="<?php echo $product['product_id']; ?>" data-order-title="<?php echo $product['name']; ?>" data-order-img-src="<?php echo $product['thumb']; ?>" data-order-price="<?php if (!$product['special']) { ?><?php echo $product['price']; ?><?php } else { ?><?php echo $product['special']; ?><?php } ?>"><span data-toggle="tooltip" data-placement="bottom" title="<?php echo $moneymaker2_modules_quickorder_button_title; ?>"><i class="fa fa-fw fa-send"></i></span></button>
 <?php } ?>
 <?php if (!$moneymaker2_common_wishlist_hide) { ?><button type="button" class="btn btn-default" <?php if (!$moneymaker2_common_wishlist_caption) { ?>data-toggle="tooltip" data-placement="bottom" <?php } ?>title="<?php echo $button_wishlist; ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-fw fa-heart"></i><?php if ($moneymaker2_common_wishlist_caption) { ?> <?php echo $button_wishlist; ?><?php } ?></button><?php } ?>
 <?php if (!$moneymaker2_common_compare_hide) { ?><button type="button" class="btn btn-default" <?php if (!$moneymaker2_common_compare_caption) { ?>data-toggle="tooltip" data-placement="bottom" <?php } ?>title="<?php echo $button_compare; ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-fw fa-area-chart"></i><?php if ($moneymaker2_common_compare_caption) { ?> <?php echo $button_compare; ?><?php } ?></button><?php } ?>
 </div>

 <?php if (!$moneymaker2_common_price_detached&&$product['price']&&$product['tax']) { ?>

<div class="price-tax"><small class="text-muted"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></small></div>

<?php } ?>

<div class="additional"></div>

 </div>

 </div>

 </div>

 <?php } ?>