<div id="cart" xmlns="http://www.w3.org/1999/html">
<div class="heading"><a title="<?php echo $heading_title; ?>"><span id="cart-total"><?php echo $text_items; ?><?php echo $total_price; ?></span></a></div>
<div id="cartOverlay" class="overlay"></div>
<div class="content">
    <?php if ($error_warning) { ?>
    <div class="warning"><?php echo $error_warning; ?><img src="/catalog/view/theme/default/image/close.png" alt="" class="close" /></div>
    <?php } ?>
    Корзина
    <?php if ($products || $vouchers) { ?>
    <div class="mini-cart-info">
        <table>
            <?php foreach ($products as $product) { ?>
            <tr>
                <td class="image">
                    <?php if ($product['thumb']) { ?>
                    <a href="<?php echo $product['href']; ?>">
                        <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" />
                    </a>
                    <?php } ?>
                </td>

                <td class="name">
                    <span><b><?php echo $product['name']; ?></b></span><?
						if (empty($product['stock'])) echo ' <span class="red">***</span>';
					?>
					<?php /*<div style="display:none"><div class="discount">
          <?php foreach ($discounts as $discount) { ?>
          <?php echo 'Купи ' .$discount['quantity']. 'шт за ' .($discount['quantity'] * $discount['price']). 'грн' ?><br />
          <?php } ?>
        </div></div> */ ?>
                    <div>
                        <?php foreach ($product['option'] as $option) { ?>
                        - <small><?php echo $option['name']; ?> <?php echo $option['value']; ?></small><br />
                        <?php } ?>
                    </div>
                    <span class="cart-attr">
                        <?php if($product['attribute_groups']) { ?>
                        <?php foreach($product['attribute_groups'][0]['attribute'] as $attribute) { ?>
                            <?php echo $attribute['name']; ?>: <?php echo $attribute['text']; ?><span class="comma">,</span>&nbsp;
                        <?php } ?>
                        <?php } ?>
                    </span>
                    <?php if ($product['option_required']) { ?>
                        <div class="options">
                            <?php foreach ($product['option_required'] as $option) { ?>
                            <div class="option">
                              <span class="opt-name"><?php echo $option['name']; ?>:</span>
                              &nbsp;&nbsp;
                              <select name="option[<?php echo $option['product_option_id']; ?>]" onchange="select_option('<?php echo $product['key']; ?>', this)">
                                <option value=""><?php echo $text_select; ?></option>
                                <?php foreach ($option['option_value'] as $option_value) { ?>
                                <option value="<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                                <?php if ($option_value['price']) { ?>
                                (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                                <?php } ?>
                                </option>
                                <?php } ?>
                              </select>
                            </div>
                            <span class="error">Поле должно быть заполнено!</span>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </td>

                <td class="quantity">
                    <span class="qty-img"></span>
					<?
					preg_match("/(.*)-(\d+)_0/", $product['key'], $m);
					if (!empty($m[2])){
						$setId = $m[2];
						?><input type="hidden" value="<?php echo $product['quantity']; ?>" /><span><?=$product['quantity']?></span><?
					} else {
						?><input type="text" value="<?php echo $product['quantity']; ?>" size="1" onblur="update('<?php echo $product['key']; ?>', this);"/><?
					}
					?>
                </td>

                <td class="total"><?php echo $product['total']; ?></td>

                <td class="remove">
                    <img src="/catalog/view/theme/fisherway/image/cart/delete.jpg" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" onclick="(getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') ? location = 'index.php?route=checkout/cart&remove=<?php echo $product['key']; ?>' : $('#cart').load('index.php?route=module/cart&remove=<?php echo $product['key']; ?>' + ' #cart > *');" />
                </td>
            </tr>
            <?php } ?>

            <?php foreach ($vouchers as $voucher) { ?>
            <tr>
                <td class="image"></td>
                <td class="name"><?php echo $voucher['description']; ?></td>
                <td class="quantity">x&nbsp;1</td>
                <td class="total"><?php echo $voucher['amount']; ?></td>
                <td class="remove">
                    <img src="/catalog/view/theme/default/image/remove-small.png" alt="<?php echo $button_remove; ?>" title="<?php echo $button_remove; ?>" onclick="(getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') ? location = 'index.php?route=checkout/cart&remove=<?php echo $voucher['key']; ?>' : $('#cart').load('index.php?route=module/cart&remove=<?php echo $voucher['key']; ?>' + ' #cart > *');" />
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <div class="coupon">Дисконтная карта или код купона (если есть): <input type="text" name="coupon"> <a href="javascript:void(0)" onclick="coupon();">Применить</a></div>
    <div class="cart-total center">
        <table id="total">
            <tr>
                <td><b><?php echo $total['title']; ?>:</b></td>
                <td id="total-money"><span><?php echo $total['text']; ?></span></td>
            </tr>
        </table>
    </div>

    <?php if (!$error_warning && !$product['option_required']) { ?>
    <div class="mini-cart-info">
        <div class="center">
            <a class="button-continue" onclick="$('#cart').removeClass('active');">Продолжить покупки</a>
            <a href="<?php echo $checkout; ?>" class="button"></a>
            </div>
    </div>
    <?php } ?>
    <?php } else { ?>
    <div class="empty"><?php echo $text_empty; ?></div>
    <?php } ?>
	<br><br>
	<?php
	if ($_SERVER['REQUEST_URI'] != '/') echo $content_bottom; 
	?>
</div>
</div>