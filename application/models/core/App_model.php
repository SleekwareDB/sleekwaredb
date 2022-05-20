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
        return $this->coreAppCollection() > 0;
    }

    public function save( array $data )
    {
        $appData = [
            'applicationName' => $data['applicationName'],
            'applicationDescription' => $data['applicationDescription'],
            'appId' => $data['appId'],
            'appSecret' => $data['appSecret']
        ];
        $this->collection('apps')->insert(add_metadata($appData));

        $userData = [
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role' => 'super',
        ];
        $this->collection('users')->insert(add_metadata($userData));

        if (checkIsAlreadyBoot($data['email']) === false) {
            $this->bootingUserApp($data['email']);
        }
    }

    public function getAppValue($key)
    {
        $app = $this->collection('apps')->createQueryBuilder();
        return $app->select(["{$key}"])->getQuery()->first();
    }
}
