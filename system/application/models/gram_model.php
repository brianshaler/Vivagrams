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
		
		function create_default_grams ($user_id, $plan_id)
		{
		  $minute = 60;
		  $hour = 3600;
		  $grams = array( array("How many hours of sleep did you get?",     7*$hour + 30*$minute, "amount"),
		                  array("Did you eat a healthy breakfast?",         8*$hour + 0*$minute, "boolean"),
		                  array("On a scale of 1-10, how do you feel?",     8*$hour + 30*$minute, "amount"),
		                  array("Did you excercise this morning?",          9*$hour + 0*$minute, "boolean"),
		                  array("Did you eat a healthy lunch?",             12*$hour + 30*$minute, "boolean"),
		                  array("On a scale of 1-10, how do you feel?",     2*$hour + 30*$minute, "amount"),
		                  array("Did you eat a healthy dinner?",            6*$hour + 30*$minute, "boolean"),
		                  array("On a scale of 1-10, how do you feel?",     7*$hour + 0*$minute, "amount"),
		                  array("How many pushups can you do?",             8*$hour + 30*$minute, "amount"),
		                  array("How much do you weigh?",                   9*$hour + 0*$minute, "amount")
		    );
		  foreach ($grams as $gram)
		  {
		    $this->create_gram(array(   "user_id"=>$user_id,
		                                "plan_id"=>$plan_id,
		                                "message"=>$gram[0],
		                                "time_of_day"=>$gram[1],
		                                "response_type"=>$gram[2]
		                              ));
	    }
	  }
		
		function get_gram_by_gram_id ($gram_id)
		{
			$this->db->where('gram_id', intval($gram_id));
			$this->db->join('plans', 'plans.plan_id = grams.plan_id');
			
			$this->db->order_by('time_of_day');
			
			$query = $this->db->get('grams');
			
			$gram = $query->row_array();
			
			return $gram;
		}
		  
		function get_grams_by_plan_id ($plan_id)
		{
			$this->db->where('grams.plan_id', intval($plan_id));
			$this->db->join('plans', 'plans.plan_id = grams.plan_id');
			
			$this->db->order_by('time_of_day', 'asc');
			
			$query = $this->db->get('grams');
			
			$grams = array();
			foreach ($query->result_array() as $row)
			{
				$grams[] = $row;
			}
			
			return $grams;
		}
		
		function get_grams_by_time_of_day ($start_time_of_day, $end_time_of_day)
		{
			$this->db->where('time_of_day >=', intval($start_time_of_day));
			$this->db->where('time_of_day <', intval($end_time_of_day));
			$this->db->join('plans', 'plans.plan_id = grams.plan_id');
			
			$this->db->order_by('time_of_day');
			
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
