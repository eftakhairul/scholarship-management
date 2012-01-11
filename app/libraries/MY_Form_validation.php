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

    public function setRulesForCreateUser()
    {
        $config = array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|alpha_numeric|callback_username_check'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|min_length[6]'
            ),
            array(
                'field' => 'confirmedPassword',
                'label' => 'Confirmed Password',
                'rules' => 'required|matches[password]'
            )
        );

        $this->set_rules($config);
    }

    public function setRulesForCreateEmployer()
    {
        $config = array(
            array(
                'field' => 'doctor_name',
                'label' => 'Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'designation',
                'label' => 'Designations',
                'rules' => 'required'
            ),
            array(
                'field' => 'email',
                'label' => 'Email address',
                'rules' => 'valid_email|required'
            ),
            array(
                'field' => 'address',
                'label' => 'Address',
                'rules' => 'required'
            ),
            array(
                'field' => 'contact_number',
                'label' => 'Contact number',
                'rules' => 'required'
            )
        );

        $this->set_rules($config);
    }

    public function setRulesForCreateApplicant()
    {
        $config = array(
           array(
                'field' => 'name',
                'label' => 'Full Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'email',
                'label' => 'Email address',
                'rules' => 'valid_email|required'
            ),
            array(
                'field' => 'address',
                'label' => 'Address',
                'rules' => 'required'
            ),
            array(
                'field' => 'contact_no',
                'label' => 'Contact number',
                'rules' => 'required'
            )
        );

        $this->set_rules($config);
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

    public function setRulesForCreateJobs()
    {
        $config = array(
            array(
                'field' => 'types',
                'label' => 'Job types',
                'rules' => 'required'
            ),
            array(
                'field' => 'title',
                'label' => 'Title',
                'rules' => 'required'
            ),
            array(
                'field' => 'description',
                'label' => 'Description',
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
}