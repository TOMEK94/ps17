{*
* 2007-2018 PrestaShop
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
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2018 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{*
* 2007-2018 PrestaShop
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
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2018 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<!-- Block Newsletter module-->
<div id="newsletter_block_left" class="block">	
	<div class="block_content">
		<div class="textnews_h1 addon-title">
			<h3>{l s='Newsletter Signup' d='Shop.Theme.Global'}</h3>
			<span>{l s='Sign up our Newsletter for Exclusive Discount codes' d='Shop.Theme.Global'}</span>
		</div>
		<div class="textnews_h5 addon-title">
			<h3>{l s='Get the latest news delivered daily' d='Shop.Theme.Global'}</h3>
			<span>{l s='Give us your email and you will be daily update with the latest events in detail!' d='Shop.Theme.Global'}</span>
		</div>
		<div class="textnews_h7 addon-title">
			<h3>{l s='Subscribe to Our Newsletter' d='Shop.Theme.Global'}</h3>
			<span>{l s='More special Deals, Events & Promotions' d='Shop.Theme.Global'}</span>
		</div>
		<div class="popup addon-title">
			<p class="text-1">{l s='Get the latest news' d='Shop.Theme.Global'}</p>
			<p class="text-2">{l s='Delivered daily!' d='Shop.Theme.Global'}</p>
			<span>{l s='Give us your email and you will be daily updated with the latest events, in detail!' d='Shop.Theme.Global'}</span>
		</div>
		<div class="news_content">
        	<div  class="block_c_right">
				<form action="{$urls.pages.index}#footer" method="post">
					<div class="form-group{if isset($msg) && $msg } {if $nw_error}form-error{else}form-ok{/if}{/if}" >
						<input class="inputNew form-control grey newsletter-input" id="newsletter-input" type="text" name="email" size="18" value="{$value}" placeholder="{l s='Your email here...' d='Shop.Forms.Labels'}" />
						<input class="input_popup form-control grey newsletter-input" id="newsletter-input" type="text" name="email" size="18" value="{$value}" placeholder="{l s='Enter your email' d='Shop.Forms.Labels'}" />
						<button type="submit" name="submitNewsletter" class="newsletter-btn buttonh1 btn-active">
							{l s='Sign up' d='Shop.Theme'}
						</button>
						<button type="submit" name="submitNewsletter" class="newsletter-btn btn-popup btn-active">
							{l s='Subscribe' d='Shop.Theme'}
						</button>
						<input type="hidden" name="action" value="0" />
					</div>
				</form>
			</div>
       </div>
	</div>
</div>
{if $msg}
    <div class="alert {if $nw_error}alert-danger{else}alert-success{/if}">
        {$msg}
    </div>
{/if}



