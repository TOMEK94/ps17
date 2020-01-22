{if $contactform_text_allow1 || $contactform_text_allow2}
				{if $contactform_text_allow1}
					<div class="box">
						<div class="alert alert-danger error" id="errorCGV1" style="display: none;">{l s="Musisz zaakceptować tę zgodę" mod="pdrodopro"}</div>
                        <p class="checkbox">
                            <input type="checkbox" name="cgv1" id="cgv1" value="1" {if isset($smarty.post.cgv1) && $smarty.post.cgv1=='1'}checked="checked"{/if} />
                            <label for="cgv1">{$contactform_text1}</label>
                        </p>
                    </div>
					<script type="text/javascript">
					$(document).ready(function()
					{
						 $('#submitMessage').on("click", function(e){
							if (!$('#cgv1').is(':checked')){
								$('#errorCGV1').show();
								return false;
							}
							return true;
						});
						$('#cgv1').on('click', function(e){
							if ($('#cgv1').is(':checked')){
								$('#errorCGV1').hide();
							} else {
								$('#errorCGV1').show();
							}
						});
					});
					</script>
				{/if}
    {if $contactform_text_allow2}
		<div class="box">
			<div class="alert alert-danger error" id="errorCGV2" style="display: none;">{l s="Musisz zaakceptować tę zgodę" mod="pdrodopro"}</div>
			<p class="checkbox">
				<input type="checkbox" name="cgv2" id="cgv2" value="1" {if isset($smarty.post.cgv2) && $smarty.post.cgv2=='1'}checked="checked"{/if} />
				<label for="cgv2">{$contactform_text2}</label>
			</p>
		</div>
		<script type="text/javascript">
            $(document).ready(function()
            {
                $('#submitMessage').on("click", function(e){
                    if (!$('#cgv2').is(':checked')){
                        $('#errorCGV2').show();
                        return false;
                    }
                    return true;
                });
                $('#cgv2').on('click', function(e){
                    if ($('#cgv2').is(':checked')){
                        $('#errorCGV2').hide();
                    } else {
                        $('#errorCGV2').show();
                    }
                });
            });
		</script>
    {/if}
{/if}