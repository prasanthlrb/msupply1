@extends('admin.app')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
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
                <button id="open_model" data-backdrop="false" class="btn btn-success round btn-glow px-2" data-toggle="modal">Create Login Slider</button>
          </div>
          <div class="card-content collapse show">
            <div class="card-body card-dashboard">
              <table class="table table-striped table-bordered zero-configuration">
                <thead>
                  <tr>
                    <th>S No</th>
                    <th>Slider Image</th>
                  <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($slider as $row)
                  <tr>
                    <td>{{$row->id}}</td>
                    <td><img style="width: 100px;" src="{{asset('login_slider/').'/'.$row->slider_image}}" alt=""></td>
                    <td class="text-center" >
                      <i class="ft-edit" onclick="editCat({{$row->id}})"></i>
                    <i class="ft-trash-2" onclick="deleteCat({{$row->id}})"></i>
                    </td>
                  </tr>
                @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>S No</th>
                    <th>Slider Image</th>
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
  <div class="modal fade text-left" id="brand_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8"
  aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary white">
          <h4 class="modal-title white" id="myModalLabel8">Create Login Slider Image</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="brand_form" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id">
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Login Slider Image</label>
            <div class="col-md-9">
              <input type="hidden" name="slider_image1" id="slider_image1">
              <div id="brand_image_place"></div>
              <input type="file" class="form-control" name="slider_image" id="slider_image" accept="image/*">
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
  <script src="../../../app-assets/js/scripts/tables/datatables/datatable-basic.js"
  type="text/javascript"></script>
<script>
    $('.login-slider').addClass('active');
  var action_type;
  $('#open_model').click(function(){
    $('#brand_model').modal('show');
    $("#brand_form")[0].reset();
    action_type = 1;
    $('#saveCat').text('Save');
    $('#myModalLabel8').text('Create Slider Login');
  })
    function saveBrand(){
          var imageFile = $('#slider_image').val();
          console.log(imageFile);
      var formData = new FormData($('#brand_form')[0]);
      if(action_type == 1){

        $.ajax({
                url : '/admin/add-login-slider',
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {
                    console.log(data)
                    $("#brand_form")[0].reset();
                     $('#brand_model').modal('hide');
                     $('.zero-configuration').load(location.href+' .zero-configuration');
                     toastr.success('Login Slider ', 'Successfully Save');
                },error: function (data) {
                    console.log(data)
                  toastr.error('Image File', 'Required!');
              }
            });
      }else{
        $.ajax({
          url : '/admin/update-login-slider',
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
               toastr.success('Login Slider Update Successfully', 'Successfully Update');
          },error: function (data) {
            toastr.error('Image File', 'Required!');
        }
      });
      }

    }

    function editCat(id){
       $('#order_unit_type').addClass('not_available');
      $.ajax({
        url : '/admin/edit_login-slider/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
         
          if(data.slider_image != null){
          let slider_image = '<div id="brand_set"><i class="ft-minus-circle text-danger" style="cursor:pointer" onclick="removeBrandImage('+data.id+')"></i>'+
          '<img src="/login_slider/'+data.slider_image+'" width="100px"></div><br>';
          $('#brand_image_place').html(slider_image);
          }
          $('#myModalLabel8').text('Update Login Slider Image');
          $('#saveCat').text('Save Change');
          $('input[name=id]').val(data.id);
          $('#brand_model').modal('show');
          action_type = 2;
        }
      });
    }
     function deleteCat(id){
      var r = confirm("Are you sure");
      if (r == true) {
      $.ajax({
        url : '/admin/delete_login-slider/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success('Login Slider Delete Successfully', 'Successfully Delete');
          $('.zero-configuration').load(location.href+' .zero-configuration');
        }
      });
    }
     }


</script>
@endsection
