

<div class="banner-aside-benefits hide-on-devices">
    <ul>
        <li>
            <div class="icon-place"><i class="icn icn-x2 icn-bnf-1"></i></div>
            <span>Более  40 000 товаров в наличии</span>
        </li>
        <li>
            <div class="icon-place"><i class="icn icn-x2 icn-bnf-2"></i></div>
            <span>Актуальные цены и наличие</span>
        </li>
        <li>
            <div class="icon-place"><i class="icn icn-x2 icn-bnf-3"></i></div>
            <span>Бесплатная доставка по Украине от 1000грн</span>
        </li>
        <li>
            <div class="icon-place"><i class="icn icn-x2 icn-bnf-4"></i></div>
            <span>Накопительная скидочная карта каждому клиенту</span>
        </li>
    </ul>
</div>


<div class="index-banner-itself">
    <ul class="slideshow slider" id="banner<?php echo $module; ?>" >
        <?php foreach ($banners as $banner) { ?>
        <?php if ($banner['link']) { ?>
        <li><a href="<?php echo $banner['link']; ?>" style="background-image: url(<?php echo $banner['image']; ?>);"  title="<?php echo $banner['title']; ?>" ></a></li>
        <?php } else { ?>
        <li style="background-image: url(<?php echo $banner['image']; ?>);"></li>
        <?php } ?>
        <?php } ?>
    </ul>
</div>