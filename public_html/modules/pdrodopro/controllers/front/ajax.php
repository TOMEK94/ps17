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

class pdrodoproAjaxModuleFrontController extends ModuleFrontController
{

    /** @var pdrodopro */
    private $pdrodopro;

    public function postProcess()
    {
        $this->pdrodopro = new pdrodopro();
    }

    public function initContent()
    {
        parent::initContent();
        $this->ajax = true;
    }

    public function displayAjax()
    {
        $typeRequest = Tools::getValue('typerequest');
        $typeField = Tools::getValue('typefield');

        if ($typeRequest=='accountform') {
            $isset = $this->pdrodopro->checkIssetItem($typeRequest, $this->context->customer->id, $this->context->cart->id, $typeField);
            if (!$isset) {
                $this->pdrodopro->insertDatabase($typeRequest, $this->context->cart->id, $this->context->customer->id, $typeField);
                echo json_encode('accountform_inserted');
                exit;
            } else {
                $this->pdrodopro->updateDatabase($typeRequest, $this->context->cart->id, $this->context->customer->id, $typeField, $isset['0']['id']);
                echo json_encode('accountform_updated');
                exit;
            }

            echo json_encode('error_accountform');
            exit;
        } elseif ($typeRequest=='getdatabyuser') {
            $data = $this->pdrodopro->getDataByUser($this->context->customer->id);
            echo json_encode($data);
            exit;
        } elseif ($typeRequest=='getdatabycart') {
            $data = $this->pdrodopro->getDataByCart($this->context->cart->id);
            echo json_encode($data);
            exit;
        }

        echo json_encode('error');
        exit;
    }
}
