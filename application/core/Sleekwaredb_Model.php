<?php

use SleekDB\Query;
use SleekDB\Store;

class Sleekwaredb_Model extends CI_Model
{
    protected $models;
    protected $store;
    protected $sleekDBConfig;
    protected $_coreUserTable = 'users';
    protected $_coreLoggerTable = 'loggers';
    protected $_coreAppDatabase = 'SleekwareDB';

    public function __construct()
    {
        parent::__construct();
        // Define Model in Array Assoc
        $this->models = include APPPATH . '/loaders/models.php';

        $this->load->library(['session', 'user_agent']);
        $this->load->helper(['url', 'html', 'form', 'app']);

        // default sleekDB configurations
        $this->sleekDBConfig = [
            "auto_cache" => true,
            "cache_lifetime" => null,
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
    public function collection($database, $name)
    {
        $databaseName = md5($database);
        $this->store = new Store( $name, STORAGE . $databaseName, $this->sleekDBConfig );
        return $this->store;
    }

    public function coreUserCollection()
    {
        $databaseName = md5($this->_coreAppDatabase);
        $this->store = new Store($this->_coreUserTable, APP_DATABASE . $databaseName, $this->sleekDBConfig);
        return $this->store;
    }

    public function coreLoggerCollection()
    {
        $databaseName = md5($this->_coreAppDatabase);
        $this->store = new Store($this->_coreLoggerTable, APP_DATABASE . $databaseName, $this->sleekDBConfig);
        return $this->store;
    }
}
