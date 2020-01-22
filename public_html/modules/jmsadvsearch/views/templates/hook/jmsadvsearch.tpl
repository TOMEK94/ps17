{*
 * @package Jms Adv Search
 * @version 1.1
 * @Copyright (C) 2009 - 2015 Joommasters.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @Website: http://www.joommasters.com
*}
<div class="jms-advsearch">
	<form method="get" action="{$link->getPageLink('search') nofilter}" class="input-group" id="searchbox">
		<div class="input-group-addon icon-drop-down">
			<select name="id_category" id="selector_cat">
			<option value="0">{l s='All Category' mod='jmsadvsearch'}</option>
				{foreach from=$jmsCategTree.children item=child name=jmsCategTree}
					{if $smarty.foreach.jmsCategTree.last}
						{include file="$branche_tpl_path" node=$child last='true'}
					{else}
						{include file="$branche_tpl_path" node=$child}
					{/if}
				{/foreach}
			</select>
		</div>
			<input type="hidden" name="fc" value="module" />
			<input type="hidden" name="module" value="jmsadvsearch" />
			<input type="hidden" name="controller" value="search" />
			<input type="hidden" name="order" value="product.position.asc" />			
		<div class="input-group keyword-group">
			<input type="text" id="ajax_advsearch" name="search_query" placeholder="{l s='Search' mod='jmsadvsearch'}" class="input-search" />
			<span class="input-group-addon input-group-search">
				<button class="fa fa-search"></button>
			</span>
		</div>
	</form>
	<div id="advsearch_result">
	</div>
</div>
