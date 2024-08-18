@extends('layout.default')
@section('title') Suppliers @endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.2/js/buttons.html5.min.js"></script>


@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Product List Table -->
        <div class="card">

            <div class="card-header">
                <div class="d-flex justify-content-start mb-3">
                    <div>
                        <h5 class="mb-0">All Suppliers</h5>
                    </div>
                </div>

                <div class="d-flex justify-content-end align-items-center mb-3">
                    <div class="d-flex align-items-center ms-auto">
                        @can('add-item')
                            <div>
                                <a href="javascript:void(0);">
                                    <button class="btn btn-primary" data-bs-target="#supplierModal" id="addSupplier">Add Supplier</button>
                                </a>
                            </div>
                        @endcan
                    </div>
                </div>

            </div>
    
            <div class="card-body">
                <div class="table-responsive -4">
                    <table id="suppliers" class="table p-2">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                @canany(['edit-item', 'delete-item'])
                                    <th>Action</th>
                                @endcanany
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="supplierModal" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-simple modal-edit-user">
      <div class="modal-content p-3 p-md-5">
         <div class="modal-body">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="text-center mb-4">
               <h3 class="modalTitle"></h3>
            </div>
            <form id="supplierForm" class="row g-3">
               <div class="col-12">
                  <label class="form-label" for="name">Name</label>
                  <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" />
                  <input type="hidden" name="supplierId" id="supplierId">
                  <div class="name error"></div>
               </div>

               <div class="col-12">
                  <label class="form-label" for="email">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" />
                  <div class="email error"></div>
               </div>

               <div class="col-12">
                  <label class="form-label" for="email">Mobile</label>
                  <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile" maxlength="10"/>
                  <div class="mobile error"></div>
               </div>

               <div class="col-12">
                  <label class="form-label" for="address">Address</label>
                  <textarea id="address" name="address" id="address" class="form-control" placeholder="Enter Address" aria-label="address" aria-describedby="basic-icon-default"></textarea>
                  <div class="address error"></div>
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
@endsection

@section('scripts')
<script>
   
    function fetchData(){
        if ($.fn.DataTable.isDataTable('#suppliers')) {
            $('#suppliers').DataTable().destroy();
        }
       $.ajax({
            url :"{{ route('getSuppliers')}}",
            method : "GET",
            contentType: 'application/json',
            success : function(response){
                console.log(response);
                $('#suppliers').DataTable( {
                    data: response,
                    columns: [
                        {"data": "name" },
                        {"data": "email" },
                        { "data": "mobile" },
                        { "data": "address" },
                        @canany(['edit-item', 'delete-item'])
                        {
                            "data": null,
                            "render": function(data, type, row) {
                                let actionButtons = '<div class="flex">';
                                
                                @can('edit-item')
                                    actionButtons += `<a href="javascript:void(0);" class="editCustomer btn btn-sm btn-warning mx-1" data-id="${row.id}">Edit</a>`;
                                @endcan
                                
                                @can('delete-item')
                                    actionButtons += `<a href="javascript:void(0)" class="deleteCustomer btn btn-sm btn-danger" data-id="${row.id}">Delete</a>`;
                                @endcan
                                actionButtons += '</div>';
                                
                                return actionButtons;
                            }
                        }
                        @endcanany
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
                                columns: function (idx, data, node) {
                                    return idx !== 4;
                                }
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            text: 'Export Excel',
                            title: '', 
                            className: 'btn btn-sm btn-success',
                            exportOptions: {
                                columns: function (idx, data, node) {
                                    return idx !== 4;
                                }
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

    $('#addSupplier').click(function (){
        $('.error').text(' ');
        $('#supplierModal').modal('show');
        $('.modalTitle').text('Add Supplier');
        $('input').val('');
        $('#submit').val('Submit');
        

    });

    $.validator.addMethod("regex", function(value, element, regexp) {
        let re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
    }, "Please check your input.");

    $('#supplierForm').validate({
        rules : {
            name : {
                required : true,
                // regex: /^[a-zA-Z]+$/,
            },
            email : {
                required : true,
                email : true
            },
            mobile: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            address: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "Name is required",
                // regex: "Name can only contain alphabets",
            },
            email: {
                required: "Email is required",
                email: "Enter a valid email"
            },
            mobile: {
                required: "Mobile is required",
                digits: "Mobile number must contain only digits",
                minlength: "Mobile number must be exactly 10 digits long",
                maxlength: "Mobile number must be exactly 10 digits long"
            },
            address: {
                required: "Address is required",
            },
        },
        submitHandler: function(form){
            // form.submit();
            var token = $('meta[name="csrf-token"]').attr('content');
            var type = $('#submit').val();

            var formData = new FormData($(form)[0]);
    
            formData.append('_token', token);
            var url = '';
            if(type =='Submit'){
                url = "{{ route('storeSupplier') }}";
            }else{
                url = "{{ route('updateSupplier') }}";
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
                        $('#supplierModal').modal('hide');
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

    $(document).ready(function () {
        fetchData();
    });

    $(document).on('click', '.editCustomer', function() {
        $('#supplierModal').modal('show');
        $('.modalTitle').text('Edit Supplier');
        
        let supplierId = $(this).data('id');
        $('#submit').val('Update');
        $('#submit').text('Update');
        var url = '/editSupplier/'+supplierId;
        $.ajax({
            url : url,
            method: "GET",
            success: function(response){
                console.log(response);
                $('#supplierModal #name').val(response.name);
                $('#supplierModal #email').val(response.email);
                $('#supplierModal #mobile').val(response.mobile);
                $('#supplierModal #address').val(response.address);
                $('#supplierModal #supplierId').val(response.id);
            }
        })
    });


    $(document).on('click', '.deleteCustomer', function() {

        id= $(this).data('id');
        var urlToRedirect = 'deleteSupplier/'+id;  
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