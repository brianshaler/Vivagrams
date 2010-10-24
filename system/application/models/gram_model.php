<?php

class Gram_Model extends Model {

	function Gram_Model()
	{
	    parent::Model();
	}
	
  function create_gram ($data)
  {
    $this->db->insert('grams', array( 'plan_id'=>intval($data['plan_id']),
                                      'time_of_day'=>intval($data['time_of_day']),
                                      'message'=>$data['message'],
                                      'response_type'=>$data['response_type'])); 
    return $this->db->insert_id();
  }
	
	function get_gram_by_gram_id ($gram_id)
	{
    $this->db->where('gram_id', intval($gram_id));
    $query = $this->db->get('grams');
    
    $gram = $query->row();
    
    return $gram;
  }
  
	function get_grams_by_plan_id ($plan_id)
	{
    $this->db->where('plan_id', intval($plan_id));
    $query = $this->db->get('grams');
    
    $grams = array();
    foreach ($query->result_array() as $row)
    {
        $grams[] = $row;
    }
    
    return $grams;
  }
  
  function update_gram ($gram_id, $data)
  {
    $this->db->where('gram_id', $gram_id);
    $this->db->update('grams', $data);
  }
  
  function delete_gram ($gram_id)
  {
    $this->db->where('gram_id', $gram_id);
    $this->db->delete('grams');
  }
  
}

?>