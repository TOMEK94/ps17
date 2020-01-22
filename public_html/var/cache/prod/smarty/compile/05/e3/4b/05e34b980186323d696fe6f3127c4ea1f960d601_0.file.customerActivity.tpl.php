<?php
/* Smarty version 3.1.33, created on 2020-01-22 19:44:45
  from '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/modules/psgdpr/views/templates/admin/tabs/customerActivity.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e28981d9dbe32_94142453',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '05e34b980186323d696fe6f3127c4ea1f960d601' => 
    array (
      0 => '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/modules/psgdpr/views/templates/admin/tabs/customerActivity.tpl',
      1 => 1572031113,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e28981d9dbe32_94142453 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="panel col-lg-10 right-panel">
    <h3>
        <i class="fa fa-list"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Customer activity list','mod'=>'psgdpr'),$_smarty_tpl ) );?>
 <small><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['module_display']->value,'htmlall','UTF-8' ));?>
</small>
    </h3>
    <p>
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Keep track of your customer activity related to data accessibility, consent and erasure.','mod'=>'psgdpr'),$_smarty_tpl ) );?>

    </p>
    <br>
    <div>
        <table id="customerLog" class="table table-striped table-bordered">
            <thead>
                <tr class="table-header">
                    <th class="text-center"><b><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Client name/ID','mod'=>'psgdpr'),$_smarty_tpl ) );?>
</b></th>
                    <th class="text-center"><b><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Type of request','mod'=>'psgdpr'),$_smarty_tpl ) );?>
</b></th>
                    <th class="text-center"><b><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Submission date','mod'=>'psgdpr'),$_smarty_tpl ) );?>
</b></th>
                </tr>
            </thead>
            <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['logs']->value, 'log');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['log']->value) {
?>
                <tr>
                    <td class="text-center"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['log']->value['client_name'],'htmlall','UTF-8' ));?>
</td>
                    <?php if ($_smarty_tpl->tpl_vars['log']->value['request_type'] == 1) {?>
                    <td class="text-center"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Consent confirmation','mod'=>'psgdpr'),$_smarty_tpl ) );?>
</td>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['log']->value['request_type'] == 2) {?>
                    <td class="text-center"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Accessibility','mod'=>'psgdpr'),$_smarty_tpl ) );?>
 (pdf)</td>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['log']->value['request_type'] == 3) {?>
                    <td class="text-center"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Accessibility','mod'=>'psgdpr'),$_smarty_tpl ) );?>
 (csv)</td>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['log']->value['request_type'] == 4) {?>
                    <td class="text-center"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Erasure','mod'=>'psgdpr'),$_smarty_tpl ) );?>
</td>
                    <?php }?>
                    <td class="text-center"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['log']->value['date_add'],'htmlall','UTF-8' ));?>
</td>
                </tr>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </tbody>
        </table>
    </div>
</div>
<?php }
}
