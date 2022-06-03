<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Configuration extends Rest_Controller
{

    public function __construct()
    {
        parent::__construct();
        token_middleware();
    }

    public function index_get()
    {
        $config = $this->core_app->all();
        $this->response([
            'status' => true,
            'type' => 'success',
            'code' => Rest_Controller::HTTP_OK,
            'msg' => 'Configuration successfully fetched',
            'result' => $config
        ], Rest_Controller::HTTP_OK);
    }

    public function index_put()
    {
        $notAllowedKeys = ['_id','deletedAt','updatedAt','createdAt','configurations.email','configurations.email.smtp'];
        $allowedKeys = [
            'applicationName',
            'applicationDescription',
            'configurations.email.from',
            'configurations.email.fromName',
            'configurations.email.smtp.host',
            'configurations.email.smtp.port',
            'configurations.email.smtp.username',
            'configurations.email.smtp.password',
            'configurations.email.smtp.encryption'
        ];

        if (!empty($this->form_json)) {
            $secured = array_diff_key($this->form_json, array_flip($notAllowedKeys));

            $sanitazed = [];
            foreach ($secured as $key => $value) {
                if (in_array($key, $allowedKeys)) {
                    $sanitazed[$key] = $value;
                }
            }
            if ($this->core_app->updateConfig($sanitazed)) {
                $response = [
                    'status' => true,
                    'type' => 'success',
                    'code' => Sleekwaredb_Controller::HTTP_CREATED,
                    'msg' => 'Document successfully updated',
                    'result' => [
                        'document' => $this->core_app->all()
                    ]
                ];
            } else {
                $response = [
                    'status' => false,
                    'type' => 'error',
                    'code' => Sleekwaredb_Controller::HTTP_NOT_MODIFIED,
                    'msg' => 'Document failed updated',
                    'result' => []
                ];
            }
        } else {
            $response = [
                'status' => false,
                'type' => 'error',
                'code' => Sleekwaredb_Controller::HTTP_INTERNAL_ERROR,
                'msg' => 'Data is empty',
                'result' => []
            ];
        }

        $this->response($response, $response['code']);
    }
}
