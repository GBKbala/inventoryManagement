@extends('layout.auth')
@section('title') Forget Password @endsection
@section('content')
<!-- Content -->
<div class="container-xxl">
   <div class="authentication-wrapper authentication-basic container-p-y">
      <!-- Register -->
      <div class="card">
         <div class="card-body">
         <h4 class="mb-2">Forgot Password?</h4>
          <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>
            <form id="forgetPassword" class="mb-3" action="{{ route('sendRestLink') }}" method="POST">
                @csrf
                @method('POST')
                <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" autofocus>
                </div>
                <button type="submit" class="btn btn-primary d-grid w-100">Send Reset Link</button>
            </form>
            <div class="text-center">
                <a href="{{ route('signIn')}}" class="d-flex align-items-center justify-content-center">
                <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                Back to login
            </a>
          </div>
            
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
      $('#forgetPassword').validate({
         rules : {
            email : {
               required : true,
               email : true
            },
        },
         messages: {
            email: {
              required: "Email is required",
            },
        },
        submitHandler: function(form){
               form.submit();
            }
      })
   });
</script>
@endsection