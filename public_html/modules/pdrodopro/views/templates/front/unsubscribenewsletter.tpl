{if $unsubscribed}
	<p class="alert alert-success">
		{l s='Twój adres e-mail został pomyślnie wypisany z modułu Newslettera!'}<br />
	</p>
{else}
	<p class="alert alert-error">
		{l s='Twój adres e-mail nie występuje w bazie danych Naszego Newslettera!'}<br />
	</p>
{/if}

<br /><br />

<ul class="footer_links clearfix">
<li><a class="btn btn-default button button-small" href="{if isset($force_ssl) && $force_ssl}{$base_dir_ssl}{else}{$base_dir}{/if}" title="{l s='Home'}"><span><i class="icon-chevron-left"></i> {l s='Home'}</span></a></li>
</ul>