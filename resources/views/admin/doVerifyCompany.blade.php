@extends('admin.app')
@section('extra-css')
@endsection
@section('section')
<div class="content-wrapper">
    <div class="content-body">     
        <form class="form form-horizontal">
            <div class="form-body">
              <h4 class="form-section"><i class="ft-user"></i> Personal Info</h4>
              <?php echo $output; ?>
            </div>
            <div class="form-actions">
              <button type="button" onclick="reject({{$company->id}})" class="btn btn-warning mr-1">
                <i class="ft-x"></i> Reject
              </button>
              <button type="button" onclick="approval({{$company->id}})" class="btn btn-success">
                <i class="la la-check-square-o"></i> Approval
              </button>
            </div>
          </form> 

    </div>
</div>


@endsection
@section('extra-js')
<script>
    
function reject(id){
  $.ajax({
        url : '/admin/reject/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success('Successfully Reject Form'); 
          window.location.href = "/admin/verify-company";
        }
      });
}
function approval(id){
  $.ajax({
        url : '/admin/approval/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success('Successfully Approved');
          window.location.href = "/admin/verify-company";
        }
      });
}
</script>
@endsection