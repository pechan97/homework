<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserOld extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	// public function index()
	// {
	// 	$this->load->view('users/index');
	// }
	//
	// public function show()
	// {
	// 	$this->load->view('users/show');
	// }

	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
	}

	public function login()
	{

		$vals = array(
		    'img_path'      => '/Users/bladimirarroyo/dev/utn/codeIgniter311/captcha/',
		    'img_url'       => 'http://myridescr.com/captcha/'
		);

		$cap = create_captcha($vals);
		$data['captcha'] = $cap['image'];
		$data['word'] = $cap['word'];
		$data['msg'] = $this->session->flashdata('error');
		$data['google_key'] = $this->config->item('google_key');
		$this->load->view('users/login', $data);
	}

	/**
	 * This method will take username/password to authenticate from params
	 */
	public function authenticate() {
		// objener valores
		$user = $this->input->post('username');
		$pass = $this->input->post('password');
		// consultar BD
		$this->load->model('User_model');
		$r = $this->User_model->authenticate($user, $pass);

		if(sizeof($r) > 0) {
			$this->session->set_userdata('user', $r[0]);
			redirect('/');
		} else {
			$this->session->set_flashdata('error', 'Password or User invalid');
			redirect('/login');
		}
	}
}
