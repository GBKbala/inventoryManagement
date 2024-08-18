@extends('layout.default')
@section('title') Purchased Items @endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.2/js/buttons.html5.min.js"></script>


@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-start mb-3">
                    <div>
                        <h5 class="mb-0">All Purchased Items</h5>
                    </div>
                </div>

                <div class="container">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-3">
                        <div class="d-flex flex-column flex-md-row align-items-end">
                            <div class="me-0 me-md-3 mb-3 mb-md-0 flex-grow-1">
                                <label for="fromDate" class="form-label">From Date</label>
                                <input type="text" class="form-control w-100" id="fromDate" name="fromDate">
                            </div>
                            <div class="me-0 me-md-3 mb-3 mb-md-0 flex-grow-1">
                                <label for="toDate" class="form-label">To Date</label>
                                <input type="text" class="form-control w-100" id="toDate" name="toDate">
                            </div>
                            <div class="mb-3 mb-md-0">
                                <button type="button" id="filter" class="btn  btn-secondary">Filter</button>
                            </div>
                        </div>
                        @can('add-item')
                            <div class="mt-3 mt-md-0 pt-5 pt-md-0">
                                <a href="javascript:void(0);">
                                    <button class="btn btn-primary mt-4" data-bs-target="#purchaseModal" id="addPurchase">Add Purchase Item</button>
                                </a>
                            </div>
                        @endcan
                    </div>
                </div>


            </div>
    
            <div class="card-body">
                <div class="table-responsive -4">
                    <table id="inventoryItems" class="table p-2">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Customer</th>
                                <th>Quantity</th>
                                <th>Date</th>
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

<div class="modal fade" id="purchaseModal" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-simple modal-edit-user">
      <div class="modal-content p-3 p-md-5">
         <div class="modal-body">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="text-center mb-4">
               <h3 class="modalTitle"></h3>
            </div>
            <form id="dispatchForm" class="row g-3">
               <div class="col-12">
                  <label class="form-label" for="item_id">Item</label>
                  <select name="item_id" id="item_id" class="form-select"  placeholder="Selecet Item">
                    @foreach($items as $key=> $item)
                        <option value="{{ $item->id}}">{{$item->name }}</option>
                    @endforeach
                  </select>
                  <input type="hidden" name="purchasedItemId" id="purchasedItemId" >
                  <div class="item_id error"></div>
               </div>
               <div class="col-12">
                  <label class="form-label" for="supplier_id">Customer</label>
                    <select name="supplier_id" id="supplier_id" class="form-select"  placeholder="Selecet Item">
                        @foreach($suppliers as $key=> $supplier)
                            <option value="{{ $supplier->id}}">{{$supplier->name }}</option>
                        @endforeach
                    </select>
                  <div class="supplier_id error"></div>
               </div>

               <div class="col-12">
                  <label class="form-label" for="quantity">Quanity</label>
                  <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity" />
                  <div class="quantity error"></div>
               </div>
               <div class="col-12">
                  <label class="form-label" for="date">Date</label>
                  <input type="text" class="form-control" id="date" name="date" placeholder="DD-MM-YYYY" autocomplete="off" />
                  <div class="date error"></div>
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
        $('#item_id').select2(
            { dropdownParent: "#purchaseModal" }
        );
    });

    $(document).ready(function() {
        $('#supplier_id').select2(
            { dropdownParent: "#purchaseModal" }
        );
    });

    $('#fromDate, #toDate, #date').datepicker({
        format: 'dd-mm-yyyy',
        autoclose: true,
        todayHighlight: true
    });

    function fetchData(fromDate ='', toDate=''){
        if ($.fn.DataTable.isDataTable('#inventoryItems')) {
            $('#inventoryItems').DataTable().destroy();
        }
       $.ajax({
            url :"{{ route('getpurchasedItems')}}",
            method : "GET",
            data: {fromDate: fromDate, toDate:toDate},
            contentType: 'application/json',
            success : function(response){
                console.log(response);
                $('#inventoryItems').DataTable( {
                    data: response,
                    columns: [
                        {"data": "inventory_item.name" },
                        {"data": "supplier.name" },
                        { "data": "quantity" },
                        { 
                            data: "date",
                            render: function(data) {
                                if (data) {
                                    var parts = data.split('-');
                                    return parts.reverse().join('-');
                                }
                                return '';
                            }
                        },
                        @canany(['edit-item', 'delete-item'])
                        {
                            "data": null,
                            "render": function(data, type, row) {
                                let actionButtons = '<div class="flex">';
                                
                                @can('edit-item')
                                    actionButtons += `<a href="javascript:void(0);" class="editPurchasedItem btn btn-sm btn-warning mx-1" data-id="${row.id}">Edit</a>`;
                                @endcan
                                
                                @can('delete-item')
                                    actionButtons += `<a href="javascript:void(0)" class="deletePurchasedItem btn btn-sm btn-danger" data-id="${row.id}">Delete</a>`;
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

    $('#addPurchase').click(function (){
        $('.error').text(' ');
        $('#purchaseModal').modal('show');
        $('.modalTitle').text('Add Purchase Item');
        $('input').val('');
        $('#submit').val('Submit');
        

    });

    $('#dispatchForm').validate({
            rules : {
                item_id : {
                    required : true,
                },
                supplier_id: {
                    required: true,
                },
                quantity : {
                    required : true,
                    number: true
                },
                date : {
                    required :true,
                }
            },
            messages: {
                item_id: {
                    required: "Item is required"
                },
                supplier_id: {
                    required: "Supplier is required",
                },
                quantity: {
                    required: "Quantity is required",
                    number: "Quantity must be a number"
                },
                price: {
                    date: "Date is required",
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
                    url = "{{ route('storePurchasedItem') }}";
                }else{
                    url = "{{ route('updatePurchasedItem') }}";
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
                            $('#purchaseModal').modal('hide');
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

        $('#filter').click(function (){
            var fromDate = $('#fromDate').val();
            var toDate = $('#toDate').val();
            fetchData(fromDate, toDate);
        });
    });

    $(document).on('click', '.editPurchasedItem', function() {
        $('.error').text(' ');
        $('#purchaseModal').modal('show');
        $('.modalTitle').text('Edit Purchase Item');
        
        let purchasedItemId = $(this).data('id');
        $('#submit').val('Update');
        $('#submit').text('Update');
        var url = '/editPurchasedItem/'+purchasedItemId;
        $.ajax({
            url : url,
            method: "GET",
            success: function(response){
                console.log(response);
                var date = response.date.split('-').reverse().join('-');
                $('#purchaseModal #date').datepicker('update', date);

                var itemIdToSelect = response.item_id;
                var supplierIdToSelect = response.supplier_id;

                $('#item_id').val(itemIdToSelect).trigger('change');
                $('#supplier_id').val(supplierIdToSelect).trigger('change');
                $('#purchaseModal #quantity').val(response.quantity);
                $('#purchaseModal #purchasedItemId').val(response.id);
                
            }
        })
    });


    $(document).on('click', '.deletePurchasedItem', function() {

        id= $(this).data('id');
        var urlToRedirect = 'deletePurchasedItem/'+id;  
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