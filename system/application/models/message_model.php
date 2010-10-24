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
		$this->db->insert('messages', array( 'message_id' => intval($data['message_id']),
												'user_id' => intval($data['user_id']),
												'gram_id' => intval($data['gram_id']),
												'message' => $data['message'],
												'send' => $data['send'],
												'sent' => $data['sent'],
												'response' => $data['response'],
												'response_text' => $data['response_text'])); 
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
}

?>
