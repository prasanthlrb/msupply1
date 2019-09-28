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
                <button id="open_model" data-backdrop="false" class="btn btn-success round btn-glow px-2" data-toggle="modal">Create Unit</button>

          </div>
          <div class="card-content collapse show">
            <div class="card-body card-dashboard">

              <table class="table table-striped table-bordered zero-configuration">
                <thead>
                  <tr>
                    <th>S No</th>
                    <th>Unit Name</th>
                    <th>Edit</th>

                    <th>Delete</th>

                  </tr>
                </thead>
                <tbody>
                  @foreach($units as $row)
                  <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->unit_name}}</td>
                    <td class="text-center" onclick="editCat({{$row->id}})"><i class="ft-edit"></i></td>

                    <td class="text-center" onclick="deleteCat({{$row->id}})"><i class="ft-trash-2"></i></td>

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

  <div class="modal fade text-left" id="unit_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8"
  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary white">
          <h4 class="modal-title white" id="myModalLabel8">Create Unit</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="unit_form" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id">
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Unit Name</label>
            <div class="col-md-9">
              <input type="text" class="form-control" placeholder="Enter your Unit Name"
              name="unit_name" id="unit_name">
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
    $('.unit-menu').addClass('active');
  var action_type;
  $('#open_model').click(function(){
    $('#unit_model').modal('show');
    $("#unit_form")[0].reset();
    action_type = 1;
    $('#saveCat').text('Save');
    $('#myModalLabel8').text('Create Unit');
  })
    function saveBrand(){
      var formData = new FormData($('#unit_form')[0]);
      if(action_type == 1){

        $.ajax({
                url : '/admin/add-unit',
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {

                    $("#unit_form")[0].reset();
                     $('#unit_model').modal('hide');
                     $('.zero-configuration').load(location.href+' .zero-configuration');
                     toastr.success('Unit Store Successfully', 'Successfully Save');
                },error: function (data) {
                    console.log(data)
                  toastr.error('Unit Name Required', 'Required!');
              }
            });
      }else{
        $.ajax({
          url : '/admin/update-unit',
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "JSON",
          success: function(data)
          {
            console.log(data);
              $("#unit_form")[0].reset();
               $('#unit_model').modal('hide');
               $('.zero-configuration').load(location.href+' .zero-configuration');
               toastr.success('Unit Update Successfully', 'Successfully Update');
          },error: function (data) {
            toastr.error('Unit Name Required', 'Required!');
        }
      });
      }

    }

    function editCat(id){

      $.ajax({
        url : '/admin/edit-unit/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('#myModalLabel8').text('Update Unit');
          $('#saveCat').text('Save Change');
          $('input[name=unit_name]').val(data.unit_name);
          $('input[name=id]').val(id);
          $('#unit_model').modal('show');
          action_type = 2;
        }
      });
    }
     function deleteCat(id){
      var r = confirm("Are you sure");
      if (r == true) {
      $.ajax({
        url : '/admin/delete-unit/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success('Unit Delete Successfully', 'Successfully Delete');
          $('.zero-configuration').load(location.href+' .zero-configuration');
        }
      });
    }
     }

</script>
@endsection
