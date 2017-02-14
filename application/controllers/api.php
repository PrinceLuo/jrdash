<?php

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
    
    private function _require_login(){
        $user_id = $this->session->userdata('user_id');
        
        // It will redirect to the welcome (index) page
        // to avoid anyone get into without authority
        if(($user_id = $this->session->userdata('user_id'))==false){
            $this->logout();
            $this->output->set_output(json_encode(['result'=>0, 'error'=>'You are not authorized.']));
            return false;
        }
    }

    // -------------------------------------------------------------------------
    public function login(){
        
        // The reason of not using the $_POST['login']
        // or $_POST['password']
        // is because 1. fix any new line \r\n
        // 2. agains XXS
        $login=$this->input->post('login', TRUE);  
        $password=$this->input->post('password', TRUE);
        $this->load->model('user_model');
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
    
    // -------------------------------------------------------------------------
    public function register(){      
        // The reason of not using the $_POST['login']
        // or $_POST['password']
        // is because 1. fix any new line \r\n
        // 2. agains XXS
        $this->output->set_content_type('application_json');
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
        //$confirm_password=$this->input->post('confirm_password');
        
        $this->load->model('user_model');
        $user_id=$this->user_model->insert(array(
            'login'=>$login,
            'password'=>hash('sha256',$password.SALT),
            'email'=>$email
        ));
        if($user_id){
            //print_r($result);
            $this->session->set_userdata(['user_id'=>$user_id]); 
            $this->output->set_output(json_encode(['result'=>1]));  
            return false;
        }
        $this->output->set_output(json_encode(['result'=>0, 'error'=>'Fail creating user!']));
    }
    
    // -------------------------------------------------------------------------
    public function get_todo($id=null){
        $this->_require_login();
        if($id!=null){
            $this->db->where(array(
                'todo_id'=>$id,
                'user_id'=> $this->session->userdata('user_id')
                    ));
        }else{
            $this->db->where('user_id', $this->session->userdata('user_id'));
        }
        
        $query=$this->db->get('todo');
        $result=$query->result();
        $this->output->set_output(json_encode($result));       
    }
    
    // -------------------------------------------------------------------------
    public function create_todo(){
        
        $this->_require_login();
        $this->form_validation->set_rules('content','Content','required|max_length[255]');
        if($this->form_validation->run()==false){
            $this->output->set_output(json_encode(array(
                'result'=>0,
                'error'=> $this->form_validation->error_array()
            )));
            return false;
        }
        $result=$this->db->insert('todo', array(
            'content'=> $this->input->post('content'),
            'user_id'=> $this->session->userdata('user_id')
        ));
        if($result){
            // Get the freshest for the DOM            
            $query = $this->db->get_where('todo', array(
                'todo_id'=> $this->db->insert_id()
                    // The insert ID number when performing database inserts
            ));            
            $this->output->set_output(json_encode([
                'result'=>1,
                'data'=>$query->result()
                ]));
            return false;
        }
        $this->output->set_output(json_encode(array(
            'result'=>0,
            'error'=>'Could not insert record.'
        )));           
    }
    
    // -------------------------------------------------------------------------
    public function update_todo(){
        
        // testing
        $this->_require_login();
        $todo_id= $this->input->post('todo_id');
    }
    
    // -------------------------------------------------------------------------
    public function delete_todo(){
        
        // testing
        $this->_require_login();
        $result=$this->db->delete('todo', array(
            'todo_id'=> $this->input->post('todo_id'),
            'user_id'=> $this->session->userdata('user_id')
        ));
        
//        print_r('Where?');
//        die('Testing!');
        if($result){
            $this->output->set_output(json_encode(array('result'=>1)));
            return false;
        }
        $this->output->set_output(json_encode(array(
            'result'=>0,
            'message'=>'Could not delete record.'
            )));
    }
    
    // -------------------------------------------------------------------------
    public function get_note(){}

    // -------------------------------------------------------------------------
    public function create_note(){  
        $this->_require_login();
    }
    
    // -------------------------------------------------------------------------
    public function update_note(){
        
        // testing
        $this->_require_login();
        $note_id= $this->input->post('note_id');
    }
    
    // -------------------------------------------------------------------------
    public function delete_note(){
        
        // testing
        $this->_require_login();
        $note_id= $this->input->post('note_id');
    }
    
    // -------------------------------------------------------------------------
    public function logout() {
        //session_destroy();
        $this->session->sess_destroy();
        redirect('/');
    }
}