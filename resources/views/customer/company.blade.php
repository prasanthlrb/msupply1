@extends('layout.app')
@section('content')

<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

			<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="/">Home</a></li>
						<li>Company Profile Submit</li>

					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">

					
						<main class="col-md-9 col-sm-8">

							<h1>Company Profile Submit</h1>

							
              <form action="/submit-company" action="" method="post" class="type_2" enctype="multipart/form-data">
							<section class="theme_box table">
                                   
                                            {{ csrf_field() }}
                                         
                                                <ul> 
                                                    <li class="row">
                                                        <div class="col-sm-12">
                                                            <label for="company" class="required">Company Name</label>
                                                            <input  type="text" name="company" id="company">
                                                        </div>
                                                        @if ($errors->has('company'))
                                                        <span class="invalid-feedback text-danger" style="color:#ff4557;float:right;padding:10px" role="alert">
                                                            <strong>{{ $errors->first('company') }}</strong>
                                                        </span>
                                                    @endif
                                                    </li>
                                                    <li class="row">
                                                        <div class="col-sm-12">
                                                            <label for="gst" class="required">GST No</label>
                                                            <input  type="text" name="gst" id="gst">
                                                        </div>
                                                        @if ($errors->has('gst'))
                                                        <span class="invalid-feedback text-danger" style="color:#ff4557;float:right;padding:10px" role="alert">
                                                            <strong>{{ $errors->first('gst') }}</strong>
                                                        </span>
                                                    @endif
                                                    </li>
                                                    <li class="row">
                                                        <div class="col-sm-12">
                                                            <label for="gst_doc" class="required">GST Document Picture</label>
                                                  
                                                            <input type="file" class="form-control" placeholder="Upload your GST"
                                                            name="gst_doc" id="gst_doc">
                                                        </div>
                                                        @if ($errors->has('gst_doc'))
                                                        <span class="invalid-feedback text-danger" style="color:#ff4557;padding:10px" role="alert">
                                                            <strong>{{ $errors->first('gst_doc') }}</strong>
                                                        </span>
                                                    @endif
                                                    </li>
                                                </ul>
                                            
							</section>
							
							<section class="theme_box">
								<div class="buttons_row">
                  <button type="submit" class="button_grey middle_btn">Submit</button>
									
								</div>
							</section>
            </form>
						</main><!--/ [col]-->

					</div><!--/ .row-->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
			
			<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->

@endsection