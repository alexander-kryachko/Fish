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
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
    </div>
    <div class="content">
      <div id="tabs" class="htabs"><a href="#tab-general"><?php echo $text_general; ?></a><a href="#tab-participants"><?php echo $text_participants; ?></a><a href="#tab-winners"><?php echo $text_winners; ?></a></div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general">
          <div id="languages" class="htabs">
            <?php foreach ($languages as $language) { ?>
            <a href="#language<?php echo $language['language_id']; ?>"><img src="view/image/flags/<?php echo $language['image']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a>
            <?php } ?>
          </div>
          <?php foreach ($languages as $language) { ?>
          <div id="language<?php echo $language['language_id']; ?>">
            <table class="form">
              <tr>
                <td><span class="required">*</span> <?php echo $text_title; ?></td>
                <td colspan="2"><input type="text" name="information_description[<?php echo $language['language_id']; ?>][title]" size="100" value="<?php echo isset($information_description[$language['language_id']]) ? $information_description[$language['language_id']]['title'] : ''; ?>" />
                  <?php if (isset($error_title[$language['language_id']])) { ?>
                  <span class="error"><?php echo $error_title[$language['language_id']]; ?></span>
                  <?php } ?></td>
              </tr>
              <tr>
                <td><span class="required">*</span> <?php echo $text_description; ?></td>
                <td colspan="2"><textarea name="information_description[<?php echo $language['language_id']; ?>][description]" id="description<?php echo $language['language_id']; ?>"><?php echo isset($information_description[$language['language_id']]) ? $information_description[$language['language_id']]['description'] : ''; ?></textarea>
                  <?php if (isset($error_description[$language['language_id']])) { ?>
                  <span class="error"><?php echo $error_description[$language['language_id']]; ?></span>
                  <?php } ?></td>
              </tr>
              <tr>
              	<td><?php echo $text_status; ?></td>
              	<td colspan="2">
              		<select name="information_description[<?php echo $language['language_id']; ?>][status]">
              			<?php if($information_description[$language['language_id']]['status'] == 0): ?>
	              			<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
	              			<option value="1"><?php echo $text_enabled; ?></option>
              			<?php else: ?>
	              			<option value="0"><?php echo $text_disabled; ?></option>
	              			<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
	              		<?php endif; ?>
              		</select>
              	</td>
              </tr>
              <tr>
              	<td><?php echo $text_newsletter_signup; ?></td>
              	<td colspan="2">
              		<select name="information_description[<?php echo $language['language_id']; ?>][newsletter]">
              			<?php if($information_description[$language['language_id']]['newsletter'] == 0): ?>
	              			<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
	              			<option value="1"><?php echo $text_enabled; ?></option>
              			<?php else: ?>
	              			<option value="0"><?php echo $text_disabled; ?></option>
	              			<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
	              		<?php endif; ?>
              		</select>
              	</td>
              </tr>
              <tr>
              	<td>Terms and Conditions</td>
              	<td>
              		<select name="information_description[<?php echo $language['language_id']; ?>][information_id]">
              			<?php foreach($information_pages as $information): ?>
              				<?php if(isset($information_description[$language['language_id']]['information_id'])): ?>
              				<option value="<?php echo $information['information_id']; ?>" <?php if($information['information_id'] == $information_description[$language['language_id']]['information_id']): ?>selected="selected"<?php endif; ?>><?php echo $information['title']; ?></option>
              				<?php else: ?>
              				<option value="<?php echo $information['information_id']; ?>"><?php echo $information['title']; ?></option>
              				<?php endif; ?>
              			<?php endforeach; ?>
              		</select>
              	</td>
              	<td class="left">
              		<select name="information_description[<?php echo $language['language_id']; ?>][term]">
              			<?php if($information_description[$language['language_id']]['term'] == 0): ?>
	              			<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
	              			<option value="1"><?php echo $text_enabled; ?></option>
              			<?php else: ?>
	              			<option value="0"><?php echo $text_disabled; ?></option>
	              			<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
	              		<?php endif; ?>
              		</select>
              	</td>
              </tr>
              <tr>
                <td><span class="required">*</span> <?php echo $text_question; ?></td>
                <td colspan="2"><input type="text" name="information_description[<?php echo $language['language_id']; ?>][question]" size="100" value="<?php echo isset($information_description[$language['language_id']]) ? $information_description[$language['language_id']]['question'] : ''; ?>" />
                  <?php if (isset($error_title[$language['language_id']])) { ?>
                  <span class="error"><?php echo $error_title[$language['language_id']]; ?></span>
                  <?php } ?></td>
              </tr>
					<?php $answer_id = 0; ?>
					<?php if($answers): ?>
		            <?php foreach($answers as $id => $value): ?>
			            	<?php foreach($value as $lang_id => $a_row): ?>
			            		<?php if($lang_id == $language['language_id']): ?>
			            		  <?php $answer_id++; ?>
					              <tr id="answer-<?php echo $answer_id; ?>-<?php echo $language['language_id']; ?>">
					                <td><span class="required">*</span> <?php echo $text_answer; ?></td>
					                <td><input type="text" name="answer_old[<?php echo $language['language_id']; ?>][<?php echo $a_row['id']; ?>][answer]" size="100" value="<?php echo $a_row['value']; ?>" /> 
					                	<?php if($answer_id > 1): ?>
					                		<a onclick="removeAnswer(<?php echo $answer_id; ?>)"><img src="view/image/delete.png"></a>
					                	<?php endif; ?>
					                </td>
					                <td class="left">
					                	<?php echo $text_correct_answer; ?> 
					                	<select name="answer_old[<?php echo $language['language_id']; ?>][<?php echo $a_row['id']; ?>][correct]">
					                		<option value="0" <?php if($a_row['correct'] == 0):?>selected="selected"<?php endif; ?>><?php echo $text_no; ?></option>
					                		<option value="1" <?php if($a_row['correct'] == 1):?>selected="selected"<?php endif; ?>><?php echo $text_yes; ?></option>
					                	</select>
					                </td>
					              </tr>
				              <?php endif; ?>
			              <?php endforeach; ?>
					<?php endforeach; ?>
						<?php else: ?>
					              <tr id="answer-<?php echo $answer_id; ?>-<?php echo $language['language_id']; ?>">
					                <td><span class="required">*</span> <?php echo $text_answer; ?></td>
					                <td><input type="text" name="answer_new[<?php echo $language['language_id']; ?>][<?php echo $answer_id; ?>][answer]" size="100" value="" /></td>
					                <td class="left">
					                	Correct answer? 
					                	<select name="answer_new[<?php echo $language['language_id']; ?>][<?php echo $answer_id; ?>][correct]">
					                		<option value="0"><?php echo $text_no; ?></option>
					                		<option value="1"><?php echo $text_yes; ?></option>
					                	</select>
					                </td>
					              </tr>
						<?php endif; ?>
              <tr class="answer_add-<?php echo $language['language_id']; ?>">
                <td>&nbsp;</td>
                <td><a onclick="addAnswer();" class="button" ><?php echo $text_add_answer; ?></a></td>
              </tr>
            </table>

          </div>
          

          <?php } ?>
          
        <table id="module" class="list">
          <thead>
            <tr>
              <td class="left"><?php echo $entry_layout; ?></td>
            <td class="left"><?php echo $entry_position; ?></td>
            <td class="left"><?php echo $entry_status; ?></td>
            <td class="right"><?php echo $entry_sort_order; ?></td>
              <td></td>
            </tr>
          </thead>
          <?php $module_row = 0; ?>
          <?php if(empty($settings[0]['competition_id'])): ?>
	          <tbody id="module-row<?php echo $module_row; ?>">
	            <tr>
	            	<input type="hidden" name="competition_module[<?php echo $module_row; ?>][competition_id]" value="<?php echo $competition_id; ?>">
	              <td class="left"><select name="competition_module[<?php echo $module_row; ?>][layout_id]">
	                  <?php foreach ($layouts as $layout) { ?>
		                  <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
	                  <?php } ?>
	                </select></td>
	              <td class="left">
	              	<select name="competition_module[<?php echo $module_row; ?>][position]">
	                  <option value="content_top"><?php echo $text_content_top; ?></option>
	                  <option value="content_bottom"><?php echo $text_content_bottom; ?></option>
	                  <option value="column_left"><?php echo $text_column_left; ?></option>
	                  <option value="column_right"><?php echo $text_column_right; ?></option>
	                </select></td>
	              <td class="left">
	              	<select name="competition_module[<?php echo $module_row; ?>][status]">
	                  <option value="1"><?php echo $text_enabled; ?></option>
	                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
	                </select></td>
	              <td class="right"><input type="text" name="competition_module[<?php echo $module_row; ?>][sort_order]" value="0" size="3" /></td>
	              <td class="left"></td>
	            </tr>
	          </tbody>
	          <?php $module_row++; ?>
          <?php endif; ?>

          <?php foreach($settings as $setting_row): ?>
	          <tbody id="module-row<?php echo $module_row; ?>">
	            <tr>
	            	<input type="hidden" name="competition_module[<?php echo $module_row; ?>][competition_id]" value="<?php echo $competition_id; ?>">
	              <td class="left"><select name="competition_module[<?php echo $module_row; ?>][layout_id]">
	                  <?php foreach ($layouts as $layout) { ?>
		                  <?php if ($layout['layout_id'] == $setting_row['layout_id']) { ?>
		                  <option value="<?php echo $layout['layout_id']; ?>" selected="selected"><?php echo $layout['name']; ?></option>
		                  <?php } else { ?>
		                  <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>
		                  <?php } ?>
	                  <?php } ?>
	                </select></td>
	              <td class="left">
	              	<select name="competition_module[<?php echo $module_row; ?>][position]">
		                  <?php if ($setting_row['position'] == 'content_top') { ?>
		                  <option value="content_top" selected="selected"><?php echo $text_content_top; ?></option>
		                  <?php } else { ?>
		                  <option value="content_top"><?php echo $text_content_top; ?></option>
		                  <?php } ?>
		                  <?php if ($setting_row['position'] == 'content_bottom') { ?>
		                  <option value="content_bottom" selected="selected"><?php echo $text_content_bottom; ?></option>
		                  <?php } else { ?>
		                  <option value="content_bottom"><?php echo $text_content_bottom; ?></option>
		                  <?php } ?>
		                  <?php if ($setting_row['position'] == 'column_left') { ?>
		                  <option value="column_left" selected="selected"><?php echo $text_column_left; ?></option>
		                  <?php } else { ?>
		                  <option value="column_left"><?php echo $text_column_left; ?></option>
		                  <?php } ?>
		                  <?php if ($setting_row['position'] == 'column_right') { ?>
		                  <option value="column_right" selected="selected"><?php echo $text_column_right; ?></option>
		                  <?php } else { ?>
		                  <option value="column_right"><?php echo $text_column_right; ?></option>
		                  <?php } ?>
	                </select></td>
	              <td class="left">
	              	<select name="competition_module[<?php echo $module_row; ?>][status]">
		                  <?php if ($setting_row['status']) { ?>
		                  <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
		                  <option value="0"><?php echo $text_disabled; ?></option>
		                  <?php } else { ?>
		                  <option value="1"><?php echo $text_enabled; ?></option>
		                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
		                  <?php } ?>
	                </select></td>
	              <td class="right"><input type="text" name="competition_module[<?php echo $module_row; ?>][sort_order]" value="0" size="3" /></td>
	              <td class="left">
	              	<a onclick="$('#module-row<?php echo $module_row; ?>').remove();" class="button"><span><?php echo $button_remove; ?></span></a>
	              </td>
	            </tr>
	          </tbody>
	          <?php $module_row++; ?>
          <?php endforeach; ?>
          <tfoot>
            <tr>
              <td colspan="4"></td>
              <td class="left"><a onclick="addModule();" class="button"><span><?php echo $button_add_module; ?></span></a></td>
            </tr>
          </tfoot>
        </table>
          
        </div>
        
        <div id="tab-participants">
	        <table class="list">
	          <thead>
	            <tr>
	              <td class="left"><?php echo $text_name; ?></td>
	              <td class="left"><?php echo $text_email; ?></td>
	              <td class="left"><?php echo $text_answer; ?></td>
	            </tr>
	          </thead>
	          <tbody>
	          	<?php if($participants): ?>
	          	<?php foreach($participants as $participant): ?>
		            <tr>
		              <td class="left"><? echo $participant['name']; ?></td>
		              <td class="left"><? echo $participant['email']; ?></td>
		              <td class="left"><? echo $participant['value']; ?></td>
		            </tr>
	            <?php endforeach; ?>
	            <?php else: ?>
	            <tr>
	              <td class="center" colspan="4"><?php echo $text_no_results; ?></td>
	            </tr>
	            <?php endif; ?>
	          </tbody>
	        </table>
        </div>

	</form>

        <div id="tab-winners">
	        <div id="tab-participants">
	        	
	        	<form action="<?php echo $winner_action; ?>" method="post" enctype="multipart/form-data" id="winner-form">
		            <table class="form">
		            	<tr>
		            		<td><?php echo $text_amount_of_winners; ?></td>
		            		<td>
		            			<input type="tekst" name="amount" value="1">
		            		</td>
		            	</tr>
		              <tr>
		                <td><?php echo $text_select_random_winners; ?></td>
		                <td>
		                	<input type="submit" value="Select winners">
						</td>
		              </tr>
		            </table>
	        	</form>
	        	
		        <table class="list">
		          <thead>
		            <tr>
	              <td class="left"><?php echo $text_name; ?></td>
	              <td class="left"><?php echo $text_email; ?></td>
	              <td class="left"><?php echo $text_answer; ?></td>
		            </tr>
		          </thead>
		          <tbody>
		          	<?php if($winners): ?>
			          	<?php foreach($winners as $winner): ?>
			            <tr>
			              <td class="left"><?php echo $winner['name']; ?></td>
			              <td class="left"><?php echo $winner['email']; ?></td>
			              <td class="left"><?php echo $winner['value']; ?></td>
			            </tr>
			            <?php endforeach; ?>
		            <?php else: ?>
			            <tr>
			              <td class="center" colspan="4"><?php echo $text_no_results; ?></td>
			            </tr>
		            <?php endif; ?>
		          </tbody>
		        </table>
	        </div>
        </div>




      
    </div>
  </div>
</div>

<script type="text/javascript">
var answer_id = <?php echo $answer_id; ?>;

function addAnswer() {
answer_id++;
<?php foreach ($languages as $language): ?>
	var langid = <?php echo $language['language_id']; ?>;
	html  = '<tr id="answer-' + answer_id + '-' + langid + '">';
	html  += '<td><?php echo $text_answer; ?></td>';
	html  += '<td>';
	html  += '<input type="text" name="answer_new[' + langid + '][' + answer_id + '][answer]" size="100" value="">';
	html  += ' <a onclick="removeAnswer(' + answer_id + ');"><img src="view/image/delete.png"></a>';
	html  += '</td>';
	html  += '<td>';
	html  += '<?php echo $text_correct_answer; ?>';
	html  += '<select name="answer_new[' + langid + '][' + answer_id + '][correct]">';
	html  += '<option value="0"><?php echo $text_no; ?></option>';
	html  += '<option value="1"><?php echo $text_yes; ?></option>';
	html  += '</select>';
	html  += '</td>';
	html  += '</tr>';
	
	$('.answer_add-' + langid).before(html);

<?php endforeach; ?>
	
}

function removeAnswer(answer_id) {
<?php foreach ($languages as $language): ?>
	var langid = <?php echo $language['language_id']; ?>;
	$('#answer-' + answer_id + '-' + langid + '').remove();
<?php endforeach; ?>
}
</script>

<script type="text/javascript"><!--
var module_row = <?php echo $module_row; ?>;
var competition_id = <?php echo $competition_id; ?>;


function addModule() {	
	html  = '<tbody id="module-row' + module_row + '">';
	html += '  <tr>';
	html += '    <input type="hidden" name="competition_module[' + module_row + '][competition_id]" value="' + competition_id + '"/>'
	html += '    <td class="left"><select name="competition_module[' + module_row + '][layout_id]">';
	<?php foreach ($layouts as $layout) { ?>
	html += '      <option value="<?php echo $layout['layout_id']; ?>"><?php echo $layout['name']; ?></option>';
	<?php } ?>
	html += '    </select></td>';
	html += '    <td class="left"><select name="competition_module[' + module_row + '][position]">';
	html += '      <option value="content_top"><?php echo $text_content_top; ?></option>';
	html += '      <option value="content_bottom"><?php echo $text_content_bottom; ?></option>';
	html += '      <option value="column_left"><?php echo $text_column_left; ?></option>';
	html += '      <option value="column_right"><?php echo $text_column_right; ?></option>';
	html += '    </select></td>';
	html += '    <td class="left"><select name="competition_module[' + module_row + '][status]">';
    html += '      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>';
    html += '      <option value="0"><?php echo $text_disabled; ?></option>';
    html += '    </select></td>';
	html += '    <td class="right"><input type="text" name="competition_module[' + module_row + '][sort_order]" value="" size="3" /></td>';
	html += '    <td class="left"><a onclick="$(\'#module-row' + module_row + '\').remove();" class="button"><span><?php echo $button_remove; ?></span></a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#module tfoot').before(html);
	
	module_row++;
}
//--></script> 
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script> 
<script type="text/javascript"><!--
<?php foreach ($languages as $language) { ?>
CKEDITOR.replace('description<?php echo $language['language_id']; ?>', {
	filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $this->session->data['token'];?>',
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $this->session->data['token'];?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $this->session->data['token'];?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $this->session->data['token'];?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $this->session->data['token'];?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $this->session->data['token'];?>'
});
<?php } ?>
//--></script> 
<script type="text/javascript"><!--
$('#tabs a').tabs(); 
$('#languages a').tabs(); 
//--></script> 
<?php echo $footer; ?>