<?php if (count($products) > 0) { ?>


<div class="cnt-box items-list">
    <div class="cnt-box-h">
        <div class="h">Недавно просмотренные</div>
    </div>
    <div class="items-list-content">
        <?php foreach ($products as $product) { ?>
        <div class="item-card">
            <figure>
            <?php if ($product['thumb']) { ?>
            <a onclick="ga('send', 'event', 'Watched', 'image', '<?php echo $product['name']; ?>')" href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a>
            <?php } ?>
            </figure>
            <div class="item-h"><a onclick="ga('send', 'event', 'Watched', 'name', '<?php echo $product['name']; ?>')" href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
            <div class="item-card-footer">

                <? if (!$product['special']){?>
                <span class="price">
                  <?php echo $product['price'];?>
                  </span>
                  <?} else {?>
                  <span class="price price-old">
                    <?php echo $product['price'];?>
                  </span>
                  <span class="price">
                    <?php echo $product['special'];?>
                  </span>
                <?};?>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<?php } ?>
