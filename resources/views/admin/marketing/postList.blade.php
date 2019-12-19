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
         
          <div class="card-content collapse show">
            <div class="card-body card-dashboard">

              <table class="table table-striped table-bordered zero-configuration">
                <thead>
                  <tr>
                    <th>S No</th>
                    <th>Post Title</th>
                    <th>Post Image</th>
                     <th>Sent Type</th>
                     <th>Status</th>
                    
                   
                  <th>Action</th>
                   
                  </tr>
                </thead>
                <tbody>
                  @foreach($lists as $row)
                  <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->title}}</td>
                    <td><img style="width: 100px;" src="{{asset('post_image/').'/'.$row->image}}" alt=""></td>
                    <td class="text-center">
                      @if($row->send_type == 0)
                      All Contact
                      @else
                      Custom Contact
                      @endif
                    </td>
                    <td class="text-center">
                      @if($row->status == 0)
                      Post Not Sent
                      @else
                     Sent Successfully
                      @endif
                    </td>
                  
                    <td class="text-center" >
                        <a href="/admin/update-post/{{$row->id}}"><i class="ft-edit"></i></a>
                        <a href="javascript:void(null)"><i class="ft-trash-2" onclick="deletePost({{$row->id}})"></i></a>
                      
                    
                    </td>

                  </tr>
                @endforeach
                </tbody>
                <tfoot>
                  <tr>
                       <th>S No</th>
                    <th>Post Title</th>
                    <th>Post Image</th>
                     <th>Sent Type</th>
                     <th>Status</th>
                    
                        
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

@endsection
@section('extra-js')

<script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>

  <script src="../../../app-assets/js/scripts/tables/datatables/datatable-basic.js"
  type="text/javascript"></script>
<script>
    $('.marketing-list').addClass('active');
  
     function deletePost(id){
      var r = confirm("Are you sure");
      if (r == true) {
      $.ajax({
        url : '/admin/delete-post/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success(data.message);
          $('.zero-configuration').load(location.href+' .zero-configuration');
        }
      });
    }
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
