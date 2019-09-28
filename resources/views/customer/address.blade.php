@extends('layout.app')

@section('content')

<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

			<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="index.html">Home</a></li>
						<li>manage address</li>

					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">

						@include('include.accountSidebar')

						<main class="col-md-9 col-sm-8">

							<h1>Managing Shipping & Billing
								 Address</h1>
							<section class="theme_box">

								
								<!-- <a id="open_model" href="#" class="button_blue"><i class="fas fa-plus"></i> ADD A NEW ADDRESS</a> -->
								
<div style="padding-top:40px"></div>
										<div class="table_wrap">
		
											<!-- - - - - - - - - - - - - - Table v2 - - - - - - - - - - - - - - - - -->
		
											<div class="col-sm-6">
												<h4 style="padding:10px">Shipping Address</h4>
											<table class="table" id="shippingTable">
		
												<tbody>
												@foreach($shipping as $address1)
													<tr>
															<td>
															
												
															
                              <h5>{{$address1->first_name}}  {{$address1->last_name}}</h5>
                            
                              <p>{{$address1->email}} - {{$address1->telephone}}</p>
                              <p>{{$address1->city}} - {{$address1->state}}</p>
                            
															<p>{{$address1->address}}</p>
															<div style="padding-bottom:10px"></div>
															<a href="javascript:void(null)" onclick="deleteShipping({{$address1->id}})" class="button_dark_grey">Delete</a>
							
															<a href="/account/edit-shipping/{{$address1->id}}" class="button_dark_grey pull-right">Edit</a>
														</td>
													</tr>
												@endforeach
											</tbody>
											
											
										</table>
										<div class="left_side" style="padding:20px">

												<a href="/account/shipping" class="button_blue middle_btn">Create Shipping</a>
				
											</div>
									</div>
											<div class="col-sm-6">
													<h4 style="padding:10px">billing Address</h4>
												
											<table class="table" id="billingTable">
		
												<tbody>
												@foreach($billing as $address1)
													<tr>
														<td>
														
                              <h5>{{$address1->first_name}}  {{$address1->last_name}}</h5>
                            
                              <p>{{$address1->email}} - {{$address1->telephone}}</p>
                              <p>{{$address1->city}} - {{$address1->state}}</p>
                            
															<p>{{$address1->address}}</p>
															<div style="padding-bottom:10px"></div>
															<a href="javascript:void(null)" onclick="deleteBilling({{$address1->id}})" class="button_dark_grey">Delete</a>
							
															<a href="/account/edit-shipping/{{$address1->id}}" class="button_dark_grey pull-right">Edit</a>
														</td>
													</tr>
												@endforeach
											</tbody>
											
											
										</table>
										<div class="right_side" style="padding:20px">

												<a href="/account/billing" class="button_blue middle_btn">Create Billing</a>
				
											</div>
									</div>
		
											<!-- - - - - - - - - - - - - - End of table v2 - - - - - - - - - - - - - - - - -->
		
										
		
									</div>
								</section><!--/ .theme_box -->
								
                        </main>
                    </div>
                </div>
			</div>



@endsection

@section('extra-js')

<script>

	function Update(){
      var formData = new FormData($('#account_form')[0]);

        $.ajax({
          url : '/account/updateAddress',
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "JSON",
          success: function(data)
          {
            console.log(data);
              $("#account_form")[0].reset();
               $('#account_model').modal('hide');
               $('.table').load(location.href+' .table');
               toastr.success('Data Update Successfully', 'Successfully Update');
		  },
		  error: function (data, errorThrown) {
          	var errorData = data.responseJSON.errors;
           		$.each(errorData, function(i, obj) {
              		toastr.error(obj[0]);
          		});
          }
      });
      
    }

    function deleteShipping(id){
			if (confirm('Are you sure you want to Delete this Address?')) {
      $.ajax({
        url : '/account/delete-shipping/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('#shippingTable').load(location.href+' #shippingTable');
        }
      });
			}
    }
    function deleteBilling(id){
			if (confirm('Are you sure you want to Delete this Address?')) {
      $.ajax({
        url : '/account/delete-billing/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('#billingTable').load(location.href+' #billingTable');
        }
      });
			}
    }



</script>
<script>
	$('.accAddress').addClass('current');
</script>
@endsection