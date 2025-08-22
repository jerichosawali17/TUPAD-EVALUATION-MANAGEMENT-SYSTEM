<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Evaluation_model extends CI_Model {

      function __construct(){
            parent::__construct();
            $this->load->database();
      }

      public function checkBenef($concated_name, $district)
      {
            $this->db->join('city', 'city.city = beneficiary.city');
            if ($district != "") {
                  $this->db->where('city.district', $district);
            }
            $this->db->where('beneficiary.active_status', "1");
            $this->db->like('concat_name', $concated_name);
            return $this->db->get('beneficiary')->num_rows();
      }

      public function seeBenef($benef)
      {
            $this->db->select('*, beneficiary.status AS benef_status');
            $this->db->join('batches', 'batches.batch_id = beneficiary.batch_id');
            $this->db->like('concat_name', $benef);
            return $this->db->get('beneficiary')->result();
      }

      public function see_duplicate_contact($benef)
      {
            $this->db->select('*, beneficiary.status AS benef_status');
            $this->db->join('batches', 'batches.batch_id = beneficiary.batch_id');
            $this->db->like('contact_no', $benef);
            return $this->db->get('beneficiary')->result();
      }

      public function see_brgy_benef($benef)
      {
            $this->db->like('concat_name', $benef);
            return $this->db->get('barangay_officials')->result();
      }

      public function checkBrgy($concated_name)
      {
            $this->db->like('concat_name', $concated_name);
            return $this->db->get('barangay_officials')->num_rows();
      }

      public function checkContact($contact_no)
      {
            $this->db->where('beneficiary.active_status', "1");
            $this->db->like('contact_no', $contact_no);
            return $this->db->get('beneficiary')->num_rows();
      }
}

?>