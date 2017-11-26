<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
<div id="content">
   <?php echo $content_top; ?>
   <div class="breadcrumb">
      <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
      <?php } ?>
   </div>
   <?php if (iconv_strlen($description,'UTF-8') > 10) { ?>
   <div class="articles-info">
      
      <h1><?php echo $heading_title; ?></h1>
      <?php if ($description) { ?>
      <?php echo $description; ?>
      <?php } ?>
      <?php if (!$articles) { ?>
      <div class="article-add-info">
         <div>
            <?php if ($show_date) { ?>
            <span class="article-date"><?php echo $date; ?></span>
            <?php } ?>
            <?php if ($show_views) { ?>
            <span class="article-viewed"><?php echo $viewed; ?></span>
            <?php } ?>
         </div>
         <?php if ($social) { ?>
         <div class="article-share"><?php echo $social; ?></div>
         <?php } ?>
      </div>
      <?php } ?>
      <?php if ($products) { ?>
      <div class="product-grid product-related">
         <h2><?php echo $text_related; ?></h2>
         <div class="product-related-list">
            <?php foreach ($products as $product) { 
            ?>

            <div class="item-card">
                <?php if ($product['thumb']) { ?>

                <figure>

                    <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" /></a>
                                              <?php if ($product['special']) { ?><span class="sticker sticker-red">SALE %</span><?php } ?>
                                            </figure>
                                            <?php } ?>
                    <div class="item-h">
	                  <a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
    	            </div>

                <div class="item-card-footer">
                		<?php if (!$product['special']) { ?>
                		<span class="price"><?php echo $product['price']; ?></span>
                		<?php } else { ?>
	                		<span class="price price-old"><?php echo $product['price']; ?></span>
	                		<span class="price"><?php echo $product['special']; ?></span>
                		<?php } ?>

                		<?php if ($product['rating']) { ?>
                		<div class="rating"><img src="catalog/view/theme/default/image/stars-<?php echo $product['rating']; ?>.png" alt="<?php echo $product['reviews']; ?>" /></div>
                		<?php } ?>

                    <div class="cart btn-place">
                      <?
                        //print_r($product);
                      ?>
                      <?if($product["quantity"]>0){
                      ?>
                        <?if($product["is_master"]!=1){?>
                          <input type="button" value="Купить" onclick="addToCart('<?php echo $product['product_id']; ?>');"  class="btn btn-red btn-small">
                        <?} else {?>
                          <a href="<?php echo $product['href']; ?>"  class="btn btn-red btn-small" style="display: inline-block;">Выбрать модель</a>
                        <?}?>
                      <?} else {?>
                        <div class="order-later">
                        <span>Нет на складе</span>
                        <a href="<?php echo $product['href']; ?>"  class="btn btn-red btn-small">заказать</a>
                        </div>
                      <?}?>
                    </div>
                </div>
            </div>
            <?php } ?>
         </div>
      </div>
      <?php } ?>
   </div>
   <?php } else { ?>
   <div class="articles-info">
      <h1><?php echo $heading_title; ?></h1>
   </div>
   <?php } ?>
   <?php if ($articles) { ?>
   <?php foreach ($articles as $article) { ?>
   <?php if ($article['children']) { ?>
   <div class="art_category">
      <div>
         <?php if ($article['thumb_category']) { ?>
         <div class="article-image"><a href="<?php echo $article['href']; ?>"><img src="<?php echo $article['thumb_category']; ?>" title="<?php echo $article['name']; ?>" alt="<?php echo $article['name']; ?>" /></a></div>
         <?php } ?>
         <div class="name"><a href="<?php echo $article['href']; ?>"><?php echo $article['name']; ?></a></div>
      </div>
   </div>
   <?php } ?>
   <?php } ?>
   <?php foreach ($articles_list as $article) { ?>
   <div class="articles-list">
      <div>
         <?php if ($article['thumb']) { ?>
         <div class="article-image"><a <?php echo ($article['external']) ? 'class="external" id="img_' . $article["article_id"] .'"' : ''; ?> href="<?php echo $article['href']; ?>"><img src="<?php echo $article['thumb']; ?>" title="<?php echo $article['name']; ?>" alt="<?php echo $article['name']; ?>" /></a></div>
         <?php } ?>
         <div class="description">
            <div class="name"><a <?php echo ($article['external']) ? 'class="external" id="link_' . $article["article_id"] .'"' : ''; ?> href="<?php echo $article['href']; ?>"><?php echo $article['name']; ?></a></div>
            <?php echo $article['description']; ?>
            <div class="add-info">
               <?php if ($show_date) { ?>
               <span class="article-date"><?php echo $article['date']; ?></span>
               <?php } ?>
               <?php if ($show_views) { ?>
               <span class="article-viewed"><?php echo $article['viewed']; ?></span>
               <?php } ?>
               <?php if ($article['description'] && $show_readmore) { ?>
               <a <?php echo ($article['external']) ? 'class="art-readmore external" id="more_' . $article["article_id"] .'"' : 'class="art-readmore"'; ?> href="<?php echo $article['href']; ?>"><?php echo $text_readmore; ?></a>
               <?php } ?>
            </div>
         </div>
      </div>
   </div>
   <?php } ?>
   <div class="pagination"><?php echo $pagination; ?></div>
   <?php } ?>
   <?php if ($continue) { ?>
   <div class="buttons">
      <div class="right"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_continue; ?></a></div>
   </div>
   <?php } ?>
   <?php echo $content_bottom; ?>
</div>
<script type="text/javascript"><!--
   $('.external').click(function(){
   	var id = this.id.replace(/[^0-9]/g, '');
   	$.ajax({
   		url: 'index.php?route=information/article/updateViewed',
   		type: 'post',
   		data: 'article_id=' + id,
   		dataType: 'html'	
   	});
   });
   //-->
</script>
<?php echo $footer; ?>