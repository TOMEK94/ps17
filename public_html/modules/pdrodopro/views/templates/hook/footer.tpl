{if $uecookie_allow}
<script type="text/javascript">{literal}
		function WHCreateCookie(name, value, days) {
    var date = new Date();
    date.setTime(date.getTime() + (days*24*60*60*1000));
    var expires = "; expires=" + date.toGMTString();
	document.cookie = name+"="+value+expires+"; path=/";
}
function WHReadCookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') c = c.substring(1, c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
	}
	return null;
}

$(window).load(function() {
$(WHCheckCookies);
});


function WHCheckCookies() {
    if(WHReadCookie('cookies_accepted') != 'T') {
        var message_container = document.createElement('div');
        message_container.id = 'cookies-message-container';
        var html_code = '<div id="cookies-message" style="padding: 10px 0px; font-size: 12px; line-height: 22px; border-bottom: 1px solid rgb(211, 208, 208); text-align: center; position: fixed; color: #ffffff; bottom: 0px; background: none repeat scroll 0 0 rgba(0, 0, 0, 0.6); width: 100%; z-index: 999;"><div style="width: 800px; display: block; margin: 0 auto;"><div class="row"><div class="col-sm-10">{/literal}{$uecookie}{literal}</div><div class="col-sm-2"><a href="javascript:WHCloseCookiesWindow();" id="accept-cookies-checkbox" name="accept-cookies" style="background-color: #324c56; padding: 5px 10px; color: #FFF; display: block; float: right;  border-radius: 4px; -moz-border-radius: 4px; -webkit-border-radius: 4px; display: inline-block; margin-left: 10px; margin-top: 0px; text-decoration: none; cursor: pointer; font-size: 12px; font-family: Arial;">Rozumiem</a></div></div></div></div>';
        message_container.innerHTML = html_code;
        document.body.appendChild(message_container);
    }
}

function WHCloseCookiesWindow() {
    WHCreateCookie('cookies_accepted', 'T', 365);
    document.getElementById('cookies-message-container').removeChild(document.getElementById('cookies-message'));
}
	{/literal}	
    </script>
{/if}