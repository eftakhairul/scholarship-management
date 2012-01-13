<?php
/**
 * Description of Tuition Controller
 *
 * @package     Controller
 * @author      Eftakhairul Islam <eftakhairul@gmail.com>
 * @website     http://eftakhairul.com
 * @copyright   Copyright (c) 2011 Eftakhairul Islam
 */

include_once APPPATH . "controllers/BaseController.php";
class TuitionController extends BaseController
{
    public function __construct()
	{
		parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('tuitions');
    }

    public function index()
    {
        $this->data['tuitions'] = $this->tuitions->getAll();
        $this->layout->view('tuition/index', $this->data);
    }

    public function add()
	{
        $this->form_validation->setRulesForAddTuition();
        $this->load->model('departments');

        if (!empty ($_POST)) {

            if ($this->form_validation->run()) {

                if($result = $this->tuitions->save($_POST)) {

                    $this->redirectForSuccess('tuition', 'Tuition Fees is added successfully');
                    } else {
                    $this->redirectForSuccess('tuition/add', 'Data is not saved');
                    }
                } else {
                    $this->data['error'] = 'Enter required information.';
                }
            }

        $this->data['departments']  = $this->departments->getAll();
        $this->layout->view('tuition/add', $this->data);
	}

    public function edit($Id)
    {
        $this->form_validation->setRulesForAddTuition();
        $this->load->model('departments');

        if (!empty ($_POST)) {

            if ($this->form_validation->run()) {

                if ($result  = $this->tuitions->update($_POST, $Id)) {
                     $this->redirectForSuccess('tuition', 'Tuition fees have been updated successfully');
                } else {
                    $this->data['error'] = 'Data is not save';
                }

            } else {
                $this->data['error'] = 'Enter required information.';
                $this->data['tuition'] = $_POST;
            }

        } else {
           $this->data['tuition'] = $this->tuitions->getAllByTuitionId($Id);
        }

        $this->data['departments']  = $this->departments->getAll();
        $this->layout->view('tuition/edit', $this->data);
    }

    public function delete()
    {
        $data = $this->uri->uri_to_assoc();

        if (empty ($data['id'])) {
            $this->redirectForFailure('tuition', 'Tuition fees is not found');
        } else {
            $this->tuitions->delete($data['id']);
            $this->redirectForSuccess('tuition', 'Tuition fees is deleted successfully');
        }
    }
}