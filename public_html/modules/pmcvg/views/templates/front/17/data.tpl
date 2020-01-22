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
		{$form_show['PMCG_PAGE_2_TITLE'][$id_lang]}
	</span>
{/capture}
	<div class="row">
		<div class="col-md-12">
			<h3>{$form_show['PMCG_PAGE_2_TITLE'][$id_lang]}</h3>
			<hr />
			{$form_show['PMCG_PAGE_2_DESC_2'][$id_lang]}
			<div id="my-account">
			<ul class="myaccount-link-list">
			<li class="col-md-4">
				<a href="{$link->getPageLink('identity')|escape:'html':'UTF-8'}">
					<i class="pass-icon"></i>
						<span>{l s='Change password' mod='pmcvg'}
						</span>
				</a>
			</li>
			<li class="col-md-4">
				<a href="{$link->getPageLink('addresses')|escape:'html':'UTF-8'}">
					<i class="adr-icon"></i>
						<span>{l s='Edit addresses' mod='pmcvg'}
						</span>
				</a>
			</li>
			<li class="col-md-4">
				<a href="{$link->getPageLink('identity')|escape:'html':'UTF-8'}">
					<i class="per-icon"></i>
						<span>{l s='Edit personaldata' mod='pmcvg'}
						</span>
				</a>
			</li>
		</ul>
		{$form_show['PMCG_PAGE_2_DESC_3'][$id_lang]}
		</div>
		<a class="btn btn-default button button-small" href="{$link->getModuleLink('pmcvg', 'privacymanagement', array(), true)|escape:'html':'UTF-8'}" title="{l s='Privacy management' mod='pmcvg'} class="btn btn-default button button-small"><span><i class="icon-chevron-left"></i> {l s='Return to privacy management' mod='pmcvg'}</span>
    </a>
	</div>