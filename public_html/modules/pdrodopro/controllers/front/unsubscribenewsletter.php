<?php
/**
* 2012-2018 Patryk Marek PrestaDev.pl
*
* Patryk Marek PrestaDev.pl - Pd Rodo Pro © All rights reserved.
*
* DISCLAIMER
*
* Do not edit, modify or copy this file.
* If you wish to customize it, contact us at info@prestadev.pl.
*
* @author    Clipart for Patryk Marek PrestaDev.pl <info@prestadev.pl>
* @copyright 2012-2018 Clipart for Patryk Marek - PrestaDev.pl
* @link      http://prestadev.pl
* @package   Pd Rodo Pro for - PrestaShop 1.6.x
* @version   1.0.3
* @license   License is for use in domain / or one multistore enviroment (do not modify or reuse this code or part of it) if you want any changes please contact with me at info@prestadev.pl
* @date      14-05-2018
*/

class pdrodoprounsubscribenewsletterModuleFrontController extends ModuleFrontController
{
    public function postProcess()
    {
        if (Tools::getValue('email')) {
            $this->removeEmailFromNewsletters($email);
        }
    }
   
    public function removeEmailFromNewsletters($email)
    {
        $sql = 'DELETE FROM ' . _DB_PREFIX_ . 'newsletter
			WHERE email="' . $email . '" ';

        return Db::getInstance()->execute($sql);
    }
   
    public function checkEmailIsset($email)
    {
        $sql = 'SELECT email FROM ' . _DB_PREFIX_ . 'newsletter WHERE email="' .$email. '"';
        $result = Db::getInstance()->executeS($sql, true, false);
        return $result ? true : false;
    }
   
    public function initContent()
    {
        parent::initContent();
        if (Tools::getValue('email')) {
            if ($this->checkEmailIsset(Tools::getValue('email'))===true) {
                $this->context->smarty->assign([
                'unsubscribed' =>  '1'
            ]);
            }
        }

        $this->setTemplate('unsubscribenewsletter.tpl');
    }
}
