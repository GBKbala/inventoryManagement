@extends('layout.auth')
@section('title') Sign Up @endsection
@section('content')
<!-- Content -->
<div class="container-xxl">
   <div class="authentication-wrapper authentication-basic container-p-y">
      <!-- Register -->
      <div class="card">
         <div class="card-body">
            <!-- <h4 class="mb-2">Welcome to Admin Panel</h4> -->
            <p class="mb-4">Sign Up for a New Account</p>
            <form id="register" action="" class="">
                @csrf
                @method('POST')
                <!-- Account Details -->
                <div id="accountDetailsValidation" class="content">
                    <div class="content-header mb-3">
                     <h3 class="mb-1">Account Information</h3>
                     <span>Enter Your Account Details</span>
                    </div>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="johndoe" />
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="john.doe@email.com" aria-label="john.doe" />
                        </div>
                        <div class="col-sm-6 form-password-toggle">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" name="password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="multiStepsPass2" />
                                <span class="input-group-text cursor-pointer" id="multiStepsPass2"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="col-sm-6 form-password-toggle">
                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="multiStepsConfirmPass2" />
                                <span class="input-group-text cursor-pointer" id="multiStepsConfirmPass2"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
            
                  </div>
               </div>
               <!-- Personal Info -->
               <div id="personalInfoValidation" class="content my-4">
                    <div class="content-header mb-3">
                        <h3 class="mb-1">Personal Information</h3>
                        <span>Enter Your Personal Information</span>
                    </div>
                    <div class="row g-3">
                        <div class="col-sm-6">
                        <label class="form-label" for="firstname">First Name</label>
                        <input type="text" id="firstname" name="firstname" class="form-control" placeholder="John" />
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label" for="lastname">Last Name</label>
                        <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Doe" />
                    </div>
                    <div class="col-sm-12">
                        <label class="form-label" for="dob">Date of Birth</label>
                        <input type="text" id="dob" name="dob" class="form-control datepicker" placeholder="YYYY-MM-DD" />
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label" for="mobile">Mobile</label>
                        <div class="input-group input-group-merge">
                           <span class="input-group-text">US (+1)</span>
                           <input type="text" id="mobile" name="mobile" class="form-control multi-steps-mobile" placeholder="202 555 0111" />
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label" for="pincode">Pincode</label>
                        <input type="text" id="pincode" name="pincode" class="form-control multi-steps-pincode" placeholder="Postal Code" maxlength="6" />
                    </div>
                    <div class="col-md-12">
                        <label class="form-label" for="address">Address</label>
                        <input type="text" id="address" name="address" class="form-control" placeholder="Address" />
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label" for="city">City</label>
                        <input type="text" id="city" name="city" class="form-control" placeholder="Jackson" />
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label" for="state">State</label>
                        <select id="state" name="state" class="select2 form-select" data-allow-clear="true">
                        
                        </select>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary btn-next">
                            <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Register</span>
                            <!-- <i class="bx bx-chevron-right bx-sm me-sm-n2"></i> -->
                        </button>
                    </div>
                  </div>
               </div>
            </form>
            <p class="text-center">
               <span>Already have an account?</span>
               <a href="{{ route('signIn')}}">
               <span>Sign in instead</span>
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
        $('#register').validate({
            rules : {
                firstname : {
                    required : true,
                },
                username : {
                    required : true,
                },
                email : {
                    required : true,
                    email : true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                dob:{
                    required: true
                },
                mobile: {
                    required: true
                },
                state : {
                    required: true
                },
                city: {
                    required : true
                },
                address : {
                    required: true
                },
                pincode : {
                    required: true
                }
                // terms: {
                //     required: true,
                // },
            },
            messages: {
                firstname: {
                    required: "Firstname is required",
                },
                username: {
                    required: "Username is required",
                },
                email: {
                    required: "Email is required",
                },
                password: {
                    required :'Password is required',
                    minlength: 'Password must be at least 6 characters long'
                },
                dob: {
                    required: "D.O.B is required",
                },
                mobile: {
                    required: "Mobile is required",
                },
                state: {
                    required: "State is required",
                },
                city: {
                    required: "City is required",
                },
                address: {
                    required: "Address is required",
                },
                pincode: {
                    required: "Pincode is required",
                },
                // terms: {
                //     required: "Agree terms & conditions",
                // },
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "terms") {
                error.insertAfter("#terms-error");
                } else {
                error.insertAfter(element);
                }
            },
            submitHandler: function(form){
                form.submit();
            }
        });
   });
</script>
@endsection