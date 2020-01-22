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

class pdrodoprodisplayModuleFrontController extends ModuleFrontController
{
    public function postProcess()
    {
        if (!isset($this->context->customer->id)) {
            header("Location: /");
            exit;
        }
       
        $customer = new Customer($this->context->customer->id);

        if (Tools::isSubmit('anonimize')) {
            $addresses = $this->getCustomerAddresses($this->context->customer->id);
            
            if (!is_array($addresses)) {
                return true;
            }
            
            $isset = false;
            foreach ($addresses as $address) {
                if ($this->checkIssetAddressInOrder($address['id_address'])===true) {
                    $isset = true;
                    break;
                }
            }
            
            if ($isset===false) {
                foreach ($addresses as $address) {
                    $adr = new Address($address['id_address']);
                    $adr->delete();
                }
            } else {
                foreach ($addresses as $address) {
                    $this->removeAllIdCustomerFromAddresses($address['id_address']);
                }
            }
            
            $this->removeIdCustomerFromMessages($this->context->customer->id);
            $this->removeIdCustomerFromCart($this->context->customer->id);
            
            // Nowy adres (anonimowy)
            $new_adr = new Address();
            $new_adr->id_customer = $this->context->customer->id;
            $new_adr->id_manufacturer = 0;
            $new_adr->id_supplier = 0;
            $new_adr->id_warehouse = 0;
            $new_adr->id_country = Configuration::get('PS_COUNTRY_DEFAULT');
            $new_adr->id_state = 0;
            $new_adr->alias = 'Anonimowe';
            $new_adr->company = '';
            $new_adr->lastname = 'Anonimowe';
            $new_adr->firstname = 'Anonimowe';
            $new_adr->vat_number = '';
            $new_adr->address1 = 'Anonimowe';
            $new_adr->address2 = 'Anonimowe';
            $new_adr->postcode= '00-000';
            $new_adr->city = 'Anonimowe';
            $new_adr->other = '';
            $new_adr->phone = '000000000';
            $new_adr->phone_mobile = '000000000';
            $new_adr->dni = '';
            $new_adr->add();
                
            // Anonimizacje konta użytkownika
            
            $customer->firstname = 'Anonim';
            $customer->lastname = 'Anonim';
            $customer->company = '';
            $customer->birthday = '0000-00-00';
            $customer->newsletter = 0;
            $customer->newsletter_date_add = '0000-00-00';
            $customer->optin = 0;
            $customer->active = 0;
            $customer->website = '';
            $customer->note = '';
            $customer->date_upd = date('Y-m-d');
            $customer->ip_registration_newsletter = '';
            $customer->email = 'anonimizacja_'.substr(md5(uniqid(rand())), 0, 6).'@anonim.pl';
            $customer->passwd = substr(md5(uniqid(rand())), 0, 6);
            $customer->update();
            $customer->logout();
        } elseif (Tools::isSubmit('delete')) {
            $se = strval(Configuration::get('PS_SHOP_EMAIL'));
            $sn = strval(Configuration::get('PS_SHOP_NAME'));
            $this->sendM($se, $se, $sn, $customer);
            
            $customer->active = 0;
            $customer->update();
            $customer->logout();
        } elseif (Tools::isSubmit('removenewsletter')) {
            $email = $customer->email;
            $this->removeEmailFromNewsletters($email);
            $pdrodopro = new pdrodopro();
            $pdrodopro->removeAllow('create_account', $customer->id, 'newsletter_allow');
            $pdrodopro->removeAllow('create_account', $customer->id, 'optin_allow');

            $customer->optin = 0;
            $customer->ip_registration_newsletter = '';
            $customer->newsletter = 0;
            $customer->update();
        }
    }
   
    private function getCustomerData($customer)
    {
        $xml = new XMLWriter();
        $xml->openURI('php://output');
        $xml->startDocument('1.0', 'UTF-8');
        $xml->setIndent(4);

        $xml->startElement("customer");

        $xml->writeElement("Firstname", $customer->firstname);
        $xml->writeElement("Lastname", $customer->lastname);
        $xml->writeElement("E-mail", $customer->email);
        $xml->writeElement("Company", $customer->company);
        $xml->writeElement("Birthday", $customer->birthday);
        $xml->writeElement("Newsletter", $customer->newsletter);
        $xml->writeElement("IP_registration_newsletter", $customer->ip_registration_newsletter);
        $xml->writeElement("Marketing", $customer->optin);
        $xml->writeElement("Active", $customer->active);
        $xml->writeElement("Date_add", $customer->date_add);

        $addresses = $this->getCustomerAddresses($this->context->customer->id);
        if (isset($addresses) && !empty($addresses)) {
            $xml->startElement("addresses");
            foreach ($addresses as $address) {
                $xml->startElement("address");
                $xml->writeElement("Alias", $address['alias']);
                $xml->writeElement("Company", $address['company']);
                $xml->writeElement("Firstname", $address['firstname']);
                $xml->writeElement("Lastname", $address['lastname']);
                $xml->writeElement("Address_line1", $address['address1']);
                $xml->writeElement("Address_line2", $address['address2']);
                $xml->writeElement("Postcode", $address['postcode']);
                $xml->writeElement("City", $address['city']);
                $xml->writeElement("Phone", $address['phone']);
                $xml->writeElement("Phone_mobile", $address['phone_mobile']);
                $xml->writeElement("Vat_number", $address['vat_number']);
                $xml->writeElement("Date_add", $address['date_add']);
                $xml->endElement();
            }
            $xml->endElement();
        }
        
        /*$messages = $this->getCustomerMessages($this->context->customer->id);
        if(isset($messages) && !empty($messages)){
            $xml->startElement("messages");
            foreach ($messages as $message) {
                $xml->startElement("message");
                $xml->writeElement("Message", $message['message']);
                $xml->writeElement("Date_add", $message['date_add']);
                $xml->endElement();
            }
            $xml->endElement();
        }*/
        
        $orders = $this->getCustomerOrders($this->context->customer->id);
        if (isset($orders) && !empty($orders)) {
            $xml->startElement("orders");
            foreach ($orders as $order) {
                $xml->startElement("order");
                $xml->writeElement("Reference", $order['reference']);
                $xml->writeElement("Status", $order['status']);
                $xml->writeElement("Payment", $order['payment']);
                $xml->writeElement("Total_paid", $order['total_paid']);
                $xml->writeElement("Shipping_number", $order['shipping_number']);
                $xml->writeElement("Date_add", $order['date_add']);
                
                $products = $this->getCustomerOrderProducts($order['id_order']);
                if (isset($products) && !empty($products)) {
                    $xml->startElement("products");
                    foreach ($products as $product) {
                        $xml->startElement("product");
                        $xml->writeElement("Product", $order['product_name']);
                        $xml->writeElement("Quantity", $order['product_quantity']);
                        $xml->writeElement("Reference", $order['product_reference']);
                        $xml->writeElement("Price_with_tax", $order['total_price_tax_incl']);
                        $xml->endElement();
                    }
                    $xml->endElement();
                }
                $xml->endElement();
            }
            $xml->endElement();
        }
        $xml->endElement();
        $xml->endDocument();
        $xml->flush();

        header('Content-type: text/xml');
        header('Content-Disposition: attachment; filename=customer.xml');
        echo $xml->outputMemory();
        exit;
    }
   
    public function sendM($ot, $se, $sn, $customer)
    {
        $templateVars = array(
                '{message}' => 'Klient: <strong>'.$customer->firstname.' '.$customer->lastname.' '.$customer->email.'</strong> zgłosił prośbę o usunięcie jego konta użytkownika ze sklepu internetowego: <strong>'.$sn.'</strong>',
                '{order_name}' => 'Nie dotyczy',
                '{product_name}' => 'Nie dotyczy',
                '{attached_file}' => 'Nie dotyczy'
            );
        Mail::Send(1, 'contact_form', 'Prośba o usunięcie konta użytkownika', $templateVars, $ot, $to_name = null, $from = null, $from_name = null, $file_attachment = null, $mode_smtp = null, $template_path = _PS_MAIL_DIR_, $die = false, $id_shop = null, $bcc = null);

        return true;
    }
   
    private function removeEmailFromNewsletters($email)
    {
        $sql = 'DELETE FROM ' . _DB_PREFIX_ . 'newsletter
			WHERE email="' . $email . '" ';

        return Db::getInstance()->execute($sql);
    }
   
    public function removeIdCustomerFromMessages($id_customer)
    {
        $sql = 'UPDATE ' . _DB_PREFIX_ . 'message
			SET id_customer = "0"
			WHERE id_customer="' . (int)$id_customer . '" ';

        return Db::getInstance()->execute($sql);
    }
    
    public function removeIdCustomerFromCart($id_customer)
    {
        $sql = 'UPDATE ' . _DB_PREFIX_ . 'cart
			SET id_customer = "0"
			WHERE id_customer="' . (int)$id_customer . '" ';

        return Db::getInstance()->execute($sql);
    }
   
    public function removeAllIdCustomerFromAddresses($id_address)
    {
        $sql = 'UPDATE ' . _DB_PREFIX_ . 'address
			SET id_customer = "0", date_upd = NOW()
			WHERE id_address="' . (int)$id_address . '" ';

        return Db::getInstance()->execute($sql);
    }
   
    public function checkIssetAddressInOrder($id_address)
    {
        $sql = 'SELECT id_order FROM ' . _DB_PREFIX_ . 'orders WHERE id_address_delivery="' . (int)$id_address . '" OR id_address_invoice="' . (int)$id_address . '"';
        $result = Db::getInstance()->executeS($sql, true, false);

        return $result ? true : false;
    }
   
    public function getCustomerMessages($customer)
    {
        $sql = 'SELECT * FROM ' . _DB_PREFIX_ . 'customer_message WHERE id_customer_thread="' . (int)$customer . '"';
        $result = Db::getInstance()->executeS($sql, true, false);

        return $result ? $result : false;
    }
   
    public function getCustomerAddresses($customer)
    {
        $sql = 'SELECT * FROM ' . _DB_PREFIX_ . 'address WHERE id_customer="' . (int)$customer . '" and alias!="Anonimowe"';
        $result = Db::getInstance()->executeS($sql, true, false);

        return $result ? $result : false;
    }
    
    public function getCustomerOrders($customer)
    {
        $sql = 'SELECT *, (SELECT name FROM ' . _DB_PREFIX_ . 'order_state_lang WHERE id_order_state=orp.current_state AND id_lang="'.$this->context->customer->id_lang.'") as status FROM ' . _DB_PREFIX_ . 'orders orp WHERE orp.id_customer="' . (int)$customer . '"';
        $result = Db::getInstance()->executeS($sql, true, false);

        return $result ? $result : false;
    }
    
    public function getCustomerOrderProducts($id_order)
    {
        $sql = 'SELECT * FROM ' . _DB_PREFIX_ . 'order_detail WHERE id_order="' . (int)$id_order . '"';
        $result = Db::getInstance()->executeS($sql, true, false);

        return $result ? $result : false;
    }
   
    public function initContent()
    {
        if (Tools::isSubmit('get_all_customer_data')) {
            $customer = new Customer($this->context->customer->id);
            $this->getCustomerData($customer);
            exit;
        }
    
        parent::initContent();
        if (Tools::isSubmit('anonimize')) {
            $this->context->smarty->assign([
            'anonimized' =>  '1'
        ]);
        } elseif (Tools::isSubmit('delete')) {
            $this->context->smarty->assign([
            'deleted' =>  '1'
        ]);
        } elseif (Tools::isSubmit('removenewsletter')) {
            $this->context->smarty->assign([
            'removed' =>  '1'
        ]);
        } elseif (Tools::isSubmit('get_all_customer_data')) {
            $this->context->smarty->assign([
            'getted' =>  '1'
        ]);
        }
    
        $this->setTemplate('anonimize.tpl');
    }
}
