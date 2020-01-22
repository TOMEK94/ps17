{**
 * 2007-2018 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2018 PrestaShop SA
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
<div id="_desktop_user_info">
	<div class="user-info btn-group compact-hidden type1 ">
		{if $logged} 
		  	<a class="btn-name dropdown-toggle" data-toggle="dropdown" href="{$my_account_url}" title="{l s='View my customer account' d='Shop.Theme.CustomerAccount'}" rel="nofollow" target="_blank">      
		   		<i class="storm-user"></i>
		  	</a>
		  	<ul role="menu" class="dropdown-menu">
		  		<li><a>{$customerName}</a></li>
				<li><a href="{$link->getPageLink('my-account', true)}" title="{l s='View my customer account' d='Shop.Theme.CustomerAccount'}" class="account" rel="nofollow">{l s='My Account' d='Shop.Theme.CustomerAccount'} </a></li>		
				<li><a href="{$link->getModuleLink('jmswishlist', 'mywishlist', array(), true)|escape:'html':'UTF-8'}" title="{l s='My wishlists' d='Shop.Theme'}">{l s='My Wishlist' d='Shop.Theme.CustomerAccount'} </a></li>
				<li><a href="{$link->getPageLink('order', true)}" title="{l s='Checkout' d='Shop.Theme.CustomerAccount'}" class="account" rel="nofollow">{l s='Checkout' d='Shop.Theme.CustomerAccount'} </a></li>
				<li><a class="logout" href="{$logout_url}" rel="nofollow" >{l s='Log out' d='Shop.Theme.Actions'}</a></li>
			</ul>
		{else}   
			<a href="{$link->getPageLink('my-account', true)}" title="{l s='View my customer account' d='Shop.Theme.CustomerAccount'}" class="account dropdown-toggle" data-toggle="dropdown" rel="nofollow">
				<i class="storm-user"></i>
			</a>
			<ul role="menu" class="dropdown-menu">
				<li><a href="{$link->getPageLink('my-account', true)}" title="{l s='View my customer account' d='Shop.Theme.CustomerAccount'}" class="account" rel="nofollow">{l s='My Account' d='Shop.Theme.CustomerAccount'} </a></li>		
				<li><a href="{$link->getModuleLink('jmswishlist', 'mywishlist', array(), true)|escape:'html':'UTF-8'}" title="{l s='My wishlists' d='Shop.Theme'}">{l s='My Wishlist' d='Shop.Theme.CustomerAccount'} </a></li>
				<li><a href="{$link->getPageLink('order', true)}" title="{l s='Checkout' d='Shop.Theme.CustomerAccount'}" class="account" rel="nofollow">{l s='Checkout' d='Shop.Theme.CustomerAccount'} </a></li>
				<li><a class="logout" href="{$link->getPageLink('my-account', true)}" title="{l s='Login' d='Shop.Theme.CustomerAccount'}" rel="nofollow" >{l s='Log In' d='Shop.Theme.Actions'}</a></li>
			</ul>
		{/if}
	</div>
    <div class="user-info btn-group compact-hidden type2">
	    {if $logged} 
		  	<a href="{$my_account_url}" title="{l s='Log in to your customer account' d='Shop.Theme.CustomerAccount'}" rel="nofollow" class="logout2 hidden-sm-down btn-xs">
	      		<span class="hidden-sm-down">{$customerName}</span>
	      	</a>
	      	<ul>	
				<li><a href="{$link->getPageLink('order', true)}" title="{l s='View my customer account' d='Shop.Theme.CustomerAccount'}" class="account" rel="nofollow">{l s='Checkout' d='Shop.Theme.CustomerAccount'} </a></li>
		  		<li><a class="logout" href="{$logout_url}" rel="nofollow">{l s='Log out' d='Shop.Theme.Actions'}</a></li>
		  	</ul>
	    {else}   
		  	<a href="{$my_account_url}" title="{l s='Log in to your customer account' d='Shop.Theme.CustomerAccount'}" rel="nofollow"  class="logout2 hidden-sm-down  btn-xs dropdown-toggle" data-toggle="dropdown">
	      		<span class="hidden-sm-down">{l s='Login/Register' d='Shop.Theme.Actions'}</span>
	      	</a>
		  	<ul>
				<li><a href="{$link->getPageLink('my-account', true)}" title="{l s='View my customer account' d='Shop.Theme.CustomerAccount'}" class="account" rel="nofollow">{l s='Moje konto'  d='Shop.Theme.CustomerAccount'} </a></li>		
				<li><a href="{$link->getPageLink('order', true)}" title="{l s='View my customer account' d='Shop.Theme.CustomerAccount'}" class="account" rel="nofollow">{l s='Do kasy' d='Shop.Theme.CustomerAccount'} </a></li>
			</ul> 
	    {/if}
	 </div>
	 <div class="user-info btn-group compact-hidden type3">
		{if $logged} 
		 	<a class="btn-name account btn-xs dropdown-toggle" data-toggle="dropdown" href="{$my_account_url}"  title="{l s='View my customer account' d='Shop.Theme.CustomerAccount'}" rel="nofollow">
		    	<span>{$customerName}</span>
		  	</a>	
	      	<ul role="menu" class="dropdown-menu">
	      		<li><a>{$customerName}</a></li>
				<li><a href="{$link->getPageLink('my-account', true)}" title="{l s='View my customer account' d='Shop.Theme.CustomerAccount'}" class="account" rel="nofollow">{l s='Moje konto' d='Shop.Theme.CustomerAccount'} </a></li>		
				<li><a href="{$link->getPageLink('order', true)}" title="{l s='View my customer account' d='Shop.Theme.CustomerAccount'}" class="account" rel="nofollow">{l s='Do kasy' d='Shop.Theme.CustomerAccount'} </a></li>
		  		<li><a class="logout" href="{$logout_url}" rel="nofollow" >{l s='Log out' d='Shop.Theme.Actions'}</a></li>
		  	</ul>
	    {else}   
		  	<a href="{$link->getPageLink('my-account', true)}" title="{l s='Login/Register' d='Shop.Theme.CustomerAccount'}" class="account" rel="nofollow">
		  		<span>{l s='Login/Register' d='Shop.Theme.Actions'}</span>
		  	</a>
	    {/if}
	 </div>
</div>

