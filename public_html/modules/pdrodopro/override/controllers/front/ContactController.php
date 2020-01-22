<?php
/**
* 2012-2018 Patryk Marek PrestaDev.pl
*
* Patryk Marek PrestaDev.pl - Pd Rodo Implementation © All rights reserved.
*
* DISCLAIMER
*
* Do not edit, modify or copy this file.
* If you wish to customize it, contact us at info@prestadev.pl.
*
* @author    Patryk Marek PrestaDev.pl <info@prestadev.pl>
* @copyright 2012-2018 Patryk Marek - PrestaDev.pl
* @link      http://prestadev.pl
* @package   Pd Rodo Implementation  for - PrestaShop 1.6.x
* @version   1.0.3
* @license   License is for use in domain / or one multistore enviroment (do not modify or reuse this code or part of it) if you want any changes please contact with me at info@prestadev.pl
* @date      14-05-2018
*/

class ContactController extends ContactControllerCore
{
    public function postProcess()
    {
        $this->pdrodopro = Module::getInstanceByName('pdrodopro');

        if (Tools::isSubmit('submitMessage')) {
            if (Configuration::get('CONTACTFORM_ALLOW1') && !Tools::getValue('cgv1')) {
                $this->errors[] = Tools::displayError('Musisz zaznaczyć zgodę nr 1.');
            }

            if (Configuration::get('CONTACTFORM_ALLOW2') && !Tools::getValue('cgv2')) {
                $this->errors[] = Tools::displayError('Musisz zaznaczyć zgodę nr 2.');
            }
        }

        parent::postProcess();
    }
}
