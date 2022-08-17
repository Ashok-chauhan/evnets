<?php
class Events_model extends CI_Model {
    public function __construct() {

    }

    public function get_events($slug = FALSE) {
		if ($slug === FALSE) {
        $query = $this->db->get('events');
        return $query->result_array();
		}

		$query = $this->db->get_where('events', array('slug' => $slug));
		//print_r($this->db->last_query());    
		return $query->result_array();
    }

    public function create_events(){
		if($this->input->post('slug')){
			$slug = url_title($this->input->post('slug'), 'dash', TRUE);
		}else{
			$slug = url_title($this->input->post('event_name'), 'dash', TRUE);
		}
		$url = base_url().'events/event/' . $slug;

        $eventdata = array(
			'event_name' => $this->input->post('event_name'),
			'slug' => $slug,
			'start_date' => $this->input->post('event_start_date'),
			'end_date' => $this->input->post('event_end_date'),
			'start_time' => $this->input->post('event_start_time'),
			'end_time' => $this->input->post('event_end_time'),
			'welcome_text' => $this->input->post('welcome_text'),
			'disclaimer' => $this->input->post('disclaimer'),
			'email_body' => $this->input->post('email_body'),
			'url' => $url,

		);
		$error = '';
		$config['upload_path'] 		= './uploads/';
		$config['allowed_types'] 	= 'gif|jpg|png';
		$this->load->library('upload', $config);
		if( ! $this->upload->do_upload('banner')){
			$error .= array('error' => $this->upload->display_errors());
			
		}else{
			$data = array('upload_data' => $this->upload->data());
			$banner = $data['upload_data']['file_name'];
			
		}

		if( ! $this->upload->do_upload('email_header')){
			$error .= array('error' => $this->upload->display_errors());
			
		}else{
			$data = array('upload_data' => $this->upload->data());
			$email_header = $data['upload_data']['file_name'];
		}

		if( ! $this->upload->do_upload('email_footer')){
			$error = array('error' => $this->upload->display_errors());
			
		}else{
			$data = array('upload_data' => $this->upload->data());
			$email_footer = $data['upload_data']['file_name'];
		}

		if($error){
			print_r($error);
		}
		
		
		$eventdata['banner'] = $banner;
		$eventdata['email_header'] = $email_header;
		$eventdata['email_footer'] = $email_footer;

		if($this->db->insert('events', $eventdata)){
			return $url;
		}

    }

	public function guest_registration(){
		$data = array(
			'name'=> $this->input->post('title').' '. $this->input->post('name'),
			'email'=>$this->input->post('email'),
			'age'=>$this->input->post('age'),
			'gender'=>$this->input->post('gender'),
			'council_number'=>$this->input->post('council_number'),
			'council_state'=>$this->input->post('council_state'),
			'phone'=>$this->input->post('phone'),
		);

		return $this->db->insert('guest', $data);

	}


}