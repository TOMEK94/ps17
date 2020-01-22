<?php
/* Smarty version 3.1.33, created on 2020-01-22 19:46:44
  from '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/themes/jms_storm/templates/catalog/_partials/product-activation.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e2898947e0779_66357656',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9e260848551a205b9305c5f6697d4f6bca2eaec6' => 
    array (
      0 => '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/themes/jms_storm/templates/catalog/_partials/product-activation.tpl',
      1 => 1573058627,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e2898947e0779_66357656 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['page']->value['admin_notifications']) {?>
  <div class="alert alert-warning row" role="alert">
    <div class="container">
      <div class="row">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['page']->value['admin_notifications'], 'notif');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['notif']->value) {
?>
          <div class="col-sm-12">
            <i class="material-icons pull-xs-left">&#xE001;</i>
            <p class="alert-text"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['notif']->value['message'], ENT_QUOTES, 'UTF-8');?>
</p>
          </div>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      </div>
    </div>
  </div>
<?php }
}
}
