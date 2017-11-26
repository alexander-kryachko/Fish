<?php if((strtotime($promotion['date_end']) > time() || $promotion['date_end'] == '0000-00-00')
  && (strtotime($promotion['date_start']) < time() || $promotion['date_start'] == '0000-00-00')) { ?>
  
  <div class="category-promotion">

    <?php if(isset($promotion['thumb']) && $promotion['thumb']) { ?>
    <div class="promotion-image">
      <?php if(isset($promotion['gift']['href']) && $promotion['gift']['href']) { ?>
        <a href = "<?php echo $promotion['gift']['href']; ?>" title="<?php echo $promotion['gift']['name']; ?>">
          <img src="<?php echo $promotion['thumb']; ?>" />
        </a>
      <?php } else { ?>
        <img src="<?php echo $promotion['thumb']; ?>" />
      <?php } ?>
    </div>
    <?php } ?>

    <div class="promotion-details">
      <div class="details-title">
        <a class="pcolorbox" href="#promotion-popup<?php echo $promotion['promotion_id']; ?>"><?php echo $promotion['name']; ?></a>
      </div>
      <?php echo $promotion['popup']; ?>    
    </div> 

  </div>

<?php } ?>