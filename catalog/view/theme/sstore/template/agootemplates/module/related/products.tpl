<?php if ($products) { ?>
<div class="box-main">

<div class="news-set center">
<h4 class="inner"><span><?php echo $text_related; ?></span></h4>
</div>

<div class="category-slide">

<div id="cat-latest" class="owl-carousel owl-theme" style="display: block; opacity: 1;">

<?php foreach ($products as $product) { ?>

<div class="item">

 <?php if ($product['thumb']) { ?>

<div class="image">
 <a href="<?php echo $product['href']; ?>">
 <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" />
 </a>
 </div>

 <?php } ?>


<div class="cart">
 <a onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button-cart" title="<?php echo $button_cart; ?>"></a>
 <a onclick="addToWishList('<?php echo $product['product_id']; ?>');" title="<?php echo $button_wishlist; ?>" class="wishlist"></a>
 <a onclick="addToCompare('<?php echo $product['product_id']; ?>');" title="<?php echo $button_compare; ?>" class="compare"></a>
</div>


<div class="clearfix"></div>


<div class="name">
 <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
 </div>

 <?php if ($product['price']) { ?>

<div class="price">
 <?php if (!$product['special']) { ?>
 <?php echo $product['price']; ?>
 <?php } else { ?>
 <span class="price-old"><?php echo $product['price']; ?></span> <?php echo $product['special']; ?>
 <?php } ?>
 </div>

 <?php } ?>
 <?php if ($product['rating']) { ?>

<div class="rating"><img src="catalog/view/theme/sstore/images/stars-<?php echo $product['rating']; ?>.png" /></div>

 <?php } ?>
 </div>


 <?php } ?>

 </div>

 </div>


<div class="clearfix"></div>

<script>
$('#cat-latest').hide();
$(window).load(function() {
	$('#cat-latest').show();
 	$('#cat-latest').owlCarousel({
		 autoplay:true,
		 autoplaySpeed:1500,
		 autoplayHoverPause:true,
		 nav:true,
		 dots:false,
		 navText:["<",">"],
		 responsiveClass:true,
		 responsive:{
		 0:{
		 items:1,
		 nav:true
		 },
		 600:{
		 items:2,
		 nav:false
		 },
		 1000:{
		 items:5,
		 nav:true,
		 loop:false
		 }
		 }

 	});
 });

</script>
</div>
<?php } ?>





