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

class Address extends AddressCore
{
    public function validateController($htmlentities = true)
    {
        $parent_result = parent::validateController($htmlentities);
        $sql = 'SELECT * FROM `'._DB_PREFIX_.'pmcvg` cvg 
        JOIN `'._DB_PREFIX_.'pmcvg_lang` l ON l.id_pmcvg = cvg.id_pmcvg ';
        $sql .= 'AND l.id_shop = '.Context::getContext()->shop->id;
        $sql .= ' JOIN `'._DB_PREFIX_.'pmcvg_shop` s ON (s.id_pmcvg = cvg.id_pmcvg AND s.id_shop = '.(int)Context::getContext()->shop->id.') AND page = 2 AND s.active = 1 AND s.required = 1';

        $sql .= ' ORDER BY cvg.id_pmcvg';
        $r = Db::getInstance()->executeS($sql);
        $errors = false;

        $post_conditions = Tools::getValue('conditions');
        $module = Module::getInstanceByName('pmcvg');
        if (!is_array($parent_result)) {
            $parent_result = array();
        }
        foreach ($r as $item) {
            if (!isset($post_conditions[$item['id_pmcvg']])) {
                $parent_result[] = $module->langtrans('Required: ').strip_tags($item['text']);
                $errors = true;
            } else {
                $id_customer = (int)Context::getContext()->customer->id;
                if ($id_customer) {
                }
            }
        }
        return $parent_result;
    }
}
