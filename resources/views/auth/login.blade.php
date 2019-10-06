@extends('layout.app')
@section('content')
<style>
        section.section_offset {
            padding: 50px;
        }
        .otp_show_field{
            display: none;
        }
    </style>
<div class="secondary_page_wrapper">
    	<div class="container">
        <section class="section_offset">

                

                <div class="relative">

                   


                    <div class="table_layout">

                        <div class="table_row">

                            <div class="row">
                               <div class="col-sm-6">
                            
                            <div class="table_cell">

                                <section>

                                    <h4>Customer Login</h4>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <ul>

                                <li class="row">

                                    <div class="col-xs-12">
                            <label for="phone" class="required">{{ __('Mobile Number') }}</label>

                           
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required autofocus>

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback text-danger" style="color:#ff4557" role="alert">
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
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </li>


                        <li class="row">

                                <div class="col-xs-12">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>

                            </li>
                        <li class="row">

                                <div class="col-xs-12">

                                    <div class="on_the_sides">

                                        <div class="left_side">
                        <a class="btn btn-link" href="javascript:void(null)" data-modal-url="/show_otp_login">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </div>

                        <div class="">

                            <a href="/register" class="button_blue middle_btn">Create Your Account</a>

                        </div>
                       

                    </div>
                    
                </div>

            </li>
            <br>
            <li class="row">
                    <div class="col-sm-6">
                                <button type="submit" class="button_blue middle_btn">
                                    {{ __('Login') }}
                                </button>

                                
                            </div>
                    <div class="col-sm-6">
                                <a href="javascript:void(null)" class="button_grey middle_btn" data-modal-url="/show_otp_login">
                                    {{ __('Login With OTP') }}
                                </a>

                                
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
function generateOTP(){
    var number = $('#phone_number').val();
    if(number.length == 10 || number.length == 11 && Number.isInteger(number)){
        var formData = new FormData($('#otp_form')[0]);
    $.ajax({
          url : '/send-login-otp',
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "JSON",
          success: function(data)
          {
            console.log(data);
            toastr.success(data.message);
            $('.before_form').each(function(){
                $('.before_form').addClass('otp_show_field');
            })
            $('.after_form').each(function(){
                $('.after_form').removeClass('otp_show_field');
            })
          },error: function (data) {
            toastr.error("This Mobile Number is Not Register","Invalid Mobile Number");
        }
      });
    }else{
        toastr.error("Invalid Mobile Number");
    }
}
function sendOTP(){
    var otp_number = $('#otp_number').val();
    console.log(otp_number)
    
var formData = new FormData($('#otp_form')[0]);
    $.ajax({
          url : '/received-login-otp',
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "JSON",
          success: function(data)
          {
            //console.log(data);
            toastr.success(data.message);
           window.location.href = "/account/dashboard";
          },error: function (data) {
            toastr.error("Please Enter Valid OTP","Invalid OTP");
        }
      });
}
function sendPasswordReset(){

}
function resetPassword(){

}
</script>
@endsection