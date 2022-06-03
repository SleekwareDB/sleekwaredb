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
}
