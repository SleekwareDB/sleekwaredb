<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Teams extends Sleekwaredb_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Check if not ajax request stop application
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
    }

    public function index()
    {
        $search        = $_POST['search']['value'];
        $limit         = $_POST['length'];
        $start         = $_POST['start'];
        $order_index   = $_POST['order'][0]['column'];
        $order_field   = $_POST['columns'][$order_index]['data'];
        $order_ascdesc = $_POST['order'][0]['dir'];

        $user = $this->core_user->datatables($search, $limit, $start, $order_field, $order_ascdesc);

        $response = [
            'draw'            => $_POST['draw'],
            'recordsTotal'    => $user['total'],
            'recordsFiltered' => $user['filtered'],
            'data'            => $user['data']
        ];

        $this->response($response, Sleekwaredb_Controller::HTTP_OK, 'json');
    }

    public function all()
    {
        $users = $this->core_user->all();
        if (!empty($users)) {
            $response = [
                'status' => true,
                'type' => 'success',
                'code' => Sleekwaredb_Controller::HTTP_OK,
                'msg' => 'Load all members',
                'data' => $users
            ];
        } else {
            $response = [
                'status' => false,
                'type' => 'error',
                'code' => Sleekwaredb_Controller::HTTP_NOT_FOUND,
                'msg' => 'Member not found!'
            ];
        }
        $this->response($response, $response['code'], 'json');
    }

    public function save()
    {
        if ( $this->core_user->save($this->form_data) ) {
            $response = [
                'status' => true,
                'type' => 'success',
                'code' => Sleekwaredb_Controller::HTTP_OK,
                'msg' => 'New member is added!'
            ];
        } else {
            $response = [
                'status' => false,
                'type' => 'error',
                'code' => Sleekwaredb_Controller::HTTP_NOT_MODIFIED,
                'msg' => 'New member failed to added!'
            ];
        }
        $this->response($response, $response['code'], 'json');
    }

    public function detail()
    {
        $uuid = $this->uri->segment(4);
        $user = $this->core_user->detail($uuid);
        $this->response($user);
    }

    public function update()
    {
        if ($this->core_user->update($this->form_json)) {
            $response = [
                'status' => true,
                'type' => 'success',
                'code' => Sleekwaredb_Controller::HTTP_OK,
                'msg' => 'Data updated!'
            ];
        } else {
            $response = [
                'status' => false,
                'type' => 'error',
                'code' => Sleekwaredb_Controller::HTTP_NOT_MODIFIED,
                'msg' => 'Failed to update'
            ];
        }
        $this->response($response, $response['code'], 'json');
    }

}
