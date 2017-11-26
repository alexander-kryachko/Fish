<style type="text/css">
#form-image_bing<?php echo $product_id; ?> img {
	vertical-align:middle;
}

#form-image_bing<?php echo $product_id; ?> select {
	margin:3px;
}

#form-image_bing<?php echo $product_id; ?> .be-scrollbox {
	width:100%;
	height:400px;
}

#form-image_bing<?php echo $product_id; ?> .be-scrollbox b {
	float:left;
	width:100%;
	background:#000;
	color:#FFF;
	font-weight:bold;
	font-size:10px;
	text-align:center;
	padding:2px 0px 2px 0px;
}

#form-image_bing<?php echo $product_id; ?> .be-scrollbox div {
	width:150px;
	height:170px;
	float:left;
	margin:3px;
	border:1px solid #CCC;
	text-align:left;
	overflow:hidden;
	background-color:#FFF;
}

#form-image_bing<?php echo $product_id; ?> .be-scrollbox span {
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
    <form id="form-image_bing-data<?php echo $product_id; ?>">
     <select name="color">
      <option value="">&mdash;&nbsp;<?php echo $text_color; ?>&nbsp;&mdash;</option>
      <option style="background:linear-gradient(to right, #999, #FFF)" value="Monochrome">Monochrome</option>
      <?php foreach ($filter['color'] as $value) { ?>
      <option style="background:<?php echo $value; ?>;" value="<?php echo $value; ?>"><?php echo $value; ?></option>
      <?php } ?>
     </select>
     <select name="size">
      <option value="">&mdash;&nbsp;<?php echo $text_size; ?>&nbsp;&mdash;</option>
      <?php foreach ($filter['size'] as $value) { ?>
      <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
      <?php } ?>
     </select>
     <select name="imageType">
      <option value="">&mdash;&nbsp;<?php echo $text_image_type; ?>&nbsp;&mdash;</option>
      <?php foreach ($filter['imageType'] as $value) { ?>
      <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
      <?php } ?>
     </select>
     <select name="imageContent">
      <option value="">&mdash;&nbsp;<?php echo $text_image_content; ?>&nbsp;&mdash;</option>
      <?php foreach ($filter['imageContent'] as $value) { ?>
      <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
      <?php } ?>
     </select>
     <select name="aspect">
      <option value="">&mdash;&nbsp;<?php echo $text_aspect; ?>&nbsp;&mdash;</option>
      <?php foreach ($filter['aspect'] as $value) { ?>
      <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
      <?php } ?>
     </select>
     <select name="freshness">
      <option value="">&mdash;&nbsp;<?php echo $text_freshness; ?>&nbsp;&mdash;</option>
      <?php foreach ($filter['freshness'] as $value) { ?>
      <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
      <?php } ?>
     </select>
     <select name="license">
      <option value="">&mdash;&nbsp;<?php echo $text_license; ?>&nbsp;&mdash;</option>
      <?php foreach ($filter['license'] as $value) { ?>
      <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
      <?php } ?>
     </select>
     <input type="text" name="width" size="8" placeholder="<?php echo $text_width; ?>" /> &times; <input type="text" name="height" size="8" placeholder="<?php echo $text_height; ?>" />
    </form>
   </td>
  </tr>
  <tr>
   <td class="left" colspan="2">
    <form id="form-image_bing<?php echo $product_id; ?>">
     <p>
      <?php echo $text_folder; ?>: <a onclick="resetFolderImageBing('<?php echo $product_id; ?>');"><img src="view/batch_editor/image/reset.png" title="<?php echo $text_reset; ?>" alt="<?php echo $text_reset; ?>" /></a>
      <select name="image_bing[directory][main]">
       <?php foreach ($directories as $directory) { ?>
       <option value="<?php echo $directory; ?>"><?php echo $directory; ?></option>
       <?php } ?>
      </select>
      <a onclick="$('#form-image_bing<?php echo $product_id; ?> select[name=\'image_bing[directory][main]\']').after(' <input name=\'image_bing[directory][]\' /> <span class=\'separator\'>/</span> ');"><img src="view/image/add.png" title="<?php echo $text_add; ?>" alt="<?php echo $text_add; ?>" /></a>
      <a onclick="$('#form-image_bing<?php echo $product_id; ?> input[name=\'image_bing[directory][]\']:last').remove(); $('#form-image_bing<?php echo $product_id; ?> span.separator:last').remove();"><img src="view/image/delete.png" title="<?php echo $text_delete; ?>" alt="<?php echo $text_delete; ?>" /></a>
     </p>
     <p>
      <input name="image_bing[keyword]" type="text" size="100" maxlength="128" value="<?php echo (isset ($keyword)) ? $keyword : ''; ?>" />
      <a class="button" onclick="searchImageBing(<?php echo $product_id; ?>);"><?php echo $text_search; ?></a>
     </p>
     <div class="be-scrollbox">
     </div>
     <div style="text-align:center; margin-top:10px;">
      <?php echo $text_main; ?> (<span class="image_bing_count_main">0</span>)
      &nbsp;&nbsp;&nbsp;
      <?php echo $text_additional; ?> (<span class="image_bing_count_additional">0</span>)
     </div>
    </form></td>
  </tr>
  <tr>
   <td class="center" colspan="2">
    <a class="button" onclick="editTool(<?php echo $product_id; ?>, 'image_bing', 'add');"><?php echo $text_add; ?></a>
    <a class="button" onclick="resetImageBing(<?php echo $product_id; ?>);"><?php echo $text_reset; ?></a>
    <?php if ($product_id) { ?>
    <a class="button" onclick="$('#dialogTool').dialog('close');">&times;</a>
    <?php } ?>
   </td>
  </tr>
 </tfoot>
</table>
<script type="text/javascript"><!--
$(document).ready(function() {
	$('#form-image_bing<?php echo $product_id; ?> input[name=\'image_bing[keyword]\']').keypress(function(e) {
		if (e.keyCode == 13) {
			searchImageBing(<?php echo $product_id; ?>);
			return false;
		}
	}).focus();
	
	$('#form-image_bing<?php echo $product_id; ?> input[type=\'checkbox\']').live('click', function() {
		if ($(this).attr('name') == 'image_bing[data][main]') {
			$('#form-image_bing<?php echo $product_id; ?> input[name=\'image_bing[data][main]\']').not(this).removeAttr('checked');
			$(this).parents('div:first').children('input[name=\'image_bing[data][]\']').removeAttr('checked');
		} else {
			$(this).parents('div:first').children('input[name=\'image_bing[data][main]\']').removeAttr('checked');
		}
		
		$('#form-image_bing<?php echo $product_id; ?> .image_bing_count_main').html($('#form-image_bing<?php echo $product_id; ?> input[name=\'image_bing[data][main]\']:checked').length);
		$('#form-image_bing<?php echo $product_id; ?> .image_bing_count_additional').html($('#form-image_bing<?php echo $product_id; ?> input[name=\'image_bing[data][]\']:checked').length);
	});
});

if (typeof searchImageBing != 'function') {
	function searchImageBing(product_id) {
		$('#form-image_bing' + product_id + ' .be-scrollbox').html('');
		$('#form-image_bing' + product_id + ' .image_bing_count_main').html('0');
		$('#form-image_bing' + product_id + ' .image_bing_count_additional').html('0');
		
		getImageBing(product_id);
	}
}

if (typeof resetImageBing != 'function') {
	function resetImageBing(product_id) {
		$('#form-image_bing' + product_id + ' input[type=\'checkbox\']').removeAttr('checked');
		$('#form-image_bing' + product_id + ' .image_bing_count_main').html('0');
		$('#form-image_bing' + product_id + ' .image_bing_count_additional').html('0');
	}
}

if (typeof getImageBing != 'function') {
	function getImageBing(product_id) {
		var html = '';
		var keyword = encodeURIComponent ($('#form-image_bing' + product_id + ' input[name=\'image_bing[keyword]\']').val());
		
		if (!keyword) {
			return false;
		}
		
		xhr = $.ajax({type:'GET', dataType:'json', data:'q=' + keyword + '&' + $('#form-image_bing-data' + product_id).serialize(), url:'index.php?route=batch_editor/tool/getImageBing&token=' + token,
			beforeSend: function() { creatOverlayLoad(true); },
			success: function(json){
				if (json['warning']) {
					creatMessage(json);
				} else {
					$.each(json['value'], function(index, value) {
						html = '<div>';
						html += ' <label><input name="image_bing[data][main]" type="checkbox" value="' + value['link'] + '"> <?php echo $text_main; ?></label><br />';
						html += ' <label><input name="image_bing[data][]" type="checkbox" value="' + value['link'] + '"> <?php echo $text_additional; ?></label><br />';
						html += ' <b>' + value['width'] + 'x' + value['height'] + '</b>';
						html += ' <a class="colorbox' + product_id + '" href="' + value['link'] + '">';
						html += ' <img src="' + value['thumbnailLink'] + '" alt="" title="" style="max-width:100%; height:auto;">';
						html += ' </a>';
						html += '</div>';
						
						$('#form-image_bing' + product_id + ' .be-scrollbox').append(html);
						//$('#form-image_bing' + product_id + ' .be-scrollbox').scrollTop(9999);
						$('#form-image_bing' + product_id + ' .colorbox' + product_id).colorbox({overlayClose:true, opacity:0.5, rel:'colorbox' + product_id, innerWidth:'80%', innerHeight:'80%'});
					});
				}
				
				creatOverlayLoad(false);
			}
		});
	}
}

if (typeof resetFolderImageBing != 'function') {
	function resetFolderImageBing(product_id) {
		xhr = $.ajax({type:'GET', dataType:'json', url:'index.php?route=batch_editor/tool/getImageDirectories&token=' + token,
			beforeSend: function() { creatOverlayLoad(true); },
			success: function(json) {
				var html = '<select name="image_bing[directory][main]">';
				
				$.each(json, function(index, folder) {
					html += '<option value="' + folder + '">' + folder + '</option>';
				});
				
				html += '</select>';
				
				$('#form-image_bing' + product_id + ' select[name=\'image_bing[directory][main]\']').replaceWith(html);
				
				creatOverlayLoad(false);
			}
		});
	}
}

<?php if (isset ($keyword) && $keyword) { ?>
searchImageBing(<?php echo $product_id; ?>);
<?php } ?>
//--></script>
<?php if ($product_id > 0) { ?>
<script type="text/javascript"><!--
$('#dialogTool').dialog({title:'<?php echo $text_image_bing; ?>', beforeClose: function(event, ui) { if ($('#colorbox').css('display') == 'block') { return false; }}});
//--></script>
<?php } ?>
