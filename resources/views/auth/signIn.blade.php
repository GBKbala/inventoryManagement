@extends('layout.auth')
@section('title') Sign In @endsection
@section('content')
<!-- Content -->
<div class="container-xxl">
   <div class="authentication-wrapper authentication-basic container-p-y">
      <!-- Register -->
      <div class="card">
         <div class="card-body">
            <h4 class="mb-2">Welcome to Admin Panel</h4>
            <p class="mb-4">Please sign-in to your account</p>
            <form id="login" class="mb-3" action=" {{ route('login')}}" method="POST">
               @csrf
               @method('POST')
               <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" autofocus value="{{ old('email')}}">
                     <div class="text-danger">@error('email'){{$message}}@enderror</div>
               </div>

               <!-- <di class="mb-3">
                  <label class="form-label" for="password">Password</label>
                  <input type="password" id="password" class="form-control" value="password">
                  <i class="toggle-password fa fa-fw fa-eye-slash"></i>
               </div> -->

               <div class="mb-3">
                  <div class="d-flex justify-content-between">
                     <label class="form-label" for="password">Password</label>
                     <a href="{{ route('forgetPassword')}}">
                     <small>Forgot Password?</small>
                     </a>
                  </div>
                  <div>
                     <div class="input-group input-group-merge">
                        <input type="password" id="password" class="form-control" name="password" aria-describedby="password" value="{{ old('password') }}"/>
                        <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                     </div>
                     <div id="password-error" class="text-danger"></div>
                  </div>
            
               </div>

               <!-- <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                     <input type="password" id="password" name="password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="multiStepsPass2" value="{{ old('password') }}" />
                     <span class="input-group-text cursor-pointer" id="multiStepsPass2"><i class="bx bx-hide"></i></span>
                  </div>
                  @error('password')<div class="text-danger">{{ $message }}</div>@enderror
                  <div id="password-error" class="text-danger"></div>
               </div> -->

               <!-- <div class="mb-3">
                  <div class="form-check">
                     <input class="form-check-input" type="checkbox" id="remember-me">
                     <label class="form-check-label" for="remember-me">
                     Remember Me
                     </label>
                  </div>
               </div> -->
               <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
               </div>
            </form>
            <p class="text-center">
               <span>New on our platform?</span>
               <a href="{{ route('signUp')}}">
               <span>Create an account</span>
               </a>
            </p>
            
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
      $('#login').validate({
         rules : {
            email : {
               required : true,
               email : true
            },
            password: {
               required: true,
               minlength: 6
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
         },
         errorPlacement: function(error, element) {
               if (element.attr("name") === "password") {
                  error.appendTo("#password-error")
               } else {
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