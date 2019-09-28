@extends('admin.app')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
@endsection
@section('section')
<div class="content-wrapper">
<div class="content-body">
        <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
              
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a>
                </li>
               
               
              <li class="breadcrumb-item">User
                </li>
               
              </ol>
            </div>
          </div>
   <br>
<section id="column-selectors">
    <div class="row">
      <div class="col-12">
        
        <div class="card">
          <div class="card-header">
            @if($roles->user_create ==1)
                <button id="open_model" data-backdrop="false" class="btn btn-success round btn-glow px-2" data-toggle="modal">Create User</button>
          @endif
              </div>
          <div class="card-content collapse show">
            <div class="card-body card-dashboard">
        <table class="table table-striped table-bordered zero-configuration">
            <thead>
              <tr>
                <th>S No</th>
                <th>Employee Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                @if($roles->user_action ==1)
                <th>Action</th>
                @endif
              </tr>
            </thead>
            <tbody>
             <?php $x=1?>
            @foreach($emp as $row)
            <tr>
            <td>{{$x}}</td>
            <td>{{$row->emp_name}}</td>
            <td>{{$row->email}}</td>
            <td>{{$row->phone}}</td>
            <td>{{$row->role_name}}</td>
            @if($roles->user_action ==1)
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
                @endif
            </tr>
            <?php $x++?>
              @endforeach
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

<div class="modal fade text-left" id="attribute_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8"
aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header bg-primary white">
    <h4 class="modal-title white" id="myModalLabel8">Create User</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <form id="user_form" method="post">
      {{ csrf_field() }}
      <input type="hidden" name="id">
  <div class="modal-body">
    <div class="form-group row">
      <label class="col-md-3 label-control" for="projectinput1">Employee Name</label>
      <div class="col-md-9">
        <input type="text" id="emp_name" class="form-control" placeholder="Enter Employee Name"
        name="emp_name">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-md-3 label-control" for="projectinput1">E-mail</label>
      <div class="col-md-9">
        <input type="text" id="email" class="form-control" placeholder="Enter Email"
        name="email">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-md-3 label-control" for="projectinput1">Phone</label>
      <div class="col-md-9">
        <input type="text" id="phone" class="form-control" placeholder="Enter your Phone Number"
        name="phone">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-md-3 label-control" for="projectinput1" id="labelPassword">Password</label>
      <div class="col-md-9">
        <input type="text" id="password" class="form-control" placeholder="Enter your Password"
        name="password">
      </div>
    </div>
    <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput6">Select Role</label>
            <div class="col-md-9">
              <select name="role_id" class="form-control select2">
                <option selected="" value="" disabled>Select Role</option>
                @foreach($role as $row)
              <option value="{{$row->id}}">{{$row->role_name}}</option>
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

 
  <script src="../../../app-assets/js/scripts/tables/datatables/datatable-basic.js"
  type="text/javascript"></script>
<script>
  $('.employee').addClass('active');
  var action_type; // the action type used to from data Save And Update
  $('#open_model').click(function(){
    $('#attribute_model').modal('show');
    $("#user_form")[0].reset();
    $('#prevImage').attr('src', '');
    action_type = 1;
    $('#saveCat').text('Save');
    $('#myModalLabel8').text('Create User');
  });


    function saveAttr(){
      $('#saveCat').attr('disabled',true);
      var formData = new FormData($('#user_form')[0]);
      if(action_type == 1){
      
        $.ajax({
                url : '/admin/employee-save',
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {                
                  $('#saveCat').attr('disabled',false);
                    $("#user_form")[0].reset();
                     $('#attribute_model').modal('hide');
                     $('.zero-configuration').load(location.href+' .zero-configuration');
                     toastr.success('User Store Successfully', 'Successfully Save');
                },error: function (data, errorThrown) {
                var errorData = data.responseJSON.errors;
                  $.each(errorData, function(i, obj) {
                    toastr.error(obj[0]);
                  });
                }
            });
      }else{
        $.ajax({
          url : '/admin/employee-update',
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "JSON",
          success: function(data)
          {
            $('#saveCat').attr('disabled',false);
              $("#user_form")[0].reset();
               $('#attribute_model').modal('hide');
               $('.zero-configuration').load(location.href+' .zero-configuration');
               toastr.success('User Update Successfully', 'Successfully Update');
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
        url : '/admin/edit-employee/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('#myModalLabel8').text('Update User');
          $('#saveCat').text('Save Change');
          $('input[name=emp_name]').val(data.emp_name);
          $('input[name=email]').val(data.email);
          $('input[name=phone]').val(data.phone);
          $('select[name=role_id]').val(data.role_id);
          $('input[name=id]').val(id);
          $('#labelPassword').text('New Password');
          $('#attribute_model').modal('show');
          action_type = 2;
        }
      });
    }
     function Delete(id){
      var r = confirm("Are you sure");
      if (r == true) {
      $.ajax({
        url : '/admin/delete-employee/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success('User Delete Successfully', 'Successfully Delete');
          $('.zero-configuration').load(location.href+' .zero-configuration');
        }
      });
    } 
     }
</script>
@endsection