<?php
/* Smarty version 3.1.33, created on 2020-01-22 19:43:44
  from '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/modules/pmcvg/views/templates/admin/configure.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e2897e01c3224_24379623',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5283b1e7d0470edb4dd87d746eacc5eb518ea536' => 
    array (
      0 => '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/modules/pmcvg/views/templates/admin/configure.tpl',
      1 => 1579718617,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e2897e01c3224_24379623 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="panel " id="configuration_fieldset_general">
	<div class="panel-heading"><i class="icon-cogs"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Privacy management','mod'=>'pmcvg'),$_smarty_tpl ) );?>
 - <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Global settings','mod'=>'pmcvg'),$_smarty_tpl ) );?>
</div>
		<div class="form-wrapper">
			<ul class="nav nav-tabs">
				<li class="active">
					<a href="#global" data-toggle="tab"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Global settings','mod'=>'pmcvg'),$_smarty_tpl ) );?>
</a>
				</li>
				<li class="">
					<a href="#general" data-toggle="tab"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Customer page settings','mod'=>'pmcvg'),$_smarty_tpl ) );?>
</a>
				</li>
				<li class="">
					<a href="#other" data-toggle="tab"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'E-mail','mod'=>'pmcvg'),$_smarty_tpl ) );?>
</a>
				</li>
			</ul>
			<div class="tab-content panel">
				<div id="global" class="tab-pane active">
					<?php echo $_smarty_tpl->tpl_vars['globalform']->value;?>

				</div>
				<div id="general" class="tab-pane">
					<?php echo $_smarty_tpl->tpl_vars['bigform']->value;?>

				</div>
				<div id="other" class="tab-pane">
					<?php echo $_smarty_tpl->tpl_vars['emailform']->value;?>

				</div>
			</div>
		</div>
	</div>
</div><?php }
}
