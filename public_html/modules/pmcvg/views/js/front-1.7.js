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
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2017 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*
* Don't forget to prefix your containers with your own identifier
* to avoid any conflicts with others containers.
*/

$(document).ready(function(){
	function submitNewsletterCvg() {
		function checkAgreement() {
			if ($('.requiredcvg').length == $('.requiredcvg:checked').length){
				var result = window['validate_'+$('.email_submit').attr('data-validate')]($('.email_submit').val());
				var numItems = $('.form-error').length;
				if (numItems == 0) {
					$('.email_submit').parent().removeClass('form-error').addClass('form-ok');
					$('#addtonewslettercvg').removeAttr('disabled');
				}
			} else {
				$('#addtonewslettercvg').attr('disabled','disabled');
			}
		}

		$(document).on('focusout', 'input.validate', function() {
		    if ($(this).hasClass('is_required') || $(this).val().length)
		    {
		        var result = window['validate_'+$(this).attr('data-validate')]($(this).val())

		        if (result)
		        {
		            $(this).parent().removeClass('form-error').addClass('form-ok');
		            var numItems = $('.form-error').length;

		            if(numItems === 0) {
		               $("#addtonewslettercvg").removeAttr("disabled", "disabled");
		            	checkAgreement();
		            }
		        }
		        else
		        {
		            $(this).parent().addClass('form-error').removeClass('form-ok');
		            $("#addtonewslettercvg").attr("disabled", "disabled");
		        }
		    }
		});
		$('.conditions_account').show();
		
		if ($('.conditions_account').length == 0) 
			return ;
		var intervalCreateAccount = setInterval(function(){
			if ($('#addtonewslettercvg').length && !$('#addtonewslettercvg').is('.conditionsadd')) {				
				$('#addtonewslettercvg').addClass('conditionsadd');
				if ($('.conditions_account').length) {
					$('.account_creation').append($('.conditions_account').html());
					checkAgreement();
					clearInterval(intervalCreateAccount)
				}
			}
		},200)
		$(document).on('click','.cgv2',checkAgreement)
	}

	function createAccountJsOpc() {
		function checkAgreement() {
			if ($('.requiredcvg').length == $('.requiredcvg:checked').length){
				$('#submitAccount').removeAttr('disabled');
				$('#submitAddress').removeAttr('disabled');
				$('#submitGuestAccount').removeAttr('disabled');
			} else {
				$('#submitAccount').attr('disabled','disabled');
				$('#submitAddress').attr('disabled','disabled');
				$('#submitGuestAccount').attr('disabled','disabled');
			}
		}
		if ($('.conditions_account').length == 0) 
			return ;
		var intervalCreateAccount = setInterval(function(){
			if ($('#submitAccount').length && !$('#submitAccount').is('.conditionsaddaccount')) {
				$('#submitAccount').addClass('conditionsaddaccount');
				if ($('.conditions_account').length) {
					$('#invoice_address').parent().parent().parent().append($('.conditions_account').html());
					$('.conditions_account').remove();					
					checkAgreement();
					clearInterval(intervalCreateAccount)
				}
			}
		},200)
		$(document).on('click','.cgv2',checkAgreement)
	}

	function createAddress() {
		if ($('.conditions_address').length == 0) 
			return ;
		var intervalCreateAddress = setInterval(function(){
			if ($('#submitAddress').length && !$('#submitAddress').is('.conditionsadd')) {
				$('#submitAddress').addClass('conditionsadd');
				if ($('.conditions_address').length) {
					$('#adress_alias').after($('.conditions_address').html());
					$('.conditions_address').remove();					
					clearInterval(intervalCreateAddress)
				}
			}
		},200)
	}

	function submitMessageCvg() {
		if ($('.conditions_contact').length == 0) 
			return ;	
		function checkAgreement() {
			if ($('.requiredcvg').length == $('.requiredcvg:checked').length){
				$('input[name="submitMessage"]').removeAttr('disabled');
			} else {
				$('input[name="submitMessage"]').attr('disabled','disabled');
			}
		}

		var intervalCreatecontact = setInterval(function(){
			if ($('input[name="submitMessage"]').length && !$('input[name="submitMessage"]').is('.conditionsadd')) {
				$('input[name="submitMessage"]').addClass('conditionsadd');
				if ($('.conditions_contact').length) {
					$('input[name="submitMessage"]').before($('.conditions_contact').html());
					$('.conditions_contact').remove();					
					checkAgreement();
					clearInterval(intervalCreatecontact)
				}
			}
		},200)
		$(document).on('click','.cgv2',checkAgreement)
	}

	function createAddressOpc() {					
		function checkAgreement() {
			if ($('.requiredcvg').length == $('.requiredcvg:checked').length){
				$('#submitAccount').removeAttr('disabled');
				$('#submitGuestAccount').removeAttr('disabled');
			} else {
				$('#submitAccount').attr('disabled','disabled');
				$('#submitGuestAccount').attr('disabled','disabled');
			}
		}
		if ($('.conditions_address').length == 0) 
			return ;		
		var intervalCreateAddress = setInterval(function(){
			if ($('#submitAccount').length && !$('#submitAccount').is('.conditionsaddaddress')) {
				$('#submitAccount').addClass('conditionsaddaddress');
				if ($('.conditions_address').length) {
					$('#invoice_address').parent().parent().parent().after($('.conditions_address').html());
					$('.conditions_address').remove();					
					checkAgreement();
					clearInterval(intervalCreateAddress)
				}
			} else {

			}
		},200)
		$(document).on('click','.cgv2',checkAgreement)
	}

	function createOrder() {
		$(document).on('click','#conditions-to-approve input',function(){
			if ($(this).is(':checked')) {
				var set = 1;
			}
			else {
				set = 0
			}
			
			var cvgid = 0;
			var tname = $(this).attr('name');
			tname = tname.replace('conditions_to_approve[conditions-','')
			tname = tname.replace(']','')
			cvgid = parseInt(tname);

			$.ajax({
				type: 'POST',
				headers: { "cache-control": "no-cache" },
				url: cvgajax+'?rand=' + new Date().getTime(),
				async: true,
				cache: false,
				dataType: "json",
				data: 'ajax=1&cvg='+cvgid+'&value_set='+parseInt(set),
			});	
		})
	}

	if ($('#submitAddress').length) {
		createAddress();
	} else { //order-opc
		createAddressOpc();
	}
	if ($('#addtonewslettercvg').length) {
		submitNewsletterCvg();
	}
	
	if ($('input[name="submitMessage"]').length) {
		submitMessageCvg();	
	}

	$(document).on('click','.cvg-button', function() {
		var obj = this;
		$.ajax({
			type: 'POST',
			headers: { "cache-control": "no-cache" },
			url: cvgajax+'?rand=' + new Date().getTime(),
			async: true,
			cache: false,
			dataType: "json",
			data: 'ajax=1&cvg='+$(this).data('value'),
			success: function(json){
				if (json.status) {
					$(obj).addClass('button_enable').removeClass('button_disable');
					$(obj).html('<span class="icon-remove"></span> '+button_enable_lang);
					$(obj).parent().parent().find('.date').html(json.date_upd);
				} else {
					$(obj).addClass('button_disable').removeClass('button_enable');
					$(obj).parent().parent().find('.date').html(json.date_upd);
					$(obj).html('<span class="icon-check"></span> '+button_disable_lang);
				}
			}
		});
	})
	createOrder();
})