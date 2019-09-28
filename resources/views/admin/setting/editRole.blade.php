@extends('admin.app')
@section('extra-css')
  <link rel="stylesheet" type="text/css" href="../../../app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/icheck/icheck.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/toggle/switchery.min.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/switch.css">
@endsection
@section('section')
<div class="content-wrapper">

    <div class="content-body">
     
   
<section id="column-selectors">
    <div class="row">
      <div class="col-12">
        
        <div class="card">
                <div class="card-header">
            
                       <div class="row">
                            <div class="col-md-2">
                                    {{-- <div class="dropdown-item">
                                        <input type="checkbox" name="all" id="role_all"/>
                                    <label for="switchery4" class="card-title ml-1">All</label>
                                      </div> --}}
                                  </div>
                                 
                                  <div class="form-group col-md-6">
                                        <form method="post" action="/admin/update-role">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="role_id" value="{{$editRole->id}}">
                                        <input type="text" id="role_name" class="form-control" placeholder="Role Name" value="{{$editRole->role_name}}" name="role_name">
                                        </div>
                                       
                                     <div class="col-md-4">
                                            <button type="submit" class="btn btn-outline-primary">Update Role</button>
                                     </div>
                       </div>
                  </div>
          <div class="card-content collapse show">
            <div class="card-body card-dashboard">
                    <div class="row">
                        @foreach($tb as $row)
                            <div class="col-md-4">
                                <div class="dropdown-item">
                                    <input type="checkbox" name="role[]" <?php echo $editRole[$row] == 1 ? 'checked' : '' ?> value="{{$row}}" class="switchery-xs role_check" />
                                <label for="switchery4" class="card-title ml-1">{{$row}}</label>
                                  </div>
                              </div>
                            
              @endforeach
                            </div>
                            <br>
                            <div class="row">
                                    <div class="col-md-12">
                                            <button type="submit" class="btn btn-outline-primary float-right">Update Role</button>
                                     </div>
                            </div>
                        </div>
                    </form>
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> 
</div>
    </div>
  </div>

@endsection
@section('extra-js')


  <script src="../../../app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
  <script src="../../../app-assets/vendors/js/forms/toggle/switchery.min.js" type="text/javascript"></script>
  <script src="../../../app-assets/js/scripts/dropdowns/dropdowns.js" type="text/javascript"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/core.js" type="text/javascript"></script> -->
  <script>
      $('.roles').addClass('active');
      $(document).on('click','#role_all', function(){
    if($("#role_all").prop('checked') == true){
        $('.role_check').trigger('click');
    } else{
    $('.role_check').trigger('click');
    }
   
});
  </script>
  


@endsection