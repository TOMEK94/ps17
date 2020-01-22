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
        
class AdminConditionsController extends AdminController
{
    public $bootstrap = true ;
    
    
    public function __construct()
    {
        $this->table = 'pmcvg';
        $this->className = 'ConditionsModel';
        $this->addRowAction('edit');
        $this->addRowAction('delete');
        $this->id_lang = Configuration::get('PS_LANG_DEFAULT');
        $this->_select = 'l.*';
        $this->_join = '
                JOIN `'._DB_PREFIX_.'pmcvg_lang` l 
                ON (l.id_pmcvg = a.id_pmcvg
                AND l.id_lang = '.$this->id_lang.'
                AND l.id_shop = '.(int)Context::getContext()->shop->id.')

                LEFT JOIN `'._DB_PREFIX_.'pmcvg_shop` s ON (s.id_pmcvg = a.id_pmcvg AND s.id_shop = '.(int)Context::getContext()->shop->id.')';


        $this->context = Context::getContext();
        $module = Module::getInstanceByName('pmcvg');
        $this->page_options = $module->getPageOptions();
        parent::__construct();
        $this->fields_list = array(
                'id_'.$this->table => array(
                        'title' => $this->l('ID'),
                        'align' => 'left',
                        'width' => 25
                ),
                'text' => array(
                        'title' => $this->l('Text'),
                        'align' => 'left',
                        'width' => 100,
                        'filter_key' => 'l!text',
                        'callback' => 'trimdescription'
                ),
                'page' => array(
                        'title' => $this->l('Page'),
                        'align' => 'left',
                        'width' => 100,
                        'callback' => 'pagecallback'
                ),
                'active' => array(
                        'title' => $this->l('Active'),
                        'align' => 'left',
                        'width' => 100,
                        'active' => 'status',
                        'filter_key' => '!active',
                ),
        );
    }
            
    public function renderForm()
    {
        $module = Module::getInstanceByName('pmcvg');
        $page_options = $module->getPageOptions();
        $pages_opt_group = array();
        foreach ($page_options as $item) {
            $pages_opt_group[] = array('id_group' => $item['id'], 'name' => $item['name']);
        }
        if (!($obj = $this->loadObject(true))) {
            return;
        }

        $this->fields_form = array(
                'tinymce' => true,
                'input' => array(
                    array(
                            'type' => 'textarea',
                            'label' => $this->l('Text'),
                            'name'  => 'text',
                            'required' => true,
                            'lang' => true,
                            'autoload_rte' => true,
                    ),

                    array(
                        'type' => 'group',
                        'label' => $this->l('Page'),
                        'name' => 'page',
                        'values' => $pages_opt_group,
                        'required' => true,
                        'col' => '6',
                        'hint' => $this->l('Select all the groups that you would like to apply to this customer.')
                    ),
                    array(
                            'type'  => 'switch',
                            'label' => $this->l('Required'),
                            'name'  => 'required',
                            'required' => true,
                            'values' =>
                        array(                                   // This is only useful if type == radio
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('Disabled')
                                )
                            )
                    ),
                    array(
                            'type'  => 'switch',
                            'label' => $this->l('Active'),
                            'name'  => 'active',
                            'required' => true,
                            'values' =>
                        array(                                   // This is only useful if type == radio
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Enabled')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('Disabled')
                                )
                            )
                    ),
                )
        );
        $p = explode(',',$obj->page);
        for($i = 1 ; $i <= 5 ; $i++) {
            $this->fields_value['groupBox_'.$i] = 0;
        }
        if (sizeof($p)) {
            foreach ($p as $item) {
                $this->fields_value['groupBox_'.$item] = 1;
            }
        }

        $this->fields_form['submit'] = array(
                'title' => $this->l('Save'),
                'class' => 'button pull-right'
        );
    
        if (Shop::isFeatureActive()) {
            $this->fields_form['input'][] = array(
                'type' => 'shop',
                'label' => $this->l('Shop association'),
                'name' => 'checkBoxShopAsso',
            );
        }
    
        if (!($obj = $this->loadObject(true))) {
            return;
        }
    
        return parent::renderForm();
    }

    public function trimdescription($t, $r)
    {
        return strip_tags($t);
    }

    public function pagecallback($t, $r)
    {
        $html = '';
        if ($t != '') {
            $arr = explode(',', $t);
            if (sizeof($arr))
            foreach ($arr as $item) {
                $html .= $this->page_options[$item]['name'].'<br/>';
            }
        }
        return $html;
    }

    public function postProcess() {
        parent::postProcess();
        if (Tools::isSubmit('submitAddpmcvg')) {
            if (!($obj = $this->loadObject(true)) || !$obj->id) {
                return;
            }
            $obj->page = implode(',',Tools::getValue('groupBox'));
            $obj->save();
        }
    }
}
