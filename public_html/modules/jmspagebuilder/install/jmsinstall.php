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

include_once(_PS_MODULE_DIR_.'jmspagebuilder/jmsHomepage.php');
class JmsPageBuilderInstall
{
    public function createTable()
    {
        $sql = array();
        $sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'jmspagebuilder`;
                    CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'jmspagebuilder` (
                    `id_homepage` int(10) unsigned NOT NULL AUTO_INCREMENT,
                    `id_shop` int(10) unsigned NOT NULL,
                    PRIMARY KEY (`id_homepage`,`id_shop`)
                ) ENGINE='._MYSQL_ENGINE_.'  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1';
        $sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'jmspagebuilder_homepages`;
                CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'jmspagebuilder_homepages` (
                  `id_homepage` int(11) NOT NULL AUTO_INCREMENT,
                  `title` varchar(100) NOT NULL,
                  `css_file` varchar(30) NOT NULL,
                  `js_file` varchar(30) NOT NULL,
                  `home_class` varchar(100) NOT NULL,
                  `params` mediumtext NOT NULL,
                  `active` tinyint(1) NOT NULL,
                  `ordering` int(11) NOT NULL,
                  PRIMARY KEY (`id_homepage`)
                ) ENGINE='._MYSQL_ENGINE_.'  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1';
        foreach ($sql as $s) {
            if (!Db::getInstance()->execute($s)) {
                return false;
            }
        }
    }
    public function _addHomePage($title, $importfile, $ordering, $css_file = '', $js_file = '', $home_class = '')
    {
        $homepage = new JmsHomepage();
        $homepage->title = $title;
        $homepage->css_file = $css_file;
        $homepage->js_file = $js_file;
        $homepage->home_class = $home_class;
        $homepage->ordering = $ordering;
        $homepage->active = 1;
        $jsonfile = fopen(_PS_ROOT_DIR_.'/modules/jmspagebuilder/json/'.$importfile, "r") or die("Unable to open file!");
        $jsontext = fread($jsonfile, filesize(_PS_ROOT_DIR_.'/modules/jmspagebuilder/json/'.$importfile));
        $homepage->params = $jsontext;
        $homepage->add();
        return $homepage->id;
    }
    public function installDemo()
    {
        $home1_id = $this->_addHomePage('Storm - Home 1', 'home_1.txt', 0, 'home1.css', 'home1.js', 'home_1');
        Configuration::updateValue('JPB_HOMEPAGE', $home1_id);
        $home2_id = $this->_addHomePage('Storm - Home 2', 'home_2.txt', 1, 'home2.css', 'home2.js', 'home_2');
        $home3_id = $this->_addHomePage('Storm - Home 3', 'home_3.txt', 2, 'home3.css', 'home3.js', 'home_3');
        $home4_id = $this->_addHomePage('Storm - Home 4', 'home_4.txt', 3, 'home4.css', 'home4.js', 'home_4');
        $home5_id = $this->_addHomePage('Storm - Home 5', 'home_5.txt', 4, 'home5.css', 'home5.js', 'home_5');
        $home6_id = $this->_addHomePage('Storm - Home 6', 'home_6.txt', 5, 'home6.css', 'home6.js', 'home_6');
        $home7_id = $this->_addHomePage('Storm - Home 7', 'home_7.txt', 6, 'home7.css', 'home7.js', 'home_7');
        $home8_id = $this->_addHomePage('Storm - Home 8', 'home_8.txt', 7, 'home8.css', 'home8.js', 'home_8');
        $home9_id = $this->_addHomePage('Storm - Home 9', 'home_9.txt', 8, 'home9.css', 'home9.js', 'home_9');
        $home10_id = $this->_addHomePage('Storm - Home 10', 'home_10.txt', 9, 'home10.css', 'home10.js', 'home_10');
        $home11_id = $this->_addHomePage('Storm - Home 11', 'home_11.txt', 10, 'home11.css', 'home11.js', 'home_11');
        $home12_id = $this->_addHomePage('Storm - Home 12', 'home_12.txt', 11, 'home12.css', 'home12.js', 'home_12');
        $home13_id = $this->_addHomePage('Storm - Home 13', 'home_13.txt', 12, 'home13.css', 'home13.js', 'home_13');
        $home14_id = $this->_addHomePage('Storm - Home 14', 'home_14.txt', 13, 'home14.css', 'home14.js', 'home_14');
        $home15_id = $this->_addHomePage('Storm - Home 15', 'home_15.txt', 14, 'home15.css', 'home15.js', 'home_15');
        $home16_id = $this->_addHomePage('Storm - Home 16', 'home_16.txt', 15, 'home16.css', 'home16.js', 'home_16');
        $home17_id = $this->_addHomePage('Storm - Home 17', 'home_17.txt', 16, 'home17.css', 'home17.js', 'home_17');
        $home18_id = $this->_addHomePage('Storm - Home 18', 'home_18.txt', 17, 'home18.css', 'home18.js', 'home_18');
        $home19_id = $this->_addHomePage('Storm - Home 19', 'home_19.txt', 18, 'home19.css', 'home19.js', 'home_19');
        $home20_id = $this->_addHomePage('Storm - Home 20', 'home_20.txt', 19, 'home20.css', 'home20.js', 'home_20');
    }
}
