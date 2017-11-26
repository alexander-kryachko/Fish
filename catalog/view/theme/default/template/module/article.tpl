<div class="box">
  <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="box-content">
    <div class="box-category">
      <ul class="box-category <?php echo $position; ?>">
        <?php foreach ($articles as $article) { ?>
        <li>
          <?php if ($article['article_id'] == $article_id) { ?>
          <a href="<?php echo $article['href']; ?>" class="active"><?php echo $article['name']; ?></a>
          <?php } else { ?>
          <a href="<?php echo $article['href']; ?>"><?php echo $article['name']; ?></a>
          <?php } ?>
          <?php if ($article['children']) { ?>
          <ul>
            <?php foreach ($article['children'] as $child) { ?>
            <li>
              <?php if ($child['article_id'] == $child_id) { ?>
              <a href="<?php echo $child['href']; ?>" class="active"><?php echo $child['name']; ?></a>
              <?php } else { ?>
              <a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a>
              <?php } ?>
            </li>
            <?php } ?>
          </ul>
          <?php } ?>
        </li>       
	<?php } ?>
      </ul>
    </div>
  </div>
</div>