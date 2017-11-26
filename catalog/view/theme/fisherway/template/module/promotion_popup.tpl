<?/*<div style='display:none'>*/?>
  <div id="promotion-popup<?php echo $promotion['promotion_id']; ?>" class="promotion-popup">

    <h4 class="popup-name">
      <?php echo $promotion['name']; ?>
    </h4>

    <?php if(isset($promotion['thumb_popup']) && $promotion['thumb_popup']) { ?>
      <div class="popup-image">
        <?php if(isset($promotion['gift']['href']) && $promotion['gift']['href']) { ?>
          <a href = "<?php echo $promotion['gift']['href']; ?>" title="<?php echo $promotion['gift']['name']; ?>">
            <img src="<?php echo $promotion['thumb_popup']; ?>" />
          </a>
        <?php } else { ?>
          <img src="<?php echo $promotion['thumb_popup']; ?>" />
        <?php } ?>
      </div>
    <?php } ?>

    <div class="popup-description">
      <?php echo $promotion['description']; ?>
    </div>

    <?php if ($promotion['products']) { ?>
      <div class="products-wrapper">
        
        <div class="products-title"><?php //echo $promotion_products; ?></div>

        <div class="promotion-products">
        <?php /* foreach($promotion['products'] as $promotion_product) {?>
          <div class="promotion-product">
            <div class="product-image">
              <img src="<?php echo $promotion_product['thumb']; ?>" />
            </div>
            <div class="product-description">
              <div class="product-name">
                <a href="<?php echo $promotion_product['href']; ?>" title="<?php echo $promotion_product['name']; ?>">
                  <?php echo $promotion_product['name']; ?>
                </a>
              </div>    
              <div class="promotion-product-price">
              <?php if ($promotion_product['price']) { ?>
                <div class="product-price">
                  <?php if (!$promotion_product['special']) { ?>
                  <?php echo $promotion_product['price']; ?>
                  <?php } else { ?>
                  <span class="product-price-old"><?php echo $promotion_product['price']; ?></span> <span class="product-price-new"><?php echo $promotion_product['special']; ?></span>
                  <?php } ?>
                </div>
              <?php } ?>
              </div>                          
            </div>
          </div>

        <?php } */ ?>
        </div>
      </div>
    <?php } ?>
  </div>
<?/*</div>*/?>