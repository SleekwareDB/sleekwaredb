<?php
defined('BASEPATH') or exit('No direct script access allowed');

class App_model extends Sleekwaredb_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function checkIfInstalled()
    {
        return $this->coreAppCollection()->count() > 0;
    }

    public function save( array $data )
    {
        $appData = [
            'applicationName' => $data['applicationName'],
            'applicationDescription' => $data['applicationDescription'],
            'appId' => $data['appId'],
            'appSecret' => $data['appSecret'],
            'createdAt' => date('Y-m-d H:i:s'),
            'updatedAt' => date('Y-m-d H:i:s'),
            'deletedAt' => null
        ];
        $this->coreAppCollection()->insert($appData);

        $userData = [
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role' => 'super',
            'createdAt' => date('Y-m-d H:i:s'),
            'updatedAt' => date('Y-m-d H:i:s'),
            'deletedAt' => null
        ];
        $this->coreUserCollection()->insert($userData);
    }
}
