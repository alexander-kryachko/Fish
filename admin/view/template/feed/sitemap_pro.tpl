<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/feed.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          <tr> 
             <td class="left" colspan="2" ><div id="info"><?php echo $text_time; ?></div></td>
		  <tr> 
			<tr> 
            <td class="left"><?php echo $entry_status; ?></td>
            <td class="left"><select name="sitemap_pro_status">
                <?php if ($sitemap_pro_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
			  
			</tr>
			<tr> 
			
			<td class="left"><?php echo $entry_category_status; ?></td>
            <td class="left"><select name="sitemap_pro_category_status">
                <?php if ($sitemap_pro_category_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>	
			  
			</tr>
			<tr>   
			  
			<td class="left"><?php echo $entry_product_status; ?></td>
            <td class="left"><select name="sitemap_pro_product_status">
                <?php if ($sitemap_pro_product_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
			  
			</tr>
			<tr>  
			  
			<td class="left"><?php echo $entry_manufacturer_status; ?></td>
            <td class="left"><select name="sitemap_pro_manufacturer_status">
                <?php if ($sitemap_pro_manufacturer_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>

			</tr>
			<tr> 
			
			<td class="left"><?php echo $entry_information_status; ?></td>
            <td class="left"><select name="sitemap_pro_information_status">
                <?php if ($sitemap_pro_information_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>		
				
          </tr>
		  
		  <tr>
            <td><?php echo $entry_secure; ?></td>
            <td><input size="60" name="sitemap_pro_secure" value="<?php echo $sitemap_pro_secure; ?>"></td>
          </tr>
		  
		   <tr>
		      <td class="left" colspan="2"><span class="help"><?php echo $help_secure; ?></span></td>
		   </tr>
		   
		   <tr>
             <td class="left"><?php echo $entry_gzip; ?></td>
             <td class="left"><input size="2" name="gzip_level" value="<?php echo $gzip_level; ?>"></td>
           </tr>
		  
		   <tr>
		       <td class="left" colspan="2"><span class="help"><?php echo $help_gzip; ?></span></td>
		   </tr>
		  <!--  Атавизм
		   <tr>
            <td class="left"><?php echo $entry_limit; ?></td>
            <td class="left"><input size="7" name="sitemap_limit" value="<?php echo $sitemap_limit; ?>"></td>
           </tr>
		  -->
		   <tr>
			    <td class="left" colspan="2"><span class="help"><?php echo $help_limit; ?></span></td>
		   </tr>
		   
		   
		   <tr>
			     <td class="left" colspan="2"><button id="generate"><?php echo $text_generate; ?></button></td>
		   </tr>
		   
		   <tr>
			     <td class="left" colspan="2"><span class="help"><?php echo $help_url; ?></span></td>
		   </tr> 
		   
		   <tr>
			     <td class="left" colspan="2"><span class="help"><?php echo $cron_help; ?></span></td>
		   </tr>
		   
		   
		   
        </table>
      
    </div>
  </div>
</div>
<script>


$( "#generate" ).bind( "click", function() {

  $('.warning').remove();   $('.success').remove();  $('#info').text('').addClass('oldpc'); 

	if ($("select[name='sitemap_pro_status']").val() == 0) {
	   
		$('.breadcrumb').after('<div class="warning">' + '<?php echo $error_off; ?>'  + '</div>');}
		
		$("#generate").after('<span class="ajax"><img src="<?php echo $ajax_image; ?>"></span>').hide();	 
									
		$("#generate").hide();  
		
		$(".ajax").show();
		
		  $('#info').append('<div>ZX Spectrum Loading <span class="blink">_</span></div></br>');	
		  
		  d = new Date(); 	start_time = d.getTime();
		
		
		 $('#info').append('<div>***Sitemap start***</div>');	
		 
	
		 
		 pr_start(0, 0, 1000);
			
			
	
		 
		return false;

});




function makefeed(part, ofset, limit){


	
	// $('#info').append('<div> part...'+ part +' ofset...'+ ofset +' limit...'+ limit + '</div>');	
	 
	 pstart_time = new Date().getTime();
		 
    $.ajax({
	  url:  '<?php echo HTTP_CATALOG; ?>index.php?route=feed/sitemap_pro/makeproducts/',
	  type: "POST",
	  data: 'part='+ part + '&limit='+ limit +'&ofset='+ ofset,
	  dataType: "json",
	  success:  function(res) {},
		
	  
	 
	  statusCode:{  404:function(){  alert('Страница не найдена');  }},

	}).done(function(data) {
	
	
		  if (data['message']) {
			 
				pt = (( new Date().getTime() - pstart_time)/ 1000);    
			 
					
				ofset = ofset + limit;
				
								 
				   if (ofset >= 50000) {
						pr_end(part, ofset, limit);
						ofset = 0;	part++;
						pr_start(part, ofset, limit);
					} else {

				 $('#info').append('<div>'+ data['message'] + '...  time: '+ pt +'</div>');	
				 
				 $('#info').append('*');	
				 
				 $('#info').append('<div>' + '|' + part + '|' + ofset + '|' + limit + '...</div>');	
				
				  makefeed(part, ofset, limit);
				  
				  }
				 
			  };
			  
		 if (data['stop']) {
		 
									
		  		    $('#info').append('<div>'+ data['stop'] + '...</div>');	
				
					makebase(part);	
					
					$(".ajax").remove();
		
					$("#generate").show();  

			      pr_end(part, ofset, limit);
			  
			  
				  
		  } ;
		  
	});
	
	
};

function pr_start(part, ofset, limit){



 $.ajax({
	  url:  '<?php echo HTTP_CATALOG; ?>index.php?route=feed/sitemap_pro/startfeed/',
	  type: "POST",
	   data: 'part='+ part + '&limit='+ limit +'&ofset='+ ofset,
	  dataType: "json",
	  }).done(function(data) {
		 makefeed(part, ofset, limit);
		 
		  $('#info').append('<div>' + data["success"] + '</div>');	
		  
	});
	 
}

function pr_end(part, ofset, limit){



 $.ajax({
	  url:  '<?php echo HTTP_CATALOG; ?>index.php?route=feed/sitemap_pro/endfeed/',
	  type: "POST",
	  data: 'part='+ part,
	  dataType: "json",
	  }).done(function(data) {
	  
	   $('#info').append('<div>' + data["success"] + '</div>');	
		  
	});
	 
}

	  
	  

function makebase(parts){

	 $.ajax({
	  url:  '<?php echo HTTP_CATALOG; ?>index.php?route=feed/sitemap_pro/',
	  type: "POST",
	 // async: false,
	  dataType: "json",
	   data: 'parts='+ parts,
	  success:  function(res) {
	     d = (( new Date().getTime() - start_time)/ 1000);    
		 //info = ('<?php echo $text_ajax_success; ?>' + d);
		
		 
		 if (res['message']) {
		 
		  // $('#info').append('<div>'+ res['message'] + '...</div>');
		   
		   	  d = (( new Date().getTime() - start_time)/ 1000);     
			  
			 	
		 $("#generate").show();  
		 $(".ajax").hide();		   
		 
		  $('#info').append('<?php echo $text_ajax_success; ?>' + d);
		 
		 return false;
		 } 
		 
		},
		 
	  statusCode:{  404:function(){  alert('Страница не найдена');  }},

	});
//return false;
};


</script>


<style>
.oldpc{
	background: black;
	color: green;
	padding:10px;
}

.blink {
  -webkit-animation: blink 1s linear infinite;
  animation: blink 1s linear infinite;
}
@-webkit-keyframes blink {
  50% { opacity: 0; }
  100% { opacity: 1; }
}
@keyframes blink {
  50% { opacity: 0; }
  100% { opacity: 1; }
}

</style>

<?php echo $footer; ?>