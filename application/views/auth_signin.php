<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

	<title>SleekwareDB</title>
	<meta name="description" content="SleekwareDB is a NoSQL database storage service. A database storage service that can be used for various platforms and is easy to integrate.">
	<link rel="shortcut icon" href="<?= base_url('assets/img/logo-with-no-bg.png') ?>" type="image/png">
	<style>
		:root {
			--primary: #4b6795;
			--info: #149f92;
		}
	</style>
</head>

<body class="d-flex align-items-center justify-content-center" style="height: 100vh;">

	<div class="card" style="width: 25rem;">
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
					<a href="<?= base_url('auth/signup') ?>" class="btn btn-outline-primary btn-block">Signup</a>
				</div>
			</form>
		</div>
	</div>

	<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
</body>

</html>
