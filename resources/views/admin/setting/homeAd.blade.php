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
              <h4 class="card-title">First Ads</h4>
            </div>
            <form method="post" id="adform1">
              {{csrf_field()}}
              <input type="hidden" name="id" value="1" id="form1">
            <img class="img-fluid" src="/ads/{{count($ads) > 0 ? $ads[0]->ad_name : ''}}" alt="Card image cap" id="firstImage">
            <input type="file" type="hidden" name="firstInputImage" id="firstInputImage" style="display: none;">
            <div class="card-body">
                    <div class="form-group">
                            <label for="donationinput1" class="sr-only">URL</label>
                            <input type="text" class="form-control" placeholder="http://" name="url" value="{{count($ads) > 0 ? $ads[0]->url : ''}}">
                          </div>
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
              <h4 class="card-title">Second Ads</h4>
            </div>
            <form method="post" id="adform2">
                {{csrf_field()}}
                <input type="hidden" name="id" value="2" id="form2">
            <img class="img-fluid" src="/ads/{{count($ads) > 0 ? $ads[1]->ad_name : ''}}" alt="Card image cap" id="firstImage1">
            <input type="file" type="hidden" name="firstInputImage" id="firstInputImage1" style="display: none;">
            <div class="card-body">
                    <div class="form-group">
                            <label for="donationinput1" class="sr-only">URL</label>
                            <input type="text" class="form-control" placeholder="http://" name="url" value="{{count($ads) > 0 ? $ads[1]->url : ''}}">
                          </div>
                          <button type="button" onclick="updateSide(2)" class="btn btn-primary">Update <i class="ft-thumbs-up position-right"></i></button>
            </div>
         
            </form>
          </div>
        </div>
      </div>
 
    <div class="col-xl-4 col-md-6 col-sm-12">
        <div class="card">
          <div class="card-content">
            <div class="card-body">
              <h4 class="card-title">Side Ads</h4>
            </div>
            <form method="post" id="adform3">
                {{csrf_field()}}
                <input type="hidden" name="id" value="3" id="form3">
            <img class="img-fluid" src="/ads/{{count($ads) > 0 ? $ads[2]->ad_name : ''}}" alt="Card image cap" id="firstImage2">
            <input type="file" type="hidden" name="firstInputImage" id="firstInputImage2" style="display: none;">
            <div class="card-body">
                    <div class="form-group">
                            <label for="donationinput1" class="sr-only">URL</label>
                            <input type="text" class="form-control" placeholder="http://" name="url" value="{{count($ads) > 0 ? $ads[2]->url : ''}}">
                          </div>
                          <button type="button" onclick="updateSide(3)" class="btn btn-primary">Update <i class="ft-thumbs-up position-right"></i></button>
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

 $('.ads').addClass('active');

    function updateSide(id){
    
      var formData = new FormData($('#adform'+id)[0]);
        $.ajax({
                url : '/admin/ads-update',
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {                
                console.log(data);
                     toastr.success('Add Update Successfully', 'Successfully Update');
                },error: function (data, errorThrown) {
               
                    toastr.error("Not Update Data");
                 
                }
            });
     
      
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
     $("#firstImage2").click(function () {
     $("#firstInputImage2").trigger('click');
      });
     $('#firstInputImage2').change(function(){
      readURL2(this);
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
function readURL2(input) {

if (input.files && input.files[0]) {
  var reader = new FileReader();

  reader.onload = function(e) {
    $('#firstImage2').attr('src', e.target.result);
  }

  reader.readAsDataURL(input.files[0]);
}
}
    
</script>
@endsection