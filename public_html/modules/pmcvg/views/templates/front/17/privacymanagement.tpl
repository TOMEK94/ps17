{capture name=path}
 	<span class="navigation_page">
		<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
			<a itemprop="url" href="{$link->getPageLink('my-account')}" title="{l s='My account' mod='pmcvg'}" >
				<span itemprop="title">{l s='My account' mod='pmcvg'}</span>
			</a>
		</span>
		<span class="navigation-pipe">></span>
		{l s='Privacy management' mod='pmcvg'}
	</span>
{/capture}
<div id="my-account">
	<div class="row addresses-lists">
		<ul class="myaccount-link-list">
			{if $form_show['PMCG_PAGE_1_ENABLE']}
			<li>
				<a href="{$link->getModuleLink('pmcvg', 'myconsents', array(), true)|escape:'html':'UTF-8'}">
					<i class="icon-cvg-1"></i> 
					<span>{$form_show['PMCG_PAGE_1_TITLE'][$id_lang]}
						<p>
							{$form_show['PMCG_PAGE_1_DESC_1'][$id_lang]|replace:'<p>':''|replace:'</p>':''}
						</p>
					</span>
				</a>
			</li>
			{/if}
			{if $form_show['PMCG_PAGE_2_ENABLE']}
			<li>
					<a href="{$link->getModuleLink('pmcvg', 'data', array(), true)|escape:'html':'UTF-8'}">
						<i class="icon-cvg-2"></i>
						<span>
								{$form_show['PMCG_PAGE_2_TITLE'][$id_lang]}
							<p>
								{$form_show['PMCG_PAGE_2_DESC_1'][$id_lang]|replace:'<p>':''|replace:'</p>':''}
							</p>
						</span>
					</a>							
			</li>
			{/if}
			{if $form_show['PMCG_PAGE_3_ENABLE']}
			<li>
				<a href="{$link->getModuleLink('pmcvg', 'export', array(), true)|escape:'html':'UTF-8'}">
					<i class="icon-cvg-3"></i>
						<span>
								{$form_show['PMCG_PAGE_3_TITLE'][$id_lang]}
							<p>
								{$form_show['PMCG_PAGE_3_DESC_1'][$id_lang]|replace:'<p>':''|replace:'</p>':''}
							</p>
						</span>
				</a>							
			</li>
			{/if}
			{if $form_show['PMCG_PAGE_4_ENABLE']}
			<li>
				<a href="{$link->getModuleLink('pmcvg', 'anonimize', array(), true)|escape:'html':'UTF-8'}">
					<i class="icon-cvg-4"></i>
						<span>
								{$form_show['PMCG_PAGE_4_TITLE'][$id_lang]}
							<p>
								{$form_show['PMCG_PAGE_4_DESC_1'][$id_lang]|replace:'<p>':''|replace:'</p>':''}
							</p>
						</span>
				</a>							
			</li>
			{/if}
			{if $form_show['PMCG_PAGE_5_ENABLE']}
			<li>
					<a href="{$link->getModuleLink('pmcvg', 'remove', array(), true)|escape:'html':'UTF-8'}">
						<i class="icon-cvg-5"></i>
						<span>
								{$form_show['PMCG_PAGE_5_TITLE'][$id_lang]}
							<p>
								{$form_show['PMCG_PAGE_5_DESC_1'][$id_lang]|replace:'<p>':''|replace:'</p>':''}
							</p>
						</span>
					</a>							
			</li>
			{/if}
			{if $form_show['PMCG_PAGE_6_ENABLE']}
			<li>
				<a href="{$link->getModuleLink('pmcvg', 'information', array(), true)|escape:'html':'UTF-8'}">
					<i class="icon-cvg-6"></i>
						<span>
								{$form_show['PMCG_PAGE_6_TITLE'][$id_lang]}
							<p>
								{$form_show['PMCG_PAGE_6_DESC_1'][$id_lang]|replace:'<p>':''|replace:'</p>':''}
							</p>
						</span>
				</a>							
			</li>
			{/if}
			{if $form_show['PMCG_PAGE_7_ENABLE']}
			<li>
				<a href="{$link->getModuleLink('pmcvg', 'leak', array(), true)|escape:'html':'UTF-8'}">
					<i class="icon-cvg-7"></i>
						<span>
								{$form_show['PMCG_PAGE_7_TITLE'][$id_lang]}
							<p>
								{$form_show['PMCG_PAGE_7_DESC_1'][$id_lang]|replace:'<p>':''|replace:'</p>':''}
							</p>
						</span>
				</a>							
			</li>
			{/if}
			{if $form_show['PMCG_PAGE_8_ENABLE']}
			<li>
				<a href="{$link->getModuleLink('pmcvg', 'processing', array(), true)|escape:'html':'UTF-8'}">
					<i class="icon-cvg-8"></i>
						<span>
								{$form_show['PMCG_PAGE_8_TITLE'][$id_lang]}
							<p>
								{$form_show['PMCG_PAGE_8_DESC_1'][$id_lang]|replace:'<p>':''|replace:'</p>':''}
							</p>
						</span>
				</a>							
			</li>
			{/if}
		</ul>
	</div>
</div>