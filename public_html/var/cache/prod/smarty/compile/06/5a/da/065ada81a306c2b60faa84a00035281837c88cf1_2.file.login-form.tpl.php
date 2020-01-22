<?php
/* Smarty version 3.1.33, created on 2020-01-22 20:01:12
  from '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/themes/jms_storm/templates/customer/_partials/login-form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e289bf8963ac7_42801809',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '065ada81a306c2b60faa84a00035281837c88cf1' => 
    array (
      0 => '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/themes/jms_storm/templates/customer/_partials/login-form.tpl',
      1 => 1573255626,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_partials/form-errors.tpl' => 1,
  ),
),false)) {
function content_5e289bf8963ac7_42801809 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->_subTemplateRender('file:_partials/form-errors.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('errors'=>$_smarty_tpl->tpl_vars['errors']->value['']), 0, false);
?>


<form id="login-form" action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8');?>
" method="post">

  <section>
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7209657025e289bf894eaf8_88865547', 'form_fields');
?>

    <div class="forgot-password">
      <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['urls']->value['pages']['password'], ENT_QUOTES, 'UTF-8');?>
" rel="nofollow">
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Zapomniałeś/aś hasła?','d'=>'Shop.Theme.CustomerAccount'),$_smarty_tpl ) );?>

      </a>
	  <?php if (isset($_smarty_tpl->tpl_vars['fb_on']->value) && $_smarty_tpl->tpl_vars['fb_on']->value) {?>
		<br /><div class="fb-login-button" data-max-rows="1" data-size="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['JMSFB_BUTTON_SIZE']->value, ENT_QUOTES, 'UTF-8');?>
" data-button-type="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['JMSFB_BUTTON_TEXT']->value, ENT_QUOTES, 'UTF-8');?>
" data-show-faces="<?php if ($_smarty_tpl->tpl_vars['JMSFB_SHOW_FRIENDS']->value) {?>true<?php } else { ?>false<?php }?>" data-auto-logout-link="<?php if ($_smarty_tpl->tpl_vars['JMSFB_LOGOUT_BUTTON']->value) {?>true<?php } else { ?>false<?php }?>" data-use-continue-as="<?php if ($_smarty_tpl->tpl_vars['JMSFB_PROFILE_INCLUDED']->value) {?>true<?php } else { ?>false<?php }?>"></div>
	<?php }?>
    </div>	
  </section>

  <footer class="form-footer text-xs-center clearfix">
    <input type="hidden" name="submitLogin" value="1">
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4609745235e289bf8961ff4_10844530', 'form_buttons');
?>

  </footer>
</form>
<?php }
/* {block 'form_field'} */
class Block_20632950165e289bf89563a9_24519774 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['form_field'][0], array( array('field'=>$_smarty_tpl->tpl_vars['field']->value),$_smarty_tpl ) );?>

        <?php
}
}
/* {/block 'form_field'} */
/* {block 'form_fields'} */
class Block_7209657025e289bf894eaf8_88865547 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'form_fields' => 
  array (
    0 => 'Block_7209657025e289bf894eaf8_88865547',
  ),
  'form_field' => 
  array (
    0 => 'Block_20632950165e289bf89563a9_24519774',
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
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20632950165e289bf89563a9_24519774', 'form_field', $this->tplIndex);
?>

      <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php
}
}
/* {/block 'form_fields'} */
/* {block 'form_buttons'} */
class Block_4609745235e289bf8961ff4_10844530 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'form_buttons' => 
  array (
    0 => 'Block_4609745235e289bf8961ff4_10844530',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <button class="btn btn-default btn-effect" data-link-action="sign-in" type="submit" class="form-control-submit">
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Sign in','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>

      </button>
    <?php
}
}
/* {/block 'form_buttons'} */
}
