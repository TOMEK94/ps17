{if $privacy_message_allow1 || $privacy_message_allow2 || $privacy_message_allow3}
	<div class="error_customerprivacy" style="color:red;"></div>
	<fieldset class="account_creation customerprivacy">
		<h3>{l s='Zgody' mod='pdrodopro'}</h3>
		{if $privacy_message_allow1}
			<div class="alert alert-danger error" id="errorcgvv1" style="display: none;">{l s="Musisz zaakceptować tę zgodę" mod="pdrodopro"}</div>
			<p class="required" style="display: block; float: left;">
				<input type="checkbox" value="1" required="required" id="customer_privacy1" name="customer_privacy1" {if isset($smarty.post.customer_privacy1) && $smarty.post.customer_privacy1=='1'}checked="checked"{/if} style="float:left;margin: 15px;" autocomplete="off"/>				
			</p>
			<label style="width: 90%;" for="customer_privacy1">{$privacy_message1}</label>
			<div class="clearfix"></div>
			
			<script type="text/javascript">{literal}
				$(document).ready(function()
				{
					$('#submitOrder, #submitAccount, #submitGuestAccount, p.payment_module a').on("click", function(e){
						if (!$('#customer_privacy1').is(':checked')){
							$('#errorcgvv1').show();
							return false;
						}
                        {/literal}{if $page_name!='authentication'}{literal}
                        postCart('customer_privacy1');
						{/literal}{/if}{literal}
						return true;
					});
					$('#customer_privacy1').on('click', function(e){
						if ($('#customer_privacy1').is(':checked')){
							$('#errorcgvv1').hide();
						} else {
							$('#errorcgvv1').show();
						}
					});
				});{/literal}
			</script>
			
			
		{/if}	
		{if $privacy_message_allow2}
			<div class="alert alert-danger error" id="errorcgvv2" style="display: none;">{l s="Musisz zaakceptować tę zgodę" mod="pdrodopro"}</div>
			<p class="required" style="display: block; float: left;">
				<input type="checkbox" value="1" required="required" id="customer_privacy2" name="customer_privacy2" {if isset($smarty.post.customer_privacy2) && $smarty.post.customer_privacy2=='1'}checked="checked"{/if} style="float:left;margin: 15px;" autocomplete="off"/>				
			</p>
			<label style="width: 90%;" for="customer_privacy2">{$privacy_message2}</label>
			<div class="clearfix"></div>
			<script type="text/javascript">{literal}
				$(document).ready(function()
				{
					$('#submitOrder, #submitAccount, #submitGuestAccount, p.payment_module a').on("click", function(e){
						if (!$('#customer_privacy2').is(':checked')){
							$('#errorcgvv2').show();
							return false;
						}
						{/literal}{if $page_name!='authentication'}{literal}
                        postCart('customer_privacy2');
                        {/literal}{/if}{literal}
						return true;
					});
					$('#customer_privacy2').on('click', function(e){
						if ($('#customer_privacy2').is(':checked')){
							$('#errorcgvv2').hide();
						} else {
							$('#errorcgvv2').show();
						}
					});
				});{/literal}
			</script>
		{/if}
		{if $privacy_message_allow3}
			<div class="alert alert-danger error" id="errorcgvv3" style="display: none;">{l s="Musisz zaakceptować tę zgodę" mod="pdrodopro"}</div>
			<p class="required" style="display: block; float: left;">
				<input type="checkbox" value="1" required="required" id="customer_privacy3" name="customer_privacy3" {if isset($smarty.post.customer_privacy3) && $smarty.post.customer_privacy3=='1'}checked="checked"{/if} style="float:left;margin: 15px;" autocomplete="off"/>				
			</p>
			<label style="width: 90%;" for="customer_privacy3">{$privacy_message3}</label>
			<div class="clearfix"></div>
			<script type="text/javascript">{literal}
				$(document).ready(function()
				{
					$('#submitOrder, #submitAccount, #submitGuestAccount, p.payment_module a').on("click", function(e){
						if (!$('#customer_privacy3').is(':checked')){
							$('#errorcgvv3').show();
							return false;
						}
						{/literal}{if $page_name!='authentication'}{literal}
                        postCart('customer_privacy3');
                        {/literal}{/if}{literal}
						return true;
					});
					$('#customer_privacy3').on('click', function(e){
						if ($('#customer_privacy').is(':checked')){
							$('#errorcgvv3').hide();
						} else {
							$('#errorcgvv3').show();
						}
					});
				});{/literal}
			</script>
		{/if}		
	</fieldset>
{/if}

{if $newsletter_message_allow1 || $newsletter_message_allow2}
	{if $newsletter_message_allow1}
		<script type="text/javascript">
		{literal}
			$(document).ready(function()
			{
				$( '<div id="newsletter_info1" style="display: none;" class="alert alert-danger">{/literal}{l s='Musisz zaakceptować zgodę przetwarzania danych osobowych w związku z zaznaczeniem chęci otrzymywania Newslettera' mod='pdrodopro'}{literal}</div><div class="checkbox" style="margin-left: 30px; {/literal}{if isset($smarty.post.newsletter_allow) && $smarty.post.newsletter_allow == '1'}{else}{literal}display: none;{/literal}{/if}{literal}" id="newsletter_allow_div"><label for="newsletter_allow"><input type="checkbox" name="newsletter_allow" id="newsletter_allow" value="1" {/literal}{if isset($smarty.post.newsletter_allow) && $smarty.post.newsletter_allow == '1'}{literal}checked="checked"{/literal}{/if}{literal} />{/literal}{$newsletter_message1|strip_tags}{literal}</label></div>' ).insertAfter($("label[for='newsletter']").parent('div.checkbox'));
			
				if ($('#newsletter').is(':checked')){
					$('#newsletter_allow_div').show();
				}
				
				$('#newsletter_allow').on('click', function(e){
					if ($('#newsletter_allow').is(':checked')){
						$('#newsletter_info1').hide();
					}
				});

                $('#newsletter').on('click', function(e){
                    if (!$('#newsletter').is(':checked')){
                        $('#newsletter_allow').prop('checked', false);
                    }
                });

				$('#submitAccount, #submitGuestAccount, p.payment_module a').on("click", function(e){
					if ($('#newsletter').is(':checked')){
						if (!$('#newsletter_allow').is(':checked')){
							$('#newsletter_info1').show();
							return false;
						}
                        {/literal}{if $page_name!='authentication'}{literal}
                        postCart('newsletter_allow');
                        {/literal}{/if}{literal}
						return true;
					}
					return true;
				});
				
				$('#newsletter').on('click', function(e){
					if ($('#newsletter').is(':checked')){
						$('#newsletter_allow_div').show();
						$("#newsletter_allow").prop('required',true);
					} else {
						$('#newsletter_allow_div').hide();
						$("#newsletter_allow").prop('required',false);
					}
					$('#newsletter_allow').prop('checked', false);
				});
			});
			{/literal}
		</script>
	{/if}
	
	{if $newsletter_message_allow2}
		<script type="text/javascript">
		{literal}
			$(document).ready(function()
			{
				$( '<div id="newsletter_info2" style="display: none;" class="alert alert-danger">{/literal}{l s='Musisz zaakceptować zgodę przetwarzania danych osobowych w związku z zaznaczeniem chęci otrzymywania ofert od Naszych partnerów' mod='pdrodopro'}{literal}</div><div class="checkbox" style="margin-left: 30px; {/literal}{if isset($smarty.post.optin_allow) && $smarty.post.optin_allow == '1'}{else}{literal}display: none;{/literal}{/if}{literal}" id="optin_allow_div"><label for="optin_allow"><input type="checkbox" name="optin_allow" id="optin_allow" value="1" {/literal}{if isset($smarty.post.optin_allow) && $smarty.post.optin_allow == '1'}{literal}checked="checked"{/literal}{/if}{literal} />{/literal}{$newsletter_message2|strip_tags}{literal}</label></div>' ).insertAfter($("label[for='optin']").parent('div.checkbox'));

				if ($('#optin').is(':checked')){
					$('#optin_allow_div').show();
				}
				
				$('#optin_allow').on('click', function(e){
					if ($('#optin_allow').is(':checked')){
						$('#newsletter_info2').hide();
					}
				});

                $('#optin').on('click', function(e){
                    if (!$('#optin').is(':checked')){
                        $('#optin_allow').prop('checked', false);
                    }
                });
			
				$('#submitAccount, #submitGuestAccount, p.payment_module a').on("click", function(e){
					if ($('#optin').is(':checked')){
						if (!$('#optin_allow').is(':checked')){
							$('#newsletter_info2').show();
							return false;
						}
                        {/literal}{if $page_name!='authentication'}{literal}
                        postCart('optin_allow');
                        {/literal}{/if}{literal}
						return true;
					}
					return true;
				});
				
				$('#optin').on('click', function(e){
					if ($('#optin').is(':checked')){
						$('#optin_allow_div').show();
						$("#optin_allow").prop('required',true);
					} else {
						$('#optin_allow_div').hide();
						$("#optin_allow").prop('required',false);
					}
					$('#optin_allow').prop('checked', false);
				});
			});
			{/literal}
		</script>
	{/if}
{/if}

{if $newsletter_message_allow1 || $newsletter_message_allow2}
	{if (isset($smarty.post.newsletter) AND $smarty.post.newsletter == 1) || (isset($smarty.post.optin) AND $smarty.post.optin == 1)}
		{if (isset($smarty.post.newsletter) AND $smarty.post.newsletter == 1) && $newsletter_message_allow1 && !isset($smarty.post.newsletter_allow)}
			<script type="text/javascript">
				$(document).ready(function()
				{
					//$('#newsletter_info1').show();
				});
			</script>
		{/if}
		{if (isset($smarty.post.optin) AND $smarty.post.optin == 1) && $newsletter_message_allow2 && !isset($smarty.post.optin_allow)}
			<script type="text/javascript">
				$(document).ready(function()
				{
					//$('#newsletter_info2').show();
				});
			</script>
		{/if}
	{/if}
{/if}

{if $page_name!='authentication'}
	<script type="text/javascript">
		$(document).ready(function()
		{
			getDataByUser();
			$.uniform.update();
		});
	</script>
{/if}