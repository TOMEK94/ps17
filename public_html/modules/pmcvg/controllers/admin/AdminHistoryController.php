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
        
class AdminHistoryController extends AdminController
{
    public $bootstrap = true ;
    
    
    public function __construct()
    {
        $this->table = 'pmcvg_customer_agreement_history';
        $this->className = 'CustomerAgreementHistoryModel';

        $this->id_lang = Configuration::get('PS_LANG_DEFAULT');
        $this->_select = 'a.id_pmcvg AS id_pmcvg2, l.*,if (l.text IS NULL,"(loading)",l.text) as text,c.firstname, c.lastname, c.email';
        $this->_join = '
                LEFT JOIN `'._DB_PREFIX_.'pmcvg_lang` l 
                ON (l.id_pmcvg = a.id_pmcvg
                AND l.id_lang = '.$this->id_lang.'
                AND l.id_shop = '.(int)Context::getContext()->shop->id.')

                LEFT JOIN `'._DB_PREFIX_.'pmcvg_shop` s ON (s.id_pmcvg = a.id_pmcvg AND s.id_shop = '.(int)Context::getContext()->shop->id.')
                LEFT JOIN `'._DB_PREFIX_.'customer` c ON c.id_customer = a.id_customer';


        $this->context = Context::getContext();
        $this->_orderBy = 'id_pmcvg_customer_agreement_history';
        $this->_orderWay = 'DESC';
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
                'date_upd' => array(
                        'title' => $this->l('Date upd'),
                        'align' => 'left',
                        'width' => 100,
                ),
                'id_customer' => array(
                    'title' => $this->l('Id customer'),
                    'align' => 'left',
                    'width' => 100,
                ),
                'firstname' => array(
                    'title' => $this->l('Firstname'),
                    'align' => 'left',
                    'width' => 100,
                ),
                'lastname' => array(
                    'title' => $this->l('Lastname'),
                    'align' => 'left',
                    'width' => 100,
                ),
                'ip' => array(
                        'title' => $this->l('Ip'),
                        'align' => 'left',
                        'width' => 100,
                ),
                'set' => array(
                        'title' => $this->l('Set'),
                        'align' => 'left',
                        'width' => 100,
                        'callback' => 'activeclb'
                ),
        );
    }
            
    public function renderForm()
    {
        $module = Module::getInstanceByName('pmcvg');
        $page_options = $module->getPageOptions();
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
                            'type' => 'select',
                            'label' => $this->l('Page'),
                            'name'  => 'page',
                            'required' => true,
                            'options' => array(
                                'query' => $page_options,
                                'id' => 'id',
                                'name' => 'name'
                            )
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

    public function activeclb($t, $r)
    {
        if ((int)$t) {
            return '<i style="color: green" class="icon-check"></i>';
        } else {
            return '<i style="color: red" class="icon-remove"></i>';
        }
    }

    public function pagecallback($t, $r)
    {
        return $this->page_options[$t]['name'];
    }

    public function trimdescription($t, $r)
    {
        if ($r['id_pmcvg2'] == -2) {
            return $this->l('Newsletter');
        }
        if ($r['id_pmcvg2'] == -1) {
            return $this->l('Optin');
        }
        return strip_tags($t);
    }
}
