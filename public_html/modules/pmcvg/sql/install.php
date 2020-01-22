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

    $sql = array();

    $sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'pmcvg` (
        `id_pmcvg` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `active` int(2) NOT NULL,
        `required` int(2) NOT NULL,
        `page` char(255) not NULL
    );';

    $sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'pmcvg_shop` (
        `id_pmcvg` int(11) ,
        `id_shop` int(11) NOT NULL,
        `active` int(2) NOT NULL,
        `required` int(2) NOT NULL,
        PRIMARY KEY (`id_pmcvg`, `id_shop`)
    );';

    $sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'pmcvg_lang` (
        `id_pmcvg` int(11),
        `id_shop` int(11), 
        `id_lang` int(11),
        `text` longtext CHARACTER SET utf8 COLLATE utf8_general_ci
    );';

    $sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'pmcvg_customer_agreement`
    (
        `id_pmcvg_customer_agreement` int(11) PRIMARY KEY AUTO_INCREMENT,
        `id_customer` int(11),
        `date_add` datetime,
        `date_upd` datetime, 
        `id_pmcvg` int(11),
        `ip` char(255),
        `set` int(2)
    );';

    $sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'pmcvg_customer_agreement_history`
    (
        `id_pmcvg_customer_agreement_history` int(11) PRIMARY KEY AUTO_INCREMENT,
        `id_customer` int(11),
        `date_upd` datetime, 
        `id_pmcvg` int(11),
        `ip` char(255),
        `set` int(2)
    );';

    $sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'pmcvg_export`
    (
        `id_pmcvg_export` int(11) PRIMARY KEY AUTO_INCREMENT,
        `id_customer` int(11),
        `date_add` datetime, 
        `log` longtext CHARACTER SET utf8 COLLATE utf8_general_ci
    );';

    $sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'pmcvg_process_log`
    (
        `id_pmcvg_log` int(11) PRIMARY KEY AUTO_INCREMENT,
        `id_customer` int(11),
        `date_add` datetime,
        `id_pmcvg_process` int(11),
        `log` longtext CHARACTER SET utf8 COLLATE utf8_general_ci
    );';

    $sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'pmcvg_process`
    (
        `id_pmcvg_process` int(11) PRIMARY KEY AUTO_INCREMENT,
        `id_customer` int(11),
        `date_add` datetime,
        `type` int(11),
        `status` longtext CHARACTER SET utf8 COLLATE utf8_general_ci
    );';

    foreach ($sql as $query) {
        if (Db::getInstance()->execute($query) == false) {
            return false;
        }
    }
