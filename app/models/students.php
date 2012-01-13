<?php

/**
 * Description of Students
 *
 * @package     Model
 * @author      Eftakhairul Islam <eftakhairul@gmail.com>
 * @website     http://eftakhairul.com
 * @copyright   Copyright (c) 2011 Eftakhairul Islam
 */

class Students extends MY_Model
{
    public function  __construct ()
    {
        parent::__construct();
        $this->loadTable('Students', 'student_id');
    }

    public function save(array $data)
    {
        if(empty($data)) {
            return false;
        }

        $student = $this->getAllByVarsityStudentId($data['varsity_student_id']);

        if(empty($student)) {
            $data['create_date'] = date('Y-m-d');
            return $this->insert($data);
        } else {
            return $this->modify($data, $student['student_id']);
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

    public function getAllByVarsityStudentId($varsityStudentId = null)
    {
        if(empty($varsityStudentId)) {
            return false;
        }

        return $this->find("{$this->table}.varsity_student_id = {$varsityStudentId}");
    }

    public function getAllByStudentId($studentId = null)
    {
        if(empty($studentId)) {
            return false;
        }

        return $this->find("{$this->table}.{$this->primaryKey} = {$studentId}");
    }

    public function modify(array $data, $studentId = null)
    {
        if(empty($data) OR empty($studentId)){
            return false;
        }

        return $this->update($data, $studentId);
    }

    public function delete($studentId = null)
    {
        if(empty ($studentId)) {
            return false;
        }

        $this->remove($studentId);
        return true;
    }

    private function calculateScholarShip()
    {

    }

    public function getDetailsFromStudentId($studentId)
    {
        $student = array(
            'enroll_year'  => substr($studentId,0,2),
            'semester_id'  => substr($studentId,2,1),
            'program_code' => substr($studentId,3,2),
            'student_id'   => substr($studentId,5,3)
        );

        return $student;
    }
}