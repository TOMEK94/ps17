<div class="panel " id="configuration_fieldset_general">
	<div class="panel-heading"><i class="icon-cogs"></i> {l s='Privacy management' mod='pmcvg'} - {l s='Global settings' mod='pmcvg'}</div>
	<div class="row">
		<div class="col-md-3">
			<strong>Uwaga operacji nie można cofnąć - podaj id klienta do skasowania</strong>			
			<form action="" method="post">
				<div class="form-group">
					<label for="customer"></label>
					<input type="text" name="customer_id" />
				</div>
				<button onclick="confirm('{l s='Czy na pewno? Operacji nie można cofnąć?' mod='pmcvg'}')" type="Submit">{l s='Remove account' mod='pmcvg'}</button>
			</form>
		</div>
	</div>
</div>