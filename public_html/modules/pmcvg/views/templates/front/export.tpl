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
{extends file='page.tpl'}

{block name='page_header_container'}{/block}

{block name='page_content'}
<div class="privacymanagement">
	<div class="row">
			<h3>{$form_show['PMCG_PAGE_3_TITLE'][$id_lang]}</h3>
		<div class="privacymanagement">
			<hr />
			{$form_show['PMCG_PAGE_3_DESC_2'][$id_lang]}
			<ul>
				<li class="col-md-4">
					<div class="pcontainer">
						<div class="pcontainerboxexport">							
							<span class="xml-icon"></span>
							<a class="download" href="{$link->getModuleLink('pmcvg', 'export?format=xml', array(), true)|escape:'html':'UTF-8'}">Pobierz plik w formacie XML</a>
						</div>
					</div>
				</li>
				<li class="col-md-4">
					<div class="pcontainer">
						<div class="pcontainerboxexport">
							<span class="csv-icon"></span>
							<a class="download"  href="{$link->getModuleLink('pmcvg', 'export?format=csv', array(), true)|escape:'html':'UTF-8'}">Pobierz plik w formacie CSV</a>
						</div>
					</div>
				</li>
				<li class="col-md-4">
					<div class="pcontainer">
						<div class="pcontainerboxexport">
							<span class="json-icon"></span>
							<a class="download"  href="{$link->getModuleLink('pmcvg', 'export?format=json', array(), true)|escape:'html':'UTF-8'}">Pobierz plik w formacie JSON</a>
						</div>
					</div>\
				</li>
			</ul>
		</div>
		{$form_show['PMCG_PAGE_3_DESC_3'][$id_lang]}
		<a class="btn btn-default button button-small" href="{$link->getModuleLink('pmcvg', 'privacymanagement', array(), true)|escape:'html':'UTF-8'}" title="{l s='Privacy management' mod='pmcvg'} class="btn btn-default button button-small">
        <span><i class="icon-chevron-left"></i> {l s='Return to privacy management' mod='pmcvg'}</span>
    </a>
	</div>
</div>
{/block}