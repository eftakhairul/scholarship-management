<?php

/**
 * Description of Group Controller
 *
 * @package     Controller
 * @author      Eftakhairul Islam <eftakhairul@gmail.com>
 */

include_once APPPATH . "controllers/BaseController.php";
class GroupController extends BaseController
{
    public function  __construct ()
    {
        parent::__construct();
        $this->_ensureLoggedIn();

        $this->load->library('pagination');
        $this->load->model('groups');
        $this->data['userType'] = $this->session->userdata('userType');
    }

    public function index()
    {
        $this->_checkAdmin();

        $url = site_url('group');
        $this->_processPagination($url);

        $this->layout->view('group/index', $this->data);
    }

    private function _processPagination($url)
    {
        $this->load->library('pagination');

        $uriAssoc = $this->uri->uri_to_assoc();
        $page = empty ($uriAssoc['page']) ? 0 : $uriAssoc['page'];
        $this->data['groups'] = $this->groups->getAll($page);

        $paginationOptions = array(
            'baseUrl' => $url . '/page/',
            'segmentValue' => $this->uri->getSegmentIndex('page') + 1,
            'numRows' => $this->groups->countAllGroups()
        );

        $this->pagination->setOptions($paginationOptions);
    }

    public function addGroup()
    {
        $this->load->library('form_validation');
        $this->form_validation->setRulesForAddGroup();

        if (!empty ($_POST)) {

            if ($this->form_validation->run()) {

                $this->groups->save($_POST);
                $this->_redirectForSuccess('group',
                       'The group has been created successfully.');

            } else {
                $this->data['errorMessage'] = 'Please correct the following errors.';
            }
        }

        $this->layout->view('group/add-group');
    }

    public function editGroup($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->setRulesForAddGroup();

        if (!empty ($_POST)) {

            if ($this->form_validation->run()) {

                if ($this->groups->update($_POST, $id)) {
                     $this->_redirectForSuccess('Group', 'Group has been updated successfully');
                } else {
                    $this->data['error'] = 'Data is not save';
                }

            } else {
                $this->data['error'] = 'Enter required information.';
                $this->data['groups'] = $_POST;
            }

        } else {
            $this->data['groups'] = $this->groups->getAllById($id);
        }

        $this->layout->view('group/edit-group', $this->data);
    }

    public function deleteGroup()
    {
        if (!$this->_checkAdmin()) {
            return;
        }

        $data = $this->uri->uri_to_assoc();

        if (empty ($data['id'])) {
            $this->_redirectForFailure('group', 'User id is not found.');
        } else {
            $this->groups->remove($data['id']);
            $this->_redirectForSuccess('group', 'Deletion is successful.');
        }
    }


    protected function _checkAdmin()
    {
        if ($this->session->userdata('userType') != SUPER_ADMIN) {

            $this->_redirectForFailure('user/manageUser',
                'You are not authorized for this section.'
            );

            return false;
        }

        return true;
    }
}
