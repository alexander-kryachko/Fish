jQuery(function($) {

    //sliders on home page
    $(".product-slider").slides();
    $(".b-slider-comp").slides();




    //styling radio buttons for iOS
    var deviceAgent = navigator.userAgent.toLowerCase();
    var iOS = deviceAgent.match(/(iphone|ipod|ipad)/);
    if (iOS) {
        $('.competition-box .e-slide-comp label').click(function (event) {
            $('#' + $(event.target).attr('for')).attr('checked', true).change();
        });
    }

    //product picture gallery
    $(function(){
            $('#product-pictures').slidespr({
                preload: true,
                preloadImage: 'img/loading.gif',
                effect: 'slide, fade',
                crossfade: true,
                slideSpeed: 500,
                fadeSpeed: 500,
                generateNextPrev: true,
                paginationClass: 'picture-pagination',
                generatePagination: false
            });
        });

        //anchor for iframe
        $('iframe:first').attr('id', 'video');

        //label stars review
        $('.product-review .product_stars input:radio').click(function() {
            $('.product-review .product_stars label').each(function() {
                $(this).removeClass('checked-label');
                $(this).removeClass('full-label');
            });
            $(this).next('label').addClass('checked-label');
            $('.product-review .product_stars label').each(function() {
                if (!$(this).hasClass('checked-label')) {
                    $(this).addClass('full-label');
                    //console.log('sss<br>');
                }
                else { return false; }
            });
        });

        //label stars review
        $('.product-review .service_stars input:radio').click(function() {
            $('.product-review .service_stars label').each(function() {
                $(this).removeClass('checked-label');
                $(this).removeClass('full-label');
            });
            $(this).next('label').addClass('checked-label');
            $('.product-review .service_stars label').each(function() {
                if (!$(this).hasClass('checked-label')) {
                    $(this).addClass('full-label');
                    //console.log('sss<br>');
                }
                else { return false; }
            });
        });

        $('.checkout-page .checkout-registr input:text').mouseover(function() {
            $(this).next('.error').remove();
            //console.log('hggh');
        }
        );
        
        
        
		
/*		
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
		window.onbeforeunload = function($)
   {
   		var popup_win = $('#popup-block').colorbox();
   		return popup_win;
   }
*/
});
