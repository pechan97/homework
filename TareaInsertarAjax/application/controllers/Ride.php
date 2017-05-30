<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ride extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
	}

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
	public function index()
	{
		// acceso al Modelo
		echo $this->config->item('google_key');
		die;
		$this->load->model('Ride_model');
		$data['rides'] = $this->Ride_model->get_all();
		$this->load->view('rides/index', $data);
	}

	public function show($id)
	{
		echo $this->config->item('google_key');
		die;
		$data['ride_id'] = $id;
		$this->load->view('rides/show', $data);
	}

	public function save($to, $from) {
		$this->load->model('Ride_model');
		// $ride['to'] = $this->input->get('to'); // $_GET['to']
		// $ride['from'] = $this->input->get('from'); // $_GET['from']

		// $ride['to'] =  $this->uri->segment(3);
		// $ride['from'] =  $this->uri->segment(4);
		//

		$result = $this->Ride_model->insert($ride);

		if($result) {
			$this->session->set_flashdata('message', 'The Ride was inserted properly');
			redirect('/');
		}
	}
}
