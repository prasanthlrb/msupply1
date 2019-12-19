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
tr td {
    width: 25%;
}
</style>



@endsection
@section('content')

			<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="index.html">Home</a></li>
						<li><a href="/category/21">Paint</a></li>
					<li><a href="/category/{{$subCategoty->id}}">{{$subCategoty->category_name}}</a></li>
	
						<li>{{$product1->product_name}}</li>
					
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

										<img id="img_zoom" data-zoom-image="/product_img/{{$product1->product_image}}" src="/product_img/{{$product1->product_image}}" alt="">

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
    @if($product1->regular_price != null && $product1->category != 7)

												<div class="label_offer percentage">
													<?php $v1 = $product1->regular_price - $product1->sales_price;
													$v2 = ceil($v1/$product1->regular_price*100); ?>
													<div>{{$v2}}%</div>OFF
		
												</div>
												@endif

									<div class="single_product_description">

									<h3 class="offset_title"><a href="#">{{$product1->product_name}}</a></h3>
									
									
										<hr>
										<div class="description_section v_centered">

							 <table class="product_info">

                                    <tbody>

                      
                                        	@if($brand->free_shipping !=null)
										<tr>
											<td>Free Delivery on order over : </td>
										<td><span class="in_stock"> <i class="fas fa-rupee-sign" style="margin-top:5px;font-size:10px"></i> {{$brand->free_shipping}}, <span> {{$brand->brand}} Brand Product</td>
										</tr>
										@endif
										@if($product1->delivery_from !=null)
										<tr>
											<td>Delivery By : </td>
										<td><span class="in_stock"><?php 
										$start = date('m-d', mktime(0, 0, 0, date('m'), date('d') + $product1->delivery_from, date('Y')));
										$parts = explode('-', $start);
										$month_name = date("M", mktime(0, 0, 0, $parts[0])); 
										
												if($product1->delivery_to !=null){
										$end = date('d', mktime(0, 0, 0, date('m'), date('d') + $product1->delivery_to, date('Y')));
										echo $month_name.' '.$parts[1].' - '.$end;
												}
										?><span> </td>
										</tr>

										@elseif($brand->delivery_from !=null)
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
                                    </tbody>

                                </table>

										</div>


										<hr>
								@if($product1->regular_price !="" || $product1->regular_price !=null)
                                    <p class="product_price"><s>₹{{$product1->regular_price}}</s> <b class="theme_color">₹{{$product1->sales_price}}</b>
                                      @if($product1->default_unit_type !=null || $product1->default_unit_type !="")
                                    / {{$product1->default_unit_type}}
                                    @endif
                                </p>
                                @elseif($product1->sales_price !="")
                                    <p class="product_price"><b class="theme_color">₹{{$product1->sales_price}}</b> 
                                    @if($product1->default_unit_type !=null || $product1->default_unit_type !="")
                                    / {{$product1->default_unit_type}}
                                    @endif
                                    </p>
                                @endif

										<p class="product_price"><b class="theme_color"></b></p>

											@if(count($liter) > 0)
											@if($liter[0]->price == null)
			<div class="buttons_row">
                <button type="button" class="button_blue middle_btn" onclick="getColorModal({{$product1->id}})" id="colorButtonModule"><i class="icon-sun"></i>Choose Colour</button>
		   </div>
		   @endif
		   @endif
				<br>
				@if($product1->sales_price == null)
			 <div class="row">



				 <div class="col-xs-12">
						@if(count($liter) > 0)

                            <label>Litreage:</label>

                            <div class="form_el">
									@foreach($liter as $lit)
									<a href="javascript:void(null)" class="button_grey mini_btn litBtn" onclick="setLitre({{$lit}})" id="lit{{$lit->paint_lit}}">{{$lit->paint_lit}} 
										@if($lit->paint_lit == '500')
										ML
										@elseif($lit->paint_lit == '250')
										
										ML
										@else
										Litre
										@endif
									
									</a>
                       
                                @endforeach
                            </div>

							@endif
                        </div>

					</div>

					<br>
					@endif
					    <form id="paintFormProduct" method="post">
							{{ csrf_field() }}
								<input type="hidden" name="product_name" id="product_name" value="{{$product1->product_name}}">
								<input type="hidden" name="product_id" id="product_id" value="{{$product1->id}}">
								<input type="hidden" name="sub_category_id" id="sub_category_id" value="{{$product1->sub_category}}">
					  <div class="description_section_2 v_centered">

                                <span class="title">Qty:</span>
                              

                                <div class="qty min clearfix">
                                    <button type="button"  class="theme_button" type="button" data-direction="minus">-</button>
                                    <input type="text" name="button_qty" id="button_qty" value="1">
                                    <button type="button"  class="theme_button" type="button" data-direction="plus">+</button>

                                </div>

                            </div>

										<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

										<div class="buttons_row">
											@if($product1->sales_price !="" || $product1->sales_price !=null)
											<button type="button" class="button_blue middle_btn" id="addToCardPaint" onclick="nonLitProduct({{$product1->sales_price}})">Add to Cart</button>
											@else
											
											<button type="button" class="button_blue middle_btn" id="addToCardPaint" disabled="true">Add to Cart</button>
											@endif
								<button type="button" onclick="addWishlist({{$product1->id}})"  class="button_dark_grey def_icon_btn middle_btn add_to_wishlist tooltip_container"><span class="tooltip top">Add to Wishlist</span></button>

                                <a href="javascript:void(null)" onclick="addCompare({{$product1->id}})"><button type="button" class="button_dark_grey def_icon_btn middle_btn add_to_compare tooltip_container"><span class="tooltip top">Add to Compare</span></button></a>

										</div>

										<!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->
					    </form>
									</div>

									<!-- - - - - - - - - - - - - - End of product description column - - - - - - - - - - - - - - - - -->

								</div>

							</section><!--/ .section_offset -->

							<!-- - - - - - - - - - - - - - End of product images & description - - - - - - - - - - - - - - - - -->

							<!-- - - - - - - - - - - - - - Tabs - - - - - - - - - - - - - - - - -->

							<div class="section_offset">

								<div class="tabs type_2">

									<!-- - - - - - - - - - - - - - Navigation of tabs - - - - - - - - - - - - - - - - -->

									<ul class="tabs_nav clearfix">

										<li><a href="#tab-1">Painting Guides</a></li>
										<li><a href="#tab-2">Product Features</a></li>
										<li><a href="#tab-3">Description</a></li>
							

									</ul>
									
									<!-- - - - - - - - - - - - - - End navigation of tabs - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Tabs container - - - - - - - - - - - - - - - - -->

									<div class="tab_containers_wrap">

										<!-- - - - - - - - - - - - - - Tab - - - - - - - - - - - - - - - - -->

									

										<!-- - - - - - - - - - - - - - End tab - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Tab - - - - - - - - - - - - - - - - -->

										<div id="tab-1" class="tab_container">

											<ul class="specifications">

											<li><span>Finishes:</span>{{$guide->finishers}}</li>
											<input type="hidden" id="coverage" value="{{$guide->coverage}}">
												<li><span>Coverage:</span>{{$guide->coverage}} Ft</li>
												<li><span>Drying Time:</span>{{$guide->drying}}</li>
												<li><span>Coats:</span>{{$guide->coating}} Coat</li>
										

											</ul>

										</div>

										<div id="tab-2" class="tab_container">

											<ul class="specifications">
												@foreach($feature as $row)
											<li>* {{$row->features}}</li>
												@endforeach

											</ul>

										</div>

											<div id="tab-3" class="tab_container">
												<div style="padding:20px;text-align:center">

													<img src="/description_image/{{$guide->description_image}}">
												</div>
											<p> @php
                                    echo $product1->product_description;
								@endphp
								
							</p>

										</div><!--/ #tab-1-->

										<!-- - - - - - - - - - - - - - End tab - - - - - - - - - - - - - - - - -->


									

										<!-- - - - - - - - - - - - - - End tab - - - - - - - - - - - - - - - - -->

									</div><!--/ .tab_containers_wrap -->

									<!-- - - - - - - - - - - - - - End of tabs containers - - - - - - - - - - - - - - - - -->

								</div><!--/ .tabs-->

							</div><!--/ .section_offset -->

							<!-- - - - - - - - - - - - - - End of tabs - - - - - - - - - - - - - - - - -->

							<!-- - - - - - - - - - - - - - Related products - - - - - - - - - - - - - - - - -->
							@if(count($relatedProducts) >0)
							<section class="section_offset">

								<h3 class="offset_title">Related Products</h3>

								<div class="owl_carousel related_products">

									@foreach($relatedProducts as $relate)
									<div class="product_item">

										<!-- - - - - - - - - - - - - - Thumbmnail - - - - - - - - - - - - - - - - -->

										<div class="image_wrap">

										<img src="/product_img/{{$relate->product_image}}" alt="">

											<!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

											<div class="actions_wrap">

												<div class="centered_buttons">

													<a href="#" class="button_dark_grey quick_view" data-modal-url="/quick-view/{{$relate->id}}">Quick View</a>

							

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

										                <div class="clearfix product_info">
														<p class="product_price alignleft"><b id="rep_pro{{$relate->id}}" class="set-not-available"></b></p>
														</div>

										</div>

										<!-- - - - - - - - - - - - - - End of product title & price - - - - - - - - - - - - - - - - -->

									</div><!--/ .product_item-->
									@endforeach
									
									<!-- - - - - - - - - - - - - - End product - - - - - - - - - - - - - - - - -->

								</div><!--/ .owl_carousel -->

							</section><!--/ .section_offset -->
							@endif
							<!-- - - - - - - - - - - - - - End of related products - - - - - - - - - - - - - - - - -->


						</main><!--/ [col]-->

						<aside class="col-md-4 col-sm-5">

							<!-- - - - - - - - - - - - - - Seller Information - - - - - - - - - - - - - - - - -->

							<section class="section_offset">

								<h3> Calculate your required paint</h3>

								<div class="theme_box">
										{{-- <div class="row">
										<div class="col-md-6">
											 <button type="button" class="button_blue mini_btn" id="iknow">I Know Exact Area For Painting </button>
										</div>
										<div class="col-md-6">
											 <button type="button" class="button_grey mini_btn" id="idontknow">I Don't Know Exact Area For Painting </button>
										</div>
									</div> --}}
								<p class="seller_category">Enter the height(ft) and length(ft) of the area you want to paint.</p>
									<br>
									<div class="v_centered">

									<div class="col-xs-12">

										<div class="row">
											<div class="col-md-5">
												<label for="input_2">Height(ft)</label>
													<div class="form_el">
														<input type="text" name="height" id="height">
													</div>
											</div>
											<div class="col-md-2">
												<p style="text-align:center;margin-top: 30px;">X</p>
											</div>
											<div class="col-md-5">
												<label for="input_2">Length(ft)</label>
													<div class="form_el">
														<input type="text" name="length" id="length">
													</div>
											</div>
										</div>
													

													<br>
													<div class="after-calculatore" style="display:none">

														<p style="text-align: center;font-weight: 600">You will need:</p>	
														<h3><span style="color: #ed4154;"><span id="cal-result"></span> Litre(s)</span> {{$product1->product_name}}</h3>		
														<p>
															*This is an estimation based on {{$guide->coating}} coats. Actual coverage will depend on the surface condition. More coats may be required if the colour change is strong.
														</p>

													</div>
										</div>

								

									</div>

								</div><!--/ .theme_box -->

								<footer class="bottom_box" style="text-align:center">
									
									<a href="javascript:void(null)" class="button_grey middle_btn" id="calculate">CALCULATE</a>

								</footer>

							</section>

						</aside><!--/ [col]-->

					</div><!--/ .row-->

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
		var paint_price=0;
		var code_name;
		function nonLitProduct(lits){
			paint_price = Math.ceil(lits);
			
		}
function setLitre(lits){
try{
lit = lits.paint_lit;
console.log(lits)
$('.litBtn').each(function(index){
	$(this).addClass("button_grey");
	$(this).removeClass("button_blue");
});
$('#lit'+lit).addClass("button_blue");
if(lits.price != null){
	paint_price = Math.ceil(lits.price);
$(".product_price .theme_color").text("Rs : "+ Math.ceil(lits.price));
$('#addToCardPaint').prop('disabled',false);
}else{

getPrice();
}
}
catch(error){
alert("Not Available")
}
}



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
        function getColorModal(id){
            $.arcticmodal({
                        url : '/get-color-modal/'+id
                    });
        }
        function getColors(data){
			$('.arcticmodal-close').trigger('click');
			$('#colorButtonModule').css('background-color',data.shade_code)
            $('#colorButtonModule').text(data.code_name)
			//console.log(data);
			colors_id = data.id;
			code_name = data.code_name;
			getPrice();
        }
		function getPrice(){
			try{
		$('.related_price_tag').remove();
			// console.log(lit)
			// console.log(colors_id)
if(lit !=0 && colors_id !=0){
	let product_id = $('#product_id').val();
	console.log(product_id)
	     $.ajax({
				url:'/selected-color',
                method:'GET',
				data:{product_id:product_id,lit:lit,colors_id:colors_id},
                success:function(result){
                    console.log(result);
                    //$('#inputColor').remove();
					if(result ==0){
                    $(".product_price .theme_color").text("Not Available");
					$('#addToCardPaint').prop('disabled',true);
					}else{
						//relatedProductPriceSet(product_id);
						paint_price = Math.ceil(result[0].price);
					console.log("related",result)
                    $(".product_price .theme_color").text("Rs : "+ Math.ceil(result[0].price));
					$('#addToCardPaint').prop('disabled',false);
					if(result[1].length >0){
						$('.set-not-available').each(function(){
							$('.set-not-available').html('<span class="related_price_tag"> Not Available</span>')
						})
						console.log(result[1])
					for(let i=0;i<result[1].length;i++){
						$('#rep_pro'+result[1][i].product_id).html('<span class="related_price_tag"><i class="fa fa-inr" aria-hidden="true"></i> '+Math.ceil(result[1][i].price)+'</span>')
					}
					}
					}
                    //$('#colorButtonModule').append('<input type="hidden" name="inputColor" id="inputColor" value="'+result.id+'">')
                }
            });
}
			}
			catch(err){
				alert("Not Available1")
			}
		}
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
			let height = $('#height').val();
			let length = $('#length').val();
			let coverage = $('#coverage').val();
			if(height !='' && length != ''){
			let total  = parseInt(height)* parseInt(length);
			let avg = total/parseInt(coverage);
			$('.after-calculatore').css("display","block");
			$('#cal-result').text(Math.ceil(avg))

			}else{
				toastr.error("Height and Length", "Field is required")
			}
			//alert(Math.ceil(avg));
		})
		$('#addToCardPaint').on('click', function(){
	
			var formData = new FormData($('#paintFormProduct')[0]);
			   formData.append("colors_id", colors_id);
			   formData.append("colors_code", code_name);
			   formData.append("lit", lit);
			   formData.append("paint_price", paint_price);
        		$.ajax({
                url : '/paintAddtoCart',
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
                    //  $('#category_model').modal('hide');
                    //  $('.zero-configuration').load(location.href+' .zero-configuration');
                    //  toastr.success('Group Store Successfully', 'Successfully Save');
                },error: function (data) {
                toastr.error(data);
                //toastr.error(data.responseJSON.errors.cat_name);
              }
            });
		})
		calculate_formula =1;
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
    </script>
@endsection