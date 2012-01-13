<?php

/**
 * Description of Tuitions
 *
 * @package     Model
 * @author      Eftakhairul Islam <eftakhairul@gmail.com> http://eftakhairul.com
 */

class Tuitions extends MY_Model
{
    public function  __construct ()
    {
        parent::__construct();
        $this->loadTable('tuitions', 'tuition_id');
    }

    public function getAllByParam(array $param)
    {
        if(empty($param)) return false;

        return $this->find($param);
    }


    public function save(array $data)
    {
        if(empty($data)) {
            return false;
        }

        $data['create_date'] = date('Y-m-d');
        
        return $this->insert($data);
    }
    
    public function update($data, $Id) 
    {
        if(empty ($data) OR empty($Id)) return false;
       
        return parent::update($data, $Id);
    }

    public function getAll()
    {
        $this->db->select("*");
        $this->db->from($this->table);

        return $this->db->get()->result_array();
    }

    public function getAllByTuitionId($id)
    {
        if(empty($id)) {
            return false;
        }

        return $this->find("{$this->table}.tuition_id = '{$id}'");
    }

    public function delete($id)
    {
        if(empty ($id)) {
            return false;
        }

        $this->remove($id);
        return true;
    }
}
