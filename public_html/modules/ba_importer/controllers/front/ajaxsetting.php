<?php
/**
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
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 *   @author    Buy-addons <contact@buy-addons.com>
 *   @copyright 2007-2015 PrestaShop SA
 *   @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *   International Registered Trademark & Property of PrestaShop SA
 */

class ba_importerAjaxSettingModuleFrontController extends ModuleFrontController
{

    /**
     * @see FrontController::postProcess()
     */
    public function run()
    {
        $id_shop = $this->context->shop->id;
        // $id_shop_group = $this->context->shop->id_shop_group;
        $settingchoose = Tools::getValue('value_setting');
        $db = Db::getInstance(_PS_USE_SQL_SLAVE_);
        if ($settingchoose != 'other') {
            $select_import_settings = 'SELECT * FROM ' . _DB_PREFIX_ . 'ba_importer_config ';
            $select_import_settings .= 'WHERE id_importer_config=' . $settingchoose . ' AND id_shop=' . $id_shop;
            $select_is = $db->ExecuteS($select_import_settings);
            Configuration::updateValue('CONFIGN_IMPORTER_BC1', $select_is[0]['ba_step1'], false, '', $id_shop);
            Configuration::updateValue('CONFIG_SELECT_IMPORTER', $select_is[0]['ba_step2'], false, '', $id_shop);
            Configuration::updateValue('CONFIGN_CRONJOB', $select_is[0]['ba_step3'], false, '', $id_shop);
        }
    }
}
