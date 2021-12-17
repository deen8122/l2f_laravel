<!-- СТРАНИЦА ПОКУПКИ ПРИЛОЖЕНИЯ -->
<div data-role="page" id="paypage">
    <div data-role="header">
	<a href="#main"  data-shadow="false"  data-iconshadow="false" class="btn-back-top"  ><span class="ico"></span></a>
	<h1 class="title">Полная версия</h1>
    </div>
    <div data-role="content" class=""> 
	<h3>Что есть в полной версии:</h3>
	<ul>
	    <li>Возможность добавить несколько фото</li>
	    <li>Синхронизация данных c сервером</li>
	    <li>Отправка уведомления на почту(email)</li>
	    <!-- <li>Уведомление на телефоне</li>-->
	    <li>Отправка  на любую почту(email)</li>
	    <li>Восстановление данных</li>
	</ul>
	<div class="show_in_full_version" style="color: green;font-weight: bold;font-size: 23px;">
	    <center>
		У вас полная версия!
	    </center>
	</div>
	<div class="hide_in_full_version">
	    <h3>1 способ.Через Google Play </h3>
	    <div class="btn btn-send" onclick="billing_buy('full')"> Google Play!</div> 

	    <h3>2 способ. Покупка через Яндекс </h3>
	    <p>Напишите мне на email deen812@mail.ru  обьясню как купить.<br>
		Тут сумма меньше(100 руб) чем через googlepay, так как  гугл забирает 30% от дохода + до 10% снимают при переводе.</p>
	    <br/>


	    <h2>Проверка полной версии</h2>
	    <p>Если у вас была полная версия, нажмите на эту кнопку:</p>
	    <div class="btn" onclick="SyncCheckFullVersion()">восстановить платную версию!</div>
	    <br/>
	    <br/>  <br/>  <br/>
	</div>
    </div>
</div>
<!-- ----------------------------- --------------------------------->