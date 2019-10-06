<div id="login_mw" class="modal_window">

	<button class="close arcticmodal-close"></button>

	<header class="on_the_sides">

		<div class="left_side">

			<h2>Register OTP</h2>

		</div>

	

	</header>

	<form class="type_2" id="otp_form" method="POST">
        @csrf
		<ul>

			<li class="otp_show_field after_form">
				<label for="phone" class="required">Enter Your OTP</label>
				<input type="text" name="otp_number" id="otp_number">
			</li>
			
		</ul>

	</form>

	<hr>

	<div class="streamlined">


		<ul>

	
		<li class="v_centered" style="float:right">
				<button class="button_blue middle_btn" onclick="submitOTP()">SUBMIT OTP</button>
				
			</li>
		</ul>

	</div>

</div>
@section('extra-js')
<script>
$('.before_form').each(function(){
                $('.before_form').removeClass('otp_show_field');
            })
            $('.after_form').each(function(){
                $('.after_form').addClass('otp_show_field');
            })
</script>
@endsection