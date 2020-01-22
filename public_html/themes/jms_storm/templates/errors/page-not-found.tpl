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
<section id="content" class="page-content page-not-found">
	<span class="icon">
		<i class="fa fa-frown"></i>
	</span>
	<h3>{l s='error 404 not found' d='Shop.Theme'}</h3>
	<p>{l s='We are sorry but the page you are looking for does not exist.' d='Shop.Theme'}</p>
	<p>{l s='You could return to homepage or using search!' d='Shop.Theme'}</p>

    {block name='hook_not_found'}
      {hook h='displayNotFound'}
    {/block}
	</div>
</section>
