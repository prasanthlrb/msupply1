
@extends('admin.app')
@section('extra-css')
<style>
  .nav-vertical .nav-left.nav-tabs li.nav-item a.nav-link {
      min-width: 11.5rem !important;

  }

 .single-product{
  display: block;
  width: 100%;
  height: 300px;
  background-color: white;
  border-radius: 5px;

 }
 .single-dynamic-product{
  display: block;
  width: 100%;
  height: 185px;
  background-color: white;
  border-radius: 5px;

 }
 .seo-preview-content h3 {
  color: #1a0dab;
  font-size: 18px;
  font-family: arial,sans-serif;
  font-weight: normal;
}
.seo-preview-content p.link {
  color: #006621;
  font-size: 14px;
  font-family: arial,sans-serif;
  font-weight: normal;
  line-height: 5px;
}
.hide-form{
  display: none;
}
.nav-vertical {
  padding: 35px;
}


</style>
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/selects/select2.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/icheck/icheck.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/toggle/switchery.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/switch.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/editors/tinymce/tinymce.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/file-uploaders/dropzone.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/ui/prism.min.css">
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/file-uploaders/dropzone.css">

@endsection
@section('section')


<div class="content-wrapper">
<div class="content-body">



        <section id="horizontal-form-layouts">
            <form action="POST" id="product_form_data" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" id="id" name="id">
                <div class="row">
                  <div class="col-md-8">
                    <div class="col-md-12">
                    <div class="card">
                      <div class="card-content collpase show">
                        <div class="card-body">

                            <div class="form-body">
                              <h4 class="form-section"><i class="ft-shopping-cart"></i> Add New Product</h4>

                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Product Name</label>
                                <div class="col-md-9">
                                  <input type="text" id="product_name" class="form-control" placeholder="Product Name"
                                  name="product_name">
                                </div>
                              </div>

                              <div class="form-group row">
                                    <label class="col-md-3 label-control" for="Select Brand">Select Category</label>
                                    <div class="col-md-9">
                                      <select style="width:100%" name="category" id="category" class="select2 form-control col-md-12" placeholder="search for Category">
                                        @foreach($category as $cat)
                                        <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                              <div class="form-group row">
                                    <label class="col-md-3 label-control" for="Select Brand">Select Sub Category</label>
                                    <div class="col-md-9">
                                      <select style="width:100%" name="sub_category" id="sub_category" class="select2 form-control col-md-12" placeholder="search for Category">
                                       <option value="" selected="" disabled="">Select Sub Category</option>
                                        @foreach($category as $cat)
                                        <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                              <div class="form-group row">
                                    <label class="col-md-3 label-control" for="Select Brand">Select Second Sub Category</label>
                                    <div class="col-md-9">
                                      <select style="width:100%" name="second_sub_category" id="second_sub_category" class="select2 form-control col-md-12" placeholder="search for Category">
                                         <option value="" selected="" disabled="">Select Second Category</option>
                                        @foreach($category as $cat)
                                        <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>
                              <div class="form-group row">
                                    <label class="col-md-3 label-control" for="Select Brand">Select Third Sub Category</label>
                                    <div class="col-md-9">
                                      <select style="width:100%" name="third_sub_category" id="third_sub_category" class="select2 form-control col-md-12" placeholder="search for Category">
                                        <option value="" selected="" disabled="">Select Third Category</option>
                                        @foreach($category as $cat)
                                        <option value="{{$cat->id}}">{{$cat->category_name}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                      <label class="col-md-3 label-control" for="Select Brand">Select Brand</label>
                                      <div class="col-md-9">
                                        <select name="brand_name" id="brand_name" class="form-control">
                                        <option value="" selected="" disabled="">Select Brand</option>
                                          @foreach($brand as $brand)
                                          <option value="{{$brand->id}}">{{$brand->brand}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>

                                  <div class="form-group row">
                                      <label class="col-md-3 label-control" for="Select category">Select Product Group</label>
                                      <div class="col-md-9">
                                        <select name="group" id="group" class="form-control">
                                        <option value="" selected="">Select Product Group</option>
                                          @foreach($group as $group)
                                          <option value="{{$group->id}}">{{$group->group}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>
                                  </div>




                        </div>
                      </div>
                    </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-12">
                    <img id="blah" src="{{ asset('app-assets/images/product-image.png')}}" alt="your image" class="single-product text-center" />
                    <input type='file' id="imgInp" name="imgInp" style="display: none;"/>
                    <button type="button" id="single-product" class="btn btn-info block single-pro"><i class="la la-plus"></i> Set product image</button>
                  </div>
                </div>

             <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Product Description</h4>


                  </div>
                  <div class="card-content collapse show">
                    <div class="card-body">

                        <div class="form-group">
                          <textarea id="product_description" name="product_description" class="tinymce">

                          </textarea>
                        </div>

                    </div>
                  </div>
                </div>
              </div>
             </div>





               <div class="row">


                    <div class="col-12">
                      <div class="card">


                        <div class="card-content">
                          <div class="card-body">
                              <div class="form-group row">
                                  <label class="col-md-3 label-control text-bold-600 font-medium-2" for="projectinput6">Product Data</label>

                                </div>

                            <div class="nav-vertical">
                              <ul class="nav nav-tabs nav-left">
                                <li class="nav-item tap1">
                                  <a class="nav-link active" id="baseVerticalLeft2-tab1" data-toggle="tab" aria-controls="tabVerticalLeft21"
                                  href="#tabVerticalLeft21" aria-expanded="true"><i class="la la-align-justify"></i> General</a>
                                </li>
                                <li class="nav-item tap2">
                                  <a class="nav-link" id="baseVerticalLeft2-tab2" data-toggle="tab" aria-controls="tabVerticalLeft22"
                                  href="#tabVerticalLeft22" aria-expanded="false"><i class="la la-header"></i> Inventory</a>
                                </li>
                                <li class="nav-item tap4">
                                  <a class="nav-link" id="baseVerticalLeft2-tab3" data-toggle="tab" aria-controls="tabVerticalLeft23"
                                  href="#tabVerticalLeft23" aria-expanded="false"><i class="la la-truck"></i> Shipping  </a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="baseVerticalLeft2-tab4" data-toggle="tab" aria-controls="tabVerticalLeft24"
                                  href="#tabVerticalLeft24" aria-expanded="false"><i class="la la-chain"></i> Linked Products</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="baseVerticalLeft2-tab5" data-toggle="tab" aria-controls="tabVerticalLeft25"
                                  href="#tabVerticalLeft25" aria-expanded="false"><i class="la la-send-o"></i> Attributes</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="baseVerticalLeft2-tab7" data-toggle="tab" aria-controls="tabVerticalLeft27"
                                  href="#tabVerticalLeft27" aria-expanded="false"><i class="la la-bank"></i> TAX</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="baseVerticalLeft2-tab8" data-toggle="tab" aria-controls="tabVerticalLeft28"
                                    href="#tabVerticalLeft28" aria-expanded="false"><i class="ft-layout"></i> Options</a>
                                  </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="baseVerticalLeft2-tab9" data-toggle="tab" aria-controls="tabVerticalLeft29"
                                    href="#tabVerticalLeft29" aria-expanded="false"><i class="ft-layers"></i> Custom Qty</a>
                                  </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="baseVerticalLeft2-tab10" data-toggle="tab" aria-controls="tabVerticalLeft30"
                                    href="#tabVerticalLeft30" aria-expanded="false"><i class="ft-folder"></i> Units</a>
                                  </li>
                                     <li class="nav-item">
                                  <a class="nav-link" id="baseVerticalLeft2-tab11" data-toggle="tab" aria-controls="tabVerticalLeft31"
                                  href="#tabVerticalLeft31" aria-expanded="false"><i class="la la-gear"></i> Distance Price</a>
                                </li>
                                     <li class="nav-item">
                                  <a class="nav-link" id="baseVerticalLeft2-tab12" data-toggle="tab" aria-controls="tabVerticalLeft32"
                                  href="#tabVerticalLeft32" aria-expanded="false"><i class="la la-gear"></i> Discount / high</a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="baseVerticalLeft2-tab6" data-toggle="tab" aria-controls="tabVerticalLeft26"
                                  href="#tabVerticalLeft26" aria-expanded="false"><i class="la la-gear"></i> Advanced</a>
                                </li>
                             
                              </ul>
                              <div class="tab-content px-1">
                                <div role="tabpanel" class="tab-pane active tap1" id="tabVerticalLeft21" aria-expanded="true"
                                aria-labelledby="baseVerticalLeft2-tab1">

                                <div class="form-group" style="padding-left:10px">
                                    <label for="projectinput1">Regular price</label>
                                    <input type="text" id="regular_price" class="form-control" name="regular_price">
                                  </div>

                                <div class="form-group" style="padding-left:10px">
                                    <label for="projectinput1">sales price</label>
                                    <input type="text" id="sales_price" class="form-control" name="sales_price">
                                  </div>
                                <div class="form-group" style="padding-left:10px">
                                    <label for="projectinput1">Minimum Order Limit</label>
                                    <input type="text" id="order_limit" class="form-control" name="order_limit">
                                  </div>

                                </div>
                                <div class="tab-pane tap2" id="tabVerticalLeft22" aria-labelledby="baseVerticalLeft2-tab2">
                                    <div class="form-group" style="padding-left:10px">
                                        <label for="projectinput1">SKU</label>
                                        <input type="text" id="sku" class="form-control" name="sku">
                                      </div>

                                    <div class="form-group" style="padding-left:10px">
                                        <label for="projectinput1">Stock quantity</label>
                                        <input type="text" id="stock_quantity" class="form-control" name="stock_quantity">
                                      </div>

                                    <div class="form-group" style="padding-left:10px">
                                        <label for="projectinput1">Low stock threshold</label>
                                        <input type="text" id="low_stock" class="form-control" name="low_stock">
                                      </div>

                                </div>
                                <div class="tab-pane tap4" id="tabVerticalLeft23" aria-labelledby="baseVerticalLeft2-tab3" style="padding:30px">

                                        <div class="row">
                                                <div class="col-md-6">

                                                <label for="projectinput1">Weight (kg)</label>
                                                <input type="text" class="form-control" name="weight" id="weight">
                                              </div>

                                                <div class="col-md-6">

                                                <label for="projectinput1">No of Items</label>
                                                <input type="text" class="form-control" name="items" id="items">
                                              </div>

                                        </div>

                                    <div class="form-group" style="padding-top:10px">

                                        <div class="row">
                                          <div class="col-md-4">
                                                <label for="projectinput1">Dimensions length (cm)</label>
                                            <input type="text" class="form-control" name="length" id="length" placeholder="Length">
                                          </div>
                                          <div class="col-md-4">
                                                <label for="projectinput1">Width</label>
                                            <input type="text" class="form-control" id="width" name="width" placeholder="Width">
                                          </div>
                                          <div class="col-md-4">
                                                <label for="projectinput1">Height</label>
                                            <input type="text" class="form-control" name="height" id="height" placeholder="Height">
                                          </div>
                                        </div>
                                      </div>

                                </div>
                                <div class="tab-pane" id="tabVerticalLeft24" aria-labelledby="baseVerticalLeft2-tab4">

                                      <div class="form-group " style="padding-left:10px">
                                          <label for="">Related Product</label>
                                        <select style="width:100%" placeholder="search for product" id="related_product" name="related_product[]" class="select2 form-control col-md-12" multiple="multiple">
                                          <optgroup label="Related Product">
                                          @foreach ($product as $product1)
                                            <option value="{{$product1->id}}">{{$product1->product_name}}</option>
                                          @endforeach
                                          </optgroup>
                                        </select>
                                      </div>

                            </div>
                            <div class="tab-pane" id="tabVerticalLeft25" aria-labelledby="baseVerticalLeft2-tab5">
                                {{-- <form method="post" id="termsData">
                                {{ csrf_field() }} --}}
                                {{-- <input type="hidden" name="pro_id" value="10"> --}}
                                  <div class="form-group">
                                    <label for="projectinput6">Select Attribute</label>
                                    <div class="">
                                      <select style="width:100%" name="attribute" id="attribute" class="form-control col-md-12" >
                                      <option value="">Select The Atribute</option>
                                        @foreach($attribute as $attribute)
                                        <option value="{{$attribute->id}}">{{$attribute->name}}</option>
                                        @endforeach
                                      </select>
                                    </div>

                                  <div id="show_terms">

                                  </div>

                                  </div>


                                {{-- </form> --}}
                                </div>

                                <div class="tab-pane" id="tabVerticalLeft27" aria-labelledby="baseVerticalLeft2-tab7">
                                    <div class="form-group">
                                        <label for="projectinput6">Tax Type</label>

                                          <select name="tax_type" id="tax_type" class="form-control" >
                                          <option value="" selected disabled>Select The Tax Type</option>

                                            <option value="in">Inclusive</option>
                                            <option value="out">Exclusive</option>

                                          </select>
                                        </div>
                                    <div class="form-group">
                                        <label for="projectinput1">TAX Percentage (%)</label>
                                        <input type="text" class="form-control" name="tax" id="tax">
                                      </div>
                                  </div>

                                  <div class="tab-pane p-2" id="tabVerticalLeft28" aria-labelledby="baseVerticalLeft2-tab8">
                                      <button class="btn btn-primary float-right" type="button" id="addOptionSet"> Add Options Set</button>

                                      <div id="optionSetPlace"></div>
                                  </div>

                                  <div class="tab-pane p-2" id="tabVerticalLeft31" aria-labelledby="baseVerticalLeft2-tab11">
                                    <div class="row">
                                      <div class="col-md-12">
                                        <button type="button" class="btn btn-primary" id="add_distance_price">Add New</button>

                                      </div>
                                      <div class="col-md-12 pt-4" id="distance-price">

                                          

                                      </div>
                                    </div>

                                  </div>


                                <div class="tab-pane p-2" id="tabVerticalLeft32" aria-labelledby="baseVerticalLeft2-tab12">
                                  <div class="row">
                            <div class="col-md-4">                            <div class="form-group">
                                <label class="label-control" for="projectinput1">Dis / High</label>
                                  <select name="price_type" id="price_type" class="form-control">
                                        <option value="" selected="" disabled="">Select </option>
                                          <option value="discount">Discount </option>
                                          <option value="high">High </option>
                                        </select>
                              </div></div>
                            <div class="col-md-4">                            <div class="form-group">
                                <label class="label-control" for="projectinput1">Type</label>
                                  <select name="value_type"  class="form-control">
                                        <option value="" selected="" disabled="">Select </option>
                                          <option value="percentage">Percentage </option>
                                          <option value="amount">Amount </option>
                                        </select>
                              </div></div>
                            <div class="col-md-4"><div class="form-group">
                                <label class="label-control" for="projectinput1">Value</label>
                                  <input type="text" id="amount" class="form-control" placeholder="Product Name"
                                  name="amount">
                              </div></div>
                          </div>


                                  </div>

                                <div class="tab-pane" id="tabVerticalLeft26" aria-labelledby="baseVerticalLeft2-tab6">
                                    <div class="dropdown-item">
                                        <input type="checkbox" name="featured" id="featured" class="switchery-xs" />
                                        <label for="switchery1" class="card-title ml-1">Enable as a Todays Deals product</label>
                                      </div>
                                    <div class="dropdown-item">
                                        <input type="checkbox" name="hot_product" id="hot_product" class="switchery-xs" />
                                        <label for="switchery2" class="card-title ml-1">Enable as a Bestselling Products</label>
                                      </div>
                                    <div class="dropdown-item">
                                        <input type="checkbox" name="new_product" id="new_product" class="switchery-xs" />
                                        <label for="switchery3" class="card-title ml-1">Enable as a On Sale Products</label>
                                      </div>
                                    <div class="dropdown-item">
                                        <input type="checkbox" name="recommended" id="recommended" class="switchery-xs" />
                                        <label for="switchery4" class="card-title ml-1">Enable as a recommended product</label>
                                      </div>
                                    <div class="dropdown-item">
                                        <input type="checkbox" name="review" id="review" class="switchery-xs" />
                                        <label for="switchery5" class="card-title ml-1">Enable as a product review</label>
                                      </div>

                                      <div class="dropdown-item">
                                        <input type="checkbox" name="group_product" id="group_product" class="switchery-xs" />
                                        <label for="switchery5" class="card-title ml-1">Enable Group Product options</label>
                                      </div>
                                </div>

                                {{-- Custom Quantity --}}
                                <div class="tab-pane p-2" id="tabVerticalLeft29" aria-labelledby="baseVerticalLeft2-tab9">
                                        <button class="btn btn-primary float-right" type="button" id="addCustomQty"> Add Custom Qty</button>

                                        <div id="CustomQtyPlace"></div>
                                    </div>
                                {{-- Units Module --}}
                                <div class="tab-pane p-2" id="tabVerticalLeft30" aria-labelledby="baseVerticalLeft2-tab10">

                                    <div class="form-group">
                                        <label for="projectinput6">Select Units</label>
                                        <div class="">
                                          <select style="width:100%" name="select_units" id="select_units" class="form-control col-md-12" >
                                          <option value="">Select The Units</option>
                                            @foreach($units as $unit)
                                            <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                        <br>
                                        <div id="show_units"></div>
                                    </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>

              </section>
                  <div class="row">
                        <div class="col-6">
                          <div class="card">
                            <div class="card-header">
                              <h4 class="card-title">Product SEO</h4>
                              <p><i class="la la-eye"></i> Google search preview</p><hr>

                            </div>
                            <div class="card-content collapse show">
                              <div class="card-body">

                    <div class="box box-solid">

                        <div class="box-body">
                          <div class="seo-preview-content">

                            <h3 id="seo-page-title">Page Title</h3>
                            <p class="link"><?php
                              echo URL::to('/'); ?>/product/</p>
                            <p class="description" id="seo-description">Enter your meta tag description.</p>
                          </div><hr>
                          <div class="seo-content">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <div class="col-md-12">
                                  <input type="text" class="form-control" name="seo_title" id="seo_title" placeholder="page title" value="">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <div class="col-md-12">
                                    <textarea id="seo_description" class="form-control" name="seo_description" placeholder="meta tag description"></textarea>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="col-md-12">
                                    <textarea id="seo_keywords" class="form-control" name="seo_keywords" placeholder="meta tag keywords by comma separator. exxample - tshirt, mobile"></textarea>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>


                        </div>
                      </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </form>


                        <div class="col-6">
                            <div class="card">
                              <div class="card-header">
                                <h4 class="card-title">Product Gallery</h4>

                              </div>
                              <div class="card-content collapse show">
                                <div class="card-body">
                                    <p class="card-text">maximum file size<code>1 MB</code> number of files<code>5</code>.</p>
                                      <button style="display:none" id="testSubmit" class="btn btn-primary mb-1"><i class="ft-trash"></i>Clear All Image</button>
                                      <form method="post" action="{{ url('/admin/images-save') }}"
                                      enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="product_get_id" id="product_get_id">
                                    <div class="dz-message">
                                        <div class="col-xs-8">
                                            <div class="message">
                                                <p>Drop files here or Click to Upload</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="fallback">
                                        <input type="file" name="file" id="productGallery" multiple>
                                    </div>

                                </form>
                                </div>
                              </div>
                            </div>
                          </div>

                  </div>


                    <div class="row">
                        <div class="col-md-6">
                          <div class="card">
                            <div class="card-header">



                            </div>
                            <div class="card-content collpase show">
                              <div class="card-body">


                                  <div class="form-actions">
                                    <button id="btnSave" onclick="Save_product()" type="button" class="btn btn-primary">
                                      <i class="la la-check-square-o"></i> Save & Publish
                                    </button>
                                  </div>

                              </div>
                            </div>
                          </div>
                        </div>

                    </div>

</div>
</div>
</div>

@endsection
@section('extra-js')
<script src="../../../app-assets/vendors/js/editors/tinymce/tinymce.js" type="text/javascript"></script>
<script src="../../../app-assets/js/scripts/editors/editor-tinymce.js" type="text/javascript"></script>
<script src="../../../app-assets/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
<script src="../../../app-assets/vendors/js/forms/toggle/switchery.min.js" type="text/javascript"></script>
<script src="../../../app-assets/js/scripts/dropdowns/dropdowns.js" type="text/javascript"></script>
<script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js" type="text/javascript"></script>
<script src="../../../app-assets/js/scripts/forms/select/form-select2.js" type="text/javascript"></script>
<script src="{{ url('/dropzone/dropzone.js') }}"></script>
    <script src="{{ url('/dropzone/config-dropzone.js') }}"></script>

<script>

var distance_price_data = [];
var attributes = [];
var units = [];
$('.catalog-menu').addClass('active');
function Save_product(){

  //$("#btnSave").attr("disabled", "disabled");
  var product_form_data = new FormData($('#product_form_data')[0]);
  // var productGallery = $('#productGallery').val();
 var product_description = tinyMCE.activeEditor.getContent();
   product_form_data.append('product_description',product_description);
   product_form_data.append("optionSet", addOptionSet);
   product_form_data.append("attribute", attributes);
   product_form_data.append("units", units);
   $("span").find('.text-danger').remove();
  $.ajax({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    url : '/admin/productSave',
    type: "POST",
    data: product_form_data,
    contentType: false,
    processData: false,
    dataType: "JSON",
    success: function(data)
    {
      $('#product_get_id').val(data);
      //console.log(data);
       //$('input[name=pro_id]').val(data);
      // $('input[name=personal]').val(data);
      //$("#product_form_data")[0].reset();
      toastr.success('Product Store Successfully', 'Successfully Save');
      //location.reload();
       CallDropZone();
    },
    error: function (textStatus, errorThrown) {
      $("#btnSave").removeAttr("disabled");
      var errorData = textStatus.responseJSON.errors;
      $.each(errorData, function(i, obj) {
        toastr.error(obj[0],i);
        //$('[name="'+i+'"]').after('<span class="text-danger">'+obj[0]+' </span>');
      });
    }
  });

}
function CallDropZone(){
  $('#testSubmit').trigger('click')
}


$('input[name="shipping_type"]').on('ifClicked', function(event){
  if(this.value == 1){
    $('#shipping-amount').addClass('hide-form');
  }else{
    $('#shipping-amount').removeClass('hide-form');
  }
});

  $("#seo_title").on("keyup", function() {
    var title = $(this).val();
    console.log(title.length)
    $('#seo-page-title').text(title);
    if(title.length >= 67){
      $("#seo_title").addClass('text-danger');
    }else{
      $("#seo_title").removeClass('text-danger');
    }
    });
  $("#seo_description").on("keyup", function() {
    var title = $(this).val();
    console.log(title.length)
    $('#seo-description').text(title);
    if(title.length >= 155){
      $("#seo_description").addClass('text-danger');
    }else{
      $("#seo_description").removeClass('text-danger');
    }
    });


$("#attribute").on("change", function(){

  var id = $('#attribute').val();
  attributes.push(id);
  console.log(attributes);
    $.ajax({
        url : '/admin/get_terms/'+id,
        type: "GET",
        success: function(data)
        {
          console.log(data);
          $('#attribute').val('');

          $("#attribute option[value=" + id + "]").prop("disabled", true);;

          $( "#show_terms" ).after(function() {
            //$('#show_terms').html(data);
            return "<div>" + data + "</div>";
          });
        }
   });
});

function RemovePop(id){
  if(confirm('Are you sure delete this row?'))
  {
    attributes = jQuery.grep(attributes, function(value) {
      return value != id;
    });
    $( "#"+id ).remove();
    $("#attribute option[value=" + id + "]").prop("disabled", false);
  }
}


function save_terms(){

  var termsData = new FormData($('#termsData')[0]);
  termsData.append("attribute", attributes);
  console.log(termsData.getAll('size'));
  $.ajax({
    url : '/admin/attribute-terms-save',
    type: "POST",
    data: termsData,
    contentType: false,
    processData: false,
    dataType: "JSON",
    success: function(data)
    {
      console.log(data);
      $('#testSubmit').trigger('click')
    },
    error: function (textStatus, errorThrown) {


  }
});
}

function initImageUpload(box) {
  let uploadField = box.querySelector('.image-upload');

  uploadField.addEventListener('change', getFile);

  function getFile(e){
    let file = e.currentTarget.files[0];
    checkType(file);
  }

  function previewImage(file){
    let thumb = box.querySelector('.js--image-preview'),
        reader = new FileReader();

    reader.onload = function() {
      thumb.style.backgroundImage = 'url(' + reader.result + ')';
    }
    reader.readAsDataURL(file);
    thumb.className += ' js--no-default';
  }

  function checkType(file){
    let imageType = /image.*/;
    if (!file.type.match(imageType)) {
      throw 'Datei ist kein Bild';
    } else if (!file){
      throw 'Kein Bild gewählt';
    } else {
      previewImage(file);
    }
  }

}




function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#imgInp").change(function() {
  readURL(this);
});

$("#single-product").click(function () {
  $("#imgInp").trigger('click');
});
$('.tap3').addClass('hidden');
$('#group-product').on('change',function(){
  var change_data = $(this).val();
  if(change_data == 1){
    $('.tap3').addClass('hidden');
    $('.tap1').removeClass('hidden');
    $('.tap2').removeClass('hidden');
    //$('.tap4').removeClass('active');
  }else{
    $('.tap1').addClass('hidden');
    $('.tap2').addClass('hidden');
    $('.tap3').removeClass('hidden');
    //$('.tap4').addClass('active');
  }
});
var addOptionSet = [];
var addOptionSetLocal = 1;
$('#addOptionSet').click(()=>{

   var optionSet = '<div id="optionsetRow'+addOptionSetLocal+'" class="pt-4"><div class="row"><div class="form-group col-6"><label for="projectinput1">Option Set Row '+addOptionSetLocal+'</label><input type="text" class="form-control" name="optionSetRow'+addOptionSetLocal+'" placeholder="Option Label Name"></div>'+
   '<div class="form-group col-6"> <label for="projectinput6">Option Show Type</label><select name="option_show_type'+addOptionSetLocal+'" class="form-control">'+
   '<option value="select">Select Model</option><option value="label">Label Model</option>'+
    '</select></div></div><div class="option1">'+
    '<div class="form-group row">'+
    '<div class="col-4"><input type="text" class="form-control" name="optionName'+addOptionSetLocal+'[]" placeholder="Option Name"></div>'+
    '</div>'+
    '<div class="form-group row">'+
     '<div class="col-4"><input type="text" class="form-control" name="optionName'+addOptionSetLocal+'[]" placeholder="Option Name"></div>'+
     '<div class="col-4"><input type="text" class="form-control" name="current_price'+addOptionSetLocal+'[]" placeholder="Change Original Price"></div>'+
    '<div class="col-4"><input type="text" class="form-control" name="additional_price'+addOptionSetLocal+'[]" placeholder="Additional Price"></div></div><div id="optionPlace'+addOptionSetLocal+'"></div>'+
    '<button class="btn btn-default" type="button" onclick="addOption('+addOptionSetLocal+')">Add Option</button>'+
    '<button class="btn btn-danger float-right" type="button" onclick="removeOptionSet('+addOptionSetLocal+')">Remove Option Set</button><hr></div>';
    addOptionSet.push(addOptionSetLocal)
    addOptionSetLocal++;
    $('#optionSetPlace').append(optionSet);
});

function removeOptionSet(id){
    if(confirm('Are you sure delete this row?'))
  {
    addOptionSet = jQuery.grep(addOptionSet, function(value) {
      return value != id;
    });
    $('#optionsetRow'+id).remove();
  }

}
var optionLineData = [];
var optionLineCount = 1;
function addOption(id){
var option = '<div id="optionLine'+id+'of'+optionLineCount+'"><i class="ft-minus-circle text-danger" style="float:right;cursor:pointer" onclick="removeOptionLabel('+id+','+optionLineCount+')"></i><div class="form-group row">'+
    '<div class="col-4"><input type="text" class="form-control" name="optionName'+id+'[]" placeholder="Option Name"></div>'+
    '<div class="col-4"><input type="text" class="form-control" name="current_price'+id+'[]" placeholder="Change Original Price"></div>'+
    '<div class="col-4"><input type="text" class="form-control" name="additional_price'+id+'[]" placeholder="Additional Price"></div></div></div>';
    optionLineData.push({
      'parent':id,
      'child':optionLineCount
    });
    optionLineCount++;
    $('#optionPlace'+id).append(option);
}
function removeOptionLabel(parent,child){
    $("#optionLine"+parent+'of'+child).remove();
}
var qtyid =1;
var qtyData = [];
$('#addCustomQty').click(()=>{
    var qty = '<div id="customQTY'+qtyid+'">'+
    '<div class="form-group row">'+
    '<div class="col-4"><input type="text" class="form-control" name="customqty[]" placeholder="Enter Your Custom QTY"></div>'+
    '<div class="col-4"><i class="ft-minus-circle text-danger" onclick="removeCustomqty('+qtyid+')"></i></div>'+
    '</div></div>';
    qtyData.push(qtyid);
    qtyid++;
    $('#CustomQtyPlace').append(qty);
});

function removeCustomqty(id){

    if(confirm('Are you sure delete this Custom Qty?'))
  {
    qtyData = jQuery.grep(qtyData, function(value) {
      return value != id;
    });
    $("#customQTY"+id).remove();
  }
}

//units modules
$("#select_units").on("change", function(){

var id = $('#select_units').val();
console.log(id)
units.push(id);
  $.ajax({
      url : '/admin/get-unit/'+id,
      type: "GET",
      success: function(data)
      {
          $('#select_units').val('');
        $("#select_units option[value=" + id + "]").prop("disabled", true);
        $( "#show_units" ).after(function() {
          //$('#show_units').html(data);
          return "<div>" + data + "</div>";
        });
      }
 });
});

function RemoveUnit(id){
    if(confirm('Are you sure delete this row?'))
  {
    units = jQuery.grep(units, function(value) {
      return value != id;
    });
    $( "#unitRow"+id ).remove();
    $("#select_units option[value=" + id + "]").prop("disabled", false);
  }
}

var distance_count_handle = 1;
$('#add_distance_price').on('click', function(){
  let template ='<div class="row pb-2" id="distance_handle'+distance_count_handle+'"><div class="col-md-6">'+
  '<label for="projectinput1">Distance</label><input type="text" class="form-control" name="price_distance[]">'+
  '</div><div class="col-md-6"><i class="ft-minus-circle text-danger" style="float:right;cursor:pointer" onclick="removeDistanceHandle('+distance_count_handle+')"></i><label for="projectinput1">Price</label>'+
  '<input type="text" class="form-control" name="distance_price[]"></div></div>';
  distance_price_data.push(distance_count_handle);
  distance_count_handle++;
$('#distance-price').append(template);
});

function removeDistanceHandle(id){
    if(confirm('Are you sure delete this row?'))
  {
    distance_price_data = jQuery.grep(distance_price_data, function(value) {
      return value != id;
    });
    $( "#distance_handle"+id ).remove();
  }
}

</script>


@endsection
