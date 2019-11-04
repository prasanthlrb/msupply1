@extends('layout.app')
@section('extra-css')
<style>
.fa{
	margin-top:5px;
}
</style>

@endsection
@section('content')

<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

			<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="index.html">Home</a></li>
						<li>My site</li>

					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">

						@include('include.accountSidebar')

						<main class="col-md-9 col-sm-8">

							<h1></h1>

						
                   

							<section class="theme_box table">
								<a href="javascript:void(null)"  class="button_blue mini_btn" style="float:right" data-modal-url="/account/create-project">Create New Site</a>
								<h3>Site List</h3>
								
        <section class="section_offset">
            <div class="row">


@foreach($project as $row)
                <div class="col-md-4">
                    <div class="theme_box">

									<div class="seller_info clearfix">


										<div class="wrapper">

                    <a href="javascript:void(null)"><b>{{$row->project_name}}</b></a>

                    <p class="seller_category">Start At : {{$row->created_at}}</p>

										</div>

									</div><!--/ .seller_info-->

									<ul class="seller_stats">


										<li><i class="fa fa-inr" aria-hidden="true"></i><span class="bold"> 0 </span> Spend</li>


									</ul>

									<div class="v_centered">

                  <a href="javascript:void(null)" class="small_link" data-modal-url="/account/edit-project/{{$row->id}}"><i class="fas fa-edit"></i></a>

										<a href="javascript:void(null)" class="button_blue mini_btn" onclick="deleteProject($row->id)"><i class="fas fa-trash-alt"></i></a>

									</div>

								</div><!--/ .theme_box -->
                </div>

@endforeach


            </div>

								


							</section>
								

							</section>
							
							<section class="theme_box">
								<div class="buttons_row">
                  <div class="row">
                   
                  
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
function saveProject(){
      var formData = new FormData($('#project_form')[0]);

        $.ajax({
                url : '/account/create-project',
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {

					
                     toastr.success(data.message);
                     window.location.replace("/account/project");

                },error: function (data) {
                    console.log(data)
                  toastr.error('Site Title Required', 'Required!');
              }
            });
  

    }
	function updateProject(){
      var formData = new FormData($('#project_form')[0]);

        $.ajax({
                url : '/account/update-project',
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {

					
                     toastr.success(data.message);
                      window.location.replace("/account/project");
                },error: function (data) {
                    console.log(data)
                  toastr.error('Site Title Required', 'Required!');
              }
            });
  

    }
	 

    function deleteProject(id){

    }

</script>

@endsection