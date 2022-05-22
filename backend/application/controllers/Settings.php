<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends Sleekwaredb_Controller {

	public function __construct()
	{
		parent::__construct();
		need_login();
	}

	public function account()
	{
		$data['title'] 		= "SleekwareDB Account";
		$data['content'] 	= "settings/sleekwaredb-account";
		$data['breadcrumb'] = [
			['title' => 'Home', 'href' => base_url('dashboard')],
			['title' => 'SleekwareDB Account', 'href' => 'javascript:;']
		];
		$user = $this->core_user->detail();
		$data['user'] = [
			'email' => $user['email'],
			'fullname' => $user['fullname']
		];
		$this->load->view('layout/adminlte', $data);
	}

	public function app()
	{
		$data['title'] 		= "SleekwareDB Configuration";
		$data['content'] 	= "settings/sleekwaredb-settings";
		$data['breadcrumb'] = [
			['title' => 'Home', 'href' => base_url('dashboard')],
			['title' => 'SleekwareDB Configuration', 'href' => 'javascript:;']
		];
		$data['setting'] = [
			'applicationName' => app_config('applicationName'),
			'applicationDescription' => app_config('applicationDescription'),
			'appId' => app_config('appId'),
			'appSecret' => app_config('appSecret')
		];
		$user = $this->core_user->detail();
		$data['user'] = [
			'email' => $user['email'],
			'fullname' => $user['fullname']
		];
		$this->load->view('layout/adminlte', $data);
	}
}
