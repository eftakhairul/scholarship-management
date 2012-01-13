<?php

/**
 * Description of Programs
 *
 * @package     Model
 * @author      Eftakhairul Islam <eftakhairul@gmail.com> http://eftakhairul.com
 */

class Programs extends MY_Model
{
    public function  __construct ()
    {
        parent::__construct();
        $this->loadTable('programs', 'program_id');
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

    public function getAllByProgramId($id)
    {
        if(empty($id)) {
            return false;
        }

        return $this->find("{$this->table}.program_id = '{$id}'");
    }

    public function getDepartmentByProgramCode($code)
    {
        if(empty($code)) return false;

        return $this->find("{$this->table}.code = '{$code}'");
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
