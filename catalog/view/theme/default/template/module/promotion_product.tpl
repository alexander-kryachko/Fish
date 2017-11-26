<?php if((strtotime($promotion['date_end']) > time() || $promotion['date_end'] == '0000-00-00')
  && (strtotime($promotion['date_start']) < time() || $promotion['date_start'] == '0000-00-00')) { ?>
  
  <div class="product-promotion">

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

    <h3 class="promotion-name">
      <?php echo $promotion['name']; ?>
    </h3>

    <?php if((strtotime($promotion['date_end']) > time() && $promotion['date_end'] != '0000-00-00')) { ?>
      <div class="promotion-timer">
        <div class="timer-title">
          <?php echo $promotion_valid; ?>
        </div>
        <div class="timer-counter">
          <div id="counter"></div>
        </div>
      </div>

      <link rel="stylesheet" type="text/css" href="catalog/view/javascript/jquery/timeTo/timeTo.css" />
      <script type="text/javascript" src="catalog/view/javascript/jquery/timeTo/jquery.timeTo.js"></script>

      <script>
      $(document).ready(function(){
        $('#counter').timeTo({
          timeTo: new Date('<?php echo $promotion['date_end']; ?>'),
          displayCaptions: true,
          lang: '<?php echo isset($promotion_counter_language) ? $promotion_counter_language : 'en'; ?>'
        });  
      });
      </script>  
    <?php } ?>

    <div class="promotion-details">
      <div class="details-title">
        <a class="pcolorbox" href="#promotion-popup<?php echo $promotion['promotion_id']; ?>"><?php echo $promotion_about; ?>&nbsp;▼</a>
      </div>
      <?php echo $promotion['popup']; ?>    
    </div>

  </div>
<?php } ?>