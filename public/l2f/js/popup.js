var alert2CloseIgnore = false;

function popupShowSucces() {
    $('.layer-succes1').css('right', 0);
    $('.layer-succes2').css('bottom', 0);
    $('.layer-succes3').css('left', 0);
    $('.layer-succes4').css('top', 0);
}
function alert2Close() {
    if (alert2CloseIgnore) {
        // alert2CloseIgnore = false;
        return false;
    }
    $('#alert').css('left', '100%');
}
function alert2(title, conf) {
    $('#alert').attr('class', '');
    $('#alert').addClass('layer');
//layer-theme-4
    if (conf != undefined) {
        $('#alert').addClass('layer-theme-' + conf.theme);
    } else {

        $('#alert').addClass('layer-theme-4');
    }
    ShowLayer('alert');
    $('#alert_text').html(title);
}
function ShowLayer(cmd) {
    var l = $('#' + cmd);

    if (l.data('pos') === 'right') {
        console.log(l.data('pos'));
        l.css('right', 0);
    } else {
        l.css('left', 0);
    }
}

function SucessHide() {
    $('.layer-succes-message').fadeOut(200);
    setTimeout(function () {
        $('.layer-succes1').css('right', '100%');
        $('.layer-succes2').css('bottom', '100%');
        $('.layer-succes3').css('left', '100%');
        $('.layer-succes4').css('top', '100%');

    }, 500);


}
/*
 * 
 * Проверяет , есть ли новые письма
 * и выводит уведомление
 */
function CheckNewMessageAlert() {
    var timeStamp = Math.floor(Date.now());
    db.SQL("SELECT * FROM DATA WHERE future_time<=" + timeStamp + "", function (row) {
        console.log(row);
        if (row.length > window.localStorage.getItem("last_check_alert", 0)) {
            window.localStorage.setItem("last_check_alert", row.length);
            var text = '<p>Дзинь- дзинь! Вам сообщение из прошлого!<br> \n\
<center><button class="btn-check"  onclick=\'$.mobile.navigate("#inbox");\'>прочитать!</button></center></p>';
            alert2(text, {theme: 'red small-text'});
        }
    })


}


function AllMessagesNoReadedDatail() {
    var timeStamp = Math.floor(Date.now());
    db.SQL("SELECT future_time FROM DATA WHERE future_time>" + timeStamp + "  AND future_time!='NaN' ORDER BY future_time ASC", function (row) {
        console.log(row);
        if (row.length > 0) {
            var obj = row.item(0);
            var text = '<p>Следующее письмо придет:<br/> <b> ' + getNormalDate(obj.future_time) + '</b></p>';
            obj = row.item(row.length - 1);
            text += '<p>Последнее письмо придет: <br/><b>' + getNormalDate(obj.future_time) + '</b></p>';
            // text+='<p>В этом месяце писем: </p>';
            alert2(text, {theme: 'white small-text'});
        }
    })


}
//Проверяет есть ли записи на сегодня.
function CheckAllMessagesNoReaded() {
    ///console.log('CheckAllMessagesNoReaded...');
    $('#inbox_content_cols').html('');
    var timeStamp = Math.floor(Date.now());
    db.SQL("SELECT * FROM DATA WHERE future_time>" + timeStamp + "", function (row) {
        if (row.length > 0) {
            $('.inbox_content_cols').html('<a class="noreaded" onclick="AllMessagesNoReadedDatail()">Недоставленных писем: <b>' + row.length + '</b> <span>подробнее</span></a>');
        } else {
            $('.inbox_content_cols').html('');
        }
    });


}