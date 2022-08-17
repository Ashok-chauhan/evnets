<?php
class Guests_model extends CI_Model {
    public function __construct() {

    }

    public function guests(){

        //$query =  $this->db->get('guest');
        $query = $this->db->query("SELECT name, email, gender, age, council_number, council_state, phone, date FROM guest");
        return $query->result_array();
    }

}