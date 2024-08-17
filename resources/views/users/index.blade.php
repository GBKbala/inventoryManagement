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
                        <h5 class="mb-0">All Users</h5>
                    </div>
                    <div>
                        <a href="{{ route('addItem')}}">
                            <button class="btn btn-primary">Add User</button>
                        </a>
                    </div>
                </div>
            </div>
    
            <div class="card-body">
                <div class="table-responsive -4">
                    <table id="inventoryItems" class="table p-2">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>User Name</th>
                                <th>Role</th>
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
@endsection

@section('scripts')
<script>
   
    function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');  
        // console.log(urlToRedirect); 
        Swal.fire({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this item!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel please!",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = urlToRedirect;
            }
        });
    }

    function fetchData(){
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
                                            <a href="{{ route('editItem', '') }}/${row.id}" class="btn btn-sm btn-warning mx-1">Edit</a>
                                            <a href="{{ route('deleteItem', '') }}/${row.id}" class="btn btn-sm btn-danger" onclick="confirmation(event)" data-id="${row.id}">Delete</a>
                                        </div>`;
                            }
                        }
                    ],
                    responsive:true,
                    pageLength: 50,
                    order: [],
                    stateSave: true,
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

    $(document).ready(function () {
        fetchData();
    });
</script>
@endsection