<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beneficiary extends CI_Controller {

	public function __construct() {
      parent::__construct();
      $this->load->helper('url');
      $this->load->model('beneficiary_model');
      // if(!$this->session->userdata('id')){ 
      //   redirect('login'); 
      // }
    }

	public function list($batch_id)
	{
		$result = $this->beneficiary_model->getBatch($batch_id);
		$data['batch_id'] = $batch_id;
		$data['batch_name'] = $result->batch_name;
		$this->load->view('beneficiary', $data);
	}

	public function benefList()
	{
		$postData = $this->input->post();
        $result = $this->beneficiary_model->benefList($postData);
        echo json_encode($result);
	}

	public function getCity()
	{
		$id = $this->input->post("id");
		$result = $this->beneficiary_model->getCity($id);

		echo '<option value="">Choose from</option>';

		if ($result) {
			foreach ($result as $row) {
				echo '<option value="'.$row->barangay.'">'.$row->barangay.'</option>';
			}
		}
	}

	public function update_benef()
	{
		$id = $this->input->post("batch_id");
		$delete_benef = $this->beneficiary_model->delete_all_benef($id);

		$datas = array(
			'status'		=>		"UPDATED"
		);
		
		$update_status = $this->beneficiary_model->update_status($datas, $id);

		if ($delete_benef) {

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
					$lastname = str_replace(' ', '_', $row[2]);
					$firstname = preg_replace('/[^A-Za-z0-9\-]/', '', $row[0]);
					$lastname = preg_replace('/[^A-Za-z0-9\-]/', '', $row[2]);
					$concated_name = $lastname.','.$firstname;

					$data_1 = array(
						'id' => null,
						'concat_name' 		=> 	$concated_name,
						'status' 			=> 	$row[22],
						'batch_id' 			=> 	$id,
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
						'active_status'		=>	'1'
					);

					$insertBenef = $this->beneficiary_model->add_beneficiary($data_1);
				}

				if ($insertBenef) {

					$res = [
						'title' => 'Success!',
						'text' => 'List has been updated successfully',
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

	public function delete_benef()
	{
		$id = $this->input->post("id");
		$result = $this->beneficiary_model->delete_benef($id);

		if ($result) {
			$res = [
				'title' => 'Success!',
				'text' => 'Beneficiary has been deleted successfully',
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

}
