<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Sleekwaredb_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->response([
			'status' => true,
			'message' => 'Welcome to SleekwareDB API v'. get_version(),
			'php_version' => phpversion(),
			'sleekdb_version' => sleekdb_version(),
			'default_timezone' => [
				'timezone' => getenv('TIME_ZONE'),
				'epoch_unix_milliseconds' => sleektime(),
				'date_time' => date("D, d M Y H:i:s", sleektime() / 1000),
			]
		]);
	}

	public function error_404()
	{
		$this->response([
			'status' => false,
			'message' => 'Page not found'
		], Sleekwaredb_Controller::HTTP_NOT_FOUND);
	}

	public function authorization()
	{
		$redirect_link = base64_decode($this->form_data['redirect']);
		$fallback_link = base64_decode($this->form_data['fallback']);
		$token = $this->form_data['token'];
		if ( $this->core_user->validateMagicKey($token) ) {
			echo "<h1>Wait for redirect to $redirect_link</h1>";
			redirect($redirect_link, 'refresh');
		} else {
			echo "<h2>Invalid token $token</h2>";
			redirect($fallback_link, 'refresh');
		}
	}
}
