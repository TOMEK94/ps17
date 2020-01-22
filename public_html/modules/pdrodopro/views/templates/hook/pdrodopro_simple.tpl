<div class="col-lg-12">
    <div class="panel">
        <div class="panel-heading">
            <i class="icon-map-marker"></i> {l s='Zgody'}
        </div>
        <div>
            <ul>
                {if isset($customer_privacy1)}<li>{$customer_privacy_message1}</li>{/if}
                {if isset($customer_privacy2)}<li>{$customer_privacy_message2}</li>{/if}
                {if isset($customer_privacy3)}<li>{$customer_privacy_message3}</li>{/if}

                {if isset($privacy_message_allow1)}<li>{$privacy_message1}</li>{/if}
                {if isset($privacy_message_allow2)}<li>{$privacy_message2}</li>{/if}
                {if isset($privacy_message_allow3)}<li>{$privacy_message3}</li>{/if}
                {if isset($privacy_message_allow4)}<li>{$privacy_message4}</li>{/if}

                {if isset($newsletter_message_allow1) || isset($newsletter_message_allow2)}
                    <h4>Newsletter:</h4>
                {/if}
                {if isset($newsletter_message_allow1)}<li>{$newsletter_message1}</li>{/if}
                {if isset($newsletter_message_allow2)}<li>{$newsletter_message2}</li>{/if}
            </ul>
        </div>
    </div>
</div>
