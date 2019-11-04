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
           
                <button id="open_model" data-backdrop="false" class="btn btn-success round btn-glow px-2" data-toggle="modal">Create Location</button>
    
          </div>
          <div class="card-content collapse show">
            <div class="card-body card-dashboard">

              <table class="table table-striped table-bordered zero-configuration">
                <thead>
                  <tr>
                    <th>S No</th>
                    <th>Location Name</th>
                    <th>Cash on Delivery</th>
                  <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($loc as $row)
                  <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->location_name}}</td>
                    <td>
                      @if($row->cod == 0)
                      Available
                      @else
                      Not Available
                      @endif
                    </td>
                    <td class="text-center" >
                      <i class="ft-edit" onclick="editCat({{$row->id}})"></i>
                    <i class="ft-trash-2" onclick="deleteCat({{$row->id}})"></i>
                    </td>
                  </tr>
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

  <div class="modal fade text-left" id="brand_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8"
  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary white">
          <h4 class="modal-title white" id="myModalLabel8">Create Location</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="brand_form" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id">
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Location Name</label>
            <div class="col-md-9">
              <input type="text" class="form-control" placeholder="Enter Location Name"
              name="location_name" id="location_name">
            </div>
          </div>
                <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput6">COD Available</label>
                <div class="col-md-9">
                  <select name="cod" class="form-control">
                    <option selected="" value="0">Available</option>
                    <option value="1">Not Available</option>
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


  <script src="../../../app-assets/js/scripts/tables/datatables/datatable-basic.js"
  type="text/javascript"></script>
<script>
    $('.location-menu').addClass('active');
  var action_type;
  $('#open_model').click(function(){
    $('#brand_model').modal('show');
    $("#brand_form")[0].reset();
    action_type = 1;
    $('#saveCat').text('Save');
    $('#myModalLabel8').text('Create Location');
  })
    function saveBrand(){
      var formData = new FormData($('#brand_form')[0]);
      if(action_type == 1){

        $.ajax({
                url : '/admin/add-location',
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
                     toastr.success(data.message);
                },error: function (data) {
                  toastr.error('Location Name Required', 'Required!');
              }
            });
      }else{
        $.ajax({
          url : '/admin/update-location',
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
               toastr.success(data.message);
          },error: function (data) {
            toastr.error('Location Name Required', 'Required!');
        }
      });
      }

    }

    function editCat(id){
      $.ajax({
        url : '/admin/edit_location/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
         
        
          $('#myModalLabel8').text('Update Location');
          $('#saveCat').text('Save Change');
          $('input[name=location_name]').val(data.location_name);
          $('input[name=id]').val(id);
           $('select[name=cod]').val(data.cod);
          $('#brand_model').modal('show');
          action_type = 2;
        }
      });
    }
     function deleteCat(id){
      var r = confirm("Are you sure");
      if (r == true) {
      $.ajax({
        url : '/admin/delete_location/'+id,
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
     
</script>
@endsection
