<?php

/**
 * Description of Departments
 *
 * @package     Model
 * @author      Eftakhairul Islam <eftakhairul@gmail.com> (http://eftakhairul.com)
 */

class Departments extends MY_Model
{
    public function  __construct ()
    {
        parent::__construct();
        $this->loadTable('departments', 'department_name');
    }


    public function save(array $data)
    {
        if(empty($data)) {
            return false;
        }

        $this->insert($data);
        return true;
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

    public function getAllByDepartmentId($id)
    {
        return $this->find("{$this->table}.department_name = '{$id}'");
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
