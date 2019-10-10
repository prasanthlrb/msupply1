@extends('layout.app')
@section('content')
<style>
        section.section_offset {
            padding: 50px;
        }
    </style>
<div class="secondary_page_wrapper">
    	<div class="container">
        <section class="section_offset">

                

                <div class="relative">
                    <div class="table_layout">

                        <div class="table_row">

                            <div class="row">
                               <div class="col-sm-8">
                            
                            <div class="table_cell">

                                <section>

                                    <h4>Customer Register</h4>
                    <form method="POST" action="{{ route('register') }}" id="register_form">
                        @csrf

                         <ul>

                                <li class="row">

                                    <div class="col-xs-12">
                            <label for="user_type" class="required">{{ __('Profile Type') }}</label>
                            <select id="user_type" name="user_type" class="form-control {{ $errors->has('user_type') ? ' is-invalid' : '' }}" required>
                                    <option selected="" disabled>select Profile Type</option>
                                    <option value="user">individual Person</option>
                                    <option value="company">Company</option>
                                 
                                  </select>
                                @if ($errors->has('user_type'))
                                    <span class="invalid-feedback error" role="alert">
                                        <strong>{{ $errors->first('user_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </li>
                        
                        <li class="row">

                                <div class="col-xs-12">
                        <label for="name" class="required">{{ __('Name') }}</label>

                        
                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback error" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </li>


                        <li class="row">

                                <div class="col-xs-12">
                            <label for="email" class="required">{{ __('E-Mail Address') }}</label>

                            
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback error" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </li>

                        <li class="row">

                                <div class="col-xs-12">
                            <label for="phone" class="required">{{ __('Phone Number') }}</label>

                            
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback error" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </li>

                        <li class="row">

                                <div class="col-xs-12">
                            <label for="password" class="required">{{ __('Password') }}</label>

                            
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback error" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </li>

                        <li class="row">

                                <div class="col-xs-12">
                            <label for="password-confirm" class="required">{{ __('Confirm Password') }}</label>

                            
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
                            </li>

                            <li class="row">

                                    <div class="col-xs-12">
    
                                        <div class="on_the_sides">
    
                                            <div class="left_side">
    
                                               
                                            </div>
    
                                            <div class="right_side">
    
                                              
    
                                            </div>
                                           
    
                                        </div>
                                        
                                    </div>
    
                                </li>
                            <li class="row">
    
                                    <div class="col-xs-12">
                                            <div class="on_the_sides">

                                                    <div class="left_side">
                                <button type="button" class="button_blue middle_btn" onclick="submitRegistration()">
                                    {{ __('Register') }}
                                </button>
                            </div>
                            <div class="">

                                    <a href="/login" class="button_grey middle_btn">Go to Login</span></a>
        
                                </div>
                            </div>
                        </div>
                                 
                        </li>
                    </ul>
                    </form>
                </section>
                
            </div><!--/ .table_cell -->

        </div>
      
    </div>
        </div><!--/ .table_row -->


    </div><!--/ .table_layout -->

</div><!--/ .relative -->

</section><!--/ .section_offset -->
</div>

@endsection
@section('extra-js')
<script>
    var token;
function submitRegistration(){
    var phone = $('#phone').val();
    if($('#password').val() != $('#password_confirmation').val()){
        toastr.error("Password Not Match"); 
        return false;
    }
    if($('#user_type').val() == null){
        toastr.error("Please Select Profile Type"); 
        return false;
    }
    if($('#name') ==''){
       toastr.error("Name Field is Required"); 
        return false; 
    }
    if($('#email') == ''){
        toastr.error("Email field is required"); 
        return false; 
    }

   if(phone.length == 10 || phone.length == 11 && Number.isInteger(phone)){
     var formData = new FormData($('#register_form')[0]);
    $.ajax({
          url : '/send-register-otp',
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "JSON",
          success: function(data)
          {
            token = data.otp;
            $.arcticmodal({
                        url : '/view-register-otp'
                    });
             
          },error: function (data) {
            toastr.error("This Mobile Number is Not Register","Invalid Mobile Number");
        }
      });
   }else{
        toastr.error("Invalid Mobile Number");
    }
   
}
function submitOTP(){
    var otp_number = $('#otp_number').val();
    if(otp_number == token){
    toastr.success("OTP Verified");
    event.preventDefault();
	document.getElementById('register_form').submit();
    }else{
       toastr.error("Invalid OTP"); 
    }
}
</script>
@endsection 