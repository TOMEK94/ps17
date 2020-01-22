<?php
/**
 * 2007-2013 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
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
 *   @author    Buy-addons <contact@buy-addons.com>
 *   @copyright 2007-2015 PrestaShop SA
 *   @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *   International Registered Trademark & Property of PrestaShop SA
 */

class Ba_importer extends Module
{

    const EACH = -1;

    public $webservice_url = 'http://webcron.prestashop.com/crons';
    public $shop_id;
    public function __construct()
    {
        $this->name = "ba_importer";
        $this->tab = "quick_bulk_update";
        $this->version = "1.0.58";
        $this->author = "buy-addons";
        $this->need_instance = 0;
        $this->secure_key = Tools::encrypt($this->name);
        $this->module_key = '53cbc72d58a88d2b87124fd4ced20701';
        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = $this->l('Prestashop Importer - import product from csv, xls, xlsx');
        $this->description = $this->l('Author: buy-addons');
        // $this->ps_versions_compliancy = array('min' => '1.5', 'max' => _PS_VERSION_);
        if ($this->_path == null) {
            $this->_path = __PS_BASE_URI__ . 'modules/' . $this->name . '/';
        }
    }

    public function install()
    {
        $db = Db::getInstance(_PS_USE_SQL_SLAVE_);
        
        $ct_importer_config = 'CREATE TABLE IF NOT EXISTS ' . _DB_PREFIX_ . 'ba_importer_config (
            `id_importer_config` int(11) unsigned NOT NULL auto_increment,
            `id_shop` int(11) unsigned DEFAULT NULL,
            `ba_name_setting` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
            `ba_name_file` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
            `import_local` int(11) unsigned DEFAULT NULL,
            `ba_step1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
            `ba_step2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
            `ba_step3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
            `date_add` datetime DEFAULT NULL,
            `date_up` datetime DEFAULT NULL,
            PRIMARY KEY (`id_importer_config`)
        )';
        $db->query($ct_importer_config);
        
        $ct_ba_cronjobs = 'CREATE TABLE IF NOT EXISTS ' . _DB_PREFIX_ . 'ba_cronjobs_importer (
            `id_cronjob` int(11) unsigned NOT NULL auto_increment,
            `id_importer_config` int(11) unsigned NOT NULL,
            `ba_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
            `hour` int(11) DEFAULT NULL,
            `day` int(11) DEFAULT NULL,
            `month` int(11) DEFAULT NULL,
            `day_of_week` int(11) DEFAULT NULL,
            `update_at` datetime DEFAULT NULL,
            `id_shop` int(11) unsigned DEFAULT NULL,
            `id_shop_group` int(11) unsigned DEFAULT NULL,
            `CONFIGN_DATA_POST` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
            `imported` int(11) unsigned DEFAULT NULL,
            PRIMARY KEY (`id_cronjob`, `id_importer_config`)
        )';
        $db->query($ct_ba_cronjobs);
        
        $list_id_shop = Shop::getCompleteListOfShopsID();
        foreach ($list_id_shop as $key_list => $value) {
            $value;
            $insert_importer_config = 'INSERT INTO ' . _DB_PREFIX_ . 'ba_importer_config (
                `id_shop`,`ba_name_setting`,`import_local`,`ba_step1`,`date_add`,`date_up`
            ) VALUES (
                \''. (int) $list_id_shop[$key_list].'\',
                \'Setting 1\',
                \'1\',
                \'{"select_settings":"1","name_settings":"Setting 1","import_local":"1","ftp_server":"",'
                   .'"ftp_user_name":"",'
                   .'"ftp_user_pass":"","ftp_link_excel":"","url_excel":"","new_items":"Add",'
                   .'"existing_items":"Update","identify_existing_items":"- None -","import_items":"All",'
                   .'"product_start":"1","product_end":"1000","characters_csv":",","characters_category":"/",'
                   .'"import_header":"0","multi_lang":"1","combi_quanti":"1","cate_exist":"1",'
                   .'"manu_exist":"1","sup_exist":"1","identify_existing_items_combi":"Attributes",'
                   .'"baencode":"utf8","product_type":"product_standard","submitimport":"","tab":"AdminModules"}\',
                NOW(),NOW()
            )';
            //var_dump($insert_importer_config);
            $db->query($insert_importer_config);
        }
        Configuration::updateGlobalValue('baautoimpor_is_run', 0);
        Configuration::updateValue('CRONJOBS_MODE', 'webservice');
        Configuration::updateValue('CRONJOB_BA_IMPORT_WEBSERVICE_ID', 0);
        $token = Tools::encrypt(Tools::getShopDomainSsl() . time());
        Configuration::updateGlobalValue('CRONJOBS_EXECUTION_TOKEN', $token);
        $confign_bc1 = '{"select_settings":"1","name_settings":"Setting 1","import_local":"1",'
                           .'"ftp_server":"","ftp_user_name":"","ftp_user_pass":"",'
                           .'"ftp_link_excel":"","url_excel":"","new_items":"Add",'
                           .'"existing_items":"Update","identify_existing_items":"- None -","import_items":"All",'
                           .'"product_start":"1","product_end":"1000","characters_csv":",","characters_category":"/",'
                           .'"import_header":"0","multi_lang":"1","combi_quanti":"1","cate_exist":"1",'
                           .'"manu_exist":"1","sup_exist":"1","identify_existing_items_combi":"Attributes",'
                           .'"baencode":"utf8","product_type":"product_standard",'
                           .'"submitimport":"","tab":"AdminModules"}';
        
        $list_id_shop = Shop::getCompleteListOfShopsID();
        foreach ($list_id_shop as $key_list => $value) {
            Configuration::updateValue('CONFIGN_IMPORTER_BC1', $confign_bc1, false, '', $list_id_shop[$key_list]);
            Configuration::updateValue('CONFIG_SELECT_IMPORTER', null, false, '', $list_id_shop[$key_list]);
            Configuration::updateValue('CONFIGN_CRONJOB', null, false, '', $list_id_shop[$key_list]);
        }
        $id_shop = $this->context->shop->id;
        Configuration::updateValue('ba_id_shop', $id_shop, false, '', '');
        $this->saveDefaultConfig();
        $this->installTab();
        if (parent::install() == false || !$this->registerHook('DisplayBackOfficeHeader')) {
            return false;
        }
        return true;
    }

    public function uninstall()
    {
        $this->uninstallTab();
        $sql = "DROP TABLE IF EXISTS " . _DB_PREFIX_ . "ba_abandoned_img;";
        Db::getInstance()->query($sql);
        $sql2 = "DROP TABLE IF EXISTS " . _DB_PREFIX_ . "ba_importer_config";
        Db::getInstance()->query($sql2);
        $sql3 = "DROP TABLE IF EXISTS " . _DB_PREFIX_ . "ba_cronjobs_importer";
        Db::getInstance()->query($sql3);
        if (parent::uninstall() == false) {
            return false;
        }
        return true;
    }

    public function installTab()
    {
        $tab = new Tab();
        $tab->active = 1;
        $tab->name = array();
        $tab->class_name = 'AdminBaCronJobs';

        foreach (Language::getLanguages(true) as $lang) {
            $tab->name[$lang['id_lang']] = 'Test Cron Jobs';
        }

        $tab->id_parent = -1;
        $tab->module = $this->name;

        return $tab->add();
    }

    public function uninstallTab()
    {
        $id_tab = (int) Tab::getIdFromClassName('AdminBaCronJobs');

        if ($id_tab) {
            $tab = new Tab($id_tab);
            return $tab->delete();
        }

        return false;
    }

    public function saveDefaultConfig()
    {

        $sql = "
            CREATE TABLE IF NOT EXISTS `" . _DB_PREFIX_ . "cronjobs` (
                `id_cronjob` int(10) NOT NULL AUTO_INCREMENT,
                `id_module` int(10) DEFAULT NULL,
                `description` text,
                `task` text,
                `hour` int(11) DEFAULT '-1',
                `day` int(11) DEFAULT '-1',
                `month` int(11) DEFAULT '-1',
                `day_of_week` int(11) DEFAULT '-1',
                `updated_at` datetime DEFAULT NULL,
                `one_shot` tinyint(1) NOT NULL DEFAULT '0',
                `active` tinyint(1) DEFAULT '0',
                `id_shop` int(11) DEFAULT '0',
                `id_shop_group` int(11) DEFAULT '0',
                PRIMARY KEY (`id_cronjob`),
                KEY `id_module` (`id_module`)
            );
            CREATE TABLE IF NOT EXISTS `" . _DB_PREFIX_ . "ba_abandoned_img` (
              `id_img` int(11) NOT NULL,
              `name_img` varchar(255) NOT NULL,
              `id_product` int(11) NOT NULL,
              UNIQUE KEY `id_img` (`id_img`,`name_img`,`id_product`)
            );
        ";
        Db::getInstance()->query($sql);
        //Insert to table cronjobs
        $baseUrl = _PS_BASE_URL_ . __PS_BASE_URI__;
        $task = urlencode($baseUrl . 'modules/ba_importer/autoimport.php?batoken='.$this->cookiekeymodule().'');
        $sql = 'SELECT id_cronjob FROM ' . _DB_PREFIX_ . 'cronjobs WHERE `task` = \''
                . $task . '\' AND `hour` = \'-1\' AND `day` = \'-1\' AND `month` = \'-1\' AND `day_of_week` = \'-1\'';
        $resultCronjob = Db::getInstance()->getValue($sql);
        if ($resultCronjob == false) {
            $id_shop = (int) Context::getContext()->shop->id;
            $id_shop_group = (int) Context::getContext()->shop->id_shop_group;

            $query = 'INSERT INTO ' . _DB_PREFIX_ . 'cronjobs
                (`description`, `task`, `hour`, `day`, `month`, `day_of_week`,
                `updated_at`, `active`, `id_shop`, `id_shop_group`)
                VALUES (\'Ba_importer.\', \'' . $task . '\', \'-1\', \'-1\', \'-1\', \'-1\', NULL, TRUE, '
                    . $id_shop . ', ' . $id_shop_group . ')';

            Db::getInstance()->execute($query);
        }
        $id_cronjob = Db::getInstance()->Insert_ID();
        Configuration::updateValue('BA_IMPORTER_ID_CRONJOB', $id_cronjob);
        $this->updateWebservice(true);
        //End insert to table cronjobs
    }

    public function hookDisplayBackOfficeHeader()
    {
        $out = '<script>var baimporter_ajax_url = "' . $this->_path . 'ajax.php' . '";</script>';
        $out .= '<script>var baimporter_token = "' . sha1(_COOKIE_KEY_ . 'baimporter') . '";</script>';
        $out .= '<script>var batoken = "' . $this->cookiekeymodule() . '";</script>';
        $out .= '<script>var alert_name_setting = "' . $this->l('Name Setting is required') . '";</script>';
        return $out;
    }

    public $html = "";
    public $demo_mode = false;
    public $number_add_product = 10;

    public function getContent()
    {
        //var_dump($this->calcPricebeforeTax(55,1));die;
        $this->selectSettings();
        $this->updateConfigSelect();
        $id_shop = $this->context->shop->id;
        $db = Db::getInstance(_PS_USE_SQL_SLAVE_);
        $this->updateWebservice(true);
        $token = Tools::getAdminTokenLite('AdminModules');
        $advance = AdminController::$currentIndex;
        $this->smarty->assign('list_setting_url', $advance.'&token='.$token.'&configure='.$this->name);
        $this->smarty->assign('cronjob_date_now', date('l, Y-m-d H:i'));
        $this->context->controller->addCSS($this->_path . 'views/css/style.css');
        $this->context->controller->addJS($this->_path . 'views/js/style.js');
        $this->context->controller->addJS($this->_path . 'views/js/ajax.js');
        
        $buttonDemoArr = array(
            Tools::getValue('deleteba_importer'),
            Tools::getValue('submitBulkdeleteba_importer')
        );
        if ($this->demo_mode==true) {
            foreach ($buttonDemoArr as $buttonDemo) {
                if ($buttonDemo === '') {
                    Tools::redirectAdmin($advance.'&token='.$token.'&configure='.$this->name.'&demoMode=1');
                }
            }
        }
        $demoMode=0;
        if (Tools::getValue('demoMode') == "1") {
            $demoMode=Tools::getValue('demoMode');
        }
        $this->smarty->assign('demoMode', $demoMode);
        $this->html = $this->display(__FILE__, 'views/templates/admin/hook/demomoderror.tpl');
        
        if (Tools::getValue("uploaderror") == 1) {
            $this->html .= "<div class='module_error alert alert-danger'>";
            $this->html .= $this->l = 'Update file error' . "</div>";
        }

        if (Tools::getValue("notexcel") == 1) {
            $this->html .= "<div class='module_error alert alert-danger'>";
            $this->html .= $this->l = 'Invalid File(Excel/CSV)' . "</div>";
        }
        if (Tools::getValue("notzip") == 1) {
            $this->html .= "<div class='module_error alert alert-danger'>";
            $this->html .= $this->l = 'Invalid Images(Zip file)' . "</div>";
        }
        
        
        if (Tools::getValue("notftp") != null) {
            $this->html .= "<div class='module_error alert alert-danger'>";
            $this->html .= $this->l = "Couldn't connect to " . Tools::getValue("notftp")."</div>";
        }
        if (Tools::getValue("notdowload") != null) {
            $this->html .= "<div class='module_error alert alert-danger'>";
            $this->html .= $this->l = "File not found: Please check your path to file "
                         ."(this path alway set from ROOT directory of FTP account)</div>";
        }
        $id_shop = $this->context->shop->id;
        $id_shop_group = $this->context->shop->id_shop_group;
        $id_group = $this->context->shop->id_shop_group;
        Configuration::updateValue('ba_id_shop', $id_shop, false, '', '');
        if (Configuration::get('CONFIGN_CHARACTERS_CSV', null, $id_shop_group, $id_shop) == false) {
            Configuration::updateValue('CONFIGN_CHARACTERS_CSV', ';', false, $id_group, $id_shop);
        }
        if (Configuration::get('CONFIGN_CHARACTERS_CATEGORY', null, $id_shop_group, $id_shop) == false) {
            Configuration::updateValue('CONFIGN_CHARACTERS_CATEGORY', '/', false, $id_group, $id_shop);
        }
        $arr_lang =array();
        $lang = Language::getLanguages();
        foreach ($lang as $value_lang) {
            $arr_lang[$value_lang["id_lang"]] = $value_lang["iso_code"];
        }
        $lang = Language::getLanguages(false);
        foreach ($lang as $value_lang) {
            $arr_lang[$value_lang["id_lang"]] = $value_lang["iso_code"];
        }
        $lang2 = Language::getLanguages();
        $lang2 = Language::getLanguages(false);
        $this->smarty->assign('arr_lang', $arr_lang);
        $this->smarty->assign('lang2', $lang2);
        $this->smarty->assign('multi_lang', Tools::getValue('multi_lang'));
        $characters_csv = Configuration::get('CONFIGN_CHARACTERS_CSV', null, $id_shop_group, $id_shop);
        $this->smarty->assign('characters_csv', $characters_csv);
        $characters_category = Configuration::get('CONFIGN_CHARACTERS_CATEGORY', null, $id_shop_group, $id_shop);
        $this->smarty->assign('characters_category', $characters_category);
        $confign_bc1 = Configuration::get('CONFIGN_IMPORTER_BC1', null, $id_shop_group, $id_shop);
        // var_dump($confign_bc1);die;
        if ($confign_bc1 == false) {
            $confign_bc1 = '{"select_settings":"1","name_settings":"Setting 1","import_local":"1",'
                           .'"ftp_server":"","ftp_user_name":"",'
                           .'"ftp_user_pass":"","ftp_link_excel":"","url_excel":"","new_items":"Add",'
                           .'"existing_items":"Update","identify_existing_items":"- None -",'
                           .'"quantity":"new_quantity",'
                           .'"update_categories":"more_categories","update_images":"more_images",'
                           .'"import_items":"All","product_start":"1","product_end":"1000",'
                           .'"characters_csv":",","characters_category":"/","import_header":"0",'
                           .'"multi_lang":"1","combi_quanti":"1","cate_exist":"1",'
                           .'"manu_exist":"1","sup_exist":"1","identify_existing_items_combi":"Attributes",'
                           .'"baencode":"utf8","product_type":"product_standard",'
                           .'"submitimport":"","tab":"AdminModules"}';
        }
        $arr_confign_bc1 = Tools::jsonDecode($confign_bc1, true);
        if (!empty($arr_confign_bc1)) {
            //var_dump($arr_confign_bc1);die;
            if (!isset($arr_confign_bc1['quantity'])) {
                $arr_confign_bc1['quantity'] = "new_quantity";
            }
            if (!isset($arr_confign_bc1['update_categories'])) {
                $arr_confign_bc1['update_categories'] = "more_categories";
            }
            if (!isset($arr_confign_bc1['update_images'])) {
                $arr_confign_bc1['update_images'] = "more_images";
            }
            $this->smarty->assign('arr_confign_bc1', $arr_confign_bc1);
        }
        // $this->html .= $this->display(__FILE__, 'views/templates/admin/hook/settings.tpl');
        $id_shop = $this->context->shop->id;
        $id_im_st = $this->context->cookie->{'ba_importerFilter_id_importer_config'};
        $na_st = $this->context->cookie->{'ba_importerFilter_ba_name_setting'};
        $imp_loc = $this->context->cookie->{'ba_importerFilter_import_local'};
        $na_fi = $this->context->cookie->{'ba_importerFilter_ba_name_file'};
        $date_add_from = $this->context->cookie->{'ba_importerFilter_date_add_0'};
        $date_add_to = $this->context->cookie->{'ba_importerFilter_date_add_1'};
        $date_up_from = $this->context->cookie->{'ba_importerFilter_date_up_0'};
        $date_up_to = $this->context->cookie->{'ba_importerFilter_date_up_1'};
        
        $da_adz = array(
            0 => $date_add_from,
            1 => $date_add_to
        );
        $da_upz = array(
            0 => $date_up_from,
            1 => $date_up_to
        );
        $sql_date_add = $this->getDateAddHelper($da_adz);
        $sql_date_up = $this->getDateUpHelper($da_upz);
        $sql_na_fi = '';
        if ($na_fi != '') {
            $sql_na_fi = ' AND a.ba_name_file LIKE "%'.$na_fi.'%"';
        }
        
        $search_im_st = 'SELECT a.*,b.update_at AS update_at FROM ' . _DB_PREFIX_ . 'ba_importer_config a';
        $search_im_st .= ' LEFT JOIN ' . _DB_PREFIX_ . 'ba_cronjobs_importer b ';
        $search_im_st .= ' ON a.id_importer_config=b.id_importer_config ';
        $search_im_st .= ' WHERE a.id_shop = ' . $id_shop . ' ';
        $search_im_st .= 'AND a.id_importer_config LIKE "%'.$id_im_st.'%" AND a.ba_name_setting LIKE "%'.$na_st.'%" ';
        $search_im_st .= 'AND a.import_local LIKE "%'.$imp_loc.'%" AND IsNull(a.ba_name_file) ';
        $search_im_st .= 'LIKE "%%"' . $sql_na_fi . $sql_date_add . $sql_date_up;
        if (Tools::isSubmit("submitFilter")) {
            $id_im_st = Tools::getValue('ba_importerFilter_id_importer_config');
            $na_st = Tools::getValue('ba_importerFilter_ba_name_setting');
            $imp_loc = Tools::getValue('ba_importerFilter_import_local');
            $na_fi = Tools::getValue('ba_importerFilter_ba_name_file');
            $da_ad = Tools::getValue('local_ba_importerFilter_date_add');
            $da_up = Tools::getValue('local_ba_importerFilter_date_up');
            $dateimeaddz = Tools::getValue('ba_importerFilter_date_add');
            $dateimeaddz2 = serialize($dateimeaddz);
            
            $dateimeupz = Tools::getValue('ba_importerFilter_date_up');
            $dateimeupz2 = serialize($dateimeupz);
            
            $sql_date_add = $this->getDateAddHelper($da_ad);
            $sql_date_up = $this->getDateUpHelper($da_up);
            
            $sql_na_fi = '';
            if ($na_fi != '') {
                $sql_na_fi = ' AND a.ba_name_file LIKE "%'.$na_fi.'%"';
            }
            
            $this->context->cookie->{'ba_importerFilter_id_importer_config'} = $id_im_st;
            $this->context->cookie->{'ba_importerFilter_ba_name_setting'} = $na_st;
            $this->context->cookie->{'ba_importerFilter_import_local'} = $imp_loc;
            $this->context->cookie->{'ba_importerFilter_ba_name_file'} = $na_fi;
            $this->context->cookie->{'ba_importerFilter_date_add_0'} = $da_ad[0];
            $this->context->cookie->{'ba_importerFilter_date_add_1'} = $da_ad[1];
            $this->context->cookie->{'ba_importerFilter_date_up_0'} = $da_up[0];
            $this->context->cookie->{'ba_importerFilter_date_up_1'} = $da_up[1];
            $this->context->cookie->{'ba_importerFilter_date_add'} = $dateimeaddz2;
            $this->context->cookie->{'ba_importerFilter_date_up'} = $dateimeupz2;
            // var_dump($imp_loc);die;
            $search_im_st = 'SELECT a.*, b.update_at AS update_at FROM ' . _DB_PREFIX_ . 'ba_importer_config a';
            $search_im_st .= ' LEFT JOIN ' . _DB_PREFIX_ . 'ba_cronjobs_importer b ';
            $search_im_st .= ' ON a.id_importer_config=b.id_importer_config ';
            $search_im_st .= ' WHERE a.id_shop = ' . $id_shop . ' AND a.id_importer_config LIKE "%'.$id_im_st.'%" ';
            $search_im_st .= 'AND a.ba_name_setting LIKE "%'.$na_st.'%" AND a.import_local LIKE "%'.$imp_loc.'%" ';
            $search_im_st .= 'AND IsNull(a.ba_name_file) LIKE "%%"' . $sql_na_fi . $sql_date_add . $sql_date_up;
            // var_dump($search_im_st);die;
        }
        if (Tools::isSubmit("submitResetba_importer")) {
            $bamodule = AdminController::$currentIndex;
            $token = Tools::getAdminTokenLite('AdminModules');
            $this->context->cookie->{'ba_importerFilter_id_importer_config'} = null;
            $this->context->cookie->{'ba_importerFilter_ba_name_setting'} = null;
            $this->context->cookie->{'ba_importerFilter_import_local'} = null;
            $this->context->cookie->{'ba_importerFilter_ba_name_file'} = null;
            $this->context->cookie->{'ba_importerFilter_date_add_0'} = null;
            $this->context->cookie->{'ba_importerFilter_date_add_1'} = null;
            $this->context->cookie->{'ba_importerFilter_date_up_0'} = null;
            $this->context->cookie->{'ba_importerFilter_date_up_1'} = null;
            $this->context->cookie->{'ba_importerOrderby'} = null;
            $this->context->cookie->{'ba_importerOrderway'} = null;
            unset($this->context->cookie->{'ba_importerFilter_date_add'});
            unset($this->context->cookie->{'ba_importerFilter_date_up'});
            Tools::redirectAdmin($bamodule.'&token='.$token.'&configure='.$this->name.'');
        }
        $viewba_importer = Tools::getValue('viewba_importer');
        $addba_importer = Tools::getValue('addba_importer');
        // var_dump($viewba_importer);
        // var_dump($addba_importer);die;
        if ($viewba_importer === false && $addba_importer === false) {
            $this->html .= $this->initList($search_im_st);
        }
        if ($viewba_importer === false && $addba_importer === '') {
            $this->html .= $this->display(__FILE__, 'views/templates/admin/hook/form.tpl');
        }
        if ($viewba_importer === '' && $addba_importer === false) {
            $this->html .= $this->display(__FILE__, 'views/templates/admin/hook/form.tpl');
        }
        $deleteba_importer = Tools::getValue('deleteba_importer');
        if ($viewba_importer === false && $addba_importer === false && $deleteba_importer === '') {
            $bamodule = AdminController::$currentIndex;
            $token = Tools::getAdminTokenLite('AdminModules');
            $delete_id_importer_config = (int) Tools::getValue('id_importer_config');
            $sql = 'DELETE FROM '._DB_PREFIX_.'ba_importer_config WHERE ';
            $sql .= 'id_importer_config='. $delete_id_importer_config;
            $db->query($sql);
            // xoa tu bang ba_cronjobs_importer
            $id_remove = (int) $delete_id_importer_config;
            $sql = 'DELETE FROM '._DB_PREFIX_.'ba_cronjobs_importer WHERE id_importer_config='.$id_remove;
            $db->query($sql);
            $table_name = 'ba_importer_data_'.$id_remove;
            $sql_drop_table = 'DROP TABLE IF EXISTS ' . _DB_PREFIX_ . $table_name;
            $db->query($sql_drop_table);
            Tools::redirectAdmin($bamodule.'&token='.$token.'&configure='.$this->name.'');
            // var_dump($db->query($sql));die;
        }
        // remove All
        if (Tools::isSubmit("submitBulkdeleteba_importer")) {
            $ids = Tools::getValue('ba_importerBox');
            if (!empty($ids)) {
                $bamodule = AdminController::$currentIndex;
                $token = Tools::getAdminTokenLite('AdminModules');
                $delete_ids = implode(',', $ids);
                $sql = 'DELETE FROM '._DB_PREFIX_.'ba_importer_config WHERE ';
                $sql .= 'id_importer_config IN ('. pSQL($delete_ids).')';
                $db->query($sql);
                // xoa tu bang ba_cronjobs_importer
                $id_remove = 'id_importer_config IN ('.pSQL($delete_ids).')';
                $sql = 'DELETE FROM '._DB_PREFIX_.'ba_cronjobs_importer WHERE '.$id_remove;
                $db->query($sql);
                foreach ($ids as $value) {
                    $table_name = 'ba_importer_data_'.$value;
                    $sql_drop_table = 'DROP TABLE IF EXISTS ' . _DB_PREFIX_ . $table_name;
                    $db->query($sql_drop_table);
                }
                Tools::redirectAdmin($bamodule.'&token='.$token.'&configure='.$this->name.'');
            }
        }
        ///////////////////
        if (Tools::isSubmit("cancelAddDb")) {
            $settingchoose = Tools::getValue('id_importer_config');
            if ($settingchoose !== false) {
                $id_importer_configg = '&id_importer_config=' . $settingchoose;
            }
            if ($settingchoose === false) {
                $select = 'SELECT * FROM ' . _DB_PREFIX_ . 'ba_importer_config ORDER BY id_importer_config DESC';
                $a = $db->getRow($select);
                $id_importer_configg = '&id_importer_config=' . $a['id_importer_config'];
            }
            $src = $advance . '&token=' . $token
                            . '&configure=ba_importer&viewba_importer'. $id_importer_configg;
                    Tools::redirectAdmin($src);
        }
        if (Tools::isSubmit("submitimport")) {
            $get_file_name = '';
            $id_shop = $this->context->shop->id;
            $id_group = $this->context->shop->id_shop_group;
            $characters = Tools::getValue("characters_csv");
            Configuration::updateValue('CONFIGN_CHARACTERS_CSV', $characters, false, $id_group, $id_shop);
            $characters_cat = Tools::getValue("characters_category");
            Configuration::updateValue('CONFIGN_CHARACTERS_CATEGORY', $characters_cat, false, $id_group, $id_shop);
            // var_dump($_POST);die;
            $arr_post = Tools::jsonEncode($_POST);
            $confign_bc1 = Tools::jsonEncode($_POST);
            
            $settingchoose = Tools::getValue('id_importer_config');
            Configuration::updateValue('get_id_config', $settingchoose);
            $this->smarty->assign('get_id_config', $settingchoose);
            // var_dump($settingchoose);die;
            $db = Db::getInstance(_PS_USE_SQL_SLAVE_);
            if ($settingchoose !== false) {
                // var_dump($confign_bc1);die;
                $a = Tools::getValue('select_settings');
                $confign_bc1 = $_POST;
                $confign_bc1['select_settings'] = $settingchoose;
                $confign_bc1 = Tools::jsonEncode($confign_bc1);
                $im_lo = Tools::getValue('import_local');
                $im_name_file = $this->getNameFileCsvOrExcel($im_lo);
                $update = 'UPDATE ' . _DB_PREFIX_ . 'ba_importer_config SET ';
                $update .= 'ba_name_setting=\''.trim($a).'\', ba_name_file=\''.$im_name_file.'\', ';
                $update .= 'import_local=\''.$im_lo.'\', ba_step1=\''.pSQL($confign_bc1).'\', ';
                $update .= 'date_up=NOW() ';
                $update .= 'WHERE id_importer_config=' . (int) $settingchoose . ' AND id_shop=' . (int) $id_shop;
                $db->query($update);
            }
            if ($settingchoose === false) {
                $name_new = Tools::getValue('select_settings');
                $insert = 'INSERT INTO ' . _DB_PREFIX_ . 'ba_importer_config (id_shop,ba_name_setting,ba_step1) ';
                $insert .= 'VALUES (\''.(int) $id_shop.'\',\''.pSQL(trim($name_new)).'\',\''.pSQL($confign_bc1).'\')';
                $db->query($insert);
                $select = 'SELECT * FROM ' . _DB_PREFIX_ . 'ba_importer_config ORDER BY id_importer_config DESC';
                $a = $db->getRow($select);
                $confign_bc1 = $_POST;
                $confign_bc1['select_settings'] = $a['id_importer_config'];
                $confign_bc1 = Tools::jsonEncode($confign_bc1);
                $im_lo = Tools::getValue('import_local');
                $im_name_file = $this->getNameFileCsvOrExcel($im_lo);
                $update = 'UPDATE ' . _DB_PREFIX_ . 'ba_importer_config SET ';
                $update .= 'ba_name_file=\''.$im_name_file.'\', import_local=\''.$im_lo.'\', ';
                $update .= 'ba_step1=\''.pSQL($confign_bc1).'\', date_add=NOW(), ';
                $update .= 'date_up=NOW() ';
                $update .= 'WHERE id_importer_config=' . (int) $a['id_importer_config'] . ' ';
                $update .= ' AND id_shop=' . (int) $id_shop;
                $db->query($update);
                Configuration::updateValue('CONFIG_SELECT_IMPORTER', null, false, '', $id_shop);
            }
            Configuration::updateValue('CONFIGN_IMPORTER_BC1', $confign_bc1, false, '', $id_shop);
            
            $id_importer_configg = Tools::getValue('id_importer_config');
            $table_name = 'ba_importer_data_';
            if ($id_importer_configg !== false) {
                $id_importer_configg = '&id_importer_config=' . $id_importer_configg;
                $table_name .= Tools::getValue('id_importer_config');
            } else {
                $select = 'SELECT * FROM ' . _DB_PREFIX_ . 'ba_importer_config ORDER BY id_importer_config DESC';
                $a = $db->getRow($select);
                $id_importer_configg = '&id_importer_config=' . $a['id_importer_config'];
                $table_name .= $a['id_importer_config'];
            }
            
            if (isset($_FILES['img'])) {
                $this->saveFileImageZip($_FILES['img'], $id_importer_configg);
            }
            if (isset($_FILES['exampleFile'])) {
                $this->saveFileImageZip($_FILES['exampleFile'], $id_importer_configg);
            }
            
            if (Tools::getValue("import_local") == 0) {
                $url = Tools::getValue("url_excel");
                $link_exits = $this->urlExists($url);
                if ($link_exits === true) {
                    $post_file = array();
                    $post_file[] = strpos(Tools::strtolower($url), ".csv");
                    $post_file[] = strpos(Tools::strtolower($url), ".xls");
                    $post_file[] = strpos(Tools::strtolower($url), ".xlsx");
                    $ext = 0;
                    foreach ($post_file as $ktfile) {
                        if ($ktfile == true) {
                            $ext = 1;
                        }
                    }
                    if ($ext == 0) {
                        $src = $advance . '&token=' . $token . '&configure=ba_importer&tab_module=others&';
                        $src .= 'module_name=ba_importer&notexcel=1&viewba_importer'. $id_importer_configg;
                        Tools::redirectAdmin($src);
                    }
                    $arr = explode("/", $url);
                    $fileName = trim(end($arr));
                    $saveto = dirname(__FILE__) . '/stories/' . $fileName;
                    $this->getImageFromUrl($url, $saveto);
                    $get_file_name = $fileName;
                } else {
                    $src = $advance . '&token=' . $token . '&configure=ba_importer&tab_module=others&';
                    $src .= 'module_name=ba_importer&notexcel=1&viewba_importer'. $id_importer_configg;
                    Tools::redirectAdmin($src);
                }
            }
            if (Tools::getValue("import_local") == 1) {
                $file = $_FILES["filexls"];
                if ($file['error'] == 0) {
                    move_uploaded_file($file['tmp_name'], dirname(__FILE__) . "/stories/" . $file['name']);
                    $fileName = $file['name'];
                } else {
                    $src = $advance . '&token=' . $token . '&configure=ba_importer&tab_module=others&';
                    $src .= 'module_name=ba_importer&uploaderror=1&viewba_importer'. $id_importer_configg;
                    Tools::redirectAdmin($src);
                }
                if ($_FILES["filexls"]["size"] == 0) {
                    $src = $advance . '&token=' . $token . '&configure=ba_importer&tab_module=others&';
                    $src .= 'module_name=ba_importer&notexcel=1&viewba_importer'. $id_importer_configg;
                    Tools::redirectAdmin($src);
                } else {
                    $post_file = array();
                    $post_file[] = strpos(Tools::strtolower($file["name"]), ".csv");
                    $post_file[] = strpos(Tools::strtolower($file["name"]), ".xls");
                    $post_file[] = strpos(Tools::strtolower($file["name"]), ".xlsx");
                    $ext = 0;
                    foreach ($post_file as $ktfile) {
                        if ($ktfile >0) {
                            $ext = 1;
                        }
                    }
                    if ($ext == 0) {
                        $src = $advance . '&token=' . $token . '&configure=ba_importer&tab_module=others&';
                        $src .= 'module_name=ba_importer&notexcel=1&viewba_importer'. $id_importer_configg;
                        Tools::redirectAdmin($src);
                    }
                }
                $get_file_name = $file['name'];
            }
            if (Tools::getValue("import_local") == 2) {
                $fp = Tools::getValue("ftp_link_excel");
                $arr = explode("/", $fp);
                $fileName = trim(end($arr));
                $post_file = array();
                $post_file[] = strpos(Tools::strtolower($fileName), ".csv");
                $post_file[] = strpos(Tools::strtolower($fileName), ".xls");
                $post_file[] = strpos(Tools::strtolower($fileName), ".xlsx");
                $ext = 0;
                foreach ($post_file as $ktfile) {
                    if ($ktfile >0) {
                        $ext = 1;
                    }
                }
                if ($ext == 0) {
                    $src = $advance . '&token=' . $token . '&configure=ba_importer&tab_module=others&';
                    $src .= 'module_name=ba_importer&notexcel=1&viewba_importer'. $id_importer_configg;
                    Tools::redirectAdmin($src);
                }
                //-- Connection Settings
                $ftp_server = Tools::getValue("ftp_server"); // Address of FTP server.
                $ftp_user_name = Tools::getValue("ftp_user_name"); // Username
                $ftp_user_pass = Tools::getValue("ftp_user_pass"); // Password
                // set up basic connection
                $conn_id = ftp_connect($ftp_server, 21);
                
                // login with username and password
                $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
                if ($login_result===true) {
                    ftp_pasv($conn_id, true);
                    
                    $download=ftp_get($conn_id, dirname(__FILE__) . '/stories/' . $fileName, $fp, FTP_BINARY);
                    // try to download $server_file and save to $local_file
                    if ($download === false) {
                        $src = $advance . '&token=' . $token . '&configure=ba_importer&tab_module=others&';
                        $src .= 'module_name=ba_importer&notdowload=1&viewba_importer'. $id_importer_configg;
                        Tools::redirectAdmin($src);
                    }
                    ftp_close($conn_id);
                } else {
                    $src = $advance . '&token=' . $token
                            . '&configure=ba_importer&tab_module=others&module_name=ba_importer&notftp='
                            .Tools::getValue("ftp_server").'&viewba_importer'. $id_importer_configg;
                    Tools::redirectAdmin($src);
                }
                $get_file_name = $fileName;
            }
            $this->saveDataCsvToDatabase($get_file_name, $table_name);
            $this->html = $this->import($arr_post, $fileName);
        } elseif (Tools::isSubmit("cancelimport")) {
            $bamodule = AdminController::$currentIndex;
            $token = Tools::getAdminTokenLite('AdminModules');
            Tools::redirectAdmin($bamodule.'&token='.$token.'&configure='.$this->name.'');
        } elseif (Tools::isSubmit("back_bc2")) {
            $db = Db::getInstance(_PS_USE_SQL_SLAVE_);
            $confign_bc1 = Configuration::get('CONFIGN_IMPORTER_BC1', null, $id_shop_group, $id_shop);
            $get_id_config = Configuration::get('get_id_config');
            if ($get_id_config != null) {
                $sql_get_name_file = 'SELECT ba_name_file FROM ' . _DB_PREFIX_ . 'ba_importer_config ';
                $sql_get_name_file .= 'WHERE id_importer_config = ' . (int) $get_id_config;
                $get_name_file = $db->ExecuteS($sql_get_name_file);
                $arr_link1 = explode("/", $get_name_file['0']['ba_name_file']);
                $fileName = trim(end($arr_link1));
            }
            if ($get_id_config == null) {
                $select = 'SELECT ba_name_file FROM ' . _DB_PREFIX_ . 'ba_importer_config ';
                $select .= 'ORDER BY id_importer_config DESC';
                $get_name_file = $db->getRow($select);
                $arr_link1 = explode("/", $get_name_file['ba_name_file']);
                $fileName = trim(end($arr_link1));
                // var_dump($get_name_file);die;
            }
            if ($confign_bc1 != false) {
                $arr_confign_bc1 = Tools::jsonDecode($confign_bc1, true);
                if (!empty($arr_confign_bc1)) {
                    $url = $arr_confign_bc1["url_excel"];
                    $link_exits = $this->urlExists($url);
                    if ($link_exits === true) {
                        $post_file = array();
                        $post_file[] = strpos(Tools::strtolower($url), ".csv");
                        $post_file[] = strpos(Tools::strtolower($url), ".xls");
                        $post_file[] = strpos(Tools::strtolower($url), ".xlsx");
                        $ext = 0;
                        foreach ($post_file as $ktfile) {
                            if ($ktfile == true) {
                                $ext = 1;
                            }
                        }
                        if ($ext == 0) {
                            $src = $advance . '&token=' . $token . '&configure=ba_importer&tab_module=others';
                            $src .= '&module_name=ba_importer&notexcel=1&viewba_importer';
                            Tools::redirectAdmin($src);
                        }
                        $arr_link = explode("/", $url);
                        $fileName = trim(end($arr_link));
                        $saveto = dirname(__FILE__) . '/stories/' . $fileName;
                        $this->getImageFromUrl($url, $saveto);
                    }
                    $this->html = $this->import($confign_bc1, $fileName);
                }
            }
        } elseif (Tools::isSubmit("btnNextStep") || Tools::isSubmit("submit_reminder")) {
            Configuration::updateValue('CONFIGN_AUTO_IMPORT', 1);
            $this->html = "";
            $submit_reminder = 0;
            $id_shop = $this->context->shop->id;
            $id_shop_group = $this->context->shop->id_shop_group;
            if (Tools::isSubmit("btnNextStep")) {
                $select_column = Tools::getValue("select");
                $array_config = array();
                $array_config = Tools::jsonEncode($select_column);
                $id_shop_group = $this->context->shop->id_shop_group;
                Configuration::updateValue('CONFIG_SELECT_IMPORTER', $array_config, false, $id_shop_group, $id_shop);
                Configuration::updateValue('baautoimpor_is_run', '0', false, $id_shop_group, $id_shop);
                
                $id_shop = (int) Context::getContext()->shop->id;
                $settingchoose = Tools::getValue('get_id_config');
                // var_dump($settingchoose);die;
                $db = Db::getInstance(_PS_USE_SQL_SLAVE_);
                if ($settingchoose !== "") {
                    $update = 'UPDATE ' . _DB_PREFIX_ . 'ba_importer_config SET ';
                    $update .= 'ba_step2=\''.pSQL($array_config).'\', ';
                    $update .= 'date_up=NOW() ';
                    $update .= 'WHERE id_importer_config=' . (int) $settingchoose . ' ';
                    $update .= 'AND id_shop=' . (int) $id_shop;
                    $db->query($update);
                }
                if ($settingchoose === "") {
                    $select = 'SELECT * FROM ' . _DB_PREFIX_ . 'ba_importer_config ORDER BY id_importer_config DESC';
                    $a = $db->getRow($select);
                    $update = 'UPDATE ' . _DB_PREFIX_ . 'ba_importer_config SET ';
                    $update .= 'ba_step2=\''.pSQL($array_config).'\', ';
                    $update .= 'date_up=NOW() ';
                    $update .= 'WHERE id_importer_config=' . (int) $a['id_importer_config'];
                    $db->query($update);
                    $select = 'SELECT * FROM ' . _DB_PREFIX_ . 'ba_importer_config ORDER BY id_importer_config DESC';
                    $b = $db->getRow($select);
                    Configuration::updateValue('CONFIG_SELECT_IMPORTER', $b['ba_step2']);
                }
                
                $data_post = Tools::jsonEncode($_POST);
                Configuration::updateValue('CONFIGN_DATA_POST', $data_post, false, $id_shop_group, $id_shop);
                $config_auto_cronjob = ('* * * * * php ' . _PS_MODULE_DIR_ . $this->name . '/autoimport.php?batoken='
                                        .$this->cookiekeymodule().'  >> '
                                        . _PS_MODULE_DIR_ . $this->name . '/cronjob/log_cronjob.txt 2>&1');
                $this->smarty->assign('config_auto_cronjob', $config_auto_cronjob);
            }
            if (Tools::isSubmit("submit_reminder")) {
                $config_auto_cronjob = ('* * * * * php ' . _PS_MODULE_DIR_ . $this->name . '/autoimport.php?batoken='
                                        .$this->cookiekeymodule().'  >> '
                                        . _PS_MODULE_DIR_ . $this->name . '/cronjob/log_cronjob.txt 2>&1');
                $this->smarty->assign('config_auto_cronjob', $config_auto_cronjob);
                if ($this->demo_mode === true) {
                    $this->html .= "<div class='alert alert-danger'>" . $this->l = 'You are use' . " <strong>"
                            . $this->l = 'Demo Mode' . "</strong>, "
                            . $this->l = 'so some buttons, functions will be disabled because of security.' . "  <br />"
                            . $this->l = 'You can use them in Live mode after you puchase our module.' . " <br />"
                            . $this->l = 'Thanks !' . "</div>";
                } else {
                    $this->configncronjob();
                    $submit_reminder = 1;
                }
            }
            if (Tools::isSubmit("submit_cronjob")) {
                $config_auto_cronjob = ('* * * * * php ' . _PS_MODULE_DIR_ . $this->name . '/autoimport.php?batoken='
                                        .$this->cookiekeymodule().'  >> '
                                        . _PS_MODULE_DIR_ . $this->name . '/cronjob/log_cronjob.txt 2>&1');
                $this->smarty->assign('config_auto_cronjob', $config_auto_cronjob);
                Configuration::updateValue('submit_cronjob', '1');
            }
            if (Configuration::get('submit_cronjob') != 1) {
                $ba_url = Tools::getShopProtocol() . Tools::getHttpHost() . __PS_BASE_URI__;
                $this->html .= "<div class='alert alert-danger'><form method='post' enctype='multipart/form-data' >"
                        . $this->l('You need set up cron job in your hosting with command ') . "<br />
                            <strong>0 * * * * curl \"".$ba_url."modules/".$this->name."/autoimport.php?batoken="
                            .$this->cookiekeymodule()."\"</strong><br />
                            <button type='submit' class='btn btn-default' name='submit_cronjob' value='1'>"
                        . $this->l('Yes, I did') . "</button></form></div>";
            }
            
            $config_cronjob = Configuration::get('CONFIGN_CRONJOB', false, $id_shop_group, $id_shop);
            $arr_config_cronjob = array("hour" => "-1", "day" => "-1", "month" => "-1", "day_of_week" => "-1");
            if ($config_cronjob != false) {
                $arr_config_cronjob = Tools::jsonDecode($config_cronjob, true);
            }
            $this->smarty->assign('link_referer', $_SERVER["HTTP_REFERER"]);
            $this->smarty->assign('arr_config_cronjob', $arr_config_cronjob);
            if ($submit_reminder == 1) {
                $this->html .= "<div class='alert alert-success'>";
                $this->html .= $this->l = 'Update successfull' . "</div>";
            }
            $this->html .= $this->display(__FILE__, 'views/templates/admin/hook/configncronjob.tpl');
        }

        return $this->html;
    }

    public function configncronjob()
    {
        $id_shop = (int) $this->context->shop->id;
        $id_shop_group = $this->context->shop->id_shop_group;
        $post = $_POST;
        $arr = Tools::jsonEncode($post);
        Configuration::updateValue('CONFIGN_CRONJOB', $arr, false, $id_shop_group, $id_shop);
        Configuration::updateValue('baautoimpor_is_run', '0', false, $id_shop_group, $id_shop);
        
        $db = Db::getInstance(_PS_USE_SQL_SLAVE_);
        $a = Configuration::get('CONFIGN_IMPORTER_BC1', null, $id_shop_group, $id_shop);
        $b = Tools::jsonDecode($a);
        $update = 'UPDATE ' . _DB_PREFIX_ . 'ba_importer_config ';
        $update .= 'SET ba_step3=\''.pSQL($arr).'\', date_up=NOW() ';
        $update .= 'WHERE id_importer_config=' . (int) $b->select_settings . ' AND id_shop=' . (int) $id_shop;
        $db->query($update);
        
        $baseUrl = _PS_BASE_URL_ . __PS_BASE_URI__;
        $task = urlencode($baseUrl . 'modules/ba_importer/autoimport.php?batoken='.$this->cookiekeymodule().'');
        $sql = 'SELECT id_cronjob FROM ' . _DB_PREFIX_ . 'cronjobs WHERE `task` = \''
                . $task . '\'';
        $id_cronjob = Db::getInstance()->getValue($sql);
        if ($id_cronjob != false) {
            $id_shop = (int) Context::getContext()->shop->id;
            $id_shop_group = (int) Context::getContext()->shop->id_shop_group;
            $query = 'REPLACE INTO ' . _DB_PREFIX_ . 'cronjobs
                (`id_cronjob`, `description`, `task`, `hour`, `day`, `month`, `day_of_week`,
                `updated_at`, `active`, `id_shop`, `id_shop_group`)
                VALUES (\'' . $id_cronjob . '\', \'Ba_importer.\', \'' . $task . '\', \''
                    . $post["hour"] . '\', \'' . $post["day"] . '\', \'' . $post["month"] . '\', \''
                    . $post["day_of_week"] . '\', NULL, TRUE, '
                    . (int) $id_shop . ', ' . (int) $id_shop_group . ')';
            Db::getInstance()->execute($query);
        }
        
        $id_shop = (int) Context::getContext()->shop->id;
        $id_shop_group = (int) Context::getContext()->shop->id_shop_group;
        $sql2 = 'SELECT id_cronjob FROM ' . _DB_PREFIX_ . 'ba_cronjobs_importer ';
        $sql2 .= 'WHERE `id_importer_config` = \''. $b->select_settings . '\'';
        $id_cronjob2 = Db::getInstance()->getValue($sql2);
        if ($id_cronjob2 == false) {
            $query2 = 'INSERT INTO ' . _DB_PREFIX_ . 'ba_cronjobs_importer
                (`id_importer_config`, `ba_name`, `hour`, `day`, `month`, `day_of_week`,
                `id_shop`, `id_shop_group`, `CONFIGN_DATA_POST`, `imported`)
                VALUES (\'' . $b->select_settings . '\', \'Ba_importer\', \''
                    . $post["hour"] . '\', \'' . $post["day"] . '\', \'' . $post["month"] . '\', \''
                    . $post["day_of_week"] . '\', '
                    . (int) $id_shop . ', ' . (int) $id_shop_group . ', \''
                    . pSQL(Configuration::get('CONFIGN_DATA_POST', null, '', $id_shop)) . '\', 0)';
            $a = Db::getInstance()->execute($query2);
        }
        if ($id_cronjob2 != false) {
            $query2 = 'REPLACE INTO ' . _DB_PREFIX_ . 'ba_cronjobs_importer
                (`id_cronjob`, `id_importer_config`, `ba_name`, `hour`, `day`, `month`, `day_of_week`,
                `id_shop`, `id_shop_group`, `CONFIGN_DATA_POST`, `imported`)
                VALUES (\'' . $id_cronjob2 . '\', \'' . $b->select_settings . '\', \'Ba_importer\', \''
                    . $post["hour"] . '\', \'' . $post["day"] . '\', \'' . $post["month"] . '\', \''
                    . $post["day_of_week"] . '\', '
                    . (int) $id_shop . ', ' . (int) $id_shop_group . ', \''
                    . pSQL(Configuration::get('CONFIGN_DATA_POST', null, '', $id_shop)) . '\', 0)';
            $a = Db::getInstance()->execute($query2);
        }
    }

    public function import($arr, $fileName)
    {
        $db = Db::getInstance();

        $this->html = '';
        $array = $this->readFileXls($fileName);
        // var_dump($array);die;
        $row_excel = count($array);
        $so_hang = $row_excel - 1;
        $arr_post = Tools::jsonDecode($arr, true);
        $start=2;
        if (Tools::getValue("import_header") == 1) {
            $start = 1;
        }
        $product_start = (int) @$arr_post["product_start"];
        if ($arr_post["import_items"] == "Range" && $product_start>0 && $start<$product_start) {
            $start = $product_start;
        }
        $product_end_range = (int) $arr_post["product_end"];
        if ($arr_post["import_items"] == "Range" && $product_end_range>0 && $product_end_range<$row_excel) {
            $row_excel = $product_end_range;
        }
        ////////
        $so_hang = $row_excel-$start+1;
        //echo $start;die;
        /////iso_lang
        $iso = Language::getIsoIds();
        $isoLang = array();
        foreach ($iso as $value) {
            $isoLang[] = $value["iso_code"];
        }
        $isoLang = implode(",", $isoLang);
        $this->smarty->assign('isoLang', $isoLang);
        /////iso_currence
        $iso = Currency::getCurrencies();
        $isoCur = array();
        foreach ($iso as $value) {
            $isoCur[] = $value["iso_code"];
        }
        $isoCur = implode(", ", $isoCur);
        $this->smarty->assign('isoCur', $isoCur);
        //// feature
        $sql = 'SELECT * FROM ' . _DB_PREFIX_ . 'feature_lang GROUP BY id_feature';
        $advance_feature = $db->executeS($sql);
        $this->smarty->assign('advance_feature', $advance_feature);
        //// Combination
        $sql = 'SELECT * FROM ' . _DB_PREFIX_ . 'attribute_group_lang WHERE id_lang = ' . $this->context->language->id;
        $ba_combination = $db->executeS($sql);
        $this->smarty->assign('ba_combination', $ba_combination);
        //// Warehouses
        $sql = 'SELECT * FROM ' . _DB_PREFIX_ . 'warehouse';
        $ba_warehouse = $db->executeS($sql);
        $this->smarty->assign('ba_warehouse', $ba_warehouse);
        
        //// CONFIG_SELECT_IMPORTER
        $id_shop = $this->context->shop->id;
        $id_shop_group = $this->context->shop->id_shop_group;
        $config_select_importer = Configuration::get('CONFIG_SELECT_IMPORTER', null, $id_shop_group, $id_shop);
        if ($config_select_importer != false) {
            $arr_config_select_importer = Tools::jsonDecode($config_select_importer, true);
        }
        // var_dump($arr_config_select_importer);die;
        
        $config_importer_bc1 = Configuration::get('CONFIGN_IMPORTER_BC1', null, $id_shop_group, $id_shop);
        if ($config_importer_bc1 != false) {
            $arr_config_importer_bc1 = Tools::jsonDecode($config_importer_bc1, true);
        }
        $this->smarty->assign('multi_lang', $arr_config_importer_bc1['multi_lang']);
        
        $mapping_select = "";
        foreach ($array[1] as $key => $header) {
            $mapping_select .="<div class='form-group'>";
            $this->smarty->assign('config_select_importer', @$arr_config_select_importer[$key]);
            $this->smarty->assign('key', $key);
            $select = $this->display(__FILE__, 'views/templates/admin/hook/select.tpl');
            if (Tools::getValue("import_header") == 1) {
                $mapping_select .="<label class='control-label advance-label'> Column "
                        . $key . "</label>" . $select . "";
            } else {
                $mapping_select .="<label class='control-label advance-label'>" . $header . "</label>" . $select . "";
            }

            $mapping_select .="</div>";
        }
        $this->smarty->assign('mapping_select', $mapping_select);
        $this->smarty->assign('base_uri', __PS_BASE_URI__);
        $this->smarty->assign('product_start_import', $start);
        $this->smarty->assign('ba_arr', $arr);
        $array_check = (array) Tools::jsonDecode($arr);
        $this->smarty->assign('identify_existing_items', $array_check["identify_existing_items"]);
        $this->smarty->assign('identify_existing_items_combi', $array_check["identify_existing_items_combi"]);
        $this->smarty->assign('manu_exist', $array_check["manu_exist"]);
        $this->smarty->assign('sup_exist', $array_check["sup_exist"]);
        $this->smarty->assign('baencode', $array_check["baencode"]);
        $this->smarty->assign('product_type', $array_check["product_type"]);
        $this->smarty->assign('select_settings', $array_check["select_settings"]);
        $settingchoose = Configuration::get('get_id_config');
        $this->smarty->assign('get_id_config', $settingchoose);
        $this->smarty->assign('multi_lang', $array_check["multi_lang"]);
        $this->smarty->assign('import_header', $array_check["import_header"]);
        $this->smarty->assign('import_local', $array_check["import_local"]);
        if ($so_hang < 0) {
            $so_hang = 0;
        }
        $this->smarty->assign('ba_so_hang', $so_hang);
        $this->smarty->assign('ba_demo_mode', $this->demo_mode);
        $this->smarty->assign('ba_file_name', $fileName);
        $tokenProducts = Tools::getAdminTokenLite('AdminProducts');
        $this->smarty->assign('tokenProducts', $tokenProducts);
        $this->smarty->assign('employee_id', $this->context->employee->id);
        $this->smarty->assign('shop_id', $this->context->shop->id);
        $this->smarty->assign('shop_id_group', $this->context->shop->id_shop_group);
        $this->html = $this->display(__FILE__, 'views/templates/admin/hook/mapping.tpl');


        return $this->html;
    }
    
    public function readFileXls($filename, $delimiter = null)
    {
        if (defined("JPATH_COMPONENT") == false) {
            define("JPATH_COMPONENT", dirname(__FILE__));
        }
        if (defined("DS") == false) {
            define("DS", DIRECTORY_SEPARATOR);
        }
        @ini_set("auto_detect_line_endings", true);
        $path_xls = JPATH_COMPONENT . DS . 'stories';
        $path_parts = pathinfo($path_xls . DS . $filename);
        $ext = Tools::strtolower($path_parts['extension']);
        if ($ext == 'xlsx') {
            require_once JPATH_COMPONENT . DS . 'libs' . DS . 'simplexlsx.class.php';
            $datas = new SimpleXLSX($path_xls . DS . $filename);
            $arrs = $datas->rows();
            // $tmp = 0;
        } elseif ($ext == 'xls') {
            require_once JPATH_COMPONENT . DS . 'libs' . DS . 'reader.php';
            $datas = new Spreadsheet_Excel_Reader();
            $datas->setOutputEncoding('UTF-8');
            $datas->read($path_xls . DS . $filename);
            $arrs = $datas->sheets[0]['cells'];
            // $tmp = 0;
        } elseif ($ext == 'csv') {
            $src = $path_xls . DS . $filename;
            $arrs = array();
            $row = 0;
            if (($handle = fopen($src, "r")) !== false) {
                $id_shop = $this->context->shop->id;
                $id_shop_group = $this->context->shop->id_shop_group;
                $characters = Configuration::get('CONFIGN_CHARACTERS_CSV', null, $id_shop_group, $id_shop);
                if ($characters == 't') {
                    $characters=chr(9);
                }
                if (!empty($delimiter)) {
                    $characters = $delimiter;
                }
                $baencode = Tools::getValue('baencode');
                while (($data = fgetcsv($handle, 10000, $characters)) !== false) {
                    if ($baencode == 'utf8') {
                        $data = array_map("bautf8encode", $data); //added
                    }
                    $arrs[$row] = $data;
                    $row++;
                }
                fclose($handle);
            }
        }
        $n = count($arrs);
        $arrs_new = array();
        $index = 1;
        if ($ext != 'xls') {
            for ($i = 0; $i < $n; $i++) {
                // if (!empty($arrs[$i][0])) {
                    // đổi chỉ số các cột bắt đầu từ 1
                $e_new = array();
                foreach ($arrs[$i] as $key => $value) {
                    $e_new[$key + 1] = @$value;
                }
                $arrs_new[$index] = $e_new;
                $index++;
                // }
            }
        } else {
            for ($i = 1; $i <= $n; $i++) {
                // if (!empty($arrs[$i][1])) {
                    $arrs_new[$index] = $arrs[$i];
                    $index++;
                // }
            }
        }
        return $arrs_new;
    }

    
    public function getImageFromUrl($url, $saveto)
    {
        $url = trim($url);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// enable if you want
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
        $raw = curl_exec($ch);
        curl_close($ch);
        if (file_exists($saveto)) {
            @unlink($saveto);
        }
        $fp = fopen($saveto, 'x');
        fwrite($fp, $raw);
        fclose($fp);
    }

    public function urlExists($url)
    {
        $ch = @curl_init($url);
        @curl_setopt($ch, CURLOPT_HEADER, true);
        @curl_setopt($ch, CURLOPT_NOBODY, true);
        @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $status = array();
        preg_match('/HTTP\/.* ([0-9]+) .*/', @curl_exec($ch), $status);
        return (@$status[1] == 200 || @$status[1] == 301);
    }

    public function updateWebservice($use_webservice)
    {
        $link = new Link();
        $admin_folder = basename(_PS_ADMIN_DIR_);
        $path = Tools::getShopDomainSsl(true, true) . __PS_BASE_URI__ . $admin_folder;
        $cron_url = $path . '/' . $link->getAdminLink('AdminBaCronJobs', false);
        $ba_webservice_id = Configuration::get('CRONJOB_BA_IMPORT_WEBSERVICE_ID');
        $webservice_id = Configuration::get('CRONJOB_BA_IMPORT_WEBSERVICE_ID') ? '/' . $ba_webservice_id : null;
        $data = array(
            'callback' => $link->getModuleLink($this->name, 'callback'),
            'domain' => Tools::getShopDomainSsl(true, true) . __PS_BASE_URI__,
            'cronjob' => $cron_url . '&token=' . Configuration::getGlobalValue('CRONJOBS_EXECUTION_TOKEN'),
            'cron_token' => Configuration::getGlobalValue('CRONJOBS_EXECUTION_TOKEN'),
            'active' => (bool) $use_webservice
        );
        $context_options = array('http' => array(
                'method' => (is_null($webservice_id) == true) ? 'POST' : 'PUT',
                'content' => http_build_query($data)
        ));
        $context_opt = stream_context_create($context_options);
        $result = Tools::file_get_contents($this->webservice_url . $webservice_id, false, $context_opt);
        if ($result != false) {
            $id_shop = $this->context->shop->id;
            $id_group = $this->context->shop->id_shop_group;
            Configuration::updateValue('CRONJOB_BA_IMPORT_WEBSERVICE_ID', (int) $result, false, $id_group, $id_shop);
        }
    }

    public function sendCallback()
    {
        ignore_user_abort(true);
        //set_time_limit(0);
        ob_start();
        echo 'cronjobs_prestashop';
        header('Connection: close');
        header('Content-Length: ' . ob_get_length());
        ob_end_flush();
        ob_flush();
        flush();
    }
    // import Accessories by Accessories IDs - đầu vào là chuỗi ID ngăn cách bởi dấu ,
    public function updateAccessories($id_product, $accessories_ids)
    {
        if (empty($accessories_ids)) {
            return false;
        }
        //echo $id_product;
        //var_dump($accessories_ids);
        $db = Db::getInstance();
        // remove OLD Accessories
        $db->execute('DELETE FROM `'._DB_PREFIX_.'accessory` WHERE `id_product_1` = '.(int)$id_product);
        // add New Accessories
        $accessories_ids = array_unique(explode(',', $accessories_ids));
        if (count($accessories_ids)<=0) {
            return false;
        }
        foreach ($accessories_ids as $id_product_2) {
            $db->insert('accessory', array(
                'id_product_1' => (int) $id_product,
                'id_product_2' => (int)$id_product_2
            ));
        }
    }
    // import Accessories by Refs - đầu vào là chuỗi Ref ngăn cách bởi dấu ,
    // trả về 1 chuỗi ID ngăn cách bởi dấu ,
    public function updateAccessoriesbyRef($id_product, $refs)
    {
        $ids=$this->getIDsByReferences($refs);
        $this->updateAccessories($id_product, $ids);
    }
    // đầu vào là 1 chuỗi Refs với dấu , ngăn cách
    public function getIDsByReferences($refs)
    {
        if (empty($refs)) {
            return false;
        }
        $ref_arr= explode(',', $refs); // chuyển chuỗi thành mảng
        $ref_arr= array_map('pSQL', $ref_arr); //loại lỗi SQL Injection
        
        $refs = "'".implode("','", $ref_arr)."'";
        
        $query = new DbQuery();
        $query->select('p.id_product');
        $query->from('product', 'p');
        $query->where('p.reference IN ('.$refs.')');

        $rows=Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS($query);
        if (empty($rows)) {
            return false;
        }
        $result=array();
        foreach ($rows as $item) {
            $result[]=$item['id_product'];
        }
        return implode(',', $result);
        //echo '<pre>';print_r($rows);die;
    }
    //
    public function selectSettings()
    {
        $id_shop = $this->context->shop->id;
        
        $db = Db::getInstance(_PS_USE_SQL_SLAVE_);
        $select_import_settings = 'SELECT * FROM ' . _DB_PREFIX_ . 'ba_importer_config WHERE id_shop=' . $id_shop;
        $select_is = $db->ExecuteS($select_import_settings);
        $this->smarty->assign('select_is', $select_is);
        
        $id_importer_configg = Tools::getValue('id_importer_config');
        if ($id_importer_configg === false) {
            $select_iss = '';
        } else {
            $select_import_settingss = 'SELECT * FROM ' . _DB_PREFIX_ . 'ba_importer_config ';
            $select_import_settingss .= 'WHERE id_importer_config = '.$id_importer_configg.' AND id_shop=' . $id_shop;
            $select_iss = $db->ExecuteS($select_import_settingss);
            $select_iss = $select_iss['0']['ba_name_setting'];
        }
        $this->smarty->assign('select_iss', $select_iss);
    }
    
    public function initList($search_1 = null)
    {
        $helper = new HelperList();
        $helper->shopLinkType = '';
        $helper->simple_header = false; //hien o & nut search
        // Actions to be displayed in the "Actions" column
        $helper->actions = array('view','delete');

        $helper->toolbar_btn['new'] = array(
            'href' => AdminController::$currentIndex . '&configure=' . $this->name . '&add'
            . $this->name . '&token=' . Tools::getAdminTokenLite('AdminModules'),
            'desc' => $this->l('Add new')
        );

        $helper->identifier = 'id_importer_config'; // t?o kh?a
        $helper->bulk_actions = array(
            'delete' => array(
                'text' => $this->l('Delete selected'),
                'icon' => 'icon-trash',
                'confirm' => $this->l('Delete selected items?')
            )
        );
        $helper->show_toolbar = true;
        $helper->title = 'List Settings';
        $helper->table = $this->name;
        $helper->list_id = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex . '&configure='
                . $this->name . '';
        $fields_list = array(
            'id_importer_config' => array(
                'title' => $this->l('ID'),
                'width' => 35,
                'type' => 'text'
            ),
            'ba_name_setting' => array(
                'title' => $this->l('Setting'),
                'width' => 120,
                'type' => 'text'
            ),
            'import_local' => array(
                'title' => $this->l('Mode'),
                'width' => 140,
                'type' => 'select',
                'list' => array(
                    0 => $this->l('Remote URL'),
                    1 => $this->l('Local'),
                    2 => $this->l('FTP')
                ),
                'filter_key' => 'import_local',
                'callback' => 'getNameByIdImportLocal',
                'callback_object' => $this
            ),
            'ba_name_file' => array(
                'title' => $this->l('File'),
                'width' => 140,
                'type' => 'text'
            ),
            'date_add' => array(
                'title' => $this->l('Date Add'),
                'width' => 140,
                'type' => 'datetime'
            ),
            'date_up' => array(
                'title' => $this->l('Last Update'),
                'width' => 140,
                'type' => 'datetime'
            ),
            'update_at' => array(
                'title' => $this->l('Last execution'),
                'width' => 140,
                'type' => 'datetime'
            )
        );
        if ($this->context->cookie->{'ba_importerOrderby'} == ""
        && $this->context->cookie->{'ba_importerOrderway'} == "") {
            $this->context->cookie->{'ba_importerOrderby'} = "id_importer_config";
            $this->context->cookie->{'ba_importerOrderway'} = "ASC";
        } else {
            $valueorderby = Tools::getValue($helper->list_id . "Orderby");
            $valueorderway = Tools::getValue($helper->list_id . "Orderway");
            if ($valueorderby != false && $valueorderway != false) {
                $this->context->cookie->{'ba_importerOrderby'} = $valueorderby;
                $this->context->cookie->{'ba_importerOrderway'} = Tools::strtoupper($valueorderway);
            }
        }
        $helper->orderBy = $this->context->cookie->{'ba_importerOrderby'};
        $helper->orderWay = $this->context->cookie->{'ba_importerOrderway'};
        $helper->listTotal = $this->getTotalList($helper, $search_1);
        $html = $helper->generateList($this->getListContent($helper, $search_1), $fields_list); /* t?o list */

        return $html;
    }

    public function getListContent($helper, $search_1)
    {
        $id_shop = $this->context->shop->id;
        $db = Db::getInstance(_PS_USE_SQL_SLAVE_);
        //pagination
        if ($this->context->cookie->{$helper->list_id . '_pagination'} == 10) {
            $this->context->cookie->{$helper->list_id . '_pagination'} = 20;
        }
        $pagi = $this->context->cookie->{$helper->list_id . '_pagination'};
        $selected_pagination = (int) Tools::getValue($helper->list_id . '_pagination', $pagi);
        if ($selected_pagination <= 0) {
            $selected_pagination = 20;
        }
        $this->context->cookie->{$helper->list_id . '_pagination'} = $selected_pagination;
        $page = (int) Tools::getValue('submitFilter' . $helper->list_id);
        if (!$page) {
            $page = 1;
        }
        $start = ($page - 1 ) * $selected_pagination;
        
        $orderby = $this->context->cookie->{'ba_importerOrderby'};
        $orderway = $this->context->cookie->{'ba_importerOrderway'};
        
        if ($search_1 == null) {
            $sql = 'SELECT a.*, b.update_at AS update_at FROM ' . _DB_PREFIX_ . 'ba_importer_config a ';
            $sql .= ' LEFT JOIN '._DB_PREFIX_.'ba_cronjobs_importer b ON a.id_importer_config=b.id_importer_config ';
            $sql .=' WHERE a.id_shop = ' . $id_shop . '
                    ORDER BY a.' . $orderby .' '. $orderway .' LIMIT ' . $start . ',' . $selected_pagination;
            $rows = $db->ExecuteS($sql);
        }
        if ($search_1 != null) {
            $sql = $search_1 . ' ORDER BY a.' . $orderby .' '. $orderway;
            $sql .=' LIMIT ' . $start . ',' . $selected_pagination;
            $rows = $db->ExecuteS($sql);
        }
        //echo '<pre>'; print($sql);die;
        return $rows;
    }

    private function getTotalList($helper, $search_1)
    {
        $helper;
        // $id_shop = $this->context->shop->id;
        //// Order by
        $orderby = $this->context->cookie->{'ba_importerOrderby'};
        $orderway = $this->context->cookie->{'ba_importerOrderway'};
        $sql = $search_1 . ' ORDER BY ' . $orderby . ' ' . $orderway;
        return count(Db::getInstance()->ExecuteS($sql));
    }
    public function getNameByIdImportLocal($id_im_lo)
    {
        $name_im_lo = '';
        if ($id_im_lo == 0) {
            $name_im_lo = $this->l('Remote URL');
        }
        if ($id_im_lo == 1) {
            $name_im_lo = $this->l('Local');
        }
        if ($id_im_lo == 2) {
            $name_im_lo = $this->l('FTP');
        }
        return $name_im_lo;
    }
    public function getNameFileCsvOrExcel($import_local)
    {
        $name_file = Tools::getValue('url_excel');
        $im_name_file = '';
        if ($import_local == 0) {
            $im_name_file = explode('/', $name_file);
            $a = (int) count($im_name_file) - 1;
            $im_name_file = '/' . $im_name_file[$a];
        }
        if ($import_local == 1) {
            $im_name_file = '--';
        }
        $name_file = Tools::getValue('ftp_link_excel');
        if ($import_local == 2) {
            $im_name_file = $name_file;
        }
        return $im_name_file;
    }
    
    public function getDateAddHelper($da_ad)
    {
        $date_add_from = '';
        $date_add_to = '';
        $date_add_arr = array();
        if ($da_ad[0] != '') {
            $date_add_from = $this->formatDate($da_ad[0], "Y-m-d");
            $date_add_from = strtotime($date_add_from);
            $date_add_from = date("Y-m-d", $date_add_from);
            $sql_date_add_from = 'date_add>="' . pSQL($date_add_from) . '"';
            $date_add_arr[] = $sql_date_add_from;
        }
        if ($da_ad[1] != '') {
            $date_add_to = $this->formatDate($da_ad[1], "Y-m-d");
            $date_add_to = strtotime($date_add_to);
            $date_add_to = date("Y-m-d", $date_add_to) . ' 23:59:59';
            $sql_date_add_to = 'date_add<="' . pSQL($date_add_to) . '"';
            $date_add_arr[] = $sql_date_add_to;
        }
        $sql_date_add = implode(' AND ', $date_add_arr);
        $sql_date_add2 = '';
        if ($sql_date_add != '') {
            $sql_date_add2 = ' AND (' . $sql_date_add . ')';
        }
        return $sql_date_add2;
    }
    
    public function getDateUpHelper($da_up)
    {
        $date_up_from = '';
        $date_up_to = '';
        $date_up_arr = array();
        if ($da_up[0] != '') {
            $date_up_from = $this->formatDate($da_up[0], "Y-m-d");
            $date_up_from = strtotime($date_up_from);
            $date_up_from = date("Y-m-d", $date_up_from);
            $sql_date_up_from = 'date_up>="' . pSQL($date_up_from) . '"';
            $date_up_arr[] = $sql_date_up_from;
        }
        if ($da_up[1] != '') {
            $date_up_to = $this->formatDate($da_up[1], "Y-m-d");
            $date_up_to = strtotime($date_up_to);
            $date_up_to = date("Y-m-d", $date_up_to) . ' 23:59:59';
            $sql_date_up_to = 'date_up<="' . pSQL($date_up_to) . '"';
            $date_up_arr[] = $sql_date_up_to;
        }
        $sql_date_up = implode(' AND ', $date_up_arr);
        $sql_date_up2 = '';
        if ($sql_date_up != '') {
            $sql_date_up2 = ' AND (' . $sql_date_up . ')';
        }
        return $sql_date_up2;
    }
    
    public function updateConfigSelect()
    {
        $id_shop = $this->context->shop->id;
        // $id_shop_group = $this->context->shop->id_shop_group;
        $settingchoose = Tools::getValue('id_importer_config');
        // var_dump($settingchoose);die;
        $db = Db::getInstance(_PS_USE_SQL_SLAVE_);
        if ($settingchoose !== false) {
            $select_import_settings = 'SELECT * FROM ' . _DB_PREFIX_ . 'ba_importer_config ';
            $select_import_settings .= 'WHERE id_importer_config=' . $settingchoose . ' AND id_shop=' . $id_shop;
            $select_is = $db->ExecuteS($select_import_settings);
            Configuration::updateValue('CONFIGN_IMPORTER_BC1', $select_is[0]['ba_step1'], false, '', $id_shop);
            Configuration::updateValue('CONFIG_SELECT_IMPORTER', $select_is[0]['ba_step2'], false, '', $id_shop);
            Configuration::updateValue('CONFIGN_CRONJOB', $select_is[0]['ba_step3'], false, '', $id_shop);
        }
    }
    
    public function formatDate($date, $format)
    {

        $dateArr = array();
        if (strpos($date, " ")) {
            $dateArr = explode(" ", $date);
        }
        if (strpos($date, "/")) {
            $dateArr = explode("/", $date);
        }
        if (strpos($date, "-")) {
            $dateArr = explode("-", $date);
        }
        if (strpos($date, ";")) {
            $dateArr = explode(";", $date);
        }
        if (strpos($date, ":")) {
            $dateArr = explode(":", $date);
        }
        if (strpos($date, ".")) {
            $dateArr = explode(".", $date);
        }
        if (strpos($date, ",")) {
            $dateArr = explode(",", $date);
        }

        $formatArr = array();
        if (strpos($format, " ")) {
            $formatArr = explode(" ", $format);
        }
        if (strpos($format, "/")) {
            $formatArr = explode("/", $format);
        }
        if (strpos($format, "-")) {
            $formatArr = explode("-", $format);
        }
        if (strpos($format, ";")) {
            $formatArr = explode(";", $format);
        }
        if (strpos($format, ":")) {
            $formatArr = explode(":", $format);
        }
        if (strpos($format, ".")) {
            $formatArr = explode(".", $format);
        }
        if (strpos($format, ",")) {
            $formatArr = explode(",", $format);
        }
        $tmpArr = array();
        for ($i = 0; $i < count($dateArr); $i++) {
            $tmpArr[$formatArr[$i]] = $dateArr[$i];
        }

        $dateFormatArr = array();
        foreach ($tmpArr as $key => $valueTmp) {
            if ($key == "Y" || $key == "y") {
                $dateFormatArr[0] = $valueTmp;
            } elseif ($key == "m" || $key == "M") {
                $dateFormatArr[1] = $valueTmp;
            } elseif ($key == "d" || $key == "D") {
                $dateFormatArr[2] = $valueTmp;
            }
        }
        ksort($dateFormatArr);
        $numberSecondDate = strtotime(implode("/", $dateFormatArr));

        if ($numberSecondDate == false) {
            return date("Y-m-d");
        }
        return implode("-", $dateFormatArr);
    }
    public function replacePrice($price)
    {
        if ($price === null) {
            return null;
        }
        $search = array('$', ' ', ',');
        $price = (float) str_replace($search, '', $price);
        return $price;
    }
    public function calcPricebeforeTax($price, $id_tax_rules_group = null)
    {
        if ($id_tax_rules_group == null) {
            return $price;
        }
        $price = (float) $price;
        $address = $this->context->shop->getAddress();
        $tax_manager = TaxManagerFactory::getManager($address, $id_tax_rules_group);
        $product_tax_calculator = $tax_manager->getTaxCalculator();
        $tax_rate = $product_tax_calculator->getTotalRate();
        if ($tax_rate>0) {
            $price = (float) number_format($price / (1 + $tax_rate / 100), 6, '.', '');
        }
        return $price;
    }
    // import specific price
    public function addSpecificPrices($array_specific, $row, $id_product, $id_attr = null, $id_shop = null)
    {
        $db = Db::getInstance();
        $an_specific = array();
        $sql_specific_select = array();
        $sql_column_specific = array();
        $sql_specific = array();
        $sql_update_set = array();
        $sql_update_where = array();
       
        foreach ($array_specific as $key_specific => $value_specific) {
            $an_specific[$key_specific] = $row[$value_specific];
        }
        if (!isset($an_specific['reduction']) && !isset($an_specific['price'])) {
            // neu ko ton tai so luong giam gia thi bo qua
            return true;
        }
        $an_specific['reduction'] = (float) @$an_specific['reduction'];
        if (isset($an_specific['price'])) {
            $an_specific['price'] = (float) @$an_specific['price'];
        } else {
            $an_specific['price'] = -1;
        }
        
        if ($an_specific['reduction'] <=0 && $an_specific['price'] <=0) {
            // neu ton tai so luong giam gia ma <=0 thi cung bo qua ko import
            return true;
        }
        if (!empty($an_specific)) {
            $an_specific['id_product_attribute'] = (int) $id_attr;
            if (!array_key_exists('from', $an_specific)) {
                $an_specific['from'] = '0000-00-00 00:00:00';
            }
            if (isset($an_specific['from']) && empty($an_specific['from'])) {
                $an_specific['from'] = '0000-00-00 00:00:00';
            }
            if (!array_key_exists('to', $an_specific)) {
                $an_specific['to'] = '0000-00-00 00:00:00';
            }
            if (isset($an_specific['to']) && empty($an_specific['to'])) {
                $an_specific['to'] = '0000-00-00 00:00:00';
            }
            if (isset($an_specific['to']) && $an_specific['to'] != '0000-00-00 00:00:00') {
                // them 23:59:59 to To
                $t = date('H', strtotime($an_specific['to']));
                if ($t == '00') {
                    $an_specific['to'] .= ' 23:59:59';
                }
            }
            if (!array_key_exists('from_quantity', $an_specific)) {
                $an_specific['from_quantity'] = '1';
            }
            if (!array_key_exists('price', $an_specific)) {
                $an_specific['price'] = '-1';
            }
            if (!array_key_exists('reduction', $an_specific)) {
                $an_specific['reduction'] = '0';
            }
            if (!array_key_exists('reduction_type', $an_specific)) {
                $an_specific['reduction_type'] = 'amount';
            }
            if (isset($an_specific['reduction_type']) && ($an_specific['reduction_type'] == 'percentage')) {
                $an_specific['reduction'] = (float) $an_specific['reduction']/100;
            }
            if (!array_key_exists('reduction_tax', $an_specific)) {
                $an_specific['reduction_tax'] = '1';
            }
            if (Tools::version_compare(_PS_VERSION_, '1.6.1.0', '<')) {
                unset($an_specific['reduction_tax']);
                // khong ton tai field nay trong bang specific_price
            }
            foreach ($an_specific as $key_an_specific => $value_an_specific) {
                $value_an_specific = trim($value_an_specific);
                if ($key_an_specific == 'price' || $key_an_specific == 'reduction') {
                    $value_an_specific = number_format($value_an_specific, 6, '.', '');
                }
                $sql_specific_select[] = '`' . $key_an_specific . '`' . ' = \''.$value_an_specific.'\'';
                
                $sql_column_specific[] = '`' . $key_an_specific . '`';
                $sql_specific[] = '\''.$value_an_specific.'\'';
                
                if ($key_an_specific != 'from' && $key_an_specific != 'to') {
                    $sql_update_set[] = '`' . $key_an_specific . '`' . ' = \''.$value_an_specific.'\'';
                } else {
                    $sql_update_where[] = '`' . $key_an_specific . '`' . ' = \''.$value_an_specific.'\'';
                }
            }
            
            $sql_column = implode(', ', $sql_column_specific);
            $sql_where = implode(', ', $sql_specific);
            $sql = 'REPLACE INTO ' . _DB_PREFIX_ . 'specific_price(`id_product`, `id_shop`, '.$sql_column.') '
                . 'VALUES(\''.$id_product.'\', \''.$id_shop.'\', '.$sql_where.')';
            //var_dump($sql);
            $db->query($sql);
        }
        $sql_specific_price_priority = 'SELECT * FROM ' . _DB_PREFIX_ . 'specific_price_priority '
                                    . 'WHERE id_product=' . $id_product;
        $result_specific_price_priority = $db->ExecuteS($sql_specific_price_priority);
        if (empty($result_specific_price_priority)) {
            $sql_insert = 'REPLACE INTO ' . _DB_PREFIX_ . 'specific_price_priority(`id_product`, `priority`) '
                        . 'VALUES(\''.$id_product.'\', \'id_shop;id_currency;id_country;id_group\')';
            $db->query($sql_insert);
        }
        Configuration::updateGlobalValue('PS_SPECIFIC_PRICE_FEATURE_ACTIVE', '1');
    }
    public $id_product_attr = 0;
    public function setCombination($bie, $a, $row, $id_pro, $b, $qty = 0, $ostock = 0, $deps = 0, $in_q = 0, $re = 0)
    {
        $array_combination_field = $a;
        $a_com = $a;
        $id_product = $id_pro;
        $array_attribute = $b;
        $_quantities = $qty;
        $_out_of_stock = $ostock;
        $_depends_on_stock = $deps;
        $increase_quantity = $in_q;
        $remove_image = $re;
        $db = Db::getInstance();
        $check_id_product_attribute_exits = false;
        $arr_id_attr = array();
        foreach ($array_attribute as $value) {
            foreach ($value as $id_attribute) {
                $arr_id_attr[] = $id_attribute;
            }
        }
        $sql = "SELECT id_product_attribute FROM "._DB_PREFIX_."product_attribute WHERE id_product = ".$id_product;
        $arr_id_pro_attr = $db->executeS($sql);
        if (!empty($arr_id_pro_attr)) {
            foreach ($arr_id_pro_attr as $value_id_pro_attr) {
                $sql = "SELECT id_attribute FROM "._DB_PREFIX_."product_attribute_combination "
                    ."WHERE id_product_attribute = ".$value_id_pro_attr["id_product_attribute"];
                $result_arr_id_attr = $db->executeS($sql);
                if (!empty($result_arr_id_attr)) {
                    $arr_id_attr_select = array();
                    foreach ($result_arr_id_attr as $value_id_attr) {
                        if (in_array($value_id_attr["id_attribute"], $arr_id_attr)) {
                            $arr_id_attr_select[] = "true";
                        } else {
                            $arr_id_attr_select[] = "false";
                        }
                    }
                    if (!in_array("false", $arr_id_attr_select)) {
                        $check_id_product_attribute_exits = true;
                        $id_product_attribute = (int) $value_id_pro_attr["id_product_attribute"];
                        break;
                    }
                }
            }
        }
        $data = array();
        $data_shop = array();
        
        foreach ($array_combination_field as $key => $value) {
            //Prestashop 1.6.0.1 have not had Tools::strpos function caused error
            if (strpos($key, "ba_combination") === 0) {
                $key = Tools::substr($key, -(Tools::strlen($key) - 15));
                if (@$row[$value] != null) {
                    $data[$key] = $row[$value];
                    if ($key == "available_date") {
                        $data[$key] = "";
                        if (empty($data[$key])) {
                            $data[$key] = $row[$value];
                        }
                    }
                    if ($key == "wholesale_price") {
                        $data[$key] = $this->replacePrice($row[$value]);
                    }
                    if ($key == "ean13") {
                        $data[$key] = $this->isEan($row[$value]);
                    }
                    if ($key == "upc") {
                        $data[$key] = $this->isEan($row[$value]);
                    }
                    if ($key == "default_on") {
                        $row[$value] = $this->dataStatusNo($row[$value]);
                        $data[$key] = $row[$value];
                        if ($row[$value] == '1') {
                            $this->removeCombinationDefault($id_product);
                        } else {
                            unset($data[$key]);
                        }
                    }
                }
            }
        }
        
        if (isset($a_com['ba_combination_quantity'])) {
            $data['quantity'] = (int) @$_quantities;
        }
        $data["id_product"] = $id_product;
       
        // Tinh toan lai gia truoc thue
        if (!isset($data['price']) && isset($data['price_incl'])) {
            $price_incl = (@$data['price_incl']>0) ? (float) @$data['price_incl']: -abs($data['price_incl']);
            // If a tax is already included in price, withdraw it from price
            $_p = new Product($id_product);
            $id_tax_rules_group_tmp = $_p->id_tax_rules_group;
            $data['price'] = $this->calcPricebeforeTax($price_incl, $id_tax_rules_group_tmp);
        }
        unset($data['price_incl']);
        //var_dump($data);
        //var_dump($row);
        $data_arr = $data;
        $data = array();
        foreach ($data_arr as $key => $value) {
            if (!empty($value)) {
                $data[$key] = $value;
            }
        }
        
        $data_shop = $data;
        $data_shop["id_shop"] = $this->shop_id;
        unset($data_shop["reference"]);
        unset($data_shop["ean13"]);
        unset($data_shop["upc"]);
        unset($data_shop["quantity"]);
        /////////////
        if (strpos(_PS_VERSION_, '1.6.0') === 0 || strpos(_PS_VERSION_, '1.5') === 0) {
            unset($data_shop["id_product"]);
        }
        if ($check_id_product_attribute_exits === false) {
            $db->insert("product_attribute", $data);
            $id_product_attribute = (int) $db->Insert_ID();
            
            $data_shop["id_product_attribute"] = $id_product_attribute;
            $db->insert("product_attribute_shop", $data_shop);
        } else {
            if ($increase_quantity == 1) {
                //////// combination_quantity
                $sql = "SELECT quantity FROM "._DB_PREFIX_."stock_available WHERE id_product = "
                        .$id_product." AND id_product_attribute = ".$id_product_attribute;
                $_combination_quantity_old = (int) $db->getValue($sql);
                $_quantities = (int) ($_quantities + $_combination_quantity_old);
            }
            if (isset($a_com['ba_combination_quantity'])) {
                $data['quantity'] = (int) @$_quantities;
            }
                        
            $where_product_attr = "id_product_attribute = " . $id_product_attribute
                                . " AND id_product = " . $id_product;
            $db->update("product_attribute", $data, $where_product_attr);
            
            $data_shop["id_product_attribute"] = $id_product_attribute;
            if (strpos(_PS_VERSION_, '1.6.0') === 0 || strpos(_PS_VERSION_, '1.5') === 0) {
                $where_product_attr = "id_product_attribute = " . $id_product_attribute
                                . " ";
            } else {
                $where_product_attr = "id_product_attribute = " . $id_product_attribute
                                . " AND id_product = " . $id_product;
            }
            $db->update("product_attribute_shop", $data_shop, $where_product_attr);
        }

        foreach ($array_attribute as $value) {
            foreach ($value as $id_attribute) {
                $sql = "REPLACE INTO " . _DB_PREFIX_ . "product_attribute_combination VALUES('"
                        . (int) $id_attribute . "', '" . $id_product_attribute . "')";
                $db->query($sql);
            }
        }
        $this->id_product_attr = $id_product_attribute;
        /////Add Combination Image
        if (!empty($array_combination_field["combination_images"])) {
            $id_combination_image = array();
            foreach ($array_combination_field["combination_images"] as $ba_com_img) {
                $name_img = @$row[$ba_com_img];
                @$name_img = explode(',', $name_img);
                foreach (@$name_img as $item_3) {
                    $id_combination_image[] = $this->addImages($item_3, $id_product, $ba_com_img, 0, 1, $remove_image);
                }
            }
        }
        if (!empty($id_combination_image)) {
            foreach ($id_combination_image as $id_image) {
                if ($id_image>0) {
                    if ($remove_image==1) {
                        $db->delete('product_attribute_image', "id_product_attribute = ".$id_product_attribute);
                    }
                    $sql = "REPLACE INTO " . _DB_PREFIX_ . "product_attribute_image VALUES('"
                            . $id_product_attribute . "', '" . (int) $id_image . "')";
                    $db->query($sql);
                }
            }
        }
        
        $data = array(
            'quantity' => @(int) ($_quantities),
            'id_product' => @(int) ($id_product),
            'id_product_attribute' => $id_product_attribute,
            'id_shop' => $this->shop_id,
            'id_shop_group' => 0,
            'out_of_stock' => (int) $_out_of_stock,
        );
        if ($_depends_on_stock !== null) {
            $data['depends_on_stock'] = (int) ($_depends_on_stock);
        }
        if (!isset($a_com['ba_combination_quantity']) && empty($_quantities)) {
            // lay quantity cu
            $sql = "SELECT quantity FROM "._DB_PREFIX_."stock_available WHERE id_product = "
                    .$id_product." AND id_product_attribute = ".$id_product_attribute;
            $_combination_quantity_old = (int) $db->getValue($sql);
            $data['quantity'] = $_combination_quantity_old;
        }
        //var_dump($data);
        $db->insert('stock_available', $data, false, true, Db::REPLACE);
        if (isset($a_com['ba_combination_quantity'])) {
            $sql = "UPDATE "._DB_PREFIX_."stock_available SET quantity = quantity + "
                .$_quantities." WHERE id_product = ". $id_product." AND id_product_attribute = 0";
            $db->query($sql);
            StockAvailable::setQuantity($id_product, $id_product_attribute, $_quantities);
        }
        
        $sql = "SELECT * FROM "._DB_PREFIX_."product_attribute WHERE id_product = ".$id_product;
        $arr_id_pro_attr = $db->executeS($sql);
        if (!empty($arr_id_pro_attr)) {
            foreach ($arr_id_pro_attr as $key => $value) {
                if ($arr_id_pro_attr[$key]['quantity'] == 0 && $bie["combi_quanti"] == 0) {
                    $zxc = new Combination($arr_id_pro_attr[$key]['id_product_attribute']);
                    $zxc->delete();
                }
            }
        }
        self::updateDefaultAttribute($id_product);
        return $id_product_attribute;
    }
    public function setCombinationBIE($bie, $a_com, $row, $id_pro, $qty = 0, $ostock = 0, $deps = 0, $in_q = 0, $re = 0)
    {
        // $_post = (array) Tools::jsonDecode($bie);
        $array_combination_field = $a_com;
        $id_product = $id_pro;
        // $array_attribute = $a_attr;
        $_quantities = $qty;
        $_out_of_stock = $ostock;
        $_depends_on_stock = $deps;
        $increase_quantity = $in_q;
        $remove_image = $re;
        $db = Db::getInstance();
        $data = array();
        $data_shop = array();
        foreach ($array_combination_field as $key => $value) {
            //Prestashop 1.6.0.1 have not had Tools::strpos function caused error
            if (strpos($key, "ba_combination") === 0) {
                $key = Tools::substr($key, -(Tools::strlen($key) - 15));
                if (@$row[$value] != null) {
                    $data[$key] = $row[$value];
                    if ($key == "available_date") {
                        $data[$key] = "";
                        if (empty($data[$key])) {
                            $data[$key] = $row[$value];
                        }
                    }
                    if ($key == "wholesale_price") {
                        $data[$key] = $this->replacePrice($row[$value]);
                    }
                    if ($key == "ean13") {
                        $data[$key] = $this->isEan($row[$value]);
                    }
                    if ($key == "upc") {
                        $data[$key] = $this->isEan($row[$value]);
                    }
                    if ($key == "default_on") {
                        $row[$value] = $this->dataStatusNo($row[$value]);
                        $data[$key] = $row[$value];
                        if ($row[$value] == '1') {
                            $this->removeCombinationDefault($id_product);
                        } else {
                            unset($data[$key]);
                        }
                    }
                }
            }
        }
        if (isset($a_com['ba_combination_quantity'])) {
            $data['quantity'] = (int) @$_quantities;
        }
        $data["id_product"] = $id_product;
        // Tinh toan lai gia truoc thue
        if (!isset($data['price']) && isset($data['price_incl'])) {
            $price_incl = (@$data['price_incl']>0) ? (float) @$data['price_incl']: -abs($data['price_incl']);
            // If a tax is already included in price, withdraw it from price
            $_p = new Product($id_product);
            $id_tax_rules_group_tmp = $_p->id_tax_rules_group;
            $data['price'] = $this->calcPricebeforeTax($price_incl, $id_tax_rules_group_tmp);
        }
        unset($data['price_incl']);
        ////////////////
        $data_arr = $data;
        $data = array();
        foreach ($data_arr as $key => $value) {
            if (!empty($value)) {
                $data[$key] = $value;
            }
        }
        if (!array_key_exists('reference', $data_arr)) {
            $data_arr["reference"] = '';
        }
        if (!array_key_exists('ean13', $data_arr)) {
            $data_arr["ean13"] = '';
        }
        if (!array_key_exists('upc', $data_arr)) {
            $data_arr["upc"] = '';
        }
        $data_shop = $data;
        $data_shop["id_shop"] = $this->shop_id;
        unset($data_shop["reference"]);
        unset($data_shop["ean13"]);
        unset($data_shop["upc"]);
        unset($data_shop["quantity"]);
        $sql = 'SELECT id_product_attribute FROM '._DB_PREFIX_.'product_attribute ';
        $sql .= 'WHERE id_product = '.(int) $id_product.' ';
        $sql2 = 'UPDATE '._DB_PREFIX_.'product_attribute SET ';
    
        if ($bie["identify_existing_items_combi"] == 'Combi Reference code') {
            if (empty($data_arr["reference"])) {
                return null;
            }
            $sql .= 'AND reference = \''.pSQL($data_arr["reference"]).'\'';
            $sql2 .= 'ean13 = \''.pSQL($data_arr["ean13"]).'\', upc = \''.pSQL($data_arr["upc"]).'\' ';
            $sql2 .= 'WHERE id_product = '.(int) $id_product.' AND reference = \''.pSQL($data_arr["reference"]).'\'';
        }
        if ($bie["identify_existing_items_combi"] == 'Combi EAN-13 or JAN barcode') {
            if (empty($data_arr["ean13"])) {
                return null;
            }
            $sql .= 'AND ean13 = \''.pSQL($data_arr["ean13"]).'\'';
            $sql2 .= 'reference = \''.pSQL($data_arr["reference"]).'\', upc = \''.pSQL($data_arr["upc"]).'\' ';
            $sql2 .= 'WHERE id_product = '.(int) $id_product.' AND ean13 = \''.pSQL($data_arr["ean13"]).'\'';
        }
        if ($bie["identify_existing_items_combi"] == 'Combi UPC barcode') {
            if (empty($data_arr["upc"])) {
                return null;
            }
            $sql .= 'AND upc = \''.pSQL($data_arr["upc"]).'\'';
            $sql2 .= 'reference = \''.pSQL($data_arr["reference"]).'\', ean13 = \''.pSQL($data_arr["ean13"]).'\' ';
            $sql2 .= 'WHERE id_product = '.(int) $id_product.' AND upc = \''.pSQL($data_arr["upc"]).'\'';
        }
        $arr_id_pro_attr = $db->executeS($sql);
        $db->query($sql2);
        // echo '<pre>'; print_r($arr_id_pro_attr);die;
        /////////////
        if (strpos(_PS_VERSION_, '1.6.0') === 0 || strpos(_PS_VERSION_, '1.5') === 0) {
            unset($data_shop["id_product"]);
        }
        $array_id_product_attribute = array();
        if (!empty($arr_id_pro_attr)) {
            foreach ($arr_id_pro_attr as $key_arr_id_pro_attr => $value_arr_id_pro_attr) {
                $value_arr_id_pro_attr;
                $id_product_attribute = $arr_id_pro_attr[$key_arr_id_pro_attr]['id_product_attribute'];
                if ($increase_quantity == 1) {
                    //////// combination_quantity
                    $sql = "SELECT quantity FROM "._DB_PREFIX_."stock_available WHERE id_product = "
                            .$id_product." AND id_product_attribute = ".$id_product_attribute;
                    $_combination_quantity_old = (int) $db->getValue($sql);
                    $_quantities = (int) ($_quantities + $_combination_quantity_old);
                }
                if (isset($a_com['ba_combination_quantity'])) {
                    $data['quantity'] = (int) @$_quantities;
                }
                // $where_product_attr = "id_product_attribute = " . $id_product_attribute
                                    // . " AND id_product = " . $id_product;
                // $db->update("product_attribute", $data, $where_product_attr);
                $data2 = array();
                $data_key = array_keys($data);
                $b = 0;
                foreach ($data as $key_data => $value_data) {
                    $key_data;
                    if ($data_key[$b] != 'id_product') {
                        $data2[] = $data_key[$b] . ' = \'' .pSQL($value_data) .'\'';
                    }
                    $b++;
                }
                $sql = 'UPDATE '._DB_PREFIX_.'product_attribute SET ';
                $sql .= implode(", ", $data2);
                $sql .= ' WHERE id_product_attribute = '.(int) $id_product_attribute.' ';
                $sql .= 'AND id_product = '.(int) $id_product.'';
                $db->query($sql);
                // echo '<pre>'; print_r($data2);
                
                $data_shop["id_product_attribute"] = $id_product_attribute;
                if (strpos(_PS_VERSION_, '1.6.0') === 0 || strpos(_PS_VERSION_, '1.5') === 0) {
                    $where_product_attr = "id_product_attribute = " . $id_product_attribute
                                    . " ";
                } else {
                    $where_product_attr = "id_product_attribute = " . $id_product_attribute
                                    . " AND id_product = " . $id_product;
                }
                $db->update("product_attribute_shop", $data_shop, $where_product_attr);

                // foreach ($array_attribute as $value) {
                    // foreach ($value as $id_attribute) {
                        // $sql = "REPLACE INTO " . _DB_PREFIX_ . "product_attribute_combination VALUES('"
                                // . (int) $id_attribute . "', '" . $id_product_attribute . "')";
                        // $db->query($sql);
                    // }
                // }
                $this->id_product_attr = $id_product_attribute;
                /////Add Combination Image
                if (!empty($array_combination_field["combination_images"])) {
                    $id_combination_image = array();
                    foreach ($array_combination_field["combination_images"] as $ba_com_img) {
                        $name_img = @$row[$ba_com_img];
                        @$name_img = explode(',', $name_img);
                        foreach (@$name_img as $item_3) {
                            $i3 = $item_3;
                            $ip = $id_product;
                            $id_combination_image[] = $this->addImages($i3, $ip, $ba_com_img, 0, 1, $remove_image);
                        }
                    }
                }
                if (!empty($id_combination_image)) {
                    foreach ($id_combination_image as $id_image) {
                        if ($id_image>0) {
                            if ($remove_image==1) {
                                $db->delete('product_attribute_image', "id_product_attribute = ".$id_product_attribute);
                            }
                            $sql = "REPLACE INTO " . _DB_PREFIX_ . "product_attribute_image VALUES('"
                                    . $id_product_attribute . "', '" . (int) $id_image . "')";
                            $db->query($sql);
                        }
                    }
                }
                $array_id_product_attribute[] = $id_product_attribute;
            } // mai lam` not' return ve` mang?
            $data = array(
                'quantity' => @(int) ($_quantities),
                'id_product' => @(int) ($id_product),
                'id_product_attribute' => $id_product_attribute,
                'id_shop' => $this->shop_id,
                'id_shop_group' => 0,
                'out_of_stock' => (int) $_out_of_stock,
            );
            if ($_depends_on_stock !== null) {
                $data['depends_on_stock'] = (int) ($_depends_on_stock);
            }
            if (!isset($a_com['ba_combination_quantity']) && empty($_quantities)) {
                // lay quantity cu
                $sql = "SELECT quantity FROM "._DB_PREFIX_."stock_available WHERE id_product = "
                        .$id_product." AND id_product_attribute = ".$id_product_attribute;
                $_combination_quantity_old = (int) $db->getValue($sql);
                $data['quantity'] = $_combination_quantity_old;
            }
            $db->insert('stock_available', $data, false, true, Db::REPLACE);
            
            if (isset($a_com['ba_combination_quantity'])) {
                $sql = "UPDATE "._DB_PREFIX_."stock_available SET quantity = quantity + "
                    .$_quantities." WHERE id_product = ". $id_product." AND id_product_attribute = 0";
                $db->query($sql);
                StockAvailable::setQuantity($id_product, $id_product_attribute, $_quantities);
            }
            $sql = "SELECT * FROM "._DB_PREFIX_."product_attribute WHERE id_product = ".$id_product;
            $arr_id_pro_attr = $db->executeS($sql);
            if (!empty($arr_id_pro_attr)) {
                foreach ($arr_id_pro_attr as $key => $value) {
                    if ($arr_id_pro_attr[$key]['quantity'] == 0 && $bie["combi_quanti"] == 0) {
                        $zxc = new Combination($arr_id_pro_attr[$key]['id_product_attribute']);
                        $zxc->delete();
                    }
                }
            }
        }
        if (empty($array_id_product_attribute)) {
            return null;// neu ko tim thay combination nao
        }
        self::updateDefaultAttribute($id_product);
        return $array_id_product_attribute;
    }
    public function logImport($arr_log_import)
    {
        $outputFlie = _PS_MODULE_DIR_."ba_importer/cronjob/log_auto_import.txt";
        $logMail = $arr_log_import;
        file_put_contents($outputFlie, $logMail, FILE_APPEND);
    }
    public function isEan($ean)
    {
        $a = preg_match('/^[0-9]{0,13}$/', $ean);
        if ($a == 0) {
            $chars = preg_split('//', $ean, -1, PREG_SPLIT_NO_EMPTY);
            $ean = "";
            foreach ($chars as $value) {
                $a = preg_match('/^[0-9]$/', $value);
                if ($a == 1) {
                    $ean .= $value;
                }
            }
            $n = Tools::strlen($ean);

            if ($n > 13) {
                $ean = Tools::substr($ean, 0, 13);
            }
        }
        return $ean;
    }
    // @param1 chu?i d?u vào là Yes, Y, 1
    // return 0
    public function dataStatusNo($status)
    {
        $status = Tools::strtolower($status);
        $int_status = 0;
        if ($status == "yes") {
            $int_status = 1;
        }
        if ($status == "y") {
            $int_status = 1;
        }
        if ($status == "1") {
            $int_status = 1;
        }
        return $int_status;
    }
      

    // @param1 chu?i d?u vào là Yes, Y, 1
    // return true
    public function dataStatusUsable($status)
    {
        $status = Tools::strtolower($status);
        $int_status = true;
        if ($status == "no") {
            $int_status = false;
        }
        if ($status == "n") {
            $int_status = false;
        }
        if ($status == "0") {
            $int_status = false;
        }
        return $int_status;
    }
    // @param1 chu?i d?u vào là Yes, Y, 1
    // return 1
    public function dataStatus($status)
    {
        $status = Tools::strtolower($status);
        $int_status = 1;
        if ($status == "no") {
            $int_status = 0;
        }
        if ($status == "n") {
            $int_status = 0;
        }
        if ($status == "0") {
            $int_status = 0;
        }
        return $int_status;
    }
    // add features
    public function addFeatures($id_product, $id_lang, $id_feature, $feature_value)
    {
        if ($feature_value == '') {
            return true;
        }
        $id_product = (int) $id_product;
        $id_lang = (int) $id_lang;
        $id_feature = (int) $id_feature;
        $feature_value = pSQL($feature_value);
        // xoa feature cua product nay
        $sql = "DELETE FROM " . _DB_PREFIX_ . "feature_product WHERE id_feature=$id_feature AND id_product=$id_product";
        Db::getInstance()->query($sql);
        // kiem xem feature nay da ton tai hay chua?
        $sql = 'SELECT a.id_feature_value FROM ' . _DB_PREFIX_ . 'feature_value AS a INNER JOIN '
                . _DB_PREFIX_ . 'feature_value_lang AS b ON a.id_feature_value=b.id_feature_value'
                . " WHERE a.id_feature=$id_feature AND b.value='" . pSQL($feature_value) . "'";
        //var_dump($sql);
        $id_feature_value = (int) Db::getInstance()->getValue($sql);
        if (empty($id_feature_value)) {
            // chua ton tai value cho feature nay
            $data = array(
                'id_feature' => $id_feature,
                'custom' => 1
            );
            Db::getInstance()->insert('feature_value', $data);
            $id_feature_value = Db::getInstance()->Insert_ID();
            $arr_id_lang = array();
            $languagesArr = Language::getLanguages(false);
            foreach ($languagesArr as $v) {
                $arr_id_lang[]=(int) ($v['id_lang']);
            }
            if (!empty($arr_id_lang)) {
                foreach ($arr_id_lang as $value_lang) {
                    $id_lang = (int) $value_lang;
                    $data = array(
                        'id_feature_value' => $id_feature_value,
                        'id_lang' => $id_lang,
                        'value' => $feature_value
                    );
                    
                    Db::getInstance()->insert('feature_value_lang', $data, false, true, DB::REPLACE);
                }
            }
            
            $data = array(
                'id_feature_value' => $id_feature_value,
                'id_feature' => $id_feature,
                'id_product' => $id_product
            );
            Db::getInstance()->insert('feature_product', $data, false, true, Db::REPLACE);
            return true;
        } else {
            // d? t?n t?i r?i
            $sql = "REPLACE INTO " . _DB_PREFIX_ . "feature_product
                    (id_feature,id_product,id_feature_value) VALUES($id_feature,$id_product,$id_feature_value)";
            Db::getInstance()->query($sql);
            return true;
        }
    }
    
    public function addFeaturesLang($id_product, $id_lang, $feature_column, $row)
    {
        //var_dump($feature_column);
        $id_default_language = (int) (Configuration::get('PS_LANG_DEFAULT'));
        $iso_default_language = Language::getIsoById($id_default_language);
        $languagesArr = Language::getLanguages(false);
        $a = array();
        $b = array();
        foreach ($languagesArr as $value_lang) {
            $b[$value_lang['iso_code']] = null;
        }
        foreach ($feature_column as $key => $row2) {
            $ar_id_iso = explode('_', $key);
            $a[$ar_id_iso['0']] = $b;
        }
        foreach ($a as $key_a => $value_a) {
            $value_a;
            foreach ($feature_column as $key => $row2) {
                $ar_id_iso = explode('_', $key);
                if ($ar_id_iso['0'] == $key_a) {
                    $a[$key_a][$ar_id_iso['1']] = trim($row[$row2]);
                }
            }
        }
        foreach ($languagesArr as $value_lang) {
            foreach ($a as $key_a => $value_a) {
                foreach ($a[$key_a] as $key_a2 => $value_a2) {
                    $value_a2;
                    if ($a[$key_a][$key_a2] == '') {
                        $a[$key_a][$key_a2] = $a[$key_a][$iso_default_language];
                    }
                }
            }
        }
        //echo '<pre>'; print_r($a);die;
        foreach ($a as $key => $row2) {
            $feature_value_null = '0';
            
            foreach ($a[$key] as $key2 => $row3) {
                $row3;
                $feature_value = $a[$key][$iso_default_language];
                if ($feature_value == '') {
                    $feature_value_null = '1';
                }
            }
            //var_dump($feature_value_null);
            if ($feature_value_null == '1') {
                //continue;
            }
            // $ar_id_iso = explode('_', $key);
            $id_product = (int) $id_product;
            $id_lang = (int) $id_lang;
            $id_feature = (int) $key;
            $check_feature_exist = 'chuatontai';
            $d = '';
            $exist_custom_feature = '0';
            foreach ($a[$key] as $key2 => $row3) {
                // $iso_feature = pSQL($key2);
                $feature_value = pSQL($a[$key][$key2]);
                //var_dump($feature_value_null);
                if (empty($feature_value)) {
                    continue;
                }
                // xoa feature cho product nay neu co
                $sql = "DELETE FROM " . _DB_PREFIX_ . "feature_product WHERE ";
                $sql .= "id_feature=$id_feature AND id_product=$id_product";
                Db::getInstance()->query($sql);
                // kiem tra xem feature nay da ton tai chua?
                $sql = 'SELECT a.id_feature_value FROM ' . _DB_PREFIX_ . 'feature_value AS a INNER JOIN '
                        . _DB_PREFIX_ . 'feature_value_lang AS b ON a.id_feature_value=b.id_feature_value'
                        . " WHERE a.id_feature=$id_feature AND b.value='" . pSQL($feature_value) . "'";
                
                $id_feature_value = (int) Db::getInstance()->getValue($sql);
                
                $sql2 = 'SELECT a.id_feature_value FROM ' . _DB_PREFIX_ . 'feature_value AS a INNER JOIN '
                    . _DB_PREFIX_ . 'feature_value_lang AS b ON a.id_feature_value=b.id_feature_value'
                    . " WHERE a.id_feature=$id_feature AND b.value='" . pSQL($feature_value) . "' AND a.custom='0'";
                $id_feature_value2 = (int) Db::getInstance()->getValue($sql2);
                ////////
                if (!empty($id_feature_value) && $exist_custom_feature == '0') {
                    $check_feature_exist = 'tontaikhongcustom';
                    $d = $id_feature_value;
                }
                if (!empty($id_feature_value2)) {
                    $check_feature_exist = 'tontaicocustom';
                    $exist_custom_feature = '1';
                    $d = $id_feature_value2;
                }
                //var_dump($sql);
                //var_dump($sql2);
                //var_dump($check_feature_exist);
            }
            
            if ($check_feature_exist == 'tontaicocustom') {
                $sql = "REPLACE INTO " . _DB_PREFIX_ . "feature_product(id_feature,id_product,id_feature_value) ";
                $sql .= "VALUES($id_feature,$id_product,$d)";
                Db::getInstance()->query($sql);
            }
            if ($check_feature_exist == 'tontaikhongcustom') {
                $languagesArr = Language::getLanguages(false);
                if (!empty($languagesArr)) {
                    foreach ($languagesArr as $value_lang) {
                        $id_lang = (int) $value_lang['id_lang'];
                        foreach ($a[$key] as $key2 => $row3) {
                            if ($key2 == $value_lang['iso_code']) {
                                $data = array(
                                    'id_feature_value' => $d,
                                    'id_lang' => $id_lang,
                                    'value' => $a[$key][$key2]
                                );
                                //var_dump($data);
                                if (!empty($data['value'])) {
                                    Db::getInstance()->insert('feature_value_lang', $data, false, true, DB::REPLACE);
                                }
                            }
                        }
                    }
                }
                $sql = "REPLACE INTO " . _DB_PREFIX_ . "feature_product(id_feature,id_product,id_feature_value) ";
                $sql .= "VALUES($id_feature,$id_product,$d)";
                Db::getInstance()->query($sql);
            }
            if ($check_feature_exist == 'chuatontai') {
                // chua t?n t?i value n?y cho feature tuong ?ng
                $data = array(
                    'id_feature' => $id_feature,
                    'custom' => 1
                );
                Db::getInstance()->insert('feature_value', $data);
                $id_feature_value = Db::getInstance()->Insert_ID();
                // $arr_id_lang = array();
                $languagesArr = Language::getLanguages(false);
                // foreach ($languagesArr as $v) {
                    // $arr_id_lang[]=(int) ($v['id_lang']);
                // }
                if (!empty($languagesArr)) {
                    foreach ($languagesArr as $value_lang) {
                        $id_lang = (int) $value_lang['id_lang'];
                        foreach ($a[$key] as $key2 => $row3) {
                            if ($key2 == $value_lang['iso_code']) {
                                $data = array(
                                    'id_feature_value' => $id_feature_value,
                                    'id_lang' => $id_lang,
                                    'value' => $a[$key][$key2]
                                );
                                //var_dump($data);
                                if (!empty($data['value'])) {
                                    Db::getInstance()->insert('feature_value_lang', $data, false, true, DB::REPLACE);
                                }
                            }
                        }
                    }
                }
                $data = array(
                    'id_feature_value' => $id_feature_value,
                    'id_feature' => $id_feature,
                    'id_product' => $id_product
                );
                Db::getInstance()->insert('feature_product', $data, false, true, Db::REPLACE);
            }
        }
        return true;
    }
    // reset cover=0 tat anh cover cua product
    public function removeCoverPhoto($id_product)
    {
        $sql = "UPDATE " . _DB_PREFIX_ . "image SET cover=NULL WHERE id_product = " . (int) $id_product;
        Db::getInstance()->query($sql);
        //lay tat ca cac anh cover
        $sql = 'SELECT * FROM ' . _DB_PREFIX_ . 'image WHERE  id_product=' . (int) $id_product;
        if ($results = Db::getInstance()->ExecuteS($sql)) {
            foreach ($results as $row) {
                $id_image = $row["id_image"];
                $sql = "UPDATE " . _DB_PREFIX_ . "image_shop SET cover=NULL WHERE id_image = " . (int) $id_image;
                Db::getInstance()->query($sql);
            }
        }
    }
    // update DEFAULT Attributes
    public function updateDefaultAttribute($id_product)
    {
        $id_product_attribute = (int) Product::getDefaultAttribute($id_product);
        //var_dump($id_product_attribute);
        $id_shop = $this->context->shop->id;
        if ($id_product_attribute > 0) {
            if (Tools::version_compare(_PS_VERSION_, '1.6.1.0', '<')) {
                $sql = "UPDATE " . _DB_PREFIX_ . "product_attribute_shop SET default_on=1 ";
                $sql .= " WHERE ";
                $sql .= " id_product_attribute = " . (int) $id_product_attribute;
                $sql .= " AND id_shop = " . (int) $id_shop;
            } else {
                $sql = "UPDATE " . _DB_PREFIX_ . "product_attribute_shop SET default_on=1 ";
                $sql .= " WHERE id_product=".(int) $id_product;
                $sql .= " AND id_product_attribute = " . (int) $id_product_attribute;
                $sql .= " AND id_shop = " . (int) $id_shop;
            }
            //var_dump($sql);
            Db::getInstance()->query($sql);
            ///
            $sql = "UPDATE " . _DB_PREFIX_ . "product_attribute SET default_on=1 ";
            $sql .=" WHERE id_product = " . (int) $id_product;
            $sql .= " AND id_product_attribute = " . (int) $id_product_attribute;
            //var_dump($sql);
            Db::getInstance()->query($sql);
        }
    }
    
    public function saveDataCsvToDatabase($file_name, $table_name, $import_header = null)
    {
        $db = Db::getInstance(_PS_USE_SQL_SLAVE_);
        $array = $this->readFileXls($file_name);
        if (Tools::getValue('baencode') == 'ansi') {
            $db->query(pSQL("SET NAMES latin1", true));
        }
        // $table_name = md5($file_name);
        
        //// drop table if exists
        $drop_table = 'DROP TABLE IF EXISTS ' . _DB_PREFIX_ . $table_name;
        $db->query($drop_table);
        
        ///// create table if not exists
        $array_query = array();
        $create_table = 'CREATE TABLE IF NOT EXISTS ' . _DB_PREFIX_ . $table_name . ' (';
        foreach ($array[1] as $key => $value) {
            $value;
            $array_query[] = '`'.$key.'` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL';
        }
        $create_table .= implode(', ', $array_query);
        $create_table .= ')';
        $db->query($create_table);
        
        //// insert data
        $count_column = count($array[1]);
        $sql = 'SELECT * FROM ' . _DB_PREFIX_ . $table_name;
        $exists_data = (int) $db->getRow($sql);
        if (empty($import_header)) {
            $import_header = Tools::getValue('import_header');
        }
        if ($exists_data == 0) {
            foreach ($array as $key => $value) {
                if ($import_header == 0 && $key == 1) {
                    continue;
                } else {
                    $array_value_row = array();
                    foreach ($array[$key] as $key2 => $value2) {
                        if ($count_column >= $key2) {
                            $array_value_row[$key2] = pSQL($value2, true);
                        }
                    }
                    $db->insert($table_name, $array_value_row);
                }
            }
        }
    }
    
    public function moveFileDownload($array_virtual_tmp)
    {
        $virtual_product_filename = '';
        $dir = _PS_MODULE_DIR_ . "ba_importer";
        $path_old = $dir . '/images/' . $array_virtual_tmp['display_filename'];
        $http = trim(Tools::strtolower($array_virtual_tmp['display_filename']));

        if (strpos($http, "http://") === 0 || strpos($http, "https://") === 0) {
            $arr = explode("/", $array_virtual_tmp['display_filename']);
            $path_old = $dir . '/images/' . trim(end($arr));
            $this->getImageFromUrl($array_virtual_tmp['display_filename'], $path_old);
        }
        $check_exit = file_exists($path_old);
        if ($check_exit) {
            $virtual_product_filename = ProductDownload::getNewFilename();
            rename($path_old, _PS_DOWNLOAD_DIR_ . $virtual_product_filename);
        }
        return $virtual_product_filename;
    }
    
    public function saveFileImageZip($img, $id_importer_configg)
    {
        $token = Tools::getAdminTokenLite('AdminModules');
        $advance = AdminController::$currentIndex;
        if ($img['error'] == 0) {
            move_uploaded_file($img['tmp_name'], dirname(__FILE__) . "/images/" . $img['name']);
            $zip = new ZipArchive;
            $a = _PS_MODULE_DIR_ . "ba_importer/images/" . $img['name'];
            $res = $zip->open($a);
            if ($res === true) {
                $zip->extractTo(_PS_MODULE_DIR_ . 'ba_importer/images/');
                $zip->close();
            }
            unlink($a);
            ///////////move file
            $dir = dirname(__FILE__) . "/images/";
            $scan = scandir($dir);
            unset($scan[0]);
            unset($scan[1]);
            foreach ($scan as $value) {
                $isfile = is_file($dir . $value);
                if ($isfile == false) {
                    $scan_dir = scandir($dir . $value);
                    foreach ($scan_dir as $value1) {
                        $isfiledir = is_file($dir . $value . "/" . $value1);
                        if ($isfiledir == true) {
                            copy($dir . $value . "/" . $value1, $dir . $value1);
                        }
                    }
                }
            }
        }
        if ($img["size"] != 0) {
            $post_file = strpos(Tools::strtolower($img["name"]), ".zip");
            if ($post_file === false) {
                $src = $advance . '&token=' . $token . '&configure=ba_importer&tab_module=others&';
                $src .= 'module_name=ba_importer&notzip=1&viewba_importer'. $id_importer_configg;
                Tools::redirectAdmin($src);
            }
        }
    }
    
    public function cookiekeymodule()
    {
        $keygooglecookie = sha1(_COOKIE_KEY_ . 'ba_importer');
        $md5file = md5($keygooglecookie);
        return $md5file;
    }
}
function bautf8encode($value)
{
    // echo mb_internal_encoding();
    $arr_encodeing=mb_detect_encoding($value, mb_list_encodings(), true);
    if (!empty($arr_encodeing)) {
        $value = mb_convert_encoding($value, "UTF-8", $arr_encodeing);
        // $value=w1250_to_utf8($value);
    }
    return $value;
}
