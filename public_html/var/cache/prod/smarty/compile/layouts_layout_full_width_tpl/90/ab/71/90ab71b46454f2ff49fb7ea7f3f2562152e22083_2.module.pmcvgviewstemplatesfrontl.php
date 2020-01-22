<?php
/* Smarty version 3.1.33, created on 2020-01-22 20:01:44
  from 'module:pmcvgviewstemplatesfrontl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e289c18a2f163_79154937',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '90ab71b46454f2ff49fb7ea7f3f2562152e22083' => 
    array (
      0 => 'module:pmcvgviewstemplatesfrontl',
      1 => 1579718617,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e289c18a2f163_79154937 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8317096075e289c18a24476_38516979', 'page_header_container');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_9354528365e289c18a24fa6_96068771', 'page_content');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_header_container'} */
class Block_8317096075e289c18a24476_38516979 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_header_container' => 
  array (
    0 => 'Block_8317096075e289c18a24476_38516979',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_header_container'} */
/* {block 'page_content'} */
class Block_9354528365e289c18a24fa6_96068771 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content' => 
  array (
    0 => 'Block_9354528365e289c18a24fa6_96068771',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="privacymanagement">
	<div class="row">
		<div class="col-md-12 bigcontainer">
		<h3><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_7_TITLE'][$_smarty_tpl->tpl_vars['id_lang']->value], ENT_QUOTES, 'UTF-8');?>
</h3>
			<hr />
			<div class="p">
				<div class="text-center">
					<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_7_DESC_2'][$_smarty_tpl->tpl_vars['id_lang']->value], ENT_QUOTES, 'UTF-8');?>

				</div>
			</div>
		</div>
	</div>
	<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_7_DESC_3'][$_smarty_tpl->tpl_vars['id_lang']->value], ENT_QUOTES, 'UTF-8');?>

	<a class="btn btn-default button button-small" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getModuleLink('pmcvg','privacymanagement',array(),true),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Privacy management','mod'=>'pmcvg'),$_smarty_tpl ) );?>
 class="btn btn-default button button-small">
        <span><i class="icon-chevron-left"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Return to privacy management','mod'=>'pmcvg'),$_smarty_tpl ) );?>
</span>
    </a>
</div>
<?php
}
}
/* {/block 'page_content'} */
}
