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
            $redirect = $this->form_json['redirect'] ?? null;
            $fallback = $this->form_json['fallback'] ?? null;

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

                $isEmailSet = (!is_null(app_config(['from' => 'configurations.email.from'])) && !is_null(app_config(['fromName' => 'configurations.email.fromName'])));

                if ($isEmailSet && !empty($redirect) && !empty($fallback)) {
                    // Send email magic link
                    $uniqueMagicToken = guidv4();
                    $magicLink = base_url('authorization') . '?redirect=' . base64_encode($redirect) . '&fallback='. base64_encode($fallback) .'&token=' . $uniqueMagicToken;
                    $sentEmail = sleekwaredb_mailer($email, '[Magic Link SleekwareDB] Login request', 'Login requested from ' . $username, [
                        'subject' => 'Login requested from ' . $username,
                        'username' => $username,
                        'magic_link' => $magicLink
                    ], true);

                    if ( $sentEmail ) {
                        $data = ['uniqueMagicToken' => $uniqueMagicToken];
                        $this->core_user->generateMagicKey($user['_id'], $data);
                        $response = [
                            'status' => true,
                            'type' => 'success',
                            'code' => Sleekwaredb_Controller::HTTP_OK,
                            'msg' => 'Magic Link has been sent to your email! Please check your email.',
                            'result' => []
                        ];
                    } else {
                        $response = [
                            'status' => false,
                            'type' => 'error',
                            'code' => Sleekwaredb_Controller::HTTP_INTERNAL_ERROR,
                            'msg' => 'Failed to send magic link to your email! Please try again.',
                            'result' => []
                        ];
                    }
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
