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

        $userId =  $this->insert($data);

        $profiles = array(
            'user_id'       =>  $userId,
            'name'           => $data['name'],
            'email'          => $data['email'],
            'contact_number' => $data['contact_number']
        );

        $CI->profiles->save($profiles);
        return $userId;
    }

    public function validateUser(array $data)
    {
        $data = $this->removeNonAttributeFields($data);
        $data['password'] = md5($data['password']);
        return $this->find($data, 'username, user_id, types');
    }

    public function getAll($offset = 0)
    {
        $limit = $this->config->item('rowsPerPage');

        return $this->findAll(null, '*', null, $offset, $limit);
    }

    public function countAll()
    {
        return $this->db->count_all("{$this->table}");
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

    public function modify(array $data, $userId = null)
    {
        if (empty($data) OR empty($userId)) {
            return false;
        }

        if (!empty($data['password'])) {
            $data['password'] = md5($data['password']);
        }

        return $this->update($data, $userId);
    }
}