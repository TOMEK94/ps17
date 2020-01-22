{if sizeof($conditions)}
<div class="conditions_{$conditions_name|escape:'htmlall':'UTF-8'}" style="{if $conditions_name neq 'account'}display: none;{/if}">
	{foreach from=$conditions item='condition'}
		<div class="form-group">
		    <div class="checkbox">
			  <label><input data-cvg="{$condition['id_pmcvg']}" name="conditions[{$condition['id_pmcvg']}]"{if isset($selected_conditions[$condition['id_pmcvg']])} checked="checked"{/if} class="cgv2{if $condition['required']} requiredcvg{if $conditions_name eq 'order'}order{/if}{/if}" type="checkbox" value="1">{$condition['text']|replace:'<p>':''|replace:'</p>':''}{if $condition['required']} <sup>*</sup>{/if}</label>
			</div>
		</div>
	{/foreach}
</div>
{/if}