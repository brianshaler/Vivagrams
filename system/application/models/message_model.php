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
			$this->db->insert('messages', array('user_id' => intval($data['user_id']),
												'gram_id' => intval($data['gram_id']),
												'message' => $data['message'],
												'send' => $data['send'],
												'sent' => $data['sent'])); 
			return $this->db->insert_id();
		}
		
		function get_message_by_message_id ($message_id)
		{
			$this->db->where('message_id', intval($message_id));
			$query = $this->db->get('messages');
			$message = $query->row();
			
			return $message;
		}
		
		function get_messages_by_user_id ($user_id)
		{
			$this->db->where('user_id', intval($user_id));
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
			$query = $this->db->get('messages');
			$messages = array();
			foreach ($query->result_array() as $row) {
				$messages[] = $row;
			}
			return $messages;
		}

		function get_unsent_messages_by_send_int_time ($start_send_int_time, $end_send_int_time)
		{
			$this->db->where('send >=', intval($start_send_int_time));
			$this->db->where('send <', intval($end_send_int_time));
			$this->db->where('sent', 0);
			$query = $this->db->get('messages');
			$messages = array();
			foreach ($query->result_array() as $row)
			{
				$messages[] = $row;
			}
			
			return $messages;
		}
		
		function update_message ($message_id, $data)
		{
			$this->db->where('message_id', intval($message_id));
			$this->db->update('messages', $data);
		}
		
		function delete_message ($message_id)
		{
			$this->db->where('message_id', intval($message_id));
			$this->db->where('messages');
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
