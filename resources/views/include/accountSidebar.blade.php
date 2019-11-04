<style>
.fas{
    margin-top:5px;
}
.fab{
    margin-top:5px;
}
</style>
<aside class="col-md-3 col-sm-4">

    <!-- - - - - - - - - - - - - - Information - - - - - - - - - - - - - - - - -->

    <section class="section_offset">

        <h3>My Account</h3>

        <ul class="theme_menu">

            <li class="profileInformation"><a href="/account/dashboard" class="dashboard"><i class="fas fa-address-card"></i> Profile Information</a></li>
            <li class="accOrders"><a href="/account/orders" class="orders"><i class="fas fa-shopping-cart"></i> Orders</a></li>
            {{-- <li class="accTransport"><a href="/account/transport" class="transport"><i class="la la-truck"></i> Transport</a></li> --}}
            <li class="accDeals"><a href="/account/deals" class="deals"><i class="fas fa-handshake"></i> Deals</a></li>
            <li class="accProject"><a href="/account/project" class="project"><i class="fas fa-sitemap"></i> Site Management</a></li>
            <li class="accWishlist"><a href="/account/wishlist" class="wishlist"><i class="fab fa-gratipay"></i> Wishlist</a></li>

            <li class="accAddress"><a href="/account/address" class="address"><i class="fas fa-address-book"></i> Manage Address</a></li>
            <li> <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
   <i class="fas fa-power-off"></i> Logout</a> </li>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
        </ul>

    </section><!--/ .section_offset -->

    <!-- - - - - - - - - - - - - - End of information - - - - - - - - - - - - - - - - -->

    <!-- - - - - - - - - - - - - - Banner - - - - - - - - - - - - - - - - -->

    <div class="section_offset">

        <a href="#" class="banner">
            
            <img src="images/banner_img_10.png" alt="">

        </a>

    </div>

    <!-- - - - - - - - - - - - - - End of banner - - - - - - - - - - - - - - - - -->

</aside><!--/ [col]-->