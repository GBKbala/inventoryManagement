@extends('layout.default')
@section('title') Add Item @endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-body">
                    <form id="addItem" action="{{ route('storeItem') }}" method="POST" class="">
                        @csrf
                        @method('POST')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label text-capitalize fs-6" for="name">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Item Name" />
                                <div class="text-danger">@error('name'){{$message}}@enderror</div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label text-capitalize fs-6" for="description">Description</label>
                            <div class="col-sm-10">
                                <textarea id="description" name="description" id="description" class="form-control" placeholder="Enter Description" aria-label="description" aria-describedby="basic-icon-default"></textarea>
                                <div class="text-danger">@error('description'){{$message}}@enderror</div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label text-capitalize fs-6" for="quantity_in_stock">Quantity</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="quanity_in_stock" name="quantity_in_stock" placeholder="Quantity In stock" />
                                <div class="text-danger">@error('quantity_in_stock'){{$message}}@enderror</div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label text-capitalize fs-6" for="price">Price</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="price" name="price" placeholder="Enter Price" />
                                <div class="text-danger">@error('price'){{$message}}@enderror</div>
                            </div>
                        </div>
                       
                        <div class="row justify-content-center mb-3">
                            <div class="col-sm-10 text-center">
                                <button type="submit" class="btn btn-primary mx-2">Submit</button>
                                <a href="{{ route('itemList')}}"><button type="button" class="btn btn-danger mx-2">Cancel</button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        $('#addItem').validate({
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
                form.submit();
            }
        });
    });
</script>
@endsection