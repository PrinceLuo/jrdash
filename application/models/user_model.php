<?php

class User_model extends CRUD_model {

    protected $_table = 'user';
    protected $_primamy_key = 'user_id';

    function __construct() {
        parent::__construct();
    }

}
