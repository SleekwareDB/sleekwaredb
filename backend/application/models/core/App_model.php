<?php
defined('BASEPATH') or exit('No direct script access allowed');

class App_model extends Sleekwaredb_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    private function checkIfInstalled()
    {
        return $this->coreAppCollection() ? true : false;
    }

    public function firstInstall( array $data )
    {
        if ($this->checkIfInstalled() === false) {
            return $this->bootingUserApp($data);
        } else {
            return false;
        }
    }

    public function checkIfEmailIsSet()
    {
        $checker = $this->collection('apps')->createQueryBuilder();
        $result = $checker->select(['configurations.emails.from', 'configurations.emails.fromName'])
            ->where(['configurations.emails.from', '!=', null])
            ->where(['configurations.emails.fromName', '!=', null])->getQuery()->fetch();
        return $result ? true : false;
    }

    public function getAppValue($key)
    {
        $app = $this->collection('apps')->createQueryBuilder();
        return $app->select($key)->getQuery()->first();
    }

    public function all()
    {
        $app = $this->store('apps')->findOneBy(['_id', '=', 1]);
        $secured = array_diff_key($app, array_flip(['uuid', '_id', 'deletedAt', 'createdAt', 'updatedAt']));
        return $secured;
    }

    public function updateConfig(array $data)
    {
        $app = $this->store('apps')->createQueryBuilder();
        return $app->where(['_id','=', 1])->getQuery()->update($data);
    }
}
