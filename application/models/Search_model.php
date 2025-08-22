<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Search_model extends CI_Model {

      function __construct(){
            parent::__construct();
            $this->load->database();
      }

      public function get_barangay($city)
      {
            $this->db->where('city', $city);
            $this->db->group_by('barangay');
            $this->db->order_by('barangay', 'asc');
            return $this->db->get('beneficiary')->result();
      }

      public function benefList($postData)
      {
            $response = array();

            $draw = $postData['draw'];
            $start = $postData['start'];
            $rowperpage = $postData['length'];
            $columnIndex = $postData['order'][0]['column'];
            $columnName = $postData['columns'][$columnIndex]['data'];
            $columnSortOrder = $postData['order'][0]['dir'];
            $searchValue = $postData['search']['value'];

            $firstname = $postData['firstname'];
            $lastname = $postData['lastname'];
            $city = $postData['city'];
            $barangay = $postData['barangay'];
            $contact = $postData['contact'];

            $searchQuery = "";
            if($searchValue != ''){
                  $searchQuery = " (
                        firstname like '%".$searchValue."%' OR
                        middlename like '%".$searchValue."%' OR
                        lastname like '%".$searchValue."%' OR
                        extension_name like '%".$searchValue."%' OR
                        birthdate like '%".$searchValue."%' OR
                        barangay like '%".$searchValue."%' OR
                        city like '%".$searchValue."%' OR
                        province like '%".$searchValue."%' OR
                        district like '%".$searchValue."%' OR
                        type_of_id like '%".$searchValue."%' OR
                        id_number like '%".$searchValue."%' OR
                        contact_no like '%".$searchValue."%' OR
                        e_payment like '%".$searchValue."%' OR
                        type_of_benef like '%".$searchValue."%' OR
                        occupation like '%".$searchValue."%' OR
                        sex like '%".$searchValue."%' OR
                        civil_status like '%".$searchValue."%' OR
                        age like '%".$searchValue."%' OR
                        monthly_income like '%".$searchValue."%' OR
                        dependent like '%".$searchValue."%' OR
                        wage_employment like '%".$searchValue."%' OR
                        skills like '%".$searchValue."%'
                  ) ";
            }

            $this->db->select('count(*) as allcount');
            $records = $this->db->get('beneficiary')->result();
            $totalRecords = $records[0]->allcount;

            $this->db->select('count(*) as allcount');
            if($searchQuery != ''){
                  $this->db->where($searchQuery);
            }
            if($barangay != ''){
                  $this->db->where("barangay", $barangay);
            }
            if($city != ''){
                  $this->db->where("city", $city);
            }
            if($firstname != ''){
                  $this->db->like("firstname", $firstname);
            }
            if($lastname != ''){
                  $this->db->like("lastname", $lastname);
            }
            if($contact != ''){
                  $this->db->like("contact_no", $contact);
            }
            $records = $this->db->get('beneficiary')->result();
            $totalRecordwithFilter = $records[0]->allcount;

            if($searchQuery != ''){
                  $this->db->where($searchQuery);
            }
            if($barangay != ''){
                  $this->db->where("barangay", $barangay);
            }
            if($city != ''){
                  $this->db->where("city", $city);
            }
            if($firstname != ''){
                  $this->db->like("firstname", $firstname);
            }
            if($lastname != ''){
                  $this->db->like("lastname", $lastname);
            }
            if($contact != ''){
                  $this->db->like("contact_no", $contact);
            }
            $this->db->order_by($columnName, $columnSortOrder);
            $this->db->limit($rowperpage, $start);
            $records = $this->db->get('beneficiary')->result();

            $data = array();
            $count = 1;

            foreach($records as $record ){

                  if ($record->status == "U") {
                        $status = '<span class="badge badge-pill text-white" style="background: #640D6B">UNSIGNED</span>';
                  } elseif ($record->status == "R") {
                        $status = '<span class="badge badge-pill badge-secondary">REPLACEMENT</span>';
                  } else {
                        $status = "";
                  }

                  $this->db->where("batch_id", $record->batch_id);
                  $batch = $this->db->get('batches')->row();

                  $data[] = array(
                        "id"                    =>          $count++,
                        "batch_name"            =>          '<b>'.$batch->batch_name.'</b>',
                        "status"                =>          $status,
                        "firstname"             =>          $record->firstname,
                        "middlename"            =>          $record->middlename,
                        "lastname"              =>          $record->lastname,
                        "extension_name"        =>          $record->extension_name,
                        "birthdate"             =>          date("M d, Y", strtotime($record->birthdate)),
                        "barangay"              =>          $record->barangay,
                        "city"                  =>          $record->city,
                        "province"              =>          $record->province,
                        "district"              =>          $record->district,
                        "type_of_id"            =>          $record->type_of_id,
                        "id_number"             =>          $record->id_number,
                        "contact_no"            =>          $record->contact_no,
                        "e_payment"             =>          $record->e_payment,
                        "type_of_benef"         =>          $record->type_of_benef,
                        "occupation"            =>          $record->occupation,
                        "sex"                   =>          $record->sex,
                        "civil_status"          =>          $record->civil_status,
                        "age"                   =>          $record->age,
                        "monthly_income"        =>          $record->monthly_income,
                        "dependent"             =>          $record->dependent,
                        "wage_employment"       =>          $record->wage_employment,
                        "skills"                =>          $record->skills,
                  );
            }

            $response = array(
                  "draw" => intval($draw),
                  "iTotalRecords" => $totalRecords,
                  "iTotalDisplayRecords" => $totalRecordwithFilter,
                  "aaData" => $data
            );

            return $response; 
      }

      public function export_excel($firstname, $lastname, $city, $barangay)
      {
            $this->db->select('*, beneficiary.status AS batch_status'); 
            $this->db->join('batches', 'batches.batch_id = beneficiary.batch_id');
            if($barangay != ''){
                  $this->db->where("barangay", $barangay);
            }
            if($city != ''){
                  $this->db->where("city", $city);
            }
            if($firstname != ''){
                  $this->db->like("firstname", $firstname);
            }
            if($lastname != ''){
                  $this->db->like("lastname", $lastname);
            }
            return $this->db->get('beneficiary')->result();
      }

      
}

?>