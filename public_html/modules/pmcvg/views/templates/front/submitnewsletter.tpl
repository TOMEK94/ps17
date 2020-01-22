{**
 * 2007-2017 PrestaShop
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
 * @copyright 2007-2017 PrestaShop SA
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
{extends file='page.tpl'}

{block name='page_header_container'}{/block}

{block name='left_column'}
  <div id="left-column" class="col-xs-12 col-sm-3">
    {widget name="ps_contactinfo" hook='displayLeftColumn'}
  </div>
{/block}

{block name='page_content'}
<div class="privacymanagement">
	<div class="row box">
		<div class="col-md-12">
			<h3>{l s='Newsletter' mod='pmcvg'}</h3>
			<hr />
			<div class="p">
				<form action="{if isset($force_ssl) && $force_ssl}{$base_dir_ssl}{else}{$base_dir}{/if}" method="post">
					<div class="row">
						<div class="col-md-3">
							<div class="form-group required">
								<label for="email">{l s='E-mail' mod='pmcvg'}</label>
								<input type="text" data-validate="isEmail" class="is_required validate form-control email_submit" value="{$email|escape:'htmlall':'UTF-8'}" id="email" name="email" />
							</div>							
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							{$conditions_form}
							<input type="hidden" name="action"  value="0" />
							<input type="hidden" name="addtonewslettercvg"  value="1" />
							<button name="submitNewsletter" type="submit" id="addtonewslettercvg" disabled="disabled" class="btn btn-primary">{l s='Add to newsletter' mod='pmcvg'}</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
{/block}