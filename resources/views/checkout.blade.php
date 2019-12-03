@extends('layout.app')
@section('extra-css')

<style>
	.item-align-left-shipping{
	margin-left: 30px;
	width: auto !important;
	float: none !important;
	}

	.address-align{
	margin-left: 30px;
	width: 50% !important;
	float: none !important;
	}

	.shipping-row{
	  padding: 10px;
	  margin-left: 10px;
	  margin-top: 15px;
	  border: 2px solid #58585a;
	  height: 220px;
	}
	.shipping-details{
	  float: right !important;
	  color: #ffffff;
	  font-size: 14px;
	  background: #3498db;
	  padding: 6px;
	  border-radius: 5px;
	 width: auto !important;
	}
	.transport_style{
	border: #58585a 1px solid;
    padding: 15px;
    text-align: justify;
    margin-left: 10px;
	}
  </style>
@endsection
@section('content')

<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

			<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="/">Home</a></li>
						<li>Checkout</li>

					</ul>

					<h1 class="page_title">Checkout</h1>


					<!-- - - - - - - - - - - - - - Billing information - - - - - - - - - - - - - - - - -->

<!-- <form method="post" id="form" action="#"> -->
						<section class="section_offset">

					<form action="" method="POST">

						<div class="theme_box">

							<h3>Shipping Information</h3>



							<ul class="simple_vertical_list">
								<div class="row">
									<?php $x=1 ?>
									@foreach ($shipping as $item)

									<li class="col-sm-4 col-md-4 col-lg-4  shipping-row">
											<div class="col-xs-12">
												<label for="radio_<?php echo $x?>" class="item-align-left-shipping">{{$item->first_name}}</label>
												<label for="radio_<?php echo $x?>" class="item-align-left-shipping">{{$item->last_name}}</label><br>
												<label for="radio_<?php echo $x?>" class="item-align-left-shipping">{{$item->email}}</label><br>

												@if($x == 1)
												<input type="radio" checked name="ship" id="radio_<?php echo $x?>" value="{{$item->id}}">
												@else
												<input type="radio" name="ship" id="radio_<?php echo $x?>" value="{{$item->id}}">
												@endif

												<label for="radio_<?php echo $x?>" class="address-align">{{$item->address}}</label><br>
												<label for="radio_<?php echo $x?>" class="item-align-left-shipping">{{$item->state}}</label> <label class="item-align-left-shipping" for="radio_<?php echo $x?>">{{$item->zip}}</label>

											</div>

										</li>




										<?php


										$x++?>

									@endforeach

								</div>

							</ul>
							<br>
							<div class="left_side">

									<a href="/shipping" class="button_blue middle_btn">Create New Shipping Details</a>

								</div>

							<br>
							<h3>Billing Information</h3>



							<ul class="simple_vertical_list">
									<div class="row">
										<?php $x=1 ?>
										@foreach ($billing as $item)

										<li class="col-sm-4 col-md-4 col-lg-4 shipping-row">
												<div class="col-xs-12">
													<label for="billing_<?php echo $x?>" class="item-align-left-shipping">{{$item->first_name}}</label>
													<label for="billing_<?php echo $x?>" class="item-align-left-shipping">{{$item->last_name}}</label><br>
													<label for="billing_<?php echo $x?>" class="item-align-left-shipping">{{$item->email}}</label><br>
													@if($x == 1)
													<input type="radio" checked name="billing" id="billing_<?php echo $x?>" value="{{$item->id}}">
													@else
													<input type="radio" name="billing" id="billing_<?php echo $x?>" value="{{$item->id}}">
													@endif
													<label for="billing_<?php echo $x?>" class="item-align-left-shipping">{{$item->telephone}}</label><br>
													<label for="billing_<?php echo $x?>" class="address-align">{{$item->address}}</label><br>
													<label for="billing_<?php echo $x?>" class="item-align-left-shipping">{{$item->state}}</label>  <label class="item-align-left-shipping" for=billing_<?php echo $x?>">{{$item->zip}}</label>

												</div>



											</li>




											<?php


											$x++?>

										@endforeach

									</div>

								</ul>
								<br>
								<div class="left_side">

										<a href="/billing" class="button_blue middle_btn">Create New Billing Details</a>

									</div>
							<br>

							{{-- <h3>Transport </h3> --}}

							<?//php echo $output; ?>
						{{-- <br>
						<br>
						<div class="left_side v_centered">

								<span>Forgot anything from Transport?</span>

								<a href="/edit-transport" class="button_grey middle_btn">Edit Your Transport</a>

							</div> --}}
							<br>
						<br>
						<h3>Select Your Construction Site</h3>
							<a href="javascript:void(null)"  class="button_blue mini_btn" data-modal-url="/account/create-project">Create New Site</a>
							<ul class="simple_vertical_list">
								@if(count($project)>0)
								<br>
								@foreach($project as $index => $pro)
								<li>

								<input type="radio" value="{{$pro->id}}" <?php echo $index ==0 ? 'checked':''?> name="project" id="radio_button_{{$index}}">
								<label for="radio_button_{{$index}}">{{$pro->project_name}}</label>

								</li>

								@endforeach
								@endif
							</ul>
							<br>
							<br>
							<hr>
							<br>

						<h3>Select Payment Type</h3>
							<ul class="simple_vertical_list">
									<li>

										<input value="online" type="radio" checked name="payment_type" id="radio_button_2222">
										<label for="radio_button_2222">Pay Online</label>

									</li>
									@if($location->cod == 0 && $cod_limit->cod > $totalPrice)
									
									<li>

										<input value="cod" type="radio" name="payment_type" id="radio_button_1111">
										<label for="radio_button_1111">Cash on Delivery</label>

									</li>
									@endif
								

								</ul>



						<br>
						<br>
						<hr>
						<br>


						<h3>Order Review</h3>



						<div class="table_wrap">

							<table class="table_type_1 order_review">

								<thead>
									<tr>
										<th colspan="2" class="product_title_col">Product Name</th>
										<th class="product_price_col">Price</th>
										<th class="product_qty_col">Quantity</th>
										<th class="product_qty_col" style="width:15% !important">TAX(GST)</th>
										{{-- <th class="product_qty_col">Sub Total</th> --}}
										<th class="product_total_col">Total</th>
									</tr>
								</thead>

								<tbody>
									<?php echo $result?>
								</tbody>

								<tfoot>
									{{-- @if(Session::has('transport')) --}}
								{{-- <tr>
										<td colspan="5" class="bold">Transport </td>
								<td class="total" style="text-align:center">₹ {{$transport_Price}}</td>
									</tr> --}}
									<?php //$totalPrice+=$transport_Price?>
									{{-- @endif --}}
									{{-- <tr>
										<td colspan="5" class="bold"> Exclusive Tax (GST)</td>

										<td class="total">₹ </td>
									</tr> --}}

									<tr>
										
										<td colspan="5" class="bold">Subtotal</td>
										<td class="total">₹ {{$totalPrice}}</td>

									</tr>
									

								<?php echo $shipping_price ?>
								
									<tr>
										<td colspan="5" class="grandtotal">Grand Total</td>
										<td class="grandtotal" style="text-align:center">₹ {{$final_total}}</td>
									</tr>

								</tfoot>

							</table>

						</div>

						<footer class="bottom_box on_the_sides">

							<div class="left_side v_centered">

								<span>Forgot an item?</span>

								<a href="/cart" class="button_grey middle_btn">Edit Your Cart</a>

							</div>

							<div class="right_side">

								<button type="button" class="button_blue middle_btn" id="order_button">PROCEED TO PAY</button>

							</div>

						</footer>
					</form>

					</section>

					<!-- - - - - - - - - - - - - - End of order review - - - - - - - - - - - - - - - - -->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
			@section('extra-js')
			<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
      <script>
			  var pay_type = 2;
			  
         var SITEURL = '{{URL::to('')}}';
         $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
         }); 
         $('body').on('click', '#order_button', function(e){
			var billing_id =  $('input[name=billing]:checked').val();
			var shipping_id =  $('input[name=ship]:checked').val();
			var project_id =  $('input[name=project]:checked').val();
			 if(pay_type ==2){
           var totalAmount = '{{$online_total}}';
           var options = {
           "key": "rzp_live_pdj3f0qWQslA0N",
           "amount": (totalAmount*100), // 2000 paise = INR 20
           "name": "MSupply",
           "description": "Payment",
           //"image": "https://www.tutsmake.com/wp-content/uploads/2018/12/cropped-favicon-1024-1-180x180.png",
           "handler": function (response){
                 $.ajax({
                  // url: SITEURL + 'paysuccess',
                   url: '/account/online-payment',
                   type: 'post',
                   dataType: 'json',
                   data: {
                    payment_id: response.razorpay_payment_id,billing_id:billing_id,shipping_id:shipping_id,payment_type:0,project_id:project_id,
                   }, 
                   success: function (msg) {
					window.location.href = '/account/orders';
                       //window.location.href = SITEURL + 'razor-thank-you';
                   }
               });
             
           },
          "prefill": {
               "contact": '{{Auth::user()->phone}}',
               "email":   '{{Auth::user()->email}}',
           },
        //    "theme": {
        //        "color": "#528FF0"
        //    }
         };
         var rzp1 = new Razorpay(options);
         rzp1.open();
         e.preventDefault();
		 }else{
			
	
			 $.ajax({
                  // url: SITEURL + 'paysuccess',
				   url: '/account/online-payment',
				   headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
                   type: 'post',
                   dataType: 'json',
                   data: {
                    payment_id: null,billing_id:billing_id,shipping_id:shipping_id,payment_type:1,project_id:project_id,
                   }, 
                   success: function (msg) {
				
                       window.location.href = '/account/orders';
                   }
               });
			}
		});
         /*document.getElementsClass('buy_plan1').onclick = function(e){
           rzp1.open();
           e.preventDefault();
         }*/
      </script>
			<script>
			
			$('#radio_button_1111').click(function(){
				pay_type = 1;
				$('#order_button').text('PLACE TO ORDER')
			});
			$('#radio_button_2222').click(function(){
				pay_type = 2;
				$('#order_button').text('PROCEED TO PAY')
			});
            //var otpValue = 666333;
	// 	$('#order_button').click(function(){
    //         // if($('input[name=payment_type]:checked').val() == 'cod'){
    //         //     $.ajax({
    //         //         url:'/account/verify-order-sms',
    //         //         method:'GET',
    //         //         success:function(data){
    //         //             $.arcticmodal({
    //         //             url : 'modals/otp.html'
    //         //         });
    //         //         }
    //         //     })
    //         // }else{
    //             var shipping = $('input[name=ship]:checked').val();
	// 		var billing = $('input[name=billing]:checked').val();
    //   window.location.href = '/order-placed/'+pay_type+'/'+shipping+'/'+billing;
    //         // }


    //         })

    //         function otpVerified(){
    //     var shipping = $('input[name=ship]:checked').val();
	//     var billing = $('input[name=billing]:checked').val();
    //   window.location.href = '/order-placed/'+pay_type+'/'+shipping+'/'+billing;
    //         }

			</script>
			@endsection
@endsection
