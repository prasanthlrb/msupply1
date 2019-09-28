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

                <h1>Terms and Condition</h1>

                <div class="theme_box clearfix">
                    @if(isset($data->terms))
                    <?php 
                  
                    echo html_entity_decode($data->terms)?>
                    @endif
                </div><!--/ .theme_box-->

            </main><!--/ [col]-->

        </div><!--/ .row-->

    </div><!--/ .container-->

</div><!--/ .page_wrapper-->

<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->


@endsection
@section('extra-js')
<script>
	$('.tconditions').addClass('current');
</script>
@endsection