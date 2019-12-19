@extends('layout.app')
@section('extra-css')
    <link rel="stylesheet" href="/js/fancybox/source/jquery.fancybox.css">
    <link rel="stylesheet" href="/js/fancybox/source/helpers/jquery.fancybox-thumbs.css">
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.css' rel='stylesheet' />
<link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-draw/v1.0.0/mapbox-gl-draw.css' type='text/css'/>
<link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.css' type='text/css' />
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
.mapboxgl-ctrl-geocoder.mapboxgl-ctrl {
    width: 100%;
    margin-bottom: 10px;
}
#map {height:350px ; }
@media screen and (max-width: 480px) {
    #map {
    height: 550px;
    width: 322px;
}
}
@media screen and (max-width: 360px) {
    #map {
    height: 350px;
    width: 252px;
}
}
.aterSubmitShow{
    display: none;
}
</style>
@endsection
@section('content')

			<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="index.html">Home</a></li>
						<li><a href="/category/7">Bricks</a></li>
					{{-- <li><a href="/category/{{$subCategoty->id}}">{{$subCategoty->category_name}}</a></li> --}}
	
						<li>{{$product1->product_name}}</li>
					<input type="hidden" id="product_id" value="{{$product1->id}}">
					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">

						<main class="col-md-12 col-sm-12">

							<!-- - - - - - - - - - - - - - Product images & description - - - - - - - - - - - - - - - - -->

							<section class="section_offset">

								<div class="clearfix">

									<!-- - - - - - - - - - - - - - Product image column - - - - - - - - - - - - - - - - -->

									<div class="single_product">

										<!-- - - - - - - - - - - - - - Image preview container - - - - - - - - - - - - - - - - -->

										<div class="image_preview_container">

										  <img id="img_zoom" data-zoom-image="{{asset('/product_img').'/'.$product1->product_image}}" src="{{asset('/product_img').'/'.$product1->product_image}}" alt="">

											<button class="button_grey_2 icon_btn middle_btn open_qv"><i class="icon-resize-full-6"></i></button>

										</div><!--/ .image_preview_container-->

										<!-- - - - - - - - - - - - - - End of image preview container - - - - - - - - - - - - - - - - -->

                                <div class="product_preview">

                                <div class="owl_carousel" id="thumbnails">
                                <a href="#" data-image="{{asset('/product_img').'/'.$product1->product_image}}" data-zoom-image="{{asset('/product_img').'/'.$product1->product_image}}">
                                    <img src="{{asset('/product_img').'/'.$product1->product_image}}" data-large-image="{{asset('/product_img').'/'.$product1->product_image}}" alt="">
                                </a>
                                @foreach($Upload as $upload1)
                                    @if(!empty($upload1))
                                    <a href="#" data-image="{{asset('/product_gallery').'/'.$upload1->filename}}" data-zoom-image="{{asset('/product_gallery').'/'.$upload1->filename}}">

                                        <img src="{{asset('/product_gallery').'/'.$upload1->resized_name}}" data-large-image="{{asset('/product_gallery').'/'.$upload1->filename}}" alt="">
                                    </a>

                                    @endif
                                @endforeach

                                </div><!--/ .owl-carousel-->


                            </div><!--/ .product_preview-->
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
                                        @if($product1->stock_quantity !="" && $product1->stock_quantity !=0)
                                            <td>Availability: </td>
                                            <td><span class="in_stock">in stock</span> {{$product1->stock_quantity}} item(s)</td>
                                        @else
                                            <td>Availability: </td>
                                            <td><span style="color:red;">Out of Stock</span></td>
                                        @endif

                                        </tr>
                                        

                                    </tbody>

                                </table>

                            </div>

                            <hr>
									<div class="aterSubmitShow" id="afterPickDistance">
                                        <p class="product_price">Rs : <b class="theme_color" id="fixedPrice"></b></p>
        @if(count($custom_qty) >0)
                                        <div class="row">
    <div class="col-md-3 col-sm-4 col-lg-4">
<div class="form-group">
  <label for="sel1">Select list:</label>
  <select class="form-control" id="custom_qty" style="height:35px">
    <option disabled selected>Select QTY</option>
    @foreach($custom_qty as $qtyData)
      <option value="{{$qtyData->customqty}}">{{$qtyData->customqty}}</option>
                                                @endforeach
  </select>
</div>

    </div>
</div>
  @endif
                                        <br><br>
                             
                                <div class="aterSubmitShow" id="afterpickQty">
                                    <p class="product_price">Total Rs : <b class="theme_color" id="fixedTotal"></b></p>
                                   
                                        <div class="buttons_row">
                                            <button class="button_blue middle_btn" onclick="buyIt()">Add to Cart</button>
                                        </div>
                                  
   
                                       </div>
                                </div>

                                        
<br>
                                        <!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->
                                        <div class="mapBox">
                                           <h3> Pick Your Shipping Location</h3>
                                           <br>
                                        <div class="theme_box">

									<div class="v_centered">
				<div class="col-xs-12">	
                    <div class="geocoder">
                        <div class="row">
                            <div class="col-md-6">
                                <div id="geocoder"></div>
                            </div>
                            <div class="col-md-6">
                                <button class="button_grey middle_btn">Submit</button>
                            </div>
                        </div>
                        </div>
                        <div id="map"></div> 						
										   </div>
									</div>

                                </div><!--/ .theme_box -->
                               </div>
									</div>

									<!-- - - - - - - - - - - - - - End of product description column - - - - - - - - - - - - - - - - -->
                                    
								</div>

							</section><!--/ .section_offset -->

							<!-- - - - - - - - - - - - - - End of product images & description - - - - - - - - - - - - - - - - -->
						

						</main><!--/ [col]-->

						

					</div><!--/ .row-->

				

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
			
			<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->

			<!-- - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->
@endsection
			
@section('extra-js')
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.js'></script>
<script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js'></script>
<script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-draw/v1.0.0/mapbox-gl-draw.js'></script>
<!-- Include Libs & Plugins
    ============================================ -->

<script>
  

//78.10098082241404,9.959194195481757;78.09465931140852,9.893505079270398
    var saved_markers = '';
    var user_location = ['{{$product1->lng}}','{{$product1->lat}}'];
    mapboxgl.accessToken = 'pk.eyJ1IjoiZmFraHJhd3kiLCJhIjoiY2pscWs4OTNrMmd5ZTNra21iZmRvdTFkOCJ9.15TZ2NtGk_AtUvLd27-8xA';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v9',
        center: user_location,
        zoom: 10
    });
    //  geocoder here
    var geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        // limit results to Australia
        //country: 'IN',
    });

    var marker ;

    // After the map style has loaded on the page, add a source layer and default
    // styling for a single point.
     map.on('load', function() {
      addMarker(user_location,'load');
        //add_markers(saved_markers);

        // Listen for the `result` event from the MapboxGeocoder that is triggered when a user
        // makes a selection and add a symbol that matches the result.
    //     geocoder.on('result', function(ev) {
    //         alert("aaaaa");
    //         console.log(ev.result.center);

    //     });
    });
    map.on('click', function (e) {
        marker.remove();
        addMarker(e.lngLat,'click');
        var current_loc ='{{$product1->lng}},{{$product1->lat}};';
        //var newCoords = current_loc + '78.09465931140852,9.893505079270398';
        // transportData.lat = e.lngLat.lat;
        // transportData.lng = e.lngLat.lng;

        var newCoords = current_loc + e.lngLat.lng+','+e.lngLat.lat;
        getMatch(newCoords);
    //    console.log(e.lngLat.lat+','+e.lngLat.lng);
        // document.getElementById("lat").value = e.lngLat.lat;
        // document.getElementById("lng").value = e.lngLat.lng;
    
    });

    function getMatch(e) {
        var url = 'https://api.mapbox.com/directions/v5/mapbox/cycling/' + e
            +'?geometries=geojson&steps=true&access_token=' + mapboxgl.accessToken;
        var req = new XMLHttpRequest();
        req.responseType = 'json';
        req.open('GET', url, true);
        req.onload  = function() {
            var jsonResponse = req.response;
            var distance = jsonResponse.routes[0].distance*0.001;
            var duration = jsonResponse.routes[0].duration/60;
            var steps = jsonResponse.routes[0].legs[0].steps;
            var coords = jsonResponse.routes[0].geometry;
          //  console.log(steps);
        // console.log(coords);
         //  console.log(distance);
          // console.log(duration);

            // get route directions on load map
            steps.forEach(function(step){
                //instructions.insertAdjacentHTML('beforeend', '<p>' + step.maneuver.instruction + '</p>');
            });
            // get distance and duration
           // instructions.insertAdjacentHTML('beforeend', '<p>' +  'Distance: ' + distance.toFixed(2) + ' km<br>Duration: ' + duration.toFixed(2) + ' minutes' + '</p>');
            // console.log('Distance: ' + distance.toFixed(2) + ' km<br>Duration: ' + duration.toFixed(2) + ' minutes');
           // transportData.distance = distance.toFixed(2);
            // $('.distance_price').text(distance.toFixed(2)+' km');
            getDistanceData(Math.ceil(distance))
            // var calculateRate = Math.round(transportData.price * distance.toFixed(2));
            // var subTotal = parseInt(calculateRate) + parseInt(transportData.other);
            // transportData.total = subTotal;
            // $('.total_tran_price').text('₹'+subTotal);
            // add the route to the map
            //addRoute(coords);
          //  console.log(coordinates);

        };
        req.send();
    }

    function addMarker(ltlng,event) {

        if(event === 'click'){
            user_location = ltlng;
        }
        marker = new mapboxgl.Marker({draggable: true,color:"#d02922"})
            .setLngLat(user_location)
            .addTo(map)
            .on('dragend', onDragEnd);
    }
    function add_markers(coordinates) {

        var geojson = (saved_markers == coordinates ? saved_markers : '');

        console.log(geojson);
        // add markers to map
        geojson.forEach(function (marker) {
            console.log(marker);
            // make a marker for each feature and add to the map
            new mapboxgl.Marker()
                .setLngLat(marker)
                .addTo(map);
        });

    }

    function onDragEnd() {
        var lngLat = marker.getLngLat();
        document.getElementById("lat").value = lngLat.lat;
        document.getElementById("lng").value = lngLat.lng;
        // console.log('lng: ' + lngLat.lng + '<br />lat: ' + lngLat.lat);
    }
    document.getElementById('geocoder').appendChild(geocoder.onAdd(map));
    var brick_price;
    var quantity;
    function getDistanceData(disc){
        var id = $('#product_id').val();
        $.ajax({
      url : '/bricks-price-predict/',
      type: "GET",
      data:{id:id,distance:disc},
      success: function(data)
      {
          if(data.status ==1){
                $('#afterPickDistance').removeClass('aterSubmitShow');
                $('#fixedPrice').text(data.data.price);
                brick_price=data.data.price;
          }else{
               $('#afterPickDistance').addClass('aterSubmitShow');
              toastr.error('Not Available in this Location','This Product is');
              brick_price=0;
          }
        
      }
 });
    }
    $('#custom_qty').on('change', function(){
        let qty = $(this).val();
        if(brick_price !=0){
            let total = parseFloat(brick_price) * parseInt(qty);
            $('.mapBox').addClass('aterSubmitShow');
            $('#afterpickQty').removeClass('aterSubmitShow');
            $('#fixedTotal').text(total);
            quantity = qty;
        }
      
    });

    function buyIt(){
        let product_id = $('#product_id').val();
        // console.log(parseFloat(brick_price));
        // console.log(parseInt(quantity));
        $.ajax({
				   url: '/hard-materials-to-cart',
				   headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
                   type: 'post',
                   dataType: 'json',
                   data: {
                    product_id: product_id,price:brick_price,quantity:quantity,
                   }, 
                   success: function (msg) {
                    //console.log(msg)
                    CartMenuUpdate();
                     toastr.success('Successfully Added');
                       //window.location.href = '/account/orders';
                   }
               });

    }
    
</script>
@endsection