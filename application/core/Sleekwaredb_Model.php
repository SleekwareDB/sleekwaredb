<?php

use SleekDB\Query;
use SleekDB\Store;

class Sleekwaredb_Model extends CI_Model
{
    protected $models;
    protected $store;
    protected $sleekDBConfig;

    protected $_coreAppDatabase = 'SleekwareDB';

    protected $_coreUserTable   = 'users';
    protected $_coreLoggerTable = 'loggers';
    protected $_coreAppTable    = 'apps';

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

    public function store($storeName)
    {
        $databaseName = md5($this->session->userdata('email'));
        $this->store = new Store( $storeName, STORAGE . $databaseName, $this->sleekDBConfig );
        return $this->store;
    }

    /**
     * It creates a new instance of the Store class and returns it.
     *
     * @return The coreUserCollection() method returns the store object.
     */
    public function coreUserCollection()
    {
        $databaseName = md5($this->_coreAppDatabase);
        $this->store = new Store($this->_coreUserTable, APP_DATABASE . $databaseName, $this->sleekDBConfig);
        return $this->store;
    }

    /**
     * It creates a new instance of the Store class and returns it.
     *
     * @return The store object.
     */
    public function coreLoggerCollection()
    {
        $databaseName = md5($this->_coreAppDatabase);
        $this->store = new Store($this->_coreLoggerTable, APP_DATABASE . $databaseName, $this->sleekDBConfig);
        return $this->store;
    }

    public function coreAppCollection()
    {
        $databaseName = md5($this->_coreAppDatabase);
        $this->store = new Store($this->_coreAppTable, APP_DATABASE . $databaseName, $this->sleekDBConfig);
        return $this->store;
    }
}
