@extends('layout.app')

@section('content')

<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

			<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="/">Home</a></li>
						<li>Checkout</li>

					</ul>

					<h1 class="page_title">Checkout</h1>


					<!-- - - - - - - - - - - - - - Billing information - - - - - - - - - - - - - - - - -->

<!-- <form method="post" id="form" action="#"> -->
						<section class="section_offset">

                        <h1 style="text-align:center">{{$message}}</h1>

					</section>

					<!-- - - - - - - - - - - - - - End of order review - - - - - - - - - - - - - - - - -->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
			
@endsection
