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
  <?php if ($success) { ?>
  <div class="success"><?php echo $success; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/backup.png" alt="" /> <?php echo $heading_title; ?></h1>
    </div>
    </br>
           <tr> 
        		<div class="buttons" style="display: inline; margin-left: 400px;"><a onclick="upload();" style="width:100px;text-align:center;" class="button"><span><?php echo $button_import; ?></span></a></div>
					</tr>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="upform">
        <table class="form">

          <tr>
            <td colspan="2"><?php echo $entry_description; ?></td>
          </tr>
          <tr>
            <td width="25%"><?php echo $entry_restore; ?></td>
            <td><input type="file" name="upload" id="upload" /></td>
          </tr>
        </table>
      </form>
      <form action="<?php echo $export; ?>" method="post" id="dwform">
        <table class="form">
	        <tr>   
	        	<div class="buttons" style="display: inline; margin-left: 400px;"><a onclick="pexport()" style="width:100px;text-align:center;" class="button"><span><?php echo $button_export; ?></span></a></div>
					</tr>
          <tr>
            <td><?php echo $entry_exportway_sel; ?></td>
            <td><input type="radio" name="exportway" value="pid"><?php echo $button_export_pid; ?> &nbsp;&nbsp;
            <input type="radio" name="exportway" value="page"><?php echo $button_export_page; ?></td>
          </tr>
          <tr>
            <td width="25%"><span class="pid"><?php echo $entry_start_id; ?></span><span class="page"><?php echo $entry_start_index; ?></span></td>
            <td><input type="text" name="min" /></td>
          </tr>
          <tr>
            <td width="25%"><span class="pid"><?php echo $entry_end_id; ?></span><span class="page"><?php echo $entry_end_index; ?></span></td>
            <td><input type="text" name="max" /></td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
$("input[value=pid]").attr("checked",true)
$(".page").hide();
$(".pid").show();

$(function() {
    $("input[value=page]").click(function() {
    		$(".pid").hide();
        $(".page").show(0);
    });
    $("input[value=pid]").click(function() {
        $(".page").hide();
    		$(".pid").show();
    });
});

function checkFileSize(id) {
	// See also http://stackoverflow.com/questions/3717793/javascript-file-upload-size-validation for details
	var input, file, file_size;

	if (!window.FileReader) {
		// The file API isn't yet supported on user's browser
		return true;
	}

	input = document.getElementById(id);
	if (!input) {
		// couldn't find the file input element
		return true;
	}
	else if (!input.files) {
		// browser doesn't seem to support the `files` property of file inputs
		return true;
	}
	else if (!input.files[0]) {
		// no file has been selected for the upload
		alert( "<?php echo $error_select_file; ?>" );
		return false;
	}
	else {
		file = input.files[0];
		file_size = file.size;
		<?php if (!empty($post_max_size)) { ?>
		// check against PHP's post_max_size
		post_max_size = <?php echo $post_max_size; ?>;
		if (file_size > post_max_size) {
			alert( "<?php echo $error_post_max_size; ?>" );
			return false;
		}
		<?php } ?>
		<?php if (!empty($upload_max_filesize)) { ?>
		// check against PHP's upload_max_filesize
		upload_max_filesize = <?php echo $upload_max_filesize; ?>;
		if (file_size > upload_max_filesize) {
			alert( "<?php echo $error_upload_max_filesize; ?>" );
			return false;
		}
		<?php } ?>
		return true;
	}
}

function upload() {
	if (checkFileSize('upload')) {
		$('#upform').submit();
	}
}

function isNumber(txt){ 
	var regExp=/^[\d]{1,}$/;//至少一位 
	return regExp.test(txt); 
}
function validateDwForm(id) {
	var val = $("input[name=exportway]:checked").val();
	var min = $("input[name=min]").attr("value");
	var max = $("input[name=max]").attr("value");
	
	if(!isNumber(min) || !isNumber(max)) {
		alert("<?php echo $error_param_not_number; ?>");
		return false;
	}
	var batchNo = parseInt(<?php echo($count_product-1) ?>/parseInt(min))+1; //产品最大分批数，即：产品数/min，然后向上取整（即取整加1）
	var minProductId = parseInt(<?php echo($min_product_id) ?>);
	var maxProductId = parseInt(<?php echo($max_product_id) ?>);
	if(val == "page") {  //此时min为分批大小，max为导出第几批。
		if(parseInt(max) > batchNo) {        
			alert("<?php echo $error_page_no_data; ?>"); 
			return false;
		} else {
			$("input[name=max]").attr("value",parseInt(max)+1);  //此处加1后，提交form在其后，故提交的form大了个1，在后续处理时需减去1
		}
	} else {
		if(parseInt(min) > maxProductId || parseInt(max) < minProductId || parseInt(min) > parseInt(max)) {  
			alert("<?php echo $error_pid_no_data; ?>"); 
			return false;
		}
	}
	
	return true;
}

function pexport() {
	if (validateDwForm('dwform')) {
		$('#dwform').submit();
		
	}
}
//--></script>
<?php echo $footer; ?>