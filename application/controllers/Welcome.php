<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Sleekwaredb_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title'] = 'SleekwareDB';
		$data['content'] = 'welcome_message';
		$this->load->view('layout/app', $data);
	}

	public function auth_signin()
	{
		$data['title'] = 'SleekwareDB - Signin';
		$data['content'] = 'auth_signin';
		$this->load->view('layout/auth', $data);
	}

	public function auth_signup()
	{
		$data['title'] = 'SleekwareDB - Signup';
		$data['content'] = 'auth_signup';
		$this->load->view('layout/auth', $data);
	}
}
