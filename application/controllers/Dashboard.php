<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('events_model');
		$this->load->helper(array('form', 'url','email'));
   		$this->load->library('form_validation');
		
		if(!$this->session->userdata('user')) redirect($this->config->item('base_url').'users/login');
				
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
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	
	public function index(){
		$events = $this->events_model->get_events();
		
		$data['events'] = $events;
		$this->load->view('templates/header');
		$this->load->view('dashboard/index', $data);
		$this->load->view('templates/footer');

	}

	public function createevent(){
		
		$events = $this->events_model->create_events();
		//print_r($events);
		if($events){
			redirect('dashboard/index');
		}
		
	}

	public function createevents()
	{
		
		
		$this->load->view('templates/header');
		$this->load->view('dashboard/createevent');
		$this->load->view('templates/footer');
	}

	public function event_details(){
		//print 'got ou';
		
		
		$slug = $this->uri->segment(3);
		$event = $this->events_model->get_events($slug);
		$data['event'] = $event;
		$this->load->view('templates/header');
		$this->load->view('dashboard/event_details', $data);
		$this->load->view('templates/footer');

	}

	public function guests(){
		$this->load->helper('form');
   		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('name','Name', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		if($this->form_validation->run() === FALSE){
			
			$error = 'ERROR- All fileds are required';
			redirect('dashboard/event_details/'.trim($this->input->post('slug').'?error='.$error));

		}else{
			//regiseter
			$response = $this->events_model->guest_registration();
			if($response){
				
				$config = array();
$config['protocol'] = 'smtp';
$config['smtp_host'] = '';
$config['smtp_user'] = '';
$config['smtp_pass'] = '';
$config['smtp_port'] = 25;
$config['wordwrap'] = TRUE;
$config['newline'] = "\r\n";
$config['crlf'] = "\r\n";
$config['charset'] = 'iso-8859-1';
$config['priority'] = 1;    
//$config['tls'] = false;
$this->email->initialize($config);


				$this->email->from('ashok@whizti.com', 'Kumar');
				$this->email->to($this->input->post('email'));
				//$this->email->cc('another@another-example.com');
				//$this->email->bcc('them@their-example.com');

				$this->email->subject('Email Test');
				$this->email->message('You have regiseter successfuly !');

				$this->email->send();
				echo $this->email->print_debugger();

				


				// $this->load->view('templates/header');
				// $this->load->view('dashboard/success');
				// $this->load->view('templates/footer');
			}

		}
	}
}
