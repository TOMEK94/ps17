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

class IdentityController extends IdentityControllerCore
{
    public function postProcess()
    {
        $this->pdrodopro = Module::getInstanceByName('pdrodopro');

        if (Tools::isSubmit('submitIdentity')) {
            if (Configuration::get('CUSTPRIV_AUTH_PAGE1') && !Tools::getValue('customer_privacy1')) {
                $this->pdrodopro->removeAllow('create_account', $this->context->customer->id, 'customer_privacy1');
            } elseif (Configuration::get('CUSTPRIV_AUTH_PAGE1') && Tools::getValue('customer_privacy1')) {
                $fields[] = 'customer_privacy1';
            }

            if (Configuration::get('CUSTPRIV_AUTH_PAGE2') && !Tools::getValue('customer_privacy2')) {
                $this->pdrodopro->removeAllow('create_account', $this->context->customer->id, 'customer_privacy2');
            } elseif (Configuration::get('CUSTPRIV_AUTH_PAGE2') && Tools::getValue('customer_privacy2')) {
                $fields[] = 'customer_privacy2';
            }

            if (Configuration::get('CUSTPRIV_AUTH_PAGE2') && !Tools::getValue('customer_privacy3')) {
                $this->pdrodopro->removeAllow('create_account', $this->context->customer->id, 'customer_privacy3');
            } elseif (Configuration::get('CUSTPRIV_AUTH_PAGE3') && Tools::getValue('customer_privacy3')) {
                $fields[] = 'customer_privacy3';
            }

            if (!Tools::getValue('newsletter') && !Tools::getValue('newsletter_allow') && Configuration::get('NEWSLETTER_AUTH1')) {
                $this->pdrodopro->removeAllow('create_account', $this->context->customer->id, 'newsletter_allow');
            } elseif (Tools::getValue('newsletter') && Tools::getValue('newsletter_allow') && Configuration::get('NEWSLETTER_AUTH1')) {
                $fields[] = 'newsletter_allow';
            }

            if (!Tools::getValue('optin') && !Tools::getValue('optin_allow') && Configuration::get('NEWSLETTER_AUTH2')) {
                $this->pdrodopro->removeAllow('create_account', $this->context->customer->id, 'optin_allow');
            } elseif (Tools::getValue('optin') && Tools::getValue('optin_allow') && Configuration::get('NEWSLETTER_AUTH2')) {
                $fields[] = 'optin_allow';
            }

            if (!empty($fields)) {
                foreach ($fields as $typeField) {
                    $isset = $this->pdrodopro->checkIssetItemByCustomer(
                        'create_account',
                        $this->context->customer->id,
                        $typeField
                    );
                    if (!$isset) {
                        $this->pdrodopro->insertDatabaseByCustomer(
                            'create_account',
                            $this->context->customer->id,
                            $typeField
                        );
                    } else {
                        $this->pdrodopro->updateDatabaseByCustomer(
                            'create_account',
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
