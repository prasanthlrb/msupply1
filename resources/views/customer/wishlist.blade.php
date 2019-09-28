@extends('layout.app')
@section('content')
			<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

			<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="index.html">Home</a></li>
						<li>Wishlist</li>

					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">
						@include('include.accountSidebar')

						<main class="col-md-9 col-sm-8">

							<h1>Wishlist</h1>

							<header class="top_box on_the_sides">

								<!-- <div class="left_side v_centered">

									<p class="visible_pages">Showing 1 to 10 of 30 (3 pages)</p>

									<span>Show:</span> 

									<div class="custom_select">

										<select name="">

											<option value="10">10</option>
											<option value="9">9</option>
											<option value="8">8</option>
											<option value="7">7</option>
											<option value="6">6</option>
											<option value="5">5</option>
											<option value="4">4</option>
											<option value="3">3</option>
											<option value="2">2</option>
											<option value="1">1</option>

										</select>

									</div>

								</div> -->

								<div class="right_side">
								
@if ($product->lastPage() > 1)
<ul class="pags">
    <li class="{{ ($product->currentPage() == 1) ? ' disabled' : '' }}">
        <a href="{{ $product->url(1) }}">Previous</a>
    </li>
    @for ($i = 1; $i <= $product->lastPage(); $i++)
        <li class="{{ ($product->currentPage() == $i) ? ' active' : '' }}">
            <a href="{{ $product->url($i) }}">{{ $i }}</a>
        </li>
    @endfor
    <li class="{{ ($product->currentPage() == $product->lastPage()) ? ' disabled' : '' }}">
        <a href="{{ $product->url($product->currentPage()+1) }}" >Next</a>
    </li>
</ul>
@endif

								</div>

							</header><!--/ .top_box -->

							<div class="table_wrap">

								<table class="table_type_1 wishlist_table">
									 	
									<thead>
										
										<tr>
											
											<th class="product_image_col">Product Image</th>
											<th class="product_title_col">Product Name and Category</th>
											<th class="product_price_col">Price</th>
											<!-- <th class="product_qty_col">Quantity</th> -->
											<th>Action</th>

										</tr>

									</thead>

									<tbody>
									@if($product->count() > 0)
									@foreach($product as $product1)
										<tr>

											<!-- - - - - - - - - - - - - - Product image - - - - - - - - - - - - - - - - -->
											
											<td data-title="Product Image">
												
												
										@if($product1->category == 1)
	                                        <img src="http://www.kagtech.net/KAGAPP/Partsupload/{{$product1->product_image}}" alt="">
											@else
												<img src="{{asset('/product_img').'/'.$product1->product_image}}" alt="">
											@endif

											</td>

											<!-- - - - - - - - - - - - - - End of product image - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Product name & category - - - - - - - - - - - - - - - - -->

											<td data-title="Product Name and Category">
												<a href="/product-view/{{$product1->product_id}}" class="product_title">{{$product1->product_name}}</a>
												<!-- <a href="#">Beauty Clearance</a> -->
											</td>
											@if($product1->category != 7)
											<td data-title="Price" class="total">{{$product1->sales_price}}</td>
											@else
											<td></td>
											@endif
										<form method="post" id="termsData">
											{{csrf_field()}}
											<!-- <td data-title="Quantity">
												<div class="qty min clearfix">
													<button type="button" class="theme_button" data-direction="minus">&#45;</button>
													<input type="text" name="button_qty" value="1">
													<button type="button" class="theme_button" data-direction="plus">&#43;</button>
												</div>
											</td> -->
											<input type="hidden" name="button_qty" value="1">
											<td data-title="Action">
												<ul class="buttons_col">
													<li>
															<a href="/product/{{$product1->id}}" class="button_blue">See Product Details</a>
					
													</li>
													<li>
														<a href="javascript:void(null)" onclick="removewish({{$product1->id}})" class="button_dark_grey">Remove</a>
													</li>
												</ul>
											</td>
										</form>
										</tr>
									@endforeach
									@else
									<tr>
									<td style="text-align:center;" colspan="3"><h2>Your Wishlist is Empty</h2></td>
									</tr>
									@endif
									</tbody>

								</table>

							</div><!--/ .table_wrap -->

							<footer class="bottom_box on_the_sides">

								<!-- <div class="left_side v_centered">

									<p class="visible_pages">Showing 1 to 10 of 30 (3 pages)</p>

									<span>Show:</span> 

									<div class="custom_select">

										<select name="">

											<option value="10">10</option>
											<option value="9">9</option>
											<option value="8">8</option>
											<option value="7">7</option>
											<option value="6">6</option>
											<option value="5">5</option>
											<option value="4">4</option>
											<option value="3">3</option>
											<option value="2">2</option>
											<option value="1">1</option>

										</select>

									</div>

								</div> -->
								
								<div class="right_side">

@if ($product->lastPage() > 1)
<ul class="pags">
    <li class="{{ ($product->currentPage() == 1) ? ' disabled' : '' }}">
        <a href="{{ $product->url(1) }}">Previous</a>
    </li>
    @for ($i = 1; $i <= $product->lastPage(); $i++)
        <li class="{{ ($product->currentPage() == $i) ? ' active' : '' }}">
            <a href="{{ $product->url($i) }}">{{ $i }}</a>
        </li>
    @endfor
    <li class="{{ ($product->currentPage() == $product->lastPage()) ? ' disabled' : '' }}">
        <a href="{{ $product->url($product->currentPage()+1) }}" >Next</a>
    </li>
</ul>
@endif

								</div>

							</footer><!--/ .bottom_box -->

						</main><!--/ [col]-->

					</div><!--/ .row-->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
			
            <!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->
            
			@endsection
			@section('extra-js')
<script>
	$('.accWishlist').addClass('current');
	
function removewish(id){
    var r = confirm("Are you sure");
    if (r == true) {
    $.ajax({
        url : '/removewish/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          //toastr.success('Wishlist Delete Successfully', 'Successfully Delete');
		  //$('.table').load(location.href+' .table');
		  location.reload();
        }
      });
    } 
}

</script>
@endsection