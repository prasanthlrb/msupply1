@extends('admin.app')
@section('extra-css')

@endsection
@section('section')
<div class="content-wrapper">
    <div class="content-body">     
          <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
         
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/order">Order</a>
                </li>
              
                <li class="breadcrumb-item active">Order View
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
                                    <label for="projectinput5">Order Status</label>
                                    <select id="orderStatus" name="orderStatus" class="form-control">
                                      <option value="0" {{$order->order_status == 0 ?'selected':''}}>Pending</option>
                                      <option value="1" {{$order->order_status == 1 ?'selected':''}}>processing</option>
                                      <option value="2" {{$order->order_status == 2 ?'selected':''}}>Shipping</option>
                                      <option value="3" {{$order->order_status == 3 ?'selected':''}}>Delivered</option>
                                      <option value="4" {{$order->order_status == 4 ?'selected':''}}>on-hold</option>
                                      <option value="5" {{$order->order_status == 5 ?'selected':''}}>Failed</option>
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
                    <p class="text-muted">Bill To</p>
                  </div>
                  <div class="col-sm-4 text-center text-md-left">
                    <p class="text-muted">Shipping To</p>
                  </div>
                  <div class="col-sm-4 text-center text-md-left">
                    <p class="text-muted">Customer :</p>
                  </div>
                  <div class="col-md-4 col-sm-12 text-center text-md-left">
                    <ul class="px-0 list-unstyled">
                    <li class="text-bold-800">{{$billing->first_name}} - {{$billing->last_name}}</li>
                      <li>{{$billing->email}}</li>
                      <li>{{$billing->address}}</li>
                      <li>{{$billing->city}} - {{$billing->zip}}</li>
                      <li>{{$billing->state}}, {{$billing->country}}</li>
                      <li>Ph : {{$billing->telephone}}</li>
                     
                    </ul>
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
                  
                </div>
                <!--/ Invoice Customer Details -->
                <!-- Invoice Items Details -->
                <div id="invoice-items-details" class="pt-2">
                  <div class="row">
                    <div class="table-responsive col-sm-12">
                      <table class="table">
                  
                         <?php echo $output; ?>
                       
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-7 col-sm-12 text-center text-md-left">

                    </div> 
                    <div class="col-md-5 col-sm-12">
                      <p class="lead">Calculate</p>
                      <div class="table-responsive">
                        <table class="table">
                          <tbody>
                            <?php echo $result; ?>
                            <tr>
                              <td>Payment Mode</td>
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

<script>
$('#orderStatusChangr').click(function(){
    var orderStatus = $('#orderStatus').val();
    $.ajax({
            url:"/admin/order-item-action",
            method:"get",
            data:{id:"{{$order->id}}",status:orderStatus},
            success:function(data){
                toastr.success(data);

        
            }
        })
})
</script>

@endsection