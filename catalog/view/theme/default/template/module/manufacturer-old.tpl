 
<div class="box">
  <div class="box-heading"><?php echo $heading_title; ?></div>
  <div class="box-content">
    <div class="box-category mf">
	<?php if ($show_button) { ?>
	<div class="closebuttoncontainer">
		<a class="closebutton" rel="<?php echo $text_hide; ?>"><?php echo $text_showall; ?></a>
	</div>
	<?php } ?>
	
      <ul>
        <?php foreach ($manufactureres as $manufacturer) { ?>
		
		<li>
		<a href="<?php echo $manufacturer['href']; ?>"  <?php echo ($manufacturer['active']) ? 'class="active"' : '' ?> style="width:<?php echo $container_width;?>px">
		<div>
			
			<img width="<?php echo $width;?>" height="<?php echo $height;?>" src="<?php echo $manufacturer['thumb'];?>" alt="<?php echo $manufacturer['name'];?>" value="<?php echo $manufacturer['manufacturer_id'];?>"/>
			
			<br>
			
			<?php echo $manufacturer['name'];?>
			</div>
			</a>
        </li>
        <?php } ?>
      </ul>
	  
	  <div style="clear:both;">  </div>
	  
    </div>
  </div>
</div>

<script type="text/javascript"><!--
$('.closebutton').bind('click', function() {


	txt = $(this).text();
	$(this).text($(this).attr('rel'));	
	$(this).attr('rel', txt);	
	
	$('.box-category.mf > ul > li > a ').toggleClass('vis');

});

//--></script>
<style>

.closebuttoncontainer {
text-align: right;
margin-bottom: 5px;
padding-right: 10px;
}

.closebutton{
text-decoration: none;
border-bottom:dashed 1px;
}
.closebutton:hover{
border-bottom:none;
}

.mf ul {
margin:0;
padding:0;
//text-align: center;
}

.mf ul li {
display:inline;
float:left;

}

.box-category.mf > ul > li:hover div {
border: 1px solid #999;
}

.box-category.mf  > ul > li:hover > a  {
color: #333;
}


.box-category.mf > ul > li > a  {
font-size: 14px;
display:none;
text-align: center;	
text-decoration: none;
line-height: 18px;
color: #276fc8;
}

.box-category.mf  > ul > li > a:hover {
text-decoration: none;
} 

.box-category.mf  > ul > li > a > div {
border: 1px solid #ccc;
text-align: center;
padding: 15px 5px;
margin-bottom: 5px;
margin-right: 5px;
}

.box-category.mf > ul > li > a.active {
display:block;
}
.box-category.mf  > ul > li a.vis {
	display:block;
}
</style>