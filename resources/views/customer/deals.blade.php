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
						<li>Deal</li>

					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">
						@include('include.accountSidebar')

                        <main class="col-md-9 col-sm-8">

							<h1>My Deal</h1>

							<header class="top_box on_the_sides">

									

								<div class="right_side">
										{{-- {{$orders->links()}} --}}
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
											
											<th>S No</th>
											<th>Deal Date</th>
											<th class="product_action_col1">Product Details</th>
											<th>Deal Status</th>
											<th class="order_total_col">Deal with</th>
											<th class="order_total_col">Total</th>
											<th class="order_number_col">Remark</th>
											<th class="product_action_col">Action</th>

										</tr>

									</thead>

									<tbody>
								
										<tr>
											<td data-title="Order Number"><a href="/account/vieworders/" style="color: #ff4557;">1</a></td>
											<td data-title="Order Date">15-08-2019</td>
											<td data-title="Ship To">
											<p>Bricks - qty(1000) - 5,000</p>
											<p>JWS STEEL 12mm- qty(2) Ton - 55,000</p>
											</td>
											
											<td data-title="Order Status">
                                                Waiting
											</td>
											<td data-title="Total" class="total">
                                                Priya
                                            </td>
											<td data-title="Total">
                                                60,000 INR
                                            </td>
											<td>
                                                You have been Taked more than 10,000 Bricks
                                            </td>
											<td data-title="Action">
												<ul class="buttons_col">
													<li>
														<a href="/account/vieworders/" class="button_grey">Order Now</a>
													</li>
													<!-- <li>
														<a href="#" class="button_grey">Reorder</a>
													</li> -->
												</ul>
											</td>
										</tr>
									
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
					$('.accDeals').addClass('current');
				</script> 
@endsection