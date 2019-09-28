@extends('layout.app')
@section('content')
<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

<div class="secondary_page_wrapper">

    <div class="container">

        <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

        <ul class="breadcrumbs">
            <li><a href="/">Home</a></li>
            <li>{{$category->category_name}}</li>
        </ul>

        <div class="row">

            <aside class="col-md-3 col-sm-4 has_mega_menu">

                    <div class="section_offset">
                            @if($category->category_image != null)
                            <h3>{{$category->category_name}}</h3>
                        <img src="/category_image/{{$category->category_image}}" alt="">
                            @endif
                    </div>

                <!-- - - - - - - - - - - - - - Categories - - - - - - - - - - - - - - - - -->

                <section class="section_offset">

                    <h3>Categories</h3>
						
								
                    <div id='cssmenu'>
                            <ul>
                                    <!-- First Menu start -->
                                    @foreach(App\category::with('childs')->where('parent_id',0)->get() as $item)
                                    @if($item->childs->count() > 0)
                                    <li class='active has-sub has-new-sub'><a href='/category/{{$item->id}}'><span>{{$item->category_name}}</span></a>
                                        <!-- second Menu start -->
                                        <ul class="first-child">
                                        @foreach($item->childs as $item2)
                                            @if($item2->childs->count() > 0)
                                            <li class='has-sub has-new-sub'><a href='/category/{{$item2->id}}'><span>{{$item2->category_name}}</span></a>
                                                <ul class="second-child">
                                                @foreach($item2->childs as $item3)
                                                @if($item3->childs->count() > 0)
                                                <li class="has-sub has-new-sub"><a href='/category/{{$item3->id}}'class='has-sub has-new-sub'><span>{{$item3->category_name}}</span></a>
                                                    <ul class="second-child">
                                                    @foreach($item3->childs as $item4)
                                                    @if($item4->childs->count() > 0)
                                                    <li class='has-sub has-new-sub'><a href='/category/{{$item4->id}}' class='has-sub has-new-sub'><span>{{$item4->category_name}}</span></a>
                                                    @else
                                                    <li class='last'><a href='/category/{{$item4->id}}'><span>{{$item4->category_name}}</span></a></li>
                                                    @endif
                                                    @endforeach
                                                </ul>
                                                </li>
                                                @else
                                                <li class='last'><a href='/category/{{$item3->id}}'><span>{{$item3->category_name}}</span></a></li>
                                                @endif
                                                @endforeach
                                            </ul>
                                                </li>
                                            @else
                                            <li class='last'><a href='/category/{{$item2->id}}'><span>{{$item2->category_name}}</span></a></li>
                                            @endif
                                            @endforeach
                                        </ul>
                                        <!-- second Menu end -->
                                    </li>
                                    @else
                            <li><a href='/category/{{$item->id}}'><span>{{$item->category_name}}</span></a></li>
                                    @endif
                               
                                 @endforeach
                                 <!-- First Menu End -->
                            </ul>
                        </div>
                </section><!--/ .animated.transparent-->

                <!-- - - - - - - - - - - - - - End of categories - - - - - - - - - - - - - - - - -->
               
               

                <!-- - - - - - - - - - - - - - Tags - - - - - - - - - - - - - - - - -->

                {{-- <section class="section_offset">

                    <h3>Brand</h3>

                    <div class="tags_container">
                            <ul class="tags_cloud">
                                @if(count($brand)>0)
                                @foreach($brand as $brand1)    
                                    <li><a href="/filter-brand/{{$brand1->id}}" class="button_grey">{{$brand1->brand}}</a></li>
                                @endforeach
                                @endif
                                </ul>
                       
                        
                    </div>

                </section> --}}

            

                <!-- - - - - - - - - - - - - - End of tags - - - - - - - - - - - - - - - - -->

                <!-- - - - - - - - - - - - - - Banner - - - - - - - - - - - - - - - - -->

                <div class="section_offset">
						@if(count($adModel) > 0)
                    <a href="{{$adModel[2]->url}}">
                        
                    <img src="/ads/{{$adModel[2]->ad_name}}" alt="">
                        @endif
                    </a>
        
                </div>
                <!-- - - - - - - - - - - - - - End of banner - - - - - - - - - - - - - - - - -->

                 <!-- - - - - - - - - - - - - - Filter - - - - - - - - - - - - - - - - -->


{{-- 
                 <section class="section_offset">

                    <h3>Already Viewed Products</h3>

                    <ul class="products_list_widget">

                        <!-- - - - - - - - - - - - - - Product - - - - - - - - - - - - - - - - -->

                        <li>
                            
                            <a href="#" class="product_thumb">
                                
                                <img src="images/product_thumb_4.jpg" alt="">

                            </a>

                            <div class="wrapper">

                                <a href="#" class="product_title">Aenean auctor wisi et urna...</a>

                                <div class="clearfix product_info">

                                    <p class="product_price alignleft"><b>₹5.99</b></p>

                                    <!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->

                                    <ul class="rating alignright">

                                        <li class="active"></li>
                                        <li class="active"></li>
                                        <li class="active"></li>
                                        <li class="active"></li>
                                        <li></li>

                                    </ul>
                                    
                                    <!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->

                                </div>

                            </div>

                        </li>

                        <!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->

                    </ul><!--/ .list_of_products-->

                </section> --}}

                <!-- - - - - - - - - - - - - - End of already viewed products - - - - - - - - - - - - - - - - -->


            </aside>

            <main class="col-md-9 col-sm-8">

                <!-- - - - - - - - - - - - - - Today's deals - - - - - - - - - - - - - - - - -->

               

                <!-- - - - - - - - - - - - - - End of today's deals - - - - - - - - - - - - - - - - -->

                <section class="section_offset">
              

                </section>

                <!-- - - - - - - - - - - - - - Products - - - - - - - - - - - - - - - - -->

                <div class="section_offset">
                    <div class="section_offset">

                        <div class="row">
                        @if(count($adModel) > 0)
                            <div class="col-sm-6">
                                
                                <a href="{{$adModel[0]->url}}" class="banner animated transparent" data-animation="fadeInDown">
                                
                                    <img src="/ads/{{$adModel[0]->ad_name}}" alt="">

                                </a>

                            </div><!--/ [col]-->

                            <div class="col-sm-6">
                                
                                <a href="{{$adModel[1]->url}}" class="banner animated transparent" data-animation="fadeInDown" data-animation-delay="150">
                                
                                    <img src="/ads/{{$adModel[1]->ad_name}}" alt="">

                                </a>

                            </div><!--/ [col]-->
                                @endif
                        </div><!--/ .row-->

                    </div><!--/ .section_offset-->
                    <header class="top_box on_the_sides">

                        <div class="left_side clearfix v_centered">

                            <!-- - - - - - - - - - - - - - Sort by - - - - - - - - - - - - - - - - -->

                            <div class="v_centered">

                                <span>Sort by:</span>

                                <div class="sort_select">
                                    <input type="hidden" id="urlPath" value="{{ Request::segment(2) }}">
    <select class="form-control" name="sorter" id="sorter" style="height:35px">
    <option disabled <?php echo Request::segment(3) == null ? 'selected' : ''?>>Default</option>
   <option value="1" <?php echo Request::segment(3) == 1 ? 'selected' : ''?>>Low to High</option>
    <option value="2" <?php echo Request::segment(3) == 2 ? 'selected' : ''?>>High to Low</option>
  </select>
                                </div>

                            </div>

                            <!-- - - - - - - - - - - - - - End of sort by - - - - - - - - - - - - - - - - -->

                            <!-- - - - - - - - - - - - - - Number of products shown - - - - - - - - - - - - - - - - -->

                           

                            <!-- - - - - - - - - - - - - - End of number of products shown - - - - - - - - - - - - - - - - -->

                        </div>

                        <div class="right_side">

                            <!-- - - - - - - - - - - - - - Product layout type - - - - - - - - - - - - - - - - -->

                            <div class="layout_type buttons_row" data-table-container="#products_container">

                                <a href="#" data-table-layout="grid_view" class="button_grey middle_btn icon_btn active tooltip_container"><i class="icon-th"></i><span class="tooltip top">Grid View</span></a>

                                <a href="#" data-table-layout="list_view list_view_products" class="button_grey middle_btn icon_btn tooltip_container"><i class="icon-th-list"></i><span class="tooltip top">List View</span></a>

                            </div>

                            <!-- - - - - - - - - - - - - - End of product layout type - - - - - - - - - - - - - - - - -->

                        </div>

                    </header>
                    
                    <div class="table_layout" id="products_container">

                                <?php $i = 0;
                                foreach($product as $key => $product1){
                                  if($i%3 == 0) {
                                    echo $i > 0 ? "</div>" : ""; 
                                        echo "<div class='table_row'>";
                                    }
                                  ?>

                            <div class="table_cell">

                                <div class="product_item">

                                    <div class="image_wrap">


                                        <?php if($product1->category == 1){ ?>
                                               <img style="width:200px" src="http://www.kagtech.net/KAGAPP/Partsupload/{{$product1->product_image}}" alt="">
                                            <?php } else{ ?>
                                                <img style="width:200px" src="{{asset('product_img/').'/'.$product1->product_image}}" alt="">
	                                      
                                        <?php } ?>                             
                                  
	                                     
                                                      

                                        <div class="actions_wrap">

                                            <div class="centered_buttons">
                                             
                                                @if($product1->category == 1)
                                                
                                                <a href="#" class="button_dark_grey middle_btn quick_view" data-modal-url="/quick-view-tiles/{{$product1->product_id}}">Quick View</a>
                                                @else
                                                
                                                <a href="#" class="button_dark_grey middle_btn quick_view" data-modal-url="/quick-view/{{$product1->product_id}}">Quick View</a>
                                                @endif

                                            </div>

                                        <a href="javascript:void(null)" onclick="addWishlist({{$product1->product_id}})" class="button_dark_grey def_icon_btn middle_btn add_to_wishlist tooltip_container"><span class="tooltip right">Add to Wishlist</span></a>

                                            <a href="javascript:void(null)" onclick="addCompare({{$product1->product_id}})" class="button_dark_grey def_icon_btn middle_btn add_to_compare tooltip_container"><span class="tooltip left">Add to Compare</span></a>

                                        </div>

                                    </div>

                                    <div class="description">

                                        <a href="/product/{{$product1->product_id}}">{{$product1->product_name}}</a>

                                        <div class="clearfix product_info">
                                            @if($product1->category != 21)
                                            <p class="product_price alignleft"><b>₹{{$product1->sales_price}}</b></p>
                                            @endif
                                            <?php 
                                            $getRating = App\rating::where('item_id',$product1->product_id)->get();
                                            if(count($getRating) > 0){
                                                $rating_count;
                                            $total=0;
                                            foreach($getRating as $row){
                                                $total +=$row->rating;
                                            }
                                            $rating_count = $total/count($getRating);
                                       
                                            }
                                               
                
                
                                                ?>
                                                @if(count($getRating) > 0)
                                                    <ul class="rating alignright">
                
                                                            <li class="active"></li>
                                                            <li class="<?php echo $rating_count >= 2 ? 'active' : '' ?>"></li>
                                                            <li class="<?php echo $rating_count >= 3 ? 'active' : '' ?>"></li>
                                                            <li class="<?php echo $rating_count >= 4 ? 'active' : '' ?>"></li>
                                                            <li class="<?php echo $rating_count >= 5 ? 'active' : '' ?>"></li>
                
                                                        </ul>
                                                        @endif

                                        </div>

                                    </div>

                                    <div class="full_description">

                                        <a class="product_title" href="/product/{{$product1->product_id}}">{{$product1->product_name}}</a>

                                        <a href="/filter-product/{{$product1->category}}" class="product_category">
                                            
                                        </a>

                                         {{-- <div class="v_centered product_reviews">
                                        
                                            <ul class="rating">

                                                <li class="active"></li>
                                                <li class="active"></li>
                                                <li class="active"></li>
                                                <li class="active"></li>
                                                <li></li>

                                            </ul>

                                            <ul class="topbar">

                                                <li><a href="#">3 Review(s)</a></li>
                                                <li><a href="#">Add Your Review</a></li>

                                            </ul>

                                        </div>  --}}

                                        <div><?php echo $product1->product_description;?></div>

                                        <!-- <a href="#" class="learn_more">Learn More</a> -->

                                    </div>

                                    <div class="actions">

                                        <p class="product_price bold">₹{{$product1->sales_price}}</p>

                                        <ul class="seller_stats">

                                            
                                            @if($product1->stocks != "")
                                            <li>Availability: <span class="success">in stock</span></li>
                                            @else
                                            <li>Availability: <span class="danger">No Stock Available</span></li>
                                            @endif
                                          

                                        </ul>

                                        <ul class="buttons_col">

                                            <!-- <li><a href="#" class="button_blue middle_btn add_to_cart">Add to Cart</a></li> -->

                                            <li><a href="/add-wishlist/{{$product1->product_id}}" class="icon_link"><i class="icon-heart-5"></i>Add to Wishlist</a></li>

                                            <li><a href="/compare-product/{{$product1->product_id}}" class="icon_link"><i class="icon-resize-small"></i>Add to Compare</a></li>

                                        </ul>

                                    </div>


                                </div>

                            </div>


<?php $i++; } ?>




</div>


                        


                    </div><!--/ .table_layout -->

                    <footer class="bottom_box" style="padding-bottom:38px">
@if ($product->lastPage() > 1)
<ul class="pags">
    <li class="{{ ($product->currentPage() == 1) ? ' disabled' : '' }}">
        <a href="{{ $product->url(1) }}">Previous</a>
    </li>
    @for ($i = 1; $i <= $product->lastPage(); $i++)
        <li class="{{ ($product->currentPage() == $i) ? ' active' : '' }}">
            <a href="{{ $product->url($i) }}">{{ $i }}</a>
        </li>
    @endfor
    <li class="{{ ($product->currentPage() == $product->lastPage()) ? ' disabled' : '' }}">
        <a href="{{ $product->url($product->currentPage()+1) }}" >Next</a>
    </li>
</ul>
@endif
                        <div class="left_side">

                            <!-- <p>Showing 1 to 3 of 45 (15 Pages)</p> -->

                        </div>

                        <div class="right_side">
                        
                            <!-- <ul class="pags">

                                <li><a href="#"></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#"></a></li>

                            </ul> -->

                        </div>

                    </footer>

                </div>

                <!-- - - - - - - - - - - - - - End of products - - - - - - - - - - - - - - - - -->

            </main>

        </div><!--/ .row -->

    </div><!--/ .container-->

</div><!--/ .page_wrapper-->

<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->
@endsection
@section('extra-js')
<script>
    $('#sorter').change(function(){
        let sorted = $(this).val();
        var urlPath = $('#urlPath').val();
        window.location.href="/category/"+urlPath+"/"+sorted;
    })
    function routeCat(id){
        window.location.href="/filter-product/"+id;
    }

</script>

@endsection