<!--==================================
		Login modal window
======================================-->

<div id="login_mw" class="modal_window">

	<button class="close arcticmodal-close"></button>

	<header class="on_the_sides">

		<div class="left_side">

			<h2>Create Site</h2>

		</div>

		<div class="right_side">

			<a href="#" class="button_grey middle_btn" onclick="saveProject()">Submit</a>

		</div>

	</header>

 <form id="project_form" method="post">
            {{ csrf_field() }}

		<ul>

			<li>
				<label for="project_name">Site Title</label>
				<input type="text" name="project_name" id="project_name">
			</li>

		

		</ul>

	</form>

	<hr>



</div>

