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

   
    <div class="col-xl-4 col-md-6 col-sm-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <h4 class="card-title">Login Screen</h4>
            </div>
            <form method="post" id="adform{{$login_screen[0]->id}}">
              {{csrf_field()}}
              <input type="hidden" name="id" value="{{$login_screen[0]->id}}" id="form1">
            <img class="img-fluid" src="/login_screen/{{$login_screen[0]->image !=null ? $login_screen[0]->image : 'noimage.png'}}" alt="Card image cap" id="firstImage">
            <input type="file" name="firstInputImage" id="firstInputImage" style="display: none;">
            <div class="card-body">
                  
                          <button type="button" onclick="updateSide(1)" class="btn btn-primary">Update <i class="ft-thumbs-up position-right"></i></button>
            </div>
         
          </form>
          </div>
        </div>
      </div>
   
    <div class="col-xl-4 col-md-6 col-sm-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <h4 class="card-title">Signup Screen</h4>
            </div>
            <form method="post" id="adform{{$login_screen[1]->id}}">
                {{csrf_field()}}
            <input type="hidden" name="id" value="{{$login_screen[1]->id}}" id="form2">
            <img class="img-fluid" src="/login_screen/{{$login_screen[1]->image !=null  ? $login_screen[1]->image : 'noimage.png'}}" alt="Card image cap" id="firstImage1">
            <input type="file" name="firstInputImage" id="firstInputImage1" style="display: none;">
            <div class="card-body">
                    
                          <button type="button" onclick="updateSide(2)" class="btn btn-primary">Update <i class="ft-thumbs-up position-right"></i></button>
            </div>
         
            </form>
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

<script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>

 
  <script src="../../../app-assets/js/scripts/tables/datatables/datatable-basic.js"
  type="text/javascript"></script>
<script>

 $('.login-screen').addClass('active');

    function updateSide(id){
    
      var formData = new FormData($('#adform'+id)[0]);
        $.ajax({
                url : '/admin/login-screen-update',
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {                
                console.log(data);
                     toastr.success('Login Screen Update Successfully', 'Successfully Update');
                },error: function (data, errorThrown) {
               
                    toastr.error("Not Update Data");
                 
                }
            });
     
      
    }

 
     $("#firstImage").click(function () {
     $("#firstInputImage").trigger('click');
      });
     $('#firstInputImage').change(function(){
      readURL(this);
     });
     $("#firstImage1").click(function () {
     $("#firstInputImage1").trigger('click');
      });
     $('#firstInputImage1').change(function(){
      readURL1(this);
     });
   

function readURL(input) {

if (input.files && input.files[0]) {
  var reader = new FileReader();

  reader.onload = function(e) {
    $('#firstImage').attr('src', e.target.result);
  }

  reader.readAsDataURL(input.files[0]);
}
}
function readURL1(input) {

if (input.files && input.files[0]) {
  var reader = new FileReader();

  reader.onload = function(e) {
    $('#firstImage1').attr('src', e.target.result);
  }

  reader.readAsDataURL(input.files[0]);
}
}

    
</script>
@endsection