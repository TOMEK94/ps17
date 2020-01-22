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
<div class="privacymanagement">
	<div class="row">
		<div class="bigcontainer">
			<h3>{$form_show['PMCG_PAGE_1_TITLE'][$id_lang]}</h3>
			{$form_show['PMCG_PAGE_1_DESC_2'][$id_lang]}
			<hr />
				<div class="alert alert-danger">
					{l s='Remember, if you cancel some of your consents, you will not be able to shop in our store until you accept them again.' mod='pmcvg'}
				</div>
				<h2>{l s='Required consents' mod='pmcvg'}</h2>
				<table class="table">
					<thead>
						<tr>
							<th width="50%"><strong>{l s='Contents' mod='pmcvg'}</strong></th>
							<th width ="25%"><strong>{l s='Date of change' mod='pmcvg'}</strong></th>
							<th>{l s='Actions' mod='pmcvg'}</th>
						</tr>
					</thead>
					<tbody>
					{foreach from=$consents item = 'consent'}
						{if $consent['required'] && $consent['page'] neq 4 && $consent['page'] neq 3 && $consent['page'] neq 5}
						<tr>
							<td>{$consent['text']|replace:'<p>':''|replace:'</p>':''}</td>
							<td class="date">{$consent['date_upd']}</td>
							<td>
								<button class="cvg-button btn btn-default button-small button{if $consent['set']}_enable{else}_disable{/if}" data-value="{$consent['id_pmcvg']}">
									{if $consent['set']}
										<span class="icon-remove"></span> {l s='Deactivate consent' mod='pmcvg'}
									{else}
										<span class="icon-check"></span> {l s='Accept consent' mod='pmcvg'}
									{/if}
								</button>
							</td>
						</tr>
						{/if}
					{/foreach}
					</tbody>
				</table>
				<h2>{l s='Optional consents' mod='pmcvg'}</h2>				
					<table class="table">
						<thead>
							<tr>
								<th width="50%"><strong>{l s='Contents' mod='pmcvg'}</strong></th>
								<th width ="25%"><strong>{l s='Date of change' mod='pmcvg'}</strong></th>
								<th>{l s='Actions' mod='pmcvg'}</th>
							</tr>
						</thead>
					<tbody>
					{foreach from=$consents item = 'consent'}
						{if !$consent['required'] || $consent['required'] AND $consent['page'] eq 4 || $consent['required'] && $consent['page'] eq 5}
						<tr>
							<td>{$consent['text']|replace:'<p>':''|replace:'</p>':''}</td>
							<td class="date">{$consent['date_upd']}</td>
							<td>
								<button class="cvg-button btn btn-default button-small button{if $consent['set']}_enable{else}_disable{/if}" data-value="{$consent['id_pmcvg']}">
									{if $consent['set']}
										<span class="icon-remove"></span> {l s='Deactivate consent' mod='pmcvg'}
									{else}
										<span class="icon-check"></span> {l s='Accept consent'}
									{/if}
								</button>
							</td>
						</tr>
						{/if}
					{/foreach}
					</tbody>
				</table>
				<h2>{l s='Additional consents' mod='pmcvg'}</h2>
				<table class="table">
					<thead>
							<tr>
								<th width="50%"><strong>{l s='Contents' mod='pmcvg'}</strong></th>
								<th width ="25%"><strong>{l s='Date of change' mod='pmcvg'}</strong></th>
								<th>{l s='Actions' mod='pmcvg'}</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>{l s='Consent to receive the newsletter' mod='pmcvg'}</td>
							<td>{$customer_opt['newsletter_date_add']}</td>
							<td>
								<button class="cvg-button btn btn-default button-small button{if $customer_opt['newsletter']}_enable{else}_disable{/if}" data-value="newsletter">
									{if $customer_opt['newsletter']}
										<span class="icon-remove"></span> {l s='Deactivate consent' mod='pmcvg'}
									{else}
										<span class="icon-check"></span> {l s='Accept consent' mod='pmcvg'}
									{/if}
								</button>
							</td>
						</tr>
						<tr>
							<td>{l s='Receive special offers from our partners' mod='pmcvg'}</td>
							<td class="date">{$customer_opt['newsletter_date_add']}</td>
							<td>
								<button class="cvg-button btn btn-default button-small button{if $customer_opt['optin']}_enable{else}_disable{/if}" data-value="optin">
									{if $customer_opt['optin']}
										<span class="icon-remove"></span> {l s='Deactivate consent' mod='pmcvg'}
									{else}
										<span class="icon-check"></span> {l s='Accept consent' mod='pmcvg'}
									{/if}
								</button>
							</td>
						</tr>
					</tbody>
				</table>
				<hr />
				{$form_show['PMCG_PAGE_1_DESC_3'][$id_lang]}
			</div>
		<a class="btn btn-default button button-small" href="{$link->getModuleLink('pmcvg', 'privacymanagement', array(), true)|escape:'html':'UTF-8'}" title="{l s='Privacy management' mod='pmcvg'} class="btn btn-default button button-small">
        <span><i class="icon-chevron-left"></i> {l s='Return to privacy management' mod='pmcvg'}</span>
    </a>
	</div>
</div>
{/block}
