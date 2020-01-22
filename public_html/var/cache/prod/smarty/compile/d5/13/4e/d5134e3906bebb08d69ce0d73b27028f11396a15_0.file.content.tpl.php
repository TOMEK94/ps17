<?php
/* Smarty version 3.1.33, created on 2020-01-22 19:44:37
  from '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/admin-zone/themes/default/template/content.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e289815ed8759_38025733',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd5134e3906bebb08d69ce0d73b27028f11396a15' => 
    array (
      0 => '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/admin-zone/themes/default/template/content.tpl',
      1 => 1566837320,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e289815ed8759_38025733 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="ajax_confirmation" class="alert alert-success hide"></div>
<div id="ajaxBox" style="display:none"></div>


<div class="row">
	<div class="col-lg-12">
		<?php if (isset($_smarty_tpl->tpl_vars['content']->value)) {?>
			<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

		<?php }?>
	</div>
</div>
<?php }
}
