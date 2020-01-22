<?php
/**
* 2007-2018 PrestaShop
*
* Jms Brand logos
*
*  @author    Joommasters <joommasters@gmail.com>
*  @copyright 2007-2018 Joommasters
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: http://www.joommasters.com
*/

include_once('../../config/config.inc.php');
include_once('../../init.php');
include_once('jmsflashsales.php');

$context = Context::getContext();
$slides = array();


if (Tools::getValue('action') == 'updateItemsOrdering' && Tools::getValue('slides'))
{
	$slides = Tools::getValue('slides');

	foreach ($slides as $position => $id_slide)
	{
		$res = Db::getInstance()->execute('
			UPDATE `'._DB_PREFIX_.'jmsflashsales_items` SET `ordering` = '.(int)$position.'
			WHERE `item_id` = '.(int)$id_slide
		);
	}
	$jms_slider = new JmsMegaBox();
	$jms_slider->clearCache();
}