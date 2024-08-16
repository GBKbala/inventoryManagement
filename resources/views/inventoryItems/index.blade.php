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
                        <a href="">
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
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Example Item</td>
                                <td>Example Description</td>
                                <td>100</td>
                                <td>$50.00</td>
                                <td>
                                    <button class="btn btn-warning btn-sm edit-btn" data-id="22">Edit</button>
                                    <button class="btn btn-danger btn-sm delete-btn" data-id="22">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
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

        // Handle Edit Button Click
        $(document).on('click', '.edit-btn', function () {
            var id = $(this).data('id');
            // Perform edit action, e.g., open a modal or redirect to an edit page
            alert('Edit button clicked for ID: ' + id);
        });

        // Handle Delete Button Click
        $(document).on('click', '.delete-btn', function () {
            var id = $(this).data('id');
            // Confirm and perform delete action
            if (confirm('Are you sure you want to delete item with ID: ' + id + '?')) {
                // Perform delete action, e.g., send an AJAX request
                alert('Delete button clicked for ID: ' + id);
            }
        });
    });
</script>
@endsection