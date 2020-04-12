@extends('admin.app')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/editors/tinymce/tinymce.min.css">
<style>
.not_available{
  display: none !important;
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
          <div class="card-header">
            @if($role->brand_create ==1)
                <button id="open_model" data-backdrop="false" class="btn btn-success round btn-glow px-2" data-toggle="modal">Create Brand</button>
            @endif
            <div class="heading-elements">

              <ul class="list-inline mb-0">

                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>

              </ul>
            </div>
          </div>
          <div class="card-content collapse show">
            <div class="card-body card-dashboard">

              <table class="table table-striped table-bordered zero-configuration">
                <thead>
                  <tr>
                    <th>S No</th>
                    <th>Brand Name</th>
                    <th>Brand Image</th>
                     <th>Thumbnail</th>
                    <th>Status</th>
                    @if($role->brand_action ==1)
                  <th>Action</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $row)
                  <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->brand}}</td>
                    <td><img style="width: 100px;" src="{{asset('upload_brand/').'/'.$row->brand_image}}" alt=""></td>
                    <td><img style="width: 100px;" src="{{asset('brand_thumbnail/').'/'.$row->thumbnail}}" alt=""></td>

                    <td class="text-center" onclick="editCat({{$row->id}})">
                      @if($row->status == 0)
                      <i class="ft-check-circle text-success"></i>
                      @else
                      <i class="ft-slash text-danger"></i>
                      @endif
                    </td>
                    @if($role->brand_action ==1)
                    <td class="text-center" >
                      <i class="ft-edit" onclick="editCat({{$row->id}})"></i>
                    <i class="ft-trash-2" onclick="deleteCat({{$row->id}})"></i>
                    </td>
                    @endif
                  </tr>
                @endforeach
                </tbody>
                <tfoot>
                  <tr>
                        <th>S No</th>
                        <th>Brand Name</th>
                        <th>Brand Image</th>
                        <th>Thumbnail</th>
                        <th>Status</th>
                        @if($role->brand_action ==1)
                        <th>Action</th>

                        @endif
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

  <div class="modal fade text-left" id="brand_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8"
  aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary white">
          <h4 class="modal-title white" id="myModalLabel8">Create brand</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="brand_form" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id">
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Brand Name</label>
            <div class="col-md-9">
              <input type="text" class="form-control" placeholder="Enter your Brand Name"
              name="brand" id="brand">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Brand Image</label>
            <div class="col-md-9">
              <input type="hidden" name="brand_image1" id="brand_image1">
              <div id="brand_image_place"></div>
              <input type="file" class="form-control"
              name="brand_image" id="brand_image">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">thumbnail image</label>
            <div class="col-md-9">
              <input type="hidden" name="thumbnail1" id="thumbnail1">
                <div id="thumbnail_image_place"></div>
              <input type="file" class="form-control"
              name="thumbnail" id="thumbnail">
            
            </div>
          </div>

            <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Delivery Min</label>
            <div class="col-md-9">
              <input type="text" class="form-control" placeholder="Enter your Min Delivery Date"
              name="delivery_from" id="delivery_from">
            </div>
          </div>

            <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Delivery Max</label>
            <div class="col-md-9">
              <input type="text" class="form-control" placeholder="Enter your Max Delivery Date"
              name="delivery_to" id="delivery_to">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Important Notes</label>
            <div class="col-md-9">
              <textarea name="notes" class="form-control" id="notes" cols="30" rows="10" ></textarea>
            
            </div>
          </div>

            <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput6">Order type</label>
                <div class="col-md-9">
                  <select name="order_type" class="form-control" id="order_type">
                    <option selected="" disabled>Select </option>
                     <option value="0">QTY</option>
                    <option value="1">Weight</option>
                    <option value="2">Price</option>
                    <option value="3">LIT</option>
                  </select>
                </div>
              </div>
            {{-- <div class="form-group row not_available" id="order_unit_type">
                <label class="col-md-3 label-control" for="projectinput6">Order Unit Type</label>
                <div class="col-md-9">
                  <select name="order_unit_type" class="form-control">
                    <option selected="" disabled>Select </option>
                     <option value="0">Basic Qty</option>
                  @foreach($units as $unit)
                  <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
                  @endforeach
                  </select>
                </div>
              </div> --}}
              
            <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Order Limit Value</label>
            <div class="col-md-9">
              <input type="text" class="form-control" placeholder="Enter Ordere Limit Value"
              name="order_limit" id="order_limit">
            </div>
          </div>
              <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput6">Free Shipping Type</label>
                <div class="col-md-9">
                  <select name="free_shipping_type" class="form-control" id="free_shipping_type">
                    <option selected="" disabled>Select </option>
                    <option value="0">QTY</option>
                    <option value="1">Weight</option>
                    <option value="2">Price</option>
                    <option value="3">LIT</option>
                  </select>
                </div>
              </div>
            <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Free Shipping</label>
            <div class="col-md-9">
              <input type="text" class="form-control" placeholder="Enter Ordere Limit Value"
              name="free_shipping" id="free_shipping">
            </div>
          </div>
            <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Paid Shipping Base Value</label>
            <div class="col-md-9">
              <input type="text" class="form-control" placeholder="Enter Ordere Limit Value"
              name="paid_base" id="paid_base">
            </div>
          </div>
              <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput6">Paid Shipping Depand on</label>
                <div class="col-md-9">
                  <select name="paid_type" class="form-control" id="paid_type">
                    <option selected="" disabled>Select </option>
                    <option value="0">QTY</option>
                    <option value="1">Weight</option>
                    <option value="2">Price</option>
                    <option value="3">LIT</option>
                  </select>
                </div>
              </div>
                  <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Paid Shipping Value</label>
            <div class="col-md-9">
              <input type="text" class="form-control" placeholder="Enter Ordere Limit Value"
              name="paid_value" id="paid_value">
            </div>
          </div>
            <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Description</label>
            <div class="col-md-9">
              <textarea name="description" class="form-control tinymce" id="description" cols="30" rows="10" ></textarea>
            
            </div>
          </div>
          <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput6">Brand Status</label>
                <div class="col-md-9">
                  <select name="status" class="form-control">
                    <option selected="" value="0">Active</option>
                    <option value="1">Deactive</option>
                  </select>
                </div>
              </div>

        </div>
        </form>
        <div class="modal-footer">
          <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-outline-primary" onclick="saveBrand()" id="saveCat">Save</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('extra-js')

<script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
<script src="../../../app-assets/vendors/js/editors/tinymce/tinymce.js" type="text/javascript"></script>
<script src="../../../app-assets/js/scripts/editors/editor-tinymce.js" type="text/javascript"></script>

  <script src="../../../app-assets/js/scripts/tables/datatables/datatable-basic.js"
  type="text/javascript"></script>
<script>
    $('.brand-menu').addClass('active');
  var action_type;
  $('#open_model').click(function(){
     $('#order_unit_type').addClass('not_available');
    $('#brand_model').modal('show');
    $("#brand_form")[0].reset();
    $('#thumb_set').remove();
    $('#brand_set').remove();
    action_type = 1;
    $('#saveCat').text('Save');
    $('#myModalLabel8').text('Create Brand');
  })
    function saveBrand(){
    
      var formData = new FormData($('#brand_form')[0]);
        var description = tinyMCE.activeEditor.getContent();
        formData.append('description', description);
      if(action_type == 1){

        $.ajax({
                url : '/admin/add-brand',
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {

                    $("#brand_form")[0].reset();
                     $('#brand_model').modal('hide');
                     $('.zero-configuration').load(location.href+' .zero-configuration');
                     toastr.success('Brand Store Successfully', 'Successfully Save');
                },error: function (data) {
                    console.log(data)
                  toastr.error('Brand Name Required', 'Required!');
              }
            });
      }else{
        $.ajax({
          url : '/admin/update-brand',
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "JSON",
          success: function(data)
          {
            console.log(data);
              $("#brand_form")[0].reset();
               $('#brand_model').modal('hide');
               $('.zero-configuration').load(location.href+' .zero-configuration');
               toastr.success('Brand Update Successfully', 'Successfully Update');
          },error: function (data) {
            toastr.error('Brand Name Required', 'Required!');
        }
      });
      }

    }

    function editCat(id){
       $('#order_unit_type').addClass('not_available');
$('#thumb_set').remove();
$('#brand_set').remove();
      $.ajax({
        url : '/admin/edit_brand/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          if(data.thumbnail != null){
          let thumbnail = '<div id="thumb_set"><i class="ft-minus-circle text-danger" style="cursor:pointer" onclick="removeThumbnail('+data.id+')"></i>'+
          '<img src="/brand_thumbnail/'+data.thumbnail+'" width="100px"></div><br>';
          $('#thumbnail_image_place').html(thumbnail)
          }
          if(data.brand_image != null){
          let brand_image = '<div id="brand_set"><i class="ft-minus-circle text-danger" style="cursor:pointer" onclick="removeBrandImage('+data.id+')"></i>'+
          '<img src="/upload_brand/'+data.brand_image+'" width="100px"></div><br>';
          $('#brand_image_place').html(brand_image);

          }
          $('#myModalLabel8').text('Update brand');
          $('#saveCat').text('Save Change');
          $('input[name=brand]').val(data.brand);
          $('input[name=free_shipping]').val(data.free_shipping);
          $('input[name=paid_base]').val(data.paid_base);
          $('input[name=paid_value]').val(data.paid_value);
          $('input[name=brand_image1]').val(data.brand_image);
          $('input[name=delivery_to]').val(data.delivery_to);
          $('input[name=delivery_from]').val(data.delivery_from);
          $('#notes').val(data.notes);
          $('input[name=id]').val(id);
          $('input[name=order_limit]').val(data.order_limit);
          if(data.description){

          tinyMCE.activeEditor.setContent(data.description);
          }
          //$('#description').val();
          $('select[name=status]').val(data.status);
          $('select[name=free_shipping_type]').val(data.free_shipping_type);
          $('select[name=order_type]').val(data.order_type);
          if(data.order_type == 1){
             $('#order_unit_type').removeClass('not_available');
          $('select[name=order_unit_type]').val(data.order_unit_type);
          }
          $('select[name=paid_type]').val(data.paid_type);
          $('#brand_model').modal('show');
          action_type = 2;
        }
      });
    }
     function deleteCat(id){
      var r = confirm("Are you sure");
      if (r == true) {
      $.ajax({
        url : '/admin/delete_brand/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success('Brand Delete Successfully', 'Successfully Delete');
          $('.zero-configuration').load(location.href+' .zero-configuration');
        }
      });
    }
     }
     function removeThumbnail(id){
       $.ajax({
        url : '/admin/delete_brand_image/'+id+'/2',
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
           $('#brand_model').modal('hide');
           toastr.success(data.message);
          location.reload();
        }
      });
      
     }

    function removeBrandImage(id){
   $.ajax({
        url : '/admin/delete_brand_image/'+id+'/1',
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
           $('#brand_model').modal('hide');
           toastr.success(data.message);
          location.reload();
        }
      });
}
// $('#order_type').change(function(){
//   var types = $(this).val();
//   if(types == "1"){
//     $('#order_unit_type').removeClass('not_available');
//   }else{
//     $('#order_unit_type').addClass('not_available');
//   }
// })
</script>
@endsection
