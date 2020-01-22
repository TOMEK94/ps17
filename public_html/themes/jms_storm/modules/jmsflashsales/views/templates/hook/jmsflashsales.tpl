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
*  @version  Release: $Revision$
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{if $jpb_homepage == 18}
<div class="jmsflashsales">
	<div class="title">
		<div class="addon-title">
			<h3>Daily deals</h3>
		</div>
		<div class="flashsales-countdown">{$expiretime|escape:'htmlall':'UTF-8'}</div>
	</div>
	<div class="flashsales-carousel">	
		{foreach from=$products item=product key=k}	
			<div class="item ajax_block_product">		
				{include file="catalog/_partials/miniatures/product_flashdeal.tpl" product=$product}
			</div>
		{/foreach}
	</div>
</div>
{else}
<div class="jmsflashsales">
	<div class="product_box">
		<div class="title">
			<div class="addon-title col-lg-3 col-md-3 col-sm-3 col-xs-12">
				<h3>Daily deals</h3>
			</div>
			<div class="flashsales-countdown col-lg-6 col-md-6 col-sm-6 col-xs-12">{$expiretime|escape:'htmlall':'UTF-8'}</div>
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
		</div>
		<div class="flashsales-carousel">	
			{foreach from=$products item=product key=k}	
				<div class="item ajax_block_product">		
					{include file="catalog/_partials/miniatures/product_flashdeal.tpl" product=$product}
				</div>
			{/foreach}
		</div>
	</div>
</div>
{/if}