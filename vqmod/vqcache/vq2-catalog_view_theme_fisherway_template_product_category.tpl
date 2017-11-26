<?php
$this->load->model('catalog/product');
$this->load->model('catalog/category');
$this->load->model('tool/image');

require_once DIR_SYSTEM.'library/utf8.php';

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
		} 
				elseif (!empty($filter_ocfilter) && $i+1 == count($breadcrumbs)){ 
			?><a itemprop="url" href="<?php echo $breadcrumb['href']; ?>"><span itemprop="title"><?php echo $breadcrumb['text']; ?> <?php
		}
		elseif ($i+1 == count($breadcrumbs)) { 
			echo $breadcrumb['text'];
		}
	} 
	?>
</div> <div style="clear:both"></div>
<?php echo '<div id="columnLeftContainer">'.$column_left.'</div>'; ?>
<div id="content" class="contentTop">
    <div class="one-line"></div>
    <? if (!empty($seo_h1)){ ?><h1><?php echo $seo_h1; ?></h1><? } ?>

	<?
		$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	?>


    <?php if ($categories && !$products && !strpos($url,'/udilishha')) { ?>
	<?php echo $content_top; ?>
<?php /*
     <div class="product-list">
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
*/ ?>
	
    <?php } ?>
    <?php if ($products) { ?>
    <?php if ($dscr_foot) { ?>
    <?php echo $dscr_foot; ?>
    <?php } ?>
    <div class="product-filter">
        <div class="sort">Выводить по:
            <?php foreach ($sorts as $sorts) { ?>
            <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
            <a rel="nofollow" href="<?php echo $sorts['href']; ?>" class="selected"><?php echo $sorts['text']; ?></a>
            <?php } else { ?>
            <a rel="nofollow" href="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></a>
            <?php } ?>
            <?php } ?>
        </div>
    </div>
    <div class="product-list<? if (!empty($filter_ocfilter)) echo ' filteredList'; ?>">
	<?php 
	$i = 0; 
	$commentsShown = false;
	$nProducts = count($products);
	foreach ($products as $product) {

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
				if ($product['quantity'] > 0){
					$priceStr = $product['special'];
					//if (!empty($price)) $priceStr .= '<p class="old-price">&nbsp;&nbsp;'. $price .'&nbsp;&nbsp;</p>';
					//&& !empty($special) $priceStr .= '<p class="new-price">'.(!empty($is_master) ? 'от ' : ''). $special .'</p>';
				}
			} 
		}
		?>		
		
        <div class="product-item <?=empty($priceStr) ? '' : ' priceOK'?>">
            <div class="product-layout">
                <?php if ($product['thumb']) { ?>
                <div class="image">
<?php echo $product['soldlabel']; ?>
<?php echo $product['newlabel']; ?>
<?php echo $product['popularlabel']; ?>
<?php echo $product['speciallabel']; ?>
<script type="text/javascript">
//product impressions
$(document).ready(function(){
ga('send', 'event', {'eventCategory': 'Category_Product', 'eventAction': 'Impression', 'eventLabel': '<?php echo $product['product_id']; ?>','metric1':'1',  'dimension2': '<?php echo $product['product_id']; ?>'}, {'nonInteraction': 1});
//ga('send', 'event', {'metric1':'1',  'dimension2': '<?php echo $product['product_id']; ?>'}); 
});
</script>			
                    <a  onclick="ga('send', 'event', {'eventCategory': 'Category_Product', 'eventAction': 'Click', 'eventLabel': '<?php echo $product['product_id']; ?>','metric2':'1',  'dimension2': '<?php echo $product['product_id']; ?>'})" href="<?php echo $product['href']; ?>#photo">
                        <?php /*foreach ($results as $result) { ?>
                        <?php if ($result['product_id'] == $product['product_id']) { ?>
       <!--                 <span class="latest-item"></span> -->
                        <?php } ?>
                        <?php }*/ ?>
                        <img src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" />
                    </a>
                </div>
                <?php } ?>
                <div class="name"><a onclick="ga('send', 'event', {'eventCategory': 'Category_Product', 'eventAction': 'Click', 'eventLabel': '<?php echo $product['product_id']; ?>','metric2':'1',  'dimension2': '<?php echo $product['product_id']; ?>'}" href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>

				<? if (!empty($filter_ocfilter)){
					echo '<div class="productDescription">'.utf8::excerpt($product['description'], 200, '&hellip;').'</div>';
				}
				?>

                <?php if ($product['rating']) { ?>
                    <div class="rating" >
                       
                        <img src="catalog/view/theme/fisherway/image/stars-<?php echo round($product['rating']); ?>.png" title="<?php echo round($product['rating'],1); ?> (<?php echo $product['reviews']; ?>)"  alt="<?php echo $product['reviews']; ?>" />
                        <div class="rating-reviews">Отзывов ( <a href="<?php echo $product['href']; ?>#review-title"><?php echo $product['reviews']; ?></a> )</div>
						</div>
                <?php } ?>
                <!--BOF Product Series-->

                <!--EOF Product Series-->
                <div class="description">
					<?php 
					/*if($product['attribute_groups']) { $u = 0; ?>
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
					<?php }*/
					?>
				</div>
			</div>

			<? 
			$priceStr = trim($priceStr);
			if (strlen($priceStr)){
				?>
				<div class="cart c_">
					<?php if(!empty($product['pds'])){?>
						<a class="btn" href="<?php echo $product['href']; ?>">Купить</a> 
					<?php } else { ?>
						<a class="btn" rel="nofollow" onclick="addToCart('<?php echo $product['product_id']; ?>');" href="javascript:void(0)">Купить</a>
					<?php } ?>
				</div>
				<?php if ($product['price']) { ?>
				<div class="price_">
					<?php if ($product['special_percent']) { ?>
						<div class="special-percent" style="display: none;"><?php echo $product['special_percent']; ?>%</div>
					<?php }?>
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
		<?php 
		$i++;
		//if ($i%3 == 0) echo "<p></p>";

		if (!empty($reviews) && !empty($filter_ocfilter) && !$commentsShown && ($i == 12 || $i == $nProducts) && (!isset($_GET['page']) || $_GET['page'] == 1)){
		// $_SERVER['REMOTE_ADDR'] == '37.57.71.114'
			echo '<div class="aggregatedComments"><div class="aggregatedCommentsInner">';
			echo '<h2>'.$seo_h1.'&nbsp;&mdash; лучшие отзывы покупателей</h2>';
			
			foreach($reviews as $r){
				echo '<div class="comment">';
				echo '<a class="title" href="'.$r['href'].'">'.$r['product'].'</a>';
				
				echo '<div class="metadata">';
				echo '<span class="stars">';
				for($j=0;$j<$r['rating'];$j++)echo '<label class="full-label"></label>';
				echo '</span>';
				echo '<span class="stamp">'.date('d.m.Y H:i', strtotime($r['date_added'])).'</span>';
				echo '</div>';
				echo '<p>'.$r['text'].'</p>';
				echo '</div>';
			}
			
			echo '</div></div>';
			$commentsShown = true;
		}
	} 
?>
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
	<div id="disqus_thread"></div>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://fisherway.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

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

            $('.product-list > div.product-item').each(function(index, element) {
                html  = '<div class="product-layout">';

                var image = $(element).find('.image').html();
                if (image != null) {
                    html += '<div class="image">' + image + '</div>';
                }

                var rating = $(element).find('.rating').html();
                if (rating != null) {
                     html += '  <div class="name">' + $(element).find('.name').html() + '</div>';
					 if ($(element).find('.productDescription').size()) html += '  <div class="productDescription">' + $(element).find('.productDescription').html() + '</div>';
                    html += '<div class="rating" >' + rating + '</div>';
                }
                else{
                    html += '  <div class="name">' + $(element).find('.name').html() + '</div>';
					if ($(element).find('.productDescription').size()) html += '  <div class="productDescription">' + $(element).find('.productDescription').html() + '</div>';
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
	html += '<div class="no-stock pds_nostock">Нет в наличии<br /><br /></div>';
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
<!-- REES46 Category Tracking Begin -->
<script type="text/javascript">
  var REES46CurrentCategory = '<?php echo $this->request->get['path']; ?>';
  REES46CurrentCategory = REES46CurrentCategory.split('_').pop();
</script>
<!-- REES46 Category Tracking End -->
<?php echo $footer; ?>
