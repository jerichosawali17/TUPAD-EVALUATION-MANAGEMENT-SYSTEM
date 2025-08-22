<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Beneficiary_model extends CI_Model {

      function __construct(){
            parent::__construct();
            $this->load->database();
      }

      public function getBatch($batch_id)
      {
            $this->db->where('batch_id', $batch_id);
            return $this->db->get('batches')->row();
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
            $id = $postData['id'];
            $barangay = $postData['barangay'];

            $searchQuery = "";
            if($searchValue != ''){
                  $searchQuery = " (
                        status like '%".$searchValue."%' OR
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
            $this->db->where('batch_id', $id);
            if($searchQuery != ''){
                  $this->db->where($searchQuery);
            }
            if($barangay != ''){
                  $this->db->where("barangay", $barangay);
            }
            $records = $this->db->get('beneficiary')->result();
            $totalRecordwithFilter = $records[0]->allcount;

            if($searchQuery != ''){
                  $this->db->where($searchQuery);
            }
            if($barangay != ''){
                  $this->db->where("barangay", $barangay);
            }
            $this->db->where('batch_id', $id);
            $this->db->order_by($columnName, $columnSortOrder);
            $this->db->limit($rowperpage, $start);
            $records = $this->db->get('beneficiary')->result();

            $data = array();

            foreach($records as $record ){
                  $action = '<div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <button class="dropdown-item" id="edit_benef" value="'.$record->id.'">Edit</button>
                                          <button class="dropdown-item" id="delete_benef" value="'.$record->id.'">Delete</button>
                                    </div>
                              </div>';

                  if ($record->status == "U") {
                        $status = '<span class="badge badge-pill text-white" style="background: #640D6B">UNSIGNED</span>';
                  } elseif ($record->status == "R") {
                        $status = '<span class="badge badge-pill badge-secondary">REPLACEMENT</span>';
                  } elseif ($record->status == "AA") {
                        $status = '<span class="badge badge-pill badge-warning">ALREADY AVAILED</span>';
                  } else {
                        $status = "";
                  }

                  $data[] = array(
                        "id"                    =>          $action,
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
                        'active_status'         =>          "1",
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

      public function getCity($id)
      {
            $this->db->where('batch_id', $id);
            $this->db->group_by('barangay');
            $this->db->order_by('barangay', 'asc');
            return $this->db->get('beneficiary')->result();
      }

      public function add_beneficiary($data)
      {
             if ($this->db->insert('beneficiary', $data)) {
                  return true;
            } else {
                  return false;
            }
      }

      public function update_status($data, $id)
      {
            $this->db->where('batch_id', $id); 
            $this->db->set($data); 
            return $this->db->update('batches');
      }

      public function delete_benef($id)
      {
            $this->db->where('id', $id);
            return $this->db->delete('beneficiary');
      }

      public function delete_all_benef($id)
      {
            $this->db->where('batch_id', $id);
            return $this->db->delete('beneficiary');
      }

      
}

?>