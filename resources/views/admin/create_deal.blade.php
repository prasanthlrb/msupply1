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
                    <h4 class="card-title">Create Deal</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis font-medium-3"></i></a>
                  </div>
                  <div class="card-content collapse show">
                    <div class="card-body">
                    <form target="_blank" method="post" action="/admin/report/orders" id="order_report">
                    {{csrf_field()}}
                      <div class="row">
                          <div class="form-group col-sm-6 col-md-6">
                            <h3 class="content-header-title">Select Customer</h3>
                            <select class="select2 form-control" name="customer" id="customer">
                              <option value="">SELECT</option>
                              @foreach($user as $row)
                              <option value="{{$row->id}}">{{$row->name}}</option>
                              @endforeach
                            </select>
                          </div>

                          <div class="form-group col-sm-6 col-md-6">
                            <h3 class="content-header-title">Select Mobile</h3>
                            <select class="select2 form-control" name="phone" id="phone">
                              <option value="">SELECT</option>
                              @foreach($user as $row)
                              <option value="{{$row->id}}">{{$row->phone}}</option>
                              @endforeach
                            </select>
                          </div>
                          
                          <div class="form-group col-sm-6 col-md-6">
                            <h3 class="content-header-title">Product</h3>
                            <select class="select2 form-control" name="product" id="product">
                              <option value="">SELECT</option>
                              @foreach($product as $row)
                              <option value="{{$row->id}}">{{$row->product_name}}</option>
                              @endforeach
                            </select>
                          </div>

                          <div class="form-group col-sm-6 col-md-6">
                            <h3 class="content-header-title">Price</h3>
                            <input type="text" name="price" id="price" class="form-control">
                          </div>

                          <div class="form-group col-sm-6 col-md-6">
                            <h3 class="content-header-title">Deal Price</h3>
                            <input type="text" name="deal_price" id="deal_price" class="form-control">
                          </div>

                          <div class="form-group col-sm-6 col-md-6">
                            <h3 class="content-header-title">Qty</h3>
                            <input type="text" name="qty" id="qty" class="form-control">
                          </div>

                          <div class="form-group col-sm-6 col-md-6">
                            <h3 class="content-header-title">Gst</h3>
                            <input type="text" name="gst" id="gst" class="form-control">
                          </div>

                          <div class="form-group col-sm-6 col-md-6">
                            <h3 class="content-header-title">Total</h3>
                            <input type="text" name="total" id="total" class="form-control">
                          </div>

                          <div class="form-group col-sm-6 col-md-6">
                            <h3 class="content-header-title">Period Date & Time</h3>
                            <input type="text" name="date_time" id="date_time" class="form-control singledate">
                          </div>
                      </div>
                      
                      <div class="row">
                        <div class="form-group col-sm-12 col-md-12">
                          <button type="submit" id="clone-button" class="btn btn-primary">
                            <i class="ft-plus"></i> Save
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

  <link rel="stylesheet" href="{{asset('autocomplete/jquery-ui.css')}}">
  <script type="text/javascript" src="{{asset('autocomplete/jquery-ui.js')}}"></script>

<script>
$(".select2").select2({
  width: '100%',
});

$('.order_report').addClass('active');
$('.singledate').daterangepicker({
  singleDatePicker: true,
  showDropdowns: true
});
$('#from_date').val('');
$('#to_date').val('');

$('.get_product').change(()=>{
   var brand = $('#brand').val();
   var cat = $('#cat').val();
    $.ajax({
      url:"/admin/report/get-order",
      method:"get",
      data:{brand:brand,cat:cat},
      success:function(data){
          $('#product').html(data);
      }
    });
});

$('#customer').change(()=>{
  $('#phone').select2(0);
   var customer = $('#customer').val();
   $.ajax({
			url : '/admin/get-user/'+customer,
			type: "GET",
      dataType: "JSON",
			success:function(data) {
        $('select[name=phone]').select2().val(data.id);
			}
		});
});


$('#phone').change(()=>{
  $('#customer').select2(0);
   var phone = $('#phone').val();
   $.ajax({
			url : '/admin/get-user/'+phone,
			type: "GET",
      dataType: "JSON",
			success:function(data) {
        $('select[name=customer]').select2().val(data.id);
			}
		});
});


$('#product').change(()=>{
   var product = $('#product').val();
   $.ajax({
			url : '/admin/get-product-deal/'+product,
			type: "GET",
      dataType: "JSON",
			success:function(data) {
        //alert(data.sales_price);
        $('#price').val(data.sales_price);
			}
		});
});

$('#reset-button').click(()=>{
    //$('#brand').select2(0);
    //$('#cat').select2(0);
    //$('#status').select2(0);
    //$('#customer_type').select2(0);
    $('#customer').select2();
    $('#product').select2();
    $('#phone').select2(0);
    //$('#payment_type').select2();
});


$("#customer").autocomplete({      
    source: function(request, response) {
        $.ajax({
            url: '/admin/get-user/',
            dataType: "json", 
            data: request, 
            success: function (data) {
	            if(data.response == 'true') 
	            {
	                response(data.message);
	            }
            }
        });      
    },
	minLength: 1,
	select: function (event, ui) {
	    $(this).val(ui.item.label); 
	    var userid = ui.item.id; 
	    $.ajax({
			url : '/admin/get-user/'+userid,
			type: "GET",
        	dataType: "JSON",
			success:function(response) {
				$("#phone").val(response.phone);	
			}
		});
	}		
}); 
</script>
@endsection
