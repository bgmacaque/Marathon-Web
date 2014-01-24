$(document).ready(function(){
	$('#panier_info').css({'display' : 'none', 'position' : 'absolute'});

	$('#panier_info').offset({top : - screen.height + $('#panier_info').height() /2+"px", left : screen.width /2 - $('#panier_info').width() /2 + "px"});

	$('#panier-top').on('click', function(){
		$('#panier_info').fadeToggle();
		$('#panier_info').draggable();
		$('#annuler_panier').on('click', function() {$('#panier_info').fadeOut();});
		$('#detail_panier').on('click', function(){
			$(function() { $(location).attr('href', './panier');});
		});
	});
});