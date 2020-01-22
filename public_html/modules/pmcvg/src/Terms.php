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

Shop::addTableAssociation('pmcvg', array('type' => 'shop'));

class ConditionsModel extends ObjectModel
{
    public $text;
    public $required;
    public $active;
    public $page;
          
    public static $definition = array(
            'table' => 'pmcvg',
            'primary' => 'id_pmcvg',
            'multilang' => true,
            'multilang_shop' => true,
            'fields' => array(
                'text' =>    array('type' => self::TYPE_HTML, 'validate' => 'isString','required'=> true,'lang' => true),
                'active' =>    array('shop' => true, 'type' => self::TYPE_BOOL, 'validate' => 'isAnything', 'required'=> true),
                'required' => array('shop' => true, 'type' => self::TYPE_BOOL, 'validate' => 'isAnything', 'required'=> true),
                'page' => array('type' => self::TYPE_STRING, 'validate'),
             ),
        );
}
