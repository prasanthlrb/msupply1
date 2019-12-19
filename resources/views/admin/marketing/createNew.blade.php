
@extends('admin.app')
@section('extra-css')
<style>
.remove_btn{
    cursor: pointer;
}
.dontShow{
    display: none !important;
}
</style>
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/selects/select2.min.css">
@endsection
@section('section')


<div class="content-wrapper">
<div class="content-body">



        <section id="horizontal-form-layouts">
            <form action="POST" id="post_form_data" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" id="id" name="id">
                <div class="row">
                  <div class="col-md-6">
                    <div class="col-md-12">
                    <div class="card">
                      <div class="card-content collpase show">
                        <div class="card-body">

                            <div class="form-body">
                              <h4 class="form-section"><i class="ft-shopping-cart"></i> Add New Post</h4>

                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Post Title</label>
                                <div class="col-md-9">
                                  <input type="text" id="title" class="form-control" placeholder="Enter Post Title"
                                  name="title">
                                </div>
                              </div>

                              <div class="form-group row">
                                      <label class="col-md-3 label-control" for="Select Type">Post Send Type</label>
                                      <div class="col-md-9">
                                        <select name="send_type" id="send_type" class="form-control">
                                        <option value="" selected="" disabled="">Select </option>
                                        <option value="0">All User </option>
                                        <option value="1">Custom User </option>
                                        </select>
                                      </div>
                                    </div>

                              <div class="form-group row dontShow showUser">
                                      <label class="col-md-3 label-control" for="Select Brand">Select User</label>
                                      <div class="col-md-9">
                                        <select name="contact_id[]" id="contact_id" class="form-control select2" multiple style="width:100%">
                                       
                                          @foreach($users as $user)
                                          <option value="{{$user->id}}">{{$user->name}} </option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>

                               <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Product Image</label>
                                <div class="col-md-9">
                                  <input type="file" id="image" class="form-control" placeholder="Upload Post Image"
                                  name="image">
                                </div>
                              </div>

                               <div class="tab-pane" id="tabVerticalLeft26" aria-labelledby="baseVerticalLeft2-tab6">
                                    <div class="dropdown-item">
                                        <input type="checkbox" name="sms" id="sms" class="switchery-xs" />
                                        <label for="switchery1" class="card-title ml-1">SMS</label>
                                      </div>
                                    <div class="dropdown-item">
                                        <input type="checkbox" name="email" id="email" class="switchery-xs" />
                                        <label for="switchery2" class="card-title ml-1">Email</label>
                                      </div>
                                    <div class="dropdown-item">
                                        <input type="checkbox" name="whatapp" id="whatapp" class="switchery-xs" />
                                        <label for="switchery3" class="card-title ml-1">WhatsApp</label>
                                      </div>
                                    <div class="dropdown-item">
                                        <input type="checkbox" name="facebook" id="facebook" class="switchery-xs" />
                                        <label for="switchery4" class="card-title ml-1">FaceBook</label>
                                      </div>
                 
                               
                                </div>

                               
                                <div class="form-actions">
                                    <div class="text-tight">
                                        <button type="button" class="btn btn-success" id="send_only">
                                          <i class="la la-check-square-o"></i> Save
                                        </button>

                                            <button type="button" class="btn btn-success" id="send_save">
                                              <i class="la la-check-square-o"></i> Save & Send
                                            </button>
                                        </div>

                                  </div>
                        </div>
                      </div>
                    </div>
                    
                    </div>
                  </div>
                  </div>
                  <div class="col-md-6">
              
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Post Content</h4>


                  </div>
                  <div class="card-content collapse show">
                    <div class="card-body">

                        <div class="form-group">
                      
                            <textarea name="content" id="content" cols="30" rows="20" style="width:100%"></textarea>
                          </textarea>
                        </div>

                    </div>
                  </div>
                </div>
              </div>
                </div>
   
              </section>

  </form>
                    

</div>
</div>
</div>

@endsection
@section('extra-js')
<script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
<script src="../../../app-assets/js/scripts/forms/select/form-select2.js" type="text/javascript"></script>
<script src="../../../custom/color.js" type="text/javascript"></script>

<script>
  $('.marketing').addClass('active');
$('#send_type').change(function(){
    var send_type = $(this).val();
    if(send_type == 1){
        $('.showUser').removeClass('dontShow');
    }else{
        $('.showUser').addClass('dontShow');
    }
});

$('#send_only').click(function(){
    savePost(0)
});
$('#send_save').click(function(){
    savePost(1)
});

function savePost(types){
     var formData = new FormData($('#post_form_data')[0]);
        formData.append('save_type', types);
            $.blockUI({
            message: '<div class="ft-refresh-cw icon-spin font-medium-2"></div>',
            timeout: 20000, //unblock after 2 seconds
            overlayCSS: {
                backgroundColor: '#FFF',
                opacity: 0.8,
                cursor: 'wait'
            },
            css: {
                border: 0,
                padding: 0,
                color: '#333',
                backgroundColor: 'transparent'
            },
        });
      $.ajax({
          url : '/admin/send-save',
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "JSON",
          success: function(data)
          {
            $.unblockUI();
             console.log(data);
            //   $("#brand_form")[0].reset();
            //    $('#brand_model').modal('hide');
            //    $('.zero-configuration').load(location.href+' .zero-configuration');
            // toastr.success(data.message);
          },error: function (data) {
            toastr.error('All Fields', 'Required!');
        }
      });
}
</script>

@endsection
