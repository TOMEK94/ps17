<?php
/* Smarty version 3.1.33, created on 2020-01-22 20:01:25
  from '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/modules/pmcvg/views/templates/hook/1.6-myaccount.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e289c05212868_36650572',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f9c5f9f8738cf5288df4aa5ed3e7963e09370d46' => 
    array (
      0 => '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/modules/pmcvg/views/templates/hook/1.6-myaccount.tpl',
      1 => 1579718617,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e289c05212868_36650572 (Smarty_Internal_Template $_smarty_tpl) {
?>	<a class="col-lg-4 col-md-6 col-sm-6 col-xs-12" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getModuleLink('pmcvg','privacymanagement',array(),true),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Privacy management','mod'=>'pmcvg'),$_smarty_tpl ) );?>
"><span class="link-item"><i class="material-icons">&#xe862;</i><span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Privacy management','mod'=>'pmcvg'),$_smarty_tpl ) );?>
</span></span></a><?php }
}
