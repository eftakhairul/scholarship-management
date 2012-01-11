<?php

/**
 * Base Controller
 *
 * Common tasks of all controllers are done here. Only inherit, no direct use please.
 *
 * @package     Base
 * @category    Controller
 */
include_once APPPATH . "libraries/DateHelper.php";
include_once APPPATH . "libraries/DbHelper.php";
include_once APPPATH . "libraries/RefactorHelper.php";
abstract class BaseController extends CI_Controller
{
	protected $data = array();

	public function __construct()
	{
		parent::__construct();

		$this->prepareEnvironment();
		$this->populateFlashData();
	}

	protected function prepareEnvironment()
	{
		$this->load->library('Layout');
		parse_str($_SERVER['QUERY_STRING'], $_GET);
	}

	protected function populateFlashData()
	{
		$notify['message'] = $this->session->flashdata('message');
		$notify['messageType'] = $this->session->flashdata('messageType');

		$this->data['notification'] = $notify;
	}

        protected function redirectForSuccess($redirectLink, $message)
        {
            $this->session->set_flashdata('message', $message);
            $this->session->set_flashdata('messageType', 'success');
            redirect($redirectLink);
        }

        protected function redirectForFailure($redirectLink, $message)
        {
            $this->session->set_flashdata('message', $message);
            $this->session->set_flashdata('messageType', 'errormsg');
            redirect($redirectLink);
        }

        public function username_check($username)
        {
            $this->load->model('users');
            if(!$this->users->checkUsernameExisted($username)){
                 return true;
             } else {
                 return false;
             }
        }

        protected function prepareLogin()
        {
            if (!$this->session->userdata('username')) {
                redirect('auth/login');
             }
        }

        protected function checkAdmin()
        {
            if ($this->session->userdata('userType') != ADMIN) {

                $this->_redirectForFailure('user/manageUser',
                    'You are not authorized for this section.'
                );

                return false;
            }

            return true;
        }
}