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

class RemoveModel extends ObjectModel
{
    public $id_customer;
    public $date_add;
    public $log;
          
    public static $definition = array(
            'table' => 'pmcvg_remove',
            'primary' => 'id_pmcvg_remove',
            'multilang_shop' => false,
            'fields' => array(
                'id_customer' =>    array('type' => self::TYPE_HTML, 'validate' => 'isInt','required'=> true,),
                'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
                'log' => array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'size' => 255),
             ),
        );
}
