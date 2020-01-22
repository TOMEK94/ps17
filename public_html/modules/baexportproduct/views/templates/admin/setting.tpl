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
{if $version === 0}
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
{/if}
<form method="POST" action="">

<div class="panel col-lg-12" style="z-index:1" id="paneltongseting">

	<div class="col-lg-12">
		<div style="float:left;" class="col-lg-2">Task frequency</div>
		<div class="col-lg-3">
			<select name="hour" id="hour">
					<option value="-1" {if $ArrConfigTime['hour'] == -1}selected{/if}><li>{l s='Every hour' mod='baexportproduct'}  </li>
					</option>
				{for $foo=0 to 23}
					<option value="{$foo|escape:'htmlall':'UTF-8'}" {if $ArrConfigTime['hour'] == $foo}selected{/if}>
						<li>{$foo|escape:'htmlall':'UTF-8'}:00</li>
					</option>
				{/for}
			</select>
		</div>
	</div>
	
	<div class="col-lg-12" style="margin-top:10px;">
		<div class="col-lg-2"></div>
		<div class="col-lg-3">
			<select name="dayofmonth" id="daymonth">
					<option value="-1" {if $ArrConfigTime['dayofmonth'] == -1}selected{/if}><li>{l s='Every day of the month' mod='baexportproduct'}</li>
					</option>
				{for $foo=1 to 31}
					<option value="{$foo|escape:'htmlall':'UTF-8'}" {if $ArrConfigTime['dayofmonth'] == $foo|escape:'htmlall':'UTF-8'}selected{/if}><li>{$foo|escape:'htmlall':'UTF-8'}</li>
					</option>
				{/for}
			</select>
		</div>
	</div>
	
	<div class="col-lg-12" style="margin-top:10px;">
		<div class="col-lg-2"></div>
		<div class="col-lg-3">
			<select name="month" id="month">
					<option value="-1" {if $ArrConfigTime['month'] == -1}selected{/if}><li>{l s='Every month' mod='baexportproduct'}</li></option>
					<option value="1" {if $ArrConfigTime['month'] == 1}selected{/if}><li>{l s='January' mod='baexportproduct'}</li></option>
					<option value="2" {if $ArrConfigTime['month'] == 2}selected{/if}><li>{l s='February' mod='baexportproduct'}</li></option>
					<option value="3" {if $ArrConfigTime['month'] == 3}selected{/if}><li>{l s='March' mod='baexportproduct'}</li></option>
					<option value="4" {if $ArrConfigTime['month'] == 4}selected{/if}><li>{l s='April' mod='baexportproduct'}</li></option>
					<option value="5" {if $ArrConfigTime['month'] == 5}selected{/if}><li>{l s='May' mod='baexportproduct'}</li></option>
					<option value="6" {if $ArrConfigTime['month'] == 6}selected{/if}><li>{l s='June' mod='baexportproduct'}</li></option>
					<option value="7" {if $ArrConfigTime['month'] == 7}selected{/if} ><li>{l s='July' mod='baexportproduct'}</li></option>
					<option value="8" {if $ArrConfigTime['month'] == 8}selected{/if}><li>{l s='August' mod='baexportproduct'}</li></option>
					<option value="9" {if $ArrConfigTime['month'] == 9}selected{/if}><li>{l s='September' mod='baexportproduct'}</li></option>
					<option value="10" {if $ArrConfigTime['month'] == 10}selected{/if}><li>{l s='October' mod='baexportproduct'}</li></option>
					<option value="11" {if $ArrConfigTime['month'] == 11}selected{/if}><li>{l s='November' mod='baexportproduct'}</li></option>
					<option value="12" {if $ArrConfigTime['month'] == 12}selected{/if}><li>{l s='December' mod='baexportproduct'}</li></option>
			</select>
		</div>
	</div>
	
	<div class="col-lg-12" style="margin-top:10px;">
		<div class="col-lg-2"></div>
		<div class="col-lg-3">
			<select name="dayofweek" id="dayweek">
					<option value="-1" {if $ArrConfigTime['dayofweek'] == -1}selected{/if}><li>{l s='Every day of the week' mod='baexportproduct'}</li></option>
					<option value="0" {if $ArrConfigTime['dayofweek'] == 0}selected{/if}><li>{l s='Monday' mod='baexportproduct'}</li></option>
					<option value="1" {if $ArrConfigTime['dayofweek'] == 1}selected{/if}><li>{l s='Tuesday' mod='baexportproduct'}</li></option>
					<option value="2" {if $ArrConfigTime['dayofweek'] == 2}selected{/if}><li>{l s='Wednesday' mod='baexportproduct'}</li></option>
					<option value="3" {if $ArrConfigTime['dayofweek'] == 3}selected{/if}><li>{l s='Thursday' mod='baexportproduct'}</li></option>
					<option value="4" {if $ArrConfigTime['dayofweek'] == 4}selected{/if}><li>{l s='Friday' mod='baexportproduct'}</li></option>
					<option value="5" {if $ArrConfigTime['dayofweek'] == 5}selected{/if}><li>{l s='Saturday' mod='baexportproduct'}</li></option>
					<option value="6" {if $ArrConfigTime['dayofweek'] == 6}selected{/if}><li>{l s='Sunday' mod='baexportproduct'}</li></option>
			</select>
		</div>
	</div>
	<label id="lbdownload" style="margin-top:10px;">Download CSV file by <a href="{$link1|escape:'htmlall':'UTF-8'}">{$link1|escape:'htmlall':'UTF-8'}</a></label>
	
	<div class="panel-footer">
		<div class="col-lg-10" id="khoangcach"></div>
		<button class="btn btn-default pull-right" type="submit" name="savetime" class="btn btn-default pull-right">
			<i class="process-icon-save"></i>{l s='Save' mod='baexportproduct'}  
		</button>

	</div>	
	
	
</div>
</div>
</form>
