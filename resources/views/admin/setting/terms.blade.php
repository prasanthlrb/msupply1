@extends('admin.app')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/miniColors/jquery.minicolors.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/spectrum/spectrum.css">
  <!-- END VENDOR CSS-->
  <!-- BEGIN MODERN CSS-->
  <link rel="stylesheet" type="text/css" href="../../../app-assets/css/app.css">
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/pickers/colorpicker/colorpicker.css">
@endsection
@section('section')
<div class="content-wrapper">

    <div class="content-body">
     
   
<section id="column-selectors">
    <div class="row">
      <div class="col-12">
        
        <div class="card">
          <div class="card-header">
            
                <button id="open_model" data-backdrop="false" class="btn btn-success round btn-glow px-2" data-toggle="modal">Create Terms</button>
                <a href="/admin/attribute" class="btn btn-primary round btn-glow px-2 float-right"><i class="ft-arrow-left"></i> Back to Attribute</a>

          </div>
          <div class="card-content collapse show">
            <div class="card-body card-dashboard">
             
              <table class="table table-striped table-bordered zero-configuration">
                <thead>
                  <tr>
                    <th>S No</th>
                    <th>Terms Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                 
                @foreach($terms as $row)
                  <tr>
                    <td>{{$row->id}}</td>
                    <td><?php if($attribute['type'] == "1"){ ?>
                      <span style="color:{{$row->color_code}};font-weight:bold;">{{$row->terms_name}}</span>
                    <?php } else{ ?>
                      {{$row->terms_name}}
                     <?php } ?>
                    </td>
                    <td class="text-center" onclick="Edit({{$row->id}})"><i class="ft-edit"></i></td>
                    <td class="text-center" onclick="Delete({{$row->id}})"><i class="ft-trash-2"></i></td>
                  </tr>
                @endforeach 
               
                </tbody>
                <tfoot>
                  <tr>
                      <th>S No</th>
                      <th>Terms Name</th>
                      <th>Edit</th>
                      <th>Delete</th>
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

  <div class="modal fade text-left" id="terms_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8"
  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary white">
          <h4 class="modal-title white" id="myModalLabel8">Create Terms</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="terms_form" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id">
            <input type="hidden" value="<?php echo $attribute['id']; ?>" name="attribute_id" id="attribute_id">
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1"> Name</label>
            <div class="col-md-9">
              <input type="text" id="cat_name" class="form-control" placeholder="Enter your Terms Name"
              name="cat_name">
            </div>
          </div>
          <?php if($attribute['type'] == "1"){ ?>
            <div class="form-group row">
              <label class="col-md-3 label-control" for="wheel-demo">Select color</label>
              <div class="col-md-9">
              <input type="text" id="color_code" name="color_code" class="form-control minicolors" data-control="wheel"
              value="#ff99ee">
            </div>
          </div>
           <?php } ?>
       
        </div>
        </form>
        <div class="modal-footer">
          <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-outline-primary" onclick="saveTerms()" id="saveCat">Save</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('extra-js')

<script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
<script src="../../../app-assets/vendors/js/pickers/miniColors/jquery.minicolors.min.js"
type="text/javascript"></script>
<script src="../../../app-assets/vendors/js/pickers/spectrum/spectrum.js" type="text/javascript"></script>
<script src="../../../app-assets/js/scripts/pickers/colorpicker/picker-color.js"
type="text/javascript"></script>
  <script src="../../../app-assets/js/scripts/tables/datatables/datatable-basic.js"
  type="text/javascript"></script>
<script>
  var action_type;
  $('#open_model').click(function(){
    $('#terms_model').modal('show');
    action_type = 1;
    $('#saveCat').text('Save');
    $('#myModalLabel8').text('Create Category');
  })
    function saveTerms(){
      var formData = new FormData($('#terms_form')[0]);
      if(action_type == 1){

        $.ajax({
                url : '/admin/termsSave',
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {                
                 
                    $("#terms_form")[0].reset();
                     $('#terms_model').modal('hide');
                     $('.zero-configuration').load(location.href+' .zero-configuration');
                     toastr.success('Category Store Successfully', 'Successfully Save');
                },error: function (data, errorThrown) {
            var errorData = data.responseJSON.errors;
            $.each(errorData, function(i, obj) {
              toastr.error(obj[0]);
            });
          }
            });
      }else{
        $.ajax({
          url : '/admin/termsUpdate',
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "JSON",
          success: function(data)
          {
            console.log(data);
              $("#terms_form")[0].reset();
               $('#terms_model').modal('hide');
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
        url : '/admin/termsEdit/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('#myModalLabel8').text('Update Category');
          $('#saveCat').text('Save Change');
          $('input[name=cat_name]').val(data.terms_name);
          $('input[name=attribute_id]').val(data.attribute_id);
          $('input[name=id]').val(id);
          $('input[name=color_code]').val(data.color_code);
          $('#terms_model').modal('show');
          action_type = 2;
        }
      });
    }
  function Delete(id){
      var r = confirm("Are you sure");
      if (r == true) {
      $.ajax({
        url : '/admin/termsDelete/'+id,
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