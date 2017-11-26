<?php if ($products){ ?>
<div class="box">
    <div class="box-heading"><?php echo $heading_title; ?></div>
    <div class="box-content">
        <div id="carousel-youwatched-<?php echo $module; ?>" class="jcarousel jcarousel_horizontal s_mb_30">
            <ul class="jcarousel-skin-opencart clearfix">
                <?php foreach ($products as $product) { ?>
                <li class="box-product" rel="tooltip">
                    <?php if ($product['thumb']) { ?>
                    <div class="image"><a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
                    <?php } ?>
                    <div class="name"><a class="trigger" href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <?php if ($products){ ?>
    <script type="text/javascript"><!--
    $(function(){
        $("ul", "#carousel-youwatched-<?php echo $module; ?>").jcarousel({
            <?php if (count($products) >= $setting['slider']['visible']){ ?>wrap: "circular",<?php } ?>
            vertical: <?php echo $setting['slider']['vertical']; ?>,
            auto: <?php echo $setting['slider']['delay']; ?>,
            visible: <?php echo (count($products) <= $setting['slider']['visible']) ? count($products) : $setting['slider']['visible']; ?>,
            scroll: <?php echo $setting['slider']['scroll']; ?>
        });
    });
    //--></script>
    <?php } ?>
</div>
<?php } ?>