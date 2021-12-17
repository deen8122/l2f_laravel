
//==========
function DendImageTest() {
    $('.gimg').each(
            function (indx, element) {
                var src = $(element).attr('src');
                console.log(src);
                SendImageToServer(src);
            });

}
function SendImageToServer(imagefile, id, id_data) {
    var ft = new FileTransfer();
    var options = new FileUploadOptions();
    options.fileKey = "vImage";
    options.fileName = imagefile.substr(imagefile.lastIndexOf('/') + 1);
    // console.log(options.fileName);
    options.mimeType = "image/jpeg";
    var params = new Object();

    var email = window.localStorage.getItem("user_email");
    var hash = window.localStorage.getItem("user_hash");
    params.email = email;
    params.hash = hash;
    params.id_data = id_data;
    params.id = id;
    options.params = params;
    options.chunkedMode = false;
    ft.upload(imagefile, serverName + '?act=saveimage&mode=upload', SendImageToServerSuccess, SendImageToServerFail, options);

}


/*
 * 
 * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 * +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 */

function SynSendAudioToServer() {
    console.log('............................................SynSendImagesToServer....................................');
    db.getDataFromSQL("SELECT * FROM AUDIO WHERE  sync!=1",
            function (arr) {
                if (arr.length > 0) {
                    for (var i = 0; i < arr.length; i++) {
                        var obj = arr.item(i);
                        console.log(JSON.stringify(obj));
                        SendAudioToServer(obj.filename, obj.id, obj.id_data);
                    }
                } else {
                    console.log('Нет записей для синхронизации!');
                    // alert("Нет записей для синхронизации!");
                }
            });

}
function SendAudioToServer(imagefile, id, id_data) {
    var ft = new FileTransfer();
    var options = new FileUploadOptions();
    options.fileKey = "vImage";
    options.fileName = imagefile.substr(imagefile.lastIndexOf('/') + 1);
    var params = new Object();
    var email = window.localStorage.getItem("user_email");
    var hash = window.localStorage.getItem("user_hash");
    params.email = email;
    params.hash = hash;
    params.id_data = id_data;
    params.id = id;
    options.params = params;
    options.chunkedMode = false;
    ft.upload(imagefile, serverName + '?act=saveaudio&mode=upload',
            function (data) {
                console.log(JSON.stringify(data.response));
                var json = JSON.parse(data.response);
                console.log(JSON.stringify(json));
                if (json.code == 'OK') {
                    var UpdatedID = json.id2;
                    db.updateData("AUDIO", "id=" + UpdatedID, ['sync'], [1], function (row) {})
                    console.log('Успешно обновлено id=:' + UpdatedID);
                } else {
                    console.log('ERROR 46');
                }
            },
            function () {},
            options);

}



function SendImageToServerSuccess(data) {
    console.log(JSON.stringify(data.response));
    var json = JSON.parse(data.response);
    console.log(JSON.stringify(json));
    if (json.code == 'OK') {
        var UpdatedID = json.id2;
        db.updateData("IMAGES", "id=" + UpdatedID, ['sync'], [1], function (row) {})
        console.log('Успешно обновлено id=:' + UpdatedID);
    } else {
        console.log('ERROR 46');
    }
}
function SendImageToServerFail(data) {
    console.log('SendImageToServerFail...');
    console.log(JSON.stringify(data));
}
/*
 * 
 * ЗАПУСК синхронизации.
 * Алгоритм:    
 * -вызов
 * -провекра на новые записи
 */
function SynStart() {
    console.log('SynStart...');
    SynSendImagesToServer();
    SynSendAudioToServer();
    if (window.localStorage.getItem("is_updated") == 1) {
        console.log('Обновлен...');
        //  return false;

    }
    var email = window.localStorage.getItem("user_email");
    var hash = window.localStorage.getItem("user_hash");
    console.log(email);
    console.log(hash);
    $.ajax({type: 'POST', data: 'hash=' + hash + '&email=' + email,
        url: serverName + '?act=auth',
        success: function (data) {
            console.log(data);
            try
            {
                var json = JSON.parse(data);
                if (json.code == 'ERROR') {
                    // alert2(json.message, {theme: 'red'});
                    window.localStorage.setItem("user_hash", "");
                    window.localStorage.setItem("user_email", "");

                }
                if (json.code == 'OK') {
                    SynSendDataToServer();

                }
            } catch (e) {
                console.log('Ошибка JSON');
            }
        },
        error: function () {
            // $('.server-content').html('<p class="error">Ой.Сервер не отвечает... (@_@)</p>');
        }
    });


}
/*
 * 
 * @returns {undefined}
 * 
 */

function SynSendDataToServer() {
    console.log('SynSendDataToServer...');
    var Ngood = 0;
    // var timeStamp = Math.floor(Date.now());
    db.getDataFromSQL("SELECT * FROM DATA WHERE flag=1 AND sync!=1",
            function (arr) {
                var data = '';
                // alert("SELECT * FROM GOOD" + sql);
                if (arr.length > 0) {
                    for (var i = 0; i < arr.length; i++) {
                        var obj = arr.item(i);
                        Ngood++;
                        data += '&data[' + i + '][id]=' + obj.id +
                                '&data[' + i + '][flag]=' + obj.flag +
                                '&data[' + i + '][text]=' + obj.text +
                                '&data[' + i + '][created_time]=' + obj.created_time +
                                '&data[' + i + '][emails]=' + obj.emails +
                                '&data[' + i + '][future_time]=' + obj.future_time;

                    }
                    console.log("Ngood=" + Ngood);
                    var email = window.localStorage.getItem("user_email");
                    var hash = window.localStorage.getItem("user_hash");
                    $.ajax({type: 'POST',
                        data: 'hash=' + hash + '&email=' + email + data,
                        url: serverName + '?act=insert',
                        success: function (data) {
                            console.log("FROM SERVER^");
                            console.log(data);
                            try
                            {
                                var json = JSON.parse(data);

                                if (json.code == 'OK') {
                                    // window.localStorage.setItem("is_updated", 1);
                                    var arrUpdated = JSON.parse(json.arr);
                                    //  console.log(arrUpdated);
                                    for (var i = 0; i < arrUpdated.length; i++) {
                                        //console.log(arrUpdated[i]);
                                        db.updateData("DATA", "id=" + arrUpdated[i], ['sync'], [1], function (row) {})

                                    }
                                    console.log('Успешно обновлено записей:' + arrUpdated.length);
                                    // SyncGetData();
                                    // alert('На сервере есть записи. Необходимо сначала их загрузить. Нажмите на кнопку "загрузить данные из сервера"');
                                    //   alert(-1);
                                } else {

                                }


                            } catch (e)
                            {
                                //alert2(json.message,{theme:'red'});
                                console.log('Ошибка JSON');
                            }
                            // setTimeout(function(){$('#sync-log').html('')}, 4000);
                        },
                        error: function () {
                            alert2('Ошибка синхронизации.Сервер забил болт...', {theme: 'red'});
                        }
                    });

                } else {
                    console.log('Нет записей для синхронизации!');
                    //alert("Нет записей для синхронизации!");
                }
            });

}



function SynSendImagesToServer() {
    console.log('............................................SynSendImagesToServer....................................');
    db.getDataFromSQL("SELECT * FROM IMAGES WHERE  sync!=1",
            function (arr) {
                if (arr.length > 0) {
                    for (var i = 0; i < arr.length; i++) {
                        var obj = arr.item(i);
                        console.log(JSON.stringify(obj));
                        SendImageToServer(obj.filename, obj.id, obj.id_data);
                    }
                } else {
                    console.log('Нет записей для синхронизации!');
                    // alert("Нет записей для синхронизации!");
                }
            });

}





$(document).on("pagebeforeshow", "#profile", function (event) {
    //$('#sync-log').html('...');
    var email = window.localStorage.getItem("user_email");
    if (email == undefined || email == '') {
        $('.if_email_y_full_no').hide();
        $('#no-sync-alert').show();
        email = '<span class="profile-user-email-none" >нет синхронизации</span>';
        //user_email_edit
        $('.user_email_edit').html('<a class="myhref" onclick="SetUserEmail()">Добавить почту</a>');
    } else {
        $('#no-sync-alert').hide();
        $('.user_email_edit').html('<a class="myhref" onclick="SyncChangeEmail()">Изменить почту</a>');
        if (window.localStorage.getItem("full_version", 0) == '1') {
            $('.if_email_y_full_no').hide();
        } else {
            $('.if_email_y_full_no').show();
        }
    }
    // $('#sync-log').append(email);
    $('.user_email').html(email);
});
function SetUserEmail() {
    var t = '';
    $('#user .user-set-email').show();
    $.mobile.changePage("#user", {transition: "slideup"})

}


function SyncSetFlag2(idgood) {
    console.log('SyncSetFlag2 ' + idgood);
    var email = window.localStorage.getItem("user_email");
    var hash = window.localStorage.getItem("user_hash");
    $.ajax({type: 'POST', data: 'hash=' + hash + '&email=' + email,
        url: serverName + '?act=setflag2&id=' + idgood,
        success: function (data) {
            console.log(data);
        },
        error: function () {}
    });
}

function SyncCheckFullVersion() {
    var email = window.localStorage.getItem("user_email");
    var hash = window.localStorage.getItem("user_hash");
    if (email == undefined) {
        alert2('<span style="font-size:14px;">Для начала укажите email в разделе СИНХРОНИЗАЦИЯ</span>', {theme: 'red'});
        return;

    }
    $.ajax({type: 'POST', data: 'hash=' + hash + '&email=' + email,
        url: serverName + '?act=checkfullversion',
        success: function (data) {
            console.log(data);
            try
            {
                var json = JSON.parse(data);
                if (json.code == 'ERROR') {
                    alert2('Мне очень жаль. У вас обычная версия!', {theme: 'red'});

                }
                if (json.code == 'OK') {
                    alert2('Шеф,все ок - у вас платная версия!', {theme: 'green'});
                    window.localStorage.setItem("full_version", 1);
                    Buy_CheckFullVersion();
                    WorkInBackground();
                }
            } catch (e) {
                alert2('Ошибка:ERROR_SC_FV1 Сервер забил болт...', {theme: 'red'});
            }
        },
        error: function () {
            alert2('Ошибка:ERROR_SC_FV2 Сервер забил болт...', {theme: 'red'});
        }
    });
}
function SyncSetFullVersion() {
    var email = window.localStorage.getItem("user_email");
    var hash = window.localStorage.getItem("user_hash");
    $.ajax({type: 'POST', data: 'hash=' + hash + '&email=' + email,
        url: serverName + '?act=setfullversion',
        success: function (data) {
            console.log(data);
            try
            {
                var json = JSON.parse(data);
                if (json.code == 'ERROR') {
                    console.log('SyncSetFullVersion ERROR');

                }
                if (json.code == 'OK') {
                    console.log('SyncSetFullVersion OK');
                }
            } catch (e) {
                console.log('Ошибка JSON');
            }
        },
        error: function () {
            // $('.server-content').html('<p class="error">Ой.Сервер не отвечает... (@_@)</p>');
        }
    });


}









//получает все данные из сервера и сохраняет на 
// телефоне, причем, если  есть запись с одинаковым ИД то запись
// на телефоне перемещается в конец.
function SyncGetData(callback) {
    console.log('SyncGetData');
    var email = window.localStorage.getItem("user_email");
    var hash = window.localStorage.getItem("user_hash");
    $('.SyncGetData').addClass('loading');
    $.ajax({type: 'POST', data: 'hash=' + hash + '&email=' + email,
        url: serverName + '/getdata',
        success: function (data) {
            $('.SyncGetData').removeClass('loading');
            // callback(data);
            //$('#btngetdatas').hide(500);
            SyncSaveServerData(data);
        },
        error: function () {
            $('.SyncGetData').removeClass('loading');
            $('.server-content').html('<p class="error">Ой.Сервер не отвечает... (@_@)</p>');
        }
    });
}
var rTitle = '';
function CompStr(str1, str2)
{
    str1 = str1.replace(/[/.,!?;()'" ]*/g, '');
    str2 = str2.replace(/[/.,!?;()'" ]*/g, '');
    // str2 = str2.replace(/[/.,!?; ]*/g, '');
    //  str1 = $.trim(str1);
    //   str2 = $.trim(str2);
    // Удаляем все пробелы, используя
// регулярные выражения в JavaScript (RegEx):
//var text3 = " a b    c d e   f g   ";
//var newText3 = text3.replace(/\s+/g, '');
    str1 = str1.replace(/\s+/g, '');
    str2 = str2.replace(/\s+/g, '');
    //alert(str1+str2);
    //return fUpperCase(Str.toString())==fUpperCase(Str2.toString());
    return (str1.toUpperCase() == str2.toUpperCase()) ? true : false;
}



function SyncAuthPageOpen() {
    $('#user section').hide();
    $('#user section.auth').show();
    $.mobile.changePage("#user", {transition: "slideup"});
}


function SyncAuth() {

    var email = $('#authemail').text();
    var pass = $('#auth_password').val();
    console.log(pass);
    console.log(email);
    if (email.length < 2) {
        alert2('Некорректный email... (@_@)', {theme: 'red'});
        return;
    }
    if (pass.length < 4) {
        alert2('Некорректный пароль... (@_@)', {theme: 'red'});
        return;
    }

    $('.SyncAuth').addClass('loading');

    $.ajax({
        type: 'POST',
        data: 'email=' + email + '&pass=' + pass + '',
        url: serverName + '?act=auth',
        success: function (data) {
            console.log(data);
            $('.SyncAuth').removeClass('loading');
            var json = JSON.parse(data);
            if (json.code == 'ERROR') {
                alert2(json.message, {theme: 'red'});

            }
            if (json.code == 'OK') {
                window.localStorage.setItem("user_email", email);
                window.localStorage.setItem("user_hash", json.hash);
                alert2('Ура! Вы авторизованы!', {theme: 'green'});
                $.mobile.navigate("#profile");
                //После успешной авторизации запускаем синхронизацию на получение данных
                SyncUpdateDataFormServer();
            }
        },
        error: function () {
            $('.SyncAuth').removeClass('loading');
        }
    });
}
function SyncRegistration() {
    var email = $('#emailreg').val();
    if (!check_email(email)) {
        return;
    }
    var pass = Math.random();
    $('.SyncRegistration').addClass('loading');
    //  return;
     $.ajax({
        type: 'POST',
        crossDomain: true,
       //  headers: {  'Access-Control-Allow-Origin': serverName },
        data: 'email=' + email + '&pass=' + pass + '',
        url: serverName + '?act=test',
        success: function (data) {
            console.log(data);
            log(JSON.stringify(data));
        },
        error: function (e) {
             console.log(e);
             log(e);
          
        }
    });
    
    $.ajax({
        type: 'POST',
        data: 'email=' + email + '&pass=' + pass + '',
        url: serverName + '?act=registration',
        success: function (data) {
            $('.SyncRegistration').removeClass('loading');
            console.log(data);
            var json = JSON.parse(data);
            if (json.code == 0) {
                alert('Такой email уже есть в системе. Авторизуйтесь или восстановите пароль!');
                $('#sync-reg-log').html('<p class="error"><b>' + json.message + '</p>');
            }
            //Если человек ввел почту, а на сервере уже есть почта то предлагаем
            // Восстановить доступ 
            if (json.code == 'EMAIL_EXIST') {
                $('#authemail').html(email);
                alert2('Ваша почта ранее была зарегистрирована. Для  восстановления доступа нажмите на кнопку: <br>\n\
                            <button  onclick="SyncAuthPageOpen()">ВПЕРЕД!</button>')
                //SyncAuthPageOpen()
            }
            if (json.code == 1) {
                window.localStorage.setItem("user_email", email);
                window.localStorage.setItem("user_hash", json.hash);
                alert2('Ура! Вы зарегистрированы !', {theme: 'green'});
                $.mobile.navigate("#profile");
            }
        },
        error: function (e) {
             console.log(e);
            $('.SyncRegistration').removeClass('loading');
            alert2('Сервер не доступен... попробуйте чуть позже! Уверен, чуваки там уже начали отладку)')
        }
    });
}



function SyncChangeEmail() {

    alert2('Функция не доступна :(', {theme: 'black'});
}
/*
 * 
 * @returns {undefined}
 * Отправка запроса на смену пароля!
 */
function SyncGetPass() {

    var email = $('#email_getpass').val();
    if (email.length < 2) {
        alert('Некорректный email... (@_@)');
        return;
    }
    $('.SyncGetPass').addClass('loading');
    $.ajax({type: 'POST',
        data: 'email=' + email,
        url: serverName + '/getpass',
        success: function (data) {
            alert('Новый пароль отправлен на вашу почту!');
            $('.SyncGetPass').removeClass('loading');
        },
        error: function () {
            $('#sync-log').html('<p class="error">Ошибка.Сервер не отвечает... (@_@)</p>');
            $('.SyncGetPass').removeClass('loading');
        }
    });
}
function SyncSection(cmd) {
    switch (cmd) {
        case 'reg_ok':
            break;
    }
}



//БЕРЕТ ВСЕ ДАННЫЕ ИЗ СЕРВРЕА, ВОЗВРАЩАЕТ В КОЛБАК ФУНКЦИЕЙ
function F1_Sync(func_call_back) {
    console.log('F1_Sync');
    var email = window.localStorage.getItem("user_email");
    var hash = window.localStorage.getItem("user_hash");
    $.ajax({type: 'POST', data: 'hash=' + hash + '&email=' + email,
        url: serverName + '?act=getdata',
        success: function (data) {
            func_call_back(data);
        },
        error: function () {
            func_call_back(0);
        }
    });

}
//Берем существующие данные. Меняем id на id + 10000, запомнинаем.
function F2_Sync(data, func_call_back) {
    console.log('F2_Sync');
    //console.log(data);
    var json = JSON.parse(data);
    // console.log(json);
    for (var i = 0; i < json.data.length; i++) {
        // id - это порядковый номер на сервере. тут используем id2
        var id = json.data[i].id2;
        console.log('--------------------------');
        console.log(id);
        db.getDataFromSQL("SELECT * FROM DATA WHERE id=" + id, function (arr, good) {
            //arr = - данные из БД
            //good - данные из цикла.
            if (arr.length == 1) {
                console.log("В базе есть запись с id=" + good.id2);
                var obj = arr.item(0);
                console.log('text s: ' + good.text);
                console.log('text m: ' + obj.text);
                //ЕСЛИ равны ничего не делаем
                if (CompStr(good.text, obj.text)) {
                    console.log('равны');
                } else {

                    console.log('НЕ РАВНЫ ' + good.id2);
                    //Перезаписываем!
                    db.updateData('DATA', 'id=' + obj.id, ['text', 'flag', 'created_time', 'future_time'], [good.text, good.flag, good.created_time, good.future_time], function () {
                        console.log('обновлена запись c [' + obj.text + '] на [' + good.text + ']');
                    });
                    //Делаем копию
                    db.insertData2('DATA', 'flag,text,created_time,future_time', [obj.flag, obj.text, obj.created_time, obj.future_time],
                            function () {
                                console.log('добавлена запись =>' + obj.text);
                            });

                }

            } else {
                console.log(' НЕт такой записи в БД');
                db.insertData2('DATA', 'id,flag,text,created_time,future_time',
                        [good.id2, good.flag, good.text, good.created_time, good.future_time],
                        function () {
                            console.log('добавлена запись 2');
                        });

            }
        }, json.data[i]);
        //  IDS+=','+json.goods[i].id;
    }
    window.localStorage.setItem("is_updated", 0);
    SynStart();
    /*
     db.getDataFromSQL("SELECT * FROM DATA",
     function (arr) {
     var data = '';
     // alert("SELECT * FROM GOOD" + sql);
     if (arr.length > 0) {
     for (var i = 0; i < arr.length; i++) {
     var obj = arr.item(i);
     db.updateData('DATA', 'id=' + obj.id,
     ['id'],
     [obj.id+100],
     function () {});
     }
     
     } else {
     //alert("Нет записей для синхронизации!");
     }
     });
     */
}
function SyncUpdateDataFormServer() {
    console.log('SyncUpdateDataFormServer');
    //ф1 -  Получаем все данные из сервера.
    //ф2 - Берем существующие данные. Меняем id на id + 10000, запомнинаем.
    //ф3 - Добавляем в базу данные из сервера
    //ф4 - Берем последнее id , и у тех записей что были до этого обновляем id
    //ф5 - Отправляем на сервер только новые записи
    //ф6 - Все круто. Радуемся.

    //--------------------------------------------------------------------------
    //ф1 -  Получаем все данные из сервера.
    F1_Sync(function (data_form_server) {
        //ф2 - Берем существующие данные. Меняем id на id + 10000, запомнинаем.
        if (data_form_server != 0) {
            F2_Sync(data_form_server, function (data_form_server) {
            });//F2_Sync
        }
    });//F1_Sync
    //--------------------------------------------------------------------------
    return false;


}

function SyncUpdateDataFormServer2() {
    console.log('SyncUpdateDataFormServer')
    console.log(data);
    try
    {
        var json = JSON.parse(data);
        console.log(json.rubrics);
        /*
         * 
         * Рубрики.
         * Если нет то записываем, сущесвтующие в телефоне если совпадает
         * с рубриков на сервере, переименовываем.
         */
        for (var i = 0; i < json.rubrics.length; i++) {
            rTitle = json.rubrics[i].title;
            db.getDataFromSQL("SELECT * FROM RUBRIC WHERE id=" + json.rubrics[i].id,
                    function (arr, rTitle) {
                        console.log(rTitle);
                        if (arr.length == 1) {
                            var obj = arr.item(0);
                            console.log(obj.id);
                            db.updateData('RUBRIC', 'id=' + obj.id, ['title'], [rTitle], function () {});
                        } else {
                            db.insertData2('RUBRIC', 'id, id_parent, title,text,deleted', [obj.id, 0, rTitle, '', 0], function () {});
                        }
                    }, rTitle);
        }
        //Записи
        /*
         * Если записи с сервера совпадает по id с существующими записями то 
         * записи на телефоне копирются, а первая записб перезаписывается.
         * делается это чтобы не сбились ID
         */
        for (var i = 0; i < json.goods.length; i++) {
            db.getDataFromSQL("SELECT * FROM GOOD WHERE id=" + json.goods[i].id,
                    function (arr, good) {
                        console.log(good);
                        if (arr.length == 1) {
                            var obj = arr.item(0);
                            console.log(obj.id);
                            if (good.title != '' && good.title.length > 0) {
                                //перезаписываем существующий, так как оно обновится с
                                // записью из сервера
                                db.insertData2('GOOD',
                                        'title,text,deleted,created_at,id_rubric',
                                        [good.title, good.text, 0, good.created_at, good.rubric_id],
                                        function () {
                                            console.log('добавлена запись');
                                        });
                                db.updateData('GOOD', 'id=' + obj.id,
                                        ['title', 'text', 'deleted', 'created_at', 'id_rubric'],
                                        [good.title, good.text, 0, good.created_at, good.rubric_id],
                                        function () {});
                            }
                        } else {
                            db.insertData2('GOOD',
                                    'id,title,text,deleted,created_at,id_rubric',
                                    [obj.id, good.title, good.text, 0, good.created_at, good.rubric_id],
                                    function () {
                                        console.log('добавлена запись');
                                    });
                        }
                    }, json.goods[i]);
        }
    } catch (e)
    {
        console.log('Ошибка');
    }
}



