$(document).ready(function () {
    InitApp();
});

function InitApp() {
    console.log('InitApp()');
    setTomorrowDate();
    
    
    doRequest('/api/letter/count', 'get', function (responce) {
        if (responce.count > 0) {
            $('.inbox_content_cols').html('Недоставленных писем:' + responce.count);

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
             xhr.setRequestHeader('Authorization', 'Bearer'+token);
        //    xhr.setRequestHeader("Content-Type", "application/json");
        //    xhr.setRequestHeader("Accept", "text/json");

        },
      //    accepts: "application/json; charset=utf-8",
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