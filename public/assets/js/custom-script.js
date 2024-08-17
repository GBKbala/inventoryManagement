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


const indianStates = [
    {"value": "AP", "label": "Andhra Pradesh"},
    {"value": "AR", "label": "Arunachal Pradesh"},
    {"value": "AS", "label": "Assam"},
    {"value": "BR", "label": "Bihar"},
    {"value": "CT", "label": "Chhattisgarh"},
    {"value": "GA", "label": "Goa"},
    {"value": "GJ", "label": "Gujarat"},
    {"value": "HR", "label": "Haryana"},
    {"value": "HP", "label": "Himachal Pradesh"},
    {"value": "JK", "label": "Jammu and Kashmir"},
    {"value": "JH", "label": "Jharkhand"},
    {"value": "KA", "label": "Karnataka"},
    {"value": "KL", "label": "Kerala"},
    {"value": "MP", "label": "Madhya Pradesh"},
    {"value": "MH", "label": "Maharashtra"},
    {"value": "MN", "label": "Manipur"},
    {"value": "ML", "label": "Meghalaya"},
    {"value": "MZ", "label": "Mizoram"},
    {"value": "NL", "label": "Nagaland"},
    {"value": "OD", "label": "Odisha"},
    {"value": "PB", "label": "Punjab"},
    {"value": "RJ", "label": "Rajasthan"},
    {"value": "SK", "label": "Sikkim"},
    {"value": "TN", "label": "Tamil Nadu"},
    {"value": "TG", "label": "Telangana"},
    {"value": "TR", "label": "Tripura"},
    {"value": "UP", "label": "Uttar Pradesh"},
    {"value": "UT", "label": "Uttarakhand"},
    {"value": "WB", "label": "West Bengal"}
];

// $(document).ready(function() {
//     indianStates.forEach(function(state) {
//         $('#state').append($('<option></option>').attr('value', state.value).text(state.label));
//     });

//     $('#state').select2({
//         placeholder: "Select a state",
//         allowClear: true
//     });
// });

$(document).ready(function() {
    $('#dob').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true
    });
});


