<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/selects/select2.min.css">
<div id="quick_view" class="modal_window">
        <button class="close arcticmodal-close" id="close_button"></button>
        <div class="clearfix">
        <div class="row">
            <div class="col-sm-6 col-md-6">


                    <div class="geocoder">
                            <div id="geocoder" ></div>
                        </div>
                        <div id="map"></div>   
            </div>

            <div class="col-sm-6 col-md-6">
   
          <div class="single_product_description">
          <!-- <a href="">If you know About Shipping Location, <span style="weight:700;color:#ff4557">please click to Skip.</span></a>   -->
   
           <div class="theme_box">
   
            <p class="form_caption">Select Shipping Cart item.</p>
   
               <form id="estimate_shipping" class="type_2">
   
                   <ul>
                        <li class="form-group row">
                              
                                <div class="col-md-12">
                                  <select style="width:100%" name="cartItem[]" id="cartItem" class="select2 form-control col-md-12" multiple="multiple" placeholder="search for Category">
                                 
                                  <optgroup label="Shopping Cart Item" id="cart-item">

                                    </optgroup>
                                
                                  
                                  </select>
                                </div>
</li>
    <br>
   
                       <li class="row">
                           
                           <div class="col-xs-12">
   
                              <p>Per Km Rate (<span class="perKmpl"></span>) X Distance (<span class="distance_price"></span>)</p>
                                <p>Other <span class="other_rate"></span></p>
                                <h2>Total Transport Price: <span class="total_tran_price"></span></h2>
                           </div>
   
                       </li>
   
                    
   
                   </ul>
   
               </form>
   
           </div><!--/ .theme_box -->
   
           <footer class="bottom_box">
   
               <button type="button" class="button_grey middle_btn" id="otherVehicle">Other Vehicle</button>
               <button type="button" class="button_grey middle_btn" id="gotoShipping">Go to Shipping</button>
   
           </footer>
   
          </div>
          </div>
          </div>    
    </div>
    
    </div>
    <script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
    <script src="../../../app-assets/js/scripts/forms/select/form-select2.js" type="text/javascript"></script>
<script>
    
$(document).ready(function(){
    $.ajax({        
        url : '/cart-item',
        type: "GET",
        success: function(data)
        {
            var x =0;
            // console.log(data);
            //$('#cart-item').html(data);
            var card_data = '';
            $.each( data, function( key, value ) {
                if(jQuery.inArray(value.id, transportDataFinal.cart_item) !== -1){

                }else{
                    card_data += '<option value="'+value.id+'">'+value.name+' </option>';
                }
                
                x++;
            });
            cardItemCount = x;
            $('#cart-item').html(card_data);
        }
    });
    $.ajax({        
        url : '/get-transport-data/'+perKm,
        type: "GET",
        success: function(data)
        {
            transportData.transport_id =perKm;
            transportData.price =data.price;
            transportData.other =data.other;
            $('.perKmpl').text('₹'+data.price)
            $('.other_rate').text('₹'+data.other)
        }
    });
});

//78.10098082241404,9.959194195481757;78.09465931140852,9.893505079270398
    var saved_markers = '';
    var user_location = [78.10098082241404,9.959194195481757];
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
        var current_loc ='78.10098082241404,9.959194195481757;';
        //var newCoords = current_loc + '78.09465931140852,9.893505079270398';
        transportData.lat = e.lngLat.lat;
        transportData.lng = e.lngLat.lng;

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
            transportData.distance = distance.toFixed(2);
            $('.distance_price').text(distance.toFixed(2)+' km');
            var calculateRate = Math.round(transportData.price * distance.toFixed(2));
            var subTotal = parseInt(calculateRate) + parseInt(transportData.other);
            transportData.total = subTotal;
            $('.total_tran_price').text('₹'+subTotal);
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

    $('#gotoShipping').click(function(){
        var cartItem  = $('#cartItem').val();
        if(cartItem != null){
            $.each( cartItem, function( key, value ) {
                transportDataFinal.cart_item.push(value);
            });
            transportData.cart_item = cartItem;
            var dataFinal ={
            'selected_id':transportData.transport_id,
            'selected_data':transportData
            };
            // console.log(transportData);
            transportDataFinal.data.push(dataFinal);
            //transportSuccess(transportData.transport_id);
            goToCheckOut();
            $('#close_button').trigger('click');
        }else{
            alert("Please Select Shipping Cart Item");
        }
        //$('#close_button').trigger('click');
    });

    $('#otherVehicle').click(function(){
        var cartItem  = $('#cartItem').val();
        if(cartItem != null){
            $.each( cartItem, function( key, value ) {
                transportDataFinal.cart_item.push(value);
            });
            transportData.cart_item = cartItem;
            var dataFinal ={
            'selected_id':transportData.transport_id,
            'selected_data':transportData
            };
            // console.log(transportData);
            transportDataFinal.data.push(dataFinal);
            transportSuccess(transportData.transport_id);
            $('#close_button').trigger('click');
        }else{
            alert("Please Select Shipping Cart Item");
        }
        //$('#close_button').trigger('click');
    });

</script>
