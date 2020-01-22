<?php
/* Smarty version 3.1.33, created on 2020-01-22 20:01:26
  from 'module:pmcvgviewstemplatesfrontp' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e289c06d304a4_94843367',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ea1ce008cf54db62d60bf0f0198456ed7742d856' => 
    array (
      0 => 'module:pmcvgviewstemplatesfrontp',
      1 => 1579718617,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e289c06d304a4_94843367 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_12231595065e289c06cfc6f9_09844553', 'page_title');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_75403825e289c06cff3f7_66661579', 'page_content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'customer/page.tpl');
}
/* {block 'page_title'} */
class Block_12231595065e289c06cfc6f9_09844553 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_title' => 
  array (
    0 => 'Block_12231595065e289c06cfc6f9_09844553',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Privacy management','mod'=>'pmcvg'),$_smarty_tpl ) );?>

<?php
}
}
/* {/block 'page_title'} */
/* {block 'page_content'} */
class Block_75403825e289c06cff3f7_66661579 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content' => 
  array (
    0 => 'Block_75403825e289c06cff3f7_66661579',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/vendor/smarty/smarty/libs/plugins/modifier.replace.php','function'=>'smarty_modifier_replace',),));
?>

  <div class="row">
    <div class="links">
		<?php if ($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_1_ENABLE']) {?>
			<a class="col-lg-3 col-md-6 col-sm-6 col-xs-12 pcontainer" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getModuleLink('pmcvg','myconsents',array(),true),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
				<div class="link-item2">
				<i class="icon-cvg-1"></i> 
				<span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_1_TITLE'][$_smarty_tpl->tpl_vars['id_lang']->value], ENT_QUOTES, 'UTF-8');?>

					<p>
						<?php echo htmlspecialchars(smarty_modifier_replace(smarty_modifier_replace($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_1_DESC_1'][$_smarty_tpl->tpl_vars['id_lang']->value],'<p>',''),'</p>',''), ENT_QUOTES, 'UTF-8');?>

					</p>
				</span>
			</div>
			</a>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_2_ENABLE']) {?>
				<a class="col-lg-3 col-md-6 col-sm-6 col-xs-12 pcontainer" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getModuleLink('pmcvg','data',array(),true),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
					<div class="link-item2">
					<i class="icon-cvg-2"></i>
					<span>
							<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_2_TITLE'][$_smarty_tpl->tpl_vars['id_lang']->value], ENT_QUOTES, 'UTF-8');?>

						<p>
							<?php echo htmlspecialchars(smarty_modifier_replace(smarty_modifier_replace($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_2_DESC_1'][$_smarty_tpl->tpl_vars['id_lang']->value],'<p>',''),'</p>',''), ENT_QUOTES, 'UTF-8');?>

						</p>
					</span>
				</div>
				</a>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_3_ENABLE']) {?>
			<a class="col-lg-3 col-md-6 col-sm-6 col-xs-12 pcontainer" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getModuleLink('pmcvg','export',array(),true),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
				<div class="link-item2">
				<i class="icon-cvg-3"></i>
					<span>
							<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_3_TITLE'][$_smarty_tpl->tpl_vars['id_lang']->value], ENT_QUOTES, 'UTF-8');?>

						<p>
							<?php echo htmlspecialchars(smarty_modifier_replace(smarty_modifier_replace($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_3_DESC_1'][$_smarty_tpl->tpl_vars['id_lang']->value],'<p>',''),'</p>',''), ENT_QUOTES, 'UTF-8');?>

						</p>
					</span>
				</div>
			</a>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_4_ENABLE']) {?>
			<a class="col-lg-3 col-md-6 col-sm-6 col-xs-12 pcontainer" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getModuleLink('pmcvg','anonimize',array(),true),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
				<div class="link-item2">
				<i class="icon-cvg-4"></i>
					<span>
							<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_4_TITLE'][$_smarty_tpl->tpl_vars['id_lang']->value], ENT_QUOTES, 'UTF-8');?>

						<p>
							<?php echo htmlspecialchars(smarty_modifier_replace(smarty_modifier_replace($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_4_DESC_1'][$_smarty_tpl->tpl_vars['id_lang']->value],'<p>',''),'</p>',''), ENT_QUOTES, 'UTF-8');?>

						</p>
					</span>
				</div>
			</a>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_5_ENABLE']) {?>
				<a class="col-lg-3 col-md-6 col-sm-6 col-xs-12 pcontainer" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getModuleLink('pmcvg','remove',array(),true),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
					<div class="link-item2">
					<i class="icon-cvg-5"></i>
					<span>
							<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_5_TITLE'][$_smarty_tpl->tpl_vars['id_lang']->value], ENT_QUOTES, 'UTF-8');?>

						<p>
							<?php echo htmlspecialchars(smarty_modifier_replace(smarty_modifier_replace($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_5_DESC_1'][$_smarty_tpl->tpl_vars['id_lang']->value],'<p>',''),'</p>',''), ENT_QUOTES, 'UTF-8');?>

						</p>
					</span>
				</div>
				</a>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_6_ENABLE']) {?>
			<a class="col-lg-3 col-md-6 col-sm-6 col-xs-12 pcontainer" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getModuleLink('pmcvg','information',array(),true),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
				<div class="link-item2">
				<i class="icon-cvg-6"></i>
					<span>
							<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_6_TITLE'][$_smarty_tpl->tpl_vars['id_lang']->value], ENT_QUOTES, 'UTF-8');?>

						<p>
							<?php echo htmlspecialchars(smarty_modifier_replace(smarty_modifier_replace($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_6_DESC_1'][$_smarty_tpl->tpl_vars['id_lang']->value],'<p>',''),'</p>',''), ENT_QUOTES, 'UTF-8');?>

						</p>
					</span>
				</div>
			</a>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_7_ENABLE']) {?>
			<a class="col-lg-3 col-md-6 col-sm-6 col-xs-12 pcontainer" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getModuleLink('pmcvg','leak',array(),true),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
				<div class="link-item2">
				<i class="icon-cvg-7"></i>
					<span>
							<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_7_TITLE'][$_smarty_tpl->tpl_vars['id_lang']->value], ENT_QUOTES, 'UTF-8');?>

						<p>
							<?php echo htmlspecialchars(smarty_modifier_replace(smarty_modifier_replace($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_7_DESC_1'][$_smarty_tpl->tpl_vars['id_lang']->value],'<p>',''),'</p>',''), ENT_QUOTES, 'UTF-8');?>

						</p>
					</span>
				</div>
			</a>
		<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_8_ENABLE']) {?>
			<a class="col-lg-3 col-md-6 col-sm-6 col-xs-12 pcontainer" href="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getModuleLink('pmcvg','processing',array(),true),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
				<div class="link-item2">
				<i class="icon-cvg-8"></i>
					<span>
							<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_8_TITLE'][$_smarty_tpl->tpl_vars['id_lang']->value], ENT_QUOTES, 'UTF-8');?>

						<p>
							<?php echo htmlspecialchars(smarty_modifier_replace(smarty_modifier_replace($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_8_DESC_1'][$_smarty_tpl->tpl_vars['id_lang']->value],'<p>',''),'</p>',''), ENT_QUOTES, 'UTF-8');?>

						</p>
					</span>
				</div>
			</a>
		<?php }?>
	</div>
</div>
<?php
}
}
/* {/block 'page_content'} */
}
