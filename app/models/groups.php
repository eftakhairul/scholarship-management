<?php

/**
 * Description of Group Model
 *
 * @author      Eftakhairul Islam <eftakhairul@gmail.com>
 */

class Groups extends MY_Model
{
    protected $statuses;
    public function  __construct ()
    {
        parent::__construct();
        $this->loadTable('groups', 'group_id');
    }

    public function save(array $data)
    {
        if(empty($data)) {
            return false;
        }
        
        return $this->insert($data);
    }

    public function getAll($offset = 0)
    {
        $limit = $this->config->item('rowsPerPage');
        $this->db->select();
        $this->db->from($this->table);
        $this->db->limit($limit, $offset);

        return $this->db->get()->result_array();
    }

    public function countAllUsers()
    {
        return $this->db->count_all("{$this->table}");
    }

    public function delete($id)
    {
        if (empty($id)) {
            return false;
        }

        return $this->remove($id);
    }

    public function update($data, $id)
    {
        if (empty($data) OR empty($id) ) {
            return false;
        }

        return parent::update($data, $id);
    }

    public function getAllById($id)
    {
        if (empty($id)) {
            return false;
        }

        return $this->findBy('group_id',$id);
    }

    public function getPrintTitle($id)
    {
        $data = array('group_id' => $id);
        $result =  $this->find($data,'print_title');
        return $result['print_title'];
    }
}
