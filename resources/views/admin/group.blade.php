@extends('admin.app')
@section('extra-css')
  <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
 
  
@endsection
@section('section')
<div class="content-wrapper">

    <div class="content-body">
     
   
<section id="column-selectors">
    <div class="row">
      <div class="col-12">
        
        <div class="card">
          <div class="card-header">
              @if($role->attribute_set_create)
                <button id="open_model" data-backdrop="false" class="btn btn-success round btn-glow px-2" data-toggle="modal">Create Group Product Name</button>
            @endif
            
          </div>
          <div class="card-content collapse show">
            <div class="card-body card-dashboard">
             
              <table class="table table-striped table-bordered zero-configuration">
                <thead>
                  <tr>
                    <th>S No</th>
                    <th>Group Name</th>
                    @if($role->attribute_set_edit)
                    <th>Edit</th>
                    @endif
                    @if($role->attribute_set_delete)
                    <th>Delete</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                  @foreach($product_group as $row)
                  <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->group}}</td>
                    @if($role->attribute_set_edit)
                    <td class="text-center" onclick="Edit({{$row->id}})"><i class="ft-edit"></i></td>
                    @endif
                    @if($role->attribute_set_delete)
                    <td class="text-center" onclick="Delete({{$row->id}})"><i class="ft-trash-2"></i></td>
                    @endif
                  </tr>
                @endforeach
                </tbody>
                <tfoot>
                  <tr>
                        <th>S No</th>
                        <th>Group Name</th>
                        @if($role->attribute_set_edit)
                        <th>Edit</th>
                        @endif
                        @if($role->attribute_set_delete)
                        <th>Delete</th>
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

  <div class="modal fade text-left" id="category_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8"
  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary white">
          <h4 class="modal-title white" id="myModalLabel8">Create Category</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id">
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Group Name</label>
            <div class="col-md-9">
              <input type="text" id="group" class="form-control" placeholder="Enter your Category Name"
              name="group">
            </div>
          </div>
      
          
        </div>
        </form>
        <div class="modal-footer">
          <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-outline-primary" onclick="Save()" id="saveCat">Save</button>
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
    $('.attributeSet-menu').addClass('active');
  var action_type;
  $('#open_model').click(function(){
    $('#category_model').modal('show');
    action_type = 1;
    $('#saveCat').text('Save');
    $("#form")[0].reset();
    $('#myModalLabel8').text('Create Group');
  })
    function Save(){
      var formData = new FormData($('#form')[0]);
      if(action_type == 1){

        $.ajax({
                url : '/admin/saveGroup',
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {                
                    $("#form")[0].reset();
                     $('#category_model').modal('hide');
                     $('.zero-configuration').load(location.href+' .zero-configuration');
                     toastr.success('Group Store Successfully', 'Successfully Save');
                },error: function (data) {
                toastr.error('Group Name Required', 'Required!');
                //toastr.error(data.responseJSON.errors.cat_name);
              }
            });
      }else{
        $.ajax({
          url : '/admin/updateGroup',
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "JSON",
          success: function(data)
          {
            console.log(data);
              $("#form")[0].reset();
               $('#category_model').modal('hide');
               $('.zero-configuration').load(location.href+' .zero-configuration');
               toastr.success('Category Update Successfully', 'Successfully Update');
          },error: function (data) {
            toastr.error('Category Name Required', 'Required!');
        }
      });
      }
      
    }

    function Edit(id){
      
      $.ajax({
        url : '/admin/editGroup/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('#myModalLabel8').text('Update Group');
          $('#saveCat').text('Save Change');
          $('input[name=group]').val(data.group);
          $('input[name=id]').val(id);
          $('#category_model').modal('show');
          action_type = 2;
        }
      });
    }
     function Delete(id){
      var r = confirm("Are you sure");
      if (r == true) {
      $.ajax({
        url : '/admin/deleteGroup/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success('Group Delete Successfully', 'Successfully Delete');
          $('.zero-configuration').load(location.href+' .zero-configuration');
        }
      });
    } 
     }
    
</script>
@endsection