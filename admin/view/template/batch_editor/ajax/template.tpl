<div class="be-scrollhead">
 <table class="be-list">
  <col width="50" /><col width="" /><col width="10%" /><col width="10%" />
  <thead>
   <tr>
    <td class="center"></td>
    <td class="left"><?php echo $text_name; ?></td>
    <td class="center" colspan="2"><?php echo $text_date_added; ?></td>
   </tr>
  </thead>
 </table>
</div>
<div class="be-scrollcontent">
 <table class="be-list">
  <?php if ($data) { ?>
  <col width="50" /><col width="" /><col width="10%" /><col width="10%" />
  <?php foreach ($data as $index => $value) { ?>
  <tbody id="template<?php echo $index; ?>">
   <tr>
    <td class="center"><a onclick="deleteTemplate('<?php echo $template; ?>', '<?php echo $index; ?>');"><img src="view/image/delete.png" title="<?php echo $button_remove; ?>" alt="<?php echo $button_remove; ?>" /></a></td>
    <td class="left"><a onclick="loadTemplate('<?php echo $template; ?>', '<?php echo $index; ?>', '<?php echo $product_id; ?>');"><?php echo $value['name']; ?></a></td>
    <td class="center"><?php echo date ('H:i:s', $value['time']); ?></td>
    <td class="center"><?php echo date ('d-m-Y', $value['time']); ?></td>
   </tr>
  </tbody>
  <?php } ?>
  <?php } else { ?>
  <tbody>
   <tr>
    <td class="center" colspan="4"><div class="attention" align="center"><?php echo $text_no_results; ?></div></td>
   </tr>
  </tbody>
  <?php } ?>
 </table>
</div>

<script type="text/javascript"><!--
function deleteTemplate(template, index) {
	xhr = $.ajax({type:'POST', dataType:'json', data:'template=' + template + '&index=' + index, url:'index.php?route=batch_editor/template/deleteTemplate&token=' + token,
		beforeSend: function() { creatOverlayLoad(true); },
		success:function(json) {
			if (json['success']) {
				$('#dialogTemplate #template' + index).remove();
			}
			
			if (!$('#dialogTemplate table tbody').length) {
				$('#dialogTemplate .be-scrollcontent .be-list').append('<tbody><tr><td class="center" colspan="4"><div class="attention" align="center"><?php echo $text_no_results; ?></div></td></tr></tbody>');
			}
			
			creatMessage(json);
			creatOverlayLoad(false);
		}
	});
}

function loadTemplate(template, index, product_id) {
	xhr = $.ajax({type:'POST', dataType:'json', data:'template=' + template + '&index=' + index, url:'index.php?route=batch_editor/template/loadTemplate&token=' + token,
		beforeSend: function() { creatOverlayLoad(true); },
		success: function(json) {
			<!--<?php if ($template == 'attribute') { ?>-->
			$.each(json['value'], function (attribute_id, value) {
				var row = attribute_row[product_id];
				addAttribute(product_id);
				
				$('#form-attribute' + product_id + ' input[name=\'attribute[' + row + '][name]\']').val(value['name']);
				$('#form-attribute' + product_id + ' input[name=\'attribute[' + row + '][attribute_id]\']').val(attribute_id);
				
				$.each(value['text'], function(language_id, text) { $('#form-attribute' + product_id + ' input[name=\'attribute[' + row + '][attribute_description][' + language_id + '][text]\']').val(text); });
			});
			<!--<?php } ?>-->
			
			<!--<?php if ($template == 'seo_generator') { ?>-->
			$.each(json['value'], function (index, data) {
				addSeoGeneratorRow(product_id);
				
				var tbody = $('#form-seo_generator' + product_id + ' #table-seo_generator' + product_id + ' tbody:last');
				
				$.each(data, function (type, value) {
					if (type == 'text' || type == 'data') {
						tbody.find('select:first option[value=\'' + type + '\']').prop('selected', true);
						tbody.find('select:first').trigger('change');
					}
					
					if (type == 'text') {
						tbody.find('textarea').html(value);
					} else if (type == 'data') {
						tbody.find('select:last option[value=\'' + value + '\']').prop('selected', true);
						tbody.find('select:last').trigger('change');
					} else {
						tbody.find('input[name*=\'[' + type + ']\']').val(value);
					}
				});
			});
			<!--<?php } ?>-->
			
			<!--<?php if ($template == 'search_replace') { ?>-->
			$.each(json['value']['type'], function (index, type) {
				addSearchReplaceRow(product_id);
				
				var tbody = $('#form-search_replace' + product_id + ' #table-search_replace' + product_id + ' tbody:last');
				
				tbody.find('select:first option[value=\'' + type + '\']').prop('selected', true);
				tbody.find('select:first').trigger('change');
				
				tbody.find('textarea:first').html(json['value']['what'][index]);
				
				if (type == 'text') {
					tbody.find('textarea:last').html(json['value']['on_what'][index]);
				} else {
					tbody.find('select:last option[value=\'' + json['value']['on_what'][index] + '\']').prop('selected', true);
				}
			});
			<!--<?php } ?>-->
			
			$('#dialogTemplate').dialog('close');
			creatOverlayLoad(false);
		}
	});
}

$(document).ready(function() {
	$('#dialogTemplate').dialog({'title':'<?php echo $text_header; ?>'});
});
//--></script>