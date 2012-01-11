<?php 
/**
 * Description of Auth Controller
 *
 * @package     Controller
 * @author      Eftakhairul Islam <eftakhairul@gmail.com> http://eftakhairul.com
 */

include_once APPPATH . "controllers/BaseController.php";

class AuthController extends BaseController
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('users');
        $this->load->library('form_validation');
	}

	public function index()
	{
		$this->login();
	}

	public function login()
	{
        $this->form_validation->setRulesForSignIn();

        if (!empty ($_POST)) {

            if ($this->form_validation->run()) {

                $result = $this->users->validateUser($_POST);

                if ($result) {

                    $this->session->set_userdata('userName', $result['username']);
                    $this->session->set_userdata('user_id', $result['user_id']);
                    $this->session->set_userdata('user_type', $result['types']);

                    $this->redirectForSuccess('jobs', 'You have successfully logged in.');

                    if($result['types'] == APPLICANT) {
                        $this->redirectForSuccess('home/applicantDeashboard', 'You have successfully logged in.');
                    }

                    if($result['types'] == EMPLOYER) {
                        $this->redirectForSuccess('home/employerDeashboard', 'You have successfully logged in.');
                    }


                } else {
                    $this->data['error'] = 'Enter correct Username & Password.';
                }

            } else {
                $this->data['error'] = 'Enter required information.';
            }
        }

        $this->load->view('auth/index', $this->data);
	}

    public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth/login');
	}

    public function changePassword()
	{
        $this->form_validation->setRulesForChangePassword();

		if (!empty($_POST)) {

            if($this->form_validation->run()){
                $_POST['user_id'] = $this->session->userdata('user_id');
                $this->users->modify($_POST);
                $this->redirectForSuccess('home', 'Password is changed successfully.');
            } else {
                $this->data['error'] = 'Enter your password again.';
            }
		}

		$this->layout->view('auth/change-password');
	}


    public function previouspassword_check($previous_password)
    {
        if($this->users->previousPasswordExisted($previous_password)){
            return true;
        };

        return false;
    }

    public function email_check($email)
    {
        $check = $this->users->email_check($email);

        if ($check) {
            $this->form_validation->set_message('email_check', 'The email "' . $email . '" already exists.');
            return false;
        } else {
            return true;
        }
    }

	public function recoverPassword()
	{
	}
}