<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Install extends Sleekwaredb_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // check if method sent using POST method
        if ($this->input->method(true) === 'POST') {
            if ($this->core_app->firstInstall($this->form_json) === true) {
                $response = [
                    'status' => true,
                    'type' => 'success',
                    'code' => Sleekwaredb_Controller::HTTP_OK,
                    'msg' => 'Successfully installed SleekwareDB'
                ];
            } else {
                $response = [
                    'status' => false,
                    'type' => 'error',
                    'code' => Sleekwaredb_Controller::HTTP_NOT_ACCEPTABLE,
                    'msg' => 'Failed to install SleekwareDB'
                ];
            }
        } else {
            $response = [
                'status' => false,
                'type' => 'error',
                'code' => Sleekwaredb_Controller::HTTP_METHOD_NOT_ALLOWED,
                'msg' => 'Method not allowed'
            ];
        }
        $this->response($response, $response['code']);
    }
}
