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
      <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          <tr>
            <td><?php echo $text_showfieldtime; ?></td>
            <td><?php if ($showfieldtime) { ?>
              <input type="radio" name="callme_setting[showfieldtime]" value="1" checked="checked" />
              <?php echo $text_yes; ?>
              <input type="radio" name="callme_setting[showfieldtime]" value="0" />
              <?php echo $text_no; ?>
			  <?php } else { ?>
              <input type="radio" name="callme_setting[showfieldtime]" value="1" />
              <?php echo $text_yes; ?>
              <input type="radio" name="callme_setting[showfieldtime]" value="0" checked="checked" />
              <?php echo $text_no; ?>
              <?php } ?></td>
              </td>
          </tr>
		  
          <tr>
            <td><?php echo $text_link_page; ?></td>
            <td><?php if ($link_page) { ?>
              <input type="radio" name="callme_setting[link_page]" value="1" checked="checked" />
              <?php echo $text_yes; ?>
              <input type="radio" name="callme_setting[link_page]" value="0" />
              <?php echo $text_no; ?>
              <?php } else { ?>
              <input type="radio" name="callme_setting[link_page]" value="1" />
              <?php echo $text_yes; ?>
              <input type="radio" name="callme_setting[link_page]" value="0" checked="checked" />
              <?php echo $text_no; ?>
              <?php } ?></td>
          </tr>
		  
          <tr>
            <td><?php echo $text_capcha; ?></td>
            <td><?php if ($capcha) { ?>
              <input type="radio" name="callme_setting[capcha]" value="1" checked="checked" />
              <?php echo $text_yes; ?>
              <input type="radio" name="callme_setting[capcha]" value="0" />
              <?php echo $text_no; ?>
              <?php } else { ?>
              <input type="radio" name="callme_setting[capcha]" value="1" />
              <?php echo $text_yes; ?>
              <input type="radio" name="callme_setting[capcha]" value="0" checked="checked" />
              <?php echo $text_no; ?>
              <?php } ?></td>
          </tr>
		  
		   <tr>
            <td><?php echo $text_button_page; ?></td>
            			  
			  <td><?php if ($button_status) { ?>
              <input type="radio" name="callme_setting[button_status]" value="1" checked="checked" />
              <?php echo $text_yes; ?>
              <input type="radio" name="callme_setting[button_status]" value="0" />
              <?php echo $text_no; ?>
              <?php } else { ?>
              <input type="radio" name="callme_setting[button_status]" value="1" />
              <?php echo $text_yes; ?>
              <input type="radio" name="callme_setting[button_status]" value="0" checked="checked" />
              <?php echo $text_no; ?>
              <?php } ?>
			</td>
									
			 <td>
			 <?php echo $text_button_color; ?>
			 
			 <?php if ($button_color) { ?>
			 <select name="callme_setting[button_color]">
				<option value="white"<?php if ($button_color=='white') echo ('selected="selected"');?>><?php echo $text_white; ?></option>
				<option value="green"<?php if ($button_color=='green') echo ('selected="selected"');?>><?php echo $text_green; ?></option>
				<option value="black"<?php if ($button_color=='black') echo ('selected="selected"');?>><?php echo $text_black; ?></option>
				<option value="pink" <?php if ($button_color=='pink') echo ('selected="selected"');?>><?php echo $text_pink; ?></option>
				<option value="blue" <?php if ($button_color=='blue') echo ('selected="selected"');?>><?php echo $text_blue; ?></option>
			 </select>
			 <?php } else { ?>
			 <select name="callme_setting[button_color]">
				<option value="white"><?php echo $text_white; ?></option>
				<option value="green" selected="selected"><?php echo $text_green; ?></option>
				<option value="black"><?php echo $text_black; ?></option>
				<option value="pink"><?php echo $text_pink; ?></option>
				<option value="blue"><?php echo $text_blue; ?></option>
			 </select>			 
              <?php } ?></td>
		  
          </tr>
        </table>

      </form>
    </div>
  </div>
  Callme ver 1.3.1 @ <a href="http://My2You.ru">My2You </a>
</div>

<?php echo $footer; ?>