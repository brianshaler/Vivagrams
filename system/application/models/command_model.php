<?php

class Command_Model extends Model {

	function Command_Model()
	{
	    parent::Model();
	}
	
  function create_command ($user_id, $cmd, $action)
  {
    if ($user_id > 0)
    {
      $this->db->insert('commands', array(  'user_id'=>intval($data['user_id']),
                                            'command'=>$cmd,
                                            'action'=>$action)); 
    }
  }
  
	function get_commands_by_user_id ($user_id)
	{
    $this->db->where('user_id', intval($user_id));
    $query = $this->db->get('commands');
    
		$commands = array();
		foreach ($query->result_array() as $row)
		{
			$commands[] = $row;
		}
    
    return $commands;
  }
  
	function get_command_by_user_command ($user_id, $command)
	{
    $this->db->where('user_id', $user_id);
    $this->db->where('command', $command);
    $query = $this->db->get('commands');
    
    $command = $query->row_array();
    
    return $command;
  }
}

?>