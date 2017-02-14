<?php

class Test extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('user_model');
    }

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
