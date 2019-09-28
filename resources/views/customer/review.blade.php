@extends('layout.app')
@section('content')

<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

<div class="secondary_page_wrapper">

    <div class="container">

        <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

        <ul class="breadcrumbs">

            <li><a href="index.html">Home</a></li>
            <li>manage address</li>

        </ul>

        <!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

        <div class="row">

            @include('include.accountSidebar')

            <main class="col-md-9 col-sm-8">

                
                <section class="section_offset">

                        <h3>My Reviews</h3>

                        <ul class="reviews">
                        @foreach($review as $row)
                            <li > 
                            <a href="#" onclick="Delete({{$row->id}})" class="button_dark_grey pull-right">Delete</a>
                            <a href="/edit-review/{{$row->id}}" class="button_dark_grey pull-right">Edit</a>
                                <article class="review">
                                    <ul class="review-rates">
                                        <li class="v_centered">
                                            <img src="{{asset('upload_single_product/').'/'.$row->product_image}}" alt="product_img2.jpg" width="100" class="review-product">
                                        </li>
                                    </ul>
                                    <div class="review-body">
                                        <div class="review-meta">
                                        <h5 class="bold">{{$row->summary}}  
                                            <ul class="rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if($i <= $row->price_rate)
                                                <li class="active"></li>
                                                @else
                                                <li class=""></li>
                                                @endif
                                            @endfor
                                            </ul>
                                        </h5>
                                        </div>
                                        <p>{{$row->review_message}}</p>
                                       <br> Review by <a href="#" class="bold">{{$row->nickname}}</a> on {{date('d-m-Y',strtotime($row->created_at))}}
                                    </div>
                                </article>
                            </li>
                        @endforeach
                        </ul>
                        <!-- <a href="#" class="button_grey middle_btn">Show All</a> -->
                    </section>
            </main>
        </div>
    </div>
</div>
<script>
    $('.rating-rev').addClass('accSidebarActive');
    function Delete(id){
      var r = confirm("Are you sure");
      if (r == true) {
      $.ajax({
        url : '/reviewDelete/'+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          toastr.success('Review Delete Successfully', 'Successfully Delete');
          //$('.table').load(location.href+' .table');
          location.reload();
        }
      });
    } 
     }
</script>
@endsection
@section('extra-js')

@endsection