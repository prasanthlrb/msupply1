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
      <div class="row">
      <div class="col-sm-7">
      <h6>From:</h6>
      <div>
      <strong>M-Supply</strong>
      </div>
    <div>{{$info->address}}</div>
      <div>Email: {{$info->email}}</div>
      <div>Phone: {{$info->phone}}</div>
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
      <th class="center">#</th>
      <th>Item</th>
      <th class="right">Unit Cost</th>
        <th class="center">Qty</th>
      <th class="right">Total</th>
      </tr>
      </thead>
      <tbody>
          <?php $x=1;?>
          @foreach($item as $row)
      <tr>
      <td class="center">{{$x}}</td>
      <td class="left strong">{{$row->product_name}}</td>
      
      <td class="right"><span style="font-family: DejaVu Sans; sans-serif;">&#8377;</span> {{$row->sales_price}}</td>
        <td class="center">{{$row->qty}}</td>
      <td class="right"><span style="font-family: DejaVu Sans; sans-serif;">₹</span> {{$row->qty * $row->sales_price}}</td>
      </tr>
      <?php $x++?>
      @endforeach
      <tr>
     <hr>
      </tr>
      </tbody>
      </table>

      <div class="row">
      <div class="col-lg-4 col-sm-5">
      
      </div>
      
      <div class="col-lg-4 col-sm-5 ml-auto">
      <table class="table table-clear">
      <tbody>
      <tr>
      <td class="left">
      <strong>Subtotal</strong>
      </td>
      <td class="right"><span style="font-family: DejaVu Sans; sans-serif;">₹</span> {{$item[0]->qty * $item[0]->sales_price}}</td>
      </tr>
      <tr>
      <td class="left">
      <strong>GST ({{$item[0]->tax_percent}}%) {{$item[0]->tax_type}}</strong>
      </td>
      <td class="right"><span style="font-family: DejaVu Sans; sans-serif;">₹</span>{{$item[0]->tax}}</td>
      </tr>
      <tr>
      <td class="left">
      <strong>Total</strong>
      </td>
      <td class="right">
      <strong><span style="font-family: DejaVu Sans; sans-serif;">₹</span> {{$item[0]->total_price}}</strong>
      </td>
      </tr>
      </tbody>
      </table>
      
      </div>
      
      </div>
      
      </div>
      </div>
      </div>