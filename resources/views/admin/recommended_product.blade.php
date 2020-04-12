@extends('admin.app')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/selects/select2.min.css">
@endsection
@section('section')
<div class="content-wrapper">
    <div class="content-body">  
   <br>
<section id="column-selectors">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
                <button id="open_model" data-backdrop="false" class="btn btn-success round btn-glow px-2" data-toggle="modal">Create Product</button>
          </div>
          <div class="card-content collapse show">
            <div class="card-body card-dashboard">
              <table class="table table-striped table-bordered zero-configuration">
                <thead>
                  <tr>
                    <th>S No</th>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                 <?php $x=1?>
                @foreach($app_recomended as $row)
                <tr>
                <td>{{$x}}</td>
                @foreach($product as $pro)
                @if($pro->id == $row->product_id)
                <td>{{$pro->product_name}}</td>
                <td><img src="{{ asset("product_img/$pro->product_image")}}" alt="" style="width:80px"></td>
                @endif
                @endforeach
                <td class="text-center">
                    <span class="dropdown">
          <button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
          <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mt-1 dropdown-menu-right">

            <a href="javascript:void(null)" onclick="Edit({{$row->id}})" class="dropdown-item"><i class="ft-edit"></i> Edit</a>
            <a href="#" onclick="Delete({{$row->id}})" class="dropdown-item"><i class="la la-trash"></i> Delete</a>
          </span>
        </span>
                    </td>
                </tr>
                <?php $x++ ?>
                  @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>S No</th>
                        <th>Product Name</th>
                        <th>Product Image</th>
                        <th>Action</th>
                      </tr>
                </tfoot>
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

  <div class="modal fade text-left" id="attribute_model" role="dialog" aria-labelledby="myModalLabel8"
  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary white">
          <h4 class="modal-title white" id="myModalLabel8">Create Category</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="Category_form" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id">
        <div class="modal-body">

          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Choose Product ID</label>
            <div class="col-md-9">
              <select class="form-control select2"  name="product_id" id="product_id">
                <option value="">SELECT</option>
                @foreach($product as $row)
              <option value="{{$row->id}}">{{$row->product_name}}</option>
                @endforeach
              </select>
            </div>
          </div>

        </div>
        </form>
        <div class="modal-footer">
          <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-outline-primary" onclick="saveAttr()" id="saveCat">Save</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('extra-js')

<script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>

<script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
  <script src="../../../app-assets/js/scripts/tables/datatables/datatable-basic.js"
  type="text/javascript"></script>
<script>
  $(".select2").select2({
      width: '100%', 
    });

  $('.category-menu').addClass('active');
  var action_type; // the action type used to from data Save And Update
  $('#open_model').click(function(){
    $('#attribute_model').modal('show');
    $("#Category_form")[0].reset();
    action_type = 1;
    $('#saveCat').text('Save');
    $('#myModalLabel8').text('Create Recommended Product');
  });


    function saveAttr(){
      $('#saveCat').attr('disabled',true);
      var formData = new FormData($('#Category_form')[0]);
      if(action_type == 1){

        $.ajax({
                url : '/admin/recommended-product-save',
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {
                  $('#saveCat').attr('disabled',false);
                    $("#Category_form")[0].reset();
                     $('#attribute_model').modal('hide');
                     $('.zero-configuration').load(location.href+' .zero-configuration');
                     toastr.success('Product Store Successfully', 'Successfully Save');
                },error: function (data, errorThrown) {
                var errorData = data.responseJSON.errors;
                  $.each(errorData, function(i, obj) {
                    toastr.error(obj[0]);
                  });
                }
            });
      }else{
        $.ajax({
          url : '/admin/recommended-product-update',
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "JSON",
          success: function(data)
          {
            console.log(data);
            $('#saveCat').attr('disabled',false);
              $("#Category_form")[0].reset();
               $('#attribute_model').modal('hide');
               $('.zero-configuration').load(location.href+' .zero-configuration');
               toastr.success('Category Update Successfully', 'Successfully Update');
          },error: function (data, errorThrown) {
            var errorData = data.responseJSON.errors;
            $.each(errorData, function(i, obj) {
              toastr.error(obj[0]);
            });
          }
      });
      }

    }

    function Edit(id){
      $.ajax({
        url : '/admin/edit-recommended-product/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('#myModalLabel8').text('Update Product');
          $('#saveCat').text('Save Change');
          $('select[name=product_id]').val(data.product_id);
          $('input[name=id]').val(id);
          $('#attribute_model').modal('show');
          action_type = 2;
        }
      });
    }

    function Delete(id){
      var r = confirm("Are you sure");
        if (r == true) {
            $.ajax({
                url : '/admin/delete-recommended-product/'+id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                toastr.success('Category Delete Successfully', 'Successfully Delete');
                $('.zero-configuration').load(location.href+' .zero-configuration');
                }
            });
        }
     }



</script>
@endsection
