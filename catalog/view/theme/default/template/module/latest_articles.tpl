    <div class="cnt-box">
        <div class="cnt-box-h">
            <div class="h"><?php echo $heading_title; ?></div>
        </div>
        <?php foreach ($articles as $article) { ?>
        <div class="news-item">
            <figure><img src="<?php echo $article['thumb']; ?>" alt="<?php echo $article['name']; ?>" /></figure>
            <div class="description">
                <div class="h"><a href="<?php echo $article['href']; ?>"><?php echo $article['name']; ?></a></div>
                <p><?php echo $article['caption']; ?></p>
            </div>
        </div>
        <?php } ?>
		<div class="all-articles all-articles-news"><a class="button" href="<?php echo $link_all_articles; ?>"><?php echo $text_all_articles; ?></a></div>
    </div>
</div>