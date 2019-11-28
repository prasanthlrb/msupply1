<!DOCTYPE html>
<html lang="en">
<head>
 <title>Order Report</title>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  </head>
  <div class="container-fluid">
        <div class="card">
      <div class="card-header">
            <span class="float-right"> <strong>Status:</strong> Delivered</span>
      Invoice <strong>#{{$order->id}}</strong> 
      <p>Date : {{$order->updated_at}}</p>
</div>
      
      <div class="card-body">
          <br>
          <br>
          <br>
          <br>
      <div class="row">
      <div class="col-sm-7">
      <h6>From:</h6>
      <div>
      <strong>M-Supply</strong>
      </div>
    <div>{{$info->address}}</div>
      <div>Email: {{$info->email}}</div>
      <div>Phone: {{$info->phone}}</div>
      <div>GSTIN: {{$info->gstin}}</div>
      </div>
      
      <div class="col-sm-5 ml-auto">
      <h6>To:</h6>
      <div>
      <strong>{{$billing->first_name}} {{$billing->last_name}}</strong>
      </div>
      <div>{{$billing->address}}</div>
      <div>{{$billing->city}} - {{$billing->zip}}</div>
      <div>{{$billing->state}}</div>
      <div>Email: {{$billing->email}}</div>
      <div>Phone: {{$billing->telephone}}</div>
      
      </div>
      </div>
      <table class="table table-striped">
      <thead>
      <tr>
        <?php $table_pos=4;?>
      <th class="center">#</th>
      <th>Item</th>
      <th class="right">Unit Cost</th>
        <th class="center">Qty</th>
        <th class="center">Tax(GST)</th>
          @if(count($ifPaint)>0)
          <?php $table_pos =6;?>
                                        <th class="product_qty_col">Color Code	</th>
                                        <th class="product_qty_col">Litreage	</th>
                                        @endif
      <th class="right">Total</th>
      </tr>
      </thead>
      <tbody>
          <?php $x=1;
      
          ?>
          @foreach($item as $index => $row)
      <tr>
      <td class="center">{{$x}}</td>
      <td class="left" style="font-size:12px">{{$row->product_name}}</td>
      <td class="right" style="font-size:12px"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> {{$row->sales_price}}</td>
        <td class="center" style="font-size:12px">{{$row->qty}}</td>
        <td class="center" style="font-size:12px">GST ({{$row->tax_percent}}%) {{$row->tax_type}} <span style="font-family: DejaVu Sans; sans-serif;">₹</span>{{$row->tax}}</td>
            @if(count($ifPaint)>0)
                                        <td style="font-size:12px">{{$ifPaint[$index]->color_id}}	</td>
                                        <td style="font-size:12px">{{$ifPaint[$index]->lit}}	</td>
                                        <?php $table_pos=6?>
                                        @endif
      <td class="right" style="font-size:12px"><span style="font-family: DejaVu Sans; sans-serif;">₹</span> {{$row->total_price}}</td>
      </tr>

      <?php
    
      $x++?>
      @endforeach
   
      <tr>
     <hr>
      </tr>
      </tbody>
      </table>

      <div class="row">
      <div class="col-lg-4 col-sm-5">
      
      </div>
      
      <div class="col-lg-6 col-sm-7 ml-auto float-right">
      <table class="table table-clear">
      <tbody>
        
        
        @if($order->shipping_type == 1)
          <tr >
            <td colspan="{{$table_pos}}">
      Subtotal
      </td>
      <td><span style="font-family: DejaVu Sans; sans-serif;">₹</span> {{$order->total_amount - $order->shipping_value}}</td>
      </tr>
                                             <tr>
                                             <td colspan="{{$table_pos}}">Shipping &amp; Heading (Flat Rate - Include)  </td>
                                                <td><span style="font-family: DejaVu Sans; sans-serif;">₹</span> {{$order->shipping_value}}</td>
        
                                            </tr>

                                            @endif
      <tr >
      <td colspan="{{$table_pos}}">
     Total
      </td>
      <td>
      <span style="font-family: DejaVu Sans; sans-serif;">₹</span> {{$order->total_amount}}
      </td>
      </tr>
      </tbody>
      </table>
      
      </div>
      
      </div>
      
      </div>
      </div>
      </div>