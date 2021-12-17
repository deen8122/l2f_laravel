function NotificationSet() {
    log('NotificationSet...');

}
function ShowNotification() {
    cordova.plugins.notification.local.schedule({
        title: 'Вам письмо из прошлого!',
        text: '......................',
        led: {color: '#FF00FF', on: 500, off: 500},
        vibrate: true,
        foreground: true
    });
}



function log(obj) {
    var str = JSON.stringify(obj);
    $('#log').append('<br>' + str)

}



















/*
 * Отправка сообщения в будущее
 * @returns {Boolean}
 */
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
    console.log('-------');
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
    let url = serverName + '/letter/add';
    let sendData = {text: message, 'future_time': date};
    fd.append('images[]', files[0]);
    fd.append('text', message);
    fd.append('future_time', date);
    console.log(fd);
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







function hideLeftBlock(id, val) {
    window.localStorage.setItem(id, val);
    $('#' + id).hide(50);
}

function DateToTimestump(date, time2) {
    console.log(date);
    console.log(time2);
    var myDate = date.split("-");

    var time = time2.split(":");

//var newDate=myDate[1]+","+myDate[2]+","+myDate[0]+","+time[0]+","+time[1];
    var newDate = myDate[0] + "," + myDate[1] + "," + myDate[2] + "," + time[0] + "," + time[1];
    console.log(newDate);
//alert(newDate);
    var y = parseInt(myDate[0]);
    var m = parseInt(myDate[1]) - 1;
    var d = parseInt(myDate[2]);
    var h = parseInt(time[0]);
    var min = parseInt(time[1]);
    console.log(y);
    console.log(m);
    console.log(d);
    return new Date(y, m, d, h, min).getTime();
    // return new Date(newDate).getTime();
}




//Проверяет есть ли записи на сегодня.
function CheckTodayMessage() {

    var timeStamp = Math.floor(Date.now());
    db.SQL("SELECT * FROM DATA WHERE future_time<=" + timeStamp + " AND flag=1", function (row) {
        console.log(row);
        if (row.length > 0) {

            $('#inbox-col').html('(' + row.length + ')');
        } else {
            $('#inbox-col').html('');
        }
    })
    CheckNewMessageAlert();
    console.log('CheckTodayMessage');
}



function setFutureTime() {
    var timeMonth = $('#futuretime').val();

    if (timeMonth == 'tomorrow') {
        var today = new Date();
        var month = dateAdd(today, 'day', 1);
        $('#date').val(month.toISOString().substr(0, 10));
    } else if (timeMonth == 'week1') {
        var today = new Date();
        var month = dateAdd(today, 'day', 7);
        $('#date').val(month.toISOString().substr(0, 10));
    } else {
        var today = new Date();
        console.log(timeMonth);
        var month = dateAdd(today, 'month', parseInt(timeMonth));
        console.log(month);
        $('#date').val(month.toISOString().substr(0, 10));
    }
}

function dateAdd(date, interval, units) {
    var ret = new Date(date); //don't change original date
    var checkRollover = function () {
        if (ret.getDate() != date.getDate())
            ret.setDate(0);
    };
    switch (interval.toLowerCase()) {
        case 'year'   :
            ret.setFullYear(ret.getFullYear() + units);
            checkRollover();
            break;
        case 'quarter':
            ret.setMonth(ret.getMonth() + 3 * units);
            checkRollover();
            break;
        case 'month'  :
            ret.setMonth(ret.getMonth() + units);
            checkRollover();
            break;
        case 'week'   :
            ret.setDate(ret.getDate() + 7 * units);
            break;
        case 'day'    :
            ret.setDate(ret.getDate() + units);
            break;
        case 'hour'   :
            ret.setTime(ret.getTime() + units * 3600000);
            break;
        case 'minute' :
            ret.setTime(ret.getTime() + units * 60000);
            break;
        case 'second' :
            ret.setTime(ret.getTime() + units * 1000);
            break;
        default       :
            ret = undefined;
            break;
    }
    return ret;
}

//Возращает читаемый вид даты из timestamp
function getNormalDate(date) {
    var ret = new Date(date);
    var month = ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'];
    // сколонение месяцев.
    var day = ret.getDate();
    var hour = ret.getHours();
    if (hour < 10)
        hour = '0' + hour;
    var min = ret.getMinutes();
    if (min < 10)
        min = '0' + min;
    // if(day <)
    return day + ' ' + month[ret.getMonth()] + ' ' + ret.getFullYear() + ' в ' + hour + ':' + min;
}



function previewFile() {
    var preview = document.querySelector('img');
    var file = document.querySelector('input[type=file]').files[0];
    var reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "";
    }
}

function ExitApp() {
    if (typeof cordova !== 'undefined') {
        if (navigator.app) {
            navigator.app.exitApp();
        } else if (navigator.device) {
            navigator.device.exitApp();
        }
    } else {
        window.close();
        $timeout(function () {
            self.showCloseMessage = true;  //since the browser can't be closed (otherwise this line would never run), ask the user to close the window
        });
    }
    //navigator.app.exitApp();
}



function testInternet(win, fail) {
    $.get("https://www.google.com/blank.html").done(win).fail(fail);
}

function GetTimeStamp() {
    var now = new Date();
    var day = now.getDate();
    if (day < 10)
        day = "0" + day;

    var hours = now.getHours();
    if (hours < 10)
        hours = "0" + hours;

    var Month = (now.getMonth() + 1);
    if (Month < 10)
        Month = "0" + Month;
    var date =
            now.getFullYear()
            + '-' + Month
            + '-' + day + ' '
            + hours
            + ':' + (now.getMinutes())
            + ':' + (now.getSeconds());
    //   console.log(date);
    return date;
}


function check_email(email, _this) {
    if (email != '') {
        var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
        if (pattern.test(email)) {
            $(_this).css({'border': '1px solid #569b44'});
            // alert('Верно');
            return true;
        } else {
            $(_this).css({'border': '1px solid #ff0000'});
            alert2('Мне кажется что email не корректный. (@_@)');
            return false;
        }
    } else {
        $(_this).css({'border': '1px solid #ff0000'});
        alert2('Поле email не должно быть пустым');
        return false;
    }
    return true;
}

function ClearData() {
    console.log('ClearData');
    db.SQL('DELETE  FROM DATA', function () {
        console.log('DELETED ALL DATA FROM DATA');
    });
}

function Buy_CheckFullVersion() {
    var full_version = window.localStorage.getItem("full_version");

    //console.log('Buy_CheckFullVersion=' + full_version);
    if (full_version == '1') {
        //hide_in_full_version
        //   console.log('hide_in_full_version Buy_CheckFullVersion=' + full_version);
        $('.hide_in_full_version').hide();
        $('.show_in_full_version').show();

        $('#ad-left').hide();
        $('#lefthelp').hide();
        $('#ad-bottom').hide();

    } else {
        $('.hide_in_full_version').show();
        $('.show_in_full_version').hide();
    }
}