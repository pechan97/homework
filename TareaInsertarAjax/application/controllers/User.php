<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function login()
	{
		$this->load->view('users/login');
	}

  public function create()
  {
    $this->load->view('users/create');
  }

  /**
	 * This method will save a new user
	 */
	public function save() {
		// objener valores
	$first_name = $this->input->post('first_name');
	$last_name = $this->input->post('last_name');
    $username = $this->input->post('username');	
    $password = $this->input->post('password');	

    $user = array(        
        'first_name' => $first_name,
        'last_name' => $last_name,
        'username' => $username,
        'password' => $password
      );


    $r = $this->User_model->save($user);

		if($r) {
      $this->session->set_flashdata('message','User saved');
			redirect('usuario/listado');
		} else {
      $this->session->set_flashdata('message','There was an error saving the user');
			redirect('usuario/crear');
		}
	}

  /**
	 * This method will take username/password to authenticate from params
	 */
	public function authenticate() {
		// objener valores
    $user = $this->input->post('username');
		$pass = $this->input->post('password');

    // consultar BD
    // si existe redirecciono a la pagina de inicio
    // load the model, can also be loaded from the autoload
		// $this->load->model('User_model');

    $r = $this->User_model->authenticate($user, $pass);

		if(sizeof($r) > 0) {
			$this->session->set_userdata('user', $r[0]);
			// redirect('/');
      $name = $r[0]->first_name;
      echo "<div>My name is: <b>$name</b></div>";
		} else {
			// $this->session->set_flashdata('error', 'Password or User invalid');
			// redirect('/');
      sleep(5);
      echo json_encode("There was an error");
		}
	}

  /**
	 * This method will list all existing users
	 */
	public function index() {

    $r = $this->User_model->all();

    $data['users'] = $r;
    $data['title'] = 'List of Users';

		$this->load->view('users/index', $data);
	}


}
