<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends Sleekwaredb_model
{
    public function __construct()
    {
        parent::__construct();
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
        $user = $this->coreUserCollection();
        $data = $user->findOneBy(['email', '=', $email]);
        if ( !empty($data) ) {
            if ( password_verify($password, $data['password']) ) {
                $this->session->set_userdata([
                    '_id' => $data['_id'],
                    'databaseName' => md5($email),
                    'fullname' => $data['fullname']
                ]);
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
        $user = $this->coreUSerCollection();
        return $user->insert($data);
    }
}
