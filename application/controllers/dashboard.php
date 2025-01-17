<?php

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $user_id = $this->session->userdata('user_id');

        // It will redirect to the welcome (index) page
        // to avoid anyone get into without authority
        if (!$user_id) {
            $this->logout();
        }
    }

    // -------------------------------------------------------------------------
    public function index() {
        $this->load->view('dashboard/inc/header_view');
        $this->load->view('dashboard/dashboard_view');
        $this->load->view('dashboard/inc/footer_view');
    }

    // -------------------------------------------------------------------------
    public function logout() {
        //session_destroy();
        $this->session->sess_destroy();
        redirect('/');
    }

}
