<?php
/**
 * Description of Validation Rules Library
 *
 * @package     Library
 * @author      Eftakhairul Islam <eftakhairul@gmail.com> http://eftakhairul.com
 * @website     http://eftakhairul.com
 */

class MY_Form_validation extends CI_Form_validation
{
    public function  __construct ()
    {
        parent::__construct();
        $this->set_error_delimiters('','');        
    }

    public function setRulesForSignIn()
    {
        $config = array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|alpha'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required'
            )
        );

        $this->set_rules($config);
    }
    
    public function setRulesForChangePassword()
    {
        $config = array(
            array(
                    'field' => 'previous_password',
                    'label' => 'previous password',
                    'rules' => 'required|callback_previouspassword_check'
            ),
            array(
                    'field' => 'password',
                    'label' => 'new password',
                    'rules' => 'required|min_length[6]'
            ),
            array(
                'field' => 'confirmedPassword',
                'label' => 'confirmed password',
                'rules' => 'required|matches[password]'
            )
        );

        $this->set_rules($config);
    }

    public function setRulesForAddProgram()
    {
        $config = array(
            array(
                    'field' => 'name',
                    'label' => 'Program name',
                    'rules' => 'required'
            ),
            array(
                    'field' => 'code',
                    'label' => 'Program Code',
                    'rules' => 'required|min_length[2]'
            ),
            array(
                'field' => 'department_name',
                'label' => 'Department',
                'rules' => 'required'
            )
        );

        $this->set_rules($config);
    }

    public function setRulesForAddDepartment()
    {
        $config = array(
            array(
                    'field' => 'department_name',
                    'label' => 'Department short name',
                    'rules' => 'required'
            )
        );

        $this->set_rules($config);
    }

    public function setRulesForAddScholarship()
    {
        $config = array(
             array(
                    'field' => 'semester_id',
                    'label' => 'Semester',
                    'rules' => 'required'
            ),
            array(
                    'field' => 'name',
                    'label' => 'Student Name',
                    'rules' => 'required'
            ),
            array(
                    'field' => 'varsity_student_id',
                    'label' => 'Student Id',
                    'rules' => 'required'
            ),
            array(
                'field' => 'last_semester_credit',
                'label' => 'Last semester credits',
                'rules' => 'required'
            ),
            array(
                    'field' => 'current_semester_credit',
                    'label' => 'Current semester credits',
                    'rules' => 'required'
            ),
            array(
                    'field' => 'arch_lecture_credit',
                    'label' => 'Arch. lecture credits',
                    'rules' => 'required'
            ),
            array(
                'field' => 'arch_studio_credit',
                'label' => 'Arch. studio credits',
                'rules' => 'required'
            ),
            array(
                    'field' => 'credit_requirement',
                    'label' => 'Credits requirement for the degree',
                    'rules' => 'required'
            ),
            array(
                    'field' => 'credit_completed',
                    'label' => 'Credits completed to date',
                    'rules' => 'required'
            ),
            array(
                'field' => 'gpa',
                'label' => 'GPA',
                'rules' => 'required'
            ),
            array(
                    'field' => 'cgpa',
                    'label' => 'CGPA',
                    'rules' => 'required'
            )
        );

        $this->set_rules($config);
    }

    public function setRulesForAddTuition()
    {
        $config = array(
            array(
                'field' => 'department_name',
                'label' => 'Department',
                'rules' => 'required'
            ),
             array(
                    'field' => 'semester_id',
                    'label' => 'Semester',
                    'rules' => 'required'
            ),
            array(
                    'field' => 'year',
                    'label' => 'Year',
                    'rules' => 'required'
            ),
            array(
                'field' => 'credit_fees',
                'label' => 'Credit fees',
                'rules' => 'required'
            )
        );

        $this->set_rules($config);
    }
}