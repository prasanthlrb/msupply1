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
            @if($roles->role_create ==1)
                <a href="/admin/add-role" class="btn btn-success round btn-glow px-2">Create Role</a>
            @endif
            
          </div>
          <div class="card-content collapse show">
            <div class="card-body card-dashboard">
             
              <table class="table table-striped table-bordered zero-configuration">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Role</th>
                    {{-- @if($role_get->role_edit_delete == 'on') --}}
                    @if($roles->role_edit ==1)
                    <th>Edit</th>
                    @endif
                    @if($roles->role_delete ==1)
                    <th>Delete</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                @php ($x = 0) @endphp
                @foreach($role as $row)
                @php $x++ @endphp
                  <tr>
                    <td>{{$x}}</td>
                    <td>{{$row->role_name}}</td>
                    {{-- @if($role_get->role_edit_delete == 'on') --}}
                    @if($roles->role_edit ==1)
                    <td class="text-center" onclick="Edit({{$row->id}})"><i class="ft-edit"></i></td>
                    @endif
                    @if($roles->role_delete ==1)
                    <td class="text-center" onclick="Delete({{$row->id}})"><i class="ft-trash-2"></i></td>
                    @endif
                  </tr>
                @endforeach 
                </tbody>
                <tfoot>
                  <tr>
                    <th>S.No</th>
                    <th>Role</th>
                    {{-- @if($role_get->role_edit_delete == 'on') --}}
                    @if($roles->role_edit ==1)
                    <th>Edit</th>
                    @endif
                    @if($roles->role_delete ==1)
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

@endsection
@section('extra-js')
<script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>

 
  <script src="../../../app-assets/js/scripts/tables/datatables/datatable-basic.js"
  type="text/javascript"></script>

  <script>

      $('.roles').addClass('active');
function Edit(id){
    window.location.href = "/admin/role-edit/"+id;
}
function Delete(id){
  var r = confirm("Are you sure");
  if (r == true) {
    $.ajax({
      url : '/admin/role-delete/'+id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        toastr.success('Role Delete Successfully', 'Successfully Delete');
        $('.zero-configuration').load(location.href+' .zero-configuration');
      }
    });
  } 
}
  
</script>


@endsection