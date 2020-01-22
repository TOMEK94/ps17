<?php
/* Smarty version 3.1.33, created on 2020-01-22 19:46:44
  from 'module:psshoppingcartpsshoppingc' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e2898948802a6_48632737',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '35655e6409b6198f29dd6e732ef9598dec599880' => 
    array (
      0 => 'module:psshoppingcartpsshoppingc',
      1 => 1573254117,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
    'module:ps_shoppingcart/ps_shoppingcart-product-line.tpl' => 1,
  ),
),false)) {
function content_5e2898948802a6_48632737 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="btn-group compact-hidden blockcart cart-preview <?php if ($_smarty_tpl->tpl_vars['cart']->value['products_count'] > 0) {?>active<?php } else { ?>inactive<?php }?> dropdown <?php if (isset($_smarty_tpl->tpl_vars['jpb_addtocart']->value) && $_smarty_tpl->tpl_vars['jpb_addtocart']->value == 'ajax_cartbottom') {?>shoppingcart-bottom<?php }?>" id="cart_block" data-refresh-url="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['refresh_url']->value, ENT_QUOTES, 'UTF-8');?>
">
	<a href="#" class="dropdown-toggle cart-icon" data-toggle="dropdown">
		<i class="storm-shopping-bag"></i>			
		<span class="ajax_cart_quantity"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cart']->value['products_count'], ENT_QUOTES, 'UTF-8');?>
</span>
	</a>
	<div class="text-custom">
		<p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your cart','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
</p>
		<span class="cart_block_total ajax_block_cart_total"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cart']->value['totals']['total']['value'], ENT_QUOTES, 'UTF-8');?>
</span>
	</div>
	
	<a href="#" class="btn-xs tab-title dropdown-toggle" data-toggle="dropdown">		 
		<span><span class="box-cart ajax_cart_quantity"> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cart']->value['products_count'], ENT_QUOTES, 'UTF-8');?>
</span> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'item(s) in your cart','mod'=>'blockcart'),$_smarty_tpl ) );?>
<i class="fa fa-chevron-down"></i><i class="fa fa-chevron-up"></i></span>
	</a>
	<div class="dropdown-menu shoppingcart-box">
	   	<div class="shoppingcart-content">
        	<span class="ajax_cart_no_product" <?php if ($_smarty_tpl->tpl_vars['cart']->value['products_count'] != 0) {?>style="display:none"<?php }?>><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'There is no product','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
</span>
			<ul class="list products cart_block_list">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cart']->value['products'], 'product');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['product']->value) {
?>
					<li><?php $_smarty_tpl->_subTemplateRender('module:ps_shoppingcart/ps_shoppingcart-product-line.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('product'=>$_smarty_tpl->tpl_vars['product']->value), 0, true);
?></li>
				<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</ul>
		</div>
		<div class="cart-prices">
			<div class="checkout-info">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cart']->value['subtotals'], 'subtotal');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['subtotal']->value) {
?>
					<div class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subtotal']->value['type'], ENT_QUOTES, 'UTF-8');?>
 cart-prices-line">
						<span class="label"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subtotal']->value['label'], ENT_QUOTES, 'UTF-8');?>
</span>
						<span class="value"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['subtotal']->value['value'], ENT_QUOTES, 'UTF-8');?>
</span>
					</div>
				<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</div>
			<div class="cart-button">
				<a id="button_order_cart" class="btn-default btn-effect" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cart_url']->value, ENT_QUOTES, 'UTF-8');?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'DO KASY','d'=>'Shop.Theme'),$_smarty_tpl ) );?>
" rel="nofollow">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'DO KASY','d'=>'Shop.Theme'),$_smarty_tpl ) );?>

				</a> 
			</div>
		</div>
	</div>
</div>
<?php }
}
