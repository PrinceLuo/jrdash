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
    public function register(){      
        // The reason of not using the $_POST['login']
        // or $_POST['password']
        // is because 1. fix any new line \r\n
        // 2. agains XXS
        $this->form_validation->set_rules('login','Login','required|min_length[4]|max_length[16]|is_unique[user.login]');
        $this->form_validation->set_rules('email','Email','required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('password','Password','required|min_length[4]|max_length[16]|matches[confirm_password]');
    
        // Try it funny~~
        //$this->form_validation->set_message('required','Only the dog knows!');      
        if($this->form_validation->run()==false){
            //echo validation_errors();
            $this->output->set_output(json_encode(['result'=>0, 'error'=>$this->form_validation->error_array()]));
            return false;
        }
        $login=$this->input->post('login');  
        $email=$this->input->post('email');  
        $password=$this->input->post('password');
        $confirm_password=$this->input->post('confirm_password');
        $user_id=$this->user_model->insert(array(
            'login'=>$login,
            'password'=>hash('sha256',$password.SALT),
            'email'=>$email
        ));
        
        $this->output->set_content_type('application_json');
        if($user_id){
            //print_r($result);
            $this->session->set_userdata(['user_id'=>$user_id]);
            
            $this->output->set_output(json_encode(['result'=>1]));
            
            return false;
        }
        $this->output->set_output(json_encode(['result'=>0, 'error'=>'Fail creating user!']));
        
        //print_r($result);
    }

        public function get() {

        $data = $this->user_model->get();
        print_r($data);
        
        // for debugging
        //$this->output->enable_profiler(TRUE);
    }

    public function insert($data=array()) {
        
        $result = $this->user_model->insert($data);
        return $result;
        
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
