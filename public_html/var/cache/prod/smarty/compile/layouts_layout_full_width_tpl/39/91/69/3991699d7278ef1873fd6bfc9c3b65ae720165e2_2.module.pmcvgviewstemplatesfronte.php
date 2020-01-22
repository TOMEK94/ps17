<?php
/* Smarty version 3.1.33, created on 2020-01-22 20:02:52
  from 'module:pmcvgviewstemplatesfronte' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e289c5c5a28e7_55482865',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3991699d7278ef1873fd6bfc9c3b65ae720165e2' => 
    array (
      0 => 'module:pmcvgviewstemplatesfronte',
      1 => 1579718617,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e289c5c5a28e7_55482865 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_19371421905e289c5c5913b2_22137442', 'page_header_container');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8755828265e289c5c591ef4_53169523', 'page_content');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_header_container'} */
class Block_19371421905e289c5c5913b2_22137442 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_header_container' => 
  array (
    0 => 'Block_19371421905e289c5c5913b2_22137442',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_header_container'} */
/* {block 'page_content'} */
class Block_8755828265e289c5c591ef4_53169523 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content' => 
  array (
    0 => 'Block_8755828265e289c5c591ef4_53169523',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="privacymanagement">
	<div class="row">
			<h3><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_3_TITLE'][$_smarty_tpl->tpl_vars['id_lang']->value], ENT_QUOTES, 'UTF-8');?>
</h3>
		<div class="privacymanagement">
			<hr />
			<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_3_DESC_2'][$_smarty_tpl->tpl_vars['id_lang']->value], ENT_QUOTES, 'UTF-8');?>

			<ul>
				<li class="col-md-4">
					<div class="pcontainer">
						<div class="pcontainerboxexport">							
							<span class="xml-icon"></span>
							<a class="download" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getModuleLink('pmcvg','export?format=xml',array(),true),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">Pobierz plik w formacie XML</a>
						</div>
					</div>
				</li>
				<li class="col-md-4">
					<div class="pcontainer">
						<div class="pcontainerboxexport">
							<span class="csv-icon"></span>
							<a class="download"  href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getModuleLink('pmcvg','export?format=csv',array(),true),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">Pobierz plik w formacie CSV</a>
						</div>
					</div>
				</li>
				<li class="col-md-4">
					<div class="pcontainer">
						<div class="pcontainerboxexport">
							<span class="json-icon"></span>
							<a class="download"  href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getModuleLink('pmcvg','export?format=json',array(),true),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">Pobierz plik w formacie JSON</a>
						</div>
					</div>\
				</li>
			</ul>
		</div>
		<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_3_DESC_3'][$_smarty_tpl->tpl_vars['id_lang']->value], ENT_QUOTES, 'UTF-8');?>

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
