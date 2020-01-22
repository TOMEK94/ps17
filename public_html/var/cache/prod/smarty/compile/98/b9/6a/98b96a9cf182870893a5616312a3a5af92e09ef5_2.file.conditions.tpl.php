<?php
/* Smarty version 3.1.33, created on 2020-01-22 19:46:44
  from '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/modules/pmcvg/views/templates/front/17/conditions.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e28989473b279_20723810',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '98b96a9cf182870893a5616312a3a5af92e09ef5' => 
    array (
      0 => '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/modules/pmcvg/views/templates/front/17/conditions.tpl',
      1 => 1579718617,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e28989473b279_20723810 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/vendor/smarty/smarty/libs/plugins/modifier.replace.php','function'=>'smarty_modifier_replace',),));
if (sizeof($_smarty_tpl->tpl_vars['conditions']->value)) {?>
<div class="conditions_<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['conditions_name']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" style="<?php if ($_smarty_tpl->tpl_vars['conditions_name']->value != 'account') {?>display: none;<?php }?>">
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['conditions']->value, 'condition');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['condition']->value) {
?>
		<div class="form-group row ">
			<label class="col-md-3 form-control-label"></label>
			<div class="col-md-6">
			    <span class="custom-checkbox">
				  <input data-cvg="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['condition']->value['id_pmcvg'], ENT_QUOTES, 'UTF-8');?>
" name="conditions[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['condition']->value['id_pmcvg'], ENT_QUOTES, 'UTF-8');?>
]"<?php if (isset($_smarty_tpl->tpl_vars['selected_conditions']->value[$_smarty_tpl->tpl_vars['condition']->value['id_pmcvg']])) {?> checked="checked"<?php }?> class="cgv2<?php if ($_smarty_tpl->tpl_vars['condition']->value['required']) {?> requiredcvg<?php if ($_smarty_tpl->tpl_vars['conditions_name']->value == 'order') {?>order<?php }
}?>" type="checkbox" value="1">
	              <span><i class="material-icons rtl-no-flip checkbox-checked">&#xE5CA;</i></span>
				  <label><?php echo htmlspecialchars(smarty_modifier_replace(smarty_modifier_replace($_smarty_tpl->tpl_vars['condition']->value['text'],'<p>',''),'</p>',''), ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['condition']->value['required']) {?> <sup>*</sup><?php }?></label>
				</span>
			</div>
		</div>
	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</div>
<?php }
}
}
