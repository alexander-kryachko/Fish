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
<a itemprop="url" href="/"></a>
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
    <div class="product-filter">
        <div class="sort">Выводить по:
            <select id="product-filter-view">
            <?php foreach ($sorts as $sorts) { ?>
            <?php if ($sorts['value'] == $sort . '-' . $order) { ?>
            <option value="<?php echo $sorts['href']; ?>" selected="selected"><?php echo $sorts['text']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $sorts['href']; ?>"><?php echo $sorts['text']; ?></option>
            <?php } ?>
            <?php } ?>
            </select>
        </div>
    </div>
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
				$priceStr .= '';
				$priceStr .= '';
				?>
				<?php 
			} 
		}
		?>		
		
        <div class="product-item">
            <div class="product-layout">
                <?php if ($product['thumb']) { ?>
                <div class="image">		
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
</div>

<? 
$priceStr = trim($priceStr);
if (strlen($priceStr)){
	if ($priceStr != $product['price']){
		?><div style="display: block;" class="special-oldprice" ><?php echo $product['price']; ?></div><?php 
	}
	if ($product['price']) { ?>
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
