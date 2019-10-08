<!doctype html>
<html lang="en">
	<head>
		<!-- Basic page needs
		============================================ -->
		<title>Msupply | Material-stores</title>
		<meta charset="utf-8">
		<meta name="author" content="">
		<meta name="description" content="">
		<meta name="keywords" content="">

		<!-- Mobile specific metas
		============================================ -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- Favicon
		============================================ -->
		<link rel="shortcut icon" type="image/x-icon" href="/images/fav_icon.png">

		<!-- Google web fonts
		============================================ -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,300,300italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

		<!-- Libs CSS
		============================================ -->
		<link rel="stylesheet" href="{{ asset('css/animate.css')}}">
		<link rel="stylesheet" href="{{ asset('css/fontello.css')}}">
		<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
			<!-- Toast alert CSS
		============================================ -->
		 <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/toastr.css')}}">
  		 <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.css')}}">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<!-- Theme CSS
		============================================ -->
		<link rel="stylesheet" href="{{ asset('js/rs-plugin/css/settings.css')}}">
		<link rel="stylesheet" href="{{ asset('js/owlcarousel/owl.carousel.css')}}">
		<link rel="stylesheet" href="{{ asset('js/arcticmodal/jquery.arcticmodal.css')}}">
		<link rel="stylesheet" href="{{ asset('css/style.css')}}">
			 <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
		<!-- JS Libs
		============================================ -->
		<script src="{{ asset('js/modernizr.js')}}"></script>

		<!-- Old IE stylesheet
		============================================ -->
		<!--[if lte IE 9]>
			<link rel="stylesheet" type="text/css" href="{{ asset('css/oldie.css')}}">
		<![endif]-->
		

		@yield('extra-css')
		<style>
		
   /* .sidebar ul.group-list li {
    padding-right: 17px;
} */

	.sidebar input[type="radio"] + label, input[type="checkbox"] + label{
	position: relative;
    width: auto !important;
    margin: 0 0px 0 0 !important;
    padding-left: 32px;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    user-select: none;
	}
    
    
    .sidebar ol,
    ul {
      list-style: none
    }

    .sidebar blockquote,
    q {
      quotes: none
    }

    blockquote:before,
    blockquote:after,
    .sidebar q:before,
    q:after {
      content: '';
      content: none
    }

    .sidebar table {
      border-collapse: collapse;
      border-spacing: 0
    }

    .sidebar {
      font: 100% "roboto", "Trebuchet MS", sans-serif;
      /* background-color: #EF476F; */
    }

    a {
      text-decoration: none;
    }

    /**
 * Hidden fallback
 */


    /**
 * Styling navigation
 */
 .sidebar input[type="radio"] + label::before, input[type="checkbox"] + label::before{
	 display: none;
 }

    header .sidebar {
      margin-right: auto;
      margin-left: auto;
      max-width: 22.5rem;
      margin-top: 150px;
      box-shadow: 0 3px 12px rgba(0, 0, 0, 0.25);
    }

    /**
 * Styling top level items
 */

    .nav a,
    .nav label {
      display: block;
      padding: 1.25rem;
      color: #151515;
      background-color: #fff;
      /* box-shadow: inset 0 -1px #eaeaea; */
      -webkit-transition: all .25s ease-in;
      transition: all .25s ease-in;
	  border : 1px solid #eaeaea;
    }

    .nav a:focus,
    .nav a:hover,
    .nav label:focus,
    .nav label:hover {
       background: #eaeaea;
	  color: #151515;
    }

    .nav label {
      cursor: pointer;
    }

    /**
 * Styling first level lists items
 */

    .group-list a,
    .group-list label {
      padding-left: 2rem;
    background: #fff;
    /* box-shadow: inset 0 -1px #eaeaea; */
    }

    .group-list a:focus,
    .group-list a:hover,
    .group-list label:focus,
    .group-list label:hover {
      background: #eaeaea;
	  color: #151515;
    }

    /**
 * Styling second level list items
 */

    .sub-group-list a,
    .sub-group-list label {
      padding-left: 4rem;
   background: #fff;
    /* box-shadow: inset 0 -1px #eaeaea; */
    }

    .sub-group-list a:focus,
    .sub-group-list a:hover,
    .sub-group-list label:focus,
    .sub-group-list label:hover {
       background: #eaeaea;
	  color: #151515;
    }

    /**
 * Styling third level list items
 */

    .sub-sub-group-list a,
    .sub-sub-group-list label {
      padding-left: 6rem;
      background: #fff;
    /* box-shadow: inset 0 -1px #eaeaea; */
    }

    .sub-sub-group-list a:focus,
    .sub-sub-group-list a:hover,
    .sub-sub-group-list label:focus,
    .sub-sub-group-list label:hover {
      background: #eaeaea;
	  color: #151515;
    }

    /**
 * Hide nested lists
 */

    .group-list,
    .sub-group-list,
    .sub-sub-group-list {
      height: 100%;
      max-height: 0;
      overflow: hidden;
      -webkit-transition: max-height .5s ease-in-out;
      transition: max-height .5s ease-in-out;
    }

    .nav__list input[type=checkbox]:checked+label+ul {
      /* reset the height when checkbox is checked */
      max-height: 1000px;
    }

    /**
 * Rotating chevron icon
 */

    label>span {
      float: right;
      -webkit-transition: -webkit-transform .65s ease;
      transition: transform .65s ease;
    }

    .nav__list input[type=checkbox]:checked+label>span {
      -webkit-transform: rotate(90deg);
      -ms-transform: rotate(90deg);
      transform: rotate(90deg);
    }
  </style>
	</head>
	<body class="front_page promo_popup">



		<!-- - - - - - - - - - - - - - Main Wrapper - - - - - - - - - - - - - - - - -->

		<div class="wide_layout">

			<!-- - - - - - - - - - - - - - Header - - - - - - - - - - - - - - - - -->

			<header id="header" class="type_6">

				<!-- - - - - - - - - - - - - - Top part - - - - - - - - - - - - - - - - -->

				<div class="top_part">

					<div class="container">

						<div class="row">

							<div class="col-lg-6 col-md-7 col-sm-8">
								<div class="row">
									<div class="col-md-6">
											@if(Auth::user())
												<p><b>Hello </b> <i style="color:#ff4557">{{Auth::user()->name}}</i>
												<a href="{{ route('logout') }}" onclick="event.preventDefault();
													document.getElementById('logout-form').submit();">
									    Logout</a> </p>


																		<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
																			@csrf
																		</form>
												@else
												<p>Welcom visitor <a href="/login">Login</a> or <a href="/register">Register</a></p>
												
												@endif

									</div>
									<div class="col-md-6">

											<div class="location-postion">
																<p>Your Location is {{Session::get('locations') }}, <a href="javascript:void(null)" data-modal-url="/get-location-page">Change</a></p>

																		</div>

									</div>
								</div>
								<!-- - - - - - - - - - - - - - Login - - - - - - - - - - - - - - - - -->





											
																	
								<!-- - - - - - - - - - - - - - End login - - - - - - - - - - - - - - - - -->

							</div> <!--/ [col]-->

							<div class="col-lg-6 col-md-5 col-sm-4">

								<div class="clearfix">

									<!-- - - - - - - - - - - - - - Language change - - - - - - - - - - - - - - - - -->

									<div class="alignright site_settings">
                                            <img src="{{ asset('/images/android-app-alt.png')}}" alt="" width="71px">
                                            <img src="{{ asset('/images/app-store.png')}}" alt="" width="71px">

{{--
										<ul class="dropdown site_setting_list language">

											<li class="animated_item"><a href="#"><img src="{{ asset('images/flag_en.jpg')}}" alt=""> English</a></li>
											<li class="animated_item"><a href="#"><img src="{{ asset('images/flag_g.jpg')}}" alt=""> German</a></li>
											<li class="animated_item"><a href="#"><img src="{{ asset('images/flag_s.jpg')}}" alt=""> Spanish</a></li>

										</ul>  --}}

									</div><!--/ .alignright.site_settings-->

									<!-- - - - - - - - - - - - - - End of language change - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Currency change - - - - - - - - - - - - - - - - -->

									<div class="alignright site_settings currency">
                                            <p>App Available on </p>
										{{--  <span class="current open_">USD</span>

										<ul class="dropdown site_setting_list">

											<li class="animated_item"><a href="#">USD</a></li>
											<li class="animated_item"><a href="#">EUR</a></li>
											<li class="animated_item"><a href="#">GBP</a></li>

										</ul>  --}}

									</div><!--/ .alignright.site_settings.currency-->

									<!-- - - - - - - - - - - - - - End of currency change - - - - - - - - - - - - - - - - -->

								</div><!--/ .clearfix-->

							</div><!--/ [col]-->

						</div><!--/ .row-->

					</div><!--/ .container -->

				</div><!--/ .top_part -->

				<!-- - - - - - - - - - - - - - End of top part - - - - - - - - - - - - - - - - -->

				<hr>

				<!-- - - - - - - - - - - - - - Bottom part - - - - - - - - - - - - - - - - -->

				<div class="bottom_part">

					<div class="container">

						<div class="row">

							<div class="main_header_row">

								<div class="col-sm-3">

									<!-- - - - - - - - - - - - - - Logo - - - - - - - - - - - - - - - - -->

									<a href="/" class="logo">

										<img src="/images/logo.png" alt="">

									</a>

									<!-- - - - - - - - - - - - - - End of logo - - - - - - - - - - - - - - - - -->

								</div><!--/ [col]-->

								<div class="col-sm-3">

									<!-- - - - - - - - - - - - - - Call to action - - - - - - - - - - - - - - - - -->

									<div class="call_us">
										<?php $main_mobile = App\contactinfo::all(); ?>
										@if(count($main_mobile)>0)
									<span>Call us toll free:</span> <b> {{$main_mobile[0]->toll_free}}</b>
										@endif
									</div><!--/ .call_us-->

									<!-- - - - - - - - - - - - - - End call to action - - - - - - - - - - - - - - - - -->

								</div><!--/ [col]-->

								<div class="col-sm-6">

									<!-- - - - - - - - - - - - - - Search form - - - - - - - - - - - - - - - - -->


									<form action="javascript:void(null)" method="post" class="clearfix search type_2">

										<input value="{{old('search')}}" type="text" id="search_box" name="search_box" tabindex="1" placeholder="Search..." class="alignleft">
										{{ csrf_field() }}
										<!-- - - - - - - - - - - - - - Categories - - - - - - - - - - - - - - - - -->

											{{-- <div class="custom_select search_category alignleft "> --}}
						
												{{-- <select class="manual" style="border: 1px solid #ffffff;" name="website_main_category">
													<option>All Categories</option>
													@foreach($category as $cats)
													<option value="{{$cats->category_name}}">{{$cats->category_name}}</option>
													@endforeach
												</select> --}}

											{{-- </div> --}}


										<!-- - - - - - - - - - - - - - End of categories - - - - - - - - - - - - - - - - -->

										<button type="button" class="button_blue def_icon_btn alignleft"></button>

									</form><!--/ #search-->
									<!-- - - - - - - - - - - - - - End search form - - - - - - - - - - - - - - - - -->
									<div id="search_result"></div>
								</div><!--/ [col]-->

							</div><!--/ .main_header_row-->

						</div><!--/ .row-->

					</div><!--/ .container-->

				</div><!--/ .bottom_part -->

				<!-- - - - - - - - - - - - - - End of bottom part - - - - - - - - - - - - - - - - -->

				<!-- - - - - - - - - - - - - - Main navigation wrapper - - - - - - - - - - - - - - - - -->

				<div id="main_navigation_wrap">

					<div class="container">

						<div class="row">

							<div class="col-xs-12">

								<!-- - - - - - - - - - - - - - Sticky container - - - - - - - - - - - - - - - - -->

								<div class="sticky_inner type_2">

									<!-- - - - - - - - - - - - - - Navigation item - - - - - - - - - - - - - - - - -->

									<div class="nav_item size_4">

										<button class="open_menu"></button>

										<!-- - - - - - - - - - - - - - Main navigation - - - - - - - - - - - - - - - - -->

										<ul class="theme_menu cats dropdown">



												<!-- - - - - - - - - - - - - - Mega menu - - - - - - - - - - - - - - - - -->

												<div id='cssmenu' class="animated_item">
													

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
	</li>
	</div>
												<!-- - - - - - - - - - - - - - End of mega menu - - - - - - - - - - - - - - - - -->






									{{--  <li class="has_megamenu animated_item"><a href="#" class="all"><b>All Categories</b></a></li>  --}}

										</ul>

										<!-- - - - - - - - - - - - - - End of main navigation - - - - - - - - - - - - - - - - -->

									</div><!--/ .nav_item-->

									<!-- - - - - - - - - - - - - - End of navigation item - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Navigation item - - - - - - - - - - - - - - - - -->

									<div class="nav_item">

										<nav class="main_navigation">

											<ul>

												<li class="home_menu"><a href="/">Home</a></li>
												{{-- <li class="offer_menu"><a href="/offers">Offers</a></li> --}}
												<li class="account_menu"><a href="/account/dashboard">My Account</a></li>
												<li class="cart_menu"><a href="/cart">Shopping Cart</a></li>
												<li class="checkout_menu"><a href="/transports">Checkout</a></li>
												<li class="contact_menu"><a href="/contact">Contact Us</a></li>


											</ul>

										</nav><!--/ .main_navigation-->

									</div>

									<!-- - - - - - - - - - - - - - End of navigation item - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Navigation item - - - - - - - - - - - - - - - - -->

									<div class="nav_item size_4">
										@if(Auth::user())
										<a href="/account/wishlist" class="wishlist_button" data-amount="{{count(App\wishlist::where('user',Auth::user()->id)->get())}}"></a>
										@else
										<a href="/account/wishlist" class="wishlist_button" data-amount="0"></a>
										@endif
									</div><!--/ .nav_item-->


									<div class="nav_item size_4">

										<a href="/compare" class="compare_button" data-amount="{{Session::has('compare') ? count(Session::get('compare')) : '0'}}" id="compare_button"></a>

									</div><!--/ .nav_item-->
									<!-- - - - - - - - - - - - - - End of main navigation - - - - - - - - - - - - - - - - -->



									<!-- - - - - - - - - - - - - - Navigation item - - - - - - - - - - - - - - - - -->
									<div class="nav_item size_3">

										<button id="open_shopping_cart" class="open_button" data-amount="0">
											<b class="title">My Cart</b>
											<b class="total_price">₹ 0.00</b>
										</button>

										<!-- - - - - - - - - - - - - - Products list - - - - - - - - - - - - - - - - -->

										<div class="shopping_cart dropdown active visible" id="cart-menu">



											</div><!--/ .shopping_cart.dropdown-->

										<!-- - - - - - - - - - - - - - End of products list - - - - - - - - - - - - - - - - -->

									</div><!--/ .nav_item-->


									<!-- - - - - - - - - - - - - - End of navigation item - - - - - - - - - - - - - - - - -->

								</div><!--/ .sticky_inner -->

								<!-- - - - - - - - - - - - - - End of sticky container - - - - - - - - - - - - - - - - -->

							</div><!--/ [col]-->

						</div><!--/ .row-->

					</div><!--/ .container-->

				</div><!--/ .main_navigation_wrap-->

				<!-- - - - - - - - - - - - - - End of main navigation wrapper - - - - - - - - - - - - - - - - -->

			</header>

			<!-- - - - - - - - - - - - - - End Header - - - - - - - - - - - - - - - - -->

			@yield('content')

			<!-- - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->

			<footer id="footer">

				<div class="container">

					<!-- - - - - - - - - - - - - - Infoblocks - - - - - - - - - - - - - - - - -->

					<div class="infoblocks_container">

						<ul class="infoblocks_wrap">

							<li>
								<a href="#" class="infoblock type_1">

									<i class="icon-paper-plane"></i>
									<span class="caption"><b>Fast Delivery</b></span>

								</a><!--/ .infoblock-->
							</li>

							<li>
								<a href="#" class="infoblock type_1">

									<i class="icon-lock"></i>
									<span class="caption"><b>Safe &amp; Secure Payment</b></span>

								</a><!--/ .infoblock-->
							</li>

							<li>
								<a href="#" class="infoblock type_1">

									<i class="icon-money"></i>
									<span class="caption"><b>100% Money back Guaranted</b></span>

								</a><!--/ .infoblock-->
							</li>

						</ul><!--/ .infoblocks_wrap.section_offset.clearfix-->

					</div><!--/ .infoblocks_container -->

					<!-- - - - - - - - - - - - - - End of infoblocks - - - - - - - - - - - - - - - - -->

				</div><!--/ .container -->

				<!-- - - - - - - - - - - - - - Footer section- - - - - - - - - - - - - - - - -->

				<div class="footer_section">

					<div class="container">

						<div class="row">

							<div class="col-md-5 col-sm-6">

								<!-- - - - - - - - - - - - - - About us widget- - - - - - - - - - - - - - - - -->

								<section class="widget">

									<h4>About Us</h4>

								<p class="about_us">{{$setting->described}}</p>

									<!-- - - - - - - - - - - - - - Social icons list - - - - - - - - - - - - - - - - -->
									@if(isset($social))
									<ul class="social_btns">
										@if($social->facebook !=null)
										<li>
											<a href="{{$social->facebook}}" class="icon_btn middle_btn social_facebook tooltip_container"><i class="icon-facebook-1"></i><span class="tooltip top">Facebook</span></a>
										</li>
										@endif

										@if($social->twitter !=null)
										<li>
											<a href="{{$social->twitter}}" class="icon_btn middle_btn social_twitter tooltip_container"><i class="icon-twitter"></i><span class="tooltip top">Twitter</span></a>
										</li>
										@endif
										@if($social->google !=null)
										<li>
											<a href="{{$social->google}}" class="icon_btn middle_btn social_googleplus tooltip_container"><i class="icon-gplus-2"></i><span class="tooltip top">GooglePlus</span></a>
										</li>
										@endif
										@if($social->pinterest !=null)
										<li>
											<a href="{{$social->pinterest}}" class="icon_btn middle_btn social_pinterest tooltip_container"><i class="icon-pinterest-3"></i><span class="tooltip top">Pinterest</span></a>
										</li>
										@endif
										@if($social->flickr !=null)
										<li>
											<a href="{{$social->flickr}}" class="icon_btn middle_btn social_flickr tooltip_container"><i class="icon-flickr-1"></i><span class="tooltip top">Flickr</span></a>
										</li>
										@endif
										@if($social->youtube !=null)
										<li>
											<a href="{{$social->youtube}}" class="icon_btn middle_btn social_youtube tooltip_container"><i class="icon-youtube"></i><span class="tooltip top">Youtube</span></a>
										</li>
										@endif
										@if($social->vimeo !=null)
										<li>
											<a href="{{$social->vimeo}}" class="icon_btn middle_btn social_vimeo tooltip_container"><i class="icon-vimeo-2"></i><span class="tooltip top">Vimeo</span></a>
										</li>
										@endif
										@if($social->instagram !=null)
										<li>
											<a href="{{$social->instagram}}" class="icon_btn middle_btn social_instagram tooltip_container"><i class="icon-instagram-4"></i><span class="tooltip top">Instagram</span></a>
										</li>
										@endif
										@if($social->linkedin !=null)
										<li>
											<a href="{{$social->linkedin}}" class="icon_btn middle_btn social_linkedin tooltip_container"><i class="icon-linkedin-5"></i><span class="tooltip top">LinkedIn</span></a>
										</li>
										@endif
									</ul>
									@endif
									<!-- - - - - - - - - - - - - - End social icons list - - - - - - - - - - - - - - - - -->

								</section>

								<!-- - - - - - - - - - - - - - End of about us widget - - - - - - - - - - - - - - - - -->

							</div><!--/ [col]-->

							<div class="col-md-2 col-sm-6">

								<!-- - - - - - - - - - - - - - Information widget - - - - - - - - - - - - - - - - -->

								<section class="widget">

									<h4>Information</h4>

									<ul class="list_of_links">

										<li class="aboutus"><a href="/about">About Us</a></li>
										<li class="ppolicy"><a href="/privacy">Privacy Policy</a></li>
										<li class="tconditions"><a href="/terms">Terms &amp; Conditions</a></li>
										<li class="contactus"><a href="/contact">Contact Us</a></li>
										<li class="faq"><a href="/faq">FAQ</a></li>
										<li class="sdetails"><a href="/shipping_details">Shipping Details</a></li>

									</ul>

								</section><!--/ .widget-->

								<!-- - - - - - - - - - - - - - End of information widget - - - - - - - - - - - - - - - - -->

							</div><!--/ [col]-->

							<div class="col-md-2 col-sm-6">

								<!-- - - - - - - - - - - - - - Extras widget - - - - - - - - - - - - - - - - -->

								<section class="widget">

									<h4>Category</h4>

									<ul class="list_of_links">
												<?php if(isset($category)){?>
											@foreach($category as $row)
											<li><a href="/category/{{$row->id}}">{{$row->category_name}}</a></li>
													@endforeach
											<?php } ?>
									</ul>

								</section><!--/ .widget-->

								<!-- - - - - - - - - - - - - - End of extras widget - - - - - - - - - - - - - - - - -->

							</div><!--/ [col]-->

							<div class="col-md-2 col-sm-6">

								<!-- - - - - - - - - - - - - - My account widget - - - - - - - - - - - - - - - - -->

								<section class="widget">

									<h4>My Account</h4>

									<ul class="list_of_links">

										<li><a href="/account/dashboard">Profile Information</a></li>
										<li><a href="/account/orders">Order History</a></li>
										<li><a href="/account/address">Manage Address</a></li>
										<li><a href="/account/wishlist">Wish List</a></li>
										{{-- <li><a href="/account/review">Reviews & Ratings</a></li> --}}

									</ul>

								</section><!--/ .widget-->

								<!-- - - - - - - - - - - - - - End my account widget - - - - - - - - - - - - - - - - -->

							</div>

							<div class="col-md-3 col-sm-6">

								<!-- - - - - - - - - - - - - - Blog widget - - - - - - - - - - - - - - - - -->



								<!-- - - - - - - - - - - - - - End of blog widget - - - - - - - - - - - - - - - - -->

							</div><!--/ [col]-->

						</div><!--/ .row-->

					</div><!--/ .container -->

				</div><!--/ .footer_section_2-->

				<!-- - - - - - - - - - - - - - End footer section- - - - - - - - - - - - - - - - -->

				<hr>

				<!-- - - - - - - - - - - - - - Footer section - - - - - - - - - - - - - - - - -->

				<div class="footer_section_3 align_center">

					<div class="container">

						<!-- - - - - - - - - - - - - - Payments - - - - - - - - - - - - - - - - -->

						<ul class="payments">

							{{-- <li><img src="/images/payment_1.png" alt=""></li> --}}
							<li><img src="/images/payment_2.png" alt=""></li>
							<li><img src="/images/payment_3.png" alt=""></li>
							{{-- <li><img src="/images/payment_4.png" alt=""></li>
							<li><img src="/images/payment_5.png" alt=""></li>
							<li><img src="/images/payment_6.png" alt=""></li>
							<li><img src="/images/payment_7.png" alt=""></li>
							<li><img src="/images/payment_8.png" alt=""></li> --}}

						</ul>

						<!-- - - - - - - - - - - - - - End of payments - - - - - - - - - - - - - - - - -->


						<p class="copyright">&copy; {{date('Y')}} <a href="http://kashousing.com">K.A.S Housing Pvt Ltd</a>. All Rights Reserved.</p>
						<p>Development &amp; Maintenance By <a href="http://lrbtech.com"> LRB INFO TECH</a></p>

					</div><!--/ .container -->

				</div><!--/ .footer_section-->

				<!-- - - - - - - - - - - - - - End footer section - - - - - - - - - - - - - - - - -->

			</footer>

			<!-- - - - - - - - - - - - - - End Footer - - - - - - - - - - - - - - - - -->

		</div><!--/ [layout]-->

		<!-- - - - - - - - - - - - - - End Main Wrapper - - - - - - - - - - - - - - - - -->

		<!-- - - - - - - - - - - - - - Social feeds - - - - - - - - - - - - - - - - -->

		{{-- <ul class="social_feeds">

			<!-- - - - - - - - - - - - - - Facebook - - - - - - - - - - - - - - - - -->


			<!-- - - - - - - - - - - - - - End of Facebook - - - - - - - - - - - - - - - - -->



			<!-- - - - - - - - - - - - - - Contact us - - - - - - - - - - - - - - - - -->

			<li>

				<button class="icon_btn middle_btn social_contact open_"><i class="icon-mail-8"></i></button>

				<section class="dropdown">

					<div class="animated_item">

						<h3 class="title">Contact Us</h3>

					</div><!--/ .animated_item-->

					<div class="animated_item">

						{{-- <p class="form_caption">Lorem ipsum dolor sit amet, adipis mauris accumsan.</p> --}}

						{{-- <form class="contactform" novalidate id="contact_side_form">
								{{csrf_field()}}
							<ul>

								<li class="row">

									<div class="col-xs-12">

										<input type="text" required title="Name" name="cf_name" placeholder="Your name">

									</div>

								</li>

								<li class="row">

									<div class="col-xs-12">

										<input type="email" required title="Email" name="cf_email" placeholder="Your Email address">

									</div>

								</li>
								<li class="row">

									<div class="col-xs-12">

										<input type="text" required title="Email" name="cf_order_number" placeholder="Your Order ID">

									</div>

								</li>

								<li class="row">

									<div class="col-xs-12">

										<textarea placeholder="Message" required title="Message" name="cf_message" rows="6"></textarea>

									</div>

								</li>

								<li class="row">

									<div class="col-xs-12">

										<button class="button_grey middle_btn" onclick="mailsend1()">Send</button>

									</div>

								</li>

							</ul>

						</form>

					</div><!--/ .animated_item-->

				</section><!--/ .dropdown-->

			</li> --}}

			<!-- - - - - - - - - - - - - - End contact us - - - - - - - - - - - - - - - - -->

			<!-- - - - - - - - - - - - - - Google map - - - - - - - - - - - - - - - - -->

			{{-- <li>

				<button class="icon_btn middle_btn social_gmap open_"><i class="icon-location-4"></i></button>

				<!--Location-->

				<section class="dropdown">

					<div class="animated_item">

						<h3 class="title">Store Location</h3>

					</div><!--/ .animated_item-->

					<div class="animated_item">

						<p class="c_info_location">{{$setting->address}}</p>

						<div class="proportional_frame">

							<iframe src="{{$setting->map2}}" style="border:0"></iframe>

						</div>

						<ul class="c_info_list">

							<li class="c_info_phone">{{$setting->phone}}</li>
							<li class="c_info_mail"><a href="mailto:#">{{$setting->email}}</a></li>
							<li class="c_info_schedule">

								<ul>

									<li>Monday-Friday: 8.00-20.00</li>
									<li>Saturday: 9.00-15.00</li>
									<li>Sunday: closed</li>

								</ul>

							</li>

						</ul>

					</div><!--/ .animated_item-->

				</section><!--/ .dropdown-->

			</li> --}}

			<!-- - - - - - - - - - - - - - End google map - - - - - - - - - - - - - - - - -->

		

		<!-- - - - - - - - - - - - - - End Social feeds - - - - - - - - - - - - - - - - -->

		<!-- Include Libs & Plugins
		============================================ -->
		<script src="{{asset('js/jquery-2.1.1.min.js')}}"></script>
		<script src="{{asset('js/queryloader2.min.js')}}"></script>
		<script src="{{asset('js/rs-plugin/js/jquery.themepunch.tools.min.js')}}"></script>
		<script src="{{asset('js/rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>
		<script src="{{asset('js/jquery.appear.js')}}"></script>
		<script src="{{asset('js/owlcarousel/owl.carousel.min.js')}}"></script>
		<script src="{{asset('js/jquery.countdown.plugin.min.js')}}"></script>
		<script src="{{asset('js/jquery.countdown.min.js')}}"></script>
		<script src="{{asset('js/arcticmodal/jquery.arcticmodal.js')}}"></script>
		 <script src="{{asset('twitter/jquery.tweet.min.js')}}"></script>
		<script src="{{asset('js/colorpicker/colorpicker.js')}}"></script>
		<script src="{{asset('js/retina.min.js')}}"></script>
		<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js"></script>
		<script src="{{asset('js/jquery.elevateZoom-3.0.8.min.js')}}"></script>
		<!-- Theme files
		============================================ -->
		<script src="{{asset('js/theme.plugins.js')}}"></script>
		<script src="{{asset('js/theme.core.js')}}"></script>
		<!-- Toast Alert Js files
		============================================ -->
		<script src="{{ asset('app-assets/js/scripts/extensions/toastr.js')}}" type="text/javascript"></script>
		<script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js')}}" type="text/javascript"></script>


			<script src="{{asset('js/search.js')}}"></script>
	</body>
	@yield('extra-js')
	<script>
		$(document).ready(function(){
		$.ajax({
			url : '/get-cart',
			type: "GET",
			success: function(data)
			{
			   var result = data.split('|');
			   $('.total_price').text(result[0]);
			   $('#open_shopping_cart').attr("data-amount",result[1]);
			}
		});
	});
	$('#open_shopping_cart').on('click',function(){
		$.ajax({
			url : '/cart-menu/',
			type: "GET",
			success: function(data)
			{
			   $('#cart-menu').html(data);
			}
	   });
	});
	function removeCartItem(id){
	var route = $('#routes').val();
	$.ajax({
        url : '/remove-cart/'+id,
        type: "GET",
        success: function(data)
        {
			//if(route == 'cart'){

			//}

			CartMenuUpdate();

        }
   });
}
function addCompare(id){
	$.ajax({
			url : '/add-compare/'+id,
			type: "GET",
			success: function(data)
			{
				if(data[0] ==1){

					toastr.success('Successfully', 'Product Added to Compare');
				}else{
					toastr.error('Exists', 'This Product Already Added');
				}
				$('#compare_button').attr("data-amount",data[1]);
			}
	   });
}
function addWishlist(id){
	try{

	$.ajax({
			url : '/add-wishlist/'+id,
			type: "GET",
			success: function(data)
			{

				if(data[0] ==1){

					toastr.success('Successfully', 'Product Added to Wishlist');
				}else{
					toastr.error('Exists', 'This Product Already Added');
				}
				$('.wishlist_button').attr("data-amount",data[1]);

			},error: function (data) {

                    toastr.error('', 'Please Login to Access');

                }
	   });
	}catch(e){
		alert(e.message)
	}
}


    function setCart(id,qty){
        $.ajax({
			  url : '/add-cart/'+id+'/'+qty,
              type: "GET",
             success: function(data)
				{
					if(data[0] == 0){
						$('.total_price').text(data[1]);
						$('#open_shopping_cart').attr("data-amount",data[2]);
						CartMenuUpdate();
					}else{
						toastr.error('We Have a Limited Quantity, Please Enter Available Stock Only');
					}
					console.log(data);
				},error: function (data) {

							 toastr.error('We Have a Limited Quantity, Please Enter Available Stock Only');

					 }
			});
    }


	function CartMenuUpdate(){
		$.ajax({
			url : '/get-cart',
			type: "GET",
			success: function(data)
			{
			   var result = data.split('|');
			   $('.total_price').text(result[0]);
			   $('#open_shopping_cart').attr("data-amount",result[1]);
			}
		});
	}

	function mailsend1(){
  	var termsData = new FormData($('#contact_side_form')[0]);
  	$.ajax({
		url : '/contact-mail',
		type: "POST",
		data: termsData,
		contentType: false,
		processData: false,
		dataType: "JSON",
		success: function(data)
		{
			 $("#contact_side_form")[0].reset();
			 toastr.success('Mail Send Successfully', 'Successfully Send');
		},
		error: function (data, errorThrown) {
          	var errorData = data.responseJSON.errors;
        	$.each(errorData, function(i, obj) {
            	toastr.error(obj[0]);
          	});
        }
	});
}
	</script>
</html>
