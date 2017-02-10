<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Home extends CI_Controller {

    public function index() {
        $this->load->view('home/inc/header_view');
        $this->load->view('home/home_view');
        $this->load->view('home/inc/footer_view');
    }

    public function test() {

        /**
         * Load the database manually
         * e.g.:
         * $this->load->database();
         * $this->db;
         * But we have autoload, we can access to the
         * db directly
         * For more information, please Google Codeigniter database
         */
        // go and check $this->db->insert();
        $this->db->insert('user', [
            'login' => 'Jenkins']);
//        
//        // go and check $this->db->update();
//        $this->db->where('user_id', 1);
//        $this->db->update('user', ['login'=>'Sammy']);
        // gp and check $this->db->delete();
//         $this->db->delete('user', array('user_id'=>2));
    }

}
