@extends('layout.default')
@section('title') Inventory Items @endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.2/js/buttons.html5.min.js"></script>


@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Product List Table -->
        <div class="card">

            <div class="card-header">
                <div class="d-flex justify-content-start mb-3">
                    <div class="p-1 mt-1">
                        <h5 class="mb-0">All Inventory Items</h5>
                    </div>
                    <div class="mx-2 d-flex align-items-center">
                        <label for="" class="mx-2 mb-0">Search</label>
                        <input type="text" name="search" id="search" class="form-control">
                    </div>
                </div>

                @can('add-item')
                <div class="container">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-2">
                
                        <div class="d-flex flex-column flex-md-row align-items-center mb-md-0 mt-2">
                            <form id="fileUpload" action="{{ route('importExcelFile') }}" method="POST" enctype="multipart/form-data" class="d-flex flex-column flex-md-row align-items-center">
                                @csrf
                                @method('POST')
                                <div class="me-2 mb-2 mb-md-0">
                                    <input type="file" class="form-control mt-1" id="file" name="file">
                                    @error('file')<div class="text-danger error">{{ $message }}</div>@enderror
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-secondary mt-1">Import</button>
                                </div>
                            </form>
                        </div>
                        <div class="d-flex flex-column flex-md-row align-items-center ms-auto">
                            <div class="me-3 mb-md-0 sm-my-2">
                                <a href="{{ route('export') }}" class="btn btn-success w-100 w-md-auto">Export</a>
                            </div>
                            <div>
                                <a href="javascript:void(0);">
                                    <button class="btn btn-primary w-100 w-md-auto" data-bs-target="#itemModal" id="addItem">Add Item</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                @endcan
            </div>
    
            <div class="card-body">
                <div class="table-responsive -4">
                    <table id="inventoryItems" class="table p-2">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Price ₹</th>
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

<div class="modal fade" id="itemModal" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-simple modal-edit-user">
      <div class="modal-content p-3 p-md-5">
         <div class="modal-body">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="text-center mb-4">
               <h3 class="modalTitle"></h3>
            </div>
            <form id="inventoryForm" class="row g-3">
               <div class="col-12">
                  <label class="form-label" for="name">Name</label>
                  <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" />
                  <input type="hidden" name="itemId" id="itemId">
                  <div class="name error"></div>
               </div>
               <div class="col-12">
                  <label class="form-label" for="lastname">Description</label>
                  <textarea id="description" name="description" id="description" class="form-control" placeholder="Enter Description" aria-label="description" aria-describedby="basic-icon-default"></textarea>
                  <div class="description error"></div>
               </div>

               <div class="col-12">
                  <label class="form-label" for="quantity">Quanity</label>
                  <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity" />
                  <div class="quantity error"></div>
               </div>
               <div class="col-12">
                  <label class="form-label" for="price">Price</label>
                  <input type="number" class="form-control" id="price" name="price" placeholder="Enter Price" />
                  <div class="price error"></div>
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


    $(document).ready(function() {
        $('#fileUpload').change( function (){
            $('.error').text(' ');
        });

        $('#fileUpload').validate({
            rules: {
                file: {
                    required: true,
                    extension: "xlsx|xls|csv"
                }
            },
            messages: {
                file: {
                    required: "A file is required to import",
                    extension: "Only files with extensions .xlsx, .xls, .csv are allowed"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });

    function fetchData(searchValue = ''){
        if ($.fn.DataTable.isDataTable('#inventoryItems')) {
            $('#inventoryItems').DataTable().clear().destroy();
        }
       $.ajax({
            url :"{{ route('getInventoryItems')}}",
            method : "GET",
            data: { search: searchValue },
            contentType: 'application/json',
            success : function(response){
                console.log(response);
                $('#inventoryItems').DataTable( {
                    data: response,
                    columns: [
                        {"data": "name" },
                        {"data": "description" },
                        { "data": "quantity" },
                        { "data": "price" },
                        @canany(['edit-item', 'delete-item'])
                        {
                            "data": null,
                            "render": function(data, type, row) {
                                let actionButtons = '<div class="flex">';
                                
                                @can('edit-item')
                                    actionButtons += `<a href="javascript:void(0);" class="editItem btn btn-sm btn-warning mx-1" data-id="${row.id}">Edit</a>`;
                                @endcan
                                
                                @can('delete-item')
                                    actionButtons += `<a href="javascript:void(0)" class="deleteItem btn btn-sm btn-danger" data-id="${row.id}">Delete</a>`;
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
                    destroy: true,
                    searching: false,
                    // stateSave: true,
                    // dom: 'Bfrtip',
                    // buttons: [
                    //     {
                    //         extend: 'csvHtml5',
                    //         text: 'Export CSV',
                    //         title: '', 
                    //         className: 'btn btn-sm btn-primary',
                    //         exportOptions: {
                    //             columns: function (idx, data, node) {
                    //                 return idx !== 4;
                    //             }
                    //         }
                    //     },
                    //     {
                    //         extend: 'excelHtml5',
                    //         text: 'Export Excel',
                    //         title: '', 
                    //         className: 'btn btn-sm btn-success',
                    //         exportOptions: {
                    //             columns: function (idx, data, node) {
                    //                 return idx !== 4;
                    //             }
                    //         }
                    //     }
                    // ]
                })
            },
            error: function(error, xhr, status){
                console.error(xhr.responseJson)
            } 
        }) 
    }

    $('#addItem').click(function (){
        $('.error').text(' ');
        $('#itemModal').modal('show');
        $('.modalTitle').text('Add Item');
        $('input').val('');
        $('#submit').val('Submit');
        

    });

    $('#inventoryForm').validate({
        rules : {
            name : {
                required : true,
            },
            description: {
                required: true,
            },
            quantity : {
                required : true,
                number: true
            },
            price : {
                required :true,
                number: true
            }
        },
        messages: {
            name: {
                required: "Item name is required"
            },
            description: {
                required: "Description is required",
            },
            quantity: {
                required: "Quantity is required",
                number: "Quantity must be a number"
            },
            price: {
                required: "Price is required",
                number: "Price must be a number"
            }
        },
        submitHandler: function(form){
            // form.submit();
            var token = $('meta[name="csrf-token"]').attr('content');
            var type = $('#submit').val();

            var formData = new FormData($(form)[0]);
    
            formData.append('_token', token);
            var url = '';
            if(type =='Submit'){
                url = "{{ route('storeItem') }}";
            }else{
                url = "{{ route('updateItem') }}";
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
                        $('#itemModal').modal('hide');
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
        fetchData('');
        $(document).on('keyup', '#search', function(){
            var searchValue = $('#search').val();
            console.log(searchValue);
            fetchData(searchValue); 
        });
    });

    $(document).on('click', '.editItem', function() {
        $('.error').text(' ');
        $('#itemModal').modal('show');
        $('.modalTitle').text('Edit Item');
        
        let userId = $(this).data('id');
        $('#submit').val('Update');
        $('#submit').text('Update');
        var url = '/editItem/'+userId;
        $.ajax({
            url : url,
            method: "GET",
            success: function(response){
                console.log(response);
                $('#itemModal #name').val(response.name);
                $('#itemModal #description').val(response.description);
                $('#itemModal #quantity').val(response.quantity);
                $('#itemModal #price').val(response.price);
                $('#itemModal #itemId').val(response.id);
            }
        })
    });


    $(document).on('click', '.deleteItem', function() {

        id= $(this).data('id');
        var urlToRedirect = 'deleteItem/'+id;  
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