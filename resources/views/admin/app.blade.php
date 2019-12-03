<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="author" content="PIXINVENT">
  <title>MSupply - Ecommerce Website</title>
  <link rel="shortcut icon" type="image/x-icon" href="/images/fav_icon.png">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">

  @yield('extra-css')
  <!-- BEGIN VENDOR CSS-->

  <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/vendors.css')}}">

  <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/fonts/meteocons/style.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/toastr.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/toastr.css')}}">
  <!-- BEGIN MODERN CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/app.css')}}">
  <!-- END MODERN CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu-modern.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-gradient.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/fonts/simple-line-icons/style.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-gradient.css')}}">

  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  {{--  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}">  --}}
  <!-- END Custom CSS-->
</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
  <!-- fixed-top-->
  <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
          <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
          <li class="nav-item mr-auto">
            <a class="navbar-brand" href="/">
              <img class="brand-logo" alt="Msupply" src="../../images/logoadmin.png">
              <h3 class="brand-text"> Supply</h3>
            </a>
          </li>
          <li class="nav-item d-none d-md-block float-right"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="toggle-icon ft-toggle-right font-medium-3 white" data-ticon="ft-toggle-right"></i></a></li>
          <li class="nav-item d-md-none">
            <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
          </li>
        </ul>
      </div>
      <div class="navbar-container content">
        <div class="collapse navbar-collapse" id="navbar-mobile">
          <ul class="nav navbar-nav mr-auto float-left">

          </ul>
          <ul class="nav navbar-nav float-right">
            <li class="dropdown dropdown-user nav-item">
              <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                <span class="mr-1">Hello,
                  <span class="user-name text-bold-700">{{ Auth::guard('admin')->user()->emp_name }}</span>
                </span>
                {{--  <span class="avatar avatar-online">
                  <img src="{{ asset('app-assets/images/portrait/small/avatar-s-19.png')}}" alt="avatar"><i></i></span>  --}}
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                  {{-- <a class="dropdown-item" href="#"><i class="ft-user"></i> Edit Profile</a> --}}



              <div class="dropdown-divider"></div><a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();"><i class="ft-power"></i> Logout</a>

                  <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </div>
              </li>
              <?php
              $company =App\company::where('status',0)->get();
              $order = App\order::where('order_status',0)->get();
              $role = App\role::find(Auth::guard('admin')->user()->role_id);
              $total = count($company) + count($order);
              ?>
            <li class="dropdown dropdown-notification nav-item">
              <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-bell"></i>
                <span class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow">{{$total}}</span>
              </a>
              @if($total >0)
              <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                <li class="dropdown-menu-header">
                  <h6 class="dropdown-header m-0">
                    <span class="grey darken-2">Notifications</span>
                  </h6>

                  <span class="notification-tag badge badge-default badge-danger float-right m-0">{{$total}} New</span>
                </li>
                <li class="scrollable-container media-list w-100">
                  @foreach($order as $row)
                  <?php $user = App\User::find($row->user_id); ?>
                <a href="/admin/order-item/{{$row->id}}">
                    <div class="media">
                      <div class="media-left align-self-center"><i class="ft-shopping-cart icon-bg-circle bg-cyan"></i></div>
                      <div class="media-body">
                        <h6 class="media-heading">You have new order!</h6>
                      <p class="notification-text font-small-3 text-muted">order id : #{{$row->id}}<br>Customer Name : {{$user->name}}<br> Phone No : {{$user->phone}}</p>
                        <small>
                        <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">{{$row->updated_at->diffForHumans()}}</time>
                        </small>
                      </div>
                    </div>
                  </a>
                  @endforeach
                  @foreach($company as $row)
                  <a href="/admin/verifyed-company/{{$row->user_id}}">
                    <div class="media">
                      <div class="media-left align-self-center"><i class="ft-user-check icon-bg-circle bg-red bg-darken-1"></i></div>
                      <div class="media-body">
                        <h6 class="media-heading red darken-1">New Company GST Approval</h6>
                      <p class="notification-text font-small-3 text-muted">Company Name : {{$row->company}}</p>
                        <small>
                          <time class="media-meta text-muted" datetime="2015-06-11T18:29:20+08:00">{{$row->updated_at->diffForHumans()}}</time>
                        </small>
                      </div>
                    </div>
                  </a>
                  @endforeach
                </li>

              </ul>
              @endif
            </li>

          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="dashboard nav-item"><a href="/admin/dashboard"><i class="la la-support"></i><span class="menu-title">Dashboard</span></a>
            </li>



        <li class="nav-item"><a href="#"><i class="la la-user-plus"></i><span class="menu-title">Customer<span class="badge badge badge-info badge-pill float-right mr-2">
            {{count(App\company::where('status',0)->get())}}
            </span></a>
          <ul class="menu-content">
            @if($role->customer_list == 1)
            <li class="customer"><a class="menu-item" href="/admin/customer" data-i18n="nav.dash.ecommerce">Customer List</a>
            </li>
            @endif
            @if($role->company_verify == 1)
            <li class="unverify_customer"><a class="menu-item" href="/admin/verify-company" data-i18n="nav.dash.ecommerce">Unverify Company</a>
            </li>
            @endif
          </ul>
        </li>


        <li class="nav-item"><a href="#"><i class="la la-user-plus"></i><span class="menu-title">User</span></a>
          <ul class="menu-content">
              @if($role->user == 1)
            <li class="roles"><a class="menu-item" href="/admin/role" data-i18n="nav.dash.ecommerce">Role</a>
            </li>
            @endif
            @if($role->role == 1)
            <li class="employee"><a class="menu-item" href="/admin/user">User</a>
            </li>
            @endif
          </ul>
        </li>

        @if($role->review == 1)
        <li class="reviews nav-item"><a href="/admin/non-review"><i class="la la-calendar-check-o"></i><span class="menu-title">Reviews</span><span class="badge badge badge-info badge-pill float-right mr-2">
            {{count(App\review::where('status',0)->get())}}
            </span></a>
        </li>
        @endif


        <li class=" nav-item"><a href="#"><i class="icon-handbag"></i><span class="menu-title">Products</span></a>
          <ul class="menu-content">
              @if($role->category == 1)
            <li class="category-menu"><a class="menu-item" href="/admin/category/0">Category</a></li>
            @endif
            @if($role->brand == 1)
            <li class="brand-menu"><a class="menu-item" href="/admin/brand/">Item Brand</a></li>
            @endif
            @if($role->attribute == 1)
            <li class="attribute-menu"><a class="menu-item" href="/admin/attribute/">Attributes & Values</a></li>
            @endif
            @if($role->attribute_set == 1)
            <li class="attributeSet-menu"><a class="menu-item" href="/admin/product-group/">Attributes Set</a></li>
            @endif
            <li class="unit-menu"><a class="menu-item" href="/admin/units/">Units</a></li>
            @if($role->catalog == 1)
            <li class="catalog-menu"><a class="menu-item" href="/admin/viewProduct/">Catalog</a></li>
            @endif
              <li class="location-management">
              <a class="menu-item" href="/admin/location-management_list">Price & Location Management</a>
            </li>
            {{-- <li class="colors-menu"><a class="menu-item" href="/admin/colors-category/">Colors</a></li> --}}
          </ul>
        </li>


        <li class=" nav-item"><a href="#"><i class="ft-shopping-cart"></i><span class="menu-title">Order</span><span class="badge badge badge-info badge-pill float-right mr-2">
          {{count(App\order::where('order_status',0)->get())}}
          </span></a>
          <ul class="menu-content">
              @if($role->order == 1)
            <li class="orders"><a class="menu-item" href="/admin/order" data-i18n="nav.dash.ecommerce">Orders</a>
            </li>
            @endif
            @if($role->transport_booking == 1)
            <li class="order_transport"><a class="menu-item" href="/admin/order-transport" data-i18n="nav.dash.ecommerce">KAS Transport</a>
            </li>
            @endif

          </ul>
        </li>
        @if($role->cms == 1)
        <li><a href="#"><i class="ft-align-left"></i> CMS</a>
          <ul>

            <li><a href="#"><i class="la la-file-o"></i> Home Page</a>
              <ul>
                  @if($role->cms_slider == 1)
                <li class="sliders"><a class="menu-item" href="/admin/show-slider">  Sliders</a></li>
                @endif
                @if($role->cms_home_layout == 1)
                <li class="home_layout"><a class="menu-item" href="/admin/home-layout"> Home Layout</a></li>
                @endif
                @if($role->ads == 1)
                <li class="ads"><a class="menu-item" href="/admin/home-add">Ads</a></li>
                @endif
              </ul>
            </li>
            @if($role->TermsAndCondition == 1)
            <li class="termsCondition"><a class="menu-item" href="/admin/terms_condition"><i class="la la-hdd-o"></i> Terms & Conditions</a></li>
            @endif
            @if($role->ShippingDetails == 1)
            <li class="shippingDetails"><a class="menu-item" href="/admin/shipping_detail"><i class="la la-floppy-o"></i> Shipping Details</a></li>
            @endif
            @if($role->PrivacyPolicy == 1)
            <li class="privacyPolicy"><a class="menu-item" href="/admin/privacy-policy"><i class="la la-floppy-o"></i> Privacy Policy</a></li>
            @endif
            @if($role->about == 1)
            <li class="aboutUs"><a class="menu-item" href="/admin/about"><i class="la la-floppy-o"></i> About Us</a></li>
            @endif
            @if($role->faq == 1)
            <li class="faq">
              <a class="menu-item" href="/admin/faq/">FAQ</a>
            </li>
            @endif
          </ul>
        </li>
        @endif
         
        <li class="nav-item"><a href="#">
          <i class="la la-adjust"></i><span class="menu-title">Color Master</span></a>
         <ul class="menu-content">
           <li class="contact_info">
              <a class="menu-item" href="/admin/color-master">Color Bank</a>
            </li>
           <li class="contact_info">
              <a class="menu-item" href="/admin/color-bulk-upload">Color Bank Bulk Upload</a>
            </li>
           <li class="contact_info">
              <a class="menu-item" href="/admin/color-products">Products</a>
            </li>
         
         </ul>
        </li>

        <li class="nav-item"><a href="#">
          <i class="ft ft-layers"></i><span class="menu-title">Tiles</span></a>
         <ul class="menu-content">
           <li class="update-tiles">
              <a class="menu-item" href="/admin/tiles-upload/">Update Tiles</a>
            </li>
           <li class="tiles">
              <a class="menu-item" href="/admin/tiles">Tiles</a>
            </li>
        
         
         </ul>
        </li>

        <li class="nav-item"><a href="#">
          <i class="fas fa-handshake"></i><span class="menu-title">Deals</span></a>
         <ul class="menu-content">
           <li class="update-tiles">
              <a class="menu-item" href="/admin/tiles-upload/">Deal History</a>
            </li>
           <li class="tiles">
              <a class="menu-item" href="/admin/tiles">New Deals</a>
            </li>
           <li class="tiles">
              <a class="menu-item" href="/admin/tiles">Waiting Deals</a>
            </li>
        
         
         </ul>
        </li>
       

     
        {{-- <li class="transports nav-item"><a href="/admin/transport"><i class="la la-truck"></i><span class="menu-title">Transport</span></a>
        </li> --}}
    



        @if($role->setting == 1)
        <li class=" nav-item"><a href="#"><i class="la la-gear"></i><span class="menu-title">Settings</span></a>
          <ul class="menu-content">
              @if($role->setting_contact_info == 1)
            <li class="contact_info">
              <a class="menu-item" href="/admin/contact-details/">Contact Info</a>
            </li>
            @endif

            @if($role->setting_social_media_link == 1)
            <li class="smm">
              <a class="menu-item" href="/admin/social-details/">Social Media Management</a>
            </li>
            @endif
            <li class="location-menu">
                <a class="menu-item" href="/admin/location_list/">Location Management</a>
              </li>

              <!-- <ul class="menu-content">
                <li>
                  <a class="menu-item" href="#" data-i18n="nav.menu_levels.second_level_child.third_level">Brand Management</a>
                </li>
                <li>
                  <a class="menu-item" href="#" data-i18n="nav.menu_levels.second_level_child.third_level">Size Management</a>
                </li>
                <li>
                  <a class="menu-item" href="#" data-i18n="nav.menu_levels.second_level_child.third_level">Color Management</a>
                </li>
              </ul> -->



          </ul>
        </li>
        @endif

          <li class=" navigation-header">
          <span data-i18n="nav.category.support">Marketing App</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip"
          data-placement="right" data-original-title="Support"></i>
        </li>
           <li class="nav-item"><a href="#"><i class="la la-send"></i><span class="menu-title">Send New</span></a>
          <ul class="menu-content">
             
            <li class="order_report"><a class="menu-item" href="/admin/createNew" data-i18n="nav.dash.ecommerce">Send New</a>
            </li>
            <li class="order_report"><a class="menu-item" href="/admin/view-post" data-i18n="nav.dash.ecommerce">All List</a>
            </li>
         
         
          </ul>

        </li>
        @if($role->report == 1)
        <li class=" navigation-header">
          <span data-i18n="nav.category.support">Report</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip"
          data-placement="right" data-original-title="Support"></i>
        </li>
        {{-- <li class=" nav-item"><a href="#"><i class="la la-support"></i><span class="menu-title" data-i18n="nav.support_raise_support.main">Report</span></a>
        </li> --}}

        <li class="nav-item"><a href="#"><i class="la la-support"></i><span class="menu-title">Report</span></a>
          <ul class="menu-content">
              @if($role->report_order == 1)
            <li class="order_report"><a class="menu-item" href="/admin/order-report" data-i18n="nav.dash.ecommerce">Order</a>
            </li>
            @endif
            @if($role->report_transport == 1)
            <li class="transport_report"><a class="menu-item" href="/admin/transport-report">Transport</a>
            </li>
            @endif
            <li><a href="#"><i class="la la-file-o"></i> Logs</a>
                <ul>
                  <li class="log-order"><a class="menu-item" href="/admin/order-log">  Order Log</a></li>


                  <li class="log-product"><a class="menu-item" href="/admin/product-log"> Product Log</a></li>
                  <li class="log-product"><a class="menu-item" href="/admin/logs/login"> Login & Logout Logs</a></li>

                </ul>
              </li>
          </ul>

        </li>
        @endif
      </ul>
    </div>
  </div>
  <div class="app-content content">
   @yield('section')
  </div>

  <footer class="footer footer-static footer-light navbar-border navbar-shadow">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
      <span class="float-md-left d-block d-md-inline-block">
        Copyright &copy; 20<?=date('y')?> <a class="text-bold-800 grey darken-2" href="http://lrbtech.com">LRB TECH </a>, All rights reserved.
     </span>
    </p>
  </footer>
  <!-- BEGIN VENDOR JS-->
  <script src="{{ asset('app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->

  <!-- BEGIN MODERN JS-->
  <script src="{{ asset('app-assets/js/core/app-menu.js')}}" type="text/javascript"></script>
  <script src="{{ asset('app-assets/js/core/app.js')}}" type="text/javascript"></script>
  <script src="{{ asset('app-assets/js/scripts/customizer.js')}}" type="text/javascript"></script>
  <!-- END MODERN JS-->
<script>
  $('#add-contact').click(function(e){
    e.preventDefault();
    window.location.href = "/admin/add-contact";
  });
//   $('form input').on('keypress', function(e) {
//     return e.which !== 13;
// });
</script>
<script src="{{ asset('app-assets/js/scripts/extensions/toastr.js')}}" type="text/javascript"></script>
<script src="{{ asset('app-assets/vendors/js/extensions/toastr.min.js')}}" type="text/javascript"></script>
  @yield('extra-js')
</body>
</html>

