<?php
/* Smarty version 3.1.33, created on 2020-01-22 20:01:25
  from '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/modules/psgdpr/views/templates/front/customerAccount.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e289c05209da6_33553111',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '82ee72e9784c4e603d5b63d3a2a19752dde3ee9c' => 
    array (
      0 => '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/modules/psgdpr/views/templates/front/customerAccount.tpl',
      1 => 1572031113,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e289c05209da6_33553111 (Smarty_Internal_Template $_smarty_tpl) {
?>
<a class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="identity-link" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getModuleLink('psgdpr','gdpr'), ENT_QUOTES, 'UTF-8');?>
">
    <span class="link-item">
        <i class="material-icons">account_box</i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'GDPR - Personal data','mod'=>'psgdpr'),$_smarty_tpl ) );?>

    </span>
</a>
<?php }
}
