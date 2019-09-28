<link rel="stylesheet" type="text/css" href="{{asset('MultiLevelMenu/css/default.css')}}" />
		<link rel="stylesheet" type="text/css" href="{{asset('MultiLevelMenu/css/component.css')}}" />
        <script src="{{asset('MultiLevelMenu/js/modernizr.custom.js')}}"></script>
        <script src="{{asset('MultiLevelMenu/js/jquery.dlmenu.js')}}"></script>
		<script>
			$(function() {
				$( '#dl-menu' ).dlmenu();
			});
		</script>


	<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->
	@foreach($product_today as $row)
											<div class="product_item">
		
												<!-- - - - - - - - - - - - - - Thumbnail - - - - - - - - - - - - - - - - -->
		
												<div class="image_wrap">
		
													<img src="product_img/{{$row->product_image}}" alt="">
		
													<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->
		
													<div class="actions_wrap">
		
														<div class="centered_buttons">
		
															<a href="#" class="button_dark_grey middle_btn quick_view" data-modal-url="modals/quick_view.html">Quick View</a>
		
															<a href="#" class="button_blue middle_btn add_to_cart">Add to Cart</a>
		
														</div><!--/ .centered_buttons -->
		
														<a href="#" class="button_dark_grey middle_btn def_icon_btn add_to_wishlist tooltip_container"><span class="tooltip right">Add to Wishlist</span></a>
		
														<a href="#" class="button_dark_grey middle_btn def_icon_btn add_to_compare tooltip_container"><span class="tooltip left">Add to Compare</span></a>
		
													</div><!--/ .actions_wrap-->
													
													<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->
		
												</div><!--/. image_wrap-->
		
												<!-- - - - - - - - - - - - - - End thumbnail - - - - - - - - - - - - - - - - -->
		
												<!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->
		
												<div class="label_offer percentage">
		
													<div>30%</div>OFF
		
												</div>
		
												<!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->
		
												<!-- - - - - - - - - - - - - - Countdown - - - - - - - - - - - - - - - - -->
		
												<div class="countdown" data-year="2016" data-month="11" data-day="6" data-hours="15" data-minutes="0" data-seconds="0"></div>
		
												<!-- - - - - - - - - - - - - - End countdown - - - - - - - - - - - - - - - - -->
		
												<!-- - - - - - - - - - - - - - Product description - - - - - - - - - - - - - - - - -->
												
												<div class="description">
														<p><a href="#">{{$row->product_name}}</a></p>
		
													
		
													<div class="clearfix product_info">
		
														<!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->
		
														<ul class="rating alignright">
		
															<li class="active"></li>
															<li class="active"></li>
															<li class="active"></li>
															<li class="active"></li>
															<li></li>
		
														</ul>
		
														<!-- - - - - - - - - - - - - - End product rating - - - - - - - - - - - - - - - - -->
		
							
												
							
														<p class="product_price alignleft">
																@if($row->sales_price != null)
															<s>₹ {{$row->regular_price}}</s> 
															<b>₹ {{$row->sales_price}}</b></p>
															@else
															<b>₹ {{$row->regular_price}}</b></p>
																@endif
		
															</div><!--/ .clearfix.product_info-->

														</div>
												<!-- - - - - - - - - - - - - - End of product description - - - - - - - - - - - - - - - - -->
		
											</div><!--/ .product_item-->
											@endforeach
											<!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

										