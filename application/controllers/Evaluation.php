<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evaluation extends CI_Controller {

	public function __construct() {
      parent::__construct();
      $this->load->helper('url');
      $this->load->model('evaluation_model');
      $this->load->library('csvreader'); 
      // if(!$this->session->userdata('id')){ 
      //   redirect('login'); 
      // }
    }

	public function index()
	{
		$this->load->view('evaluation');
	}

	public function checkBenef($category)
	{
		$count = 1;
		$config['upload_path']   = './upload/';
        $config['allowed_types'] = 'csv';
        $config['max_size']      = 1024;
        $this->load->library('upload', $config);
        $district = $this->input->post('district');

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
                $contact_no = $row[3];

                if ($category == "TUPAD%20BENEFICIARIES") {
                    $concated_name = $lastname.','.$firstname;
                    $duplicates = $this->evaluation_model->checkBenef($concated_name, $district);
                } elseif ($category == "BARANGAY%20OFFICIALS") {
                    $concated_name = $lastname.','.$firstname;
                    $duplicates = $this->evaluation_model->checkBrgy($concated_name);
                } elseif ($category == "CONTACT%20NUMBER") {
                    $concated_name = $lastname.','.$firstname;
                    $duplicates = $this->evaluation_model->checkContact($contact_no);
                }

            	if ($duplicates > 0) {

                    if ($category == "CONTACT%20NUMBER") {
                        echo '<tr>
                            <td>'.$count++.'</td>
                            <td>'.$row[0].'</td>
                            <td>'.$row[2].'</td>
                            <td>
                                <button class="btn btn-primary" id="see_benef" value="'.$contact_no.'">
                                    <i class="icon-users"></i>
                                    See Duplicates
                                </button>
                            </td>
                        </tr>';
                    } else {
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
        }

        echo '</tbody>
        </table>';
        
	}

	public function see_benef()
	{
		$count = 1;
		$benef = $this->input->post('benef');
        $category = $this->input->post('category');

        if ($category == "TUPAD BENEFICIARIES") {
            $this->see_tupad_benef($count, $benef);
        } elseif ($category == "BARANGAY OFFICIALS") {
            $this->see_brgy_benef($count, $benef);
        } elseif ($category == "CONTACT NUMBER") {
            $this->see_duplicate_contact($count, $benef);
        }
	}

    public function see_tupad_benef($count, $benef)
    {
        $result = $this->evaluation_model->seeBenef($benef);

        echo '<table id="duplicate-benef-list" class="table custom-table">
            <thead>
                <tr>
                    <th class="align-middle text-center">Batch Name</th>
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

            foreach ($result as $row) {

                if ($row->status == "R") {
                    $senior = 'table-danger';
                } elseif ($row->status == "U") {
                    $senior = 'table-success';
                } else {
                    $senior = "";
                }

                if ($row->benef_status == "U") {
                    $status = '<span class="badge badge-pill text-white" style="background: #640D6B">UNSIGNED</span>';
                } elseif ($row->benef_status == "R") {
                    $status = '<span class="badge badge-pill badge-secondary">REPLACEMENT</span>';
                } elseif ($row->benef_status == "AA") {
                    $status = '<span class="badge badge-pill badge-warning">ALREADY AVAILED</span>';
                }else {
                    $status = "";
                }

                echo '<tr class="'.$senior.'">
                    <td class="font-weight-bold">'.strtoupper($row->batch_name).'</td>
                    <td>'.$status.'</td>
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

    public function see_brgy_benef($count, $benef)
    {
        $result = $this->evaluation_model->see_brgy_benef($benef);

        echo '<table id="duplicate-benef-list" class="table custom-table">
            <thead>
                <tr>
                    <th class="align-middle text-center">#</th>
                    <th class="align-middle text-center">First Name</th>
                    <th class="align-middle text-center">Middle Name</th>
                    <th class="align-middle text-center">Last Name</th>
                    <th class="align-middle text-center">Extension Name</th>
                    <th class="align-middle text-center">City/Municipality</th>
                    <th class="align-middle text-center">Barangay</th>
                    <th class="align-middle text-center">Position</th>
                </tr>
            </thead>
            <tbody>';

            foreach ($result as $row) {
                echo '
                <tr>
                    <td>'.$count++.'</td>
                    <td>'.$row->firstname.'</td>
                    <td>'.$row->middlename.'</td>
                    <td>'.$row->lastname.'</td>
                    <td>'.$row->suffix.'</td>
                    <td>'.$row->city.'</td>
                    <td>'.$row->barangay.'</td>
                    <td>'.$row->position.'</td>
                </tr>';
            }

        echo '</tbody>
        </table>';
    }

    public function see_duplicate_contact($count, $benef)
    {
        $result = $this->evaluation_model->see_duplicate_contact($benef);

        echo '<table id="duplicate-benef-list" class="table custom-table">
            <thead>
                <tr>
                    <th class="align-middle text-center">Batch Name</th>
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

            foreach ($result as $row) {

                if ($row->status == "R") {
                    $senior = 'table-danger';
                } elseif ($row->status == "U") {
                    $senior = 'table-success';
                } else {
                    $senior = "";
                }

                if ($row->benef_status == "U") {
                    $status = '<span class="badge badge-pill text-white" style="background: #640D6B">UNSIGNED</span>';
                } elseif ($row->benef_status == "R") {
                    $status = '<span class="badge badge-pill badge-secondary">REPLACEMENT</span>';
                } elseif ($row->benef_status == "AA") {
                    $status = '<span class="badge badge-pill badge-warning">ALREADY AVAILED</span>';
                }else {
                    $status = "";
                }

                echo '<tr class="'.$senior.'">
                    <td class="font-weight-bold">'.strtoupper($row->batch_name).'</td>
                    <td>'.$status.'</td>
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

    public function check_duplicates() {
        if ($_FILES['csv_file']['name']) {
            $path = $_FILES['csv_file']['tmp_name'];
            $csvData = $this->csvreader->parse_file($path); // Parses the CSV file

            list($duplicates, $duplicateEntries) = $this->find_duplicates($csvData);

            if (!empty($duplicates)) {
                $response = "<h5 class='mb-3'>Duplicate entries found:</h5><ol>";
                foreach ($duplicateEntries as $duplicate) {
                    $response .= "<li class='mb-1'>" . implode(" ", $duplicate) . "</li>";
                }
                $response .= "</ol>";
                echo $response;
            } else {
                echo "No duplicate entries found.";
            }
        } else {
            echo "Please upload a CSV file.";
        }
    }

    private function find_duplicates($data) {
        $seen = [];
        $duplicates = [];
        $duplicateEntries = [];

        foreach ($data as $row) {

            $row_string = implode('', array_map(function($item) {
                return preg_replace('/[^A-Za-z0-9]/', '', $item);
            }, $row));
            $key = md5($row_string);

            if (isset($seen[$key])) {
                $duplicates[] = $row;
                $duplicateEntries[] = $row;
            } else {
                $seen[$key] = true;
            }
        }

        return [$duplicates, $duplicateEntries];
    }
}
