//https://github.com/JoschkaSchulz/cordova-plugin-image-resizer 

var pictureSource;   // picture source
var destinationType; // sets the format of returned value 
var imageCount = 0;
var selectedImg = '';
var appConfig = {
    roofoldername: 'letter2future'
};



function picture_select() {
   // alert(2);
    var objs = $('.image-conteiner');
    var col = 0;
    if(objs!==null){
        col = objs.length;
        
    }

   // alert(col);
    if (window.localStorage.getItem("full_version") != '1' &&  col >=1) {
        alert2('Извините, но функция доступна только для полной версии. (@_@)<br>\n\
<center><a onclick=\'$.mobile.navigate("#paypage");\' style="text-decoration:underline;">подробнее >></a></center>');
        return;
      
    } 
     


}

/*
 * ВЫЗЫВАЕМ ФОТО КАМЕРУ
 */
var log1 = true;
var eventtype = 0;
function capturePhoto() {
    console.log('capturePhoto');
    eventtype = 1;
    navigator.camera.getPicture(recupImage, onFail, {
        saveToPhotoAlbum: appConfig.roofoldername,
        quality: 100,
        destinationType: destinationType.FILE_URI,
        targetWidth: 520,
        targetHeight: 520
    });
}

function recupImage(imageURI) {
    window.resolveLocalFileSystemURI(imageURI, copiePhoto, fail);
}
//recupImageGallery
function recupImageGallery(src) {
    //CopieStart(src);
   // return;
      var options = {
          uri:  src,
          folderName: appConfig.roofoldername,
          quality: 100,
          width: 820,
          height: 820,
          base64: false,
          fit: false
    };

    window.ImageResizer.resize(options,
      function(image) {
           console.log('....ImageResizer.....OK.');
            console.log(image);
             CopieStart(image);
         // success: image is the new resized image
      }, function() {
           console.log('...failed: grumpy cat likes this function.');
        // failed: grumpy cat likes this function
        CopieStart(src);
      });
    
    
    

}

function CopieStart(src){
    window.FilePath.resolveNativePath(src,
            function (src2) {
                console.log(src2);
                window.resolveLocalFileSystemURI(src2, copiePhoto, fail);
            }, function () {
        if (src.indexOf('file:') + 1) {
            //alert("подстрока найдена");
        } else {
            // alert("подстрока не найдена");
            src = 'file://' + src;
        }

        window.resolveLocalFileSystemURI(src, copiePhoto, fail);
    });
    
}
function ImageDelete(_this, idImg) {
    $(_this).parent('div').remove();
    $(_this).remove();
    imageCount--;
    if (imageCount < 1) {
        $('#select-photo-btn').show();
    }
}
function copiePhoto(fileEntry) {
    console.log('....copiePhoto......');
    window.resolveLocalFileSystemURL(
            cordova.file.externalRootDirectory,
            function (fileSystem) {
                console.log('....copiePhoto......0' + appConfig.roofoldername + "/images");
                fileSystem.getDirectory(
                        appConfig.roofoldername,
                        {create: true, exclusive: false},
                        function (dirEntry) {
                            // success(dirEntry);
                            console.log('....copiePhoto......1');
                            fileEntry.copyTo(dirEntry, fileEntry.name, onCopySuccess, fail);

                        },
                        function (error) {
                            console.log('....copiePhoto.....ERROR 1.');
                            console.log(error.code);

                        });
            }, function (error) {
        console.log('....copiePhoto.....ERROR.');
        console.log(error.code);
        //  alert(error.code);
    });
    /*
     window.requestFileSystem(LocalFileSystem.PERSISTENT, 0, function(fileSys) { 
     fileSys.root.getDirectory("photos2", {create: true, exclusive: false}, function(dir) { 
     fileEntry.copyTo(dir, fileEntry.name, onCopySuccess, fail); 
     }, fail); 
     }, fail); 
     */
}

function onCopySuccess(entry) {
    
    
    if(entry.fullPath ===""){
        alert(entry.fullPath);
        return;
    }
   
    imageCount++;

$('#select-photo-btn').html('+ Прикрепить еще фото!');
    var src = "file:///storage/emulated/0" + entry.fullPath;
    selectedImg = src;
    $('#smallImage').append('<div class="image-conteiner" style="background-image:url(' + src + ')"><a onclick="ImageDelete(this)" class="remove-img-btn"></a><img class="gimg" id="imgxc" src="' + src + '"></div>');
    if (imageCount >= 10) {
        $('#select-photo-btn').hide();
    }

}





/*
 * ВЫБОР ФОТОГРАФИЙ ИЗ ГАЛЕРЕИ
 * @returns {undefined}
 */

function getImageGallery() {
    eventtype = 2;
    navigator.camera.getPicture(recupImageGallery, function (message) {
        console.log(message);
    }, {
        quality: 100,
        destinationType: destinationType.FILE_URI,
        //  destinationType: destinationType.DATA_URL,
        sourceType: navigator.camera.PictureSourceType.SAVEDPHOTOALBUM
                //,
                //  targetWidth: 480
                // targetHeight: 512
    }
    );
}


function errorCallback(error) {
    console.log('...........errorCallback.........');
}






function onPhotoSuccessURI(imageURI) {
    var src = imageURI;
    console.log(src);
    selectedImg = src;
    $('#smallImage').append('<div style="font-size:10px;"><a onclick="ImageDelete(this)">удалить</a><img class="gimg" id="imgxc" src="' + src + '"></div>');
    imageCount++;
    if (imageCount >= 1) {
        $('#select-photo-btn').hide();
    }
    copiePhoto(src);
}




function resOnError2(error) {
    alert(error.code);
}


function successCallback(entry) {
    console.log("entry: " + JSON.stringify(entry));
    console.log("New Path: " + entry.fullPath);
    console.log("native url: " + entry.nativeURL); // <<--- this is the new url: file:///data/data/com.intel.appx.RotarApp.xwalk15/files/my_avatar.jpg
}


function movePic(imageData) {
    console.log("move pic");
    console.log(imageData);
    window.resolveLocalFileSystemURL(imageData, resolveOnSuccess, resOnError);
}

// A button will call this function
//
function capturePhotoEdit() {
    // Take picture using device camera, allow edit, and retrieve image as base64-encoded string  
    navigator.camera.getPicture(onPhotoDataSuccess, onFail, {quality: 20, allowEdit: true,
        destinationType: destinationType.DATA_URL});
}

// Called if something bad happens.
// 
function onFail(message) {
    alert('Failed because: ' + message);
}

function success(entry) {
    console.log("New Path: " + entry.fullPath);
}

function fail(error) {
    alert("fail:"+error.code);
}



