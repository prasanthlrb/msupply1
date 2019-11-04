
@extends('admin.app')
@section('extra-css')
<style>
.remove_btn{
    cursor: pointer;
}
.vcenter {
   
   margin-top:30px;
  
}
</style>

@endsection
@section('section')


<div class="content-wrapper">
<div class="content-body">



        <section id="horizontal-form-layouts">
            <form method="POST" action="/admin/edit-price-based-location"  enctype="multipart/form-data">
                {{ csrf_field() }}
                
                <div class="row">
             

                  <div class="col-md-12">
                        <div class="card">
                      <div class="card-header">
                      <input type="hidden" name="product" id="product" value="{{$product->id}}">
                        <h4 class="card-title">{{$product->product_name}} </h4>
                        
                      </div>
                      <div class="card-content collpase show">
                        <div class="card-body">
                            
                          <hr class="pb-2">

                          
                         
@foreach($lm as $index => $loc)
                                    <div class="row">

                                        <div class="col-md-2">
                                        <h4 class="card-title text-center vcenter">{{$loc->location}}</h4>
                                        </div>

                                          <div class="col-md-3">
                                             <div class="form-group">
                                                 <label class="label-control" for="projectinput1">Regular Price 
                                                     @if($index == 0)
                                                   <a href="javascript:void(null)" onclick="applyRegular({{$loc->id}})">Apply to All</a>
                                                   @endif
                                                 </label>
                                               
                                             <input type="text" id="regular_price{{$loc->id}}" name="regular_price{{$loc->id}}" class="form-control regular_price" value="{{$loc->regular_price}}">
                                                </div>
                                            </div>
                                          <div class="col-md-3">
                                             <div class="form-group">
                                                 <label class="label-control" for="projectinput1">Sales Price 
                                                        @if($index == 0)
                                                   <a href="javascript:void(null)" onclick="applySales({{$loc->id}})">Apply to All</a>
                                                   @endif
                                                 </label>
                                               
                                             <input type="text" id="sales_price{{$loc->id}}" name="sales_price{{$loc->id}}" class="form-control sales_price" value="{{$loc->sales_price}}">
                                                </div>
                                            </div>
                                          {{-- <div class="col-md-2">
                                             <div class="form-group">
                                                 <label class="label-control" for="projectinput1">Lat</label>
                                               
                                                  <input type="text" name="lat{{$loc->id}}" class="form-control" value="{{$loc->lat}}">
                                                </div>
                                            </div>
                                          <div class="col-md-2">
                                             <div class="form-group">
                                                 <label class="label-control" for="projectinput1">Lng</label>
                                               
                                                  <input type="text" name="lng{{$loc->id}}" class="form-control" value="{{$loc->lng}}">
                                                </div>
                                            </div> --}}

                                        <div class="col-md-3"> 
                                            <div class="form-group">
                                               
                                                <label class="label-control" for="projectinput1">Status this Location</label>
                                                <select name="status{{$loc->id}}" class="form-control">
                                                
                                                    <option value="0" <?php echo $loc->status == 0 ?'selected':''?>>Available </option>
                                                    <option value="1" <?php echo $loc->status == 1 ?'selected':''?>>Not Available </option>
                                                </select>
                                            </div>
                                        </div>
                                        </div>
                          
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>
                  
                </div>
              </section>


                    <div class="row">
                        <div class="col-md-12">
                          <div class="card">
                            <div class="card-header">



                            </div>
                            <div class="card-content collpase show">
                              <div class="card-body">


                                  <div class="form-actions float-left pb-2">
                                    <button type="button" class="btn btn-danger" id="delete_asign_product">
                                      <i class="la la-trash"></i> Delete
                                    </button>
                                  </div>
                                  <div class="form-actions float-right pb-2">
                                    <button type="submit" class="btn btn-success" id="color_product_save">
                                      <i class="la la-check-square-o"></i> Update & Publish
                                    </button>
                                  </div>

                              </div>
                            </div>
                          </div>
                        </div>

                    </div>
                    

  </form>
</div>
</div>
</div>

@endsection
@section('extra-js')

<script src="../../../custom/color.js" type="text/javascript"></script>

<script>
        $('.location-management').addClass('active');
 
$('#delete_asign_product').click(function(){
    let id = $('#product').val();
        var r = confirm("Are you sure");
      if (r == true) {
      $.ajax({
        url : '/admin/delete-assign-location/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          window.location.href = "/admin/location-management_list";
        }
      });
    }
})

</script>

@endsection
