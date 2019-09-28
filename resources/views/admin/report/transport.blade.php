@extends('admin.app')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/pickers/daterange/daterange.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/daterange/daterangepicker.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/pickadate/pickadate.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/selects/select2.min.css">
@endsection
@section('section')
<div class="content-wrapper">
        <div class="content-header row">
              <div class="col-lg-12 col-md-12">
                <div class="card" >
                  <div class="card-header">
                    <h4 class="card-title">Transport Report</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis font-medium-3"></i></a>
                  </div>
                  <div class="card-content collapse show">
                    <div class="card-body">
                    <form target="_blank" method="post" action="/admin/report/transport">
                    {{csrf_field()}}
                      <div class="row">
                        <div class="form-group col-sm-3 col-md-3">
                          <h3 class="content-header-title">From Date</h3>
                          <input autocomplete="off" type='text' class="form-control singledate" id="from_date" name="from_date"  />
                        </div>
                        <div class="form-group col-sm-3 col-md-3">
                          <h3 class="content-header-title">To Date</h3>
                          <input autocomplete="off" type="text" class="form-control singledate" id="to_date" name="to_date">
                        </div>
                        <div class="form-group col-sm-3 col-md-3">
                            <h3 class="content-header-title">Transport Status</h3>
                            <select class="select2 form-control" name="status" id="status">
                                <option value="3" selected="">All</option>
                                <option value="0">Booked</option>
                                <option value="1">Delivery</option>
                                <option value="2">Cancel</option>
                            </select>
                          </div>

                        <div class="form-group col-sm-3 col-md-3">
                          <h3 class="content-header-title">Select Vehicle</h3>
                          <select class="select2 form-control" name="vehicle" id="vehicle">
                            <option value="0">All</option>
                            @foreach($vehicle as $row)
                            <option value="{{$row->vehicle_name}}">{{$row->vehicle_name}}</option>
                            @endforeach
                          </select>
                        </div>


                        <div class="form-group col-sm-3 col-md-3">
                            <h3 class="content-header-title">Customer Type</h3>
                            <select class="select2 form-control" name="customer_type" id="customer_type">

                              <option value="0">All</option>
                              <option value="1">Individual</option>
                              <option value="2">Company</option>
                            </select>
                          </div>

                        <div class="form-group col-sm-3 col-md-3">
                          <h3 class="content-header-title">Customer</h3>
                          <select class="select2 form-control" name="customer[]" multiple id="customer">
                            @foreach($user as $row)
                            <option value="{{$row->id}}">{{$row->name}}</option>
                            @endforeach
                          </select>
                        </div>

                        <div class="form-group col-sm-3 col-md-3">
                            <h3 class="content-header-title">Payment Type</h3>
                            <select class="select2 form-control" name="payment_type" id="payment_type">
                              <option value="0">All</option>
                              <option value="1">Online</option>
                              <option value="2">COD</option>
                            </select>
                          </div>

                    </div>
                </div>
                    <div class="row">
                      <div class="form-group col-sm-12 col-md-12">
                      <button type="submit" id="clone-button" class="btn btn-primary">
                              <i class="ft-plus"></i> Filter
                      </button>
                      <button type="reset" id="reset-button" class="btn btn-primary">
                              <i class="ft-plus"></i> Reset
                      </button>
                      </div>
                    </div>
                  </form>
                  </div>
                </div>
              </div>



        </div>
      </div>
</div>
@endsection
@section('extra-js')
<script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
<script src="../../../app-assets/vendors/js/pickers/pickadate/picker.js" type="text/javascript"></script>
  <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.date.js" type="text/javascript"></script>
  <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.time.js" type="text/javascript"></script>
  <script src="../../../app-assets/vendors/js/pickers/pickadate/legacy.js" type="text/javascript"></script>
  <script src="../../../app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js"
  type="text/javascript"></script>
  <script src="../../../app-assets/vendors/js/pickers/daterange/daterangepicker.js"
  type="text/javascript"></script>
<script>
$(".select2").select2({
              width: '100%',
            });

$('.transport_report').addClass('active');
$('.singledate').daterangepicker({
  singleDatePicker: true,
  showDropdowns: true
});
$('#from_date').val('');
$('#to_date').val('');

$('#customer_type').change(()=>{
   var customer_type = $('#customer_type').val();

    $.ajax({
            url:"/admin/report/get-order-customer",
            method:"get",
            data:{customer_type:customer_type},
            success:function(data){
              $('#customer').html(data);
            }
        });

});

$('#reset-button').click(()=>{
    $('#vehicle').select2(0);
    $('#status').select2(0);
    $('#customer_type').select2(0);
    $('#customer').select2();
    $('#product').select2();
    $('#transport_mode').select2(0);
    $('#payment_type').select2();
});
</script>
@endsection
