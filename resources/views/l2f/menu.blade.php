<!-- PANEL -->
<? /*
<div data-role="panel" id="mypanel" data-position="left" data-display="overlay">
<ul data-role="listview" data-inset="true">
<li><span class="icon1 icon-send"></span>
<a onclick="window.location = ''" data-onclick='$.mobile.changePage("#main", {transition: "slideup"});' class="deen-btn lang" data-lang="menu_send">Отправить</a></li>
<li><span class="icon1 icon-inbox"></span><a  href="#inbox" class="deen-btn lang" data-lang="menu_letters">Письма <span class="inbox-col" id="inbox-col"></span></a></li>
<li><span class="icon1 icon-about"></span><a onclick='$.mobile.changePage("#about", {transition: "slideup"});' class="deen-btn lang" data-lang="menu_about">О программе</a></li>
<li class="hide_in_full_version"><span class="icon1 icon-buy"></span><a  onclick='$.mobile.navigate("#paypage");' class="deen-btn lang" data-lang="menu_fullversion">Полная версия</a></li>
<li>
<span class="icon1 icon-config"></span>
<a  onclick='$.mobile.navigate("#profile");' class="deen-btn lang" data-lang="menu_sync">Синхронизация</a>
</li>
<li>
<span class="icon1 icon-exit"></span>
<a href="#" onclick="ExitApp();" class="deen-btn lang" data-lang="menu_exit">Выйти</a>
</li>
</ul>
<div class="left-help" id="lefthelp" style="xdisplay: none;">
<!--<div class="icon1 ico-close close" onclick="hideLeftBlock('lefthelp',1)"></div>-->
<center>
<h2  class="lang" data-lang="banner_title1">Помоги проекту!</h2>
</center>
<p class="lang" data-lang="banner_text1">Оставьте положительный отзыв и поставьте оценку 4 или 5. 
Также пишите предложения по улучшению приложения.</p>
<center>
<a href="#" 
onclick='testInternet(function () {
// hideLeftBlock("lefthelp", 1);
window.open("market://details?id=com.deen812.letter2feature", "_system");
}, function () {
alert2("Нет интернет соединения!");
});' class="lang" data-lang="banner_btn1">Оценить!</a>
</center>

</div>


</div>
*/?>
<div s|data-role="panel" id="mypanel" data-position="left" data-display="overlay" 
     class="ui-panel ui-panel-position-left ui-panel-display-overlay ui-body-inherit ui-panel-animate ui-panel-open">
    <div class="ui-panel-inner"><ul data-role="listview" data-inset="true" class="ui-listview ui-listview-inset ui-corner-all ui-shadow">
	    <li class="ui-first-child"><span class="icon1 icon-send"></span>
		<a onclick="window.location = ''" data-onclick="$.mobile.changePage(&quot;#main&quot;, {transition: &quot;slideup&quot;});" class="deen-btn lang ui-btn ui-btn-icon-right ui-icon-carat-r" data-lang="menu_send">Отправить</a></li>
	    <li><span class="icon1 icon-inbox"></span><a href="#inbox" class="deen-btn lang ui-btn ui-btn-icon-right ui-icon-carat-r" data-lang="menu_letters">Письма <span class="inbox-col" id="inbox-col"></span></a></li>
	    <li><span class="icon1 icon-about"></span><a onclick="$.mobile.changePage( & quot; #about & quot; , {transition: & quot; slideup & quot; });" class="deen-btn lang ui-btn ui-btn-icon-right ui-icon-carat-r" data-lang="menu_about">О программе</a></li>
	    <li class="hide_in_full_version"><span class="icon1 icon-buy"></span><a onclick="$.mobile.navigate( & quot; #paypage & quot; );" class="deen-btn lang ui-btn ui-btn-icon-right ui-icon-carat-r" data-lang="menu_fullversion">Полная версия</a></li>
	    <li>
		<span class="icon1 icon-config"></span>
		<a onclick="$.mobile.navigate( & quot; #profile & quot; );" class="deen-btn lang ui-btn ui-btn-icon-right ui-icon-carat-r" data-lang="menu_sync">Синхронизация</a>
	    </li>
	    <li class="ui-last-child">
		<span class="icon1 icon-exit"></span>
		<a href="#" onclick="ExitApp();" class="deen-btn lang ui-btn ui-btn-icon-right ui-icon-carat-r" data-lang="menu_exit">Выйти</a>
	    </li>
	</ul><div class="left-help" id="lefthelp" style="xdisplay: none;">
	    <!--<div class="icon1 ico-close close" onclick="hideLeftBlock('lefthelp',1)"></div>-->
	    <center>
		<h2 class="lang" data-lang="banner_title1">Помоги проекту!</h2>
	    </center>
	    <p class="lang" data-lang="banner_text1">Оставьте положительный отзыв и поставьте оценку 4 или 5. 
		Также пишите предложения по улучшению приложения.</p>
	    <center>
		<a href="#" onclick="testInternet(function () {
                        // hideLeftBlock(&quot;lefthelp&quot;, 1);
                        window.open( & quot; market://details?id=com.deen812.letter2feature&quot;, &quot;_system&quot;);
                        }, function () {
                        alert2( & quot; Нет интернет соединения! & quot; );
                        });" class="lang ui-link" data-lang="banner_btn1">Оценить!</a>
	    </center>

	</div></div>



</div>