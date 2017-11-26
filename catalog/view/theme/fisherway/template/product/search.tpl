<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content"><?php echo $content_top; ?>
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php //$products = array_unique($products,SORT_REGULAR); //asort($products);?>
  <h1><?php echo $text_search; ?>:</h1>
 
  <?php if ($products) { ?>

  <div class="product-list">
    <?php foreach ($products as $product) { ?>
    <div class="searchcell">
      <?php if ($product['thumb']) { ?>
      <div><a href="<?php echo $product['href']; ?>"><img class="searchimg" src="<?php echo $product['thumb']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
      <?php } else { ?>
	  <div class="image"><a href="<?php echo $product['href']; ?>"><img class="searchimg" src="/image/cache/no-image-318x310.jpg" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name']; ?>" /></a></div>
	  <?php } ?>
	
	  <div class="searchinfo">
	  <?php 
		$search_words = explode(" ", $_GET["search"]);
		foreach ($search_words as $i=>$keyword) {
		$product['name'] = str_ireplace($keyword, '<span class="highlight-class">'.strtoupper($keyword).'</span>' ,$product['name']);
		$product['decription'] = str_ireplace($keyword, '<span class="highlight-class">'.strtoupper($keyword).'</span>' ,$product['description']);
		}
		?>

      <div class="name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a></div>
	   <div class="price">
        <?php if (!$product['special']) { ?>
	
        <?php echo $product['price']; ?>
        <?php } else { ?>
			<? if ((float)str_replace(',', '', $product['price']) != (float)str_replace(',', '', $product['special'])){ ?>
				<span class="price-old"><?php echo $product['price']; ?></span><br/>
			<? } ?>
			<span class="price-new"><?php echo $product['special']; ?></span>
        <?php } ?>
		     <?php if ($product['quantity'] != 0) { ?>
       <div class="search-stock">в наличии</div>
     <?php } else { ?>
       <div class="search-nostock">Нет в наличии</div>
     <?php } ?> 
	  		 <?php if ($product['rating']) { ?>
      <div class="rating-search"><img width="100px" src="/catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
	   <?php } ?>
      </div>

      <div class="attributes">
     
     <?php if($product['attribute_groups']) { ?>
        
    <?php foreach($product['attribute_groups'] as $attribute_group) { ?>
      <?php foreach($attribute_group['attribute'] as $attribute) { ?>
      <span class="attribute_name"><?php echo $attribute['name']; ?>:</span>
      <span class="attribute_text"><?php echo $attribute['text']; ?> | </span>
      <?php } ?>
        <?php } ?>
     
    <?php } ?>
     
     </div>
	  <div class="search-description">
	  <?php echo $product['description']; ?>
	  </div>
	  	  <div class="search-description">
	  <b>Код товара: <?php echo ltrim($product['sku'],'0'); ?></b>
	  </div>
      </div>
    </div>
	<hr style="width: 100%; height: 12px; background: #fff; border: none;">
    <?php } ?>
  </div>
  <div class="pagination"><?php echo $pagination; ?></div>
  <?php } else { ?>
  <div class="content"><?php echo $text_empty; ?></div>
  <?php }?>
  <?php echo $content_bottom; ?></div>
<script type="text/javascript">
var google_tag_params = {
ecomm_prodid: "", 
ecomm_pagetype: "searchresults",
ecomm_totalvalue: ""
};
</script>
<?php echo $footer; ?>