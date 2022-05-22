<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Team_members extends Sleekwaredb_Controller
{

    public function __construct()
    {
        parent::__construct();
        need_login();
    }

    public function index()
    {
        $data['title']         = "Team Members";
        $data['content']     = "team-members";
        $data['breadcrumb'] = [
            ['title' => 'Home', 'href' => base_url('dashboard')],
            ['title' => 'Team Members', 'href' => 'javascript:;']
        ];
        $this->load->view('layout/adminlte', $data);
    }
}
