<?php
/* Smarty version 3.1.33, created on 2020-01-22 19:55:21
  from '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/themes/jms_storm/modules/jmspagebuilder/views/templates/hook/addonbrand.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e289a993db177_69412135',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cd40246dc985af2b3502c10c77f131c9ebbbf3c3' => 
    array (
      0 => '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/themes/jms_storm/modules/jmspagebuilder/views/templates/hook/addonbrand.tpl',
      1 => 1573058627,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e289a993db177_69412135 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript">    	
	var brand_items = 3,
	    brand_itemsDesktop = <?php if ($_smarty_tpl->tpl_vars['items_show']->value) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['items_show']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>5<?php }?>,
	    brand_itemsDesktopSmall = <?php if ($_smarty_tpl->tpl_vars['items_show_md']->value) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['items_show_md']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>4<?php }?>,
	    brand_itemsTablet = <?php if ($_smarty_tpl->tpl_vars['items_show_sm']->value) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['items_show_sm']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>3<?php }?>,
	    brand_itemsMobile = <?php if ($_smarty_tpl->tpl_vars['items_show_xs']->value) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['items_show_xs']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>2<?php }?>;
        var p_nav_brand = <?php if ($_smarty_tpl->tpl_vars['navigation']->value == 1) {?>true<?php } else { ?>false<?php }?>;
	    var p_pag_brand = <?php if ($_smarty_tpl->tpl_vars['pagination']->value == 1) {?>true<?php } else { ?>false<?php }?>;
        var auto_play_brand = <?php if ($_smarty_tpl->tpl_vars['autoplay']->value == 1) {?>true<?php } else { ?>false<?php }?>;		
<?php echo '</script'; ?>
>
<?php if ($_smarty_tpl->tpl_vars['addon_title']->value) {?>
<div class="addon-title">
	<h3><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['addon_title']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</h3>
</div>
<?php }
if ($_smarty_tpl->tpl_vars['addon_desc']->value) {?>
<p class="addon-desc"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['addon_desc']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</p>
<?php }?>
<div class="brand-carousel">
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['brands']->value, 'brand');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['brand']->value) {
?>
		<div class="brand-item">	
			<?php if ($_smarty_tpl->tpl_vars['brand']->value['image']) {?>
			<a href="<?php if ($_smarty_tpl->tpl_vars['link_enable']->value == '1') {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['brand']->value['url'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>#<?php }?>" title="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['brand']->value['title'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">					
				<img src="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['image_url']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['brand']->value['image'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['brand']->value['title'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" />
			</a>
			<?php }?>
		</div>
	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div><?php }
}
