{*
* 2007-2018 PrestaShop
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
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2018 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{if $addon_title}
<div class="addon-title">
	<h3>{$addon_title|escape:'htmlall':'UTF-8'}</h3>
</div>
{/if}
{if $addon_desc}
<p class="addon-desc">{$addon_desc|escape:'htmlall':'UTF-8'}</p>
{/if}
<div class="contact-info{if $box_class} {$box_class|escape:'htmlall':'UTF-8'}{/if}">
	<ul>
       {if $ci_address != ''}<li class="address">{$ci_address|escape:'html':'UTF-8'}</li>{/if}
       {if $phone != ''}<li class="phone"><span>{l s='Phone: ' d='Shop.Theme'} </span><a href="tel:{$phone|escape:'html':'UTF-8'}">{$phone|escape:'html':'UTF-8'}</a></li>{/if}
	   {if $email != ''}<li class="email"><span>{l s='Email: ' d='Shop.Theme'}</span><a href="mailto:{$email|escape:'html':'UTF-8'}">{$email|escape:'html':'UTF-8'}</a></li>{/if}
	   {if $opentime != ''}<li class="open_time"><span>{l s='Hours: ' d='Shop.Theme'} </span>{$opentime|escape:'html':'UTF-8'}</li>{/if}
    </ul>
</div>
