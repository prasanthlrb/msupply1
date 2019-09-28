@extends('admin.app')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/vendors.css">
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
              @if($role->attribute_create ==1)
                <button id="open_model" data-backdrop="false" class="btn btn-success round btn-glow px-2" data-toggle="modal">Create Attribute</button>
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
                    <th>Name</th>
                    <th>Type</th>
                    @if($role->attribute_terms ==1)
                    <th>Terms</th>
                    @endif
                    @if($role->attribute_edit ==1)
                    <th>Edit</th>
                    @endif
                    @if($role->attribute_delete ==1)
                    <th>Delete</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                @foreach($attribute as $row)
                  <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->name}}</td>
                    <td><?php
                    if($row->type=="0"){ ?>
                      select
                    <?php }elseif($row->type=="1"){ ?>
                      color
                    <?php } else{ ?>
                      label
                    <?php } ?>
                      </td>
                      @if($role->attribute_terms ==1)
                    <td class="text-center"><a href="/admin/terms/{{$row->id}}"><i class="ft-bookmark"></i>
                      <?php $x=0;?>
                      @foreach($terms as $data)
                      @if($row->id == $data->attribute_id)
                     <?php $x +=1;?>
                     @endif
                     @endforeach
                     @endif
                    ({{$x}})
                    </a></td>
                    @if($role->attribute_edit ==1)
                    <td class="text-center" onclick="Edit({{$row->id}})"><i class="ft-edit"></i></td>
                    @endif
                    @if($role->attribute_delete ==1)
                    <td class="text-center" onclick="Delete({{$row->id}})"><i class="ft-trash-2"></i></td>
                    @endif
                  </tr>
                @endforeach 
                
                  
                </tbody>
                <tfoot>
                  <tr>
                      <th>S No</th>
                      <th>Name</th>
                      <th>Type</th>
                      @if($role->attribute_terms ==1)
                      <th>Terms</th>
                      @endif
                      @if($role->attribute_edit ==1)
                      <th>Edit</th>
                      @endif
                      @if($role->attribute_delete ==1)
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

  <div class="modal fade text-left" id="attribute_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8"
  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary white">
          <h4 class="modal-title white" id="myModalLabel8">Create Attribute</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="attribute_form" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id">
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Attribute Name</label>
            <div class="col-md-9">
              <input type="text" id="attribute_name" class="form-control" placeholder="Enter your Attribute Name"
              name="attribute_name">
            </div>
          </div>
          {{-- <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput6">Select type</label>
                <div class="col-md-9">
                  <select id="type" name="type" class="form-control">
                    <option selected="" value="0">select</option>
                    <option value="1">color</option>
                    <!-- <option value="2">label</option> -->
                  
                  </select>
                </div>
              </div> --}}
          
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

 
  <script src="../../../app-assets/js/scripts/tables/datatables/datatable-basic.js"
  type="text/javascript"></script>
<script>
  $('.attribute-menu').addClass('active');
  var action_type;
  $('#open_model').click(function(){
    $('#attribute_model').modal('show');
    action_type = 1;
    $('#saveCat').text('Save');
    $('#myModalLabel8').text('Create Attribute');
  })
    function saveAttr(){
      var formData = new FormData($('#attribute_form')[0]);
      if(action_type == 1){
      
        $.ajax({
                url : '/admin/attributeSave',
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {                
                    $("#attribute_form")[0].reset();
                     $('#attribute_model').modal('hide');
                     $('.zero-configuration').load(location.href+' .zero-configuration');
                     toastr.success('Attribute Store Successfully', 'Successfully Save');
                },error: function (data, errorThrown) {
                var errorData = data.responseJSON.errors;
                  $.each(errorData, function(i, obj) {
                    toastr.error(obj[0]);
                  });
                }
            });
      }else{
        $.ajax({
          url : '/admin/attributeUpdate',
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "JSON",
          success: function(data)
          {
            console.log(data);
              $("#attribute_form")[0].reset();
               $('#attribute_model').modal('hide');
               $('.zero-configuration').load(location.href+' .zero-configuration');
               toastr.success('Attribute Update Successfully', 'Successfully Update');
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
        url : '/admin/attributeEdit/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('#myModalLabel8').text('Update Attribute');
          $('#saveCat').text('Save Change');
          $('input[name=attribute_name]').val(data.name);
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
        url : '/admin/attributeDelete/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success('Attribute Delete Successfully', 'Successfully Delete');
          $('.zero-configuration').load(location.href+' .zero-configuration');
        }
      });
    } 
     }
    
</script>
@endsection