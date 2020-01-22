{**
 * 2007-2018 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
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
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
<section  id    = "{$identifier}"
          class = "{[
                      'checkout-step'   => true,
                      '-current'        => $step_is_current,
                      '-reachable'      => $step_is_reachable,
                      '-complete'       => $step_is_complete,
                      'js-current-step' => $step_is_current
                  ]|classnames}"
>
	<div class="step-box1">
		 <h1 class="step-title">
			<i class="fa fa-check-circle-o done"></i>
			<span class="step-number">{$position}</span>
			{$title}
			<span class="step-edit text-muted"><i class="fa fa-pencil-square-o edit"></i>{l s='Edit' d='Shop.Theme.Actions'}</span>
		</h1>
		<div class="content">
			{block name='step_content'}DUMMY STEP CONTENT{/block}
		</div>
	</div>
</section>
