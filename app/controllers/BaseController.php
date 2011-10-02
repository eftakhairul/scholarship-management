<?php

/**
 * Base Controller
 *
 * Common tasks of all controllers are done here. Only inherit, no direct use please.
 *
 * @package     Base
 * @category    Controller
 * @author      Raju Mazumder <rajuniit@gmail.com>
 */

include_once APPPATH . "libraries/DateHelper.php";
include_once APPPATH . "libraries/DbHelper.php";
include_once APPPATH . "libraries/RefactorHelper.php";

abstract class BaseController extends Controller
{
    protected $data = array();

    public function __construct()
    {
        parent::__construct();
        
        $this->_prepareEnvironment();
        $this->_populateFlashData();
    }
    
    protected function _prepareEnvironment()
    {
        $this->load->library('Layout');
        parse_str($_SERVER['QUERY_STRING'], $_GET);
    }

    protected function _populateFlashData()
    {
        $notify['message'] = $this->session->flashdata('message');
        $notify['messageType'] = $this->session->flashdata('messageType');

        $this->data['notification'] = $notify;
    }

    protected function _ensureLoggedIn()
    {
        if (!$this->session->userdata('username')) {
            redirect('user');
        }
    }

    protected function _redirectForSuccess($redirectLink, $message)
    {
        $this->session->set_flashdata('message', $message);
        $this->session->set_flashdata('messageType', 'success');
        redirect($redirectLink);
    }

    protected function _redirectForFailure($redirectLink, $message)
    {
        $this->session->set_flashdata('message', $message);
        $this->session->set_flashdata('messageType', 'errormsg');
        redirect($redirectLink);
    }
}
