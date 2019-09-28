@extends('admin.app')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
  <style>
  .clickable-Product-row{
    cursor: pointer;
  }
  </style>
@endsection
@section('section')
<div class="content-wrapper">

    <div class="content-body">     
            
<section id="column-selectors">
    <div class="row">
      <div class="col-12">
        
        <div class="card">
  
          <div class="card-content collapse show">
            <div class="card-body card-dashboard">
             
              <table class="table table-striped table-bordered zero-configuration">
                <thead>
                  <tr>
                       
                    <th>S No</th>
                    <th>Order ID</th>
                    <th>Order Details</th>
                    <th>Payment Status</th>
                    <th>Order Status</th>
                    <th>Details</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $x=1 ?>
                    @foreach($order as $row)
                      <tr>
                      <td>{{$x}}</td>  
                      <td><a href="/admin/order-item/{{$row->id}}" >#{{$row->id}}</a></td>  
                      <?php if($row->transport_type == "1"){
                        $output = "Transport : KAS Earth Mover";
                    }else{
                     $output = "Transport : Own Transport";
                    } ?>
                 <td>
                 <p>{{$output}}</p>
                 <p>row Date : {{$row->created_at}}</p>
                 <p>Item Name : {{$row->product_name}}</p>
                 <p>quantity : {{$row->qty}}</p>
                 <p>Total : {{$row->total_amount}}</p>
                 </td>
                       
                <td>{{$row->payment_type == "1" ? "Cash on Delivery" : "Online Payment"}}</td>  
                <?php 
                if($row->order_status == 0){
        $status ='<b>Pending</b>';
    }
    else if($row->order_status == 1){
        $status ='<b>Processing</b>';
    }
    else if($row->order_status == 2){
        $status ='<b>Shipping</b>';
    }
    else if($row->order_status == 3){
        $status ='<b>Delivered</b>';
    }
    else if($row->order_status == 4){
        $status ='<b>on-hold</b>';
    }
    
    else{
        $status ='<b>failed</b>';
    }
    echo '<td>
    '.$status.'
    </td>';
                      ?>
                       <?php
                       echo '<td>
   <p>'.$row->name.'</p>
    <p>'.$row->phone.'</p>
    </td>';
    ?>
                    </tr>  
                    <?php $x++?>
                    @endforeach
                </tbody>
                
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> 
</div>
    </div>
  </div>


@endsection
@section('extra-js')


<script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>



<script>
    var status_id = null;
    $('.order-menu').addClass('active');

    var orderPageTable = $('.zero-configuration').DataTable();

$('#page-reload').click(function(){
    location.reload();
});


</script>


@endsection