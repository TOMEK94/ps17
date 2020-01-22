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
* to license@buy-addons.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
* @author    Buy-addons    <contact@buy-addons.com>
* @copyright 2007-2018 Buy-addons
* @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<div id="warning" class='col-lg-12 panel'><div class='alert alert-danger' style='margin-top:10px;'>
<form method='post' enctype='multipart/form-data' >
		{l s='You need set up cron job in your hosting with command' mod='baexportproduct'} . <br />
			<strong>0 * * * * curl "{$ba_url|escape:'htmlall':'UTF-8'}modules/{$tenfile|escape:'htmlall':'UTF-8'}/autoexport.php?token={$keytoken|escape:'htmlall':'UTF-8'}"
			</strong><br />
			<button type='submit' class='btn btn-default' name='submit_cronjob' value='1'>
		 {l s='yes, i did' mod='baexportproduct'}  </button></form></div></div>