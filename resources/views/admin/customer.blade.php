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
                        <label for="projectinput5">Select Customer Type</label>
                        <select id="orderStatus" name="orderStatus" class="form-control">
                          <option value="3" selected="">All</option>
                          <option value="user">Individual</option>
                          <option value="company">Company</option>

                        </select>
                      </div>
                    </div>
                    <div class="col-xl-4 col-lg-12 mb-1">
                            <div class="form-group text-center">
                              <!-- Floating button Regular with text -->
                              <a href="javascript:void(null)" id="orderFilter" class="btn btn-float btn-cyan"><i class="la la-filter"></i><span>Filter</span></a>

                              <a href="#" id="page-reload" class="btn btn-float btn-cyan"><i class="la la-refresh"></i><span>refresh</span></a>
                            </div>
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
                    <th>S No</th>
                    <th>Customer</th>
                    <th>E-mail</th>
                    <th>Phone</th>
                    <th>Customer Type</th>
                    @if($role->customer_action ==1)
                    <th>Action</th>
                    @endif
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
@if($role->customer_action ==1)
<script>
    var status_id = null;
    $('.customer').addClass('active');

    var orderPageTable = $('.zero-configuration').DataTable(
    {
        processing: true,
        serverSide: true,
        "ajax":'/admin/get-customer/3',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'customer', name: 'customer' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'user_type', name: 'user_type' },
            { data: 'action', name: 'action' },

        ],
    });
    </script>
@else

<script>
    var status_id = null;
    $('.customer').addClass('active');
    var orderPageTable = $('.zero-configuration').DataTable(
    {
        processing: true,
        serverSide: true,
        "ajax":'/admin/get-customer/3',
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'customer', name: 'customer' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'user_type', name: 'user_type' },

        ],
    });
    </script>
    @endif
    <script>
$('#page-reload').click(function(){
    location.reload();
});
$('#orderFilter').click(function(){
    var orderStatus = $('#orderStatus').val();
    console.log(orderStatus);
    var new_url = '/admin/get-customer/'+orderStatus;
    orderPageTable.ajax.url(new_url).load();
    //orderPageTable.draw();
})
</script>


@endsection
