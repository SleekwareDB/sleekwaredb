<?php
defined('BASEPATH') or exit('No direct script access allowed');

use SleekDB\Query;
use SleekDB\Store;

class Sleekwaredb_Model extends CI_Model
{
    protected $models;
    protected $store;
    protected $sleekDBConfig;

    public function __construct()
    {
        parent::__construct();
        // Define Model in Array Assoc
        $this->models = include APPPATH . '/loaders/models.php';

        $this->load->library(['session', 'user_agent']);
        $this->load->helper(['url', 'html', 'form', 'app', 'cookie', 'string']);

        // default sleekDB configurations
        $this->sleekDBConfig = [
            "auto_cache" => true,
            "cache_lifetime" => 240, // 4 minutes
            "timeout" => false,
            "primary_key" => "_id",
            "search" => [
                "min_length" => 2,
                "mode" => "or",
                "score_key" => "scoreKey",
                "algorithm" => Query::SEARCH_ALGORITHM["hits"]
            ]
        ];

        if (!empty($this->models)) {
            foreach ($this->models as $key => $value) {
                $this->load->model($key, $value);
            }
        }
    }

    /**
     * > It creates a new instance of the Store class, which is the class that handles all the CRUD
     * operations
     *
     * @param database The name of the database name is user email / team name / project name / application name.
     * @param name The name of the collection
     *
     * @return The store collection object.
     */
    public function collection($name)
    {
        $this->store = new Store( $name, APP_DATABASE, $this->sleekDBConfig );
        return $this->store;
    }

    public function coreAppCollection()
    {
        $files = array();
        $dir = opendir(APP_DATABASE);
        while (($currentFile = readdir($dir)) !== false) {
            $skips = ['.','..','.gitignore','index.html'];
            if (in_array($currentFile, $skips)) {
                continue;
            }
            $files[] = $currentFile;
        }
        closedir($dir);
        return count($files);
    }

    /**
     * > It creates a new store object and returns it
     *
     * @param storeName The name of the store you want to create.
     *
     * @return The store object.
     */
    public function store($storeName)
    {
        $this->store = new Store( $storeName, APP_DATABASE, $this->sleekDBConfig );
        return $this->store;
    }

    /**
     * It creates a new database and stores the application details in the `apps` collection
     *
     * @param payload An array of data that will be used to create the application.
     */
    public function bootingUserApp($payload)
    {
        $error = true;
        try {
            $storeCollections = ['apps', 'users', 'teams', 'projects', 'applications', 'rest_keys', 'rest_logs', 'rest_access', 'rest_limits'];
            for ($i = 0; $i < count($storeCollections); $i++) {
                $this->store = new Store($storeCollections[$i], APP_DATABASE, $this->sleekDBConfig);
            }

            // Create super admin user
            $this->collection('users')->insert(add_metadata([
                'fullname' => $payload['fullname'],
                'username' => $payload['username'],
                'email' => $payload['email'],
                'role' => 'super_admin',
                'uniqueMagicToken' => null,
            ]));

            // Store application Details
            $this->collection('apps')->insert(add_metadata([
                'applicationName' => $payload['applicationName'],
                'applicationDescription' => $payload['applicationDescription'],
                'applicationId' => guidv4(),
                'applicationSecret' => random_string('encrypt', 32),
                'configurations' => [
                    'email' => [
                        'from' => null,
                        'fromName' => null,
                        'replyTo' => null,
                        'smtp' => [
                            'debug' => null,
                            'auth' => null,
                            'host' => null,
                            'port' => null,
                            'username' => null,
                            'password' => null,
                            'secure' => null,
                        ],
                    ],
                ]
            ]));

            // Create API Key for Super Account
            $this->collection('rest_keys')->insert(add_metadata([
                'email' => $payload['email'],
                'key' => random_string('encrypt'),
                'level' => 1,
                'ignore_limits' => false,
                'is_private_key' => false,
                'ip_addresses' => null,
                'date_created' => sleektime()
            ]));
        } catch (\Throwable $th) {
            $error = false;
        }

        return $error;
    }

    public function allStores()
    {
        $stores = APP_DATABASE;
        $files = array();
        $dir = opendir($stores);
        while (($currentFile = readdir($dir)) !== false) {
            if ($currentFile == '.' or $currentFile == '..') {
                continue;
            }
            $files[] = $currentFile;
        }
        closedir($dir);
        usort($files, function ($a, $b) {
            return strnatcmp($a, $b);
        });
        return $this->_storeTotalCollections($files);
    }

    private function _storeTotalCollections($storeNames)
    {
        $storeCollections = [];
        foreach ($storeNames as $name) {
            $this->store = new Store($name, APP_DATABASE, $this->sleekDBConfig);
            array_push($storeCollections, [
                'uuid' => guidv4(),
                'name' => $name,
                'totalCollections' => $this->store->count()
            ]);
        }
        return $storeCollections;
    }

    protected function collection_rows($name)
    {
        $this->store = new Store($name, APP_DATABASE, $this->sleekDBConfig);
        return $this->store->count();
    }

    public function collection_filtered($name)
    {
        $this->store = new Store($name, APP_DATABASE, $this->sleekDBConfig);
        $query = $this->store->createQueryBuilder();
        $data = $query->where(['deleted', '=', null])->getQuery()->fetch();
        return count($data);
    }
}
