@extends('layout.app')
@section('content')

<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

			<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="index.html">Home</a></li>
						<li>Contact Us</li>

					</ul>

					<div class="row">

				@include('include.infoSidebar')

						<main class="col-md-9 col-sm-8">

							<h1 class="page_title">Contact Us</h1>

							<section class="section_offset">
								
								<h3>Contact Form</h3>

								<div class="theme_box">

									<form novalidate enctype="multipart/form-data"  id="contact_form">
									{{csrf_field()}}
										<ul>
											<li class="row">
												<div class="col-sm-6">
													<label for="cf_name" class="required">Name</label>
													<input type="text" required name="cf_name" id="cf_name" title="Name">
												</div><!--/ [col]-->
												<div class="col-sm-6">
													<label for="cf_email" class="required">Email Address</label>
													<input type="email" required name="cf_email" id="cf_email" title="Email">
												</div><!--/ [col]-->
											</li><!--/ .row -->

											<li class="row">

												<div class="col-xs-12">

													<label for="cf_order_number">Order number</label>
													<input type="text" name="cf_order_number" id="cf_order_number" title="Order number">

												</div><!--/ [col]-->

											</li><!--/ .row -->

											<li class="row">

												<div class="col-xs-12">

													<label for="cf_message" class="required">Message</label>
													<textarea id="cf_message" required name="cf_message" title="Message" rows="6"></textarea>

												</div><!--/ [col]-->

											</li><!--/ .row -->

											{{-- <div class="g-recaptcha" 
												data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
											</div> --}}

										</ul>

									</form><!--/ .contactform -->

									<!-- - - - - - - - - - - - - - End of contact form - - - - - - - - - - - - - - - - -->

								</div><!--/ .theme_box -->

								<footer class="bottom_box on_the_sides">

									<div class="left_side">
									
										<button onclick="mailsend()" class="button_dark_grey middle_btn" type="button" form="contact_form">Submit</button>

									</div>

									<div class="right_side">

										<p class="prompt">Required Fields</p>

									</div>

								</footer>

							</section>

							<section class="section_offset">

								<h3>Contact Information</h3>

								<div class="theme_box">

									<div class="row">

										<div class="col-sm-5">

											<div class="proportional_frame">

												<iframe src="{{isset($contact_info[0]->map1) ? $contact_info[0]->map1 : ''}}" style="border:0"></iframe>

											</div>

										</div><!--/ [col]-->

										<div class="col-sm-7">

											<p class="form_caption">Store Location.</p>

											<ul class="c_info_list">
											@foreach($contact_info as $contact)
												<li class="c_info_location">{{$contact->address}}</li>
												<li class="c_info_phone">{{$contact->phone}}</li>
												<li class="c_info_mail"><a href="mailto:#">{{$contact->email}}</a></li>
											@endforeach  
											</ul>

										</div><!--/ [col]-->

									</div><!--/ .row -->

								</div><!--/ .theme_box -->

							</section>

						</main><!--/ [col]-->

					</div><!--/ .row-->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->

@endsection
@section('extra-js')

<script>
	$('.contact_menu').addClass('current');
	function mailsend(){
  	var termsData = new FormData($('#contact_form')[0]);
  	$.ajax({
		url : '/contact-mail',
		type: "POST",
		data: termsData,
		contentType: false,
		processData: false,
		dataType: "JSON",
		success: function(data)
		{
			//console.log(data);                
			$("#contact_form")[0].reset();
			toastr.success('Mail Send Successfully', 'Successfully Send');
		},
		error: function (data, errorThrown) {
          	var errorData = data.responseJSON.errors;
        	$.each(errorData, function(i, obj) {
            	toastr.error(obj[0]);
          	});
        }
	});
}
</script>
@endsection