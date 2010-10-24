<?php

class Plan_Model extends Model {

	function Plan_Model()
	{
	    parent::Model();
	}
	
  function create_plan ($data)
  {
    log_message('error', 'create_plan '.json_encode($data));
    $this->db->insert('plans', array('user_id'=>intval($data['user_id']))); 
    $plan_id = $this->db->insert_id();
    
    return $plan_id;
  }
  
	function get_plan_by_user_id ($user_id)
	{
    $this->db->where('user_id', intval($user_id));
    $query = $this->db->get('plans');
    
    $plan = $query->row();
    
    return $plan;
  }
  
	function get_plan_by_plan_id ($plan_id)
	{
    $this->db->where('plan_id', intval($plan_id));
    $query = $this->db->get('plans');
    
    $plan = $query->row();
    
    return $plan;
  }
}

?>