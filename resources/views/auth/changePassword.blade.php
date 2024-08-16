@extends('layout.default')
@section('title') Change Password @endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-body">
                    <form id="changepassword" action="{{ route('updatePassword') }}" method="POST" class="">
                        @csrf
                        @method('POST')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label text-capitalize fs-6" for="oldPassword">Old Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="oldPassword" name="oldPassword" placeholder="Old Password" />
                                <div class="text-danger">@error('oldPassword'){{$message}}@enderror</div>
                            </div>
                            <input type="hidden" name="userID" id="userID" value="{{ auth()->user()->id }}">
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label text-capitalize fs-6" for="password">New Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" name="password" placeholder="New Password" />
                                <div class="text-danger">@error('password'){{$message}}@enderror</div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label text-capitalize fs-6" for="password_confirmation">Confirm Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" />
                                <div class="text-danger">@error('password_confirmation'){{$message}}@enderror</div>
                            </div>
                        </div>

                        <div class="row justify-content-center mb-3">
                            <div class="col-sm-10 text-center">
                                <button type="submit" class="btn btn-primary mx-2">Change Password</button>
                                <a href="{{ url('dashboard')}}"><button type="button" class="btn btn-danger mx-2">Cancel</button></a>
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
      $('#changepassword').validate({
        rules : {
            oldPassword: {
               required: true,
    
            },
            password: {
               required: true,
               minlength: 6
            },
            password_confirmation: {
               required: true,
               equalTo: "#password"
            },
        },
        messages: {
            oldPassword: {
               required :'Old Password is required',
            },
            password: {
               required :'Password is required',
               minlength: 'Password must be at least 6 characters long'
            },
            password_confirmation: {
                required :'Confirm password is required',
                equalTo: 'Passwords mismatch'
            },
        },
        submitHandler: function(form){
            form.submit();
        }
      })
   });
</script>

@endsection