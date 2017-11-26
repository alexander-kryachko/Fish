window.psApi = '/catalog/view/theme/fisherway/scripts/productSelectionApi.php';

jQuery(function($){
	init();

    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete(this);
        this._createShowAllButton();
      },
 
      _createAutocomplete: function(wid) {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left ui-corner-right" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" ),
			appendTo: '#autocomplete-widget .custom-combobox',
			autoFocus: true,
			select: function(event, ui){
				ui.item.option.selected = true;
				$('#autocomplete-widget #category option[value="'+ui.item.option.value+'"]').attr('checked', 'checked');
				$('#autocomplete-widget #category').trigger('change');
				input.trigger('blur');				
			},
			change: function(event, ui){
				wid._removeIfInvalid(event, ui);
			},
          });
		  var input = this.input;
		  
		  input.bind('focus click', function(){
			wasOpen = input.autocomplete("widget" ).is(":visible");
			if (!wasOpen) {
				input.autocomplete("search", "");
			}
			$(this).select();
		  });
      
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", "Show All Items" )
          /*.tooltip()*/
          .appendTo('#autocomplete-widget .custom-combobox')
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .on( "mousedown", function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .on( "click", function() {
            input.trigger( "focus" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " didn't match any item" );
          /*.tooltip( "open" );*/
        this.element.val( "" );
        this._delay(function() {
          this.input/*.tooltip( "close" )*/.attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
 
});

function init(){
	var html = '<p>Загружаем категории&hellip;</p>';
	$('#product-selection-container').html(html);
	$.get(psApi+'?categories', function(result){
		eval('var result = '+result+';');
		var html = '<p><span class="position:relative !important;" id="autocomplete-widget"><select id="category" onchange="selectCategory(event);">';
		html += '<option value="0"></option>';
		for(i in result) html += '<option value="'+result[i]['id']+'">'+result[i]['name']+'</option>';
		html += '</select></span></p>';
		html += '<p>Бюджет от <input type="text" name="priceFrom" id="priceFrom" value="0" size="4" /> до <input type="text" name="priceTo" id="priceTo" value="10000" size="4" /> грн</p>';
		html += '<p><label><input type="checkbox" name="notavailable" id="notavailable" /> показывать &laquo;не в наличии&raquo;</label></p>';
		html += '<p><label><input type="checkbox" name="fdisabled" id="fdisabled" /> показывать отключенные</label></p>';
		html += '<div id="options"></div>';
		html += '<div id="get"><button onclick="search(event);">Подобрать</button></div><br />';
		html += '<div id="products"></div>';
		$('#product-selection-container').html(html);

		$("#category" ).combobox();
		$("#toggle").on("click", function() {
			$("#category").toggle();
		});
		
		// class="custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left ui-autocomplete-input ui-autocomplete-loading"		
		

	});
}

function test(){
	$.get(psApi+'?test', function(result){
		alert(result)
	});
}

function selectCategory(){
	var category = parseInt($('#category option:selected').val());
	$('#get').hide();
	$('#products').html('');

	if (category){
		$('#options').html('<p>Загружаем характеристики&hellip;</p>');
		$.get(psApi+'?options='+category, function(result){
			eval('var options = '+result+';');

			var o, v, s, m, mv, html = '';
			var cols = [0, 0, 0];
			if (options.length){
				html = '<details open="open" id="details"><summary>Характеристики</summary>';
				html += '<div class="filterColumn" id="col0"></div>';
				html += '<div class="filterColumn" id="col1"></div>';
				html += '<div class="filterColumn" id="col2"></div>';
				html += '</details><br />';
				$('#options').html(html);
				
				var ok = false;
				for(i in options){
					o = options[i];
					if (o['values'] === undefined || o['values'].length == 0) continue;
					ok = true;
					htmlAdd = '<strong>'+o['name']+'</strong><br />';
					for(j in o['values']){
						v = o['values'][j];
						htmlAdd += '<label><input type="'+(o['type'] == 'radio' ? 'radio' : 'checkbox')+'" name="val['+o['option_id']+'][]" value="'+v['value_id']+'" /> '+v['name']+'</label><br />';
					}
					htmlAdd += '<br />';
					s = 2 + o['values'].length;
					m = -1;
					mv = 0;
					for(var k=0;k<3;k++) if (cols[k] < mv || m == -1){m = k; mv = cols[k];}
					cols[m] += s;
					//alert(m + ' : ' + htmlAdd);
					$('#col'+m).append(htmlAdd);
				}
				if (!ok) $('#options').html('<p class="noFilters">Нет характеристик</p>');
			} else {
				$('#options').html('<p class="noFilters">Нет характеристик</p>');
			}
			$('#get').show();
		});
	} else {
		$('#options').html('');
		$('#get').hide();
		$('#products').html('');
	}
}

function search(){
	if ($('#details').size() > 0) $('#details').attr('open', false);
	$('#products').html('Загружаем товары&hellip;');
	
	var values = [];
	$('#options input:checked').each(function(){
		values[values.length] = $(this).val();
	});

	var data = {
		'category': parseInt($('#category option:selected').val()),
		'priceFrom': parseFloat($('#priceFrom').val().trim()),
		'priceTo': parseFloat($('#priceTo').val().trim()),
		'priceTo': parseFloat($('#priceTo').val().trim()),
		'notavailable': $('#notavailable').prop('checked'),
		'fdisabled': $('#fdisabled').prop('checked'),
		'values': values
	};
	$.post(psApi+'?products', data, function(result){
		eval('var products = '+result+';');
		var html = '', row, i;
		if (products.length){
			html += '<table class="product-selection-table">';
			for(i in products){
				row = products[i];
				html += '<tr>';
				html += '<td style="text-align:center;"><img src="'+(row['image'] ? '/image/'+row['image'] : 'about:blank')+'" class="thumb"/></td>';
				html += '<td><a href="'+row['url']+'"><strong>'+row['name']+'</strong></a> &nbsp; <small>'+row['sku']+'</small>';
				if (row['attributes'].length){
					html += '<div class="attrs">';
					html += row['attributes'].join(' &nbsp;&nbsp;|&nbsp;&nbsp; ');
					html += '</div>';
				}
				html += '</td>';
				html += '<td class="pr">'+number_format(row['finalPrice'], 2, '.', '')+' грн</td>';
				html += '<td class="pr" style="color:#999;font-size:11px;">+'+number_format(row['margin'], 2, '.', '')+' грн</td>';
				html += '<td class="bt">';
				if (!parseInt(row['status'])) html += '<small style="color:red;">отключен</small>';
				else if (!parseInt(row['quantity'])) html += '<small style="color:red">нет</small>';
				else html += '<button onclick="addToCart(\''+row['product_id']+'\');">Купить</button>';
				html += '</td>';
html += '<td class="bt" style="width: 5%;">'+row['jan']+'</td>';
				html += '</tr>';
			}
			html += '</table>';
			$('#products').html(html);
		} else {
			$('#products').html('Не найдено подходящих товаров');
		}
	});
}

function number_format(number, decimals, dec_point, thousands_sep){
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? '' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}