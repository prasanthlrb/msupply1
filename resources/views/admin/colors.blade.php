@extends('admin.app')
@section('extra-css')
@endsection
@section('section')
<div class="content-wrapper">

    <div class="content-body">
          <section id="backColor">
                <div class="row p-2">
                    <div class="col-md-6">
                            <button id="open_model" data-backdrop="false" class="btn btn-success round btn-glow px-2" data-toggle="modal">Create Color</button>
                    </div>
                    <div class="col-md-6">
                            <a href="/admin/colors-category" class="btn btn-dark round float-right"><i class="ft-arrow-left"></i> GoTo Colors Category</a>
                        </div>


                    </div>
                <div class="row">
                  <div class="col-md-12">
                  <div class="card p-1 text-white" style="background:{{$color->colors}}">
                      <div class="card-content">
                        <div class="card-body">
                          <div class="float-left">
                            <p class="white mb-0">
                            <strong>{{$color->title}}</strong>
                            </p>

                          </div>
                          <div class="float-right">
                            <p class="card-title">
                            <small class="float-right">{{$color->colors}}</small>
                            </p>

                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>

                <div class="row" id="load-color">
                    </div>
              </section>

</div>
    </div>



  <div class="modal fade text-left" id="color_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8"
  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary white">
          <h4 class="modal-title white" id="myModalLabel8">Create Category</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="color_form" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id">
        <input type="hidden" name="category" value="{{$color->id}}" id="category_id">

        <div class="modal-body">
            <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput1">Color Name</label>
                <div class="col-md-9">
                  <input type="text" id="name" class="form-control" placeholder="Enter Color Name"
                  name="name">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput4">Color Code</label>
                <div class="col-md-9">
                  <input type="text" id="code" class="form-control" placeholder="Enter Color Code" name="code">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput4">Colors</label>
                <div class="col-md-9">
                  <input type="text" id="color" class="form-control" placeholder="Enter Color Code" name="color">
                </div>
              </div>

              <div class="form-group row">
                    <label class="col-md-3 label-control" for="projectinput4">Price</label>
                    <div class="col-md-9">
                      <input type="text" id="price" class="form-control" placeholder="Enter Color Price" name="price">
                    </div>
                  </div>



        </div>
        </form>
        <div class="modal-footer">
          <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-outline-success" onclick="saveColor()" id="saveCat">Save</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('extra-js')

<script>
    loadData();
    function loadData(){
        let cat_id = $('#category_id').val();
        $('#load-color').load('/admin/load-color/'+cat_id);
    }
    $('.colors-menu').addClass('active');
  var action_type;
  $('#open_model').click(function(){
    $('#color_model').modal('show');
    $("#color_form")[0].reset();
    action_type = 1;
    $('#saveCat').text('Save');
    $('#myModalLabel8').text('Create Color');
  })
    function saveColor(){
      var formData = new FormData($('#color_form')[0]);
      if(action_type == 1){

        $.ajax({
                url : '/admin/colors-save',
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {
                    console.log(data);
                    $("#color_form")[0].reset();
                     $('#color_model').modal('hide');
                     loadData();
                    //  $('.zero-configuration').load(location.href+' .zero-configuration');
                     toastr.success('Color Store Successfully', 'Successfully Save');
                },error: function (data) {
                    console.log(data.errors)
                  toastr.error('form Details Required', 'Required!');
              }
            });
      }else{
        $.ajax({
          url : '/admin/colors-update',
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "JSON",
          success: function(data)
          {
            console.log(data);
              $("#color_form")[0].reset();
               $('#color_model').modal('hide');
               loadData();
               toastr.success('Colors Update Successfully', 'Successfully Update');
          },error: function (data) {
            toastr.error('Form Details Required', 'Required!');
        }
      });
      }

    }

    function editColor(id){

      $.ajax({
        url : '/admin/edit-colors/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('#myModalLabel8').text('Update Colors');
          $('#saveCat').text('Save Change');
          $('input[name=name]').val(data.name);
          $('input[name=price]').val(data.price);
          $('input[name=color]').val(data.color);
          $('input[name=code]').val(data.code);
          $('input[name=id]').val(id);
          $('#color_model').modal('show');
          action_type = 2;
        }
      });
    }
     function deleteColor(id){
      var r = confirm("Are you sure");
      if (r == true) {
      $.ajax({
        url : '/admin/delete-colors/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success('Colors Delete Successfully', 'Successfully Delete');
          loadData();
        }
      });
    }
     }

</script>
@endsection
