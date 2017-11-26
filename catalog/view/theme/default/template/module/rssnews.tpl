<div class="box">
  <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="box-content">
  <div style="font-size:14px; color:#333 line-height: 22px;">
    <ul style="line-height: 20px;">
      <?php 
      if(isset($news['rss']['channel']['item'])){
      foreach($news['rss']['channel']['item'] as $k=>$v){
      	if($rsnewsno <= ($k)){
        	break;
        }
      ?>
      <li><?php echo $v['title'];?><br />
      <div><?php echo $v['description'];?></div>
      </li>
	<?php }}?>	
    </ul>
    </div>
  </div>
</div>
