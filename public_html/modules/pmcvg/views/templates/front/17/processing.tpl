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
		{$form_show['PMCG_PAGE_8_TITLE'][$id_lang]}
	</span>
{/capture}
<div class="privacymanagement">
	<div class="row">
		<div class="col-md-12 bigcontainer">
		<h3>{$form_show['PMCG_PAGE_8_TITLE'][$id_lang]}</h3>
			<hr />
			<div class="p">
				{$form_show['PMCG_PAGE_8_DESC_2'][$id_lang]}	
				<div class="text-center">
					<a class="btn btn-primary" href="{$link->getPageLink('contact')|escape:'html':'UTF-8'}">{l s='Reducing data processing' mod='pmcvg'}</a>
				</div>
			</div>
		</div>
		{$form_show['PMCG_PAGE_8_DESC_3'][$id_lang]}	
		<a class="btn btn-default button button-small" href="{$link->getModuleLink('pmcvg', 'privacymanagement', array(), true)|escape:'html':'UTF-8'}" title="{l s='Privacy management' mod='pmcvg'} class="btn btn-default button button-small">
        <span><i class="icon-chevron-left"></i> {l s='Return to privacy management' mod='pmcvg'}</span>
    </a>
	</div>
</div>