<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
    
    public function __construct()
    {
        parent::__construct();
		$this->load->library('user_agent');
        // $this->load->helper('url');
        $this->load->model('MainModel','main');
    }
	public function index()
	{
		if(isset($_SESSION['username'])){
			redirect('main-view');
		}
		$this->load->view('LoginView');
	}
	public function authUser(){
		// var_dump($_POST);die;
		$data['result'] = 'Credentials not found';
		$data['code']   = 404;
		if(isset($_POST['email']) && isset($_POST['password'])){
			$check_user = $this->main->validateUser($_POST['email']);

			if($check_user){
				if(password_verify($_POST['password'], $check_user->Password)){
					$_SESSION['username'] = $check_user->Username;
					$_SESSION['role']     = $check_user->Role;
					$data['result'] = 'Login Success';
					$data['code']   = 200;
				}
				else{
					$data['result'] = 'Credentials error';
					$data['code']   = 404;
				}
			}
			else{
				$data['result'] = 'User not found';
				$data['code']   = 404;
			}
		}
		echo json_encode($data);
	}

	public function mainView(){
		if(!isset($_SESSION['username'])){
			redirect();
		}

		$data['all_tools'] = $this->main->getAllTools();
		$data['isMobile']  = $this->agent->is_mobile() ? TRUE : FALSE;
		$data['all_borrowed'] = $this->main->getAllBorrowedTools();
		// var_dump('<pre>',$data['all_borrowed']);die;
		// var_dump($data['isMobile']);die;
		// var_dump('<pre>',$data['all_tools']);die;
		$this->load->view('MainView',$data);
	}

	public function borrowTool(){
		$data['result'] = 'User Error';
		$data['code']   = 404;
		if (isset($_SESSION['username'])) {
			$data['result'] = 'Something went wrong';
			$data['code']   = 400;
			if (isset($_POST['toolid']) && isset($_POST['barCode'])) {
				$result = $this->main->borrowTool($_POST['toolid'], $_POST['barCode']);
				if ($result) {
					$data['result'] = 'success';
					$data['code']   = 200;
				}
			}
		}
		echo json_encode($data);
	}

	public function returnTool() {

		// if(isse)
	}

	public function logout(){
		session_destroy();
		redirect();
	} 
}
