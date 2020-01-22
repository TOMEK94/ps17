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
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

{if $version === 0}
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>{/if}
<form class="defaultForm form-horizontal" method="post" enctype="multipart/form-data">
<div class='panel col-lg-12' id="paneltong">
<a href="#">
	<div class="panel-heading" id="icon1">
	<i class="fa fa-cogs" aria-hidden="true"></i>
		{l s=' Fileter product' mod='baexportproduct'}
				<i style="float:right;margin-top:10px;margin-right:15px;" class="fa fa-minus-circle" id="fontawe1" aria-hidden="true"></i>
	</div>
</a>
    
    <div id="hidefilter">
        <div class='form-wrapper' style="margin-top:10px;">
		
            <div class='form-group'>
                <div class="col-lg-3"></div>
                <label class="control-label col-lg-1" style="margin-top:10px;">{l s='Manufacturers' mod='baexportproduct'}</label>
                <div class='row col-lg-5' style="margin:10px;">
                    <table class='table table-bordered'>
                        <tbody style="height: 150px;overflow: auto;">
                            <tr>
                                <td>
                                    <span class="title_box">
                                        <input type="checkbox" name="checkManufacturers[]" id="checkme" onclick="$(this).parents('.form-group').find('.checkbox_table').prop('checked', this.checked)">
                                    </span>
                                </td>

                                <td>
                                    <span class="title_box">
                                        {l s='Name' mod='baexportproduct'}  
                                    </span>
                                </td>
                            </tr>
                            {foreach from=$nameManufac key=key item=i}
                                <tr>

                                    <td>
                                        <input {foreach from=$settingtpl['id_manufacturer'] key=k item=i}{if $nameManufac[$key]['id_manufacturer']|escape:'htmlall':'UTF-8' == $settingtpl['id_manufacturer'][$k]|escape:'htmlall':'UTF-8'}checked{/if}{/foreach} type="checkbox" value="{$nameManufac[$key]['id_manufacturer']|escape:'htmlall':'UTF-8'}" class="checkbox_table table_in statusOrders" name="Manufacturers[]}" >
                                    </td>
                                    <td>
                                        <label class="luivao">{$nameManufac[$key]['name']|escape:'htmlall':'UTF-8'}</label>
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>


                    </table>
                </div>
            </div>
        </div>


        <div class='form-wrapper'>
            <div class='form-group'>
                <div class="col-lg-3"></div>
                <label class="control-label col-lg-1" style="margin-top:10px;">{l s='Supplier' mod='baexportproduct'}</label>
                <div class='row col-lg-5' style="margin:10px;">
                    <table class='table table-bordered'>
                        <tbody style="height: 150px;overflow: auto;">
                            <tr>
                                <td>
                                    <span class="title_box">
                                        <input type="checkbox" name="checkSupplier[]" id="checkme" onclick="$(this).parents('.form-group').find('.checkbox_table').prop('checked', this.checked)">
                                    </span>
                                </td>

                                <td>
                                    <span class="title_box">
                                        {l s='Name' mod='baexportproduct'}  
                                    </span>
                                </td>
                            </tr>
                            {foreach from=$nameSuppli key=key1 item=i}
                                <tr>
                                    <td>
                                        <input {foreach from=$settingtpl['id_supplier'] key=k item=i}{if $nameSuppli[$key1]['id_supplier']|escape:'htmlall':'UTF-8' == $settingtpl['id_supplier'][$k]|escape:'htmlall':'UTF-8'}checked{/if}{/foreach} type="checkbox" value='{$nameSuppli[$key1]['id_supplier']|escape:'htmlall':'UTF-8'}' class="checkbox_table table_in statusOrders" name="Supplier[]}" >
                                    </td>

                                    <td>
                                        <label class="luivao">{$nameSuppli[$key1]['name']|escape:'htmlall':'UTF-8'}</label>
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

		
        <div class='form-wrapper'>
            <div class='form-group'>
                <div class="col-lg-3"></div>
                <label class="col-lg-1 control-label" style="margin-top:10px;">{l s='Category' mod='baexportproduct'}</label>

                <div class="col-lg-5" style="margin:10px;">
                    {$menu}{*Escape is unnecessary*}
                </div>
            </div>
        </div>
		
        <div class="form-group table_bl">
            <div class="col-lg-12">
                <div class="col-lg-3"></div>
                <label class="control-label col-lg-1">{l s='Attribute' mod='baexportproduct'}</label>
                <div class="col-lg-3" style="margin-left:10px;">
                    <select size="5" multiple name="OpAttri[]}" id="selecattri">
                        {foreach from=$attribute key=k1 item=i}
                            <optgroup label="{$attribute[$k1]['name']|escape:'htmlall':'UTF-8'}" mutiplay>
                                {foreach from=$Attribute13[$k1] key=k item=i}
                                    <option value="{$Attribute13[$k1][$k]['id_attribute']|escape:'htmlall':'UTF-8'}" {foreach from=$settingtpl['id_attribute'] key=key item=i}{if $Attribute13[$k1][$k]['id_attribute']|escape:'htmlall':'UTF-8' == $settingtpl['id_attribute'][$key]|escape:'htmlall':'UTF-8'}selected{/if}{/foreach}>
                                        {$Attribute13[$k1][$k]['name']|escape:'htmlall':'UTF-8'}
                                    </option>
                                {/foreach}
                            </optgroup>
                        {/foreach}
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group table_bl">
            <div class="col-lg-12" style="margin-top: 20px;">
                <div class="col-lg-3"></div>
                <label class="control-label col-lg-1">{l s='Features' mod='baexportproduct'}</label>

                <div class="col-lg-3" style="margin-left:10px;">
                    <select size="5" multiple name="OpFeatu[]}" id="selectFeature">
                        {foreach from=$idfeature key=k1 item=i}
                            <optgroup label="{$idfeature[$k1]['name']|escape:'htmlall':'UTF-8'}" mutiplay>
                                {foreach from=$ValFeature[$k1] key=k item=i}
                                    <option value="{$ValFeature[$k1][$k]['id_feature_value']|escape:'htmlall':'UTF-8'}"  {foreach from=$settingtpl['id_feature'] key=key item=i}{if $ValFeature[$k1][$k]['id_feature_value']|escape:'htmlall':'UTF-8' == $settingtpl['id_feature'][$key]|escape:'htmlall':'UTF-8'}selected{/if}{/foreach}>
                                        {$ValFeature[$k1][$k]['value']|escape:'htmlall':'UTF-8'}
                                    </option>
                                {/foreach}
                            </optgroup>
                        {/foreach}
                    </select>
                </div>
            </div>
        </div>


        <div id="store1_5">            
			<div class="col-lg-3"></div>
				<label class="control-label col-lg-1">{l s='Store' mod='baexportproduct'}</label>

				<div class="col-lg-3" style="margin-left:10px;">
				<select size='3' name='opStore[]' multiple id="selectStore">
				   {foreach from=$shop key=k item=i}
						<option value="{$shop[$k]['id_shop']|escape:'htmlall':'UTF-8'}" {foreach from=$settingtpl['id_store'] key=key item=i}{if $shop[$k]['id_shop']|escape:'htmlall':'UTF-8' == $settingtpl['id_store'][$key]|escape:'htmlall':'UTF-8'}selected{/if}{/foreach}>
							{$shop[$k]['name']|escape:'htmlall':'UTF-8'}
						</option>

					{/foreach}
				</select>
			</div>
		</div>
            


        <div class="form-wrapper">
            <div class="form-group">
                <div class="col-lg-12  ">
                    <div class="col-lg-2"></div>
                    <label class="col-lg-2 control-label" style="margin-top:10px;">{l s='Status Product' mod='baexportproduct'}</label>
                    <div class="col-lg-5" id="divstatus" >
                        <span name="switch" style="margin-left:15px;margin-top:10px;">
                            {l s='Yes' mod='baexportproduct'}<input id="rdstatus1" {if $settingtpl['id_status']|escape:'htmlall':'UTF-8' == 2}checked{/if} type="radio" name="status" value="2"  >

                            {l s='No' mod='baexportproduct'}<input id="rdstatus2" {if $settingtpl['id_status']|escape:'htmlall':'UTF-8' == 1}checked{/if} type="radio" name="status"  value="1" >

                            {l s='All' mod='baexportproduct'}<input id="rdstatus3" {if $settingtpl['id_status']|escape:'htmlall':'UTF-8' == 0}checked{/if} type="radio" name="status" value="0" >
							</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-wrapper" >
            <div class="form-group">
                <div class="col-lg-12" id="visibility1_5">
                    <div class="col-lg-2"></div>
                    <label class="control-label col-lg-2" for="visibility" id="lbvisibi">
                        {l s='Visibility' mod='baexportproduct'}
                    </label>
                    <div class="col-lg-3" id="optionvisibi">
                        <select name="visibility[]" id="visibility" size="4" multiple >
                            <option value="both" {foreach $settingtpl['id_visibility'] key=key item=i}{if $settingtpl['id_visibility'][$key]|escape:'htmlall':'UTF-8' == "both"}selected{/if}{/foreach}>Everywhere</option>
                            <option value="catalog" {foreach $settingtpl['id_visibility'] key=key item=i}{if $settingtpl['id_visibility'][$key]|escape:'htmlall':'UTF-8' == "catalog"}selected{/if}{/foreach}>Catalog only</option>
                            <option value="search"{foreach $settingtpl['id_visibility'] key=key item=i}{if $settingtpl['id_visibility'][$key]|escape:'htmlall':'UTF-8' == "search"}selected{/if}{/foreach}>Search only</option>
                            <option value="none" {foreach $settingtpl['id_visibility'] key=key item=i}{if $settingtpl['id_visibility'][$key]|escape:'htmlall':'UTF-8' == "none"}selected{/if}{/foreach}>Nowhere</option>
                        </select>
                    </div>


                </div>
            </div>
        </div>



        <div class="form-wrapper">
            <div class="form-group">
			<div class="col-lg-12">
			<div class="control-label col-lg-4 required">
				<span class="label-tooltip" data-original-title="" title="">
					{l s='Price' mod='baexportproduct'}
				</span>
			</div>
                
                    <div class="form-group col-lg-5" style="margin-left:10px;">
                        <div style="float:left;" class="input-group col-lg-5"><span class="input-group-addon">{$currency->sign|escape:'htmlall':'UTF-8'} </span>
							<input placeholder="{l s='From' mod='baexportproduct'}" id="inputfrprice" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onpaste="return false;" value="{$settingtpl['from_price']|escape:'htmlall':'UTF-8'}"  type="text" name="fromMoney"/></div>
                        <div  class="col-lg-1 "style="width: 37px;padding-left: 16px;padding-top: 3px;">-</div>
                        <div  class="input-group col-lg-5"><span class="input-group-addon">{$currency->sign|escape:'htmlall':'UTF-8'}</span>
							<input placeholder="{l s='To' mod='baexportproduct'}" id="toprice" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onpaste="return false;" class="col-lg-5" value="{$settingtpl['to_price']|escape:'htmlall':'UTF-8'}" type="text" name="ToMoney" /></div>
						</div>
					</div>
				</div>
			</div>

        <div class="form-wrapper" id="feildquantity">
			<div class="form-group">
			<div class="col-lg-12">
			<div class="control-label col-lg-4 required">
				<span class="label-tooltip" data-original-title="" title="">
					{l s='Quantity' mod='baexportproduct'}
				</span>
			</div>
                
                    <div class="form-group col-lg-5" id="inputquan">
                        <div id="fromquantity" class="col-lg-5"><input placeholder="{l s='From' mod='baexportproduct'}" id="inputfromquantity" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onpaste="return false;" type="text" value="{$settingtpl['from_quantity']|escape:'htmlall':'UTF-8'}" name="FromQuantity"/></div>
                        <div style="width: 36px;padding-left: 20px;padding-top: 3px;" class="col-lg-1" >-</div>
                        <div id="divtoquan" class="col-lg-5"><input placeholder="{l s='To' mod='baexportproduct'}" id="inputtoquantity" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onpaste="return false;" class="col-lg-5" value="{$settingtpl['to_quantity']|escape:'htmlall':'UTF-8'}" type="text" name="ToQuantity" /></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-wrapper">
            <div class="form-group">
			<div class="col-lg-12">
			<div class="control-label col-lg-4 required">
				<span class="label-tooltip" data-original-title="" title="">
					{l s='Create Date' mod='baexportproduct'}
				</span>
			</div>
                    <div class="form-group col-lg-6" style="margin-left:4px;">
                        <div id="divcreatefr">
							<input placeholder="{l s='From' mod='baexportproduct'}"  id="fromCreate" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onpaste="return false;" value="{$settingtpl['from_create']|escape:'htmlall':'UTF-8'}" class="Date" type="text" name="fromCreate"/>
							<span class="input-group-addon" style="width:27px;height:27px;">
								<i class="icon-calendar"></i>
							</span>
						</div>
                        <div class="col-lg-1" style="width: 32px;padding-left: 16px;padding-top: 3px;">-</div>
                        <div id="divcreateto" class="CLDate col-lg-6">
							<input placeholder="{l s='To' mod='baexportproduct'}" id="tocreatedate"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" onpaste="return false;" value="{$settingtpl['to_create']|escape:'htmlall':'UTF-8'}" class="Date" type="text" name="ToCreate" />
							<span class="input-group-addon" style="width:27px;height:27px;">
								<i class="icon-calendar"></i>
							</span>
						</div>
						
                    </div>
                </div>
            </div>
        </div>

        <div class="form-wrapper">
            <div class="form-group">
			<div class="col-lg-12">
			<div class="control-label col-lg-4 required">
				<span class="label-tooltip" data-original-title="" title="">
					{l s='Update Date' mod='baexportproduct'}
				</span>
			</div>
                    <div class="form-group col-lg-5" style="margin-left:4px;">
                        <div id="divupdatefr" class="CLDate col-lg-6"><input placeholder="{l s='From' mod='baexportproduct'}" id="frominputupdate" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onpaste="return false;" class="Date" value="{$settingtpl['from_update']|escape:'htmlall':'UTF-8'}" type="text" name="FromUpdate"/><span class="input-group-addon" style="width:27px;height:27px;"><i class="icon-calendar"></i></span></div>
                        <div class="col-lg-1"  style="width: 26px;padding-left: 10px;padding-top: 3px;float:left">-</div>
                        <div id="divupdateto" class="CLDate col-lg-6"><input placeholder="{l s='To' mod='baexportproduct'}" id="toupdatedate" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onpaste="return false;" class="Date" value="{$settingtpl['to_update']|escape:'htmlall':'UTF-8'}" type="text" name="ToUpdate" /><span class="input-group-addon" style="width:27px;height:27px;"><i class="icon-calendar"></i></span></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-wrapper">
           <div class="form-group">
			<div class="col-lg-12">
			<div class="control-label col-lg-4 required">
				<span class="label-tooltip" data-original-title="" title="">
					{l s='Package Width' mod='baexportproduct'}
				</span>
			</div>
                    <div id="divwidth" class="input-group col-lg-2" >
						<span class="input-group-addon" >{l s='cm' mod='baexportproduct'}</span>
						<input placeholder="{l s='From' mod='baexportproduct'}" id="inputfrwidth" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onpaste="return false;" value="{$settingtpl['from_width']|escape:'htmlall':'UTF-8'}"  name="FromWidth" type="text"  >
					</div>
					<div class="between"> - </div>
					<div class="input-group col-lg-2" class="ToWie">
						<span class="input-group-addon">{l s='cm' mod='baexportproduct'}</span>
						<input placeholder="{l s='To' mod='baexportproduct'}" id="inputtowidth" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onpaste="return false;" type="text" value="{$settingtpl['to_width']|escape:'htmlall':'UTF-8'}" name="ToWidth" >
					</div>
					
                </div>
            </div>
        </div>

        <div class="form-wrapper">
           <div class="form-group">
			<div class="col-lg-12">
			<div class="control-label col-lg-4 required">
				<span class="label-tooltip" data-original-title="" title="">
					{l s='Package Height' mod='baexportproduct'}
				</span>
			</div>
                    <div class="input-group col-lg-2" id="heighttrc">
						<span class="input-group-addon" id="donviheightfr">{l s='cm' mod='baexportproduct'}</span>
						<input placeholder="{l s='From' mod='baexportproduct'}" id="inputfrheight" class="inputto" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onpaste="return false;" value="{$settingtpl['from_height']|escape:'htmlall':'UTF-8'}"  name="FromHeight" type="text"  >
					</div>
					<div  class="between"> - </div>
					<div class="input-group col-lg-2" id="toheight">
						<span class="input-group-addon">{l s='cm' mod='baexportproduct'}</span>
						<input placeholder="{l s='To' mod='baexportproduct'}" id="inputtoheight" class="inputto" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onpaste="return false;" type="text" value="{$settingtpl['to_height']|escape:'htmlall':'UTF-8'}" name="ToHeight" >
					</div>
                </div>
            </div>
        </div>

        <div class="form-wrapper">
            <div class="form-group">
			<div class="col-lg-12">
			<div class="control-label col-lg-4 required">
				<span class="label-tooltip" data-original-title="" title="">
					{l s='Package Depth' mod='baexportproduct'}
				</span>
			</div>
                    <div class="input-group col-lg-2" id="feildfromdepth">
						<span class="input-group-addon" id="donvidepthfr">{l s='cm' mod='baexportproduct'}</span>
						<input placeholder="{l s='From' mod='baexportproduct'}" id="inputDepthfr" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onpaste="return false;" value="{$settingtpl['from_depth']|escape:'htmlall':'UTF-8'}"  name="FromDepth" type="text"  >
					</div>
					<div id="idbet1" class="between"> - </div>
					<div class="input-group col-lg-2" id="todepth">
						<span class="input-group-addon">{l s='cm' mod='baexportproduct'}</span>
						<input placeholder="{l s='To' mod='baexportproduct'}" id="inputDepthto" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onpaste="return false;" type="text" value="{$settingtpl['to_depth']|escape:'htmlall':'UTF-8'}" name="ToDepth" >
					</div>
                </div>
            </div>
        </div>

        <div class="form-wrapper">
           <div class="form-group">
			<div class="col-lg-12">
			<div class="control-label col-lg-4 required">
				<span class="label-tooltip" data-original-title="" title="">
					{l s='Package Weight' mod='baexportproduct'}
				</span>
			</div>
                    <div class="input-group col-lg-2" id="feildfrweight">
						<span id="donvifrweight" class="input-group-addon">{l s='kg' mod='baexportproduct'}</span>
						<input placeholder="{l s='From' mod='baexportproduct'}" id="inputWeightfr" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onpaste="return false;" value="{$settingtpl['from_weight']|escape:'htmlall':'UTF-8'}"  name="FromWeight" type="text"  >
					</div>
					<div id="idbet" class="between"> - </div>
					<div class="input-group col-lg-2" id="feildtoweight">
						<span class="input-group-addon">{l s='kg' mod='baexportproduct'}</span>
						<input placeholder="{l s='To' mod='baexportproduct'}" id="inputWeightTo" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onpaste="return false;" type="text" value="{$settingtpl['from_weight']|escape:'htmlall':'UTF-8'}" name="ToWeight" >
					</div>
                </div>
            </div>
        </div>
</div>
</div>

<div class="panel col-lg-12" id="panel2">
        <a href="#">
            <div class="panel-heading" id="icon2">
                <i class="fa fa-cogs" aria-hidden="true"></i>
						{l s='SELECT FIELDS FOR EXPORT' mod='baexportproduct'}
				<i style="float:right;margin-top:10px;margin-right:15px;" class="fa fa-minus-circle classicon" id="fontawe2" aria-hidden="true"></i>
            </div>
        </a>
        <div id="hidetruong">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-4" id="boxdata">
				<div id="resetForm">
					<a id="reset" onclick="return false" href=""><i class="icon-refresh icon-refresh"></i>Reset</a>
				</div>
					<div class="header_box" id="general7">
						<label id="lbproduc">{l s='Product data' mod='baexportproduct'} </label>
						<input id="search7" class="search_left" placeholder="Search">
					</div>
                <ul class="block_product_left">
                    <li  Name_Gerenal="{l s='Product ID' mod='baexportproduct'}-id_product">
                        {l s='Product ID' mod='baexportproduct'}
                    </li>
                    <li Name_Gerenal="{l s='Supplier ID Default' mod='baexportproduct'}-id_supplier">
                        {l s='Supplier ID Default' mod='baexportproduct'}
                    </li>
                    <li Name_Gerenal="{l s='Supplier Name Default' mod='baexportproduct'}-supplier_name">
                        {l s='Supplier Name Default' mod='baexportproduct'}
                    </li>
					<li Name_Gerenal="{l s='All Suppliers ID' mod='baexportproduct'}-id_supplier_all">
                        {l s='All Suppliers ID' mod='baexportproduct'}
                    </li>
					 <li Name_Gerenal="{l s='All Suppliers Name' mod='baexportproduct'}-supplier_name_all">
                        {l s='All Suppliers Name' mod='baexportproduct'}
                    </li>
                    <li Name_Gerenal="{l s='Manufacturer ID' mod='baexportproduct'}-id_manufacturer">
                        {l s='Manufacturer ID' mod='baexportproduct'}
                    </li>
                    <li Name_Gerenal="{l s='Manufacturer Name' mod='baexportproduct'}-manufacturer_name">
                        {l s='Manufacturer Name' mod='baexportproduct'}
                    </li>
					{foreach from=$Language key=key item=i}
						<li Name_Gerenal="{l s='Product Name ' mod='baexportproduct'}{$Language[$key]['name']|escape:'htmlall':'UTF-8'}-name {$Language[$key]['name']|escape:'htmlall':'UTF-8'}">
							{l s='Product Name ' mod='baexportproduct'}{$Language[$key]['name']|escape:'htmlall':'UTF-8'}
						</li>
					{/foreach}
                    <li Name_Gerenal="{l s='Product link' mod='baexportproduct'}-product_link">
                        {l s='Product link' mod='baexportproduct'}
                    </li>
					<li Name_Gerenal="{l s='Product Reference Code' mod='baexportproduct'}-reference">
                        {l s='Product Reference Code' mod='baexportproduct'}
                    </li>
                    <li Name_Gerenal="{l s='Product EAN 13' mod='baexportproduct'}-ean13">
                        {l s='Product EAN-13' mod='baexportproduct'}
                    </li>
                    <li Name_Gerenal="{l s='UPC barcode' mod='baexportproduct'}-upc">
                        {l s='UPC barcode' mod='baexportproduct'}
                    </li>
                    <li Name_Gerenal="{l s='Visibility' mod='baexportproduct'}-visibility">
                        {l s='Visibility' mod='baexportproduct'}
                    </li>
				{foreach from=$Language key=key item=i}
                    <li Name_Gerenal="{l s='Short description ' mod='baexportproduct'}{$Language[$key]['name']|escape:'htmlall':'UTF-8'}-description_short {$Language[$key]['name']|escape:'htmlall':'UTF-8'}">
                        {l s='Short description ' mod='baexportproduct'}{$Language[$key]['name']|escape:'htmlall':'UTF-8'}
                    </li>
				{/foreach}
				{foreach from=$Language key=key item=i}
                    <li Name_Gerenal="{l s='Description ' mod='baexportproduct'}{$Language[$key]['name']|escape:'htmlall':'UTF-8'}-description {$Language[$key]['name']|escape:'htmlall':'UTF-8'}">
                        {l s='Description ' mod='baexportproduct'}{$Language[$key]['name']|escape:'htmlall':'UTF-8'}
                    </li>
				{/foreach}

                    <li Name_Gerenal="{l s='Wholesale price' mod='baexportproduct'}-wholesale_price">
                        {l s='Wholesale price' mod='baexportproduct'}
                    </li>
                    <li Name_Gerenal="{l s='Retail price' mod='baexportproduct'}-price">
                        {l s='Retail price' mod='baexportproduct'}
                    </li>
					
					<li Name_Gerenal="{l s='Price include Tax' mod='baexportproduct'}-price_incl">
                        {l s='Price include Tax' mod='baexportproduct'}
                    </li>
					<li Name_Gerenal="{l s='Tax ID' mod='baexportproduct'}-tax_id">
                        {l s='ID Tax' mod='baexportproduct'}
                    </li>
					
					<li Name_Gerenal="{l s='Tax Rate (%)' mod='baexportproduct'}-tax_rate">
                        {l s='Tax Rate (%)' mod='baexportproduct'}
                    </li>
					
                    <li Name_Gerenal="{l s='Unit Number' mod='baexportproduct'}-unity">
                        {l s='Unit Number' mod='baexportproduct'}
                    </li>
                    <li Name_Gerenal="{l s='Unit Price Ratio (tax excl.)' mod='baexportproduct'}-unit_price_ratio">
                        {l s='Unit Price Ratio (tax excl.)' mod='baexportproduct'}
                    </li>
					
					
				{foreach from=$Language key=key item=i}
                    <li Name_Gerenal="{l s='Meta title ' mod='baexportproduct'}{$Language[$key]['name']|escape:'htmlall':'UTF-8'}-meta_title {$Language[$key]['name']|escape:'htmlall':'UTF-8'}">
                        {l s='Meta title ' mod='baexportproduct'}{$Language[$key]['name']|escape:'htmlall':'UTF-8'}
                    </li>
				{/foreach}
				{foreach from=$Language key=key item=i}
					<li Name_Gerenal="{l s='Meta description ' mod='baexportproduct'}{$Language[$key]['name']|escape:'htmlall':'UTF-8'}-meta_description {$Language[$key]['name']|escape:'htmlall':'UTF-8'}">
                        {l s='Meta description ' mod='baexportproduct'}{$Language[$key]['name']|escape:'htmlall':'UTF-8'}
                    </li>
				{/foreach}
				
				{foreach from=$Language key=key item=i}
                    <li Name_Gerenal="{l s='Default Category Name ' mod='baexportproduct'}{$Language[$key]['name']|escape:'htmlall':'UTF-8'}-category_{$Language[$key]['id_lang']|escape:'htmlall':'UTF-8'}">
                        {l s='Default Category Name' mod='baexportproduct'} {$Language[$key]['name']|escape:'htmlall':'UTF-8'}
                    </li>
				{/foreach}
					<li Name_Gerenal="{l s='Default Category ID' mod='baexportproduct'}-category_id">
                        {l s='Default Category ID' mod='baexportproduct'}
                    </li>
				{foreach from=$Language key=key item=i}
					<li Name_Gerenal="{l s='Associated Categories Name ' mod='baexportproduct'}{$Language[$key]['name']|escape:'htmlall':'UTF-8'}-accessories_categories_{$Language[$key]['id_lang']|escape:'htmlall':'UTF-8'}">
                        {l s='Associated Categories Name' mod='baexportproduct'} {$Language[$key]['name']|escape:'htmlall':'UTF-8'}
                    </li>
				{/foreach}
					
					<li Name_Gerenal="{l s='Associated Categories IDs' mod='baexportproduct'}-accessories_categories_ids">
                        {l s='Associated Categories IDs' mod='baexportproduct'}
                    </li>
					
				{foreach from=$Language key=key item=i}
                    <li Name_Gerenal="{l s='Accessories Name ' mod='baexportproduct'}{$Language[$key]['name']|escape:'htmlall':'UTF-8'}-accessories_{$Language[$key]['id_lang']|escape:'htmlall':'UTF-8'}">
                        {l s='Accessories Name' mod='baexportproduct'} {$Language[$key]['name']|escape:'htmlall':'UTF-8'}
                    </li>
				{/foreach}	
					<li Name_Gerenal="{l s='Accessories IDs' mod='baexportproduct'}-accessories_id">
                        {l s='Accessories IDs' mod='baexportproduct'}
                    </li>
					<li Name_Gerenal="{l s='Accessories Reference' mod='baexportproduct'}-accessories_reference">
                        {l s='Accessories Reference' mod='baexportproduct'}
                    </li>
					
                    <li Name_Gerenal="{l s='Friendly URL' mod='baexportproduct'}-link_rewrite">
                        {l s='Friendly URL' mod='baexportproduct'}
                    </li>
                    <li Name_Gerenal="{l s='Quantity Product' mod='baexportproduct'}-quantity">
                        {l s='Quantity Product' mod='baexportproduct'}
                    </li>
                    <li Name_Gerenal="{l s='Product width' mod='baexportproduct'}-width">
                        {l s='Product width' mod='baexportproduct'}
                    </li>
                    <li Name_Gerenal="{l s='Product height' mod='baexportproduct'}-height">
                        {l s='Product height' mod='baexportproduct'}
                    </li>
                    <li Name_Gerenal="{l s='Product depth' mod='baexportproduct'}-depth">
                        {l s='Product depth' mod='baexportproduct'}
                    </li>
                    <li Name_Gerenal="{l s='Product weight' mod='baexportproduct'}-weight">
                        {l s='Product weight' mod='baexportproduct'}
                    </li>
                    <li Name_Gerenal="{l s='Additional shipping fees' mod='baexportproduct'}-additional_shipping_cost">
                        {l s='Additional shipping fees' mod='baexportproduct'}
                    </li>
                    <li Name_Gerenal="{l s='Condition' mod='baexportproduct'}-condition">
                        {l s='Condition' mod='baexportproduct'}
                    </li>
                    <li Name_Gerenal="{l s='Customization File fields' mod='baexportproduct'}-uploadable_files">
                        {l s='Customization File fields' mod='baexportproduct'}
                    </li>
                    <li Name_Gerenal="{l s='Customization Text fields' mod='baexportproduct'}-text_fields">
                        {l s='Customization Text fields' mod='baexportproduct'}
                    </li>
                    <li Name_Gerenal="{l s='Enabled' mod='baexportproduct'}-active">
                        {l s='Enabled' mod='baexportproduct'}
                    </li>
					<li Name_Gerenal="{l s='Tags' mod='baexportproduct'}-tag">
                        {l s='Tags' mod='baexportproduct'}
                    </li>
					<li Name_Gerenal="{l s='Link Image' mod='baexportproduct'}-image_link">
                        {l s='Link Image' mod='baexportproduct'}
                    </li>

                    <li Name_Gerenal="{l s='Combination Attribute value pair' mod='baexportproduct'}-combination_Attribute_value_pair">
                        {l s='Combination Attribute value pair' mod='baexportproduct'}
                    </li>
					{foreach $getNameAttributeGr key=k item=i}
						<li Name_Gerenal="{l s='Combination Attribute ' mod='baexportproduct'}{$getNameAttributeGr[$k]['name']|escape:'htmlall':'UTF-8'}-combination_Attribute_{$getNameAttributeGr[$k]['name']|escape:'htmlall':'UTF-8'}">
							{l s='Combination Attribute ' mod='baexportproduct'}{$getNameAttributeGr[$k]['name']|escape:'htmlall':'UTF-8'}
						</li>
					{/foreach}
					
                    <li Name_Gerenal="{l s='Combination wholesale price' mod='baexportproduct'}-Combination_wholesale_price">
                        {l s='Combination wholesale price' mod='baexportproduct'}
                    </li>

                    <li Name_Gerenal="{l s='Combination Product Weight' mod='baexportproduct'}-combination_weight">
                        {l s='Combination Product Weight' mod='baexportproduct'}
                    </li>
                    <li Name_Gerenal="{l s='Combination unit impact' mod='baexportproduct'}-combination_unit_impact">
                        {l s='Combination unit impact' mod='baexportproduct'}
                    </li>
                    <li Name_Gerenal="{l s='Combination Product Reference' mod='baexportproduct'}-combination_reference">
                        {l s='Combination Product Reference' mod='baexportproduct'}
                    </li>
                    <li Name_Gerenal="{l s='Combination Product EAN13' mod='baexportproduct'}-combination_ean13">
                        {l s='Combination Product EAN13' mod='baexportproduct'}
                    </li>
                    <li Name_Gerenal="{l s='Combination UPC' mod='baexportproduct'}-combination_upc">
                        {l s='Combination UPC' mod='baexportproduct'}
                    </li>
                    <li Name_Gerenal="{l s='Combination Date update' mod='baexportproduct'}-combination_available_date">
                        {l s='Combination Date update' mod='baexportproduct'}
                    </li>
                    <li Name_Gerenal="{l s='Combination Default' mod='baexportproduct'}-combination_default_on">
                        {l s='Combination Default' mod='baexportproduct'}
                    </li>
					<li Name_Gerenal="{l s='Combination Product Image' mod='baexportproduct'}-combination_Image">
                        {l s='Combination Product Image' mod='baexportproduct'}
                    </li>
                    {foreach from=$Features key=k12 item=i}
                        <li Name_Gerenal="{l s='Features ' mod='baexportproduct'}{$Features[$k12]|escape:'htmlall':'UTF-8'}-features_{$Features[$k12]|escape:'htmlall':'UTF-8'}">
                            {l s='Features ' mod='baexportproduct'}{$Features[$k12]|escape:'htmlall':'UTF-8'}
                        </li>
                    {/foreach}
					
					
                </ul>
            </div>
            <div id="btnclick" class="navigation-fields navigation-fields-base col-lg-2" style="margin-top:100px;    margin-left: 10px;">
                <button type="button" class="btn btn-default add_all_product add_fild_right"> {l s='' mod='baexportproduct'}Add all <i class="icon-arrow-right"></i></button>
                <button type="button" class="btn btn-default add_product add_fild_right">{l s='' mod='baexportproduct'} Add <i class="icon-arrow-right"></i></button>
                <button type="button" class="btn btn-default remove_product add_fild_right"> {l s='' mod='baexportproduct'}Remove <i class="icon-arrow-left"></i></button>
                <button type="button" class="btn btn-default remove_product_all add_fild_right">{l s='' mod='baexportproduct'}Clear  <i class="icon-arrow-left"></i></button>
                <input id="hide" type="text" name="display" value="{foreach from=$settingtpl['select_feild'] key=key2 item = item2}{$item2|escape:'htmlall':'UTF-8'}{/foreach}" />
            </div>
            <div class="col-lg-4" id="rightpanel2">
                <div class="header_General">
                    <label id="lbselecpro">{l s='' mod='baexportproduct'}Selected Product</label>
                </div>
                <ul class="block_product_right" id="Rightlist">
				{foreach from=$settingtpl['name_gerenal'] key=key item=i}
                        <li Name_Gerenal="{$settingtpl['name_gerenal'][$key]|escape:'htmlall':'UTF-8'}">
                             <input class="selected_fields_textfield" type="text" value="{$settingtpl['name_product'][$key]|escape:'htmlall':'UTF-8'}" onblur="exproduct_updateDatafromTextfield(this)" />
							 <i class="icon-arrows icon-arrows-select-fields" style="margin-left:3px;"></i>
                        </li>
				{/foreach}
                </ul>
            </div>
        </div>
</div>



<div class="panel col-lg-12" id="panel3">
        <a href="#">
            <div class="panel-heading" id="icon3">
                <i class="fa fa-cogs" aria-hidden="true"></i>{l s=' Setting' mod='baexportproduct'}
				<i style="float:right;margin-top:10px;margin-right:15px;" class="fa fa-minus-circle classicon" id="fontawe3" aria-hidden="true"></i>
            </div>
        </a>
    <div id="hidesetting">
	
	<div class="form-group">
		<label class="control-label col-lg-5">
			 {l s='Export Combination' mod='baexportproduct'}
		</label>
			
		<div class="col-lg-4" >
				<span class="switch prestashop-switch fixed-width-lg" name="SWCombina" style="margin-left: 10px;">
                <input type="radio" name="Combination" checked id="Combi_on" value="1" class="combinationex">
                <label class="combinationex" for="Combi_on">{l s='Yes' mod='baexportproduct'} </label>
                <input class="combinationex" type="radio" name="Combination" id="Combi_off" value="0" >
                <label class="combinationex" for="Combi_off">{l s='No' mod='baexportproduct'} </label>
                <a class="slide-button btn"></a>
            </span>
		</div>
	</div>
			
			
    <div class="form-group" id="combihide">
		<label class="control-label col-lg-5">
			 {l s='Each Combination in a separate line' mod='baexportproduct'}
		</label>

        <div class="col-lg-4 ">
            <span class="switch prestashop-switch fixed-width-lg" name="switch" style="margin-left: 10px;">
                <input class="combinationex" type="radio" name="separate" id="separate_on" value="1" {if $settingtpl['combination_line'] == 1}checked{/if}{if $settingtpl['combination_line'] == ""}checked{/if}>
                <label class="combinationex" for="separate_on">{l s='Yes' mod='baexportproduct'} </label>
                <input class="combinationex" type="radio" name="separate" id="separate_off" value="0" {if $settingtpl['combination_line'] == 0}checked{/if}>
                <label class="combinationex" for="separate_off">{l s='No' mod='baexportproduct'} </label>
                <a class="slide-button btn"></a>
            </span>
        </div>
	</div>
	
	
        <div class="form-group">
			<label class="control-label col-lg-5">
				 {l s='Select file format:' mod='baexportproduct'}
			</label>
           
            <div class="col-lg-4 ">
                <div class="radio format_file" style="margin-left:10px;padding-left: 0px;">
                    <input id="rdcsv" style="margin-left:0px;" type="radio" name="format_file" id="format_csv" value="csv" {if $settingtpl['format_file'] == "csv"}checked{/if}{if $settingtpl['format_file'] == ""}checked{/if}>
					<span id="lbcsv"> {l s='' mod='baexportproduct'}CSV(Comma delimited)(*.csv)</span>
                </div>
                <div class="radio format_file" style="margin-left:10px;padding-left: 0px;">
                    <input id="rdxls"  style="margin-left:0px;" type="radio" name="format_file" id="format_xls" value="xls" {if $settingtpl['format_file'] == "xls"}checked{/if}>
					<span id="lbxls">{l s='' mod='baexportproduct'}Excel 97-2003 Workbook(*.xls)</span>
                </div>
				<div class="radio format_file" style="margin-left:10px;padding-left: 0px;">
                    <input id="rdxlsx"  style="margin-left:0px;" type="radio" name="format_file" id="format_xlsx" value="xlsx" {if $settingtpl['format_file'] == "xlsx"}checked{/if}>
					<span id="lbxls">{l s='' mod='baexportproduct'}Excel Workbook(*.xlsx)</span>
                </div> 				
            </div>
        </div>
		<div class="form-group">
			<label class="control-label col-lg-5" >
				{l s='Encoding' mod='baexportproduct'}
			</label>
			<div>    
				<select name="encoding" class="col-lg-5" style="margin-left:14px;width:170px;">
					<option value="utf8" {if $settingtpl['encoding'] == 'utf8'}selected{/if}>{l s='UTF-8' mod='baexportproduct'}</option>
					<option value="ansi" {if $settingtpl['encoding'] == 'ansi'}selected{/if}>{l s='ANSI' mod='baexportproduct'}</option>
				</select>							
			</div>
		</div>
        <div class="form-group">
			<label class="control-label col-lg-5" >
				 {l s='CSV Delimiter' mod='baexportproduct'}
			</label>
            
            <div class="col-lg-2">    
				<input type="text" name="Delimiter" value="{$settingtpl['character']|escape:'htmlall':'UTF-8'}" id="inputdelimiter" style="margin-left: 10px;">
			</div>
        </div>
		
			
	<div class="form-group">
			<label class="control-label col-lg-5" >
				 {l s='Currencies' mod='baexportproduct'}
			</label>
			
			<select id="opcurrency" name="nameCurr" class="col-lg-5" style="margin-left:14px;width:170px;">
				{foreach from=$Cur key=k item=i}
					<option value="{$k|escape:'htmlall':'UTF-8'}" {if $k|escape:'htmlall':'UTF-8' == $settingtpl['id_currency']|escape:'htmlall':'UTF-8'}selected{/if}>{$Cur[$k]['name']|escape:'htmlall':'UTF-8'}</option>
				{/foreach}
			</select>
		</div>
		
        <div class="form-group">
			<label class="control-label col-lg-5" >
				 {l s='Sort By' mod='baexportproduct'}
			</label>
            
            <select id="opsort" name="namesort" class="col-lg-5" style="margin-left:14px;width:170px;" class="floatnone">
                <option value="id_product" {if $settingtpl['namesort'] == id_product}selected{/if}>{l s='Product ID' mod='baexportproduct'}</option>
                <option value="name" {if $settingtpl['namesort'] == name}selected{/if}>{l s='Product Name' mod='baexportproduct'}</option>
                <option value="id_supplier" {if $settingtpl['namesort'] == id_supplier}selected{/if}>{l s='Supplier ID' mod='baexportproduct'}</option>
                <option value="id_manufacturer ID" {if $settingtpl['namesort'] == id_manufacturer}selected{/if}>{l s='Manufacturer ID' mod='baexportproduct'}</option>
                <option value="manufacturer_name" {if $settingtpl['namesort'] == manufacturer_name}selected{/if}>{l s='Manufacturer Name' mod='baexportproduct'}</option>
                <option value="reference" {if $settingtpl['namesort'] == reference}selected{/if}>{l s='Product Reference Code' mod='baexportproduct'}</option>
                <option value="ean13" {if $settingtpl['namesort'] == ean13}selected{/if}>{l s='Product EAN-13' mod='baexportproduct'}</option>
                <option value="upc" {if $settingtpl['namesort'] == upc}selected{/if}>{l s='UPC barcode' mod='baexportproduct'}</option>
                <option value="wholesale_price" {if $settingtpl['namesort'] == wholesale_price}selected{/if}>{l s='Wholesale price' mod='baexportproduct'}</option>
				<option value="price" {if $settingtpl['namesort'] == price}selected{/if}>{l s='Retail price' mod='baexportproduct'}</option>
                <option value="quantity" {if $settingtpl['namesort'] == quantity}selected{/if}>{l s='Quantity Product' mod='baexportproduct'}</option>
                <option value="width" {if $settingtpl['namesort'] == width}selected{/if}>{l s='Product width' mod='baexportproduct'}</option>
                <option value="height" {if $settingtpl['namesort'] == height}selected{/if}>{l s='Product height' mod='baexportproduct'}</option>
                <option value="depth" {if $settingtpl['namesort'] == depth}selected{/if}>{l s='Product depth' mod='baexportproduct'}</option>
                <option value="weight" {if $settingtpl['namesort'] == weight}selected{/if}>{l s='Product weight' mod='baexportproduct'}</option>
            </select>
            <label id="lbasc" style="margin-left:5px;" class="floatnone">
                {l s='ASC' mod='baexportproduct'}
            </label><input type="radio" name="SortBy" id="SortByASC" value="ASC" style="margin-left:5px;" {if $settingtpl['SortBy'] == "ASC"}checked{/if}{if $settingtpl['SortBy'] == ""}checked{/if}>
            <label id="lbdesc" style="margin-left:5px;" class="floatnone">
                {l s='DESC' mod='baexportproduct'}
            </label><input type="radio" name="SortBy" id="SortByDESC" value="DESC" style="margin-left:5px;" {if $settingtpl['SortBy'] == "DESC"}checked{/if}>
        </div>
		
		
                <div class="form-group">
			<label class="control-label col-lg-5" >
				 {l s='Number to Export' mod='baexportproduct'}
			</label>
					
					<div class="col-lg-2" id="divallran"     style="margin-left: 10px;">
					<label class="size floatnone" class="control-label" >{l s='All' mod='baexportproduct'}</label>
					<input id="rdAll" class="floatnone" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onpaste="return false;"  type="radio" name="ranger" id="rangerAll" value="0" style="margin-left:5px;" {if $settingtpl['ranger'] == 0}checked{/if}{if $settingtpl['ranger'] == "false"}checked{/if}>
					<label class="size floatnone" class="control-label" style="margin-left:30px;">{l s='Ranger' mod='baexportproduct'}</label>
					<input id="rdranger" class="floatnone" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onpaste="return false;"  type="radio" name="ranger" id="RangerPick" value="1" style="margin-left:5px;"{if $settingtpl['ranger'] == 1}checked{/if}>
					</div>
					<div id = "numberP" {if $settingtpl['ranger'] == 0}style="display:none"{else}style="display:block"{/if}>
					<span style="float:left;padding-top:5px;"> From Product</span>		
					<div class="col-lg-1"><input id="frpr" class="col-lg-1" type="text" name="TextFromranger" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{$settingtpl['frRanger']|escape:'htmlall':'UTF-8'}" style="margin-left:5px;"></div>
					<span style="float:left;padding-left:3px;padding-top:5px;">To</span>				
					<div class="col-lg-1"><input id="topr" class="col-lg-1" type="text" name="TextToranger" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{$settingtpl['toRanger']|escape:'htmlall':'UTF-8'}" style="margin-left:5px;"></div>
					</div>
	
	</div>
    </div>
	<div class="panel-footer">
		<div class="col-lg-10" id="khoangcach"></div>
		
		<button  type="submit" name="onlySaveSetting" class="btn btn-default pull-right"><i class="process-icon-save"></i> Save</button>
		<button id="btnsaveandsb" type="submit" name="export" class="btn btn-default pull-right"><i class="process-icon-save"></i> Save & Export</button>
	</div>	

</div>

		

	
	</div>




</form>