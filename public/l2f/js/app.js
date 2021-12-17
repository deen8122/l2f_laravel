var db = null;
var selectedImageId = 1;
var lc = null;
var server = {domain: ''}
var idOpenedMessage = 0;
var full_version = 0;
var currentLang = '';
var serverName = 'http://l2f-laravel';
//serverName = 'http://l2fserver:81/';
var IDdevice = 812;
var syncHash = '12354fgdfg';
var syncIndex = 0;
var log = function (e) {
    console.log('---log---')
    console.log(e);
    var log = JSON.stringify(e)

    $('#log2').append('<br>' + log);

};

document.addEventListener('deviceready', function () {

    navigator.globalization.getPreferredLanguage(
            function (language) {

                if (language.value == "en-US" || language.value == "en-GB" || language.value == "en-IN") {
                    currentLang = "en";
                    lang_SetTexts();
                }
            },
            function () {

            }
    );

}, false);

$(document).on("pageshow", "#main", function (event) {
    InitApp();
    // makeList();
    //ads_Show();
    MSG_show();
    window.onerror = function myErrorHandler(errorMsg, url, lineNumber) {
        log("<span style='color:red'>Error occured: " + errorMsg + '<br>url:' + url + '<br>line: ' + lineNumber + '</span>');//or any message
        return false;
    }

});

function plus() {}

//------------- ИНИЙИАЛИЗАЦИЯ -------------------
function InitApp() {
    full_version = window.localStorage.getItem("full_version", 0);
    console.log('InitApp()');


    $.support.cors = true;
    //   $.mobile.allowCrossDomainPages = true;
    var lastTime = window.localStorage.getItem("lastTime");
    var today = new Date();
    var month = dateAdd(today, 'day', 1);
    // month =  month.toISOString().substr(0, 10);
    // console.log(month);
    $('#date').val(month.toISOString().substr(0, 10));
    // $('#date').val(today.getDay()+"."+ today.getMonth()+"."+today.getFullYear());
    var h = today.getHours();
    if (h < 10) {
        h = '0' + h;
    }
    var s = today.getMinutes();
    if (s < 10) {
        s = '0' + s;
    }
    var time = h + ':' + s;
    // alert(time);
    $('#time').val(time);

    $('#select-photo-btn').show();

    let url = serverName + 'api/profile';
    console.log(url);

    $.ajax({type: 'GET',
        beforeSend: function (xhr) {
            xhr.withCredentials = true;
        },
        data: {}, url: url,
        success: function (responce) {
            console.log(responce);
        },
        error: function (responce) {
            console.log(responce);
        }
    });
}





//--------------------------------------------------
$(document).on("pageshow", "#inbox", function (event) {

}
);

var pn = 0;


























//--------------------------------------------------
/*
 * Детальная страница письма
 */
$(document).on("pageshow", "#inbox_detail", function (event) {
    db = new DB();
    $('#cont-img').html('');
    $('#cont-audio').html('');
    var timeStamp = Math.floor(Date.now());

    db.SQL("SELECT * FROM DATA WHERE future_time<=" + timeStamp + " AND flag=1 AND id=" + idOpenedMessage, function (row) {
        // console.log(row);
        if (row.length > 0) {
            $('#inbox-col').html('(' + row.length + ')');

            var t = '<div class="inbox-container">';
            for (var i = 0; i < row.length; i++) {
                var obj = row.item(i);
                t += '<div class="itemwhite">';
                t += '<div class="date">отправлено: <b>' + getNormalDate(obj.created_time) + '</b></div>';
                t += '<div class="date">получено: <b>' + getNormalDate(obj.future_time) + '</b></div>';
                t += '<div class="text">' + obj.text + '</div>';
                t += '</div>';
            }
            t += '</div>';
            $('.inbox_detail').html(t);
            db.getDataFromSQL(
                    "SELECT * FROM IMAGES WHERE id_data=" + obj.id,
                    function (arr) {
                        for (var i = 0; i < arr.length; i++) {
                            var obj = arr.item(i);
                            $('#cont-img').append('<img  class="img" src="' + obj.filename + '">')
                        }
                    });
            db.getDataFromSQL(
                    "SELECT * FROM AUDIO WHERE id_data=" + obj.id,
                    function (arr) {
                        for (var i = 0; i < arr.length; i++) {
                            var obj = arr.item(i);
                            $('#cont-audio').append('<a  class="btn_audio" id="audio-' + obj.id + '" onclick="Audio_Play(' + obj.id + ',\'' + obj.filename + '\')">Воспроизвести</a>')
                        }
                    });
            //Обновлем параметр о том что прочтен
            db.updateData("DATA", "id=" + obj.id, ['opened'], [0], function (row) { })
        }
    })
});

function OpenInbox(_this, id) {
    //alert(id);
    idOpenedMessage = id;
    $('.inbox_detail').html('');
    $.mobile.navigate("#inbox_detail");
}
function CloseMessage() {
    $('.layer-succes1').css('right', 0);
    $('.layer-succes2').css('bottom', 0);
    $('.layer-succes3').css('left', 0);
    $('.layer-succes4').css('top', 0);
    db.updateData("DATA", "id=" + idOpenedMessage, ['flag'], [2], function (row) {
        SyncSetFlag2(idOpenedMessage);
        setTimeout(function () {
            CheckTodayMessage();
            UpdateMessageList();
            SucessHide();
            $.mobile.navigate("#inbox");
        }, 500);

    });

}
function SetMessageShowed(idMessage) {
    db.updateData("DATA", "id=" + idMessage, ['showed'], [1], function (row) {
    })
}
/*
 * 
 * Выводит список сообщений
 */
function UpdateMessageList() {
    //console.log('UpdateMessageList...');
    var timeStamp = Math.floor(Date.now());
    //console.log(timeStamp);
    timeStamp = new Date().getTime();
    // console.log(timeStamp);
    // console.log(new Date());
    /*
     * 1502882712653
     * 1502968680000
     */
    db.SQL("SELECT * FROM DATA WHERE future_time<=" + timeStamp + " AND flag=1 ORDER BY opened DESC,future_time DESC LIMIT 50", function (row) {
        if (row.length > 0) {
            $('.inbox-col').html('(' + row.length + ')');

            var t = '<div class="inbox-container">';
            for (var i = 0; i < row.length; i++) {
                var obj = row.item(i);
                console.log(obj);
                t += '<div class="item ' + (obj.opened == 1 ? 'item-no-readed' : '') + '" onclick="OpenInbox(this,' + obj.id + ')">';
                // if(obj.filename!=null){t+= '<div class="hasimg"></div>'; }
                t += '<div class="date">отправлено: <b>' + getNormalDate(obj.created_time) + '</b></div>';
                //  t += '<div class="date">получено: <b>' + getNormalDate(obj.future_time) + '</b></div>';
                t += '<div class="text">' + obj.text + '</div>';
                t += '</div>';

            }
            t += '</div>';
            $('#inbox_content').html(t);
        } else {
            $('#inbox_content').html('<div class="empty-inbox">Нет писем из прошлого</div>')
        }

    })

    //inbox_content_cols
    CheckAllMessagesNoReaded();

}





