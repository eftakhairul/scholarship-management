<?php

/**
 * Description of User Controller
 *
 * @package     Controller
 * @author      Syed Abidur Rahman <aabid048@gmail.com>
 * @author      Eftakhairul Islam <eftakhairul@gmail.com>
 */

include_once APPPATH . "controllers/BaseController.php";

class UserController extends BaseController
{
    public function  __construct ()
    {
        parent::__construct();
        $this->load->model('users');
        $this->data['userType'] = $this->session->userdata('userType');
    }

    public function index()
    {
        if ($this->session->userdata('userType')) {
            redirect('user/manageUser');
        }

        $this->load->library('form_validation');
        $this->form_validation->setRulesForSignIn();

        if (!empty ($_POST)) {

            if ($this->form_validation->run()) {
                
                $result = $this->users->validateUser($_POST);
                if ($result) {

                    $this->session->set_userdata('username', $result['username']);
                    $this->session->set_userdata('userType', $result['user_type_id']);
                    $this->session->set_userdata('groupType', $result['group_id']);
                    $this->session->set_userdata('user_id', $result['user_id']);
                    $this->_redirectForSuccess('schedule', 'You have successfully logged in.');

                } else {
                    $this->data['error'] = 'Enter correct Username & Password.';
                }
                
            } else {
                $this->data['error'] = 'Enter required information.';
            }
        }

        $this->load->view('users/index', $this->data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('user');
    }

    public function manageUser()
    {
        $this->_checkAdmin();

        $url = site_url('user/manageUser');
        $this->_processPagination($url);

        $this->layout->view('users/manage-user', $this->data);
    }

    private function _processPagination($url)
    {
        $this->load->library('pagination');

        $uriAssoc = $this->uri->uri_to_assoc();
        $page = empty ($uriAssoc['page']) ? 0 : $uriAssoc['page'];
        $this->data['users'] = $this->users->getAll($page);

        $paginationOptions = array(
            'baseUrl' => $url . '/page/',
            'segmentValue' => $this->uri->getSegmentIndex('page') + 1,
            'numRows' => $this->users->countAllUsers()
        );

        $this->pagination->setOptions($paginationOptions);
    }

    public function addUser()
    {
        $this->load->library('form_validation');
        $this->load->model('groups');
        $this->form_validation->setRulesForUserEntry();

        if (!empty ($_POST)) {

            if ($this->form_validation->run()) {

                $_POST['user_id'] = $this->users->save($_POST);
                $this->load->model('profiles');
                $this->profiles->save($_POST);
                $this->_redirectForSuccess('user/manageUser',
                       'The user information has been created successfully.');

            } else {
                $this->data['errorMessage'] = 'Please correct the following errors.';
            }
        }

        $this->data['types'] = $this->users->getUserTypes();
        $this->data['groups'] = $this->groups->getAll();

        $this->layout->view('users/add-user', $this->data);
    }

    public function editUser()
    {
        $this->load->library('form_validation');
        $this->load->model('groups');
        $this->form_validation->setRulesForUserEntry(array('isEdit' => true, 'userType' => $this->session->userdata('userType')));

        if (!empty ($_POST)) {

            if ($this->form_validation->run()) {

                $this->users->modify($_POST);
                $this->load->model('profiles');
                $this->profiles->modify($_POST);
                $this->_redirectForSuccess('user/manageUser',
                       'The user information has been updated successfully.');

            } else {
                $this->data['errorMessage'] = 'Please correct the following errors.';
                $this->data['user'] = $_POST;
            }
        } else {
            $data = $this->uri->uri_to_assoc();

            if (empty ($data['id'])) {
                $this->_redirectForFailure('user/manageUser', 'User id is not found.');
            } else {

                if(($this->session->userdata('userType') != SUPER_ADMIN) AND ($this->session->userdata('user_id') != $data['id'])) {
                    $this->_redirectForFailure('schedule', 'You do not have the permission.');
                }

                $this->data['user'] = $this->users->getDetail($data['id']);

                if (empty ($this->data['user'])) {
                    $this->_redirectForFailure('user/manageUser','User data is not found.');
                }
            }
        }

        $this->data['types'] = $this->users->getUserTypes();
        $this->data['groups'] = $this->groups->getAll();

        $this->layout->view('users/edit-user', $this->data);
    }

    public function deleteUser()
    {
        if (!$this->_checkAdmin()) {
            return;
        }

        $data = $this->uri->uri_to_assoc();

        if (empty ($data['id'])) {
            $this->_redirectForFailure('user', 'User id is not found.');
        } else {
            $this->users->remove($data['id']);
            $this->_redirectForSuccess('user', 'Deletion is successful.');
        }
    }

    public function username_check($username)
    {
        return !$this->users->checkUsernameExisted($username);
    }

    protected function _checkAdmin()
    {
        if ($this->session->userdata('userType') != SUPER_ADMIN) {

            $this->_redirectForFailure('schedule',
                'You are not authorized for this section.'
            );

            return false;
        }

        return true;
    }

    public function changePassword()
    {
        $this->load->library('form_validation');
        $this->form_validation->setRulesForChangePassword();

        if (!empty ($_POST)) {

            if ($this->form_validation->run()) {

                $this->users->modify($_POST);
                $this->_redirectForSuccess('schedule',
                       'The user information has been updated successfully.');

            } else {
                $this->data['errorMessage'] = 'Please correct the following errors.';
                $this->data['user'] = $_POST;
            }
        } else {
            $data = $this->uri->uri_to_assoc();

            if (empty ($data['id'])) {
                $this->_redirectForFailure('user/manageUser', 'User id is not found.');
            } else {

                if(($this->session->userdata('userType') != SUPER_ADMIN) AND ($this->session->userdata('user_id') != $data['id'])) {
                    $this->_redirectForFailure('schedule', 'You do not have the permission.');
                }

                $this->data['user'] = array('user_id' => $data['id']);
            }

        }        

        $this->layout->view('users/change-password', $this->data);
        
    }
}
