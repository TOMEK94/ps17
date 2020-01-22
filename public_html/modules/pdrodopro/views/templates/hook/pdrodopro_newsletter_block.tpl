{if $newsletter_message_allow1}
    {if $newsletter_message_allow1}
			<div class="alert alert-danger error" id="error_newsletter_allow" style="display: none;">{l s="Musisz zaakceptować tę zgodę" mod="pdrodopro"}</div>
			<p class="checkbox">
				<input type="checkbox" name="newsletter_allow" required="required" id="newsletter_allow" value="1" {if isset($smarty.post.newsletter_allow) && $smarty.post.newsletter_allow=='1'}checked="checked"{/if} />
				<label for="newsletter_allow">{$newsletter_message1}</label>
			</p>
		<script type="text/javascript">
            $(document).ready(function()
            {
                $('button[name="submitNewsletter"]').on('submit', function(e){
                    if (!$('#newsletter_allow').is(':checked')){
                        $('#error_newsletter_allow').show();
                        return false;
                    }
                    postCart('newsletter_allow');
                    return true;
                });
                $('#newsletter_allow').on('click', function(e){
                    if ($('#newsletter_allow').is(':checked')){
                        $('#error_newsletter_allow').hide();
                    } else {
                        $('#error_newsletter_allow').show();
                    }
                });
            });
		</script>
    {/if}
{/if}