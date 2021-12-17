//https://github.com/AlexDisler/cordova-plugin-inapppurchase
//https://github.com/AlexDisler/cordova-inapppurchases-app
//https://alexdisler.com/2016/02/29/in-app-purchases-ionic-cordova/
function billing_setEmail(){
    var email = $('#billing-email').val();
    if(email ==""){
        alert("Email is required!");
        return false;
    }
    if(!billing_check_email(email)){
        alert("Email is wrong!");
          return false;
    }
   // alert(email);
   window.localStorage.setItem("user_email",email);
   billing_buy('full');
}
function billing_buy(productId) {
    //productId ='full';
    /*
     var email = window.localStorage.getItem("user_email");
    if (email == undefined || email == '') {
        // alert2('Сперва перейдите в раздел синхронизация и пройдите авторизацию.', {theme: 'green'});
         //$.mobile.navigate("#profile");
        // alert2CloseIgnore = true;
         alert2('<p>введите ваш email</p>\n\
                 <input required="" type="email" placeholder="email" id="billing-email"><br>\n\
                  <button class="btn " style="margin:auto; width:200px;" onclick="billing_setEmail()">Go!</button>', {theme: 'white'});
         return false;
    }
    */
    inAppPurchase.getProducts([productId])
            .then(function (products) {
                //       alert2('<span style="font-size:12px">id:'+productId+' <br>'+JSON.stringify(products) + '', {theme: 'red'})
                // return;
                console.log('billing_buy:' + productId);
                inAppPurchase
                        .buy(productId)
                        .then(function (data) {
                            // alert(JSON.stringify(data));
                            //  alert('consuming transactionId: ' + data.transactionId);
                            return inAppPurchase.consume(data.type, data.receipt, data.signature);
                        })
                        .then(function () {
                            SyncSetFullVersion();
                            window.localStorage.setItem("full_version", 1);
                            Buy_CheckFullVersion();
                            alert2('Удачно вышло!<br> Спасибо за покупку.<br>  Эти деньги пойдут на развитие приложения.', {theme: 'green'});
                            //$ionicLoading.hide();
                             WorkInBackground();
                        })
                        .catch(function (err) {
                            //$ionicLoading.hide();
                            // alert(err);
                            alert2('Отмена операции!', {theme: 'red'})
                            // $ionicPopup.alert({  title: 'Something went wrong', template: 'Check your console log for the error details'});
                        });
            })
            .catch(function (err) {
                alert2(' Пока оплата не работает к сожалению.<br><span style="font-size:12px">id:' + productId + ' <br>' + JSON.stringify(err) + '', {theme: 'red'})
                console.log(err);
            });
}


function billing_check_email(email) {
    if (email != '') {
        var pattern = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
        if (pattern.test(email)) {
          
            return true;
        } else {
           
            return false;
        }
    } else {
       
        return false;
    }
    return true;
}
 