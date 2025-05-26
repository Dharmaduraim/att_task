<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(['form', 'url']);
        $this->load->model('User_model');
    }
// Function:1 login view
    public function login() {
        $this->load->view('auth/login');
    }
// Function:2 login form submit
    public function do_login() {
    $this->load->library('form_validation');
    // Set validation rules
    $this->form_validation->set_rules('username', 'Username', 'required|trim');
    $this->form_validation->set_rules('password', 'Password', 'required|trim');

    if ($this->form_validation->run() == FALSE) {
        $this->load->view('auth/login');

    } else {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $user = $this->User_model->get_user($username, $password);
       $this->db->last_query();
        if ($user) {
            $this->session->set_userdata('user', $user);
            redirect('product');
        } else {
            $this->session->set_flashdata('error', 'Invalid login credentials.');
            redirect('auth/login');
        }
    }
}
// Function:3 user logout
    public function logout() {
        $this->session->unset_userdata('user');
        redirect('auth/login');
    }
}
