<?php

	/*
		`message_id` int(11) NOT NULL AUTO_INCREMENT,
		`user_id` int(11) NOT NULL,
		`gram_id` int(11) NOT NULL,
		`message` varchar(160) NOT NULL,
		`send` datetime NOT NULL,
		`sent` datetime NOT NULL,
		`response` int(11) NOT NULL,
		`response_text` varchar(140) NOT NULL,
		PRIMARY KEY (`message_id`)
	*/
	
	class Message_Model extends Model {

		function Message_Model()
		{
			parent::Model();
		}
		
		function create_message ($data)
		{
		  // Check to see if the gram has been set to be send in this interval
		  // To avoid sending duplicate messages, user_id-gram_id-send must be UNIQUE in MySQL
			$this->db->where('user_id', $data['user_id']);
      $this->db->where('gram_id', $data['gram_id']);
      $this->db->where('send', $data['send']);
			$query = $this->db->get('messages');
	    
			$message = $query->row_array();
			if ($message && isset($message["message_id"]))
			{
			  return false;
		  }
			
			// The user/gram/send combination doesn't exist. Go ahead and queue it up.
			$this->db->insert('messages', array('user_id' => intval($data['user_id']),
												'gram_id' => intval($data['gram_id']),
												'message' => $data['message'],
												'send' => $data['send'])); 
			return $this->db->insert_id();
		}
		
		function get_message_by_message_id ($message_id)
		{
			$this->db->where('message_id', intval($message_id));
			$this->db->join('user', 'user.id = messages.user_id');
			$this->db->order_by('send');
			$query = $this->db->get('messages');
	    
			$message = $query->row_array();
			
			return $message;
		}
		
		function get_messages_by_user_id ($user_id)
		{
			$this->db->where('user_id', intval($user_id));
			$this->db->join('user', 'user.id = messages.user_id');
			$this->db->order_by('send');
			$query = $this->db->get('messages');
			$messages = array();
			foreach ($query->result_array() as $row)
			{
				$messages[] = $row;
			}
			return $messages;
		}
		
		function get_messages_by_gram_id ($gram_id)
		{
			$this->db->where('gram_id', intval($gram_id));
			$this->db->join('user', 'user.id = messages.user_id');
			$this->db->order_by('send');
			$query = $this->db->get('messages');
			$messages = array();
			foreach ($query->result_array() as $row) {
				$messages[] = $row;
			}
			return $messages;
		}

		function get_unsent_messages($end_time) {
			$this->db->where('response', 0);
			$this->db->where('sent', 0);
			$this->db->where('send <', $end_time);
			$this->db->join('user', 'user.id = messages.user_id');
			$this->db->order_by('send');
			$query = $this->db->get('messages');
			
			$messages = array();
			foreach ($query->result_array() as $row)
			{
				$messages[] = $row;
			}
			
			return $messages;
		}
		function get_unresponded_messages_by_user ($user_id) {
			$this->db->where('user_id', $user_id);
			$this->db->where('response', 0);
			$this->db->where('sent >', 0);
			$this->db->join('user', 'user.id = messages.user_id');
			$this->db->order_by('sent');
			$query = $this->db->get('messages');
			
			$messages = array();
			foreach ($query->result_array() as $row)
			{
				$messages[] = $row;
			}
			
			return $messages;
		}

    function send_message($message_id) {
      $this->db->where('message_id', intval($message_id));
      $this->db->update('messages', array('sent' => date('Y-m-d H:i:s')));
    }

		function update_message ($message_id, $data)
		{
			$this->db->where('message_id', intval($message_id));
			$this->db->update('messages', $data);
		}
		
		function delete_message ($message_id)
		{
			$this->db->where('message_id', intval($message_id));
			$this->db->delete('messages');
		}
		
		function isValidDateTime($dateTime) 
		{ 
			if (preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/", $dateTime, $matches)) { 
				if (checkdate($matches[2], $matches[3], $matches[1])) { 
					return true; 
				} 
			} 

			return false; 
		} 
	}
?>
