<?php

/**
 * Profiles of Users
 *
 * @package     Model
 * @author      Eftakhairul Islam <eftakhairul@gmail.com> (http://eftakhairul.com)
 */

class Proofiles extends MY_Model
{
    public function  __construct()
    {
        parent::__construct();
        $this->loadTable('profiles', 'user_id');
    }

    public function save(array $data)
    {
        if (empty($data)) {
            return false;
        }

        $data['create_date'] = date('Y-m-d');

        return $this->insert($data);
    }

    public function getDetailsByUserId($userId = null)
    {
        if (empty($userId)) {
            return false;
        }

        return $this->find("{$this->table}.user_id = {$userId}");
    }

    public function modify(array $data, $userId = null)
    {
        if (empty($data) OR empty($userId)) {
            return false;
        }

        return $this->update($data, $userId);
    }
}