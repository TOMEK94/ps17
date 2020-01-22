<div class="panel " id="configuration_fieldset_general">
	<div class="panel-heading"><i class="icon-cogs"></i> {l s='Privacy management' mod='pmcvg'} - {l s='Global settings' mod='pmcvg'}</div>
		<div class="form-wrapper">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#global" data-toggle="tab">{l s='Global settings' mod='pmcvg'}</a>
				</li>
				<li class="">
					<a href="#general" data-toggle="tab">{l s='Customer page settings' mod='pmcvg'}</a>
				</li>
				<li class="">
					<a href="#other" data-toggle="tab">{l s='E-mail' mod='pmcvg'}</a>
				</li>
			</ul>
			<div class="tab-content panel">
				<div id="global" class="tab-pane active">
					{$globalform}
				</div>
				<div id="general" class="tab-pane">
					{$bigform}
				</div>
				<div id="other" class="tab-pane">
					{$emailform}
				</div>
			</div>
		</div>
	</div>
</div>