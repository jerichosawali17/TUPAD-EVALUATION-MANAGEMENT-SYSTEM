<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model {

      function __construct(){
            parent::__construct();
            $this->load->database();
      }

      public function login_user($data){

            $userdata = array(
                  'username' => $data['username'],
            );

            $this->db->where($userdata);

            return $this->db->get('accounts')->row();
            
      }
}

?>