@extends('admin.app')
@section('extra-css')
  <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/ui/dragula.min.css">
@endsection
@section('section')
<div class="content-wrapper">

    <div class="content-body">


<section id="column-selectors">
    <div class="row">
      <div class="col-12">

        <div class="card">
          <div class="card-header">
              @if($role->cms_slider_create ==1)
                <button id="open_model" data-backdrop="false" class="btn btn-success round btn-glow px-2" data-toggle="modal">Create Sliders</button>
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

              <table class="table table-striped table-bordered">
                <thead>
                  <tr>

                    <th>Slider Title Name</th>
                    <th>SubTitle</th>
                    <th>Slider Position</th>
                    <th>Slider Image</th>
                    @if($role->cms_slider_action ==1)
                    <th>Action</th>
                  @endif
                  </tr>
                </thead>
                <tbody id="list-group-tags">

                @foreach($slider as $row)
                <tr data-value="{{$row->id}}">

                <td>{{$row->title}}</td>
                <td>{{$row->sub_title}}</td>
                <td>{{$row->slider_position}}</td>
                <td><img src="{{ asset("slider/$row->slider_image")}}" alt="" style="width:80px"></td>
                @if($role->cms_slider_action ==1)
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

                  @endforeach
                </tbody>
                <tfoot>
                  <tr>


                    <th>Slider Title Name</th>
                    <th>SubTitle</th>
                    <th>Slider Position</th>
                    <th>Slider Image</th>
                    @if($role->cms_slider_action ==1)
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
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary white">
          <h4 class="modal-title white" id="myModalLabel8">Create Slider</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="slider_form" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id">
            <input type="hidden" name="parent_id" value="{{ Request::segment(3) }}">
        <div class="modal-body">
          <div class="form-group row">
                <div class="col-md-8">
            <label class="label-control" for="projectinput1">Title</label>

              <input type="text" id="title" class="form-control" placeholder="Enter your Slider Title"
              name="title">
            </div>
                <div class="col-md-2">
            <label class="label-control" for="projectinput1">Title Color</label>

              <input type="text" id="title_color" class="form-control" placeholder="#000000"
              name="title_color">
            </div>
                <div class="col-md-2">
            <label class="label-control" for="projectinput1">Title Y Position</label>

              <input type="text" id="title_y" class="form-control" placeholder="100"
              name="title_y">
            </div>
          </div>
          <div class="form-group row">
                <div class="col-md-8">
            <label class="label-control" for="projectinput1">Sub Title</label>

              <input type="text" id="sub_title" class="form-control" placeholder="Enter your Slider sub title"
              name="sub_title">
            </div>
                <div class="col-md-2">
            <label class="label-control" for="projectinput1">Sub Title Color</label>

              <input type="text" id="sub_color" class="form-control" placeholder="#000000"
              name="sub_color">
            </div>
                <div class="col-md-2">
            <label class="label-control" for="projectinput1">Y Position</label>

              <input type="text" id="sub_y" class="form-control" placeholder="100"
              name="sub_y">
            </div>
          </div>
          <div class="form-group row">
                <div class="col-md-8">
            <label class="label-control" for="projectinput1">Description</label>

              <input type="text" id="desc" class="form-control" placeholder="Enter your Slider Description"
              name="desc">
            </div>
                <div class="col-md-2">
            <label class="label-control" for="projectinput1">Description Color</label>

              <input type="text" id="desc_color" class="form-control" placeholder="#000000"
              name="desc_color">
            </div>
                <div class="col-md-2">
            <label class="label-control" for="projectinput1">Y Position</label>

              <input type="text" id="desc_y" class="form-control" placeholder="100"
              name="desc_y">
            </div>
          </div>
          <div class="form-group row">
                <div class="col-md-8">
            <label class="label-control" for="projectinput1">Button Text</label>

              <input type="text" id="button_text" class="form-control" placeholder="Enter your button text"
              name="button_text">
            </div>
                <div class="col-md-2">
            <label class="label-control" for="projectinput1">Button Color</label>

              <input type="text" id="button_color" class="form-control" placeholder="#000000"
              name="button_color">
            </div>
                <div class="col-md-2">
            <label class="label-control" for="projectinput1">Y Position</label>

              <input type="text" id="button_y" class="form-control" placeholder="100"
              name="button_y">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Button URL</label>
            <div class="col-md-9">
              <input type="text" id="button_url" class="form-control" placeholder="http://" name="button_url">
            </div>
          </div>

          <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput6">Select Slider Position</label>
                <div class="col-md-9">
                  <select id="slider_position" name="slider_position" class="form-control">
                    <option selected="" value="0" disabled>select</option>
                    <option value="right">Right</option>
                    <option value="left">Left</option>
                    <option value="center">Center</option>


                  </select>
                </div>
              </div>
          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Slider Image</label>
            <div class="col-md-9">
                <input id="slider_image" type="file" class="form-control" accept="image/*" name="slider_image" />
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
  <script src="../../../app-assets/vendors/js/extensions/dragula.min.js" type="text/javascript"></script>
<script>

dragula([document.getElementById('list-group-tags')], {
  revertOnSpill: true
}).on('drop', function(el) {
     var parentElId = $(el).wrapAll();
   var droppedElIndex = $(el).index();
   var droppedElId = $(el).attr('data-value');
  $.ajax({
        url : '/admin/drop-slider/'+droppedElIndex+'/'+droppedElId,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          console.log(data);
        }

      });
});
  var action_type;
  $('#open_model').click(function(){
    $('#attribute_model').modal('show');
    action_type = 1;
    $("#slider_form")[0].reset();
    $('#prevImage').attr('src', '');
    $('#saveCat').text('Save');
    $('#myModalLabel8').text('Create Sliders');
  })
    function saveAttr(){
      $('#saveCat').attr('disabled',true);
      var formData = new FormData($('#slider_form')[0]);
      if(action_type == 1){

        $.ajax({
                url : '/admin/slider-save',
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {
                  $('#saveCat').attr('disabled',false);
                    $("#slider_form")[0].reset();
                     $('#attribute_model').modal('hide');
                     toastr.success('Slider Store Successfully', 'Successfully Save');
                     location.reload();
                },error: function (data, errorThrown) {
                var errorData = data.responseJSON.errors;
                  $.each(errorData, function(i, obj) {
                    toastr.error(obj[0]);
                  });
                }
            });
      }else{
        $.ajax({
          url : '/admin/slider-update',
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "JSON",
          success: function(data)
          {
            console.log(data);
            $('#saveCat').attr('disabled',false);
              $("#slider_form")[0].reset();
               $('#attribute_model').modal('hide');
               toastr.success('Slider Update Successfully', 'Successfully Update');
               location.reload();
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
        url : '/admin/edit-slider/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          $('#myModalLabel8').text('Update Slider');
          $('#saveCat').text('Save Change');
          $('input[name=	title]').val(data.	title);
          $('input[name=	sub_title]').val(data.	sub_title);
          $('input[name=desc]').val(data.desc);
          $('input[name=button_text]').val(data.button_text);
          $('input[name=button_url	]').val(data.button_url	);
          $('input[name=button_color]').val(data.	button_color);
          $('input[name=button_y]').val(data.button_y);
          $('select[name=slider_position]').val(data.slider_position);
          $('input[name=title_color]').val(data.title_color);
          $('input[name=title_y]').val(data.title_y);
          $('input[name=sub_color]').val(data.sub_color);
          $('input[name=sub_y]').val(data.sub_y);
          $('input[name=desc_color]').val(data.desc_color);
          $('input[name=desc_y]').val(data.desc_y);
          $('input[name=category_name]').val(data.category_name);
          $('#prevImage').attr('src', '/slider/'+data.slider_image);
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
        url : '/admin/delete-slider/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success('Slider Delete Successfully', 'Successfully Delete');
          location.reload();
        }
      });
    }
     }
     $('#slider_image').change(function(){
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

$('.sliders').addClass('active');
</script>


@endsection
