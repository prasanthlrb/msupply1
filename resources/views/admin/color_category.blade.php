@extends('admin.app')
@section('extra-css')

@endsection
@section('section')
<div class="content-wrapper">

    <div class="content-body">
        <section>
            <div class="row p-2">

                <button id="open_model" data-backdrop="false" class="btn btn-success round btn-glow px-2" data-toggle="modal">Create Color Category</button>
            </div>

            <div class="row" id="load-category">



            </div>



          </section>

</div>
    </div>



  <div class="modal fade text-left" id="color_category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8"
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

        <div class="modal-body">
            <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput1">Title</label>
                <div class="col-md-9">
                  <input type="text" id="title" class="form-control" placeholder="Enter Category Title"
                  name="title">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput4">Category Colors</label>
                <div class="col-md-9">
                  <input type="text" id="colors" class="form-control" placeholder="Enter Category Colors" name="colors">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput6">Status</label>
                <div class="col-md-9">
                  <select id="status" name="status" class="form-control">
                    <option value="0">Active</option>
                    <option value="1">InActive</option>
                  </select>
                </div>
              </div>

        </div>
        </form>
        <div class="modal-footer">
          <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-outline-primary" onclick="saveCategory()" id="saveCat">Save</button>
        </div>
      </div>
    </div>
  </div>

@endsection
@section('extra-js')

<script>
loadData();
    function loadData(){
        $('#load-category').load('/admin/load-color-category');
    }
    $('.colors-menu').addClass('active');
  var action_type;
  $('#open_model').click(function(){
    $('#color_category').modal('show');
     $("#Category_form")[0].reset();
     action_type = 1;
    // $('#saveCat').text('Save');
     $('#myModalLabel8').text('Create Color Category');
  })
    function saveCategory(){
      var formData = new FormData($('#Category_form')[0]);
      if(action_type == 1){

        $.ajax({
                url : '/admin/add-color-category',
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {

                    $("#Category_form")[0].reset();
                     $('#color_category').modal('hide');
                     loadData();
                    toastr.success(data['message']);
                    //.reload(true);
                },error: function (data) {
                    console.log(data)
                    toastr.error('Form FieldRequired', 'Required!');
              }
            });
      }else{
        $.ajax({
          url : '/admin/update-color-category',
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "JSON",
          success: function(data)
          {
            console.log(data);
              $("#Category_form")[0].reset();
               $('#color_category').modal('hide');
               loadData();
               toastr.success(data['message']);
          },error: function (data) {
            toastr.error('Form FieldRequired', 'Required!');
        }
      });
      }

    }

    function editCat(id){

      $.ajax({
        url : '/admin/edit_color_category/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('#myModalLabel8').text('Update brand');
          $('#saveCat').text('Save Change');
          $('input[name=title]').val(data.title);
          $('input[name=colors]').val(data.colors);
          $('input[name=id]').val(id);
          $('select[name=status]').val(data.status);
          $('#color_category').modal('show');
          action_type = 2;
        }
      });
    }
     function deleteCat(id){
      var r = confirm("Are you sure");
      if (r == true) {
      $.ajax({
        url : '/admin/delete_color_category/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success('Brand Delete Successfully', 'Successfully Delete');
          loadData();
        }
      });
    }
     }

</script>
@endsection
