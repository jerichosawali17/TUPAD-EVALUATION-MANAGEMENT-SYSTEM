<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Batch_model extends CI_Model {

      function __construct(){
            parent::__construct();
            $this->load->database();
      }

      public function start_transaction() {
            $this->db->trans_start();
      }

      public function end_transaction() {
            if ($this->db->trans_status() === FALSE) {
                  $this->db->trans_rollback();
                  return FALSE;
            } else {
                  $this->db->trans_complete();
                  return TRUE;
            }
      }

      public function batchList($postData)
      {
            $response = array();

            $draw = $postData['draw'];
            $start = $postData['start'];
            $rowperpage = $postData['length'];
            $columnIndex = $postData['order'][0]['column'];
            $columnName = $postData['columns'][$columnIndex]['data'];
            $columnSortOrder = $postData['order'][0]['dir'];
            $searchValue = $postData['search']['value'];
            $city = $postData['city'];
            $status = $postData['status'];
            $month = $postData['month'];

            $searchQuery = "";
            if($searchValue != ''){
                  $searchQuery = " (
                        batch_name like '%".$searchValue."%' OR
                        city like'%".$searchValue."%' OR
                        no_of_benef like'%".$searchValue."%'
                  ) ";
            }

            $this->db->select('count(*) as allcount');
            $records = $this->db->get('batches')->result();
            $totalRecords = $records[0]->allcount;

            $this->db->select('count(*) as allcount');
            if($searchQuery != ''){
                  $this->db->where($searchQuery);
            }
            if($city != ''){
                  $this->db->where("city", $city);
            }
            if($status != ''){
                  $this->db->where("status", $status);
            }
            if($month != ''){
                  $this->db->where("MONTH(implement_date)", $month);
            }
            $records = $this->db->get('batches')->result();
            $totalRecordwithFilter = $records[0]->allcount;

            if($searchQuery != ''){
                  $this->db->where($searchQuery);
            }
            if($city != ''){
                  $this->db->where("city", $city);
            }
            if($status != ''){
                  $this->db->where("status", $status);
            }
            if($month != ''){
                  $this->db->where("MONTH(implement_date)", $month);
            }
            $this->db->order_by($columnName, $columnSortOrder);
            $this->db->limit($rowperpage, $start);
            $records = $this->db->get('batches')->result();

            $data = array();

            foreach($records as $record ){
                  $action = '<div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <button class="dropdown-item" id="edit_batch" value="'.$record->batch_id.'">Edit</button>
                                          <a class="dropdown-item" href="'.base_url().'beneficiary/list/'.$record->batch_id.'" target="_blank">View Beneficiaries</a>
                                          <button class="dropdown-item" id="delete_batch" value="'.$record->batch_id.'">Delete</button>
                                    </div>
                              </div>';

                  if ($record->status == "UPDATED") {
                        $status = '<span class="badge badge-pill badge-success">UPDATED</span>';
                  } elseif ($record->status == "NOT UPDATED") {
                        $status = '<span class="badge badge-pill badge-secondary">NOT UPDATED</span>';
                  } else {
                        $status = "";
                  }

                  if ($record->active_status == "1") {
                        $active_status = '<span class="badge badge-pill badge-success">ACTIVE</span>';
                  } else {
                        $active_status = '<span class="badge badge-pill badge-secondary">NOT ACTIVE</span>';
                  }

                  if ($record->adl == "0000-00-00") {
                        $adl = '<span class="badge badge-pill badge-secondary">NO ADL</span>';
                  } else {
                        $adl = $record->adl;
                  }

                  $data[] = array(
                        'batch_id'        =>    $adl,
                        'batch_name'      =>    $record->batch_name,
                        'city'            =>    $record->city,
                        'no_of_benef'     =>    number_format($record->no_of_benef),
                        'id'              =>    $action,
                        'status'          =>    $status,
                        'active_status'   =>    $active_status,
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

      public function brgyList($postData)
      {
            $response = array();

            $draw = $postData['draw'];
            $start = $postData['start'];
            $rowperpage = $postData['length'];
            $columnIndex = $postData['order'][0]['column'];
            $columnName = $postData['columns'][$columnIndex]['data'];
            $columnSortOrder = $postData['order'][0]['dir'];
            $searchValue = $postData['search']['value'];
            $city = $postData['city'];

            $searchQuery = "";
            if($searchValue != ''){
                  $searchQuery = " (
                        firstname like '%".$searchValue."%' OR
                        middlename like '%".$searchValue."%' OR
                        lastname like '%".$searchValue."%' OR
                        city like '%".$searchValue."%' OR
                        barangay like '%".$searchValue."%' OR
                        position like '%".$searchValue."%'
                  ) ";
            }

            $this->db->select('count(*) as allcount');
            $records = $this->db->get('barangay_officials')->result();
            $totalRecords = $records[0]->allcount;

            $this->db->select('count(*) as allcount');
            if($searchQuery != ''){
                  $this->db->where($searchQuery);
            }
            if($city != ''){
                  $this->db->like("city", $city);
            }
            $records = $this->db->get('barangay_officials')->result();
            $totalRecordwithFilter = $records[0]->allcount;

            if($searchQuery != ''){
                  $this->db->where($searchQuery);
            }
            if($city != ''){
                  $this->db->like("city", $city);
            }
            $this->db->order_by($columnName, $columnSortOrder);
            $this->db->limit($rowperpage, $start);
            $records = $this->db->get('barangay_officials')->result();

            $data = array();
            $count = 1;

            foreach($records as $record ){
                  $action = '<div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <button class="dropdown-item" id="edit_batch" value="'.$record->official_id.'">Edit</button>
                                          <button class="dropdown-item" id="delete_batch" value="'.$record->official_id.'">Delete</button>
                                    </div>
                              </div>';

                  $data[] = array(
                        'id'              =>    $action,
                        'firstname'       =>    strtoupper($record->firstname),
                        'middlename'      =>    strtoupper($record->middlename),
                        'lastname'        =>    strtoupper($record->lastname),
                        'city'            =>    strtoupper($record->city),
                        'barangay'        =>    strtoupper($record->barangay),
                        'position'        =>    strtoupper($record->position)
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

      public function view_benef($batch_id)
      {
            $this->db->where('batch_id', $batch_id);
            return $this->db->get('beneficiary')->result();
      }

      public function add_bacth($data)
      {
            if ($this->db->insert('batches', $data)) {
                  return true;
            } else {
                  return false;
            }
      }

      public function add_beneficiary($data)
      {
            if ($this->db->insert('beneficiary', $data)) {
                  return true;
            } else {
                  return false;
            }
      }

      public function add_officials($data)
      {
            if ($this->db->insert('barangay_officials', $data)) {
                  return true;
            } else {
                  return false;
            }
      }

      public function fetch_batch($batch_id)
      {
            $this->db->where('batch_id', $batch_id);
            return $this->db->get('batches')->row();
      }

      public function edit_batch($data, $batch_id)
      {
            $this->db->where('batch_id', $batch_id); 
            $this->db->set($data); 
            return $this->db->update('batches');
      }

      public function edit_benef($data, $batch_id)
      {
            $this->db->where('batch_id', $batch_id); 
            $this->db->set($data); 
            return $this->db->update('beneficiary');
      }

      public function delete_batch($batch_id)
      {
            $this->db->where('batch_id', $batch_id);
            return $this->db->delete('batches');
      }

      public function delete_benef($batch_id)
      {
            $this->db->where('batch_id', $batch_id);
            return $this->db->delete('beneficiary');
      }

      public function delete_officials()
      {
            return $this->db->truncate('barangay_officials');
      }

      public function checkBenef($concated_name)
      {
            $this->db->join('city', 'city.city = beneficiary.city');
            $this->db->like('concat_name', $concated_name);
            return $this->db->get('beneficiary')->num_rows();
      }

      public function checkBrgy($concated_name)
      {
            $this->db->like('concat_name', $concated_name);
            return $this->db->get('barangay_officials')->num_rows();
      }

      public function month_added()
      {
            $this->db->select("MONTH(implement_date) as month, DATE_FORMAT(implement_date, '%M') AS month_name");
            $this->db->from('batches');
            $this->db->where("MONTH(implement_date) != 0");
            $this->db->group_by("month");
            $this->db->order_by("month", "asc");
            return $this->db->get()->result();
      }
}

?>