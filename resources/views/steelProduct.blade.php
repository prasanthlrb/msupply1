@extends('layout.app')
@section('extra-css')

    <!-- Theme CSS
    ============================================ -->
    <link rel="stylesheet" href="/js/fancybox/source/jquery.fancybox.css">
    <link rel="stylesheet" href="/js/fancybox/source/helpers/jquery.fancybox-thumbs.css">
<style>
/* .unit_price_label:hover{
    cursor: pointer;
    background: #ed4154;
    color: #fff;
}
.unit_price_label p:hover{
    color: #fff;
} */
.order_limit_class{
    color:#ed4154
}
.select_unit_type{
    background: #ed4154;
    color: #fff; 
}
.select_unit_type p{
    background: #ed4154;
    color: #fff; 
}
.buy_now_btn{
    padding-top:25px;
}
.calculator_btn{
        width: 25%;
    margin-top: -25px;
    margin-left: 50px;
}
input[type="radio"] + label,
		input[type="checkbox"] + label{
			position: relative;
			width: auto !important;
			margin:0 -20px 0 0 !important;
			padding-left: 32px;

			-webkit-user-select: none;
			 -khtml-user-select: none;
			   -moz-user-select: none;
			   		user-select: none;
		}

</style>
@endsection
@section('content')


<div class="secondary_page_wrapper">

    <div class="container">

        <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

        <ul class="breadcrumbs">

            <li><a href="/">Home</a></li>
        <li><a href="/category/14">{{$category->category_name}}</a></li>
            <li>{{$brands->brand}}</li>


        </ul>

        <!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

        <div class="row">

            <main class="col-md-12 col-sm-12">

                <!-- - - - - - - - - - - - - - Product images & description - - - - - - - - - - - - - - - - -->

                <section class="section_offset">

                    <div class="clearfix">

                        <!-- - - - - - - - - - - - - - Product image column - - - - - - - - - - - - - - - - -->

                        <div class="col-md-5">

                            <!-- - - - - - - - - - - - - - Image preview container - - - - - - - - - - - - - - - - -->

                            <div class="image_preview_container">
                              
                                    <img id="img_zoom" data-zoom-image="{{asset('/upload_brand').'/'.$brands->brand_image}}" src="{{asset('/upload_brand').'/'.$brands->brand_image}}" alt="">
                               
                                <!-- <button class="button_grey_2 icon_btn middle_btn open_qv"><i class="icon-resize-full-6"></i></button> -->

                            </div><!--/ .image_preview_container-->

                            <!-- - - - - - - - - - - - - - End of image preview container - - - - - - - - - - - - - - - - -->

                            <!-- - - - - - - - - - - - - - Prodcut thumbs carousel - - - - - - - - - - - - - - - - -->

                           

                            <!-- - - - - - - - - - - - - - End of prodcut thumbs carousel - - - - - - - - - - - - - - - - -->

                            <!-- - - - - - - - - - - - - - Share - - - - - - - - - - - - - - - - -->

                             <div class="v_centered">

                                <span class="title">Share this:</span>

                                <div class="addthis_widget_container">
                                    <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
                                    <a class="addthis_button_preferred_1"></a>
                                    <a class="addthis_button_preferred_2"></a>
                                    <a class="addthis_button_preferred_3"></a>
                                    <a class="addthis_button_preferred_4"></a>
                                    <a class="addthis_button_compact"></a>
                                    <a class="addthis_counter addthis_bubble_style"></a>
                                    </div>
                                </div>

                            </div>
                             <form id="steelFormProduct" method="post">
							{{ csrf_field() }}
                            <div class="buttons_row buy_now_btn">
                                <div id="total_price_place"></div>
                                <button type="button" id="steelAddtoCart" class="button_blue middle_btn">Buy Now</button>
                                @if($category->id == 14)
                                <a href="javascript:void(null)" data-modal-url="/calculator/steel/{{$brands->id}}">
                                    <img src="{{asset('/images/calculator.png')}}" alt="" class="calculator_btn">
                                    
                                </a>
                                @endif
                            </div>
                            <!-- - - - - - - - - - - - - - End of share - - - - - - - - - - - - - - - - -->

                        </div>
                    </form>

                        <!-- - - - - - - - - - - - - - End of product image column - - - - - - - - - - - - - - - - -->

                        <!-- - - - - - - - - - - - - - Product description column - - - - - - - - - - - - - - - - -->

                        <div class="single_product_description col-md-7">

                            <h3 class="offset_title"><a href="#">{{$brands->brand}}</a></h3>
                            <div class="description_section v_centered">

							 <table class="product_info">

                                    <tbody>

                      
                                        	@if($brands->free_shipping !=null)
										<tr>
											<td>Free Delivery on order over : </td>
										<td><span class="in_stock">  {{$brands->free_shipping}} KG on <span> {{$brands->brand}} Brand Product</td>
										</tr>
										@endif

                                    </tbody>

                                </table>

										</div>


                            <div class="table_wrap">

									<!-- - - - - - - - - - - - - - Table v1 - - - - - - - - - - - - - - - - -->

									<table class="table_type_1">

										<thead>

											<tr>
                                                <th>Product Name </th>
                                             @foreach($unit_title as $title)
                                            <th>Price in {{$title->unit_name}}</th>
                                           
                                                @endforeach
												<th>Qty</th>
												<th>Total</th>
											</tr>

										</thead>

										<tbody>
                                            @foreach($product as $key => $pro)
											<tr>
                                            <td data-title="Heading 1">{{$pro->product_name}}</td>
                                            @foreach($unit[$key]->sortBy('unit_name') as $data)
                                            <td class="unit_price_label unit_class{{$pro->id}}" onclick="setUnit({{$pro}},{{$data}})" id="unit_{{$data->id}}">
                                              
                                                <div class="form_el">

														<input type="radio" name="radio_{{$pro->id}}" id="radio_{{$data->id}}" style="margin: 0 -20px 0 0 !important;">
                                                        <label for="radio_{{$data->id}}"><p><small><i class="fas fa-rupee-sign" style="margin-top:5px"></i></small> {{$data->unit_price}} / {{$data->unit_name}} </p>
                                                        
                                                                
                                                            
                                                            <?php echo $data->unit_name == "Rods" ? "<p class='order_limit_class'>Per Rods (".$pro->weight." Kg) </p>" : '' ?>
                                                            <?php echo $data->unit_name == "Bundle" ? "<p class='order_limit_class'> of (".$pro->items.") items</p>" : '' ?>
                                                        
                                                        </label>

													</div>
                                            </td>
                                            @endforeach
												<td>
                                                <input type="number" onkeyup="qtyBox({{$pro->id}})" id="qtybox{{$pro->id}}">
                                                </td>
                                            <td id="total_price{{$pro->id}}">0</td>
											</tr>
                                            @endforeach
										

										</tbody>


									</table>

									<!-- - - - - - - - - - - - - - End of table v1 - - - - - - - - - - - - - - - - -->

								</div>
                        


               

                        </div>

                        <!-- - - - - - - - - - - - - - End of product description column - - - - - - - - - - - - - - - - -->

                    </div>

                </section><!--/ .section_offset -->

                <!-- - - - - - - - - - - - - - End of product images & description - - - - - - - - - - - - - - - - -->

          



                <!-- - - - - - - - - - - - - - End of related products - - - - - - - - - - - - - - - - -->


            </main><!--/ [col]-->

            {{-- <aside class="col-md-3 col-sm-4">



            </aside> --}}

        </div><!--/ .row-->

    </div><!--/ .container-->

</div><!--/ .page_wrapper-->

<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->


@endsection

@section('extra-js')

<!-- Include Libs & Plugins
    ============================================ -->
    <script src="/js/jquery.elevateZoom-3.0.8.min.js"></script>
    <script src="/js/fancybox/source/jquery.fancybox.pack.js"></script>
    <script src="/js/fancybox/source/helpers/jquery.fancybox-media.js"></script>
    <script src="/js/fancybox/source/helpers/jquery.fancybox-thumbs.js"></script>
    <script>
        var bulkItems = [];
        function setUnit(pro,data){
            // console.log(pro)
            // console.log(data)
            let ifAvailable =0;
            if(bulkItems.length > 0){
            for(let i =0;i<bulkItems.length;i++){
                if(bulkItems[i].product_id == pro.id){
                    bulkItems[i].unit_id = data.unit_id;
                    bulkItems[i].product_name = pro.product_name;
                    bulkItems[i].unit_price = data.unit_price;
                    bulkItems[i].unit_name = data.unit_name;
                    ifAvailable =1;
                }
            }
            if(ifAvailable == 0){
                let arrayData = {
                    product_id:data.product_id,
                    product_name:data.product_name,
                    unit_id:data.unit_id,
                    unit_name:data.unit_name,
                    unit_price:data.unit_price,
                    qty:''
                }
               
                 bulkItems.push(arrayData)
            }
            }else{
                let arrayData = {
                    product_id:data.product_id,
                    product_name:data.product_name,
                    unit_id:data.unit_id,
                    unit_name:data.unit_name,
                    unit_price:data.unit_price,
                    qty:''
                }
              
                 bulkItems.push(arrayData)
            }
            // $('.unit_class'+pro.id).each( function(){
            //     $('.unit_class'+pro.id).removeClass('select_unit_type');
            // });

          //  $('#unit_'+data.id).addClass('select_unit_type');
              qtyBox(pro.id)
        }
        function qtyBox(id){
            var qty = Math.ceil($('#qtybox'+id).val());
            var totalAmount=0;
             for(let i =0;i<bulkItems.length;i++){
              if(bulkItems[i].product_id == id){
                  bulkItems[i]['qty'] = qty;
                  let total = parseInt(bulkItems[i]['unit_price']) * parseInt(qty)
                  if(qty == ''){
                      total=0;
                  $('#total_price'+id).html('<p style="color:#ed4154">Rs : '+total+'</p>')
                  }else{
                  $('#total_price'+id).html('<p style="color:#ed4154">Rs : '+total+'</p>')

                  totalAmount = parseInt(totalAmount) + parseInt(total);
                  }
                  break;
              }else{
                  let dummytotal = bulkItems[i]['unit_price'] * bulkItems[i]['qty'];
                  totalAmount = parseInt(totalAmount) + parseInt(dummytotal);
              }

             }
              $('#total_price_place').html('<h3 style="color:#ed4154">Rs : '+totalAmount+'</h3>')
            // console.log(id)
             //console.log(bulkItems)
        }

        function noofkg(data){
            let kg = $('#noofkg'+data.id).val();
            $('#noofrods'+data.id).val('');
            $('#noofbundle'+data.id).val('');
            let rods = Math.ceil(kg / data.weight);
            $('#noofrods'+data.id).val(rods);
            let bundle = Math.ceil(rods / data.items);
            $('#noofbundle'+data.id).val(bundle);
        }

        function noofrods(data){
            let rods = $('#noofrods'+data.id).val();
            $('#noofkg'+data.id).val('');
            $('#noofbundle'+data.id).val('');
            let kg = Math.ceil(rods * data.weight);
            $('#noofkg'+data.id).val(kg);
            let bundle = Math.ceil(rods / data.items);
            $('#noofbundle'+data.id).val(bundle);
        }
        function noofbundle(data){
            let bundle = $('#noofbundle'+data.id).val();
            $('#noofkg'+data.id).val('');
            $('#noofrods'+data.id).val('');
             let rods = Math.ceil(bundle * data.items);
            $('#noofrods'+data.id).val(rods);
            let kg = Math.ceil(rods * data.weight);
            $('#noofkg'+data.id).val(kg);
        }
            $('#steelAddtoCart').on('click', function(){
                 bulkItems = jQuery.grep(bulkItems, function(value) {
      return value.qty != '';
    });
              if(bulkItems.length > 0){
                  let _token = $('input[name=_token]');
            //    // var formData = new FormData($('#steelFormProduct')[0]);
			//    bulkItems.push("_token", _token);
        		$.ajax({
                url : '/steelAddtoCart',
                type: "GET",
                data: {data:bulkItems},
                dataType: "JSON",
                success: function(data)
                {                
                    //$("#form")[0].reset();
					//console.log(data)
					CartMenuUpdate();
                    //  $('#category_model').modal('hide');
                    //  $('.zero-configuration').load(location.href+' .zero-configuration');
                    //  toastr.success('Group Store Successfully', 'Successfully Save');
                },error: function (data) {
                toastr.error(data);
                //toastr.error(data.responseJSON.errors.cat_name);
              }
            });
              }
            })

    </script>
@endsection
