<?php
/**
* 2014 Presta-Mod.pl
*
* NOTICE OF LICENSE
*
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
*  @author    2014-2014 Presta Mod prestamod biuro@presta-mod.pl presta-mod.pl 
*  @copyright biuro@presta-mod.pl
*  @license   GNU http://gnu.org.pl/text/licencja-gnu.html
*  International Registered Trademark & Property of PrestaShop SA
*/

require_once dirname(__FILE__).'/../../src/Terms.php';
        
class AdminNotificationController extends AdminController
{
    public $bootstrap = true ;
    
    
    public function __construct()
    {
        $this->table = 'pmcvg_process';
        $this->className = 'ProcessModelCvg';
        $this->addRowAction('view');
        $this->id_lang = Configuration::get('PS_LANG_DEFAULT');
        parent::__construct();

        $this->context = Context::getContext();
        $module = Module::getInstanceByName('pmcvg');
        $this->page_options = $module->getPageOptions();
        $this->_select = 'c.*,a.id_customer AS aid_customer';
        $this->_join = ' LEFT OUTER JOIN `'._DB_PREFIX_.'customer` c ON c.id_customer = a.id_customer';
        $list = array();
        for ($i = 1 ; $i < 5 ; $i++) {
            $list[$i] = $this->statuscallback($i);
        }
        $this->fields_list = array(
                'id_'.$this->table => array(
                        'title' => $this->l('ID'),
                        'align' => 'left',
                        'width' => 25
                ),
                'aid_customer' => array(
                        'title' => $this->l('Id customer'),
                        'align' => 'left',
                        'width' => 100,
                ),
                'firstname' => array(
                        'title' => $this->l('First name'),
                        'align' => 'left',
                        'width' => 100,
                ),
                'lastname' => array(
                        'title' => $this->l('Last name'),
                        'align' => 'left',
                        'width' => 100,
                ),
                'status' => array(
                        'title' => $this->l('Status'),
                        'align' => 'left',
                        'type' => 'select',
                        'filter_type' => 'int',
                        'list' => $list,
                        'filter_key' => 'status',
                        'callback' => 'statuscallback'
                ),
        );        
    }
    
    public function statuscallback($t, $r = array())
    {
        if ($t == '1') {
            return $this->l('Request - remove account');
        } elseif ($t == '2') {
            return $this->l('Request - anonimize data');
        } elseif ($t == '3') {
            return $this->l('Account deleted');
        } elseif ($t == '4') {
            return $this->l('Data Anonimized');
        }
    }

    public function renderView()
    {
        if (!($obj = $this->loadObject(true))) {
            return;
        }
        $c = new Customer($obj->id_customer);
        
        $sql = 'SELECT * FROM `'._DB_PREFIX_.'address` WHERE id_customer = '.(int)$obj->id_customer;
        $addresses = Db::getInstance()->executeS($sql);
        $this->context->smarty->assign('object', $obj);
        $this->context->smarty->assign('customer', $c);
        $this->context->smarty->assign('addresses', $addresses);
        if (Tools::isSubmit('file')) {
            if (file_exists(dirname(__FILE__).'/../../tmp/'.$obj->id_customer)) {
                $this->context->smarty->assign('download', $obj->id_customer);
            }
        }
        return $this->context->smarty->fetch(dirname(__FILE__).'/../../views/templates/admin/notification.tpl');
    }

    public function postProcess()
    {
        parent::postProcess();
        if (!($obj = $this->loadObject(true))) {
            return;
        }
        if (Tools::isSubmit('download') && file_exists(dirname(__FILE__).'/../../tmp/'.$obj->id_customer)) {
            header("Content-Type: text/csv");
            header("Content-Disposition: attachment; filename=".$obj->id_customer.".csv");
            echo file_get_contents(dirname(__FILE__).'/../../', $obj->id_customer);
            $module = Module::getInstanceByName('pmcvg');
            $log = $this->l('Download anonimized file');
            $module->addProcessLog($obj->id_customer, $log, $obj->id);

            unlink(dirname(__FILE__).'/../../', $obj->id_customer);
            $log = $this->l('Remove anonimized file from server');
            $module->addProcessLog($obj->id_customer, $log, $obj->id);
            die();
        } elseif (Tools::isSubmit('download')) {
            Tools::redirectAdmin('?controller=AdminNotification&token='.Tools::getValue('token').'&file_not_found&id_pmcvg_process='.Tools::getValue('id_pmcvg_process').'&viewpmcvg_process');
        }
        if (Tools::isSubmit('remove_account')) {
            $module = Module::getInstanceByName('pmcvg');
            if (!$module->removeCustomer($obj->id_customer, $obj->id)) {
                $this->errors[] = $this->l('Account not exists');
            } else {
                $obj->status = 3;
                $obj->save();
            }
        } elseif (Tools::isSubmit('anonimize_account')) {
            if (!($obj = $this->loadObject(true))) {
                return;
            }
            $module = Module::getInstanceByName('pmcvg');
            $customer = new Customer($obj->id_customer);
            if (!$customer->id) {
                $this->errors[] = $this->l('Account not exists');
            } elseif (!$module->anonimizeAccount($obj->id_customer, $obj->id)) {
                $this->errors[] = $this->l('Account not exists');
            } else {
                $obj->status = 4;
                $obj->save();
                $obj->status = 4;
                $obj->save();
                Tools::redirectAdmin('?controller=AdminNotification&token='.Tools::getValue('token').'&file='.$obj->id_customer.'&id_pmcvg_process='.Tools::getValue('id_pmcvg_process').'&viewpmcvg_process');
            }
        } elseif (Tools::isSubmit('file')) {
            $this->confirmations[] = $this->l('Successfully anonimized');
        }
    }
}
