<?php
/* Smarty version 3.1.33, created on 2020-01-22 19:55:21
  from '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/themes/jms_storm/modules/jmspagebuilder/views/templates/hook/jmspagebuilder_body.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e289a994147c6_26381342',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e9f744833f1a71c264039498742ec05d79ab898a' => 
    array (
      0 => '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/themes/jms_storm/modules/jmspagebuilder/views/templates/hook/jmspagebuilder_body.tpl',
      1 => 1573058627,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e289a994147c6_26381342 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rows']->value, 'row');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
?>
	<div class="jms-row<?php if (isset($_smarty_tpl->tpl_vars['row']->value->settings->custom_class) && $_smarty_tpl->tpl_vars['row']->value->settings->custom_class) {?> <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['row']->value->settings->custom_class,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>" 
		<?php if (isset($_smarty_tpl->tpl_vars['row']->value->settings->background_img) && $_smarty_tpl->tpl_vars['row']->value->settings->background_img) {?>style="
		<?php if (isset($_smarty_tpl->tpl_vars['row']->value->settings->background_img) && $_smarty_tpl->tpl_vars['row']->value->settings->background_img) {?>background-image:url('<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['root_url']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['row']->value->settings->background_img,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
');
		<?php }?>
		<?php if (isset($_smarty_tpl->tpl_vars['row']->value->settings->background_size) && $_smarty_tpl->tpl_vars['row']->value->settings->background_size) {?>background-size:<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['row']->value->settings->background_size,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
;
		<?php }?>
		<?php if (isset($_smarty_tpl->tpl_vars['row']->value->settings->background_attachment) && $_smarty_tpl->tpl_vars['row']->value->settings->background_attachment) {?>background-attachment:<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['row']->value->settings->background_attachment,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
;
		<?php }?>
		<?php if (isset($_smarty_tpl->tpl_vars['row']->value->settings->background_repeat) && $_smarty_tpl->tpl_vars['row']->value->settings->background_repeat) {?>background-repeat:<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['row']->value->settings->background_repeat,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
;
		<?php }?>
		<?php if (isset($_smarty_tpl->tpl_vars['row']->value->settings->background_position) && $_smarty_tpl->tpl_vars['row']->value->settings->background_position) {?>background-position:<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['row']->value->settings->background_position,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
;
		<?php }?>"
		<?php }?>>
		<?php if (isset($_smarty_tpl->tpl_vars['row']->value->settings->fluid) && $_smarty_tpl->tpl_vars['row']->value->settings->fluid == '0') {?>
			<div class="container">
		<?php } else { ?>
			<div class="container-fluid">
		<?php }?>
		<div class="row">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['row']->value->cols, 'column', false, 'cindex');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cindex']->value => $_smarty_tpl->tpl_vars['column']->value) {
?>
			<div class="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['column']->value->className,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
if (isset($_smarty_tpl->tpl_vars['column']->value->settings->custom_class) && $_smarty_tpl->tpl_vars['column']->value->settings->custom_class) {?> <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['column']->value->settings->custom_class,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>" style="
			<?php if (isset($_smarty_tpl->tpl_vars['column']->value->settings->background_img) && $_smarty_tpl->tpl_vars['column']->value->settings->background_img) {?>
				background-image:url('<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['root_url']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['column']->value->settings->background_img,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
');
			<?php }?>
			<?php if (isset($_smarty_tpl->tpl_vars['row']->value->settings->background_repeat) && $_smarty_tpl->tpl_vars['row']->value->settings->background_repeat) {?>
				background-repeat:<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['row']->value->settings->background_repeat,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
;
			<?php }?>
			<?php if (isset($_smarty_tpl->tpl_vars['column']->value->settings->background_size) && $_smarty_tpl->tpl_vars['column']->value->settings->background_size) {?>background-size:<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['column']->value->settings->background_size,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
;<?php }
if (isset($_smarty_tpl->tpl_vars['column']->value->settings->background_attachment) && $_smarty_tpl->tpl_vars['column']->value->settings->background_attachment) {?>background-attachment:<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['column']->value->settings->background_attachment,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
;<?php }
if (isset($_smarty_tpl->tpl_vars['column']->value->settings->background_position) && $_smarty_tpl->tpl_vars['column']->value->settings->background_position) {?>background-position:<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['column']->value->settings->background_position,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
;<?php }?>">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['column']->value->addons, 'addon', false, 'aindex');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['aindex']->value => $_smarty_tpl->tpl_vars['addon']->value) {
?>
					<div class="addon-box">
						<?php if (isset($_smarty_tpl->tpl_vars['addon']->value->return_value) && $_smarty_tpl->tpl_vars['addon']->value->return_value) {
echo $_smarty_tpl->tpl_vars['addon']->value->return_value;
}?>
					</div>
				<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</div>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</div>
		</div>
	</div>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
