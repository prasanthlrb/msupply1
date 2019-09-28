@extends('layout.app')
@section('extra-css')
<style>
ul.pagination {
	list-style: none;
}
.pagination > li{ float: left; }

		.pagination > li:first-child > a{ border-radius: 3px 0 0 3px; }

		.pagination > li:first-child > a::before,
		.pagination > li:last-child > a::before{
			display: inline-block;
			position: relative;
			top: -1px;
			font-size: 13px;
			font-family: 'fontello';	
		}

		.pagination > li:first-child > a::before{ content: '\eab8'; }
		.pagination > li:last-child > a::before{ content: '\eab9'; }

		.pagination > li:last-child > a{ border-radius: 0 3px 3px 0; }

		.pagination > li:not(:last-child) > a{ border-right: none; }

		.pagination > li > a{
			position: relative;
			display: block;
			width: 30px;
			height: 30px;
			text-align: center;
			font-size: 14px;
			line-height: 30px;
			border: 1px solid #eaeaea;
			background: #fff;
		}
		.pagination > li > span{
			position: relative;
			display: block;
			width: 30px;
			height: 30px;
			text-align: center;
			font-size: 14px;
			line-height: 30px;
			border: 1px solid #eaeaea;
			background: #fff;
		}

		.pagination > li:not(:last-child) > a::after{
			content: "";
			position: absolute;
			z-index: 1;
			right: -1px;
			top: -1px;
			bottom: -1px;
			display: block;
			width: 1px;
			background: #ff4557;
			opacity: 0;

			-webkit-transition: opacity .7s ease;
					transition: opacity .7s ease;
		}

		.pagination > li.active:not(:last-child) > a::after,
		.pagination > li:not(:last-child) > a:hover::after{
			opacity: 1;

			-webkit-transition: opacity .1s ease;
					transition: opacity .1s ease;
		}

		.pagination > li.active > span,
		.pagination > li > a:hover{
			color: #fff;
			background: #ff4557;
			border-color: #ff4557;
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
						<li>Orders</li>

					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">
						@include('include.accountSidebar')

                        <main class="col-md-9 col-sm-8">

							<h1>My Orders</h1>

							<header class="top_box on_the_sides">

									

								<div class="right_side">
										{{$orders->links()}}
									{{-- <ul class="pags">
											
										<li><a href="#"></a></li>
										<li class="active"><a href="#">1</a></li>
										<li><a href="#">2</a></li>
										<li><a href="#">3</a></li>
										<li><a href="#"></a></li>

									</ul> --}}

								</div>

							</header><!--/ .top_box -->

							<div class="table_wrap">

								<table class="table_type_1 orders_table">

									<thead>

										<tr>
											
											<th class="order_number_col">Order Number</th>
											<th>Order Date</th>
											<th class="ship_col">Ship To</th>
											<th>Order Status</th>
											<th class="order_total_col">Total</th>
											<th class="product_action_col">Action</th>

										</tr>

									</thead>

									<tbody>
									@foreach($orders as $order)
										<tr>
											<td data-title="Order Number"><a href="/account/vieworders/{{$order->id}}" style="color: #ff4557;">#{{$order->id}}</a></td>
											<td data-title="Order Date">{{date('Y-m-d', strtotime($order->created_at))}}</td>
											<td data-title="Ship To">
												<p>{{$order->first_name}} - {{$order->last_name}}</p>
												<p>{{$order->telephone}}</p>
												<p>{{$order->address}}</p>
												<p>{{$order->zip}}</p>
											</td>
											
											<td data-title="Order Status">

												@if($order->order_status == 0)
												Pending
												@elseif($order->order_status == 1)
											
												Processing
												@elseif($order->order_status == 2)
												Shipping
												@elseif($order->order_status == 3)
												Delivered
												@elseif($order->order_status == 4)
												on-hold
												@elseif($order->order_status == 5)
												Cancel
												@endif
											</td>
											<td data-title="Total" class="total">₹ {{$order->total_amount}}</td>
											<td data-title="Action">
												<ul class="buttons_col">
													<li>
														<a href="/account/vieworders/{{$order->id}}" class="button_grey">View Order</a>
													</li>
													<!-- <li>
														<a href="#" class="button_grey">Reorder</a>
													</li> -->
												</ul>
											</td>
										</tr>
									@endforeach
									</tbody>

								</table>

							</div>

						</main><!--/ [col]-->
					</div><!--/ .row-->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
			
            <!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->
  
			@endsection
			
			@section('extra-js')
			<script>
					$('.accOrders').addClass('current');
				</script> 
@endsection