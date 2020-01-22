<?php
/* Smarty version 3.1.33, created on 2020-01-22 20:02:08
  from 'module:pmcvgviewstemplatesfronta' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e289c304b2dc5_13541358',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f0875f0d6e0e4cd658ecbc2424e8785567aaaace' => 
    array (
      0 => 'module:pmcvgviewstemplatesfronta',
      1 => 1579718617,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e289c304b2dc5_13541358 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7291186365e289c304a2098_31622282', 'page_title');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_14738151555e289c304a49a8_09787509', 'page_content');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_title'} */
class Block_7291186365e289c304a2098_31622282 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_title' => 
  array (
    0 => 'Block_7291186365e289c304a2098_31622282',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Anonimize','mod'=>'pmcvg'),$_smarty_tpl ) );?>

<?php
}
}
/* {/block 'page_title'} */
/* {block 'page_content'} */
class Block_14738151555e289c304a49a8_09787509 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content' => 
  array (
    0 => 'Block_14738151555e289c304a49a8_09787509',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="privacymanagement">
	<div class="row">
		<div class="col-md-12 bigcontainer">
		<h3><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_4_TITLE'][$_smarty_tpl->tpl_vars['id_lang']->value], ENT_QUOTES, 'UTF-8');?>
</h3>
		<hr />
		<?php if ($_smarty_tpl->tpl_vars['confirmation']->value == true) {?>
			<div class="p">
				<div class="text-center">
					<div class="alert alert-success" role="alert">
						<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You have sent an anonymization request, the confirmation has been sent to the e-mail.','mod'=>'pmcvg'),$_smarty_tpl ) );?>

					</div>
				</div>
			</div>
		<?php } else { ?>
			<div class="p">
				<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_4_DESC_2'][$_smarty_tpl->tpl_vars['id_lang']->value], ENT_QUOTES, 'UTF-8');?>

				<div class="text-center">
					<a id="removemydata" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getModuleLink('pmcvg','anonimize',array(),true),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
?process=1" class="btn btn-primary"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Confirm anonimization data','mod'=>'pmcvg'),$_smarty_tpl ) );?>
</a>
				</div>
				<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_4_DESC_3'][$_smarty_tpl->tpl_vars['id_lang']->value], ENT_QUOTES, 'UTF-8');?>

			</div>
		<?php }?>
		</div>
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
