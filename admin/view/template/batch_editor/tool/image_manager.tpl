<style type="text/css">
#form-image_manager<?php echo $product_id; ?> input, #form-image_manager<?php echo $product_id; ?> select {
	vertical-align:middle;
}

#form-image_manager<?php echo $product_id; ?> select[name="image_manager[directory][main]"] {
	margin:10px 0px;
}

#form-image_manager<?php echo $product_id; ?> #drop-files {
	border:none;
	padding:15px;
	margin:-5px;
}

#form-image_manager<?php echo $product_id; ?> #upload_button {
	cursor:pointer;
}

#form-image_manager<?php echo $product_id; ?> .be-scrollbox {
	width:100%;
	height:300px;
	margin-top:15px;
}

#form-image_manager<?php echo $product_id; ?> .be-scrollbox div {
	float:left;
	border:1px solid #CCC;
	margin:10px;
	padding:5px;
	background:#FFF;
	min-width:150px;
	text-align:center;
}

#form-image_manager<?php echo $product_id; ?> .be-scrollbox div img {
	margin:0px auto;
	display:block;
	margin-top:3px;
	float:none !important;
}

#form-image_manager<?php echo $product_id; ?> .be-scrollbox div b {
	display:inline-block;
	width:<?php echo $image['width']; ?>px;
	overflow:hidden;
}

#form-image_manager<?php echo $product_id; ?> .be-scrollbox div label {
	display:block;
}

#form-image_manager<?php echo $product_id; ?> .be-scrollbox div input {
	margin-bottom:5px;
}
</style>
<?php if ($product_id) { ?>
<table class="be-form">
 <tr>
  <td width="1%"><img src="<?php echo $product_image; ?>" /></td>
  <td width="99%"><h3><?php echo $product_name; ?></h3></td>
 </tr>
</table>
<?php } ?>
<form id="form-image_manager<?php echo $product_id; ?>">
 <table class="be-list">
  <tfoot>
   <tr>
    <td class="left">
    <?php echo $text_image_name; ?> (<?php echo $text_translit; ?>):
    <label><input name="image_manager[image_name]" type="radio" value="0" checked="checked" /> <em><?php echo $text_original; ?></em></label>
    <label><input name="image_manager[image_name]" type="radio" value="1" /> <em><?php echo $text_product_name; ?></em></label>
    </td>
   </tr>
   <tr>
    <td class="left">
      <?php echo $text_folder; ?>:
      <a onclick="imageManagerResetFolder('<?php echo $product_id; ?>');"><img src="view/batch_editor/image/reset.png" title="<?php echo $text_reset; ?>" alt="<?php echo $text_reset; ?>" /></a>
      <select name="image_manager[directory][main]">
       <?php foreach ($directories as $directory) { ?>
       <option value="<?php echo $directory; ?>"><?php echo $directory; ?></option>
       <?php } ?>
      </select>
      <a onclick="$(this).before(' <input name=\'image_manager[directory][]\' /> <span class=\'separator\'>/</span> ');"><img src="view/image/add.png" title="<?php echo $text_add; ?>" alt="<?php echo $text_add; ?>" /></a>
      <a onclick="$('#form-image_manager<?php echo $product_id; ?> input[name=\'image_manager[directory][]\']:last').remove(); $('#form-image_manager<?php echo $product_id; ?> span.separator:last').remove();"><img src="view/image/delete.png" title="<?php echo $text_delete; ?>" alt="<?php echo $text_delete; ?>" /></a>
    </td>
   </tr>
   <tr>
    <td class="center">
     <div id="drop-files" ondragover="return false">
      <div class="notice"><?php echo $text_drag_image; ?> <input id="upload_button" type="file" multiple="multiple" /></div>
      <div class="be-scrollbox"></div>
     </div>
    </td>
   </tr>
   <tr>
    <td class="center">
     <a class="button" onclick="imageManagerUpload('<?php echo $product_id; ?>');"><?php echo $text_load; ?></a>
     <a class="button" onclick="imageManagerResetForm('<?php echo $product_id; ?>');"><?php echo $text_reset; ?></a>
     <?php if ($product_id > 0) { ?>
     <a class="button" onclick="$('#dialogTool').dialog('close');" title="<?php echo $text_close; ?>">&times;</a>
     <?php } ?>
    </td>
   </tr>
  </tfoot>
 </table>
</form>
<script type="text/javascript"><!--
var image_manager_array = [];

$(document).ready(function() {
	$('#form-image_manager<?php echo $product_id; ?> #drop-files').on('drop', function(e) {
		var files = e.dataTransfer.files
		
		imageManagerView('<?php echo $product_id; ?>', files);
	});
	
	$('#form-image_manager<?php echo $product_id; ?>').delegate('#upload_button', 'change', function(e) {
		var files = $(this)[0].files;
		
		imageManagerView('<?php echo $product_id; ?>', files);
		
		$(this).replaceWith('<input id="upload_button" type="file" multiple="multiple" />');
	});
	
	$('#form-image_manager<?php echo $product_id; ?> .be-scrollbox').on('click', 'a', function() {
		var index = parseInt ($(this).attr('data-index'));
		
		image_manager_array.splice(index, 1);
		
		$('#form-image_manager<?php echo $product_id; ?> .be-scrollbox > div').remove();
		
		imageManagerAdd('<?php echo $product_id; ?>', -1);
	});
	
	$('#form-image_manager<?php echo $product_id; ?> #drop-files').on('dragenter', function() {
		$(this).css({'box-shadow':'inset 0px 0px 20px #CCC'});
		
		return false;
	});
	
	$('#form-image_manager<?php echo $product_id; ?> #drop-files').on('drop', function() {
		$(this).css({'box-shadow':'none'});
		
		return false;
	});
});

function imageManagerView(product_id, files) {
	$.each(files, function(index, file) {
		if (files[index].type.match('image.*')) {
			var fileReader = new FileReader();
			
			fileReader.onload = (function(file) {
				return function(e) {
					image_manager_array.push({name:file.name, data:this.result});
					imageManagerAdd(product_id, (image_manager_array.length - 1));
				};
			})(files[index]);
			
			fileReader.readAsDataURL(file);
		}
	});
	
	return false;
}

function imageManagerAdd(product_id, index) {
	if (index < 0) {
		start = 0;
		end = image_manager_array.length;
	} else {
		start = index;
		end = index + 1;
	}
	
	for (i = start; i < end; i++) {
		var html = '';
		
		html += '<div>';
		html += ' <label><input type="radio" name="main" /> <?php echo $text_main; ?></label>';
		html += ' <input type="text" name="sort_order" size="2" /> <?php echo $text_sort_order; ?>';
		html += ' <img src="' + image_manager_array[i].data + '" width="<?php echo $image["width"]; ?>" height="<?php echo $image["height"]; ?>" title="' + image_manager_array[i].name + '" />';
		html += ' <b>' + image_manager_array[i].name + '</b>';
		html += ' <a data-index="' + i + '"><img src="view/image/delete.png" alt="<?php echo $text_delete; ?>" title="<?php echo $text_delete; ?>" /></a>';
		html += '</div>';
		
		$('#form-image_manager' + product_id + ' .be-scrollbox').append(html);
	}
	
	return false;
}

function imageManagerUpload(product_id) {
	if (image_manager_array.length) {
		var directory = '';
		var warning = '';
		
		var form = $('#form-image_manager' + product_id);
		
		form.find('[name^=\'image_manager[directory]\']').each(function(index, element) {
			directory += '&' + $(element).attr('name') + '=' + $(element).val();
		});
		
		var image_name = '&image_manager[image_name]=' + form.find('input[name=\'image_manager[image_name]\']:checked').val();
		
		$.each(image_manager_array, function(index, file) {
			var parent = form.find('.be-scrollbox a[data-index=\'' + index + '\']').parent('div');
			
			var sort_order = parent.find('input[name=\'sort_order\']').val();
			
			var main = parent.find('input[name=\'main\']').prop('checked');
			
			if (main) {
				var i = 'main';
			} else {
				var i = index;
			}
			
			var data = 'tool=image_manager&selected[]=' + product_id + '&image_manager[image][' + i + '][name]=' + image_manager_array[index].name + '&image_manager[image][' + i + '][data]=' + image_manager_array[index].data + '&image_manager[image][' + i + '][sort_order]=' + sort_order + directory + image_name;
			
			xhr = $.ajax({type:'POST', dataType:'json', data:data, url:'index.php?route=batch_editor/tool/editTool&token=' + token, async:false,
				beforeSend: function() { creatOverlayLoad(true); },
				success: function(json) {
					if (json['success']) {
						form.find('.be-scrollbox a[data-index=\'' + index + '\']').parent('div').css({'border':'1px solid green'});
					} else {
						form.find('.be-scrollbox a[data-index=\'' + index + '\']').parent('div').css({'border':'1px solid red'});
						
						warning = json['warning'];
					}
					
					creatOverlayLoad(false);
				}
			});
		});
		
		getProductData(product_id, 'image');
		getProductCount(product_id, 'image');
		getProductDateModified(product_id);
		
		if (warning) {
			creatMessage({'warning':warning});
		} else {
			creatMessage({'success':'<?php echo $text_success_upload; ?>'});
		}
	} else {
		creatMessage({'warning':'<?php echo $text_error_image; ?>'});
	}
}

function imageManagerResetForm(product_id) {
	image_manager_array.length = 0;
	
	$('#form-image_manager' + product_id + ' .be-scrollbox > div').remove();
}

function imageManagerResetFolder(product_id) {
	xhr = $.ajax({type:'GET', dataType:'json', url:'index.php?route=batch_editor/tool/getImageDirectories&token=' + token,
		beforeSend: function() { creatOverlayLoad(true); },
		success: function(json) {
			var html = '<select name="image_manager[directory][main]">';
			
			$.each(json, function(index, folder) {
				html += '<option value="' + folder + '">' + folder + '</option>';
			});
			
			html += '</select>';
			
			$('#form-image_manager' + product_id + ' select[name=\'image_manager[directory][main]\']').replaceWith(html);
			
			creatOverlayLoad(false);
		}
	});
}
//--></script>

<?php if ($product_id > 0) { ?>
<script type="text/javascript"><!--
$('#dialogTool').dialog({title:'<?php echo $text_image_manager; ?>', beforeClose: function(event, ui) { image_manager_array.length = 0; }});
//--></script>
<?php } ?>