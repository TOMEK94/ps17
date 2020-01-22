{*
 * @package Jms Ajax Search
 * @version 1.1
 * @Copyright (C) 2009 - 2015 Joommasters.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @Website: http://www.joommasters.com
*}
{if $jpb_homepage == 6 || $jpb_homepage == 8 || $jpb_homepage == 11 || $jpb_homepage == 19 || $jpb_homepage == 20}
<div class="btn-group compact-hidden jms_ajax_search" id="jms_ajax_search">
	<a href="#" class="btn-xs icon_search" title="Search">
		<span class="button-search storm-zoom"></span>
	</a>
	<div class="search-box">
		<div class="close-search">
			<i class="fa fa-times" aria-hidden="true"></i>
		</div>
		<form method="get" action="{$link->getPageLink('search')|escape:'html':'UTF-8'}" class="searchbox">
			<input type="hidden" name="controller" value="search" />
			<input type="hidden" name="orderby" value="position" />
			<input type="hidden" name="orderway" value="desc" />
			<input type="text" id="ajax_search" name="search_query" placeholder="{l s='Search...' d='Modules.JmsAjaxsearch'}" class="form-control ajax_search"  />		
		 	<button type="submit" name="submit_search" class="button-search storm-zoom"></button>
		</form>
		<div id="search_result"></div>
	</div>	
</div>
{else}
<div class="btn-group compact-hidden jms_ajax_search" id="jms_ajax_search">
	<div class="search-box">
		<form method="get" action="{$link->getPageLink('search')|escape:'html':'UTF-8'}" class="searchbox">
			<input type="hidden" name="controller" value="search" />
			<input type="hidden" name="orderby" value="position" />
			<input type="hidden" name="orderway" value="desc" />
			<input type="text" id="ajax_search" name="search_query" placeholder="{l s='Search...' d='Modules.JmsAjaxsearch'}" class="form-control ajax_search" />		
			<button type="submit" name="submit_search" class="button-search storm-zoom"></button>
		</form>
		<div id="search_result"></div>
	</div>	
</div>
{/if}

