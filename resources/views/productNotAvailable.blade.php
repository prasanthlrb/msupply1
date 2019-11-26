@extends('layout.app')
@section('extra-css')

    <!-- Theme CSS
    ============================================ -->
    <link rel="stylesheet" href="/js/fancybox/source/jquery.fancybox.css">
    <link rel="stylesheet" href="/js/fancybox/source/helpers/jquery.fancybox-thumbs.css">

@endsection
@section('content')


<div class="secondary_page_wrapper">

    <div class="container">

        <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

        <ul class="breadcrumbs">

            <li><a href="/">Home</a></li>
            <li><a href="/category/{{$cats->id}}">{{$cats->category_name}}</a></li>
            <li>{{$product1->product_name}}</li>


        </ul>

        <!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

        <div class="row">

            <main class="col-md-12 col-sm-12">

                <!-- - - - - - - - - - - - - - Product images & description - - - - - - - - - - - - - - - - -->

                <section class="section_offset">

                    <div class="clearfix">

                        <!-- - - - - - - - - - - - - - Product image column - - - - - - - - - - - - - - - - -->

                        <div class="col-md-5">

                            <!-- - - - - - - - - - - - - - Image preview container - - - - - - - - - - - - - - - - -->

                            <div class="image_preview_container">
                                <?php if($product1->product_image != ""){ ?>
                                    <img id="img_zoom" data-zoom-image="{{asset('/product_img').'/'.$product1->product_image}}" src="{{asset('/product_img').'/'.$product1->product_image}}" alt="">
                                <?php } else{ ?>
                                    <img id="img_zoom" data-zoom-image="{{asset('/images/qv_img_1.jpg')}}" src="{{asset('/images/qv_img_1.jpg')}}" alt="">
                                <?php } ?>
                                <!-- <button class="button_grey_2 icon_btn middle_btn open_qv"><i class="icon-resize-full-6"></i></button> -->

                            </div><!--/ .image_preview_container-->

                            <!-- - - - - - - - - - - - - - End of image preview container - - - - - - - - - - - - - - - - -->

                            <!-- - - - - - - - - - - - - - Prodcut thumbs carousel - - - - - - - - - - - - - - - - -->

                            <div class="product_preview">

                                <div class="owl_carousel" id="thumbnails">
                                <a href="#" data-image="{{asset('/product_img').'/'.$product1->product_image}}" data-zoom-image="{{asset('/product_img').'/'.$product1->product_image}}">
                                    <img src="{{asset('/product_img').'/'.$product1->product_image}}" data-large-image="{{asset('/product_img').'/'.$product1->product_image}}" alt="">
                                </a>
                                @foreach($Upload as $upload1)
                                    @if(!empty($upload1))
                                    <a href="#" data-image="{{asset('/product_gallery').'/'.$upload1->filename}}" data-zoom-image="{{asset('/product_gallery').'/'.$upload1->filename}}">

                                        <img src="{{asset('/product_gallery').'/'.$upload1->resized_name}}" data-large-image="{{asset('/product_gallery').'/'.$upload1->filename}}" alt="">
                                    </a>

                                    @endif
                                @endforeach

                                </div><!--/ .owl-carousel-->


                            </div><!--/ .product_preview-->

                            <!-- - - - - - - - - - - - - - End of prodcut thumbs carousel - - - - - - - - - - - - - - - - -->

                            <!-- - - - - - - - - - - - - - Share - - - - - - - - - - - - - - - - -->

                             <div class="v_centered">

                                <span class="title">Share this:</span>

                                <div class="addthis_widget_container">
                                    <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
                                    <a class="addthis_button_preferred_1"></a>
                                    <a class="addthis_button_preferred_2"></a>
                                    <a class="addthis_button_preferred_3"></a>
                                    <a class="addthis_button_preferred_4"></a>
                                    <a class="addthis_button_compact"></a>
                                    <a class="addthis_counter addthis_bubble_style"></a>
                                    </div>
                                </div>

                            </div>

                            <!-- - - - - - - - - - - - - - End of share - - - - - - - - - - - - - - - - -->

                        </div>

                        <!-- - - - - - - - - - - - - - End of product image column - - - - - - - - - - - - - - - - -->

                        <!-- - - - - - - - - - - - - - Product description column - - - - - - - - - - - - - - - - -->
                        
                        <div class="single_product_description col-md-7">

                            <h3 class="offset_title"><a href="#">{{$product1->product_name}}</a></h3>

                            <!-- - - - - - - - - - - - - - Page navigation - - - - - - - - - - - - - - - - -->

                            <!-- <div class="page-nav">

                                <a href="#" class="page-prev"></a>
                                <a href="#" class="page-next"></a>

                            </div> -->

                     
                            <div class="description_section">

                                <table class="product_info">

                                    <tbody>

                                        <!-- <tr>

                                            <td>Vendor: </td>


                                        </tr> -->

                                     
                                       
                                       



										@if($product1->notes !=null)
										<tr>
											<td>Important Note : </td>
										<td> <span class="in_stock">{{$product1->notes}}</span></td>
										</tr>
										
                                        @endif

                                    </tbody>

                                </table>

                            </div>

                            <hr>

               


                               


             


              
                <br>
                           
                            <!-- - - - - - - - - - - - - - End of quantity - - - - - - - - - - - - - - - - -->

                            <!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

                            <div class="buttons_row">
                           
                            <button type="button" class="button_blue middle_btn">Currently Not Available This Location</button>
                           
                                
                                
                            </div>


                            <!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

                        </div>

                        <!-- - - - - - - - - - - - - - End of product description column - - - - - - - - - - - - - - - - -->

                    </div>

                </section><!--/ .section_offset -->

                <!-- - - - - - - - - - - - - - End of product images & description - - - - - - - - - - - - - - - - -->

                <!-- - - - - - - - - - - - - - Tabs - - - - - - - - - - - - - - - - -->

                <div class="section_offset">

                    <div class="tabs type_2">

                        <ul class="tabs_nav clearfix">
                            <li class="active"><a href="#tab-1">Description</a></li>
                            <li><a href="#tab-2">Product Details</a></li>
                        
                        </ul>

                        <div class="tab_containers_wrap">

                            <div id="tab-1" class="tab_container">
                                @php
                                    echo $product1->product_description;
                                @endphp
                            </div>

                            <div id="tab-2" class="tab_container">
                                <ul class="specifications">
                                    
                                   
                                    @if(isset($product1->items))
                                         <li><span>No of Items:</span>{{$product1->items}} </li>
                                    @endif
                                    @if(isset($product1->weight))
                                        <li><span>Weight:</span>{{$product1->weight}}</li>
                                    @endif
                                    @if(isset($product1->length))
                                        <li><span>Length:</span>{{$product1->length}}</li>
                                   @endif
                                    @if(isset($product1->width))
                                        <li><span>Width:</span>{{$product1->width}}</li>
                                    @endif
                                    @if(isset($product1->height))
                                        <li><span>Height:</span>{{$product1->height}}</li>
                                    @endif
                                    
                                    
                                    
                                </ul>
                            </div>

                        

                        </div>


                    </div>

                </div>



                <!-- - - - - - - - - - - - - - End of related products - - - - - - - - - - - - - - - - -->


            </main><!--/ [col]-->

            {{-- <aside class="col-md-3 col-sm-4">



            </aside> --}}

        </div><!--/ .row-->

    </div><!--/ .container-->

</div><!--/ .page_wrapper-->

<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->


@endsection

@section('extra-js')

<!-- Include Libs & Plugins
    ============================================ -->
    <script src="/js/jquery.elevateZoom-3.0.8.min.js"></script>
    <script src="/js/fancybox/source/jquery.fancybox.pack.js"></script>
    <script src="/js/fancybox/source/helpers/jquery.fancybox-media.js"></script>
    <script src="/js/fancybox/source/helpers/jquery.fancybox-thumbs.js"></script>

@endsection
