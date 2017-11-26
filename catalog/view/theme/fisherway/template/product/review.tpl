<?php if ($reviews) { ?>
<?php foreach ($reviews as $review) { ?>
<div class="review-list" itemprop="review" itemscope itemtype="http://schema.org/Review">
<meta itemprop="name" content="<?php echo $heading_title; ?>" >
  <div class="author" itemprop="author"><?php echo $review['author']; ?></div>
  <div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
  <meta itemprop="worstRating" content = "1">
  <meta itemprop="bestRating" content = "5">
  <meta itemprop="ratingValue" content="<?php echo $review['rating'] ?>">
  <meta itemprop="datePublished" content="<?php echo $review['date_added'] ?>">
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
