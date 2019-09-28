@extends('layout.app')
@section('content')

<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

	<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="/">Home</a></li>
						<li>Compare Products</li>

					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<h1>Compare Products</h1>
					@if(count($product)>0)
					<div class="table_wrap">
						
						<table class="table_type_1 compare">

							<tbody>

								<tr>
									
									<th class="row_title_col">Product Image</th>
									@foreach($product as $row)
									<td>
										
										<a href="#"><img src="/product_img/{{$row->product_image}}" alt=""></a>

									</td>
									@endforeach

								</tr>

								<tr>
									
									<th class="row_title_col">Product Name</th>
									@foreach($product as $row)
									<td>

										<a href="/product/{{$row->id}}">{{$row->product_name}}</a>

									</td>
									@endforeach
								</tr>

								


								<tr>
									
									<th>Finishes </th>
									@foreach($product as $row)
									@foreach($pg as $p_g)
									@if($row->id == $p_g->product_id)
									<td>{{$p_g->finishers}}</td>
									@endif
									@endforeach
									@endforeach
								</tr>
								<tr>
									
									<th>Coverage </th>
									@foreach($product as $row)
									@foreach($pg as $p_g)
									@if($row->id == $p_g->product_id)
									<td>{{$p_g->coverage}}</td>
									@endif
									@endforeach
									@endforeach
								</tr>
								<tr>
									
									<th>Drying Time</th>
									@foreach($product as $row)
									@foreach($pg as $p_g)
									@if($row->id == $p_g->product_id)
									<td>{{$p_g->drying}}</td>
									@endif
									@endforeach
									@endforeach
								</tr>
								<tr>
									
									<th>Coating </th>
									@foreach($product as $row)
									@foreach($pg as $p_g)
									@if($row->id == $p_g->product_id)
									<td>{{$p_g->coating}} </td>
									@endif
									@endforeach
									@endforeach
								</tr>

								<tr>
									
									<th>Available Litreage </th>
									@foreach($product as $row)
									
									<td>
									@foreach($pl as $p_l)
									@if($row->id == $p_l->product_id)
									
										{{$p_l->paint_lit}} 
										<?php echo $p_l->paint_lit == 500 ? "ml" :"lit" ?>
									
									@endif
									@endforeach
								</td>
									@endforeach
								</tr>


								<tr>
									
									<th class="row_title_col">Action</th>
									@foreach($product as $row)
									<td>

										<div class="buttons_row">
										
											<a href="/product/{{$row->id}}" class="button_blue middle_btn">See product Page</a>

											<a href="javascript:void(null)" onclick="addWishlist({{$row->id}})" class="button_dark_grey middle_btn def_icon_btn add_to_wishlist tooltip_container"><span class="tooltip top">Add to Wishlist</span></a>

											 <a href="/remove-compare/{{$row->id}}" class="button_dark_grey middle_btn icon_btn tooltip_container"><span class="tooltip top">Remove from Compare</span><i class="icon-cancel-2"></i></a>

										</div>

									</td>
									@endforeach

								</tr>

							</tbody>

						</table>

					</div>
					@else
					<br><h3 style="text-align:center;">Compare Product is Empty</h3>
					@endif


@if(isset($related))
<br>
<br>
<section class="section_offset">

    <h3 class="offset_title">Related Products</h3>

    <div class="owl_carousel related_products">


    @foreach($related as $r_product)
        <div class="product_item">


            <div class="image_wrap">
				@if($r_product->category == 1)
<img src="http://www.kagtech.net/KAGAPP/Partsupload/{{$r_product->product_image}}" alt="">
				@else
<img src="{{asset('/product_img').'/'.$r_product->product_image}}" alt="">
				@endif
				


                <div class="actions_wrap">

                    <div class="centered_buttons">

                        <a href="#" class="button_dark_grey quick_view" data-modal-url="/quick-view/{{$r_product->id}}">Quick View</a>

                        <!-- <a href="#" class="button_blue add_to_cart">Add to Cart</a> -->

                    </div>

                    <a href="javascript:void(null)" onclick="addWishlist({{$r_product->id}})" class="button_dark_grey def_icon_btn add_to_wishlist tooltip_container"><span class="tooltip right">Add to Wishlist</span></a>

                    <a href="/compare-product/{{$r_product->id}}" class="button_dark_grey def_icon_btn add_to_compare tooltip_container"><span class="tooltip left">Add to Compare</span></a>

                </div>

            </div>

            {{-- <div class="label_new">New</div> --}}


            <div class="description">

                <a href="/product/{{$r_product->id}}">{{$r_product->product_name}}</a>

                <div class="clearfix product_info">


                           
                    <p class="product_price alignleft"><b>₹{{$r_product->sales_price}}</b></p>

                </div>

            </div>


        </div>
    @endforeach
    </div><!--/ .owl_carousel -->

</section><!--/ .section_offset -->
@endif
				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
			
			<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->

@endsection
@section('extra-js')

@endsection