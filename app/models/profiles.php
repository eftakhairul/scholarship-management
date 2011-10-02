<?php

/**
 * Description of Profiles
 *
 * @author Syed Abidur Rahman <aabid048@gmail.com>
 */

class Profiles extends MY_Model
{
    public function  __construct ()
    {
        parent::__construct();
        $this->loadTable('profiles', 'profile_id');
    }

    public function save(array $data)
    {
        $data['created_date'] = date('Y-m-d');
        return $this->insert($data);
    }

    public function modify(array $data)
    {
        $select = "UPDATE `{$this->table}`
                   SET `name` = {$this->db->escape($data['name'])},
                   `email_address` = {$this->db->escape($data['email_address'])}
                   WHERE `user_id` = {$this->db->escape($data['user_id'])}";

        $this->db->query($select);
    }
}