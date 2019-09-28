@extends('admin.app')
@section('extra-css')
  <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/selects/select2.min.css">
 <!-- BEGIN VENDOR CSS-->
 <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/ui/dragula.min.css">
 <!-- END VENDOR CSS-->

  <style>
  .hidden-data{
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
          <div class="card-header">
            @if($role->cms_home_layout_create ==1)
                <button id="open_model" data-backdrop="false" class="btn btn-success round btn-glow px-2" data-toggle="modal">Create Layouts</button>
          @endif
              </div>
       
        </div>
        <div class="col-lg-6">
          <div class="card">
            <ul class="list-group" id="list-group-tags">
                @foreach($layout as $row)
              <li class="list-group-item" data-value="{{$row->id}}">
                  @if($role->cms_home_layout_delete ==1)
                <span class="badge badge-danger badge-pill float-right" onclick="Delete({{$row->id}})"><i class="ft-trash-2"></i></span>
                @endif
                @if($role->cms_home_layout_edit ==1)
                <span class="badge badge-primary badge-pill float-right" onclick="Edit({{$row->id}})"><i class="ft-edit"></i></span>
                @endif
                {{$row->title}} - ({{$row->type}})
              </li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section> 
</div>
    </div>
  </div>

  <div class="modal fade text-left" id="category_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8"
  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary white">
          <h4 class="modal-title white" id="myModalLabel8">Create Layout</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id">
        <div class="modal-body">
          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput1">Title</label>
            <div class="col-md-9">
              <input type="text" id="title" class="form-control" placeholder="Enter Title"
              name="title">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3 label-control" for="projectinput6">Type</label>
            <div class="col-md-9">
              <select id="type" name="type" class="form-control">
                <option selected="" value="0" disabled>select</option>
                <option value="products">products</option>
                <option value="category">category</option>
              </select>
            </div>
          </div>

         
          <div class="form-group row products hidden-data">
            <label class="col-md-3 label-control" for="projectinput6">Select Productn</label>
            <div class="col-md-9">
              <select style="width:100%" id="products" name="products[]" class="select2 form-control col-md-12" multiple="multiple">
                <optgroup id="product1">
                @foreach($product as $prod)
              <option value="{{$prod->id}}">{{$prod->product_name}}</option>
              @endforeach
                </optgroup>
              </select>
            </div>
          </div>

          <div class="form-group row category hidden-data">
            <label class="col-md-3 label-control" for="projectinput6">Select Category</label>
            <div class="col-md-9">
              <select style="width:100%" id="category" name="category[]" class="select2 form-control col-md-12" multiple="multiple">
                <optgroup id="category1">
                @foreach($category as $cat)
                <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                @endforeach
              </optgroup>
              </select>
            </div>
          </div>
          
        </div>
        </form>
        <div class="modal-footer">
          <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-outline-primary" onclick="Save()" id="saveCat">Save</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('extra-js')
<script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
<script src="../../../app-assets/js/scripts/forms/select/form-select2.js" type="text/javascript"></script>
  <!-- BEGIN PAGE VENDOR JS-->
  <script src="../../../app-assets/vendors/js/extensions/dragula.min.js" type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
<script>

 $('.home_layout').addClass('active');


dragula([document.getElementById('list-group-tags')], {
  revertOnSpill: true
}).on('drop', function(el) {
     var parentElId = $(el).wrapAll();
   var droppedElIndex = $(el).index();
   var droppedElId = $(el).attr('data-value');
  //console.log(parentElId);
  console.log(droppedElIndex);
  console.log(droppedElId);
 
  $.ajax({
        url : '/admin/drop-layout/'+droppedElIndex+'/'+droppedElId,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          console.log(data);
        }

      });
});
  var action_type;

  $('#type').change(function(){
    var type = $(this).val();
    if(type == "products"){
      $('.products').removeClass('hidden-data');
      $('.category').addClass('hidden-data');
    }else{
      $('.category').removeClass('hidden-data');
      $('.products').addClass('hidden-data');
    }  
  })
  $('#open_model').click(function(){
    
    $('#category_model').modal('show');
    $('.category').addClass('hidden-data');
    $('.products').addClass('hidden-data');
    action_type = 1;
    $('#saveCat').text('Save');
    $("#form")[0].reset();
    $('#myModalLabel8').text('Create Layout');
    $(".select2").select2({
    placeholder: "Select a State",
    allowClear: true
}); 
  })
    function Save(){
      var formData = new FormData($('#form')[0]);
      if(action_type == 1){

        $.ajax({
                url : '/admin/save-layout',
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {   
                  console.log(data);             
                    $("#form")[0].reset();
                     $('#category_model').modal('hide');
                     
                     //$('#list-group-tags').load(location.href+' #list-group-tags');
                     toastr.success('Group Store Successfully', 'Successfully Save');
                     location.reload();
                },error: function (data) {
                toastr.error('Group Name Required', 'Required!');
                //toastr.error(data.responseJSON.errors.cat_name);
              }
            });
      }else{
        $.ajax({
          url : '/admin/update-layout',
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "JSON",
          success: function(data)
          {
            console.log(data);
              $("#form")[0].reset();
               $('#category_model').modal('hide');
              // $('#list-group-tags').load(location.href+' #list-group-tags');
               toastr.success('Category Update Successfully', 'Successfully Update');
               location.reload();
          },error: function (data) {
            toastr.error('Category Name Required', 'Required!');
        }
      });
      }
      
    }

    function Edit(id){
      
      $.ajax({
        url : '/admin/edit-layout/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
         
          $('#myModalLabel8').text('Update Layout');
          $('#saveCat').text('Save Change');
          $('input[name=id]').val(data[0].id);
          $('input[name=title]').val(data[0].title);
          $('select[name=type]').val(data[0].type);
         
          if(data[0].type == "products"){
            $('.products').removeClass('hidden-data');
            $('.category').addClass('hidden-data');
            $('#product1').html(data[1]);
          }else{
            $('.category').removeClass('hidden-data');
            $('.products').addClass('hidden-data');
           // $('.category').html(data[1]);
           $('#category1').html(data[1]);
          }
          setTimeout(function(){
                $(".select2").select2(); 
            }, 100);
          $('#category_model').modal('show');
          action_type = 2;
        }
      });
    }
     function Delete(id){
      var r = confirm("Are you sure");
      if (r == true) {
      $.ajax({
        url : '/admin/delete-layout/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success('Group Delete Successfully', 'Successfully Delete');
          //$('#list-group-tags').load(location.href+' #list-group-tags');
          location.reload();
        }
      });
    } 
     }
    
</script>
@endsection