<!doctype html>
<html>

    <head>
        <title>Письмо в будущее</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">  
	<meta http-equiv="Content-Security-Policy" content="script-src 'self' 'unsafe-eval' 'unsafe-inline' *; object-src 'self'; style-src 'self' 'unsafe-inline'; media-src *"> 

	<link rel="stylesheet" href="/l2f/css/jquery.mobile.icons.min.css" />
        <link href="/l2f/css/jquery.mobile.structure-1.4.5.min.css" rel="stylesheet">
        <link rel="stylesheet" href="/l2f/css/bl.min.css" />

	<script src="/l2f/lib/jquery.min.js"></script>
        <script src="/l2f/css/jquery.mobile-1.4.5.min.js"></script>  

	<script src="/l2f/js/popup.js"></script>
        <script src="/l2f/js/functions.js"></script>

        <script src="/l2f/js/ad.js"></script>
        <script src="/l2f/js/syn.js"></script>


        <script src="/l2f/js/picture.js"></script>
        <script src="/l2f/js/localization.js"></script>

        <script src="/l2f/js/app.js"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<script type="text/javascript">
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
	</script>
    </head>
    <body>

	@include('l2f.layers')

        <div data-role="page" id="main">
	    @include('l2f.menu')

            <!-- PANEL -->
            <div data-theme="a" data-role="header" style="z-index: 999">
                <a href="#mypanel" id="top-menu"><span class="icon2 icon-menu"></span></a>
                <h3></h3>
            </div>
            <div data-role="content">
		@include('l2f.letter_send')              
            </div>
        </div> 

	@include('l2f.inbox')
	@include('l2f.inbox_detail')
	@include('l2f.paypage')
	@include('l2f.about')








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
