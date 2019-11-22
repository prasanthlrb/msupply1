@extends('layout.app')
@section('extra-css')
<style>
</style>
@section('content')

<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

<div class="secondary_page_wrapper">

    <div class="container">

        <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

        <ul class="breadcrumbs">

            <li><a href="index.html">Home</a></li>
            <li><a href="/account/orders">Orders</a></li>
            <li>manage address</li>

        </ul>

        <!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

        <div class="row">

            @include('include.accountSidebar')
            <main class="col-md-9 col-sm-8">
              
                    <h1>Order #{{$order->id}} - Status :
                            @if($order->order_status == 0)
                            Pending
                            @elseif($order->order_status == 1)
                        
                            Processing
                            @elseif($order->order_status == 2)
                            Shipping
                            @elseif($order->order_status == 3)
                            Delivered
                            @elseif($order->order_status == 4)
                            on-hold
                            @elseif($order->order_status == 5)
                            Cancel
                            @endif</h1>

                    <!-- - - - - - - - - - - - - - Order table - - - - - - - - - - - - - - - - -->

                    <div class="section_offset">
                            <div class="row">

                                    <div class="col-md-6">
                    <header class="top_box">

                            <div class="buttons_row">
                                @if($order->order_status == 0 OR $order->order_status == 1)
                                <a href="/account/order-cancel/{{$order->id}}" class="button_grey middle_btn">Cancel Order</a>
                                @endif
                                @if($order->order_status == 3)
                                <a href="/account/order-print/{{$order->id}}" class="button_grey middle_btn" target="_blank">Print Order</a>
                                @endif
                            </div>

                        </header>

                        <div class="table_wrap">

                            <table class="table_type_1 order_table">

                                <tbody>
                                    <tr>
                                        <th>Order ID</th>

                                        <td><a href="#">{{$order->id}}</a></td>
                                    </tr>
                                    <tr>
                                        <th>Order Date</th>
                                        <td>{{date('Y-m-d', strtotime($order->created_at))}}</td>
                                    </tr>

                                    <tr>
                                        <th>Order Status</th>
                                        <td>@if($order->order_status == 0)
                                                Pending
                                                @elseif($order->order_status == 1)
                                            
                                                Processing
                                                @elseif($order->order_status == 2)
                                                Shipping
                                                @elseif($order->order_status == 3)
                                                Delivered
                                                @elseif($order->order_status == 4)
                                                on-hold
                                                @elseif($order->order_status == 5)
                                                Failed
                                                @endif</td>
                                    </tr>

                                    <!-- <tr>
                                        <th>Shipment</th>
                                        <td>United Parcel Service - Worldwide Expedited</td>
                                    </tr> -->

                                    <tr>
                                        
                                        <th>Payment</th>

                                        <td>@if($order->payment_type == '1')
                                                Cash On Delivery
                                                @else
                                                Online Payment
												@endif</td>

                                    </tr>
                                    <tr>
                                        
                                        <th>Delivery Date</th>

                                    <td>{{$order->delivery_info}}</td>
                                            

                                    </tr>
                                    <tr>
                                        
                                        <th>Construction Site</th>

                                    <td>{{$project->project_name}}</td>
                                            

                                    </tr>

                                    <tr>

                                        <th>Total</th>

                                        <td class="total">₹ {{$order->total_amount}}</td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>
                                    </div>
                                    <div class="col-md-6">
                                            <section>
                                                @if(!empty($product))
                                                @if($product->review == 'on' && $order->order_status == 3)
                                                <input type="hidden" name="item_id" id="item_id" value="{{$product->id}}">
                                                    <h3>Review & Ratings</h3>
                                                    @if(empty($rating))
                                                    <ul class="rating alignleft">
                                                         <li id="rating_1" class="rating_" value="1"></li>
                                                        <li id="rating_2" class="rating_" value="2"></li>
                                                        <li id="rating_3" class="rating_" value="3"></li>
                                                        <li id="rating_4" class="rating_" value="4"></li>
                                                        <li id="rating_5" class="rating_" value="5"></li>
                                                    </ul>
                                                    <br>
                                                    <textarea id="reviews" name="review" rows="6"></textarea>
                                                    <br>
                                                    <div class="right_side">
    
                                                        <button type="button" id="reviewSubmit" class="button_blue middle_btn">Submit</button>
                        
                                                    </div>
                                                    @else
                                                    <input type="hidden" name="review_old" id="review_old" value="{{$review->id}}">
                                                    <input type="hidden" name="rating_old" id="rating_old" value="{{$rating->id}}">
                                                    <ul class="rating alignleft">
                                                            <li id="rating_1" class="rating_ active" value="1"></li>
                                                           <li id="rating_2" class="rating_ <?php echo $rating->rating >= 2 ? 'active' : '' ?>" value="2"></li>
                                                           <li id="rating_3" class="rating_ <?php echo $rating->rating >= 3 ? 'active' : '' ?>" value="3"></li>
                                                           <li id="rating_4" class="rating_ <?php echo $rating->rating >= 4 ? 'active' : '' ?>" value="4"></li>
                                                           <li id="rating_5" class="rating_ <?php echo $rating->rating >= 5 ? 'active' : '' ?>" value="5"></li>
                                                       </ul>
                                                       <br>
                                                    <textarea id="reviews" name="review" rows="6">{{$review->review}}</textarea>
                                                       <br>
                                                       <div class="right_side">
       
                                                           <button type="button" id="reviewResubmit" class="button_blue middle_btn">Resubmit</button>
                           
                                                       </div>
                                                    @endif
                                                    @endif
                                                    @endif
                                                </section>
                                    </div>

                            </div>

                    </div><!--/ .section_offset -->

                    <!-- - - - - - - - - - - - - - End of order table - - - - - - - - - - - - - - - - -->

                    <div class="section_offset">

                        <div class="row">

                            <div class="col-md-6">

                                <!-- - - - - - - - - - - - - - Bill to - - - - - - - - - - - - - - - - -->

                                <section>

                                    <h3>Bill To</h3>

                                    <div class="table_wrap">

                                        <table class="table_type_1 order_table">

                                            <tbody>
                                            @foreach($billing as $bill)
                                                <tr>
                                                    <th>Email</th>
                                                    <td><a>{{$bill->email}}</a></td>
                                                </tr>
                                                <tr>
                                                    <th>Name</th>
                                                    <td>{{$bill->first_name}} {{$bill->last_name}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Address</th>
                                                    <td>{{$bill->address}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Zip/Postal Code</th>
                                                    <td>{{$bill->zip}}</td>
                                                </tr>
                                                <tr>
                                                    <th>City</th>
                                                    <td>{{$bill->city}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Country</th>
                                                    <td>{{$bill->country}}</td>
                                                </tr>
                                                <tr>
                                                    <th>State</th>
                                                    <td>{{$bill->state}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Phone</th>
                                                    <td>{{$bill->telephone}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>

                                        </table>

                                    </div>

                                </section>

                                <!-- - - - - - - - - - - - - - End of bill to - - - - - - - - - - - - - - - - -->

                            </div><!--/ [col] -->

                            <div class="col-md-6">

                                <!-- - - - - - - - - - - - - - Ship to - - - - - - - - - - - - - - - - -->

                                <section>

                                    <h3>Ship To</h3>

                                    <div class="table_wrap">

                                        <table class="table_type_1 order_table">

                                            <tbody>
                                            @foreach($shipping as $ship)
                                                <tr>
                                                    <th>Email</th>
                                                    <td><a>{{$ship->email}}</a></td>
                                                </tr>
                                                <tr>
                                                    <th>Name</th>
                                                    <td>{{$ship->first_name}} {{$ship->last_name}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Address</th>
                                                    <td>{{$ship->address}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Zip/Postal Code</th>
                                                    <td>{{$ship->zip}}</td>
                                                </tr>
                                                <tr>
                                                    <th>City</th>
                                                    <td>{{$ship->city}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Country</th>
                                                    <td>{{$ship->country}}</td>
                                                </tr>
                                                <tr>
                                                    <th>State</th>
                                                    <td>{{$ship->state}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Phone</th>
                                                    <td>{{$ship->telephone}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>

                                        </table>

                                    </div>

                                </section>

                                <!-- - - - - - - - - - - - - - End of ship to - - - - - - - - - - - - - - - - -->

                            </div><!--/ [col] -->

                        </div><!--/ .row -->

                    </div><!--/ .section_offset -->
                 

                    <!-- - - - - - - - - - - - - - Items ordered - - - - - - - - - - - - - - - - -->

                    <section class="section_offset">

                        <h3>Items Ordered</h3>

                        <div class="table_wrap">

                            <table class="table_type_1 order_review">

                                <thead>
                                    
                                    <tr>
                                        
                                        <th class="product_title_col">Product Name</th>
                                        <th class="product_price_col">Price</th>
                                        <th class="product_qty_col">Quantity</th>
                                        <th class="product_qty_col">Tax(GST)</th>
                                        @if(count($ifPaint)>0)
                                        <th class="product_qty_col">Color Code	</th>
                                        <th class="product_qty_col">Litreage	</th>
                                        @endif
                                        <th class="product_total_col">Total</th>

                                    </tr>

                                </thead>

                                <tbody>
                                <?php
                                $sub = 0;
                                $total = 0;
                                $shipping = 0;
                                $table_pos =4;
                                 $subTotal=0;
                                ?>
                                @foreach($order_items as $index => $order_item)
                                <input type="hidden" name="order_item_id" id="order_item_id" value="{{$order_item->id}}">
                                    <tr>
                                        <td data-title="Product Name">
                                            <a href="#" class="product_title">
                                              
                                                    {{$order_item->product_name}}
                                                                                   
                                            </a>
                                            <!-- <ul class="sc_product_info">
                                                <li>Size: Big</li>
                                                <li>Color: Red</li>
                                            </ul> -->
                                        </td>
                                        <td data-title="Price" class="subtotal">₹ {{$order_item->sales_price}}</td>
                                        <td data-title="Quantity">{{$order_item->qty}}</td>
                                          <td class="center">GST ({{$order_item->tax_percent}}%) {{$order_item->tax_type}} <span style="font-family: DejaVu Sans; sans-serif;">₹</span>{{$order_item->tax}}</td>
                                         @if(count($ifPaint)>0)
                                        <td>{{$ifPaint[$index]->color_id}}	</td>
                                        <td>{{$ifPaint[$index]->lit}}	</td>
                                        <?php $table_pos=6?>
                                        @endif
                                        <td data-title="Total" class="total">₹ {{$order_item->total_price }}</td>
                                    </tr>
                                   
                                @endforeach
                                
                                </tbody>

                                <tfoot>
                    
                                            @if($order->shipping_type == 1)
                                              <td colspan="{{$table_pos}}">
      <strong>Subtotal</strong>
      </td>
      <td class="right"><span style="font-family: DejaVu Sans; sans-serif;">₹</span> {{$order->total_amount - $order->shipping_value}}</td>
      </tr>
                                             <tr>
                                             <td colspan="{{$table_pos}}" class="bold">Shipping &amp; Heading (Flat Rate - Include)  </td>
                                                <td class="total">₹ {{$order->shipping_value}}</td>
        
                                            </tr>
                                            @endif
                                   

                                   

                                    <tr>
                                        
                                    <td colspan="{{$table_pos}}" class="grandtotal">Grand Total</td>
                                        <td class="grandtotal">₹ {{$order->total_amount}}</td>

                                    </tr>

                                </tfoot>

                            </table>

                        </div><!--/ .table_wrap -->

                        <!-- <footer class="bottom_box">

                            <a href="shop_orders_list.html" class="button_grey middle_btn">Back to My Orders</a>

                        </footer> -->

                    </section>

                    <!-- - - - - - - - - - - - - - End of items ordered - - - - - - - - - - - - - - - - -->

                           

                </main>
        </div>
    </div>
</div>

@endsection
@section('extra-js')
<script>
    $('.orders').addClass('accSidebarActive');
function Review(){
    var product_form_data = new FormData($('#form')[0]);

    var price_rate = $('input[name=price_rate]:checked').val();
    var value_rate = $('input[name=value_rate]:checked').val();
    var quality_rate = $('input[name=quality_rate]:checked').val();

        product_form_data.append('price_rate',price_rate);
        product_form_data.append('value_rate',value_rate);
        product_form_data.append('quality_rate',quality_rate);
    $.ajax({
        url : '/addReview',
        type: "POST",
        data: product_form_data,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
            $("#form")[0].reset();
            toastr.success('Review Store Successfully', 'Successfully Save');
            window.location.href = "/account/review";
        },
        error: function (data, errorThrown) {    
            var errorData = data.responseJSON.errors;
            $.each(errorData, function(i, obj) {
                toastr.error(obj[0]);
            });
        }
    }); 
}
var rating = 0;
    $('.rating_').click(function(){
     rating = $(this).val();
     setTimeout(function(){
        if(rating == 1){
            $('#rating_1').addClass('active');
            $('#rating_2').removeClass('active');
            $('#rating_3').removeClass('active');
            $('#rating_4').removeClass('active');
            $('#rating_5').removeClass('active');
           
        }else if(rating == 2){
            $('#rating_1').addClass('active');
            $('#rating_2').addClass('active');
            $('#rating_3').removeClass('active');
            $('#rating_4').removeClass('active');
            $('#rating_5').removeClass('active');
           
        }else if(rating == 3){
            $('#rating_1').addClass('active');
            $('#rating_2').addClass('active');
            $('#rating_3').addClass('active');
            $('#rating_4').removeClass('active');
            $('#rating_5').removeClass('active');
           
        }else if(rating == 4){
            $('#rating_1').addClass('active');
            $('#rating_2').addClass('active');
            $('#rating_3').addClass('active');
            $('#rating_4').addClass('active');
            $('#rating_5').removeClass('active');
            
        }else if(rating == 5){
            $('#rating_1').addClass('active');
            $('#rating_2').addClass('active');
            $('#rating_3').addClass('active');
            $('#rating_4').addClass('active');
            $('#rating_5').addClass('active');
           
        }
    }, 500);
    });
    $('#reviewSubmit').click(function(){
        var reviews = $('#reviews').val();
        var order_item_id = $('#order_item_id').val();
        var item_id = $('#item_id').val();
        if(rating !=0){
        if(reviews.length >60){
            product_form_data = {
                reviews:reviews,
                rating:rating,
                order_item_id:order_item_id,
                item_id:item_id 
            }

        $.ajax({
        url : '/account/add-review',
        type: "GET",
        data: product_form_data,
        dataType: "JSON",
        success: function(data)
        {
            console.log(data)
            toastr.success('Review Store Successfully', 'Successfully Save');
           
        }
    }); 

            }else{
                toastr.error("Review length Maximun 60 Characters");
            }
        }else{
            toastr.error("Please Rating Your Product");
        }
    });
    $('#reviewResubmit').click(function(){
        var reviews = $('#reviews').val();
        var review_old = $('#review_old').val();
        var rating_old = $('#rating_old').val();
        if(reviews.length >60){
            product_form_data = {
                reviews:reviews,
                rating:rating,
                review_old:review_old,
                rating_old:rating_old 
            }

        $.ajax({
        url : '/account/re-review',
        type: "GET",
        data: product_form_data,
        dataType: "JSON",
        success: function(data)
        {
            console.log(data)
            toastr.success('Review Store Successfully', 'Successfully Save');
           
        }
    }); 
        }else{
            toastr.error("Review length Maximun 60 Characters");
        }
    })
</script>
@endsection