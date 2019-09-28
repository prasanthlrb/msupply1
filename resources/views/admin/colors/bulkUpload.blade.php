@extends('admin.app')
@section('section')
<div class="content-wrapper">
          <!-- // callback options section end -->
        <div class="content-header row">
              <div class="col-lg-12 col-md-12">
                <div class="card" >
                  <div class="card-header">

                    <div class="row">
                        <div class="form-group col-sm-12 col-md-12">
                        
                        <button type="reset" id="color-bank-bulk-button" class="btn btn-primary float-right">
                                <i class="ft-plus"></i> Upload
                        </button>
                        </div>
                  </div>
                 
                  <div class="card-content collapse show">

                    <div class="card-body">
                    <form method="post" id="color_bulk_data">
                    {{csrf_field()}}
                        <div class="form-group row">
                                      <label class="col-md-2 label-control" for="Select Brand">Select Product</label>
                                      <div class="col-md-5">
                                        <select name="product_id" id="product_id" class="form-control">
                                        <option value="" selected="" disabled="">Select </option>
                                          @foreach($product as $sub)
                                          <option value="{{$sub->id}}">{{$sub->product_name}} </option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>
                      <div class="row">
                        <div class="form-group col-md-12">
                          <h3 class="content-header-title">Color Bulk Update</h3>
                         <textarea name="color_bank_bulk_data" id="color_bank_bulk_data" rows="50" style="width:100%"></textarea>
                        </div>
                    </div>
                </div>
                  </form>
                  </div>
                </div>
              </div>


            
      </div>
        </div>
</div>
@endsection
@section('extra-js')
<script src="../../../custom/color.js" type="text/javascript"></script>
  @endsection
