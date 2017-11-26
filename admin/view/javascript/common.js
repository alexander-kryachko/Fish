window.number_format = function(number, decimals, dec_point, thousands_sep){
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

$(document).ready(function() {
	$('#menu > ul').superfish({
		pathClass	 : 'overideThisToUse',
		delay		 : 0,
		animation	 : {height: 'show'},
		speed		 : 'normal',
		autoArrows   : false,
		dropShadows  : false, 
		disableHI	 : false, /* set to true to disable hoverIntent detection */
		onInit		 : function(){},
		onBeforeShow : function(){},
		onShow		 : function(){},
		onHide		 : function(){}
	});
	
	$('#menu > ul').css('display', 'block');
});
 
function getURLVar(key) {
	var value = [];
	
	var query = String(document.location).split('?');
	
	if (query[1]) {
		var part = query[1].split('&');

		for (i = 0; i < part.length; i++) {
			var data = part[i].split('=');
			
			if (data[0] && data[1]) {
				value[data[0]] = data[1];
			}
		}
		
		if (value[key]) {
			return value[key];
		} else {
			return '';
		}
	}
} 

$(document).ready(function() {
	route = getURLVar('route');
	
	if (!route) {
		$('#dashboard').addClass('selected');
	} else {
		part = route.split('/');
		
		url = part[0];
		
		if (part[1]) {
			url += '/' + part[1];
		}
		
		$('a[href*=\'' + url + '\']').parents('li[id]').addClass('selected');
	}
	
	$('#menu ul li').on('click', function() {
		$(this).addClass('hover');
	});

	$('#menu ul li').on('mouseout', function() {
		$(this).removeClass('hover');
	});	
});

function addOrderToCoupon(){
	var order_id = parseInt($('#addOrderToCoupon').val());
	var token = getURLVar('token');
	var coupon_id = getURLVar('coupon_id');
	if (!coupon_id || !order_id || isNaN(order_id) || order_id <= 0) return;
	$.post('/admin/index.php?route=sale/coupon/update&token='+token+'&coupon_id='+coupon_id, {'action': 'addOrder', 'order': order_id}, function(data){
		if (data) {
			alert(data);
			return false;
		}
		location.reload(true);
	});
}

function deleteOrderFromCoupon(order_id){
	if (!confirm('Вы уверены?')) return false;
	var order_id = parseInt(order_id);
	var token = getURLVar('token');
	var coupon_id = getURLVar('coupon_id');
	if (!coupon_id || !order_id || isNaN(order_id) || order_id <= 0) return;
	$.post('/admin/index.php?route=sale/coupon/update&token='+token+'&coupon_id='+coupon_id, {'action': 'deleteOrder', 'order': order_id}, function(data){
		if (data) {
			alert(data);
			return false;
		}
		location.reload(true);
	});
}

function addClientPref(){
	var token = getURLVar('token'),
		prefType = $('#addClientPrefForm input[name="prefType"').val().trim(),
		prefValue = $('#addClientPrefForm input[name="prefValue"').val().trim();
	if (prefType.length && prefValue.length){
		$.post('/admin/index.php?route=module/clientPrefs/add&token='+token, {'prefType': prefType, 'prefValue': prefValue}, function(data){
			if (data){
				window.location.reload(true);
			} else {
				alert('Такое предпочтение уже существует либо не может быть добавлено');
			}
		});
	}
}

function removeClientPref(pref_id){
	var token = getURLVar('token');
	$.post('/admin/index.php?route=module/clientPrefs/remove&token='+token, {'pref_id': pref_id}, function(data){
		window.location.reload(true);
	});
}