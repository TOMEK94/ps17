<?php
/**
* 2007-2018 PrestaShop
*
* Jms Adv Search
*
*  @author    Joommasters <joommasters@gmail.com>
*  @copyright 2007-2018 Joommasters
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: http://www.joommasters.com
*/

/**
 * @since 1.5.0
 */

require_once(_PS_ROOT_DIR_.'/modules/jmsadvsearch/jmsadvsearch.php');
 use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery;
 use PrestaShop\PrestaShop\Core\Product\Search\SortOrder;
 use PrestaShop\PrestaShop\Adapter\Search\SearchProductSearchProvider;
class JMSAdvSearchSearchModuleFrontController extends ProductListingFrontController
{
    public $instant_search;
    public $ajax_search;
    private $search_string;
    private $search_tag;
	private $id_category;

    public function init()
    {
        parent::init();

        $this->search_string = Tools::getValue('s');
        if (!$this->search_string) {
            $this->search_string = Tools::getValue('search_query');
        }

        $this->id_category = Tools::getValue('id_category');

        $this->context->smarty->assign(array(
            'search_string' => $this->search_string,
            'id_category' => $this->id_category,
        ));		
        $this->doProductSearch('catalog/listing/search', array('entity' => 'search'));
    }    
	protected function getProductSearchQuery()
     {
         $query = new ProductSearchQuery();
         $query
           ->setSortOrder(new SortOrder('product', Tools::getProductsOrder('by'), Tools::getProductsOrder('way')))
		   ->setIdCategory($this->search_tag)
           ->setSearchString($this->search_string)           
        ;

         return $query;
     }

     protected function getDefaultProductSearchProvider()
     {
         return new SearchProductSearchProvider(
            $this->getTranslator()
       );
     }
	public function getListingLabel()
     {
         return $this->getTranslator()->trans('Search results', array(), 'Shop.Theme.Catalog');
     }
}
