{*
* 2007-2018 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2018 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{if $sidebar == 'left'} 
	{assign var="layout" value="layouts/layout-left-column.tpl"}
{elseif $sidebar == 'right'}
	{assign var="layout" value="layouts/layout-right-column.tpl"}
{elseif $sidebar == 'no'}	
	{assign var="layout" value="layouts/layout-full-width.tpl"}
{/if}
{extends file='page.tpl'}
{block name="page_content"}
{capture name=path}{$post.title|escape:'html':'UTF-8'}{/capture}
<div class="single-blog">
	<div class="blog-post">
		<h1 class="title">{$post.title|escape:'html':'UTF-8'}</h1>
		{assign var=catparams value=['category_id' => $post.category_id, 'slug' => $post.category_alias]}	
		<ul class="post-meta">
			{if $jmsblog_setting.JMSBLOG_SHOW_CATEGORY}
				<li>
					<span>
						{l s='In:' d='Modules.JmsBlog'} 
						<a href="{jmsblog::getPageLink('jmsblog-category', $catparams)}">
							{$post.category_name|escape:'html':'UTF-8'}
						</a>
					</span>
				</li>
			{/if}
			<li>
				<span>{$post.created|escape:'html':'UTF-8'|date_format:"%B %e, %Y"}</span>
			</li>
		</ul>
		{if $post.link_video && $jmsblog_setting.JMSBLOG_SHOW_MEDIA}
			<div class="post-video">
				{$post.link_video}
			</div>
		{elseif $post.image && $jmsblog_setting.JMSBLOG_SHOW_MEDIA}
			<div class="post-thumb">
				<img src="{$image_baseurl|escape:'html':'UTF-8'}{$post.image|escape:'html':'UTF-8'}" alt="{l s='Image Blog' d='Modules.JmsBlog'}" />
			</div>
		{/if}
		
		
		<div class="post-fulltext">
			{$post.fulltext nofilter}	
		</div>
	</div>
{if $jmsblog_setting.JMSBLOG_SHOW_SOCIAL_SHARING}
<div class="social-sharing">
{literal}
<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "a6f949b3-864b-44c5-b0ec-4140186ad958", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
{/literal}
<span class='st_sharethis_large' displayText='ShareThis'></span>
{if $jmsblog_setting.JMSBLOG_SHOW_FACEBOOK}
<span class='st_facebook_large' displayText='Facebook'></span>
{/if}
{if $jmsblog_setting.JMSBLOG_SHOW_TWITTER}
<span class='st_twitter_large' displayText='Tweet'></span>
{/if}
{if $jmsblog_setting.JMSBLOG_SHOW_GOOGLEPLUS}
<span class='st_googleplus_large' displayText='Google +'></span>
{/if}
{if $jmsblog_setting.JMSBLOG_SHOW_LINKEDIN}
<span class='st_linkedin_large' displayText='LinkedIn'></span>
{/if}
{if $jmsblog_setting.JMSBLOG_SHOW_PINTEREST}
<span class='st_pinterest_large' displayText='Pinterest'></span>
{/if}
{if $jmsblog_setting.JMSBLOG_SHOW_EMAIL}
<span class='st_email_large' displayText='Email'></span>
{/if}
</div>
{/if}
</div>
	{if $jmsblog_setting.JMSBLOG_COMMENT_ENABLE}	
		<div id="comments">
			{if $jmsblog_setting.JMSBLOG_FACEBOOK_COMMENT == 0}	
				{if $msg == 1}<div class="success">{l s='Your comment submited' d='Modules.JmsBlog'} ! {if $jmsblog_setting.JMSBLOG_AUTO_APPROVE_COMMENT == 0} {l s='Please waiting approve from Admin' d='Modules.JmsBlog'}.{/if}</div>{/if}
				{if $cerrors|@count gt 0}
					<ul>
					{foreach from=$cerrors item=cerror}
						<li class="error">{$cerror}</li>
					{/foreach}	
					</ul>
				{/if}
				<div id="accordion" class="panel-group">
					<div class="panels">		
						<div id="post-comments">
						{if $comments}
							{foreach from=$comments item=comment key = k}
								<div class="post-comment clearfix">
									<div class="post-comment-info">
										<img class="attachment-widget wp-post-image img-responsive" src="{$image_baseurl|escape:'html':'UTF-8'}user.png" />
										<div class="left">
											<div class="title">
												<h6>
													By <span>{$comment.customer_name|escape:'html':'UTF-8'}</span>
													on {$comment.time_add|escape:'html':'UTF-8'|date_format:'%B %e, %Y'}
												</h6>
											</div>
											<p class="post-comment-content">{$comment.comment|truncate:120:'...'|escape:'html':'UTF-8'}</p>
										</div>
										
									</div>
								</div>
							{/foreach}	
						{/if}
						</div>
					</div>
				</div>
				{if $jmsblog_setting.JMSBLOG_ALLOW_GUEST_COMMENT || (!$jmsblog_setting.JMSBLOG_ALLOW_GUEST_COMMENT && $logged)}	
				<div class="commentForm">
					<form id="commentForm" enctype="multipart/form-data" method="post" action="index.php?fc=module&module=jmsblog&controller=post&post_id={$post.post_id|escape:'html':'UTF-8'}&action=submitComment">	
						<div class="row">
							<div class="col-lg-12 col-md-12 col-sm-12">
								<label>{l s='Name' d='Modules.JmsBlog'}</label>
								<div class="form-group">
									<input id="customer_name" placeholder="Your name *" class="form-control" name="customer_name" type="text" value="{$customer.firstname}{$customer.lastname}" required />
								</div>	
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12">
								<label>{l s='Email' d='Modules.JmsBlog'}</label>
								<div class="form-group">
									<input id="comment_title" placeholder="Your email *" class="form-control" name="email" type="text" value="{$customer.email}" required />
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="lb-comment">{l s='Comments' d='Modules.JmsBlog'}</label>
							<textarea id="comment" placeholder="Write your comment..." class="form-control" name="comment" rows="6" required></textarea>
						</div>
						<div id="new_comment_form_footer">
							<input id="item_id_comment_send" name="post_id" type="hidden" value="{$post.post_id|escape:'html':'UTF-8'}" />
							<input id="item_id_comment_reply" name="post_id_comment_reply" type="hidden" value="" />
							<p class="">
								<button id="submitComment" class="btn btn-default" name="submitComment" type="submit">{l s='Post comment' d='Modules.JmsBlog'}</button>
							</p>
						</div>
					</form>
					<script>
					$("#commentForm").validate({
					  rules: {		
						customer_name: "required",		
						email: {
						  required: true,
						  email: true
						}
					  }
					});
					</script>
				</div>
				{/if}
				{if !$jmsblog_setting.JMSBLOG_ALLOW_GUEST_COMMENT && !$logged}
					{l s='Please Login to comment' d='Modules.JmsBlog'}
				{/if}
			{else}
				{include file="modules/jmsblog/views/templates/front/comment_facebook.tpl"}		
			{/if}
		</div>
	{/if}
{/block}


