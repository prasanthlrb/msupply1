@extends('layout.app')
@section('content')
<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

<div class="secondary_page_wrapper">

    <div class="container">

        <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

        <ul class="breadcrumbs">

            <li><a href="index.html">Home</a></li>
            <li>Terms and Condition</li>

        </ul>

        <div class="row">
            @include('include.infoSidebar')

            <main class="col-md-9 col-sm-8">

                <h1>Shipping details</h1>

                <div class="theme_box clearfix">
                    @if(isset($data->shipping_details))
                    <?php 
                  
                    echo html_entity_decode($data->shipping_details)?>
                    @endif
                </div><!--/ .theme_box-->

            </main><!--/ [col]-->

        </div><!--/ .row-->

    </div><!--/ .container-->

</div><!--/ .page_wrapper-->

<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->


@endsection
@section('extra-js')
<script>
	$('.sdetails').addClass('current');
</script>
@endsection