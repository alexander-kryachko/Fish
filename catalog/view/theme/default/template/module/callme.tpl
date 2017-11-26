 <!DOCTYPE html>
<html dir="ltr" lang="ru">
<head>
<meta charset="UTF-8" />
</head>
  
    
  <style type="text/css">
  body  {
  font-family: Arial, Sans-Serif;
  font-size: 13px;
  background-color: #F8F8F8;/*цвет фона*/
  padding: 10px;
  text-align: center;
  margin:0;
   }
   
  form {padding:0;margin:0;}
  h3 {font-size:14px; }
  input, textarea {
  background-color: #F6F6F6;
  border: solid 1px #787878;
  display: inline;
  margin-bottom:10px;
  width: 217px;
  text-align: center;
  	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	-khtml-border-radius: 3px;
	border-radius: 3px;
  }
  input[name="time1"],input[name="time2"]{width: 98px; display:inline; }
  textarea {padding-top:5px; height: 45px;}
  input[type="checkbox"]{width: 15px; height:15px; display:inline; }
  input {line-height:20px; height:25px;}
  .buttons input {height:30px;}
  .buttons input:hover {border: solid 1px #33677F; background-color:#E6E6E6;}
  .activeField { background-color: #ffffff;  border: solid 1px #2390C1; }
  .idle  {  border: solid 1px #787878;  background-color:#FFFFFF;  }
  .error {color:#FF0000;}
   span.success{ font-size:16px;   text-align:center;  color:#18650E;  display:block;  }
</style>


  <body>
  
  <h3><?php echo $heading_title; ?></h3>
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
       
    
    <?php echo $entry_name; ?>
	<?php if ($error_name) { ?>
    <span class="error"><?php echo $error_name; ?></span>
    <?php } ?>	<br />
    <input type="text" name="name" class="idle" value="<?php echo $name; ?>" onblur="this.className='idle'" onfocus="this.className='activeField'"/>
     	 
    <?php echo $entry_tel; ?>
    <?php if ($error_tel) { ?>
    <span class="error"><?php echo $error_tel; ?></span>
    <?php } ?>	
	<br />
    <input type="text" name="tel" class="idle" value="<?php echo $tel; ?>" onblur="this.className='idle'" onfocus="this.className='activeField'" />
	
	<?php if ($callme_setting['showfieldtime']==1) { ?>
	<?php echo $entry_time; ?>
	<br />
    <input type="text" name="time1" class="idle" value="<?php echo $time1; ?>" onblur="this.className='idle'" onfocus="this.className='activeField'" /> --
	<input type="text" name="time2" class="idle" value="<?php echo $time2; ?>" onblur="this.className='idle'" onfocus="this.className='activeField'" />
	<?php } ?>
	
	<?php echo $entry_enquiry; ?><br />
    <textarea name="enquiry" cols="20" rows="2" class="idle" onblur="this.className='idle'" onfocus="this.className='activeField'" ><?php echo $enquiry; ?> </textarea>
    <br />
		
	<input type="hidden" name="link_page" value="<?php echo $_SERVER['HTTP_REFERER'] ?>" />
		 
	<?php if (isset($success)) { ?>
    <span class="success"><?php echo $success; ?></span>
   <?php } else { ?>
	 
	<?php if ($callme_setting['capcha']==1) { ?>
    <div class="ihomos">
	<?php if ($error_capcha) { ?>
    <span class="error"><?php echo $error_capcha; ?></span>
    <?php } ?>	<br />
	<?php echo $qs; ?> <BR />
    <?php echo $no; ?>:<input type="checkbox" name="irobot_no" value="0" checked="checked" />
	<?php echo $yes; ?>:<input type="checkbox" name="irobot_yes" value="1"  />
    </div>
	<?php } ?>	
	<div class="buttons">
      <input type="submit" value="<?php echo $button_send; ?>" />
    </div>
	 <?php } ?>
	 
  </form>
  
  </body>
  </html>
