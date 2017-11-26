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
      <div class="buttons">
      	<a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a>
      	<a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a>
      </div>
    </div>
    <div class="content">
      <div class="htabs">
      	<a href="#general"><?php echo $tab_general; ?></a>
      	<a href="#autocomplete"><?php echo $tab_autocomplete; ?></a>
      	<a href="#productOptions"><?php echo $tab_productOptions; ?></a>
      	<a href="#categoriesOptions"><?php echo $tab_categoriesOptions; ?></a>
      	<a href="#suggestions"><?php echo $tab_suggestions; ?></a>
      	<a href="#config"><?php echo $tab_config; ?></a>
      	<a href="#rtIndex" class="rtIndexTab hiddenTab"><?php echo $tab_rtIndex; ?></a>
      </div>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
          <div id="general">
          <table class="form">
            <tr>
              <td><?php echo $entry_sphinx_status; ?></td>
              <td>
              	<select name="sphinx_search_module">
                  <?php if (isset($sphinx_search_module)) { ?>
                  <option value="1" <?php if ($sphinx_search_module) echo 'selected="selected"'; ?> ><?php echo $text_enabled; ?></option>
                  <option value="0" <?php if (!$sphinx_search_module) echo 'selected="selected"'; ?> ><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_sphinx_server; ?></td>
              <td>
              	<input type="text" name="sphinx_search_server" value="<?php echo ($sphinx_search_server) ? $sphinx_search_server : '127.0.0.1' ?>" />
              </td>
            </tr>
            <tr>
              <td><?php echo $entry_sphinx_port; ?></td>
              <td>
              	<input type="text" name="sphinx_search_port" value="<?php echo ($sphinx_search_port) ? $sphinx_search_port : 9312; ?>" />
              </td>
            </tr>
            <tr class="settings-title">
				<td colspan="2"><span class="title"><?php echo $entry_sphinx_match_mode_title; ?></span></td>
			</tr>
            <tr>
              <td><?php echo $entry_sphinx_match_mode; ?></td>
              <td>
              	<select name="sphinx_match_mode">
                  <?php foreach ($sphinx_match_modes as $key=>$mode) { ?>
	                  <?php if ($key == $sphinx_match_mode) { ?>
	                  	<option value="<?php echo $key; ?>" selected="selected"><?php echo $mode; ?></option>
	                  <?php } else { ?>
	                  	<option value="<?php echo $key; ?>"><?php echo $mode; ?></option>
	                  <?php } ?>
                  <?php } ?>
                </select><button id="search-mode">?</button>
              </td>
            </tr>
            <tr class="settings-header info search-mode">
				<td colspan="2"><span class="explanation"><?php echo $entry_sphinx_match_modes_explanation; ?></span></td>
			</tr>
            <tr>
            	<td></td>
            </tr>
            
            <tr class="settings-title">
				<td colspan="2"><span class="title"><?php echo $entry_sphinx_sort_mode_title; ?></span></td>
			</tr>
			
			<tr>
              <td><?php echo $entry_sort_status; ?></td>
              <td>
              	<select name="sphinx_search_sort">
                  <?php if (isset($sphinx_search_sort)) { ?>
                  <option value="1" <?php if ($sphinx_search_sort) echo 'selected="selected"'; ?> ><?php echo $text_enabled; ?></option>
                  <option value="0" <?php if (!$sphinx_search_sort) echo 'selected="selected"'; ?> ><?php echo $text_disabled; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_enabled; ?></option>
                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                  <?php } ?>
                </select><button id="sort-mode">?</button>
              </td>
            </tr>
			
            <tr>
			  <th><?php echo $entry_sphinx_sort_info; ?></th>
			  <th><?php echo $entry_sphinx_attr_expr_info; ?></th>
			</tr>
			
			<?php foreach ($sphinx_sort_modes as $key=>$arr) { ?>
				<tr>
					<?php if ($key == $sphinx_sort_mode) { ?>
						<td><input type="radio" name="sphinx_sort_mode" value="<?php echo $key; ?>" checked /> <?php echo $arr['mode'] ?></td>
					<?php } else { ?>
						<td><input type="radio" name="sphinx_sort_mode" value="<?php echo $key; ?>" /> <?php echo $arr['mode'] ?></td>
					<?php } ?>
					<?php if(isset($arr['attrs'])) { ?>
						<td>
							<select name="sphinx_sort_attr_val[<?php echo $key ?>]"> 
								<?php foreach($arr['attrs'] as $ak => $av) { ?>
									<option value="<?php echo $ak; ?>" <?php if ($sphinx_sort_attr_val[$key] == $ak) echo 'selected="selected"'; ?>><?php echo $av; ?></option>
								<?php } ?> 
							</select>
						</td>	            
					<?php } else { ?>
						<?php if($key != 0) { ?>
							<td><input type="text" name="sphinx_sort_attr_val[<?php echo $key; ?>]" value="<?php echo $sphinx_sort_attr_val[$key] ?>" /></td>
						<?php  } else { ?>
							<td><input type="hidden" name="sphinx_sort_attr_val[<?php echo $key; ?>]" value="<?php echo $sphinx_sort_attr_val[$key] ?>" /></td>
						<?php } ?>
				</tr>
					<?php } ?>
			<?php } ?>
			
            </tr>
            <tr class="settings-header info sort-mode">
				<td colspan="2"><span class="explanation"><?php echo $entry_sphinx_sort_modes_explanation; ?></span></td>
			</tr>
            <tr>
            	<td></td>
            </tr>
            
            <tr class="settings-title">
				<td colspan="2"><span class="title"><?php echo $entry_sphinx_ranking_mode_title; ?></span></td>
			</tr>
            <tr>
              <td><?php echo $entry_sphinx_ranking_mode; ?></td>
              <td>
              	<select name="sphinx_ranking_mode">
                  <?php foreach ($sphinx_ranking_modes as $key=>$mode) { ?>
	                  <?php if ($key == $sphinx_ranking_mode) { ?>
	                  	<option value="<?php echo $key; ?>" selected="selected"><?php echo $mode; ?></option>
	                  <?php } else { ?>
	                  	<option value="<?php echo $key; ?>"><?php echo $mode; ?></option>
	                  <?php } ?>
                  <?php } ?>
                </select><button id="ranking-mode">?</button>
              </td>
            </tr>
            <tr class="settings-header info ranking-mode">
				<td colspan="2"><span class="explanation"><?php echo $entry_sphinx_ranking_modes_explanation; ?></span></td>
			</tr>
            <tr>
            	<td></td>
            </tr>
            
            <tr class="settings-title">
				<td colspan="2"><span class="title"><?php echo $entry_sphinx_weight_title; ?></span></td>
			</tr>
            
			<tr>
            <?php $br=1; foreach($sphinx_sort_attrs as $key => $val) { ?>
				<?php if($br == 1 || ($br-1)%ceil(count($sphinx_sort_attrs)/2) == 0) { echo '<td class="valign">'; } ?>
					<div class="weights-wrap"><?php echo $val; ?></div>
					<input type="text" name="sphinx_weights[<?php echo $key; ?>]" value="<?php echo (isset($sphinx_weights[$key]) && $sphinx_weights[$key] != '') ? $sphinx_weights[$key] : 1; ?>" class="weights-field" /> <br />
				<?php if($br%ceil(count($sphinx_sort_attrs)/2) == 0 || $br == count($sphinx_sort_attrs)) { echo '</td>'; } ?>
            <?php $br++; } ?>
			</tr>
          </table>
        </div><!-- end of general -->
        
        <div id="autocomplete">
        	<table class="form">
				<tr>
					<td><?php echo $entry_autocomplete_status; ?></td>
		            <td>
		            	<select name="sphinx_search_autocomple">
		                  <?php if (isset($sphinx_search_autocomple)) { ?>
		                  <option value="1" <?php if ($sphinx_search_autocomple) echo 'selected="selected"'; ?> ><?php echo $text_enabled; ?></option>
		                  <option value="0" <?php if (!$sphinx_search_autocomple) echo 'selected="selected"'; ?> ><?php echo $text_disabled; ?></option>
		                  <?php } else { ?>
		                  <option value="1"><?php echo $text_enabled; ?></option>
		                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
		                  <?php } ?>
		                </select>
		              </td>
				</tr>
				
				<tr>
					<td><?php echo $entry_autocomplete_selector; ?></td>
		            <td>
		              	<input type="text" name="sphinx_autocomple_selector" value="<?php echo ($sphinx_autocomple_selector) ? $sphinx_autocomple_selector : '#search input' ?>" />
		            </td>
				</tr>
				
				<tr>
					<td><?php echo $entry_autocomplete_limit; ?></td>
		            <td>
		              	<input type="text" name="sphinx_autocomple_limit" value="<?php echo ($sphinx_autocomple_limit) ? $sphinx_autocomple_limit : '' ?>" />
		            </td>
				</tr>
				
				<tr>
					<td><?php echo $entry_autocomplete_categories; ?></td>
		            <td>
		              	<select name="sphinx_search_autocomplete_categories">
		                  <?php if (isset($sphinx_search_autocomplete_categories)) { ?>
		                  <option value="1" <?php if ($sphinx_search_autocomplete_categories) echo 'selected="selected"'; ?> ><?php echo $text_yes; ?></option>
		                  <option value="0" <?php if (!$sphinx_search_autocomplete_categories) echo 'selected="selected"'; ?> ><?php echo $text_no; ?></option>
		                  <?php } else { ?>
		                  <option value="1"><?php echo $text_yes; ?></option>
		                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
		                  <?php } ?>
		                </select>
		            </td>
				</tr>
				
				<tr>
					<td><?php echo $entry_sphinx_autocomplete_cat_limit; ?></td>
		            <td>
		              	<input type="text" name="sphinx_autocomplete_cat_limit" value="<?php echo ($sphinx_autocomplete_cat_limit) ? $sphinx_autocomplete_cat_limit : '' ?>" />
		            </td>
				</tr>
        	</table>
        </div><!-- end of autocomplete -->
        
        <div id="productOptions">
        	<table class="form">
				<tr>
					<td><?php echo $entry_sphinx_product_status; ?></td>
					<td>
						<select name="sphinx_search_product_status">
		                  <?php if (isset($sphinx_search_product_status)) { ?>
		                  <option value="1" <?php if ($sphinx_search_product_status) echo 'selected="selected"'; ?> ><?php echo $text_yes; ?></option>
		                  <option value="0" <?php if (!$sphinx_search_product_status) echo 'selected="selected"'; ?> ><?php echo $text_no; ?></option>
		                  <?php } else { ?>
		                  <option value="1"><?php echo $text_yes; ?></option>
		                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
		                  <?php } ?>
		                </select>
	              </td>
				</tr>
				<tr>
					<td><?php echo $entry_sphinx_products_quantity; ?></td>
					<td>
						<input type="text" name="sphinx_search_products_quantity" value="<?php echo $sphinx_search_products_quantity; ?>" />
	              </td>
				</tr>
        	</table>
        </div><!-- end of productOptions -->
        
        <div id="categoriesOptions">
        	<table class="form">
				<tr>
					<td><?php echo $entry_sphinx_category_status; ?></td>
					<td>
						<select name="sphinx_category_status">
		                  <?php if (isset($sphinx_category_status)) { ?>
		                  <option value="1" <?php if ($sphinx_category_status) echo 'selected="selected"'; ?> ><?php echo $text_enabled; ?></option>
		                  <option value="0" <?php if (!$sphinx_category_status) echo 'selected="selected"'; ?> ><?php echo $text_disabled; ?></option>
		                  <?php } else { ?>
		                  <option value="1"><?php echo $text_enabled; ?></option>
		                  <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
		                  <?php } ?>
		                </select>
	              	</td>
				</tr>
				<tr>
					<td><?php echo $entry_sphinx_category_product_status; ?></td>
					<td>
						<select name="sphinx_category_product_status">
		                  <?php if (isset($sphinx_category_product_status)) { ?>
		                  <option value="1" <?php if ($sphinx_category_product_status) echo 'selected="selected"'; ?> ><?php echo $text_yes; ?></option>
		                  <option value="0" <?php if (!$sphinx_category_product_status) echo 'selected="selected"'; ?> ><?php echo $text_no; ?></option>
		                  <?php } else { ?>
		                  <option value="1"><?php echo $text_yes; ?></option>
		                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
		                  <?php } ?>
		                </select>
	              </td>
				</tr>
				<tr>
					<td><?php echo $entry_sphinx_categories_product_quantity; ?></td>
					<td>
						<input type="text" name="sphinx_category_product_quantity" value="<?php echo $sphinx_category_product_quantity; ?>" />
	              	</td>
				</tr>
        	</table>
        </div><!-- end of categoriesOptions -->
        
        <div id="suggestions">
        	<table class="form">
				<tr>
					<td><?php echo $entry_sphinx_suggestion_explanation; ?></td>
					<td colspan="2">
						<a onclick="genSuggestions($(this), 0)" class="button"><span><?php echo $entry_sphinx_gen_btn; ?></span></a>
						<img id="loader" src="view/image/loading.gif" style="display: none" />
						<div id="progressBar">
							<span class="msg"><?php echo $text_calculating; ?></span>
							<div></div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div class="attention"><?php echo $entry_sphinx_show_errors_attention; ?></div>
					</td>
				</tr>
        	</table>
        </div><!-- end of suggestions -->
        
        <div id="config">
		  	<table class="form">
			  	<tr>
					<td><?php echo $entry_sphinx_config_index_type; ?></td>
					<td>
						<select id="sphinx_config_index_type" name="sphinx_config_index_type">
		                  <?php if (isset($sphinx_config_index_type)) { ?>
		                  <option value="1" <?php if ($sphinx_config_index_type) echo 'selected="selected"'; ?> ><?php echo $text_rt_yes; ?></option>
		                  <option value="0" <?php if (!$sphinx_config_index_type) echo 'selected="selected"'; ?> ><?php echo $text_rt_no; ?></option>
		                  <?php } else { ?>
		                  <option value="1"><?php echo $text_rt_yes; ?></option>
		                  <option value="0" selected="selected"><?php echo $text_rt_no; ?></option>
		                  <?php } ?>
		                </select>
	              </td>
				</tr>
	            <tr>
	              <td><?php echo $entry_sphinx_config_path_to_indexes; ?></td>
	              <td>
	              	<input type="text" name="sphinx_config_path_to_indexes" value="<?php echo ($sphinx_config_path_to_indexes) ? $sphinx_config_path_to_indexes : ''; ?>" />
	              </td>
	            </tr>
	            <tr>
	              <td><?php echo $entry_sphinx_config_path_to_log; ?></td>
	              <td>
	              	<input type="text" name="sphinx_config_path_to_log" value="<?php echo ($sphinx_config_path_to_log) ? $sphinx_config_path_to_log : ''; ?>" />
	              </td>
	            </tr>	
	            <tr>
					<td><?php echo $entry_sphinx_config_generate_file; ?></td>
					<td colspan="2">
						<a id="genConfig" href="index.php?route=module/sphinxsearch/generateSphinxConfig&token=<?php echo $token; ?>" target="_blank" class="button"><span><?php echo $entry_sphinx_gen_config_btn; ?></span></a>
						<img id="loaderConfig" src="view/image/loading.gif" style="display: none" />
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<div class="attention"><?php echo $entry_sphinx_config_attention; ?></div>
					</td>
				</tr>
			</table>
		</div><!-- end of config -->
		
		<div id="rtIndex">
		  <table class="form">
			<tr id="buildProductsRtIndex">
				<td colspan="2">
					<a onclick="buildProductsRtIndex($(this), 0)" class="button"><span><?php echo $entry_sphinx_rtIndex_gen_products_btn; ?></span></a>
					<div id="progressBarProducts">
						<span class="msgConfig"><?php echo $text_calculating; ?></span>
						<div></div>
					</div>
					<img id="loaderProducts" src="view/image/loading.gif" style="display: none" />
				</td>
			</tr>
			
			<tr id="buildCategoriesRtIndex">
				<td colspan="2">
					<a onclick="buildCategoriesRtIndex($(this), 0)" class="button"><span><?php echo $entry_sphinx_rtIndex_gen_categories_btn; ?></span></a>
					<div id="progressBarCategories">
						<span class="msgConfig"><?php echo $text_calculating; ?></span>
						<div></div>
					</div>
					<img id="loaderCategories" src="view/image/loading.gif" style="display: none" />
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div class="attention"><?php echo $entry_sphinx_rtIndex_attention; ?></div>
				</td>
			</tr>
		  </table>
		</div><!-- end of indexType -->
        
      </form>
  </div>
</div>

<?php echo $footer; ?>

<script type="text/javascript">

$(document).ready(function(){

	$('.htabs a').tabs();
	$('.info').hide();
	$('button').click(function(){
		$('.info.'+$(this).attr('id')).show();
		return false;
	});
	
	var indexType = $('#sphinx_config_index_type').find(":selected").val();
	
	if(indexType == 1) {
		$('a.rtIndexTab').removeClass('hiddenTab');
		$('#config .attention').html("<?php echo $entry_sphinx_rtIndex_attention; ?>");
	}
	
	$('#sphinx_config_index_type').on('change', function (e) {
		var optionSelected = $("option:selected", this);
	   	var valueSelected = this.value;
	   	
	   	if(valueSelected == 1) {
	   		$('a.rtIndexTab').removeClass('hiddenTab');
	   		$('#config .attention').html("<?php echo $entry_sphinx_rtIndex_attention; ?>");
	   	} else {
	   		$('a.rtIndexTab').addClass('hiddenTab');
	   		$('#config .attention').html("<?php echo $entry_sphinx_config_attention; ?>");
	   	}
			   	
	});
	
	$('#genConfig').click(function(){
		$('#loaderConfig').show();
	
		var confirmVal = confirm('Do you want to save changes first?');
	
		if(confirmVal) {
			//Save data before generating file
			saveAndContinue(true);
		}
		
		location.href = $('#genConfig').attr('href');
		$('#loaderConfig').hide();
		
		return false;
	});
	
});

function saveAndContinue(isConfigFile) {
	
	$.ajax({
		type: 'POST',
		async: false,
		url: 'index.php?route=module/sphinxsearch/save&token=<?php echo $token; ?>',
		data: $('#form').serialize(),
		success: function(data) {
			if(isConfigFile) {
				$('#loaderConfig').hide();
				location.href = $('#genConfig').attr('href');
			}
		}
	});
}

function genSuggestions(el, offset) {
	
	var onClickAttr = el.attr('onclick');
	el.attr('onclick','').unbind('click');
	el.addClass('disabled');
	
	$('#progressBar').show();
	$('#loader').show();

	//Save before continue
	//saveAndContinue(false);

	$.ajax({
		type:'POST',
		url: 'index.php?route=module/sphinxsearch/generateSuggestions&offset='+offset+'&token=<?php echo $token; ?>',
		dataType: 'json',
		success: function(data) {
			if(data['error'] != '') {
				$('#progressBar').after("<span class='prError errors'>"+data['error']+"</span>");
				$('#progressBar').hide();
				$('#loader').hide();
				return;
			} 
			
			$('#progressBar .msg').empty();
			
			var percent = Math.floor((data['offset']/data['total']) * 100);
		
			$('#progressBar').find('div').animate({ width: percent + '%' }, 200).html(percent + "%&nbsp;");
			
			if(percent >= 100) {
				$('#progressBar').find('div').text('Done');
				$('#loader').hide();
				el.attr('onclick',onClickAttr).bind('click');
				el.removeClass('disabled');
			} else {
				genSuggestions(el, data['offset']);
			}

		}
	});
}

function buildProductsRtIndex(el, offset) {
	
	var onClickAttr = el.attr('onclick');
	el.attr('onclick','').unbind('click');
	el.addClass('disabled');
	
	$('#progressBarProducts').show();
	$('#loaderProducts').show();
	$('.prError').remove();

	//Save before continue
	//saveAndContinue(false);

	$.ajax({
		type:'POST',
		url: 'index.php?route=module/sphinxsearch/buildProductsRtIndex&offset='+offset+'&token=<?php echo $token; ?>',
		dataType: 'json',
		success: function(data) {
			
			if(data['error']) {
				$('#progressBarProducts').hide();
				$('#progressBarProducts').after("<span class='prError errors'>"+data['error']+"</span>");
				$('#loaderProducts').hide();
				el.attr('onclick',onClickAttr).bind('click');
				el.removeClass('disabled');
				return false;
			}
			
			var percent = Math.floor((data['offset']/data['total']) * 100);
		
			$('#progressBarProducts').find('div').animate({ width: percent + '%' }, 200).html(percent + "%&nbsp;");
			
			if(percent >= 100) {
				$('#progressBarProducts').find('div').text('Done');
				$('#loaderProducts').hide();
				el.attr('onclick',onClickAttr).bind('click');
				el.removeClass('disabled');
			} else {
				buildProductsRtIndex(el, data['offset']);
			}
		}
	});

}

function buildCategoriesRtIndex(el, offset) {
	
	var onClickAttr = el.attr('onclick');
	el.attr('onclick','').unbind('click');
	el.addClass('disabled');
	
	$('#progressBarCategories').show();
	$('#loaderCategories').show();
	$('.catError').remove();

	//Save before continue
	//saveAndContinue(false);

	$.ajax({
		type:'POST',
		url: 'index.php?route=module/sphinxsearch/buildCategoriesRtIndex&offset='+offset+'&token=<?php echo $token; ?>',
		dataType: 'json',
		success: function(data) {
			
			if(data['error']) {
				$('#progressBarCategories').hide();
				$('#progressBarCategories').after("<span class='catError errors'>"+data['error']+"</span>");
				$('#loaderCategories').hide();
				el.attr('onclick',onClickAttr).bind('click');
				el.removeClass('disabled');
				return false;
			}
			
			var percent = Math.floor((data['offset']/data['total']) * 100);
		
			$('#progressBarCategories').find('div').animate({ width: percent + '%' }, 200).html(percent + "%&nbsp;");
			
			if(percent >= 100) {
				$('#progressBarCategories').find('div').text('Done');
				$('#loaderCategories').hide();
				el.attr('onclick',onClickAttr).bind('click');
				el.removeClass('disabled');
			} else {
				buildCategoriesRtIndex(el, data['offset']);
			}
		}
	});
}
</script>