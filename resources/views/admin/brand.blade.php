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
            @if($role->brand_create ==1)
                <button id="open_model" data-backdrop="false" class="btn btn-success round btn-glow px-2" data-toggle="modal">Create Brand</button>
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
                    <th>Brand Name</th>
                    <th>Brand Image</th>
                    <th>Status</th>
                    @if($role->brand_action ==1)
                    <th>Edit</th>

                    <th>Delete</th>
                    @endif
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $row)
                  <tr>
                    <td>{{$row->id}}</td>
                    <td>{{$row->brand}}</td>
                    <td><img style="width: 100px;" src="{{asset('upload_brand/').'/'.$row->brand_image}}" alt=""></td>

                    <td class="text-center" onclick="editCat({{$row->id}})">
                      @if($row->status == 0)
                      <i class="ft-check-circle text-success"></i>
                      @else
                      <i class="ft-slash text-danger"></i>
                      @endif
                    </td>
                    @if($role->brand_action ==1)
                    <td class="text-center" onclick="editCat({{$row->id}})"><i class="ft-edit"></i></td>

                    <td class="text-center" onclick="deleteCat({{$row->id}})"><i class="ft-trash-2"></i></td>
                    @endif
                  </tr>
                @endforeach
                </tbody>
                <tfoot>
                  <tr>
                        <th>S No</th>
                        <th>Brand Name</th>
                        <th>Brand Image</th>
                        <th>Status</th>
                        @if($role->brand_action ==1)
                        <th>Edit</th>

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
          <h4 class="modal-title white" id="myModalLabel8">Create brand</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="brand_form" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id">
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Brand Name</label>
            <div class="col-md-9">
              <input type="text" class="form-control" placeholder="Enter your Brand Name"
              name="brand" id="brand">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Brand Image</label>
            <div class="col-md-9">
              <input type="hidden" name="brand_image1" id="brand_image1">
              <input type="file" class="form-control" placeholder="Enter your Brand Name"
              name="brand_image" id="brand_image">
            </div>
          </div>
          <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput6">Brand Status</label>
                <div class="col-md-9">
                  <select name="status" class="form-control">
                    <option selected="" value="0">Active</option>
                    <option value="1">Deactive</option>
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
    $('.brand-menu').addClass('active');
  var action_type;
  $('#open_model').click(function(){
    $('#brand_model').modal('show');
    $("#brand_form")[0].reset();
    action_type = 1;
    $('#saveCat').text('Save');
    $('#myModalLabel8').text('Create Brand');
  })
    function saveBrand(){
      var formData = new FormData($('#brand_form')[0]);
      if(action_type == 1){

        $.ajax({
                url : '/admin/add-brand',
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
                    console.log(data)
                  toastr.error('Brand Name Required', 'Required!');
              }
            });
      }else{
        $.ajax({
          url : '/admin/update-brand',
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
        url : '/admin/edit_brand/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('#myModalLabel8').text('Update brand');
          $('#saveCat').text('Save Change');
          $('input[name=brand]').val(data.brand);
          $('input[name=brand_image1]').val(data.brand_image);
          $('input[name=id]').val(id);
          $('select[name=status]').val(data.status);
          $('#brand_model').modal('show');
          action_type = 2;
        }
      });
    }
     function deleteCat(id){
      var r = confirm("Are you sure");
      if (r == true) {
      $.ajax({
        url : '/admin/delete_brand/'+id,
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
