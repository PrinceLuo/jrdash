<?php

class CRUD_model extends CI_Model {

    protected $_table = null;
    protected $_primamy_key = null;

    function __construct() {
        parent::__construct();
    }

    // -------------------------------------------------------------------------
    // -------------------------------------------------------------------------

    /**
     * @usage :
     * Single: $this->user_model-> get(2)     
     * All:    $this->user_model->get();
     * Custom: $this->user_model-> get(array('any'=>'param'))
     * 
     * @param number $user_id
     */
    public function get($id = null, $order_by = null) {
//        if($id==null){
//            $q = $this->db->get();
//        }
        // Someone may type get("2")
        if (is_numeric($id)) {
            $this->db->where($this->_primamy_key, $id);
        }
        if (is_array($id)) {
            foreach ($id as $key => $value) {
                $this->db->where($key, $value);
            }
        }

        $q = $this->db->get($this->_table);
        return $q->result_array();
    }

    // -------------------------------------------------------------------------
    /**
     * @usage $result = $this->user_model->insert array('login'=>'Jethro'));
     * 
     * @param array $data
     * @return type
     */
    public function insert($data = array()) {

        $this->db->insert($this->_table, $data);
        return $this->db->insert_id();
    }

    // -------------------------------------------------------------------------
    /**
     * @usage $result = $this->whatever_model->update(
      array('login'=>'Prince'), 4);
     * $this->whatever_model->update(['login'=>'Ted'], ['date_created]);
     * @param array $new_data
     * @param number $where
     * @return type
     */
    public function update($new_data, $where) {

        if (is_numeric($where)) {
            $this->db->where($this->_primamy_key, $where);
        } elseif (is_array($where)) {
            foreach ($where as $key => $value) {
                $this->db->where($key, $value);
            }
        } else {
            die('You must pass a second parameter to the UPDATE() method.');
        }
        //$this->db->where(array('user_id' => $user_id));
        $this->db->update($this->_table, $new_data);
        return $this->db->affected_rows();
    }

    // -------------------------------------------------------------------------
    /*     *
     * @usage
     * @param 
     */
    public function insert_update($data, $id = false) {

        if (!$id) {
            die('You must pass a second parameter to the insert_update() method.');
        }
        $this->db->select($this->_primamy_key);
        $this->db->where($this->_primamy_key, $id);

        $q = $this->db->get($this->_table);
        $result = $q->num_rows();
        echo $result;
        if ($result == 0) {
            // insert// update
            echo 'INSERT!';
            return $this->insert($data);
        }
        // update
        echo 'UPDATE!';
        return $this->update($data, $id);
    }

    // -------------------------------------------------------------------------
    /**
     * @usage $result = $this->user_model->delete(number);
     *                  $this->whatever_model->delete(array('any'=>'param'));
     * @param number $id
     * @return type
     */
    public function delete($id = null) {

        if (is_numeric($id)) {
            // where statement
            $this->db->where($this->_primamy_key, $id);
        } else if (is_array($id)) {
            // where statement
            foreach ($id as $key => $value) {
                $this->db->where($key, $value);
            }
        } else { // if no param, it will delete the whole table
            die('You must pass a parameter to the DELETE() method.');
        }


        $this->db->delete($this->_table);
        return $this->db->affected_rows();
    }

}
