<?php
/* Smarty version 3.1.33, created on 2020-01-22 19:55:21
  from '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/themes/jms_storm/modules/jmspagebuilder/views/templates/hook/addonspace.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e289a99338593_16894421',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3d83b5169214eb03e7a6534326cf00b348138628' => 
    array (
      0 => '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/themes/jms_storm/modules/jmspagebuilder/views/templates/hook/addonspace.tpl',
      1 => 1573058627,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e289a99338593_16894421 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="jms-empty-space clearfix<?php if (isset($_smarty_tpl->tpl_vars['space_class']->value) && $_smarty_tpl->tpl_vars['space_class']->value) {?> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['space_class']->value, ENT_QUOTES, 'UTF-8');
}?>" style="margin-bottom:<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['spacegap']->value, ENT_QUOTES, 'UTF-8');?>
px;"></div>
<?php }
}
