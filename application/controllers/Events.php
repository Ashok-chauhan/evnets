<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('events_model');
		$this->load->helper(array('form', 'url'));
   		$this->load->library('form_validation');
		
						
	}

    public function event(){
        $slug = $this->uri->segment(3);
		$event = $this->events_model->get_events($slug);
		$data['event'] = $event;
		$this->load->view('templates/header');
		$this->load->view('events/event', $data);
		$this->load->view('templates/footer');
    }

    public function register(){
        $this->load->helper('email');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $eventData = $this->events_model->get_events(trim($this->input->post('slug')));
     
     $this->form_validation->set_rules('name','Name', 'required');
     $this->form_validation->set_rules('email', 'email', 'required');
     
     if($this->form_validation->run() === FALSE){
       
         $error = 'ERROR- All fileds are required';
         redirect('events/event/'.trim($this->input->post('slug').'?error='.$error));

     }else{
        $pageurl = $eventData[0]['url'];
         //regiseter
         $response = $this->events_model->guest_registration();
         if($response){
          

             $this->load->view('templates/header');
             $this->load->view('events/success');
             $this->load->view('templates/footer');
         }

     }

    }

}