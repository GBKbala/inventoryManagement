@extends('layout.default')
@section('title') Inventory Items @endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.2/js/buttons.html5.min.js"></script>


@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Product List Table -->
        <div class="card">
            <!-- Inventory Items Header -->
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="mb-0">All Inventory Items</h5>
                    </div>
                    <div>
                        <a href="{{ route('addItem')}}">
                            <button class="btn btn-primary">Add Item</button>
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
                            @foreach($inevntoryItems as $key=> $item )
                                <tr>
                                    <td>{{ $item->name}}</td>
                                    <td>{{ $item->description}}</td>
                                    <td>{{ $item->quantity_in_stock}}</td>
                                    <td>{{ $item->price}}</td>
                                    <td>
                                        <a href="{{ route('editItem',$item->id) }}" class="btn btn-warning btn-sm edit-btn" data-id="{{ $item->id}}">Edit</a>
                                        <a href="{{ route('deleteItem',$item->id) }}" class="btn btn-danger btn-sm delete-btn" data-id="{{ $item->id}}" onclick="confirmation(event)">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
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

    $(document).ready(function () {
            var table = $('#inventoryItems').DataTable({
                responsive: true,
                pageLength: 50,
                order: [], 
                dom: '<"dt-buttons"B><"dataTables_filter"f>rtip',
                buttons: [
                    {
                        extend: 'csvHtml5',
                        text: 'Export CSV',
                        className: 'btn btn-secondary',
                        exportOptions: {
                        columns: function (idx, data, node) {
                            return idx !== 4;
                            }
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Export Excel',
                        className: 'btn btn-success',
                        exportOptions: {
                        columns: function (idx, data, node) {
                            return idx !== 4;
                            }
                        }
                    }
                ]
        });

        $('#exportCSV').on('click', function () {
            table.button('.buttons-csv').trigger();
        });

        $('#exportExcel').on('click', function () {
            table.button('.buttons-excel').trigger();
        });

     
        // $(document).on('click', '.edit-btn', function () {
        //     var id = $(this).data('id');
        //     alert('Edit button clicked for ID: ' + id);
        // });

        
        // $(document).on('click', '.delete-btn', function () {
        //     var id = $(this).data('id');
        //     if (confirm('Are you sure you want to delete item with ID: ' + id + '?')) {
        //         alert('Delete button clicked for ID: ' + id);
        //     }
        // });
    });
</script>
@endsection