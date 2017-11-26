<div class="panel-default box-product box-product-nocarousel">

<?php foreach ($products as $product) { ?>


<div class="col-xs-1 product-item product-item-nocarousel">


<div class="image">
<a href="<?php echo $product['href']; ?>">
<img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-responsive" />
</a>
<?php if ($product['special']) { ?>
<?php $new_price = preg_replace("/[^0-9]/", '', $product['special']); ?>
<?php $old_price = preg_replace("/[^0-9]/", '', $product['price']); ?>
<?php if ($old_price != 0) { ?>
<?php $total_discount = round(100 - ($new_price / $old_price) * 100); ?>
<span class="sticker st-sale">-<?php echo $total_discount; ?>%</span>
<?php } ?>
<?php } ?>
</div>



<div class="caption">


<div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>


<?php if ($product['price']) { ?>


<div class="price">
<?php if (!$product['special']) { ?>
<?php echo $product['price']; ?>
<?php } else { ?>
<span class="price-old"> <?php echo $product['price']; ?> </span> <span class="price-new"><?php echo $product['special']; ?></span>
<?php } ?>
<?php if ($product['tax']) { ?>
<br /><span class="price-tax"><?php echo $text_tax; ?> <?php echo $product['tax']; ?></span>
<?php } ?>
</div>


<?php } ?>
</div>



<div class="buttons">


<div class="btn-group dropup">
<?php if (($product['quantity'] <= 0) and $disable_cart_button){ ?>
<button type="button" class="btn btn-addtocart" title="<?php echo $button_cart; ?>" disabled><?php echo $disable_cart_button_text; ?> </button>
<?php } else { ?>
<button type="button" class="btn btn-addtocart" onclick="cart.add('<?php echo $product['product_id']; ?>');" title="<?php echo $button_cart; ?>"><i class="fa fa-shopping-basket fa-fw"></i>  <?php echo $button_cart; ?> </button>
<?php } ?>
<?php if ($on_off_qview){ ?>
<button class="btn btn-addtocart btn-qview" data-qview="<?php echo $product['qview']; ?>" data-toggle="tooltip" title="<?php echo $qview_text; ?>">
<i class="fa fa-eye fa-fw"></i>
</button>
<?php } ?>
<button type="button" class="btn btn-addtocart dropdown-toggle" data-toggle="dropdown">
<i class="fa fa-angle-down caretalt"></i>
</button>
<ul class="dropdown-menu addtocart-additional">
<li><a href="#" onclick="wishlist.add('<?php echo $product['product_id']; ?>');return false;" title="<?php echo $button_wishlist; ?>"><i class="fa fa-heart fa-fw"></i>  <?php echo $button_wishlist; ?></a></li>
<li><a href="#" onclick="compare.add('<?php echo $product['product_id']; ?>');return false;" title="<?php echo $button_compare; ?>"><i class="fa fa-balance-scale fa-fw"></i>  <?php echo $button_compare; ?></a></li>
</ul>
</div>


</div>


</div>


<?php } ?>

</div>


