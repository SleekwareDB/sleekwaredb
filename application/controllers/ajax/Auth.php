<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends Sleekwaredb_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Check if not ajax request stop application
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
    }

    /**
     * It checks if the user is authorized to login.
     */
    public function sign_in()
    {
        $email = $this->form_data['email'];
        $password = $this->form_data['password'];

        $status = $this->core_user->checkLogin($email, $password);
        if ($status == 200) {
            $response = [
                'status' => true,
                'type' => 'success',
                'code' => Sleekwaredb_Controller::HTTP_OK,
                'msg' => 'Login success!'
            ];
        } else {
            $response = [
                'status' => false,
                'type' => 'error',
                'code' => ($status == 401) ? Sleekwaredb_Controller::HTTP_UNAUTHORIZED : Sleekwaredb_Controller::HTTP_NOT_FOUND,
                'msg' => ($status == 401) ? 'Login unauthorized!' : 'Credential not found!'
            ];
        }
        $this->response($response, $response['code'], 'json');
    }

    /**
     * It creates a new user account
     */
    public function create_account()
    {
        $data = [
            'fullname' => $this->form_data['fullname'],
            'email' => $this->form_data['email'],
            'password' => password_hash($this->form_data['password'], PASSWORD_DEFAULT)
        ];

        if ($this->core_user->save($data)) {
            $response = [
                'status' => true,
                'type' => 'success',
                'code' => Sleekwaredb_Controller::HTTP_OK,
                'msg' => 'New user created!'
            ];
        } else {
            $response = [
                'status' => false,
                'type' => 'error',
                'code' => Sleekwaredb_Controller::HTTP_NOT_MODIFIED,
                'msg' => 'Failed to create new user'
            ];
        }
        $this->response($response, $response['code'], 'json');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $response = [
            'status' => true,
            'type' => 'success',
            'code' => Sleekwaredb_Controller::HTTP_OK,
            'msg' => 'Logout success!'
        ];
        $this->response($response, $response['code'], 'json');
    }
}
