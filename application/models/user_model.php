<?php

class User_model extends CI_Model {

    /**
     * @usage :
     * Single: $this->user_model-> get(2)
     * Multiple: $this->user_model-> get(array())
     * All:    $this->user_model->get();
     * 
     * @param number $user_id
     */
    public function get($user_id = null) {
        if ($user_id === null) {
            $q = $this->db->get('user');
        } elseif(is_array($user_id)){ // now input an array
            $q = $this->db->get_where('user', $user_id);
        }else { // now input one specific number
            $q = $this->db->get_where('user', array('user_id' => $user_id));
        }
        return $q->result_array();
    }

    /**
     * @usage $result = $this->user_model->insert array('login'=>'Jethro'));
     * 
     * @param array $data
     * @return type
     */
    public function insert($data=array()) {

        $this->db->insert('user', $data);
        return $this->db->insert_id();
    }

    /**
     * @usage $result = $this->user_model->update(
      array('login'=>'Prince'), 4);
     * @param array $data
     * @param number $user_id
     * @return type
     */
    public function update($data, $user_id) {

        $this->db->where(array('user_id' => $user_id));
        $this->db->update('user', $data);
        return $this->db->affected_rows();
    }

    /**
     * @usage $result = $this->user_model->delete(number);
     * @param number $user_id
     * @return type
     */
    public function delete($user_id) {

        $this->db->delete('user', array('user_id' => $user_id));
        return $this->db->affected_rows();
    }

}
