<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends Sleekwaredb_model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * It returns the data for the datatables.
     *
     * @param string search The search string
     * @param integer limit The number of records to be returned
     * @param integer start The starting index of the result set.
     * @param string order_field The field to order by
     * @param string order_ascdesc ASC or DESC
     */
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

    /**
     * > If the data is an array, then update all the data in the array, otherwise update the data by
     * id
     *
     * @param array data The data to be updated.
     *
     * @return array|boolean The update function is returning the result of the updateOrInsertMany function.
     */
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

    /**
     * > This function returns all the users in the database
     *
     * @return array An array of all the users in the database.
     */
    public function all()
    {
        $user = $this->collection('users')->findAll(["_id" => "desc"]);
        return $user;
    }

    /**
     * > This function will return a user object if the username and email match
     *
     * @param string username The username of the user you want to authenticate.
     * @param string email The email address of the user.
     *
     * @return array The data is being returned.
     */
    public function authenticate($username, $email)
    {
        $user = $this->store('users');
        $data = $user->findOneBy([
            ['username', '=', $username],
            ['email', '=', $email],
        ]);
        return $data;
    }

    /**
     * > It takes an id and an array of data, finds the user with that id, updates the user with the
     * data, and returns the updated user
     *
     * @param int id The id of the user you want to update
     * @param array data The data to be stored in the database.
     *
     * @return array|boolean The updated user.
     */
    public function generateMagicKey(int $id, array $data)
    {
        $query = $this->store('users');
        $user = $query->findById($id);
        foreach ($data as $key => $value) {
            $user[$key] = $value;
        }
        return $query->update($user);
    }

    /**
     * > It takes a magic key, finds the user with that key, and then sets the key to null
     *
     * @param string key The magic key that was sent to the user's email address.
     *
     * @return array|boolean The user's uniqueMagicToken is being set to null.
     */
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

    /**
     * > Check if a user has a recovery code
     *
     * @param string username The username of the user
     * @param string email The email address of the user
     *
     * @return boolean A boolean value.
     */
    public function checkForRecoveryCode($username, $email)
    {
        $query = $this->store('users');
        $user = $query->findOneBy([
            ['username', '=', $username],
            ['email', '=', $email],
        ]);
        return (!empty($user['recoveryCode'])) ? true : false;
    }

    /**
     * It takes a username, email, and passPhrase and then updates the user's recoveryCode with the
     * passPhrase
     *
     * @param string username The username of the user you want to generate a recovery code for.
     * @param string email The email address of the user
     * @param string passPharse This is the password that the user will use to login.
     *
     * @return array|boolean The user's recovery code.
     */
    public function generateRecoveryCode($username, $email, $passPharse)
    {
        $query = $this->store('users');
        $user = $query->findOneBy([
            ['username', '=', $username],
            ['email', '=', $email],
        ]);
        if (!empty($user)) {
            $user['recoveryCode'] = $passPharse;
            return $query->updateOrInsert($user, false);
        } else {
            return null;
        }
    }

    /**
     * It takes an email address as a parameter, finds the user in the database, and returns the API
     * key
     *
     * @param string email The email address of the user you want to get the API key for.
     *
     * @return string The API key for the user with the email address provided.
     */
    public function getApiKey($email)
    {
        $user = $this->collection('rest_keys');
        $data = $user->findOneBy(['email', '=', $email]);
        return $data['key'];
    }
}
