<?php
class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        if (!$this->session->userdata('user')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $this->load->view('product/create');
    }
}
