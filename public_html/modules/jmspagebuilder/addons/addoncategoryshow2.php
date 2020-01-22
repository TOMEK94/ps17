<?php
/**
* 2007-2018 PrestaShop
*
* Jms Page Builder
*
*  @author    Joommasters <joommasters@gmail.com>
*  @copyright 2007-2018 Joommasters
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: http://www.joommasters.com
*/

if (!defined('_PS_VERSION_')) {
    exit;
}
include_once(_PS_MODULE_DIR_.'jmspagebuilder/addons/addonbase.php');
include_once(_PS_MODULE_DIR_.'jmspagebuilder/classes/productHelper.php');
class JmsAddonCategoryShow2 extends JmsAddonBase
{
    public function __construct()
    {
        $this->addonname = 'categoryshow2';
        $this->modulename = 'jmspagebuilder';
        $this->addontitle = 'Category Show 2';
        $this->addondesc = 'Show Categories In Shop';
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();

    }
    public function getInputs()
    {
        $inputs = array(
            array(
                'type' => 'text',
                'name' => 'title',
                'label' => $this->l('Title'),
                'lang' => '1',
                'desc' => 'Enter text which will be used as addon title. Leave blank if no title is needed.',
                'default' => 'Our Products'
            ),
            array(
                'type' => 'categories',
                'name' => 'ctcategories',
                'label' => $this->l('Categories'),
                'lang' => '0',
                'desc' => 'Select Categories to Show',
                'default' => '',
                'usecheckbox' => '1'
            ),
            array(
                'type' => 'text',
                'name' => 'child_categories',
                'label' => $this->l('Number of Child '),
                'lang' => '0',
                'desc' => 'Number of child category you want to show, not set to show all',
                'default' => 5
            ),
            array(
                'type' => 'switch',
                'name' => 'show_img',
                'label' => $this->l('Show Image'),
                'lang' => '0',
                'desc' => 'Show/Hide Image of Parent Category',
                'default' => 1
            ),
            array(
                'type' => 'text',
                'name' => 'items_total',
                'label' => $this->l('Total Items'),
                'lang' => '0',
                'desc' => 'Total Number Items',
                'default' => 10
            ),
            array(
                'type' => 'text',
                'name' => 'rows',
                'label' => $this->l('Number of Rows'),
                'lang' => '0',
                'desc' => 'Number of Rows (Or Number of Product per Column)',
                'default' => 2
            ),
            array(
                'type' => 'text',
                'name' => 'cols',
                'label' => $this->l('Number of Columns'),
                'lang' => '0',
                'desc' => 'Number of Columns (Or Number of Product per Row) ( > 1199px )',
                'default' => 4
            ),
            array(
                'type' => 'text',
                'name' => 'cols_md',
                'label' => $this->l('Number of Columns On Medium Device'),
                'lang' => '0',
                'desc' => 'Number of Columns (Or Number of Product per Row) On Medium Device ( > 991px )',
                'default' => 3
            ),
            array(
                'type' => 'text',
                'name' => 'cols_sm',
                'label' => $this->l('Number of Columns On Tablet'),
                'lang' => '0',
                'desc' => 'Number of Columns (Or Number of Product per Row) On Tablet( >= 768px )',
                'default' => 2
            ),
            array(
                'type' => 'text',
                'name' => 'cols_xs',
                'label' => $this->l('Number of Columns On Mobile'),
                'lang' => '0',
                'desc' => 'Number of Columns (Or Number of Product per Row) On Mobile( >= 320px )',
                'default' => 2
            ),
            array(
                'type' => 'switch',
                'name' => 'navigation',
                'label' => $this->l('Show Navigation'),
                'lang' => '0',
                'desc' => 'Enanble/Disable Navigation',
                'default' => '1'
            ),
            array(
                'type' => 'switch',
                'name' => 'pagination',
                'label' => $this->l('Show Pagination'),
                'lang' => '0',
                'desc' => 'Enanble/Disable Pagination',
                'default' => '0'
            ),
            array(
                'type' => 'switch',
                'name' => 'autoplay',
                'label' => $this->l('Auto Play'),
                'lang' => '0',
                'desc' => 'Enanble/Disable Auto Play',
                'default' => '0'
            ),
            array(
                'type' => 'switch',
                'name' => 'rewind',
                'label' => $this->l('ReWind Navigation'),
                'lang' => '0',
                'desc' => 'Enanble/Disable ReWind Navigation',
                'default' => '1'
            ),
            array(
                'type' => 'switch',
                'name' => 'slidebypage',
                'label' => $this->l('slide By Page'),
                'lang' => '0',
                'desc' => 'Enanble/Disable Slide By Page',
                'default' => '0'
            ),
            array(
                'type' => 'text',
                'name' => 'overwrite_tpl',
                'label' => $this->l('Overwrite Tpl File'),
                'lang' => '0',
                'desc' => 'Use When you want overwrite template file'
            )
        );
        return $inputs;
    }
    public function returnValue($addon)
    {
        $id_lang = $this->context->language->id;
        if($addon->fields[1]->name != 'desc') {
            $show_img = $addon->fields[3]->value;
            $_categories = $addon->fields[1]->value;
            $filter_cat = $addon->fields[2]->value;
            
        } else {
            $show_img = $addon->fields[5]->value;
            $_categories = $addon->fields[2]->value;
            $filter_cat = $addon->fields[3]->value;         
        }           
        if (Tools::strlen($_categories) == 0) {
            return "Please select categories to show!";
        }
        $category_ids = explode(",", $_categories);
        $categories = array();
        $filter_cat = $addon->fields[2]->value;
        $img_cat_dir=$this->root_url.'/img/c/';
        $limit='';
        if($filter_cat != '')
            $limit='LIMIT 0,'.$filter_cat;
        $k = 0;
        $total_config = $addon->fields[4]->value;
        $rows = $addon->fields[5]->value;
        $cols = $addon->fields[6]->value;
        $fields = $addon->fields;
        foreach ($category_ids as $id_category) {
            $category = new Category($id_category, (int)Context::getContext()->language->id);
            $categories[$k]['id_category'] = $id_category;
            $categories[$k]['name'] = $category->name;
            $categories[$k]['link_rewrite'] = $category->link_rewrite;
            $categories[$k]['meta_description'] = $category->meta_description;
            $query = 'SELECT hss.name, hss.id_category, hss.link_rewrite
            FROM '._DB_PREFIX_.'category hs         
            LEFT JOIN '._DB_PREFIX_.'category_lang hss ON (hs.id_category = hss.id_category)
            WHERE hs.id_parent = '.$id_category.' AND hss.id_lang = '.(int)$id_lang.' ORDER BY `name` ASC '.$limit;
            $categories[$k]['cat_childs'] = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($query);
            if($id_category != 1)
            {
                $result_product_count = Db::getInstance()->ExecuteS('
                SELECT COUNT(ac.`id_product`) as totalProducts
                FROM `'._DB_PREFIX_.'category_product` ac
                LEFT JOIN `'._DB_PREFIX_.'product` p ON p.`id_product` = ac.`id_product`
                WHERE ac.`id_category` = '.$id_category.' AND p.`active` = 1');
                $categories[$k]['product_count'] = $result_product_count[0]['totalProducts'];
            }
            $k++;
        }
        $categories_arr = JmsProductHelper::sliceProducts($categories, $rows, $cols, $total_config);
        //print_r($categories_arr);exit;
        $addon_tpl_dir = $this->loadTplDir();
        $this->context->smarty->assign(
            array(
                'link'          => $this->context->link,
                'categories'    => $categories_arr,
                'addon_title'   => $addon->fields[0]->value->$id_lang,
                'show_img'      => $show_img,
                'img_cat_dir'   => $img_cat_dir,
                'cols'          => $cols,
                'cols_md'       => $fields[7]->value,
                'cols_sm'       => $fields[8]->value,
                'cols_xs'       => $fields[9]->value,
                'navigation'    => $fields[10]->value,
                'pagination'    => $fields[11]->value,
                'autoplay'      => $fields[12]->value,
                'rewind'        => $fields[13]->value,
                'slidebypage'   => $fields[14]->value,
                'addon_tpl_dir' => $addon_tpl_dir
            )
        );
        $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
