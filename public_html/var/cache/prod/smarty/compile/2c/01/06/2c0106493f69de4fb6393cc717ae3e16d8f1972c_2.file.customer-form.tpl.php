<?php
/* Smarty version 3.1.33, created on 2020-01-22 20:01:30
  from '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/themes/jms_storm/templates/customer/_partials/customer-form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e289c0aeeb915_57105761',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2c0106493f69de4fb6393cc717ae3e16d8f1972c' => 
    array (
      0 => '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/themes/jms_storm/templates/customer/_partials/customer-form.tpl',
      1 => 1573058627,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_partials/form-errors.tpl' => 1,
  ),
),false)) {
function content_5e289c0aeeb915_57105761 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->_subTemplateRender('file:_partials/form-errors.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('errors'=>$_smarty_tpl->tpl_vars['errors']->value['']), 0, false);
?>

<form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8');?>
" id="customer-form" class="js-customer-form" method="post">
  <section>
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19186675645e289c0aee3bf0_02345042', "form_fields");
?>

  </section>

  <footer class="form-footer clearfix">
    <input type="hidden" name="submitCreate" value="1">
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_536484165e289c0aeea782_49818871', "form_buttons");
?>

  </footer>

</form>
<?php }
/* {block "form_field"} */
class Block_21372990585e289c0aee7a47_23948690 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_field'][0], array( array('field'=>$_smarty_tpl->tpl_vars['field']->value),$_smarty_tpl ) );?>

        <?php
}
}
/* {/block "form_field"} */
/* {block "form_fields"} */
class Block_19186675645e289c0aee3bf0_02345042 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'form_fields' => 
  array (
    0 => 'Block_19186675645e289c0aee3bf0_02345042',
  ),
  'form_field' => 
  array (
    0 => 'Block_21372990585e289c0aee7a47_23948690',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['formFields']->value, 'field');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['field']->value) {
?>
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_21372990585e289c0aee7a47_23948690', "form_field", $this->tplIndex);
?>

      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php
}
}
/* {/block "form_fields"} */
/* {block "form_buttons"} */
class Block_536484165e289c0aeea782_49818871 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'form_buttons' => 
  array (
    0 => 'Block_536484165e289c0aeea782_49818871',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <button class="btn-default btn-primary form-control-submit pull-xs-right" data-link-action="save-customer" type="submit">
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>

      </button>
    <?php
}
}
/* {/block "form_buttons"} */
}
