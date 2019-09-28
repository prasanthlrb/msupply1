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
                    <th>Vehicle Name</th>
                    <th>Distance</th>
                    <th>Total</th>
                    <th>Customer </th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                    <?php $x=1 ?>
                    @foreach($transport as $row)
                      <tr>
                      <td>{{$x}}</td>  
                      <td><a href="/admin/order-transport-details/{{$row->id}}" >#{{$row->id}}</a></td>  
                      <td>{{$row->vehicle_name}}</td> 
                     <td>
                           
                            {{$row->distance}} Km
                            </td>
                          <td>
                            ₹ {{$row->total}}
                            </td>
                       <?php echo '<td>
                           <p>'.$row->name.'</p>
                            <p>'.$row->phone.'</p>
                            </td>';
                           
                                if($row->status == 0){
                                    $status ='<b>Booked</b>';
                                }
                                else if($row->status == 1){
                                    $status ='<b>Delivery</b>';
                                }
                                else if($row->status == 2){
                                    $status ='<b>Cancel</b>';
                                }
                                
                                else{
                                    $status ='<b>failed</b>';
                                }
                                echo '<td>
                                '.$status.'
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

    $('.zero-configuration').DataTable();

$('#page-reload').click(function(){
    location.reload();
});


</script>


@endsection