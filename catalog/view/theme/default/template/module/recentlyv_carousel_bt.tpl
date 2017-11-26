<?php if ($show_in_box) { ?>
    <div class="box">
        <div class="box-heading"><?php echo $tabname_lang; ?></div>
        <div class="box-content ">
        <?php } ?>
        <div class="box-product bt_carousel-box-<?php echo $module_id; ?>" style="position: relative;">
            <?php if (isset($carouselSetting['nav']) && $carouselSetting['nav'] == 'on') { ?>
                <a class="bt_carousel_arrow_prev-<?php echo $module_id; ?>" id="bt_carousel-<?php echo $module_id; ?>_prev" style="display: block;"></a>
                <a class="bt_carousel_arrow_next-<?php echo $module_id; ?>" id="bt_carousel-<?php echo $module_id; ?>_next" style="display: block;"></a>
            <?php } ?>



            <ul id="bt_carousel-<?php echo $module_id; ?>" class="bt_carousel-<?php echo $module_id; ?>">
                <?php foreach ($products as $product) { ?>
                    <li>
                        <div>
                            <?php if ($product['thumb']) { ?>
                                <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
                            <?php } ?>
                            <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
                            <?php if ($product['price']) { ?>
                                <div class="price">
                                    <?php if (!$product['special']) { ?>
                                        <?php echo $product['price']; ?>
                                    <?php } else { ?>
                                        <span class="price-old"><?php echo $product['price']; ?></span> <span class="price-new"><?php echo $product['special']; ?></span>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <?php if ($product['rating']) { ?>
                                <div class="rating"><img src="catalog/view/theme/<?php echo $template; ?>/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
                            <?php } ?>
                            <div class="cart"><input type="button" value="<?php echo $cart_btn_lang; ?>" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button" /></div>
                        </div>
                    </li>

                <?php } ?>
            </ul>
            <?php if (isset($carouselSetting['pagination']) && $carouselSetting['pagination'] == 'on') { ?>    
                <div id="bt_carousel_pagination-<?php echo $module_id; ?>" class="bt-carousel-pager-<?php echo $module_id; ?>">
                </div>
            <?php } ?>
        </div>
        <?php if ($show_in_box) { ?>
        </div>
    </div>
<?php } ?>
<style type="text/css">
<?php
if (isset($carouselSetting['css']) && $carouselSetting['css'] != '') {
    $tempText = str_replace('{module_id}', $module_id,  $carouselSetting['css']);
    $tempText = str_replace('{your_template_var}', $template, $tempText);
    $tempText = htmlspecialchars_decode($tempText);
    echo $tempText;
}
?>
</style>

<script type="text/javascript" language="javascript" src="catalog/view/javascript/carousel/jquery.carouFredSel-6.2.1-packed.js"></script>
<script type="text/javascript" language="javascript" src="catalog/view/javascript/carousel/jquery.mousewheel.min.js"></script>
<script type="text/javascript" language="javascript" src="catalog/view/javascript/carousel/jquery.touchSwipe.min.js"></script>
<script type="text/javascript" language="javascript" src="catalog/view/javascript/carousel/jquery.transit.min.js"></script>
<script type="text/javascript" language="javascript" src="catalog/view/javascript/carousel/jquery.ba-throttle-debounce.min.js"></script>

<script type="text/javascript" language="javascript">
            $(function() {
    $('#bt_carousel-<?php echo $module_id; ?>').carouFredSel({
    width: <?php echo (isset($carouselSetting['width']) && $carouselSetting['width'] != '' ) ? ((strpos($carouselSetting['width'],'%') !== false) ? '"'.$carouselSetting['width'].'"' : $carouselSetting['width'] ) : 'null'; ?>,
            height: <?php echo (isset($carouselSetting['height']) && $carouselSetting['height'] != '' ) ? ((strpos($carouselSetting['height'],'%') !== false) ? '"'.$carouselSetting['height'].'"' : $carouselSetting['height'] ) : 'null'; ?>,
<?php if (isset($carouselSetting['pagination']) && $carouselSetting['pagination'] == 'on') { ?>
        pagination: {
        container: "#bt_carousel_pagination-<?php echo $module_id; ?>",
                anchorBuilder: function(nr, item) {
        return '<div class="bt-carousel-pager-item-<?php echo $module_id; ?>"><a class="bt-carousel-pager-link-<?php echo $module_id; ?>" href="#' + nr + '">' + nr + '</a></div>';
        }
        },
<?php } ?>
<?php if (isset($carouselSetting['nav']) && $carouselSetting['nav'] == 'on') { ?>
        prev: '#bt_carousel-<?php echo $module_id; ?>_prev',
                next: '#bt_carousel-<?php echo $module_id; ?>_next',
<?php } ?>
    auto: {
    play: <?php echo (isset($carouselSetting['autoplay']) && $carouselSetting['autoplay'] == 'on' ) ? 'true' : 'false'; ?>,
            timeoutDuration: <?php echo (isset($carouselSetting['timeout_duration']) && $carouselSetting['timeout_duration'] != '' ) ? $carouselSetting['timeout_duration'] : '2500'; ?>
    },
            direction: '<?php echo (isset($carouselSetting['direction']) && $carouselSetting['direction'] != '' ) ? $carouselSetting['direction'] : 'left'; ?>',
            items: <?php echo (isset($carouselSetting['scroll_limit']) && $carouselSetting['scroll_limit'] != '' ) ? $carouselSetting['scroll_limit'] : '6'; ?>,
            circular: <?php echo (isset($carouselSetting['circular']) && $carouselSetting['circular'] == 'on' ) ? 'true' : 'false'; ?>,
            infinite: <?php echo (isset($carouselSetting['infinite']) && $carouselSetting['infinite'] == 'on' ) ? 'true' : 'false'; ?>,
            responsive: <?php echo (isset($carouselSetting['responsive']) && $carouselSetting['responsive'] == 'on' ) ? 'true' : 'false'; ?>,
            align: "<?php echo (isset($carouselSetting['align']) && $carouselSetting['align'] != '' ) ? $carouselSetting['align'] : 'center'; ?>",
<?php
if (isset($carouselSetting['swipe_nav']) && $carouselSetting['swipe_nav'] == 'on') {
    echo 'swipe: {
                onMouse: true,
                onTouch: true,
                duration: 800
            },';
}
?>
    scroll: {
    items: <?php echo (isset($carouselSetting['scroll_products']) && $carouselSetting['scroll_products'] != '' ) ? $carouselSetting['scroll_products'] : '6'; ?>,
            fx: "<?php echo (isset($carouselSetting['scroll_effect']) && $carouselSetting['scroll_effect'] != '' ) ? $carouselSetting['scroll_effect'] : 'scroll'; ?>",
            easing: "<?php echo (isset($carouselSetting['scroll_easing']) && $carouselSetting['scroll_easing'] != '' ) ? $carouselSetting['scroll_easing'] : 'swing'; ?>",
            duration: <?php echo (isset($carouselSetting['scroll_duration']) && $carouselSetting['scroll_duration'] != '' ) ? $carouselSetting['scroll_duration'] : '500'; ?>,
            pauseOnHover: <?php echo (isset($carouselSetting['hover']) && $carouselSetting['hover'] == 'on' ) ? 'true' : 'false'; ?>,
    }
    });
    });
</script>
