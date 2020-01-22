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

class CustomerAgreementHistoryModel extends ObjectModel
{
    public $id_customer;
    public $date_upd;
    public $set;
    public $id_pmcvg;
    public $ip;
          
    public static $definition = array(
        'table' => 'pmcvg_customer_agreement_history',
        'primary' => 'id_pmcvg_customer_agreement_history',
        'multilang_shop' => false,
        'fields' => array(
            'id_customer' =>    array('type' => self::TYPE_HTML, 'validate' => 'isInt','required'=> true,),
            'date_upd' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
            'set' => array('type' => self::TYPE_INT, 'validate' => 'isBool'),
            'id_pmcvg' => array('type' => self::TYPE_INT, 'validate' => 'isInt'),
            'ip' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
         ),
    );
}
