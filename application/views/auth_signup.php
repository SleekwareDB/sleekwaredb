<div class="card bg-dark border-0" style="width: 25rem;">
	<div class="card-body">
		<div class="text-center">
			<a href="<?= base_url() ?>"><img src="<?= base_url('assets/img/logo-with-no-bg.png') ?>" alt="SleekwareDB" width="125" height="35"></a>
		</div>
		<hr>
		<form id="signUpForm" method="post" autocomplete="off" class="needs-validation" novalidate>
			<div class="form-group">
				<label for="fullname">Fullname</label>
				<input type="text" name="fullname" id="fullname" class="form-control" placeholder="Fullname" required>
			</div>
			<div class="form-group">
				<label for="email">Email</label>
				<input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
			</div>
			<button type="submit" class="btn btn-primary btn-block">Signup</button>
			<hr>
			<div class="form-group text-center">
				<p>Have SleekwareDB Account</p>
				<a href="<?= base_url() ?>" class="btn btn-outline-primary btn-block">Signin</a>
			</div>
		</form>
	</div>
</div>
