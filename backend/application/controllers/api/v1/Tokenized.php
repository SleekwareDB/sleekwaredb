<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tokenized extends Rest_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index_post()
    {
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
                        'code' => Rest_Controller::HTTP_OK,
                        'msg' => 'Successfully generete token and get apikey',
                        'result' => [
                            'token' => $verify['token'] . '.' . $verify['pharse'],
                            'apikey' => $verify['apikey']
                        ]
                    ];
                    break;
                case 401:
                    $response = [
                        'status' => false,
                        'type' => 'warning',
                        'msg' => 'Authentication failed! Check your email and password.',
                        'code' => Rest_Controller::HTTP_UNAUTHORIZED,
                        'result' => []
                    ];
                    break;
                case 404:
                    $response = [
                        'status' => false,
                        'type' => 'error',
                        'msg' => 'Credential not found!',
                        'code' => Rest_Controller::HTTP_NOT_FOUND,
                        'result' => []
                    ];
                    break;
            }
        } else {
            $response = [
                'status' => false,
                'type' => 'warning',
                'msg' => 'Please enter your credentials',
                'code' => Rest_Controller::HTTP_NOT_ACCEPTABLE,
                'result' => []
            ];
        }
    }
}
