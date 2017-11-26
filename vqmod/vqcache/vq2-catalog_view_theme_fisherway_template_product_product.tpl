<?php
$this->load->model('catalog/product');
$data = array(
    'sort'  => 'p.date_added',
    'order' => 'DESC',
    'start' => 0,
    'limit' => 10
);

$ql = $this->db->query('SELECT product_id FROM '.DB_PREFIX.'product  ORDER BY date_added DESC LIMIT 10');
$latest = array();
foreach ($ql->rows as $result) $latest[] = $result['product_id'];

echo $header;

$timestamp = time();
$date_time_array = getdate($timestamp);
$hours = $date_time_array['hours'];
$minutes = $date_time_array['minutes'];
$seconds = $date_time_array['seconds'];
$month = $date_time_array['mon'];
$day = $date_time_array['mday'];
$year = $date_time_array['year'];
$timestamp = mktime($hours,$minutes,$seconds,$month,$day - $config_newproduct,$year);
?>

<!--BOF Product Series-->
<script type="text/javascript">
    $(document).ready(function()
    {
        //$('.pds a').click(function(e){
        //$this = $(this);

        //TODO loading using AJAX
        //$('#content').load($this.attr('href') + ' #content');
        //e.preventDefault();
        //});
    });
</script>
<!--EOF Product Series-->

<div id="content">
    <div class="one-line"></div>
    <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="breadcrumb">
        <a itemprop="url" href="/"><span itemprop="title">Главная</a>
        <?php foreach ($breadcrumbs as $i=> $breadcrumb) { ?>
            <?php echo $breadcrumb['separator']; ?>
            <?php if($i+1 < count($breadcrumbs)) { ?>
                <a itemprop="url" href="<?php echo $breadcrumb['href']; ?>"><span itemprop="title"><?php echo $breadcrumb['text']; ?></span></a>
            <?php } elseif ($i+1 == count($breadcrumbs)) { ?>
                <?php echo $breadcrumb['text']; ?>
            <?php } ?>
        <?php } ?>
    </div>
    <div class="product-info" itemscope itemtype="http://schema.org/Product">
        <div class="left left-product">
            <?php

            if ($thumb) {
                //echo '<li><a href="#"><img src="'.$thumb.'" width="140" height="140" title="'.$heading_title.'" alt="'.$heading_title.'" /></a></li>';
                $images = array_merge(
                    array(array('popup' => $popup, 'thumb' => $thumb)),
                    $images
                );
            }

            if ($images) {
                $images = is_array($images) ? array_slice($images, 0, 4) : array();
                echo '<div id="fancybox-pictures">';

                echo '<div class="screens">';
                $nImages = count($images);
                if ($nImages > 1) echo '<a class="prev browse left"></a>';
                
			echo '<div class="scrollable">';
if ($this->config->get('config_display_newproduct')) { if (($date_available ) > strftime('%Y-%m-%d',$timestamp)){ echo '<div class="newlabel"></div>'; } }
if ($this->config->get('config_display_popularproduct')) { if (($viewed) > ($config_popularproduct)) { echo '<div class="popularlabel"></div>'; } }
if ($this->config->get('config_display_specialsproduct')) { if ($price && $special) { echo '<div class="speciallabel"></div>'; } }
if ($this->config->get('config_display_availableproduct')) { if (($quantity ) <= 0){ echo '<div class="soldlabel"></div>'; } }
echo '<div class="items">';
                $n = 0;
                foreach($images as $image){
                    echo '<a href="/image/'.$image['popup'].'" title="'.$heading_title.'" class="fancybox" rel="gallery" data-n="'.$n.'">';
                    echo '<img itemprop="image" src="/image/'.$image['popup'].'" title="'.$heading_title.'" alt="'.$heading_title.'" style="max-width: 100%;" />';
                    echo '</a>';
                    $n++;
                }
                echo '</div></div>';
                if ($nImages > 1) echo '<a class="next browse right"></a>';
                echo '</div>';

                echo '<ul class="picture-pagination">';
                if ($images) {
                    $n=0;
                    foreach ($images as $image){
                        echo '<li '.(!$n ? 'class="current"' : '').'><a onclick="scrollImgTo('.$n.');"><img src="'. $image['thumb'] .'" title="'. $heading_title .'" alt="'. $heading_title .'" /></a></li>';
                        $n++;
                    }
                }
                echo '</ul>';
                echo '</div>';


                /*echo '<div id="product-pictures">';
                echo '<div class="image slides_container">';
                if ($thumb){
                    echo '<a href="/image/'.$popup.'" title="'.$heading_title.'" class="colorbox img-link">
                        <img itemprop="image" src="/image/'.$popup.'" title="'.$heading_title.'" alt="'.$heading_title.'" style="max-width: 100%;" />
                    </a>';
                }
                if ($images){
                    foreach($images as $image){
                        echo '<a href="/image/'.$image['popup'].'" title="'.$heading_title.'" class="colorbox img-link">
                            <img itemprop="image" src="/image/'.$image['popup'].'" title="'.$heading_title.'" alt="'.$heading_title.'" style="max-width: 100%;" />
                        </a>';
                    }
                }
                echo '</div>';
                echo '<ul class="picture-pagination">';
                if ($thumb) echo '<li><a href="#"><img src="'.$thumb.'" width="140" height="140" title="'.$heading_title.'" alt="'.$heading_title.'" /></a></li>';
                if ($images) {
                    $y=0;
                    foreach ($images as $image) {
                        if ($y<2) {
                            echo '<li><a href="#"><img src="'. $image['thumb'] .'" title="'. $heading_title .'" alt="'. $heading_title .'" /></a></li>';
                        }
                        $y++;
                    }
                }
                echo '</ul>';
                echo '</div>';*/
            }
            ?>
            <div style="clear:both;"></div>

        </div>

        <div class="right right-product">
            <?php echo $promotion; ?>
            <div style="display:none" class="product-sticker"><?php echo $statuses; ?><?php if ($upc) { ?> <img src="/catalog/view/theme/fisherway/image/sticker_<?php echo $upc; ?>.png"></img><?php } ?></div>
            <?php $new = false;
            if (in_array($product_id, $latest)){
                $new = true;
                ?><span class="latest-item"></span><?php
            }
            /*
      foreach ($results as $result) { ?>
                <?php if ($result['product_id'] == $product_id) { $new = true; ?>
                <span class="latest-item"></span>
                <?php } ?>
            <?php }
      */
            ?>

            <h1 itemprop="name" <?php if ($new) { echo 'style="margin-top: 80px;"'; } ?>><?php echo $heading_title; ?></h1>

            <?php if ($price) {
            ?>
            <div class="product-title">
                <?php if ($is_master) { ?>
                <?php } else { ?>
                    <div class="product-code">Код: <?php echo $sku; ?></div>  <?php } ?>
                <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                    <meta itemprop="availability" href="http://schema.org/InStock" content="Есть в наличии">
                    <?php if ($quantity != 0) { ?>
                    <div class="price">Цена:
                        <meta itemprop="price" content="<?php echo $price; ?>" />
                        <?php } else { ?>
                        <div class="price" style="display:none">Цена:
			<span itemprop="price" class="price"> 
            <?php }

            if (!$special) {
                $priceStr = '';

                if ($is_master) {
                    //BOF: is_master
                    if(sizeof($pds) <= 0) {} else $priceStr .= 'от ';
                    if(sizeof($pds) > 0) {
                        $min = 999999;
                        $oldmin = false;
                        foreach ($pds as $p){
                            //$p_all = $this->model_catalog_product->getProduct($p['product_id']);
                            if (!$p['quantity']) continue;
                            if (!$p['special']) { // $p_all['special']
                                $min = $p['price'] < $min ? $p['price']  : $min; // $p_all['price']
                            } else {
                                $min = $p['special'] < $min ? $p['special']  : $min; //$p_all['special']
                            }
                            if ($oldmin === false || $p['price'] < $oldmin) $oldmin = $p['price']; // $p_all['price']
                        }
                        if ($min != 999999) {
                            $priceStr .= number_format((float)$min, 2, '.', '').' грн';
                            if ($oldmin !== false && $oldmin > $min) $oldpriceStr = number_format((float)$oldmin, 2, '.', '').' грн';
                        }
                    }
                    if(sizeof($pds) <= 0) $priceStr .= $price;
                    //EOF: is_master
                } else {
                    $priceStr .= $price;
                }
                $priceStr = trim($priceStr);
                if (strlen($priceStr) && $priceStr != 'от') {
                    //$oldpriceStr = false; //uncomment this line to disable old series price
                    if (!empty($oldpriceStr)){
                        echo '<span class="new-price">'.$priceStr.'</span>';
                        echo '&nbsp;<del class="old-price">&nbsp;'.$oldpriceStr.'&nbsp;</del>';
                    } else {
                        echo $priceStr;
                    }
                } else {
                    $quantity = 0;
                }
            } else { ?>
                <p itemprop="price" class="new-price"><?php if ($is_master) { ?>от <?php } ?><?php echo $special; ?></p>
                <? if ($price != $special){?><p class="old-price">&nbsp;&nbsp;<?php echo $price; ?>&nbsp;&nbsp;</p><? } ?>
            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>

                    <?php if ($special) { ?>
                        <div class="action">
                            <!--<p>Акция! Скидка <?php echo $discount; ?> на эту модель!</p>-->
                            <?php if ($countdown) { ?>
                                <div class="countdown_comment">До конца акции осталось:</div>
                                <div id="countdown_dashboard" class="countdown_dashboard">
                                    <div class="dash dig3 days_dash">
                                        <span class="dash_title">Дни</span>
                                        <?php if ($show_weeks == 0) { ?>
                                            <div class="digit">0</div>
                                        <?php } ?>
                                        <div class="digit">0</div>
                                        <div class="digit">0</div>

                                    </div>

                                    <div class="dash hours_dash">
                                        <span class="dash_title">Часы</span>
                                        <div class="digit">0</div>
                                        <div class="digit">0</div>
                                    </div>

                                    <div class="dash minutes_dash">
                                        <span class="dash_title">Минуты</span>
                                        <div class="digit">0</div>
                                        <div class="digit">0</div>
                                    </div>

                                    <div class="dash seconds_dash">
                                        <span class="dash_title">Секунды</span>
                                        <div class="digit">0</div>
                                        <div class="digit">0</div>
                                    </div>

                                </div>
                                <script language="javascript" type="text/javascript">
                                    jQuery(document).ready(function() {
                                        $('#countdown_dashboard').countDown({
                                            targetDate: {
                                                'day':      <?php echo $day; ?>,
                                                'month':    <?php echo $month; ?>,
                                                'year':     <?php echo $year; ?>,
                                                'hour':     <?php echo $hour; ?>,
                                                'min':      <?php echo $min; ?>,
                                                'sec':     <?php echo $sec; ?>
                                            }
                                            <?php if ($show_weeks == 0) { ?>
                                            , omitWeeks : true

                                            <?php } ?>
                                            ,onComplete : function(){
                                                $('.action').remove();
                                                var old_price = $('.old-price').text();
                                                $('.new-price').remove()
                                                $('.old-price').remove();
                                                $('div.price').append('от ' + old_price);
                                            }
                                        });
                                    });
                                </script>
                            <?php } ?>
                            <?php if($special_percent){ ?>
                                <div class="special-percent" style="display: none"><?php echo $special_percent; ?>%</div>
                            <?php }?>
                        </div>
                    <?php } ?>
                    <div class="discount">
                        <?php foreach ($discounts as $discount) { ?>
                            <?php echo 'Купи ' .$discount['quantity']. ' шт за ' .$discount['price']. '' ?> <span class="economy"><?php // echo ($price * $discount['quantity']) ?></span><br />
                        <?php } ?>
                    </div>
                    <?php if ($quantity != 0) { ?>
                        <div class="stock"><?php echo $stock; ?></div>
                        <?php if ($minimum > 1) { ?>
                            <div>

                                Цена за штуку, минимальный заказ <?php echo $minimum ?> шт.
                            </div>
                        <?php } ?>
                        <div class="depDate" >
                            <?
                            if ($manufacturer == 'Favorite' && !empty($stickers)){
                                echo '<a class="fancybox" id="size-table-link"><span class="text">Официальный продавец ТМ Favorite</span>'.$stickers.'</a>';
                                echo '<div id="size-table">
				'.$stickers.'
				<div align="right"><a id="size-table-close">закрыть</a></div>
			</div>';
                            }
                            ?>
                            <?
                            if ($manufacturer == 'Norfin' && !empty($stickers)){
                                echo '<a class="fancybox" id="size-table-link"><span class="text">Таблица размеров одежды Norfin</span>'.$stickers.'</a>';
                                echo '<div id="size-table">
				'.$stickers.'
				<div align="right"><a id="size-table-close">закрыть</a></div>
			</div>';
                            }
                            ?>
                        </div>
                        <div class="cart">
                            <div>
                                <input type="text" name="quantity" size="2" value="<?php echo $minimum; ?>" style="display: none;"/>
                                <input type="hidden" name="product_id" size="2" value="<?php echo $product_id; ?>" />
                                <input type="button"  value="<?php echo ($is_master)?"Выбрать модель":"Купить"; ?>" id="button-cart" class="button" onClick="ga('send', 'pageview', '/buy_now_product');"/>
                            </div>
                        </div>
                        <!--start x2_nop-->
                        <div class="purchasecount">
                            <?php if ($x2_nop) { ?>
                                <span><?php echo $text_x2_nop; ?></span> <?php echo $x2_nop; ?> человек<br />
                            <?php } ?>
                        </div>
                        <!--end x2_nop-->
                    <?php } else { ?>
                        <div class="no-stock-info"><?php echo $no_stock; ?></div>
                    <?php } ?>

                    <?php
                    $hb_oosn_stock_status = $this->config->get('hb_oosn_stock_status');
                    $hb_oosn_product_qty = $this->config->get('hb_oosn_product_qty');
                    if ($hb_oosn_stock_status ==  '0'){
                        $stock_status_id = 0;
                    }

                    if (($quantity < $hb_oosn_product_qty) and ($stock_status_id == $hb_oosn_stock_status) and ($options == false)){ ?>
                        <div id="oosn_info_container">
                            <div id="oosn_info_text" style="padding-top:20px;"><?php echo $oosn_info_text; ?></div><br />
                            <div>
                                <table style="padding-top:5px; width:100%;">
                                    <?php if ($this->config->get('hb_oosn_name_enable') == 'y') {?>
                                        <tr>
                                            <td><?php echo $oosn_text_name; ?></td>
                                            <td><input name="notifyname" type="text" id="notifyname" placeholder="<?php echo $oosn_text_name_plh; ?>" value="<?php echo $fname;?>" /></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td><?php echo $oosn_text_email; ?></td>
                                        <td><input name="notifyemail" type="text" id="notifyemail" placeholder="<?php echo $oosn_text_email_plh; ?>" value="<?php echo $email;?>" /></td>
                                    </tr>
                                    <?php if ($this->config->get('hb_oosn_mobile_enable') == 'y') {?>
                                        <tr>
                                            <td><?php echo $oosn_text_phone; ?></td>
                                            <td><input name="notifyphone" type="text" id="notifyphone" placeholder="<?php echo $oosn_text_phone_plh; ?>" value="<?php echo $phone;?>" /></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td></td>
                                        <td><input name="notify" type="button" class="button" id="notify_btn" value="<?php echo $notify_button;?>" /><br></td>
                                    </tr>
                                </table>
                                <div id='loadgif' style='display:none'><img src='catalog/view/theme/default/image/loading.gif'/></div>
                                <br><div id="msgoosn"></div>
                            </div>
                            <br>
                        </div>
                    <?php }/*else {*/ ?>
                    <!-- nostock update -->
                    <div id='los' style='display:none'><img src='catalog/view/theme/default/image/loading.gif'/></div>
                    <div id="option_no_stock" ><input type='hidden' id='notify_option_id' value ='0'><input type='hidden' id='notify_option_value_id' value ='0'><input type='hidden' id='notifyoption' value ='0'></div>
                    <!-- \nostock update -->
                    <?php if ($options) { ?>
                        <!-- nostock update -->
                        <div id="option_no_stock_input" style='display:none;'>
                            <div id="oosn_info_text"><div id="opt_info"></div></div><br />
                            <div>
                                <table style="padding-top:5px; width:100%;">
                                    <?php if ($this->config->get('hb_oosn_name_enable') == 'y') {?>
                                        <tr>
                                            <td><?php echo $oosn_text_name; ?></td>
                                            <td><input name="notifyname" type="text" id="notifyname" placeholder="<?php echo $oosn_text_name_plh; ?>" value="<?php echo $fname;?>" /></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td><?php echo $oosn_text_email; ?></td>
                                        <td><input name="notifyemail" type="text" id="notifyemail" placeholder="<?php echo $oosn_text_email_plh; ?>" value="<?php echo $email;?>" /></td>
                                    </tr>
                                    <?php if ($this->config->get('hb_oosn_mobile_enable') == 'y') {?>
                                        <tr>
                                            <td><?php echo $oosn_text_phone; ?></td>
                                            <td><input name="notifyphone" type="text" id="notifyphone" placeholder="<?php echo $oosn_text_phone_plh; ?>" value="<?php echo $phone;?>" /></td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td></td>
                                        <td><input name="notify" type="button" class="button" id="notify_btn" value="<?php echo $notify_button;?>" /><br><br></td>
                                    </tr>
                                </table>
                                <div id='loadgif' style='display:none'><img src='catalog/view/theme/default/image/loading.gif'/></div>
                                <br><div id="msgoosn"></div>
                            </div>
                            <br>
                        </div><br><br>
                        <!-- \nostock update -->

                        <div class="options">
                            <h2><?php echo $text_option; ?>:</h2>
                            <br />
                            <?php foreach ($options as $option) { ?>
                                <?php if ($option['type'] == 'select') { ?>
                                    <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                        <span class="opt-name"><?php echo $option['name']; ?>:</span>
                                        <?php if ($option['required']) { ?>
                                            <span class="required">*</span>
                                        <?php } ?>
                                        &nbsp;&nbsp;
                                        <?/*<select name="option[<?php echo $option['product_option_id']; ?>]">*/?>
                                        <select name="option[<?php echo $option['product_option_id']; ?>]" onchange="checkOptionQty(this.value, $('option:selected',this).text(),'<?php echo $option['name']; ?>', <?php echo $option['product_option_id']; ?>)">
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
                                    <br />
                                <?php } ?>
                                <?php if ($option['type'] == 'radio') { ?>
                                    <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                        <?php if ($option['required']) { ?>
                                            <span class="required">*</span>
                                        <?php } ?>
                                        <b><?php echo $option['name']; ?>:</b><br />
                                        <?php foreach ($option['option_value'] as $option_value) { ?>
                                            <?/*<input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />*/?>
                                            <input type="radio" onchange="checkOptionQty(this.value, '<?php echo $option_value['name']; ?>','<?php echo $option['name']; ?>', <?php echo $option['product_option_id']; ?>)" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
                                            <label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                                                <?php if ($option_value['price']) { ?>
                                                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                                                <?php } ?>
                                            </label>
                                            <br />
                                        <?php } ?>
                                    </div>
                                    <br />
                                <?php } ?>
                                <?php if ($option['type'] == 'checkbox') { ?>
                                    <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                        <?php if ($option['required']) { ?>
                                            <span class="required">*</span>
                                        <?php } ?>
                                        <b><?php echo $option['name']; ?>:</b><br />
                                        <?php foreach ($option['option_value'] as $option_value) { ?>
                                            <?/*<input type="checkbox" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />*/?>
                                            <input type="checkbox" onchange="checkOptionQty(this.value, '<?php echo $option_value['name']; ?>','<?php echo $option['name']; ?>', <?php echo $option['product_option_id']; ?>)" name="option[<?php echo $option['product_option_id']; ?>][]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
                                            <label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                                                <?php if ($option_value['price']) { ?>
                                                    (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                                                <?php } ?>
                                            </label>
                                            <br />
                                        <?php } ?>
                                    </div>
                                    <br />
                                <?php } ?>
                                <?php if ($option['type'] == 'image') { ?>
                                    <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                        <?php if ($option['required']) { ?>
                                            <span class="required">*</span>
                                        <?php } ?>
                                        <b><?php echo $option['name']; ?>:</b><br />
                                        <table class="option-image">
                                            <?php foreach ($option['option_value'] as $option_value) { ?>
                                                <tr>
                                                    <td style="width: 1px;">
                                                        <?/*<input type="radio" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />*/?>
                                                        <input type="radio" onchange="checkOptionQty(this.value, '<?php echo $option_value['name']; ?>','<?php echo $option['name']; ?>', <?php echo $option['product_option_id']; ?>)" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option_value['product_option_value_id']; ?>" id="option-value-<?php echo $option_value['product_option_value_id']; ?>" />
                                                    </td>
                                                    <td><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><img src="<?php echo $option_value['image']; ?>" alt="<?php echo $option_value['name'] . ($option_value['price'] ? ' ' . $option_value['price_prefix'] . $option_value['price'] : ''); ?>" /></label></td>
                                                    <td><label for="option-value-<?php echo $option_value['product_option_value_id']; ?>"><?php echo $option_value['name']; ?>
                                                            <?php if ($option_value['price']) { ?>
                                                                (<?php echo $option_value['price_prefix']; ?><?php echo $option_value['price']; ?>)
                                                            <?php } ?>
                                                        </label></td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                    </div>
                                    <br />
                                <?php } ?>
                                <?php if ($option['type'] == 'text') { ?>
                                    <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                        <?php if ($option['required']) { ?>
                                            <span class="required">*</span>
                                        <?php } ?>
                                        <b><?php echo $option['name']; ?>:</b><br />
                                        <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" />
                                    </div>
                                    <br />
                                <?php } ?>
                                <?php if ($option['type'] == 'textarea') { ?>
                                    <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                        <?php if ($option['required']) { ?>
                                            <span class="required">*</span>
                                        <?php } ?>
                                        <b><?php echo $option['name']; ?>:</b><br />
                                        <textarea name="option[<?php echo $option['product_option_id']; ?>]" cols="40" rows="5"><?php echo $option['option_value']; ?></textarea>
                                    </div>
                                    <br />
                                <?php } ?>
                                <?php if ($option['type'] == 'file') { ?>
                                    <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                        <?php if ($option['required']) { ?>
                                            <span class="required">*</span>
                                        <?php } ?>
                                        <b><?php echo $option['name']; ?>:</b><br />
                                        <input type="button" value="<?php echo $button_upload; ?>" id="button-option-<?php echo $option['product_option_id']; ?>" class="button">
                                        <input type="hidden" name="option[<?php echo $option['product_option_id']; ?>]" value="" />
                                    </div>
                                    <br />
                                <?php } ?>
                                <?php if ($option['type'] == 'date') { ?>
                                    <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                        <?php if ($option['required']) { ?>
                                            <span class="required">*</span>
                                        <?php } ?>
                                        <b><?php echo $option['name']; ?>:</b><br />
                                        <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="date" />
                                    </div>
                                    <br />
                                <?php } ?>
                                <?php if ($option['type'] == 'datetime') { ?>
                                    <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                        <?php if ($option['required']) { ?>
                                            <span class="required">*</span>
                                        <?php } ?>
                                        <b><?php echo $option['name']; ?>:</b><br />
                                        <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="datetime" />
                                    </div>
                                    <br />
                                <?php } ?>
                                <?php if ($option['type'] == 'time') { ?>
                                    <div id="option-<?php echo $option['product_option_id']; ?>" class="option">
                                        <?php if ($option['required']) { ?>
                                            <span class="required">*</span>
                                        <?php } ?>
                                        <b><?php echo $option['name']; ?>:</b><br />
                                        <input type="text" name="option[<?php echo $option['product_option_id']; ?>]" value="<?php echo $option['option_value']; ?>" class="time" />
                                    </div>
                                    <br />
                                <?php } ?>
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <div id="haract">
                        <?php if ($manufacturer) { ?>
                            <div style="display:none" class="product-attr">
                                <span class="attr-name"><?php echo $text_manufacturer; ?></span>
                                <span itemprop="brand" class="attr-value"><?php echo $manufacturer; ?></span>
                                <div style="clear:both;"></div>
                            </div>
                        <?php } ?>
                        <!--<div class="product-attr">
                    <span class="attr-name"><?php echo $text_model; ?></span>
                    <span class="attr-value"><?php echo $model; ?></span>
                    <div style="clear:both;"></div>
                </div>-->

                        <?php if ($attribute_groups) { ?>
                            <?php foreach ($attribute_groups as $attribute_group) { ?>
                                <?php foreach ($attribute_group['attribute'] as $attribute) { ?>
                                    <div class="product-attr">
                                        <span class="attr-name"><?php echo $attribute['name']; ?></span>
                                        <span class="attr-value"><?php echo $attribute['text']; ?></span>
                                        <div style="clear:both;"></div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </div>

                </div>
                <div class="product-title-right">
                    <?php echo $content_bottom; ?>
                </div>
            </div>
            <div style="clear:both;"></div>
            <div class="product-menu">
                <ul>
                    <li><a href="<?php echo $_SERVER['REQUEST_URI']; ?>#opisanie">Описание</a></li>
                    <li><a href="<?php echo $_SERVER['REQUEST_URI']; ?>#video">Видео</a></li>
                    <li><a href="<?php echo $_SERVER['REQUEST_URI']; ?>#review-title">Отзывы</a></li>
                </ul>
            </div>
            <div class="product-desc">

                <!--BOF Product Series -->
                <!--if this is a master then load list of slave products, if this is a slave product then load other slave products under the same master -->
                <?php $this->load->model('catalog/product'); ?>
                <?php if(sizeof($pds) > 0) { ?>
                <div class="price pds">
                    <h3 id="pds">Модельный ряд</h3>

                    <?php
                    usort($pds, function($a, $b){
                        if (($a['quantity'] == 0 && $b['quantity'] == 0) || ($a['quantity'] != 0 && $b['quantity'] != 0)) {
                            return strcasecmp($a['product_name'], $b['product_name']);
                        }
                        if ($a['quantity'] == 0) return 1;
                        return -1; // $b['quantity'] == 0
                    });
                    $available = true;
                    foreach ($pds as $p){
                        if (empty($p['quantity']) && $available){
                            $available = false;
                            echo '<div id="hiddenUnavailable">';
                        }

                        //$p_all = $this->model_catalog_product->getProduct($p['product_id']);
                        $pds_price = !$p['special'] ? $p['price'] : $p['special']; // $p_all['special'], $p_all['price']

                        ?>
                        <div class="product-title-v2">

                            <span class="thumbnail <?php echo $pds_enable_preview ? 'preview' : ''?> <?php echo ($p['product_id'] == $product_id) ? 'pds-current' : '' ?>" title="<?php echo $p['product_name']; ?>" ">
                            <?php
                            echo '<a href="'.($p['product_pds_image'] ? $p['product_pds_image'] : $p['product_main_image']).'" title="'.$p['product_name'].'" class="fancybox fix-150">';
                            echo '<img src="'.($p['product_pds_image'] ? $p['product_pds_image'] : $p['product_main_image']).'" alt="'. $p['product_name'].'" width="150" />';
                            echo '</a>';
                            ?>
                            </span>

                            <div class="info">
                                <span class="name <?php echo $pds_enable_preview ? 'preview' : ''?> <?php echo ($p['product_id'] == $product_id) ? 'pds-current' : '' ?>" ><h2><?php echo $p['product_name']; ?></h2></span>

                    <?php if($p['quantity']  > 6661400 && $p['quantity'] < 6661489 ) { ?>
                        <span class="stock" >Под заказ (3-5 дней)</span>
                    <?php } elseif($p['quantity'] > 0 ) { ?>
                        <span class="stock" >Есть в наличии</span>
                    <?php } ?>
            
                                <div class="haract">
                                    <?php
                                    if ($p['attribute_groups']){
                                        $params = array();
                                        foreach ($p['attribute_groups'] as $attribute_group) {
                                            foreach ($attribute_group['attribute'] as $attribute) {
                                                $params[] = '<span class="attr">'.$attribute['name'].' <span class="attr-value">'.$attribute['text'].'</span></span>';
                                            }
                                        }
                                        if (!empty($params)) echo implode(' | ', $params);
                                    }
                                    ?>
                                </div>


                <span class="promotion"><?php echo($p['promotion']); ?></span>
            
                                <? if (!empty($p['discounts']) && $available){ ?>
                                    <div class="pds-discount">
                                        <?php
                                        foreach ($p['discounts'] as $pds_discount) {
                                            $economy = round($pds_price * $pds_discount['quantity'] - str_replace(',', '', $pds_discount['price']));
                                            if ($economy > 0) echo 'Акция! Купи ' .$pds_discount['quantity']. ' шт за ' .round(str_replace(',', '', $pds_discount['price'])). ' грн. Выгода &ndash; <span class="economy">'.$economy.' грн.</span><br />';
                                        }
                                        ?>
                                    </div>
                                <? } ?>

                            </div>
                            <div class="buy">
                                <?php
                                if ($p['quantity'] != 0){
                                    //BOF: old price
                                    if ($p['special'] && round($p['price']) != round($pds_price)){ // $p_all['special']
                                        echo '<del class="old-price">&nbsp;'.round($p['price']).' <span>грн</span>&nbsp;</del><br />'; // $p_all['price']
                                    }
                                    //EOF: old price
                                    echo round($pds_price);
                                    echo ' <span>грн</span>';
                                }

                                if ($p['quantity'] != 0){
                                    echo '<a rel="nofollow" class="buybtn" onclick="addToCart(\''. $p['product_id'].'\'); " href="javascript:void(0)">Купить</a>';
                                } else {
                                    echo '<span class="no-stock">'. $no_stock .'</span>';
                                    echo '<a class="notify-on-stock" onclick="notifyOnStock(\''. $p['product_id'].'\');"><span>Сообщить о наличии</span></a>';
                                }
                                if (!empty($p['sku'])){ //// $p_all['sku']
                                    echo '<div class="model-sku">Код: '.ltrim($p['sku'],'0').'</div>'; // $p_all['sku']
                                }
                                ?>
                            </div>
                        </div>
                    <?php }
                    if (!$available){
                        echo '</div>';
                        echo '<div id="showHidden"><span>Показать все</span></div>';
                    }
                    ?>

                    <div style="clear:both;"></div>
                    <?php } ?>
                    <? //BOF: комплекты ?>
                    <div id="product-set-container"></div>
                    <? //EOF: комплекты ?>
                    <?php if(!$display_add_to_cart){ ?>
                        <style>
                            /*Hide cart and options*/
                            .cart, .options, .buttons-cart, .input-qty, #product_buy, #product_options {display: none;}
                        </style>
                    <?php } ?>
                    <!--EOF Product Series -->
                    <?php if ($options) { ?>
                    <?php } ?>



                    <?php if ($review_status) { ?>
                    <table>
                        <tr>
                            <div class="product-descri">
                                <h3 id="opisanie">Описание</h3>
                                <?php echo $statuses; ?>
                                <div itemprop="description">
                                    <?php  //echo $product_info['product_id']; ?>
                                    <?php
                                    if (!empty($description)){
                                        echo $description;
                                    } else {

                                    }
                                    ?>



                                    <!--start x2_nop-->
                                    <?php if ($x2_nop) { ?>
                                        <span><?php echo $heading_title; ?>  <?php echo $text_x2_nop; ?></span> <?php echo $x2_nop; ?> рыбаков<br />
                                    <?php } ?>
                                    <!--end x2_nop-->
                                    <div class="youtube">
                                        <?php /* if(count($youtubes)){
            $colorbox = 1;
                foreach($youtubes as $isbn){
                $videokodu = explode('=',$isbn);
                    if(!empty($videokodu[0])){
                        ?>
                        <iframe width="560" height="315" src="//<?php echo $mpn; ?>" frameborder="0" allowfullscreen></iframe>
                        <?php
                    }
                }
            }
      */      ?>
                                    </div>
                                    <?php // echo $mpn; ?>
                                </div>

                                <div id="tab-review" class="product-review">
                                    <h3 id="review-title">Отзывы</h3>
                                    <?php
                                    $reviews = $this->model_catalog_review->getReviewsByProductId($product_id); ?>
                                    <?php if ($reviews) { ?>
                                        <?php foreach ($reviews as $review) { ?>
                                            <div class="review-list" itemprop="review" itemscope itemtype="http://schema.org/Review">
                                                <meta itemprop="name" content="<?php echo $heading_title; ?>" >
                                                <div class="author" itemprop="author"><?php echo $review['author']; ?></div>
                                                <meta itemprop="datePublished" content="<?php echo $review['date_added'] ?>">
                                                <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
                                                    <meta itemprop="worstRating" content = "1">
                                                    <meta itemprop="bestRating" content = "5">
                                                    <meta itemprop="ratingValue" content="<?php echo $review['rating'] ?>">
                                                    <div class="rating"><span>Оценка товара</span><span><?php for ($i = 0; $i < $review['rating']; $i++) { ?><label class="full-label"></label><?php } ?><?php for ($i = $review['rating']; $i < 5; $i++) { ?><label></label><?php } ?></span></div>
                                                    <div class="rating"><span>Оценка сервиса Fisherway</span><?php for ($i = 0; $i < $review['rating_service']; $i++) { ?><label class="full-label"></label><?php } ?><?php for ($i = $review['rating_service']; $i < 5; $i++) { ?><label></label><?php } ?></div>
                                                </div>
                                                <div style="clear:both;"></div>
                                                <div class="text" itemprop="description"><?php echo $review['text']; ?></div>
                                            </div>
                                        <?php } ?>
                                        <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                                            Рейтинг: <span itemprop="ratingValue"><?php echo $review['rating'] ?></span>, отзывов <span itemprop="reviewCount">25</span>
                                        </div>
                                    <?php } ?>
                                </div>
                                <?php } ?>

                                <?php if ($review_status) { ?>
                                    <div class="product-review" id="add-review">

                                        </br>
                                        <p>Оставьте отзыв на <?php echo $heading_title; ?></p>
                                        <div>
                                            <b>Комментарий</b>
                                            <textarea name="text" cols="40" rows="8"></textarea>
                                        </div>
                                        <div>
                                            <b>Имя</b>
                                            <input type="text" name="name" value="" />
                                        </div>
                                        <div class="product_stars">
                                            <b>Рейтинг</b>
                                            <input type="radio" name="rating" value="1" id="rad1"/>
                                            <label for="rad1"></label>
                                            <input type="radio" name="rating" value="2" id="rad2"/>
                                            <label for="rad2"></label>
                                            <input type="radio" name="rating" value="3" id="rad3"/>
                                            <label for="rad3"></label>
                                            <input type="radio" name="rating" value="4" id="rad4"/>
                                            <label for="rad4"></label>
                                            <input type="radio" name="rating" value="5" id="rad5"/>
                                            <label for="rad5"></label>
                                        </div>
                                        <div class="service_stars">
                                            <b>Оценка сервиса</b>
                                            <input type="radio" name="rating_service" value="1" id="rad6"/>
                                            <label for="rad6"></label>
                                            <input type="radio" name="rating_service" value="2" id="rad7"/>
                                            <label for="rad7"></label>
                                            <input type="radio" name="rating_service" value="3" id="rad8"/>
                                            <label for="rad8"></label>
                                            <input type="radio" name="rating_service" value="4" id="rad9"/>
                                            <label for="rad9"></label>
                                            <input type="radio" name="rating_service" value="5" id="rad10"/>
                                            <label for="rad10"></label>
                                        </div>
                                        <div>
                                            <a id="button-review" class="button" onclick="ga('send', 'pageview', '/post_review');">Добавить отзыв</a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </tr>
                        <tr>
                            <div>
                                <?php echo $column_right; ?>

                            </div>
                        </tr>
                    </table>
                </div>



            </div>



        </div>

        <div class="box-heading">
            <?php foreach ($breadcrumbs as $i=> $breadcrumb) { ?>
                <?php // echo $breadcrumb['separator']; ?>
                <?php if($i+3 < count($breadcrumbs)) { ?>
                    <?php echo $breadcrumb['text']; ?>
                <?php } elseif ($i+3 == count($breadcrumbs)) { ?>
                    <?php // echo $breadcrumb['text']; ?>
                <?php } ?>
            <?php } ?>
            Похожие на <?php echo $heading_title; ?></div>
        <?php echo $content_top; ?>
    </div>

    <div style="display:none" class="esprice"><?php echo $price; ?></div>
    <script type="text/javascript"><!--
        $(document).ready(function() {
            $('.colorbox').colorbox({
                overlayClose: true,
                opacity: 0.5,
                rel: "colorbox",
                top: 100
                // fixed: true
                // position: fixed
            });
        });
        //--></script>
    <script type="text/javascript"><!--
        $('#button-cart').bind('click', function() {
            $('#popup_product_sires').removeClass('active');

            <?php if ($is_master) { ?>
            $('#popup_product_sires').addClass('active');
            //$('html, body').animate({scrollTop:0});
            $('html, body').animate({scrollTop:$('#pds').offset().top});
            <?php } else {
                ?>
            var dataArray = [];
            $('.product-info input[type=\'text\'], .product-info input[type=\'hidden\'], .product-info input[type=\'radio\']:checked, .product-info input[type=\'checkbox\']:checked, .product-info select, .product-info textarea').each(function(){
                if (!$(this).parents('.products-related').size()){
                    dataArray[dataArray.length] = this;
                }
            });
            $.ajax({
                url: 'index.php?route=checkout/cart/add',
                type: 'post',
                data: dataArray,
                dataType: 'json',
                success: function(json) {
                    $('.success, .warning, .attention, information, .error').remove();

                    if (json['error']) {
                        $('#cart').load('index.php?route=module/cart #cart > *');
                        $('#cart').addClass('active');

                        if (json['error']['option']) {
                            for (i in json['error']['option']) {
                                $('#option-' + i).after('<span class="error">' + json['error']['option'][i] + '</span>');
                            }
                        }
                    }

                    if (json['success']) {
                        $('#cart').load('index.php?route=module/cart #cart > *');
                        $('#cart').addClass('active');
                        $('#cart-total').html(json['total']);
                    }
                }
            });
            <?php } ?>

        });
        //--></script>
    <?php if ($options) { ?>
        <?php foreach ($options as $option) { ?>
            <?php if ($option['type'] == 'file') { ?>
                <script type="text/javascript"><!--
                    new AjaxUpload('#button-option-<?php echo $option['product_option_id']; ?>', {
                        action: 'index.php?route=product/product/upload',
                        name: 'file',
                        autoSubmit: true,
                        responseType: 'json',
                        onSubmit: function(file, extension) {
                            $('#button-option-<?php echo $option['product_option_id']; ?>').after('<img src="/catalog/view/theme/default/image/loading.gif" class="loading" style="padding-left: 5px;" />');
                            $('#button-option-<?php echo $option['product_option_id']; ?>').attr('disabled', true);
                        },
                        onComplete: function(file, json) {
                            $('#button-option-<?php echo $option['product_option_id']; ?>').attr('disabled', false);

                            $('.error').remove();

                            if (json['success']) {
                                alert(json['success']);

                                $('input[name=\'option[<?php echo $option['product_option_id']; ?>]\']').attr('value', json['file']);
                            }

                            if (json['error']) {
                                $('#option-<?php echo $option['product_option_id']; ?>').after('<span class="error">' + json['error'] + '</span>');
                            }

                            $('.loading').remove();
                        }
                    });
                    //--></script>
            <?php } ?>
        <?php } ?>
    <?php } ?>
    <script type="text/javascript"><!--
        $('#review .pagination a').live('click', function() {
            $('#review').fadeOut('slow');

            $('#review').load(this.href);

            $('#review').fadeIn('slow');

            return false;
        });

        // $('#review').load('index.php?route=product/product/review&product_id=<?php echo $product_id; ?>');

        $('#button-review').bind('click', function() {
            $.ajax({
                url: 'index.php?route=product/product/write&product_id=<?php echo $product_id; ?>',
                type: 'post',
                dataType: 'json',
                data: 'name=' + encodeURIComponent($('input[name=\'name\']').val()) + '&text=' + encodeURIComponent($('textarea[name=\'text\']').val()) + '&rating=' + encodeURIComponent($('input[name=\'rating\']:checked').val() ? $('input[name=\'rating\']:checked').val() : '') + '&rating_service=' + encodeURIComponent($('input[name=\'rating_service\']:checked').val() ? $('input[name=\'rating_service\']:checked').val() : '') + '&captcha=' + encodeURIComponent($('input[name=\'captcha\']').val()),
                beforeSend: function() {
                    $('.success, .warning').remove();
                    $('#button-review').attr('disabled', true);
                    $('#review-title').after('<div class="attention"><img src="/catalog/view/theme/default/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
                },
                complete: function() {
                    $('#button-review').attr('disabled', false);
                    $('.attention').remove();
                },
                success: function(data) {
                    if (data['error']) {
                        $('#add-review').after('<div class="warning">' + data['error'] + '</div>');
                    }

                    if (data['success']) {
                        $('#add-review').after('<div class="success">' + data['success'] + '</div>');

                        $('input[name=\'name\']').val('');
                        $('textarea[name=\'text\']').val('');
                        $('input[name=\'rating\']:checked').attr('checked', '');
                        $('input[name=\'captcha\']').val('');
                    }
                }
            });
        });
        //--></script>
    <?/*<script type="text/javascript"><!--
// $('#tabs a').tabs();
// //static product menu
//      var menu_dist = $('.product-menu').offset().top;
//      $(window).scroll(function () {
//          if ($(this).scrollTop() > menu_dist) {
//              $('.product-menu').css('position', 'fixed');
//              $('.product-menu').css('top', '0');
//          } else  {
//              $('.product-menu').css('position', 'relative');
//          }
//      });
//--></script>*/?>
    <?php if($is_set){?>
        <script type="text/javascript">
            $('.product-info .right .price, .product-info .right .cart').remove();
            $('.product-info .right .description').after('<div id="list-products-in-set-product-page"><div class="load-image"><img src="image/set-loader-min.gif" alt=""></div></div>');
            $('#list-products-in-set-product-page').load(
                $('base').attr('href') + 'index.php?route=module/set/productload&set_id=<?php echo $is_set; ?>',
                function(){
                    $('.load-image').hide();
                }
            );
        </script>
    <?php } ?>


    <?php if($count_set){?>
        <script type="text/javascript">
            $('#product-set-container').append('<div id="set-place"><div class="load-image"><img src="image/set-loader.gif" alt=""></div></div>');
            $('#set-place').load(
                $('base').attr('href') + 'index.php?route=module/set/setsload&product_id=<?php echo $product_id; ?>',
                function(){
                    $('.load-image').hide();
                }
            );
        </script>
        <?php /*if($set_place=='before_tabs'){?>
		<script type="text/javascript">
			$('.product-info').after('<div id="set-place"><div class="load-image"><img src="image/set-loader.gif" alt=""></div></div>');
			$('#set-place').load(
				$('base').attr('href') + 'index.php?route=module/set/setsload&product_id=<?php echo $product_id; ?>', 
					function(){
						$('.load-image').hide(); 
					}
			);                    
		</script>
	<?php } elseif($set_place=='in_tabs'){ ?>
		<script type="text/javascript">
			$('#tabs a:first-child').after('<a id="link-to-sets" href="#tab-sets"><img src="image/set-loader-min.gif" alt=""></a>');
			$('#tab-description').after('<div id="tab-sets" class="tab-content"></div>');
			$('#tab-sets').load(
				$('base').attr('href') + 'index.php?route=module/set/setsload&product_id=<?php echo $product_id; ?>', 
					function(){
						$('#tabs a').tabs();
						$('.load-image').hide();
						$('#link-to-sets').text('<?php echo $tab_sets; ?>');
					}
			);
								 
		</script>                
	<?php }*/ ?>
    <?php } ?>
    <style type="text/css"><?php echo $this->config->get('hb_oosn_css');?></style>
    <script type="text/javascript"><!--
        function checkOptionQty(ovid,oname,sname,oid) {
            $('#los').show();
            $('#option_no_stock').html('');
            $.ajax({
                type: 'post',
                url: 'index.php?route=product/product_oosn/checkstock',
                data: {option_id: oid, option_value_id: ovid, product_id: '<?php echo $product_id; ?>', option_value: oname, option_selected: sname},
                dataType: 'json',
                success: function(json) {
                    if (json['success']) {
                        $('#option_no_stock_input').show();
                        $('#option_no_stock').html(json['success']);
                        $( "#option_no_stock_input" ).effect( "<?php echo $this->config->get('hb_oosn_pp_effect'); ?>", "fast" );

                        $(".options").find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
                        $(".options").find('select').val('');
                    }
                    if (json['hasqty']) {
                        $('#option_no_stock_input').hide();
                    }
                    if (json['optinfo']) {
                        $('#opt_info').html(json['optinfo']);
                    }
                }
            });
            $('#los').hide();

        };

        $('#notify_btn').click(function(){
            $('#msgoosn').html('');
            $('#loadgif').show();
            $.ajax({
                type: 'post',
                url: 'index.php?route=product/product_oosn',
                data: {data: $('#notifyemail').val(),product_id: '<?php echo $product_id; ?>',option_id:$('#notify_option_id').val(), 							option_value_id:$('#notify_option_value_id').val(),
                    <?php if ($this->config->get('hb_oosn_name_enable') == 'y') {?>
                    name: $('#notifyname').val(),
                    <?php } ?>

                    <?php if ($this->config->get('hb_oosn_mobile_enable') == 'y') {?>
                    phone: $('#notifyphone').val(),
                    <?php } ?>
                    option: $('#notifyoption').val()

                },
                dataType: 'json',
                success: function(json) {
                    if (json && json['success'] !== undefined){
                        $('#msgoosn').html(json['success']);
                        $('#loadgif').hide();
                    }
                },
                error: function() {
                    alert("There was an error in printing the message.");
                }
            });

        });
        //--></script>
    <!-- D Remarketing -->
    <script type="text/javascript">
        $(document).ready(function(){

            var pageurl = document.URL;
            window.GIHhtQfW_AtmUrls = window.GIHhtQfW_AtmUrls || [];
            if ( -1 < pageurl.indexOf('?')){
                var mas = pageurl.split('?');
                window.GIHhtQfW_AtmUrls.push(mas[0]);
            }
            $('#button-cart').click(function () {

                window.GIHhtQfW_AtmUrls.push('http://fisherway.com.ua/add-to-cart');
            });
        });


    </script>
    <!-- D Remarketing -->
    <script type="text/javascript">

        (function(d,w){

            var n=d.getElementsByTagName("script")[0],

                s=d.createElement("script"),

                f=function(){n.parentNode.insertBefore(s,n);};

            s.type="text/javascript";

            s.async=true;

            s.src="http://track.recreativ.ru/trck.php?shop=1273&ttl=30&offer=<?php echo $product_id; ?>&rnd="+Math.floor(Math.random()*999);

            if(window.opera=="[object Opera]"){d.addEventListener("DOMContentLoaded", f, false);}

            else{f();}

        })(document,window);

    </script>
    <!-- ADTRG -->
    <script type="text/javascript">
        $(document).ready(function(){
            __AtmUrls = window.__AtmUrls || [];
            var product_url = document.URL;
            if (-1 < product_url.indexOf('#')) {
                var mas = product_url.split('#');
                product_url = mas[0];
                __AtmUrls.push('' + product_url);
            }
        });
    </script>

    <!-- Stock Status -->
    <script type="text/javascript">
        $(document).ready(function(){

            ga('send', 'event', {'eventCategory': 'Stock Status', 'eventAction': '<?php if ($quantity != 0) { ?>Yes<?php } else { ?>No<?php } ?>'}, 'eventLabel': '<?php echo $heading_title; ?>', {'nonInteraction': 1});

        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            ga('send', 'event', {'eventCategory': 'Product Page', 'eventAction': 'Impression', 'eventLabel': '<?php echo $product_id; ?>','metric3':'1',  'dimension2': '<?php echo $product_id; ?>'});
        });
    </script>
    <script  src="catalog/view/theme/fisherway/scripts/jquery.Countdown.js"></script>
    <?php echo $footer; ?>
