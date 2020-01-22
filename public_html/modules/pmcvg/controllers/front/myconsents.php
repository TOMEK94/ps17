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

class pmcvgmyconsentsModuleFrontController extends ModuleFrontController
{
    public $auth = true;
    public $ssl = true;
    public function __construct()
    {
        if (Tools::isSubmit('ajax')) {
            $this->auth = false;
        }
        parent::__construct();
        $this->display_column_left = false;
        $this->context = Context::getContext();
    }

    public function initContent()
    {
        if (Tools::isSubmit('ajax')) {
            $id_customer = (int)Context::getContext()->customer->id;
            $cvg = Tools::getValue('cvg');
            if ($cvg == 'newsetter') {
            } elseif ($cvg == 'optin') {
            } else {
                $cvg = (int)$cvg;
            }
            if ((int)$cvg) {
                $cvg = CustomerAgreementModel::getByCustomer($id_customer, $cvg);
                $cvg->set = !(int)$cvg->set;
                if (Tools::isSubmit('value_set')) {
                    $cvg->set = (int)Tools::getValue('value_set');
                }
                $cvgh = new CustomerAgreementHistoryModel();
                $cvgh->id_customer = $cvg->id_customer;
                $cvgh->set = $cvg->set;
                $cvgh->id_pmcvg = $cvg->id_pmcvg;
                $cvgh->ip = $cvg->ip;
                $cvgh->save();
                if ($cvg->save()) {
                    die(
                        Tools::jsonEncode(
                            array(
                                'error' => false,
                                'status' => $cvg->set,
                                'date_upd' => $cvg->date_upd,
                            )
                        )
                    );
                }
            } elseif ($cvg == 'newsletter') {
                $c = new Customer(Context::getContext()->customer->id);
                $c->newsletter = (int)!$c->newsletter;
                $c->newsletter_date_add = date('Y-m-d H:i:s');
                $c->update();
                $cvgh = new CustomerAgreementHistoryModel();

                $cvgh->id_customer = $c->id;
                $cvgh->set = $c->newsletter;
                $cvgh->id_pmcvg = -1;
                $cvgh->ip = pSQL(Tools::getRemoteAddr());
                $cvgh->save();

                die(
                    Tools::jsonEncode(
                        array(
                            'error' => false,
                            'status' => $c->newsletter,
                            'date_upd' => $c->newsletter_date_add,
                        )
                    )
                );
            } elseif ($cvg == 'optin') {
                $c = new Customer(Context::getContext()->customer->id);
                $c->optin = (int)!$c->optin;
                $c->newsletter_date_add = date('Y-m-d H:i:s');
                $c->update();
                $cvgh = new CustomerAgreementHistoryModel();
                $cvgh->id_customer = $c->id;
                $cvgh->set = $c->optin;
                $cvgh->id_pmcvg = -2;
                $cvgh->ip = pSQL(Tools::getRemoteAddr());
                $cvgh->save();
                die(
                    Tools::jsonEncode(
                        array(
                            'error' => false,
                            'status' => $c->optin,
                            'date_upd' => $c->newsletter_date_add,
                        )
                    )
                );
            }
        } else {
            Media::addJsDef(
                array(
                    'button_enable_lang' => $this->module->langtrans('Deactivate consent'),
                    'button_disable_lang ' => $this->module->langtrans('Accept consent'),
                )
            );
            
            $values = $this->module->generateFormValues();
            $sql = 'SELECT newsletter,optin,newsletter_date_add FROM `'._DB_PREFIX_.'customer` WHERE id_customer = '.(int)Context::getContext()->customer->id;
            $customer_opt = Db::getInstance()->getRow($sql);
            $this->context->smarty->assign(
                array(
                    'form_show' => $values,
                    'id_lang' => Context::getContext()->language->id,
                    'customer_opt' => $customer_opt,
                    'consents' => $this->module->getCustomerConsents()
                )
            );
            $this->setTemplate('module:pmcvg/views/templates/front/myconsents.tpl');
            parent::initContent();
        }
    }
}
