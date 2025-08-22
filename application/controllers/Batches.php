<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Batches extends CI_Controller {

	public function __construct() {
      parent::__construct();
      $this->load->helper('url');
      $this->load->model('batch_model');
      // if(!$this->session->userdata('id')){ 
      //   redirect('login'); 
      // }
    }

	public function index()
	{
		$this->load->view('batches');
	}

	public function batchList()
	{
		$postData = $this->input->post();
        $result = $this->batch_model->batchList($postData);
        echo json_encode($result);
	}

	public function brgyList()
	{
		$postData = $this->input->post();
        $result = $this->batch_model->brgyList($postData);
        echo json_encode($result);
	}

	public function see_benef()
	{
		$count = 1;
		$config['upload_path']   = './upload/';
        $config['allowed_types'] = 'csv';
        $config['max_size']      = 1024;
        $this->load->library('upload', $config);

        echo '<table id="benef-list" class="table custom-table">
            <thead>
                <tr>
                	<th class="align-middle text-center">#</th>
                	<th class="align-middle text-center">Status</th>
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

        if (!$this->upload->do_upload('csv_file')) {
            echo $this->upload->display_errors();
        } else {
            $excelfile = $this->upload->data();
            $file_path = $excelfile['full_path'];
            $csv_content = file_get_contents($file_path);
            $csv_content = utf8_encode($csv_content);
            file_put_contents($file_path, $csv_content);

            $csv = array_map('str_getcsv', file($file_path));

            foreach ($csv as $row) {

            	if ($row[22] == "U") {
            		$status = '<span class="badge badge-pill text-white" style="background: #640D6B">UNSIGNED</span>';
            	} elseif ($row[22] == "R") {
            		$status = '<span class="badge badge-pill badge-secondary">REPLACEMENT</span>';
            	} elseif ($row[22] == "AA") {
            		$status = '<span class="badge badge-pill badge-warning">ALREADY AVAILED</span>';
            	} else {
            		$status = "";
            	}

            	echo '<tr>
            		<td>'.$count++.'</td>
            		<td>'.$status.'</td>
            		<td>'.$row[0].'</td>
            		<td>'.$row[1].'</td>
            		<td>'.$row[2].'</td>
            		<td>'.$row[3].'</td>
            		<td>'.$row[4].'</td>
            		<td>'.$row[5].'</td>
            		<td>'.$row[6].'</td>
            		<td>'.$row[7].'</td>
            		<td>'.$row[8].'</td>
            		<td>'.$row[9].'</td>
            		<td>'.$row[10].'</td>
            		<td>'.$row[11].'</td>
            		<td>'.$row[12].'</td>
            		<td>'.$row[13].'</td>
            		<td>'.$row[14].'</td>
            		<td>'.$row[15].'</td>
            		<td>'.$row[16].'</td>
            		<td>'.$row[17].'</td>
            		<td>'.$row[18].'</td>
            		<td>'.$row[19].'</td>
            		<td>'.$row[20].'</td>
            		<td>'.$row[21].'</td>
            	</tr>';
            }
        }

        echo '</tbody>
        </table>';
	}

	public function checkbenef()
	{
		$count = 1;
		$config['upload_path']   = './upload/';
        $config['allowed_types'] = 'csv';
        $config['max_size']      = 10000;
        $this->load->library('upload', $config);

        echo '<table id="benef-list" class="table table-sm custom-table">
            <thead>
                <tr>
                	<th class="align-middle text-center">#</th>
                	<th class="align-middle text-center">First Name</th>
                	<th class="align-middle text-center">Last Name</th>
                	<th class="align-middle text-center"></th>
                </tr>
            </thead>
            <tbody>';

        if (!$this->upload->do_upload('csv_file')) {
            echo $this->upload->display_errors();
        } else {
            $excelfile = $this->upload->data();
            $file_path = $excelfile['full_path'];

            $csv = array_map('str_getcsv', file($file_path));
            $csv_content = file_get_contents($file_path);
            $csv_content = utf8_encode($csv_content);
            file_put_contents($file_path, $csv_content);
            
            foreach ($csv as $row) {

            	$firstname = str_replace(' ', '_', $row[0]);
                $lastname = str_replace(' ', '_', $row[2]);
                $firstname = preg_replace('/[^A-Za-z0-9\-]/', '', $row[0]);
                $lastname = preg_replace('/[^A-Za-z0-9\-]/', '', $row[2]);

                $concated_name = $lastname.','.$firstname;
                $duplicates = $this->batch_model->checkBenef($concated_name);

            	if ($duplicates > 0) {

            		echo '<tr>
	            		<td>'.$count++.'</td>
	            		<td>'.$row[0].'</td>
	            		<td>'.$row[2].'</td>
            			<td>
            				<button class="btn btn-primary" id="see_benef" value="'.$concated_name.'">
            					<i class="icon-users"></i>
            					See Duplicates
            				</button>
            			</td>
	            	</tr>';
            	}
            }
        }

        echo '</tbody>
        </table>';
	}

	public function view_benef()
	{
		$count = 1;
		$batch_id = $this->input->post('batch_id');
		$result = $this->batch_model->view_benef($batch_id);

        echo '<table id="benef-list" class="table custom-table">
            <thead>
                <tr>
                	<th class="align-middle text-center">#</th>
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

            foreach ($result as $row) {

            	if ($row->age >= 60) {
            		$senior = "table-success";
            	} else {
            		$senior = "";
            	}

            	echo '<tr class="'.$senior.'">
            		<td>'.$count++.'</td>
            		<td>'.$row->firstname.'</td>
            		<td>'.$row->middlename.'</td>
            		<td>'.$row->lastname.'</td>
            		<td>'.$row->extension_name.'</td>
            		<td>'.date("M d, Y", strtotime($row->birthdate)).'</td>
            		<td>'.$row->barangay.'</td>
            		<td>'.$row->city.'</td>
            		<td>'.$row->province.'</td>
            		<td>'.$row->district.'</td>
            		<td>'.$row->type_of_id.'</td>
            		<td>'.$row->id_number.'</td>
            		<td>'.$row->contact_no.'</td>
            		<td>'.$row->e_payment.'</td>
            		<td>'.$row->type_of_benef.'</td>
            		<td>'.$row->occupation.'</td>
            		<td>'.$row->sex.'</td>
            		<td>'.$row->civil_status.'</td>
            		<td>'.$row->age.'</td>
            		<td>'.$row->monthly_income.'</td>
            		<td>'.$row->dependent.'</td>
            		<td>'.$row->wage_employment.'</td>
            		<td>'.$row->skills.'</td>
            	</tr>';
            }

        echo '</tbody>
        </table>';
	}

	public function add_bacth()
	{
		$this->batch_model->start_transaction();
		
		$city = $this->input->post("city");
		$batch_name = $this->input->post("batch_name");
		$no_of_benef = $this->input->post("no_of_benef");
		$date_of_implementation = date("Y-m-d");
		$adl = $this->input->post("adl");
		$batch_code = rand(0000,9999);
		$batch_id = 'TUPAD-ORMIN-'.date("Y-m").'-'.$batch_code;

		$data = array(
			'batch_id' 			=> 		$batch_id,
			'batch_name'		=>		$batch_name,
			'city' 				=> 		$city, 
			'no_of_benef' 		=> 		$no_of_benef,
			'implement_date' 	=> 		$date_of_implementation,
			'status' 			=> 		"NOT UPDATED",
			'active_status'		=>		"1",
			'adl'				=>		$adl,
		);
		
		$result = $this->batch_model->add_bacth($data);

		$config['upload_path']   = './upload/';
		$config['allowed_types'] = 'csv';
		$config['max_size']      = 10000;
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('csv_file')) {
			$excelfile = $this->upload->data();
			$file_path = $excelfile['full_path'];
			$csv_content = file_get_contents($file_path);
			$csv_content = utf8_encode($csv_content);
			file_put_contents($file_path, $csv_content);

			$csv = array_map('str_getcsv', file($file_path));

			foreach ($csv as $row) {

				$firstname = str_replace(' ', '_', $row[0]);
				$middlename = str_replace(' ', '_', $row[1]);
				$lastname = str_replace(' ', '_', $row[2]);
				$firstname = preg_replace('/[^A-Za-z0-9\-]/', '', $row[0]);
				$middlename = preg_replace('/[^A-Za-z0-9\-]/', '', $row[1]);
				$lastname = preg_replace('/[^A-Za-z0-9\-]/', '', $row[2]);
				$concated_name = $lastname.','.$firstname.','.$middlename;

				$data_1 = array(
					'id' => null,
					'concat_name' 		=> 	$concated_name,
					'status' 			=> 	$row[22],
					'batch_id' 			=> 	$batch_id,
					'firstname' 		=> 	$row[0],
					'middlename' 		=> 	$row[1],
					'lastname' 			=> 	$row[2],
					'extension_name'	=>	$row[3],
					'birthdate'			=>	$row[4],
					'barangay'			=>	$row[5],
					'city'				=>	$row[6],
					'province'			=>	$row[7],
					'district'			=>	$row[8],
					'type_of_id'		=>	$row[9],
					'id_number'			=>	$row[10],
					'contact_no'		=>	$row[11],
					'e_payment'			=>	$row[12],
					'type_of_benef'		=>	$row[13],
					'occupation'		=>	$row[14],
					'sex'				=>	$row[15],
					'civil_status'		=>	$row[16],
					'age'				=>	$row[17],
					'monthly_income'	=>	$row[18],
					'dependent'			=>	$row[19],
					'wage_employment'	=>	$row[20],
					'skills'			=>	$row[21],
					'active_status'		=>	"1",
				);

				$insertBenef = $this->batch_model->add_beneficiary($data_1);
			}
		}

		$transaction_status = $this->batch_model->end_transaction();

		if ($transaction_status) {

			$res = [
				'title' => 'Success!',
				'text' => 'Batch has been added successfully',
				'icon' => 'success'
			];
			echo json_encode($res);
			return;

		} else {
			$res = [
				'title' => 'Warning!',
				'text' => 'An error was occured',
				'icon' => 'error'
			];
			echo json_encode($res);
			return;
		}

	}

	public function add_brgy()
	{
		$this->batch_model->delete_officials();

		$config['upload_path']   = './upload/';
		$config['allowed_types'] = 'csv';
		$config['max_size']      = 10000;
		$this->load->library('upload', $config);

		if ($this->upload->do_upload('brgy_file')) {
			$excelfile = $this->upload->data();
			$file_path = $excelfile['full_path'];
			$csv_content = file_get_contents($file_path);
			$csv_content = utf8_encode($csv_content);
			file_put_contents($file_path, $csv_content);

			$csv = array_map('str_getcsv', file($file_path));

			foreach ($csv as $row) {
				$official_id = rand(000000,999999);
				$firstname = str_replace(' ', '_', $row[0]);
				$middlename = str_replace(' ', '_', $row[1]);
				$lastname = str_replace(' ', '_', $row[2]);
				$firstname = preg_replace('/[^A-Za-z0-9\-]/', '', $row[0]);
				$middlename = preg_replace('/[^A-Za-z0-9\-]/', '', $row[1]);
				$lastname = preg_replace('/[^A-Za-z0-9\-]/', '', $row[2]);
				$concated_name = $lastname.','.$firstname;

				$data = array(
					'id'			=>		null,	
					'official_id'	=>		$official_id,
					'concat_name'	=>		$concated_name,
					'firstname'		=>		$row[0],
					'middlename'	=>		$row[1],
					'lastname'		=>		$row[2],
					'suffix'		=>		$row[3],
					'city'			=>		$row[4],
					'barangay'		=>		$row[5],
					'province'		=>		$row[6],
					'position'		=>		$row[7]
				);

				$insertBenef = $this->batch_model->add_officials($data);
			}

			if ($insertBenef) {

				$res = [
					'title' => 'Success!',
					'text' => 'Barangay Officials has been added successfully',
					'icon' => 'success'
				];
				echo json_encode($res);
				return;

			} else {

				$res = [
					'title' => 'Warning!',
					'text' => 'An error was occured',
					'icon' => 'error'
				];
				echo json_encode($res);
				return;

			}

		} else {

			$res = [
				'title' => 'Warning!',
				'text' => 'An error was occured',
				'icon' => 'error'
			];
			echo json_encode($res);
			return;

		}
	}

	public function fetch_batch()
	{
		$batch_id = $this->input->post("batch_id");

		$result = $this->batch_model->fetch_batch($batch_id);

		if ($result) {
			$res = [
				'batch_id'			=>		$result->batch_id,
				'batch_name'		=>		$result->batch_name,
				'city'				=>		$result->city,
				'no_of_benef'		=>		$result->no_of_benef,
				'status'			=>		$result->status,
				'active_status'		=>		$result->active_status,
				'implement_date'	=>		date("Y-m-d", strtotime($result->implement_date)),
				'adl'				=>		$result->adl,
			];
			echo json_encode($res);
			return;
		}
	}

	public function edit_batch()
	{
		$batch_id = $this->input->post("batch_id");
		$city = $this->input->post("city");
		$batch_name = $this->input->post("batch_name");
		$no_of_benef = $this->input->post("no_of_benef");
		$status = $this->input->post("status");
		$active_status = $this->input->post("active_status");
		$adl = $this->input->post("adl");
		$date_uploaded = $this->input->post("date_uploaded");
		
		$data_1 = array(
			'batch_name'		=>		$batch_name,
			'city' 				=> 		$city, 
			'no_of_benef' 		=> 		$no_of_benef,
			'status' 			=> 		$status,
			'active_status' 	=> 		$active_status,
			'adl' 				=> 		$adl,
			'implement_date' 	=> 		$date_uploaded,
		);

		$data_2 = array(
			'active_status'		=>		$active_status
		);
		
		$result = $this->batch_model->edit_batch($data_1, $batch_id);
		$benef_result = $this->batch_model->edit_benef($data_2, $batch_id);

		if ($result) {
			$res = [
				'title' => 'Success!',
				'text' => 'Batch has been edited successfully',
				'icon' => 'success'
			];
			echo json_encode($res);
			return;

		} else {
			$res = [
				'title' => 'Warning!',
				'text' => 'An error was occured',
				'icon' => 'error'
			];
			echo json_encode($res);
			return;
		}
	}

	public function delete_batch()
	{
		$batch_id = $this->input->post("batch_id");

		$result['delete_batch'] = $this->batch_model->delete_batch($batch_id);
		$result['delete_benef'] = $this->batch_model->delete_benef($batch_id);

		if ($result) {
			$res = [
				'title' => 'Success!',
				'text' => 'Batch has been deleted successfully',
				'icon' => 'success'
			];
			echo json_encode($res);
			return;
		} else {

			$res = [
				'title' => 'Warning!',
				'text' => 'An error was occured',
				'icon' => 'error'
			];
			echo json_encode($res);
			return;

		}
	}

	public function month_added()
	{
		$result = $this->batch_model->month_added();
		echo "<option value=''>Select from</option>"; 
        foreach ($result as $row) {
            echo "<option value=".$row->month.">".$row->month_name."</option>";
        }
	}
}
