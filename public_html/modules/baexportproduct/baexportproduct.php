<?php
/**
 * 2007-2016 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@buy-addons.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 *  @author    Buy-Addons <contact@buy-addons.com>
 *  @copyright 2007-2018 PrestaShop SA
 *  @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 * @since 1.6
 */

class BaExportProduct extends Module
{
    public function __construct()
    {
        $this->name = 'baexportproduct';
        $this->tab = 'migration_tools';
        $this->version = '1.0.11';
        $this->author = 'buy-addons';
        $this->need_instance = 0;
        $this->bootstrap = true;
        $this->module_key = '38d3d96681cf34eef0c455662dae7c7a';
        parent::__construct();
        $this->displayName = $this->l('Export Product to CSV/Excel File');
        $this->description = $this->l('Export All of Products to CSV/Excel File');
    }

    public function install()
    {
        if (parent::install() == false) {
            return false;
        }
        Configuration::UpdateValue('settingsql', '{"id_currency":"0",
        "id_manufacturer":false,"id_supplier":false,"id_category":false,"id_attribute":false,"id_feature":false,
        "id_store":false,"id_status":"0","id_visibility":false,"from_price":"","to_price":"","from_quantity":"",
        "to_quantity":"","from_create":"","to_create":"","from_update":"","to_update":"","from_width":"","to_width":"",
        "from_height":"","to_height":"","from_depth":"","to_depth":"","from_weight":"","to_weight":"","select_feild":"",
        "name_gerenal":[],"name_product":[],"combination":"1","combination_line":"1","format_file":"csv",
        "character":",","namesort":"id_product","SortBy":"ASC","ranger":"0","frRanger":"","toRanger":"",
        "encoding":"utf8"}');

        $dbsqlcron = Db::getInstance(_PS_USE_SQL_SLAVE_);
        $sqlcron = ' CREATE TABLE IF NOT EXISTS ' . _DB_PREFIX_ . 'cronjobs (
            id_cronjob int(10) primary key not null AUTO_INCREMENT,
            id_module int(10),
            description text,
            task text,
            hour int(11),
            day int(11),
            month int(11),
            day_of_week int(11),
            update_at datetime,
            one_shot tinyint(1),
            active tinyint(1),
            id_shop int(11),
            id_shop_group int(11)
        )';
        $dbsqlcron->query($sqlcron);
        return true;
    }

    public function uninstall()
    {
        if (parent::uninstall() == false) {
            return false;
        }
        return true;
    }

    public function getcontent()
    {
        $html = '';

        if (Tools::isSubmit('onlySaveSetting')) {
            $hide = Tools::getValue('display');
            $changeArray = explode(",", $hide);

            $Arrfirst = array();
            foreach ($changeArray as $key => $value) {
                $Arrfirst[] = str_replace(strstr($changeArray[$key], '-'), '', $changeArray[$key]);
                if ($changeArray[$key] == "") {
                    unset($changeArray[$key]);
                }

                if ($Arrfirst[$key] == "") {
                    unset($Arrfirst[$key]);
                }
            }

            ////////// lưu dữ liệu khi ấn nút save

            $setting = array(
                'id_currency' => Tools::getValue('nameCurr'),
                'id_manufacturer' => Tools::getValue('Manufacturers'),
                'id_supplier' => Tools::getValue('Supplier'),
                'id_category' => Tools::getValue('Category'),
                'id_attribute' => Tools::getValue('OpAttri'),
                'id_feature' => Tools::getValue('OpFeatu'),
                'id_store' => Tools::getValue('opStore'),
                'id_status' => Tools::getValue('status'),
                'id_visibility' => Tools::getValue('visibility'),
                'from_price' => Tools::getValue('fromMoney'),
                'to_price' => Tools::getValue('ToMoney'),
                'from_quantity' => Tools::getValue('FromQuantity'),
                'to_quantity' => Tools::getValue('ToQuantity'),
                'from_create' => Tools::getValue('fromCreate'),
                'to_create' => Tools::getValue('ToCreate'),
                'from_update' => Tools::getValue('FromUpdate'),
                'to_update' => Tools::getValue('ToUpdate'),
                'from_width' => Tools::getValue('FromWidth'),
                'to_width' => Tools::getValue('ToWidth'),
                'from_height' => Tools::getValue('FromHeight'),
                'to_height' => Tools::getValue('ToHeight'),
                'from_depth' => Tools::getValue('FromDepth'),
                'to_depth' => Tools::getValue('ToDepth'),
                'from_weight' => Tools::getValue('FromWeight'),
                'to_weight' => Tools::getValue('ToWeight'),
                'select_feild' => Tools::getValue('display'),
                'name_gerenal' => $changeArray,
                'name_product' => $Arrfirst,
                'combination' => Tools::getValue('Combination'),
                'combination_line' => Tools::getValue('separate'),
                'format_file' => Tools::getValue('format_file'),
                'character' => Tools::getValue('Delimiter'),
                'namesort' => Tools::getValue('namesort'),
                'SortBy' => Tools::getValue('SortBy'),
                'ranger' => Tools::getValue('ranger'),
                'frRanger' => Tools::getValue('TextFromranger'),
                'toRanger' => Tools::getValue('TextToranger'),
                'encoding' => Tools::getValue('encoding'),
            );
            $ToStr = Tools::jsonEncode($setting);
            Configuration::UpdateValue('settingsql', $ToStr);
            Tools::jsonDecode($ToStr, true);

            $getlist = Configuration::get('settingsql');
            $getlistArr = Tools::jsonDecode($getlist, true);
            
            $this->smarty->assign('settingtpl', $getlistArr);
            if (Configuration::UpdateValue('settingsql', $ToStr) == 1) {
                $html .= $this->displayConfirmation($this->l('Update successful'));
            }
        }



        ///////// save setting vào bảng cronjob
        if (Tools::isSubmit('savetime')) {
            $settingtime = array(
                'hour' => Tools::getValue('hour'),
                'dayofmonth' => Tools::getValue('dayofmonth'),
                'month' => Tools::getValue('month'),
                'dayofweek' => Tools::getValue('dayofweek')
            );
            $ToStrSettingTime = Tools::jsonEncode($settingtime);
            Configuration::UpdateValue('settingsqltime', $ToStrSettingTime);
            Tools::jsonDecode($ToStrSettingTime, true);
            $this->settingProduct();
            if (Configuration::UpdateValue('settingsqltime', $ToStrSettingTime) == 1) {
                $html .= $this->displayConfirmation($this->l('Update successful'));
            }
        }
        $getConfigTime = Configuration::get('settingsqltime');
        $ArrConfigTime = Tools::jsonDecode($getConfigTime, true);
        $this->smarty->assign('ArrConfigTime', $ArrConfigTime);
        ///link download
        $link1 = Tools::getShopProtocol() . Tools::getServerName() . __PS_BASE_URI__;
        $link1 .= 'index.php?controller=productcontr&fc=module&module=baexportproduct&token=';
        $link1 .= md5(_COOKIE_KEY_);
        $keytoken = md5(_COOKIE_KEY_);
        
        $this->smarty->assign('link1', $link1);
        $this->smarty->assign('keytoken', $keytoken);
        //////////tab setting
        
        /////////
        if (Tools::isSubmit('export')) {
            $this->getFeature();

            $hide = Tools::getValue('display');
            $changeArray = explode(",", $hide);
            $Arrfirst = array();
            foreach ($changeArray as $key => $value) {
                if ($changeArray[$key] == "") {
                    unset($changeArray[$key]);
                }
                $Arrfirst[] = str_replace(strstr($changeArray[$key], '-'), '', $changeArray[$key]);
            }
            if ($Arrfirst[$key] == "") {
                unset($Arrfirst[$key]);
            }

            $ArrSecond = array();
            foreach ($changeArray as $key => $value) {
                if ($changeArray[$key] == "") {
                    unset($changeArray[$key]);
                }
                $ArrSecond[] = str_replace("-", "", strstr($value, '-'));
            }
            ///input table config

            $setting = array(
                'id_currency' => Tools::getValue('nameCurr'),
                'id_manufacturer' => Tools::getValue('Manufacturers'),
                'id_supplier' => Tools::getValue('Supplier'),
                'id_category' => Tools::getValue('Category'),
                'id_attribute' => Tools::getValue('OpAttri'),
                'id_feature' => Tools::getValue('OpFeatu'),
                'id_store' => Tools::getValue('opStore'),
                'id_status' => Tools::getValue('status'),
                'id_visibility' => Tools::getValue('visibility'),
                'from_price' => Tools::getValue('fromMoney'),
                'to_price' => Tools::getValue('ToMoney'),
                'from_quantity' => Tools::getValue('FromQuantity'),
                'to_quantity' => Tools::getValue('ToQuantity'),
                'from_create' => Tools::getValue('fromCreate'),
                'to_create' => Tools::getValue('ToCreate'),
                'from_update' => Tools::getValue('FromUpdate'),
                'to_update' => Tools::getValue('ToUpdate'),
                'from_width' => Tools::getValue('FromWidth'),
                'to_width' => Tools::getValue('ToWidth'),
                'from_height' => Tools::getValue('FromHeight'),
                'to_height' => Tools::getValue('ToHeight'),
                'from_depth' => Tools::getValue('FromDepth'),
                'to_depth' => Tools::getValue('ToDepth'),
                'from_weight' => Tools::getValue('FromWeight'),
                'to_weight' => Tools::getValue('ToWeight'),
                'select_feild' => Tools::getValue('display'),
                'name_gerenal' => $changeArray,
                'name_product' => $Arrfirst,
                'combination' => Tools::getValue('Combination'),
                'combination_line' => Tools::getValue('separate'),
                'format_file' => Tools::getValue('format_file'),
                'character' => Tools::getValue('Delimiter'),
                'namesort' => Tools::getValue('namesort'),
                'SortBy' => Tools::getValue('SortBy'),
                'ranger' => Tools::getValue('ranger'),
                'frRanger' => Tools::getValue('TextFromranger'),
                'toRanger' => Tools::getValue('TextToranger'),
                'encoding' => Tools::getValue('encoding'),
            );
            $ToStr = Tools::jsonEncode($setting);
            Configuration::UpdateValue('settingsql', $ToStr);
            Tools::jsonDecode($ToStr, true);

            $getlist = Configuration::get('settingsql');
            $getlistArr = Tools::jsonDecode($getlist, true);
            $this->smarty->assign('settingtpl', $getlistArr);
            $All = $this->settingall();
            $character = $getlistArr['character'];

            if ($getlistArr['format_file'] == 'csv') {
                ob_clean();
                if ($getlistArr['character'] == "t") {
                    header('Content-type: text/csv');
                    $namefi = 'Products_';
                    header('Content-Disposition: attachment;filename="'.pSQL($namefi).'.'.date('Y-m-d H:i').'.csv"');
                    header('Pragma: no-cache');
                    header('Expires: 0');
                    $file = fopen('php://output', 'w');

                    fputcsv($file, $Arrfirst, chr(9));

                    foreach ($All as $row) {
                        fputcsv($file, $row, chr(9));
                    }
                    exit();
                } elseif ($getlistArr['character'] == "," || $getlistArr['character'] == "") {
                    header('Content-type: text/csv');
                    $namefi = 'Products_';
                    header('Content-Disposition: attachment;filename="'.pSQL($namefi).'.'.date('Y-m-d H:i').'.csv"');
                    header('Pragma: no-cache');
                    header('Expires: 0');
                    $file = fopen('php://output', 'w');
                    fputcsv($file, $Arrfirst);

                    foreach ($All as $row) {
                        fputcsv($file, $row);
                    }
                    exit();
                } else {
                    header('Content-type: text/csv');
                    $namefi = 'Export Product to CSV/Excel File';
                    header('Content-Disposition: attachment;filename="'.pSQL($namefi).'.'.date('Y-m-d H:i').'.csv"');
                    header('Pragma: no-cache');
                    header('Expires: 0');
                    $file = fopen('php://output', 'w');

                    fputcsv($file, $Arrfirst, $character);

                    foreach ($All as $row) {
                        fputcsv($file, $row, $character);
                    }
                    exit();
                }
            } elseif ($getlistArr['format_file'] == 'xls') {
                $fileName = "Products_" . date('Y-m-d H:i') . ".xls";
                require_once(dirname(__FILE__).'/libs/PHPExcel.php');
                $xls = new PHPExcel();
                $xls->getProperties()->setCreator($this->author);
                $xls->getProperties()->setLastModifiedBy($this->author);
                $xls->getProperties()->setTitle($this->name);
                $xls->setActiveSheetIndex(0);
                $xls->getActiveSheet()->setTitle("Products");
                //echo '<pre>';print_r($Arrfirst);die;
                foreach ($Arrfirst as $k => $v) {
                    $xls->getActiveSheet()->setCellValueByColumnAndRow($k, 1, $v);
                }
                $row_index = 2;
                foreach ($All as $row) {
                    $col_index = 0;
                    foreach ($row as $key => $value) {
                        $xls->getActiveSheet()->setCellValueByColumnAndRow($col_index, $row_index, $value);
                        $col_index++;
                    }
                    $row_index++;
                }
                
                $xls->setActiveSheetIndex(0);
                //////////////////////
                // Redirect output to a client’s web browser (Excel5)
                ob_clean();
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$fileName.'"');
                header('Cache-Control: max-age=0');
                // If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');
                // If you're serving to IE over SSL, then the following may be needed
                header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header('Pragma: public'); // HTTP/1.0
                $xls = PHPExcel_IOFactory::createWriter($xls, 'Excel5');
                $xls->save('php://output');
                exit;
            } elseif ($getlistArr['format_file'] == 'xlsx') {
                $fileName = "Products_" . date('Y-m-d H:i') . ".xlsx";
                require_once(dirname(__FILE__).'/libs/PHPExcel.php');
                $xls = new PHPExcel();
                $xls->getProperties()->setCreator($this->author);
                $xls->getProperties()->setLastModifiedBy($this->author);
                $xls->getProperties()->setTitle($this->name);
                $xls->setActiveSheetIndex(0);
                $xls->getActiveSheet()->setTitle("Products");
                //echo '<pre>';print_r($Arrfirst);die;
                foreach ($Arrfirst as $k => $v) {
                    $xls->getActiveSheet()->setCellValueByColumnAndRow($k, 1, $v);
                }
                $row_index = 2;
                foreach ($All as $row) {
                    $col_index = 0;
                    foreach ($row as $key => $value) {
                        $xls->getActiveSheet()->setCellValueByColumnAndRow($col_index, $row_index, $value);
                        $col_index++;
                    }
                    $row_index++;
                }
                
                $xls->setActiveSheetIndex(0);
                //////////////////////
                // Redirect output to a client’s web browser (Excel5)
                ob_clean();
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="'.$fileName.'"');
                header('Cache-Control: max-age=0');
                // If you're serving to IE 9, then the following may be needed
                header('Cache-Control: max-age=1');
                // If you're serving to IE over SSL, then the following may be needed
                header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
                header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
                header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
                header('Pragma: public'); // HTTP/1.0
                $xls = PHPExcel_IOFactory::createWriter($xls, 'Excel2007');
                $xls->save('php://output');
                exit;
            }
        }
        $getlist = Configuration::get('settingsql');
        $getlistArr = Tools::jsonDecode($getlist, true);
        $this->smarty->assign('settingtpl', $getlistArr);
        $this->smarty->assign('version', strpos(_PS_VERSION_, '1.5'));


        $id_lang = $this->context->language->id;

        $getNameAttributeGr = AttributeGroup::getAttributesGroups($id_lang);
        $this->smarty->assign('getNameAttributeGr', $getNameAttributeGr);

        $tenfile = $this->name;
        $ba_url = Tools::getShopProtocol() . Tools::getHttpHost() . __PS_BASE_URI__;
        $this->smarty->assign('ba_url', $ba_url);
        $this->smarty->assign('tenfile', $tenfile);

        $bamodule = AdminController::$currentIndex;
        $token = Tools::getAdminTokenLite('AdminModules');
        $configure = $this->name;
        $linkurl = Tools::getShopProtocol() . Tools::getHttpHost() . __PS_BASE_URI__ . 'modules/'
                . $this->name . '/file_csv/product.csv';
        $this->smarty->assign('linkurl', $linkurl);
        $this->smarty->assign('configure', $configure);
        $this->smarty->assign('bamodule', $bamodule);
        $this->smarty->assign('token', $token);

        /////////smarty tpl

        $Cur = Currency::getCurrencies();
        $this->smarty->assign('Cur', $Cur);
        $shop = Shop::getShops(true, null, false);
        $this->smarty->assign('shop', $shop);
        $idAttribute = AttributeGroup::getAttributesGroups($id_lang);
        $idAttriGroup = array();
        $Attribute13 = array();
        foreach ($idAttribute as $k0 => $v0) {
            $v0;
            $idAttriGroup[] = $idAttribute[$k0]['id_attribute_group'];
        }
        foreach ($idAttriGroup as $k8 => $v8) {
            $v8;
            $Attribute13[] = AttributeGroup::getAttributes($id_lang, $idAttriGroup[$k8]);
        }
        $idfeature = Feature::getFeatures(1, 1);
        $ValFeature = array();
        foreach ($idfeature as $k => $v) {
            $v;
            $ValFeature[] = FeatureValue::getFeatureValuesWithLang($id_lang, $idfeature[$k]['id_feature']);
        }

        $this->smarty->assign('idfeature', $idfeature);
        $this->smarty->assign('ValFeature', $ValFeature);
        $this->smarty->assign('attribute', $idAttribute);
        $this->smarty->assign('Attribute13', $Attribute13);
        $Language = Language::getLanguages(true, false);

        $this->smarty->assign('Language', $Language);
        $ArrFe = array();
        $feature = Feature::getFeatures($id_lang, true);
        foreach ($feature as $k => $v100) {
            $v100;
            $ArrFe[] = $feature[$k]['name'];
        }
        $this->smarty->assign('Features', $ArrFe);
        $nameManufac = $this->manufacturer();
        $nameSuppli = $this->suppiler();

        $currency = Currency::getDefaultCurrency();
        $this->smarty->assign('currency', $currency);
        $this->smarty->assign('nameManufac', $nameManufac);
        $this->smarty->assign('nameSuppli', $nameSuppli);

        $idCate = $getlistArr['id_category'];
        if ($idCate == false) {
            $idCate = array(00);
        } else {
            $idCate = $getlistArr['id_category'];
        }
        if (strpos(_PS_VERSION_, '1.5') === 0) {
            $root = Category::getRootCategory();
            $tab_root = array('id_category' => $root->id, 'name' => $root->name);
            $selectcat = $getlistArr['id_category'];
            $helper = new Helper();
            $a = $helper->renderCategoryTree($tab_root, $selectcat, 'Category', false, false, array(), false);
            $this->smarty->assign("menu", $a);
        } else {
            $root = Category::getRootCategory();
            $tree = new HelperTreeCategories('categories_col1');
            $tree->setUseCheckBox(false)
                    ->setAttribute('is_category_filter', $root->id)
                    ->setSelectedCategories($idCate)
                    ->setRootCategory($root->id)
                    ->setUseCheckBox(true)
                    ->setInputName('Category');
            $menu = $this->tpl_list_vars['category_tree'] = $tree->render();
            $this->smarty->assign("menu", $menu);
        }

        ///////

        $taskbar = 'exportProduct';
        if (Tools::getValue('task')) {
            $taskbar = Tools::getValue('task');
        }
        $this->smarty->assign('taskbar', $taskbar);
        $html .= $this->display(__FILE__, 'views/templates/admin/tab.tpl');


        if (Tools::getValue('task') == 'Setting') {
            $html .= $this->warning();
            $html .= $this->display(__FILE__, 'views/templates/admin/setting.tpl');
        }if (Tools::getValue('task') == '') {
            $html .= $this->display(__FILE__, 'views/templates/admin/exportProduct.tpl');
            $this->context->controller->addJS($this->_path . 'views/js/productExport.js');
        } elseif (Tools::getValue('task') == 'exportProduct') {
            $html .= $this->display(__FILE__, 'views/templates/admin/exportProduct.tpl');
            $this->context->controller->addJS($this->_path . 'views/js/productExport.js');
        }

        $html .= '
            <script type="text/javascript">
                var dateFormat1=\'' . $this->myformatdate() . '\';
            </script>
        ';
        $this->smarty->assign('_COOKIE_KEY_', _COOKIE_KEY_);
        $this->context->controller->addJqueryUI('ui.sortable');

        
        if (strpos(_PS_VERSION_, '1.5') === 0) {
            $this->context->controller->addCSS($this->_path . 'views/css/stylecss1_5.css');
        } else {
            $this->context->controller->addCSS($this->_path . 'views/css/styleExport.css');
        }
        return $html;
    }

    public function typeattribute()
    {
        $Id_lang1 = $this->context->language->id;
        $dbSQL = Db::getInstance(_PS_USE_SQL_SLAVE_);
        $sql = 'select name from ' . _DB_PREFIX_ . 'attribute_group_lang where id_lang = "' . (int) $Id_lang1 . '"';
        $ValSql = $dbSQL->ExecuteS($sql);
        return $ValSql;
    }

    public function attribute()
    {
        $Id_lang1 = $this->context->language->id;
        $getlist = Configuration::get('settingsql');
        $getlistArr = Tools::jsonDecode($getlist, true);
        $valAttri = $getlistArr['id_attribute'];
        $strAtt = implode(',', (array) $valAttri);
        if ($strAtt == "") {
            $Attr = '';
        } else {
            $dbSQL = Db::getInstance(_PS_USE_SQL_SLAVE_);
            $sql = 'SELECT ' . _DB_PREFIX_ . 'product_attribute.id_product 
            from ' . _DB_PREFIX_ . 'product_attribute_combination 
            INNER JOIN ' . _DB_PREFIX_ . 'attribute_lang on
            ' . _DB_PREFIX_ . 'product_attribute_combination.id_attribute
            = ' . _DB_PREFIX_ . 'attribute_lang.id_attribute 
            INNER join 
            ' . _DB_PREFIX_ . 'product_attribute on 
            ' . _DB_PREFIX_ . 'product_attribute_combination.id_product_attribute 
            = ' . _DB_PREFIX_ . 'product_attribute.id_product_attribute 
            where id_lang = "' . (int) $Id_lang1 . '" and 
            ' . _DB_PREFIX_ . 'attribute_lang.id_attribute in (' . pSQL($strAtt) . ')';
            $Val = $dbSQL->ExecuteS($sql);

            $a = array();
            foreach ($Val as $k => $v) {
                $v;
                $a[] = $Val[$k]['id_product'];
            }
            $b = implode(',', $a);
            if ($b == "") {
                $b = 0;
                $Attr = 'id_product in (' . pSQL($b) . ')';
            } else {
                $Attr = 'id_product in (' . pSQL($b) . ')';
            }
        }
        return $Attr;
    }

    public function store()
    {
        $getlist = Configuration::get('settingsql');
        $getlistArr = Tools::jsonDecode($getlist, true);
        $getidStore = $getlistArr['id_store'];
        $StrIdStore = implode(',', (array) $getidStore);
        if ($StrIdStore == "") {
            $rsStore = '';
        } else {
            $dbSQL = Db::getInstance(_PS_USE_SQL_SLAVE_);
            $sql = 'select id_product from ' . _DB_PREFIX_ . 'product
            where id_shop_default in (' . pSQL($StrIdStore) . ')';
            $rtsql = $dbSQL->ExecuteS($sql);
            $val = array();
            foreach ($rtsql as $k => $v) {
                $v;
                $val[] = $rtsql[$k]['id_product'];
            }
            $strval = implode(',', $val);
            $rsStore = 'id_product in (' . pSQL($strval) . ')';
        }


        return $rsStore;
    }

    public function feature()
    {
        $getlist = Configuration::get('settingsql');
        $getlistArr = Tools::jsonDecode($getlist, true);

        $GetFeature = $getlistArr['id_feature'];


        if ($GetFeature == "") {
            $selectFeate = '';
        } else {
            $strGetFeature = implode(',', $GetFeature);
            $dbSQL = Db::getInstance(_PS_USE_SQL_SLAVE_);
            $sql = 'select id_product from ' . _DB_PREFIX_ . 'feature_product 
            where id_feature_value in (' . pSQL($strGetFeature) . ')';
            $rtsql = $dbSQL->ExecuteS($sql);
            $val = array();
            foreach ($rtsql as $k => $v) {
                $v;
                $val[] = $rtsql[$k]['id_product'];
            }
            $StrVal = implode(',', $val);
            if ($StrVal == '') {
                $selectFeate = '';
            } else {
                $selectFeate = 'id_product in (' . pSQL($StrVal) . ')';
            }
        }

        return $selectFeate;
    }

    public function visibility()
    {
        $getlist = Configuration::get('settingsql');
        $getlistArr = Tools::jsonDecode($getlist, true);
        $a = $getlistArr['id_visibility'];
        $a1 = implode('","', (array) $a);
        if ($a == "") {
            $sqlVisibility = '';
        } else {
            $sqlVisibility = 'visibility in ("' . $a1 . '")';
        }
        return $sqlVisibility;
    }

    public function getFeature()
    {
        $Id_lang1 = $this->context->language->id;
        $dbsql = Db::getInstance(_PS_USE_SQL_SLAVE_);
        $sql = 'SELECT ' . _DB_PREFIX_ . 'feature_product.id_product,
        ' . _DB_PREFIX_ . 'feature_product.id_feature,' . _DB_PREFIX_ . 'feature_value_lang.id_lang,
        ' . _DB_PREFIX_ . 'feature_value_lang.id_feature_value,' . _DB_PREFIX_ . 'feature_value_lang.value 
        from ' . _DB_PREFIX_ . 'feature_value_lang INNER JOIN ' . _DB_PREFIX_ . 'feature_product on 
        ' . _DB_PREFIX_ . 'feature_product.id_feature_value = ' . _DB_PREFIX_ . 'feature_value_lang.id_feature_value 
        where id_lang ="' . (int) $Id_lang1 . '"';
        $sqlFeater = $dbsql->ExecuteS($sql);

        return $sqlFeater;
    }

    public function status()
    {
        $getlist = Configuration::get('settingsql');
        $getlistArr = Tools::jsonDecode($getlist, true);
        $PressStatus = $getlistArr['id_status'];
        if ($PressStatus == 1) {
            $sqlStatus = 'active = 0';
        } elseif ($PressStatus == 2) {
            $sqlStatus = 'active = 1';
        } else {
            $sqlStatus = '';
        }
        return $sqlStatus;
    }

    public function checkmoney()
    {
        $getlist = Configuration::get('settingsql');
        $getlistArr = Tools::jsonDecode($getlist, true);

        $fromMoney = $getlistArr['from_price'];
        $ToMoney = $getlistArr['to_price'];
        if ($ToMoney == "" && $fromMoney == "") {
            $sqlprice = '';
        } elseif ($ToMoney == "") {
            $sqlprice = 'price > "' . (int) $fromMoney . '"';
        } elseif ($fromMoney == "") {
            $sqlprice = 'price < "' . (int) $ToMoney . '"';
        } else {
            $sqlprice = 'price > "' . (int) $fromMoney . '" and price < "' . (int) $ToMoney . '"';
        }

        return $sqlprice;
    }

    public function selectQuantity()
    {
        $getlist = Configuration::get('settingsql');
        $getlistArr = Tools::jsonDecode($getlist, true);
        $fromQuantity = $getlistArr['from_quantity'];
        $ToQuantity = $getlistArr['to_quantity'];
        $dbSQL = Db::getInstance(_PS_USE_SQL_SLAVE_);
        if ($fromQuantity == "" && $ToQuantity == "") {
            $sql = 'select id_product from ' . _DB_PREFIX_ . 'stock_available 
            where id_product_attribute = 0';
        } elseif ($fromQuantity == "") {
            $sql = 'select id_product from ' . _DB_PREFIX_ . 'stock_available 
            where id_product_attribute = 0 and quantity < "' . (int) $ToQuantity . '"';
        } elseif ($ToQuantity == "") {
            $sql = 'select id_product from ' . _DB_PREFIX_ . 'stock_available 
            where id_product_attribute = 0 and quantity > "' . (int) $fromQuantity . '"';
        } else {
            $sql = 'select id_product from ' . _DB_PREFIX_ . 'stock_available 
            where id_product_attribute = 0 and quantity > "' . (int) $fromQuantity . '" 
            and quantity < "' . (int) $ToQuantity . '"';
        }
        $PQuantity = $dbSQL->ExecuteS($sql);
        $SLQuantity = 'id_product in (0)';
        if (!empty($PQuantity)) {
            $array = array();
            foreach ($PQuantity as $key => $value) {
                $value;
                $array[] = $PQuantity[$key]['id_product'];
            }
            $String = implode(',', $array);
            $SLQuantity = 'id_product in (' . pSQL($String) . ') ';
        }

        return $SLQuantity;
    }

    public function numberProduct()
    {
        $getlist = Configuration::get('settingsql');
        $getlistArr = Tools::jsonDecode($getlist, true);
        
        $dbsql = Db::getInstance(_PS_USE_SQL_SLAVE_);
        $sql = 'SELECT id_product from ' . _DB_PREFIX_ . 'product ORDER BY id_product ASC ';
        $sqlNumberProduct = $dbsql->ExecuteS($sql);
        $a = $getlistArr['ranger'];
        $a1 = $getlistArr['frRanger'];
        $a2 = $getlistArr['toRanger'];
        if ($a == 1) {
            if ($a1 == '' && $a2 == '') {
                $rtsqlNumber = '';
            } elseif ($a1 > count($sqlNumberProduct)) {
                $rtsqlNumber = 'id_product in (0)';
            } elseif ($a1 > $a2 && !empty($a2)) {
                $rtsqlNumber = 'id_product in (0)';
            } elseif ($a1 == '') {
                $dbsql = Db::getInstance(_PS_USE_SQL_SLAVE_);
                $sql = 'SELECT id_product from ' . _DB_PREFIX_ . 'product ORDER BY id_product ASC ';
                $sqlNumberProduct = $dbsql->ExecuteS($sql);
                $numberProduct = array();
                for ($i = 0; $i < $a2; $i++) {
                    $numberProduct[] = $sqlNumberProduct[$i];
                }
                
                foreach ($numberProduct as $key => $value) {
                    $value;
                    if ($numberProduct[$key] == "") {
                        unset($numberProduct[$key]);
                    }
                }
                // foreach ()
                $rtNumber = array();
                foreach ($numberProduct as $k => $value) {
                    $value;
                    $rtNumber[] = $numberProduct[$k]['id_product'];
                }
                $StNumber = implode(',', $rtNumber);
                $rtsqlNumber = 'id_product in (' . pSQL($StNumber) . ')';
            } elseif ($a2 == '') {
                $dbsql = Db::getInstance(_PS_USE_SQL_SLAVE_);
                $sql = 'SELECT id_product from ' . _DB_PREFIX_ . 'product ORDER BY id_product ASC ';
                $sqlNumberProduct = $dbsql->ExecuteS($sql);
                $numberProduct = array();
                for ($i = $a1; $i < count($sqlNumberProduct); $i++) {
                    $numberProduct[] = $sqlNumberProduct[$i];
                }
                foreach ($numberProduct as $key => $value) {
                    $value;
                    if ($numberProduct[$key] == "") {
                        unset($numberProduct[$key]);
                    }
                }
                $rtNumber = array();
                foreach ($numberProduct as $k => $value) {
                    $rtNumber[] = $numberProduct[$k]['id_product'];
                }
                $StNumber = implode(',', $rtNumber);
                $rtsqlNumber = 'id_product in (' . pSQL($StNumber) . ')';
            } else {
                $dbsql = Db::getInstance(_PS_USE_SQL_SLAVE_);
                $sql = 'SELECT id_product from ' . _DB_PREFIX_ . 'product ORDER BY id_product ASC ';
                $sqlNumberProduct = $dbsql->ExecuteS($sql);
                $numberProduct = array();
                $rtNumber = array();
                for ($i = $a1 -1; $i < $a2; $i++) {
                    $numberProduct[] = $sqlNumberProduct[$i];
                }
                foreach ($numberProduct as $key => $value) {
                    $value;
                    if ($numberProduct[$key] == "") {
                        unset($numberProduct[$key]);
                    }
                }
                foreach ($numberProduct as $k => $value) {
                    $rtNumber[] = $numberProduct[$k]['id_product'];
                }
                
                $StNumber = implode(',', $rtNumber);
                $rtsqlNumber = 'id_product in (' . pSQL($StNumber) . ')';
            }
        } else {
            $rtsqlNumber = '';
        }
        return $rtsqlNumber;
    }

    public function checkDateCreate()
    {
        $getlist = Configuration::get('settingsql');
        $getlistArr = Tools::jsonDecode($getlist, true);
        $DateCreate = '';
        $FromCreate = $getlistArr['from_create'];
        $formatFromDate = date("Y-m-d", strtotime(str_replace('/', '-', $FromCreate))) . " 00:00:00";
        $toCreate = $getlistArr['to_create'];
        $formatToDate = date("Y-m-d", strtotime(str_replace('/', '-', $toCreate))) . " 23:59:59";
        if ($FromCreate == "" && $toCreate == "") {
            $DateCreate = "";
        } elseif ($toCreate == "") {
            $DateCreate = 'date_add > "' . pSQL($formatFromDate) . '"';
        } elseif ($FromCreate == "") {
            $DateCreate = 'date_add < "' . pSQL($formatToDate) . '"';
        } else {
            $DateCreate = 'date_add > "' . pSQL($formatFromDate) . '" and date_add < "' . pSQL($formatToDate) . '" ';
        }
        return $DateCreate;
    }

    public function checkDateUpdate()
    {
        $getlist = Configuration::get('settingsql');
        $getlistArr = Tools::jsonDecode($getlist, true);
        $DateUpdate = '';
        $FromUpdate = $getlistArr['from_update'];
        $formatFromupdate = date("Y-m-d", strtotime(str_replace('/', '-', $FromUpdate))) . " 00:00:00";
        $ToUpdate = $getlistArr['to_update'];
        $FormatToUpdate = date("Y-m-d", strtotime(str_replace('/', '-', $ToUpdate))) . " 00:00:00";
        if ($FromUpdate == "" && $ToUpdate == "") {
            $DateUpdate = '';
        } elseif ($ToUpdate == "") {
            $DateUpdate = 'date_upd > "' . pSQL($formatFromupdate) . '"';
        } elseif ($FromUpdate == "") {
            $DateUpdate = 'date_upd < "' . pSQL($FormatToUpdate) . '"';
        } else {
            $DateUpdate = 'date_upd > "' . pSQL($formatFromupdate) . '"
            and date_upd < "' . pSQL($FormatToUpdate) . '" ';
        }
        return $DateUpdate;
    }

    public function selectManufactor()
    {
        $getlist = Configuration::get('settingsql');
        $getlistArr = Tools::jsonDecode($getlist, true);
        $SelectManufac = '';
        $pickManuFac = $getlistArr['id_manufacturer'];
        $arr = array();
        if (!empty($pickManuFac)) {
            foreach ($pickManuFac as $value) {
                $arr[] = $value;
            }
            $StringManu = implode(',', $arr);
            $SelectManufac = 'id_manufacturer in (' . pSQL($StringManu) . ')';
        }
        return $SelectManufac;
    }

    public function selectSupplie()
    {
        $getlist = Configuration::get('settingsql');
        $getlistArr = Tools::jsonDecode($getlist, true);
        $SelectSup = '';
        $pickSup = $getlistArr['id_supplier'];
        $arr = array();

        if (!empty($pickSup)) {
            foreach ($pickSup as $value) {
                $arr[] = $value;
            }
            $StringSup = implode(',', $arr);

            $SelectSup = 'id_supplier in (' . pSQL($StringSup) . ')';
        }

        return $SelectSup;
    }

    public function selectCategory()
    {
        $getlist = Configuration::get('settingsql');
        $getlistArr = Tools::jsonDecode($getlist, true);
        $pickCategory = $getlistArr['id_category'];
        $StrCate = implode(',', (array) $pickCategory);

        $dbsql = Db::getInstance(_PS_USE_SQL_SLAVE_);
        if ($StrCate == "") {
            $sql = 'select id_product from ' . _DB_PREFIX_ . 'category_product';
        } else {
            $sql = 'select id_product from ' . _DB_PREFIX_ . 'category_product
            where id_category in (' . pSQL($StrCate) . ')';
        }

        $nameSupplier = $dbsql->ExecuteS($sql);
        $a = array();
        foreach ($nameSupplier as $k => $value) {
            $value;
            $a[] = $nameSupplier[$k]['id_product'];
        }
        $StrA = implode(',', $a);
        if ($pickCategory == "") {
            $selectCate = '';
        } else {
            $selectCate = 'id_product in (' . pSQL($StrA) . ')';
        }
        return $selectCate;
    }

    public function manufacturer()
    {
        $dbsql = Db::getInstance(_PS_USE_SQL_SLAVE_);
        $sql = 'select * from ' . _DB_PREFIX_ . 'manufacturer';
        $nameMANU = $dbsql->ExecuteS($sql);
        return $nameMANU;
    }

    public function suppiler()
    {
        $dbsql = Db::getInstance(_PS_USE_SQL_SLAVE_);
        $sql = 'select * from ' . _DB_PREFIX_ . 'supplier';
        $nameSupplier = $dbsql->ExecuteS($sql);
        return $nameSupplier;
    }

    public function checkWidth()
    {
        $SelectWidth = '';
        $getlist = Configuration::get('settingsql');
        $getlistArr = Tools::jsonDecode($getlist, true);
        $fromWidth1 = $getlistArr['from_width'];
        $ToWidth = $getlistArr['to_width'];
        if ($fromWidth1 == '' && $ToWidth == '') {
            $SelectWidth = '';
        } elseif ($ToWidth == '') {
            $SelectWidth = ' width >= " ' . (int) $fromWidth1 . '" ';
        } elseif ($fromWidth1 == '') {
            $SelectWidth = ' width <= "' . (int) $ToWidth . '" ';
        } else {
            $SelectWidth = ' width <= "' . (int) $ToWidth . '" and width >= "' . (int) $fromWidth1 . '" ';
        }

        return $SelectWidth;
    }

    public function checkHeight()
    {
        $selectHeight = '';
        $getlist = Configuration::get('settingsql');
        $getlistArr = Tools::jsonDecode($getlist, true);
        $FromHeight = $getlistArr['from_height'];
        $ToHeight = $getlistArr['to_height'];
        if ($FromHeight == '' && $ToHeight == '') {
            $selectHeight = '';
        } elseif ($ToHeight == '') {
            $selectHeight = ' height >= " ' . (int) $FromHeight . '" ';
        } elseif ($FromHeight == '') {
            $selectHeight = ' height <= "' . (int) $ToHeight . '" ';
        } else {
            $selectHeight = ' height <= "' . (int) $ToHeight . '" and height >= "' . (int) $FromHeight . '" ';
        }
        return $selectHeight;
    }

    public function checkDepth()
    {
        $selectDepth = '';
        $getlist = Configuration::get('settingsql');
        $getlistArr = Tools::jsonDecode($getlist, true);
        $FromDepth = $getlistArr['from_depth'];
        $ToDepth = $getlistArr['to_depth'];
        if ($FromDepth == '' && $ToDepth == '') {
            $selectDepth = '';
        } elseif ($ToDepth == '') {
            $selectDepth = ' depth >= " ' . (int) $FromDepth . '" ';
        } elseif ($FromDepth == '') {
            $selectDepth = ' depth <= "' . (int) $ToDepth . '" ';
        } else {
            $selectDepth = ' depth <= "' . (int) $ToDepth . '" and depth >= "' . (int) $FromDepth . '" ';
        }
        return $selectDepth;
    }

    public function checkWeight()
    {
        $selectWeight = '';
        $getlist = Configuration::get('settingsql');
        $getlistArr = Tools::jsonDecode($getlist, true);
        $FromWeight = $getlistArr['from_weight'];
        $ToWeight = $getlistArr['to_weight'];
        if ($FromWeight == '' && $ToWeight == '') {
            $selectWeight = '';
        } elseif ($ToWeight == '') {
            $selectWeight = ' weight >= " ' . (int) $FromWeight . '" ';
        } elseif ($FromWeight == '') {
            $selectWeight = ' weight <= "' . (int) $ToWeight . '" ';
        } else {
            $selectWeight = ' weight <= "' . (int) $ToWeight . '" and weight >= "' . (int) $FromWeight . '" ';
        }
        return $selectWeight;
    }

    public function selectAll()
    {
        $ProductNumber = $this->numberProduct();
        $feature = $this->feature();
        $Store = $this->store();
        $checkattri = $this->attribute();
        $visibility = $this->visibility();
        $Status = $this->status();
        $Manufacturer = $this->selectManufactor();
        $Supplie = $this->selectSupplie();
        $Category = $this->selectCategory();
        $Money = $this->checkmoney();
        $Quantity = $this->selectQuantity();
        $DateCreate = $this->checkDateCreate();
        $DateUpdate = $this->checkDateUpdate();
        $Width = $this->checkWidth();
        $Height = $this->checkHeight();
        $Depth = $this->checkDepth();
        $Weight = $this->checkWeight();
        $Array = array($feature, $ProductNumber, $Store, $checkattri, $visibility,
            $Status, $Manufacturer, $Supplie, $Category, $Money, $Quantity, $DateCreate, $DateUpdate, $Width,
            $Height, $Depth, $Weight);
        foreach ($Array as $key => $value) {
            $value;
            if ($Array[$key] == "") {
                unset($Array[$key]);
            }
        }
        $Str = implode(' and ', $Array);
        $dbSQL = Db::getInstance(_PS_USE_SQL_SLAVE_);
        $sql = ' Select * from ' . _DB_PREFIX_ . 'product where ' . $Str . '';
        $All = $dbSQL->ExecuteS($sql);
        return $All;
    }

    ///////////
    public function getAttribute($id_product)
    {
        $dbSQL = Db::getInstance(_PS_USE_SQL_SLAVE_);
        $sql = 'select * from ' . _DB_PREFIX_ . 'product_attribute where id_product = "' . (int) $id_product . '"';
        $RunSQL = $dbSQL->ExecuteS($sql);
        return $RunSQL;
    }

    // chuy?n ngày tháng sang d?ng yy/mm/dd
    public function myformatdate()
    {
        $id_lang = $this->context->language->id;
        $lang = new language($id_lang);
        $dateformat = $lang->date_format_lite;
        if (strpos($dateformat, "Y") >= 0) {
            $dateformat = str_replace("Y", "yy", $dateformat);
        }
        if (strpos($dateformat, "m") >= 0 && strpos($dateformat, "mm") === false) {
            $dateformat = str_replace("m", "mm", $dateformat);
        }
        if (strpos($dateformat, "d") >= 0 && strpos($dateformat, "dd") === false) {
            $dateformat = str_replace("d", "dd", $dateformat);
        }
        if (strpos($dateformat, "y") >= 0 && strpos($dateformat, "yy") === false) {
            $dateformat = str_replace("y", "yy", $dateformat);
        }
        $html = $dateformat;
        return $html;
    }
// format ngày tháng theo ngôn ng?
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
            if ($key == "H" || $key == "h") {
                $dateFormatArr[3] = $valueTmp;
            } elseif ($key == "I" || $key == "i") {
                $dateFormatArr[4] = $valueTmp;
            }
        }
        ksort($dateFormatArr);
        $numberSecondDate = strtotime(implode("/", $dateFormatArr));

        if ($numberSecondDate == false) {
            return date("Y-m-d h:i");
        }
        return implode("-", $dateFormatArr);
    }

    ///////////////
    public function filterData(&$str)
    {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if (strstr($str, '"')) {
            $str = '"' . str_replace('"', '""', $str) . '"';
        }
    }
    public $getlistArr1;
    ////// hàm lấy tùy chọn
    public function settingall()
    {
        $id_lang = $this->context->language->id;

        $getlist = Configuration::get('settingsql');
        $getlistArr = Tools::jsonDecode($getlist, true);
        $this->getlistArr1 = $getlistArr;
        $ValAll = array();
        $Cur = Currency::getCurrencies();

        $csrs = array();
        $checkall = $this->selectAll();
        $id_lang = $this->context->language->id;

        $feature = Feature::getFeatures($id_lang, true);
        ////// vòng lặp lấy tất cả product
        foreach ($checkall as $key => $value) {
            $product = new Product($checkall[$key]['id_product'], false, $id_lang);
            $combinations = $product->getAttributeCombinations($id_lang);

            $product1 = new Product($checkall[$key]['id_product'], $id_lang);
            $Manufacturer = new Manufacturer($product->id_manufacturer);
            $Supplie = new Supplier($product->id_supplier);
            $getTagArr = Tag::getProductTags($checkall[$key]['id_product']);
            ///get image
            $image = new Image();
            $cover = $image->getImages($id_lang, $checkall[$key]['id_product']);
            $link = new Link();
            $getLinkImagePr = array();
            foreach ($cover as $keyimg => $valueim) {
                $valueim;
                $id_image = $cover[$keyimg]['id_image'];
                $idpd = $checkall[$key]['id_product'];
                $getLinkImagePr[] = 'http://' . $link->getImageLink($product->link_rewrite, $idpd . '-' . $id_image);
            }
            $Result = array();
            $StrgetLinkImagePr = implode(',', $getLinkImagePr);


            $Language = Language::getLanguages(true, false);
            $id_language = array();
            foreach ($Language as $key3 => $value2) {
                $value2;
                $id_language[] = $Language[$key3]['id_lang'];
            }
            $productfor = array();
            foreach ($id_language as $key4 => $value4) {
                $value4;
                $productfor[] = new Product($checkall[$key]['id_product'], false, $id_language[$key4]);
            }
            foreach ($productfor as $key5 => $value5) {
                $value5;
                $Result['name ' . $Language[$key5]['name']] = $productfor[$key5]->name;
                $Result['description_short ' . $Language[$key5]['name']] = $productfor[$key5]->description_short;
                $Result['description ' . $Language[$key5]['name']] = $productfor[$key5]->description;
                $Result['meta_title ' . $Language[$key5]['name']] = $productfor[$key5]->meta_title;
                $Result['meta_description ' . $Language[$key5]['name']] = $productfor[$key5]->meta_description;
            }


            $RunsqlFeature = array();
            //////// feature
            foreach ($feature as $k3 => $v2) {
                $v2;
                $IdFeature = $feature[$k3]['id_feature'];
                $dbsql = Db::getInstance(_PS_USE_SQL_SLAVE_);
                $sqlfeature = 'SELECT ' . _DB_PREFIX_ . 'feature_value_lang.value 
                                from ' . _DB_PREFIX_ . 'feature_value_lang 
                                INNER JOIN ' . _DB_PREFIX_ . 'feature_product on 
                                ' . _DB_PREFIX_ . 'feature_product.id_feature_value
                                = ' . _DB_PREFIX_ . 'feature_value_lang.id_feature_value 
                                where 
                                id_lang ="' . (int) $id_lang . '" and 
                                id_product = "' . (int) $checkall[$key]['id_product'] . '"
                                and id_feature in (' . (int) $IdFeature . ') ';

                $RunsqlFeature[] = $dbsql->ExecuteS($sqlfeature);
                if (!empty($RunsqlFeature[$k3])) {
                    $Result['features_' . $feature[$k3]['name']] = $RunsqlFeature[$k3][0]['value'];
                }
            }

            ////Tag
            if ($getTagArr != false) {
                foreach ($getTagArr as $keyTag => $valuetag) {
                    $valuetag;
                    $StrgetTagArr = implode(',', $getTagArr[$keyTag]);
                    $Result['tag'] = $StrgetTagArr;
                }
            }
            
            $Result['product_link'] = $product->getLink();
            $Result['id_product'] = $checkall[$key]['id_product'];
            $Result['id_supplier'] = $product->id_supplier;
            $Result['supplier_name'] = $Supplie->name;
            $Result['id_manufacturer'] = $product->id_manufacturer;
            $Result['manufacturer_name'] = $Manufacturer->name;
            $Result['reference'] = $product->reference;// get tax
            $Result['tax_id'] = $product->id_tax_rules_group;
            $address = $this->context->shop->getAddress();
            $tax_manager = TaxManagerFactory::getManager($address, $product->id_tax_rules_group);
            $product_tax_calculator = $tax_manager->getTaxCalculator();
            $tax_rate = $product_tax_calculator->getTotalRate();
            $Result['tax_rate'] = $tax_rate;
            
            /////////////////////
            $Result['ean13'] = $product->ean13;
            $Result['upc'] = $product->upc;
            $Result['visibility'] = $product->visibility;
            $valCurr = $getlistArr['id_currency'];
            //var_dump($valCurr);die;
            // Supplier field
            // Get all available suppliers
            $suppliers = Supplier::getSuppliers();
            $AllSupplier = ProductSupplier::getSupplierCollection($checkall[$key]['id_product'], true);
            if (!empty($AllSupplier)) {
                $SupplierSelected = array();
                foreach ($AllSupplier as $item) {
                    $SupplierSelected[] = $item->id_supplier;
                }
                $id_supplier_all = array();
                $supplier_name_all = array();
                foreach ($suppliers as $item) {
                    if (in_array($item['id_supplier'], $SupplierSelected)) {
                        $id_supplier_all[] = $item['id_supplier'];
                        $supplier_name_all[] = $item['name'];
                    }
                }
                $Result['id_supplier_all'] = implode(',', $id_supplier_all);
                $Result['supplier_name_all'] = implode(',', $supplier_name_all);
            } else {
                $Result['id_supplier_all'] = '';
                $Result['supplier_name_all'] = '';
            }
            
            //echo '<pre>';var_dump($Result);die;
            $Result['wholesale_price'] = $this->displayPrice($product->wholesale_price, $Cur[$valCurr]);
            //$CurrPrice = Tools::convertPrice($product->price, $Cur[$valCurr]);
            $Result['price'] = $this->displayPrice($product->price, $Cur[$valCurr]);
            $priceIncl = (1+$tax_rate/100)*$product->price;
            $Result['price_incl'] = $this->displayPrice($priceIncl, $Cur[$valCurr]);
            $Result['unity'] = $product->unity;
            //$CurrPriceRatio = Tools::convertPrice($product->unit_price_ratio, $Cur[$valCurr]);
            $Result['unit_price_ratio'] = $this->displayPrice($product->unit_price_ratio, $Cur[$valCurr]);
            $Result['meta_title'] = $product->meta_title;
            // get main category ID
            $Result['category_id'] = $product->id_category_default;
            // get Associated categories
            foreach ($Language as $l) {
                $categories = Product::getProductCategoriesFull($checkall[$key]['id_product'], $l['id_lang']);
                $tmp_cate = array();
                $tmp_cate_ids = array();
                foreach ($categories as $c) {
                    $tmp_cate[] =  $c['name'];
                    $tmp_cate_ids[] =  $c['id_category'];
                }
                $Result['accessories_categories_'.$l['id_lang']] = implode(",", $tmp_cate);
                $Result['accessories_categories_ids'] = implode(",", $tmp_cate_ids);
                // add main category name
                $ce = new Category($product->id_category_default, $l['id_lang']);
                $Result['category_'.$l['id_lang']] = $ce->name;
            }
            //// Accessories
            foreach ($Language as $l) {
                $accessories = Product::getAccessoriesLight($l['id_lang'], $checkall[$key]['id_product']);
                if (empty($accessories)) {
                    continue;
                }
                $tmp_accessories = array();
                $tmp_accessories_ids = array();
                $tmp_accessories_ref = array();
                foreach ($accessories as $a) {
                    $tmp_accessories[] =  $a['name'];
                    $tmp_accessories_ids[] =  $a['id_product'];
                    $tmp_accessories_ref[] =  $a['reference'];
                }
                $Result['accessories_'.$l['id_lang']] = implode(",", $tmp_accessories);
                $Result['accessories_id'] = implode(",", $tmp_accessories_ids);
                $Result['accessories_reference'] = implode(",", $tmp_accessories_ref);
                //echo '<pre>';print_r($accessories);die;
            }
            //echo '<pre>';var_dump($product);die;
            $Result['meta_description'] = $product->meta_description;
            $Result['link_rewrite'] = $product->link_rewrite;
            $Result['quantity'] = $product1->quantity;
            $Result['width'] = $product->width;
            $Result['height'] = $product->height;
            $Result['depth'] = $product->depth;
            $Result['weight'] = $product->weight;
            $ship_cost = $product->additional_shipping_cost;
            $Result['additional_shipping_cost'] = $this->displayPrice($ship_cost, $Cur[$valCurr]);
            $Result['condition'] = $product->condition;
            $Result['uploadable_files'] = $product->uploadable_files;
            $Result['text_fields'] = $product->text_fields;
            $Result['active'] = $product->active;

            if ($Result['active'] == 1) {
                $Result['active'] = $this->l('yes');
            } else {
                $Result['active'] = $this->l('no');
            }
            $Result['image_link'] = $StrgetLinkImagePr;
            ///////// mảng lấy combination
            
            if (!empty($combinations)) {
                $comb_array = array();
                foreach ($combinations as $combinati) {
                    $comb_array[$combinati['id_product_attribute']]['attributes'][] =
                    array($combinati['group_name'], $combinati['attribute_name']);
                    $comb_array[$combinati['id_product_attribute']]['wholesale_price']=$combinati['wholesale_price'];
                    $id_attr = $combinati['id_product_attribute'];
                    $id_pro = $combinati['id_product'];
                    $com_price = Product::getPriceStatic($id_pro, true, $id_attr);
                    $comb_array[$combinati['id_product_attribute']]['price']= $com_price;
                    $comb_array[$combinati['id_product_attribute']]['weight'] =
                    $combinati['weight'] . Configuration::get('PS_WEIGHT_UNIT');
                    $comb_array[$combinati['id_product_attribute']]['unit_impact']=$combinati['unit_price_impact'];
                    $comb_array[$combinati['id_product_attribute']]['reference'] = $combinati['reference'];
                    $comb_array[$combinati['id_product_attribute']]['ean13'] = $combinati['ean13'];
                    $comb_array[$combinati['id_product_attribute']]['upc'] = $combinati['upc'];
                    $comb_array[$combinati['id_product_attribute']]['available_date'] =
                    strftime($combinati['available_date']);
                    $comb_array[$combinati['id_product_attribute']]['default_on'] = $combinati['default_on'];
                    $dbsql = Db::getInstance(_PS_USE_SQL_SLAVE_);
                    $ps_product_attribute_image = ' SELECT id_image FROM ' . _DB_PREFIX_ . 'product_attribute_image 
                    WHERE id_product_attribute=' . (int) $combinati['id_product_attribute'] . '';
                    $product_attribute_image = $dbsql->ExecuteS($ps_product_attribute_image);
                    $imageanh = array();
                    foreach ($product_attribute_image as $key6 => $value6) {
                        $value6;
                        $rewrite = $product->link_rewrite;
                        $id_img = $product_attribute_image[$key6]['id_image'];
                        $imageanh[$key6] = '' . Tools::getShopProtocol() . '' .
                        $link->getImageLink($rewrite, '1' . '-' . $id_img);
                    }
                    $comb_array[$combinati['id_product_attribute']]['id_image'] = $imageanh;
                    $comb_array[$combinati['id_product_attribute']]['id_attribute'] =
                    $combinati['id_product_attribute'];
                }
            }
            //echo '<pre>';print_r($comb_array);die;

            $wholesalePrice = array();
            $price = array();
            $weight = array();
            $unit_impact = array();
            $reference = array();
            $ean = array();
            $upc = array();
            $variDate = array();
            $Defalut = array();
            $image = array();
            if ($getlistArr['combination'] == 1) {
                ///////////////// mỗi combination 1 dòng
                if ($getlistArr['combination_line'] == 1) {
                    if (!empty($combinations)) {
                        foreach ($comb_array as $k1 => $value1) {
                            $countArr = count($comb_array[$k1]['attributes']);
                            $stt = array();
                            for ($c = 0; $c < $countArr; $c++) {
                                $stt[] = $c;
                            }

                            $ArrAllAttri = array();
                            foreach ($stt as $kstt => $vstt) {
                                $vstt;
                                $valueComb = $comb_array[$k1]['attributes'][$stt[$kstt]];
                                $ArrAllAttri[] = implode(':', $valueComb);
                            }
                            $StrAllAttri = implode(',', $ArrAllAttri);
                            $nameAttr = array();
                            $ValueAttr = array();
                            foreach ($comb_array[$k1]['attributes'] as $k2 => $value2) {
                                $nameAttr[] = $comb_array[$k1]['attributes'][$k2][0];
                                $ValueAttr[] = $comb_array[$k1]['attributes'][$k2][1];
                            }


                            foreach ($nameAttr as $k3 => $value3) {
                                $value3;
                                $Result['combination_Attribute_' . $nameAttr[$k3]] = $ValueAttr[$k3];
                            }


                            $Result['combination_Attribute_value_pair'] = $StrAllAttri;
                            $w_price = $this->displayPrice($comb_array[$k1]['wholesale_price'], $Cur[$valCurr]);
                            $Result['Combination_wholesale_price'] = $w_price;
                            $Result['combination_weight'] = $comb_array[$k1]['weight'];
                            $impact = $this->displayPrice($comb_array[$k1]['unit_impact'], $Cur[$valCurr]);
                            $Result['combination_unit_impact'] = $impact;
                            $Result['combination_reference'] = $comb_array[$k1]['reference'];
                            $Result['combination_ean13'] = $comb_array[$k1]['ean13'];
                            $Result['combination_upc'] = $comb_array[$k1]['upc'];
                            $Result['combination_available_date'] = $comb_array[$k1]['available_date'];
                            $Result['combination_default_on'] = $comb_array[$k1]['default_on'];

                            $Combination_image = implode(',', $comb_array[$k1]['id_image']);
                            $Result['combination_Image'] = $Combination_image;
                            if ($Result['combination_default_on'] == 1) {
                                $Result['combination_default_on'] = 'yes';
                            } else {
                                $Result['combination_default_on'] = 'no';
                            }
                            $csrs[] = $Result;
                        }
                    } else {
                        $csrs[] = $Result;
                    }
                }
                ////////các combination chung 1 dòng
                if ($getlistArr['combination_line'] != 1) {
                    if (!empty($combinations)) {
                        $NameAttrGr = array();
                        $str = array();
                        
                        foreach ($comb_array as $k1 => $v1) {
                            $v1;
                            $arr1 = array();
                            foreach ($comb_array[$k1]['attributes'] as $k22 => $v22) {
                                $v22;
                                $valAttri = $comb_array[$k1]['attributes'][$k22][1];
                                $arr1[] = $comb_array[$k1]['attributes'][$k22][0] . ':' . $valAttri;
                            }
                            $StrValuePair = implode(',', $arr1);

                            $Result['combination_Attribute_value_pair'][] = $StrValuePair;

                            implode(';', $Result['combination_Attribute_value_pair']);
                            $p = $comb_array[$k1]['wholesale_price'];
                            $wholesalePrice[] = $this->displayPrice($p, $Cur[$valCurr]);
                            $StrwholesalePrice = implode(',', $wholesalePrice);
                            $Result['Combination_wholesale_price'] = $StrwholesalePrice;

                            $price[] = $comb_array[$k1]['price'];
                            $StrPrice = implode(',', $price);
                            $Result['combination_price'] = $StrPrice;
                            $weight[] = $comb_array[$k1]['weight'];
                            $StrWeight = implode(',', $weight);
                            $Result['combination_weight'] = $StrWeight;
                            //var_dump($comb_array[$k1]['unit_impact']);
                            if (!empty($comb_array[$k1]['unit_impact'])) {
                                $unit_impact[] = $this->displayPrice($comb_array[$k1]['unit_impact'], $Cur[$valCurr]);
                                $Strunit = implode(',', $unit_impact);
                                $Result['combination_unit_impact'] = $Strunit;
                            }
                            $reference[] = $comb_array[$k1]['reference'];
                            foreach ($reference as $k11 => $value11) {
                                $value11;
                                if ($reference[$k11] == "") {
                                    unset($reference[$k11]);
                                }
                            }
                            $StrReference = implode(',', $reference);
                            $Result['combination_reference'] = $StrReference;

                            $ean[] = $comb_array[$k1]['ean13'];
                            foreach ($ean as $k12 => $value11) {
                                if ($ean[$k12] == "") {
                                    unset($ean[$k12]);
                                }
                            }
                            $Strean = implode(',', $ean);
                            $Result['combination_ean13'] = $Strean;

                            $upc[] = $comb_array[$k1]['upc'];
                            foreach ($upc as $k13 => $value11) {
                                if ($upc[$k13] == "") {
                                    unset($upc[$k13]);
                                }
                            }
                            $Strupc = implode(',', $upc);
                            $Result['combination_upc'] = $Strupc;

                            $variDate[] = $comb_array[$k1]['available_date'];
                            $StrDate = implode(',', $variDate);
                            $Result['combination_available_date'] = $StrDate;

                            $Defalut[] = $comb_array[$k1]['default_on'];
                            $Strdefault = implode(',', $Defalut);
                            $Result['combination_default_on'] = $Strdefault;
                            if ($Result['combination_default_on'] == 1) {
                                $Result['combination_default_on'] = 'yes';
                            } else {
                                $Result['combination_default_on'] = 'no';
                            }

                            $image[] = $Combination_image = implode(',', $comb_array[$k1]['id_image']);
                            foreach ($image as $k14 => $value11) {
                                if ($image[$k14] == "") {
                                    unset($image[$k14]);
                                }
                            }
                            $StrImage = implode(',', $image);
                            $Result['combination_Image'] = $StrImage;
                            $getNameAttributeGr = AttributeGroup::getAttributesGroups($id_lang);
                            $i = array();
                            $nameAttr = array();
                            $ValueAttr = array();

                            foreach ($comb_array[$k1]['attributes'] as $k2 => $value2) {
                                $nameAttr[] = $comb_array[$k1]['attributes'][$k2][0];
                                $ValueAttr[] = $comb_array[$k1]['attributes'][$k2][1];
                            }
                            foreach ($getNameAttributeGr as $k3 => $value3) {
                                $i[] = $getNameAttributeGr[$k3]['name'];
                                foreach ($nameAttr as $k4 => $value4) {
                                    if ($nameAttr[$k4] == $getNameAttributeGr[$k3]['name']) {
                                        $NameAttrGr[$getNameAttributeGr[$k3]['name']][] = $ValueAttr[$k4];
                                    }
                                }
                            }
                        }
                        //echo '<pre>';print_r($NameAttrGr);die;
                        foreach ($getNameAttributeGr as $k5 => $value5) {
                            if (!empty($NameAttrGr[$getNameAttributeGr[$k5]['name']])) {
                                for ($i = 0; $i < count($NameAttrGr[$getNameAttributeGr[$k5]['name']]); $i++) {
                                    for ($j = $i + 1; $j < count($NameAttrGr[$getNameAttributeGr[$k5]['name']]); $j++) {
                                        $bienJ = $NameAttrGr[$getNameAttributeGr[$k5]['name']][$j];
                                        if ($NameAttrGr[$getNameAttributeGr[$k5]['name']][$i] == $bienJ) {
                                            $NameAttrGr[$getNameAttributeGr[$k5]['name']][$j] = "";
                                        }
                                    }
                                }
                                foreach ($NameAttrGr[$getNameAttributeGr[$k5]['name']] as $k8 => $value8) {
                                    $value8;
                                    if ($NameAttrGr[$getNameAttributeGr[$k5]['name']][$k8] == "") {
                                        unset($NameAttrGr[$getNameAttributeGr[$k5]['name']][$k8]);
                                    }
                                }

                                $str[] = implode(',', $NameAttrGr[$getNameAttributeGr[$k5]['name']]);
                                foreach ($str as $k6 => $value6) {
                                    $value6;
                                    $Result['combination_Attribute_' . $getNameAttributeGr[$k5]['name']] = $str[$k6];
                                }
                            }
                        }
                        // end combination
                        $AttrivalInResult = $Result['combination_Attribute_value_pair'];
                        $Result['combination_Attribute_value_pair'] = implode(';', $AttrivalInResult);
                        $csrs[] = $Result;
                    } else {
                        $csrs[] = $Result;
                    }
                }
            } else {
                $csrs[] = $Result;
            }
        }

        //// sắp xếp theo thuộc tính chọn
        $sort = array();
        if ($getlistArr['SortBy'] == 'ASC') {
            $asc = $getlistArr['namesort'];
            for ($i = 0; $i < count($csrs) - 1; $i++) {
                for ($j = $i + 1; $j < count($csrs); $j++) {
                    if ($csrs[$i][$asc] > $csrs[$j][$asc]) {
                        $tmp = $csrs[$j];
                        $csrs[$j] = $csrs[$i];
                        $csrs[$i] = $tmp;
                    }
                }
            }

            for ($i = 0; $i < count($csrs); $i++) {
                $sort[] = $csrs[$i];
            }
        }
        if ($getlistArr['SortBy'] == 'DESC') {
            $asc = $getlistArr['namesort'];
            for ($i = 0; $i < count($csrs) - 1; $i++) {
                for ($j = $i + 1; $j < count($csrs); $j++) {
                    if ($csrs[$i][$asc] < $csrs[$j][$asc]) {
                        $tmp = $csrs[$j];
                        $csrs[$j] = $csrs[$i];
                        $csrs[$i] = $tmp;
                    }
                }
            }
            for ($i = 0; $i < count($csrs); $i++) {
                $sort[] = $csrs[$i];
            }
        }
        ///////// hoàn thành mảng in ra file csv
        $hide = $getlistArr['select_feild'];
        $changeArray = explode(",", $hide);
        $Arrfirst = array();
        foreach ($changeArray as $key => $value) {
            $Arrfirst[] = str_replace(strstr($changeArray[$key], '-'), '', $changeArray[$key]);
            if ($Arrfirst[$key] == "") {
                unset($Arrfirst[$key]);
            }
        }

        $ArrSecond = array();
        foreach ($changeArray as $key => $value) {
            if ($changeArray[$key] == "") {
                unset($changeArray[$key]);
            }
            // $ArrSecond[] = str_replace("-", "", strstr($value, '-'));
            if ((bool) strstr($value, 'combination_')) {
                $ArrSecond[] = strstr($value, 'combination_');
            } else {
                $ArrSecond[] = str_replace("-", "", strstr($value, '-'));
            }
            if ($ArrSecond[$key] == "") {
                unset($ArrSecond[$key]);
            }
        }


        $ResultArr = array();
        foreach ($sort as $key2 => $value2) {
            $value1;
            $ResultArr = array();
            foreach ($ArrSecond as $key => $value) {
                if (!empty($sort[$key2][$ArrSecond[$key]])) {
                    $ResultArr[] = $sort[$key2][$ArrSecond[$key]];
                } else {
                    $ResultArr[] = "";
                }
            }
            $ValAll[] = $ResultArr;
        }
        // encoding data
        if ($getlistArr['encoding'] == 'ansi' && $getlistArr['format_file'] == 'csv') {
            if (!empty($ValAll)) {
                foreach ($ValAll as $key => &$v) {
                    foreach ($v as &$v1) {
                        $v1 = mb_convert_encoding($v1, 'UTF-16LE', 'UTF-8');
                    }
                }
            }
        }
        //echo '<pre>';print_r($ValAll);die;
        return $ValAll;
    }
    public function headerSetting()
    {
        $getlist = Configuration::get('settingsql');
        $getlistArr = Tools::jsonDecode($getlist, true);
        $hide = $getlistArr['select_feild'];
        $changeArray = explode(",", $hide);
        $Arrfirst = array();
        if (!empty($changeArray)) {
            foreach ($changeArray as $key => $value) {
                $value;
                $Arrfirst[] = str_replace(strstr($changeArray[$key], '-'), '', $changeArray[$key]);
                if ($Arrfirst[$key] == "") {
                    unset($Arrfirst[$key]);
                }
            }
        }
        
        return $Arrfirst;
    }
    public function settingProduct()
    {
        $URL = _PS_BASE_URL_ . __PS_BASE_URI__;
        $task = urlencode($URL . 'modules/baexportproduct/autoexport.php'.'?token='.md5(_COOKIE_KEY_));
        $nameModule = $this->name;
        $ValSetting = $_POST;
        $ArrayValSetting = Tools::jsonEncode($ValSetting);
        Configuration::updateValue('CONFIGN_CRONJOB', $ArrayValSetting);


        $sqlIdCron = 'SELECT id_cronjob FROM ' . _DB_PREFIX_ . 'cronjobs WHERE task = "' . pSQL($task) . '" ';
        $id_cronjob = Db::getInstance()->getValue($sqlIdCron);

        $id_shop = (int) Context::getContext()->shop->id;
        $id_shop_group = (int) Context::getContext()->shop->id_shop_group;
        $dbSQL = Db::getInstance(_PS_USE_SQL_SLAVE_);
        $sql = 'Replace into ' . _DB_PREFIX_ . 'cronjobs
            (`id_cronjob`,`description`,`task`,`hour`, `day`, `month`, `day_of_week`,`active`,
            `id_shop`, `id_shop_group`) Values
            ("' . (int) $id_cronjob . '","' . pSQL($nameModule) . '","' . pSQL($task) . '",
            ' . (int) $ValSetting['hour'] . ',' .
            (int) $ValSetting['dayofmonth'] . ',' . (int) $ValSetting['month'] . ',
            ' . (int) $ValSetting['dayofweek'] . ',true,' .
            (int) $id_shop . ',' . (int) $id_shop_group . ')';
        $dbSQL->query($sql);
    }

    public function warning()
    {
        $html = '';
        if (Tools::isSubmit("submit_cronjob")) {
            Configuration::updateValue('submit_cronjob', '1');
        }
        if (Configuration::get('submit_cronjob') != 1) {
            $html .= $this->display(__FILE__, 'views/templates/admin/warning.tpl');
        }
        return $html;
    }
    public function displayPrice($price, $currency)
    {
        $currency = new Currency($currency['id_currency']);
        $price = Tools::displayPrice($price, $currency);
        //echo '<pre>';var_dump($this->getlistArr1);die;
        if ($currency->sign == '$') {
            // gia dollar thi return luon
            return $price;
        }
        if ($this->getlistArr1['encoding'] == 'ansi' && $this->getlistArr1['format_file'] == 'csv') {
            $price = str_replace($currency->sign, $currency->iso_code, $price);
            return $price;
        }
        if ($this->getlistArr1['format_file'] == 'csv') {
            // is UTF-8 in csv
            $price = str_replace('€', chr(128), $price);
            $price = str_replace('¢', chr(162), $price);
            $price = str_replace('£', chr(163), $price);
            $price = str_replace('¤', chr(164), $price);
            $price = str_replace('¥', chr(165), $price);
        }
        return $price;
    }
}
