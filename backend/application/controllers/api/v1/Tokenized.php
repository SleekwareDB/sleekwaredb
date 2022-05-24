<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tokenized extends Sleekwaredb_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->input->method(true) === 'POST') {
            $form_data = json_decode(file_get_contents('php://input'), true);
            if (!empty($form_data)) {
                $email = $form_data['email'];
                $password = $form_data['password'];
                $verify = $this->core_user->verifyAccessToken($email, $password);
                switch ($verify['code']) {
                    case 200:
                        $response = [
                            'status' => true,
                            'type' => 'success',
                            'code' => Sleekwaredb_Controller::HTTP_OK,
                            'msg' => 'Successfully generete token and get apikey',
                            'result' => [
                                'token' => $verify['token'],
                                'apikey' => $verify['apikey']
                            ]
                        ];
                        break;
                    case 401:
                        $response = [
                            'status' => false,
                            'type' => 'warning',
                            'msg' => 'Authentication failed! Check your email and password.',
                            'code' => Sleekwaredb_Controller::HTTP_UNAUTHORIZED,
                            'result' => []
                        ];
                        break;
                    case 404:
                        $response = [
                            'status' => false,
                            'type' => 'error',
                            'msg' => 'Credential not found!',
                            'code' => Sleekwaredb_Controller::HTTP_NOT_FOUND,
                            'result' => []
                        ];
                        break;
                }
            } else {
                $response = [
                    'status' => false,
                    'type' => 'warning',
                    'msg' => 'Please enter your credentials',
                    'code' => Sleekwaredb_Controller::HTTP_NOT_ACCEPTABLE,
                    'result' => []
                ];
            }
        } else {
            $response = [
                'status' => false,
                'type' => 'warning',
                'msg' => 'Method not allowed',
                'code' => Sleekwaredb_Controller::HTTP_METHOD_NOT_ALLOWED,
                'result' => []
            ];
        }
        $this->response($response, $response['code']);
    }
}
