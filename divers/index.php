<form class="row login_form" method="post" id="contactForm" novalidate="novalidate">

	<div class="col-md-12 form-group">
		<input type="text" class="form-control" id="name" name="name" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
	</div>

	<div class="col-md-12 form-group">

		<input
				type="text"
				class="form-control"
				id="password"
				name="password"
				placeholder="Password"
				onfocus="this.placeholder = ''" 
				onblur="this.placeholder = 'Password'">

	</div>

	<div class="col-md-12 form-group">

		<div class="creat_account">

		<input
			type="checkbox"
			id="f-option2"
			name="selector">

			
		<label for="f-option2">Keep me logged in</label>

		</div>

	 </div>

	<div class="col-md-12 form-group">

		<button type="submit" value="submit" class="primary-btn">Log In</button>

		<a href="#">Forgot Password?</a>

		</div>

</form>

<?php
	echo $_POST['name'];
	echo $_POST['password'];
?>