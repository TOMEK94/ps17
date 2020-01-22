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
		{l s='Newsletter' mod='pmcvg'}
	</span>
{/capture}
<div class="privacymanagement">
	<div class="row box">
		<div class="col-md-12">
			<h3>{l s='Newsletter' mod='pmcvg'}</h3>
			<hr />
			<div class="p">
				<form action="{if isset($force_ssl) && $force_ssl}{$base_dir_ssl}{else}{$base_dir}{/if}" method="post">
					<div class="row">
						<div class="col-md-3">
							<div class="form-group required">
								<label for="email">{l s='E-mail' mod='pmcvg'}</label>
								<input type="text" data-validate="isEmail" class="is_required validate form-control email_submit" value="{$email|escape:'htmlall':'UTF-8'}" id="email" name="email" />
							</div>							
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							{$conditions_form}
							<input type="hidden" name="action"  value="0" />
							<input type="hidden" name="addtonewslettercvg"  value="1" />
							<button name="submitNewsletter" type="submit" id="addtonewslettercvg" disabled="disabled" class="btn btn-primary">{l s='Add to newsletter' mod='pmcvg'}</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>