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

<div class="result_div">
{if $products}
<div class="results">
	{foreach from=$products item=product name=i}
		<div class="item">
		{if $show_image}
			<div class="left-img">
				<a href="{$product.link nofilter}" title="{$product.name nofilter}" class="product_image">
				<img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'home_default') nofilter}" alt="{$product.name nofilter}" />
				</a>
			</div>
		{/if}
			<div class="right-info">
				<a href="{$product.link nofilter}" title="{$product.name|truncate:50:'...' nofilter}">
					{$product.name|truncate:35:'...' nofilter}
				</a>
				{if $description}
				<p class="product-description">{$product.desc|truncate:$count_description:'...' nofilter}</p>
				{/if}
				{if $show_price}
					<span class="price">{$product.price nofilter}</span>
				{/if}
			</div>
		</div>
	{/foreach}
</div>
{else}
{$no_text nofilter}
{/if}
</div>
