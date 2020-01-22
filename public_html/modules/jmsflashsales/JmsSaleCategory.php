<?php
/**
* 2007-2018 PrestaShop
*
* Jms FlashSales
*
*  @author    Joommasters <joommasters@gmail.com>
*  @copyright 2007-2018 Joommasters
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: http://www.joommasters.com
*/

class JmsSaleCategory extends ObjectModel
{
	public $title;	
	public $icon_class;	

	public static $definition = array(
		'table' => 'jmsflashsales_categories',
		'primary' => 'category_id',
		'multilang' => true,
		'fields' => array(																
			'title' =>			array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isCleanHtml', 'required' => true, 'size' => 255),						
			'icon_class' =>		array('type' => self::TYPE_STRING, 'validate' => 'isCleanHtml', 'size' => 255)
		)
	);

	public	function __construct($category_id = null, $id_lang = null, $id_shop = null)
	{
		parent::__construct($category_id, $id_lang, $id_shop);
	}
	
	public function delete()
	{
		$res = true;
		$res &= Db::getInstance()->execute('
			UPDATE FROM `'._DB_PREFIX_.'jmsflashsales_items SET category_id = 0`
			WHERE `category_id` = '.(int)$this->id
		);
		$res &= parent::delete();
		return $res;
	}
}
