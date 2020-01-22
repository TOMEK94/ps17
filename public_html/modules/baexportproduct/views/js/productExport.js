/**
 * 2007-2017 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@buy-addons.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    Buy-addons    <contact@buy-addons.com>
 * @copyright 2007-2018 Buy-addons
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */
$(document).ready(function () {
		$("#Rightlist").sortable();
		$("#Rightlist").on( "sortstop", function( event, ui ) {
			exproduct_updateProductData();
		} );
		/////////
		$("#Rightlist").disableSelection();
	});
$(document).ready(function () {
	
	$(".Date").datepicker();
	///show data
	$('#icon1').click(function(){
		$('#hidefilter').toggle();
		return false;
	});
	$('#icon1').click(function(){
		$('#fontawe1').toggleClass(function(){
			if($('#fontawe1').hasClass('fa-minus-circle') == true){
				$('#fontawe1').removeClass('fa-minus-circle');
				return 'fa-plus-circle';
				
			}else{
				$('#fontawe1').removeClass('fa-plus-circle');
				return 'fa-minus-circle';
			}
		});
	});


	$('#icon2').click(function(){
		$('#hidetruong').toggle();
		return false;
	});
	$('#icon2').click(function(){
		$('#fontawe2').toggleClass(function(){
			if($('#fontawe2').hasClass('fa-minus-circle') == true){
				$('#fontawe2').removeClass('fa-minus-circle');
				return 'fa-plus-circle';
				
			}else{
				$('#fontawe2').removeClass('fa-plus-circle');
				return 'fa-minus-circle';
			}
		});
	});
	
	$('#icon3').click(function(){
		$('#hidesetting').toggle();
		return false;
	});
	$('#icon3').click(function(){
		$('#fontawe3').toggleClass(function(){
			if($('#fontawe3').hasClass('fa-minus-circle') == true){
				$('#fontawe3').removeClass('fa-minus-circle');
				return 'fa-plus-circle';
				
			}else{
				$('#fontawe3').removeClass('fa-plus-circle');
				return 'fa-minus-circle';
			}
		});
	});
	/////////
	$("#Combi_on").click(function(){
		$("#combihide").show();
	});
	$("#Combi_off").click(function(){
		$("#combihide").hide();
	});
	$("#rdAll").click(function(){
		$("#numberP").hide();
	});
	$("#rdranger").click(function(){
		$("#numberP").show();
	});
	
	$(document).on('click', '#reset', function () {
        $('.search_left').val('');
        if ($('.search_left').val() == "") 
		{
            $('.block_product_left li').css({"display": "list-item"});
            $('.selected_fields li').css({"display": ""});
        }
        return false;

    });
	
	$(document).on('keyup', '.search_left', function () {
        var self = $(this);
        $('.block_product_left li').each(function () {

            if ($(this).text().toLowerCase().indexOf(self.val().toLowerCase()) >= 0) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
	$(document).on('click', '.block_product_right li', function (e) {
        if (e.ctrlKey) {
            $(this).addClass('checked');
        } else {
            $('.block_product_right li').removeClass('checked');
            $(this).addClass('checked');
        }
    });
	
	$(document).on('click', '.block_product_left li', function (e) {
        if (e.ctrlKey) {
            $(this).addClass('checked');
        } else {
            $('.block_product_left li').removeClass('checked');
            $(this).addClass('checked');
        }
    });
	$(document).on('click', '.add_product', function () {
        $('.block_product_left li.checked').each(function () {
            var el = $(this).clone();
            exproduct_moveLefttoRight(el);
        });
		exproduct_updateProductData();
    });
	
	$(document).on('click', '.add_all_product', function () {
			$('.block_product_left li').each(function (e) {
				if ($(this).is(':visible')) {// chi lay nhung element dang hien thi
					var el = $(this).clone();
					exproduct_moveLefttoRight(el);
				}
			});
			exproduct_updateProductData();
	});

	$(document).on('click', '.remove_product', function () {
		$('.block_product_right .checked').each(function (e) {
            var el = $(this).clone().removeClass('checked');
            $(this).remove();
        });
		exproduct_updateProductData();
	});
	
	
	$(document).on('click', '.remove_product_all', function () {
		$('.block_product_right li').each(function (e) {
            var el = $(this).clone().removeClass('checked');
            $(this).remove();
        });
		exproduct_updateProductData();
	});
	
	
	$(document).on('dblclick', '.block_product_left li', function () {
		$('.block_product_left .checked').each(function (e) {
			var el = $(this).clone();
			exproduct_moveLefttoRight(el);
		});
		exproduct_updateProductData();
	});

	$(document).on('dblclick', '.block_product_right', function () {
		$('.block_product_right .checked').each(function (e) {
            var el = $(this).clone().removeClass('checked');
            $(this).remove();
        });
		exproduct_updateProductData();
	});
});
function searchCategory()
{
	var category_to_check;
	if ($('#search_cat').length)
	{
		$('#search_cat').autocomplete('ajax.php?searchCategory=1', {
			delay: 100,
			minChars: 3,
			autoFill: true,
			max:20,
			matchContains: true,
			mustMatch:true,
			scroll:false,
			cacheLength:0,
			multipleSeparator:'||',
			formatItem: function(item) 
			{
				return item[1]+' - '+item[0];
			}
		}).result(function(event, item)
		{ 
			parent_ids = getParentCategoriesIdAndOpen(item[1]);
		});
	}
}
function exproduct_updateProductData(){
	var joinInput = '';
	$('.block_product_right li').each(function () {
		joinInput += $(this).attr('Name_Gerenal') + ',';
	});
	$('#hide').val(joinInput);
}
function exproduct_moveLefttoRight(Elementchecked){
	var el = Elementchecked.removeClass('checked');
	var inputData = el.text().trim();
	var html = '<input class="selected_fields_textfield" type="text" value="'+inputData+'" onblur="exproduct_updateDatafromTextfield(this)" />';
	html += '<i class="icon-arrows icon-arrows-select-fields"></i>';
	var newElement = el.html(html);
	$('.block_product_right').append(el[0]);
}
function exproduct_updateDatafromTextfield(ob){
	var el = $(ob);
	var pa = el.parent();
	var name_gerenal = pa.attr('name_gerenal').split("-");
	name_gerenal[0] = el.val();
	console.log(name_gerenal);
	pa.attr('name_gerenal', name_gerenal.join('-'));
	// cap nhat lai data hidden de gui len server
	exproduct_updateProductData();
}