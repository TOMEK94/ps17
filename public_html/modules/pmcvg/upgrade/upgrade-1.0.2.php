<?php
/**
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
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2017 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * This function updates your module from previous versions to the version 1.1,
 * usefull when you modify your database, or register a new hook ...
 * Don't forget to create one file per version.
 */

function installModuleTab($tabClass, $tabName, $idTabParent)
{
    $tab = new Tab();
    $tab->name = $tabName;
    $tab->class_name = $tabClass;
    $tab->module = 'pmcvg';
    $tab->id_parent = $idTabParent;

    if (!$tab->save()) {
        return false;
    }

    return $tab->id;
}

function upgrade_module_1_0_2($module)
{
    $sql = array();
    try {
        $sql[] = 'ALTER TABLE `'._DB_PREFIX_.'pmcvg_customer_agreement` ADD COLUMN ip CHAR(255)';
        foreach ($sql as $query) {
            if (@Db::getInstance()->execute($query) == false) {
                // return false;
            }
        }
    } catch (Exception $exp) {
    }
    $sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'pmcvg_customer_agreement_history`
    (
        `id_pmcvg_customer_agreement_history` int(11) PRIMARY KEY AUTO_INCREMENT,
        `id_customer` int(11),
        `date_upd` datetime, 
        `id_pmcvg` int(11),
        `ip` char(255),
        `set` int(2)
    );';

    foreach ($sql as $query) {
        if (Db::getInstance()->execute($query) == false) {
            return false;
        }
    }
    $idTab = Db::getInstance()->getValue('SELECT id_tab FROM `'._DB_PREFIX_.'tab` WHERE class_name = "AdminConditions"');
    $tabs = array(
        'AdminHistory' => array(
                'en' => 'History of chage',
                'pl' => 'Zmiany'
        ),
    );
    
    $deflang = (int)Configuration::get('PS_LANG_DEFAULT');

    foreach ($tabs as $class => $tab) {
        $tabNamesArray = array();
        foreach ($tab as $tabIso => $tabName) {
            foreach (Language::getLanguages() as $language) {
                if ($language['iso_code'] == $tabIso) {
                    $tabNamesArray[$language['id_lang']] = $tabName;
                }
            }
        }
        if (!key_exists($deflang, $tabNamesArray)) {
            $tabNamesArray[$deflang] = $tab['en'];
        }
        installModuleTab($class, $tabNamesArray, $idTab);
    }
    return true;
}
