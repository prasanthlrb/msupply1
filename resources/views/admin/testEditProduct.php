@extends('admin.app')
@section('extra-css')
<style>
    .nav-vertical .nav-left.nav-tabs li.nav-item a.nav-link {
        min-width: 11.5rem !important;

    }

    .single-product {
        display: block;
        width: 100%;
        height: 300px;
        background-color: white;
        border-radius: 5px;

    }

    .single-dynamic-product {
        display: block;
        width: 100%;
        height: 185px;
        background-color: white;
        border-radius: 5px;

    }

    .seo-preview-content h3 {
        color: #1a0dab;
        font-size: 18px;
        font-family: arial, sans-serif;
        font-weight: normal;
    }

    .seo-preview-content p.link {
        color: #006621;
        font-size: 14px;
        font-family: arial, sans-serif;
        font-weight: normal;
        line-height: 5px;
    }

    .hide-form {
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
<link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/bootstrap-treeview.min.css">

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

                        <div class="card">
                            <div class="card-content collpase show">
                                <div class="card-body">

                                    <div class="form-body">
                                        <h4 class="form-section"><i class="ft-shopping-cart"></i> Add New Product</h4>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="projectinput1">Product Name</label>
                                            <div class="col-md-9">
                                                <input type="text" id="product_name" class="form-control" placeholder="Product Name" name="product_name" value="{{$product_find->product_name}}">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="Select Brand">Select Category</label>
                                            <div class="col-md-9">
                                                <select style="width:100%" name="category[]" id="category" class="select2 form-control col-md-12" multiple="multiple" placeholder="search for Category">
                                                    @foreach($category as $cat)
                                                    <option {{in_array($cat->id, $tree_category) ? 'selected' : ''}} value="{{$cat->id}}">{{$cat->category_name}}</option>
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
                                                    <option value="{{$brand->id}}" {{$brand->id == $product_find->brand_name ? 'selected' : ''}}>{{$brand->brand}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="Select category">Select Product Group</label>
                                            <div class="col-md-9">
                                                <select name="group" id="group" class="form-control">
                                                    <option value="" selected="" disabled="">Select Product Group</option>
                                                    @foreach($group as $group)
                                                    <option value="{{$group->id}}" {{$group->id == $product_find->group ? 'selected' : ''}}>{{$group->group}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-md-4 col-sm-12">
                        <img id="blah" src="{{ asset('product_img/'.$product_find->product_image.'')}}" alt="your image" class="single-product text-center" />
                        <input type='file' id="imgInp" name="imgInp" style="display: none;" />
                        {{-- <button type="button" id="single-product" class="btn btn-info block single-pro"><i class="la la-plus"></i> Set product image</button> --}}

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
                                        {{$product_find->product_description}}
                                        </textarea>
                                    </div>

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
                                    <a class="nav-link active" id="baseVerticalLeft2-tab1" data-toggle="tab" aria-controls="tabVerticalLeft21" href="#tabVerticalLeft21" aria-expanded="true"><i class="la la-align-justify"></i> General</a>
                                </li>
                                <li class="nav-item tap2">
                                    <a class="nav-link" id="baseVerticalLeft2-tab2" data-toggle="tab" aria-controls="tabVerticalLeft22" href="#tabVerticalLeft22" aria-expanded="false"><i class="la la-header"></i> Inventory</a>
                                </li>
                                <li class="nav-item tap4">
                                    <a class="nav-link" id="baseVerticalLeft2-tab3" data-toggle="tab" aria-controls="tabVerticalLeft23" href="#tabVerticalLeft23" aria-expanded="false"><i class="la la-truck"></i> Shipping </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="baseVerticalLeft2-tab4" data-toggle="tab" aria-controls="tabVerticalLeft24" href="#tabVerticalLeft24" aria-expanded="false"><i class="la la-chain"></i> Linked Products</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="baseVerticalLeft2-tab5" data-toggle="tab" aria-controls="tabVerticalLeft25" href="#tabVerticalLeft25" aria-expanded="false"><i class="la la-send-o"></i> Attributes</a>
                                </li>


                                <li class="nav-item">
                                    <a class="nav-link" id="baseVerticalLeft2-tab6" data-toggle="tab" aria-controls="tabVerticalLeft26" href="#tabVerticalLeft26" aria-expanded="false"><i class="la la-gear"></i> Advanced</a>
                                </li>
                            </ul>
                            <div class="tab-content px-1">
                                <div role="tabpanel" class="tab-pane active tap1" id="tabVerticalLeft21" aria-expanded="true" aria-labelledby="baseVerticalLeft2-tab1">

                                    <div class="form-group" style="padding-left:10px">
                                        <label for="projectinput1">Regular price</label>
                                        <input type="text" id="regular_price" class="form-control" name="regular_price" value="{{$product_find->regular_price}}">
                                    </div>

                                    <div class="form-group" style="padding-left:10px">
                                        <label for="projectinput1">sales price</label>
                                        <input type="text" id="sales_price" class="form-control" name="sales_price" value="{{$product_find->sales_price}}">
                                    </div>

                                </div>
                                <div class="tab-pane tap2" id="tabVerticalLeft22" aria-labelledby="baseVerticalLeft2-tab2">
                                    <div class="form-group" style="padding-left:10px">
                                        <label for="projectinput1">SKU</label>
                                        <input type="text" id="sku" class="form-control" name="sku" value="{{$product_find->sku}}">
                                    </div>

                                    <div class="form-group" style="padding-left:10px">
                                        <label for="projectinput1">Stock quantity</label>
                                        <input type="text" id="stock_quantity" class="form-control" name="stock_quantity" value="{{$product_find->stock_quantity}}">
                                    </div>

                                    <div class="form-group" style="padding-left:10px">
                                        <label for="projectinput1">Low stock threshold</label>
                                        <input type="text" id="low_stock" class="form-control" name="low_stock" value="{{$product_find->low_stock}}">
                                    </div>

                                </div>
                                <div class="tab-pane tap4" id="tabVerticalLeft23" aria-labelledby="baseVerticalLeft2-tab3" style="padding:30px">
                                    <div class="form-group">
                                        <label for="projectinput1">Weight (kg)</label>
                                        <input type="text" class="form-control" name="weight" id="weight" value="{{$product_find->weight}}">
                                    </div>
                                    <div class="form-group" style="padding-left:10px">
                                        <label for="projectinput1">Dimensions (cm)</label>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="length" id="length" placeholder="Length" value="{{$product_find->length}}">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" id="width" name="width" placeholder="Width" value="{{$product_find->width}}">
                                            </div>
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" name="height" id="height" placeholder="Height" value="{{$product_find->height}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="dropdown-item">
                                                <span class="skin skin-futurico">
                                                    <input <?php echo $product_find->shipping_type == '1' ? 'checked' : '' ?> type="radio" id="shipping_type" name="shipping_type" value="1" class="shipping">
                                                    <label for="radio1" class="ml-1"> Free Shipping</label>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="dropdown-item">
                                                <span class="skin skin-futurico">
                                                    <input <?php echo $product_find->shipping_type == '2' ? 'checked' : '' ?> type="radio" id="shipping_type1" name="shipping_type" value="2" class="shipping">
                                                    <label for="radio2" class="ml-1"> Paid Shipping</label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    @if($product_find->shipping_type == 1)
                                    <div class="form-group hide-form" id="shipping-amount" style="padding-left:10px">
                                        <label for="projectinput1">Shipping Amount per Km</label>
                                        <input type="text" class="form-control" id="shipping_amount" name="shipping_amount">
                                    </div>
                                    @else
                                    <div class="form-group" id="shipping-amount" style="padding-left:10px">
                                        <label for="projectinput1">Shipping Amount per Km</label>
                                        <input value="{{$product_find->shipping_amount}}" type="text" class="form-control" id="shipping_amount" name="shipping_amount">
                                    </div>
                                    @endif
                                </div>
                                <div class="tab-pane" id="tabVerticalLeft24" aria-labelledby="baseVerticalLeft2-tab4">

                                    <div class="form-group " style="padding-left:10px">
                                        <label for="">Related Product</label>
                                        <select style="width:100%" placeholder="search for product" id="related_product" name="related_product[]" class="select2 form-control col-md-12" multiple="multiple">
                                            <optgroup label="Related Product">

                                                @foreach($product as $product1)

                                                <option {{in_array($product1->id, $related_product) ? 'selected' : ''}} value="{{$product1->id}}">{{$product1->product_name}}</option>
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
                                            <select style="width:100%" name="attribute" id="attribute" class="form-control col-md-12">
                                                <option value="">Select The Atribute</option>
                                                <?php $arraydata3 = array(); ?>
                                                @foreach($product_attribute as $data1)
                                                <?php $arraydata3[] = '' . $data1->attribute . ''; ?>
                                                @endforeach
                                                @foreach($attribute as $attribute)
                                                <option {{in_array($attribute->id, $arraydata3) ? 'disabled' : ''}} value="{{$attribute->id}}">{{$attribute->name}}</option>


                                                @endforeach


                                            </select>
                                        </div>

                                        <div id="show_terms">

                                        </div>

                                    </div>


                                    {{-- </form> --}}
                                </div>


                                <div class="tab-pane" id="tabVerticalLeft26" aria-labelledby="baseVerticalLeft2-tab6">
                                    <div class="dropdown-item">
                                        <input <?php echo $product_find->featured == 'on' ? 'checked' : '' ?> type="checkbox" name="featured" id="featured" class="switchery-xs" />
                                        <label for="switchery1" class="card-title ml-1">Enable as a Today's Deals product</label>
                                    </div>
                                    <div class="dropdown-item">
                                        <input <?php echo $product_find->hot_product == 'on' ? 'checked' : '' ?> type="checkbox" name="hot_product" id="hot_product" class="switchery-xs" />
                                        <label for="switchery2" class="card-title ml-1">Enable as a Bestselling Products product</label>
                                    </div>
                                    <div class="dropdown-item">
                                        <input <?php echo $product_find->new_product == 'on' ? 'checked' : '' ?> type="checkbox" name="new_product" id="new_product" class="switchery-xs" />
                                        <label for="switchery3" class="card-title ml-1">Enable as a On Sale Products product</label>
                                    </div>
                                    <div class="dropdown-item">
                                        <input <?php echo $product_find->recommended == 'on' ? 'checked' : '' ?> type="checkbox" name="recommended" id="recommended" class="switchery-xs" />
                                        <label for="switchery4" class="card-title ml-1">Enable as a recommended product</label>
                                    </div>
                                    <div class="dropdown-item">
                                        <input <?php echo $product_find->review == 'on' ? 'checked' : '' ?> type="checkbox" name="review" id="review" class="switchery-xs" />
                                        <label for="switchery5" class="card-title ml-1">Enable as a product review</label>
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
                            <p><i class="la la-eye"></i> Google search preview</p>
                            <hr>

                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">

                                <div class="box box-solid">

                                    <div class="box-body">
                                        <div class="seo-preview-content">

                                            <h3 id="seo-page-title">{{$product_find->seo_title}}</h3>
                                            <p class="link"><?php 
                                                            echo URL::to('/'); ?>/product/</p>
                                            <p class="description" id="seo-description">{{$product_find->seo_description}}.</p>
                                        </div>
                                        <hr>
                                        <div class="seo-content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <input type="text" class="form-control" name="seo_title" id="seo_title" placeholder="page title" value="{{$product_find->seo_title}}">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <textarea id="seo_description" class="form-control" name="seo_description" placeholder="meta tag description">{{$product_find->seo_description}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <textarea id="seo_keywords" class="form-control" name="seo_keywords" placeholder="meta tag keywords by comma separator. exxample - tshirt, mobile">{{$product_find->seo_keywords}}</textarea>
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
                                <form method="post" action="{{ url('/admin/images-save') }}" enctype="multipart/form-data" class="dropzone" id="my-dropzone">
                                    {{ csrf_field() }}
                                    <input type="hidden" id="product_page_id" name="product_page_id" value="{{ Request::segment(3) }}">
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
<!-- BEGIN PAGE VENDOR JS-->
<script src="../../../app-assets/vendors/js/extensions/bootstrap-treeview.min.js" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN PAGE LEVEL JS-->
{{-- <script src="../../../app-assets/js/scripts/extensions/tree-view.js" type="text/javascript"></script> --}}
<!-- END PAGE LEVEL JS-->
<script src="{{ url('/dropzone/dropzone.js') }}"></script>
<script src="{{ url('/dropzone/config-dropzone.js') }}"></script>
<script>
    var attributes = [];
</script>
@foreach($product_attribute as $data1)
<script>
    attributes.push("<?php echo $data1->attribute; ?>");
    console.log(attributes);
</script>
@endforeach
<script>
    $(document).ready(function() {
        $.ajax({
            url: "/admin/get-category-tree",
            method: "GET",
            dataTypes: "json",
            success: function(data) {
                $('#default-treeview').treeview({
                    data: data,
                    showCheckbox: true,
                });
                var node = {
                    !!str_replace('"', '', json_encode($tree_category)) !!
                };
                $('#default-treeview').treeview('selectNode', [node, {
                    silent: true
                }]);
            }
        });

        $.ajax({
            url: '/admin/get_edit_attribute/' + {
                !!$product_find - > id!!
            },
            type: "GET",
            success: function(data) {
                //$('#attribute').val('');
                //$("#attribute option[value=" + id + "]").prop("disabled", true);;        
                setTimeout(function() {
                    $(".select2").select2();
                }, 100);
                $("#show_terms").after(function() {
                    //$('#show_terms').html(data);
                    return "<div>" + data + "</div>";
                });
            }
        });

    })




    $('#checkTreeView').click(function(e) {
        e.preventDefault();

        //var nodes = $('#default-treeview').treeview('getChecked');


        console.log(nodes);
    })

    function Save_product() {

        $("#btnSave").attr("disabled", "disabled");
        var product_form_data = new FormData($('#product_form_data')[0]);

        var productGallery = $('#productGallery').val();
        var product_description = tinyMCE.activeEditor.getContent();
        var product_page_id = $('#product_page_id').val();



        //Category ID Get

        product_form_data.append('product_description', product_description);
        //  product_form_data.append("attribute", attributes);
        product_form_data.append("product_page_id", product_page_id);
        //   product_form_data.append('regular_price',regular_price);
        //   product_form_data.append('sales_price',sales_price);
        //   product_form_data.append('sku',sku);
        //   product_form_data.append('stock_quantity',stock_quantity);
        //   product_form_data.append('low_stock',low_stock);
        //   product_form_data.append('weight',weight);
        //   product_form_data.append('length',length);
        //   product_form_data.append('width',width);
        //   product_form_data.append('height',height);
        //   product_form_data.append('shipping_type',shipping_type);
        //   product_form_data.append('shipping_amount',shipping_amount);
        //   product_form_data.append('upsells',upsells);
        //   product_form_data.append('cross_sells',cross_sells);
        //   product_form_data.append('tag',tag);
        //   product_form_data.append('product_image',product_image);
        //   product_form_data.append('hot_product',hot_product);
        //   product_form_data.append('new_product',new_product);
        //   product_form_data.append('review',review);
        //   product_form_data.append('recommended',recommended);
        //   product_form_data.append('featured',featured);
        //tinyMCE.triggerSave();
        //console.log(product_form_data.getAll('tag'));
        // console.log(product_form_data.get('hot'));
        // console.log(product_form_data.get('new_product'));
        // console.log(product_form_data.get('review'));
        // console.log(product_form_data.get('recommended'));
        // console.log(product_form_data.get('featured'));



        $("span").find('.text-danger').remove();

        //var formData = new FormData($('#product_form')[0]);
        //var formData = product_form_data;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/admin/productUpdate',
            type: "POST",
            data: product_form_data,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {
                $('#product_get_id').val(data);
                console.log(data);
                // $('input[name=pro_id]').val(data);                
                // $('input[name=personal]').val(data);                
                //$("#product_form_data")[0].reset();

                toastr.success('Product Store Successfully', 'Successfully Save');
                //location.reload();
                CallDropZone();


            },
            error: function(textStatus, errorThrown) {
                $("#btnSave").removeAttr("disabled");
                var errorData = textStatus.responseJSON.errors;
                $.each(errorData, function(i, obj) {
                    toastr.error(obj[0], i);
                    //$('[name="'+i+'"]').after('<span class="text-danger">'+obj[0]+' </span>');
                });
            }
        });

    }

    function CallDropZone() {
        console.log('CALLOK');
        $('#testSubmit').trigger('click')
    }


    $('input[name="shipping_type"]').on('ifClicked', function(event) {
        if (this.value == 1) {
            $('#shipping-amount').addClass('hide-form');
        } else {
            $('#shipping-amount').removeClass('hide-form');
        }
    });

    $("#seo_title").on("keyup", function() {
        var title = $(this).val();
        console.log(title.length)
        $('#seo-page-title').text(title);
        if (title.length >= 67) {
            $("#seo_title").addClass('text-danger');
        } else {
            $("#seo_title").removeClass('text-danger');
        }
    });
    $("#seo_description").on("keyup", function() {
        var title = $(this).val();
        console.log(title.length)
        $('#seo-description').text(title);
        if (title.length >= 155) {
            $("#seo_description").addClass('text-danger');
        } else {
            $("#seo_description").removeClass('text-danger');
        }
    });

    function get_sub_category() {
        var id = $('#category').val();
        $.ajax({
            url: '/admin/get_sub_category/' + id,
            type: "GET",
            success: function(data) {
                $('#sub_category').html(data);
            }
        });
    }

    $("#attribute").on("change", function() {

        var id = $('#attribute').val();
        attributes.push(id);
        console.log(attributes);
        $.ajax({
            url: '/admin/get_terms/' + id,
            type: "GET",
            success: function(data) {
                console.log(data);
                $('#attribute').val('');

                $("#attribute option[value=" + id + "]").prop("disabled", true);;

                $("#show_terms").after(function() {
                    //$('#show_terms').html(data);
                    return "<div>" + data + "</div>";
                });
            }
        });
    });

    function RemovePop(id) {
        if (confirm('Are you sure delete this row?')) {
            attributes = jQuery.grep(attributes, function(value) {
                return value != id;
            });
            console.log(attributes);
            $("#" + id).remove();
            $("#attribute option[value=" + id + "]").prop("disabled", false);
        }
    }


    function save_terms() {

        var termsData = new FormData($('#termsData')[0]);
        termsData.append("attribute", attributes);
        console.log(termsData.getAll('size'));
        $.ajax({
            url: '/admin/attribute-terms-save',
            type: "POST",
            data: termsData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {
                console.log(data);
                $('#testSubmit').trigger('click')
            },
            error: function(textStatus, errorThrown) {


            }
        });
    }

    function initImageUpload(box) {
        let uploadField = box.querySelector('.image-upload');

        uploadField.addEventListener('change', getFile);

        function getFile(e) {
            let file = e.currentTarget.files[0];
            checkType(file);
        }

        function previewImage(file) {
            let thumb = box.querySelector('.js--image-preview'),
                reader = new FileReader();

            reader.onload = function() {
                thumb.style.backgroundImage = 'url(' + reader.result + ')';
            }
            reader.readAsDataURL(file);
            thumb.className += ' js--no-default';
        }

        function checkType(file) {
            let imageType = /image.*/;
            if (!file.type.match(imageType)) {
                throw 'Datei ist kein Bild';
            } else if (!file) {
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

    $(".single-product").click(function() {
        $("#imgInp").trigger('click');
    });
    $('.tap3').addClass('hidden');
    $('#group-product').on('change', function() {
        var change_data = $(this).val();
        if (change_data == 1) {
            $('.tap3').addClass('hidden');
            $('.tap1').removeClass('hidden');
            $('.tap2').removeClass('hidden');
            //$('.tap4').removeClass('active');
        } else {
            $('.tap1').addClass('hidden');
            $('.tap2').addClass('hidden');
            $('.tap3').removeClass('hidden');
            //$('.tap4').addClass('active');
        }
    })
</script>


@endsection 