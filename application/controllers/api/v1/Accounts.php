<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Accounts extends Rest_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index_get()
    {
        $users = $this->core_user->all();
        $this->response([
            'status' => true,
            'type' => 'success',
            'code' => Rest_Controller::HTTP_OK,
            'result' => $users
        ], Rest_Controller::HTTP_OK);
    }
}
