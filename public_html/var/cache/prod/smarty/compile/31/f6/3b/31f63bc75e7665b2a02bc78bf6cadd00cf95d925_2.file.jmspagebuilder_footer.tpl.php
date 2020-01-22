<?php
/* Smarty version 3.1.33, created on 2020-01-22 19:46:44
  from '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/themes/jms_storm/modules/jmspagebuilder/views/templates/hook/jmspagebuilder_footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e2898949ca223_43141395',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '31f63bc75e7665b2a02bc78bf6cadd00cf95d925' => 
    array (
      0 => '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/themes/jms_storm/modules/jmspagebuilder/views/templates/hook/jmspagebuilder_footer.tpl',
      1 => 1573058627,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e2898949ca223_43141395 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['rows']->value, 'row');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
?>
	<div class="jms-row<?php if (isset($_smarty_tpl->tpl_vars['row']->value->settings->custom_class) && $_smarty_tpl->tpl_vars['row']->value->settings->custom_class) {?> <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['row']->value->settings->custom_class,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>" <?php if (isset($_smarty_tpl->tpl_vars['row']->value->settings->background_img) && $_smarty_tpl->tpl_vars['row']->value->settings->background_img) {?>style="<?php if (isset($_smarty_tpl->tpl_vars['row']->value->settings->background_img) && $_smarty_tpl->tpl_vars['row']->value->settings->background_img) {?>background-image:url('<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['root_url']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['row']->value->settings->background_img,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
');<?php }
if (isset($_smarty_tpl->tpl_vars['row']->value->settings->background_size) && $_smarty_tpl->tpl_vars['row']->value->settings->background_size) {?>background-size:<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['row']->value->settings->background_size,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
;<?php }
if (isset($_smarty_tpl->tpl_vars['row']->value->settings->background_attachment) && $_smarty_tpl->tpl_vars['row']->value->settings->background_attachment) {?>background-attachment:<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['row']->value->settings->background_attachment,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
;<?php }
if (isset($_smarty_tpl->tpl_vars['row']->value->settings->background_position) && $_smarty_tpl->tpl_vars['row']->value->settings->background_position) {?>background-position:<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['row']->value->settings->background_position,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
;<?php }?>"<?php }?>>
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
}?>" style="<?php if (isset($_smarty_tpl->tpl_vars['column']->value->settings->background_img) && $_smarty_tpl->tpl_vars['column']->value->settings->background_img) {?>background-image:url('<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['root_url']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['column']->value->settings->background_img,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
');<?php }
if (isset($_smarty_tpl->tpl_vars['column']->value->settings->background_size) && $_smarty_tpl->tpl_vars['column']->value->settings->background_size) {?>background-size:<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['column']->value->settings->background_size,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
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
if ($_smarty_tpl->tpl_vars['settingpanel']->value) {?>
<div id="jmstools" class="jmsclose hidden-xs hidden-sm">
	<a id="jmstools-arrow" class="pull-right"><i class="fa fa-cog"></i></a>
	<div id="jmstools-content" class="pull-left">
		<form action="index.php" method="POST">
			<?php if (count($_smarty_tpl->tpl_vars['themeskins']->value) > 0) {?>
			<div class="form-group">
				<label class="form-label">Theme Skin</label>
					<a class="skin-box <?php if ($_smarty_tpl->tpl_vars['jpb_skin']->value == 'default' || $_smarty_tpl->tpl_vars['jpb_skin']->value == '') {?>active<?php }?>" title="Default">
					<img src="themes/<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['themename']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
/assets/img/skin-icons/default.png" alt="Default" />
					</a>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['themeskins']->value, 'sk');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sk']->value) {
?>
					<a class="skin-box <?php ob_start();
echo htmlspecialchars($_smarty_tpl->tpl_vars['sk']->value, ENT_QUOTES, 'UTF-8');
$_prefixVariable1 = ob_get_clean();
if ($_smarty_tpl->tpl_vars['jpb_skin']->value == $_prefixVariable1) {?>active<?php }?>" title="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['sk']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" data-color="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['sk']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
					<img src="themes/<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['themename']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
/assets/img/skin-icons/<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['sk']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
.png" alt="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['sk']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" />
					</a>
				<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</div>
			<?php }?>
			<?php if (isset($_smarty_tpl->tpl_vars['homepages']->value) && count($_smarty_tpl->tpl_vars['homepages']->value) > 1) {?>
			<div class="form-group">
					<label>Home Page</label>
					<select name="jpb_homepage" id="jmshomepage">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['homepages']->value, 'hp');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['hp']->value) {
?>
						<option value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['hp']->value['id_homepage'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" <?php ob_start();
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['hp']->value['id_homepage'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
$_prefixVariable2 = ob_get_clean();
if ($_smarty_tpl->tpl_vars['jpb_homepage']->value == $_prefixVariable2) {?>selected="selected"<?php }?>><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['hp']->value['title'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</option>
					<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</select>
			</div>
			<?php }?>
			<?php if (isset($_smarty_tpl->tpl_vars['producthovers']->value)) {?>
			<div class="form-group">
					<label>Product Box Hover</label>
					<select name="jpb_phover" id="jmsphover">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['producthovers']->value, 'ph', false, 'phkey');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['phkey']->value => $_smarty_tpl->tpl_vars['ph']->value) {
?>
						<option value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['phkey']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" <?php ob_start();
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['phkey']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
$_prefixVariable3 = ob_get_clean();
if ($_smarty_tpl->tpl_vars['jpb_phover']->value == $_prefixVariable3) {?>selected="selected"<?php }?>><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['ph']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</option>
					<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</select>
			</div>
			<?php }?>
			<div class="form-group">
				<label>Product Box Color Pick</label>
				<select name="jpb_pcolor">
					<option value="1" <?php if ($_smarty_tpl->tpl_vars['jpb_pcolor']->value == '1') {?>selected="selected"<?php }?>>Show</option>
					<option value="0" <?php if ($_smarty_tpl->tpl_vars['jpb_pcolor']->value == '0') {?>selected="selected"<?php }?>>Hide</option>
				</select>
			</div>
			<div class="form-group">
				<label>Direction</label>
				<select name="jpb_rtl">
					<option value="0" <?php if ($_smarty_tpl->tpl_vars['jpb_rtl']->value == '0') {?>selected="selected"<?php }?>>LTR</option>
					<option value="1" <?php if ($_smarty_tpl->tpl_vars['jpb_rtl']->value == '1') {?>selected="selected"<?php }?>>RTL</option>
				</select>
			</div>
			<input id="jmsskin" type="hidden" name="jpb_skin" value="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['jpb_skin']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" />

			<div class="form-group btn-action">
				<button type="submit" class="btn" name="apply" value="1">Apply</button>
				<a class="btn" href="index.php?settingreset=1">Reset</a>
			</div>
			<input type="hidden" name="settingpanel" value="1" />
		</form>
	</div>
</div>
<?php }
}
}
