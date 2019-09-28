@extends('admin.app')
@section('extra-css')
<style>
.btn-space{
  margin-top: 10px;
}
</style>
@endsection
@section('section')
<div class="content-wrapper">
          <!-- // callback options section end -->
        <div class="content-header row">
              <div class="col-lg-12 col-md-12">
                <div class="card" >
                  <div class="card-header">
                    <div class="row">
                        <div class="form-group col-sm-12 col-md-12">
                          <div class="row">
                            <div class="btn-space col-md-2">
                          <a href="http://www.kagtiles.com/stockapp/user/getproductdetailsbybranch/Madurai" target="blank" class="btn btn-primary">
                            <i class="ft-plus"></i> Open data Madurai
                        </a>
                            </div>
                            <div class="btn-space col-md-2">
                          <a href="http://www.kagtiles.com/stockapp/user/getproductdetailsbybranch/Trichy" target="blank" class="btn btn-primary">
                                <i class="ft-plus"></i> Open data Trichy
                        </a>
                            </div>
                            <div class="btn-space col-md-2">
                               <a href="http://www.kagtiles.com/stockapp/user/getproductdetailsbybranch/Salem" target="blank" class="btn btn-primary">
                                <i class="ft-plus"></i> Open data Salem
                        </a>
                            </div>
                            <div class="btn-space col-md-3">
                              <a href="http://www.kagtiles.com/stockapp/user/getproductdetailsbybranch/Coimbatore" target="blank" class="btn btn-primary">
                                <i class="ft-plus"></i> Open data Coimbatore
                        </a>
                            </div>
                            <div class="btn-space col-md-2">
                              <a href="http://www.kagtiles.com/stockapp/user/getproductdetailsbybranch/Vellore" target="blank" class="btn btn-primary">
                                <i class="ft-plus"></i> Open data Vellore
                        </a>
                            </div>
                            <div class="btn-space col-md-2">
                              <a href="http://www.kagtiles.com/stockapp/user/getproductdetailsbybranch/Karaikal" target="blank" class="btn btn-primary">
                                <i class="ft-plus"></i> Open data Karaikal
                        </a>
                            </div>
                            <div class="btn-space col-md-3">
                              <a href="http://www.kagtiles.com/stockapp/user/getproductdetailsbybranch/Vadapalani" target="blank" class="btn btn-primary">
                                <i class="ft-plus"></i> Open data Vadapalani
                        </a>
                            </div>
                            <div class="btn-space col-md-3">
                               <a href="http://www.kagtiles.com/stockapp/user/getproductdetailsbybranch/Pallavaram" target="blank" class="btn btn-primary">
                                <i class="ft-plus"></i> Open data Pallavaram
                        </a>
                            </div>
                            <div class="btn-space col-md-3">
                               <a href="http://www.kagtiles.com/stockapp/user/getproductdetailsbybranch/Tirunelveli" target="blank" class="btn btn-primary">
                                <i class="ft-plus"></i> Open data Tirunelveli
                        </a>
                            </div>
                            <div class="btn-space col-md-2">
                              <a href="http://www.kagtiles.com/stockapp/user/getproductdetailsbybranch/Perungalthur" target="blank" class="btn btn-primary">
                                <i class="ft-plus"></i> Open data Perungalthur
                        </a>
                            </div>
                          </div>

                       
                       
                        
                        <button type="reset" id="updateTiles" class="btn btn-primary float-right">
                                <i class="ft-plus"></i> Upload
                        </button>
                        </div>
                  </div>

                  <div class="card-content collapse show">

                    <div class="card-body">
                    <form target="_blank" method="post" action="/admin/report/orders" id="order_report">
                    {{csrf_field()}}
      <div class="form-group row">
            <label class="col-md-2 label-control" for="projectinput6">Select Stock Location</label>
            <div class="col-md-9">
              <select name="location" id="location" class="form-control">
                <option selected="" value="0" disabled>select</option>
                <option value="Madurai">Madurai</option>
                <option value="Trichy">Trichy</option>
                <option value="Salem">Salem</option>
                <option value="Coimbatore">Coimbatore</option>
                <option value="Vellore">Vellore</option>
                <option value="Karaikal">Karaikal</option>
                <option value="Vadapalani">Vadapalani</option>
                <option value="Pallavaram">Pallavaram</option>
                <option value="Tirunelveli">Tirunelveli</option>
                <option value="Perungalthur">Perungalthur</option>
               
              </select>
            </div>
          </div>


                      <div class="row">
                        <div class="form-group col-md-12">
                          <h3 class="content-header-title">Stock Update</h3>
                         <textarea name="tiles-update" id="tiles-update" rows="50" style="width:100%"></textarea>
                        </div>
                    </div>
                </div>
                  </form>
                  </div>
                </div>
              </div>



                  <div class="col-lg-12 col-md-12">
                    <div class="card" >
                      <div class="card-header">
                        <form method="post" action="/admin/tiles-tax">

                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12">

                            <button type="submit" class="btn btn-primary float-right">
                                    <i class="ft-plus"></i> Update Tax
                            </button>
                            </div>
                      </div>

                      <div class="card-content collapse show">

                        <div class="card-body">
                        {{csrf_field()}}
                          <div class="row">
                        <div class="form-group col-sm-12 col-md-12">
                                        <label for="projectinput6">Tax Type</label>

                                          <select name="tax_type" id="tax_type" class="form-control" >
                                          <option value="" selected disabled>Select The Tax Type</option>

                                            <option value="in">Inclusive</option>
                                            <option value="out">Exclusive</option>

                                          </select>
                                        </div>

                                    <div class="form-group col-sm-12 col-md-12">
                                        <label for="projectinput1">TAX Percentage (%)</label>
                                        <input type="text" class="form-control" name="tax" id="tax">
                                      </div>
                         </div>
                        </div>
                        
                      </div>
                    </div>
                  </form>
                  </div>
                  </div>




              <div class="col-lg-12 col-md-12">
                    <div class="card" >
                      <div class="card-header">

                        <div class="row">
                            <div class="form-group col-sm-12 col-md-12">

                            <button type="reset" id="update-details" class="btn btn-primary float-right">
                                    <i class="ft-plus"></i> Upload
                            </button>
                            </div>
                      </div>

                      <div class="card-content collapse show">

                        <div class="card-body">
                        <form target="_blank" method="post" action="/admin/report/orders" id="order_report">
                        {{csrf_field()}}
                          <div class="row">
                            <div class="form-group col-md-12">
                              <h3 class="content-header-title">Product Details Update</h3>
                             <textarea name="tiles-details-update" id="tiles-details-update" rows="50" style="width:100%"></textarea>
                            </div>
                         </div>
                    </div>
                      </form>
                      </div>
                    </div>
                  </div>

        </div>
      </div>
        </div>
</div>
@endsection
@section('extra-js')

<script>
$('.update-tiles').addClass('active');
$('#updateTiles').click(()=>{
  var tilesUpdate = $('#tiles-update').val();
  var location = $('#location').val();
  try{
    $.blockUI({
            message: '<div class="ft-refresh-cw icon-spin font-medium-2"></div>',
            timeout: 20000, //unblock after 2 seconds
            overlayCSS: {
                backgroundColor: '#FFF',
                opacity: 0.8,
                cursor: 'wait'
            },
            css: {
                border: 0,
                padding: 0,
                color: '#333',
                backgroundColor: 'transparent'
            },
        });
  $.ajax({
    url : '/admin/upload-tiles-json',
    method: "POST",
    data: {
    "_token": "{{ csrf_token() }}",
    "location":location,
    "datas": tilesUpdate,
    },
    dataType: "JSON",
    success: function(data)
        {
            $.unblockUI();
            console.log(data);
        //toastr.success('Tiles Store Successfully', 'Successfully Save');
        },error: function (data, errorThrown) {
        var errorData = data.responseJSON.errors;
             $.each(errorData, function(i, obj) {
              toastr.error(obj[0]);
        });
        }
     });
  }catch(err){
    toastr.error("Please Paste Tiles Json Data");
  }
});

//product Details update
$('#update-details').click(()=>{
  var tilesUpdate = $('#tiles-details-update').val();
  try{
    $.blockUI({
            message: '<div class="ft-refresh-cw icon-spin font-medium-2"></div>',
            timeout: 20000, //unblock after 2 seconds
            overlayCSS: {
                backgroundColor: '#FFF',
                opacity: 0.8,
                cursor: 'wait'
            },
            css: {
                border: 0,
                padding: 0,
                color: '#333',
                backgroundColor: 'transparent'
            },
        });
  $.ajax({
    url : '/admin/update-tiles-json',
    method: "POST",
    data: {
    "_token": "{{ csrf_token() }}",
    "datas": tilesUpdate
    },
    dataType: "JSON",
    success: function(data)
        {
            $.unblockUI();
            console.log(data);
        //toastr.success('Category Store Successfully', 'Successfully Save');
        },error: function (data, errorThrown) {
        var errorData = data.responseJSON.errors;
             $.each(errorData, function(i, obj) {
              toastr.error(obj[0]);
        });
        }
     });
  }catch(err){
    toastr.error("Please Paste Tiles Details Json Data");
  }
});

</script>
@endsection
