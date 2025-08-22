<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	public function __construct() {
      parent::__construct();
      $this->load->helper('url');
      $this->load->model('search_model');
      // if(!$this->session->userdata('id')){ 
      //   redirect('login'); 
      // }
    }

	public function index()
	{
		$this->load->view('search');
	}

    public function benefList()
    {
        $postData = $this->input->post();
        $result = $this->search_model->benefList($postData);
        echo json_encode($result);
    }

    public function get_barangay()
    {
        $city = $this->input->post('city');
        $result = $this->search_model->get_barangay($city);

        echo '<option value="">Choose from</option>';

        if ($result) {
            foreach ($result as $row) {
                echo '<option value="'.$row->barangay.'">'.$row->barangay.'</option>';
            }
        }
    }

    public function export_excel()
    {
        $file = 'Livelihood Report - '.date('Y-m-d h:i:s a', time());;
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=".$file.".xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        $firstname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        $city = $this->input->post('city');
        $barangay = $this->input->post('barangay');
        $count = 1;

        $result = $this->search_model->export_excel($firstname, $lastname, $city, $barangay);

        echo '
        <table border = "1">
            <thead>
                <tr>
                    <th class="align-middle text-center">#</th>
                    <th class="align-middle text-center">Batch</th>
                    <th class="align-middle text-center">Status</th>
                    <th class="align-middle text-center">Full Name</th>
                    <th class="align-middle text-center">First Name</th>
                    <th class="align-middle text-center">Middle Name</th>
                    <th class="align-middle text-center">Last Name</th>
                    <th class="align-middle text-center">Extension Name</th>
                    <th class="align-middle text-center">Birthday</th>
                    <th class="align-middle text-center">Barangay</th>
                    <th class="align-middle text-center">City/Municipality</th>
                    <th class="align-middle text-center">Province</th>
                    <th class="align-middle text-center">District</th>
                    <th class="align-middle text-center">Type of ID </th>
                    <th class="align-middle text-center">ID Number</th>
                    <th class="align-middle text-center">Contact No.</th>
                    <th class="align-middle text-center">E-payment/Bank Account No.</th>
                    <th class="align-middle text-center">Type of Beneficiary</th>
                    <th class="align-middle text-center">Occupation</th>
                    <th class="align-middle text-center">Sex</th>
                    <th class="align-middle text-center">Civil Status</th>
                    <th class="align-middle text-center">Age</th>
                    <th class="align-middle text-center">Average Monthly Income</th>
                    <th class="align-middle text-center">Dependent</th>
                    <th class="align-middle text-center">Interested  in wagage employment or self-employment?</th>
                    <th class="align-middle text-center">Skills training needed</th>
                </tr>
            </thead>
            <tbody>';

            foreach ($result as $record) {

                if ($record->batch_status == "U") {
                    $status = '<span class="badge badge-pill text-white" style="background: #640D6B">UNSIGNED</span>';
                    $color = "style = 'background: #640D6B; color:white' ";
                } elseif ($record->batch_status == "R") {
                    $status = '<span class="badge badge-pill badge-secondary">REPLACEMENT</span>';
                    $color = "style = 'background: red; color:white' ";
                } else {
                    $status = "";
                    $color = "";
                }

                echo '<tr '.$color.'>';
                echo '<td>'. $count++ .'</td>';
                echo '<td>'. '<b>'.$record->batch_name.'</td>';
                echo '<td>'. $status.'</td>';
                echo '<td>'. $record->concat_name.'</td>';
                echo '<td>'. $record->firstname.'</td>';
                echo '<td>'. $record->middlename.'</td>';
                echo '<td>'. $record->lastname.'</td>';
                echo '<td>'. $record->extension_name.'</td>';
                echo '<td>'. date("M d, Y", strtotime($record->birthdate)).'</td>';
                echo '<td>'. $record->barangay.'</td>';
                echo '<td>'. $record->city.'</td>';
                echo '<td>'. $record->province.'</td>';
                echo '<td>'. $record->district.'</td>';
                echo '<td>'. $record->type_of_id.'</td>';
                echo '<td>'. $record->id_number.'</td>';
                echo '<td>'. $record->contact_no.'</td>';
                echo '<td>'. $record->e_payment.'</td>';
                echo '<td>'. $record->type_of_benef.'</td>';
                echo '<td>'. $record->occupation.'</td>';
                echo '<td>'. $record->sex.'</td>';
                echo '<td>'. $record->civil_status.'</td>';
                echo '<td>'. $record->age.'</td>';
                echo '<td>'. $record->monthly_income.'</td>';
                echo '<td>'. $record->dependent.'</td>';
                echo '<td>'. $record->wage_employment.'</td>';
                echo '<td>'. $record->skills.'</td>';
                echo '</tr>';
            }

            echo '</tbody>
        </table>
        ';
    }
}
