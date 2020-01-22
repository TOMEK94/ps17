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
if (!defined('_REMOVE_ACCOUNT_')) {
    define('_REMOVE_ACCOUNT_', 1);
}
if (!defined('_ANONIMIZE_ACCOUNT_')) {
    define('_ANONIMIZE_ACCOUNT_', 2);
}
if (!defined('_USER_ANONIMIZE_REQUEST_')) {
    define('_USER_ANONIMIZE_REQUEST_', 3);
}
if (!defined('_USER_REMOVE_REQUEST_')) {
    define('_USER_REMOVE_REQUEST_', 4);
}
use PrestaShop\PrestaShop\Core\Checkout\TermsAndConditions;
class pmcvg extends Module
{
    protected $config_form = false;
    static $ids_get;
    public function __construct()
    {
        $this->name = 'pmcvg';
        $this->tab = 'administration';
        $this->version = '1.0.7';
        $this->author = 'prestahelp.com & Rafał Zontek';
        $this->need_instance = 0;
        $this->languages = Language::getLanguages(false);
        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;


        $this->displayName = $this->l('GDPR - regulations on data protection RODO');
        $this->description = $this->l('GDPR - regulations on data protection RODO');
        parent::__construct();

        $this->confirmUninstall = $this->l('Are you sure?');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);

        require_once(dirname(__FILE__).'/src/Export.php');
        require_once(dirname(__FILE__).'/src/Log.php');
        require_once(dirname(__FILE__).'/src/Terms.php');
        require_once(dirname(__FILE__).'/src/Process.php');
        require_once(dirname(__FILE__).'/src/CustomerAgrement.php');
        require_once(dirname(__FILE__).'/src/CustomerAgrementHistory.php');

        $this->tabs = array(
                'AdminConditions' => array(
                        'en' => 'Privacy management',
                        'pl' => 'Treść zgód'
                ),
                'AdminNotification' => array(
                        'en' => 'Notification',
                        'pl' => 'Zgłoszenia'
                ),
                'AdminHistory' => array(
                        'en' => 'History of chage',
                        'pl' => 'Zmiany'
                ),
                'AdminRemove' => array(
                        'pl' => 'Usuwanie klientów ręcznie',
                        'en' => 'Manualy remove customer'
                ),

        );
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        Configuration::updateValue('PMCVG_LIVE_MODE', false);

        include(dirname(__FILE__).'/sql/install.php');
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
        return $this->installTab()   &&
            parent::install() &&
            $this->registerHook('header') &&
            $this->registerHook('backOfficeHeader') &&
            $this->registerHook('displayCustomerAccount') &&
            $this->registerHook('actionCustomerAccountAdd') &&
            $this->registerHook('createAccountForm') &&                                 
            $this->registerHook('actionBeforeSubmitAccount') &&
            $this->registerHook('termsAndConditions') &&
            $this->registerHook('actionSubmitAccountBefore') &&
            $this->installConfig();
        $this->getIdDeleted();
    }

    public function uninstall()
    {
        Configuration::deleteByName('PMCVG_LIVE_MODE');
        $this->unregisterHook('termsAndConditions');
        $this->unregisterHook('header');
        $this->unregisterHook('backOfficeHeader');
        $this->unregisterHook('displayCustomerAccount');
        $this->unregisterHook('actionCustomerAccountAdd');
        $this->unregisterHook('createAccountForm');                                 
        $this->unregisterHook('actionBeforeSubmitAccount');
        $this->unregisterHook('termsAndConditions');
        $this->unregisterHook('actionSubmitAccountBefore');
        include(dirname(__FILE__).'/sql/uninstall.php');
        $this->uninstallTab();
        return parent::uninstall();
    }

    private function uninstallModuleTab($tabClass)
    {
        $idTab = Tab::getIdFromClassName($tabClass);
        if ($idTab != 0) {
            $tab = new Tab($idTab);
            $tab->delete();
            return true;
        }
        return false;
    }

    /**
     * Set values for the inputs.
     */
    public function generateFormValues()
    {
        $config = array();
        $l = Language::getLanguages(true);
        for ($i = 1 ; $i <= 8 ; $i++) {
            $config['PMCG_PAGE_'.$i.'_ENABLE'] = (int)Configuration::get('PMCG_PAGE_'.$i.'_ENABLE');
            foreach ($l as $lang) {
                $config['PMCG_PAGE_'.$i.'_TITLE'][$lang['id_lang']] = Configuration::get('PMCG_PAGE_'.$i.'_TITLE', $lang['id_lang']);
                $config['PMCG_PAGE_'.$i.'_BUTTON'][$lang['id_lang']] = Configuration::get('PMCG_PAGE_'.$i.'_BUTTON', $lang['id_lang']);
                $config['PMCG_PAGE_'.$i.'_DESC_1'][$lang['id_lang']] = Configuration::get('PMCG_PAGE_'.$i.'_DESC_1', $lang['id_lang']);
                $config['PMCG_PAGE_'.$i.'_DESC_2'][$lang['id_lang']] = Configuration::get('PMCG_PAGE_'.$i.'_DESC_2', $lang['id_lang']);
                $config['PMCG_PAGE_'.$i.'_DESC_3'][$lang['id_lang']] = Configuration::get('PMCG_PAGE_'.$i.'_DESC_3', $lang['id_lang']);
            }
        }
        return $config;
    }

    /**
     * Save form data.
     */
    protected function postProcess()
    {
        $form_values = $this->generateFormEmailValues();
        foreach (array_keys($form_values) as $key) {
            if (Tools::isSubmit($key)) {
                Configuration::updateValue($key, Tools::getValue($key));
            }
        }

        $form_values = $this->generateFormGlobalValues();
        foreach (array_keys($form_values) as $key) {
            if (Tools::isSubmit($key)) {
                Configuration::updateValue($key, Tools::getValue($key));
            }
        }
        $form_values = $this->generateFormValues();
        $l = Language::getLanguages(true);
        foreach (array_keys($form_values) as $key) {
            if (strpos($key, '_ENABLE') !== false) {
                if (Tools::isSubmit($key)) {
                    Configuration::updateValue($key, Tools::getValue($key));
                }
            } else {
                $sconfig = array();
                foreach ($l as $lang) {
                    if (Tools::isSubmit($key.'_'.$lang['id_lang'])) {
                        $sconfig[$lang['id_lang']] = Tools::getValue($key.'_'.$lang['id_lang']);
                    }
                }
                if (sizeof($sconfig)) {
                    Configuration::updateValue($key, $sconfig, true);
                }
            }
        }
    }

    /**
    * Add the CSS & JavaScript files you want to be loaded in the BO.
    */
    public function hookBackOfficeHeader()
    {
        $this->context->controller->addCSS($this->_path.'views/css/back.css');
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
        if (version_compare(_PS_VERSION_, '1.7.0', '>=') === true)  {
            $this->context->controller->addJS($this->_path.'/views/js/front-1.7.js');
        }
        Media::addJsDef(
            array('cvgajax' => Context::getContext()->link->getModuleLink('pmcvg', 'myconsents'))
        );
        if (Tools::isSubmit('submitNewsletter') && Tools::isSubmit('action') && Tools::getValue('action') == 0 && !Tools::isSubmit('addtonewslettercvg')) {
            $sql = 'SELECT count(*) FROM `'._DB_PREFIX_.'pmcvg` cvg 
            JOIN `'._DB_PREFIX_.'pmcvg_lang` l ON l.id_pmcvg = cvg.id_pmcvg AND l.id_lang = '.(int)Context::getContext()->language->id.' ';
            $sql .= 'AND l.id_shop = '.Context::getContext()->shop->id;
            $sql .= ' JOIN `'._DB_PREFIX_.'pmcvg_shop` s ON (s.id_pmcvg = cvg.id_pmcvg AND s.id_shop = '.(int)Context::getContext()->shop->id.') AND page LIKE "%4%" AND s.active = 1';
            $sql .= ' ORDER BY cvg.id_pmcvg';
            
            $r = Db::getInstance()->getValue($sql);
            if ($r) {
                Tools::redirect(
                Context::getContext()->link->getModuleLink('pmcvg', 'submitnewsletter',
                    array(
                        'email' => Tools::getValue('email'),
                        'action' => 0,
                    )
                )
            );
            }
        }
        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
        $show_all = false;
        $controller = Tools::getValue('controller');
        if ($controller == 'order' || $controller == 'orderopc') {
            $s = $this->getCustomerConsentsRequred();
            if (sizeof($s)) {
                if (Context::getContext()->customer->id) {
                    if (Configuration::get('PMCG_REDIRECT')) {
                        Tools::redirect(Context::getContext()->link->getModuleLink('pmcvg', 'myconsents', array('order' => 1)));
                    } else {
                        $show_all = true;                        
                    }
                }
            }
        }



        if ($controller == 'contact') {
            if (version_compare(_PS_VERSION_, '1.7.0', '<') === true)  {
                $this->context->controller->addJS($this->_path.'/views/js/front.js');
            } else {
                $this->context->controller->addJS($this->_path.'/views/js/front-1.7.js');
            }
            $sql = 'SELECT * FROM `'._DB_PREFIX_.'pmcvg` cvg 
            JOIN `'._DB_PREFIX_.'pmcvg_lang` l ON l.id_pmcvg = cvg.id_pmcvg AND l.id_lang = '.(int)Context::getContext()->language->id.' ';
            $sql .= 'AND l.id_shop = '.Context::getContext()->shop->id;
            $sql .= ' JOIN `'._DB_PREFIX_.'pmcvg_shop` s ON (s.id_pmcvg = cvg.id_pmcvg AND s.id_shop = '.(int)Context::getContext()->shop->id.') AND page LIKE "%5%" AND s.active = 1 AND s.required = 1';

            $sql .= ' ORDER BY cvg.id_pmcvg';
            $r = Db::getInstance()->executeS($sql);
            $errors = false;
            $post_conditions = Tools::getValue('conditions');
            if (Tools::isSubmit('condition')) {
                foreach ($r as $item) {
                    if (!isset($post_conditions[$item['id_pmcvg']])) {
                        $this->context->controller->errors[] = $this->l('Required: ').strip_tags($item['text']);
                        $errors = true;
                    }
                }
            }
            return $this->displayContact();
        }

        if ($controller == 'order') {
            return $this->displayOrder($show_all);
        } elseif ($controller == 'address' || Tools::isSubmit('submitAddress')) {
            return $this->displayAddress();
        } elseif ($controller == 'orderopc') {
            $htm = '';
            $htm .=$this->displayOrder($show_all);
            if (Context::getContext()->customer->id) {
                $htm .=$this->displayAddress();
            }
            return $htm;
        }

        // p($controller);
    }

    public function displayAddress()
    {
        if (version_compare(_PS_VERSION_, '1.7.0', '<') === true) {
            $this->context->controller->addJS($this->_path.'/views/js/front.js');
            $sql = 'SELECT * FROM `'._DB_PREFIX_.'pmcvg` cvg 
            JOIN `'._DB_PREFIX_.'pmcvg_lang` l ON l.id_pmcvg = cvg.id_pmcvg AND l.id_lang = '.(int)Context::getContext()->language->id.' ';
            $sql .= 'AND l.id_shop = '.Context::getContext()->shop->id;
            $sql .= ' JOIN `'._DB_PREFIX_.'pmcvg_shop` s ON (s.id_pmcvg = cvg.id_pmcvg AND s.id_shop = '.(int)Context::getContext()->shop->id.') AND page LIKE "%2%" AND s.active = 1';
            if (!is_array(pmcvg::$ids_get)) {
                pmcvg::$ids_get = array(0);
            }
            
            $sql .= ' ORDER BY cvg.id_pmcvg';
            
            $r = Db::getInstance()->executeS($sql);
            $selected = array();
            if (Tools::isSubmit('conditions')) {
                foreach (Tools::getValue('conditions') as $key => $value) {
                    $selected[$key] = 1;
                }
            }
            
            foreach ($r as $item) {
                pmcvg::$ids_get[] = $item['id_pmcvg'];
            }
            $this->context->smarty->assign('conditions', $r);
            $this->context->smarty->assign('conditions_name', 'address');
            $this->context->smarty->assign('selected_conditions', $selected);
            return $this->display(dirname(__FILE__), '/views/templates/front/conditions.tpl');
        }
    }

    public function displayContact()
    {
        if (Tools::isSubmit('conditions') && Context::getContext()->customer->id) {
            $condition = Tools::getValue('conditions');
            foreach ($condition as $condition_item => $val) {
                $customerAgrement = CustomerAgreementModel::getByCustomer(Context::getContext()->customer->id, $condition_item);
                $customerAgrement->id_customer = Context::getContext()->customer->id;
                $customerAgrement->id_pmcvg = $condition_item;
                $customerAgrement->set = 1;
                $customerAgrement->save();
                $cvgh = new CustomerAgreementHistoryModel();
                $cvgh->id_customer = $customerAgrement->id_customer;
                $cvgh->set = $customerAgrement->set;
                $cvgh->id_pmcvg = $customerAgrement->id_pmcvg;
                $cvgh->ip = $customerAgrement->ip;
                $cvgh->save();
            }
        }
        
        $sql = 'SELECT * FROM `'._DB_PREFIX_.'pmcvg` cvg 
        JOIN `'._DB_PREFIX_.'pmcvg_lang` l ON l.id_pmcvg = cvg.id_pmcvg AND l.id_lang = '.(int)Context::getContext()->language->id.' ';
        $sql .= 'AND l.id_shop = '.Context::getContext()->shop->id;
        $sql .= ' JOIN `'._DB_PREFIX_.'pmcvg_shop` s ON (s.id_pmcvg = cvg.id_pmcvg AND s.id_shop = '.(int)Context::getContext()->shop->id.') AND page LIKE "%5%" AND s.active = 1';

        $sql .= ' ORDER BY cvg.id_pmcvg';
        
        $r = Db::getInstance()->executeS($sql);
        $selected = array();
        if (Tools::isSubmit('conditions')) {
            foreach (Tools::getValue('conditions') as $key => $value) {
                $selected[$key] = 1;
            }
        }
        $this->context->smarty->assign('conditions', $r);
        $this->context->smarty->assign('conditions_name', 'contact');
        $this->context->smarty->assign('selected_conditions', $selected);
        if (version_compare(_PS_VERSION_, '1.7.0', '<') === true)  {
            $this->context->controller->addJS($this->_path.'/views/js/front.js');
            return $this->display(dirname(__FILE__), '/views/templates/front/conditions.tpl');
        } else {
            $this->context->controller->addJS($this->_path.'/views/js/front-1.7.js');
            return $this->display(dirname(__FILE__), '/views/templates/front/17/conditions.tpl');
        }
    }

    public function displayCreateAccount()
    {
        if (version_compare(_PS_VERSION_, '1.7.0', '<') === true) 
        {
            $this->context->controller->addJS($this->_path.'/views/js/front.js');
            $sql = 'SELECT * FROM `'._DB_PREFIX_.'pmcvg` cvg 
            JOIN `'._DB_PREFIX_.'pmcvg_lang` l ON l.id_pmcvg = cvg.id_pmcvg AND l.id_lang = '.(int)Context::getContext()->language->id.' ';
            $sql .= 'AND l.id_shop = '.Context::getContext()->shop->id;
            $sql .= ' JOIN `'._DB_PREFIX_.'pmcvg_shop` s ON (s.id_pmcvg = cvg.id_pmcvg AND s.id_shop = '.(int)Context::getContext()->shop->id.') AND page LIKE "%1%" AND s.active = 1';
            if (is_array(pmcvg::$ids_get)) {
                $sql .= ' WHERE cvg.id_pmcvg NOT IN ('.implode(',',pmcvg::$ids_get).')';
            }
            $sql .= ' ORDER BY cvg.id_pmcvg';
            $r = Db::getInstance()->executeS($sql);
            $selected = array();
            if (Tools::isSubmit('conditions')) {
                foreach (Tools::getValue('conditions') as $key => $value) {
                    $selected[$key] = 1;
                }
            }
            
            $this->context->smarty->assign('conditions', $r);
            $this->context->smarty->assign('conditions_name', 'account');
            $this->context->smarty->assign('selected_conditions', $selected);
            return $this->display(dirname(__FILE__), '/views/templates/front/conditions.tpl');
        } else {
            $this->context->controller->addJS($this->_path.'/views/js/front.js');
            $sql = 'SELECT * FROM `'._DB_PREFIX_.'pmcvg` cvg 
            JOIN `'._DB_PREFIX_.'pmcvg_lang` l ON l.id_pmcvg = cvg.id_pmcvg AND l.id_lang = '.(int)Context::getContext()->language->id.' ';
            $sql .= 'AND l.id_shop = '.Context::getContext()->shop->id;
            $sql .= ' JOIN `'._DB_PREFIX_.'pmcvg_shop` s ON (s.id_pmcvg = cvg.id_pmcvg AND s.id_shop = '.(int)Context::getContext()->shop->id.') AND page LIKE "%1%" AND s.active = 1';
            if (is_array(pmcvg::$ids_get)) {
                $sql .= ' WHERE cvg.id_pmcvg NOT IN ('.implode(',',pmcvg::$ids_get).')';
            }
            $sql .= ' ORDER BY cvg.id_pmcvg';
            $r = Db::getInstance()->executeS($sql);
            $selected = array();
            if (Tools::isSubmit('conditions')) {
                foreach (Tools::getValue('conditions') as $key => $value) {
                    $selected[$key] = 1;
                }
            }
            
            $this->context->smarty->assign('conditions', $r);
            $this->context->smarty->assign('conditions_name', 'account');
            $this->context->smarty->assign('selected_conditions', $selected);            
            return $this->display(dirname(__FILE__), '/views/templates/front/17/conditions.tpl');
        }
    }

    public function displayOrder($show_all_required)
    {
        if (Configuration::get('PMCG_ALL_CONSENTS')) {
            if ((int)Context::getContext()->customer->id) {
                $show_all_required = true;
            }
        }
        if (!$show_all_required) {
            $page = 'page like "%3%" ';
        } else {
            $page = '(page like "%1%" OR page like "%2%" OR page like "%3%")';
        }
        

        if (version_compare(_PS_VERSION_, '1.7.0', '<') === true) {
            $this->context->controller->addJS($this->_path.'/views/js/front.js');
            $this->context->controller->addCSS($this->_path.'/views/css/front.css');
            $sql = 'SELECT * FROM `'._DB_PREFIX_.'pmcvg` cvg 
            JOIN `'._DB_PREFIX_.'pmcvg_lang` l ON l.id_pmcvg = cvg.id_pmcvg AND l.id_lang = '.(int)Context::getContext()->language->id.' ';
            $sql .= 'AND l.id_shop = '.Context::getContext()->shop->id;
            $sql .= ' JOIN `'._DB_PREFIX_.'pmcvg_shop` s ON (s.id_pmcvg = cvg.id_pmcvg AND s.id_shop = '.(int)Context::getContext()->shop->id.') AND '.$page.' AND s.active = 1';

            $sql .= ' ORDER BY cvg.id_pmcvg';
            $r = Db::getInstance()->executeS($sql);
            $selected = array();
            if (Tools::isSubmit('conditions')) {
                foreach (Tools::getValue('conditions') as $key => $value) {
                    $selected[$key] = 1;
                }
            }
            $this->context->smarty->assign('conditions', $r);
            $this->context->smarty->assign('conditions_name', 'order');
            $this->context->smarty->assign('selected_conditions', $selected);
            return $this->display(dirname(__FILE__), '/views/templates/front/conditions.tpl');
        }
    }

    public function hookTermsAndConditions($params)
    {        
        $show_all_required = false;
        if (Configuration::get('PMCG_ALL_CONSENTS')) {
            if ((int)Context::getContext()->customer->id) {
                $show_all_required = true;
            }
        }
        if (!$show_all_required) {
            $page = 'page like "%3%" ';
        } else {
            $page = '(page like "%1%" OR page like "%2%" OR page like "%3%")';
        }
        

        if (version_compare(_PS_VERSION_, '1.7.0', '>=') === true) {            
            $this->context->controller->addCSS($this->_path.'/views/css/front.css');
            $sql = 'SELECT * FROM `'._DB_PREFIX_.'pmcvg` cvg 
            JOIN `'._DB_PREFIX_.'pmcvg_lang` l ON l.id_pmcvg = cvg.id_pmcvg AND l.id_lang = '.(int)Context::getContext()->language->id.' ';
            $sql .= 'AND l.id_shop = '.Context::getContext()->shop->id;
            $sql .= ' JOIN `'._DB_PREFIX_.'pmcvg_shop` s ON (s.id_pmcvg = cvg.id_pmcvg AND s.id_shop = '.(int)Context::getContext()->shop->id.') AND '.$page.' AND s.active = 1';

            $sql .= ' ORDER BY cvg.id_pmcvg';
            $r = Db::getInstance()->executeS($sql);
            $selected = array();
            if (Tools::isSubmit('conditions')) {
                foreach (Tools::getValue('conditions') as $key => $value) {
                    $selected[$key] = 1;
                }
            }
        }
        $conditions = array();

        foreach ($r as $item) {
            $termsAndConditions = new TermsAndConditions();
            $termsAndConditions
                ->setText(
                    $item['text'],
                    ''
                )
                ->setIdentifier('conditions-'.$item['id_pmcvg']);
            ;
            $conditions[] = $termsAndConditions;
        }
        
        
        return $conditions;
    }

    public function hookDisplayCustomerAccount()
    {
        return $this->display(__FILE__, '1.6-myaccount.tpl');
    }

    public function getIdDeleted()
    {
        $c = new Customer();
        $deleted = 'deleted@'.str_replace(array('https://', 'http://', 'www.'), array(), _PS_BASE_URL_);
        $c->getByEmail($deleted);
        if (!(int)$c->id) {
            $c = new Customer();
            $c->firstname = $this->l('Deleted');
            $c->lastname = $this->l('Deleted');
            $c->email = 'deleted@'.str_replace(array('https://', 'http://', 'www.'), array(), _PS_BASE_URL_);
            $c->passwd = Tools::passwdGen();
            $c->add();
        }
        return $c->id;
    }

    public function getAddressDeleted($id_customer_deleted = false)
    {
        if ($id_customer_deleted === false) {
            $id_customer_deleted = $this->getIdDeleted();
        }
        $sql = 'SELECT id_address FROM `'._DB_PREFIX_.'address` WHERE id_customer = '.(int)$id_customer_deleted;
        $row = Db::getInstance()->getRow($sql);
        if (!$row) {
            $a = new Address();
            $a->id_customer = $id_customer_deleted;
            $a->firstname = $this->l('Deleted');
            $a->lastname = $this->l('Deleted');
            $a->address1 = $this->l('Deleted');
            $a->address2 = $this->l('Deleted');
            $a->city = $this->l('Deleted');
            $a->phone = $this->l('000000000');
            $a->company = $this->l('Deleted');
            $a->postcode = $this->l('00000');
            $a->id_country = 1;
            $a->alias = $this->l('Deleted');
            try {
                $a->add();
            } catch (Exception $exp) {
                die($exp->getMessage());
            }
            return $a->id;
        }
        return $row['id_address'];
    }

    public function removeCustomer($id_customer, $id_pmcvg_process)
    {
        if ($id_customer == 0) {
            return false;
        }
        $c = new Customer($id_customer);
        if ($c->id == 0) {
            return false;
        }
        if (Configuration::get('PMCG_REMOVE_TYPE')) { //Usuwanie wszystkich danych klienta
            $sql = 'DELETE FROM `'._DB_PREFIX_.'cart_product` WHERE id_cart IN (
                SELECT id_cart FROM `'._DB_PREFIX_.'cart` WHERE id_customer = '.(int)$id_customer.')';
            $result = Db::getInstance()->execute($sql);
            ;
            
            $sql = 'DELETE FROM `'._DB_PREFIX_.'cart` WHERE id_customer = '.(int)$id_customer;
            $result = Db::getInstance()->execute($sql);
            ;

            $sql = 'DELETE FROM `'._DB_PREFIX_.'cart_rule` WHERE id_customer = '.(int)$id_customer;
            $result = Db::getInstance()->execute($sql);

            $sql = 'DELETE FROM `'._DB_PREFIX_.'compare` WHERE id_customer = '.(int)$id_customer;
            $result = Db::getInstance()->execute($sql);

            $sql = 'DELETE FROM `'._DB_PREFIX_.'address` WHERE id_customer = '.(int)$id_customer;
            $result = Db::getInstance()->execute($sql);

            $sql = 'DELETE FROM `'._DB_PREFIX_.'order_detail` WHERE id_cart IN (
                SELECT id_cart FROM `'._DB_PREFIX_.'orders` WHERE id_customer = '.(int)$id_customer.')';

            $sql = 'DELETE FROM `'._DB_PREFIX_.'orders` WHERE id_customer = '.(int)$id_customer;
            $result = Db::getInstance()->execute($sql);

            $sql = 'DELETE FROM `'._DB_PREFIX_.'customer_group` WHERE id_customer = '.(int)$id_customer;
            $result = Db::getInstance()->execute($sql);

            $sql = 'DELETE FROM `'._DB_PREFIX_.'customer_message` WHERE id_customer_thread IN (
                SELECT id_customer_thread FROM `'._DB_PREFIX_.'customer_thread` WHERE id_customer = '.(int)$id_customer.')';

            $sql = 'DELETE FROM `'._DB_PREFIX_.'customer_thread` WHERE id_customer = '.(int)$id_customer;
            $result = Db::getInstance()->execute($sql);
            
            $sql = 'SELECT id_guest FROM `'._DB_PREFIX_.'guest` WHERE id_customer = '.(int)$id_customer;
            $guest = Db::getInstance()->getRow($sql);

            if ($guest) {
                $sql = 'DELETE FROM `'._DB_PREFIX_.'connections_page` WHERE id_connections IN (
                SELECT id_connections FROM `'._DB_PREFIX_.'connections` WHERE id_guest = '.(int)$guest.')';
                Db::getInstance()->execute($sql);
                $sql = 'DELETE FROM `'._DB_PREFIX_.'connections_source` WHERE id_connections IN (
                SELECT id_connections FROM `'._DB_PREFIX_.'connections` WHERE id_guest = '.(int)$guest.')';
            }

            $sql = 'DELETE FROM `'._DB_PREFIX_.'message` WHERE id_customer = '.(int)$id_customer;
            $result = Db::getInstance()->execute($sql);
            $sql = 'DELETE FROM `'._DB_PREFIX_.'order_return` WHERE id_customer = '.(int)$id_customer;
            $result = Db::getInstance()->execute($sql);
            $sql = 'DELETE FROM `'._DB_PREFIX_.'order_slip` WHERE id_customer = '.(int)$id_customer;
            $result = Db::getInstance()->execute($sql);
            $sql = 'DELETE FROM `'._DB_PREFIX_.'specific_price` WHERE id_customer = '.(int)$id_customer;
            $result = Db::getInstance()->execute($sql);
            $c = new Customer($id_customer);
            $email = pSql($c->email);

            $sql = 'DELETE FROM `'._DB_PREFIX_.'newsletter` WHERE email = "'.$email.'"';
            $result = Db::getInstance()->execute($sql);
            
            $log = $this->l('Permanent deletion of data from the server (baskets, orders, addresses)');
            $this->addProcessLog($c->id, $log, $id_pmcvg_process);
            $c->delete();
            return true;

            $this->sendMail($c->email, _REMOVE_ACCOUNT_, $c->id_lang);
        } else { // Pozostawienie zamówień - usunięcie podstawowych danych
            $id_customer_deleted = $this->getIdDeleted();
            $id_address_deleted = $this->getAddressDeleted($id_customer_deleted);

            $c = new Customer($id_customer);
            $sql = 'UPDATE `'._DB_PREFIX_.'cart` SET id_address_delivery = '.$id_address_deleted.', id_address_invoice = '.$id_address_deleted.',id_customer = '.$id_customer_deleted.' WHERE id_customer = '.(int)$id_customer;
            Db::getInstance()->execute($sql);
            $sql = 'UPDATE `'._DB_PREFIX_.'guest` SET id_customer = '.$id_customer_deleted.' WHERE id_customer = '.(int)$id_customer;
            Db::getInstance()->execute($sql);
            $sql = 'UPDATE `'._DB_PREFIX_.'cart_rule` SET id_customer = '.$id_customer_deleted.' WHERE id_customer = '.(int)$id_customer;
            Db::getInstance()->execute($sql);
            $sql = 'UPDATE `'._DB_PREFIX_.'compare` SET id_customer = '.$id_customer_deleted.' WHERE id_customer = '.(int)$id_customer;
            Db::getInstance()->execute($sql);
            $sql = 'UPDATE `'._DB_PREFIX_.'orders` SET id_address_delivery = '.$id_address_deleted.', id_address_invoice = '.$id_address_deleted.',id_customer = '.$id_customer_deleted.' WHERE id_customer = '.(int)$id_customer;
            Db::getInstance()->execute($sql);
            $sql = 'UPDATE `'._DB_PREFIX_.'customer_thread` SET id_customer = '.$id_customer_deleted.' WHERE id_customer = '.(int)$id_customer;
            Db::getInstance()->execute($sql);
            $sql = 'UPDATE `'._DB_PREFIX_.'message` SET id_customer = '.$id_customer_deleted.' WHERE id_customer = '.(int)$id_customer;
            Db::getInstance()->execute($sql);
            $sql = 'UPDATE `'._DB_PREFIX_.'order_return` SET id_customer = '.$id_customer_deleted.' WHERE id_customer = '.(int)$id_customer;
            Db::getInstance()->execute($sql);
            $sql = 'UPDATE `'._DB_PREFIX_.'order_slip` SET id_customer = '.$id_customer_deleted.' WHERE id_customer = '.(int)$id_customer;
            Db::getInstance()->execute($sql);
            $sql = 'UPDATE `'._DB_PREFIX_.'specific_price` SET id_customer = '.$id_customer_deleted.' WHERE id_customer = '.(int)$id_customer;
            Db::getInstance()->execute($sql);
            $sql = 'DELETE FROM `'._DB_PREFIX_.'address` WHERE id_customer = '.(int)$id_customer;
            $result = Db::getInstance()->execute($sql);
            $log = $this->l('Remove customer account - transfer of data for statistical purposes');
            $this->addProcessLog($c->id, $log, $id_pmcvg_process);
            $c->delete();
            $this->sendMail($c->email, _REMOVE_ACCOUNT_, $c->id_lang);
            return true;
        }
    }

    public function export($id_customer, $log)
    {
        $export_model = new ExportModel();
        $export_model->id_customer = (int)$id_customer;
        $export_model->log = $log;
        $export_model->add();
    }

    public function addProcessLog($id_customer, $log, $id_pmcvg_process)
    {
        $log_model = new LogModel();
        $log_model->id_customer = (int)$id_customer;
        $log_model->id_pmcvg_process = (int)$id_pmcvg_process;
        $log_model->log = $log;
        $log_model->add();
    }

    public function getPageOptions()
    {
        $arr = array(
            1 => array(
                'id' => 1,
                'name' => $this->l('Create account'),
            ),
            2 => array(
                'id' => 2,
                'name' => $this->l('Create address'),
            ),
            3 => array(
                'id' => 3,
                'name' => $this->l('Order'),
            ),
            4 => array(
                'id' => 4,
                'name' => $this->l('Newsletter'),
            ),
            5 => array(
                'id' => 5,
                'name' => $this->l('Contact form'),
            )
        );
        if (version_compare(_PS_VERSION_, '1.7.0', '>=') === true) {
            unset($arr[2]);
        }
        return $arr;
    }

    public function getCustomerConsents()
    {
        $sql = 'SELECT cvg.*,l.*,a.set,a.date_upd FROM `'._DB_PREFIX_.'pmcvg` cvg 
        JOIN `'._DB_PREFIX_.'pmcvg_lang` l ON l.id_pmcvg = cvg.id_pmcvg AND l.id_lang = '.(int)Context::getContext()->language->id.' ';
        $sql .= 'AND l.id_shop = '.Context::getContext()->shop->id;
        $sql .= ' JOIN `'._DB_PREFIX_.'pmcvg_shop` s ON (s.id_pmcvg = cvg.id_pmcvg AND s.id_shop = '.(int)Context::getContext()->shop->id.') AND s.active = 1';
        $sql .= ' LEFT OUTER JOIN `'._DB_PREFIX_.'pmcvg_customer_agreement` a ON a.id_pmcvg = cvg.id_pmcvg
        AND (a.id_customer = '.(int)Context::getContext()->customer->id.' OR a.id_customer IS NULL) AND s.id_shop = '.(int)Context::getContext()->shop->id.' 
        ';

        $r = Db::getInstance()->executeS($sql);

        return $r;
    }

    public function getCustomerConsentsRequred()
    {
        $sql = 'SELECT cvg.*,l.*,a.set,a.date_upd FROM `'._DB_PREFIX_.'pmcvg` cvg 
        JOIN `'._DB_PREFIX_.'pmcvg_lang` l ON l.id_pmcvg = cvg.id_pmcvg AND l.id_lang = '.(int)Context::getContext()->language->id.' ';
        $sql .= 'AND l.id_shop = '.Context::getContext()->shop->id;
        $sql .= ' JOIN `'._DB_PREFIX_.'pmcvg_shop` s ON (s.id_pmcvg = cvg.id_pmcvg AND s.id_shop = '.(int)Context::getContext()->shop->id.') AND s.active = 1';
        $sql .= ' LEFT OUTER JOIN `'._DB_PREFIX_.'pmcvg_customer_agreement` a ON a.id_pmcvg = cvg.id_pmcvg
        AND (a.id_customer = '.(int)Context::getContext()->customer->id.' OR a.id_customer IS NULL) AND s.id_shop = '.(int)Context::getContext()->shop->id.' 
        WHERE s.required AND page IN (1,2) AND (a.set IS NULL OR a.set = 0)';

        $r = Db::getInstance()->executeS($sql);
        return $r;
    }

    public function addProcess($id_customer, $type, $id_lang)
    {
        $processModel = new ProcessModelCvg();
        {
            $processModel->id_customer = $id_customer;
            $processModel->type = 1;
            $processModel->status = $type;
            $processModel->add();
            $this->notification($type, $id_customer, $id_lang);
        }
    }

    public function notification($type, $id_customer, $id_lang)
    {
        if ((int)Context::getContext()->customer->id) {
            $mail = Context::getContext()->customer->email;
            if ($type == 2) { // User anonimize request
                $this->sendMail($mail, _USER_ANONIMIZE_REQUEST_, $id_lang);
            } elseif ($type == 1) { // User anonimize request
                $this->sendMail($mail, _USER_REMOVE_REQUEST_, $id_lang);
            }
        }
    }

    public function installTab()
    {
        $deflang = (int)Configuration::get('PS_LANG_DEFAULT');
        
        $mainTab = $this->installModuleTab('AdminConditions', array($deflang => 'Zarządzanie prywatnością'), 0);
        
        if ($mainTab) {
            foreach ($this->tabs as $class => $tab) {
                $tabNamesArray = array();
                foreach ($tab as $tabIso => $tabName) {
                    foreach ($this->languages as $language) {
                        if ($language['iso_code'] == $tabIso) {
                            $tabNamesArray[$language['id_lang']] = $tabName;
                        }
                    }
                }
                if (!key_exists($deflang, $tabNamesArray)) {
                    $tabNamesArray[$deflang] = $tab['en'];
                }
                $this->installModuleTab($class, $tabNamesArray, $mainTab);
            }
        } else {
            return false;
        }
        return true;
    }
    
    public function uninstallTab()
    {
        foreach ($this->tabs as $class => $key) {
            $this->uninstallModuleTab($class);
        }
        $this->uninstallModuleTab('AdminConditions');
    }
    
    private function installModuleTab($tabClass, $tabName, $idTabParent)
    {
        $tab = new Tab();
        $tab->name = $tabName;
        $tab->class_name = $tabClass;
        $tab->module = $this->name;
        $tab->id_parent = $idTabParent;
    
        if (!$tab->save()) {
            return false;
        }
    
        return $tab->id;
    }

    public function getContent()
    {
        $this->registerHook('termsAndConditions');
        $this->registerHook('additionalCustomerFormFields');
        $this->registerHook('actionCustomerAccountAdd');
        $this->getIdDeleted();
        /**
         * If values have been submitted in the form, process.
         */
        if (((bool)Tools::isSubmit('submitRodoueModule')) == true) {
            $this->postProcess();
        }

        $this->context->smarty->assign('module_dir', $this->_path);
        
        $form = $this->renderForm(array(
                array(
                    $this->l('Right to opposition'),
                    1
                ),
                array(
                    $this->l('Right to correct information'),
                    2
                ),
                array(
                    $this->l('Right to export data'),
                    3
                ),
                array(
                    $this->l('Right to be anonymous'),
                    4
                ),
                array(
                    $this->l('Right to be forgot'),
                    5
                ),
                array(
                    $this->l('Right to be informed'),
                    6
                ),
                array(
                    $this->l('Right to be notified'),
                    7
                ),
                array(
                    $this->l('Right to limit data processing'),
                    8
                )
            )
        );
        
        $this->context->smarty->assign('bigform', $form);
        $this->context->smarty->assign('globalform', $this->formGlobal());
        $this->context->smarty->assign('emailform', $this->formEmail());
        
        $output = $this->context->smarty->fetch($this->local_path.'views/templates/admin/configure.tpl');
        return $output;
    }

    /**
     * Create the form that will be displayed in the configuration of your module.
     */
    protected function renderForm($pages)
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitRodoueModule';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            .'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = array(
            'fields_value' => $this->generateFormValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        $forms = array();
        foreach ($pages as $p) {
            $forms[] = $this->generateForm($p[0], $p[1]);
        }
        return $helper->generateForm($forms);
    }

    protected function generateForm($form_name, $page)
    {
        return array(
            'form' => array(
                'legend' => array(
                'title' => $form_name,
                'icon' => 'icon-cogs',
                ),
                'tinymce' => true,
                'input' => array(
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Enable this page'),
                        'name' => 'PMCG_PAGE_'.$page.'_ENABLE',
                        'is_bool' => true,
                        'shop' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),
                    array(
                        'col' => 3,
                        'type' => 'text',
                        'lang' => true,
                        'name' => 'PMCG_PAGE_'.$page.'_TITLE',
                        'label' => $this->l('Page title'),
                    ),
                    array(
                        'col' => 3,
                        'type' => 'text',
                        'lang' => true,
                        'name' => 'PMCG_PAGE_'.$page.'_BUTTON',
                        'label' => $this->l('Button title'),
                    ),
                    array(
                        'col' => 6,
                        'type' => 'textarea',
                        'autoload_rte' => true,
                        'lang' => true,
                        'name' => 'PMCG_PAGE_'.$page.'_DESC_1',
                        'label' => $this->l('Description on privacy management'),
                    ),
                    array(
                        'col' => 6,
                        'type' => 'textarea',
                        'autoload_rte' => true,
                        'lang' => true,
                        'name' => 'PMCG_PAGE_'.$page.'_DESC_2',
                        'label' => $this->l('Top description'),
                    ),
                    array(
                        'col' => 6,
                        'type' => 'textarea',
                        'autoload_rte' => true,
                        'lang' => true,
                        'name' => 'PMCG_PAGE_'.$page.'_DESC_3',
                        'label' => $this->l('Bottom description'),
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );
    }

    public function installConfig()
    {
        $l = Language::getLanguages(true);
        $config = array();
        
        $button = $this->l('My consent');
        $title = $this->l('Right to opposition');
        $desc1 = $this->l('W tym miejscu możesz sprawdzić, wszystkie zgody formalne i w łatwy sposób je ograniczyć.');
        $desc2 = $this->l('W tym miejscu możesz sprawdzić, wszystkie zgody formalne i w łatwy sposób je ograniczyć.');
        $desc3 = $this->l('');

        $config['PMCG_PAGE_1_ENABLE'] = 1;
        foreach ($l as $lang) {
            $config['PMCG_PAGE_1_BUTTON'][$lang['id_lang']] = $button;
            $config['PMCG_PAGE_1_TITLE'][$lang['id_lang']] = $title;
            $config['PMCG_PAGE_1_DESC_1'][$lang['id_lang']] = $desc1;
            $config['PMCG_PAGE_1_DESC_2'][$lang['id_lang']] = $desc2;
            $config['PMCG_PAGE_1_DESC_3'][$lang['id_lang']] = $desc3;
        }
        Configuration::updateValue('PMCG_ADMIN_EMAIL', Configuration::get('PS_SHOP_EMAIL'));
        $button = $this->l('Information');
        $title = $this->l('Right to correct information');
        $desc1 = $this->l('Sprawdź czy Twoje dane osobowe są poprawne, możesz zmienić swoje dane osobiste, adresy, oraz hasło.');
        $desc2 = $this->l('Sprawdź czy Twoje dane osobowe są poprawne, możesz zmienić swoje dane osobiste, adresy, oraz hasło.');
        $desc3 = $this->l('');

        $config['PMCG_PAGE_2_ENABLE'] = 1;
        foreach ($l as $lang) {
            $config['PMCG_PAGE_2_BUTTON'][$lang['id_lang']] = $button;
            $config['PMCG_PAGE_2_TITLE'][$lang['id_lang']] = $title;
            $config['PMCG_PAGE_2_DESC_1'][$lang['id_lang']] = $desc1;
            $config['PMCG_PAGE_2_DESC_2'][$lang['id_lang']] = $desc2;
            $config['PMCG_PAGE_2_DESC_3'][$lang['id_lang']] = $desc3;
        }

        $button = $this->l('Export data');
        $title = $this->l('Right to export data');
        $desc1 = $this->l('Udostępniamy w prosty sposób pobranie danych osobowych w formacie: xml, csv, json.');
        $desc2 = $this->l('Udostępniamy w prosty sposób pobranie danych osobowych w formacie: xml, csv, json.');
        $desc3 = $this->l('');
        $config['PMCG_PAGE_3_ENABLE'] = 1;
        foreach ($l as $lang) {
            $config['PMCG_PAGE_3_BUTTON'][$lang['id_lang']] = $button;
            $config['PMCG_PAGE_3_TITLE'][$lang['id_lang']] = $title;
            $config['PMCG_PAGE_3_DESC_1'][$lang['id_lang']] = $desc1;
            $config['PMCG_PAGE_3_DESC_2'][$lang['id_lang']] = $desc2;
            $config['PMCG_PAGE_3_DESC_3'][$lang['id_lang']] = $desc3;
        }

        $button = $this->l('Anonimize data');
        $title = $this->l('Right to be anonymous');
        $desc1 = $this->l('Możesz być anonimowy, przesłanie zgłoszenia podda twoje dane anonimizacji.');
        $desc2 = $this->l('Możesz być anonimowy, przesłanie zgłoszenia podda twoje dane anonimizacji.');
        $desc3 = $this->l('');
        $config['PMCG_PAGE_4_ENABLE'] = 1;
        foreach ($l as $lang) {
            $config['PMCG_PAGE_4_BUTTON'][$lang['id_lang']] = $button;
            $config['PMCG_PAGE_4_TITLE'][$lang['id_lang']] = $title;
            $config['PMCG_PAGE_4_DESC_1'][$lang['id_lang']] = $desc1;
            $config['PMCG_PAGE_4_DESC_2'][$lang['id_lang']] = $desc2;
            $config['PMCG_PAGE_4_DESC_3'][$lang['id_lang']] = $desc3;
        }

        $button = $this->l('Remove account');
        $title = $this->l('Right to be forgot');
        $desc1 = $this->l('Usuń trwale i nieodwracalnie swoje dane.');
        $desc2 = $this->l('Usuń trwale i nieodwracalnie swoje dane. Po przesłaniu formularza twoje dane zostaną skasowane przes obsługę sklepu.');
        $desc3 = $this->l('');
        $config['PMCG_PAGE_5_ENABLE'] = 1;
        foreach ($l as $lang) {
            $config['PMCG_PAGE_5_BUTTON'][$lang['id_lang']] = $button;
            $config['PMCG_PAGE_5_TITLE'][$lang['id_lang']] = $title;
            $config['PMCG_PAGE_5_DESC_1'][$lang['id_lang']] = $desc1;
            $config['PMCG_PAGE_5_DESC_2'][$lang['id_lang']] = $desc2;
            $config['PMCG_PAGE_5_DESC_3'][$lang['id_lang']] = $desc3;
        }

        $button = $this->l('Information');
        $title = $this->l('Right to be informed');
        $desc1 = $this->l('Podstawowe informacje jakie dane osobowe przechowujemy w naszym sklepie w celu realizacji zamówień');
        $desc2 = $this->l('W sklepie [nazwa]. przechowujemy twoje dane osobowe takie jak: Imię, Nazwisko, Adres, E-Mail, Numer telefonu, w celu realizacji zamówień twoje dane osobowe są udostępniane firmie kurierskiej: (nazwa firmy)');
        $desc3 = $this->l('');
        $config['PMCG_PAGE_6_ENABLE'] = 1;
        foreach ($l as $lang) {
            $config['PMCG_PAGE_6_BUTTON'][$lang['id_lang']] = $button;
            $config['PMCG_PAGE_6_TITLE'][$lang['id_lang']] = $title;
            $config['PMCG_PAGE_6_DESC_1'][$lang['id_lang']] = $desc1;
            $config['PMCG_PAGE_6_DESC_2'][$lang['id_lang']] = $desc2;
            $config['PMCG_PAGE_6_DESC_3'][$lang['id_lang']] = $desc3;
        }

        $button = $this->l('Information');
        $title = $this->l('Right to be notified');
        $desc1 = $this->l('W przypadku wycieku danych, zostaniesz o tym poinformowany w ciągu 72 h');
        $desc2 = $this->l('W przypadku wycieku danych, zostaniesz o tym poinformowany w ciągu 72 h');
        $desc3 = $this->l('');
        $config['PMCG_PAGE_7_ENABLE'] = 1;
        foreach ($l as $lang) {
            $config['PMCG_PAGE_7_BUTTON'][$lang['id_lang']] = $button;
            $config['PMCG_PAGE_7_TITLE'][$lang['id_lang']] = $title;
            $config['PMCG_PAGE_7_DESC_1'][$lang['id_lang']] = $desc1;
            $config['PMCG_PAGE_7_DESC_2'][$lang['id_lang']] = $desc2;
            $config['PMCG_PAGE_7_DESC_3'][$lang['id_lang']] = $desc3;
        }

        $button = $this->l('Limit data processing');
        $title = $this->l('Right to limit data processing');
        $desc1 = $this->l('Jeżeli chcesz możesz wysłać zgłoszenie, abyśmy zaprzestali przetwarzania danych osobowych powiązanych z Twoim kontem. ');
        $desc2 = $this->l('Jeżeli chcesz możesz wysłać zgłoszenie, abyśmy zaprzestali przetwarzania danych osobowych powiązanych z Twoim kontem. ');
        $desc3 = $this->l('');
        $config['PMCG_PAGE_8_ENABLE'] = 1;
        foreach ($l as $lang) {
            $config['PMCG_PAGE_8_BUTTON'][$lang['id_lang']] = $button;
            $config['PMCG_PAGE_8_TITLE'][$lang['id_lang']] = $title;
            $config['PMCG_PAGE_8_DESC_1'][$lang['id_lang']] = $desc1;
            $config['PMCG_PAGE_8_DESC_2'][$lang['id_lang']] = $desc2;
            $config['PMCG_PAGE_8_DESC_3'][$lang['id_lang']] = $desc3;
        }

        foreach ($config as $key => $val) {
            Configuration::updateValue($key, $val);
        }

        return true;
    }

    public function hookAdditionalCustomerFormFields($params)
    {
        $sql = 'SELECT * FROM `'._DB_PREFIX_.'pmcvg` cvg 
        JOIN `'._DB_PREFIX_.'pmcvg_lang` l ON l.id_pmcvg = cvg.id_pmcvg AND l.id_lang = '.(int)Context::getContext()->language->id.' ';
        $sql .= 'AND l.id_shop = '.Context::getContext()->shop->id;
        $sql .= ' JOIN `'._DB_PREFIX_.'pmcvg_shop` s ON (s.id_pmcvg = cvg.id_pmcvg AND s.id_shop = '.(int)Context::getContext()->shop->id.') AND page LIKE "%1%" AND s.active = 1';
        if (is_array(pmcvg::$ids_get)) {
            $sql .= ' WHERE cvg.id_pmcvg NOT IN ('.implode(',',pmcvg::$ids_get).')';
        }
        $sql .= ' ORDER BY cvg.id_pmcvg';
        $r = Db::getInstance()->executeS($sql);
        $selected = array();
        if (Tools::isSubmit('conditions')) {
            foreach (Tools::getValue('conditions') as $key => $value) {
                $selected[$key] = 1;
            }
        }
        $formField = array();
        foreach ($r as $item) {
            $formField[] = (new FormField())
            ->setName('conditions_'.$item['id_pmcvg'])
            ->setType('checkbox')
            ->setLabel($item['text'])
            ->setRequired($item['required']);
        }
        

        return $formField;
    }

    public function hookCreateAccountForm()
    {
        if (version_compare(_PS_VERSION_, '1.7.0', '<') === true) {
            return $this->displayCreateAccount();
        }
        return '';
    }

    public function hookActionBeforeSubmitAccount()
    {
        return true;
        $sql = 'SELECT * FROM `'._DB_PREFIX_.'pmcvg` cvg 
        JOIN `'._DB_PREFIX_.'pmcvg_lang` l ON l.id_pmcvg = cvg.id_pmcvg AND l.id_lang = '.(int)Context::getContext()->language->id.' ';
        $sql .= 'AND l.id_shop = '.Context::getContext()->shop->id;
        $sql .= ' JOIN `'._DB_PREFIX_.'pmcvg_shop` s ON (s.id_pmcvg = cvg.id_pmcvg AND s.id_shop = '.(int)Context::getContext()->shop->id.') AND page LIKE "%1%" AND s.active = 1 AND s.required = 1';

        $sql .= ' ORDER BY cvg.id_pmcvg';
        $r = Db::getInstance()->executeS($sql);
        $errors = false;
        $post_conditions = Tools::getValue('conditions');
        foreach ($r as $item) {
            if (!isset($post_conditions[$item['id_pmcvg']])) {
                $this->context->controller->errors[] = $this->l('Required: ').strip_tags($item['text']);
                $errors = true;
            }            
        }
        return true;
    }

    public function hookActionCustomerAccountAdd($params)
    {
        if (Tools::isSubmit('conditions') && Context::getContext()->customer->id) {
            $condition = Tools::getValue('conditions');
            foreach ($condition as $condition_item => $val) {
                $customerAgrement = CustomerAgreementModel::getByCustomer(Context::getContext()->customer->id, $condition_item);
                $customerAgrement->id_customer = Context::getContext()->customer->id;
                $customerAgrement->id_pmcvg = $condition_item;
                $customerAgrement->set = 1;
                $customerAgrement->save();
                $cvgh = new CustomerAgreementHistoryModel();
                $cvgh->id_customer = $customerAgrement->id_customer;
                $cvgh->set = $customerAgrement->set;
                $cvgh->id_pmcvg = $customerAgrement->id_pmcvg;
                $cvgh->ip = $customerAgrement->ip;
                $cvgh->save();
            }
            return true;
        }
        if (isset($params['newCustomer']) &&(int)$params['newCustomer']->id) {
            foreach ($_POST as $item => $value) {
                if (strpos($item, 'conditions_') !== false) {
                    $condition_item = (int)str_replace('conditions_', '', $item);
                    if ($condition_item) {
                        $customerAgrement = CustomerAgreementModel::getByCustomer(Context::getContext()->customer->id, $condition_item);
                        $customerAgrement->id_customer = Context::getContext()->customer->id;
                        $customerAgrement->id_pmcvg = $condition_item;
                        $customerAgrement->set = 1;
                        $customerAgrement->save();
                        $cvgh = new CustomerAgreementHistoryModel();
                        $cvgh->id_customer = $customerAgrement->id_customer;
                        $cvgh->set = $customerAgrement->set;
                        $cvgh->id_pmcvg = $customerAgrement->id_pmcvg;
                        $cvgh->ip = $customerAgrement->ip;
                        $cvgh->save();
                    }
                }
            }
        }
    }

    public function langtrans($s)
    {
        if ($s == 'Requred: ') {
            return $this->l('Required: ');
        } elseif ($s == 'Export customer data:') {
            return $this->l('Export customer data: ');
        } else if ($s == 'Deactivate consent') {
            return $this->l('Deactivate consent');
        } else if ($s == 'Accept consent') {
            return $this->l('Accept consent');
        } else if ($s == 'Are you sure you want to delete your account?') {
            return $this->l('Are you sure you want to delete your account?');
        }

        
                
        return $s;
    }

    public function sendMail($mail, $template, $id_lang)
    {
        $mail_iso = Language::getIsoById($id_lang);
        $id_shop = Context::getContext()->shop->id;
        if (file_exists(dirname(__FILE__).'/mails/'.$mail_iso.'/anonimize_confirm_customer.html')) {
            $dir_mail = dirname(__FILE__).'/mails/';
        }

        if (file_exists(_PS_MAIL_DIR_.$mail_iso.'/anonimize_confirm_customer.html')) {
            $dir_mail = _PS_MAIL_DIR_;
        }

        $configuration = Configuration::getMultiple(
                array(
                    'PS_SHOP_EMAIL',
                    'PS_MAIL_METHOD',
                    'PS_MAIL_SERVER',
                    'PS_MAIL_USER',
                    'PS_MAIL_PASSWD',
                    'PS_SHOP_NAME',
                    'PS_MAIL_COLOR',
                    'PMCG_NOTIFI_ANONIMIZE_CUSTOMER',
                    'PMCG_NOTIFI_ANONIMIZE_ADMIN',
                    'PMCG_NOTIFI_ANONIMIZE_CONF_CUSTOMER',
                    'PMCG_NOTIFI_REMOVE_CUSTOMER',
                    'PMCG_NOTIFI_REMOVE_ADMIN',
                    'PMCG_NOTIFI_REMOVE_CONF_CUSTOMER',
                )
            );
        if ($template == _REMOVE_ACCOUNT_) {
            $template_vars = array();
            $template_vars['{CUSTOMER}'] = '';
            if (Context::getContext()->customer->id) {
                $c = new Customer();
                $customer = $c->id.': '.$c->firstname.' '.$c->lastname.' '.$c->email;
                $template_vars['{CUSTOMER}'] = $customer;
            }

            if ($configuration['PMCG_NOTIFI_REMOVE_CONF_CUSTOMER']) {
                Mail::Send(
                $id_lang,
                'remove_confirm_customer',
                $this->l('Your personal data has been deleted'),
                $template_vars,
                $mail,
                null,
                $configuration['PS_SHOP_EMAIL'],
                $configuration['PS_SHOP_NAME'],
                null,
                null,
                $dir_mail,
                null,
                Context::getContext()->shop->id
            );
            }
        } elseif ($template == _ANONIMIZE_ACCOUNT_) {
            $template_vars = array();
            $template_vars['{CUSTOMER}'] = '';
            if (Context::getContext()->customer->id) {
                $c = new Customer();
                $customer = $c->id.': '.$c->firstname.' '.$c->lastname.' '.$c->email;
                $template_vars['{CUSTOMER}'] = $customer;
            }
            if ($configuration['PMCG_NOTIFI_ANONIMIZE_CONF_CUSTOMER']) {
                Mail::Send(
                $id_lang,
                'anonimize_confirm_customer',
                $this->l('Your account is anonymous'),
                $template_vars,
                $mail,
                null,
                $configuration['PS_SHOP_EMAIL'],
                $configuration['PS_SHOP_NAME'],
                null,
                null,
                $dir_mail,
                null,
                Context::getContext()->shop->id
            );
            }
        } elseif ($template == _USER_ANONIMIZE_REQUEST_) {
            $template_vars = array();
            $template_vars['{CUSTOMER}'] = '';
            if (Context::getContext()->customer->id) {
                $c = new Customer();
                $customer = $c->id.': '.$c->firstname.' '.$c->lastname.' '.$c->email;
                $template_vars['{CUSTOMER}'] = $customer;
            }

            if (Configuration::get('PMCG_ADMIN_EMAIL') != '' && $configuration['PMCG_NOTIFI_ANONIMIZE_ADMIN']) {
                Mail::Send(
                $id_lang,
                'anonimize_request_admin',
                $this->l('New request - anonimize account'),
                $template_vars,
                Configuration::get('PMCG_ADMIN_EMAIL'),
                null,
                $configuration['PS_SHOP_EMAIL'],
                $configuration['PS_SHOP_NAME'],
                null,
                null,
                $dir_mail,
                null,
                Context::getContext()->shop->id
            );
            }

            if ($configuration['PMCG_NOTIFI_ANONIMIZE_CUSTOMER']) {
                Mail::Send(
                $id_lang,
                'anonimize_request_customer',
                $this->l('You send anonimize data request'),
                $template_vars,
                $mail,
                null,
                $configuration['PS_SHOP_EMAIL'],
                $configuration['PS_SHOP_NAME'],
                null,
                null,
                $dir_mail,
                null,
                Context::getContext()->shop->id
            );
            }
        } elseif ($template == _USER_REMOVE_REQUEST_) {
            $template_vars = array();
            $template_vars['{CUSTOMER}'] = '';
            if (Context::getContext()->customer->id) {
                $c = new Customer();
                $customer = $c->id.': '.$c->firstname.' '.$c->lastname.' '.$c->email;
                $template_vars['{CUSTOMER}'] = $customer;
            }
            if ($configuration['PMCG_NOTIFI_REMOVE_ADMIN'] && Configuration::get('PMCG_ADMIN_EMAIL') != '') {
                Mail::Send(
                $id_lang,
                'remove_request_admin',
                $this->l('New request - remove account'),
                $template_vars,
                Configuration::get('PMCG_ADMIN_EMAIL'),
                null,
                $configuration['PS_SHOP_EMAIL'],
                $configuration['PS_SHOP_NAME'],
                null,
                null,
                $dir_mail,
                null,
                Context::getContext()->shop->id
            );
            }

            if ($configuration['PMCG_NOTIFI_REMOVE_CUSTOMER']) {
                Mail::Send(
                $id_lang,
                'remove_request_customer',
                $this->l('You send remove data request'),
                $template_vars,
                $mail,
                null,
                $configuration['PS_SHOP_EMAIL'],
                $configuration['PS_SHOP_NAME'],
                null,
                null,
                $dir_mail,
                null,
                Context::getContext()->shop->id
            );
            }
        }
    }

    public function anonimizeAccount($id_customer, $id_pmcvg_process)
    {
        $c = new Customer($id_customer);
        if ($c->id) {
            $sql = 'SELECT c.id_customer, c.id_gender, c.company, c.firstname, c.lastname, c.email, c.birthday, c.newsletter, c.newsletter_date_add, c.website, c.date_add, c.date_upd, c.ip_registration_newsletter,  a.company, a.firstname, a.lastname, a.address1, a.address2, a.postcode, a.city, a.other, a.phone, a.phone_mobile, a.vat_number,dni, a.date_add, a.date_upd,l.name as country FROM `'._DB_PREFIX_.'customer` c JOIN `'._DB_PREFIX_.'address` a ON a.id_customer = c.id_customer 
                JOIN `'._DB_PREFIX_.'country_lang` l ON l.id_country = a.id_country AND l.id_lang = '.(int)Context::getContext()->language->id .'
                WHERE  c.id_customer = '.(int)$id_customer;
            $csv = Db::getInstance()->executeS($sql);
            if (sizeof($csv)) {
                $out = fopen(dirname(__FILE__).'/tmp/'.$id_customer, 'w');
                fputcsv($out, array_keys($csv[0]));
                foreach ($csv as $item) {
                    fputcsv($out, $item);
                }
                fclose($out);
            }
            if ((int)$id_customer) {
                $c = new Customer($id_customer);
                $this->sendMail($c->email, _ANONIMIZE_ACCOUNT_, $c->id_lang);
                $c->firstname = $this->l('Anonymous');
                $c->lastname = $this->l('Anonymous');
                $c->company = $this->l('Anonymous');
                $c->birthday = '0000-00-00';
                $c->update();
                $sql = 'UPDATE `'._DB_PREFIX_.'address`
                SET alias = "'.$this->l('Anonymous').'",
                company = "'.$this->l('Anonymous').'",
                lastname = "'.$this->l('Anonymous').'",
                firstname = "'.$this->l('Anonymous').'",
                address1 = "'.$this->l('Anonymous').'",
                address2 = "'.$this->l('Anonymous').'",
                postcode = "00-000",
                city = "'.$this->l('Anonymous').'",
                other = "'.$this->l('Anonymous').'",
                phone = "'.$this->l('000000000').'",
                phone_mobile = "'.$this->l('Anonymous').'",
                vat_number = "'.$this->l('Anonymous').'",
                dni = "'.$this->l('Anonymous').'",
                phone_mobile = "000000"
                WHERE id_customer = '.(int)$id_customer;

                Db::getInstance()->execute($sql);
                $log = $this->l('User data anonimized');
                $this->addProcessLog($c->id, $log, $id_pmcvg_process);

                return true;
            }
            return false;
        }
        return false;
    }

    public function generateFormGlobal()
    {
        return array(
            'form' => array(
                'legend' => array(
                'title' => $this->l('Global settings'),
                'icon' => 'icon-cogs',
                ),
                'input' => array(
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Remove customer, order, cart'),
                        'name' => 'PMCG_REMOVE_TYPE',
                        'desc' => $this->l('If "Active" - Delete all data from database, If Not active move order to customer id: ').$this->getIdDeleted(),
                        'is_bool' => true,
                        'shop' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Redirect to my consents'),
                        'name' => 'PMCG_REDIRECT',
                        'desc' => $this->l('If the customer has not agreed, redirect to my consents'),
                        'is_bool' => true,
                        'shop' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Always show all required consents on order page'),
                        'name' => 'PMCG_ALL_CONSENTS',
                        'is_bool' => true,
                        'shop' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('E-Mail to notification'),
                        'name' => 'PMCG_ADMIN_EMAIL',
                        'shop' => false,
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );
    }

    public function generateFormEmail()
    {
        return array(
            'form' => array(
                'legend' => array(
                'title' => $this->l('Email settings'),
                'icon' => 'icon-cogs',
                ),
                'input' => array(
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Send anonimize request notification to customer'),
                        'name' => 'PMCG_NOTIFI_ANONIMIZE_CUSTOMER',
                        'is_bool' => true,
                        'shop' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Send anonimize request notification to administrator'),
                        'name' => 'PMCG_NOTIFI_ANONIMIZE_ADMIN',
                        'is_bool' => true,
                        'shop' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Send anonimize confirmation to customer'),
                        'name' => 'PMCG_NOTIFI_ANONIMIZE_CONF_CUSTOMER',
                        'is_bool' => true,
                        'shop' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Send remove account notification to customer'),
                        'name' => 'PMCG_NOTIFI_REMOVE_CUSTOMER',
                        'is_bool' => true,
                        'shop' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Send remove account request notification to administrator'),
                        'name' => 'PMCG_NOTIFI_REMOVE_ADMIN',
                        'is_bool' => true,
                        'shop' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Send remove account request confirmation to customer'),
                        'name' => 'PMCG_NOTIFI_REMOVE_CONF_CUSTOMER',
                        'is_bool' => true,
                        'shop' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => true,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => false,
                                'label' => $this->l('Disabled')
                            )
                        ),
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                ),
            ),
        );
    }

    public function formGlobal()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitRodoueModule';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            .'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = array(
            'fields_value' => $this->generateFormGlobalValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        return $helper->generateForm(array($this->generateFormGlobal()));
    }

    public function formEmail()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitRodoueModule';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            .'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = array(
            'fields_value' => $this->generateFormEmailValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        );

        return $helper->generateForm(array($this->generateFormEmail()));
    }

    public function generateFormGlobalValues()
    {
        $config = array();
        $config['PMCG_ADMIN_NOTIFICATION'] = Configuration::get('PMCG_ADMIN_NOTIFICATION');
        $config['PMCG_REMOVE_TYPE'] = Configuration::get('PMCG_REMOVE_TYPE');
        $config['PMCG_REDIRECT'] = Configuration::get('PMCG_REDIRECT');
        $config['PMCG_ALL_CONSENTS'] = Configuration::get('PMCG_ALL_CONSENTS');
        $config['PMCG_ADMIN_EMAIL'] = Configuration::get('PMCG_ADMIN_EMAIL');
        return $config;
    }

    public function generateFormEmailValues()
    {
        $config = array();
        
        $config['PMCG_NOTIFI_ANONIMIZE_CUSTOMER'] = Configuration::get('PMCG_NOTIFI_ANONIMIZE_CUSTOMER');
        $config['PMCG_NOTIFI_ANONIMIZE_ADMIN'] = Configuration::get('PMCG_NOTIFI_ANONIMIZE_ADMIN');
        $config['PMCG_NOTIFI_ANONIMIZE_CONF_CUSTOMER'] = Configuration::get('PMCG_NOTIFI_ANONIMIZE_CONF_CUSTOMER');
        $config['PMCG_NOTIFI_REMOVE_CUSTOMER'] = Configuration::get('PMCG_NOTIFI_REMOVE_CUSTOMER');
        $config['PMCG_NOTIFI_REMOVE_ADMIN'] = Configuration::get('PMCG_NOTIFI_REMOVE_ADMIN');
        $config['PMCG_NOTIFI_REMOVE_CONF_CUSTOMER'] = Configuration::get('PMCG_NOTIFI_REMOVE_CONF_CUSTOMER');
        return $config;
    }
}
