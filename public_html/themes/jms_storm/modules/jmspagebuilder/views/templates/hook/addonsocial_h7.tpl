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
<div id="social_block">
	<ul class="find-us">
       {if $facebook_url != ''}<li class="divider"><a href="{$facebook_url|escape:'html':'UTF-8'}" class="facebook">Facebook</a></li>{/if}
       {if $twitter_url != ''}<li class="divider"><a href="{$twitter_url|escape:'html':'UTF-8'}" class="twitter">Twitter</a></li>{/if}
       {if $linkedin_url != ''}<li class="divider"><a href="{$linkedin_url|escape:'html':'UTF-8'}" class="linkedin">Linkedin</a></li>{/if}
       {if $youtube_url != ''}<li class="divider"><a href="{$youtube_url|escape:'html':'UTF-8'}" class="youtube">Youtube</a></li>{/if}
       {if $google_plus_url != ''}<li class="divider"><a href="{$google_plus_url|escape:'html':'UTF-8'}" class="gplus">Google-plus</a></li>{/if}
	   {if $pinterest_url != ''}<li class="divider"><a href="{$pinterest_url|escape:'html':'UTF-8'}" class="pinterest">Pinterest</a></li>{/if}            
	   {if $instagram_url != ''}<li class="divider"><a href="{$instagram_url|escape:'html':'UTF-8'}" class="instagram">Instagram</a></li>{/if}
  </ul>
</div>
