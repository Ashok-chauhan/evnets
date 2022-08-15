<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
    public function __construct(){
		parent::__construct();
		//Your own constructor code.
		//$this->load->helper('url');
		//$this->load->helper('form');
		//$this->load->helper('menu');
		///$this->load->model('Muser');

	}

	public function login()
	{
		if(isset($_REQUEST['error']) && $_REQUEST['error'] !='')
			$error_string = '<div class="error">'.$_REQUEST['error'].'</div>';
		else $error_string = '';
		
		$data['error_messages'] = $error_string;
		$this->load->view('templates/loginheader');
		$this->load->view('users/login',$data);
		$this->load->view('templates/footer');
		
	}

    public function authenticate(){
		$error_string = '';
		if(!isset($_POST['email']) || $_POST['email'] == '')
			$error_string .= 'Email Is Required<br/>';

		if(!isset($_POST['password']) || $_POST['password'] == '')
			$error_string .= 'Password Is Required<br/>';
		
		if($error_string !='')
			redirect('users/login/?error='.$error_string);

		//else {
            $email = $_POST['email'];
			$password = md5($_POST['password']);
			$this->db->where('email',$email);
			$this->db->where('password',$password);
			$result = $this->db->get('users');
			$user = $result->row_array();
			print_r($user);
			if($user){
            
                if(isset($user['id']) && $user['id'] !='') {
                    if($user['status']=='inactive'){
                    $error_string .= 'Account is not Activated<br/>';
                    redirect('users/login/?error='.$error_string);
                    }
                    $this->session->set_userdata('user', $user);
                    redirect($this->config->item('base_url').'dashboard/index');
                }
			}else{
				$error_string .= 'Invalid email/password';
				redirect('users/login/?error='.$error_string);
			}


        //}
    }

	function logout() {
		$this->session->sess_destroy();
		redirect($this->config->item('base_url').'users/login');
	}

}
