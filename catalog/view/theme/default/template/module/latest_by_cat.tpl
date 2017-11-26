<div class="box">
  <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="box-content-product-list">
      <?php foreach ($products as $product) { ?>
	  <div class="box-content-product-item">
      <div class="box-content-product-layout">
        <?php if ($product['thumb']) { ?>
        <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
        <?php } ?>
        <div class="box-name"><a style="color: #515151;text-decoration: none;font-size:17px;" href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
        <?php if ($product['price']) { ?>
        <div class="price-box">
		<div>
          <?php if (!$product['special']) { ?>
          <?php echo $product['price']; ?>
          <?php } else { ?>
          <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
          <?php } ?>
        </div>
		</div>
        <?php } ?>
        <?php if ($product['rating']) { ?>
        <div class="box-rating"><img src="catalog/view/theme/fisherway/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
        <?php } ?>
      </div>
	  </div>
      <?php } ?>
   
  </div>
</div>