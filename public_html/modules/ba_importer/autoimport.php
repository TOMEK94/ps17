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
 * to license@buy-addons.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 *  @author    Buy-addons <contact@buy-addons.com>
 *  @copyright 2007-2013 Buy-addons
 *  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */

header('Content-Type: text/html; charset=ISO-8859-1');
include_once('../../config/config.inc.php');
// if maintaince mode enable
$remote_ip = Tools::getRemoteAddr();
if (!(int)Configuration::get('PS_SHOP_ENABLE')) {
    if (!in_array($remote_ip, explode(',', Configuration::get('PS_MAINTENANCE_IP')))) {
        if (!Configuration::get('PS_MAINTENANCE_IP')) {
            Configuration::updateValue('PS_MAINTENANCE_IP', $remote_ip);
        } else {
            Configuration::updateValue('PS_MAINTENANCE_IP', Configuration::get('PS_MAINTENANCE_IP') . ',' . $remote_ip);
        }
    }
}

include_once('../../init.php');
require_once('./ba_importer.php');
set_time_limit(0);
require_once('./classes/autoimport.php');

$ba_importer = new Ba_importer();
$cookiekey = $ba_importer->cookiekeymodule();
$batoken = Tools::getValue("batoken");

if ($batoken == $cookiekey) {
    $db = Db::getInstance(_PS_USE_SQL_SLAVE_);
    $sl_ba_cronjobs = 'SELECT a.* FROM ' . _DB_PREFIX_ . 'ba_cronjobs_importer a';
    $sl_ba_cronjobs .= ' INNER JOIN ' . _DB_PREFIX_ . 'ba_importer_config b';
    $sl_ba_cronjobs .= ' ON  a.id_importer_config = b.id_importer_config';
    $sl_ba_cronjobs .= ' WHERE b.import_local !=1 AND a.imported = 0 LIMIT 0,1';
    $list_ba_cron = $db->ExecuteS($sl_ba_cronjobs);
    $product_end = Tools::getValue('product_end');
    // var_dump($a); die;

    $autoimport = new AutoImport();

    $autoimport->funcAutoImport($list_ba_cron, $product_end);
} else {
    echo $ba_importer->l("You do not have permission to access it.");
    die;
}
