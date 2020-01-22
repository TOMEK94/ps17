<?php
/* Smarty version 3.1.33, created on 2020-01-22 20:01:55
  from 'module:pmcvgviewstemplatesfrontm' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e289c23aaffa3_83288243',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e7b51fce460aa831b06504faed0fabc62578868f' => 
    array (
      0 => 'module:pmcvgviewstemplatesfrontm',
      1 => 1579718617,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e289c23aaffa3_83288243 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5383374335e289c23a7a886_55026359', 'page_title');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18704456395e289c23a7d217_59977587', 'page_content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'customer/page.tpl');
}
/* {block 'page_title'} */
class Block_5383374335e289c23a7a886_55026359 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_title' => 
  array (
    0 => 'Block_5383374335e289c23a7a886_55026359',
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
class Block_18704456395e289c23a7d217_59977587 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content' => 
  array (
    0 => 'Block_18704456395e289c23a7d217_59977587',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/vendor/smarty/smarty/libs/plugins/modifier.replace.php','function'=>'smarty_modifier_replace',),));
?>

<div class="privacymanagement">
	<div class="row">
		<div class="bigcontainer">
			<h3><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_1_TITLE'][$_smarty_tpl->tpl_vars['id_lang']->value], ENT_QUOTES, 'UTF-8');?>
</h3>
			<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_1_DESC_2'][$_smarty_tpl->tpl_vars['id_lang']->value], ENT_QUOTES, 'UTF-8');?>

			<hr />
				<div class="alert alert-danger">
					<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Remember, if you cancel some of your consents, you will not be able to shop in our store until you accept them again.','mod'=>'pmcvg'),$_smarty_tpl ) );?>

				</div>
				<h2><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Required consents','mod'=>'pmcvg'),$_smarty_tpl ) );?>
</h2>
				<table class="table">
					<thead>
						<tr>
							<th width="50%"><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Contents','mod'=>'pmcvg'),$_smarty_tpl ) );?>
</strong></th>
							<th width ="25%"><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Date of change','mod'=>'pmcvg'),$_smarty_tpl ) );?>
</strong></th>
							<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Actions','mod'=>'pmcvg'),$_smarty_tpl ) );?>
</th>
						</tr>
					</thead>
					<tbody>
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['consents']->value, 'consent');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['consent']->value) {
?>
						<?php if ($_smarty_tpl->tpl_vars['consent']->value['required'] && $_smarty_tpl->tpl_vars['consent']->value['page'] != 4 && $_smarty_tpl->tpl_vars['consent']->value['page'] != 3 && $_smarty_tpl->tpl_vars['consent']->value['page'] != 5) {?>
						<tr>
							<td><?php echo htmlspecialchars(smarty_modifier_replace(smarty_modifier_replace($_smarty_tpl->tpl_vars['consent']->value['text'],'<p>',''),'</p>',''), ENT_QUOTES, 'UTF-8');?>
</td>
							<td class="date"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['consent']->value['date_upd'], ENT_QUOTES, 'UTF-8');?>
</td>
							<td>
								<button class="cvg-button btn btn-default button-small button<?php if ($_smarty_tpl->tpl_vars['consent']->value['set']) {?>_enable<?php } else { ?>_disable<?php }?>" data-value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['consent']->value['id_pmcvg'], ENT_QUOTES, 'UTF-8');?>
">
									<?php if ($_smarty_tpl->tpl_vars['consent']->value['set']) {?>
										<span class="icon-remove"></span> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Deactivate consent','mod'=>'pmcvg'),$_smarty_tpl ) );?>

									<?php } else { ?>
										<span class="icon-check"></span> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Accept consent','mod'=>'pmcvg'),$_smarty_tpl ) );?>

									<?php }?>
								</button>
							</td>
						</tr>
						<?php }?>
					<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</tbody>
				</table>
				<h2><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Optional consents','mod'=>'pmcvg'),$_smarty_tpl ) );?>
</h2>				
					<table class="table">
						<thead>
							<tr>
								<th width="50%"><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Contents','mod'=>'pmcvg'),$_smarty_tpl ) );?>
</strong></th>
								<th width ="25%"><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Date of change','mod'=>'pmcvg'),$_smarty_tpl ) );?>
</strong></th>
								<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Actions','mod'=>'pmcvg'),$_smarty_tpl ) );?>
</th>
							</tr>
						</thead>
					<tbody>
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['consents']->value, 'consent');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['consent']->value) {
?>
						<?php if (!$_smarty_tpl->tpl_vars['consent']->value['required'] || $_smarty_tpl->tpl_vars['consent']->value['required'] && $_smarty_tpl->tpl_vars['consent']->value['page'] == 4 || $_smarty_tpl->tpl_vars['consent']->value['required'] && $_smarty_tpl->tpl_vars['consent']->value['page'] == 5) {?>
						<tr>
							<td><?php echo htmlspecialchars(smarty_modifier_replace(smarty_modifier_replace($_smarty_tpl->tpl_vars['consent']->value['text'],'<p>',''),'</p>',''), ENT_QUOTES, 'UTF-8');?>
</td>
							<td class="date"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['consent']->value['date_upd'], ENT_QUOTES, 'UTF-8');?>
</td>
							<td>
								<button class="cvg-button btn btn-default button-small button<?php if ($_smarty_tpl->tpl_vars['consent']->value['set']) {?>_enable<?php } else { ?>_disable<?php }?>" data-value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['consent']->value['id_pmcvg'], ENT_QUOTES, 'UTF-8');?>
">
									<?php if ($_smarty_tpl->tpl_vars['consent']->value['set']) {?>
										<span class="icon-remove"></span> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Deactivate consent','mod'=>'pmcvg'),$_smarty_tpl ) );?>

									<?php } else { ?>
										<span class="icon-check"></span> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Accept consent'),$_smarty_tpl ) );?>

									<?php }?>
								</button>
							</td>
						</tr>
						<?php }?>
					<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					</tbody>
				</table>
				<h2><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Additional consents','mod'=>'pmcvg'),$_smarty_tpl ) );?>
</h2>
				<table class="table">
					<thead>
							<tr>
								<th width="50%"><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Contents','mod'=>'pmcvg'),$_smarty_tpl ) );?>
</strong></th>
								<th width ="25%"><strong><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Date of change','mod'=>'pmcvg'),$_smarty_tpl ) );?>
</strong></th>
								<th><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Actions','mod'=>'pmcvg'),$_smarty_tpl ) );?>
</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Consent to receive the newsletter','mod'=>'pmcvg'),$_smarty_tpl ) );?>
</td>
							<td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['customer_opt']->value['newsletter_date_add'], ENT_QUOTES, 'UTF-8');?>
</td>
							<td>
								<button class="cvg-button btn btn-default button-small button<?php if ($_smarty_tpl->tpl_vars['customer_opt']->value['newsletter']) {?>_enable<?php } else { ?>_disable<?php }?>" data-value="newsletter">
									<?php if ($_smarty_tpl->tpl_vars['customer_opt']->value['newsletter']) {?>
										<span class="icon-remove"></span> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Deactivate consent','mod'=>'pmcvg'),$_smarty_tpl ) );?>

									<?php } else { ?>
										<span class="icon-check"></span> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Accept consent','mod'=>'pmcvg'),$_smarty_tpl ) );?>

									<?php }?>
								</button>
							</td>
						</tr>
						<tr>
							<td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Receive special offers from our partners','mod'=>'pmcvg'),$_smarty_tpl ) );?>
</td>
							<td class="date"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['customer_opt']->value['newsletter_date_add'], ENT_QUOTES, 'UTF-8');?>
</td>
							<td>
								<button class="cvg-button btn btn-default button-small button<?php if ($_smarty_tpl->tpl_vars['customer_opt']->value['optin']) {?>_enable<?php } else { ?>_disable<?php }?>" data-value="optin">
									<?php if ($_smarty_tpl->tpl_vars['customer_opt']->value['optin']) {?>
										<span class="icon-remove"></span> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Deactivate consent','mod'=>'pmcvg'),$_smarty_tpl ) );?>

									<?php } else { ?>
										<span class="icon-check"></span> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Accept consent','mod'=>'pmcvg'),$_smarty_tpl ) );?>

									<?php }?>
								</button>
							</td>
						</tr>
					</tbody>
				</table>
				<hr />
				<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_show']->value['PMCG_PAGE_1_DESC_3'][$_smarty_tpl->tpl_vars['id_lang']->value], ENT_QUOTES, 'UTF-8');?>

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
