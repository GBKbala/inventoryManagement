@extends('layout.default')
@section('title') Users @endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.2/js/buttons.html5.min.js"></script>

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Product List Table -->
        <div class="card">

            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="mb-0">All Users</h5>
                    </div>
                    @can('add-user')
                        <div>
                            <a href="javascript:void(0);">
                                <button type="button" class="btn btn-primary" data-bs-target="#userModal" id="addUser">Add User</button>
                            </a>
                        </div>
                    @endcan
                </div>
            </div>
    
            <div class="card-body">
                <div class="table-responsive -4">
                    <table id="users" class="table p-2">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>User Name</th>
                                <th>Role</th>
                                <th class="w-48">Email</th>
                                <th>Mobile</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


<!--User Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-simple modal-edit-user">
      <div class="modal-content p-3 p-md-5">
         <div class="modal-body">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="text-center mb-4">
               <h3 class="modalTitle"></h3>
            </div>
            <form id="userForm" class="row g-3">
               <div class="col-12 col-md-6">
                  <label class="form-label" for="firstname">First Name</label>
                  <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Enter First Name" />
                  <input type="hidden" name="userId" id="userID">
                  <div class="firstname error"></div>
               </div>
               <div class="col-12 col-md-6">
                  <label class="form-label" for="lastname">Last Name</label>
                  <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Enter Last Name" />
                  <div class="lastname error"></div>
               </div>

               <div class="col-12">
                  <label class="form-label" for="dob">D.O.B</label>
                  <input type="text" id="dob" name="dob" class="form-control" placeholder="Select Date" autocomplete="off"/>
                  <div class="dob error"></div>
               </div>
               <div class="col-12 col-md-6">
                  <label class="form-label" for="username">Username</label>
                  <input type="text" id="username" name="username" class="form-control" placeholder="Enter User Name" />
                  <div class="username error"></div>
               </div>


               <div class="col-12 col-md-6">
                  <label class="form-label" for="mobile">Mobile</label>
                  <div class="input-group input-group-merge">
                    <input type="text" id="mobile" name="mobile" class="form-control phone-number-mask" placeholder="Enter Mobile"  maxlength="10"/>
                  </div>
                  <div id="mobile-error" class="text-danger"></div>
                  <div class="mobile error"></div>
               </div>

               <div class="col-12 col-md-6">
                  <label class="form-label" for="email">Email</label>
                  <input type="email" id="email" name="email" class="form-control" placeholder="Enter Your Email" />
                  <div class="email error"></div>
               </div>

               <div class="col-12 col-md-6">
                  <label class="form-label" for="password">Password</label>
                  <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password" />
                  <div class="password error"></div>
               </div>

               <div class="col-12 col-md-6">
                  <label class="form-label" for="address">Address</label>
                  <input type="text" id="address" name="address" class="form-control" placeholder="Enter Your Address" />
                  <div class="address error"></div>
               </div>

               <div class="col-12 col-md-6">
                  <label class="form-label" for="pincode">Pincode</label>
                  <input type="text" id="pincode" name="pincode" class="form-control" placeholder="Enter Your Pincode" maxlength="6"/>
                  <div class="pincode error"></div>
               </div>

               <div class="col-12 col-md-6">
                  <label class="form-label" for="city">city</label>
                  <input type="text" id="city" name="city" class="form-control" placeholder="Enter Your City" />
                  <div class="city error"></div>
               </div>

               <div class="col-12 col-md-6">
                  <label class="form-label" for="state">State</label>
                  <input type="text" id="state" name="state" class="form-control" placeholder="Enter Your State" />
                  <div class="state error"></div>
               </div>
              
              
               <div class="col-12 text-center">
                  <button type="submit" id="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                  <button type="reset" class="btn btn-label-danger" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!--User Modal -->

@endsection

@section('scripts')
<script>
   
    function fetchData(){

        if ($.fn.DataTable.isDataTable('#users')) {
            $('#users').DataTable().destroy();
        }

        $.ajax({
            url :"{{ route('getUsers')}}",
            method : "GET",
            contentType: 'application/json',
            success : function(response){
                console.log(response);
                $('#users').DataTable( {
                    data: response,
                    columns: [
                        {"data": "firstname" },
                        {"data": "lastname" },
                        { "data": "username" },
                        {
                            "data": "userRole",
                            "render": function (data, type, row) {
                                if (data == 1) {
                                    return 'Admin';
                                } else {
                                    return 'User';
                                }
                            }
                        },
                        { "data": "email" },
                        { "data": "mobile" },

                        {
                            "data": null,
                            "render": function(data, type, row) {
                                return `<div class="flex">
                                            <a href="javascript:void(0);" class="editUser btn btn-sm btn-warning mx-1" data-id="${row.id}">Edit</a>
                                            <a href="javascript:void(0);" class="deleteUser btn btn-sm btn-danger" onclick="confirmation(event)" data-id="${row.id}">Delete</a>
                                        </div>`;
                            }
                        }
                    ],
                    responsive:true,
                    pageLength: 50,
                    order: [],
                    // stateSave: true,
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'csvHtml5',
                            text: 'Export CSV',
                            title: '', 
                            className: 'btn btn-sm btn-primary',
                            exportOptions: {
                                columns: ':not(:last-child)'
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            text: 'Export Excel',
                            title: '', 
                            className: 'btn btn-sm btn-success',
                            exportOptions: {
                                columns: ':not(:last-child)'
                            }
                        }
                    ]
                })
            },
            error: function(error, xhr, status){
                console.error(xhr.responseJson)
            } 
        }) 
    }

    $(document).ready(function () {
        fetchData();
    });


    $('#addUser').click(function (){
        $('#userModal').modal('show');
        $('.modalTitle').text('Add User');

        $('#submit').val('Submit');
        $('input').val('');

    });

    $.validator.addMethod("regex", function(value, element, regexp) {
        let re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
    }, "Please check your input.");

    $('#userForm').validate({
        rules : {
            firstname : {
                required : true,
                regex: /^[a-zA-Z]+$/,
            },
            lastname : {
                regex: /^[a-zA-Z]+$/,
            },
            username : {
                required : true,
            },
            email : {
                required : true,
                email : true
            },
            password: {
                required: function() {
                    return $('#submit').val() === 'Submit';
                },
                minlength: 6
            },
            dob:{
                required: true
            },
            mobile: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            state : {
                required: true
            },
            city: {
                required : true
            },
            address : {
                required: true
            },
            pincode : {
                required: true
            }
        },
        messages: {
            firstname: {
                required: "Firstname is required",
                regex: "Firstname can only contain alphabets",
            },
            lastname: {
                regex: "Lastname can only contain alphabets"
            },
            username: {
                required: "Username is required",
            },
            email: {
                required: "Email is required",
            },
            password: {
                required :'Password is required',
                minlength: 'Password must be at least 6 characters long'
            },
            dob: {
                required: "D.O.B is required",
            },
            mobile: {
                required: "Mobile is required",
                digits: "Mobile number must contain only digits",
                minlength: "Mobile number must be exactly 10 digits long",
                maxlength: "Mobile number must be exactly 10 digits long"
            },
            state: {
                required: "State is required",
            },
            city: {
                required: "City is required",
            },
            address: {
                required: "Address is required",
            },
            pincode: {
                required: "Pincode is required",
            },
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") == "mobile") {
                error.appendTo("#mobile-error");
            }else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form){
            // form.submit();
            var token = $('meta[name="csrf-token"]').attr('content');
            // var formData = $(form).serialize();
            var type = $('#submit').val();

            var formData = new FormData($(form)[0]);
    
            formData.append('_token', token);
            var url = '';
            if(type =='Submit'){
                url = "{{ route('storeUser') }}";
            }else{
                url = "{{ route('updateUser') }}";
            }
            
            $('.error').html('');
            $('#submit').attr('disabled',true);
            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    showToastr(response.status, response.message);
                    fetchData();
                    if (response.status == 'success') {
                        $(form)[0].reset();
                        $('#userModal').modal('hide');
                    }
                    $('#submit').attr('disabled',false);
                },
                error: function(xhr, status, error) {
                    $('.error').html('');
                    $('#submit').attr('disabled',false);
                    $.each(xhr.responseJSON.errors, function(key,value) {
                        $('.'+key).append('<span class="alert-danger">'+value+'</span>');
                    }); 
                }
            });

        }
    });

    $(document).on('click', '.editUser', function() {
        $('#userModal').modal('show');
        $('.modalTitle').text('Edit User');
        
        let userId = $(this).data('id');
        $('#submit').val('Update');
        $('#submit').text('Update');


        var url = '/editUser/'+userId;
        $.ajax({
            url : url,
            method: "GET",
            success: function(response){
                console.log(response);
                $('#userModal #firstname').val(response.firstname);
                $('#userModal #lastname').val(response.lastname);
                $('#userModal #username').val(response.username);
                $('#userModal #email').val(response.email);
                var dob = response.dob.split('-').reverse().join('-');
                $('#userModal #dob').datepicker('update', dob);
                $('#userModal #mobile').val(response.mobile);
                $('#userModal #city').val(response.city);
                $('#userModal #address').val(response.address);
                $('#userModal #state').val(response.state);
                $('#userModal #pincode').val(response.pincode);
                $('#userModal #userRole').val(response.userRole);
                $('#userModal #userId').val(response.id);
            }
        })
        
    });

    $(document).on('click', '.deleteUser', function() {

        id= $(this).data('id');
        var urlToRedirect = 'deleteUser/'+id;  
        // console.log(urlToRedirect); 
        Swal.fire({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel please!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url : urlToRedirect,
                    method: "GET",
                    data:{id:id},
                    success: function(response){
                        showToastr(response.status, response.message);
                        fetchData();
                    }
                })
            }
        });
    });

</script>
@endsection