<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content">
  <div class="top">
    <div class="left"></div>
    <div class="right"></div>
    <div class="center">
      <h1><?php echo $heading_title; ?></h1>
    </div>
  </div>
  <div class="middle">
    <div class="product-related-list">
        <?php for ($j = $i; $j < ($i + 4); $j++) { ?>
        <div class="item-card">
            <?php if (isset($products[$j])) { ?>
            <a href="<?php echo $products[$j]['href']; ?>"><img src="<?php echo $products[$j]['thumb']; ?>" title="<?php echo $products[$j]['name']; ?>" alt="<?php echo $products[$j]['name']; ?>" /></a><br />
            <a href="<?php echo $products[$j]['href']; ?>"><?php echo $products[$j]['name']; ?></a><br />
            <span style="color: #999; font-size: 11px;"><?php echo $products[$j]['description']; ?></span><br />
            <?php if ($display_price) { ?>
            <?php if (!$products[$j]['special']) { ?>
            <span style="color: #900; font-weight: bold;"><?php echo $products[$j]['price']; ?></span>
            <?php } else { ?>
            <span style="color: #900; font-weight: bold; text-decoration: line-through;"><?php echo $products[$j]['price']; ?></span> <span style="color: #F00;"><?php echo $products[$j]['special']; ?></span>
            <?php } ?>
            <a class="button_add_small" href="<?php echo $products[$j]['add']; ?>" title="<?php echo $button_add_to_cart; ?>" >&nbsp;</a>
  		  <?php } ?>
            <br />
            <?php if ($products[$j]['rating']) { ?>
            <img src="catalog/view/theme/default/image/stars_<?php echo $products[$j]['rating'] . '.png'; ?>" alt="<?php echo $products[$j]['stars']; ?>" />
            <?php } ?>
            <?php } ?>

          </div>
        <?php } ?>
    </div>
    <div class="pagination"><?php echo $pagination; ?></div>
  </div>
  <div class="bottom">
    <div class="left"></div>
    <div class="right"></div>
    <div class="center"></div>
  </div>
</div>
<?php echo $footer; ?> 