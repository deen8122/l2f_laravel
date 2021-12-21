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