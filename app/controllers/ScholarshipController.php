<?php
/**
 * Description of Scholarship Controller
 *
 * @package     Controller
 * @author      Eftakhairul Islam <eftakhairul@gmail.com>
 * @website     http://eftakhairul.com
 * @copyright   Copyright (c) 2011 Eftakhairul Islam
 */

include_once APPPATH . "controllers/BaseController.php";
class ScholarshipController extends BaseController
{

    public function __construct()
	{
		parent::__construct();

        $this->load->library('form_validation');
        $this->load->library('students');
        $this->load->library('programs');
    }

    public function index()
    {
        $this->layout->view('user/index', $this->data);
    }

    public function add()
    {
        $this->form_validation->setRulesForAddScholarship();

        if (!empty ($_POST)) {

            if ($this->form_validation->run()) {


//
//                if($result = $this->users->save($_POST)) {
//                    $this->redirectForSuccess('auth/login', 'Registration is successful');
//                } else {
//                    $this->redirectForSuccess('user/registration', 'Data is not saved');
//                }
//            } else {
//                $this->data['error'] = 'Enter required information.';
            }

        }

        $this->layout->view('scholarship/add', $this->data);
    }

    private function checkLastSemesterCredit($data)
    {
        if($data['credit_requirement'] <= $data['credit_completed']) {
            $this->data['error'] = 'Credit reaches to Degree Completion .';
            return false;
        }

        $StudentIdDetails  = $this->getDetailsFromStudentId($data['varsity_student_id']);
        $programDeatils = $this->programs->getDepartmentByProgramCode($StudentIdDetails['program_code']);

        if( ($data['credit_requirement'] - $data['credit_completed']) < $data['last_semester_credit']) {
            return true;
        }

        if($data['last_semester_credit'] < $programDeatils['lowest_credits'])
        {
            $this->data['error'] = "Last Semester's credit is less";
            return false;
        }

        return true;
    }

    private function processPagination()
    {
        $this->load->library('pagination');
        $url = site_url('user/index');

        $uriAssoc = $this->uri->uri_to_assoc();
        $page = empty ($uriAssoc['page']) ? 0 : $uriAssoc['page'];
        $this->data['users'] = $this->users->getAll($page);

        $paginationOptions = array(
            'baseUrl' => $url . '/page/',
            'segmentValue' => $this->uri->getSegmentIndex('page') + 1,
            'numRows' => $this->users->countAll()
        );

        $this->pagination->setOptions($paginationOptions);
    }
}