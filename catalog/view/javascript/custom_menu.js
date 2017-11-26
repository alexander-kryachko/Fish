$(document).ready(function() {

	href = location.pathname.substr(1);
	//$('.box-category a[href*="'+href+'"]').parent().addClass('active');

	//$('.box_category li div').parent().children('a').append('&nbsp; <i style="text-decoration:none;">&gt;</i>')

	var menu_width = $('.box_category').width();
	$('#column-left .box_category li div').css('left', menu_width);
	$('#column-right .box_category').addClass('right');
	$('#column-right .box_category li div').css('right', menu_width).addClass('right');
	$('#column-left .box_category li div ul').css('min-width', menu_width);
	$('#column-right .box_category li div ul').css('min-width', menu_width);

});
