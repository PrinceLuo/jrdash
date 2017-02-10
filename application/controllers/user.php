<?php

class User extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('user_model');
    }

    public function login(){
        
        // The reason of not using the $_POST['login']
        // or $_POST['password']
        // is because 1. fix any new line \r\n
        // 2. agains XXS
        $login=$this->input->post('login', TRUE);  
        $password=$this->input->post('password', TRUE);
        $result=$this->user_model->get(array(
            'login'=>$login,
            'password'=>hash('sha256', $password.SALT)));
        $this->output->set_content_type('application_json');
        if($result){
            //print_r($result);
            $this->session->set_userdata(['user_id'=>$result[0]['user_id']]);
            
            $this->output->set_output(json_encode(['result'=>1]));
            return false;
        }
        $this->output->set_output(json_encode(['result'=>0]));
        
        //print_r($result);
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
