/*** Плагин предложения скидки ***/
$.fn.discount = function(options) {
	/*** Создаём настройки по-умолчанию, расширяя их с помощью параметров, которые были переданы ***/
	var settings = $.extend({
		'animationTime': 500,
		'coockieName': 'discount_show',
		'coockieValue': 'No',
		'coockieExpiresDays': 7,
		'dialogText': 'Остаться на странице и получить скидку?',
		'popupBlockSelector': '#popup-block',	// Селектор popup блока
		'popupShadowboxBlockSelector': '.popup-bg',	// Селектор тени popup блока
		'popupCloseSelector': '.close-popup'
	}, options);

	var animationTime = settings.animationTime;
	var coockieName = settings.coockieName;
	var coockieValue = settings.coockieValue;
	var dialogText = settings.dialogText;
	var coockieExpiresDays = settings.coockieExpiresDays;
	var popupBlock = $(this).find(settings.popupBlockSelector);
	var popupShadowboxBlock = $(this).find(settings.popupShadowboxBlockSelector);
	var popupClose = $(this).find(settings.popupCloseSelector);
	var isDiscount = 0;
	var checkCoockie = getCookie(coockieName);

	$('a').live('click', function() { isDiscount = 1; });
	$('form').bind('submit', function() { isDiscount = 1; });
	if(checkCoockie == coockieValue) {
		isDiscount = 1;
	};

	function setCookie(key, value) {
		var expires = new Date();
		expires.setTime(expires.getTime() + (coockieExpiresDays * 24 * 60 * 60 * 1000));
		document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
	};

	function getCookie(key) {
		var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
		return keyValue ? keyValue[2] : null;
	};

	function showDiscount() {
			//Таймер для попапа 
			$('#timer-close').FlipClock(300, {
				clockFace: 'MinuteCounter',
					countdown: true,
					callbacks: {
						stop: function() {
							$('.message').html('The clock has stopped!')
						}
					}
			});
			popupShadowboxBlock.show();
			popupBlock.show();
			popupShadowboxBlock.on('click',function() {
				popupBlock.hide();
				popupShadowboxBlock.hide();
			});
			popupClose.on('click',function() {
				popupBlock.hide();
				popupShadowboxBlock.hide();
			});
			setCookie(coockieName, coockieValue)
			isDiscount = 1;

	};

	$(window)
		.off()
		.on('beforeunload', function(event){
			if(0 == isDiscount) {
				showDiscount();
				setTimeout(function() {
				}, 10);
				return dialogText;
			}
		});
};

$(document).ready(function() {
	$('body').discount();
});