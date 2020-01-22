{if $privacy_message_allow1 || $privacy_message_allow2 || $privacy_message_allow3 || $privacy_message_allow4}
				{if $privacy_message_allow1}
					<div class="box">
						<div class="alert alert-danger error" id="errorCGV2" style="display: none;">{l s="Musisz zaakceptować tę zgodę" mod="pdrodopro"}</div>
                        <p class="checkbox">
                            <input type="checkbox" name="cgv2" required="required" id="cgv2" value="1" {if isset($smarty.post.cgv2) && $smarty.post.cgv2=='1'}checked="checked"{/if} />
                            <label for="cgv2">{$privacy_message1}</label>
                        </p>
                    </div>
					<script type="text/javascript">
					$(document).ready(function()
					{
						 $('p.payment_module a').on("click", function(e){
							if (!$('#cgv2').is(':checked')){
                                e.preventDefault();
								$('#errorCGV2').show();
								return false;
							}
                            postCart('cgv2');
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
				{if $privacy_message_allow2}
					<div class="box">
						<div class="alert alert-danger error" id="errorCGV3" style="display: none;">{l s="Musisz zaakceptować tę zgodę" mod="pdrodopro"}</div>
                        <p class="checkbox">
                            <input type="checkbox" name="cgv3" required="required" id="cgv3" value="1" {if isset($smarty.post.cgv3) && $smarty.post.cgv3=='1'}checked="checked"{/if} />
                            <label for="cgv3">{$privacy_message2}</label>
                        </p>
                    </div>
					<script type="text/javascript">
					$(document).ready(function()
					{
						$('p.payment_module a').on("click", function(e){
							if (!$('#cgv3').is(':checked')){
                                e.preventDefault();
								$('#errorCGV3').show();
								return false;
							}
                            postCart('cgv3');
							return true;
						});
						$('#cgv3').on('click', function(e){
							if ($('#cgv3').is(':checked')){
								$('#errorCGV3').hide();
							} else {
								$('#errorCGV3').show();
							}
						});
					});
					</script>
				{/if}
				{if $privacy_message_allow3}
					<div class="box">
						<div class="alert alert-danger error" id="errorCGV4" style="display: none;">{l s="Musisz zaakceptować tę zgodę" mod="pdrodopro"}</div>
                        <p class="checkbox">
                            <input type="checkbox" name="cgv4" required="required" id="cgv4" value="1" {if isset($smarty.post.cgv4) && $smarty.post.cgv4=='1'}checked="checked"{/if} />
                            <label for="cgv4">{$privacy_message3}</label>
                        </p>
                    </div>
					<script type="text/javascript">
					$(document).ready(function()
					{
						$('p.payment_module a').on("click", function(e){
							if (!$('#cgv4').is(':checked')){
                                e.preventDefault();
								$('#errorCGV4').show();
								return false;
							}
                            postCart('cgv4');
							return true;
						});
						$('#cgv4').on('click', function(e){
							if ($('#cgv4').is(':checked')){
								$('#errorCGV4').hide();
							} else {
								$('#errorCGV4').show();
							}
						});
					});
					</script>
				{/if}
				{if $privacy_message_allow4}
					<div class="box">
						<div class="alert alert-danger error" id="errorCGV5" style="display: none;">{l s="Musisz zaakceptować tę zgodę" mod="pdrodopro"}</div>
                        <p class="checkbox">
                            <input type="checkbox" name="cgv5" required="required" id="cgv5" value="1" {if isset($smarty.post.cgv5) && $smarty.post.cgv5=='1'}checked="checked"{/if} />
                            <label for="cgv5">{$privacy_message4}</label>
                        </p>
                    </div>
					<script type="text/javascript">
					$(document).ready(function()
					{
						$('p.payment_module a').on("click", function(e){
							if (!$('#cgv5').is(':checked')){
                                e.preventDefault();
								$('#errorCGV5').show();
								return false;
							}
                            postCart('cgv5');
							return true;
						});
						$('#cgv5').on('click', function(e){
							if ($('#cgv5').is(':checked')){
								$('#errorCGV5').hide();
							} else {
								$('#errorCGV5').show();
							}
						});
					});
					</script>
				{/if}
	<script type="text/javascript">
        $(document).ready(function()
        {
            getDataByCart();
            $.uniform.update();
        });
	</script>
{/if}