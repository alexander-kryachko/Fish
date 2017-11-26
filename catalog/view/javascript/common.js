$(document).ready(function(){
    var r = $("#column-right").height();
    var c = $("#content").height();
    if (c < r)
        $("#content").height(r);
    /* Search */
    $('.button-search').bind('click', function() {
        url = $('base').attr('href') + 'index.php?route=product/search';

        var search = $('input[name=\'search\']').attr('value');

        if (search) {
			url += '&search=' + encodeURIComponent(search) + '&description=true' + '&sub_category=true';
        }

        location = url;
    });

    $('#searchin').bind('keydown', function(e) {
        if (e.keyCode == 13) {
            url = $('base').attr('href') + 'index.php?route=product/search';

            var search = $('input[name=\'search\']').attr('value');

            if (search) {               
				url += '&search=' + encodeURIComponent(search) + '&description=true' + '&sub_category=true';
            }

            location = url;
        }
    });

    /* Ajax Cart */
    $('#cart > .heading a').live('click', function() {
        $('#cart').addClass('active');

        $('#cart').load('index.php?route=module/cart #cart > *');

        // $('#cart').live('mouseleave', function() {
            // $(this).removeClass('active');
        // });
    });

    $(document).keyup(function(e) {
      if (e.keyCode == 27) { $('#cart').removeClass('active'); $('#popup_product_sires').removeClass('active'); }   // esc
    });

    $("body").click(function (event) {
        if ($(event.target).closest("#cart .content").length === 0) {
            $('#cart').removeClass('active');
        }
    });

    $("#product_sires_overlay").click(function (event){
        $('#popup_product_sires').removeClass('active');
    });

    /* Mega Menu */
    $('#menu ul > li > a + div').each(function(index, element) {
        // IE6 & IE7 Fixes
        if ($.browser.msie && ($.browser.version == 7 || $.browser.version == 6)) {
            var category = $(element).find('a');
            var columns = $(element).find('ul').length;

            $(element).css('width', (columns * 143) + 'px');
            $(element).find('ul').css('float', 'left');
        }

        var menu = $('#menu').offset();
        var dropdown = $(this).parent().offset();

        i = (dropdown.left + $(this).outerWidth()) - (menu.left + $('#menu').outerWidth());

        if (i > 0) {
         $(this).css('margin-left', '-' + (i + 5) + 'px');
        }
    });

    // IE6 & IE7 Fixes
    if ($.browser.msie) {
        if ($.browser.version <= 6) {
            $('#column-left + #column-right + #content, #column-left + #content').css('margin-left', '195px');

            $('#column-right + #content').css('margin-right', '195px');

            $('.box-category ul li a.active + ul').css('display', 'block');
        }

        if ($.browser.version <= 7) {
            $('#menu > ul > li').bind('mouseover', function() {
                $(this).addClass('active');
            });

            $('#menu > ul > li').bind('mouseout', function() {
                $(this).removeClass('active');
            });
        }
    }

    $('.success img, .warning img, .attention img, .information img').live('click', function() {
        $(this).parent().fadeOut('slow', function() {
            $(this).remove();
        });
    });
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

function addToCart(product_id){ 
    $('#popup_product_sires').removeClass('active');

    $.ajax({
        url: 'index.php?route=checkout/cart/add',
        type: 'post',
        data: 'product_id=' + product_id,
        dataType: 'json',
        success: function(json) {
            if (json['error']) {
                //window.location = json['redirect'];
            }

            // if (json['success']) {
            //     window.location = "/index.php?route=checkout/cart";
            // }

            if (json['success']) {
                $('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
                //change 311013
                $('#cart').addClass('active');
                $('#cart').load('index.php?route=module/cart #cart > *');
                $('#cart').live('mouseleave', function() {
                    $(this).removeClass('active');
                });
                $('.success').fadeIn('slow');
                $('#cart-total').html(json['total']);
                $('html, body').animate({ scrollTop: 0 }, 'slow');
            }
        }
    });
}

function addToCartComplect(product_id_1, product_id_2) {
    $.ajax({
        url: 'index.php?route=checkout/cart/add',
        type: 'post',
        data: 'product_id=' + product_id_1,
        dataType: 'json',
        success: function(json) {
            if (json['error']) {
                window.location = json['redirect'];
            }
        }
    });

    $.ajax({
        url: 'index.php?route=checkout/cart/add',
        type: 'post',
        data: 'product_id=' + product_id_2,
        dataType: 'json',
        success: function(json) {
            if (json['error']) {
                window.location = json['redirect'];
            }

            // if (json['success']) {
            //     window.location = "/index.php?route=checkout/cart";
            // }

            if (json['success']) {
                $('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');
                //change 311013
                $('#cart').addClass('active');
                $('#cart').load('index.php?route=module/cart #cart > *');

                $('#cart').live('mouseleave', function() {
                    $(this).removeClass('active');
                });

                $('.success').fadeIn('slow');

                $('#cart-total').html(json['total']);

                $('html, body').animate({ scrollTop: 0 }, 'slow');
            }
        }
    });
}

function addToWishList(product_id) {
    $.ajax({
        url: 'index.php?route=account/wishlist/add',
        type: 'post',
        data: 'product_id=' + product_id,
        dataType: 'json',
        success: function(json) {
            $('.success, .warning, .attention, .information').remove();

            if (json['success']) {
                $('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');

                $('.success').fadeIn('slow');

                $('#wishlist-total').html(json['total']);

                $('html, body').animate({ scrollTop: 0 }, 'slow');
            }
        }
    });
}

function addToCompare(product_id) {
    $.ajax({
        url: 'index.php?route=product/compare/add',
        type: 'post',
        data: 'product_id=' + product_id,
        dataType: 'json',
        success: function(json) {
            $('.success, .warning, .attention, .information').remove();

            if (json['success']) {
                $('#notification').html('<div class="success" style="display: none;">' + json['success'] + '<img src="catalog/view/theme/default/image/close.png" alt="" class="close" /></div>');

                $('.success').fadeIn('slow');

                $('#compare-total').html(json['total']);

                $('html, body').animate({ scrollTop: 0 }, 'slow');
            }
        }
    });
}
