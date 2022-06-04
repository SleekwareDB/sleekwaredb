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
            'filtered' => $this->collection_filtered('users')
        ];
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

    public function all()
    {
        $user = $this->collection('users')->findAll(["_id" => "desc"]);
        return $user;
    }

    public function authenticate($username, $email)
    {
        $user = $this->store('users');
        $data = $user->findOneBy([
            ['username', '=', $username],
            ['email', '=', $email],
        ]);
        return $data;
    }

    public function generateMagicKey(int $id, array $data)
    {
        $query = $this->store('users');
        $user = $query->findById($id);
        foreach ($data as $key => $value) {
            $user[$key] = $value;
        }
        return $query->update($user);
    }

    public function validateMagicKey(string $key)
    {
        $query = $this->store('users');
        $user = $query->findOneBy(['uniqueMagicToken', '=', $key]);
        if (!empty($user)) {
            $user['uniqueMagicToken'] = null;
            return $query->update($user);
        } else {
            return false;
        }
    }

    public function getApiKey($email)
    {
        $user = $this->collection('rest_keys');
        $data = $user->findOneBy(['email', '=', $email]);
        return $data['key'];
    }
}
