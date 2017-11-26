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
    <?php foreach ($breadcrumbs as $i=> $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?>
    <?php if($i+1 < count($breadcrumbs)) { ?>
        <a itemprop="url" href="<?php echo $breadcrumb['href']; ?>"><span itemprop="title"><?php echo $breadcrumb['text']; ?></span></a>
    <?php } elseif ($i+1 == count($breadcrumbs)) { ?>
        <?php echo $breadcrumb['text']; ?>
    <?php } ?>
    <?php } ?>
  </div>
  <?php echo $content_top; ?>
  <div class="product-info" itemscope itemtype="http://schema.org/Product">
    <div class="left left-product">
        <?php if ($thumb || $images) { ?>
        <div id="product-pictures">
          <ul class="picture-pagination">
            <?php if ($thumb) { ?>
            <li><a href="#"><img src="<?php echo $thumb; ?>" width="140" height="140" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></li>
             <?php } ?>
             <?php if ($images) $y=0;{ ?>
            <?php foreach ($images as $image) {
                if ($y<2) { ?>
            <li><a href="#"><img src="<?php echo $image['thumb']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" /></a></li>
            <?php } $y++; } ?>
            <?php } ?>
          </ul>
          <div class="image slides_container">
           <?php if ($thumb) { ?>
          <a href="/image/<?php echo $popup; ?>" title="<?php echo $heading_title; ?>" class="colorbox img-link">
            <img itemprop="image" src="/image/<?php echo $popup; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" style="max-width: 100%;" />
          </a>
          <?php } ?>
          <?php if ($images) { ?>
                <?php foreach ($images as $image) { ?>
                <a href="/image/<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>" class="colorbox img-link">
                    <img itemprop="image" src="/image/<?php echo $image['popup']; ?>" title="<?php echo $heading_title; ?>" alt="<?php echo $heading_title; ?>" style="max-width: 100%;" />
                </a>
                <?php } ?>
          <?php } ?>
          </div>
        </div>
        <?php } ?>

        <div style="clear:both;"></div>

        <?php if ($special) { ?>
        <div class="action">
            <p>Акция! Скидка <?php echo $discount; ?> на эту модель!</p>

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
                            'sec':      <?php echo $sec; ?>
                        }
                        <?php if ($show_weeks == 0) { ?>
                        , omitWeeks : true
                        <?php } ?>
                    });
                });
            </script>
            <?php } ?>
        </div>
        <?php } ?>

        <div style="clear:both;"></div>

        <div class="product-menu">
          <ul>
            <li><a href="<?php echo $_SERVER['REQUEST_URI']; ?>#opisanie">Описание</a></li>
            <li><a href="<?php echo $_SERVER['REQUEST_URI']; ?>#video">Видео</a></li>
            <li><a href="<?php echo $_SERVER['REQUEST_URI']; ?>#review-title">Отзывы</a></li>
          </ul>
        </div>
    </div>
    <div class="right right-product">
        <div class="product-title">
		<div class="product-sticker"><?php echo $statuses; ?><?php if ($upc) { ?> <img src="/catalog/view/theme/fisherway/image/sticker_<?php echo $upc; ?>.png"></img><?php } ?></div>
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
		<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
		<meta itemprop="availability" href="http://schema.org/InStock" content="Есть в наличии">
			 <?php if ($quantity != 0) { ?>
			 <div itemprop="price" class="price">
			 <?php } else { ?>
			 <div itemprop="price" class="price" style="display:none">
            <?php } ?>
    
                <?php if (!$special) {
				$priceStr = '';
				if ($is_master) {
					if(sizeof($pds) <= 0) { ?>
				    <?php } else { ?>
					<?php $priceStr .= 'от '; ?>
                  <?php } ?>
				    <?php if(sizeof($pds) > 0) { ?>
				      <?php $min = 999999; ?>
                      <?php foreach ($pds as $p) {
						if (!$p['quantity']) continue;
					  ?>
                      <?php $p_all = $this->model_catalog_product->getProduct($p['product_id']); ?>
                      <?php if (!$p_all['special']) { ?> 
                        <?php  $min = $p_all['price'] < $min ? $p_all['price']  : $min; ?>
                      <?php } else { ?>
                        <?php  $min = $p_all['special'] < $min ? $p_all['special']  : $min; ?>
                      <?php } ?>
                    <?php } ?>
                    <?php if ($min != 999999) $priceStr .= number_format((float)$min, 2, '.', '').' грн'; ?>              
                  <?php } ?>
				    <?php if(sizeof($pds) <= 0) { ?>
				    <?php $priceStr .= $price; ?>
                  <?php } ?>
                <?php } else { ?>
                  <?php $priceStr .= $price; ?>
				<?php }
				$priceStr = trim($priceStr);
				if (strlen($priceStr) && $priceStr != 'от') echo $priceStr;
					else $quantity = 0;
                } else { ?>
                <p class="old-price">&nbsp;&nbsp;<?php echo $price; ?>&nbsp;&nbsp;</p>
                <p itemprop="price" class="new-price"><?php if ($is_master) { ?>от <?php } ?><?php echo $special; ?></p>
                <?php } ?>
              </div>
		</div>
			  <?php } ?>

            <?php if ($quantity != 0) { ?>
            <div class="stock"><?php echo $stock; ?></div>
			<div class="cart">
                <div>
                  <input type="text" name="quantity" size="2" value="<?php echo $minimum; ?>" style="display: none;"/>
                  <input type="hidden" name="product_id" size="2" value="<?php echo $product_id; ?>" />
                  <input type="button" value="Купить" id="button-cart" class="button" onClick="ga('send', 'pageview', '/buy_now_product');"/>
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
              <div class="product-cond-layout">
              <?php echo $content_bottom; ?>
              <div style="clear:both;"></div>
              </div>
          </div>
    </div>
    <div style="clear:both;"></div>
<? //BOF: комплекты ?>
<div id="product-set-container"></div>
<? //EOF: комплекты ?>
    <div class="product-desc">

            <!--BOF Product Series -->
            <!--if this is a master then load list of slave products, if this is a slave product then load other slave products under the same master -->
            <?php $this->load->model('catalog/product'); ?>
            <?php if(sizeof($pds) > 0) { ?>
                <div class="price pds">
					<h2 id="pds">Модельный ряд</h2>
					
					<?php 
					usort($pds, function($a, $b){
						if (($a['quantity'] == 0 && $b['quantity'] == 0) || ($a['quantity'] != 0 && $b['quantity'] != 0)) {
							return strcasecmp($a['product_name'], $b['product_name']);
							//return 0;
						}
						if ($a['quantity'] == 0) return 1;
						return -1;
					});
					$available = true;
					foreach ($pds as $p){
						if (empty($p['quantity']) && $available){
							$available = false;
							echo '<div id="hiddenUnavailable">';
						}
						?>
						<div class="product-title-v2">

							<span class="thumbnail <?php echo $pds_enable_preview ? 'preview' : ''?> <?php echo ($p['product_id'] == $product_id) ? 'pds-current' : '' ?>" title="<?php echo $p['product_name']; ?>" ">
							<?php if($p['product_pds_image']) { ?>
								<img src="<?php echo $p['product_pds_image']; ?>" alt="<?php echo $p['product_name']; ?>" width="150" height="150"/>
							<?php } else { ?>
								<img src="<?php echo $p['product_main_image']; ?>" alt="<?php echo $p['product_name']; ?>" width="150" height="150"/>
							<?php } ?>
							</span>

							<div class="info">
								<span class="name <?php echo $pds_enable_preview ? 'preview' : ''?> <?php echo ($p['product_id'] == $product_id) ? 'pds-current' : '' ?>" ><?php echo $p['product_name']; ?></span>
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
							</div>
							<div class="buy">
								<?php 
								if ($p['quantity'] != 0){
								   $p_all = $this->model_catalog_product->getProduct($p['product_id']); 
								   echo !$p_all['special'] ? round($p_all['price']) : round($p_all['special']);
								   echo ' <span>грн</span>'; 
								} 

								if ($p['quantity'] != 0) { ?>
									<a rel="nofollow" class="buybtn" onclick="addToCart('<?php echo $p['product_id']; ?>');" href="javascript:void(0)">Купить</a>
								<?php } else { ?>
									<span class="no-stock"><?php echo $no_stock; ?></span>
								<?php } ?> 
							</div>
						</div>
					<?php } 
					if (!$available){
						echo '</div>';
						echo '<div id="showHidden"><span>Показать все</span></div>';
					}
					?>
					
                </div>
                <div style="clear:both;"></div>
            <?php } ?>
            <?php if(!$display_add_to_cart){ ?>
                <style>
                    /*Hide cart and options*/
                    .cart, .options, .buttons-cart, .input-qty, #product_buy, #product_options {display: none;}
                </style>
            <?php } ?>
            <!--EOF Product Series -->
        <?php if ($options) { ?>
        <?php } ?>

        <?php /*if ($related_product){ ?>
        <h5 class="kit">Акционное предложение! <span>Купи комплект сейчас со скидкой на аксессуары:</span></h5>
        <div class="products-related">

            <div class="complect">

                <div class="product-related">
                    <div class="image">
                        <?php if($thumb) { ?>
                            <img src="<?php echo $thumb; ?>" alt="<?php echo $heading_title; ?>" style="max-width: 100%;" />
                        <?php } else { ?>
                            <img src="/image/no_image.jpg" alt="<?php echo $heading_title; ?>" style="max-width: 100%;" />
                        <?php } ?>
                    </div>

                    <div class="name">
                        <?php echo $heading_title; ?>
                    </div>

                    <?php if ($price) { ?>
                        <div class="price">
                        <?php if (!$special) { ?>
                        <?php echo $price; ?>
                        <?php } else { ?>
                        <p class="old-price">&nbsp;&nbsp;<?php echo $price; ?>&nbsp;&nbsp;</p>
                        <p class="new-price"><?php echo $special; ?></p>
                        <?php } ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="znak">+</div>

                <div class="product-related">
                    <div class="image">
                        <?php if($thumb) { ?>
                            <img src="<?php echo $related_product['thumb']; ?>" alt="<?php echo $related_product['name']; ?>" style="max-width: 100%;" />
                        <?php } else { ?>
                            <img src="/image/no_image.jpg" alt="<?php echo $related_product['name']; ?>" style="max-width: 100%;" />
                        <?php } ?>
                    </div>

                    <div class="name">
                        <?php echo $related_product['name']; ?>
                    </div>

                    <?php if ($related_product['price']) { ?>
                        <div class="price">
                        <?php if (!$related_product['special']) { ?>
                        <?php echo $related_product['price']; ?>
                        <?php } else { ?>
                        <p class="old-price">&nbsp;&nbsp;<?php echo $related_product['price']; ?>&nbsp;&nbsp;</p>
                        <p class="new-price"><?php echo $related_product['special']; ?></p>
                        <?php } ?>
                        </div>
                    <?php } ?>
                </div>

                <div class="znak">=</div>

                <div class="buy">
                    <div class="price"><?php echo $complect_price; ?></div>
                    <div class="cart"><a class="button" onclick="addToCartComplect(<?php echo $complect_id; ?>);" href="javascript:void(0)">&nbsp;</a></div>
                </div>

            </div>

        </div>
        <?php }*/ ?>
		
		
        <?php if ($review_status) { ?>
<table>
	<tr>
	<div class="product-descri">
        <h2 id="opisanie">Описание</h2>
        <div itemprop="description">
<!--		<p><?php 
			if ($is_master || empty($pds)){
				echo $heading_title.', цена ';
			} else {
				echo $heading_title.' относится к серии &laquo;<a href="'.$master_link.'">'.$master_info['name'].'</a>&raquo;, цена ';
				//print_r($master_info);
			}
            if (!$special) {
				$priceStr = '';
				if ($is_master) {
					//if(sizeof($pds) <= 0) {} else $priceStr .= 'от ';
				    if(sizeof($pds) > 0) {
						$priceStr .= 'от ';
						$min = 999999;
						foreach ($pds as $p) {
							if (!$p['quantity']) continue;
							$p_all = $this->model_catalog_product->getProduct($p['product_id']);
							if (!$p_all['special']) {
								$min = $p_all['price'] < $min ? $p_all['price']  : $min;
							} else {
								$min = $p_all['special'] < $min ? $p_all['special']  : $min;
							}
						}
						if ($min != 999999) $priceStr .= number_format((float)$min, 2, '.', '').' грн';
					}

				    if(sizeof($pds) <= 0) {
						$priceStr .= $price;
					}
                } else {
					$priceStr .= $price;
				}
				$priceStr = trim($priceStr);
				if (strlen($priceStr) && $priceStr != 'от') echo $priceStr;
					else $quantity = 0;
			} else {
				echo ($is_master ? 'от ' : '') . $special;
				/*?>
					<p class="old-price">&nbsp;&nbsp;<?php echo $price; ?>&nbsp;&nbsp;</p>
					<p temprop="price" class="new-price"><?php if ($is_master) { ?>от <?php } ?><?php echo $special; ?></p>
				<?php */
			} 
			?>
		</p>
-->
		<?php  echo $product_info['product_id']; ?>
		<?php echo $description; ?>
	      <!--start x2_nop-->
        <?php if ($x2_nop) { ?>
        <span><?php echo $heading_title; ?>  <?php echo $text_x2_nop; ?></span> <?php echo $x2_nop; ?> рыбаков<br />
        <?php } ?>
        <!--end x2_nop-->
		
		</div>
	
        <div id="tab-review" class="product-review">
		<h2 id="review-title">Отзывы</h2>		
		<?php
$reviews = $this->model_catalog_review->getReviewsByProductId($product_id); ?>
<?php if ($reviews) { ?>
<?php foreach ($reviews as $review) { ?>
<div class="review-list" itemprop="review" itemscope itemtype="http://schema.org/Review">
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

<?php } else { ?>
<div class="content"><?php echo $text_no_reviews; ?></div>
<?php } ?>
<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
<meta itemprop="bestRating" content="5"/>
<meta itemprop="worstRating" content="1"/>
<meta itemprop="ratingValue" content="<?php echo $review['rating'] ?>">
<meta itemprop="reviewCount" content="<?php echo rand(3, 4); ?>"> 
  </div>		
        </div>
        <?php } ?>
		
        <?php if ($review_status) { ?>
        <div class="product-review" id="add-review">
</br>
            <p>Оставьте отзыв о товаре «<?php echo $heading_title; ?>»</p>
            <div>
                <b>Отзыв</b>
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

  <?php if (!empty($filter_breadcrumbs)){ ?>
  <div itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="breadcrumb breadcrumbBottom">
    <?php
	foreach ($filter_breadcrumbs as $i=> $breadcrumb){
		echo $breadcrumb['separator'];
		echo '<a itemprop="url" href="'.$breadcrumb['href'].'"><span itemprop="title">'.$breadcrumb['text'].'</span></a>';
	}
	?>
  </div>  
  <?php } ?>
  
</div>


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
				if (json['success']) {
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
<?php echo $footer; ?>
