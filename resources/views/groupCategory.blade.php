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
                                foreach($brands as $key => $data){
                                  if($i%3 == 0) {
                                    echo $i > 0 ? "</div>" : ""; 
                                        echo "<div class='table_row'>";
                                    }
                                  ?>

                            <div class="table_cell">

                                <div class="product_item">

                                    <div class="image_wrap">
<a class="product_title" href="/steel-product/{{$data->id}}">
                                                <img style="width:200px" src="{{asset('upload_brand/').'/'.$data->brand_image}}" alt="">
</a>
                                                              
                                  
	                                     
                                                      

                                      

                                    </div>

                                    <div class="description">

                                        <a href="/steel-product/{{$data->id}}">{{$data->brand}}</a>


                                    </div>

                                    <div class="full_description">

                                        <a class="product_title" href="/steel-product/{{$data->id}}">{{$data->brand}}</a>

                                       
                                            
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

                                  

                                    </div>

                                    <div class="actions">

                                

                                    </div>


                                </div>

                            </div>


<?php $i++; } ?>




</div>


                        


                    </div><!--/ .table_layout -->

                    <footer class="bottom_box" style="padding-bottom:38px">



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
    function routeCat(id){
        window.location.href="/filter-product/"+id;
    }

</script>

@endsection