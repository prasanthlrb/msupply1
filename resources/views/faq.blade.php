@extends('layout.app')
@section('content')
<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

<div class="secondary_page_wrapper">

    <div class="container">

        <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

        <ul class="breadcrumbs">

            <li><a href="index.html">Home</a></li>
            <li>FAQ</li>

        </ul>

        <div class="row">
            @include('include.infoSidebar')

            <main class="col-md-9 col-sm-8">

                <h1>FAQ</h1>

                <!-- - - - - - - - - - - - - - Accordion - - - - - - - - - - - - - - - - -->

                <dl class="accordion">

                    @foreach($faq as $faq1)

                    <dt>{{$faq1->question}}</dt>
                    <dd>{{$faq1->answer}}</dd>

                    @endforeach

                   

                </dl>

                <!-- - - - - - - - - - - - - - End of accordion - - - - - - - - - - - - - - - - -->

            </main><!--/ [col]-->

        </div><!--/ .row-->

    </div><!--/ .container-->

</div><!--/ .page_wrapper-->

<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->
@endsection
@section('extra-js')
<script>
	$('.faqMenu').addClass('current');
</script>
@endsection