<style type="text/css">
#form-image_google<?php echo $product_id; ?> img {
	vertical-align:middle;
}

#form-image_google<?php echo $product_id; ?> select {
	margin:3px;
}

#form-image_google<?php echo $product_id; ?> .be-scrollbox {
	width:100%;
	height:400px;
}

#form-image_google<?php echo $product_id; ?> .be-scrollbox b {
	float:left;
	width:100%;
	background:#000;
	color:#FFF;
	font-weight:bold;
	font-size:10px;
	text-align:center;
	padding:2px 0px 2px 0px;
}

#form-image_google<?php echo $product_id; ?> .be-scrollbox div {
	width:150px;
	height:170px;
	float:left;
	margin:3px;
	border:1px solid #CCC;
	text-align:left;
	overflow:hidden;
	background-color:#FFF;
}

#form-image_google<?php echo $product_id; ?> .be-scrollbox span {
	float:left;
	width:100%;
	margin:3px 0px;
	text-align:center;
}
</style>
<?php if ($product_id) { ?>
<table class="be-form">
 <tr>
  <td width="1%"><img src="<?php echo $product_image; ?>" alt="<?php echo $product_name; ?>" title="<?php echo $product_name; ?>" /></td>
  <td width="99%"><h3><?php echo $product_name; ?></h3></td>
 </tr>
</table>
<?php } ?>
<table class="be-list">
 <tfoot>
  <tr>
   <td class="left" colspan="2">
    <form id="form-image_google-data<?php echo $product_id; ?>">
     <select name="fileType">
      <option value="">&mdash;&nbsp;<?php echo $text_file_type; ?>&nbsp;&mdash;</option>
      <?php foreach ($filter['fileType'] as $value) { ?>
      <option value="<?php echo $value; ?>"><?php echo ucfirst ($value); ?></option>
      <?php } ?>
     </select>
     <select name="imgDominantColor">
      <option value="">&mdash;&nbsp;<?php echo $text_color; ?>&nbsp;&mdash;</option>
      <?php foreach ($filter['imgDominantColor'] as $value) { ?>
      <option value="<?php echo $value; ?>" style="background:<?php echo $value; ?>"><?php echo ucfirst ($value); ?></option>
      <?php } ?>
     </select>
     <select name="imgColorType">
      <option value="">&mdash;&nbsp;<?php echo $text_colorization; ?>&nbsp;&mdash;</option>
      <?php foreach ($filter['imgColorType'] as $value) { ?>
      <option value="<?php echo $value; ?>"><?php echo ucfirst ($value); ?></option>
      <?php } ?>
     </select>
     <select name="imgSize">
      <option value="">&mdash;&nbsp;<?php echo $text_size; ?>&nbsp;&mdash;</option>
      <?php foreach ($filter['imgSize'] as $value) { ?>
      <option value="<?php echo $value; ?>"><?php echo ucfirst ($value); ?></option>
      <?php } ?>
     </select>
     <select name="imgType">
      <option value="">&mdash;&nbsp;<?php echo $text_image_type; ?>&nbsp;&mdash;</option>
      <?php foreach ($filter['imgType'] as $value) { ?>
      <option value="<?php echo $value; ?>"><?php echo ucfirst ($value); ?></option>
      <?php } ?>
     </select>
    </form>
   </td>
  </tr>
  <tr>
   <td class="left" colspan="2"><form id="form-image_google<?php echo $product_id; ?>">
     <p>
      <?php echo $text_folder; ?>: <a onclick="resetFolderImageGoogle('<?php echo $product_id; ?>');"><img src="view/batch_editor/image/reset.png" title="<?php echo $text_reset; ?>" alt="<?php echo $text_reset; ?>" /></a>
      <select name="image_google[directory][main]">
       <?php foreach ($directories as $directory) { ?>
       <option value="<?php echo $directory; ?>"><?php echo $directory; ?></option>
       <?php } ?>
      </select>
      <a onclick="$('#form-image_google<?php echo $product_id; ?> select[name=\'image_google[directory][main]\']').after(' <input name=\'image_google[directory][]\' /> <span class=\'separator\'>/</span> ');"><img src="view/image/add.png" title="<?php echo $text_add; ?>" alt="<?php echo $text_add; ?>" /></a>
      <a onclick="$('#form-image_google<?php echo $product_id; ?> input[name=\'image_google[directory][]\']:last').remove(); $('#form-image_google<?php echo $product_id; ?> span.separator:last').remove();"><img src="view/image/delete.png" title="<?php echo $text_delete; ?>" alt="<?php echo $text_delete; ?>" /></a>
     </p>
     <p>
      <input name="image_google[keyword]" type="text" size="100" maxlength="128" value="<?php echo (isset ($keyword)) ? $keyword : ''; ?>" />
      <a class="button" onclick="searchImageGoogle(<?php echo $product_id; ?>);"><?php echo $text_search; ?></a>
     </p>
     <div class="be-scrollbox">
     </div>
     <div style="text-align:center; margin-top:10px;">
      <?php echo $text_main; ?> (<span class="image_google_count_main">0</span>)
      &nbsp;&nbsp;&nbsp;
      <?php echo $text_additional; ?> (<span class="image_google_count_additional">0</span>)
     </div>
    </form></td>
  </tr>
  <tr>
   <td class="center" colspan="2">
    <a class="button" onclick="editTool(<?php echo $product_id; ?>, 'image_google', 'add');"><?php echo $text_add; ?></a> <a class="button" onclick="resetImageGoogle(<?php echo $product_id; ?>);"><?php echo $text_reset; ?></a>
    <?php if ($product_id) { ?>
    <a class="button" onclick="$('#dialogTool').dialog('close');">&times;</a>
    <?php } ?>
   </td>
  </tr>
 </tfoot>
</table>
<script type="text/javascript"><!--
if (typeof counter == 'undefined') {
	var counter = [];
}
counter[<?php echo $product_id; ?>] = 1;

$(document).ready(function() {
	$('#form-image_google<?php echo $product_id; ?> input[name=\'image_google[keyword]\']').keypress(function(e) {
		if (e.keyCode == 13) {
			searchImageGoogle(<?php echo $product_id; ?>);
			return false;
		}
	}).focus();
	
	$('#form-image_google<?php echo $product_id; ?> input[type=\'checkbox\']').live('click', function() {
		if ($(this).attr('name') == 'image_google[data][main]') {
			$('#form-image_google<?php echo $product_id; ?> input[name=\'image_google[data][main]\']').not(this).removeAttr('checked');
			$(this).parents('div:first').children('input[name=\'image_google[data][]\']').removeAttr('checked');
		} else {
			$(this).parents('div:first').children('input[name=\'image_google[data][main]\']').removeAttr('checked');
		}
		
		$('#form-image_google<?php echo $product_id; ?> .image_google_count_main').html($('#form-image_google<?php echo $product_id; ?> input[name=\'image_google[data][main]\']:checked').length);
		$('#form-image_google<?php echo $product_id; ?> .image_google_count_additional').html($('#form-image_google<?php echo $product_id; ?> input[name=\'image_google[data][]\']:checked').length);
	});
});

if (typeof searchImageGoogle != 'function') {
	function searchImageGoogle(product_id) {
		counter[product_id] = 1;
		
		$('#form-image_google' + product_id + ' .be-scrollbox').html('');
		$('#form-image_google' + product_id + ' .image_google_count_main').html('0');
		$('#form-image_google' + product_id + ' .image_google_count_additional').html('0');
		
		getImageGoogle(product_id);
	}
}

if (typeof resetImageGoogle != 'function') {
	function resetImageGoogle(product_id) {
		$('#form-image_google' + product_id + ' input[type=\'checkbox\']').removeAttr('checked');
		$('#form-image_google' + product_id + ' .image_google_count_main').html('0');
		$('#form-image_google' + product_id + ' .image_google_count_additional').html('0');
	}
}

if (typeof getImageGoogle != 'function') {
	function getImageGoogle(product_id) {
		var html = '';
		var keyword = encodeURIComponent ($('#form-image_google' + product_id + ' input[name=\'image_google[keyword]\']').val());
		
		if (!keyword) {
			return false;
		}
		
		xhr = $.ajax({type:'GET', dataType:'json', data:'q=' + keyword + '&start=' + counter[product_id] + '&num=10&' + $('#form-image_google-data' + product_id).serialize(), url:'index.php?route=batch_editor/tool/getImageGoogle&token=' + token,
			beforeSend: function() { creatOverlayLoad(true); },
			success: function(json){
				if (json['warning']) {
					creatMessage(json);
				} else {
					if (counter[product_id] == 1 && (json['value']).length > 0) {
						$('#form-image_google' + product_id + ' .be-scrollbox').html('<span><a class="button" onclick="getImageGoogle(' + product_id + ');"><?php echo $text_more; ?></a></span>');
					}
					
					$.each(json['value'], function(index, value) {
						html = '<div>';
						html += ' <label><input name="image_google[data][main]" type="checkbox" value="' + value['link'] + '"> <?php echo $text_main; ?></label><br />';
						html += ' <label><input name="image_google[data][]" type="checkbox" value="' + value['link'] + '"> <?php echo $text_additional; ?></label><br />';
						html += ' <b>' + value['width'] + 'x' + value['height'] + '</b>';
						html += ' <a class="colorbox' + product_id + '" href="' + value['link'] + '">';
						html += ' <img src="' + value['thumbnailLink'] + '" alt="" title="" style="max-width:100%; height:auto;">';
						html += ' </a>';
						html += '</div>';
						
						$('#form-image_google' + product_id + ' .be-scrollbox span').before(html);
						$('#form-image_google' + product_id + ' .be-scrollbox').scrollTop(9999);
						$('#form-image_google' + product_id + ' .colorbox' + product_id).colorbox({overlayClose:true, opacity:0.5, rel:'colorbox' + product_id, innerWidth:'80%', innerHeight:'80%'});
					});
					
					counter[product_id] += 10;
					
					if (counter[product_id] >= 51) {
						counter[product_id] = 0;
						
						$('#form-image_google' + product_id + ' .be-scrollbox span').remove();
					}
				}
				
				creatOverlayLoad(false);
			}
		});
	}
}

if (typeof resetFolderImageGoogle != 'function') {
	function resetFolderImageGoogle(product_id) {
		xhr = $.ajax({type:'GET', dataType:'json', url:'index.php?route=batch_editor/tool/getImageDirectories&token=' + token,
			beforeSend: function() { creatOverlayLoad(true); },
			success: function(json) {
				var html = '<select name="image_google[directory][main]">';
				
				$.each(json, function(index, folder) {
					html += '<option value="' + folder + '">' + folder + '</option>';
				});
				
				html += '</select>';
				
				$('#form-image_google' + product_id + ' select[name=\'image_google[directory][main]\']').replaceWith(html);
				
				creatOverlayLoad(false);
			}
		});
	}
}

<?php if (isset ($keyword) && $keyword) { ?>
searchImageGoogle(<?php echo $product_id; ?>);
<?php } ?>
//--></script>
<?php if ($product_id > 0) { ?>
<script type="text/javascript"><!--
$('#dialogTool').dialog({title:'<?php echo $text_image_google; ?>', beforeClose: function(event, ui) { if ($('#colorbox').css('display') == 'block') { return false; }}});
//--></script>
<?php } ?>
