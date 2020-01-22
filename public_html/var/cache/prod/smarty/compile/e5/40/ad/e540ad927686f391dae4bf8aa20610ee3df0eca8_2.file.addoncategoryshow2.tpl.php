<?php
/* Smarty version 3.1.33, created on 2020-01-22 19:46:44
  from '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/themes/jms_storm/modules/jmspagebuilder/views/templates/hook/addoncategoryshow2.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e2898948c7ab6_44073208',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e540ad927686f391dae4bf8aa20610ee3df0eca8' => 
    array (
      0 => '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/themes/jms_storm/modules/jmspagebuilder/views/templates/hook/addoncategoryshow2.tpl',
      1 => 1573058627,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e2898948c7ab6_44073208 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript">
	var cs_items = <?php if ($_smarty_tpl->tpl_vars['cols']->value) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cols']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>4<?php }?>;
	var cs_itemsDesktop = <?php if ($_smarty_tpl->tpl_vars['cols']->value) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cols']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>4<?php }?>;
	var cs_itemsDesktopSmall = <?php if ($_smarty_tpl->tpl_vars['cols_md']->value) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cols_md']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>3<?php }?>;
	var cs_itemsTablet = <?php if ($_smarty_tpl->tpl_vars['cols_sm']->value) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cols_sm']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>2<?php }?>;
	var cs_itemsMobile = <?php if ($_smarty_tpl->tpl_vars['cols_xs']->value) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['cols_xs']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>1<?php }?>;
	var cs_nav = <?php if ($_smarty_tpl->tpl_vars['navigation']->value == 1) {?>true<?php } else { ?>false<?php }?>;
	var cs_pag = <?php if ($_smarty_tpl->tpl_vars['pagination']->value == 1) {?>true<?php } else { ?>false<?php }?>;
	var cs_auto_play_carousel = <?php if ($_smarty_tpl->tpl_vars['autoplay']->value == 1) {?>true<?php } else { ?>false<?php }?>;
<?php echo '</script'; ?>
>
<?php if ($_smarty_tpl->tpl_vars['addon_title']->value) {?>
<div class="addon-title">
	<h3><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['addon_title']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</h3>
</div>
<?php }?>
<div class="home_categories2">
    <?php if (isset($_smarty_tpl->tpl_vars['categories']->value) && $_smarty_tpl->tpl_vars['categories']->value) {?>
            <div class="categories-carousel2">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'category');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['category']->value) {
?>
	            <div class="item block_category">
	            	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['category']->value, 'c_item');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['c_item']->value) {
?>
	            
						<?php $_smarty_tpl->_assignInScope('categoryLink', $_smarty_tpl->tpl_vars['link']->value->getcategoryLink($_smarty_tpl->tpl_vars['c_item']->value['id_category'],$_smarty_tpl->tpl_vars['c_item']->value['link_rewrite']));?>
						<div class="categories-wrapper">
							<?php if ($_smarty_tpl->tpl_vars['show_img']->value == 1) {?>
							<div class="categoy-image">
								<a href="<?php echo $_smarty_tpl->tpl_vars['categoryLink']->value;?>
">
									<img src="<?php echo $_smarty_tpl->tpl_vars['img_cat_dir']->value;
echo $_smarty_tpl->tpl_vars['c_item']->value['id_category'];?>
.jpg" alt="<?php echo $_smarty_tpl->tpl_vars['c_item']->value['name'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['c_item']->value['name'];?>
" class="img-responsive"/>
								</a>
							</div>
							<?php }?>
							<div class="c_item-info">
								<a class="cat-name" href="<?php echo $_smarty_tpl->tpl_vars['categoryLink']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['c_item']->value['name'];?>
</a>
								<ul class="child" style="margin-bottom: 0;">
									<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['c_item']->value['cat_childs'], 'child');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['child']->value) {
?>
										<?php $_smarty_tpl->_assignInScope('childLink', $_smarty_tpl->tpl_vars['link']->value->getcategoryLink($_smarty_tpl->tpl_vars['child']->value['id_category'],$_smarty_tpl->tpl_vars['c_item']->value['link_rewrite']));?>
										<li>
											<a href="<?php echo $_smarty_tpl->tpl_vars['childLink']->value;?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['child']->value['name'], ENT_QUOTES, 'UTF-8');?>
</a>
										</li>
									<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
								</ul>
								
							</div>
						</div>
	            	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
	            </div>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
    <?php } else { ?>
        <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No categories','d'=>'Modules.JmsPagebuilder'),$_smarty_tpl ) );?>
</p>
  <?php }?>
</div>


	<?php }
}
