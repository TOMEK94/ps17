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

class BaexportproductproductcontrModuleFrontController extends ModuleFrontController
{
    public function initContent()
    {
        parent::init();
        parent::initHeader();
        parent::initContent();
        $token = Tools::getValue('token');
        $getlist = Configuration::get('settingsql');
        $getlistArr = Tools::jsonDecode($getlist, true);
        if ($token == md5(_COOKIE_KEY_)) {
            $file_ext = '.csv';
            if ($getlistArr['format_file'] == 'csv') {
                $file_ext = '.csv';
            } elseif ($getlistArr['format_file'] == 'xls') {
                $file_ext = '.xls';
            } elseif ($getlistArr['format_file'] == 'xlsx') {
                $file_ext = '.xlsx';
            }
            $fileName = _PS_MODULE_DIR_ . 'baexportproduct' . "/file_csv/product".$file_ext;
            if (file_exists($fileName)) {
                // Maximum size of chunks (in bytes).
                $maxRead = 30 * 1024 * 1024; // 30MB

                $fh = fopen($fileName, 'r');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="ExportProducts' . $file_ext . '"');
                while (!feof($fh)) {
                    // Read and output the next chunk.
                    echo fread($fh, $maxRead);
                    // Flush the output buffer to free memory.
                    ob_flush();
                }
            } else {
                echo 'File not found.';
            }
            exit();
        } else {
            $this->setTemplate('error.tpl');
        }
    }
}
