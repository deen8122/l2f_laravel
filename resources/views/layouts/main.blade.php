<!doctype html>
<html>
    
    <head>
        <title>Письмо в будущее</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">  
	<meta http-equiv="Content-Security-Policy" content="script-src 'self' 'unsafe-eval' 'unsafe-inline' *; object-src 'self'; style-src 'self' 'unsafe-inline'; media-src *"> <link rel="stylesheet" href="/l2f/css/jquery.mobile.icons.min.css" />
        <link href="/l2f/css/datepicker.min.css" rel="stylesheet">
        <link href="/l2f/css/jquery.mobile.structure-1.4.5.min.css" rel="stylesheet">
        <link rel="stylesheet" href="/l2f/css/bl.min.css" />
        <script src="/l2f/lib/jquery.min.js"></script>
        <script type="text/javascript" charset="utf-8" src="cordova.js"></script>
        <script src = "lib/datepicker.min.js" ></script>
        <script src="/l2f/css/jquery.mobile-1.4.5.min.js"></script>
        <script src="/l2f/lib/fastclick.js"></script>   
        <script src="/l2f/js/class_DB.js"></script>

        <script src="/l2f/js/functions.js"></script>
        <script src="/l2f/js/audio.js"></script>
        <script src="/l2f/js/billing.js"></script>
        <script src="/l2f/js/ad.js"></script>
        <script src="/l2f/js/syn.js"></script>

        <!-- <script src="/l2f/js/notification.js"></script>-->
        <script src="/l2f/js/picture.js"></script>
        <script src="/l2f/js/localization.js"></script>

        <script src="/l2f/js/app.js"></script>

    </head>
    <body>



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

                </span></div></div>
        <div data-role="page" id="main">

            <!-- PANEL -->
            <div data-role="panel" id="mypanel" data-position="left" data-display="overlay">
                <ul data-role="listview" data-inset="true">
                    <li><span class="icon1 icon-send"></span><a onclick="window.location = ''" 
                                                                data-onclick='$.mobile.changePage("#main", {transition: "slideup"});' class="deen-btn lang" data-lang="menu_send">Отправить</a></li>
                    <li><span class="icon1 icon-inbox"></span><a  href="#inbox" class="deen-btn lang" data-lang="menu_letters">Письма <span class="inbox-col" id="inbox-col"></span></a></li>
                    <li><span class="icon1 icon-about"></span><a onclick='$.mobile.changePage("#about", {transition: "slideup"});' class="deen-btn lang" data-lang="menu_about">О программе</a></li>
                    <li class="hide_in_full_version"><span class="icon1 icon-buy"></span><a  onclick='$.mobile.navigate("#paypage");' class="deen-btn lang" data-lang="menu_fullversion">Полная версия</a></li>
                    <li><span class="icon1 icon-config"></span><a  onclick='$.mobile.navigate("#profile");' class="deen-btn lang" data-lang="menu_sync">Синхронизация</a></li>
                    <li><span class="icon1 icon-exit"></span><a href="#" onclick="ExitApp();" class="deen-btn lang" data-lang="menu_exit">Выйти</a></li>
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
            <!-- PANEL -->
            <div data-theme="a" data-role="header" style="z-index: 999">
                <a href="#mypanel" id="top-menu"><span class="icon2 icon-menu"></span></a>
                <h3></h3>
            </div>
            <div data-role="content">


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
                    <div id="smallImage">  

                    </div>
                    <!--
                          <div class="image-conteiner" style="background-image:url(img/rek-cw.jpg)">
                            <a onclick="ImageDelete(this)" class="remove-img-btn"></a>
                            <img class="gimg" id="imgxc" src="img/rek-cw.jpg">
                        </div>

                        <div class="image-conteiner" style="background-image:url(img/rek-bk.png)">
                            <a onclick="ImageDelete(this)" class="remove-img-btn"></a>
                            <img class="gimg" id="imgxc" src="img/rek-cw.jpg">
                        </div>
			
                        <div class="image-conteiner" style="background-image:url(img/rek-cw.jpg)">
                            <a onclick="ImageDelete(this)" class="remove-img-btn"></a>
                            <img class="gimg" id="imgxc" src="img/rek-cw.jpg">
                        </div>
                    -->
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
                    <!--billing_buy\
                    <img class="gimg" id="imgxc" src="http://tel.bashqort.com/images/bashqort_tele2.jpg">
                   <br/><div class="btn btn-send" onclick="billing_buy('com.deen812.letter2feature.full')">billing_buy()</div> 
                     <br/><div class="btn btn-send" onclick="SyncUpdateDataFormServer()">SyncUpdateDataFormServer</div> 
                     <br/><div class="btn btn-send" onclick="ClearData()">ClearData</div>
                    -->
                </div>

                <!--
                <div  class="hide_in_full_version">
                    <center>
                        <h3>Немножко рекламы</h3>

                        <a   onclick='window.open("market://details?id=com.deen812.catswar", "_system");'>
                            <img src="img/rek-cw.jpg" class="rekimg">
                        </a>
                        <a   onclick='window.open("market://details?id=com.deen812.crazychicken", "_system");'>
                            <img src="img/rek-bk.png" class="rekimg">
                        </a>
                    </center>
                </div>
                -->
            </div>
        </div> 


        <!--inbox -->
        <div data-role="page" id="inbox">
            <div data-role="header">
                <a href="#main"  data-shadow="false"  data-iconshadow="false" class="btn-back-top"  ><span class="ico"></span></a>
                <h1 class="title">Письма</h1>
            </div>
            <div data-role="content" >
                <div id="inbox_content_cols" class="inbox_content_cols inbox-container">

                </div>
                <div class="div-center div-color div-color-none">
                    <button class="letter-icon" onclick='$.mobile.changePage("#main", {transition: "slideup"});'>Написать письмо</button>
                </div>
                <div class="inbox_content"  id="inbox_content">
                </div>


            </div>
        </div>


        <!--inbox -->
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






        <!-- -----------------------------GOODS-LIST---------------------->
        <div data-role="page" id="add">
            <div data-role="header">
                <a href="#main"  data-shadow="false"  data-iconshadow="false" class="btn-back-top"  ><span class="ico"></span></a>
                <h1 class="title">Добавить</h1>
            </div>
            <div data-role="content" class=""> 
                <center>
                    <h2>Добавьте фото</h2>
                    <img class="loadingimg" src="/l2f/css/images/loading.gif">  
                </center>
                <table class="new-good-tble">
                    <tr>
                        <td><a class="a-icon-btn icon-photo"   data-role="button" onclick="capturePhoto()"></a></td>
                        <td><a class="a-icon-btn icon-gallery"  data-role="button"  onclick="getImageGallery()"></a></td>
                    </tr>
                </table>
            </div><!-- /content -->
        </div>
        <!-- ----------------------------- --------------------------------->


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



        <!-- О программе -->
        <div data-role="page" id="about">
            <div data-role="header">
                <a href="#main"  data-shadow="false"  data-iconshadow="false" class="btn-back-top"  ><span class="ico"></span></a>
                <h1 class="title">О программе</h1>
            </div>
            <div data-role="content" class="text-content">               
                <div class="container">
                    <p style="text-align: justify">Напиши себе в будущем письмо. Расскажи как поживаешь, о чем мечтаешь, куда стремишься и что пережил. 
                        Ты из будущего прочитает письмо, вспомнит былые времена. Возможно загрустит, возможно обрадуется. 
                        Сможет  понять чего добился и от чего пришлось отказаться.
                    </p>             
                    <p>версия: <b>4.0.1</b></p>
                    <p>контакты: <b>deen812@mail.ru</b></p>
                    <center>
                        <Img src="/l2f/css/logo-clock-64.png">
                    </center>
                    <!--<p> разработчик:Кагарманов Дeнис</p>-->
                    <h3>Политика конфиденциальности персональной информации</h3>
                    <p style="text-align: justify">Записи которые дублируются на сервер кодируются по ключу. В качестве ключа
                        используется ваш email. Ваш email нигде кроме как для синхронизации и отсылки уведомления (при покупке полной версии)
                        не используется.</p>


                    <h3>____________________</h3>
                    <div class="btn btn-send" onclick="ShowNotification()">Проверка уведомлений</div>
                </div>          
            </div><!-- /content -->
        </div>
        <!-- ----------------------------- --------------------------------->






        <!-- -----------------------------about---------------------->
        <div data-role="page" id="buy">
            <div data-role="header">
                <a href="#main"  data-shadow="false"  data-iconshadow="false" class="btn-back-top"  ><span class="ico"></span></a>
                <h1 class="title">Полная версия</h1>
            </div>
            <div data-role="content" class="text-content"> 
                <div class="container">
                    <p>Расширение функционала</p>
                    <ul>
                        <li>Синхронизация данных c сервером</li>
                        <li>Отрпавка уведомления на почту(email)</li>
                        <!-- <li>Уведомление на телефоне</li> -->
                        <!-- <li>Отрпавка  на любую почту(email)</li>    -->             
                    </ul>
                </div>          

            </div><!-- /content -->
        </div>
        <!-- ----------------------------- --------------------------------->



        <!-- ----------PROFILE----------------->
        <div data-role="page" id="profile">
            <div data-role="header">
                <a href="#main"  data-shadow="false"  data-iconshadow="false" class="btn-back-top"  ><span class="ico"></span></a>
                <h1 class="title">Профиль</h1>
            </div>
            <div data-role="content" class="text-content"> 
                <div class="container">
                    <h2>Зачем вам синхронизация?</h2>
                    <p>Без синхронизации ваши записи хранятся в памяти телефона. Если вы поменяете телефон, или же сбросите данные
                        то все записи потеряются. А при синхронизации ваши записи будут дублироваться на удаленные сервер и от  туда 
                        в случае потери данных можно скачать ваши записи.
                    </p>
                    <p>Также, для  отпавки сообщений на email необходима синхронизация.</p>

                    <div class="show_in_full_version profile-succes-text">
                        <p>У вас полная версия приложения!</p>
                    </div>

                    <table class="table2 " >
                        <tr>
                            <td>Email для синхронизации:</td> 
                            <td class="user_email">deen812@mail.ru</td>
                            <td class="user_email_edit"><a class="myhref" onclick="SyncChangeEmail()">изменить</a></td>
                        </tr>
                    </table>
                    <div id="no-sync-alert" style="display: none">
                        <div class="alert alert-red hide_in_full_version">
                            Внимание, ваши данные не синхронизированы.<br>
                            Необходимо указать email, затем купить полную версию.

                        </div>
                        <div class="div-buttons-center">
                            <button  onclick="SetUserEmail()" class="btn-green">Включиь синхронизацию!</button>                      
                        </div> 
                    </div>
                    <div class="if_email_y_full_no">
                        <div class="alert alert-red hide_in_full_version">
                            Вам необходимо купить полную версию для того чтобы ваши данные
                            дублировались на сервер.

                        </div>
                        <button  onclick='$.mobile.navigate("#paypage")' class="btn-green">Купить полную версию!</button>
                    </div>
                    <!--
                    <div class="hide_in_full_version">
                         <button  onclick='$.mobile.navigate("#paypage")' class="btn-green">Купить полную версию!</button>
                    </div>
                    -->

                </div>          

            </div><!-- /content -->
        </div>
        <!-- ----------------------------- --------------------------------->


        <!-- -----------------------------about---------------------->
        <div data-role="page" id="user">
            <div data-role="header">
                <a data-rel="back"  data-shadow="false"  data-iconshadow="false" class="btn-back-top"  ><span class="ico"></span></a>
                <h1 class="title">...</h1>
            </div>
            <div data-role="content" class="text-content"> 
                <div class="container">
                    <section class="user-set-email">
                        <p>Указывайте корректный email , так как  при помощи почты можно будет восстанавливать данные.</p>
                        <span>email:</span>
                        <input type="email" id="emailreg" placeholder="my-email@mail.ru" value="">
                        <button onclick="SyncRegistration()" class="SyncRegistration">Вперед!</button>
                    </section>

                    <section class="auth">
                        <p>На вашу почту <b id="authemail"></b> выслан пароль. Введите этот пароль в поле и нажмите отправить!</p>
                        <span>пароль:</span>

                        <input type="text" id="auth_password" placeholder="*****" >
                        <button onclick="SyncAuth()" class="SyncRegistration">Отправить!</button>
                    </section>
                </div>          

            </div><!-- /content -->
        </div>
        <!-- ----------------------------- --------------------------------->

        <div class="ads" id="ad-bottom">
            <a class="hide-btn" onclick="AdsClose()">x</a>
            <div class="ads ads-content"> </div>
        </div>
        <div id="log2" style="color: red;
             position: absolute;
             bottom: 0;
             left: 0;">

        </div>
    </body>
</html>
