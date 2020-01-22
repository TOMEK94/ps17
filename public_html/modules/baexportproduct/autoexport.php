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
*  @copyright 2007-2016 PrestaShop SA
*  @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
* @since 1.6
*/

include_once('../../config/config.inc.php');
include_once('../../init.php');
require_once("baexportproduct.php");
if (Tools::getValue('token')== md5(_COOKIE_KEY_)) {
    $getlist = Configuration::get('settingsql');
    $getlistArr = Tools::jsonDecode($getlist, true);
    $product = new baExportProduct();
    $rows = $product->settingall();
    
    $header = $product->headerSetting();
    //echo '<pre>';print_r($header);
    //echo '<pre>';print_r($rows);
    //die;
    $strall = array();
    if ($getlistArr['format_file'] == 'csv') {
        if ($getlistArr['character'] == "t") {
            foreach ($rows as $key4 => $value4) {
                $strall[] = implode(';', $value4);
            }
            $valal = array($header);
            foreach ($strall as $chan) {
                $valal[] = explode(';', $chan);
            }
            $arraay = array();
            $file = fopen(_PS_MODULE_DIR_ . 'baexportproduct' . "/file_csv/product.csv", "w");
            foreach ($valal as $line) {
                fputcsv($file, $line, chr(9));
            }
            fclose($file);
        } else {
            foreach ($rows as $key4 => $value4) {
                $strall[] = implode(';', $value4);
            }
            $valal = array($header);
            foreach ($strall as $chan) {
                $valal[] = explode(';', $chan);
            }
            $arraay = array();
            $file = fopen(_PS_MODULE_DIR_ . 'baexportproduct' . "/file_csv/product.csv", "w");
            foreach ($valal as $line) {
                fputcsv($file, $line, $getlistArr['character']);
            }
            fclose($file);
        }
        exit;
    } elseif ($getlistArr['format_file'] == 'xls') {
        $fileName = _PS_MODULE_DIR_ . 'baexportproduct' . "/file_csv/product.xls";
        require_once(dirname(__FILE__).'/libs/PHPExcel.php');
        $xls = new PHPExcel();
        $xls->getProperties()->setCreator($product->author);
        $xls->getProperties()->setLastModifiedBy($product->author);
        $xls->getProperties()->setTitle($product->name);
        $xls->setActiveSheetIndex(0);
        $xls->getActiveSheet()->setTitle("Products");
        // echo '<pre>';print_r($Arrfirst);die;
        foreach ($header as $k => $v) {
            $xls->getActiveSheet()->setCellValueByColumnAndRow($k, 1, $v);
        }
        $row_index = 2;
        foreach ($rows as $row) {
            $col_index = 0;
            foreach ($row as $key => $value) {
                $xls->getActiveSheet()->setCellValueByColumnAndRow($col_index, $row_index, $value);
                $col_index++;
            }
            $row_index++;
        }
        
        $xls->setActiveSheetIndex(0);
        $xls = PHPExcel_IOFactory::createWriter($xls, 'Excel5');
        $xls->save($fileName);
        exit;
    } elseif ($getlistArr['format_file'] == 'xlsx') {
        $fileName = _PS_MODULE_DIR_ . 'baexportproduct' . "/file_csv/product.xlsx";
        require_once(dirname(__FILE__).'/libs/PHPExcel.php');
        $xls = new PHPExcel();
        $xls->getProperties()->setCreator($product->author);
        $xls->getProperties()->setLastModifiedBy($product->author);
        $xls->getProperties()->setTitle($product->name);
        $xls->setActiveSheetIndex(0);
        $xls->getActiveSheet()->setTitle("Products");
        // echo '<pre>';print_r($Arrfirst);die;
        foreach ($header as $k => $v) {
            $xls->getActiveSheet()->setCellValueByColumnAndRow($k, 1, $v);
        }
        $row_index = 2;
        foreach ($rows as $row) {
            $col_index = 0;
            foreach ($row as $key => $value) {
                $xls->getActiveSheet()->setCellValueByColumnAndRow($col_index, $row_index, $value);
                $col_index++;
            }
            $row_index++;
        }
        
        $xls->setActiveSheetIndex(0);
        //////////////////////
        $xls = PHPExcel_IOFactory::createWriter($xls, 'Excel2007');
        $xls->save($fileName);
        exit;
    }
} else {
    die();
}
