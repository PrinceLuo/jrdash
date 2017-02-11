<?php

/* *
 * You can set the file name by your own will.
 * But make sure keep the class name begins 
 * with "MY_", same as the "MY_" in the 
 * config.php (you can also change it).
 */
class MY_Form_validation extends CI_Form_validation{

    function __construct($rules=array()) {
        parent::__construct($rules);
    }

    public function error_array(){
        if(count($this->_error_array>0)){
            return $this->_error_array;
        }
    }
}
