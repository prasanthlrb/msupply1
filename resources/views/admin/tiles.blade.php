@extends('admin.app')
@section('extra-css')
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/vendors.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/selects/select2.min.css">
  <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
 
  <style>
  .deleteIcon{
    cursor: pointer;
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
    
          <div class="card-content collapse show">
            <div class="card-body card-dashboard">

              <table class="table table-striped table-bordered zero-configuration">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Action</th>
                   
                  </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                  <tr>
                        <th>S.No</th>
                        <th>Product Name</th>
                        <th>Image</th>
                      <th>Category</th>
                        <th>Action</th>
                        
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

  <div class="modal fade text-left" id="updateTile2Cat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2"
  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary white">
          <h4 class="modal-title white" id="myModalLabel8">Update SubCategory</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {{-- <form id="update_tiles_subcategory" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="subcategoryProduct_id">
        <div class="modal-body">
         
          <div class="form-group row">
                <label class="col-md-3 label-control" for="projectinput6">Select Subcategory</label>
                <div class="col-md-9">
                  <select name="subcategory" class="form-control">
                    <option selected="" value="" disabled >Active</option>
                    @foreach($subcategory as $cat)
                  <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

        </div>
        </form> --}}
        <div class="modal-footer">
          <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-outline-primary" id="update_tiles_category">Update</button>
        </div>
      </div>
    </div>
  </div>

 <div class="modal fade text-left" id="tilesProductShow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel8"
  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary white">
          <h4 class="modal-title white" id="myModalTitle">Create Category</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="Category_form" method="post">
        <div class="modal-body">
        
            <div class="container">
        <div class="row clearfix">
                <div class="col-xs-12 col-md-12" style="padding-top:10px">
                    
                    <table style="width:100%" class="stock-available-table table table-bordered" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <td colspan="2" class="bg-primary" style="padding:15px;">
                                    <div class="row">
                                        <div class="col-md-7 text-right"><span style="color:#fff">Stock and Transit Details</span></div>
                                        <div class="col-md-5 text-right"><span style="color:#fff">Last Update: <span id="updated_at"></span> </span></div>

                                    </div>


                                </td>
                            </tr>
                        </thead>
                        <tbody>
                                {{-- <tr>
                                        <td colspan="2" class="text-center" style="padding-left:0;padding-right:0;padding-top:0;">
                                        <p style="font-size:3em;margin-bottom:0px;" class="text-center">Stock: <blinks class="font-weight-bold text-center" id="stock_quantity"></blinks></p>

                                        </td>
                                    </tr> --}}
                            <tr>
                                <td colspan="2" class="text-center" style="border:0px !important;padding:2px;">
                                <img src="" class="prodimg" style="width:435px">
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <table style="width:100%;" class="product-specs-table table table-bordered" cellpadding="0" cellspacing="0">
                            <thead>
                             
                                <tr>
                                    <td colspan="2" class="bg-primary text-center" style="padding:15px;color:#fff;">
                                        Product Specification
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Brand</td>
                                    <td class="font-weight-bold">
                                        <select name="brands" id="brands" class="form-control">
                                        <option value="" selected="" disabled="">Select </option>
                                         @foreach($brand as $data)
                                            <option value="{{$data->id}}">{{$data->brand}}</option>
                                           @endforeach
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                <td class="font-weight-bold" id="product_name"></td>
                                </tr>
                                {{-- <tr>
                                    <td>Price </td>
                                <td class="font-weight-bold" id="sales_price"></td>
                                </tr> --}}
                                <tr>
                                    <td>Description</td>
                                    <td class="font-weight-bold" id="product_description"> </td>
                                </tr>
                                {{-- <tr>
                                    <td>Category</td>
                                    <td class="font-weight-bold">Floor</td>
                                </tr> --}}
                                <tr>
                                    <td>Size</td>
                                    <td class="font-weight-bold" id="width"></td>
                                </tr>
                                <tr>
                                    <td>Weight</td>
                                    <td class="font-weight-bold" id="weight"></td>
                                </tr>
                                <tr>
                                    <td>Total Coverage in Sqft.	</td>
                                     <td><input type="text" style="width:100%" name="length" id="length"></td>
                                  
                                </tr>
                                      <tr>
                                    <td> Subcategory</td>
                                    <td>
                                
                                      <select name="sub_category" id="sub_category" class="form-control">
                                        <option value="" selected="" disabled="">Select </option>
                                        <option value="2">Wall Tiles </option>
                                        <option value="3">Floor Tiles </option>
                                         
                                        </select>
                               
                                    </td>
                                </tr>
                                <tr>
                                    <td>Second Subcategory</td>
                                    <td>
                                
                                      <select name="second_sub_category" id="second_sub_category" class="form-control">
                                        <option value="" selected="" disabled="">Select </option>
                                         @foreach($category as $cat)
                                            <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                           @endforeach
                                        </select>
                               
                                    </td>
                                </tr>

                                <tr>
                                    <td>ThirdSubcategory</td>
                                    <td>
                                
                                      <select name="third_sub_category" id="third_sub_category" class="form-control">
                                        <option value="" selected="" disabled="">Select </option>
                                         @foreach($subcategory as $cat)
                                            <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                           @endforeach
                                        </select>
                               
                                    </td>
                                </tr>
                                <tr>
                                    <td>No of Pieces</td>
                                    <td class="font-weight-bold" id="items"></td>
                                </tr>
                              </tbody>
                              <tbody id="location-stock"></tbody>
                              <tr>
                                <td>Discount / High</td>
                                <td>   <select name="price_type" id="price_type" class="form-control">
                                        <option value="" selected="" disabled="">Select </option>
                                          <option value="discount">Discount </option>
                                          <option value="high">High </option>
                                        </select>
                                      </td>
                              </tr>
                              <tr>
                                <td>Value Type</td>
                                <td> <select name="value_type" id="value_type" class="form-control">
                                        <option value="" selected="" disabled="">Select </option>
                                          <option value="percentage">Percentage </option>
                                          <option value="amount">Amount </option>
                                        </select></td>
                              </tr>
                              <tr>
                                <td>Value</td>
                                <td><input type="text" style="width:100%" name="amount" id="amount"></td>
                              </tr>
                              <tbody id="location-stock"></tbody>

                                <tr>
                                <td>Related Product</td>
                                <td> 
                                  <div id="related"></div>
                                </td>

                              </tr>
                                <tr>
                                <td>Important Notes</td>
                                <td><textarea  name="notes" id="notes"cols="30" rows="10"></textarea> </td>
                              </tr>
                        </table>
                       
                </div>

        </div>

        </div>
        </form>
     
      </div>
    </div>
  </div>
</div>
  


@endsection
@section('extra-js')


<script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
<script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
<script src="../../../app-assets/js/scripts/forms/select/form-select2.js" type="text/javascript"></script>

  <script src="../../../app-assets/js/scripts/tables/datatables/datatable-basic.js"
  type="text/javascript"></script>

  <script>
      var status_id = null;
      $('.tiles').addClass('active');

      var orderPageTable = $('.zero-configuration').DataTable(
      {
          processing: true,
          serverSide: true,
          "ajax":'/admin/get-tiles-product',
          columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
              { data: 'product_name', name: 'product_name' },
              { data: 'product_image', name: 'product_image' },
              { data: 'category', name: 'category' },
              { data: 'delete', name: 'delete' },

          ],
      });
      

   var ClickEvent = 0;
function Delete(id){
  ClickEvent = 1;
    var r = confirm("Are you sure");
    if (r == true) {
    $.ajax({
        url : '/admin/productDelete/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success('Product Delete Successfully', 'Successfully Delete');
          $('.table').load(location.href+' .table');
          ClickEvent = 0;
        }
      });
    }
}
$(".clickable-Product-row").click(function() {
    if(ClickEvent == 0){
      window.location = $(this).data("href");
    }
    ClickEvent = 0;
    });
var product_id;
function getProduct(id){
  $('select[name=price_type]').val("");
  $('select[name=value_type]').val("");
  $('select[name=second_sub_category]').val("");
  $('select[name=third_sub_category]').val("");
  // $('#related_product').val('').change();
  $('#amount').val('');
       $.ajax({
        url : '/admin/get-single-tiles-product/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            // console.log(data);
            $('.prodimg').attr('src','http://www.kagtech.net/KAGAPP/Partsupload/'+data[0].product_image);
            $('#width').text(data[0].width);
            $('#weight').text(data[0].weight);
            $('#items').text(data[0].items);
            //$('#product_id').val(data[0].id);
            product_id = data[0].id;
            if(data[0].price_type != null){
              $('select[name=price_type]').val(data[0].price_type);
            }
            if(data[0].value_type != null){
              $('select[name=value_type]').val(data[0].value_type);
            }
            $('#amount').val(data[0].amount);
            $('#product_description').text(data[0].product_description);
            $('#notes').val(data[0].notes);
            $('#product_name').text(data[0].product_name);
            $('select[name=brands]').val(data[0].brand_name);
            $('select[name=sub_category]').val(data[0].sub_category);
            $('#length').val(data[0].length);
            $('#updated_at').text(data[0].updated_at);
            if(data[2] != null){
            $('select[name=second_sub_category]').val(data[2]);
            }
            if(data[3] != null){
            $('select[name=third_sub_category]').val(data[3]);
            }
            $('#sales_price').text(data[0].sales_price ? "Rs : "+data[0].sales_price : data[0].sales_price);
            $('#location-stock').html(data[1]);
            $('#tilesProductShow').modal('show');
            $('#related').html(data[4]);
            setTimeout( function(){
              $('.select2').select2();
            },0)
        }
      });
}

$('#second_sub_category').on('change',function(){
    let subcategory = $('#second_sub_category').val();
  $.ajax({
          url : '/admin/update-secondSubcategory',
          type: "GET",
          data: {product_id:product_id,data:subcategory},
          dataType: "JSON",
          success: function(data)
          {
            console.log(data);
              // $("#brand_form")[0].reset();
                // $('#updateTile2Cat').modal('hide');
              //  $('.zero-configuration').load(location.href+' .zero-configuration');
                toastr.success(data.message);
                  $.ajax({
      url : '/admin/product-subcategory-get/'+subcategory,
      type: "GET",
      success: function(output)
      {
        // console.log(data)
         $('#third_sub_category').html(output);
      }
 });
          },error: function (data) {
            toastr.error('Subcategory Required', 'Required!');
        }
      });
})
$('#third_sub_category').on('change',function(){
    let subcategory = $('#third_sub_category').val();
  $.ajax({
          url : '/admin/update-thirdSubcategory',
          type: "GET",
          data: {product_id:product_id,data:subcategory},
          dataType: "JSON",
          success: function(data)
          {
            console.log(data);
              // $("#brand_form")[0].reset();
                // $('#updateTile2Cat').modal('hide');
              //  $('.zero-configuration').load(location.href+' .zero-configuration');
                toastr.success(data.message);
          },error: function (data) {
            toastr.error('Subcategory Required', 'Required!');
        }
      });
})
$('#price_type').change(function(){
  let price_type = $('#price_type').val();
   $.ajax({
        url: '/admin/update-price_type',
        method: "GET",
        data: { product_id: product_id, data: price_type },
        dataType: "JSON",
        success: function (data) {
            //console.log(data);
            toastr.success(data.message);
        }
    })
})
$('#value_type').change(function(){
 let value_type = $('#value_type').val();
   $.ajax({
        url: '/admin/update-value_type',
        method: "GET",
        data: { product_id: product_id, data: value_type },
        dataType: "JSON",
        success: function (data) {
            //console.log(data);
          toastr.success(data.message);
        }
    })
})
$('#amount').change(function(){
  let amount = $('#amount').val();
   $.ajax({
        url: '/admin/update-amount',
        method: "GET",
        data: { product_id: product_id, data: amount },
        dataType: "JSON",
        success: function (data) {
            //console.log(data);
            toastr.success(data.message);
        }
    })
})
$('#length').change(function(){
  let length = $('#length').val();
   $.ajax({
        url: '/admin/update-length',
        method: "GET",
        data: { product_id: product_id, data: length },
        dataType: "JSON",
        success: function (data) {
            //console.log(data);
            toastr.success(data.message);
        }
    })
});
$('#brands').change(function(){
    let brands = $('#brands').val();
   $.ajax({
        url: '/admin/update-tiles-brands',
        method: "GET",
        data: { product_id: product_id, data: brands },
        dataType: "JSON",
        success: function (data) {
            //console.log(data);
            toastr.success(data.message);
        }
    })
})
$('#sub_category').change(function(){
    let sub_category = $('#sub_category').val();
   $.ajax({
        url: '/admin/update-tiles-sub_category',
        method: "GET",
        data: { product_id: product_id, data: sub_category },
        dataType: "JSON",
        success: function (data) {
            //console.log(data);
            toastr.success(data.message);
    $.ajax({
      url : '/admin/product-subcategory-get/'+sub_category,
      type: "GET",
      success: function(output)
      {
        // console.log(data)
         $('#second_sub_category').html(output);
      }
 });
        }
    })
});
function relatedFunction(){
  var r_p = $('#related_product').val();

  $.ajax({
        url: '/admin/update-tiles-related_product',
        method: "GET",
        data: { product_id: product_id, data: r_p },
        dataType: "JSON",
        success: function (data) {
          toastr.success(data.message);
        }
  });
 
  
}
function uploadGallery(pro_id){
    $('#product_page_id').val(pro_id);
    $('#product_get_id').val(pro_id);
$('#gallery_modal').modal('show');

}

$('#notes').on('change', function(){
  let notes = $(this).val(); 
  $.ajax({
        url: '/admin/update-tiles-notes',
        method: "GET",
        data: { product_id: product_id, data: notes },
        dataType: "JSON",
        success: function (data) {
          toastr.success(data.message);
        }
  });
})


</script>


@endsection
