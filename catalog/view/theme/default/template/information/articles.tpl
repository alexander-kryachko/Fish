<?php echo $header; ?><?php echo $column_left; ?><?php echo $column_right; ?>
  <div id="content"><?php echo $content_top; ?><div id="articles">
	<div class="breadcrumb">
	    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
	    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
	    <?php } ?>
	</div>

   <h1><?php echo $heading_title; ?></h1>
	<?php echo $articles_description; ?>

<div class="box-articles">
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

<?php if ($latest_articles) { ?>
<?php foreach ($latest_articles as $article) { ?>
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

	<?php } else { ?>
		<p><?php echo $text_empty; ?></p>
	<?php } ?>
    </div>    
  </div>
<?php echo $content_bottom; ?></div>

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
//--></script>

<?php echo $footer; ?>