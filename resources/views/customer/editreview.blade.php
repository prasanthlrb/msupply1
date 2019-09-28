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
                                <section class="section_offset">
                                    <h3>Edit Your Own Review</h3>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <!-- <p>You're reviewing: <a href="#">Metus nulla facilisi, Original 24 fl oz</a><br>How do you rate this product? *</p> -->
                                            <div class="table_wrap rate_table">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>1 Star</th>
                                                            <th>2 Stars</th>
                                                            <th>3 Stars</th>
                                                            <th>4 Stars</th>
                                                            <th>5 Stars</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Price</td>
                                                            <td>
                                                                <input <?php echo $review->price_rate == '1' ? 'checked' : '' ?> value="1" checked type="radio" name="price_rate" id="rate_1">
                                                                <label for="rate_1"></label>
                                                            </td>
                                                            <td>
                                                                <input <?php echo $review->price_rate == '2' ? 'checked' : '' ?> value="2" type="radio" name="price_rate" id="rate_2">
                                                                <label for="rate_2"></label>
                                                            </td>
                                                            <td>
                                                                <input <?php echo $review->price_rate == '3' ? 'checked' : '' ?> value="3" type="radio" name="price_rate" id="rate_3">
                                                                <label for="rate_3"></label>
                                                            </td>
                                                            <td>
                                                                <input <?php echo $review->price_rate == '5' ? 'checked' : '' ?> value="4" type="radio" name="price_rate" id="rate_4">
                                                                <label for="rate_4"></label>
                                                            </td>
                                                            <td>
                                                                <input <?php echo $review->price_rate == '5' ? 'checked' : '' ?> value="5" type="radio" name="price_rate" id="rate_5">
                                                                <label for="rate_5"></label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Value</td>
                                                            <td>
                                                                <input <?php echo $review->value_rate == '1' ? 'checked' : '' ?> value="1" checked type="radio" name="value_rate" id="rate_6">
                                                                <label for="rate_6"></label>
                                                            </td>
                                                            <td>
                                                                <input <?php echo $review->value_rate == '2' ? 'checked' : '' ?> value="2" type="radio" name="value_rate" id="rate_7">
                                                                <label for="rate_7"></label>
                                                            </td>
                                                            <td>
                                                                <input <?php echo $review->value_rate == '3' ? 'checked' : '' ?> value="3" type="radio" name="value_rate" id="rate_8">
                                                                <label for="rate_8"></label>
                                                            </td>
                                                            <td>
                                                                <input <?php echo $review->value_rate == '4' ? 'checked' : '' ?> value="4" type="radio" name="value_rate" id="rate_9">
                                                                <label for="rate_9"></label>
                                                            </td>
                                                            <td>
                                                                <input <?php echo $review->value_rate == '5' ? 'checked' : '' ?> value="5" type="radio" name="value_rate" id="rate_10">
                                                                <label for="rate_10"></label>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Quality</td>
                                                            <td>
                                                                <input <?php echo $review->quality_rate == '1' ? 'checked' : '' ?> value="1" checked type="radio" name="quality_rate" id="rate_11">
                                                                <label for="rate_11"></label>
                                                            </td>
                                                            <td>
                                                                <input <?php echo $review->quality_rate == '2' ? 'checked' : '' ?> value="2" type="radio" name="quality_rate" id="rate_12">
                                                                <label for="rate_12"></label>
                                                            </td>
                                                            <td>
                                                                <input <?php echo $review->quality_rate == '3' ? 'checked' : '' ?> value="3" type="radio" name="quality_rate" id="rate_13">
                                                                <label for="rate_13"></label>
                                                            </td>
                                                            <td>
                                                                <input <?php echo $review->quality_rate == '4' ? 'checked' : '' ?> value="4" type="radio" name="quality_rate" id="rate_14">
                                                                <label for="rate_14"></label>
                                                            </td>
                                                            <td>
                                                                <input <?php echo $review->quality_rate == '5' ? 'checked' : '' ?> value="5" type="radio" name="quality_rate" id="rate_15">
                                                                <label for="rate_15"></label>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <p class="subcaption">All fields are required.</p>
                                            <form method="post" id="form" class="type_2">
                                                {{csrf_field()}}
                                                <ul>
                                                    <li class="row">
                                                        <div class="col-sm-6">
                                                            <input value="{{$review->product_id}}" type="hidden" name="product_id" id="product_id">
                                                            <input value="{{$review->customer_id}}" type="hidden" name="customer_id" id="customer_id">
                                                            <input value="{{$review->id}}" type="hidden" name="id" id="id">
                                                            <label for="nickname">Nickname</label>
                                                            <input value="{{$review->nickname}}" type="text" name="nickname" id="nickname">
                                                        </div>
                                                        <div class="col-sm-6">
                                                            
                                                            <label for="summary">Summary of Your Review</label>
                                                            <input value="{{$review->summary}}" type="text" name="summary" id="summary">
                                                        </div>
                                                    </li>
                                                    <li class="row">
                                                        <div class="col-xs-12">
                                                            <label for="review_message">Review</label>
                                                            <textarea rows="5" name="review_message" id="review_message">{{$review->review_message}}</textarea>
                                                        </div>
                                                    </li>
                                                    <li class="row">
                                                        <div class="col-xs-12">
                                                            <button type="button" onclick="Review()" class="button_dark_grey middle_btn">Submit Review</button>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </form>
                                        </div>

                                    </div>

                                </section>
                        </ul>
                        <!-- <a href="#" class="button_grey middle_btn">Show All</a> -->
                    </section>
            </main>
        </div>
    </div>
</div>
<script>
	$('.rating-rev').addClass('accSidebarActive');
function Review(){
    var product_form_data = new FormData($('#form')[0]);

    var price_rate = $('input[name=price_rate]:checked').val();
    var value_rate = $('input[name=value_rate]:checked').val();
    var quality_rate = $('input[name=quality_rate]:checked').val();

        product_form_data.append('price_rate',price_rate);
        product_form_data.append('value_rate',value_rate);
        product_form_data.append('quality_rate',quality_rate);
    $.ajax({
        url : '/updateReview',
        type: "POST",
        data: product_form_data,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
            $("#form")[0].reset();
            toastr.success('Review Update Successfully', 'Successfully Save');
            window.location.href = "/account/review";
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
@endsection
@section('extra-js')

@endsection