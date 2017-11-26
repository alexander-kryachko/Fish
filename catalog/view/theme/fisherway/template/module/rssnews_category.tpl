<div class="boxr">
  <div class="box-heading">
  <img src="/catalog/view/theme/fisherway/image/review.png" style="vertical-align:bottom">&nbsp;&nbsp;
  	<?php echo $heading_title; ?>
  </div>
  <div class="box-content">
  <div class="box-category rss">
    <ul>
      <?php 
      if(isset($news['rss']['channel']['item'])){
      foreach($news['rss']['channel']['item'] as $k=>$v){
		//$v['description'] = mb_convert_encoding($v['description'], "utf-8", "windows-1251");
		//$v['title'] = mb_convert_encoding($v['title'], "utf-8", "windows-1251");
		//$v['description'] = iconv('WINDOWS-1251', 'UTF-8', $v['description']);
		//$v['title'] = iconv('WINDOWS-1251', 'UTF-8', $v['title']);
      	if($rsnewsno <= ($k)){
        	break;
        }
      ?>
	  <noindex><div style="font-size:15px; color:#999"><?php echo $v['title'];?></div>
      <div style="font-size:15px; color:#999">&nbsp;<?php echo (is_array($v['description'])) ? "" : $v['description'];?></div></noindex>
      
	<?php }}?>	
    </ul>
    </div>
  </div>
</div>
