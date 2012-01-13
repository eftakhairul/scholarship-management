<?php

/**
 * Description of Users
 *
 * @package     Model
 * @author      Eftakhairul Islam <eftakhairul@gmail.com>
 * @website     http://eftakhairul.com
 * @copyright   Copyright (c) 2011 Eftakhairul Islam
 */

class Users extends MY_Model
{
    public function  __construct ()
    {
        parent::__construct();
        $this->loadTable('users', 'user_id');
    }

    public function save(array $data)
    {
        if(empty($data)) {
            return false;
        }

        $CI =& get_instance();
        $CI->load->model('profiles');

        $data['password']    = md5($data['password']);
        $data['create_date'] = date('Y-m-d');

        return $this->insert($data);
    }

    public function validateUser(array $data)
    {
        $data = $this->removeNonAttributeFields($data);
        $data['password'] = md5($data['password']);
        return $this->find($data, 'username, user_id, types');
    }

    public function checkUsernameExisted($username)
    {
        $result = $this->find(array('username' => $username), $this->primaryKey);
        return $result;
    }

    public function previousPasswordExisted($previous_password)
    {
        $previous_password = md5($previous_password);
        
        return $this->find(array('password' => $previous_password), $this->primaryKey);
    }

    public function modify(array $data)
    {
        if(!empty($data['password'])){
            $data['password'] = md5($data['password']);
        }

        return $this->update($data, $data['user_id']);
    }
}