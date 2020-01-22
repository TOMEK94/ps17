<?php
/**
* 2007-2018 PrestaShop
*
* Jms Adv Search
*
*  @author    Joommasters <joommasters@gmail.com>
*  @copyright 2007-2018 Joommasters
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: http://www.joommasters.com
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

use PrestaShop\PrestaShop\Core\Module\WidgetInterface;
use PrestaShop\PrestaShop\Adapter\Category\CategoryProductSearchProvider;
use PrestaShop\PrestaShop\Adapter\Image\ImageRetriever;
use PrestaShop\PrestaShop\Adapter\Product\PriceFormatter;
use PrestaShop\PrestaShop\Core\Product\ProductListingPresenter;
use PrestaShop\PrestaShop\Adapter\Product\ProductColorsRetriever;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchContext;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery;
use PrestaShop\PrestaShop\Core\Product\Search\SortOrder;

class JmsAdvSearch extends Module implements WidgetInterface
{
    private $_html = '';
    private $_postErrors = array();

    public function __construct()
    {
        $this->name = 'jmsadvsearch';
        $this->tab = 'front_office_features';
        $this->version = '2.0.0';
        $this->author = 'Joommasters';
        $this->need_instance = 0;
        $this->morecharacter = $this->l('Please enter at least 3 characters');
        $this->no_products = $this->l('There is no product');
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('JMS Adv Search');
        $this->description = $this->l('Adv Search module');
    }

    public function install()
    {
        $res = true;
        if (parent::install() && $this->registerHook('header')) {
            $res &= Configuration::updateValue('JMS_ADVSEARCH_COUNT', 5);
            $res &= Configuration::updateValue('JMS_ADVSEARCH_SHOW_DESC', 0);
            $res &= Configuration::updateValue('JMS_ADVSEARCH_DESC_COUNT', 100);
            $res &= Configuration::updateValue('JMS_ADVSEARCH_SHOW_PRICE', 1);
            $res &= Configuration::updateValue('JMS_ADVSEARCH_SHOW_IMAGE', 1);
            $res &= Configuration::updateValue('JMS_ADVSEARCH_LEVEL_CATEGORIES', 5);
            $res &= Configuration::updateValue('JMS_ADVSEARCH_CATEG_SORT', 1);
            $res &= Configuration::updateValue('JMS_ADVSEARCH_CATEG_SORT_WAY', 1);
            $res &= Configuration::updateValue('JMS_ADVSEARCH_NUM_PRODUCT', 1);
            return $res;
        }
        return false;
    }
    public function uninstall()
    {
        /* Deletes Module */
        $res = true;
        if (parent::uninstall()) {
            /* Unsets configuration */
            $res &= Configuration::deleteByName('JMS_ADVSEARCH_COUNT');
            $res &= Configuration::deleteByName('JMS_ADVSEARCH_SHOW_DESC');
            $res &= Configuration::deleteByName('JMS_ADVSEARCH_DESC_COUNT');
            $res &= Configuration::deleteByName('JMS_ADVSEARCH_SHOW_PRICE');
            $res &= Configuration::deleteByName('JMS_ADVSEARCH_SHOW_IMAGE');

            $res &= Configuration::deleteByName('JMS_ADVSEARCH_LEVEL_CATEGORIES');
            $res &= Configuration::deleteByName('JMS_ADVSEARCH_CATEG_SORT');
            $res &= Configuration::deleteByName('JMS_ADVSEARCH_CATEG_SORT_WAY');
            $res &= Configuration::deleteByName('JMS_ADVSEARCH_NUM_PRODUCT');
            return (bool)$res;
        }

        return false;
    }
    public function getContent()
    {
        $errors = array();
        $output = '';
        if (Tools::isSubmit('submitConfig')) {
            $count = (int)(Tools::getValue('JMS_ADVSEARCH_COUNT'));
            if (!$count || $count <= 0 || !Validate::isInt($count)) {
                $errors[] = $this->l('An invalid number of products has been specified.');
            } else {
                Configuration::updateValue('JMS_ADVSEARCH_COUNT', (int)(Tools::getValue('JMS_ADVSEARCH_COUNT')));
                Configuration::updateValue('JMS_ADVSEARCH_SHOW_DESC', (int)(Tools::getValue('JMS_ADVSEARCH_SHOW_DESC')));
                Configuration::updateValue('JMS_ADVSEARCH_DESC_COUNT', (int)(Tools::getValue('JMS_ADVSEARCH_DESC_COUNT')));
                Configuration::updateValue('JMS_ADVSEARCH_SHOW_PRICE', (int)(Tools::getValue('JMS_ADVSEARCH_SHOW_PRICE')));
                Configuration::updateValue('JMS_ADVSEARCH_SHOW_IMAGE', (int)(Tools::getValue('JMS_ADVSEARCH_SHOW_IMAGE')));
                Configuration::updateValue('JMS_ADVSEARCH_LEVEL_CATEGORIES', (int)(Tools::getValue('JMS_ADVSEARCH_LEVEL_CATEGORIES')));
                Configuration::updateValue('JMS_ADVSEARCH_CATEG_SORT', (int)(Tools::getValue('JMS_ADVSEARCH_CATEG_SORT')));
                Configuration::updateValue('JMS_ADVSEARCH_CATEG_SORT_WAY', (int)(Tools::getValue('JMS_ADVSEARCH_CATEG_SORT_WAY')));
                Configuration::updateValue('JMS_ADVSEARCH_NUM_PRODUCT', (int)(Tools::getValue('JMS_ADVSEARCH_NUM_PRODUCT')));
            }

            if (isset($errors) && count($errors)) {
                $output .= $this->displayError(implode('<br />', $errors));
            } else {
                $output .= $this->displayConfirmation($this->l('Your settings have been updated.'));
            }
        }
        return $output.$this->displayForm();
    }

    public function displayForm()
    {
        $fields_form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Settings'),
                    'icon' => 'icon-cogs'
                ),
                'tabs' => array('search' => 'Dropdown Search Result Setting','select'=>'Categories Select Box Setting'),
                'input' => array(
                    array(
                        'type' => 'text',
                        'label' => $this->l('Number of products to be displayed'),
                        'name' => 'JMS_ADVSEARCH_COUNT',
						'class' => 'fixed-width-xl',
                        'tab' => 'search',
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Show Description'),
                        'name' => 'JMS_ADVSEARCH_SHOW_DESC',
                        'is_bool' => true,
                        'tab' => 'search',
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        ),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Description character limit'),
                        'name' => 'JMS_ADVSEARCH_DESC_COUNT',
						'class' => 'fixed-width-xl',
                        'tab' => 'search'
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Show Price'),
                        'name' => 'JMS_ADVSEARCH_SHOW_PRICE',
                        'tab' => 'search',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        ),
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Show Image'),
                        'name' => 'JMS_ADVSEARCH_SHOW_IMAGE',
                        'tab' => 'search',
                        'is_bool' => true,
                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        ),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Level categories'),
                        'name' => 'JMS_ADVSEARCH_LEVEL_CATEGORIES',
                        'tab' => 'select',
						'class' => 'fixed-width-xl'
                    ),
                    array(
                        'type' => 'switch',
                        'label' => $this->l('Show Number Product'),
                        'name' => 'JMS_ADVSEARCH_NUM_PRODUCT',
                        'desc' => $this->l('show number product in that category.'),
                        'tab' => 'select',
                        'values' => array(
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
                                ),
                    ),
                    array(
                        'type' => 'radio',
                        'label' => $this->l('Sort'),
                        'name' => 'JMS_ADVSEARCH_CATEG_SORT',
                        'tab' => 'select',
                        'values' => array(
                            array(
                                'id' => 'name',
                                'value' => 1,
                                'label' => $this->l('By name')
                            ),
                            array(
                                'id' => 'position',
                                'value' => 0,
                                'label' => $this->l('By position')
                            ),
                        )
                    ),
                    array(
                        'type' => 'radio',
                        'label' => $this->l('Sort order'),
                        'name' => 'JMS_ADVSEARCH_CATEG_SORT_WAY',
                        'tab' => 'select',
                        'values' => array(
                            array(
                                'id' => 'name',
                                'value' => 1,
                                'label' => $this->l('Descending')
                            ),
                            array(
                                'id' => 'position',
                                'value' => 0,
                                'label' => $this->l('Ascending')
                            ),
                        )
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                )
            ),
        );

        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $this->fields_form = array();
        $helper->module = $this;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitConfig';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $language = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->tpl_vars = array(
            'base_url' => $this->context->shop->getBaseURL(),
            'language' => array(
                'id_lang' => $language->id,
                'iso_code' => $language->iso_code
            ),
            'fields_value' => $this->getAddFieldsValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
            'image_baseurl' => $this->_path.'views/img/'
        );
        $helper->override_folder = '/';
        return $helper->generateForm(array($fields_form));
    }
    public function getAddFieldsValues()
    {
        return array(
            'JMS_ADVSEARCH_COUNT' => Configuration::get('JMS_ADVSEARCH_COUNT'),
            'JMS_ADVSEARCH_SHOW_DESC' => Configuration::get('JMS_ADVSEARCH_SHOW_DESC'),
            'JMS_ADVSEARCH_DESC_COUNT' => Configuration::get('JMS_ADVSEARCH_DESC_COUNT'),
            'JMS_ADVSEARCH_SHOW_PRICE' => Configuration::get('JMS_ADVSEARCH_SHOW_PRICE'),
            'JMS_ADVSEARCH_SHOW_IMAGE' => Configuration::get('JMS_ADVSEARCH_SHOW_IMAGE'),

            'JMS_ADVSEARCH_LEVEL_CATEGORIES' => Configuration::get('JMS_ADVSEARCH_LEVEL_CATEGORIES'),
            'JMS_ADVSEARCH_CATEG_SORT' => Configuration::get('JMS_ADVSEARCH_CATEG_SORT'),
            'JMS_ADVSEARCH_CATEG_SORT_WAY' => Configuration::get('JMS_ADVSEARCH_CATEG_SORT_WAY'),
            'JMS_ADVSEARCH_NUM_PRODUCT' => Configuration::get('JMS_ADVSEARCH_NUM_PRODUCT'),
        );
    }
    public function hookDisplayHeader()
    {
        $this->context->controller->addJS(($this->_path).'views/js/advsearch.js', 'all');
        $this->context->controller->addCSS(($this->_path).'views/css/style.css', 'all');
    }
    public function getWidgetVariables($hookName = null, array $configuration = [])
    {
        $category = new Category((int)Configuration::get('PS_HOME_CATEGORY'), $this->context->language->id);
        $max_depth = Configuration::get('JMS_ADVSEARCH_LEVEL_CATEGORIES');
        $result_ids = array();
        $result_parents = array();
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
        SELECT c.id_parent, c.id_category, cl.name, cl.description, cl.link_rewrite, c.level_depth
        FROM `'._DB_PREFIX_.'category` c
        INNER JOIN `'._DB_PREFIX_.'category_lang` cl ON (c.`id_category` = cl.`id_category` AND cl.`id_lang` = '.(int)$this->context->language->id.Shop::addSqlRestrictionOnLang('cl').')
        INNER JOIN `'._DB_PREFIX_.'category_shop` cs ON (cs.`id_category` = c.`id_category` AND cs.`id_shop` = '.(int)$this->context->shop->id.')
        WHERE (c.`active` = 1 OR c.`id_category` = '.(int)Configuration::get('PS_HOME_CATEGORY').')
        AND c.`id_category` != '.(int)Configuration::get('PS_ROOT_CATEGORY').'
        '.((int)$max_depth != 0 ? ' AND `level_depth` <= '.(int)$max_depth : '').'
        AND c.id_category IN (
            SELECT id_category
            FROM `'._DB_PREFIX_.'category_group`
            WHERE `id_group` IN ('.pSQL(implode(', ', Customer::getGroupsStatic((int)$this->context->customer->id))).')
        )
        ORDER BY `level_depth` ASC, '.(Configuration::get('JMS_ADVSEARCH_CATEG_SORT') ? 'cl.`name`' : 'cs.`position`').' '.(Configuration::get('JMS_ADVSEARCH_CATEG_SORT_WAY') ? 'DESC' : 'ASC'));
        foreach ($result as &$row) {
            $result_parents[$row['id_parent']][] = &$row;
            $result_ids[$row['id_category']] = &$row;
        }

        $jms_categ_tree = $this->getTree($result_parents, $result_ids, $max_depth, ($category ? $category->id : null));
        $this->smarty->assign('jmsCategTree', $jms_categ_tree);
        $this->context->controller->addCSS(($this->_path).'views/css/style.css', 'all');

        return [
            'root_url' => $this->getUrl(),
            'link' => $this->context->link,
            
            'branche_tpl_path' => _PS_MODULE_DIR_.'/jmsadvsearch/views/templates/hook/category-tree-branch.tpl',
            'number' => Configuration::get('JMS_ADVSEARCH_NUM_PRODUCT'),
        ];
    }

    public function renderWidget($hookName = null, array $configuration = [])
    {
        $this->smarty->assign($this->getWidgetVariables($hookName, $configuration));

        return $this->display(
            __FILE__,
            'views/templates/hook/jmsadvsearch.tpl',
            $this->getCacheId('jmsadvsearch')
        );
    }

    public function searchProductCategories($id_categories, $id_lang, $query, Context $context = null)
    {
        if (!$context) {
            $context = Context::getContext();
        }

        $sql = new DbQuery();
        $sql->select('p.`id_product`, pl.`name`, p.`ean13`, p.`upc`, p.`active`, p.`reference`, m.`name` AS manufacturer_name, stock.`quantity`, product_shop.advanced_stock_management, p.`customizable`');
        $sql->from('category_product', 'cp');
        $sql->leftJoin('product', 'p', 'p.`id_product` = cp.`id_product`');
        $sql->join(Shop::addSqlAssociation('product', 'p'));
        $sql->leftJoin('product_lang', 'pl', 'p.`id_product` = pl.`id_product` AND pl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang('pl'));
        $sql->leftJoin('manufacturer', 'm', 'm.`id_manufacturer` = p.`id_manufacturer`');
        $where = '';
        if ($id_categories) {
            $where .= ' cp.id_category = '.$id_categories.' AND ';
        }
        $where .= '(pl.`name` LIKE \'%'.pSQL($query).'%\'
        OR p.`ean13` LIKE \'%'.pSQL($query).'%\'
        OR p.`upc` LIKE \'%'.pSQL($query).'%\'
        OR p.`reference` LIKE \'%'.pSQL($query).'%\'
        OR p.`supplier_reference` LIKE \'%'.pSQL($query).'%\'
        OR  p.`id_product` IN (SELECT id_product FROM '._DB_PREFIX_.'product_supplier sp WHERE `product_supplier_reference` LIKE \'%'.pSQL($query).'%\')
        )';
        $sql->groupBy('`id_product`');
        $sql->orderBy('pl.`name` ASC');

        if (Combination::isFeatureActive()) {
            $sql->leftJoin('product_attribute', 'pa', 'pa.`id_product` = p.`id_product`');
            $sql->join(Shop::addSqlAssociation('product_attribute', 'pa', false));
            $where .= ' OR pa.`reference` LIKE \'%'.pSQL($query).'%\' OR pa.`ean13` LIKE \'%'.pSQL($query).'%\'';
        }
        $sql->where($where);
        $sql->join(Product::sqlStock('p', 'pa', false, $context->shop));

        $result = Db::getInstance()->executeS($sql);

        if (!$result) {
            return false;
        }

        $results_array = array();
        foreach ($result as $row) {
            $row['price_tax_incl'] = Product::getPriceStatic($row['id_product'], true, null, 2);
            $row['price_tax_excl'] = Product::getPriceStatic($row['id_product'], false, null, 2);
            $results_array[] = $row;
        }
        return $results_array;
    }

    public function returnSearch($result)
    {

        $assembler = new ProductAssembler($this->context);

        $presenterFactory = new ProductPresenterFactory($this->context);
        $presentationSettings = $presenterFactory->getPresentationSettings();
        $presenter = new ProductListingPresenter(
            new ImageRetriever(
                $this->context->link
            ),
            $this->context->link,
            new PriceFormatter(),
            new ProductColorsRetriever(),
            $this->context->getTranslator()
        );

        $products_for_template = [];

        foreach ($result as $rawProduct) {
            $products_for_template[] = $presenter->present(
                $presentationSettings,
                $assembler->assembleProduct($rawProduct),
                $this->context->language
            );
        }

        return $products_for_template;
    }
    public function getTree($result_parents, $result_ids, $max_depth, $id_category = null, $current_depth = 0)
    {
        if (is_null($id_category)) {
            $id_category = $this->context->shop->getCategory();
        }
        $children = array();
        if (isset($result_parents[$id_category]) && count($result_parents[$id_category]) && ($max_depth == 0 || $current_depth < $max_depth)) {
            foreach ($result_parents[$id_category] as $subcat) {
                $children[] = $this->getTree($result_parents, $result_ids, $max_depth, $subcat['id_category'], $current_depth + 1);
            }
        }
        if (!isset($result_ids[$id_category])) {
            return false;
        }
        $numberProduct = $this->getProduct($id_category);
        $return = array(
            'id' => $id_category,
            'link' => $this->context->link->getCategoryLink($id_category, $result_ids[$id_category]['link_rewrite']),
            'name' =>  $result_ids[$id_category]['name'],
            'desc'=>  $result_ids[$id_category]['description'],
            'children' => $children,
            'level_depth' => $result_ids[$id_category]['level_depth'],
            'numberproduct' => $numberProduct,
        );
        return $return;
    }
    public function getUrl()
    {
        $force_ssl = Configuration::get('PS_SSL_ENABLED') && Configuration::get('PS_SSL_ENABLED_EVERYWHERE');
        $protocol_link = (Configuration::get('PS_SSL_ENABLED') || Tools::usingSecureMode()) ? 'https://' : 'http://';

        if (isset($force_ssl) && $force_ssl) {
            return $protocol_link.Tools::getShopDomainSsl().__PS_BASE_URI__;
        } else {
            return _PS_BASE_URL_.__PS_BASE_URI__;
        }
    }
    public function getProduct($id_category)
    {
        $category = new Category($id_category, 1);
        $product_count = $category->getProducts(1, 1, 10000, null, null, true);
        return $product_count;
    }
}
