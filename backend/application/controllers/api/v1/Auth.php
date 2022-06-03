<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends Sleekwaredb_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        if ($this->input->method(true) === 'POST') {
            $username = $this->form_json['username'];
            $email = $this->form_json['email'];

            $user = $this->core_user->authenticate($username, $email);

            if (!empty($user)) {
                $issuedAt   = new DateTimeImmutable();
                $expire     = $issuedAt->modify('+1 weeks')->getTimestamp();      // Add 1 weeks
                $serverName = $this->input->server('SERVER_NAME');
                $payload = [
                    'iat'  => $issuedAt->getTimestamp(),         // Issued at: time when the token was generated
                    'iss'  => $serverName,                       // Issuer
                    'nbf'  => $issuedAt->getTimestamp(),         // Not before
                    'exp'  => $expire,                           // Expire
                    'data' => [
                        'username' => $username,
                        'email' => $email,
                        'fullname' => $user['fullname'],
                        'uuid' => $user['uuid']
                    ]
                ];

                $apikey = $this->core_user->getApiKey($email);

                if ($this->core_app->checkIfEmailIsSet()) {
                    // TODO: Send email magic link
                } else {
                    $response = [
                        'status' => true,
                        'type' => 'success',
                        'code' => Sleekwaredb_Controller::HTTP_OK,
                        'msg' => 'Successfully login',
                        'result' => [
                            'apikey' => $apikey,
                            'token' => encode_auth_token($payload),
                            'type' => 'bearer'
                        ]
                    ];
                }
            } else {
                $response = [
                    'status' => false,
                    'type' => 'warning',
                    'msg' => 'Authentication failed! Check your email and username.',
                    'code' => Sleekwaredb_Controller::HTTP_UNAUTHORIZED,
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
