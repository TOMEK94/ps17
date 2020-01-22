{if isset($anonimize_account_allow)}
	<li><a href="#" class="anonimize"><i class="icon-user"></i><span>{l s='Anonimizuj konto'}</span></a></li>
	<script>
		$(".anonimize").on("click", function(e){
			e.preventDefault();
			if (confirm('{l s="Jesteś pewien że chcesz dokonać anonimizacji konta? Wszystkie dotychczas przypisane adresy i wiadomości zostaną usunięte z historii Twojego konta. UWAGA! Proces jest nieodwracalny!"}')) {
				$("#anonimizeAccount").submit();
			}
		});
	</script>
	<form action="{$link->getModuleLink('pdrodopro', 'display')|escape:'html'}" method="POST" name="anonimizeAccount" id="anonimizeAccount">
		<input type="hidden" name="anonimize" value="1" />
	</form>
{/if}

{if isset($delete_account_allow)}
	<li><a href="#" class="delete_account"><i class="icon-trash"></i><span>{l s='Usuń konto'}</span></a></li>
	<script>
		$(".delete_account").on("click", function(e){
			e.preventDefault();
			if (confirm('{l s="Jesteś pewien że chcesz usunąć konto użytkownika? Zostanie wysłana prośba do administratora serwisu o usunięcie Twojego konta! Proces jest nieodwracalny!"}')) {
				$("#deleteAccount").submit();
			}
		});
	</script>
	<form action="{$link->getModuleLink('pdrodopro', 'display')|escape:'html'}" method="POST" name="deleteAccount" id="deleteAccount">
		<input type="hidden" name="delete" value="1" />
	</form>
{/if}

{if isset($unsubscribe_newsletter_allow)}
	<li><a href="#" class="remove_newsletter"><i class="icon-envelope"></i><span>{l s='Usuń email z Newslettera'}</span></a></li>
	<script>
		$(".remove_newsletter").on("click", function(e){
			e.preventDefault();
			if (confirm('{l s="Jesteś pewien że chcesz usunąć swój adres e-mail z bazy danych Naszego Newslettera? Proces jest nieodwracalny!"}')) {
				$("#removeNewsletter").submit();
			}
		});
	</script>
	<form action="{$link->getModuleLink('pdrodopro', 'display')|escape:'html'}" method="POST" name="removeNewsletter" id="removeNewsletter">
		<input type="hidden" name="removenewsletter" value="1" />
	</form>
{/if}

{if isset($get_all_customer_data)}
	<li><a href="#" class="get_all_customer_data"><i class="icon-cog"></i><span>{l s='Pobierz zebrane dane o mnie'}</span></a></li>
	<script>
		$(".get_all_customer_data").on("click", function(e){
			e.preventDefault();
			$("#get_all_customer_data").submit();
		});
	</script>
	<form action="{$link->getModuleLink('pdrodopro', 'display')|escape:'html'}" method="POST" name="get_all_customer_data" id="get_all_customer_data">
		<input type="hidden" name="get_all_customer_data" value="1" />
	</form>
{/if}