
function setTomorrowDate() {
    let today = new Date();
    let month = dateAdd(today, 'day', 1);
    // month =  month.toISOString().substr(0, 10);
    // console.log(month);
    $('#date').val(month.toISOString().substr(0, 10));
    // $('#date').val(today.getDay()+"."+ today.getMonth()+"."+today.getFullYear());
    let h = today.getHours();
    if (h < 10) {
        h = '0' + h;
    }
    let s = today.getMinutes();
    if (s < 10) {
        s = '0' + s;
    }
    let time = h + ':' + s;
    // alert(time);
    $('#time').val(time);
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
    var ret = new Date(date * 1000);
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
    return new Date(y, m, d, h, min).getTime() / 1000;
    // return new Date(newDate).getTime();
}

function updateUrl(urlPath){
  //  document.title = response.pageTitle;
     window.history.pushState(urlPath,"", urlPath);
}