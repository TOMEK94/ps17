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
        
class AdminRemoveController extends AdminController
{
    public $bootstrap = true ;
    
    
    public function __construct()
    {
        parent::__construct();
    }
            
    public function initContent() {
        $this->content = Context::getContext()->smarty->fetch(dirname(__FILE__).'/../../views/templates/admin/remove.tpl');
    	parent::initContent();
    }

    public function postProcess() {
    	if (Tools::isSubmit('customer_id')) {
    		$c = new Customer((int)Tools::getValue('customer_id'));
    		if (!(int)$c->id) {
    			$this->errors[] = $this->l('The customer can not be found with id: ').(int)Tools::getValue('customer_id');
    		} else {
    			$m = Module::getInstanceByName('pmcvg');
    			if ($m->removeCustomer((int)Tools::getValue('customer_id'), 0)) {
    				$this->confirmations[] = $this->l('Customer removed correctly');
    			}
    		}
    	}
    }
}
