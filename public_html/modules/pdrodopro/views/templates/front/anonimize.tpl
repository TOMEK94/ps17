{if isset($anonimized)}
	<p class="alert alert-success">
		{l s='Twoje konto zostało anonimizowane!'}<br />
		{l s='Twoje dane personalne zostały ukryte'}<br />
		{l s='Ni będziesz mógł zalogować się już na swoje konto. Zapraszamy ponownie!'}
	</p>
{/if}

{if isset($deleted)}
	<p class="alert alert-success">
		{l s='Prośba o usunięcie Twojego konta została wysłana do administratora. Prosimy o cierpliwość - rozpatrujemy Twój wniosek. Zapraszamy ponownie! Zostałeś wylogowany z serwisu.'}
	</p>
{/if}

{if isset($removed)}
	<p class="alert alert-success">
		{l s='Twój adres e-mail został pomyślnie usunięty z Naszej bazy danych Newslettera.'}
	</p>
{/if}

{if isset($getted)}
	<p class="alert alert-success">
		{l s='Twoje dane są aktualnie przygotowywane i pojawią się za chwilę w formie pliku do pobrania.'}
	</p>
{/if}

<br /><br />

<ul class="footer_links clearfix">
<li><a class="btn btn-default button button-small" href="{if isset($force_ssl) && $force_ssl}{$base_dir_ssl}{else}{$base_dir}{/if}" title="{l s='Home'}"><span><i class="icon-chevron-left"></i> {l s='Home'}</span></a></li>
</ul>