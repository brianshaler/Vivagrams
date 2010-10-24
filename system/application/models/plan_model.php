<?php

class Plan_Model extends Model {

	function Plan_Model()
	{
	    parent::Model();
	}
	
	function get_plan_by_user_id ($user_id)
	{
    $this->db->where('user_id', $user_id);
    $query = $this->db->get('activity');
    
    $plan = $query->row();
    
    return $plan;
  }
  
  function create_plan ($data)
  {
    $this->db->insert('plan', array('user_id'=>$data['user_id'])); 
    return $this->db->insert_id();
  }
}

?>