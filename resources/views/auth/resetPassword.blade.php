@extends('layout.auth')
@section('title') Reset Password @endsection
@section('content')
<!-- Content -->
<div class="container-xxl">
   <div class="authentication-wrapper authentication-basic container-p-y">
      <!-- Register -->
      <div class="card">
         <div class="card-body">
         <h4 class="mb-2">Reset Password</h4>
            <!-- <p class="mb-4">Please sign-in to your account</p> -->
            <form id="resetPassword" class="mb-3" action="{{ route('resetNewPassword')}}" method="POST">
                @csrf
                @method('POST')
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" autofocus value="{{ old('email')}}">
                        <input type="hidden" name="token" id="token" value="{{$token}}">
                        <div class="text-danger">@error('email'){{$message}}@enderror</div>
                </div>

                <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password">New Password</label>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                    @error('password')<div class="text-danger">{{ $message }}</div>@enderror
                    <div id="password-error" class="text-danger"></div>
                </div>
                <div class="mb-3 form-password-toggle">
                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                    </div>
                    @error('password_confirmation')<div class="text-danger">{{ $message }}</div>@enderror
                    <div id="password_confirmation-error" class="text-danger"></div>
                </div>
                <button type="submit" class="btn btn-primary d-grid w-100 mb-3">
                Set new password
                </button>
                <div class="text-center">
                    <a href="auth-login-basic.html">
                        <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                        Back to login
                    </a>
                </div>
          </form>   
         </div>
      </div>
      <!-- /Register -->
      
   </div>
</div>
<!-- / Content -->
@endsection

@section('scripts')
<script>
   $(document).ready(function(){
      $('#resetPassword').validate({
        rules : {
            email : {
               required : true,
               email : true
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
            email: {
              required: "Email is required",
            },
            password: {
               required :'Password is required',
               minlength: 'Password must be at least 6 characters long'
            },
            password_confirmation: {
                required :'Confirm password is required',
                equalTo: 'Passwords do not match'
            },
        },
        errorPlacement: function(error, element) {
            if (element.attr("name") === "password") {
                error.appendTo("#password-error")
            }else if (element.attr("name") === "password_confirmation") {
                error.appendTo("#password_confirmation-error")
            } 
            else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form){
            form.submit();
        }
      })
   });
</script>
@endsection