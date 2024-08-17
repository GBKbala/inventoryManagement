@extends('layout.default')
@section('title') Inventory Items @endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.2/js/buttons.html5.min.js"></script>


@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Product List Table -->
        <div class="card">

            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="mb-0">All Inventory Items</h5>
                    </div>
                    <div>
                        <a href="javascript:void(0);">
                            <button class="btn btn-primary" data-bs-target="#itemModal"  id="addItem">Add Item</button>
                        </a>
                    </div>
                </div>
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
                  <label class="form-label" for="quantity_in_stock">Quanity In Stock</label>
                  <input type="number" class="form-control" id="quantity_in_stock" name="quantity_in_stock" placeholder="Quantity In stock" />
                  <div class="quantity_in_stock error"></div>
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
   
   

    function fetchData(){
        if ($.fn.DataTable.isDataTable('#inventoryItems')) {
            $('#inventoryItems').DataTable().destroy();
        }
       $.ajax({
            url :"{{ route('getInventoryItems')}}",
            method : "GET",
            contentType: 'application/json',
            success : function(response){
                console.log(response);
                $('#inventoryItems').DataTable( {
                    data: response,
                    columns: [
                        {"data": "name" },
                        {"data": "description" },
                        { "data": "quantity_in_stock" },
                        { "data": "price" },
                        {
                            "data": null,
                            "render": function(data, type, row) {
                                return `<div class="flex">
                                            <a href="javascript:void(0);" class="editItem btn btn-sm btn-warning mx-1" data-id="${row.id}">Edit</a>
                                            <a href="javascript:void(0)" class="deleteItem btn btn-sm btn-danger" data-id="${row.id}">Delete</a>
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

    $('#addItem').click(function (){
        $('#itemModal').modal('show');
        $('.modalTitle').text('Add Item');

        $('#submit').val('Submit');
        $('input').val('');

    });

    $('#inventoryForm').validate({
            rules : {
                name : {
                    required : true,
                },
                description: {
                    required: true,
                },
                quanity_in_stock : {
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
                quanity_in_stock: {
                    required: "Quantity in stock is required",
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
        fetchData();
    });

    $(document).on('click', '.editItem', function() {
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
                $('#itemModal #quantity_in_stock').val(response.quantity_in_stock);
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