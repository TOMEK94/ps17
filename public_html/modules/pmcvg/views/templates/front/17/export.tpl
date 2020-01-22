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
		{$form_show['PMCG_PAGE_3_TITLE'][$id_lang]}
	</span>
{/capture}
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