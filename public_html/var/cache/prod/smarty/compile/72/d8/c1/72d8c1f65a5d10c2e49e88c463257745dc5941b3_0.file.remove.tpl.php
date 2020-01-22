<?php
/* Smarty version 3.1.33, created on 2020-01-22 19:44:37
  from '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/modules/pmcvg/views/templates/admin/remove.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e289815ecbcf3_35912655',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '72d8c1f65a5d10c2e49e88c463257745dc5941b3' => 
    array (
      0 => '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/modules/pmcvg/views/templates/admin/remove.tpl',
      1 => 1579718617,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e289815ecbcf3_35912655 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="panel " id="configuration_fieldset_general">
	<div class="panel-heading"><i class="icon-cogs"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Privacy management','mod'=>'pmcvg'),$_smarty_tpl ) );?>
 - <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Global settings','mod'=>'pmcvg'),$_smarty_tpl ) );?>
</div>
	<div class="row">
		<div class="col-md-3">
			<strong>Uwaga operacji nie można cofnąć - podaj id klienta do skasowania</strong>			
			<form action="" method="post">
				<div class="form-group">
					<label for="customer"></label>
					<input type="text" name="customer_id" />
				</div>
				<button onclick="confirm('<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Czy na pewno? Operacji nie można cofnąć?','mod'=>'pmcvg'),$_smarty_tpl ) );?>
')" type="Submit"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Remove account','mod'=>'pmcvg'),$_smarty_tpl ) );?>
</button>
			</form>
		</div>
	</div>
</div><?php }
}
