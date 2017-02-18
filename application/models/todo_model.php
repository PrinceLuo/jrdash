<?php

class Todo_model extends CRUD_model {

    protected $_table = 'todo';
    protected $_primamy_key = 'todo_id';

    function __construct() {
        parent::__construct();
    }

}
