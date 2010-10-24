<?php

class User_Model extends Model {
    
	function User_Model()
	{
	    parent::Model();
	}
	
	function get_user_by_name($str)
	{
	    $this->db->where('user_name', $str);
	    $this->db->join('fa_user_profile', 'fa_user.id = fa_user_profile.id');
        $query = $this->db->get('fa_user');
        
        foreach ($query->result_array() as $row)
        {
            return $row;
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
            return $row;
        }
        
        return array();
    }
}

?>