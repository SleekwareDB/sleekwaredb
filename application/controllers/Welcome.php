<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Betta_Controller {
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function auth_signin()
	{
		$this->load->view('auth_signin');
	}
}
