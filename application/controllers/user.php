<?php

class User extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('user_model');
    }

    public function get() {

        $data = $this->user_model->get();
        print_r($data);
        
        // for debugging
        //$this->output->enable_profiler(TRUE);
    }

    public function insert() {
        
        $result = $this->user_model->insert(
                array('login'=>'Jethro'));
        print_r($result);
        
        // for debugging
        //$this->output->enable_profiler(TRUE);
    }

    public function update() {
        
        $result = $this->user_model->update(
                array('login'=>'Prince'), 4);
        print_r($result);
        
        // for debugging
        //$this->output->enable_profiler(TRUE);
    }

    public function delete() {
        
        $result = $this->user_model->delete(4);
        print_r($result);
        
        // for debugging
        //$this->output->enable_profiler(TRUE);
    }

}
