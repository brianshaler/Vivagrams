<<<<<<< HEAD
<?php
	/*
		`gram_id` int(11) NOT NULL AUTO_INCREMENT,
		`plan_id` int(11) NOT NULL,
		`time_of_day` int(11) NOT NULL,
		`message` varchar(160) NOT NULL,
		`response_type` varchar(10) NOT NULL,
		PRIMARY KEY (`gram_id`),
		KEY `plan_id` (`plan_id`)
	*/

	class Gram_Model extends Model 
	{
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
		
		function get_grams_by_time_frame ($start_time_of_day, $end_time_of_day)
		{
			$this->db->where('time_of_day >=', intval($start_time_of_day));
			$this->db->where('time_of_day <=', intval($end_time_of_day));
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
=======
<?php
/*
	`gram_id` int(11) NOT NULL AUTO_INCREMENT,
	`plan_id` int(11) NOT NULL,
	`time_of_day` int(11) NOT NULL,
	`message` varchar(160) NOT NULL,
	`response_type` varchar(10) NOT NULL,
	PRIMARY KEY (`gram_id`),
	KEY `plan_id` (`plan_id`)
*/

class Gram_Model extends Model 
{
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
	
	function get_grams_by_time_frame ($start_time_of_day, $end_time_of_day)
	{
		$this->db->where('time_of_day >=', intval($start_time_of_day));
		$this->db->where('time_of_day <=', intval($end_time_of_day));
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
>>>>>>> 3e96c338d1e60cad7ef96fe0f345deeb0736ae5e
?>