<?php
/* Smarty version 3.1.33, created on 2020-01-22 19:48:20
  from '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/themes/jms_storm/templates/catalog/product-layout-default.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e2898f4607030_55261490',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8c459bb5633be23e62746645682dfdcc14c7629d' => 
    array (
      0 => '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/themes/jms_storm/templates/catalog/product-layout-default.tpl',
      1 => 1573254849,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:catalog/_partials/product-cover-thumbnails.tpl' => 1,
    'file:catalog/_partials/product-prices.tpl' => 1,
    'file:catalog/_partials/product-customization.tpl' => 1,
    'file:catalog/_partials/product-variants.tpl' => 1,
    'file:catalog/_partials/miniatures/pack-product.tpl' => 1,
    'file:catalog/_partials/product-discounts.tpl' => 1,
    'file:catalog/_partials/product-add-to-cart.tpl' => 1,
    'file:catalog/_partials/product-details.tpl' => 1,
    'file:catalog/_partials/miniatures/product.tpl' => 1,
    'file:catalog/_partials/product-images-modal.tpl' => 1,
  ),
),false)) {
function content_5e2898f4607030_55261490 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>
 

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20484363755e2898f45ae2b5_41986906', 'head_seo');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4690724545e2898f45b0ad7_07349711', 'head');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7112490195e2898f45b9fc8_08069902', 'content');
?>


<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, $_smarty_tpl->tpl_vars['layout']->value);
}
/* {block 'head_seo'} */
class Block_20484363755e2898f45ae2b5_41986906 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'head_seo' => 
  array (
    0 => 'Block_20484363755e2898f45ae2b5_41986906',
  ),
);
public $prepend = 'true';
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <link rel="canonical" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['canonical_url'], ENT_QUOTES, 'UTF-8');?>
">
<?php
}
}
/* {/block 'head_seo'} */
/* {block 'head'} */
class Block_4690724545e2898f45b0ad7_07349711 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'head' => 
  array (
    0 => 'Block_4690724545e2898f45b0ad7_07349711',
  ),
);
public $append = 'true';
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <meta property="og:type" content="product">
  <meta property="og:url" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['current_url'], ENT_QUOTES, 'UTF-8');?>
">
  <meta property="og:title" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page']->value['meta']['title'], ENT_QUOTES, 'UTF-8');?>
">
  <meta property="og:site_name" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shop']->value['name'], ENT_QUOTES, 'UTF-8');?>
">
  <meta property="og:description" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page']->value['meta']['description'], ENT_QUOTES, 'UTF-8');?>
">
  <meta property="og:image" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['cover']['large']['url'], ENT_QUOTES, 'UTF-8');?>
">
  <meta property="product:pretax_price:amount" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['price_tax_exc'], ENT_QUOTES, 'UTF-8');?>
">
  <meta property="product:pretax_price:currency" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
">
  <meta property="product:price:amount" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['price_amount'], ENT_QUOTES, 'UTF-8');?>
">
  <meta property="product:price:currency" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currency']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
">
  <?php if (isset($_smarty_tpl->tpl_vars['product']->value['weight']) && ($_smarty_tpl->tpl_vars['product']->value['weight'] != 0)) {?>
  <meta property="product:weight:value" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['weight'], ENT_QUOTES, 'UTF-8');?>
">
  <meta property="product:weight:units" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['weight_unit'], ENT_QUOTES, 'UTF-8');?>
">
  <?php }
}
}
/* {/block 'head'} */
/* {block 'product_flags'} */
class Block_2642751155e2898f45bbf95_52941022 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                <ul class="product-flags">
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['flags'], 'flag');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['flag']->value) {
?>
                    <li class="product-flag <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['flag']->value['type'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['flag']->value['label'], ENT_QUOTES, 'UTF-8');?>
</li>
                  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </ul>
              <?php
}
}
/* {/block 'product_flags'} */
/* {block 'product_cover_tumbnails'} */
class Block_7593933865e2898f45c2152_37327232 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/product-cover-thumbnails.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
              <?php
}
}
/* {/block 'product_cover_tumbnails'} */
/* {block 'page_content'} */
class Block_14578946585e2898f45bb952_06810852 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

			 <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2642751155e2898f45bbf95_52941022', 'product_flags', $this->tplIndex);
?>


              <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7593933865e2898f45c2152_37327232', 'product_cover_tumbnails', $this->tplIndex);
?>

              <div class="scroll-box-arrows">
                <i class="fa fa-angle-left left"></i>
                <i class="fa fa-angle-right right"></i>
              </div>

            <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_8074006345e2898f45bb232_39549762 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <section class="page-content" id="content">
            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14578946585e2898f45bb952_06810852', 'page_content', $this->tplIndex);
?>

          </section>
        <?php
}
}
/* {/block 'page_content_container'} */
/* {block 'page_title'} */
class Block_8595700605e2898f45c4b10_39122395 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8');
}
}
/* {/block 'page_title'} */
/* {block 'page_header'} */
class Block_21346525725e2898f45c4384_15535732 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

					<h2  itemprop="name"><?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8595700605e2898f45c4b10_39122395', 'page_title', $this->tplIndex);
?>
</h2>
				<?php
}
}
/* {/block 'page_header'} */
/* {block 'page_header_container'} */
class Block_2559363965e2898f45c3d26_84403669 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

				<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_21346525725e2898f45c4384_15535732', 'page_header', $this->tplIndex);
?>

			<?php
}
}
/* {/block 'page_header_container'} */
/* {block 'product_prices'} */
class Block_12650302125e2898f45c6565_09323394 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

				<?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/product-prices.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            <?php
}
}
/* {/block 'product_prices'} */
/* {block 'product_description_short'} */
class Block_923827325e2898f45c7628_58859658 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

					<div id="product-description-short-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['id'], ENT_QUOTES, 'UTF-8');?>
" class="product-desc"itemprop="description"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['product']->value['description_short']),150,"..." )), ENT_QUOTES, 'UTF-8');?>
</div>
				<?php
}
}
/* {/block 'product_description_short'} */
/* {block 'product_customization'} */
class Block_8908960695e2898f45ce794_21380055 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

						<?php $_smarty_tpl->_subTemplateRender("file:catalog/_partials/product-customization.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('customizations'=>$_smarty_tpl->tpl_vars['product']->value['customizations']), 0, false);
?>
					<?php
}
}
/* {/block 'product_customization'} */
/* {block 'product_variants'} */
class Block_19677657475e2898f45dd924_31969436 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

								<?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/product-variants.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
							<?php
}
}
/* {/block 'product_variants'} */
/* {block 'product_miniature'} */
class Block_72856885e2898f45e0c02_13673271 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

											<?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/miniatures/pack-product.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('product'=>$_smarty_tpl->tpl_vars['product_pack']->value), 0, true);
?>
										<?php
}
}
/* {/block 'product_miniature'} */
/* {block 'product_pack'} */
class Block_12172627335e2898f45de9c4_27894189 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

							<?php if ($_smarty_tpl->tpl_vars['packItems']->value) {?>
								<section class="product-pack">
									<h3 class="h4"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'This pack contains','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</h3>
									<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['packItems']->value, 'product_pack');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product_pack']->value) {
?>
										<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_72856885e2898f45e0c02_13673271', 'product_miniature', $this->tplIndex);
?>

									<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
								</section>
							<?php }?>
							<?php
}
}
/* {/block 'product_pack'} */
/* {block 'product_discounts'} */
class Block_9183023965e2898f45e28b8_74158159 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

								<?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/product-discounts.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
							<?php
}
}
/* {/block 'product_discounts'} */
/* {block 'product_add_to_cart'} */
class Block_14582024805e2898f45e38f1_48032096 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

								<?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/product-add-to-cart.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
							<?php
}
}
/* {/block 'product_add_to_cart'} */
/* {block 'product_refresh'} */
class Block_12201812795e2898f45e5863_15297766 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

								<input class="product-refresh ps-hidden-by-js" name="refresh" type="submit" value="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Refresh','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
">
							<?php
}
}
/* {/block 'product_refresh'} */
/* {block 'product_buy'} */
class Block_10159315915e2898f45db0f6_73512604 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

						<form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['pages']['cart'], ENT_QUOTES, 'UTF-8');?>
" method="post" id="add-to-cart-or-refresh">
							<input type="hidden" name="token" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['static_token']->value, ENT_QUOTES, 'UTF-8');?>
">
							<input type="hidden" name="id_product" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['id'], ENT_QUOTES, 'UTF-8');?>
" id="product_page_product_id">
							<input type="hidden" name="id_customization" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['id_customization'], ENT_QUOTES, 'UTF-8');?>
" id="product_customization_id">

							<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19677657475e2898f45dd924_31969436', 'product_variants', $this->tplIndex);
?>


							<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_12172627335e2898f45de9c4_27894189', 'product_pack', $this->tplIndex);
?>

							
							<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_9183023965e2898f45e28b8_74158159', 'product_discounts', $this->tplIndex);
?>

							
							<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14582024805e2898f45e38f1_48032096', 'product_add_to_cart', $this->tplIndex);
?>

							<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductButtons','product'=>$_smarty_tpl->tpl_vars['product']->value),$_smarty_tpl ) );?>


							<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_12201812795e2898f45e5863_15297766', 'product_refresh', $this->tplIndex);
?>

						</form>
					<?php
}
}
/* {/block 'product_buy'} */
/* {block 'product_description'} */
class Block_18483599565e2898f45efe70_76975025 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                     <div class="product-description"><?php echo $_smarty_tpl->tpl_vars['product']->value['description'];?>
</div>
                   <?php
}
}
/* {/block 'product_description'} */
/* {block 'product_details'} */
class Block_5491066805e2898f45f1464_72412870 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                   <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/product-details.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                 <?php
}
}
/* {/block 'product_details'} */
/* {block 'product_attachments'} */
class Block_9614357525e2898f45f2510_05904501 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                   <?php if ($_smarty_tpl->tpl_vars['product']->value['attachments']) {?>
                    <div class="tab-pane fade in" id="attachments" role="tabpanel">
                       <section class="product-attachments">
                         <h3 class="h5 text-uppercase"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Download','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
</h3>
                         <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['attachments'], 'attachment');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['attachment']->value) {
?>
                           <div class="attachment">
                             <h4><a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('entity'=>'attachment','params'=>array('id_attachment'=>$_smarty_tpl->tpl_vars['attachment']->value['id_attachment'])),$_smarty_tpl ) );?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['attachment']->value['name'], ENT_QUOTES, 'UTF-8');?>
</a></h4>
                             <p><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['attachment']->value['description'], ENT_QUOTES, 'UTF-8');?>
</p
                             <a href="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0], array( array('entity'=>'attachment','params'=>array('id_attachment'=>$_smarty_tpl->tpl_vars['attachment']->value['id_attachment'])),$_smarty_tpl ) );?>
">
                               <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Download','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
 (<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['attachment']->value['file_size_formatted'], ENT_QUOTES, 'UTF-8');?>
)
                             </a>
                           </div>
                         <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                       </section>
                     </div>
                   <?php }?>
                 <?php
}
}
/* {/block 'product_attachments'} */
/* {block 'product_tabs'} */
class Block_2336296165e2898f45e7af6_04263860 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

              <div class="tabs">
                <ul class="nav nav-tabs" role="tablist">
                  <?php if ($_smarty_tpl->tpl_vars['product']->value['description']) {?>
                    <li class="nav-item">
                       <a
                         class="nav-link<?php if ($_smarty_tpl->tpl_vars['product']->value['description']) {?> active<?php }?>"
                         data-toggle="tab"
                         href="#description"
                         role="tab"
                         aria-controls="description"
                         <?php if ($_smarty_tpl->tpl_vars['product']->value['description']) {?> aria-selected="true"<?php }?>><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Descriptions','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</a>
                    </li>
                  <?php }?>
                  <?php if ($_smarty_tpl->tpl_vars['product']->value['attachments']) {?>
                    <li class="nav-item">
                      <a
                        class="nav-link"
                        data-toggle="tab"
                        href="#attachments"
                        role="tab"
                        aria-controls="attachments"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Attachments','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</a>
                    </li>
                  <?php }?>
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['extraContent'], 'extra', false, 'extraKey');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['extraKey']->value => $_smarty_tpl->tpl_vars['extra']->value) {
?>
                    <li class="nav-item">
                      <a
                        class="nav-link"
                        data-toggle="tab"
                        href="#extra-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['extraKey']->value, ENT_QUOTES, 'UTF-8');?>
"
                        role="tab"
                        aria-controls="extra-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['extraKey']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['extra']->value['title'], ENT_QUOTES, 'UTF-8');?>
</a>
                    </li>
                  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </ul>

                <div class="tab-content" id="tab-content">
                 <div class="tab-pane fade in<?php if ($_smarty_tpl->tpl_vars['product']->value['description']) {?> active<?php }?>" id="description" role="tabpanel">
                   <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18483599565e2898f45efe70_76975025', 'product_description', $this->tplIndex);
?>

                 </div>

                 <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5491066805e2898f45f1464_72412870', 'product_details', $this->tplIndex);
?>


                 <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_9614357525e2898f45f2510_05904501', 'product_attachments', $this->tplIndex);
?>


                 <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['extraContent'], 'extra', false, 'extraKey');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['extraKey']->value => $_smarty_tpl->tpl_vars['extra']->value) {
?>
                 <div class="tab-pane fade in <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['extra']->value['attr']['class'], ENT_QUOTES, 'UTF-8');?>
" id="extra-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['extraKey']->value, ENT_QUOTES, 'UTF-8');?>
" role="tabpanel" <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['extra']->value['attr'], 'val', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['val']->value) {
?> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8');?>
="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['val']->value, ENT_QUOTES, 'UTF-8');?>
"<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>>
                   <?php echo $_smarty_tpl->tpl_vars['extra']->value['content'];?>

                 </div>
                 <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </div>  
            </div>
          <?php
}
}
/* {/block 'product_tabs'} */
/* {block 'product_miniature'} */
class Block_20724282505e2898f4601e76_02079710 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

							<?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/miniatures/product.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('product'=>$_smarty_tpl->tpl_vars['product_accessory']->value), 0, true);
?>
						<?php
}
}
/* {/block 'product_miniature'} */
/* {block 'product_accessories'} */
class Block_19115736585e2898f45ffad6_66493269 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php if ($_smarty_tpl->tpl_vars['accessories']->value) {?>
        <section class="product-accessories clearfix">
			<div class="addon-title">
				<h3><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Accessories','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</h3>
			</div>
		
			<div class="products accessories-carousel customs-carousel-product">			
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['accessories']->value, 'product_accessory');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product_accessory']->value) {
?>
					<div class="item ajax_block_product">
						<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20724282505e2898f4601e76_02079710', 'product_miniature', $this->tplIndex);
?>
  
					</div>
				<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</div>
			
        </section>
      <?php }?>
    <?php
}
}
/* {/block 'product_accessories'} */
/* {block 'product_footer'} */
class Block_2053575265e2898f4603b30_82499298 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayFooterProduct','product'=>$_smarty_tpl->tpl_vars['product']->value,'category'=>$_smarty_tpl->tpl_vars['category']->value),$_smarty_tpl ) );?>

    <?php
}
}
/* {/block 'product_footer'} */
/* {block 'product_images_modal'} */
class Block_19442922035e2898f4604f98_50287852 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/product-images-modal.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <?php
}
}
/* {/block 'product_images_modal'} */
/* {block 'page_footer_container'} */
class Block_5472715765e2898f4605fa3_03922323 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      
    <?php
}
}
/* {/block 'page_footer_container'} */
/* {block 'content'} */
class Block_7112490195e2898f45b9fc8_08069902 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_7112490195e2898f45b9fc8_08069902',
  ),
  'page_content_container' => 
  array (
    0 => 'Block_8074006345e2898f45bb232_39549762',
  ),
  'page_content' => 
  array (
    0 => 'Block_14578946585e2898f45bb952_06810852',
  ),
  'product_flags' => 
  array (
    0 => 'Block_2642751155e2898f45bbf95_52941022',
  ),
  'product_cover_tumbnails' => 
  array (
    0 => 'Block_7593933865e2898f45c2152_37327232',
  ),
  'page_header_container' => 
  array (
    0 => 'Block_2559363965e2898f45c3d26_84403669',
  ),
  'page_header' => 
  array (
    0 => 'Block_21346525725e2898f45c4384_15535732',
  ),
  'page_title' => 
  array (
    0 => 'Block_8595700605e2898f45c4b10_39122395',
  ),
  'product_prices' => 
  array (
    0 => 'Block_12650302125e2898f45c6565_09323394',
  ),
  'product_description_short' => 
  array (
    0 => 'Block_923827325e2898f45c7628_58859658',
  ),
  'product_customization' => 
  array (
    0 => 'Block_8908960695e2898f45ce794_21380055',
  ),
  'product_buy' => 
  array (
    0 => 'Block_10159315915e2898f45db0f6_73512604',
  ),
  'product_variants' => 
  array (
    0 => 'Block_19677657475e2898f45dd924_31969436',
  ),
  'product_pack' => 
  array (
    0 => 'Block_12172627335e2898f45de9c4_27894189',
  ),
  'product_miniature' => 
  array (
    0 => 'Block_72856885e2898f45e0c02_13673271',
    1 => 'Block_20724282505e2898f4601e76_02079710',
  ),
  'product_discounts' => 
  array (
    0 => 'Block_9183023965e2898f45e28b8_74158159',
  ),
  'product_add_to_cart' => 
  array (
    0 => 'Block_14582024805e2898f45e38f1_48032096',
  ),
  'product_refresh' => 
  array (
    0 => 'Block_12201812795e2898f45e5863_15297766',
  ),
  'product_tabs' => 
  array (
    0 => 'Block_2336296165e2898f45e7af6_04263860',
  ),
  'product_description' => 
  array (
    0 => 'Block_18483599565e2898f45efe70_76975025',
  ),
  'product_details' => 
  array (
    0 => 'Block_5491066805e2898f45f1464_72412870',
  ),
  'product_attachments' => 
  array (
    0 => 'Block_9614357525e2898f45f2510_05904501',
  ),
  'product_accessories' => 
  array (
    0 => 'Block_19115736585e2898f45ffad6_66493269',
  ),
  'product_footer' => 
  array (
    0 => 'Block_2053575265e2898f4603b30_82499298',
  ),
  'product_images_modal' => 
  array (
    0 => 'Block_19442922035e2898f4604f98_50287852',
  ),
  'page_footer_container' => 
  array (
    0 => 'Block_5472715765e2898f4605fa3_03922323',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


  <section id="main" itemscope itemtype="https://schema.org/Product">
    <meta itemprop="url" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['url'], ENT_QUOTES, 'UTF-8');?>
">
    <div class="row product-detail">
      <div class="pb-left-column col-lg-6 col-md-6 col-sm-6 col-xs-12">
	   <div class="pd-left-content">
          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8074006345e2898f45bb232_39549762', 'page_content_container', $this->tplIndex);
?>

		 </div>
        </div>
        <div class="pb-right-column col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2559363965e2898f45c3d26_84403669', 'page_header_container', $this->tplIndex);
?>

			<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_12650302125e2898f45c6565_09323394', 'product_prices', $this->tplIndex);
?>

			<div class="product-information">
				<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_923827325e2898f45c7628_58859658', 'product_description_short', $this->tplIndex);
?>

			
				<?php if ($_smarty_tpl->tpl_vars['product']->value['is_customizable'] && count($_smarty_tpl->tpl_vars['product']->value['customizations']['fields'])) {?>
					<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8908960695e2898f45ce794_21380055', 'product_customization', $this->tplIndex);
?>

				<?php }?>
				
                    <ul class="other-info">
						<?php if ($_smarty_tpl->tpl_vars['product']->value['reference']) {?>
												<!-- number of item in stock -->
						<li id="product_reference">
							<label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Product Code:','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</label>
							<span class="editable"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['reference'], ENT_QUOTES, 'UTF-8');?>
</span>
						</li>
						<?php }?>
												<!-- availability or doesntExist -->
						<li id="availability_statut">
							<label id="availability_label">
								<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Availability:','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>

							</label>
							<span id="availability_value" class="label-availability">
								<?php if (intval($_smarty_tpl->tpl_vars['product']->value['quantity']) <= 0) {?>
									<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Out stock','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>

								<?php } else { ?>
									<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'In stock','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>

								<?php }?>
							</span>
						</li>
						<li>
						<?php if ($_smarty_tpl->tpl_vars['product']->value['additional_shipping_cost'] > 0) {?>
							<label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Shipping tax: '),$_smarty_tpl ) );?>
</label>
								<span class="shipping_cost"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['additional_shipping_cost'], ENT_QUOTES, 'UTF-8');?>
</span>
						<?php } else { ?>
							<label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Shipping tax:'),$_smarty_tpl ) );?>
</label><span class="shipping_cost"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>' Free'),$_smarty_tpl ) );?>
</span>
						<?php }?>
					</li>
					</ul>
				<div class="product-actions">
					<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_10159315915e2898f45db0f6_73512604', 'product_buy', $this->tplIndex);
?>

				</div>
				<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayReassurance'),$_smarty_tpl ) );?>

				
			</div>
          <!-- Go to www.addthis.com/dashboard to customize your tools -->
          <div class="addthis_inline_share_toolbox_ld1s"></div>
            
		</div>
	
    </div>
	
	<div id="more_info_block" class="tabs">
            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2336296165e2898f45e7af6_04263860', 'product_tabs', $this->tplIndex);
?>

          </div>
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19115736585e2898f45ffad6_66493269', 'product_accessories', $this->tplIndex);
?>

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2053575265e2898f4603b30_82499298', 'product_footer', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19442922035e2898f4604f98_50287852', 'product_images_modal', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5472715765e2898f4605fa3_03922323', 'page_footer_container', $this->tplIndex);
?>

  </section>

<?php
}
}
/* {/block 'content'} */
}
