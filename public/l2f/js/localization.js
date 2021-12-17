var rustexts = {};
var entexts = {
    send_btn: "Send to future!",
    date_reciev: "Time of receipt",
    date: "date",
    time: "time",
    msgPH: "Enter the text of the letter here",
    addpicture: "Attach photo",
    option1: "Tomorrow", option2: "after  1 week", option3: "after 1 month", option4: "after 3 months", option5: " after 6 months ", option6: "after 1 year",
    menu_send: "New letter",
    menu_letters: "Letters",
    menu_about: "About",
    menu_fullversion: "Full version",
    menu_sync: "Synchronization",
    menu_exit: "Exit",
    add_emails: "add emails",
    banner_title1: "Help the project!",
    banner_text1: "Leave a positive review and rate 4 or 5.Also write suggestions for improving the application.",
    banner_btn1: "Go to the Google Play for rate ",
    text_free_version: "You have a free version ",
    addaudio: 'add records'
};
var arLocal = {
    ru: rustexts,
    en: entexts
}

function lang_getText(text) {
    return arLocal.currentLang.text;
}

function lang_SetTexts() {
    if (currentLang == "")
        return false;
    console.log('lang_SetTexts')
    console.log(currentLang)

    console.log(arLocal[currentLang]);
    var langData = arLocal[currentLang];
    $('.lang').each(function () {
        var $element = $(this);
        var idLang = $element.data('lang');
        if (idLang != "") {
            console.log(idLang);
            if (langData[idLang] != undefined) {
                if ($element.data('langtype') == 'placeholder') {
                    $element.attr('placeholder', langData[idLang])
                } else {
                    $element.html(langData[idLang])
                }
            }
            console.log($element);
        }
    });
}


var MSG = 3;
function MSG_show() {
    var msg = window.localStorage.getItem("MSG_" + MSG, 0);
    if (msg > 0) {
        return;
    }
    alert2CloseIgnore = true;
    var msg = '<div class="main-message">';
    msg += '<div class="title">Привет Товарищ!</div>';
    msg += '<div class="text">В этой версии добавлена возможность добавлять аудио сообщения, но увы, только для платной версии.\n\
              <p>Также хочу напомнить про синхронизацию, чтобы ваши письма не потерялись. Для включения синхронизации обязательно укажите\n\
 рабочий email  и у вас должна быть полня версия. Вроде все! )</p>\n\<br>\n\
<a class="btn" style="margin:auto" onclick=" MSG_hide()">Прочитал!</a></div>';
    msg += '</div>';
    alert2(msg, {theme: 'white'});
}
function MSG_hide() {
    window.localStorage.setItem("MSG_" + MSG, 2);
    alert2CloseIgnore = false;
    alert2Close();
}