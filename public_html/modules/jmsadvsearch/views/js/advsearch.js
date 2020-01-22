/**
* 2007-2018 PrestaShop
*
* Jms Adv Search
*
*  @author    Joommasters <joommasters@gmail.com>
*  @copyright 2007-2018 Joommasters
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: http://www.joommasters.com
*/
$(document).ready(function() {
	$('#selector_cat').click(function(event){
		var id_cat_search = $('#selector_cat').find(":selected").val();		
	});
	var timer;
	$( "#ajax_advsearch" ).keyup(function() {
		var id_cat_search = $('#selector_cat').find(":selected").val();		
		var search_key = $( "#ajax_advsearch" ).val();		
		clearTimeout(timer);
		timer = setTimeout(function() {					
			$.ajax({
				type: 'GET',
				url: prestashop.urls.base_url + 'modules/jmsadvsearch/ajax_search.php',
				headers: { "cache-control": "no-cache" },
				async: true,
				data: 'search_key=' + search_key + '&id_category=' + id_cat_search,
				success: function(data)
				{		
					$('#advsearch_result').html(data);
				}
			}) .done(function( msg ) {
				$( "#advsearch_result" ).html(msg);
			});
			
		}, 1000);
	})	
	$('html').click(function() {
		$( "#advsearch_result" ).html('');
	});

	$('#advsearch_result').click(function(event){
		event.stopPropagation();
	});

});