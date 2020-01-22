<div class="btn-group compact-hidden blockcart cart-preview {if $cart.products_count > 0}active{else}inactive{/if} dropdown {if isset($jpb_addtocart) && $jpb_addtocart == 'ajax_cartbottom'}shoppingcart-bottom{/if}" id="cart_block" data-refresh-url="{$refresh_url}">
	<a href="#" class="dropdown-toggle cart-icon" data-toggle="dropdown">
		<i class="storm-shopping-bag"></i>			
		<span class="ajax_cart_quantity">{$cart.products_count}</span>
	</a>
	<div class="text-custom">
		<p>{l s='Your cart' d='Shop.Theme.Actions'}</p>
		<span class="cart_block_total ajax_block_cart_total">{$cart.totals.total.value}</span>
	</div>
	
	<a href="#" class="btn-xs tab-title dropdown-toggle" data-toggle="dropdown">		 
		<span><span class="box-cart ajax_cart_quantity"> {$cart.products_count}</span> {l s='item(s) in your cart' mod='blockcart'}<i class="fa fa-chevron-down"></i><i class="fa fa-chevron-up"></i></span>
	</a>
	<div class="dropdown-menu shoppingcart-box">
	   	<div class="shoppingcart-content">
        	<span class="ajax_cart_no_product" {if $cart.products_count != 0}style="display:none"{/if}>{l s='There is no product' d='Shop.Theme.Actions'}</span>
			<ul class="list products cart_block_list">
				{foreach from=$cart.products item=product}
					<li>{include 'module:ps_shoppingcart/ps_shoppingcart-product-line.tpl' product=$product}</li>
				{/foreach}
			</ul>
		</div>
		<div class="cart-prices">
			<div class="checkout-info">
				{foreach from=$cart.subtotals item="subtotal"}
					<div class="{$subtotal.type} cart-prices-line">
						<span class="label">{$subtotal.label}</span>
						<span class="value">{$subtotal.value}</span>
					</div>
				{/foreach}
			</div>
			<div class="cart-button">
				<a id="button_order_cart" class="btn-default btn-effect" href="{$cart_url}" title="{l s='DO KASY' d='Shop.Theme'}" rel="nofollow">
					{l s='DO KASY' d='Shop.Theme'}
				</a> 
			</div>
		</div>
	</div>
</div>
