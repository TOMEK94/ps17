<?php
/* Smarty version 3.1.33, created on 2020-01-22 20:01:29
  from 'module:pmcvgviewstemplatesfrontd' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e289c091bb5b1_67576424',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '28be6884ab903bef89a1a25d2ab48e3563833a84' => 
    array (
      0 => 'module:pmcvgviewstemplatesfrontd',
      1 => 1579718617,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e289c091bb5b1_67576424 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_11938465785e289c091aa282_35543836', 'page_title');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_10374665615e289c091ada03_81345808', 'page_content');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, 'customer/page.tpl');
}
/* {block 'page_title'} */
class Block_11938465785e289c091aa282_35543836 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_title' => 
  array (
    0 => 'Block_11938465785e289c091aa282_35543836',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_2_TITLE'][$_smarty_tpl->tpl_vars['id_lang']->value], ENT_QUOTES, 'UTF-8');?>

<?php
}
}
/* {/block 'page_title'} */
/* {block 'page_content'} */
class Block_10374665615e289c091ada03_81345808 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content' => 
  array (
    0 => 'Block_10374665615e289c091ada03_81345808',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<div class="row">
		<div class="col-md-12">
			<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_2_DESC_2'][$_smarty_tpl->tpl_vars['id_lang']->value], ENT_QUOTES, 'UTF-8');?>

			<div id="my-account">
				<a class="col-lg-4 col-md-6 col-sm-6 col-xs-12 pcontainer" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getPageLink('identity'),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
					<div class="link-item">
						<i class="pass-icon"></i>
						<span>
							<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Change password','mod'=>'pmcvg'),$_smarty_tpl ) );?>
</span>
						</span>
					</div>
				</a>
				<a class="col-lg-4 col-md-6 col-sm-6 col-xs-12 pcontainer" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getPageLink('addresses'),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
					<div class="link-item">
						<i class="adr-icon"></i>
						<span>
							<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Edit addresses','mod'=>'pmcvg'),$_smarty_tpl ) );?>
</span>
						</span>
					</div>
				</a>
				<a class="col-lg-4 col-md-6 col-sm-6 col-xs-12 pcontainer" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getPageLink('identity'),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
					<div class="link-item">
						<i class="per-icon"></i>
						<span>
							<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Edit personaldata','mod'=>'pmcvg'),$_smarty_tpl ) );?>
</span>
						</span>
					</div>
				</a>
		</ul>
		<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_2_DESC_3'][$_smarty_tpl->tpl_vars['id_lang']->value], ENT_QUOTES, 'UTF-8');?>

		</div>
		<a class="btn btn-default button button-small" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getModuleLink('pmcvg','privacymanagement',array(),true),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Privacy management','mod'=>'pmcvg'),$_smarty_tpl ) );?>
 class="btn btn-default button button-small"><span><i class="icon-chevron-left"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Return to privacy management','mod'=>'pmcvg'),$_smarty_tpl ) );?>
</span>
    </a>
	</div>
<?php
}
}
/* {/block 'page_content'} */
}
