<?php 

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('login_model');
        if($this->session->userdata('id')){ 
            redirect('home'); 
        }
    }

    public function index()
    {
        $this->load->view('index');
    }

    public function auth()
    {
        $this->load->view('auth');
    }

    public function login()
    {
        $data = $this->input->post();
        $password = $this->input->post('password');

        $count = $this->login_model->count_details($data);

        if ($count > 0) {

            $row = $this->login_model->login_user($data);

            if ($row) {
                    $fetch_email = $row->email;
                    $fetch_pass = $row->password;
                    if(password_verify($password, $fetch_pass)){

                        if ($row->status == 1) {

                            $session = array(
                                'id' => $row->id,
                                'firstname' => $row->firstname,
                                'lastname' => $row->lastname,
                                'username' => $row->username,
                                'role' => $row->role,
                                'office' => $row->office,
                                'province' => $row->province,
                            );

                            $this->session->set_userdata( $session );
                            redirect('home');

                            // $code = rand(000000,999999);
                            // $insert_code = $this->login_model->insert_code($code, $fetch_email);

                            // if ($insert_code) {

                            //     $this->send_email($code, $fetch_email);

                            //     $this->session->set_flashdata('success', '
                            //     <div class="alert alert-success alert-dismissible fade show " role="alert">
                            //     <span> We have sent an OTP code to your account email - <b>'.$fetch_email.'</b> </span>
                            //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            //     <span aria-hidden="true">&times;</span>
                            //     </button>
                            //     </div>');
                            //     redirect(base_url('login/auth'));
                            // }
                        }
                        else
                        {
                            $this->session->set_flashdata('error', '
                                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                                <span> Account has been deactivated!</span>
                                <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>');
                            $this->session->set_flashdata('email', $this->input->post('email'));
                            $this->session->set_flashdata('password', $this->input->post('password'));
                            redirect(base_url('login'));
                        }

                        
                    }
                    else
                    {
                        $this->session->set_flashdata('error', '
                            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                            <span> Incorrect username or password! </span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>');
                        $this->session->set_flashdata('username', $this->input->post('username'));
                        $this->session->set_flashdata('password', $this->input->post('password'));
                        redirect(base_url('login'));
                    }
                

            }
            else
            {
                $this->session->set_flashdata('error', '
                    <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <span> Incorrect username or password! </span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
                $this->session->set_flashdata('username', $this->input->post('username'));
                $this->session->set_flashdata('password', $this->input->post('password'));
                redirect(base_url('login'));
            }

        }
        else
        {
            $this->session->set_flashdata('error', '
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <span> It looks like you are not yet a member! Contact the admin to signup.!</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            $this->session->set_flashdata('username', $this->input->post('username'));
            $this->session->set_flashdata('password', $this->input->post('password'));
            redirect(base_url('login'));
        }
    }

    public function check_otp()
    {
        $code = $this->input->post('code');
        $check_code = $this->login_model->check_code($code);
        if ($check_code > 0) {
            $row = $this->login_model->fetch_code($code);
            if ($row) {
                $upd_code = $this->login_model->update_code($code);
                if ($upd_code) {
                    $session = array(
                            'id' => $row->id,
                            'firstname' => $row->firstname,
                            'lastname' => $row->lastname,
                            'username' => $row->username,
                            'role' => $row->role,
                            'office' => $row->office,
                            'province' => $row->province,
                        );

                        $this->session->set_userdata( $session );
                        redirect('home');
                }else{
                    $this->session->set_flashdata('error', '
                    <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <span> It looks like you are not yet a member! Contact the admin to signup.!</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                    </div>');
                    $this->session->set_flashdata('email', $this->input->post('email'));
                    $this->session->set_flashdata('password', $this->input->post('password'));
                    redirect(base_url('login/auth'));
                }
            }else{
                $this->session->set_flashdata('error', '
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <span>Failed while updating code!</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                </div>');
                $this->session->set_flashdata('email', $this->input->post('email'));
                $this->session->set_flashdata('password', $this->input->post('password'));
                redirect(base_url('login/auth'));
            }
        } else {
            $this->session->set_flashdata('error', '
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <span>You have entered incorrect code!</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                </div>');
                $this->session->set_flashdata('email', $this->input->post('email'));
                $this->session->set_flashdata('password', $this->input->post('password'));
                redirect(base_url('login/auth'));
        }
    }

    public function send_email($code, $email)
    {
        // Load the email library
        $this->load->library('email');

        // Compose the email
        $this->email->from('ro4b@dole.gov.ph', 'LIVELIHOOD INFORMATION MANAGEMENT SYSTEM (LIMS)');
        $this->email->to($email);
        $this->email->subject('OTP Code');
        $this->email->message('Your OTP code is: ' . $code);
        $this->email->send();
    }

}