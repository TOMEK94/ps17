<?php
/**
* 2007-2018 PrestaShop
*
* Jms Flash Sales
*
*  @author    Joommasters <joommasters@gmail.com>
*  @copyright 2007-2018 Joommasters
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: http://www.joommasters.com
*/

if (!defined('_PS_VERSION_'))
	exit;

use PrestaShop\PrestaShop\Core\Module\WidgetInterface;
use PrestaShop\PrestaShop\Adapter\Category\CategoryProductSearchProvider;
use PrestaShop\PrestaShop\Adapter\Image\ImageRetriever;
use PrestaShop\PrestaShop\Adapter\Product\PriceFormatter;
use PrestaShop\PrestaShop\Core\Product\ProductListingPresenter;
use PrestaShop\PrestaShop\Adapter\Product\ProductColorsRetriever;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchContext;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery;
use PrestaShop\PrestaShop\Core\Product\Search\SortOrder;
include_once(_PS_MODULE_DIR_.'jmsflashsales/JmsSaleCategory.php');
include_once(_PS_MODULE_DIR_.'jmsflashsales/JmsSaleItem.php');
class JmsFlashSales extends Module
{
	private $_html = '';
	private $_postErrors = array();

	public function __construct()
	{
		$this->name = 'jmsflashsales';
		$this->tab = 'front_office_features';
		$this->version = '1.1.0';
		$this->author = 'Joommasters';
		$this->need_instance = 0;		
		$this->secure_key = Tools::encrypt($this->name);
		$this->bootstrap = true;
		$force_ssl = Configuration::get('PS_SSL_ENABLED') && Configuration::get('PS_SSL_ENABLED_EVERYWHERE');
        $protocol_link = (Configuration::get('PS_SSL_ENABLED') || Tools::usingSecureMode()) ? 'https://' : 'http://';

        if (isset($force_ssl) && $force_ssl) {
            $this->root_url = $protocol_link.Tools::getShopDomainSsl().__PS_BASE_URI__;
        } else {
            $this->root_url = _PS_BASE_URL_.__PS_BASE_URI__;
        }
		parent::__construct();

		$this->displayName = $this->l('Jms FlashSales.');
		$this->description = $this->l('FlashSales Module for Prestashop.');
	}

	public function install()
	{
		if (parent::install() && $this->registerHook('header') && $this->registerHook('actionShopDataDuplication'))
		{
			$expire_time = date('Y-m-d h:i:s', strtotime("+230 days"));
			$res = Configuration::updateValue('JMS_FLASHSALES_EXPIRETIME', $expire_time);
			$res &= Configuration::updateValue('JMS_FLASHSALES_AUTO', 0);
			$res &= Configuration::updateValue('JMS_FLASHSALES_TOTAL', 10);
			$res &= Configuration::updateValue('JMS_FLASHSALES_ITEMS_SHOW', 4);			
			/* Creates tables */
			$res &= $this->createTables();
			if ($res)
				$this->installSamples();
			return $res;	
		}		
		return false;		
	}
	private function installSamples()
	{		
		$languages = Language::getLanguages(false);						
		$category1 = new JmsSaleCategory();						
		$category1->icon_class = '';
		foreach ($languages as $language)
		{
			$category1->title[$language['id_lang']] = 'Sale of 30%';					
		}
		$category1->add();
		$category2 = new JmsSaleCategory();						
		$category2->icon_class = '';
		foreach ($languages as $language)
		{
			$category2->title[$language['id_lang']] = 'Sale of 40%';					
		}
		$category2->add();
		$products = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT id_product
			FROM '._DB_PREFIX_.'product
			WHERE active = 1 LIMIT 0,5'
		);
		$ordering = 0;
		foreach($products as $product) {
			$item = new JmsSaleItem();			
			$item->product_id = $product['id_product'];
			$item->category_id = $category1->id;			
			$item->ordering = $ordering;
			$item->active = 1;						
			$item->add();
			$ordering++;
		}
	}
	public function uninstall()
	{
		/* Deletes Module */
		if (parent::uninstall())
		{
			/* Deletes tables */
			$res = $this->deleteTables();
			/* Unsets configuration */
			$res &= Configuration::deleteByName('JMS_FLASHSALES_EXPIRETIME');
			$res &= Configuration::deleteByName('JMS_FLASHSALES_AUTO');			
			$res &= Configuration::deleteByName('JMS_FLASHSALES_TOTAL');			
			$res &= Configuration::deleteByName('JMS_FLASHSALES_ITEMS_SHOW');	
			
			return $res;
		}
		return false;
	}
	/**
	 * Creates tables
	 */
	protected function createTables()
	{
		/* Boxs */
		$res = true;
		$res = (bool)Db::getInstance()->execute('
			CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'jmsflashsales` (
				`item_id` int(11) NOT NULL AUTO_INCREMENT,
				`id_shop` int(11) NOT NULL,
				PRIMARY KEY (`item_id`)
			) ENGINE='._MYSQL_ENGINE_.'  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
		');
		$res = (bool)Db::getInstance()->execute('
			CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'jmsflashsales_items` (
				`item_id` int(11) NOT NULL AUTO_INCREMENT,
				`product_id` int(11) NOT NULL,
				`category_id` int(11) NOT NULL,
				`ordering` int(11) NOT NULL,
				`active` tinyint(1) NOT NULL,
				PRIMARY KEY (`item_id`,`product_id`)
			) ENGINE='._MYSQL_ENGINE_.'  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
		');
		$res = (bool)Db::getInstance()->execute('
			CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'jmsflashsales_categories` (
				`category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
				`icon_class` varchar(30) NOT NULL,
				PRIMARY KEY (`category_id`)
			) ENGINE='._MYSQL_ENGINE_.'  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
		');	
		$res = (bool)Db::getInstance()->execute('
			CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'jmsflashsales_categories_lang` (
				`category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
				`id_lang` int(10) unsigned NOT NULL,
				`title` varchar(200) NOT NULL,
				PRIMARY KEY (`category_id`,`id_lang`)
			) ENGINE='._MYSQL_ENGINE_.'  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
		');
		return $res;
	}

	/**
	 * deletes tables
	 */
	protected function deleteTables()
	{
		$items = $this->getItems();		
		foreach ($items as $item)	
		{				
			$to_del = new JmsSaleItem($box['id_box']);
			$to_del->delete();
		}		
		Db::getInstance()->execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'jmsflashsales`;');
		Db::getInstance()->execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'jmsflashsales_items`;');		
		Db::getInstance()->execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'jmsflashsales_categories`;');		
		Db::getInstance()->execute('DROP TABLE IF EXISTS `'._DB_PREFIX_.'jmsflashsales_categories_lang`;');		
		return true;
	}
	
	public function getContent()
	{
		$this->_html .= $this->headerHTML();
		$this->_html .= $this->renderPathway();

		/* Validate & process */
		if (Tools::isSubmit('submitItem') || Tools::isSubmit('delete_id_item') || Tools::isSubmit('submitCategory') || Tools::isSubmit('delete_id_category') || Tools::isSubmit('submitConfig') || Tools::isSubmit('changeStatus')) {
			if ($this->_postValidation())
			{
				$this->_postProcess();				
				$this->_html .= $this->renderList();
			}
			else
				$this->_html .= $this->renderAddForm();

			$this->clearCache();
		} elseif (Tools::isSubmit('categories')) {
			$this->_html .= $this->renderListCategories();
		} elseif (Tools::isSubmit('addCategory') || (Tools::isSubmit('id_category') && $this->catExists((int)Tools::getValue('id_category')))) {
			$this->_html .= $this->renderCategoryAddForm();
		} elseif (Tools::isSubmit('addItem') || (Tools::isSubmit('id_item') && $this->itemExists((int)Tools::getValue('id_item')))) {
			$this->_html .= $this->renderAddForm();	
		} elseif (Tools::isSubmit('config')) {	
			$this->_html .= $this->renderForm();
		} else {			
			$this->_html .= $this->renderList();
		}

		return $this->_html;
	}
	
	private function _postValidation()
	{
		$errors = array();

		/* Validation for Slider configuration */
		if (Tools::isSubmit('changeStatus'))
		{
			if (!Validate::isInt(Tools::getValue('item_id')))
				$errors[] = $this->l('Invalid Item');
		}
		/* Validation for Slide */
		elseif (Tools::isSubmit('submitItem'))
		{			
			/* Checks position */
			if (!Validate::isInt(Tools::getValue('ordering')) || (Tools::getValue('ordering') < 0))
				$errors[] = $this->l('Invalid Item ordering');
			/* If edit : checks id_slide */
			if (Tools::isSubmit('item_id'))
			{					
				if (!Validate::isInt(Tools::getValue('item_id')) && !$this->itemExists(Tools::getValue('item_id')))
					$errors[] = $this->l('Invalid id_item');
				if (!Validate::isInt(Tools::getValue('product_id')) && !$this->itemExists(Tools::getValue('product_id')))
					$errors[] = $this->l('Invalid Product ID');
			}			
			
		} elseif (Tools::isSubmit('submitCategory')) {
			if (Tools::isSubmit('category_id')) {					
				if (!Validate::isInt(Tools::getValue('category_id')) && !$this->catExists(Tools::getValue('category_id')))
					$errors[] = $this->l('Invalid id_category');
			}
		} elseif (Tools::isSubmit('delete_id_item') && (!Validate::isInt(Tools::getValue('delete_id_item')) || !$this->itemExists((int)Tools::getValue('delete_id_item')))) {
			$errors[] = $this->l('Invalid id_item');
		} elseif (Tools::isSubmit('delete_id_category') && (!Validate::isInt(Tools::getValue('delete_id_category')) || !$this->catExists((int)Tools::getValue('delete_id_category'))))
			$errors[] = $this->l('Invalid id_category');
		/* Display errors if needed */
		if (count($errors))
		{
			$this->_html .= $this->displayError(implode('<br />', $errors));
			return false;
		}

		/* Returns if validation is ok */
		return true;
	}
	private function _postProcess()
	{
		$errors = array();

		/* Processes Slider */
		if (Tools::isSubmit('submitConfig'))
		{
			$res = Configuration::updateValue('JMS_FLASHSALES_EXPIRETIME', Tools::getValue('JMS_FLASHSALES_EXPIRETIME'));
			$res &= Configuration::updateValue('JMS_FLASHSALES_AUTO', (int)(Tools::getValue('JMS_FLASHSALES_AUTO')));						
			$res &= Configuration::updateValue('JMS_FLASHSALES_TOTAL', (int)(Tools::getValue('JMS_FLASHSALES_TOTAL')));						
			$res &= Configuration::updateValue('JMS_FLASHSALES_ITEMS_SHOW', (int)(Tools::getValue('JMS_FLASHSALES_ITEMS_SHOW')));									
			
			$this->clearCache();			
			if (!$res)
				$errors[] = $this->displayError($this->l('The configuration could not be updated.'));
			else
				Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', true).'&conf=6&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name.'&config=1');
		} /* Process Slide status */
		elseif (Tools::isSubmit('changeStatus') && Tools::isSubmit('id_item'))
		{
			$item = new JmsSaleItem((int)Tools::getValue('id_item'));
			if ($item->active == 0)
				$item->active = 1;
			else
				$item->active = 0;
			$res = $item->update();
			$this->clearCache();
			$this->_html .= ($res ? $this->displayConfirmation($this->l('Status updated')) : $this->displayError($this->l('Cant change status.')));
		} /* Processes item */
		elseif (Tools::isSubmit('submitItem'))
		{
			/* Sets ID if needed */			
			if (Tools::getValue('id_item'))
			{					
				$item = new JmsSaleItem((int)Tools::getValue('id_item'));
				if (!Validate::isLoadedObject($item))
				{
					$this->_html .= $this->displayError($this->l('Invalid id_item'));
					return;
				}				
			}
			else
				$item = new JmsSaleItem();			
			$item->product_id = (int)Tools::getValue('product_id');
			$item->category_id = (int)Tools::getValue('category_id');
			if(Tools::getValue('id_item'))
				$item->ordering = (int)Tools::getValue('ordering');	
			else
				$item->ordering = $this->getNextPosition();
			$item->active = (int)Tools::getValue('active');			
			
			/* Processes if no errors  */			
			if (!$errors)
			{				
				/* Adds */
				if (!Tools::getValue('id_item'))
				{
					if (!$item->add())
						$errors[] = $this->displayError($this->l('The item could not be added.'));
				}
				/* Update */
				elseif (!$item->update())
					$errors[] = $this->displayError($this->l('The item could not be updated.'));
				$this->clearCache();
			}
		} /* Deletes */
		elseif (Tools::isSubmit('submitCategory'))
		{
			/* Sets ID if needed */			
			if (Tools::getValue('id_category'))
			{					
				$category = new JmsSaleCategory((int)Tools::getValue('id_category'));
				if (!Validate::isLoadedObject($category))
				{
					$this->_html .= $this->displayError($this->l('Invalid id_category'));
					return;
				}				
			}
			else
				$category = new JmsSaleCategory();						
			$category->icon_class = Tools::getValue('icon_class');			
			$languages = Language::getLanguages(false);						
			foreach ($languages as $language)
			{
				$category->title[$language['id_lang']] = Tools::getValue('title_'.$language['id_lang']);					
			}
			/* Processes if no errors  */			
			if (!$errors)
			{				
				/* Adds */
				if (!Tools::getValue('id_category'))
				{
					if (!$category->add())
						$errors[] = $this->displayError($this->l('The category could not be added.'));
				}
				/* Update */
				elseif (!$category->update())
					$errors[] = $this->displayError($this->l('The category could not be updated.'));
				$this->clearCache();
			}
		}
		elseif (Tools::isSubmit('delete_id_item'))
		{
			$item = new JmsSaleItem((int)Tools::getValue('delete_id_item'));
			$res = $item->delete();
			$this->clearCache();
			if (!$res)
				$this->_html .= $this->displayError('Could not delete');
			else
				Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', true).'&conf=1&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name);
		}
		elseif (Tools::isSubmit('delete_id_category'))
		{
			$category = new JmsSaleCategory((int)Tools::getValue('delete_id_category'));
			$res = $category->delete();
			$this->clearCache();
			if (!$res)
				$this->_html .= $this->displayError('Could not delete');
			else
				Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', true).'&conf=1&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name.'&categories=1');
		}
		/* Display errors if needed */
		if (count($errors))
			$this->_html .= $this->displayError(implode('<br />', $errors));
		elseif (Tools::isSubmit('submitItem') && Tools::getValue('id_item'))
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', true).'&conf=4&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name);
		elseif (Tools::isSubmit('submitItem'))
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', true).'&conf=3&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name);
		elseif (Tools::isSubmit('submitCategory') && Tools::getValue('id_category'))
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', true).'&conf=4&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name.'&categories=1');	
		elseif (Tools::isSubmit('submitCategory'))
			Tools::redirectAdmin($this->context->link->getAdminLink('AdminModules', true).'&conf=3&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name.'&categories=1');
	}
	public function clearCache()
	{
		$this->_clearCache('jmsflashsales.tpl');
	}
	public function hookActionShopDataDuplication($params)
	{
		Db::getInstance()->execute('
		INSERT IGNORE INTO '._DB_PREFIX_.'jmsflashsales (item_id, id_shop)
		SELECT item_id, '.(int)$params['new_id_shop'].'
		FROM '._DB_PREFIX_.'jmsflashsales
		WHERE id_shop = '.(int)$params['old_id_shop']);
		$this->clearCache();
	}
	public function headerHTML()
	{
		if (Tools::getValue('controller') != 'AdminModules' && Tools::getValue('configure') != $this->name)
			return;

		$this->context->controller->addJqueryUI('ui.sortable');
		/* Style & js for fieldset 'slides configuration' */
		$html = '<script type="text/javascript">
			$(function() {
				var $mySlides = $("#slides");
				$mySlides.sortable({
					opacity: 0.6,
					cursor: "move",
					update: function() {
						var order = $(this).sortable("serialize") + "&action=updateItemsOrdering";
						$.post("'.$this->context->shop->physical_uri.$this->context->shop->virtual_uri.'modules/'.$this->name.'/ajax_'.$this->name.'.php?secure_key='.$this->secure_key.'", order);
						}						
					});
				$mySlides.hover(function() {
					$(this).css("cursor","move");
					},
					function() {
					$(this).css("cursor","auto");
				});
			});
		</script>';

		return $html;
	}
	
	public function getNextPosition()
	{
		$row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('
			SELECT MAX(hss.`ordering`) AS `next_position`
			FROM `'._DB_PREFIX_.'jmsflashsales_items` hss, `'._DB_PREFIX_.'jmsflashsales` hs
			WHERE hss.`item_id` = hs.`item_id` AND hs.`id_shop` = '.(int)$this->context->shop->id
		);

		return (++$row['next_position']);
	}

	public function getItems($active = null, $limit = null)
	{
		$this->context = Context::getContext();
		$id_shop = $this->context->shop->id;
		$id_lang = $this->context->language->id;
		return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT hs.`item_id` as id_item,hss.`product_id`, hss.`ordering`, hss.`active`
			FROM '._DB_PREFIX_.'jmsflashsales hs
			LEFT JOIN '._DB_PREFIX_.'jmsflashsales_items hss ON (hs.item_id = hss.item_id)									
			WHERE id_shop = '.(int)$id_shop.
			($active ? ' AND hss.`active` = 1' : ' ').
			' ORDER BY hss.ordering'.
			($limit ? ' LIMIT 0,'.$limit : ' ')
		);
		
	}
	
	public function getCategoryName($id_item)
	{
		$this->context = Context::getContext();
		$id_shop = $this->context->shop->id;
		$id_lang = $this->context->language->id;
		return Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue('
			SELECT hss.`title`
			FROM '._DB_PREFIX_.'jmsflashsales_items hs			
			LEFT JOIN '._DB_PREFIX_.'jmsflashsales_categories_lang hss ON (hs.category_id = hss.category_id)									
			WHERE hss.`id_lang` = '.(int)$id_lang. ' AND hs.`item_id` = '.$id_item 
		);
		
	}
	public function getProductName($id_item)
	{
		$this->context = Context::getContext();
		$id_shop = $this->context->shop->id;
		$id_lang = $this->context->language->id;
		$product_id = Db::getInstance(_PS_USE_SQL_SLAVE_)->getValue('
			SELECT hs.`product_id`
			FROM '._DB_PREFIX_.'jmsflashsales_items hs								
			WHERE hs.`item_id` = '.$id_item 
		);
		return Product::getProductName($product_id);
		
	}
	public function displayStatus($id_item, $active)
	{
		$title = ((int)$active == 0 ? $this->l('Disabled') : $this->l('Enabled'));
		$icon = ((int)$active == 0 ? 'icon-remove' : 'icon-check');
		$class = ((int)$active == 0 ? 'btn-danger' : 'btn-success');
		$html = '<a class="btn '.$class.'" href="'.AdminController::$currentIndex.
			'&configure='.$this->name.'
				&token='.Tools::getAdminTokenLite('AdminModules').'
				&changeStatus&id_item='.(int)$id_item.'" title="'.$title.'"><i class="'.$icon.'"></i> '.$title.'</a>';

		return $html;
	}

	public function itemExists($id_item)
	{
		$req = 'SELECT hs.`item_id` as id_item
				FROM `'._DB_PREFIX_.'jmsflashsales` hs
				WHERE hs.`item_id` = '.(int)$id_item;
		$row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($req);

		return ($row);
	}
	
	public function catExists($id_category)
	{
		$req = 'SELECT hs.`category_id` as id_category
				FROM `'._DB_PREFIX_.'jmsflashsales_categories` hs
				WHERE hs.`category_id` = '.(int)$id_category;
		$row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($req);

		return ($row);
	}
	
	public function renderPathway()
	{
		if(Tools::isSubmit('categories'))
			$view = 'categories';
		elseif(Tools::isSubmit('config')) 
			$view = 'config';
		else 
			$view = 'items';			
		$this->context->smarty->assign(
			array(
				'view' => $view,
				'link' => $this->context->link
			)
		);
		return $this->display(__FILE__, 'path.tpl');
	}
	public function renderList()
	{
		$items = $this->getItems();		
		foreach ($items as $key => $item) {
			$items[$key]['status'] = $this->displayStatus($item['id_item'], $item['active']);
			$items[$key]['catname'] = $this->getCategoryName($item['id_item']);
			$items[$key]['productname'] = $this->getProductName($item['id_item']);
		}
		$this->context->smarty->assign(
			array(
				'link' => $this->context->link,
				'items' => $items,
				'image_baseurl' => $this->root_url.'modules/jmsflashsales/views/img/'
			)
		);

		return $this->display(__FILE__, 'list.tpl');
	}
	
	function getCategories() {
		$this->context = Context::getContext();		
		$id_lang = $this->context->language->id;
		
		return Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT hs.`category_id`, hss.`title`
			FROM `'._DB_PREFIX_.'jmsflashsales_categories` hs
			LEFT JOIN '._DB_PREFIX_.'jmsflashsales_categories_lang hss ON (hs.category_id = hss.category_id)			
			WHERE id_lang = '.(int)$id_lang);
	}
	
	function renderListCategories() 
	{
		$categories = $this->getCategories();		
		$this->context->smarty->assign(
			array(
				'link' => $this->context->link,
				'categories' => $categories
			)
		);

		return $this->display(__FILE__, 'categorylist.tpl');
	}
	
	public function renderAddForm()
	{
		$context = Context::getContext();
		$_categories = $this->getCategories();		
		$fields_form = array(
			'form' => array(
				'legend' => array(
					'title' => $this->l('Item informations'),
					'icon' => 'icon-cogs'
				),
				'input' => array(
					array(
						'type' => 'text',
						'label' => $this->l('Product ID'),
						'name' => 'product_id',
						'class' => 'fixed-width-xl'
					),
					array(
						'type' => 'select',
						'label' => $this->l('Category'),
						'name' => 'category_id',
						'desc' => $this->l('Select Category'),
						'class' => ' fixed-width-xl',
						'options' => array('query' => $_categories,'id' => 'category_id', 'name' => 'title')
					),
					array(
						'type' => 'switch',
						'label' => $this->l('Active'),
						'name' => 'active',
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
				),
				'submit' => array(
					'title' => $this->l('Save'),
				)
			),
		);

		if (Tools::isSubmit('id_item') && $this->itemExists((int)Tools::getValue('id_item')))
		{
			$box = new JmsSaleItem((int)Tools::getValue('id_item'));
			$fields_form['form']['input'][] = array('type' => 'hidden', 'name' => 'id_item');				
			$fields_form['form']['input'][] = array('type' => 'hidden', 'name' => 'ordering');				
		}

		$helper = new HelperForm();
		$helper->show_toolbar = false;
		$helper->table = $this->table;
		$lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
		$helper->default_form_language = $lang->id;
		$helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
		$this->fields_form = array();
		$helper->module = $this;
		$helper->identifier = $this->identifier;
		$helper->submit_action = 'submitItem';
		$helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$language = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
		$helper->tpl_vars = array(
			'base_url' => $this->root_url,
			'language' => array(
				'id_lang' => $language->id,
				'iso_code' => $language->iso_code
			),
			'fields_value' => $this->getAddFieldsValues(),
			'languages' => $this->context->controller->getLanguages(),
			'id_language' => $this->context->language->id
		);

		$helper->override_folder = '/';		
		return $helper->generateForm(array($fields_form));
	}
	
	public function renderCategoryAddForm()
	{
		$context = Context::getContext();
		$_categories = $this->getCategories();
		$fields_form = array(
			'form' => array(
				'legend' => array(
					'title' => $this->l('Category informations'),
					'icon' => 'icon-cogs'
				),
				'input' => array(
					array(
						'type' => 'text',
						'label' => $this->l('Title'),
						'name' => 'title',
						'lang' => true,
						'class' => 'fixed-width-xl'
					),
					array(
						'type' => 'text',
						'label' => $this->l('Icon Class'),
						'name' => 'icon_class',
						'class' => 'fixed-width-xl'
					)
				),
				'submit' => array(
					'title' => $this->l('Save'),
				)
			),
		);

		if (Tools::isSubmit('id_category') && $this->catExists((int)Tools::getValue('id_category')))
		{
			$category = new JmsSaleCategory((int)Tools::getValue('id_category'));
			$fields_form['form']['input'][] = array('type' => 'hidden', 'name' => 'id_category');			
		}

		$helper = new HelperForm();
		$helper->show_toolbar = false;
		$helper->table = $this->table;
		$lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
		$helper->default_form_language = $lang->id;
		$helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
		$this->fields_form = array();
		$helper->module = $this;
		$helper->identifier = $this->identifier;
		$helper->submit_action = 'submitCategory';
		$helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$language = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
		$helper->tpl_vars = array(
			'base_url' => $this->root_url,
			'language' => array(
				'id_lang' => $language->id,
				'iso_code' => $language->iso_code
			),
			'fields_value' => $this->getCatAddFieldsValues(),
			'languages' => $this->context->controller->getLanguages(),
			'id_language' => $this->context->language->id
		);

		$helper->override_folder = '/';		
		return $helper->generateForm(array($fields_form));
	}
	public function renderForm()
	{	
		$fields_form = array(
			'form' => array(
				'legend' => array(
					'title' => $this->l('Settings'),
					'icon' => 'icon-cogs'
				),
				'input' => array(
					array(
						'type' => 'datetime',
						'label' => $this->l('Expire Time'),
						'name' => 'JMS_FLASHSALES_EXPIRETIME',
						'lang' => true,
					),	
					array(
						'type' => 'switch',
						'label' => $this->l('Auto Play'),
						'name' => 'JMS_FLASHSALES_AUTO',
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
						'type' => 'text',
						'label' => $this->l('Items Show'),
						'name' => 'JMS_FLASHSALES_ITEMS_SHOW',	
						'class' => 'fixed-width-xl'						
					),
					array(
						'type' => 'text',
						'label' => $this->l('Number of Items'),
						'name' => 'JMS_FLASHSALES_TOTAL',		
						'class' => 'fixed-width-xl'		
					)
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

		$helper->identifier = $this->identifier;
		$helper->submit_action = 'submitConfig';
		$helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->tpl_vars = array(
			'fields_value' => $this->getConfigFieldsValues(),
			'languages' => $this->context->controller->getLanguages(),
			'id_language' => $this->context->language->id
		);

		return $helper->generateForm(array($fields_form));
	}

	public function getConfigFieldsValues()
	{
		return array(
			'JMS_FLASHSALES_EXPIRETIME' => Tools::getValue('JMS_FLASHSALES_EXPIRETIME', Configuration::get('JMS_FLASHSALES_EXPIRETIME')),
			'JMS_FLASHSALES_AUTO' => Tools::getValue('JMS_FLASHSALES_AUTO', Configuration::get('JMS_FLASHSALES_AUTO')),
			'JMS_FLASHSALES_ITEMS_SHOW' => Tools::getValue('JMS_FLASHSALES_ITEMS_SHOW', Configuration::get('JMS_FLASHSALES_ITEMS_SHOW')),
			'JMS_FLASHSALES_TOTAL' => Tools::getValue('JMS_FLASHSALES_TOTAL', Configuration::get('JMS_FLASHSALES_TOTAL'))
		);
	}

	public function getAddFieldsValues()
	{
		$fields = array();

		if (Tools::isSubmit('id_item') && $this->itemExists((int)Tools::getValue('id_item')))
		{
			$item = new JmsSaleItem((int)Tools::getValue('id_item'));
			$fields['id_item'] = (int)Tools::getValue('id_item', $item->id);			
		}
		else
			$item = new JmsSaleItem();		
		$fields['category_id'] = Tools::getValue('category_id', $item->category_id);		
		$fields['product_id'] = Tools::getValue('product_id', $item->product_id);		
		$fields['ordering'] = Tools::getValue('ordering', $item->ordering);		
		$fields['active'] = Tools::getValue('active', $item->active);								

		return $fields;
	}
	
	public function getCatAddFieldsValues()
	{
		$fields = array();

		if (Tools::isSubmit('id_category') && $this->catExists((int)Tools::getValue('id_category')))
		{
			$category = new JmsSaleCategory((int)Tools::getValue('id_category'));			
			$fields['id_category'] = (int)Tools::getValue('id_category', $category->id);			
		}
		else
			$category = new JmsSaleCategory();		
		$fields['icon_class'] = Tools::getValue('icon_class', $category->icon_class);				
		$languages = Language::getLanguages(false);		
		foreach ($languages as $lang)
		{
			$fields['title'][$lang['id_lang']] = Tools::getValue('title_'.(int)$lang['id_lang'], $category->title[(int)$lang['id_lang']]);									
		}
		return $fields;
	}
	
	public function hookDisplayHeader()	
	{						
		$this->context->controller->addCSS(($this->_path).'views/css/style.css', 'all');
		$this->context->controller->addJS(($this->_path).'views/js/jquery.plugin.js', 'all');
        $this->context->controller->addJS(($this->_path).'views/js/jquery.countdown.js', 'all');
        $this->context->controller->addJS(($this->_path).'views/js/jmscountdown.js', 'all');	
	}
		
	public function hookDisplayHome($params)
	{								
		$id_lang = $this->context->language->id;
		$id_shop = $this->context->shop->id;
		$items = $this->getItems(1, Configuration::get('JMS_FLASHSALES_TOTAL'));		
		$products = array();
		foreach ($items as $key => $item)
		{			
			$sql = 'SELECT p.*, product_shop.*, stock.out_of_stock, IFNULL(stock.quantity, 0) as quantity, MAX(product_attribute_shop.id_product_attribute) id_product_attribute, 	product_attribute_shop.minimal_quantity AS product_attribute_minimal_quantity, pl.`description`, pl.`description_short`, pl.`available_now`,
					pl.`available_later`, pl.`link_rewrite`, pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`, pl.`name`, MAX(image_shop.`id_image`) id_image,
					il.`legend`, m.`name` AS manufacturer_name, 
					DATEDIFF(product_shop.`date_add`, DATE_SUB(NOW(),
					INTERVAL '.(Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).'
						DAY)) > 0 AS new, product_shop.price AS orderprice 
				FROM `'._DB_PREFIX_.'product` p				
				'.Shop::addSqlAssociation('product', 'p').'
				LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa
				ON (p.`id_product` = pa.`id_product`)
				'.Shop::addSqlAssociation('product_attribute', 'pa', false, 'product_attribute_shop.`default_on` = 1').'
				'.Product::sqlStock('p', 'product_attribute_shop', false, $this->context->shop).'				
				LEFT JOIN `'._DB_PREFIX_.'product_lang` pl
					ON (p.`id_product` = pl.`id_product`
					AND pl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang('pl').')
				LEFT JOIN `'._DB_PREFIX_.'image` i
					ON (i.`id_product` = p.`id_product`)'.
								Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1').'
				LEFT JOIN `'._DB_PREFIX_.'image_lang` il
					ON (image_shop.`id_image` = il.`id_image`
					AND il.`id_lang` = '.(int)$id_lang.')
				LEFT JOIN `'._DB_PREFIX_.'manufacturer` m
					ON m.`id_manufacturer` = p.`id_manufacturer`
				WHERE p.`id_product` = '.$item['product_id'].' AND product_shop.`id_shop` = '.(int)$id_shop.'
					 AND product_shop.`active` = 1'
					.' GROUP BY product_shop.id_product';
			$row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
			//print_r($sql); exit;	
			$products[] = Product::getProductProperties($id_lang, $row);	
		}	
		
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

        foreach ($products as $rawProduct) {
            $products_for_template[] = $presenter->present(
                $presentationSettings,
                $assembler->assembleProduct($rawProduct),
                $this->context->language
            );
        }
        
		$this->smarty->assign(array(			
			'products' => $products_for_template,
			'items_show' => Configuration::get('JMS_FLASHSALES_ITEMS_SHOW'),
			'items' => Configuration::get('JMS_FLASHSALES_TOTAL'),
			'auto' => Configuration::get('JMS_FLASHSALES_AUTO'),
			'expiretime' => Configuration::get('JMS_FLASHSALES_EXPIRETIME'),
			'image_baseurl' => $this->root_url.'modules/jmsflashsales/views/img/',
		));		
		return $this->display(__FILE__, 'jmsflashsales.tpl');
	}
	function getProducts($category_id) {
		$this->context = Context::getContext();
		$id_shop = $this->context->shop->id;
		$id_lang = $this->context->language->id;
		$_products = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
			SELECT hs.`item_id` as id_item,hss.`product_id`, hss.`ordering`, hss.`active`
			FROM '._DB_PREFIX_.'jmsflashsales hs
			LEFT JOIN '._DB_PREFIX_.'jmsflashsales_items hss ON (hs.`item_id` = hss.`item_id`)								
			WHERE `id_shop` = '.(int)$id_shop.' AND `category_id` = '.$category_id.
			' AND hss.`active` = 1'.
			' ORDER BY hss.`ordering`'
		);
		$result = array();
		foreach($_products as $_product) {
			$sql = 'SELECT p.*, product_shop.*, stock.out_of_stock, IFNULL(stock.quantity, 0) as quantity, MAX(product_attribute_shop.id_product_attribute) id_product_attribute, 	product_attribute_shop.minimal_quantity AS product_attribute_minimal_quantity, pl.`description`, pl.`description_short`, pl.`available_now`,
					pl.`available_later`, pl.`link_rewrite`, pl.`meta_description`, pl.`meta_keywords`, pl.`meta_title`, pl.`name`, MAX(image_shop.`id_image`) id_image,
					il.`legend`, m.`name` AS manufacturer_name, 
					DATEDIFF(product_shop.`date_add`, DATE_SUB(NOW(),
					INTERVAL '.(Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).'
						DAY)) > 0 AS new, product_shop.price AS orderprice 
				FROM `'._DB_PREFIX_.'product` p				
				'.Shop::addSqlAssociation('product', 'p').'
				LEFT JOIN `'._DB_PREFIX_.'product_attribute` pa
				ON (p.`id_product` = pa.`id_product`)
				'.Shop::addSqlAssociation('product_attribute', 'pa', false, 'product_attribute_shop.`default_on` = 1').'
				'.Product::sqlStock('p', 'product_attribute_shop', false, $this->context->shop).'				
				LEFT JOIN `'._DB_PREFIX_.'product_lang` pl
					ON (p.`id_product` = pl.`id_product`
					AND pl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang('pl').')
				LEFT JOIN `'._DB_PREFIX_.'image` i
					ON (i.`id_product` = p.`id_product`)'.
								Shop::addSqlAssociation('image', 'i', false, 'image_shop.cover=1').'
				LEFT JOIN `'._DB_PREFIX_.'image_lang` il
					ON (image_shop.`id_image` = il.`id_image`
					AND il.`id_lang` = '.(int)$id_lang.')
				LEFT JOIN `'._DB_PREFIX_.'manufacturer` m
					ON m.`id_manufacturer` = p.`id_manufacturer`
				WHERE p.`id_product` = '.$_product['product_id'].' AND product_shop.`id_shop` = '.(int)$id_shop.'
					 AND product_shop.`active` = 1'
					.' GROUP BY product_shop.id_product';
			$row = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($sql);
			$result[] = Product::getProductProperties($id_lang, $row);			
		}
		
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
	public function hookFooter($params)
	{								
		$categories = $this->getCategories();		
		$products = array();
		foreach ($categories as $key => $category)
		{
			$products[$key] = $this->getProducts($category['category_id']);
		}	
		
		$this->smarty->assign(array(
			'categories' => $categories,		
			'products' => $products,
			'items_show' => Configuration::get('JMS_FLASHSALES_ITEMS_SHOW'),
			'items' => Configuration::get('JMS_FLASHSALES_TOTAL'),
			'auto' => Configuration::get('JMS_FLASHSALES_AUTO'),
			'expiretime' => Configuration::get('JMS_FLASHSALES_EXPIRETIME'),
			'image_baseurl' => $this->_path.'views/img/',
		));		
		return $this->display(__FILE__, 'jmsflashsales-tab.tpl');
	}
	public function returnSearch($result)
	{

		$context = Context::getContext();
        $assembler = new ProductAssembler($context);

        $presenterFactory = new ProductPresenterFactory($context);
        $presentationSettings = $presenterFactory->getPresentationSettings();
        $presenter = new ProductListingPresenter(
            new ImageRetriever(
                $context->link
            ),
            $context->link,
            new PriceFormatter(),
            new ProductColorsRetriever(),
            $context->getTranslator()
        );

        $products_for_template = [];

        foreach ($result as $rawProduct) {
            $products_for_template[] = $presenter->present(
                $presentationSettings,
                $assembler->assembleProduct($rawProduct),
                $context->language
            );
        }

        return $products_for_template;
	}
}
