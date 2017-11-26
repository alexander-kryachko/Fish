<div class="cnt-boxes">
    <div class="cnt-box">
        <div class="cnt-box-h">
            <div class="h"><?php echo $heading_title; ?></div>
        </div>
        <div class="testimonial-slider-container">
            <ul class="testimonial-slider slider">
                <?php foreach ($ratings as $rating) { ?>
                <li>
                    <blockquote>
                        <?php echo $rating['comment'];?>
                        <footer>
                            <?php if(isset($show_rating)){ ?>
                            <div class="item-rate">
                                <div class="rate-stars"><?php echo $rating['shop_rating'];?></div>
                            </div>
                            <?}?>
                            <span class="quoted"><?php echo $rating['author'];?></span>
                        </footer>
                    </blockquote>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>


