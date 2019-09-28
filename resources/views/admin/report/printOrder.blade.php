<!DOCTYPE html>
<html lang="en">
<head>
  <title>Report</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <style>
        th{
            font-size: 12px;
        }
        td{
            font-size: 12px;
        }
        </style>
</head>
<body>

<div class="container-fluid">

<div class="row">
  <div class="col-sm-12 col-md-12 col-lg-12">

  </div>
 </div>
<div class="row">
 <div class="col-sm-12 col-md-12 col-lg-12">
  <!-- <h2>Order Items</h2>          -->
  <table class="table table-bordered">

    <tbody>
    @if(!empty($data))
      <tr>
        <th>Date</th>
        <th>Order ID</th>
        <th>Customer</th>
        <th>Product</th>
        <th>Payment Type</th>
        <th>Transport Type</th>
        <th>QTY</th>
        <th>Amount</th>
        <th>GST</th>
        <th>Total Value</th>
      </tr>

      <?php $total=0 ?>
      @foreach($data as $item)

      <tr>

        <td>{{$item->created_at}}</td>
        <td>{{$item->id}}</td>
        @if($item->user_type == 'user')
        <td>{{$item->name}}</td>
        @else
        <?php $company = App\company::where('user_id',$item->user_id)->first();?>
        <td>{{$company->company}} <br>{{$item->name}}</td>
        @endif
        <td>{{$item->product_name}}</td>
        <td>{{$item->transport_type == 1 ? 'K.A.S Earth Mover' : 'Own Transport'}}</td>
        <td>{{$item->payment_type == 1 ? 'Online' : 'COD'}}</td>
       <td>{{$item->qty}}</td>
       <td>{{$item->sales_price}}</td>
       <td>{{$item->tax}} <br>
    <span style="font-size:8px">({{$item->tax_type}}{{$item->tax_percent}}%)</span>
    </td>
       <td>{{$item->total_amount}}</td>
       <?php $total += $item->total_amount?>

      </tr>
      @endforeach
    <tr>
        <td style="text-align:right" colspan="9"> Total :</td>
        <th>{{$total}}</th>
       </tr>
@endif
    </tbody>
  </table>
</div>

</div>


</div>

</body>
</html>
