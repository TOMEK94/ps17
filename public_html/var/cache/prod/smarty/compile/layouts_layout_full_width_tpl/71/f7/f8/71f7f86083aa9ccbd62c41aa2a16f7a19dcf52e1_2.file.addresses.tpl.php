<?php
/* Smarty version 3.1.33, created on 2020-01-22 20:01:33
  from '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/themes/jms_storm/templates/customer/addresses.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e289c0d65f8f0_77769669',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '71f7f86083aa9ccbd62c41aa2a16f7a19dcf52e1' => 
    array (
      0 => '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/themes/jms_storm/templates/customer/addresses.tpl',
      1 => 1573058627,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:customer/_partials/block-address.tpl' => 1,
  ),
),false)) {
function content_5e289c0d65f8f0_77769669 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7358355935e289c0d652403_16771494', 'page_title');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14884299425e289c0d654d31_36118019', 'page_content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'customer/page.tpl');
}
/* {block 'page_title'} */
class Block_7358355935e289c0d652403_16771494 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_title' => 
  array (
    0 => 'Block_7358355935e289c0d652403_16771494',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your addresses','d'=>'Shop.Theme.CustomerAccount'),$_smarty_tpl ) );?>

<?php
}
}
/* {/block 'page_title'} */
/* {block 'customer_address'} */
class Block_12185837125e289c0d659738_00072336 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php $_smarty_tpl->_subTemplateRender('file:customer/_partials/block-address.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('address'=>$_smarty_tpl->tpl_vars['address']->value), 0, true);
?>
    <?php
}
}
/* {/block 'customer_address'} */
/* {block 'page_content'} */
class Block_14884299425e289c0d654d31_36118019 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content' => 
  array (
    0 => 'Block_14884299425e289c0d654d31_36118019',
  ),
  'customer_address' => 
  array (
    0 => 'Block_12185837125e289c0d659738_00072336',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['customer']->value['addresses'], 'address');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['address']->value) {
?>
    <div class="col-lg-4 col-md-6 col-sm-6">
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_12185837125e289c0d659738_00072336', 'customer_address', $this->tplIndex);
?>

    </div>
  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
  <div class="clearfix"></div>
  <div class="addresses-footer">
    <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['pages']['address'], ENT_QUOTES, 'UTF-8');?>
" data-link-action="add-address" class="btn-default">
      <i class="fa fa-plus-circle"></i>
      <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Create new address','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
</span>
    </a>
  </div>
<?php
}
}
/* {/block 'page_content'} */
}
