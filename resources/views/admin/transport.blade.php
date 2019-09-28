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
            @if($role->transport_create ==1)
                <button id="open_model" data-backdrop="false" class="btn btn-success round btn-glow px-2" data-toggle="modal">Create vehicle</button>
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
                    <th>vehicle Name</th>                   
                    <th>Per Kmpl Price</th>
                    <th>vehicle Image</th>                   
                    <th>Other Rate</th>
                    @if($role->transport_edit ==1)
                    <th>Edit</th>
                    @endif
                    @if($role->transport_delete ==1)
                    <th>Delete</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                    <?php $x=1 ?>
                  @foreach($transport as $row)
                  <tr>
                    <td>{{$x}}</td>
                    <td style="text-align:center;font-weight:700">{{$row->vehicle_name}}</td>
                    <td style="text-align:center;font-weight:700">₹ {{$row->price}}</td>
                    <td><img style="width: 100px;" src="{{asset('transport/').'/'.$row->vehicle_image}}" alt=""></td>
                    
                    <td style="text-align:center;font-weight:700">₹ {{$row->other}}</td>
                    @if($role->transport_edit ==1)
                    <td class="text-center" onclick="editCat({{$row->id}})"><i class="ft-edit"></i></td>
                    @endif
                    @if($role->transport_delete ==1)
                    <td class="text-center" onclick="deleteCat({{$row->id}})"><i class="ft-trash-2"></i></td>
                    @endif
                  </tr>

                  <?php $x++?>
                @endforeach
                </tbody>
                <tfoot>
                  <tr>
                       <th>S No</th>
                    <th>vehicle Name</th>                   
                    <th>Per Kmpl Price</th>
                    <th>vehicle Image</th>   
                    <th>Other Rate</th>     
                    @if($role->transport_edit ==1)           
                    <th>Edit</th>
                    @endif
                    @if($role->transport_delete ==1)
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

  <div class="modal fade text-left" id="brand_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8"
  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary white">
          <h4 class="modal-title white" id="myModalLabel8">Create vehicle</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="brand_form" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id">
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">vehicle Name</label>
            <div class="col-md-9">
              <input type="text" class="form-control" placeholder="Enter your vehicle Name"
              name="vehicle_name" id="vehicle_name">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Per Kmpl Price</label>
            <div class="col-md-9">
              <input type="text" class="form-control" placeholder="Enter kmpl price"
              name="price" id="price">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Other Rate</label>
            <div class="col-md-9">
              <input type="text" class="form-control" placeholder="Enter Other Rate"
              name="other_rate" id="other_rate">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Vehicle Capacity</label>
            <div class="col-md-9">
              <input type="text" class="form-control" placeholder="Enter Capacity in Kg"
              name="capacity" id="capacity">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">vehicle Image</label>
            <div class="col-md-9">
              <input type="hidden" name="vehicle_image1" id="vehicle_image1">
              <input type="file" class="form-control" placeholder="Enter your vehicle"
              name="vehicle_image" id="vehicle_image">
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
   $('.transports').addClass('active');
  var action_type;
  $('#open_model').click(function(){
    $('#brand_model').modal('show');
    $("#brand_form")[0].reset();
    action_type = 1;
    $('#saveCat').text('Save');
    $('#myModalLabel8').text('Create vehicle');
  })
    function saveBrand(){
      var formData = new FormData($('#brand_form')[0]);
      if(action_type == 1){

        $.ajax({
                url : '/admin/save-transport',
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
                  
                  toastr.error('Brand Name Required', 'Required!');
              }
            });
      }else{
        $.ajax({
          url : '/admin/update-transport',
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
      
      $.ajax({
        url : '/admin/edit-transport/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('#myModalLabel8').text('Update brand');
          $('#saveCat').text('Save Change');
          $('input[name=vehicle_name]').val(data.vehicle_name);
          $('input[name=price]').val(data.price);
          $('input[name=vehicle_image1]').val(data.vehicle_image);
          $('input[name=other_rate]').val(data.other);
          $('input[name=capacity]').val(data.capacity);
          $('input[name=id]').val(id);
          $('#brand_model').modal('show');
          action_type = 2;
        }
      });
    }
     function deleteCat(id){
      var r = confirm("Are you sure");
      if (r == true) {
      $.ajax({
        url : '/admin/delete-transport/'+id,
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
    
</script>
@endsection