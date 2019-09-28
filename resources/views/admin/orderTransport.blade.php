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
            <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="projectinput5">Transport Status</label>
                        <select id="orderStatus" name="orderStatus" class="form-control">
                          <option value="3" selected="">All</option>
                          <option value="0">Booked</option>
                          <option value="1">Delivery</option>
                          <option value="2">Cancel</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-12 mb-1">
                            <div class="form-group text-center">
                              <!-- Floating button Regular with text -->
                              <a href="javascript:void(null)" id="orderFilter" class="btn btn-float btn-cyan"><i class="la la-filter"></i><span>Filter</span></a>
                              @if($role->transport_booking_action ==1)
                              <a href="javascript:void(null)" id="orderAction" class="btn btn-float btn-float-lg btn-pink"><i class="la la-check-circle"></i><span>Action</span></a>
                             @endif
                              <a href="#" id="page-reload" class="btn btn-float btn-cyan"><i class="la la-refresh"></i><span>refresh</span></a>
                            </div>
                          </div>
                    <div class="col-md-4">
                        <br>
                            <a href="/admin/order" class="btn btn-primary mr-1">
                              <i class="ft ft-shopping-cart"></i> Go to Order
                            </a>
                          
                    </div>
                  
            </div>
<section id="column-selectors">
    <div class="row">
      <div class="col-12">
        
        <div class="card">
  
          <div class="card-content collapse show">
            <div class="card-body card-dashboard">
             
              <table class="table table-striped table-bordered zero-configuration">
                <thead>
                  <tr>
                       
                    <th><input type="checkbox" name="transport_master_checkbox" class="transport_master_checkbox" value=""/></th>
                    <th>Order ID</th>
                    <th>Vehicle Name</th>
                    <th>Distance</th>
                    <th>Total</th>
                    <th>Customer </th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                        
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
    $('.order_transport').addClass('active');

    var orderPageTable = $('.zero-configuration').DataTable(
    {
        processing: true,
        serverSide: true,
        "ajax":'/admin/transport-order/3',
        columns: [
            // { data: 'order_id', name: 'order_id' },
            // { data: 'action', name: 'action' },
           { data:"checkbox",name: 'checkbox', orderable:false, searchable:false },
            { data: 'order_id', name: 'order_id' },
            { data: 'vehicle_name', name: 'vehicle_name'},
            { data: 'distance', name: 'distance'},
            { data: 'total', name: 'total'},
            { data: 'customer_details', name: 'customer_details'},
            { data: 'status', name: 'status'},
        

        ],
    });
$(document).on('click','.transport_master_checkbox', function(){
    if($(".transport_master_checkbox").prop('checked') == true){
        $(".order_checkbox").prop('checked',true);
} else{
    $(".order_checkbox").prop('checked',false);
}
   
});
$('#page-reload').click(function(){
    location.reload();
});

$(document).on('click','#orderAction', function(){
    var order_id=[];
    var orderStatus = $('#orderStatus').val();
    if(orderStatus !=3){
    $(".order_checkbox:checked").each(function(){
        order_id.push($(this).val());
    });
    if(order_id.length > 0){
        $.ajax({
            url:"/admin/order-transport-action",
            method:"get",
            data:{id:order_id,status:orderStatus},
            success:function(data){
                toastr.success(data);
              // orderPageTable.fnFilter("^"+ orderStatus +"$", 2, false, false)
                $('.zero-configuration').DataTable().ajax.reload();
                $(".transport_master_checkbox").prop('checked',false);
            }
        })
    }else{
        toastr.error("Please select atleast one Checkbox");
    }
}else{
    toastr.error("Please select Any other Transport Status");
}
});  

$('#orderFilter').click(function(){
    var orderStatus = $('#orderStatus').val();
    console.log(orderStatus);
    var new_url = '/admin/transport-order/'+orderStatus;
    orderPageTable.ajax.url(new_url).load();
    //orderPageTable.draw();
})
</script>


@endsection