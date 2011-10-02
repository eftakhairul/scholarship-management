<?php

/**
 * Description of Users
 *
 * @author Syed Abidur Rahman <aabid048@gmail.com>
 */

class Users extends MY_Model
{
    public function  __construct ()
    {
        parent::__construct();
        $this->loadTable('users', 'user_id');
    }

    public function getAll($offset = 0)
    {
        $limit = $this->config->item('rowsPerPage');
        $this->db->select();
        $this->db->from($this->table);
        $this->db->join('profiles', "profiles.{$this->primaryKey}={$this->table}.{$this->primaryKey}");
        $this->db->join('user_types', "user_types.user_type_id={$this->table}.user_type_id");
        $this->db->limit($limit, $offset);

        return $this->db->get()->result_array();
    }

    public function countAllUsers()
    {
        return $this->db->count_all("{$this->table}");
    }

    public function getDetail($userId)
    {
        $this->db->select();
        $this->db->from($this->table);
        $this->db->join('profiles', "profiles.{$this->primaryKey}={$this->table}.{$this->primaryKey}");
        $this->db->join('user_types', "user_types.user_type_id={$this->table}.user_type_id");
        $this->db->where("{$this->table}.{$this->primaryKey}", $userId);

        return $this->db->get()->row_array();
    }

    public function validateUser($data)
    {
        if (!empty ($data['password'])) {
            $data['password'] = md5($data['password']);
        }

        return $this->find($data, 'username, user_type_id, group_id, user_id');
    }

    public function checkUsernameExisted($username)
    {
        $result = $this->find(array('username' => $username), $this->primaryKey);
        return !empty($result);
    }

    public function save(array $data)
    {
       if (!empty ($data['password'])) {
            $data['password'] = md5($data['password']);
        }
        
        $data['created_date'] = date('Y-m-d');
        return $this->insert($data);
    }

    public function modify(array $data)
    {
        if (!empty ($data['password'])) {
            $data['password'] = md5($data['password']);
        }

        return $this->update($data, $data['user_id']);
    }

    public function getUserTypes()
    {
        $this->db->select('*');
        $this->db->from('user_types');
        return $this->db->get()->result_array();
    }
}