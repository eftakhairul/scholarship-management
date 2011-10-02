<?php

class MY_Form_validation extends CI_Form_validation
{
    public function  __construct ()
    {
        parent::CI_Form_validation();
        $this->set_error_delimiters('','');        
    }

    public function setRulesForAddGroup()
    {
        $config = array(
            array(
                'field' => 'associated_name',
                'label' => 'the associated group name',
                'rules' => 'required'
            ),
            array(
                'field' => 'print_title',
                'label' => 'the title for printing',
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
                'rules' => 'required|min_length[6]'
            )
        );

        $this->set_rules($config);
    }

    public function setRulesForUserEntry($options = array())
    {
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Staff Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'email_address',
                'label' => 'Email address',
                'rules' => 'valid_email'
            ),
            array(
                'field' => 'group_id',
                'label' => 'Associated Group',
                'rules' => 'required'
            ),
            array(
                'field' => 'user_type_id',
                'label' => 'User Type',
                'rules' => 'required'
            ));

        if (empty ($options['isEdit'])) {
            $config = array_merge($config, array(
                array(
                    'field' => 'username',
                    'label' => 'Username',
                    'rules' => 'required|alpha_numeric|callback_username_check'
                ))
            );
        }

        if ( empty ($options['isEdit']) ) {
            $config = array_merge($config, array(
                array(
                    'field' => 'password',
                    'label' => 'Password',
                    'rules' => 'required|min_length[6]'
                ),
                array(
                    'field' => 'confirmedPassword',
                    'label' => 'Confirmed Password',
                    'rules' => 'required|matches[password]'
                ))
            );
        }

        $this->set_rules($config);
    }
    
    public function setRulesForCreateSchedule()
    {
        $config = array(
            array(
                'field' => 'date',
                'label' => 'Date',
                'rules' => 'required'
            ),
            array(
                'field' => 'time',
                'label' => 'Time',
                'rules' => 'required'
            ),
            array(
                'field' => 'venue',
                'label' => 'Venue',
                'rules' => 'required'
            ),
            array(
                'field' => 'title',
                'label' => 'Event',
                'rules' => 'required'
            ),
            array(
                'field' => 'grace_status_id',
                'label' => 'This field',
                'rules' => 'required'
            )
        );

        $this->set_rules($config);
    }

    public function setRulesForChangePassword()
    {
        $config = array(
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
    
}