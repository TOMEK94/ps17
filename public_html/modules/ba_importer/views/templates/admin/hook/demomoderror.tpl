{*
* 2007-2013 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@buy-addons.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author Buy-addons <contact@buy-addons.com>
*  @copyright  2007-2018 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{if $demoMode=="1"}
	<div class="bootstrap ba_error">
		<div class="module_error alert alert-danger">
			{l s='You are use ' mod='ba_importer'}
			<strong>{l s='Demo Mode ' mod='ba_importer'}</strong>
			{l s=', so some buttons, functions will be disabled because of security. ' mod='ba_importer'}
			{l s='You can use them in Live mode after you puchase our module. ' mod='ba_importer'}
			{l s='Thanks !' mod='ba_importer'}
		</div>
	</div>
{/if}