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
class pmcvgexportModuleFrontController extends ModuleFrontController
{

    public function __construct()
    {
        parent::__construct();
        $this->display_column_left = false;
        $this->context = Context::getContext();
    }

    public function initContent()
    {
        $values = $this->module->generateFormValues();
        $this->context->smarty->assign('form_show', $values);
        $this->context->smarty->assign('id_lang', Context::getContext()->language->id);
        $this->setTemplate('module:pmcvg/views/templates/front/export.tpl');
        $this->addCSS(_MODULE_DIR_.'/pmcvg/views/css/front.css');
        parent::initContent();
    }

    public function postProcess()
    {
        if (Tools::isSubmit('format')) {
            $this->module->export(Context::getContext()->customer->id, Tools::getValue('format'));
            if (Tools::getValue('format') == 'json') {
                $sql = 'SELECT id_customer, id_gender,company, firstname,lastname, email, birthday, newsletter, newsletter_date_add,website, date_add, date_upd, ip_registration_newsletter FROM `'._DB_PREFIX_.'customer` WHERE id_customer = '.(int)Context::getContext()->customer->id;
                $customer = Db::getInstance()->getRow($sql);

                $sql = '
				SELECT company, firstname, lastname, address1, address2, postcode, city, other, phone, phone_mobile, vat_number,dni, date_add, date_upd,l.name as country FROM `'._DB_PREFIX_.'address` a JOIN `'._DB_PREFIX_.'country_lang` l ON l.id_country = a.id_country AND l.id_lang = '.(int)Context::getContext()->language->id.' WHERE id_customer = '.(int)Context::getContext()->customer->id;
                $addresses = Db::getInstance()->executeS($sql);

                $json = array();
                $json['customer'] = $customer;
                $json['address'] = $addresses;

                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename=' . 'data.json');
                header('Content-Transfer-Encoding: binary');
                header('Connection: Keep-Alive');
                header('Expires: 0');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Pragma: public');
                header('Content-Length: ' . strlen(Tools::jsonEncode($json)));
                echo Tools::jsonEncode($json);
                $l = new LogModel();
                $l->id_customer = (int)Context::getContext()->customer->id;
                $log = $this->module->langtrans('Export customer data: ').'JSON';
                $l->log = $log;
                $l->add();
                die();
            } elseif (Tools::getValue('format') == 'xml') {
                $sql = 'SELECT id_customer, id_gender,company, firstname,lastname, email, birthday, newsletter, newsletter_date_add,website, date_add, date_upd, ip_registration_newsletter FROM `'._DB_PREFIX_.'customer` WHERE id_customer = '.(int)Context::getContext()->customer->id;
                $customer = Db::getInstance()->getRow($sql);

                $sql = '
				SELECT company, firstname, lastname, address1, address2, postcode, city, other, phone, phone_mobile, vat_number,dni, date_add, date_upd,l.name as country FROM `'._DB_PREFIX_.'address` a JOIN `'._DB_PREFIX_.'country_lang` l ON l.id_country = a.id_country AND l.id_lang = '.(int)Context::getContext()->language->id.' WHERE id_customer = '.(int)Context::getContext()->customer->id;
                $addresses = Db::getInstance()->executeS($sql);

                $json = array();
                $json['customer'] = $customer;
                $json['address'] = $addresses;
                $xml_data = new SimpleXMLElement('<?xml version="1.0"?><data></data>');
                $this->arrayToXml($json, $xml_data);
                header("Content-type: text/xml");
                header('Content-Transfer-Encoding: binary');
                $l = new LogModel();
                $l->id_customer = (int)Context::getContext()->customer->id;
                $log = ($this->module->langtrans('Export customer data: ').'XML');
                $l->log = $log;
                $l->add();
                die($xml_data->asXml());
            }
            if (Tools::getValue('format') == 'csv') {
                $sql = 'SELECT c.id_customer, c.id_gender, c.company, c.firstname, c.lastname, c.email, c.birthday, c.newsletter, c.newsletter_date_add, c.website, c.date_add, c.date_upd, c.ip_registration_newsletter,  a.company, a.firstname, a.lastname, a.address1, a.address2, a.postcode, a.city, a.other, a.phone, a.phone_mobile, a.vat_number,dni, a.date_add, a.date_upd,l.name as country FROM `'._DB_PREFIX_.'customer` c JOIN `'._DB_PREFIX_.'address` a ON a.id_customer = c.id_customer 
				JOIN `'._DB_PREFIX_.'country_lang` l ON l.id_country = a.id_country AND l.id_lang = '.(int)Context::getContext()->language->id .'
				WHERE  c.id_customer = '.(int)Context::getContext()->customer->id;
                $csv = Db::getInstance()->executeS($sql);
                if (sizeof($csv)) {
                    header("Content-Type: text/csv");
                    header("Content-Disposition: attachment; filename=data.csv");
                    $out = fopen('php://output', 'w');
                    fputcsv($out, array_keys($csv[0]));
                    foreach ($csv as $item) {
                        fputcsv($out, $item);
                    }
                    fclose($out);
                    $l = new LogModel();
                    $l->id_customer = (int)Context::getContext()->customer->id;
                    $log = $this->module->langtrans('Export customer data: ').'CSV';
                    $l->log = $log;
                    $l->add();
                    die();
                }
            }
        }
    }

    private function arrayToXml($data, &$xml_data)
    {
        foreach ($data as $key => $value) {
            if (is_numeric($key)) {
                $key = 'item_'.$key;
            }
            if (is_array($value)) {
                $subnode = $xml_data->addChild($key);
                $this->arrayToXml($value, $subnode);
            } else {
                $xml_data->addChild($key, htmlspecialchars("$value"));
            }
        }
    }
}
