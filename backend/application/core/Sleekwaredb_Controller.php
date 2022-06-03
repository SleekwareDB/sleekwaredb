<?php
defined('BASEPATH') or exit('No direct script access allowed');

use SleekDB\Query;

/**
 * @package Sleekwaredb_Controller Load default configuration of application
 * @author Imam Ali Mustofa <ddarkterminal@pm.me>
 * @version 1.0
 */
class Sleekwaredb_Controller extends CI_Controller
{

    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_NOT_MODIFIED = 304;
    const HTTP_BAD_REQUEST = 400;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_FORBIDDEN = 403;
    const HTTP_NOT_FOUND = 404;
    const HTTP_METHOD_NOT_ALLOWED = 405;
    const HTTP_NOT_ACCEPTABLE = 406;
    const HTTP_INTERNAL_ERROR = 500;

    protected $update_version;
    protected $models;
    protected $libraries;
    protected $helpers;
    protected $form_data;
    protected $sleekDBConfig;

    /**
     * @param $rest_server
     */
    public function __construct($rest_server = false)
    {
        parent::__construct();

        $this->load->driver('cache', array('adapter' => 'file'));

        // Define Model in Array Assoc
        $this->models = include APPPATH . '/loaders/models.php';
        $this->libraries = include APPPATH . '/loaders/libraries.php';
        $this->helpers = include APPPATH . '/loaders/helpers.php';

        $this->load->library($this->libraries);
        $this->load->helper($this->helpers);

        $this->encryption->initialize(array('driver' => 'openssl'));
        $this->dotenv->load();
        date_default_timezone_set(getenv('TIME_ZONE'));

        $this->form_data = ($this->input->method() == 'post') ? $this->input->post(null, true) : $this->input->get(null,  true);
        $bodyContent = file_get_contents('php://input');
        $this->form_json = $bodyContent ? json_decode($bodyContent, true) : [];

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

        if ($rest_server) {
            if (!in_array($this->input->method(), ['get', 'post', 'put', 'delete'])) {
                $this->response([
                    'status' => false,
                    'msg'    => 'Request Method not allowed!',
                ], self::HTTP_FORBIDDEN);
            }
        }
    }

    /**
     * @param array $response
     * @param int $status
     * @param string $content_type
     */
    public function response($response, int $status = 200, string $content_type = 'json')
    {
        $type = '';
        switch ($content_type) {
            case 'json':
                $type = 'application/json';
                $data = json_encode($response);
                break;
            case 'html':
                $type = 'text/html';
                $data = $response;
                break;
        }

        $this->output
            ->set_content_type($type)
            ->set_status_header($status)
            ->set_output($data);
    }
}
