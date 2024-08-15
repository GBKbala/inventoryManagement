$('.show_hide').click(function(){
    var element = $(this).closest('div');
    var password = element.find($('#password'));
    if(password.attr('type') === 'password' ){
        password.attr('type','text');
        $('#icon').removeClass("bx-show");
        $('#icon').addClass('bx-hide');
    }else{
        password.attr('type','password');
        $('#icon').removeClass("bx-hide");
        $('#icon').addClass('bx-show');
    }

});

var base_url = $('meta[name="base_url"]').attr('content');

toastr.options = {
    "closeButton": true,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}

$.ajaxSetup({
    headers: {
        'Authorization': 'Bearer ' + localStorage.getItem('access_token') 
    }
});


$(document).ready(function(){
    $('#login').submit(function(e){
        e.preventDefault();
    }).validate({
        rules: {
            email_username:{
            required: true,
        },
          password: {
            required: true,
            minlength: 8
          },
        },
        messages: {
            email_username: {
              required: "Enter your email address or username",
            },
            password: {
                required :'Enter your password',
                minlength: 'Password must be at least 8 characters long'
            }
        },
        submitHandler: function(form) {
            var form = $('#login')[0];
            var formData = new FormData(form);
            $.ajax({
                url: form.action,
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log(data);
                    $('#login')[0].reset();
                    toastr.success(data.message);
                    localStorage.setItem('access_token',data.authorisation.token);
                    // Cookies.set('access_token', data.authorisation.token);
                    document.cookie = "access_token=" + data.authorisation.token;
    
                    setTimeout(function () {
                        window.location.href=$('meta[name="base_url"]').attr('content')+'/dashboard';
                    }, 2000);
                },
                error: function(xhr, status, error){
                    $('.errors').html("");
                    console.log(xhr.responseJSON);
                    // toastr.error(xhr.responseJSON.message);
                    $.each(xhr.responseJSON.errors, function (key, element)
                    {
                        $("."+key).append("<span class='text-danger'>"+element+"</span>")
                    });
                }
            });
        }
    });
});


$(document).ready(function(){
    $('#register').submit(function(e){
        e.preventDefault();
    }).validate({
        rules: {
            firstname:{
                required: true,
            },
            lastname:{
                required: true,
            },
            username:{
                required: true,
            },
            email:{
                required: true,
            },
            password: {
                required: true,
                minlength: 8
            },
            password_confirmation: {
                minlength: 8,
                equalTo: "#password"
            },
            phone: {
                required: true,
                minlength: 10,
            },
            terms: {
                required: true,
            },
        },
        messages: {
            firstname:{
                required: "Enter your firstname",
            },
            lastname:{
                required: "Enter your lastname",
            },
            username:{
                required: "Enter your username",
            },
            email: {
              required: "Enter your email",
            },
            password: {
                required :'Enter your password',
                minlength: 'Password must be at least 8 characters long'
            },
            password_confirmation: {
                minlength: 'Password must be at least 8 characters long',
                equalTo: "Password mismatch"
            },
            phone: {
                required: "Enter your phone number",
                minlength: "Enter a valid phone number",
            },
            terms: {
                required: "Agree terms & conditions",
            },
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "terms") {
              error.insertAfter("#terms-error");
            } else {
              error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            // form.submit();
            var form = $('#register')[0];
            var formData = new FormData(form);
            $.ajax({
                url: form.action,
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    console.log(data);
                    $('#register')[0].reset();
                    toastr.success(data.message);
                    setTimeout(function () {
                        window.location.href=$('meta[name="base_url"]').attr('content');
                    }, 3000);
                },
                error: function(xhr, status, error){
                    $('.errors').html("");
                    console.log(xhr.responseJSON);
                    // toastr.error(xhr.responseJSON.message);
                    $.each(xhr.responseJSON.errors, function (key, element)
                    {
                        $("."+key).append("<span class='text-danger'>"+element+"</span>")
                    });
                }
            });
        }
    });
});
