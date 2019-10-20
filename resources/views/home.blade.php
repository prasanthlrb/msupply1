@extends('layout.app')
@section('content')
<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

			<div class="page_wrapper">

				<div class="container">

					<div class="row">

						<!-- - - - - - - - - - - - - - Banners - - - - - - - - - - - - - - - - -->
						<aside class="col-md-3 col-sm-4 has_mega_menu">

							
								<!-- - - - - - - - - - - - - - Todays deals - - - - - - - - - - - - - - - - -->
								@if(count($product_today) > 0)
								<section class="section_offset animated transparent" data-animation="fadeInDown">

										<h3 class="widget_title">Today's Deals</h3>
		
										<!-- - - - - - - - - - - - - - Carousel of today's deals - - - - - - - - - - - - - - - - -->
									@if(count($product_today) >1)
										<div class="owl_carousel widgets_carousel">
												
											
		
											<!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->
		
											@foreach($product_today as $row)
											<div class="product_item">
		
												<!-- - - - - - - - - - - - - - Thumbnail - - - - - - - - - - - - - - - - -->
		
												<div class="image_wrap">
		
													<img src="product_img/{{$row->product_image}}" alt="">
		
													<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->
		
													<div class="actions_wrap">
		
														<div class="centered_buttons">
		
															<a href="#" class="button_dark_grey middle_btn quick_view" data-modal-url="/quick-view/{{$row->id}}">Quick View</a>
		
														
		
														</div><!--/ .centered_buttons -->
		
														<a href="javascript:void(null)" onclick="addWishlist({{$row->id}})" class="button_dark_grey middle_btn def_icon_btn add_to_wishlist tooltip_container"><span class="tooltip right">Add to Wishlist</span></a>
		
														<a href="javascript:void(null)" onclick="addCompare({{$row->id}})" class="button_dark_grey middle_btn def_icon_btn add_to_compare tooltip_container"><span class="tooltip left">Add to Compare</span></a>
		
													</div><!--/ .actions_wrap-->
													
													<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->
		
												</div><!--/. image_wrap-->
		
												<!-- - - - - - - - - - - - - - End thumbnail - - - - - - - - - - - - - - - - -->
		
												<!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->
												@if($row->regular_price != null && $row->category != 7)

												<div class="label_offer percentage">
													<?php $v1 = $row->regular_price - $row->sales_price;
													$v2 = ceil($v1/$row->regular_price*100); ?>
													<div>{{$v2}}%</div>OFF
		
												</div>
												@endif
												<!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->
		
												<!-- - - - - - - - - - - - - - Product description - - - - - - - - - - - - - - - - -->
												
												<div class="description">
														<p><a href="/product/{{$row->id}}">{{$row->product_name}}</a></p>
		
													
													@if($row->category != 7)
													<div class="clearfix product_info">
		
														<!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->
		
														<?php 
														$getRating = App\rating::where('item_id',$row->id)->get();
														if(count($getRating) > 0){
															$rating_count;
														
														   
														$total=0;
														foreach($getRating as $rows){
															$total +=$rows->rating;
														}
														$rating_count = $total/count($getRating);
												   
														}
														   
							
							
															?>
															@if(count($getRating) > 0)
																<ul class="rating alignright">
							
																		<li class="active"></li>
																		<li class="<?php echo $rating_count >= 2 ? 'active' : '' ?>"></li>
																		<li class="<?php echo $rating_count >= 3 ? 'active' : '' ?>"></li>
																		<li class="<?php echo $rating_count >= 4 ? 'active' : '' ?>"></li>
																		<li class="<?php echo $rating_count >= 5 ? 'active' : '' ?>"></li>
							
																	</ul>
																	@endif
		
														<!-- - - - - - - - - - - - - - End product rating - - - - - - - - - - - - - - - - -->
		
							
												
							
														<p class="product_price alignleft">
																@if($row->regular_price != null)
															<s>₹ {{$row->regular_price}}</s> 
															<b>₹ {{$row->sales_price}}</b></p>
															@else
															<b>₹ {{$row->sales_price}}</b></p>
																@endif
		
															</div>
															@endif
															<!--/ .clearfix.product_info-->

														</div>
												<!-- - - - - - - - - - - - - - End of product description - - - - - - - - - - - - - - - - -->
		
											</div><!--/ .product_item-->
											@endforeach
											
											<!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->
		
									
		
										</div><!--/ .widgets_carousel-->
										@else
										<div class="product_item">
		
												<!-- - - - - - - - - - - - - - Thumbnail - - - - - - - - - - - - - - - - -->
												
												<div class="image_wrap">
		
														<img src="product_img/{{$product_today[0]->product_image}}" alt="">
		
													<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->
		
													<div class="actions_wrap">
		
														<div class="centered_buttons">
		
														<a href="#" class="button_dark_grey middle_btn quick_view" data-modal-url="/quick-view/{{$product_today[0]->id}}">Quick View</a>
		
														
		
														</div><!--/ .centered_buttons -->
		
														<a href="/add-wishlist/{{$row->id}}" class="button_dark_grey middle_btn def_icon_btn add_to_wishlist tooltip_container"><span class="tooltip right">Add to Wishlist</span></a>
		
														<a href="javascript:void(null)" onclick="addCompare({{$product_today[0]->id}})" class="button_dark_grey middle_btn def_icon_btn add_to_compare tooltip_container"><span class="tooltip left">Add to Compare</span></a>
		
													</div><!--/ .actions_wrap-->
													
													<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->
		
												</div><!--/. image_wrap-->
		
												<!-- - - - - - - - - - - - - - End thumbnail - - - - - - - - - - - - - - - - -->
		
												<!-- - - - - - - - - - - - - - Label - - - - - - - - - - - - - - - - -->
		
												<div class="label_offer percentage">
		
													<div>25%</div>OFF
		
												</div>
		
												<!-- - - - - - - - - - - - - - End label - - - - - - - - - - - - - - - - -->
		
												<!-- - - - - - - - - - - - - - Countdown - - - - - - - - - - - - - - - - -->
		
												<div class="countdown" data-year="2016" data-month="2" data-day="9" data-hours="10" data-minutes="30" data-seconds="30"></div>
		
												<!-- - - - - - - - - - - - - - End countdown - - - - - - - - - - - - - - - - -->
		
												<!-- - - - - - - - - - - - - - Product description - - - - - - - - - - - - - - - - -->
		
												<div class="description">
		
														<p><a href="product/{{$product_today[0]->id}}">{{$product_today[0]->product_name}}</a></p>
		
													<div class="clearfix product_info">
		
														<!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->
		
														<?php 
														$getRating = App\rating::where('item_id',$product_today[0]->id)->get();
														if(count($getRating) > 0){
															$rating_count;
														
														   
														$total=0;
														foreach($getRating as $rows){
															$total +=$rows->rating;
														}
														$rating_count = $total/count($getRating);
												   
														}
														   
							
							
															?>
															@if(count($getRating) > 0)
																<ul class="rating alignright">
							
																		<li class="active"></li>
																		<li class="<?php echo $rating_count >= 2 ? 'active' : '' ?>"></li>
																		<li class="<?php echo $rating_count >= 3 ? 'active' : '' ?>"></li>
																		<li class="<?php echo $rating_count >= 4 ? 'active' : '' ?>"></li>
																		<li class="<?php echo $rating_count >= 5 ? 'active' : '' ?>"></li>
							
																	</ul>
																	@endif
		
														<!-- - - - - - - - - - - - - - End product rating - - - - - - - - - - - - - - - - -->
		
														<p class="product_price alignleft">
																@if($product_today[0]->sales_price != null)
															<s>₹ {{$product_today[0]->regular_price}}</s> 
															<b>₹ {{$product_today[0]->sales_price}}</b></p>
															@else
															<b>₹ {{$product_today[0]->regular_price}}</b></p>
																@endif
		
													</div><!--/ .clearfix.product_info-->
		
												</div>
		
												<!-- - - - - - - - - - - - - - End of product description - - - - - - - - - - - - - - - - -->
		
											</div><!--/ .product_item-->
										@endif
										<!-- - - - - - - - - - - - - - End of carousel of today's deals - - - - - - - - - - - - - - - - -->
		
										<!-- - - - - - - - - - - - - - View all deals of the day - - - - - - - - - - - - - - - - -->
		
										
		
										<!-- - - - - - - - - - - - - - End of view all deals of the day - - - - - - - - - - - - - - - - -->
		
									</section><!--/ .section_offset.animated.transparent-->
		
									<!-- - - - - - - - - - - - - - End of today's deals - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - Categories - - - - - - - - - - - - - - - - -->
						@endif
								<section class="section_offset animated transparent" data-animation="fadeInDown">
						
									<h3>Categories</h3>
								
					  
			
				
								@include('include.category')

						
								</section><!--/ .animated.transparent-->
						
								<!-- - - - - - - - - - - - - - End of categories - - - - - - - - - - - - - - - - -->
						
								<!-- - - - - - - - - - - - - - Banner - - - - - - - - - - - - - - - - -->
						
								<div class="section_offset animated transparent" data-animation="fadeInDown">
						<?php if(count($adModel) > 0){?>
									<a href="{{$adModel[2]->url}}">
										
									<img src="ads/{{$adModel[2]->ad_name}}" alt="">
						
									</a>
								<?php } ?>
								</div>
						
								<!-- - - - - - - - - - - - - - End of banner - - - - - - - - - - - - - - - - -->
						
							</aside><!--/ [col]-->

						<!-- - - - - - - - - - - - - - End of banners - - - - - - - - - - - - - - - - -->

						<!-- - - - - - - - - - - - - - Main slider - - - - - - - - - - - - - - - - -->

						<main class="col-md-9 col-sm-8">

							<div class="section_offset animated transparent" data-animation="fadeInDown">
							
								<!-- - - - - - - - - - - - - - Revolution slider - - - - - - - - - - - - - - - - -->

								<div class="revolution_slider">

									<div class="rev_slider">

										<ul>
											<?php if(isset($slider)){?>
											<!-- - - - - - - - - - - - - - Slide  - - - - - - - - - - - - - - - - -->
											@foreach($slider as $row)
											<li data-transition="papercut" data-slotamount="7">
												
												<img src="slider/{{$row->slider_image}}" alt="">

											<div style="color:<?php echo $row->title_color != null ?  $row->title_color : '' ?>" class="caption sfl stl <?php echo $row->slider_position == 'center' ? 'layer_3' : 'layer_1' ?> " data-x="{{$row->slider_position}}" data-hoffset="<?php echo $row->slider_position == 'right' ? '-60' : '60' ?>" data-y="<?php echo $row->title_y != null ?  $row->title_y : '90' ?>" data-easing="easeOutBack" data-speed="600" data-start="900"><?php echo $row->title?></div>

												<div style="color:<?php echo $row->sub_color != null ?  $row->sub_color : '' ?>" class="caption sfl stl <?php echo $row->slider_position == 'center' ? 'layer_6' : 'layer_2' ?>" data-x="{{$row->slider_position}}" data-y="<?php echo $row->sub_y != null ?  $row->sub_y : '138' ?>" data-hoffset="<?php echo $row->slider_position == 'right' ? '-60' : '60' ?>" data-easing="easeOutBack" data-speed="600" data-start="1000"><?php echo $row->sub_title?></div>

												<div style="color:<?php echo $row->desc_color != null ?  $row->desc_color : '' ?>" class="caption sfl stl layer_3" data-x="{{$row->slider_position}}" data-y="<?php echo $row->desc_y != null ?  $row->desc_y : '190' ?>" data-hoffset="<?php echo $row->slider_position == 'right' ? '-60' : '60' ?>" data-easing="easeOutBack" data-speed="600" data-start="1100"><?php echo $row->desc ?></div>

												<div style="color:<?php echo $row->button_color != null ?  $row->button_color : '' ?>" class="caption sfb stb" data-x="{{$row->slider_position}}" data-y="<?php echo $row->button_y != null ?  $row->button_y : '245' ?>" data-hoffset="<?php echo $row->slider_position == 'right' ? '-60' : '60' ?>" data-easing="easeOutBack" data-speed="700" data-start="1100">
													<a href="{{$row->button_url}}" class="button_blue big_btn">{{$row->button_text}}</a>
												</div>

											</li>
											@endforeach
										<?php } ?>
										</ul>

									</div><!--/ .rev_slider-->

								</div><!--/ .revolution_slider-->
								
								<!-- - - - - - - - - - - - - - End of Revolution slider - - - - - - - - - - - - - - - - -->

							</div><!--/ .section_offset -->

							<!-- - - - - - - - - - - - - - Banners - - - - - - - - - - - - - - - - -->

							<div class="section_offset">

								<div class="row">
									@if(count($adModel) > 0)
									<div class="col-sm-6">
										
										<a href="{{$adModel[0]->url}}" class="banner animated transparent" data-animation="fadeInDown">
										
											<img src="ads/{{$adModel[0]->ad_name}}" alt="">

										</a>

									</div><!--/ [col]-->

									<div class="col-sm-6">
										
										<a href="{{$adModel[1]->url}}" class="banner animated transparent" data-animation="fadeInDown" data-animation-delay="150">
										
											<img src="ads/{{$adModel[1]->ad_name}}" alt="">

										</a>

									</div><!--/ [col]-->
									@endif
								</div><!--/ .row-->

							</div><!--/ .section_offset-->

							<!-- - - - - - - - - - - - - - End of banners - - - - - - - - - - - - - - - - -->
							<?php echo $output ?>
						

						

						
						

							
						</main><!--/ [col]-->
                
						<!-- - - - - - - - - - - - - - End of main slider - - - - - - - - - - - - - - - - -->

					</div><!--/ .row-->
					<br>
					@if(count($brand_slider) >0)
					<section class="section_offset animated transparent" data-animation="fadeInDown">

								<h3 class="offset_title">Our Brands</h3>

								<!-- - - - - - - - - - - - - - Carousel of brands - - - - - - - - - - - - - - - - -->

								<div class="owl_carousel brands">
									@foreach($brand_slider as $brand)
									<!--Brand-->
									<a href="javascript:void(null)">
									<img src="brand_thumbnail/{{$brand->thumbnail}}" alt="">
									</a>
									<!--End brand-->

									@endforeach

								</div><!--/ .owl_carousel-->
								
								<!-- - - - - - - - - - - - - - End of carousel of brands - - - - - - - - - - - - - - - - -->

							</section><!--/ .section_offset.animated.transparent-->
							@endif
				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
			
            <!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->
			@endsection
			
			@section('extra-js')
			<script>
			$('.home_menu').addClass('current');

window.onscroll = function() {scrollFunction()};
function scrollFunction() {
  if (document.documentElement.scrollTop > 905 && document.documentElement.scrollTop < 2900) {
	$('#stricky-sideimg').addClass('fixedSideImage');
	  //console.log(document.documentElement.scrollTop)
    // document.getElementById("stricky-sideimg").style.fontSize = "30px";
  } else {
	 $('#stricky-sideimg').removeClass('fixedSideImage');
// 	  console.log(document.documentElement.scrollTop)
//    document.getElementById("stricky-sideimg").style.fontSize = "90px";
  }
}
			</script>
			@endsection