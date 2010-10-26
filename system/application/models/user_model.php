<?php

class User_Model extends Model {
    
	function User_Model()
	{
	    parent::Model();
	}
	
	function get_user_by_name($str)
	{
    $this->db->where('user_name', $str);
    $this->db->join('user_profile', 'user.id = user_profile.id');
    $query = $this->db->get('user');
    log_message('error', "\n\n" . $this->db->last_query() . "\n\n");
    
    foreach ($query->result_array() as $row)
    {
        return prep_user($row);
    }
    
    return array();
  }
    
	function get_user_by_id($id)
	{
    $this->db->where('user.id', $id);
    $this->db->join('user_profile', 'user.id = user_profile.id');
    $query = $this->db->get('user');
    
    foreach ($query->result_array() as $row)
    {
        return prep_user($row);
    }
    
    return array();
  }
  
  function update_user_by_name ($str, $data)
  {
    $this->db->where("user_name", $str);
    $this->db->update('user', $data);
    
  }
}

?>