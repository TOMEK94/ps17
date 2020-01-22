{*
* 2007-2017 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
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
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2017 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

<div class="panel">
	<h3><i class="icon icon-credit-card"></i> {l s='Notification' mod='pmcvg'}</h3>
	<div class="row">
		<div class="col-md-12">
			<form action="?controller=AdminNotification&token={$smarty.get.token}&id_pmcvg_process={$smarty.get.id_pmcvg_process}&viewpmcvg_process=1" method="post">
				{if $object->status eq 1}
					<h2>{l s='Your customer send to you requrest of remove account' mod='pmcvg'}</h2>
					<strong>{l s='Personal data' mod='pmcvg'}</strong>
					<table class="table">
						<tr>
							<th>{l s='Id' mod='pmcvg'}</th>
							<th>{l s='Firstname' mod='pmcvg'}</th>
							<th>{l s='Lastname' mod='pmcvg'}</th>
							<th>{l s='Company' mod='pmcvg'}</th>
							<th>{l s='E-mail' mod='pmcvg'}</th>
						</tr>
						<tr>
							<td>{$customer->id}</td>
							<td>{$customer->firstname}</td>
							<td>{$customer->lastname}</td>
							<td>{$customer->company}</td>
							<td>{$customer->email}</td>
						</tr>
					</table>
					<strong>{l s='Addresses' mod='pmcvg'}</strong>
					<table class="table">
						<tr>
							<th>{l s='id_address' mod='pmcvg'}</th>
							<th>{l s='alias' mod='pmcvg'}</th>
							<th>{l s='company' mod='pmcvg'}</th>
							<th>{l s='lastname' mod='pmcvg'}</th>
							<th>{l s='firstname' mod='pmcvg'}</th>
							<th>{l s='address1' mod='pmcvg'}</th>
							<th>{l s='address2' mod='pmcvg'}</th>
							<th>{l s='postcode' mod='pmcvg'}</th>
							<th>{l s='city' mod='pmcvg'}</th>
							<th>{l s='phone' mod='pmcvg'}</th>
							<th>{l s='phone_mobile' mod='pmcvg'}</th>
						</tr>
						{foreach from=$addresses item='adres'}
						<tr>
							<td>{$adres['id_address']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['alias']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['company']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['lastname']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['firstname']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['address1']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['address2']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['postcode']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['city']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['phone']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['phone_mobile']|escape:'htmlall':'UTF-8'}</td>
						</tr>
						{/foreach}
					</table>
					<input type="submit" class="btn btn-default" name="remove_account" value="{l s='Confirm' mod='pmcvg'}" />
				{else if $object->status eq 2}
					<h2>{l s='Your customer send to you requrest of aninimize data' mod='pmcvg'}</h2>
					<table class="table">
						<tr>
							<th>{l s='Id' mod='pmcvg'}</th>
							<th>{l s='Firstname' mod='pmcvg'}</th>
							<th>{l s='Lastname' mod='pmcvg'}</th>
							<th>{l s='Company' mod='pmcvg'}</th>
							<th>{l s='E-mail' mod='pmcvg'}</th>
						</tr>
						<tr>
							<td>{$customer->id}</td>
							<td>{$customer->firstname}</td>
							<td>{$customer->lastname}</td>
							<td>{$customer->company}</td>
							<td>{$customer->email}</td>
						</tr>
					</table>
					<strong>Addresses</strong>
					<table class="table">
						<tr>
							<th>{l s='id_address' mod='pmcvg'}</th>
							<th>{l s='alias' mod='pmcvg'}</th>
							<th>{l s='company' mod='pmcvg'}</th>
							<th>{l s='lastname' mod='pmcvg'}</th>
							<th>{l s='firstname' mod='pmcvg'}</th>
							<th>{l s='address1' mod='pmcvg'}</th>
							<th>{l s='address2' mod='pmcvg'}</th>
							<th>{l s='postcode' mod='pmcvg'}</th>
							<th>{l s='city' mod='pmcvg'}</th>
							<th>{l s='phone' mod='pmcvg'}</th>
							<th>{l s='phone_mobile' mod='pmcvg'}</th>
						</tr>
						{foreach from=$addresses item='adres'}
						<tr>
							<td>{$adres['id_address']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['alias']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['company']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['lastname']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['firstname']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['address1']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['address2']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['postcode']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['city']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['phone']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['phone_mobile']|escape:'htmlall':'UTF-8'}</td>
						</tr>
						{/foreach}
					</table>
					<input type="submit" class="btn btn-default" name="anonimize_account" value="{l s='Confirm' mod='pmcvg'}" />
				{else if $object->status eq 3}
				<h2>{l s='Your customer send to you requrest of remove account' mod='pmcvg'}</h2>
					<table class="table">
						<tr>
							<th>{l s='Id' mod='pmcvg'}</th>
							<th>{l s='Firstname' mod='pmcvg'}</th>
							<th>{l s='Lastname' mod='pmcvg'}</th>
							<th>{l s='Company' mod='pmcvg'}</th>
							<th>{l s='E-mail' mod='pmcvg'}</th>
						</tr>
						<tr>
							<td>{$customer->id}</td>
							<td>{$customer->firstname}</td>
							<td>{$customer->lastname}</td>
							<td>{$customer->company}</td>
							<td>{$customer->email}</td>
						</tr>
					</table>
					<strong>Addresses</strong>
					<table class="table">
						<tr>
							<th>{l s='id_address' mod='pmcvg'}</th>
							<th>{l s='alias' mod='pmcvg'}</th>
							<th>{l s='company' mod='pmcvg'}</th>
							<th>{l s='lastname' mod='pmcvg'}</th>
							<th>{l s='firstname' mod='pmcvg'}</th>
							<th>{l s='address1' mod='pmcvg'}</th>
							<th>{l s='address2' mod='pmcvg'}</th>
							<th>{l s='postcode' mod='pmcvg'}</th>
							<th>{l s='city' mod='pmcvg'}</th>
							<th>{l s='phone' mod='pmcvg'}</th>
							<th>{l s='phone_mobile' mod='pmcvg'}</th>
						</tr>
						{foreach from=$addresses item='adres'}
						<tr>
							<td>{$adres['id_address']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['alias']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['company']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['lastname']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['firstname']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['address1']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['address2']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['postcode']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['city']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['phone']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['phone_mobile']|escape:'htmlall':'UTF-8'}</td>
						</tr>
						{/foreach}
					</table>
				{else if $object->status eq 4}
				<h2>{l s='Your customer send to you requrest of aninimize data' mod='pmcvg'}</h2>
					<table class="table">
						<tr>
							<th>{l s='Id' mod='pmcvg'}</th>
							<th>{l s='Firstname' mod='pmcvg'}</th>
							<th>{l s='Lastname' mod='pmcvg'}</th>
							<th>{l s='Company' mod='pmcvg'}</th>
							<th>{l s='E-mail' mod='pmcvg'}</th>
						</tr>
						<tr>
							<td>{$customer->id}</td>
							<td>{$customer->firstname}</td>
							<td>{$customer->lastname}</td>
							<td>{$customer->company}</td>
							<td>{$customer->email}</td>
						</tr>
					</table>
					<strong>Addresses</strong>
					<table class="table">
						<tr>
							<th>{l s='id_address' mod='pmcvg'}</th>
							<th>{l s='alias' mod='pmcvg'}</th>
							<th>{l s='company' mod='pmcvg'}</th>
							<th>{l s='lastname' mod='pmcvg'}</th>
							<th>{l s='firstname' mod='pmcvg'}</th>
							<th>{l s='address1' mod='pmcvg'}</th>
							<th>{l s='address2' mod='pmcvg'}</th>
							<th>{l s='postcode' mod='pmcvg'}</th>
							<th>{l s='city' mod='pmcvg'}</th>
							<th>{l s='phone' mod='pmcvg'}</th>
							<th>{l s='phone_mobile' mod='pmcvg'}</th>
						</tr>
						{foreach from=$addresses item='adres'}
						<tr>
							<td>{$adres['id_address']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['alias']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['company']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['lastname']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['firstname']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['address1']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['address2']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['postcode']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['city']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['phone']|escape:'htmlall':'UTF-8'}</td>
							<td>{$adres['phone_mobile']|escape:'htmlall':'UTF-8'}</td>
						</tr>
						{/foreach}
					</table>
				{/if}
			</form>
		</div>
	</div>
	<div class="panel-footer">
		<a href="index.php?controller=AdminNotification&amp;token={$smarty.get.token}" class="btn btn-default" onclick="window.history.back();">
			<i class="process-icon-back"></i> Back
		</a>
	</div>
</div>
{if isset($download)}
<script type="text/javascript">
	window.location.href = window.location.href + '&download=1';
</script>
{/if}