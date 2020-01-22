<?php
/* Smarty version 3.1.33, created on 2020-01-22 19:55:21
  from '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/themes/jms_storm/modules/jmspagebuilder/views/templates/hook/addonsliderlayer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5e289a99265553_46976319',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e2b8529667029f88caf89be0677bb2926c7ce200' => 
    array (
      0 => '/home/krulove24/domains/pagedesign.pl/public_html/bizneselektroniczny/themes/jms_storm/modules/jmspagebuilder/views/templates/hook/addonsliderlayer.tpl',
      1 => 1573058627,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5e289a99265553_46976319 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="jms-slider-wrapper">
	<div class="responisve-container">
		<div class="slider" >
		<div class="fs_loader"></div>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['slides']->value, 'slide');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['slide']->value) {
?>
			<div class="slide <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['slide']->value['class_suffix'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" style="background:<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['slide']->value['bg_color'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 url(<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['image_url']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
slides/<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['slide']->value['bg_image'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
) no-repeat left top;background-size:cover;" <?php if ($_smarty_tpl->tpl_vars['slide']->value['slide_link']) {?>onclick="document.location='<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['slide']->value['slide_link'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
';"<?php }?>>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['slide']->value['layers'], 'layer');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['layer']->value) {
?>
					<?php if ($_smarty_tpl->tpl_vars['layer']->value['data_type'] == 'text') {?>
					<div class="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_class_suffix'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 jms-slide-content" 
					<?php if ($_smarty_tpl->tpl_vars['layer']->value['data_fixed']) {?>data-fixed<?php }?> 
					data-position="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_y'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_x'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" 
					data-fontsize = "<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_font_size'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
					<?php if ($_smarty_tpl->tpl_vars['layer']->value['data_line_height']) {?>
					data-lineheight = "<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_line_height'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
px"
					<?php }?>
					data-in="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_in'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" 
					data-out="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_out'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" 
					data-delay="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_delay'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" 
					data-ease-in="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_ease_in'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" 
					data-ease-out="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_ease_out'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" 
					data-step="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_step'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" 
					data-special="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_special'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
					data-time = "<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_time'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
					style="font-size: <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_font_size'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
px; font-style:<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_style'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
; color: <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_color'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
; line-height:<?php if ($_smarty_tpl->tpl_vars['layer']->value['data_line_height']) {
echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_line_height'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
px<?php }?>;"					
					><?php echo $_smarty_tpl->tpl_vars['layer']->value['data_html'];?>

					</div>
					<?php } elseif ($_smarty_tpl->tpl_vars['layer']->value['data_type'] == 'image') {?>					
					<img class="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_class_suffix'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 jms-slide-content" 
					src="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['image_url']->value,'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
layers/<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_image'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" alt="" 
					<?php if ($_smarty_tpl->tpl_vars['layer']->value['data_fixed']) {?>data-fixed<?php }?> 
					data-position="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_y'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_x'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" 
					data-in="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_in'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" 
					data-out="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_out'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" 
					data-delay="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_delay'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" 
					data-ease-in="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_ease_in'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" 
					data-ease-out="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_ease_out'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" 
					data-time = "<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_time'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
					data-step="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_step'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" 
					data-special="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_special'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" 
					width="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_width'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" 
					height="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_height'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"/>
					<?php } else { ?>
						
					<iframe class="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_class_suffix'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 jms-slide-content"
					<?php if ($_smarty_tpl->tpl_vars['layer']->value['data_fixed'] || $_smarty_tpl->tpl_vars['layer']->value['data_video_bg']) {?>data-fixed<?php }?> 
					data-position="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_y'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_x'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" 
					data-in="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_in'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" 
					data-out="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_out'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" 
					<?php if ($_smarty_tpl->tpl_vars['layer']->value['data_video_bg']) {?>data-delay="0"<?php } else { ?>data-delay="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_delay'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" <?php }?>
					data-ease-in="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_ease_in'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" 
					data-ease-out="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_ease_out'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" 
					data-step="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_step'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" 
					data-special="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_special'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
					data-time = "<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_time'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
					<?php if ($_smarty_tpl->tpl_vars['layer']->value['data_video_bg']) {?>
						width="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['configs']->value['JMS_SLIDER_WIDTH'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
						height="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['configs']->value['JMS_SLIDER_HEIGHT'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
					<?php } else { ?>
						width="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_width'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
						height="<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_height'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
					<?php }?>
					<?php if ($_smarty_tpl->tpl_vars['layer']->value['videotype'] == 'youtube') {?>
						src="http://www.youtube.com/embed/<?php echo htmlspecialchars(substr($_smarty_tpl->tpl_vars['layer']->value['data_video'],(strpos($_smarty_tpl->tpl_vars['layer']->value['data_video'],'?v=')+3)), ENT_QUOTES, 'UTF-8');?>
?autoplay=<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_video_autoplay'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
&controls=<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_video_controls'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
&loop=<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_video_loop'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
					<?php } elseif ($_smarty_tpl->tpl_vars['layer']->value['videotype'] == 'vimeo') {?>
						 <?php $_smarty_tpl->_assignInScope('vimeo_link', (explode("/",$_smarty_tpl->tpl_vars['layer']->value['data_video'])));?>
						src="https://player.vimeo.com/video/<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['vimeo_link']->value[count($_smarty_tpl->tpl_vars['vimeo_link']->value)-1], ENT_QUOTES, 'UTF-8');?>
?autoplay=<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_video_autoplay'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
&loop=<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['layer']->value['data_video_loop'],'htmlall','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
					<?php }?>	
					allowfullscreen 
					frameborder="0">
					</iframe> 
					<?php }?>
				<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</div>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</div>
	</div>
</div>

  
<?php echo '<script'; ?>
 type="text/javascript">	
	var jmsslider_trans = "<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['configs']->value['JMS_SLIDER_TRANS'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
";
	var jmsslider_end_animate = "<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['configs']->value['JMS_SLIDER_TRANS'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
";
	var jmsslider_trans_in = "<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['configs']->value['JMS_SLIDER_TRANS'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
";	
	var jmsslider_trans_out = "<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['configs']->value['JMS_SLIDER_TRANS_OUT'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
";	
	<?php if ($_smarty_tpl->tpl_vars['configs']->value['JMS_SLIDER_FULL_WIDTH']) {?>
		var jmsslider_full_width = true;
	<?php } else { ?>	
		var jmsslider_full_width = false;
	<?php }?>
	var jmsslider_delay = <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['configs']->value['JMS_SLIDER_DELAY'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
;
	var jmsslider_duration = <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['configs']->value['JMS_SLIDER_DURATION'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
;
	var jmsslider_speed_in = <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['configs']->value['JMS_SLIDER_SPEED_IN'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
;
	var jmsslider_speed_out = <?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['configs']->value['JMS_SLIDER_SPEED_OUT'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
;
	var jmsslider_ease_in = "<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['configs']->value['JMS_SLIDER_EASE_IN'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
";
	var jmsslider_ease_out = "<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['configs']->value['JMS_SLIDER_EASE_OUT'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
";
	<?php if ($_smarty_tpl->tpl_vars['navigation']->value) {?>
		var jmsslider_navigation = true;
	<?php } else { ?>	
		var jmsslider_navigation = false;
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['pagination']->value) {?>
		var jmsslider_pagination = true;
	<?php } else { ?>	
		var jmsslider_pagination = false;
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['autoplay']->value) {?>
		var jmsslider_autoplay = true;
	<?php } else { ?>	
		var jmsslider_autoplay = false;
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['pausehover']->value) {?>
		var jmsslider_pausehover = true;
	<?php } else { ?>	
		var jmsslider_pausehover = false;
	<?php }?>	
	<?php if ($_smarty_tpl->tpl_vars['configs']->value['JMS_SLIDER_BG_ANIMATE']) {?>
		var jmsslider_bg_animate = true;
	<?php } else { ?>	
		var jmsslider_bg_animate = false;
	<?php }?>
	var jmsslider_bg_ease = "<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['configs']->value['JMS_SLIDER_BG_EASE'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
";
	<?php if ($_smarty_tpl->tpl_vars['configs']->value['JMS_SLIDER_RESPONSIVE']) {?>
		var jmsslider_responsive = true;
	<?php } else { ?>	
		var jmsslider_responsive = false;
	<?php }?>	
	var jmsslider_dimensions = "<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['max_width']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars(call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['max_height']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
";
<?php echo '</script'; ?>
><?php }
}
