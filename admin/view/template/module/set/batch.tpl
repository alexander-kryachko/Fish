<?php echo $header; ?>
<div id="content">
	<link rel="stylesheet" type="text/css" href="view/stylesheet/ocfilter/ocfilter.css" />
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
		<h1><img src="view/image/module.png" alt="" /> <?php echo 'Пакетное формирование'; ?></h1>
		<div class="buttons">
			<a onclick="location = '<?php echo $restock; ?>';" class="button">Статусы по наличию</a>
			<a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo 'Выйти'; ?></span></a>
		</div>
    </div>
    <div class="content">
       
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
		
            <div id="tab-set">
                <table class="form batch">
					<thead>
						<tr>
							<th></th>
							<th>Товар 1</th>
							<th></th>
							<th>Товар 2</th>
						</tr>
					</thead>
					<tbody>
                    <tr>
                      <td><?php echo 'Категории товаров:'; ?></td>
                      <td><div class="scrollbox">
                          <?php $class = 'odd'; ?>
                          <?php foreach ($categories as $category) { ?>
                          <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                          <div class="<?php echo $class; ?>">
                            <?php if (in_array($category['category_id'], $batch_categories1)) { ?>
                            <input type="checkbox" name="batch_category1[]" value="<?php echo $category['category_id']; ?>" checked="checked" />
                            <?php echo $category['name']; ?>
                            <?php } else { ?>
                            <input type="checkbox" name="batch_category1[]" value="<?php echo $category['category_id']; ?>" />
                            <?php echo $category['name']; ?>
                            <?php } ?>
                          </div>
                          <?php } ?>
                        </div>
                        <a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo 'Выделить все'; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo 'Снять выделение'; ?></a>
					  </td>
                      <td><?php echo 'Категории товаров:'; ?></td>
                      <td><div class="scrollbox">
                          <?php $class = 'odd'; ?>
                          <?php foreach ($categories as $category) { ?>
                          <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                          <div class="<?php echo $class; ?>">
                            <?php if (in_array($category['category_id'], $batch_categories2)) { ?>
                            <input type="checkbox" name="batch_category2[]" value="<?php echo $category['category_id']; ?>" checked="checked" />
                            <?php echo $category['name']; ?>
                            <?php } else { ?>
                            <input type="checkbox" name="batch_category2[]" value="<?php echo $category['category_id']; ?>" />
                            <?php echo $category['name']; ?>
                            <?php } ?>
                          </div>
                          <?php } ?>
                        </div>
                        <a onclick="$(this).parent().find(':checkbox').attr('checked', true);"><?php echo 'Выделить все'; ?></a> / <a onclick="$(this).parent().find(':checkbox').attr('checked', false);"><?php echo 'Снять выделение'; ?></a>
					  </td>					  
                    </tr>
					<tr class="filtersrow">
                      <td><?php echo 'Фильтр по атрибутам:'; ?></td>
					  <td><input type="text" name="addfilter[1][name]" value="" /><input type="hidden" name="addfilter[1][attribute_id]" value="" /> <a class="button" onclick="addFilterAttribute(1);">Добавить атрибут</a></td>
					  <td><?php echo 'Фильтр по атрибутам:'; ?></td>
					  <td><input type="text" name="addfilter[2][name]" value="" /><input type="hidden" name="addfilter[2][attribute_id]" value="" /> <a class="button" onclick="addFilterAttribute(2);">Добавить атрибут</a></td>
					</tr>
					</tbody>
					<tbody id="attributes">
						<tr>
							<td colspan="2"><table><tbody id="attributes1"></tbody></table></td>
							<td colspan="2"><table><tbody id="attributes2"></tbody></table></td>
						</tr>
					</tbody>
					<tbody>
					<tr style="border-top:1px solid #633;">
                      <td><?php echo 'Диапазон цен:'; ?></td>
					  <td><input type="text" name="batch_price_from1" value="" size="5" /> &nbsp;&ndash;&nbsp; <input type="text" name="batch_price_to1" value="" size="5" /> грн.</td>
					  <td><?php echo 'Диапазон цен:'; ?></td>
					  <td><input type="text" name="batch_price_from2" value="" size="5" /> &nbsp;&ndash;&nbsp; <input type="text" name="batch_price_to2" value="" size="5" /> грн.</td>
					</tr>
					<tr class="productsline">
						<?php /*
						<td><?php echo 'Выберите товар:<br /><small>В дополнение или вместо фильтров</small>'; ?></td>
						<td><input type="text" name="product_search1" value="" /></td> */?> 
						<td></td>
						<td></td>
						<td><?php echo 'Выберите товар:<br /><small>В дополнение или вместо фильтров</small>'; ?></td>
						<td><input type="text" name="product_search2" value="" /></td>
					</tr>
					</tbody>
					<tbody id="products">
						<tr>
							<td colspan="2"><table><tbody id="products1"></tbody></table></td>
							<td colspan="2"><table><tbody id="products2"></tbody></table></td>
						</tr>
					</tbody>
					<tbody>					
					<tr>
                      <td><?php echo 'Количество:'; ?></td>
					  <td><input type="text" name="batch_quantity1" value="1" size="5" /></td>
					  <td><?php echo 'Скидка:'; ?></td>
					  <td><input type="text" name="batch_discount" value="" size="5" /> %</td>
					</tr>
					<tr>
                      <td></td>
					  <td></td>
					  <td><?php echo 'Количество:'; ?></td>
					  <td><input type="text" name="batch_quantity2" value="1" size="5" /></td>
					</tr>
					<tr>
					</tr>
					</tbody>
                </table>
				<div align="center" id="batchBtns">
					<a class="button" data-action="batch">Создать комплекты</a> &nbsp;&nbsp;&nbsp; 
					<a class="button" data-action="unbatch">Удалить комплекты</a> &nbsp;&nbsp;&nbsp; 
					<a class="button" onclick="location.reload(true);">Очистить форму</a> &nbsp;&nbsp;&nbsp; 
				</div>
          </div>
  		</form>
    </div>
	</div>
    
    <div id="window-option">
    </div>
</div>

<script type="text/javascript"><!--
$.widget('custom.catcomplete', $.ui.autocomplete, {
    _renderMenu: function(ul, items) {
        var self = this, currentCategory = '';
        $.each(items, function(index, item) {
            if (item.category != currentCategory) {
                ul.append('<li class="ui-autocomplete-category">' + item.category + '</li>');
                currentCategory = item.category;
            }
            self._renderItem(ul, item);
        });
    }
});

/* OCFilter option values switcher */
$(document).on('click', '.switcher .selected', function(e) {
	var $this = $(this).parent('.switcher');
	if (!$this.hasClass('active')) {
		$('.switcher').removeClass('active');
		$this.addClass('active');
	} else {
		$this.removeClass('active');
	}
});

$(document).on('change', '.switcher input[type=\'checkbox\']', function() {
	var $this = $(this), selected = $this.parents('.switcher').find('.selected'), text = $this.parent('label').text(), length = selected.find('span').length, counter = selected.find('strong').length;
	if (counter) {
		selected.find('strong').text($this.parents('.switcher').find('.values input[name*=\'[options_id][]\']:checked').length);
	} else {
		if ($this.attr('checked')) {
			selected.append('<span id="v-' + this.value + '">' + text + '</span>').find('b').remove();
		} else {
			if (length === 1) {
				$('#v-' + this.value).replaceWith('<b>- Выберите -</b>');
			} else {
				$('#v-' + this.value).remove();
			}
		}
	}
});

$(document).click(function(e){
	if (!$(e.target).parents('.switcher').length) $('.switcher.active').removeClass('active');
	/*if (!$(e.target).parents('#colorbox').length) {
		$('#colorbox').remove();
		$('a.color-handler').removeClass('active');
	}*/
});

$(document).ready(function(){
	$('#batchBtns a[data-action]').bind('click', function(){
		if ($(this).hasClass('disabled')) return false;
		$('#batchBtns a').addClass('disabled');
		var post = {};
		post['batch_category1'] = $.makeArray($("input[name*=batch_category1]:checked").map(function(i, e){return $(e).val();}));
		post['batch_category2'] = $.makeArray($("input[name*=batch_category2]:checked").map(function(i, e){return $(e).val();}));
		post['ocfilter_product_option1'] = {};
		post['ocfilter_product_option2'] = {};
		$("#attributes1 input[name*=ocfilter_product_option]:checked").each(function(){
			var oid = $(this).attr('name').match(/ocfilter_product_option\[(\d+)\]/)[1];
			if (post['ocfilter_product_option1'][oid] === undefined) post['ocfilter_product_option1'][oid] = [];
			post['ocfilter_product_option1'][oid].push($(this).val());
		});
		$("#attributes2 input[name*=ocfilter_product_option]:checked").each(function(){
			var oid = $(this).attr('name').match(/ocfilter_product_option\[(\d+)\]/)[1];
			if (post['ocfilter_product_option2'][oid] === undefined) post['ocfilter_product_option2'][oid] = [];
			post['ocfilter_product_option2'][oid].push($(this).val());
		});
		post['batch_price_from1'] = parseFloat($("input[name=batch_price_from1]").val())||0;
		post['batch_price_to1'] = parseFloat($("input[name=batch_price_to1]").val())||0;
		post['batch_price_from2'] = parseFloat($("input[name=batch_price_from2]").val())||0;
		post['batch_price_to2'] = parseFloat($("input[name=batch_price_to2]").val())||0;
		post['batch_quantity1'] = parseInt($("input[name=batch_quantity1]").val())||0;
		post['batch_quantity2'] = parseInt($("input[name=batch_quantity2]").val())||0;
		post['batch_discount'] = parseFloat($("input[name=batch_discount]").val())||0;
		post['action'] = $(this).attr('data-action');
		post['products1'] = $.makeArray($("#products1 input[type='hidden']").map(function(i, e){return $(e).val();}));
		post['products2'] = $.makeArray($("#products2 input[type='hidden']").map(function(i, e){return $(e).val();}));
		
		var error = false;
		//if (!post['batch_category1'].length || !$("#attributes1 input[name*=ocfilter_product_option]:checked").size()) error = 'Выберите товар 1 (категорию и атрибуты)';
		if (!post['batch_category1'].length) error = 'Выберите категорию товара 1';
		//else if ((!post['batch_category2'].length || !$("#attributes2 input[name*=ocfilter_product_option]:checked").size()) && !post['products2'].length) error = 'Выберите товар 2 (или категорию и атрибуты1)';
		else if (!post['batch_category2'].length && !post['products2'].length) error = 'Выберите категорию товара 2 или сам товар';
		else if (post['action'] == 'batch' &&(post['batch_quantity1'] < 1 || post['batch_quantity2'] < 1)) error = 'Укажите количество товаров';
		else if (post['action'] == 'batch' &&(post['batch_discount'] < 1)) error = 'Укажите скидку';

		if (error){
			alert(error);
			$('#batchBtns a').removeClass('disabled');
			return false;
		}
		$.post('index.php?route=module/set/batch&token=<?php echo $token; ?>', post, function(data){
			if (data) alert(data);
			$('#batchBtns a').removeClass('disabled');
			//location.reload(true);
		});
	});
});

$('input[name=\'product_search2\']').autocomplete({
	delay: 0,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.product_id,
                        price: item.price
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		var n = 2;
		$('input[name="product_search'+n+'"]').val('');
		if (!ui.item.label) return false;
		var html = [];
		var pid = ui.item.value;
		if ($('#products'+n+' tr[data-pid="'+pid+'"]').size() > 0){
			alert('Товар уже добавлен');
			return false;
		}
		html.push('<tr class="product" data-pid="'+pid+'">');
		html.push('<td width="100%"><input type="hidden" name="products['+n+'][]" value="'+pid+'" />');
		html.push(ui.item.label + '<br /><small><a class="del" onclick="$(this).parents(\'tr.product\').remove();">Удалить</a></small>');
		html.push('</td></tr>');
		$('#products'+n).append(html.join(''));
		return false;
	},
	focus: function(event, ui) {
      return false;
	}
});

function addFilterAttribute(n){
	var oid = parseInt($('input[name="addfilter['+n+'][attribute_id]"]').val());
	if (!oid) {
		alert('Выберите атрибут, пользуясь выпадающей подсказкой');
		return false;
	}
	
	$.post('index.php?route=module/set/batch&token=<?php echo $token; ?>', {'action': 'add', 'oid': oid}, function(data){
		$('input[name="addfilter['+n+'][name]"]').val('');
		$('input[name="addfilter['+n+'][attribute_id]"]').val(0);
		if (!data) return false;
		eval('var data = '+data+';');
		if (data.message){
			alert(data.message);
			return false;
		}
		var html = [];
		var option = data.option;
		if ($('#attributes'+n+' tr.attr[data-oid="'+option.option_id+'"]').size() > 0){
			alert('Атрибут уже добавлен');
			return false;
		}
		html.push('<tr class="'+(!option.status ? 'disabled ' : '')+'attr" data-oid="'+option.option_id+'">');
		html.push('<td width="30%">' + option.name + '<br /><small><a class="del" onclick="$(this).parents(\'tr.attr\').remove();">Удалить</a></small></td><td width="70%">');
		if (option.values) {
			var values = [];
			var sortable = [];
			for (var j in option.values) sortable.push(option.values[j])
			sortable.sort(function(a, b) {return a['name'].toLowerCase().localeCompare(b['name'].toLowerCase());})
			for (var j in sortable) {
				var value = sortable[j];
				//if (value.selected) selecteds.push('<span id="v-' + value.value_id + '">' + value.name + option.postfix + '</span>');
				values.push('<div>');
				values.push(' <label><input type="checkbox" name="ocfilter_product_option[' + option.option_id + '][values][' + value.value_id + '][selected]" value="' + value.value_id + '"' + (value.selected ? ' checked="checked"' : '') + ' />' + value.name + option.postfix + '</label>');
				//for (var l = 0; l < ocfilter.php.languages.length; l++){
					//values.push('&nbsp;<input type="text" name="ocfilter_product_option[' + option.option_id + '][values][' + value.value_id + '][description][' + ocfilter.php.languages[l].language_id + '][description]" value="' + value.description[ocfilter.php.languages[l].language_id].description + '" size="30" style="background-image: url(\'view/image/flags/' + ocfilter.php.languages[l].image + '\');" />');
				//}
				//values.push('&nbsp;<input type="text" name="ocfilter_product_option[' + option.option_id + '][values][' + value.value_id + '][description][1][description]" value="" size="30" />');
				values.push('</div>');
			}
			//if (!selecteds.length) 
			selecteds = ['<b>- Выберите -</b>'];
			html.push('<div class="switcher"><div class="selected">' + selecteds.join('') + '</div><div class="values">' + values.join('') + '</div>');
		} else {
			html.push('<a href="index.php?route=catalog/ocfilter/update&token=<?php echo $token; ?>&option_id=' + option.option_id + '" target="_blank">Обновить</a>');
		}
        html.push('</td></tr>');
        $('#attributes'+n).append(html.join(''));	
	});
}

function attributeautocomplete(n) {
    $('input[name=\'addfilter[' + n + '][name]\']').catcomplete({
        delay: 500,
        source: function(request, response) {
            $.ajax({
                url: 'index.php?route=catalog/ocfilter/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
                dataType: 'json',
                success: function(json) {
                    response($.map(json, function(item) {
                        return {
                            category: '',
                            label: item.name,
                            value: item.option_id
                        }
                    }));
                }
            });
        },
        select: function(event, ui) {
            $('input[name=\'addfilter[' + n + '][name]\']').attr('value', ui.item.label);
            $('input[name=\'addfilter[' + n + '][attribute_id]\']').attr('value', ui.item.value);
            return false;
        },
        focus: function(event, ui) {
            return false;
        }
    });
}

attributeautocomplete(1);
attributeautocomplete(2);

//--></script>

<?php echo $footer; ?>