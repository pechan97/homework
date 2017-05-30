<?php
class Ride_model extends CI_Model {

  function get_all() {
    $query = $this->db->get('rides');
	  return $query->result_array();
  }

  function insert($ride) {
    return $this->db->insert('rides', $ride);
  }

}
