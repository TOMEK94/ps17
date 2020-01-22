<?php
/* Smarty version 3.1.33, created on 2020-01-22 20:03:07
  from 'module:pmcvgviewstemplatesfronti' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e289c6bb19a92_30503391',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd341d91aaee643a4a6034b8572c2071bc066ad9d' => 
    array (
      0 => 'module:pmcvgviewstemplatesfronti',
      1 => 1579718617,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e289c6bb19a92_30503391 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20168674375e289c6bb0e958_03629051', 'page_header_container');
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_20757007105e289c6bb0f470_71298543', 'page_content');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_header_container'} */
class Block_20168674375e289c6bb0e958_03629051 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_header_container' => 
  array (
    0 => 'Block_20168674375e289c6bb0e958_03629051',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_header_container'} */
/* {block 'page_content'} */
class Block_20757007105e289c6bb0f470_71298543 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content' => 
  array (
    0 => 'Block_20757007105e289c6bb0f470_71298543',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="privacymanagement">
	<div class="row">
		<div class="col-md-12 bigcontainer">
		<h3><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_6_TITLE'][$_smarty_tpl->tpl_vars['id_lang']->value], ENT_QUOTES, 'UTF-8');?>
</h3>
			<hr />
			<div class="p">
				<div class="text-center">
					<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_6_DESC_2'][$_smarty_tpl->tpl_vars['id_lang']->value], ENT_QUOTES, 'UTF-8');?>
	
				</div>
			</div>
		</div>
		<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_6_DESC_3'][$_smarty_tpl->tpl_vars['id_lang']->value], ENT_QUOTES, 'UTF-8');?>

		<a class="btn btn-default button button-small" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getModuleLink('pmcvg','privacymanagement',array(),true),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Privacy management','mod'=>'pmcvg'),$_smarty_tpl ) );?>
 class="btn btn-default button button-small">
        <span><i class="icon-chevron-left"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Return to privacy management','mod'=>'pmcvg'),$_smarty_tpl ) );?>
</span>
    </a>
	</div>
</div>
<?php
}
}
/* {/block 'page_content'} */
}
