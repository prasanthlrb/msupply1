
@extends('admin.app')
@section('extra-css')
<style>
.remove_btn{
    cursor: pointer;
}
</style>

@endsection
@section('section')


<div class="content-wrapper">
<div class="content-body">



        <section id="horizontal-form-layouts">
            <form action="POST" id="product_form_data" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" id="id" name="id">
                <div class="row">
                  <div class="col-md-6">
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
                                      <label class="col-md-3 label-control" for="Select Brand">Select Sub Category</label>
                                      <div class="col-md-9">
                                        <select name="sub_category" id="sub_category" class="form-control">
                                        <option value="" selected="" disabled="">Select </option>
                                          @foreach($category as $sub)
                                          <option value="{{$sub->id}}">{{$sub->category_name}} </option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>

                              <div class="form-group row">
                                      <label class="col-md-3 label-control" for="Select tax_type">Tax Type</label>
                                      <div class="col-md-9">
                                        <select name="tax_type" id="tax_type" class="form-control">
                                        <option value="" selected="" disabled="">Select The Tax Type </option>
                                        <option value="in">Inclusive</option>
                                        <option value="out">Exclusive</option>

                                        </select>
                                      </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control"  for="projectinput1">TAX Percentage (%)</label>
                                        <div class="col-md-9">
                                        <input type="text" class="form-control" name="tax" id="tax">
                                      </div>
                                      </div>


                              <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Finishers</label>
                                <div class="col-md-9">
                                  <input type="text" id="finishers" class="form-control" placeholder="Product Name"
                                  name="finishers">
                                </div>
                              </div>

                               <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Coverage</label>
                                <div class="col-md-9">
                                  <input type="text" id="coverage" class="form-control" placeholder="Product Name"
                                  name="coverage">
                                </div>
                              </div>

                               <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Drying Time</label>
                                <div class="col-md-9">
                                  <input type="text" id="drying_time" class="form-control" placeholder="Product Name"
                                  name="drying_time">
                                </div>
                              </div>

                               <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Coats</label>
                                <div class="col-md-9">
                                  <input type="text" id="coats" class="form-control" placeholder="Product Name"
                                  name="coats">
                                </div>
                              </div>
                               <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Product Image</label>
                                <div class="col-md-9">
                                  <input type="file" id="product_image" class="form-control" placeholder="Product Name"
                                  name="product_image">
                                </div>
                              </div>
                               <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Description Image</label>
                                <div class="col-md-9">
                                  <input type="file" id="description_image" class="form-control" placeholder="Product Name"
                                  name="description_image">
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
                  <div class="col-md-6">
                    <div class="card">
                      <div class="card-header">
                        
                        <h4 class="card-title">Product Feature</h4>
                        
                      </div>
                      <div class="card-content collpase show">
                        <div class="card-body">
                          <button class="btn btn-primary" type="button" id="addFeature"> Add Feature</button>
                          <hr class="pb-2">
                          
                          <div id="featurePlace"></div>
                          
                          
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                        <div class="card">
                      <div class="card-header">
                        
                        <h4 class="card-title">litreage and Price </h4>
                        
                      </div>
                      <div class="card-content collpase show">
                        <div class="card-body">
                          <button class="btn btn-primary" type="button" id="addLitPriceBox"> Add lit & price</button>
                          <hr class="pb-2">

                          
                         


                          <div id="litandpricePlace"></div>
                          
                          
                        </div>
                      </div>
                    </div>
                  </div>
                  
                </div>
              </section>

  </form>

                    <div class="row">
                        <div class="col-md-6">
                          <div class="card">
                            <div class="card-header">



                            </div>
                            <div class="card-content collpase show">
                              <div class="card-body">


                                  <div class="form-actions">
                                    <button type="button" class="btn btn-success" id="color_product_save">
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
<script src="../../../custom/color.js" type="text/javascript"></script>



@endsection
