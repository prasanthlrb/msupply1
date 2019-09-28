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
        @if(!empty($data))
        <table class="table table-bordered" style="position:absolute;top:0px;left:0px">
          <thead>

                <tr>
                  <th>Date</th>
                  <th> ID</th>
                  <th>Customer</th>
                  <th>Vehicle Name</th>
                  <th>Payment Type</th>
                  <th>Price</th>
                  <th>Distance</th>
                  <th>Other</th>
                  <th>Total</th>
                </tr>
          </thead>
          <tbody>
              <?php $total=0 ?>
                @foreach($data as $item)
                <tr>
                  <td>{{$item->created_at}}</td>
                  <td>{{$item->id}}</td>
                  <td>{{$item->name}}</td>
                  <td>{{$item->vehicle_name}}</td>
                  <td>{{$item->payment_type == 1 ? 'Online' : 'COD'}}</td>
                 <td>{{$item->price}}</td>
                 <td>{{$item->distance}}</td>
                 <td>{{$item->other}}</td>
                 <td>{{$item->total}}</td>
                 <?php $total += $item->total?>
                </tr>
                @endforeach
                <tr>
                        <td style="text-align:right" colspan="8"> Total :</td>
                <th>{{$total}}</th>
                       </tr>

          </tbody>
        </table>
        @endif
      </div>

</body>
</html>





