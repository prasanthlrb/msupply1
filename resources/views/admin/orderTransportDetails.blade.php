@extends('admin.app')
@section('extra-css')
<style>
    .hide_transport{
    display: none !important;
    }
    .mapboxgl-ctrl-geocoder.mapboxgl-ctrl {
        width: 100%;
        margin-bottom: 10px;
    }
    #map {height:250px ;width:100%; }
   
    </style>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.css' rel='stylesheet' />
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-draw/v1.0.0/mapbox-gl-draw.css' type='text/css'/>
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.css' type='text/css' />
@endsection
@section('section')
<div class="content-wrapper">
    <div class="content-body">     
          <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
         
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/order-transport">Order Transport</a>
                </li>
              
                <li class="breadcrumb-item active">Order Transport View
                </li>
              </ol>
            </div>
          </div>
        </div>
   
    </div>

          <div class="content-body">
            <section class="card">
              <div id="invoice-template" class="card-body">
                <!-- Invoice Company Details -->
                <div id="invoice-company-details" class="row">
                  <div class="col-md-6 col-sm-12 text-center text-md-left">
                    <div class="row">
                     
                      <div class="media-body">
                            <div class="col-md-4">
                            <div class="form-group">
                                    <label for="projectinput5">Transport Status</label>
                                    <select id="orderStatus" name="orderStatus" class="form-control">
                                      <option value="0" {{$order->status == 0 ?'selected':''}}>Booked</option>
                                      <option value="1" {{$order->status == 1 ?'selected':''}}>Delivery</option>
                                      <option value="2" {{$order->status == 2 ?'selected':''}}>Cancel</option>
                                    </select>
                                  </div>
                                  </div>
                                  <div class="col-md-4">
                                  <button type="button" class="btn btn-primary mr-1" id="orderStatusChangr">
                                        <i class="la la-check-circle"></i> Apply
                                      </button>
                      </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12 text-center text-md-right">
                    <h2>ORDER ID</h2>
                  <p class="pb-3"># {{$order->id}}</p>
                    <p>
                    <span class="text-muted">Order Date :</span> {{$order->created_at}}</p>
                    <p>
                        <span class="text-muted">Payment Type :</span> {{$order->payment_type == 1?"Cash on Delivery":"Online Payment"}}</p>
                      </div>
                </div>
                <!--/ Invoice Company Details -->
                <!-- Invoice Customer Details -->
                <div id="invoice-customer-details" class="row pt-2">
                
                  <div class="col-sm-4 text-center text-md-left">
                    <p class="text-muted">Shipping To</p>
                  </div>
                  <div class="col-sm-4 text-center text-md-left">
                    <p class="text-muted">Customer :</p>
                  </div>
                  <div class="col-sm-4 text-center text-md-left">
                    <p class="text-muted">Transport Vehicle :</p>
                  </div>
                 
                  <div class="col-md-4 col-sm-12 text-left text-md-left">
                    <ul class="px-0 list-unstyled">
                            <li class="text-bold-800">{{$shipping->first_name}} - {{$shipping->last_name}}</li>
                            <li>{{$shipping->email}}</li>
                            <li>{{$shipping->address}}</li>
                            <li>{{$shipping->city}} - {{$shipping->zip}}</li>
                            <li>{{$shipping->state}}, {{$shipping->country}}</li>
                            <li>Ph : {{$shipping->telephone}}</li>
                    </ul>
                  </div>
                  <div class="col-md-4 col-sm-12 text-left text-md-left">
                    <ul class="px-0 list-unstyled">
                    <li class="text-bold-800">{{$user->name}}</li>
                      <li>{{$user->phone}}</li>
                      <li>{{$user->email}}</li>
                      <li>{{$user->user_type}}</li>
                    </ul>
                  </div>
                  <div class="col-md-4 col-sm-12 text-left text-md-left">
                    {{-- <p class="lead"></p> --}}
                    <div class="row">
                      <div class="col-md-8">
                        <table class="table table-borderless table-sm">
                          <tr>
                             <?php $row = App\transport::find($order->transport_id); ?>
                              
                              <td><b>{{$row->vehicle_name}}</b></td>
                             
                              <img src="/transport/{{$row->vehicle_image}}" alt="" width="80%">
                              </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                  
                </div>
                <!--/ Invoice Customer Details -->
                <!-- Invoice Items Details -->
                <div id="invoice-items-details" class="pt-2">
                 
                  <div class="row">
                    <div class="col-md-7 col-sm-12 text-center text-md-left">
                      <p class="lead">Map Location:</p>
                      <div class="row">
                        <div class="col-md-8">
                            <div id="map"></div> 
                        </div>
                      </div>
                    </div>
                    <div class="col-md-5 col-sm-12">
                      <p class="lead">Transport Price</p>
                      <div class="table-responsive">
                        <table class="table">
                          <tbody>
                            <tr>
                                <td>Per Km</td>
                            <td class="text-right">₹ {{$order->price}}</td>
                              </tr>
                              <tr>
                                <td>Distance</td>
                                <td class="text-right">{{$order->distance}} Km</td>
                              </tr>
                              <tr>
                                <td>Other</td>
                                <td class="text-right">₹ {{$order->other}}</td>
                              </tr>
                              <tr>
                                <td class="text-bold-800">Total</td>
                                <td class="text-bold-800 text-right"> ₹ {{$order->total}}</td>
                              </tr>
                            <tr>
                              <td>Payment Type</td>
                              <td class="pink text-right">{{$order->payment_type == 1?"Cash on Delivery":"Online Payment"}}</td>
                            </tr>
                           
                          </tbody>
                        </table>
                      </div>
                      
                    </div>
                  </div>
                </div>
                <!-- Invoice Footer -->
                {{-- <div id="invoice-footer">
                  <div class="row">
                    <div class="col-md-7 col-sm-12">
                      <h6>Terms & Condition</h6>
                      <p>You know, being a test pilot isn't always the healthiest business
                        in the world. We predict too much for the next year and yet far
                        too little for the next 10.</p>
                    </div>
                    <div class="col-md-5 col-sm-12 text-center">
                      <button type="button" class="btn btn-info btn-lg my-1"><i class="la la-paper-plane-o"></i> Send Invoice</button>
                    </div>
                  </div>
                </div> --}}
                <!--/ Invoice Footer -->
              </div>
            </section>
          </div>
    </div>
  </div>


@endsection
@section('extra-js')
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.js'></script>
<script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js'></script>
<script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-draw/v1.0.0/mapbox-gl-draw.js'></script>
<script type="text/javascript">

//78.10098082241404,9.959194195481757;78.09465931140852,9.893505079270398
var saved_markers = '';
    var user_location = [{{$order->lat}},{{$order->lng}}];
    mapboxgl.accessToken = 'pk.eyJ1IjoiZmFraHJhd3kiLCJhIjoiY2pscWs4OTNrMmd5ZTNra21iZmRvdTFkOCJ9.15TZ2NtGk_AtUvLd27-8xA';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v9',
        center: user_location,
        zoom: 8
    });
    //  geocoder here
    var geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        // limit results to Australia
        //country: 'IN',
    });
   
$('#orderStatusChangr').click(function(){
    var orderStatus = $('#orderStatus').val();
    $.ajax({
            url:"/admin/order-Transport-item-action",
            method:"get",
            data:{id:"{{$order->id}}",status:orderStatus},
            success:function(data){
                toastr.success(data);

        
            }
        })
});
</script>

@endsection