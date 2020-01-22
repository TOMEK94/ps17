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
class pmcvgremoveModuleFrontController extends ModuleFrontController
{
    public $auth = true;
    public $ssl = true;

    public function __construct()
    {
        parent::__construct();
        $this->display_column_left = false;
        $this->context = Context::getContext();
    }

    public function initContent()
    {
        $this->addCSS(_MODULE_DIR_.'/pmcvg/views/css/front.css');
        $this->addJS(_MODULE_DIR_.'/pmcvg/views/js/remove.js');
        Media::addJsDef(array('message_confirm ' => $this->module->langtrans('Are you sure you want to delete your account?')));
        $this->setTemplate('module:pmcvg/views/templates/front/remove.tpl');
        $values = $this->module->generateFormValues();
        $this->context->smarty->assign('form_show', $values);
        $this->context->smarty->assign('id_lang', Context::getContext()->language->id);
        parent::initContent();
    }

    public function postProcess()
    {
        if (Tools::isSubmit('process')) {
            $this->module->addProcess(Context::getContext()->customer->id, 1, Context::getContext()->language->id);
            Tools::redirect(Context::getContext()->link->getModuleLink('pmcvg', 'free'));
        }
    }
}
