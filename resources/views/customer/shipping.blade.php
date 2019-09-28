@extends('layout.app')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/selects/select2.min.css">
@endsection
@section('content')

<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

			<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="/">Home</a></li>
						<li>Shipping</li>

					</ul>

					<h1 class="page_title">Create Shipping Address</h1>


					<!-- - - - - - - - - - - - - - Billing information - - - - - - - - - - - - - - - - -->

<!-- <form method="post" id="form" action="#"> -->
						<section class="section_offset">

					
						<div class="theme_box">

							<a class="icon_btn button_dark_grey edit_button" href="#"><i class="icon-pencil"></i></a>

						<form action="/account/createShipping" method="post" class="type_2">
						{{ csrf_field() }}
							<ul>
							
								<li class="row">
									<div class="col-sm-6">
										<label for="first_name" class="required">First Name</label>
										<input value="<?php echo old('first_name'); ?>" type="text" name="first_name" id="first_name">
										<label style="color:red;"><?php echo $errors->first('first_name'); ?></label>
									</div>
									<div class="col-sm-6">
										<label for="last_name" class="required">Last Name</label>
										<input value="<?php echo old('last_name'); ?>" type="text" name="last_name" id="last_name">
										<label style="color:red;"><?php echo $errors->first('last_name'); ?></label>
									</div>
								</li>

									<li class="row">
										
										<div class="col-sm-6">
											
											<label for="email" class="required">Email Address</label>
											<input value="<?php echo old('email'); ?>" type="email" name="email" id="email">
											<label style="color:red;"><?php echo $errors->first('email'); ?></label>

										</div>
										<div class="col-sm-6">

											<label for="telephone" class="required">Telephone</label>
											<input value="<?php echo old('telephone'); ?>" type="text" name="telephone" id="telephone">
											<label style="color:red;"><?php echo $errors->first('telephone'); ?></label>

										</div>

									</li>

									<li class="row">	

										<div class="col-xs-12">

											<label for="address" class="required">Address</label>
											<textarea id="address" name="address"><?php echo old('address'); ?></textarea>
											<label style="color:red;"><?php echo $errors->first('address'); ?></label>

										</div>

									</li>


									<li class="row">

										<div class="col-sm-6">
											
											<label class="required"> City </label>

												<select style="width:100%" name="city" id="city" class="select2 form-control col-md-12" placeholder="search for Category">
												
														@foreach($citys as $data)
														<option value="{{$data}}" {{$data == "Madurai" ? 'selected' : '' }}>{{$data}}</option>
														@endforeach
												
													
													</select>
											
											

											
										</div>

										<div class="col-sm-6">

											<label class="required">State/Province</label>

											<div class="custom_select">

												<select name="state" id="state">
												@if (old('state') != "")
												<option value="<?php echo old('state'); ?>"><?php echo old('state'); ?></option>
												@else
													<option value="Tamil Nadu">Tamil Nadu</option>
													<option value="Other state">Other state</option>
											
												@endif
												</select>
												<label style="color:red;"><?php echo $errors->first('state'); ?></label>

											</div>

										</div>

									</li>

									<li class="row">

										<div class="col-sm-6">

											<label for="zip" class="required">Zip/Postal Code</label>
											<input value="<?php echo old('zip'); ?>" type="text" name="zip" id="zip">
											<label style="color:red;"><?php echo $errors->first('zip'); ?></label>

										</div><!--/ [col] -->

										<div class="col-sm-6">

											<label class="required">Country</label>

											<div class="custom_select">
												
												<select name="country" id="country">
												@if (old('country') != "")
												<option value="<?php echo old('country'); ?>"><?php echo old('country'); ?></option>
												@else
												<option value="India">India</option>
												@endif
												</select>
												<label style="color:red;"><?php echo $errors->first('country'); ?></label>

											</div>

										</div><!--/ [col] -->

									</li><!--/ .row -->
                                 

                                    <br>
                            </ul>
                            <footer class="bottom_box on_the_sides">

                                
    
                                <div class="right_side">
    
                                    <button type="submit" class="button_blue middle_btn">Submit</button>
    
                                </div>
    
                            </footer>
                        </form>
						</div>
					</section>

					<!-- - - - - - - - - - - - - - End of order review - - - - - - - - - - - - - - - - -->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->

			@section('extra-js')
			<script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
			<script src="../../../app-assets/js/scripts/forms/select/form-select2.js" type="text/javascript"></script>
			@endsection

@endsection