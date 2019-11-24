@extends('layout.app')
@section('extra-css')
    <link rel="stylesheet" href="/js/fancybox/source/jquery.fancybox.css">
    <link rel="stylesheet" href="/js/fancybox/source/helpers/jquery.fancybox-thumbs.css">
<style>
p.productdesc{
	width:60%;
}
.single_product_description {
    position: relative;
    padding-top: 10px;
    overflow: hidden;
}
.hide-details{
	display: none;
}
.hideCalcField{
	display: none;
}
.border-len-bread{
	border: #b1abab solid 1px;
    padding: 10px;
}
.calculatoreBox {
    padding-top: 120px;
}
</style>
@endsection
@section('content')

			<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="index.html">Home</a></li>
						<li><a href="/category/1">Tiles</a></li>
					<li><a href="/category/{{$subCategoty->id}}">{{$subCategoty->category_name}}</a></li>
					@if(isset($second_sub_category->id))
					<li><a href="/category/{{$second_sub_category->id}}">{{$second_sub_category->category_name}}</a></li>
					@endif
					@if(isset($third_sub_category->id))
					<li><a href="/category/{{$third_sub_category->id}}">{{$third_sub_category->category_name}}</a></li>
						@endif
						<li>{{$product1->product_name}}</li>
					<input type="hidden" id="product_id" value="{{$product1->id}}">
					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">

						<main class="col-md-8 col-sm-7">

							<!-- - - - - - - - - - - - - - Product images & description - - - - - - - - - - - - - - - - -->

							<section class="section_offset">

								<div class="clearfix">

									<!-- - - - - - - - - - - - - - Product image column - - - - - - - - - - - - - - - - -->

									<div class="single_product">

										<!-- - - - - - - - - - - - - - Image preview container - - - - - - - - - - - - - - - - -->

										<div class="image_preview_container">

										<img id="img_zoom" data-zoom-image="http://www.kagtech.net/KAGAPP/Partsupload/{{$product1->product_image}}" src="http://www.kagtech.net/KAGAPP/Partsupload/{{$product1->product_image}}" alt="">

											<button class="button_grey_2 icon_btn middle_btn open_qv"><i class="icon-resize-full-6"></i></button>

										</div><!--/ .image_preview_container-->

										<!-- - - - - - - - - - - - - - End of image preview container - - - - - - - - - - - - - - - - -->


										<!-- - - - - - - - - - - - - - Share - - - - - - - - - - - - - - - - -->
										
										<div class="v_centered">

											<span class="title">Share this:</span>

											<div class="addthis_widget_container">
												<!-- AddThis Button BEGIN -->
												<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
												<a class="addthis_button_preferred_1"></a>
												<a class="addthis_button_preferred_2"></a>
												<a class="addthis_button_preferred_3"></a>
												<a class="addthis_button_preferred_4"></a>
												<a class="addthis_button_compact"></a>
												<a class="addthis_counter addthis_bubble_style"></a>
												</div>
												<!-- AddThis Button END -->
											</div>
											
										</div>
										
										<!-- - - - - - - - - - - - - - End of share - - - - - - - - - - - - - - - - -->

									</div>

									<!-- - - - - - - - - - - - - - End of product image column - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Product description column - - - - - - - - - - - - - - - - -->

									<div class="single_product_description">

									<h3 class="offset_title"><a href="#">{{$product1->product_name}}</a></h3>

									
 <div class="description_section">

                                <table class="product_info">

                                    <tbody>

                                        <!-- <tr>

                                            <td>Vendor: </td>


                                        </tr> -->

                                        <tr>
                                        @if($stock->stocks !="" && $stock->stocks  !=0)
                                            <td>Availability: </td>
                                            <td><span class="in_stock">in stock</span> {{$stock->stocks}} item(s)</td>
                                        @else
                                            <td>Availability: </td>
                                            <td><span style="color:red;">Out of Stock</span></td>
                                        @endif

										</tr>
										@if($brand->free_shipping !=null)
										<tr>
											<td>Free Delivery on order over : </td>
										<td><span class="in_stock"> <i class="fas fa-rupee-sign" style="margin-top:5px;font-size:10px"></i> {{$brand->free_shipping}}, {{$brand->brand}} Brand Product<span> </td>
										</tr>
										@endif
										
										@if($brand->delivery_from !=null)
										<tr>
											<td>Delivery By : </td>
										<td><span class="in_stock"><?php 
										$start = date('m-d', mktime(0, 0, 0, date('m'), date('d') + $brand->delivery_from, date('Y')));
										$parts = explode('-', $start);
										$month_name = date("M", mktime(0, 0, 0, $parts[0])); 
										
												if($brand->delivery_to !=null){
										$end = date('d', mktime(0, 0, 0, date('m'), date('d') + $brand->delivery_to, date('Y')));
										echo $month_name.' '.$parts[1].' - '.$end;
												}
										?><span> </td>
										</tr>
										@endif



										@if($product1->notes !=null)
										<tr>
											<td>Important Note : </td>
										<td> <span class="in_stock">{{$product1->notes}}</span></td>
										</tr>
										
										@elseif($brand->notes !=null)
										<tr>
											<td>Important Note : </td>
										<td> <span class="in_stock">{{$brand->notes}}</span></td>
										</tr>
										@endif

										<hr>
                                    </tbody>

                                </table>

                            </div>

                            <hr>
									

                                    <p class="product_price">Rs : <b class="theme_color">{{ceil($stock->sales_price)}} </b>/ Per Box</p>


								   <ul class="specifications">
									  <hr>
									  <h5>Product Details</h5>
									   <li>
														   <div class="row">
															   <div class="col-md-6 col-sm-6">
																   Brand 
															   </div>
															   <div class="col-md-6 col-sm-6">
																   
																: {{$brand->brand}}
															   </div>
														   </div>
														  </li>
                                                       <li>
														   <div class="row">
															   <div class="col-md-6 col-sm-6">
																   Size 
															   </div>
															   <div class="col-md-6 col-sm-6">
																: {{$product1->width}}
															   </div>
														   </div>
														  </li>
                                                       <li>
														   <div class="row">
															   <div class="col-md-6 col-sm-6">
																   Weight 
															   </div>
															   <div class="col-md-6 col-sm-6">
																: {{$product1->weight}}
															   </div>
														   </div>
														  </li>
                                                       <li>
														   <div class="row">
															   <div class="col-md-6 col-sm-6">
																   Total Coverage in Sqft 
															   </div>
															   <input type="hidden" id="sqft" value="{{$product1->length}}">
															   <div class="col-md-6 col-sm-6">
																: {{$product1->length}}
															   </div>
														   </div>
														  </li>
                                                       <li>
														   <div class="row">
															   <div class="col-md-6 col-sm-6">
																   No of Pieces 
															   </div>
															   <div class="col-md-6 col-sm-6">
																: {{$product1->items}}
																<input type="hidden" id="noitem" value=" {{$product1->items}}">
															   </div>
														   </div>
														  </li>
                                                       <li>
														   <div class="row">
															   <div class="col-md-6 col-sm-6">
																   Description 
															   </div>
															   <div class="col-md-6 col-sm-6">
																: {{$product1->product_description}}
															   </div>
														   </div>
														  </li>


                                                
                                                   </ul>
		

										<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->
							<br>
							<form id="tilesFormProduct" method="post">
							{{ csrf_field() }}
								<input type="hidden" name="product_name" id="product_name" value="{{$product1->product_name}}">
								<input type="hidden" name="product_id" id="product_id" value="{{$product1->id}}">
								<input type="hidden" name="stocks" id="stocks" value="{{$stock->stocks}}">
								<input type="hidden" name="sales_price" id="sales_price" value="{{$stock->sales_price}}">
					  <div class="description_section_2 v_centered">

                                <span class="title">Qty:</span>
                              

                                <div class="qty min clearfix">
                                    <button type="button"  class="theme_button" type="button" data-direction="minus">-</button>
                                    <input type="text" name="button_qty" id="button_qty" value="1">
                                    <button type="button"  class="theme_button" type="button" data-direction="plus">+</button>

                                </div>

							</div>
								<div class="buttons_row">

											<button type="button" onclick="tileAddtoCart()" class="button_blue middle_btn">Add to Cart</button>

											 <button type="button" onclick="addWishlist({{$product1->id}})"  class="button_dark_grey def_icon_btn middle_btn add_to_wishlist tooltip_container"><span class="tooltip top">Add to Wishlist</span></button>

                                				<a href="javascript:void(null)" onclick="addCompare({{$product1->id}})"><button type="button" class="button_dark_grey def_icon_btn middle_btn add_to_compare tooltip_container"><span class="tooltip top">Add to Compare</span></button></a>

										</div>
									</form>
										<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

									</div>

									<!-- - - - - - - - - - - - - - End of product description column - - - - - - - - - - - - - - - - -->

								</div>

							</section><!--/ .section_offset -->

							<!-- - - - - - - - - - - - - - End of product images & description - - - - - - - - - - - - - - - - -->
						

						</main><!--/ [col]-->

						<aside class="col-md-4 col-sm-5">

							<!-- - - - - - - - - - - - - - Seller Information - - - - - - - - - - - - - - - - -->

							<section class="section_offset">

								<h3> Calculate your required Tiles</h3>

								<div class="theme_box">
									<div class="row">
										<div class="col-md-6">
											 <button type="button" class="button_blue mini_btn" id="iknow">I Know Exact Area For Tiling </button>
										</div>
										<div class="col-md-6">
											 <button type="button" class="button_grey mini_btn" id="idontknow">I Don't Know Exact Area For Tiling </button>
										</div>
									</div>
									<br>
					<div class="iknow">
								<p class="seller_category">Enter the Specify Area(Sq.ft.)</p>
								<div class="v_centered">

									<div class="col-xs-12">
                                       
										<div class="row" style="padding-top:30px">
											<div class="col-md-6">
												<label for="input_2">Specify Area(Sq.ft.)</label>
													<div class="form_el">
														<input type="text" name="input_sqft" id="input_sqft">
													</div>
											</div>

										</div>

									</div>
								</div>
					</div>
						<div class="idontknow hideCalcField">
								<p class="seller_category">Enter the Length(ft) and Breadth(ft) of the area you want to Tile.</p>
								<div class="v_centered">

									<div class="col-xs-12">

										@if($product1->sub_category == 2)

                                       	 <div style="float:right">

                                            <button type="button" class="button_blue mini_btn" onclick="addOneMore1()">Add </button>
										</div>
										<div class="row" style="padding-top:30px">
											<div class="col-md-12 border-len-bread">
										<div class="col-md-12">
											<p>Wall</p>
											<div class="col-md-5">
												<label for="input_2">Length(ft)</label>
													<div class="form_el">
														<input type="text" name="wall_length" id="wall_length1">
													</div>
											</div>
											<div class="col-md-1">
												<p style="text-align:center;margin-top: 30px;">X</p>
											</div>
											<div class="col-md-5">
												<label for="input_2">Breadth(ft)</label>
													<div class="form_el">
														<input type="text" name="wall_breadth" id="wall_breadth1">
													</div>
											</div>
										 </div>

										<div class="col-md-12" style="padding-top:20px">
											<p>Door</p>
											<div class="col-md-5">
												<label for="input_2">Length(ft)</label>
													<div class="form_el">
														<input type="text" name="door_length" id="door_length1">
													</div>
											</div>
											<div class="col-md-1">
												<p style="text-align:center;margin-top: 30px;">X</p>
											</div>
											<div class="col-md-5">
												<label for="input_2">Breadth(ft)</label>
													<div class="form_el">
														<input type="text" name="door_breadth" id="door_breadth1">
													</div>
											</div>
										 </div>

										<div class="col-md-12" style="padding-top:20px">
											<p>Window</p>
											<div class="col-md-5">
												<label for="input_2">Length(ft)</label>
													<div class="form_el">
														<input type="text" name="window_length" id="window_length1">
													</div>
											</div>
											<div class="col-md-1">
												<p style="text-align:center;margin-top: 30px;">X</p>
											</div>
											<div class="col-md-5">
												<label for="input_2">Breadth(ft)</label>
													<div class="form_el">
														<input type="text" name="window_breadth" id="window_breadth1">
													</div>
											</div>
										</div>
										 </div>
										 
										 

										</div>
									
										@else
										 <div style="float:right">

                                            <button type="button" class="button_blue mini_btn" onclick="addOneMore()">Add </button>
										</div>
										


										<div class="row" style="padding-top:30px">

											<div class="col-md-4">
												<label for="input_2">Length(ft)</label>
													<div class="form_el">
														<input type="text" name="length[]" id="length1">
													</div>
											</div>
											<div class="col-md-1">
												<p style="text-align:center;margin-top: 30px;">X</p>
											</div>
											<div class="col-md-4">
												<label for="input_2">Breadth(ft)</label>
													<div class="form_el">
														<input type="text" name="breadth[]" id="breadth1">
													</div>
                                            </div>
                                         
										</div>
										@endif
										
										<div id="calboxPlace"></div>

									</div>
								</div>
										<br>
													
										
						</div>
						<br>
						<div class="after-calculatore" style="display:none">
														<div class="calculatoreBox">
															<ul class="specifications">
																	
													   
                                                       <li style="text-align: center;font-weight: 600">
														 
														   Tile Caculator Result:
														  </li>
                                                       <li>
														   <div class="row">
															   <div class="col-md-6">
																   Total Area 	 
															   </div>
															   <div class="col-md-6">
																:  <span id="total-area"></span>
															   </div>
														   </div>
														   
														  </li>
                                                       <li>
														   <div class="row">
															   <div class="col-md-6">
																   No of Boxes Required 
															   </div>
															   <div class="col-md-6">
																:  <span id="noofboxes"></span>
															   </div>
														   </div>

														  </li>
                                                       <li>
														   <div class="row">
															   <div class="col-md-6">
																   No of Tiles 
															   </div>
															   <div class="col-md-6">
																:  <span id="nooftiles"></span>
															   </div>
														   </div>

														  </li>
                                                     
														</ul>
													</div>
											</div>	
								</div><!--/ .theme_box -->

								
									
								<footer class="bottom_box" style="text-align:center">
									@if($subCategoty->id ==2)
									<a href="javascript:void(null)" class="button_grey middle_btn" id="calculate1">CALCULATE</a>
									@else
									<a href="javascript:void(null)" class="button_grey middle_btn" id="calculate">CALCULATE</a>
									@endif
								</footer>

							</section>

						</aside><!--/ [col]-->

					</div><!--/ .row-->

					<div class="row">
						@if(count($Upload) >0)
						<div class="more-detail-btn" style="margin-top:100px;margin-bottom:100px;text-align:center"> 
							<button class="button_blue middle_btn" style="position:absolute;right:40%" id="more-detail-btn">
								More Details About this Product
								
							</button>
							<img src="{{asset('/riva/riva0.png')}}" alt="" width="75%" style="max-height:100px;over-flow:hidden">
						</div> 

						<div style="text-align:center;margin-top:100px;margin-bottom:100px" class="more-tiles-details hide-details">
							@foreach($Upload as $gallery)
							<img src="{{asset("/product_gallery/$gallery->filename")}}" alt="" width="75%">
							@endforeach
						</div>
							
						@endif

							<!-- - - - - - - - - - - - - - Related products - - - - - - - - - - - - - - - - -->
							@if(count($relatedProducts) >0)
							<section class="section_offset">

								<h3 class="offset_title">Related Products</h3>

								<div class="owl_carousel related_products">

									@foreach($relatedProducts as $relate)
									<div class="product_item">

										<!-- - - - - - - - - - - - - - Thumbmnail - - - - - - - - - - - - - - - - -->

										<div class="image_wrap">

										<img src="http://www.kagtech.net/KAGAPP/Partsupload/{{$relate->product_image}}" alt="">

											<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

											<div class="actions_wrap">
												

												<div class="centered_buttons">

													<a href="#" class="button_dark_grey quick_view" data-modal-url="/quick-view-tiles/{{$relate->id}}">Quick View</a>

							

												</div><!--/ .centered_buttons -->

												<a href="javascript:void(null)" onclick="addWishlist({{$relate->id}})" class="button_dark_grey def_icon_btn add_to_wishlist tooltip_container"><span class="tooltip right">Add to Wishlist</span></a>

                    							<a href="javascript:void(null)" onclick="addCompare({{$relate->id}})" class="button_dark_grey def_icon_btn add_to_compare tooltip_container"><span class="tooltip left">Add to Compare</span></a>

											</div><!--/ .actions_wrap-->
											
											<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

										</div><!--/. image_wrap-->

										<!-- - - - - - - - - - - - - - End thumbmnail - - - - - - - - - - - - - - - - -->


										<!-- - - - - - - - - - - - - - Product title & price - - - - - - - - - - - - - - - - -->

										<div class="description">

										<a href="/product/{{$relate->id}}">{{$relate->product_name}}</a>

										

										</div>

										<!-- - - - - - - - - - - - - - End of product title & price - - - - - - - - - - - - - - - - -->

									</div><!--/ .product_item-->
									@endforeach
									
									
									
									<!-- - - - - - - - - - - - - - End product - - - - - - - - - - - - - - - - -->

								</div><!--/ .owl_carousel -->

							</section><!--/ .section_offset -->
							@endif
							<!-- - - - - - - - - - - - - - End of related products - - - - - - - - - - - - - - - - -->

					</div>

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
			
			<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->

			<!-- - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->
@endsection
			
@section('extra-js')

<!-- Include Libs & Plugins
    ============================================ -->
    <script src="/js/jquery.elevateZoom-3.0.8.min.js"></script>
    <script src="/js/fancybox/source/jquery.fancybox.pack.js"></script>
    <script src="/js/fancybox/source/helpers/jquery.fancybox-media.js"></script>
    <script src="/js/fancybox/source/helpers/jquery.fancybox-thumbs.js"></script>
    <script>
		var lit=0;
		var colors_id =0;
		var calculate_formula = 1;
function setLitre(lits){
lit = lits;
$('.litBtn').each(function(index){
	$(this).addClass("button_grey");
	$(this).removeClass("button_blue");
});
$('#lit'+lit).addClass("button_blue");
getPrice();
}

$('#more-detail-btn').on('click',function(){
	$('.more-detail-btn').addClass('hide-details');
	$('.more-tiles-details').removeClass('hide-details');
})

function addCart(id){
    var qty  = $('#button_qty').val();
    var haveAcolor = $('#haveAcolor').val()
    var optionAvailable = $('#optionAvailable').val();

    //Both Color and Option Available
    if(haveAcolor == '1' && optionAvailable){
        //get Form Data
        var formData = new FormData($('#optionForm')[0]);
        let inputColor = $('#inputColor').val();
        if(inputColor){
            try{
        formData.append('product_id',id);
        formData.append('colors',inputColor);
        formData.append('qty',qty);
    $.ajax({
    url : '/set-cart-item',
         type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "JSON",
    success: function(data)
    {
        console.log(data);
    },error: function (error) {
           console.log(error);
        }
    });
        }catch(err){
        console.log(err)
        }
        }else{
            getColorModal();
        }
        //only Have a Color Data
    }else if(haveAcolor == '1'){
        let inputColor = $('#inputColor').val();
        if(inputColor){
            $.ajax({
            url : '/set-cart-item',
            type: "GET",
            data: {color:inputColor,id:id,qty:qty},
    success: function(data)
    {
        console.log(data);
    },error: function (error) {
           console.log(error);
        }
    });
        }else{
            getColorModal();
        }
        //only have a option form Data
    }
    else if(optionAvailable){
         //get Data Form
        var formData = new FormData($('#optionForm')[0]);
        formData.append('product_id',id);
        formData.append('qty',qty);
        $.ajax({
        url : '/set-cart-item',
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
        console.log(data);
        },error: function (error) {
           console.log(error);
        }
        });
    }
    //both color and option not have
    else{

        setCart(id,qty);
    }


    }
    //end of function
      
    
		
        function checkOrderLimit(data){
            var button_qty = $('#button_qty').val();
            if(button_qty <= button_qty){

                toastr.error('is Maximum of '+data, 'Your Order Limit QTY');
                setTimeout(()=>{
                    $('#button_qty').val(data);
                },0)
            }
        }

		$('#calculate').on('click', function(){
				var totalSqft=0;
			if(calculate_formula == 1){
				totalSqft = $('#input_sqft').val();
			}else{
				
				for(let i=0; i < calBoxCollection.length; i++){
					let totSqft = parseInt($('#length'+calBoxCollection[i]).val() * $('#breadth'+calBoxCollection[i]).val());
					totalSqft +=totSqft;
				}
			}
			
			let sqft = $('#sqft').val();
			let noitem = $('#noitem').val();
			//if(breadth !='' && length != ''){
			let total = parseInt(totalSqft / sqft);
			let totalnoitem = parseInt(noitem) * total;
			$('.after-calculatore').css("display","block");
			$('#total-area').text(totalSqft)
			$('#noofboxes').text(Math.ceil(total))
			$('#nooftiles').text(Math.ceil(totalnoitem))
			// }else{
			// 	toastr.error("breadth and Length", "Field is required")
			// }
			
		});
		$('#calculate1').on('click', function(){
				var totalSqft=0;
			if(calculate_formula == 1){
				totalSqft = $('#input_sqft').val();
			}else{
				
				for(let i=0; i < calBoxCollection.length; i++){
					let totSqft = parseInt($('#wall_length'+calBoxCollection[i]).val() * $('#wall_breadth'+calBoxCollection[i]).val());
					let totSqft1 = parseInt($('#door_length'+calBoxCollection[i]).val() * $('#door_breadth'+calBoxCollection[i]).val());
					let totSqft2 = parseInt($('#window_length'+calBoxCollection[i]).val() * $('#window_breadth'+calBoxCollection[i]).val());
					let subTotalSqft = parseInt(totSqft) - parseInt(parseInt(totSqft1) + parseInt(totSqft2))
					totalSqft +=subTotalSqft;
				}
			}
			let sqft = $('#sqft').val();
			let noitem = $('#noitem').val();
			let total = parseInt(totalSqft / sqft);
			let totalnoitem = parseInt(noitem) * total;
			$('.after-calculatore').css("display","block");
			$('#total-area').text(totalSqft)
			$('#noofboxes').text(Math.ceil(total))
			$('#nooftiles').text(Math.ceil(totalnoitem))
		});
		function tileAddtoCart(){
			var formData = new FormData($('#tilesFormProduct')[0]);
			let stock = parseFloat($('#stocks').val());
			let qty =  parseFloat($('#button_qty').val());
			if(stock > qty){
        		$.ajax({
                url : '/tilesAddtoCart',
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {                
                    //$("#form")[0].reset();
					//console.log(data)
					CartMenuUpdate();
					toastr.success('Successfully Added');
			    },error: function (data) {
                toastr.error("Not Available");
                
              }
            });
			}else{
				 toastr.error(" Available Stock","Please Enter Less Rather than");
			}
		}
		$('#iknow').click(function(){
			$(this).addClass('button_blue');
			$('#idontknow').addClass('button_grey');
			$('#idontknow').removeClass('button_blue');
			$('.iknow').removeClass('hideCalcField');
			$('.idontknow').addClass('hideCalcField');
			calculate_formula =1;
		})
		$('#idontknow').click(function(){
			$(this).addClass('button_blue');
			$('#iknow').addClass('button_grey');
			$('#iknow').removeClass('button_blue');
			$('.idontknow').removeClass('hideCalcField');
			$('.iknow').addClass('hideCalcField');
			calculate_formula =2;
		});
		calBox =2;
		calBoxCollection =[1];
		function addOneMore(){
			let table = '<div class="row" style="padding-top:30px" id="calbox'+calBox+'"><div class="col-md-12">'+
						'<div class="col-md-4"><label for="input_2">Length(ft)</label>'+
						'<div class="form_el"><input type="text" name="length[]" id="length'+calBox+'">'+
						'</div></div><div class="col-md-1">'+
						'<p style="text-align:center;margin-top: 30px;">X</p>'+
						'</div><div class="col-md-4"><label for="input_2">Breadth(ft)</label>'+
						'<div class="form_el"><input type="text" name="breadth[]" id="breadth'+calBox+'">'+
						'</div></div><div class="col-md-2" style="margin-top:25px;margin-left: -12px;">'+
                        '<button type="button" class="button_blue mini_btn" onclick="removeCalBox('+calBox+')">Remove</button>'+
                        '</div></div></div>';
						calBoxCollection.push(calBox);
						calBox++;
			$('#calboxPlace').after(table);
		}
		function addOneMore1(){
			let table = '<div class="row" style="padding-top:30px" id="calbox'+calBox+'">'+
			'<button type="button" class="button_blue mini_btn" onclick="removeCalBox('+calBox+')">Remove</button>'+
						'<div class="col-md-12 border-len-bread">'+
						'<div class="col-md-12"><p>Wall</p>'+
						'<div class="col-md-5"><label for="input_2">Length(ft)</label>'+
						'<div class="form_el"><input type="text" name="wall_length" id="wall_length'+calBox+'">'+
						'</div></div><div class="col-md-1">'+
						'<p style="text-align:center;margin-top: 30px;">X</p>'+
						'</div><div class="col-md-5"><label for="input_2">Breadth(ft)</label>'+
						'<div class="form_el"><input type="text" name="wall_breadth" id="wall_breadth'+calBox+'">'+
						'</div></div><div class="col-md-2" style="margin-top:25px;margin-left: -12px;">'+
                        '</div></div>'+
						'<div class="col-md-12"><p>Door</p>'+
						'<div class="col-md-5"><label for="input_2">Length(ft)</label>'+
						'<div class="form_el"><input type="text" name="door_length" id="door_length'+calBox+'">'+
						'</div></div><div class="col-md-1">'+
						'<p style="text-align:center;margin-top: 30px;">X</p>'+
						'</div><div class="col-md-5"><label for="input_2">Breadth(ft)</label>'+
						'<div class="form_el"><input type="text" name="door_breadth" id="door_breadth'+calBox+'">'+
						'</div></div><div class="col-md-2" style="margin-top:25px;margin-left: -12px;">'+
                        '</div></div>'+
						'<div class="col-md-12"><p>Window</p>'+
						'<div class="col-md-5"><label for="input_2">Length(ft)</label>'+
						'<div class="form_el"><input type="text" name="window_length" id="window_length'+calBox+'">'+
						'</div></div><div class="col-md-1">'+
						'<p style="text-align:center;margin-top: 30px;">X</p>'+
						'</div><div class="col-md-5"><label for="input_2">Breadth(ft)</label>'+
						'<div class="form_el"><input type="text" name="window_breadth" id="window_breadth'+calBox+'">'+
						'</div></div><div class="col-md-2" style="margin-top:25px;margin-left: -12px;">'+
                        '</div></div>'+
						'</div></div>';
						calBoxCollection.push(calBox);
						calBox++;
			$('#calboxPlace').after(table);
		}

function removeCalBox(id){
if(confirm('Are you sure delete this row?'))
  {
    calBoxCollection = jQuery.grep(calBoxCollection, function(value) {
      return value != id;
    });
    $('#calbox'+id).remove();
  }	
		}
    </script>
@endsection