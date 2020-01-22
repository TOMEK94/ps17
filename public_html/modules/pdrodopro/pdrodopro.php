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
* @copyright 2012-2018 Patryk Marek - PrestaDev.pl
* @link      http://prestadev.pl
* @package   Pd Rodo Pro for - PrestaShop 1.6.x
* @version   1.0.3
* @license   License is for use in domain / or one multistore enviroment (do not modify or reuse this code or part of it) if you want any changes please contact with me at info@prestadev.pl
* @date      14-05-2018
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

class pdrodopro extends Module
{
    public function __construct()
    {
        $this->name = 'pdrodopro';
        if (version_compare(_PS_VERSION_, '1.4.0.0') >= 0) {
            $this->tab = 'front_office_features';
        } else {
            $this->tab = 'Blocks';
        }
        $this->version = '1.0.4';
        $this->author = 'PrestaDdev.pl';
        $this->need_instance = 0;

        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = $this->l('Zmiany związane z RODO');
        $this->description = $this->l('Dodaje odpowiednie klauzule i funkcje w związku z zmianami z RODO');
        $this->ps_versions_compliancy = array('min' => '1.5', 'max' => '1.6.99.99');

        $this->_html = '';
    }

    public function install()
    {
        $return = (parent::install()
                    && $this->registerHook('createAccountForm')
                    && $this->registerHook('displayCustomerIdentityForm')
                    && $this->registerHook('orderClauses')
                    && $this->registerHook('newsletterClauses')
                    && $this->registerHook('contactformClauses')
                    && $this->registerHook('customerAccount')
                    && $this->registerHook('header')
                    && $this->registerHook('displayAdminCustomers')
                    && $this->registerHook('displayAdminOrder')
                    && $this->registerHook('orderDetailDisplayed')
                    && $this->registerHook('footer')
                    && $this->registerHook('actionCustomerAccountAdd')
                    && $this->registerHook('actionBeforeSubmitAccount')
                    && pdrodopro::createTables());

        $conf_keys = array('CONTACTFORM_ALLOW1', 'CONTACTFORM_ALLOW2', 'NEWSLETTER_AUTH1', 'NEWSLETTER_AUTH2', 'GET_ALL_CUSTOMER_DATA', 'COOKIES_AUTH', 'UNSUBSCRIBE_NEWSLETTER', 'DELETE_ACCOUNT', 'ANONIMIZE_ACCOUNT', 'CUSTPRIV_AUTH_PAGE1', 'CUSTPRIV_AUTH_PAGE2', 'CUSTPRIV_AUTH_PAGE3', 'CUSTPRIV_AUTH_PAGE4', 'CUSTPRIV_IDENTITY_PAGE3', 'CUSTPRIV_IDENTITY_PAGE4', 'CUSTPRIV_IDENTITY_PAGE1', 'CUSTPRIV_IDENTITY_PAGE2', 'CUSTPRIV_MSG_AUTH2', 'CUSTPRIV_MSG_AUTH3', 'CUSTPRIV_MSG_IDENTITY2', 'CUSTPRIV_MSG_IDENTITY3', 'CUSTPRIV_MSG_IDENTITY4');

        foreach ($conf_keys as $conf_key) {
            Configuration::updateValue($conf_key, '');
        }
        
        Configuration::updateValue('COOKIES_MESSAGE', 'Wykorzystujemy pliki cookies oraz inne podobne technologie, aby nasz serwis lepiej spełniał Twoje oczekiwania.  Jeżeli nie wyrażasz zgody na wykorzystywanie plików cookies, możesz w każdej chwili zablokować je korzystając z ustawień swojej przeglądarki internetowej. <br />Szczegółowe informacje znajdziesz w Polityce Prywatności i Regulaminie sklepu.');
        Configuration::updateValue('CUSTPRIV_MSG_AUTH1', 'Wyrażam zgodę na przetwarzanie moich danych osobowych w zakresie niezbędnym do prowadzenia marketingu produktów i usług Sprzedawcy zgodnie z ustawą z dnia 29.08.1997 r. o ochronie danych osobowych (Dz. U. z 2002 r., Nr 101, poz. 926 ze zm.). Oświadczam, że zostałem poinformowany, iż przysługuje mi prawo dostępu do treści moich danych oraz możliwość ich poprawiania, a także, że podanie danych jest dobrowolnie.');
        Configuration::updateValue('CUSTPRIV_MSG_IDENTITY1', 'Wyrażam zgodę na wykorzystywanie i przetwarzanie moich danych osobowych w celu realizacji zamówienia (zgodnie z przepisami ustawy o ochronie danych osobowych z dnia 29.08.1997).');
        Configuration::updateValue('CUSTPRIV_MSG_IDENTITY2', 'Rozumiem swoje prawo do odstąpienia od umowy w ciągu 14 dni od wydania przedmiotu umowy.');
        Configuration::updateValue('NEWSLETTER_MESSAGE1', 'Wyrażam zgodę na przetwarzanie moich danych osobowych dla potrzeb wykonania Usług (zgodnie z Ustawą z dnia 29.08.1997 r. o Ochronie danych osobowych; t.j.Dz. U. z 2002r. Nr 101, poz. 926 ze zm.). W celu zapisania się do naszego biuletynu informacyjnego rozsyłanego e-mailem. ');
        Configuration::updateValue('NEWSLETTER_MESSAGE2', 'Wyrażam zgodę na przetwarzanie moich danych osobowych dla potrzeb wykonania Usług (zgodnie z Ustawą z dnia 29.08.1997 r. o Ochronie danych osobowych; t.j.Dz. U. z 2002r. Nr 101, poz. 926 ze zm.). W celu otrzymywania oferty promocyjne od naszych partnerów. ');
        Configuration::updateValue('CONTACTFORM_TEXT1', 'Zgadzam się na otrzymywanie drogą elektroniczną na wskazany przeze mnie adres e-mail informacji handlowych zgodnie z ustawą z dnia 18 lipca 2002 roku o świadczeniu usług drogą elektroniczną oraz z ustawą z dnia 16 lipca 2004 roku prawo telekomunikacyjne.');
        Configuration::updateValue('CONTACTFORM_TEXT2', 'Oświadczam, że zapoznałem/zapoznałam się z Regulaminem i akceptuję jego treść.');
        
        return $return;
    }

    public function uninstall()
    {
        $this->unregisterHook('createAccountForm');
        $this->unregisterHook('displayCustomerIdentityForm');
        $this->unregisterHook('actionBeforeSubmitAccount');
        $this->unregisterHook('orderClauses');
        $this->unregisterHook('newsletterClauses');
        $this->unregisterHook('header');
        $this->unregisterHook('footer');
        $this->unregisterHook('orderDetailDisplayed');
        $this->unregisterHook('displayAdminCustomers');
        $this->unregisterHook('displayAdminOrder');
        $this->unregisterHook('actionCustomerAccountAdd');
        $this->unregisterHook('contactformClauses');
        $this->unregisterHook('customerAccount');
        if (parent::uninstall()) {
            return true;
        }
        return false;
    }

    public function getContent()
    {
        if (Tools::isSubmit('submitCustPrivMess')) {
            $this->_postProcess();
        } else {
            $this->_html .= '<br />';
        }

        $this->_html .= '<h2>'.$this->displayName.' (v'.$this->version.')</h2><p>'.$this->description.'</p>';
         
        $this->context->smarty->assign('module_dir', $this->_path);
        $this->_html .= $this->context->smarty->fetch($this->local_path.'views/templates/admin/configure.tpl');
        $this->_html .= $this->renderForm();
        $this->_html .= $this->_displayExtraForm();
        $this->_html .= $this->_displayExtraFormForNewsletter();
        $this->_html .= $this->_displayExtraFormForContactForm();

        return $this->_html;
    }

    private function _postProcess()
    {
        if (Tools::isSubmit('submitCustPrivMess')) {
            Configuration::updateValue('ANONIMIZE_ACCOUNT', (int)Tools::getValue('ANONIMIZE_ACCOUNT'));
            Configuration::updateValue('DELETE_ACCOUNT', (int)Tools::getValue('DELETE_ACCOUNT'));
            Configuration::updateValue('UNSUBSCRIBE_NEWSLETTER', (int)Tools::getValue('UNSUBSCRIBE_NEWSLETTER'));
            Configuration::updateValue('GET_ALL_CUSTOMER_DATA', (int)Tools::getValue('GET_ALL_CUSTOMER_DATA'));
            
            Configuration::updateValue('COOKIES_MESSAGE', Tools::getValue('COOKIES_MESSAGE'), true);
            Configuration::updateValue('COOKIES_AUTH', (int)Tools::getValue('COOKIES_AUTH'));
            
            Configuration::updateValue('NEWSLETTER_MESSAGE1', Tools::getValue('NEWSLETTER_MESSAGE1'), true);
            Configuration::updateValue('NEWSLETTER_MESSAGE2', Tools::getValue('NEWSLETTER_MESSAGE2'), true);
            Configuration::updateValue('NEWSLETTER_AUTH1', (int)Tools::getValue('NEWSLETTER_AUTH1'));
            Configuration::updateValue('NEWSLETTER_AUTH2', (int)Tools::getValue('NEWSLETTER_AUTH2'));

            Configuration::updateValue('CONTACTFORM_TEXT1', Tools::getValue('CONTACTFORM_TEXT1'), true);
            Configuration::updateValue('CONTACTFORM_TEXT2', Tools::getValue('CONTACTFORM_TEXT2'), true);
            Configuration::updateValue('CONTACTFORM_ALLOW1', (int)Tools::getValue('CONTACTFORM_ALLOW1'));
            Configuration::updateValue('CONTACTFORM_ALLOW2', (int)Tools::getValue('CONTACTFORM_ALLOW2'));
            
            Configuration::updateValue('CUSTPRIV_MSG_AUTH1', Tools::getValue('CUSTPRIV_MSG_AUTH1'), true);
            Configuration::updateValue('CUSTPRIV_MSG_AUTH2', Tools::getValue('CUSTPRIV_MSG_AUTH2'), true);
            Configuration::updateValue('CUSTPRIV_MSG_AUTH3', Tools::getValue('CUSTPRIV_MSG_AUTH3'), true);
            Configuration::updateValue('CUSTPRIV_MSG_IDENTITY1', Tools::getValue('CUSTPRIV_MSG_IDENTITY1'), true);
            Configuration::updateValue('CUSTPRIV_MSG_IDENTITY2', Tools::getValue('CUSTPRIV_MSG_IDENTITY2'), true);
            Configuration::updateValue('CUSTPRIV_MSG_IDENTITY3', Tools::getValue('CUSTPRIV_MSG_IDENTITY3'), true);
            Configuration::updateValue('CUSTPRIV_MSG_IDENTITY4', Tools::getValue('CUSTPRIV_MSG_IDENTITY4'), true);

            Configuration::updateValue('CUSTPRIV_AUTH_PAGE1', (int)Tools::getValue('CUSTPRIV_AUTH_PAGE1'));
            Configuration::updateValue('CUSTPRIV_AUTH_PAGE2', (int)Tools::getValue('CUSTPRIV_AUTH_PAGE2'));
            Configuration::updateValue('CUSTPRIV_AUTH_PAGE3', (int)Tools::getValue('CUSTPRIV_AUTH_PAGE3'));
            Configuration::updateValue('CUSTPRIV_IDENTITY_PAGE1', (int)Tools::getValue('CUSTPRIV_IDENTITY_PAGE1'));
            Configuration::updateValue('CUSTPRIV_IDENTITY_PAGE2', (int)Tools::getValue('CUSTPRIV_IDENTITY_PAGE2'));
            Configuration::updateValue('CUSTPRIV_IDENTITY_PAGE3', (int)Tools::getValue('CUSTPRIV_IDENTITY_PAGE3'));
            Configuration::updateValue('CUSTPRIV_IDENTITY_PAGE4', (int)Tools::getValue('CUSTPRIV_IDENTITY_PAGE4'));

            $this->_clearCache('pdrodopro.tpl');
            $this->_clearCache('pdrodopro-simple.tpl');
            $this->_html .= $this->displayConfirmation($this->l('Zaktualizowano dane.'));
        }
    }




    private function _displayExtraForm()
    {
        $this->_html .= '<fieldset class="panel">
						<div class="panel-heading">
							<i class="icon-cogs"></i>'.$this->l('Instrukcja instalacji').'
						</div>
						<div class="form-wrapper">
							'.$this->l('KROK1: Proszę otworzyć plik:').'
							<b>themes/nazwa_szablonu/order-carier.tpl</b>
							'.$this->l('Poniżej kodu:').'
							<xmp>
<div class="box">
	<p class="checkbox">
		<input type="checkbox" name="cgv" id="cgv" value="1" {if $checkedTOS}checked="checked"{/if} />
		<label for="cgv">{l s=\'I agree to the terms of service and will adhere to them unconditionally.\'}</label>
		<a href="{$link_conditions|escape:\'html\':\'UTF-8\'}" class="iframe" rel="nofollow">{l s=\'(Read the Terms of Service)\'}</a>
	</p>
</div>
							</xmp>
							'.$this->l('Należy dodać:').'
							<textarea name="code" cols="40" rows="1">
{hook h=\'orderClauses\'}
							</textarea>

							</div>
						</fieldset>';
    }

    private function _displayExtraFormForNewsletter()
    {
        $this->_html .= '<fieldset class="panel">
						<div class="panel-heading">
							<i class="icon-cogs"></i>'.$this->l('Instrukcja instalacji dla bloku newslettera').'
						</div>
						<div class="form-wrapper">
							'.$this->l('KROK1: Proszę otworzyć plik:').'
							<b>themes/nazwa_szablonu/modules/blocknewsletter/blocknewsletter.tpl</b>
							'.$this->l('Poniżej kodu:').'
							<xmp>
<button type="submit" name="submitNewsletter" class="btn btn-default button button-small">
    <span>{l s=\'Ok\' mod=\'blocknewsletter\'}</span>
</button>
<input type="hidden" name="action" value="0" />
							</xmp>
							'.$this->l('Należy dodać:').'
							<textarea name="code" cols="40" rows="1">
{hook h=\'newsletterClauses\'}
							</textarea>
							</div>
						</fieldset>';
    }

    private function _displayExtraFormForContactForm()
    {
        $this->_html .= '<fieldset class="panel">
						<div class="panel-heading">
							<i class="icon-cogs"></i>'.$this->l('Instrukcja instalacji dla formularza kontaktowego:').'
						</div>
						<div class="form-wrapper">
							'.$this->l('KROK1: Proszę otworzyć plik:').'
							<b>themes/nazwa_szablonu/contact-form.tpl</b>
							'.$this->l('Powyżej kodu:').'
							<xmp>
<div class="submit">
	<button type="submit" name="submitMessage" id="submitMessage" class="button btn btn-default button-medium"><span>{l s=\'Send\'}<i class="icon-chevron-right right"></i></span></button>
</div>
							</xmp>
							'.$this->l('Należy dodać:').'
							<textarea name="code" cols="40" rows="1">
{hook h=\'contactformClauses\'}
							</textarea>
							</div>
						</fieldset>';
    }
    
    public function checkConfig($switch_key, $msg_key)
    {
        if (!$this->active) {
            return false;
        }

        if (!Configuration::get($switch_key)) {
            return false;
        }

        $message = Configuration::get($msg_key, $this->context->language->id);
        if (empty($message)) {
            return false;
        }

        return true;
    }

    public function hookActionBeforeSubmitAccount($params)
    {
        if (!Tools::getValue('customer_privacy1') && Configuration::get('CUSTPRIV_AUTH_PAGE1')) {
            $this->context->controller->errors[] = $this->l('Musisz zaakceptować zgodę nr1.');
        }
        
        if (!Tools::getValue('customer_privacy2') && Configuration::get('CUSTPRIV_AUTH_PAGE2')) {
            $this->context->controller->errors[] = $this->l('Musisz zaakceptować zgodę nr2.');
        }
        
        if (!Tools::getValue('customer_privacy3') && Configuration::get('CUSTPRIV_AUTH_PAGE3')) {
            $this->context->controller->errors[] = $this->l('Musisz zaakceptować zgodę nr3.');
        }

        if (Tools::getValue('newsletter') && !Tools::getValue('newsletter_allow') && Configuration::get('NEWSLETTER_AUTH1')) {
            $this->context->controller->errors[] = $this->l('Musisz zaakceptować zgodę newslettera nr1.');
        }

        if (Tools::getValue('optin') && !Tools::getValue('optin_allow') && Configuration::get('NEWSLETTER_AUTH2')) {
            $this->context->controller->errors[] = $this->l('Musisz zaakceptować zgodę newslettera nr2.');
        }
    }

    public function hookCreateAccountForm($params)
    {
        if (!$this->isCached('pdrodopro.tpl', $this->getCacheId())) {
            $this->smarty->assign('privacy_message1', strip_tags(Configuration::get('CUSTPRIV_MSG_AUTH1'),'<a>'));
            $this->smarty->assign('privacy_message_allow1', Configuration::get('CUSTPRIV_AUTH_PAGE1'));
            $this->smarty->assign('privacy_message2', strip_tags(Configuration::get('CUSTPRIV_MSG_AUTH2'),'<a>'));
            $this->smarty->assign('privacy_message_allow2', Configuration::get('CUSTPRIV_AUTH_PAGE2'));
            $this->smarty->assign('privacy_message3', strip_tags(Configuration::get('CUSTPRIV_MSG_AUTH3'),'<a>'));
            $this->smarty->assign('privacy_message_allow3', Configuration::get('CUSTPRIV_AUTH_PAGE3'));
            $this->smarty->assign('newsletter_message1', strip_tags(Configuration::get('NEWSLETTER_MESSAGE1'),'<a>'));
            $this->smarty->assign('newsletter_message_allow1', Configuration::get('NEWSLETTER_AUTH1'));
            $this->smarty->assign('newsletter_message2', strip_tags(Configuration::get('NEWSLETTER_MESSAGE2'),'<a>'));
            $this->smarty->assign('newsletter_message_allow2', Configuration::get('NEWSLETTER_AUTH2'));
        }

        return $this->display(__FILE__, 'pdrodopro.tpl', $this->getCacheId());
    }

    public function hookDisplayCustomerIdentityForm($params)
    {
        return $this->hookCreateAccountForm($params);
    }

    public function hookOrderDetailDisplayed($params)
    {
        $data = $this->getCartAllows($params['order']->id_cart);

        if (!empty($data)) {
            foreach ($data as $item) {
                if ($item['type_allow']=='cgv2') {
                    $this->smarty->assign('privacy_message1', strip_tags(Configuration::get('CUSTPRIV_MSG_IDENTITY1'),'<a>'));
                    $this->smarty->assign('privacy_message_allow1', Configuration::get('CUSTPRIV_IDENTITY_PAGE1'));
                }
                if ($item['type_allow']=='cgv3') {
                    $this->smarty->assign('privacy_message2', strip_tags(Configuration::get('CUSTPRIV_MSG_IDENTITY2'),'<a>'));
                    $this->smarty->assign('privacy_message_allow2', Configuration::get('CUSTPRIV_IDENTITY_PAGE2'));
                }
                if ($item['type_allow']=='cgv4') {
                    $this->smarty->assign('privacy_message3', strip_tags(Configuration::get('CUSTPRIV_MSG_IDENTITY3'),'<a>'));
                    $this->smarty->assign('privacy_message_allow3', Configuration::get('CUSTPRIV_IDENTITY_PAGE3'));
                }
                if ($item['type_allow']=='cgv5') {
                    $this->smarty->assign('privacy_message4', strip_tags(Configuration::get('CUSTPRIV_MSG_IDENTITY4'),'<a>'));
                    $this->smarty->assign('privacy_message_allow4', Configuration::get('CUSTPRIV_IDENTITY_PAGE4'));
                }
            }
        }

        return $this->display(__FILE__, 'pdrodopro_simple.tpl', $this->getCacheId());
    }

    public function hookDisplayAdminOrder($params)
    {
        $order = new Order($params['id_order']);
        $data = $this->getCartAllows($order->id_cart);

        if (!empty($data)) {
            foreach ($data as $item) {
                if ($item['type_allow']=='cgv2') {
                    $this->smarty->assign('privacy_message1', strip_tags(Configuration::get('CUSTPRIV_MSG_IDENTITY1'),'<a>'));
                    $this->smarty->assign('privacy_message_allow1', Configuration::get('CUSTPRIV_IDENTITY_PAGE1'));
                }
                if ($item['type_allow']=='cgv3') {
                    $this->smarty->assign('privacy_message2', strip_tags(Configuration::get('CUSTPRIV_MSG_IDENTITY2'),'<a>'));
                    $this->smarty->assign('privacy_message_allow2', Configuration::get('CUSTPRIV_IDENTITY_PAGE2'));
                }
                if ($item['type_allow']=='cgv4') {
                    $this->smarty->assign('privacy_message3', strip_tags(Configuration::get('CUSTPRIV_MSG_IDENTITY3'),'<a>'));
                    $this->smarty->assign('privacy_message_allow3', Configuration::get('CUSTPRIV_IDENTITY_PAGE3'));
                }
                if ($item['type_allow']=='cgv5') {
                    $this->smarty->assign('privacy_message4', strip_tags(Configuration::get('CUSTPRIV_MSG_IDENTITY4'),'<a>'));
                    $this->smarty->assign('privacy_message_allow4', Configuration::get('CUSTPRIV_IDENTITY_PAGE4'));
                }
            }
        }

        return $this->display(__FILE__, 'pdrodopro_simple.tpl', $this->getCacheId());
    }

    public function hookDisplayAdminCustomers($params)
    {
        $data = $this->getCustomerAllows($params['id_customer']);
        if (!empty($data)) {
            foreach ($data as $item) {
                if ($item['type_allow']=='customer_privacy1') {
                    $this->smarty->assign('customer_privacy_message1', strip_tags(Configuration::get('CUSTPRIV_MSG_AUTH1'),'<a>'));
                    $this->smarty->assign('customer_privacy1', Configuration::get('CUSTPRIV_AUTH_PAGE1'));
                }
                if ($item['type_allow']=='customer_privacy2') {
                    $this->smarty->assign('customer_privacy_message2', strip_tags(Configuration::get('CUSTPRIV_MSG_AUTH2'),'<a>'));
                    $this->smarty->assign('customer_privacy2', Configuration::get('CUSTPRIV_AUTH_PAGE2'));
                }
                if ($item['type_allow']=='customer_privacy3') {
                    $this->smarty->assign('customer_privacy_message3', strip_tags(Configuration::get('CUSTPRIV_MSG_AUTH3'),'<a>'));
                    $this->smarty->assign('customer_privacy3', Configuration::get('CUSTPRIV_AUTH_PAGE3'));
                }
                if ($item['type_allow']=='newsletter_allow') {
                    $this->smarty->assign('newsletter_message1', strip_tags(Configuration::get('NEWSLETTER_MESSAGE1'),'<a>'));
                    $this->smarty->assign('newsletter_message_allow1', Configuration::get('NEWSLETTER_AUTH1'));
                }
                if ($item['type_allow']=='optin_allow') {
                    $this->smarty->assign('newsletter_message2', strip_tags(Configuration::get('NEWSLETTER_MESSAGE2'),'<a>'));
                    $this->smarty->assign('newsletter_message_allow2', Configuration::get('NEWSLETTER_AUTH2'));
                }
            }
        }

        return $this->display(__FILE__, 'pdrodopro_simple.tpl', $this->getCacheId());
    }

    public function hookHeader()
    {
        $this->context->controller->addCSS($this->_path . 'views/css/styles.css', 'all');
        $this->makeJs();
    }

    public function hookFooter()
    {
        $this->context->controller->addJS($this->_path . 'views/js/scripts.js');

        if (!$this->isCached('footer.tpl', $this->getCacheId())) {
            $this->smarty->assign(array(
                'uecookie' => Configuration::get('COOKIES_MESSAGE'),
                'uecookie_allow' => Configuration::get('COOKIES_AUTH')
            ));
        }
        return $this->display(__FILE__, 'footer.tpl', $this->getCacheId());
    }

    public function hookNewsletterClauses()
    {
        if (!$this->isCached('pdrodopro_newsletter_block.tpl', $this->getCacheId())) {
            $this->smarty->assign('newsletter_message1', strip_tags(Configuration::get('NEWSLETTER_MESSAGE1'),'<a>'));
            $this->smarty->assign('newsletter_message_allow1', Configuration::get('NEWSLETTER_AUTH1'));
        }

        return $this->display(__FILE__, 'pdrodopro_newsletter_block.tpl', $this->getCacheId());
    }

    public function hookOrderClauses()
    {
        if (!$this->isCached('pdrodopro_order.tpl', $this->getCacheId())) {
            $this->smarty->assign('privacy_message1', strip_tags(Configuration::get('CUSTPRIV_MSG_IDENTITY1'),'<a>'));
            $this->smarty->assign('privacy_message_allow1', Configuration::get('CUSTPRIV_IDENTITY_PAGE1'));
            $this->smarty->assign('privacy_message2', strip_tags(Configuration::get('CUSTPRIV_MSG_IDENTITY2'),'<a>'));
            $this->smarty->assign('privacy_message_allow2', Configuration::get('CUSTPRIV_IDENTITY_PAGE2'));
            $this->smarty->assign('privacy_message3', strip_tags(Configuration::get('CUSTPRIV_MSG_IDENTITY3'),'<a>'));
            $this->smarty->assign('privacy_message_allow3', Configuration::get('CUSTPRIV_IDENTITY_PAGE3'));
            $this->smarty->assign('privacy_message4', strip_tags(Configuration::get('CUSTPRIV_MSG_IDENTITY4'),'<a>'));
            $this->smarty->assign('privacy_message_allow4', Configuration::get('CUSTPRIV_IDENTITY_PAGE4'));
        }

        return $this->display(__FILE__, 'pdrodopro_order.tpl', $this->getCacheId());
    }

    public function hookContactformClauses()
    {
        if (!$this->isCached('contactform.tpl', $this->getCacheId())) {
            $this->smarty->assign('contactform_text1', strip_tags(Configuration::get('CONTACTFORM_TEXT1'),'<a>'));
            $this->smarty->assign('contactform_text_allow1', Configuration::get('CONTACTFORM_ALLOW1'));
            $this->smarty->assign('contactform_text2', strip_tags(Configuration::get('CONTACTFORM_TEXT2'),'<a>'));
            $this->smarty->assign('contactform_text_allow2', Configuration::get('CONTACTFORM_ALLOW2'));
        }

        return $this->display(__FILE__, 'contactform.tpl', $this->getCacheId());
    }

    public function hookCustomerAccount()
    {
        if (Configuration::get('ANONIMIZE_ACCOUNT')!=0) {
            $this->smarty->assign(array(
                'anonimize_account_allow' => '1'
            ));
        }
        
        if (Configuration::get('DELETE_ACCOUNT')!=0) {
            $this->smarty->assign(array(
                'delete_account_allow' => '1'
            ));
        }
        
        if (Configuration::get('UNSUBSCRIBE_NEWSLETTER')!=0) {
            $this->smarty->assign(array(
                'unsubscribe_newsletter_allow' => '1'
            ));
        }
        
        if (Configuration::get('GET_ALL_CUSTOMER_DATA')!=0) {
            $this->smarty->assign(array(
                'get_all_customer_data' => '1'
            ));
        }

        return $this->display(__FILE__, 'my_account.tpl');
    }
    
    public function renderForm()
    {
    	$switch = version_compare(_PS_VERSION_, '1.6.0', '>=') ? 'switch' : 'radio';

        $fields_form[]['form'] = array(
                'legend' => array(
                    'title' => $this->l('Konto klienta'),
                    'icon' => 'icon-cogs'
                ),
                'input' => array(
                    array(
                        'type' => $switch,
                    'class' => 't',
                        'label' => $this->l('Pozwól użytkownikowi na anonimizację konta'),
                        'name' => 'ANONIMIZE_ACCOUNT',
                        'values' => array(
                                    array(
                                        'id' => 'active_on',
                                        'value' => 1,
                                        'label' => $this->l('Enabled')
                                    ),
                                    array(
                                        'id' => 'active_off',
                                        'value' => 0,
                                        'label' => $this->l('Disabled')
                                    )
                                ),
                    ),
                    array(
                        'type' => $switch,
                    'class' => 't',
                        'label' => $this->l('Pozwól użytkownikowi na zgłoszenie prośby o usunięcie konta'),
                        'name' => 'DELETE_ACCOUNT',
                        'values' => array(
                                    array(
                                        'id' => 'active_on',
                                        'value' => 1,
                                        'label' => $this->l('Enabled')
                                    ),
                                    array(
                                        'id' => 'active_off',
                                        'value' => 0,
                                        'label' => $this->l('Disabled')
                                    )
                                ),
                    ),
                    array(
                        'type' => $switch,
                    'class' => 't',
                        'label' => $this->l('Pozwól użytkownikowi na usunięcie emaila z bazy danych modułu Newsletter'),
                        'name' => 'UNSUBSCRIBE_NEWSLETTER',
                        'values' => array(
                                    array(
                                        'id' => 'active_on',
                                        'value' => 1,
                                        'label' => $this->l('Enabled')
                                    ),
                                    array(
                                        'id' => 'active_off',
                                        'value' => 0,
                                        'label' => $this->l('Disabled')
                                    )
                                ),
                    ),
                    array(
                        'type' => $switch,
                    'class' => 't',
                        'label' => $this->l('Pozwól użytkownikowi na pobranie wszystkich danych o kliencie'),
                        'name' => 'GET_ALL_CUSTOMER_DATA',
                        'values' => array(
                                    array(
                                        'id' => 'active_on',
                                        'value' => 1,
                                        'label' => $this->l('Enabled')
                                    ),
                                    array(
                                        'id' => 'active_off',
                                        'value' => 0,
                                        'label' => $this->l('Disabled')
                                    )
                                ),
                    )
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                )
        );
        
        $fields_form[]['form'] = array(
                'legend' => array(
                    'title' => $this->l('Komunikat Cookie - wyskakujące okno'),
                    'icon' => 'icon-cogs'
                ),
                'input' => array(
                    array(
                        'type' => $switch,
                    'class' => 't',
                        'label' => $this->l('Wyświetl komunikat cookie'),
                        'name' => 'COOKIES_AUTH',
                        'values' => array(
                                    array(
                                        'id' => 'active_on',
                                        'value' => 1,
                                        'label' => $this->l('Enabled')
                                    ),
                                    array(
                                        'id' => 'active_off',
                                        'value' => 0,
                                        'label' => $this->l('Disabled')
                                    )
                                ),
                    ),
                    array(
                        'type' => 'textarea',
                        'lang' => false,
                        'autoload_rte' => true,
                        'label' => $this->l('Treść komunikatu'),
                        'name' => 'COOKIES_MESSAGE',
                        'desc' => $this->l('')
                    )
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                )
        );
        
        $fields_form[]['form'] = array(
                'legend' => array(
                    'title' => $this->l('Klauzule - proces tworzenia konta'),
                    'icon' => 'icon-cogs'
                ),
                'input' => array(
                    array(
                        'type' => $switch,
                    'class' => 't',
                        'label' => $this->l('Wyświetl klauzulę nr1.'),
                        'name' => 'CUSTPRIV_AUTH_PAGE1',
                        'values' => array(
                                    array(
                                        'id' => 'active_on',
                                        'value' => 1,
                                        'label' => $this->l('Enabled')
                                    ),
                                    array(
                                        'id' => 'active_off',
                                        'value' => 0,
                                        'label' => $this->l('Disabled')
                                    )
                                ),
                    ),
                    array(
                        'type' => 'textarea',
                        'lang' => false,
                        'autoload_rte' => true,
                        'label' => $this->l('Treść klauzuli nr1.:'),
                        'name' => 'CUSTPRIV_MSG_AUTH1',
                        'desc' => $this->l('')
                    ),
                    array(
                        'type' => $switch,
                    'class' => 't',
                        'label' => $this->l('Wyświetl klauzulę nr2.'),
                        'name' => 'CUSTPRIV_AUTH_PAGE2',
                        'values' => array(
                                    array(
                                        'id' => 'active_on',
                                        'value' => 1,
                                        'label' => $this->l('Enabled')
                                    ),
                                    array(
                                        'id' => 'active_off',
                                        'value' => 0,
                                        'label' => $this->l('Disabled')
                                    )
                                ),
                    ),
                    array(
                        'type' => 'textarea',
                        'lang' => false,
                        'autoload_rte' => true,
                        'label' => $this->l('Treść klauzuli nr2.:'),
                        'name' => 'CUSTPRIV_MSG_AUTH2',
                        'desc' => $this->l('')
                    ),
                    array(
                        'type' => $switch,
                    'class' => 't',
                        'label' => $this->l('Wyświetl klauzulę nr3.'),
                        'name' => 'CUSTPRIV_AUTH_PAGE3',
                        'values' => array(
                                    array(
                                        'id' => 'active_on',
                                        'value' => 1,
                                        'label' => $this->l('Enabled')
                                    ),
                                    array(
                                        'id' => 'active_off',
                                        'value' => 0,
                                        'label' => $this->l('Disabled')
                                    )
                                ),
                    ),
                    array(
                        'type' => 'textarea',
                        'lang' => false,
                        'autoload_rte' => true,
                        'label' => $this->l('Treść klauzuli nr3.:'),
                        'name' => 'CUSTPRIV_MSG_AUTH3',
                        'desc' => $this->l('')
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                )
        );
        
        $fields_form[]['form'] = array(
                'legend' => array(
                    'title' => $this->l('Klauzule - proces zakupowy'),
                    'icon' => 'icon-cogs'
                ),
                'input' => array(
                    array(
                        'type' => $switch,
                    'class' => 't',
                        'label' => $this->l('Wyświetl klauzulę nr1.'),
                        'name' => 'CUSTPRIV_IDENTITY_PAGE1',
                        'values' => array(
                                    array(
                                        'id' => 'active_on',
                                        'value' => 1,
                                        'label' => $this->l('Enabled')
                                    ),
                                    array(
                                        'id' => 'active_off',
                                        'value' => 0,
                                        'label' => $this->l('Disabled')
                                    )
                                ),
                    ),
                    array(
                        'type' => 'textarea',
                        'lang' => false,
                        'autoload_rte' => true,
                        'label' => $this->l('Treść klauzuli nr1.'),
                        'name' => 'CUSTPRIV_MSG_IDENTITY1',
                        'desc' => $this->l('')
                    ),
                    array(
                        'type' => $switch,
                    'class' => 't',
                        'label' => $this->l('Wyświetl klauzulę nr2.'),
                        'name' => 'CUSTPRIV_IDENTITY_PAGE2',
                        'values' => array(
                                    array(
                                        'id' => 'active_on',
                                        'value' => 1,
                                        'label' => $this->l('Enabled')
                                    ),
                                    array(
                                        'id' => 'active_off',
                                        'value' => 0,
                                        'label' => $this->l('Disabled')
                                    )
                                ),
                    ),
                    array(
                        'type' => 'textarea',
                        'lang' => false,
                        'autoload_rte' => true,
                        'label' => $this->l('Treść klauzuli nr2.'),
                        'name' => 'CUSTPRIV_MSG_IDENTITY2',
                        'desc' => $this->l('')
                    ),
                    array(
                        'type' => $switch,
                    'class' => 't',
                        'label' => $this->l('Wyświetl klauzulę nr3.'),
                        'name' => 'CUSTPRIV_IDENTITY_PAGE3',
                        'values' => array(
                                    array(
                                        'id' => 'active_on',
                                        'value' => 1,
                                        'label' => $this->l('Enabled')
                                    ),
                                    array(
                                        'id' => 'active_off',
                                        'value' => 0,
                                        'label' => $this->l('Disabled')
                                    )
                                ),
                    ),
                    array(
                        'type' => 'textarea',
                        'lang' => false,
                        'autoload_rte' => true,
                        'label' => $this->l('Treść klauzuli nr3.'),
                        'name' => 'CUSTPRIV_MSG_IDENTITY3',
                        'desc' => $this->l('')
                    ),
                    array(
                        'type' => $switch,
                    'class' => 't',
                        'label' => $this->l('Wyświetl klauzulę nr4.'),
                        'name' => 'CUSTPRIV_IDENTITY_PAGE4',
                        'values' => array(
                                    array(
                                        'id' => 'active_on',
                                        'value' => 1,
                                        'label' => $this->l('Enabled')
                                    ),
                                    array(
                                        'id' => 'active_off',
                                        'value' => 0,
                                        'label' => $this->l('Disabled')
                                    )
                                ),
                    ),
                    array(
                        'type' => 'textarea',
                        'lang' => false,
                        'autoload_rte' => true,
                        'label' => $this->l('Treść klauzuli nr4.'),
                        'name' => 'CUSTPRIV_MSG_IDENTITY4',
                        'desc' => $this->l('')
                    ),
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                )
        );
        
        $fields_form[]['form'] = array(
                'legend' => array(
                    'title' => $this->l('Klauzule - podczas akceptacji Newslettera'),
                    'icon' => 'icon-cogs'
                ),
                'input' => array(
                    array(
                        'type' => $switch,
                    'class' => 't',
                        'label' => $this->l('Wyświetl klauzulę nr1.'),
                        'name' => 'NEWSLETTER_AUTH1',
                        'values' => array(
                                    array(
                                        'id' => 'active_on',
                                        'value' => 1,
                                        'label' => $this->l('Enabled')
                                    ),
                                    array(
                                        'id' => 'active_off',
                                        'value' => 0,
                                        'label' => $this->l('Disabled')
                                    )
                                ),
                    ),
                    array(
                        'type' => 'textarea',
                        'lang' => false,
                        'autoload_rte' => true,
                        'label' => $this->l('Treść klauzuli nr1.'),
                        'name' => 'NEWSLETTER_MESSAGE1',
                        'desc' => $this->l('')
                    ),
                    array(
                        'type' => $switch,
                    'class' => 't',
                        'label' => $this->l('Wyświetl klauzulę nr2.'),
                        'name' => 'NEWSLETTER_AUTH2',
                        'values' => array(
                                    array(
                                        'id' => 'active_on',
                                        'value' => 1,
                                        'label' => $this->l('Enabled')
                                    ),
                                    array(
                                        'id' => 'active_off',
                                        'value' => 0,
                                        'label' => $this->l('Disabled')
                                    )
                                ),
                    ),
                    array(
                        'type' => 'textarea',
                        'lang' => false,
                        'autoload_rte' => true,
                        'label' => $this->l('Treść klauzuli nr2.'),
                        'name' => 'NEWSLETTER_MESSAGE2',
                        'desc' => $this->l('')
                    )
                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                )
        );

        $fields_form[]['form'] = array(
            'legend' => array(
                'title' => $this->l('Klauzule - formularz kontaktowy'),
                'icon' => 'icon-cogs'
            ),
            'input' => array(
                array(
                    'type' => $switch,
                    'class' => 't',
                    'label' => $this->l('Wyświetl klauzulę nr1.'),
                    'name' => 'CONTACTFORM_ALLOW1',
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->l('Enabled')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->l('Disabled')
                        )
                    ),
                ),
                array(
                    'type' => 'textarea',
                    'lang' => false,
                    'autoload_rte' => true,
                    'label' => $this->l('Treść klauzuli nr1.'),
                    'name' => 'CONTACTFORM_TEXT1',
                    'desc' => $this->l('')
                ),
                array(
                    'type' => $switch,
                    'class' => 't',
                    'label' => $this->l('Wyświetl klauzulę nr2.'),
                    'name' => 'CONTACTFORM_ALLOW2',
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->l('Enabled')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->l('Disabled')
                        )
                    ),
                ),
                array(
                    'type' => 'textarea',
                    'lang' => false,
                    'autoload_rte' => true,
                    'label' => $this->l('Treść klauzuli nr2.'),
                    'name' => 'CONTACTFORM_TEXT2',
                    'desc' => $this->l('')
                )
            ),
            'submit' => array(
                'title' => $this->l('Save'),
            )
        );

        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table =  $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $this->fields_form = array();

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitCustPrivMess';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFieldsValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id
        );

        return $helper->generateForm($fields_form);
    }

    public function getConfigFieldsValues()
    {
        $return = array();

        $return['ANONIMIZE_ACCOUNT'] = (int)Configuration::get('ANONIMIZE_ACCOUNT');
        $return['DELETE_ACCOUNT'] = (int)Configuration::get('DELETE_ACCOUNT');
        $return['UNSUBSCRIBE_NEWSLETTER'] = (int)Configuration::get('UNSUBSCRIBE_NEWSLETTER');
        $return['GET_ALL_CUSTOMER_DATA'] = (int)Configuration::get('GET_ALL_CUSTOMER_DATA');
        
        $return['COOKIES_AUTH'] = (int)Configuration::get('COOKIES_AUTH');
        $return['COOKIES_MESSAGE'] = Configuration::get('COOKIES_MESSAGE');
        
        $return['NEWSLETTER_AUTH1'] = (int)Configuration::get('NEWSLETTER_AUTH1');
        $return['NEWSLETTER_AUTH2'] = (int)Configuration::get('NEWSLETTER_AUTH2');
        $return['NEWSLETTER_MESSAGE1'] = Configuration::get('NEWSLETTER_MESSAGE1');
        $return['NEWSLETTER_MESSAGE2'] = Configuration::get('NEWSLETTER_MESSAGE2');

        $return['CONTACTFORM_ALLOW1'] = (int)Configuration::get('CONTACTFORM_ALLOW1');
        $return['CONTACTFORM_ALLOW2'] = (int)Configuration::get('CONTACTFORM_ALLOW2');
        $return['CONTACTFORM_TEXT1'] = Configuration::get('CONTACTFORM_TEXT1');
        $return['CONTACTFORM_TEXT2'] = Configuration::get('CONTACTFORM_TEXT2');
        
        $return['CUSTPRIV_AUTH_PAGE1'] = (int)Configuration::get('CUSTPRIV_AUTH_PAGE1');
        $return['CUSTPRIV_AUTH_PAGE2'] = (int)Configuration::get('CUSTPRIV_AUTH_PAGE2');
        $return['CUSTPRIV_AUTH_PAGE3'] = (int)Configuration::get('CUSTPRIV_AUTH_PAGE3');
        $return['CUSTPRIV_IDENTITY_PAGE1'] = (int)Configuration::get('CUSTPRIV_IDENTITY_PAGE1');
        $return['CUSTPRIV_IDENTITY_PAGE2'] = (int)Configuration::get('CUSTPRIV_IDENTITY_PAGE2');
        $return['CUSTPRIV_IDENTITY_PAGE3'] = (int)Configuration::get('CUSTPRIV_IDENTITY_PAGE3');
        $return['CUSTPRIV_IDENTITY_PAGE4'] = (int)Configuration::get('CUSTPRIV_IDENTITY_PAGE4');

        $return['CUSTPRIV_MSG_AUTH1'] = Configuration::get('CUSTPRIV_MSG_AUTH1');
        $return['CUSTPRIV_MSG_AUTH2'] = Configuration::get('CUSTPRIV_MSG_AUTH2');
        $return['CUSTPRIV_MSG_AUTH3'] = Configuration::get('CUSTPRIV_MSG_AUTH3');
        
        $return['CUSTPRIV_MSG_IDENTITY1'] = Configuration::get('CUSTPRIV_MSG_IDENTITY1');
        $return['CUSTPRIV_MSG_IDENTITY2'] = Configuration::get('CUSTPRIV_MSG_IDENTITY2');
        $return['CUSTPRIV_MSG_IDENTITY3'] = Configuration::get('CUSTPRIV_MSG_IDENTITY3');
        $return['CUSTPRIV_MSG_IDENTITY4'] = Configuration::get('CUSTPRIV_MSG_IDENTITY4');

        return $return;
    }

    public static function createTables()
    {
        $sql = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'pdrodopro`(
            `id`  INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `id_customer` int(10) unsigned NOT NULL,
			`id_cart` int(10) unsigned NOT NULL,
			`typee` varchar(255) NULL,
			`type_allow` varchar(255) NULL,
			`dateadd` datetime NULL,
			`date_update` datetime NULL
			) ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8';

        return Db::getInstance()->execute($sql);
    }

    public function hookActionCustomerAccountAdd()
    {
        if (Tools::getValue('customer_privacy1') && Configuration::get('CUSTPRIV_AUTH_PAGE1')) {
            $fields[] = 'customer_privacy1';
        }
        if (Tools::getValue('customer_privacy2') && Configuration::get('CUSTPRIV_AUTH_PAGE2')) {
            $fields[] = 'customer_privacy2';
        }
        if (Tools::getValue('customer_privacy3') && Configuration::get('CUSTPRIV_AUTH_PAGE3')) {
            $fields[] = 'customer_privacy3';
        }
        if (Tools::getValue('newsletter') && Tools::getValue('newsletter_allow') && Configuration::get('NEWSLETTER_AUTH1')) {
            $fields[] = 'newsletter_allow';
        }
        if (Tools::getValue('optin') && Tools::getValue('optin_allow') && Configuration::get('NEWSLETTER_AUTH2')) {
            $fields[] = 'optin_allow';
        }

        if (!empty($fields)) {
            foreach ($fields as $typeField) {
                $isset = $this->checkIssetItem(
                            'create_account',
                            $this->context->customer->id,
                            $this->context->cart->id,
                            $typeField
                        );
                if (!$isset) {
                    $this->insertDatabase(
                                'create_account',
                                $this->context->cart->id,
                                $this->context->customer->id,
                                $typeField
                            );
                } else {
                    $this->updateDatabase(
                                'create_account',
                                $this->context->cart->id,
                                $this->context->customer->id,
                                $typeField,
                                $isset['0']['id']
                            );
                }
            }
        }
    }

    public function insertDatabase($type, $id_cart, $id_customer, $type_allow)
    {
        $sql = 'INSERT INTO ' . _DB_PREFIX_ . 'pdrodopro (id_customer, id_cart, typee, type_allow, dateadd)
				VALUES (' . (int)$id_customer . ', ' . (int)$id_cart . ', "' . pSQL($type) . '", "' . pSQL($type_allow) . '", NOW())';

        if (Db::getInstance()->execute($sql)) {
            return (int)Db::getInstance()->Insert_ID();
        }

        return false;
    }

    public function insertDatabaseByCustomer($type, $id_customer, $type_allow)
    {
        $sql = 'INSERT INTO ' . _DB_PREFIX_ . 'pdrodopro (id_customer, id_cart, typee, type_allow, dateadd)
				VALUES (' . (int)$id_customer . ', 0, "' . pSQL($type) . '", "' . pSQL($type_allow) . '", NOW())';

        if (Db::getInstance()->execute($sql)) {
            return (int)Db::getInstance()->Insert_ID();
        }

        return false;
    }

    public function makeJs()
    {
        $this->addJsVar(
            [
                'baseUri' => Context::getContext()->shop->getBaseURL(true),
            ]
        );
    }

    public function addJsVar($array)
    {
        Media::addJsDef(['pdrodopro' => $array]);
        return true;
    }

    public static function dropTables()
    {
        $sql = 'DROP TABLE
			`'._DB_PREFIX_.'pdrodopro`
		';

        $result = Db::getInstance()->execute($sql);

        return $result;
    }

    public function checkIssetItem($type, $id_customer, $id_cart, $typeField)
    {
        $sql = 'SELECT id FROM ' . _DB_PREFIX_ . 'pdrodopro WHERE type_allow="' . addslashes($typeField) . '" AND typee="' . addslashes($type) . '" AND id_cart="' . (int)$id_cart . '" AND id_customer="' . (int)$id_customer . '"';
        $result = Db::getInstance()->executeS($sql, true, false);
        return $result ? $result : false;
    }

    public function getCustomerAllows($id_customer)
    {
        $sql = 'SELECT * FROM ' . _DB_PREFIX_ . 'pdrodopro WHERE id_customer="' . (int)$id_customer . '"';
        $result = Db::getInstance()->executeS($sql, true, false);
        return $result ? $result : false;
    }

    public function getCartAllows($id_cart)
    {
        $sql = 'SELECT * FROM ' . _DB_PREFIX_ . 'pdrodopro WHERE id_cart="' . (int)$id_cart . '" AND type_allow LIKE "%cgv%"';
        $result = Db::getInstance()->executeS($sql, true, false);
        return $result ? $result : false;
    }

    public function checkIssetItemByCustomer($type, $id_customer, $typeField)
    {
        $sql = 'SELECT id FROM ' . _DB_PREFIX_ . 'pdrodopro WHERE type_allow="' . addslashes($typeField) . '" AND typee="' . addslashes($type) . '" AND id_customer="' . (int)$id_customer . '"';
        $result = Db::getInstance()->executeS($sql, true, false);
        return $result ? $result : false;
    }

    public function getDataByUser($id_customer)
    {
        $sql = 'SELECT * FROM ' . _DB_PREFIX_ . 'pdrodopro WHERE id_customer="' . (int)$id_customer . '"';
        $result = Db::getInstance()->executeS($sql, true, false);
        return $result ? $result : false;
    }

    public function getDataByCart($id_cart)
    {
        $sql = 'SELECT * FROM ' . _DB_PREFIX_ . 'pdrodopro WHERE id_cart="' . (int)$id_cart . '"';
        $result = Db::getInstance()->executeS($sql, true, false);
        return $result ? $result : false;
    }

    public function updateDatabase($type, $id_cart, $id_customer, $type_allow, $isset)
    {
        $sql = 'UPDATE ' . _DB_PREFIX_ . 'pdrodopro
			SET typee = "' . pSQL($type) . '", date_update = NOW(),
			id_customer = "' . (int)$id_customer . '",
			id_cart = "' . (int)$id_cart . '",
			type_allow = "' . pSQL($type_allow) . '" 
			WHERE id = "' . (int)$isset . '"';

        return Db::getInstance()->execute($sql);
    }

    public function updateDatabaseByCustomer($type, $id_customer, $type_allow, $isset)
    {
        $sql = 'UPDATE ' . _DB_PREFIX_ . 'pdrodopro
			SET typee = "' . pSQL($type) . '", date_update = NOW(),
			id_customer = "' . (int)$id_customer . '",
			type_allow = "' . pSQL($type_allow) . '" 
			WHERE id = "' . (int)$isset . '"';

        return Db::getInstance()->execute($sql);
    }

    public function removeAllow($type, $id_customer, $type_allow)
    {
        $sql = 'DELETE FROM ' . _DB_PREFIX_ . 'pdrodopro
			WHERE typee = "' . pSQL($type) . '" AND id_customer = "' . (int)$id_customer . '"
			AND	type_allow = "' . pSQL($type_allow) . '"';

        return Db::getInstance()->execute($sql);
    }
}
