<?php

class Test extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('user_model');
////        $result = $this->user_model->get();
//        $result = $this->user_model->update(array('password'=>'rookie'), "17");
        $result= $this->user_model->insert_update(['password'=>hash('sha256', 'Morph'. SALT)],"17");
        echo '<pre>';
        print_r($result);
        echo '</pre>';
    }

    public function index(){$this->output->enable_profiler(true);}


    public function test_get() {

        $data = $this->user_model->get();
        print_r($data);

        // for debugging
        //$this->output->enable_profiler(TRUE);
    }

    public function test_insert($data = array()) {

        $result = $this->user_model->insert($data);
        return $result;

        // for debugging
        //$this->output->enable_profiler(TRUE);
    }

    public function test_update() {

        $result = $this->user_model->update(
                array('login' => 'Prince'), 4);
        print_r($result);

        // for debugging
        //$this->output->enable_profiler(TRUE);
    }

    public function test_delete() {

        $result = $this->user_model->delete(4);
        print_r($result);

        // for debugging
        //$this->output->enable_profiler(TRUE);
    }

}
