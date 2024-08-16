@extends('layout.default')
@section('title') Add Item @endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-body">
                    <form id="" action="" method="" class="">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="name">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Item Name" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="description">Description</label>
                            <div class="col-sm-10">
                                <textarea id="description" name="description" class="form-control" placeholder="Enter Description" aria-label="description" aria-describedby="basic-icon-default"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="quanity_in_stock">Quantity</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="quanity_in_stock" name="quanity_in_stock" placeholder="Quantity In stock" />
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="quanity_in_stock">Price</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="price" name="price" placeholder="Enter Price" />
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

</script>

@endsection