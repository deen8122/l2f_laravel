<div class="layer layer-right" id="layer-right">
    <a onclick="$('#layer-right').css('left', '100%')" class="layer-close"></a>
</div>
<div class="layer layer-theme-2" id="empty_message" data-pos="left" onclick="$('#empty_message').css('left', '100%');$('#message').focus();">
    <a onclick="$('#empty_message').css('left', '100%');$('#message').focus();" class="layer-close"></a>
    <div><span>И что же мне передать в будущее?</span></div>
</div>

<div class="layer layer-theme-4" id="alert" data-pos="left" onclick="alert2Close()">
    <a onclick="alert2Close()" class="layer-close"></a>
    <div><span id='alert_text'>И что же мне передать в будущее?</span></div>
</div>

<div class="layer layer-theme-3" onclick="$('#empty_date').css('right', '100%')" id="empty_date" data-pos="right" style="right:100%;left:initial">
    <a onclick="$('#empty_date').css('right', '100%')" class="layer-close"></a>
    <div><span>Собственно, в какое время желаете получить письмо?</span></div>
</div>

<div class="layer-succes layer-succes1"></div>
<div class="layer-succes layer-succes2"></div>
<div class="layer-succes layer-succes3"></div>
<div class="layer-succes layer-succes4"></div>
<div class="layer-succes-message" onclick="SucessHide()"><div>
	<span>Ваше письмо отправлено в будущее!
	    <br> 

	</span></div>
</div>