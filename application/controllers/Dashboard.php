<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('events_model');
		$this->load->model('guests_model');
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
		
		if($events){
			//send email to guest_registration

			$config = array();
				$config['protocol'] = 'smtp';
				$config['smtp_host'] = '';
				$config['smtp_user'] = '';
				$config['smtp_pass'] = '';
				$config['smtp_port'] = 587;
				$config['wordwrap'] = TRUE;
				$config['newline'] = "\r\n";
				$config['crlf'] = "\r\n";
				$config['charset'] = 'iso-8859-1';
				$config['priority'] = 1;    
				//$config['tls'] = false;
				$this->email->initialize($config);


				$this->email->from('', 'Ashok');
				$this->email->to('');
				$this->email->cc('');
				//$this->email->bcc('them@their-example.com');

				$this->email->subject('Email Test');
				$this->email->message('You have regiseter successfuly !, click link to regiseter '. $events);

				$this->email->send();
				//echo $this->email->print_debugger();

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
			$config['smtp_host'] = 'smtpout.secureserver.net';
			$config['smtp_user'] = 'ashok@embin.com';
			$config['smtp_pass'] = 'embinMachine9';
			$config['smtp_port'] = 587;
			//$config['smtp_port'] = 465;
			$config['wordwrap'] = TRUE;
			$config['newline'] = "\r\n";
			$config['crlf'] = "\r\n";
			$config['charset'] = 'iso-8859-1';
			$config['priority'] = 1;    
			$this->email->initialize($config);
			$this->email->from('ashok@embin.com', 'ashok');
			$this->email->to($this->input->post('email'));
			//$this->email->cc('another@another-example.com');
			//$this->email->bcc('them@their-example.com');

			$this->email->subject('Email Test');
			$this->email->message('You have regiseter successfuly !');

			$this->email->send();
			//echo $this->email->print_debugger();

		
				$this->load->view('templates/header');
				$this->load->view('dashboard/success');
				$this->load->view('templates/footer');
			}

		}
	}


	public function export(){
		$filename = 'guests_'.date('Ymd').'.csv';
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$filename");
		header("Content-Type: application/csv;");

		 $data = $this->guests_model->guests();
		 $file = fopen('php://output','w');
		 $header = array("name", "email", "gender","age","council_number","council_state","phone","date");
		fputcsv($file, $header);
		foreach($data as $key=>$line){
			fputcsv($file, $line);
		}
		fclose($file);
		exit;
		

	}

	public function pastevents(){
		$events = $this->events_model->pastevents();
		
		$data['events'] = $events;
		$this->load->view('templates/header');
		$this->load->view('dashboard/past_future_events', $data);
		$this->load->view('templates/footer');

	}

	public function upcomingevents(){
		$events = $this->events_model->upcomingevents();
		
		$data['events'] = $events;
		$this->load->view('templates/header');
		$this->load->view('dashboard/past_future_events', $data);
		$this->load->view('templates/footer');

	}
}
