<form id="letterform" method="post"  enctype="multipart/form-data">
    <div class="div-center xdiv-color-1">
	<!-- <h4>Текст письма</h4> -->



	<textarea class="lang" data-lang="msgPH" data-langtype="placeholder" id="message" placeholder="Введите текст письма" style="min-height: 150px!important;"></textarea>
	<br/> <br/>
	<a id="select-audio-btn"  class="colored-a lang" data-lang="addaudio" onclick="Audio_addNewFile()">Прикрепить аудио</a>
	<div id="main-audio-list">  
	</div>
	<div class="clear"></div>
	<br/>
	<a id="select-photo-btn"  class="lang" data-lang="addpicture" onclick="picture_select()">Прикрепить фото</a>
	<input type="file"id="image" name="images[]">
	
	<div id="smallImage">  

	</div>
	
	<div style="clear: both"></div>
    </div>

    <div class="div-center xdiv-color-2">
	<b style="color:#555" class="lang" data-lang="date_reciev">Время получения</b>
	<table>
	    <tr>
		<td>
		    <span class="lang" data-lang="date" >Дата:</span>
		    <input 
			type="text" 
			id="date" 
			class="datepicker-here"  
			data-date-format="yyyy-mm-dd" 
			readonly="readonly" 
			data-position="top left"
			>
		</td>
		<td>
		    <span class="lang" data-lang="time" >Время:</span>
		    <input type="time" id="time" >
		</td>
	    </tr>
	</table>

	<select id="futuretime" onchange="setFutureTime()">
	    <option value="tomorrow" class="lang" data-lang="option1" > Завтра</option>
	    <option value="week1" class="lang" data-lang="option2"> Неделя</option>
	    <option value="1" class="lang" data-lang="option3"> 1 месяц</option>
	    <option value="3" class="lang" data-lang="option4"> 3 месяца</option>
	    <option value="6" class="lang" data-lang="option5"> пол года</option>
	    <option value="12" class="lang" data-lang="option6"> 1 год</option>
	</select>
    </div>  

    <div class="div-center xdiv-color-2 xshow_in_full_version">
	<a class="colored-a lang" onclick=" if (window.localStorage.getItem('full_version') != '1') {
                        alert2('Извините, но функция доступна только для полной версии. (@_@)');
                        return false;
                    }
                    $('.email_to_wrap').show(100)"  data-lang="add_emails">Добавить email</a>
	<div class="email_to_wrap" style="display:none">
	    <p style="font-size: 12px;">Укажете электронные почты через запятую для дублирования сообщения.
		Например: my@mail.ru или my@mail.ru, test@gmail.com </p>
	    <input type="text" id="emails"  placeholder="my@mail.ru, test@mail.ru" >
	    <a class="colored-a" onclick="$('.email_to_wrap').hide(100)">свернуть...</a>
	</div>

    </div>


    <div class="div-center div-color div-color-none">
	<!--<div class="btn btn-send" onclick="SynSendImagesToServer()">SynSendImagesToServer()</div>-->
	<!--   <div class="btn btn-send" onclick="NotificationSet()">NotificationSet()</div> -->
	<div class="btn btn-send lang" onclick="Send()" data-lang="send_btn">Отправить в будущее</div>
	<br/>


	<div id="log" style="display:none;width:100%; background: #fff;font-size: 10px;overflow: scroll;max-height: 200px"></div>

	<div  class="inbox_content_cols">

	</div>
	<div  class="hide_in_full_version">
	    <center>
		<a  class="lang" data-lang="text_free_version" onclick='$.mobile.navigate("#paypage");' style="text-decoration: underline;color:#222;" >У вас бесплатная версия</a>
	    </center>
	</div>

    </div>
</form>
