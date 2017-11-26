/*
 * Category Menu Pro v1.1.3
 * for OpenCart 1.5.1 - 1.5.6.4
 *
 * Copyright 2014, iDiY
 * Support: idiy.webmaster@gmail.com
 *
 */

$(document).ready(function() {

	$('.parent-item.active').addClass('item-open');
	$('ul.cmpro-collapsible a.parent-item, ul.cmpro-collapsible span.toggle-btn').click(function() {
		$(this).toggleClass('item-open').parent().next().slideToggle(200, 'linear');
		return false;
	});

	$('ul.cmpro-accordion a.parent-item,ul.cmpro-accordion span.toggle-btn').click(function() {
		$(this).toggleClass('item-open').parent().next().slideToggle(200, 'linear');
		$(this).closest('ul').find('.item-open').not(this).toggleClass('item-open').parent().next().slideToggle(200, 'linear');
		return false;
	});

});