<?php
/* Smarty version 3.1.33, created on 2020-01-22 19:46:44
  from '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/themes/jms_storm/modules/jmsmegamenu/views/templates/hook/jmsmegamenu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e289894863109_87792056',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '59b66a62cb79922fcaad19de0bd6c762a1ac1aa2' => 
    array (
      0 => '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/themes/jms_storm/modules/jmsmegamenu/views/templates/hook/jmsmegamenu.tpl',
      1 => 1573058627,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e289894863109_87792056 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="jms-megamenu-wrap">
	<a id="open-button" class="open-button hidden-lg hidden-md" href="#"></a>
	<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['menu_html']->value,'' ));?>

</div>
<?php echo '<script'; ?>
 type="text/javascript">
	var jmmm_event = '<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['JMSMM_MOUSEEVENT']->value, ENT_QUOTES, 'UTF-8');?>
';
	var jmmm_duration = <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['JMSMM_DURATION']->value, ENT_QUOTES, 'UTF-8');?>
;	
<?php echo '</script'; ?>
><?php }
}
