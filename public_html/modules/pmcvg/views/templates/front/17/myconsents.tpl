{addJsDef cvgajax=$link->getModuleLink('pmcvg', 'myconsents', array(), true)|escape:'html':'UTF-8'}
{addJsDefL name=button_disable_lang}{l s='Accept consent' mod='pmcvg'}{/addJsDefL}
{addJsDefL name=button_enable_lang}{l s='Deactivate consent' mod='pmcvg'}{/addJsDefL}
{capture name=path}
 	<span class="navigation_page">
		<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
			<a itemprop="url" href="{$link->getPageLink('my-account')}" title="{l s='My account' mod='pmcvg'}" >
				<span itemprop="title">{l s='My account' mod='pmcvg'}</span>
			</a>
		</span>
		<span class="navigation-pipe">></span>
		<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
			<a itemprop="url" href="{$link->getModuleLink('pmcvg', 'privacymanagement', array(), true)|escape:'html':'UTF-8'}" title="{l s='Privacy management' mod='pmcvg'}" >
				<span itemprop="title">{l s='Privacy management' mod='pmcvg'}</span>
			</a>
		</span>
		<span class="navigation-pipe">></span>
		{$form_show['PMCG_PAGE_1_TITLE'][$id_lang]}
	</span>
{/capture}
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