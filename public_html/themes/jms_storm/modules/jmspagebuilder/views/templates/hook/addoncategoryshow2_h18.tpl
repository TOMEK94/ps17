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

<script type="text/javascript">
	var cs_items = {if $cols}{$cols|escape:'htmlall':'UTF-8'}{else}4{/if};
	var cs_itemsDesktop = {if $cols}{$cols|escape:'htmlall':'UTF-8'}{else}4{/if};
	var cs_itemsDesktopSmall = {if $cols_md}{$cols_md|escape:'htmlall':'UTF-8'}{else}3{/if};
	var cs_itemsTablet = {if $cols_sm}{$cols_sm|escape:'htmlall':'UTF-8'}{else}2{/if};
	var cs_itemsMobile = {if $cols_xs}{$cols_xs|escape:'htmlall':'UTF-8'}{else}1{/if};
	var cs_nav = {if $navigation == 1}true{else}false{/if};
	var cs_pag = {if $pagination == 1}true{else}false{/if};
	var cs_auto_play_carousel = {if $autoplay == 1}true{else}false{/if};
</script>
{if $addon_title}
<div class="addon-title">
	<h3>{$addon_title|escape:'htmlall':'UTF-8'}</h3>
</div>
{/if}
<div class="home_categories2">
    {if isset($categories) AND $categories}
            <div class="categories-carousel2">
            {foreach from=$categories item=category }
	            <div class="item block_category">
	            	{foreach from=$category item=c_item }
	            
						{assign var='categoryLink' value=$link->getcategoryLink($c_item.id_category, $c_item.link_rewrite)}
						<div class="categories-wrapper">
							{if $show_img == 1}
							<div class="categoy-image">
								<a href="{$categoryLink nofilter}">
									<img src="{$img_cat_dir nofilter}{$c_item.id_category nofilter}.jpg" alt="{$c_item.name nofilter}" title="{$c_item.name nofilter}" class="img-responsive"/>
								</a>
							</div>
							{/if}
							<div class="c_item-info">
								<a href="{$categoryLink nofilter}" class="cat-name">{$c_item.name nofilter}</a>
								<a href="{$categoryLink nofilter}" class="view-all"><i class="fa fa-plus-square"></i> View all</a>
								<ul class="child" style="margin-bottom: 0;">
									{foreach from=$c_item.cat_childs item=child}
										{assign var='childLink' value=$link->getcategoryLink($child.id_category, $c_item.link_rewrite)}
										<li>
											<a href="{$childLink nofilter}">{$child.name}</a>
										</li>
									{/foreach}
								</ul>
								
							</div>
						</div>
	            	{/foreach}
	            </div>
            {/foreach}
            </div>
    {else}
        <p>{l s='No categories' d='Modules.JmsPagebuilder'}</p>
  {/if}
</div>


	