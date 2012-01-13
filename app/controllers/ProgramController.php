<?php
/**
 * Description of Program Controller
 *
 * @package     Controller
 * @author      Eftakhairul Islam <eftakhairul@gmail.com>
 * @website     http://eftakhairul.com
 * @copyright   Copyright (c) 2011 Eftakhairul Islam
 */

include_once APPPATH . "controllers/BaseController.php";
class ProgramController extends BaseController
{
    private $userId;

    public function __construct()
	{
		parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('programs');
    }

    public function index()
    {
        $this->data['programs'] = $this->programs->getAll();
        $this->layout->view('program/index', $this->data);
    }

    public function add()
	{
        $this->form_validation->setRulesForAddProgram();
        $this->load->model('departments');

        if (!empty ($_POST)) {

            if ($this->form_validation->run()) {

                if($result = $this->programs->save($_POST)) {

                    $this->redirectForSuccess('program', 'Program is created successfully');
                    } else {
                    $this->redirectForSuccess('program/add', 'Data is not saved');
                    }
                } else {
                    $this->data['error'] = 'Enter required information.';
                }
            }

        $this->data['departments']  = $this->departments->getAll();
        $this->layout->view('program/add', $this->data);
	}

    public function edit($Id)
    {
        $this->form_validation->setRulesForAddProgram();
        $this->load->model('departments');

        if (!empty ($_POST)) {

            if ($this->form_validation->run()) {

                if ($result  = $this->programs->update($_POST, $Id)) {
                     $this->redirectForSuccess('program', 'Program has been updated successfully');
                } else {
                    $this->data['error'] = 'Data is not save';
                }


            } else {
                $this->data['error'] = 'Enter required information.';
                $this->data['program'] = $_POST;
            }

        } else {
           $this->data['program'] = $this->programs->getAllByProgramId($Id);
        }

        $this->data['departments']  = $this->departments->getAll();
        $this->layout->view('program/edit', $this->data);
    }

    public function delete()
    {
        $data = $this->uri->uri_to_assoc();

        if (empty ($data['id'])) {
            $this->redirectForFailure('program', 'Program is not found');
        } else {
            $this->programs->delete($data['id']);
            $this->redirectForSuccess('program', 'Program is deleted successfully');
        }
    }
}