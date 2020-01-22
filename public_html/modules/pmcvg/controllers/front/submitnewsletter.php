<?php

/*
* 2007-2016 PrestaShop
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
*  @copyright  2007-2016 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/
class pmcvgsubmitnewsletterModuleFrontController extends ModuleFrontController
{
    public $ssl = true;
    
    const GUEST_NOT_REGISTERED = -1;
    const CUSTOMER_NOT_REGISTERED = 0;
    const GUEST_REGISTERED = 1;
    const CUSTOMER_REGISTERED = 2;

    public function __construct()
    {
        parent::__construct();
        $this->display_column_left = false;
        $this->context = Context::getContext();
    }

    public function initContent()
    {
        $this->addCSS(_MODULE_DIR_.'/pmcvg/views/css/front.css');
        $this->addJS(_MODULE_DIR_.'/pmcvg/views/js/front.js');
        $this->addJS(array(
            _PS_JS_DIR_.'validate.js'
        ));
        Context::getContext()->smarty->assign('conditions_form', $this->displayNewsletter());
        $this->setTemplate('module:pmcvg/views/templates/front/submitnewsletter.tpl');
        parent::initContent();
    }

    public function displayNewsletter()
    {
        if (version_compare(_PS_VERSION_, '1.7.0', '<') === true) {
            $sql = 'SELECT * FROM `'._DB_PREFIX_.'pmcvg` cvg 
            JOIN `'._DB_PREFIX_.'pmcvg_lang` l ON l.id_pmcvg = cvg.id_pmcvg ';
            $sql .= 'AND l.id_shop = '.Context::getContext()->shop->id.' AND l.id_lang = '.Context::getContext()->language->id;
            $sql .= ' JOIN `'._DB_PREFIX_.'pmcvg_shop` s ON (s.id_pmcvg = cvg.id_pmcvg AND s.id_shop = '.(int)Context::getContext()->shop->id.') AND page = 4 AND s.active = 1';
            $sql .= ' ORDER BY cvg.id_pmcvg';
            
            $r = Db::getInstance()->executeS($sql);
            $selected = array();
            if (Tools::isSubmit('conditions')) {
                foreach (Tools::getValue('conditions') as $key => $value) {
                    $selected[$key] = 1;
                }
            }
            $this->context->smarty->assign('conditions', $r);
            $this->context->smarty->assign('email', Tools::getValue('email'));
            $this->context->smarty->assign('conditions_name', 'account');
            $this->context->smarty->assign('selected_conditions', $selected);
            $conditions = Context::getContext()->smarty->fetch(dirname(__FILE__).'/../../views/templates/front/conditions.tpl');
            return $conditions;
        }
    }
}
