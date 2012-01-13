<?php
/**
 * Description of Departments Controller
 *
 * @package     Controller
 * @author      Eftakhairul Islam <eftakhairul@gmail.com>
 * @website     http://eftakhairul.com
 * @copyright   Copyright (c) 2011 Eftakhairul Islam
 */

include_once APPPATH . "controllers/BaseController.php";
class DepartmentController extends BaseController
{
    private $userId;

    public function __construct()
	{
		parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('departments');
    }

    public function index()
    {
        $this->data['departments'] = $this->departments->getAll();
        $this->layout->view('department/index', $this->data);
    }

    public function add()
    {
        $this->form_validation->setRulesForAddDepartment();

        if (!empty ($_POST)) {

            if ($this->form_validation->run()) {
                if($result = $this->departments->save($_POST)) {
                    $this->redirectForSuccess('department', 'Department is added successful');
                } else {
                    $this->redirectForSuccess('department/add', 'Data is not saved');
                }
            } else {
                $this->data['error'] = 'Enter required information.';
            }
        }

        $this->layout->view('department/add', $this->data);
    }

    public function edit($Id)
    {
        $this->form_validation->setRulesForAddDepartment();

        if (!empty ($_POST)) {

            if ($this->form_validation->run()) {

                if ($result  = $this->departments->update($_POST, $Id)) {
                     $this->redirectForSuccess('department', 'Department has been updated successfully');
                } else {
                    $this->data['error'] = 'Data is not save';
                }


            } else {
                $this->data['error'] = 'Enter required information.';
                $this->data['department'] = $_POST;
            }

        } else {
           $this->data['department'] = $this->departments->getAllByDepartmentId($Id);
        }

        $this->layout->view('department/edit', $this->data);
    }

    public function delete()
    {
        $data = $this->uri->uri_to_assoc();

        if (empty ($data['id'])) {
            $this->redirectForFailure('department', 'Department is not found');
        } else {
            $this->departments->delete($data['id']);
            $this->redirectForSuccess('department', 'Department is deleted successfully');
        }
    }

}