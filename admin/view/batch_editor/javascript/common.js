var xhr = null;
var timeoutID = 0;
var product_top = 0;
var loading = '<img src="view/batch_editor/image/loading.gif" />';
var loading30 = '<img src="view/batch_editor/image/loading30.gif" />';

function inputFormDisabled(this_) {
	if ($(this_).attr('checked') == 'checked') {
		$(this_).parents('form:first').find('input').not(this_).attr('disabled', 'disabled');
	} else {
		$(this_).parents('form:first').find('input').not(this_).removeAttr('disabled');
	}
}

function creatMessage(json) {
	clearTimeout(timeoutID);
	$('#message').remove();
	$('body').append('<div id="message"></div>');
	
	var message = $('#message');
	
	if (json['warning']) {
		message.html(json['warning']).addClass('warning shadow');
	} else if (json['attention']) {
		message.html(json['attention']).addClass('attention shadow');
	} else {
		message.html(json['success']).addClass('success shadow');
	}
	
	message.css({'bottom':-$(this).height(), 'right':'15px', 'position':'fixed', 'padding':'70px', 'font-size':'13px', 'font-weight':'bold', 'z-index':'10001'}).animate({bottom:0}, 500);
	
	if (json['attention']) {
		message.prepend('<img style="cursor:pointer;float:right;margin-top:-60px;margin-right:-60px;" onclick="$(\'#message\').fadeOut(\'fast\');" src="view/batch_editor/image/close.png">');
	} else {
		timeoutID = setTimeout (function() { message.animate({bottom: -$(this).height()}, 5000); }, 4000);
	}
}

function creatOverlayLoad(action) {
	if (action) {
		$('#messageLoad').html(loading30 + '<div></div><input type="button" onclick="xhrAbort(); creatOverlayLoad(false);" value="stop" style="width:100px;" />');
		$('#overlay, #messageLoad').show();
	} else {
		$('#messageLoad').html('');
		$('#overlay, #messageLoad').hide();
	}
}

function creatDialog(name) {
	$('#' + name).remove();
	$('.image_manager').remove();
	$('body').append('<div id="' + name + '"></div>');
	$('#' + name).dialog({height:'auto', width:'90%', modal:true, bgiframe:true, resizable:true, autoOpen:false});
	return $('#' + name);
}

function removeTableRow($this) {
	var table = $($this).parents('table');
	var colspan = $($this).parents('tr').children('td').length;
	
	$($this).parents('tbody').remove();
	
	if (table.children('tbody').length == 0) {
		var html = '';
		
		html += '<tbody class="no_results">'
		html += ' <tr>';
		html += '  <td class="center" colspan="' + colspan + '"><div class="attention" align="center">' + text_no_results + '</div></td>';
		html += ' </tr>';
		html += '</tbody>';
		
		table.append(html);
	}
}

function selectTableRow(this_) {
	$(this_).parents('form').find('input[type=\'radio\']').not(this_).removeAttr('checked');
	$(this_).parents('form').find('tbody.selected').removeClass('selected');
	$(this_).parents('tbody').addClass('selected');
	
	var checkbox = $(this_).parents('tbody').find('input[type=\'checkbox\']');
	checkbox.attr('checked', 'checked');
	checkbox.parents('td').removeClass('disabled').addClass('enabled');
}

function selectTableTd(this_) {
	if ($(this_).val() == 1) {
		$(this_).parents('td').removeClass('disabled').addClass('enabled');
	} else {
		$(this_).parents('td').removeClass('enabled').addClass('disabled');
	}
}

function checkedTableTd(this_) {
	if ($(this_).attr('checked')) {
		$(this_).parents('td').removeClass('disabled').addClass('enabled');
	} else {
		$(this_).parents('td').removeClass('enabled').addClass('disabled');
		var radio = $(this_).parents('tbody').removeClass('selected').find('input[type=\'radio\']');
		
		if (radio.attr('checked')) {
			$('#no_checked').trigger('click');
		}
	}
}

function creatProductClone() {
	$(document).ready(function(e) {
		$('#product-clone').remove();
		
		$('#product').before('<table id="product-clone" class="be-list shadow" style="display:none; position: relative; z-index:1000;"><thead><tr class="sort"></tr></thead></table>');
		
		$('#product thead tr:first td').each(function(index, element) {
			$('#product-clone thead tr').append('<td><div></div></td>');
			
			$('#product-clone thead tr td:eq(' + $(element).index() + ') div').css({'width':$(element).outerWidth() - 11}).after($(element).html()).parent().addClass($(element).attr('class'));
		});
		
		$(window).scroll(function() {
			if (product_top == 0) {
				product_top = $('#product').offset().top;
			}
			
			if ($(this).scrollTop() > product_top + $('#product thead').height()) {
				$('#product-clone').css({'display':'inline-table', 'top':$(this).scrollTop() - product_top});
			} else {
				$('#product-clone').css({'display':'none'});
				
				product_top = 0;
			}
		});
	});
	
	$(window).trigger('scroll');
}

function xhrAbort() {
	xhr.abort();
	xhr = null;
}

$(document).ready(function() {
	$('body').prepend('<div id="messageLoad"></div><div id="overlay"></div>');
});