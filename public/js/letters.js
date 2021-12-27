function sendLetter() {
    let message = $('#message').val();
    let date = $('#date').val();
    let emails = $('#emails').val();

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

    popupShowSucces()

    let fd = new FormData();
    let files = $('#image')[0].files;
    let url = '/letter/add';
    fd.append('images[]', files[0]);
    fd.append('text', message);
    fd.append('future_time', timestump);
    fd.append('email_to', emails);
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

function getLetter(id) {
    let $content = $('#content');
    updateUrl('/letter/'+id);
    doRequest('/api/letter/' + id, 'get', function (responce) {
        console.log(responce);
        let obj = responce;
        var t = '<div id="inbox_detail" class="inbox_detail"><div id="inbox_detail" class="inbox-container">';
            
            t += '<div class="itemwhite">';
            t += '<div class="date">отправлено: <b>' + getNormalDate(obj.created_time) + '</b></div>';
            t += '<div class="date">получено: <b>' + getNormalDate(obj.future_time) + '</b></div>';
            t += '<div class="text">' + obj.text + '</div>';
            t += '</div>';
        
        t += '</div></div>';
        $content.html(t);
        $('#cont-img').append('<img  class="img" src="' + obj.filename + '">')

    });




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
                t += '<div class="item ' + (obj.opened == 1 ? 'item-no-readed' : '') + '" onclick="getLetter(' + obj.id + ')">';
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