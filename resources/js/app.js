require('./bootstrap');
require('jquery-validation/dist/jquery.validate.js');


(function ($) {
    "use strict"; // Start of use strict
    $('form').validate();

    
   
})(jQuery);


window.filepreview = function (input, h, w, div = 'profilePicDiv') {
    $('.' + div).empty();
    if (input.files)
        $.each(input.files, readAndPreview);
    function readAndPreview(i, file) {
        if (!/\.(jpe?g|png)$/i.test(file.name)) {
            $.alert(file.name + ' is not a valid image.');
            return;
        }
        var reader = new FileReader();
        $(reader).on("load", function () {
            $('.' + div).append($("<img/>", { src: this.result, height: h, width: w, class: 'img-fluid img-thumbnail' }));
        });
        reader.readAsDataURL(file);
    }
}


window.show = function (obj) {
    console.log(obj);
    var s = `
        <div class="row">
            <div class="col-4 font-weight-bold">Name :${obj['name']}</div>
            <div class="col-4 font-weight-bold">Email :${obj['email']}</div>
        </div>
    `;
    document.getElementById('showModelBody').innerHTML = s;
    $("#showModel").modal('show');
}




window.storeUser = function (token, url) {
        var formUser = document.getElementById('addNewUser');
        var formdata = new FormData();
        for (var i = 0; i < formUser.length; i++) {
            if ("file" == formUser[i].type) {
                formdata.append(formUser[i].name, formUser[i].files[0])
            } else {
                formdata.append(formUser[i].name, formUser[i].value)
            }
        }
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function () {
            if (this.status == 200 && this.readyState == 4) {
                var output = JSON.parse(this.response);
                if(output['status']){
                        
                    $('.alert-danger').html('');
                    $('.alert-danger').addClass('d-none');
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(output.success_message);
                    window.location = "/home";
                }else{
                    $('.alert-danger').html('');
                    $('.alert-danger').removeClass('d-none');
                    if (output.errors.join().includes("valid email")) {
                        $('.alert-danger').append('<li> The email must be a valid email address.</li>');
                    }else  if (output.errors.join().includes("already")) {
                        $('.alert-danger').append('<li> The email has already been taken.</li>');
                    }
                    else {
                        $('.alert-danger').append('<li> Please fill all the required fields. </li>');
                    }
                }
            }
        };
        xml.open('POST', url, true);
        xml.send(formdata);

}

window.updateUser = function (token, url,id) {

    var formUser = document.getElementById('editUser');
        var formdata = new FormData();
        for (var i = 0; i < formUser.length; i++) {
            if ("file" == formUser[i].type) {
                formdata.append(formUser[i].name, formUser[i].files[0])
            } else {
                formdata.append(formUser[i].name, formUser[i].value)
            }
        }
        formdata.append('id', id);
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function () {
            if (this.status == 200 && this.readyState == 4) {
                var output = JSON.parse(this.response);
                if(output['status']){
                        
                    $('.alert-danger').html('');
                    $('.alert-danger').addClass('d-none');
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(output.success_message);
                    window.location = "/home";
                }else{
                    $('.alert-danger').html('');
                    $('.alert-danger').removeClass('d-none');
                    if (output.errors.join().includes("valid email")) {
                        $('.alert-danger').append('<li> The email must be a valid email address.</li>');
                    }else  if (output.errors.join().includes("already")) {
                        $('.alert-danger').append('<li> The email has already been taken.</li>');
                    }
                    else {
                        $('.alert-danger').append('<li> Please fill all the required fields. </li>');
                    }
                }
            }
        };
        xml.open('POST', url, true);
        xml.send(formdata);

}
