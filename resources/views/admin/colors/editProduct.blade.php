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
            <input type="hidden" name="product_id" value="{{$product->id}}">
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
                                <input type="text" id="product_name" class="form-control" value="{{$product->product_name}}"
                                  name="product_name">
                                </div>
                              </div>
                              <div class="form-group row">
                                      <label class="col-md-3 label-control" for="Select Brand">Select Sub Category</label>
                                      <div class="col-md-9">
                                        <select name="sub_category" id="sub_category" class="form-control">
                                        <option value="" selected="" disabled="">Select </option>
                                          @foreach($category as $sub)
                                          <option value="{{$sub->id}}" {{$product->sub_category == $sub->id ? "selected":''}}>{{$sub->category_name}} </option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>

                                    <div class="form-group row">
                                      <label class="col-md-3 label-control" for="Select tax_type">Tax Type</label>
                                      <div class="col-md-9">
                                        <select name="tax_type" id="tax_type" class="form-control">
                                        <option value="" selected="" disabled="">Select The Tax Type </option>
                                        <option value="in" <?php echo $product->tax_type == 'in'? 'selected':''?>>Inclusive</option>
                                        <option value="out" <?php echo $product->tax_type == 'out'? 'selected':''?>>Exclusive</option>

                                        </select>
                                      </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 label-control"  for="projectinput1">TAX Percentage (%)</label>
                                        <div class="col-md-9">
                                        <input type="text" class="form-control" name="tax" id="tax" value="{{$product->tax}}">
                                      </div>
                                      </div>


                                     <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Finishers</label>
                                <div class="col-md-9">
                                <input type="text" id="finishers" class="form-control" value="{{$guide->finishers}}"
                                  name="finishers">
                                </div>
                              </div>

                               <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Coverage</label>
                                <div class="col-md-9">
                                  <input type="text" id="coverage" class="form-control" value="{{$guide->coverage}}"
                                  name="coverage">
                                </div>
                              </div>

                               <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Drying Time</label>
                                <div class="col-md-9">
                                  <input type="text" id="drying_time" class="form-control" value="{{$guide->drying}}"
                                  name="drying_time">
                                </div>
                              </div>

                               <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Coats</label>
                                <div class="col-md-9">
                                  <input type="text" id="coats" class="form-control" value="{{$guide->coating}}"
                                  name="coats">
                                </div>
                              </div>
                               <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Product Image</label>
                                <div class="col-md-9">
                                  <input type="file" id="product_image" class="form-control" 
                                  name="product_image">
                                </div>
                              </div>
                               <div class="form-group row">
                                <label class="col-md-3 label-control" for="projectinput1">Description Image</label>
                                <div class="col-md-9">
                                  <input type="file" id="description_image" class="form-control" 
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
                            {{$product->product_description}}
                          </textarea>
                        </div>

                    </div>
                  </div>
                </div>
              </div>
                </div>


                <div class="row">
                
                   <div class="col-md-12">
                        <div class="card">
                      <div class="card-header">
                        
                        <h4 class="card-title">litreage and Price </h4>
                        
                      </div>
                      <div class="card-content collpase show">
                        <div class="card-body">
                          <button class="btn btn-primary" type="button" id="addLitPriceBox"> Add lit & price</button>
                          <hr class="pb-2">

                          @if(count($paintLit) >0)
                          @foreach($paintLit as $data)
                        <div class="row" id="litPriceBoxEdit{{$data->id}}">
                            <div class="col-md-3">                            <div class="form-group">
                                <label class="label-control" for="projectinput1">Dis / High</label>
                            <select name="price_type_edit" id="price_type_edit{{$data->id}}" class="form-control" onchange="paint_lit_change('price_type_edit',{{$data->id}})">
                                   
                                        <option <?php echo $data->price_type == null ? 'selected' : '' ?> value="" selected="" disabled="">Select </option>
                                       
                                          <option value="discount" <?php echo $data->price_type == 'discount' ? 'selected' : '' ?>>Discount </option>
                                          <option value="high" <?php echo $data->price_type == 'high' ? 'selected' : '' ?>>High </option>
                                          
                                        </select>
                              </div></div>
                            <div class="col-md-3">                            <div class="form-group">
                                <label class="label-control" for="projectinput1">Litreage</label>
                            <select name="paint_lit_edit" id="paint_lit_edit{{$data->id}}" class="form-control" onchange="paint_lit_change('paint_lit_edit',{{$data->id}})">
                                      
                                        <option <?php echo $data->paint_lit == null ? 'selected' : '' ?> selected="" disabled="">Select </option>
                                        
                                          <option <?php echo $data->paint_lit == '500' ? 'selected' : '' ?> value="500">500 Lit </option>
                                          <option <?php echo $data->paint_lit == '1' ? 'selected' : '' ?> value="1">1 Lit </option>
                                          <option <?php echo $data->paint_lit == '4' ? 'selected' : '' ?> value="4">4 Lit </option>
                                          <option <?php echo $data->paint_lit == '20' ? 'selected' : '' ?> value="20">20 Lit </option>
                                          <option <?php echo $data->paint_lit == '10' ? 'selected' : '' ?> value="10">10 Lit </option>
                                         
                                        </select>
                              </div></div>
                            <div class="col-md-2">                            <div class="form-group">
                                <label class="label-control" for="projectinput1">Type</label>
                            <select name="value_type_edit" id="value_type_edit{{$data->id}}"  class="form-control" onchange="paint_lit_change('value_type_edit',{{$data->id}})">
                                    
                                        <option <?php echo $data->value_type == null ? 'selected' : '' ?> selected="" disabled="">Select </option>
                                    
                                          <option <?php echo $data->value_type == 'percentage' ? 'selected' : '' ?> value="percentage">Percentage </option>
                                          <option <?php echo $data->value_type == 'amount' ? 'selected' : '' ?> value="amount">Amount </option>
                                   
                                        </select>
                              </div></div>
                            <div class="col-md-2"><div class="form-group">
                                <label class="label-control" for="projectinput1">Value</label>
                                 @if($data->amount == null)
                            <input type="text" class="form-control" id="amount_edit{{$data->id}}" name="amount_edit" onchange="paint_lit_change('amount_edit',{{$data->id}})">
                                @else
                            <input type="text" id="amount_edit{{$data->id}}" class="form-control" name="amount_edit" value="{{$data->amount}}" onchange="paint_lit_change('amount_edit',{{$data->id}})">
                                @endif
                              </div></div>
                              <div class="col-md-2"><div class="form-group">
                                <label class="label-control" for="projectinput1">Price</label><i class="ft-minus-circle text-danger remove_btn" onclick="removeLitAndPriceEdit({{$data->id}})" style="float:right"></i>
                                 <input type="text" class="form-control" id="price_edit{{$data->id}}" value="{{$data->price}}" name="price" onchange="paint_lit_change('price_edit',{{$data->id}})">
                          </div></div>
                                </div>
                          @endforeach
                          @endif

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
                        
                        <h4 class="card-title">Product Feature</h4>
                        
                      </div>
                      <div class="card-content collpase show">

                        <div class="card-body">
                          <button class="btn btn-primary" type="button" id="addFeature"> Add Feature</button>
                          <hr class="pb-2">

                          @foreach($features as $row)
                        <div class="form-group row" id="featureEditRow{{$row->id}}">
                            <div class="col-11">
                        <input type="text" class="form-control" name="features[]" value="{{$row->features}}">
                            </div>
        <div class="col-1"><i class="ft-minus-circle text-danger remove_btn" onclick="removeEditFeature({{$row->id}})"></i></div>
        </div>
                        @endforeach
                          <div id="featurePlace"></div>
                          
                          
                        </div>
                      </div>
                    </div>
                        
                  </div>
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
