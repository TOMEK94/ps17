<?php
/* Smarty version 3.1.33, created on 2020-01-22 19:55:21
  from '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/themes/jms_storm/modules/jmspagebuilder/views/templates/hook/addonblog_h8.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e289a993b6099_29723606',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '071fd137579126e8d75267903fc00025f6c12449' => 
    array (
      0 => '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/themes/jms_storm/modules/jmspagebuilder/views/templates/hook/addonblog_h8.tpl',
      1 => 1573058627,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e289a993b6099_29723606 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/vendor/smarty/smarty/libs/plugins/modifier.replace.php','function'=>'smarty_modifier_replace',),1=>array('file'=>'/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
echo '<script'; ?>
 type="text/javascript">	
	var blog_items = 3,
	    blog_itemsDesktop = <?php if ($_smarty_tpl->tpl_vars['items_show']->value) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['items_show']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>3<?php }?>,
	    blog_itemsDesktopSmall = <?php if ($_smarty_tpl->tpl_vars['items_show_md']->value) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['items_show_md']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>2<?php }?>,
	    blog_itemsTablet = <?php if ($_smarty_tpl->tpl_vars['items_show_sm']->value) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['items_show_sm']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>2<?php }?>,
	    blog_itemsMobile = <?php if ($_smarty_tpl->tpl_vars['items_show_xs']->value) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['items_show_xs']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');
} else { ?>1<?php }?>;
		var p_nav_blog = <?php if ($_smarty_tpl->tpl_vars['navigation']->value == 1) {?>true<?php } else { ?>false<?php }?>;
	    var p_pag_blog = <?php if ($_smarty_tpl->tpl_vars['pagination']->value == 1) {?>true<?php } else { ?>false<?php }?>;
		var auto_play_blog = <?php if ($_smarty_tpl->tpl_vars['autoplay']->value == 1) {?>true<?php } else { ?>false<?php }?>;
<?php echo '</script'; ?>
>
<?php if ($_smarty_tpl->tpl_vars['addon_title']->value) {?>
<div class="addon-title">
	<h3><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['addon_title']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</h3>
</div>
<?php }
if ($_smarty_tpl->tpl_vars['addon_desc']->value) {?>
<p class="addon-desc"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['addon_desc']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</p>
<?php }
if (count($_smarty_tpl->tpl_vars['posts']->value) > 0) {?>
<div class="blog-carousel">	
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['posts']->value, 'post');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['post']->value) {
?>				
		<?php $_smarty_tpl->_assignInScope('params', array('post_id'=>$_smarty_tpl->tpl_vars['post']->value['post_id'],'category_slug'=>$_smarty_tpl->tpl_vars['post']->value['category_alias'],'slug'=>$_smarty_tpl->tpl_vars['post']->value['alias']));?>
		<?php $_smarty_tpl->_assignInScope('catparams', array('category_id'=>$_smarty_tpl->tpl_vars['post']->value['category_id'],'slug'=>$_smarty_tpl->tpl_vars['post']->value['category_alias']));?>	
		<div class="blog-item">
			<?php if ($_smarty_tpl->tpl_vars['post']->value['link_video'] && ($_smarty_tpl->tpl_vars['show_media']->value == '1')) {?>
				<div class="post-thumb">
					<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value['link_video'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

					<?php if ($_smarty_tpl->tpl_vars['show_category']->value == '1') {?>
						<div class="category_name">
							<a href="<?php echo htmlspecialchars(smarty_modifier_replace(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( jmsblog::getPageLink('jmsblog-category',$_smarty_tpl->tpl_vars['catparams']->value),'htmlall','UTF-8' )),'&amp;','&'), ENT_QUOTES, 'UTF-8');?>
">
								<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value['category_name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

							</a>
						</div>
					<?php }?>
				</div>
			<?php } elseif ($_smarty_tpl->tpl_vars['post']->value['image'] && ($_smarty_tpl->tpl_vars['show_media']->value == '1')) {?>
				<div class="post-thumb">
					<a href="<?php echo htmlspecialchars(smarty_modifier_replace(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( jmsblog::getPageLink('jmsblog-post',$_smarty_tpl->tpl_vars['params']->value),'htmlall','UTF-8' )),'&amp;','&'), ENT_QUOTES, 'UTF-8');?>
">
						<img src="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['image_url']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value['image'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value['title'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" class="img-responsive" />
					</a>
					<?php if ($_smarty_tpl->tpl_vars['show_category']->value == '1') {?>
						<div class="category_name">
							<a href="<?php echo htmlspecialchars(smarty_modifier_replace(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( jmsblog::getPageLink('jmsblog-category',$_smarty_tpl->tpl_vars['catparams']->value),'htmlall','UTF-8' )),'&amp;','&'), ENT_QUOTES, 'UTF-8');?>
">
								<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value['category_name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

							</a>
						</div>
					<?php }?>
				</div>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['show_time']->value == '1') {?>
				<div class="time">
					<span class="day">
						<?php echo htmlspecialchars(smarty_modifier_date_format(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value['created'],'html','UTF-8' )),'%e'), ENT_QUOTES, 'UTF-8');?>

					</span>
					<span class="month">
						<?php echo htmlspecialchars(smarty_modifier_date_format(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value['created'],'html','UTF-8' )),'%b'), ENT_QUOTES, 'UTF-8');?>

					</span>
				</div>
			<?php }?>
			<div class="post-info">
				<h4 class="post-title">
					<a href="<?php echo htmlspecialchars(smarty_modifier_replace(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( jmsblog::getPageLink('jmsblog-post',$_smarty_tpl->tpl_vars['params']->value),'htmlall','UTF-8' )),'&amp;','&'), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['title'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value['title'],40,'...' )),'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</a>
				</h4>
				<ul class="post-meta">
					<?php if ($_smarty_tpl->tpl_vars['show_nviews']->value == '1') {?>
						<li>
							<span>
								<i class="fa fa-eye" aria-hidden="true" style="font-size: 15px;"></i>
								<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value['views'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Views','d'=>'Modules.JmsPagebuilder'),$_smarty_tpl ) );?>

							</span>
						</li>
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['show_ncomments']->value == '1') {?>		
						<li class="comment">
							<span>
								<i class="fa fa-comment-o" aria-hidden="true" style="font-size: 15px;"></i>
								<?php if ($_smarty_tpl->tpl_vars['post']->value['comment_count'] > 0) {?>
									(<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value['comment_count'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
) <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Comments','d'=>'Modules.JmsPagebuilder'),$_smarty_tpl ) );?>

								<?php } else { ?>
									(<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['post']->value['comment_count'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
) <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Comment','d'=>'Modules.JmsPagebuilder'),$_smarty_tpl ) );?>

								<?php }?>
							</span>
						</li>
					<?php }?>
				</ul>
				<?php if ($_smarty_tpl->tpl_vars['show_introtext']->value == '1') {?>	
					<div class="post-intro"><?php echo $_smarty_tpl->tpl_vars['post']->value['introtext'];?>
</div>	
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['show_readmore']->value == '1') {?>	
					<a class="post-readmore btn-hover" href="<?php echo htmlspecialchars(smarty_modifier_replace(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( jmsblog::getPageLink('jmsblog-post',$_smarty_tpl->tpl_vars['params']->value),'htmlall','UTF-8' )),'&amp;','&'), ENT_QUOTES, 'UTF-8');?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Read more','d'=>'Modules.JmsPagebuilder'),$_smarty_tpl ) );?>
</a>	
				<?php }?>
			</div>
		</div>		
	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>	
</div>	
<?php }?>	<?php }
}
