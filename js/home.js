$(document).ready(function(){ //prevent any code from running before the document is finished loading
    $('#message-line').popover({title:"Greška", content:"Pogrešni podaci.", placement:"right", trigger:"manual"}); //priprema gresku za id=message-line
    if($('#fileToUpload').length>0){
        $('.img-upload').popover({title:"Greška", content:"Pogrešan format.", placement:"right", trigger:"manual"});//priprema gresku za kasnije pozivanje
        $('input[name="pronadjiSlike"]').attr('disabled', 'disabled'); //postavlja u css-u atribute buttona na disabled
        $('#fileToUpload').change(function(){
            var ext = $('#fileToUpload').val().split('.').pop().toLowerCase(); //uzima vrijednost url-a, razdvaja na tackama, uzima zadnji razdvojeni, pretvara u lowerCase
            if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {  //provjerava da li je neki od podrzanih formata
                $('#uploadingPhoto').attr('src', 'img/error.png'); //postavlja atribut src u html tagu za sliku na img/error.png
                $('input[name="pronadjiSlike"]').attr('disabled', 'disabled'); //onemogucava button
                $('.img-upload').popover("show"); // prikazuje ponovo .img-upload
                return;
            }
            $('input[name="pronadjiSlike"]').removeAttr('disabled'); //omogucava button
            readURL(this); //poziva funkciju readURL
        });
        $('#fileToUpload').click(function(){
            $('.img-upload').popover("hide");
        });
    }
    $("#uploadImage").on('submit',(function(e) { //poziva se funkction(e) kada se submit-a forma uploadImage
        e.preventDefault();
        var ext = $(this.fileToUpload).val().split('.').pop().toLowerCase();
        if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
            $('#fileToUpload').val(null);
            return;
        }
            $('.img-upload').append('<div  class="loading-img"><img src="img/loading.gif"></div>');
        $.ajax({
            url: "upload.php", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData:false,        // To send DOMDocument or non processed data file it is set to false
            success: function(data)   // A function to be called if request succeeds
            {
                window.setTimeout(function(){
                    $('.loading-img').remove();
                }, 2000);

            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Greška.");
            }
        });
    }));
    $(".form-signin").on('submit',(function(e) {
        e.preventDefault();
        var values = $(this).serialize();
        var forma = this;
        $.ajax({
            url: "rest.php/login", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: values, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            success: function(data)   // A function to be called if request succeeds
            {
                location.reload();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                $('#message-line').popover('show');
                $('.input-group').addClass("has-error");
            }
        });
    }));
    $(".form-register").on('submit',(function(e) {
        e.preventDefault();
        var values = $(this).serialize();
        var forma = this;
        $.ajax({
            url: "rest.php/register", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: values, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            success: function(data)   // A function to be called if request succeeds
            {
                location.reload();
            },
            error: function(data){
                alert(data);
            }
        });
    }));
    $('input[type="email"], input[type="password"]').on('change keyup paste', function(){
        $('.input-group').removeClass("has-error");
        $('#message-line').popover('hide');
    });
    $("form[name='logout']").on('submit',(function(e) {
        e.preventDefault();
        var values = $(this).serialize();
        var forma = this;
        $.ajax({
            url: "rest.php/logout", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: values, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            success: function(data)   // A function to be called if request succeeds
            {
                location.reload();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("Greška.");
            }
        });
    }));
});

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {      //slika odabrana
            $('#uploadingPhoto').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);  //?
    }
}