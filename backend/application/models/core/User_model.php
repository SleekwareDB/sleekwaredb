<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends Sleekwaredb_model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function datatables( $search, $limit, $start, $order_field, $order_ascdesc )
    {
        $users = $this->collection('users')->createQueryBuilder();
        $data = $users->except(['_id', 'deletedAt'])
            ->where(['deletedAt', '=', null])
            ->where(['fullname', 'like', "%{$search}%"])
            ->orWhere(['email', 'like', "%{$search}%"])
            ->orWhere(['role', 'like', "%{$search}%"])
            ->orderBy(["{$order_field}" => "{$order_ascdesc}"])
            ->skip($start)
            ->limit($limit)->getQuery();

        return [
            'total' => count($data->fetch()),
            'data' => $data->fetch(),
            'filtered' => $this->collection_filterd('users')
        ];
    }

    /**
     * > It checks if the user exists in the database, and if it does, it checks if the password is
     * correct
     *
     * @param email The email address of the user
     * @param password The password to verify.
     *
     * @return The status code of the login attempt.
     */
    public function checkLogin($email, $password)
    {
        $user = $this->collection('users');
        $data = $user->findOneBy(['email', '=', $email]);
        if ( !empty($data) ) {
            if ( password_verify($password, $data['password']) ) {
                $token = encode_auth_token([
                    'uuid' => $data['uuid'],
                    'databaseName' => md5($email),
                    'fullname' => $data['fullname'],
                    'email' => $data['email']
                ]);
                set_auth($data['uuid'], $token);
                return 200;
            } else {
                return 401;
            }
        } else {
            return 404;
        }
    }

    /**
     * > This function saves a user's data to the database
     *
     * @param array data The data to be inserted into the database.
     *
     * @return The result of the insert operation.
     */
    public function save( array $data )
    {
        $user = $this->collection('users');
        return $user->insert(add_metadata($data));
    }

    public function update( array $data )
    {
        if (count($data) > 0) {
            $updateData = [];
            $ids = [];
            for ($i=0; $i < count($data); $i++) {
                array_push($updateData, update_metadata($data[$i]));
                array_push($ids, $data[$i]['_id']);
            }
            $query = $this->collection('users')->createQueryBuilder();
            $query->where(['_id', 'not in', $ids])->getQuery()->delete();
            return $this->collection('users')->updateOrInsertMany($updateData);
        } else {
            $id = $data['_id'];
            $updateData = update_metadata($data);
            unset($updateData['_id']);
            return $this->collection('users')->updateById($id, $updateData);
        }
    }

    public function detail( $uuid = null )
    {
        $uid = $uuid ?? get_session('uuid');
        $user = $this->collection('users');
        return $user->findOneBy(['uuid','=', $uid]);
    }

    public function all()
    {
        $user = $this->collection('users')->findAll(["_id" => "desc"]);
        return $user;
    }

    public function verifyAccessToken($email, $password)
    {
        $user = $this->collection('users');
        $data = $user->findOneBy(['email', '=', $email]);
        if (!empty($data)) {
            if (password_verify($password, $data['password'])) {
                $api = $this->collection($email, 'rest_keys')->findOneBy(['email','=', $email]);
                return [
                    'code' => 200,
                    'pharse' => encrypt_decrypt('encrypt', $data['uuid']),
                    'token' => encode_auth_token([
                        'uuid' => $data['uuid'],
                        'databaseName' => md5($email),
                        'fullname' => $data['fullname'],
                        'email' => $data['email']
                    ]),
                    'apikey' => $api['key']
                ];
            } else {
                return [
                    'code' => 401,
                    'token' => null,
                ];
            }
        } else {
            return [
                'code' => 404,
                'token' => null
            ];
        }
    }
}
