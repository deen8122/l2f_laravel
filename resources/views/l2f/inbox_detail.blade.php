<div data-role="page" id="inbox_detail">
    <div data-role="header">
	<a href="#inbox"  data-shadow="false"  data-iconshadow="false" class="btn-back-top"  ><span class="ico"></span></a>
	<h1 class="title">Письмо из прошлого</h1>
    </div>
    <div data-role="content" >
	<div class="inbox_detail">

	</div>
	<div id="cont-audio">

	</div>
	<div id="cont-img">

	</div>

	<div class="div-buttons-center">
	    <button onclick="CloseMessage()">Прочитал, удалить!</button>                      
	</div>
	<div class="div-buttons-center">
	    <br/>
	    <center>
		<a  onclick='ReSendLetter()' style="text-decoration: underline;color:#222;">отправить письмо еще раз</a>
	    </center>              
	</div>
    </div>
</div>