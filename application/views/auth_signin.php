<div class="card bg-dark border-0" style="width: 25rem;">
	<div class="card-body">
		<div class="text-center">
			<a href="<?= base_url() ?>"><img src="<?= base_url('assets/img/logo-with-no-bg.png') ?>" alt="SleekwareDB" width="125" height="35"></a>
		</div>
		<hr>
		<form id="loginForm" method="post" autocomplete="off">
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="Email">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Password">
			</div>
			<button type="submit" class="btn btn-primary btn-block">Login</button>
			<div class="text-center mt-2">
				<a href="<?= base_url('forgot_password') ?>" class="btn btn-link">Forgot Password</a>
			</div>
			<hr>
			<div class="form-group text-center">
				<p>Dont have SleekwareDB Account</p>
				<a href="<?= base_url('auth_signup') ?>" class="btn btn-outline-primary btn-block">Signup</a>
			</div>
		</form>
	</div>
</div>
