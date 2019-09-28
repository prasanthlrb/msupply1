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
                <?php $y=1;?>
                @if(count($linkCat2) >0)
                <li class="breadcrumb-item"><a href="/admin/category/0">Category</a>
                </li>

                @foreach($linkCat2 as $link)
              <li class="breadcrumb-item"><a href="/admin/category/{{$link['id']}}">{{$link['name']}}</a>
                </li>
                <?php $y++;?>
                @endforeach
                @endif
              </ol>
            </div>
          </div>
   <br>
<section id="column-selectors">
    <div class="row">
      <div class="col-12">

        <div class="card">
          <div class="card-header">
            @if($role->category_create ==1)
                <button id="open_model" data-backdrop="false" class="btn btn-success round btn-glow px-2" data-toggle="modal">Create Category</button>
            @endif

          </div>
          <div class="card-content collapse show">
            <div class="card-body card-dashboard">

              <table class="table table-striped table-bordered zero-configuration">
                <thead>
                  <tr>
                    <th>S No</th>
                    <th>Category Name</th>
                    <th>Category Image</th>
                    @if($y < 4)
                  <th>SubCategory</th>
                  @endif
                  @if($role->category_action ==1)
                    <th>Action</th>
                  @endif
                  </tr>
                </thead>
                <tbody>
                 <?php $x=1?>
                @foreach($category as $row)
                <tr>
                <td>{{$x}}</td>
                <td>{{$row->category_name}}</td>
                <td><img src="{{ asset("category_image/$row->category_image")}}" alt="" style="width:80px"></td>
                @if($y < 4)
                <td><a href="/admin/category/{{$row->id}}">Create SubCategory</a></td>
                @endif
                @if($role->category_action ==1)
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
                <tfoot>
                    <tr>
                        <th>S No</th>
                        <th>Category Name</th>
                        <th>Category Image</th>
                        @if($y < 4)
                      <th>SubCategory</th>
                      @endif
                      @if($role->category_action ==1)
                        <th>Action</th>
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
          <h4 class="modal-title white" id="myModalLabel8">Create Category</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="Category_form" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id">
            <input type="hidden" name="parent_id" value="{{ Request::segment(3) }}">
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Category Name</label>
            <div class="col-md-9">
              <input type="text" id="category_name" class="form-control" placeholder="Enter your Category Name"
              name="category_name">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Category Image</label>
            <div class="col-md-9">
                <input id="category_image" type="file" class="form-control" accept="image/*" name="category_image" />
              <div id="preview"><img id="prevImage" style="width: 240px;
                padding-top: 20px;" src="" /></div><br>
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
  $('.category-menu').addClass('active');
  var action_type; // the action type used to from data Save And Update
  $('#open_model').click(function(){
    $('#attribute_model').modal('show');
    $("#Category_form")[0].reset();
    $('#prevImage').attr('src', '');
    action_type = 1;
    $('#saveCat').text('Save');
    $('#myModalLabel8').text('Create Category');
  });


    function saveAttr(){
      $('#saveCat').attr('disabled',true);
      var formData = new FormData($('#Category_form')[0]);
      if(action_type == 1){

        $.ajax({
                url : '/admin/category-save',
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {
                  $('#saveCat').attr('disabled',false);
                    $("#Category_form")[0].reset();
                     $('#attribute_model').modal('hide');
                     $('.zero-configuration').load(location.href+' .zero-configuration');
                     toastr.success('Category Store Successfully', 'Successfully Save');
                },error: function (data, errorThrown) {
                var errorData = data.responseJSON.errors;
                  $.each(errorData, function(i, obj) {
                    toastr.error(obj[0]);
                  });
                }
            });
      }else{
        $.ajax({
          url : '/admin/category-update',
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "JSON",
          success: function(data)
          {
            console.log(data);
            $('#saveCat').attr('disabled',false);
              $("#Category_form")[0].reset();
               $('#attribute_model').modal('hide');
               $('.zero-configuration').load(location.href+' .zero-configuration');
               toastr.success('Category Update Successfully', 'Successfully Update');
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
        url : '/admin/edit-category/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('#myModalLabel8').text('Update Attribute');
          $('#saveCat').text('Save Change');
          $('input[name=category_name]').val(data.category_name);
          $('#prevImage').attr('src', '/category_image/'+data.category_image);
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
        url : '/admin/delete-category/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success('Category Delete Successfully', 'Successfully Delete');
          $('.zero-configuration').load(location.href+' .zero-configuration');
        }
      });
    }
     }
     $('#category_image').change(function(){
      readURL(this);
     });

     function readURL(input) {

if (input.files && input.files[0]) {
  var reader = new FileReader();

  reader.onload = function(e) {
    $('#prevImage').attr('src', e.target.result);
  }

  reader.readAsDataURL(input.files[0]);
}
}

</script>
@endsection
