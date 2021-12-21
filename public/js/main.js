$(document).ready(function () {
    InitApp();

});

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
    doRequest('/api/letter/count', 'get', function (responce) {
        if (responce.count > 0) {
            $('.inbox_content_cols').html('Недоставленных писем:' + responce.count);

        }
    });



}
function setDate() {

}
function Send() {
    var message = $('#message').val();
    var date = $('#date').val();
    var email_to = $('#email_to').val();
    var emailst = $('#emails').val();
    // alert(emailst);
    console.log(emailst);
    if (message.length < 2) {
        ShowLayer('empty_message');
        return false;
    }
    if (date === '') {
        ShowLayer('empty_date');
        return false;
    }
    var time = $('#time').val();
    console.log('---time----');
    console.log(time);
    if (time == 'NaN' || time == '' || time == undefined) {
        time = '00:01';
    }
    console.log(time);
    //alert(date);
    var timestump = DateToTimestump(date, time);
    console.log(timestump);

    // popupShowSucces()

    var fd = new FormData();
    var files = $('#image')[0].files;
    let url = '/letter/add';
    let sendData = {text: message, 'future_time': date};
    fd.append('images[]', files[0]);
    fd.append('text', message);
    fd.append('future_time', timestump);

    console.log(sendData);
    $.ajax({type: 'POST', data: fd, url: url, contentType: false,
        processData: false,
        success: function (responce) {
            console.log(responce);
        },
        error: function (responce) {
            console.log(responce);
        }
    });
    setTimeout(function () {
        $('.layer-succes-message').fadeIn(200)
    }, 500);

    $('#select-photo-btn').html('Прикрепить фото');
    $('#main-audio-list').html('');

}


function getLetters() {
    let $content = $('#content');
    doRequest('/api/letters', 'get', function (responce) {
        console.log(responce);
        let row = responce.data;
        if (row.length > 0) {
            $('.inbox-col').html('(' + row.length + ')');

            var t = '<div class="inbox-container">';
            for (var i = 0; i < row.length; i++) {
                var obj = row[i];
                console.log(obj);
                t += '<div class="item ' + (obj.opened == 1 ? 'item-no-readed' : '') + '" onclick="OpenInbox(this,' + obj.id + ')">';
                // if(obj.filename!=null){t+= '<div class="hasimg"></div>'; }
                t += '<div class="date">отправлено: <b>' + getNormalDate(obj.created_time) + '</b></div>';
             //    t += '<div class="date">получено: <b>' + getNormalDate(obj.future_time) + '</b></div>';
                t += '<div class="text">' + obj.text + '</div>';
                t += '</div>';

            }
            t += '</div>';
            $content.html(t);
        } else {
            $content.html('<div class="empty-inbox">Нет писем из прошлого</div>')
        }
    });
}
function doRequest(url, method, success, error) {
    console.log('-- doRequest ' + method + ' ' + url + ' --');
    let csrf = $('meta[name="csrf-token"]').attr('content');
    console.log('-- ' + csrf + ' --');

    $.ajaxSetup({
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': csrf
        }
    });
    $.ajax({
        type: method,
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', 'Bearer 1|TL5uaC6yEnlzGicaBsy7Qfb1wGf8scBjR1Gem8B7');
            //  xhr.withCredentials = true;

        },
        //  headers: {"Authorization": localStorage.getItem('token')},
        datatype: "json",
        data: {_token: csrf}, url: url,
        success: function (responce) {
            console.log(url + '-- success --');
            console.log(responce);
            if (success) {
                success(responce);
            }

        },
        error: function (responce) {
            console.log(url + '-- error --');
            console.log(responce.responseJSON);
            if (error) {
                error(responce)
            }

        }
    });
}