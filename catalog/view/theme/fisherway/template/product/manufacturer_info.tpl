<?php
$this->load->model('catalog/product');
$this->load->model('catalog/category');
$this->load->model('tool/image');
$this->data['products'] = array();
/*
$data = array(
    'sort'  => 'p.date_added',
    'order' => 'DESC',
    'start' => 0,
    'limit' => 10
    );
$results = $this->model_catalog_product->getProducts($data);
*/
?>
<?php echo $header; ?>
<div id="categoryContainer">

<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb" class="breadcrumb brcat">
<a itemprop="url" href="/"><span itemprop="title">Главная</span></a>
	<?php 
	foreach ($breadcrumbs as $i=> $breadcrumb) { 
		echo $breadcrumb['separator'];
		if($i+1 < count($breadcrumbs)) { 
			?><a itemprop="url" href="<?php echo $breadcrumb['href']; ?>"><span itemprop="title"><?php echo $breadcrumb['text']; ?></span></a><?php 	
		} elseif ($i+1 == count($breadcrumbs)) { 
			echo $breadcrumb['text'];
		}
	} 
	?>
</div> <div style="clear:both"></div>
<?php echo '<div id="columnLeftContainer">'.$column_left.'</div>'; ?>
<div id="content" class="contentTop">
    <div class="one-line"></div>
    <? if (!empty($seo_h1)){ ?><h1><?php echo $seo_h1; ?></h1><? } ?>
    <?php if ($categories && !$products) { ?>
	<?php echo $content_top; ?>
<!--    <div class="product-list">
        <?php if (count($categories) <= 5) { ?>

            <?php foreach ($categories as $category) { ?>
            <div class="product-item priceOK"><div class="product-layout"><div class="image"><a href="<?php echo $category['href']; ?>"><img src="<?php echo $category['thumb']; ?>"></div><div class="name"><?php echo $category['name']; ?></a></div></div></div>
            <?php } ?>

		
		
        <?php } else { ?>
        <?php for ($i = 0; $i < count($categories);) { ?>
        <ul>
            <?php $j = $i + ceil(count($categories) / 4); ?>
            <?php for (; $i < $j; $i++) { ?>
            <?php if (isset($categories[$i])) { ?>
            <li><a href="<?php echo $categories[$i]['href']; ?>"><img src="<?php echo $categories[$i]['thumb']; ?>"><span><?php echo $categories[$i]['name']; ?></span></a></li>
            <?php } ?>
            <?php } ?>
        </ul>
        <?php } ?>
        <?php } ?>
    </div>

-->	
	
    <?php } ?>
    <?php if ($products) { ?>
    <?php if ($dscr_foot) { ?>
    <?php echo $dscr_foot; ?>
    <?php } ?>
  
    <div class="product-list">
        <?php $i = 0; foreach ($products as $product) { ?>
		
		<?
		//echo '<!--';
		//print_r($product);
		//echo '-->';
		$priceStr = '';
		if ($product['price']) {
			if (!$product['special']) {
				if (!empty($product['pds'])) {
					//$priceStr .= 'от ';
					$min = 999999; 
					foreach ($product['pds'] as $p) {
						//$p_all = $this->model_catalog_product->getProduct($p['all']['product_id']);
						if (!$p['all']['quantity']) continue;
						if (!$p['all']['special']) {
							$min = $p['all']['price'] < $min ? $p['all']['price']  : $min;
						} else {
							$min = $p['all']['special'] < $min ? $p['all']['special']  : $min; 
					  }
					}
					if ($min != 999999) $priceStr = number_format((float)$min, 2, '.', '').' <span>грн.</span>';
				} else {
					if ($product['quantity'] > 0) $priceStr = $product['price']; 
					
				}
			} else { 
				$priceStr = $product['special'];
				$priceStr .= '<p class="old-price">&nbsp;&nbsp;'. $price .'&nbsp;&nbsp;</p>';
				$priceStr .= '<p class="new-price">'.($is_master ? 'от ' : ''). $special .'</p>';
				?>
				<?php 
			} 
		}
		?>		
		
        <div class="product-item <?=empty($priceStr) ? '' : ' priceOK'?>">
            <div class="product-layout">
                <?php if ($product['thumb']) { ?>
                <div class="image">
                <div class="product-sticker-category">
                    <?php if ($product['ean']) { ?>
                        <?php if ($product['ean'] == 'top') { ?> 
                        <img src="/catalog/view/theme/fisherway/image/sticker_<?php echo $product['ean']; ?>.png" class="sticker-top"></img>
                        <?php } else { ?>
                        <img src="/catalog/view/theme/fisherway/image/sticker_<?php echo $product['ean']; ?>.png"></img>
                        <?php } ?>
                    <?php } ?>
                </div>				
                    <a rel="nofollow" href="<?php echo $product['href']; ?>#photo">
                        <?php /*foreach ($results as $result) { ?>
                        <?php if ($result['product_id'] == $product['product_id']) { ?>
       <!--                 <span class="latest-item"></span> -->
                        <?php } ?>
                        <?php }*/ ?>
                        <img src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" />
                    </a>
                </div>
                <?php } ?>
                <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
                <?php if ($product['rating']) { ?>
                    <div class="rating" >
                       
                        <img src="/catalog/view/theme/fisherway/image/stars-<?php echo round($product['rating']); ?>.png" title="<?php echo round($product['rating'],1); ?> (<?php echo $product['reviews']; ?>)"  alt="<?php echo $product['reviews']; ?>" />
                        <div class="rating-reviews">Отзывов ( <a href="<?php echo $product['href']; ?>#review-title"><?php echo $product['reviews']; ?></a> )</div>
						</div>
                <?php } ?>
                <!--BOF Product Series-->

                <!--EOF Product Series-->
                <div class="description">
    <?php 
	if($product['attribute_groups']) { $u = 0; ?>
    <?php foreach($product['attribute_groups'][0]['attribute'] as $attribute) { ?>
    <?php if($u < 3) { ?>
    <div class="product-attr">
        <span class="attr-name"><?php echo $attribute['name']; ?></span>
        <span class="attr-value"><?php echo $attribute['text']; ?></span>
        <div style="clear:both;"></div>
    </div>
    <?php } ?>
    <?php $u++; ?>
    <?php } ?>
    <?php }
	?>
</div>
</div>

<? 
$priceStr = trim($priceStr);
if (strlen($priceStr)){
	?>
	<div class="cart c_">
		<?php if(!empty($product['pds'])){?>
			<a class="btn" rel="nofollow" href="<?php echo $product['href']; ?>">Купить</a> 
		<?php } else { ?>
			<a class="btn" rel="nofollow" onclick="addToCart('<?php echo $product['product_id']; ?>');" href="javascript:void(0)">Купить</a>
		<?php } ?>
	</div>
	<?php if ($product['price']) { ?>
	<div class="price_">
		<div>
		<?php echo $priceStr; ?>
		</div>
	</div>
	<?php } ?>
<?php } else {
	//echo $no_stock;
}?>

<div style="clear:both;"></div>
<div class="cart" style="display: none;">
	<?php if($product['is_set']){?>
		<a class="button" href="<?php echo $product['href']; ?>"><?php echo $button_cart; ?></a>
	<?php } else { ?>
		<input type="button" value="<?php echo $button_cart; ?>" onclick="addToCart('<?php echo $product['product_id']; ?>');" class="button" />
	<?php } ?>
</div>
</div>
<?php $i++;/* if ($i%3 == 0) echo "<p></p>";*/} ?>
</div>
<div class="pagination"><?php echo $pagination; ?></div>
<?php } ?>
<?php if ($thumb || $description) { ?>
<div style="clear:both"></div>
<div class="category-info">
<?php if ($description) { ?>
    <?php echo $description; ?>
<?php } ?>
    <?php if ($thumb) { ?>
 
    <?php } ?>
	
    <?php /*if ($dscr_foot) { ?>
    <?php echo $dscr_foot; ?>
    <?php } */ ?>
</div>
<?php } ?>
<?php if (!$categories && !$products) { ?>
<div class="content"><?php echo $text_empty; ?></div>
<?php } ?>
<?php echo $content_bottom; ?></div>


<?php echo '<div id="columnRightContainer">'.$column_right.'</div>'; ?>

</div>

<script type="text/javascript">
    $(function(){
        $(".align_center_to_right").css('top','60px');
		$("body").css('min-width','1210px');
        $("#menu > ul > li > div").css('margin-top','-60px');
    })
</script>
<script type="text/javascript"><!--
    function display(view) {
        if (view == 'list') {
            $('.product-grid').attr('class', 'product-list');

            $('.product-list > div').each(function(index, element) {
                html  = '<div class="product-layout">';

                var image = $(element).find('.image').html();
                if (image != null) {
                    html += '<div class="image">' + image + '</div>';
                }

                var rating = $(element).find('.rating').html();
                if (rating != null) {
                     html += '  <div class="name">' + $(element).find('.name').html() + '</div>';
                    html += '<div class="rating" >' + rating + '</div>';
                }
                else{
                    html += '  <div class="name">' + $(element).find('.name').html() + '</div>';
                }
//BOF Product Series
if($(element).find('.pds').length > 0)
    html += '<div class="pds">' + $(element).find('.pds').html() + '</div>';
//EOF Product Series
html += '  <div class="cart" style="display: none;">' + $(element).find('.cart').html() + '</div>';
html += '</div>';

if ($(element).hasClass('priceOK')){
	var cart = $(element).find('.cart').html();
	if (cart != null) {
		html += '<div class="cart c_">' + cart  + '</div>';
	}

	var price = $(element).find('.price_').html();
	if (price != null) {
		html += '<div class="price_">' + price  + '</div><div style="clear:both;"></div>';
	}
} else {
	html += '<div class="no-stock pds_nostock"><br /><br /></div>';
}



$(element).html(html);

//BOF Product Series
imagePreview();
pdsListRolloever();
//EOF Product Series
});

$('.display').html('<b><?php echo $text_display; ?></b> <?php echo $text_list; ?> <b>/</b> <a onclick="display(\'grid\');"><?php echo $text_grid; ?></a>');

$.totalStorage('display', 'list');
} else {
    $('.product-list').attr('class', 'product-grid');

    $('.product-grid > div').each(function(index, element) {
        html  = '<div class="product-layout">';

        var image = $(element).find('.image').html();
        if (image != null) {
            html += '<div class="image">' + image + '</div>';
        }

        html += '  <div class="name">' + $(element).find('.name').html() + '</div>';

//BOF Product Series
if($(element).find('.pds').length > 0)
    html += '<div class="pds">' + $(element).find('.pds').html() + '</div>';
//EOF Product Series
html += '  <div class="cart" style="display: none;">' + $(element).find('.cart').html() + '</div>';
html += '</div>';

var cart = $(element).find('.cart').html();
if (cart != null) {
    html += '<div class="cart">' + cart  + '</div>';
}

var price = $(element).find('.price').html();
if (price != null) {
    html += '<div class="price">' + price  + '</div><div style="clear:both;"></div>';
}

var rating = $(element).find('.rating').html();
if (rating != null) {
    html += '<div class="rating" >' + rating + '</div>';
}

$(element).html(html);

//BOF Product Series
imagePreview();
pdsListRolloever();
//EOF Product Series
});

$('.display').html('<b><?php echo $text_display; ?></b> <a onclick="display(\'list\');"><?php echo $text_list; ?></a> <b>/</b> <?php echo $text_grid; ?>');

$.totalStorage('display', 'grid');
}
}



$(document).ready(function(){
	view = $.totalStorage('display');
	if (view) {
		display(view);
	} else {
		display('list');
	}
});

//--></script>
<!-- D Remarketing -->
<script type="text/javascript">

$(document).ready(function(){

$('a.button').click(function(){

var product_id = $(this).attr('href') || null;

if ($(this).attr('href') === 'javascript:void(0)'){

product_id = $(this).attr('onclick') || null;

}

var list = $('div.product-list') || null;

if (null!== product_id && null !== list) {

list.find('div.product-item').each(function(){

var self= $(this);

var btn = self.find('a.button') || null;

var url = self.find('div.name a').attr('href') || null;

if (null !==url && null !==btn && product_id === btn.attr('href') || product_id === btn.attr('onclick') ) {

window.GIHhtQfW_AtmUrls = window.GIHhtQfW_AtmUrls || [];

window.GIHhtQfW_AtmUrls.push(url);

window.GIHhtQfW_AtmUrls.push('http://fisherway.com.ua/add-to-cart');

}

});

}

});

});

</script>
<!-- D Remarketing -->
<?php echo $footer; ?>
