<?php

/**
 * Description of Scholarships
 *
 * @package     Model
 * @author      Eftakhairul Islam <eftakhairul@gmail.com>
 * @website     http://eftakhairul.com
 * @copyright   Copyright (c) 2011 Eftakhairul Islam
 */
class Scholarships extends MY_Model
{
    public function  __construct ()
    {
        parent::__construct();
        $this->loadTable('scholarships', 'scholarship_id');
    }

    public function save(array $data)
    {
        if (empty($data)) {
            return false;
        }

        $params = array(
            'year'        => $data['year'],
            'semester_id' => $data['semester_id'],
            'semester_id' => $data['semester_id']
        );

        $scholarship = $this->getAllByParams($params);

        if (empty($scholarship)) {
            $data['create_date'] = date('Y-m-d');
            return $this->insert($data);
        } else {
            return $this->modify($data, $scholarship['scholarship_id']);
        }
    }

    public function countAll()
    {
        return $this->db->count_all("{$this->table}");
    }

    public function getAll($offset = 0)
    {
        $limit = $this->config->item('rowsPerPage');

        return $this->findAll(null, '*', null, $offset, $limit);
    }

    public function getAllByParams(array $params)
    {
        if(empty($params)) {
            return false;
        }

        return $this->find($params);
    }

    public function modify(array $data, $scholarshipId = null)
    {
        if(empty($data) OR empty($scholarshipId)){
            return false;
        }

        return $this->update($data, $scholarshipId);
    }

    public function delete($scholarshipId = null)
    {
        if(empty ($scholarshipId)) {
            return false;
        }

        $this->remove($scholarshipId);
        return true;
    }
}