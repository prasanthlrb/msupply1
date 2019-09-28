@extends('layout.app')
@section('extra-css')
@if ($errors->has('*') != "")
<style>
.display_hide{
  display:block !important;
}
</style>
@endif
<style>
    .display_hide{
      display: none;
    }
    </style>
@endsection
@section('content')
{{$errors->has('*')}}
<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

			<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="index.html">Home</a></li>
						<li>My Account</li>

					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">

						@include('include.accountSidebar')

						<main class="col-md-9 col-sm-8">

							<h1>My Profile</h1>

							@if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

							<section class="theme_box table">

								<h4>Personal Information</h4>

								<p>Name : {{Auth::user()->name}}<br>
								<!-- <a href="#" class="mail_to">male</a> -->
								</p>
								<p>Email : <a href="#" class="mail_to">{{Auth::user()->email}}</a></p>

								<p>Mobile Number : <a href="#" class="mail_to">{{Auth::user()->phone}}</a></p>

							</section>
							
							<section class="theme_box">
								<div class="buttons_row">
                  <div class="row">
                    <div class="col-sm-6">
                      <a href="javascript:void(null)" id="show_account_info" class="button_grey middle_btn">Edit Account Information</a>
                    <div class="display_hide" id="account_info">
                      <form id="account_form" action="/account/change-account-info" method="post">
                          {{ csrf_field() }}
                            <ul> 
                              <li class="row">
                                <div class="col-sm-12">
                                  <label for="first_name" class="required">Name</label>
                                  <input  type="text" name="name" value="{{Auth::user()->name}}">
                                </div>
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                              </li>
                              <li class="row">
                                <div class="col-sm-12">
                                  <label for="first_name" class="required">Phone</label>
                                  <input  type="text" name="phone" value="{{Auth::user()->phone}}">
                                </div>
                                @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </span>
                            @endif
                              </li>
                              <li class="row">
                                <div class="col-sm-12">
                                  <label for="first_name" class="required">E-Mail ID</label>
                                  <input  type="text" name="email" value="{{Auth::user()->email}}">
                                </div>
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                              </li>
                              
                            </ul>
                            <div class="right_side" style="padding-top:15px">
                                <button  type="submit" class="button_blue middle_btn">Save</button>
                                <button id="close_account_info" style="float:right" type="button" class="button_blue middle_btn">Close</button>
                              </div>
                          </form>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <a href="javascript:void(null)" id="show_password" class="button_grey middle_btn">Change Password</a>
                       
                        <form id="password_form" action="/account/userchangePassword" method="post" class="display_hide change_pass">
                            {{ csrf_field() }}
                              <ul> 
                                <li class="row">
                                  <div class="col-sm-12">
                                    <label class="required">New Password</label>
                                    <input  type="password" name="password" id="password">
                                  </div>
                                  @if ($errors->has('password'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                              @endif
                                </li>

                                <li class="row">
                                  <div class="col-sm-12">
                                    <label class="required">Re Enter Password</label>
                                    <input  type="password" name="password_confirmation" id="password_confirmation">
                                  </div>
                                  @if ($errors->has('password_confirmation'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('password_confirmation') }}</strong>
                                  </span>
                              @endif
                                </li>

                              </ul>
                              <div class="right_side" style="padding-top:15px">
                                  <button type="submit" class="button_blue middle_btn">Save</button>
                                  <button id="close_password" style="float:right" type="button" class="button_blue middle_btn">Close</button>
                                </div>
                            </form>
                   

                    </div>
                  </div>
								</div>
							</section>

						</main><!--/ [col]-->

					</div><!--/ .row-->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
			
			<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->

  <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/toastr.css')}}">
  {{-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.css')}}"> --}}
  <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="{{ asset('app-assets/js/scripts/extensions/toastr.js')}}" type="text/javascript"></script>
<script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js')}}" type="text/javascript"></script>
<script>
$('.profileInformation').addClass('current');

//Account Info
$('#show_account_info').click(function(){
  $('#account_info').removeClass('display_hide');
  $('#show_account_info').addClass('display_hide');
// toastr.success('Data Update Successfully', 'Successfully Update');
});
$('#close_account_info').click(function(){
  $('#account_info').addClass('display_hide');
  $('#show_account_info').removeClass('display_hide');
});
//password change
$('#show_password').click(function(){
  $('.change_pass').removeClass('display_hide');
  $('#show_password').addClass('display_hide');
});
$('#close_password').click(function(){
  $('.change_pass').addClass('display_hide');
  $('#show_password').removeClass('display_hide');
});


	// function changePass(){
  //     var formData = new FormData($('#password_form')[0]);

  //       $.ajax({
  //         url : '/account/userchangePassword',
  //         type: "POST",
  //         data: formData,
  //         contentType: false,
  //         processData: false,
  //         dataType: "JSON",
  //         success: function(data)
  //         {
  //           console.log(data);
  //             	$("#password_form")[0].reset();
  //           	$('#password_model').modal('hide');
  //              toastr.success('Change Password Successfully', 'Successfully Update');
	// 	  },
	// 	  error: function (data, errorThrown) {
  //         	var errorData = data.responseJSON.errors;
  //          		$.each(errorData, function(i, obj) {
  //             		toastr.error(obj[0]);
  //         		});
  //         }
  //     });
      
	// }
	
	// function Update(){
  //     var formData = new FormData($('#account_form')[0]);

  //       $.ajax({
  //         url : '/account/updateCustomer',
  //         type: "POST",
  //         data: formData,
  //         contentType: false,
  //         processData: false,
  //         dataType: "JSON",
  //         success: function(data)
  //         {
  //           console.log(data);
  //             $("#account_form")[0].reset();
  //              $('#account_model').modal('hide');
  //              $('.table').load(location.href+' .table');
  //              toastr.success('Data Update Successfully', 'Successfully Update');
	// 	  },
	// 	  error: function (data, errorThrown) {
  //         	var errorData = data.responseJSON.errors;
  //          		$.each(errorData, function(i, obj) {
  //             		toastr.error(obj[0]);
  //         		});
  //         }
  //     });
      
  //   }




</script>

@endsection