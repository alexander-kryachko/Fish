"use strict";
var clock;
$(function(){

	// Grab the current date
	var currentDate = new Date();

	// Set some date in the future. In this case, it's always Jan 1
	var futureDate  = new Date(2017, 10, 24);

	// Calculate the difference in seconds between the future and current date
	var diff = futureDate.getTime() / 1000 - currentDate.getTime() / 1000;

	// Instantiate a coutdown FlipClock
	clock = $('.clocks').FlipClock(diff, {
		clockFace: 'DailyCounter',
		countdown: true,
		language:"ru"
	});



	var ifMob=false, ifTab=false, ifPortrait=false;
	var carSlides=4;
	function checkSize(){
		ifMob=false, ifTab=false, ifPortrait=false;
		if($(window).width()<1200) ifTab=true;
		if($(window).width()<768) ifMob=true;
		if($(window).width()<1000) ifPortrait=true;
		if($(window).width()>=1000) carSlides=4;
		if(ifPortrait) carSlides=3;
		if(ifMob) carSlides=1;

	}
	checkSize();

	/*** BANNER SLIDESHOW ***/
    $('.slideshow').each(function(){
        var $this = $(this);
        $this.data('linkedEl', $this.bxSlider({
            auto: true,
            controls: true,
            pager: true,
            pause: 6500,
            autoHover: true,
            speed:500,
            adaptiveHeight: false,
            touchEnabled:false
        }));
    })
    $('.testimonial-slider').each(function(){
        var $this = $(this);
        $this.data('linkedEl', $this.bxSlider({
            auto: true,
            controls: false,
            pager: true,
            pause: 6500,
            autoHover: true,
            speed:500,
            adaptiveHeight: false,
            touchEnabled:false
        }));
    })
    $('.items-slider').each(function(){
        var $this = $(this);
        $this.data('linkedEl', $this.bxSlider({
            auto: true,
            controls: true,
            pager: false,
            pause: 6500,
            autoHover: true,
            speed:500,
            adaptiveHeight: false,
            touchEnabled:false
        }));
    })


	/*** BANNER CARUSEL ***/
	$('.items-carusel').each(function(){
		var $this = $(this);
        $this.data('linkedEl', $this.bxSlider({
		   	minSlides: carSlides,
  			maxSlides: carSlides,
  			slideWidth: 16400,
  			slideMargin: 0,
  			pager:false,
  			controls:true,
  			autoHover: true,
  			speed:499,
            auto:false,
            touchEnabled:false
		}));
	})	
	if(ifPortrait){
		$('.items-list-content').each(function(){
			var $this = $(this);
	        $this.data('linkedEl', $this.bxSlider({
			   	minSlides: carSlides,
	  			maxSlides: carSlides,
	  			slideWidth: 16400,
	  			slideMargin: 0,
	  			pager:false,
	  			controls:true,
	  			autoHover: true,
	  			speed:499,
	            auto:false,
	            touchEnabled:false
			}));
		})	
	}


	//$('.phone-number').attr('type','tel');

	$('.ocfilter-column-left>.box-content').before('<div class="toggle-filter"><span>Фильтр</span></div>');
	$('.toggle-filter').click(function(){
		$(this).addClass('clicked').siblings('.box-content').slideToggle();
	})


	function resizedw(){
	    checkSize();
	    $('.slideshow').each(function(){
	    	$(this).data('linkedEl').reloadSlider();
	    })
	    $('.testimonial-slider').each(function(){
	    	$(this).data('linkedEl').reloadSlider();
	    })
	    $('.items-slider').each(function(){
	    	$(this).data('linkedEl').reloadSlider();
	    })
	    $('.items-carusel').each(function(){
	    	$(this).data('linkedEl').destroySlider();
			var $this = $(this);
	        $this.data('linkedEl', $this.bxSlider({
			   	minSlides: carSlides,
	  			maxSlides: carSlides,
	  			slideWidth: 16400,
	  			slideMargin: 0,
	  			pager:false,
	  			controls:true,
	  			autoHover: true,
	  			speed:499,
	            auto:false
			}));

	    })
		$('.items-list-content').each(function(){
			if($(this).parents('.bx-wrapper').length){
	    		$(this).data('linkedEl').destroySlider();
			}
			if(ifPortrait){
				$('.items-list-content').each(function(){
					var $this = $(this);
			        $this.data('linkedEl', $this.bxSlider({
					   	minSlides: carSlides,
			  			maxSlides: carSlides,
			  			slideWidth: 16400,
			  			slideMargin: 0,
			  			pager:false,
			  			controls:true,
			  			autoHover: true,
			  			speed:499,
			            auto:false
					}));
				})	
			}


		})
	}

	var doit;
	window.onresize = function(){
	  clearTimeout(doit);
	  doit = setTimeout(resizedw, 200);
	};





	$('.mobile-menu-call').click(function(e){
		e.preventDefault();
		$(this).toggleClass('opened').siblings('#supermenu').slideToggle();
	})

	/*** TABS ***/		
	$('.tabs-controls li').click(function(e){
		e.preventDefault();
		$(this).addClass('on').siblings().removeClass('on');
		$(this).parents('.tabs').find('.tab:eq('+$(this).index()+')').addClass('on').siblings().removeClass('on');
		if($(this).parents('.tabs').find('.tab.on').find('.slider').length){
			var sl=$(this).parents('.tabs').find('.tab.on').find('.slider').data('linkedEl');
			sl.reloadSlider();
		}
	}).first().click();

	// $('.search-tabs li').click(function(e){
	// 	e.preventDefault();
	// 	$(this).addClass('active').siblings().removeClass('active');
	// })


	/*** CUSTOM SELECTBOX ***/


	function close_pop(pop){
	  var pop=pop || $('.pop-up:visible'), glow=$('.pop-glow');
	  $('html').removeClass('pop-called');
	  pop.hide();
	  glow.hide();
	}
	$('.pop-close, .pop-glow').click(function(e){
	  e.preventDefault();
	  var pop=($(this).parents('.pop-up').length) ? $(this).parents('.pop-up') : $('.pop-up:visible');
	  close_pop(pop);
	})

	$('[data-pop-link]').click(function(e){
	  e.preventDefault();
	  var pop=$('.pop_up[data-pop="'+$(this).attr('data-pop-link')+'"]');
	  $('html').addClass('pop_called');
	  $('.pop-glow').show().css('height',$(document).height());
	  pop.show().css({'top':$(window).scrollTop()+$(window).height()/2-pop.height()/2});
	})



	$('.rate-stars').each(function(){
		$(this).append('<span/>');
		$(this).find('span').css('width',parseInt(17*$(this).text()));
	})


    $('[data-section-link]').click(function(e){
      e.preventDefault();
      $("html, body").animate({ scrollTop: $('[data-section="'+$(this).attr('data-section-link')+'"]').offset().top+'px' },400);
    })





      $('.img-thumbs a').click(function(e){
        e.preventDefault();
        $(this).addClass('active').siblings().removeClass('active').parents('.img-switch').find('.img-main').attr('src',$(this).attr('href'));
      })


      $('.cC').click(function(e){
	    e.preventDefault();
	    if($(this).is(':radio')) $("input[name='"+$(this).find('input').attr('name')+"']").prop('checked', false).parents('.cC').removeClass('checked');
	    	$(this).toggleClass('checked').find('input').click()
	  	}).each(function(){
       	if($(this).find('input').is(':checked')) $(this).addClass('checked')
      })

      $('.cC input').click(function(e){
        e.stopPropagation()
      })



      $('.closebutton.link-all').click(function(e){
      	e.preventDefault();
      	$(this).parents('.cnt-box').toggleClass('opened');
      })


      $('.search-form').submit(function(e){
      	e.preventDefault();
      	$(this).siblings('div').click();
      })


      if($(window).width()<1001){
      	$('.custom_menu .box-category>.arrow>a').mouseover(function(e){
      		//e.preventDefault();
      	})
      	$('.custom_menu .box-category>.arrow>a').click(function(e){
      		e.preventDefault();
      		//$(this).next('div').slideToggle();
      	})
      }



	$('#product-filter-view').on('change', function(){
		location.href = $(this).val();
	});



})

