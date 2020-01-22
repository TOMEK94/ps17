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

class OrderController extends OrderControllerCore
{
    public function postProcess()
    {
        if ($this->step == 3 && Tools::isSubmit('processCarrier')) {
            $this->pdrodopro = Module::getInstanceByName('pdrodopro');

            if (Configuration::get('CUSTPRIV_IDENTITY_PAGE1') && !Tools::getValue('cgv2')) {
                $this->errors[] = Tools::displayError('Musisz zaznaczyć zgodę nr 1.');
            }
            if (Configuration::get('CUSTPRIV_IDENTITY_PAGE2') && !Tools::getValue('cgv3')) {
                $this->errors[] = Tools::displayError('Musisz zaznaczyć zgodę nr 2.');
            }
            if (Configuration::get('CUSTPRIV_IDENTITY_PAGE3') && !Tools::getValue('cgv4')) {
                $this->errors[] = Tools::displayError('Musisz zaznaczyć zgodę nr 3.');
            }
            if (Configuration::get('CUSTPRIV_IDENTITY_PAGE4') && !Tools::getValue('cgv5')) {
                $this->errors[] = Tools::displayError('Musisz zaznaczyć zgodę nr 4.');
            }

            if (count($this->errors)<1) {
                if (Tools::getValue('cgv1')) {
                    $fields[] = 'cgv1';
                }
                if (Configuration::get('CUSTPRIV_IDENTITY_PAGE1') && Tools::getValue('cgv2')) {
                    $fields[] = 'cgv2';
                }
                if (Configuration::get('CUSTPRIV_IDENTITY_PAGE2') && Tools::getValue('cgv3')) {
                    $fields[] = 'cgv3';
                }
                if (Configuration::get('CUSTPRIV_IDENTITY_PAGE3') && Tools::getValue('cgv4')) {
                    $fields[] = 'cgv4';
                }
                if (Configuration::get('CUSTPRIV_IDENTITY_PAGE4') && Tools::getValue('cgv5')) {
                    $fields[] = 'cgv5';
                }
                foreach ($fields as $typeField) {
                    $isset = $this->pdrodopro->checkIssetItem('order_process', $this->context->customer->id, $this->context->cart->id, $typeField);
                    if (!$isset) {
                        $this->pdrodopro->insertDatabase(
                            'order_process',
                            $this->context->cart->id,
                            $this->context->customer->id,
                            $typeField
                        );
                    } else {
                        $this->pdrodopro->updateDatabase(
                            'order_process',
                            $this->context->cart->id,
                            $this->context->customer->id,
                            $typeField,
                            $isset['0']['id']
                        );
                    }
                }
            }
        }

        parent::postProcess();
    }
}
