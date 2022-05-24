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
			'message' => 'Welcome to SleekwareDB API v1.0'
		]);
	}
}
