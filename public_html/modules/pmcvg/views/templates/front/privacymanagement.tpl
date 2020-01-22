{**
 * 2007-2017 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
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
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2017 PrestaShop SA
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
{extends file='customer/page.tpl'}

{block name='page_title'}
  {l s='Privacy management' mod='pmcvg'}
{/block}

{block name='page_content'}
  <div class="row">
    <div class="links">
		{if $form_show['PMCG_PAGE_1_ENABLE']}
			<a class="col-lg-3 col-md-6 col-sm-6 col-xs-12 pcontainer" href="{$link->getModuleLink('pmcvg', 'myconsents', array(), true)|escape:'html':'UTF-8'}">
				<div class="link-item2">
				<i class="icon-cvg-1"></i> 
				<span>{$form_show['PMCG_PAGE_1_TITLE'][$id_lang]}
					<p>
						{$form_show['PMCG_PAGE_1_DESC_1'][$id_lang]|replace:'<p>':''|replace:'</p>':''}
					</p>
				</span>
			</div>
			</a>
		{/if}
		{if $form_show['PMCG_PAGE_2_ENABLE']}
				<a class="col-lg-3 col-md-6 col-sm-6 col-xs-12 pcontainer" href="{$link->getModuleLink('pmcvg', 'data', array(), true)|escape:'html':'UTF-8'}">
					<div class="link-item2">
					<i class="icon-cvg-2"></i>
					<span>
							{$form_show['PMCG_PAGE_2_TITLE'][$id_lang]}
						<p>
							{$form_show['PMCG_PAGE_2_DESC_1'][$id_lang]|replace:'<p>':''|replace:'</p>':''}
						</p>
					</span>
				</div>
				</a>
		{/if}
		{if $form_show['PMCG_PAGE_3_ENABLE']}
			<a class="col-lg-3 col-md-6 col-sm-6 col-xs-12 pcontainer" href="{$link->getModuleLink('pmcvg', 'export', array(), true)|escape:'html':'UTF-8'}">
				<div class="link-item2">
				<i class="icon-cvg-3"></i>
					<span>
							{$form_show['PMCG_PAGE_3_TITLE'][$id_lang]}
						<p>
							{$form_show['PMCG_PAGE_3_DESC_1'][$id_lang]|replace:'<p>':''|replace:'</p>':''}
						</p>
					</span>
				</div>
			</a>
		{/if}
		{if $form_show['PMCG_PAGE_4_ENABLE']}
			<a class="col-lg-3 col-md-6 col-sm-6 col-xs-12 pcontainer" href="{$link->getModuleLink('pmcvg', 'anonimize', array(), true)|escape:'html':'UTF-8'}">
				<div class="link-item2">
				<i class="icon-cvg-4"></i>
					<span>
							{$form_show['PMCG_PAGE_4_TITLE'][$id_lang]}
						<p>
							{$form_show['PMCG_PAGE_4_DESC_1'][$id_lang]|replace:'<p>':''|replace:'</p>':''}
						</p>
					</span>
				</div>
			</a>
		{/if}
		{if $form_show['PMCG_PAGE_5_ENABLE']}
				<a class="col-lg-3 col-md-6 col-sm-6 col-xs-12 pcontainer" href="{$link->getModuleLink('pmcvg', 'remove', array(), true)|escape:'html':'UTF-8'}">
					<div class="link-item2">
					<i class="icon-cvg-5"></i>
					<span>
							{$form_show['PMCG_PAGE_5_TITLE'][$id_lang]}
						<p>
							{$form_show['PMCG_PAGE_5_DESC_1'][$id_lang]|replace:'<p>':''|replace:'</p>':''}
						</p>
					</span>
				</div>
				</a>
		{/if}
		{if $form_show['PMCG_PAGE_6_ENABLE']}
			<a class="col-lg-3 col-md-6 col-sm-6 col-xs-12 pcontainer" href="{$link->getModuleLink('pmcvg', 'information', array(), true)|escape:'html':'UTF-8'}">
				<div class="link-item2">
				<i class="icon-cvg-6"></i>
					<span>
							{$form_show['PMCG_PAGE_6_TITLE'][$id_lang]}
						<p>
							{$form_show['PMCG_PAGE_6_DESC_1'][$id_lang]|replace:'<p>':''|replace:'</p>':''}
						</p>
					</span>
				</div>
			</a>
		{/if}
		{if $form_show['PMCG_PAGE_7_ENABLE']}
			<a class="col-lg-3 col-md-6 col-sm-6 col-xs-12 pcontainer" href="{$link->getModuleLink('pmcvg', 'leak', array(), true)|escape:'html':'UTF-8'}">
				<div class="link-item2">
				<i class="icon-cvg-7"></i>
					<span>
							{$form_show['PMCG_PAGE_7_TITLE'][$id_lang]}
						<p>
							{$form_show['PMCG_PAGE_7_DESC_1'][$id_lang]|replace:'<p>':''|replace:'</p>':''}
						</p>
					</span>
				</div>
			</a>
		{/if}
		{if $form_show['PMCG_PAGE_8_ENABLE']}
			<a class="col-lg-3 col-md-6 col-sm-6 col-xs-12 pcontainer" href="{$link->getModuleLink('pmcvg', 'processing', array(), true)|escape:'html':'UTF-8'}">
				<div class="link-item2">
				<i class="icon-cvg-8"></i>
					<span>
							{$form_show['PMCG_PAGE_8_TITLE'][$id_lang]}
						<p>
							{$form_show['PMCG_PAGE_8_DESC_1'][$id_lang]|replace:'<p>':''|replace:'</p>':''}
						</p>
					</span>
				</div>
			</a>
		{/if}
	</div>
</div>
{/block}
