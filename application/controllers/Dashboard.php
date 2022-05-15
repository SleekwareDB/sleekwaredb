<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Sleekwaredb_Controller {

	public function __construct()
	{
		parent::__construct();
		need_login();
	}

	public function index()
	{
		$data['title'] 		= "Dashboard - SleekwareDB";
		$data['content'] 	= "dashboard";
		$data['breadcrumb'] = [
			['title' => 'Home', 'href' => base_url('dashboard')],
			['title' => 'Dashboard', 'href' => 'javascript:;']
		];
		$this->load->view('layout/adminlte', $data);
	}
}
