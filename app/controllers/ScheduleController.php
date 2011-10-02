<?php

/**
 * Description of Schedule Controller
 *
 * @package     Controller
 * @author      Eftakhairul <eftakhairul@gmail.com>
 * @author      Syed Abidur Rahman <aabid048@gmail.com>
 */

include_once APPPATH . "controllers/BaseController.php";
class ScheduleController extends BaseController
{
    public function  __construct ()
    {
        parent::__construct();
        $this->_ensureLoggedIn();

        $this->load->library('pagination');
        $this->load->model('schedules');
        $this->data['userType'] = $this->session->userdata('userType');
    }
    
    public function index()
    {
        $this->load->model('groups');
        $uriAssoc = $this->uri->uri_to_assoc();
        $uriAssoc = array_merge($uriAssoc, array(
                        'url' => site_url('schedule/index'),
                        'status' => 'due'
                   ));

        $this->_processPagination($uriAssoc);
        $this->data['flagForPrint'] = true;
        $this->data['groups'] = $this->groups->getAll();

        $this->layout->view('schedule/index', $this->data);
    }

    public function printSchedule() 
    {
        $this->load->model('groups');
        $options['group_id'] = $this->session->userdata('groupType');
        

        $this->data['schedules'] = $this->schedules->getAllForPrint($options);

        $this->data['title'] = $this->groups->getPrintTitle($this->session->userdata('groupType'));
        $this->load->view('schedule/print-schedule', $this->data);
    }

    public function viewSchedules()
    {
        $uriAssoc = $this->uri->uri_to_assoc();
        $uriAssoc = array_merge($uriAssoc, array(
                        'url' => site_url('schedule/viewSchedules'),
                        'isPast' => true
                   ));
        $this->_processPagination($uriAssoc);

        $this->layout->view('schedule/index', $this->data);
    }

    private function _processPagination($options)
    {
        $this->load->library('pagination');

        $options['page'] = empty ($options['page']) ? 0 : $options['page'];

        if($this->session->userdata('userType') != SUPER_ADMIN) {
            $options['group_id'] = $this->session->userdata('groupType');
        }
        $this->data['schedules'] = $this->schedules->getAll($options);

        $paginationOptions = array(
            'baseUrl' => $options['url'] . (empty ($options['status']) ? '' : '/status/'.$options['status']). '/page/',
            'segmentValue' => $this->uri->getSegmentIndex('page') + 1,
            'numRows' => $this->schedules->countAllSchedules($options)
        );

        $this->pagination->setOptions($paginationOptions);
    }

    public function createSchedule()
    {
        $this->_checkAdmin();

        $this->load->model('statuses');
        $this->load->library('form_validation');
        $this->form_validation->setRulesForCreateSchedule();

        if (!empty ($_POST)) {
            
            if ($this->form_validation->run()) {

                $_POST['group_id'] = $this->session->userdata('groupType');
                if ($this->schedules->save($_POST)) {
                   
                     $this->_redirectForSuccess('schedule', 'Event has been created successfully');
                } else {
                    $this->data['error'] = 'Data is not saved.';
                }

            } else {
                $this->data['error'] = 'Enter required information.';
            }
        }

        $this->data['statuses'] = $this->statuses->getAll();
        $this->layout->view('schedule/create', $this->data);
    }

    public function edit($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->setRulesForCreateSchedule();

        $this->load->model('statuses');
        $this->data['statuses'] = $this->statuses->getAll();

        if (!empty ($_POST)) {

            if ($this->form_validation->run()) {

                $_POST['group_id'] = $this->session->userdata('groupType');
                if ($this->schedules->update($_POST, $id)) {
                     $this->_redirectForSuccess('schedule', 'Event has been updated successfully');
                } else {
                    $this->data['error'] = 'Data is not save';
                }

            } else {
                $this->data['error'] = 'Enter required information.';
                $this->data['schedules'] = $_POST;
            }

        } else {
            $this->data['schedules'] = $this->schedules->getAllById($id);
        }

        $this->layout->view('schedule/edit', $this->data);
    }

    public function deleteEvent()
    {
        if (!$this->_checkAdmin()) {
            return;
        }

        $data = $this->uri->uri_to_assoc();

        if (empty ($data['id'])) {
            $this->_redirectForFailure('schedule', 'Event is not found');
        } else {
            $status = array('status_id' => 3);
            $this->schedules->update($status, $data['id']);
            $this->_redirectForSuccess('schedule', 'Event is deleted successfully');
        }
    }

    public function viewEvent($id)
    {
        if(empty($id)) {
            $this->_redirectForFailure('schedule', 'Date is not found');
        }

        $this->data['schedule'] = $this->schedules->getDetailById($id);
        $this->layout->view('schedule/view-event', $this->data);
    }

    public function searchByGroup()
    {
        $this->load->model('groups');
        $uriAssoc = $this->uri->uri_to_assoc();
        $uriAssoc = array_merge($uriAssoc, array(
                        'url' => site_url('schedule/index'),
                        'status' => 'due'
                   ));
        if (!empty ($_POST)) {
             $uriAssoc['group_id'] = $_POST['group_id'];
         }

        $this->_processPagination($uriAssoc);
        $this->data['groups'] = $this->groups->getAll();

        $this->layout->view('schedule/searchbygroupname', $this->data);
        
    }

    public function pastSchedule()
    {
        $this->load->model('groups');
        $options['group_id'] = $this->session->userdata('groupType');

        if(!empty($_POST)) {
            $this->data['schedules'] = $this->schedules->pastschedule($options, $_POST);
        } else {
            $this->data['schedules'] = $this->schedules->pastschedule($options);
        }

        $this->layout->view('schedule/past-schedule', $this->data);
    }

    protected function _checkAdmin()
    {
        if ($this->session->userdata('userType') != SUPER_ADMIN AND $this->session->userdata('userType') != ADMIN) {
            $this->_redirectForFailure('schedule',
                'You are not authorized for this section.'
            );
            return false;
        }
        return true;
    }
}