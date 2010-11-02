<?php

class Log_Model extends Model {

	function Log_Model()
	{
	    parent::Model();
	}
	
  function log ($event_time, $event_type, $controller, $method, $info)
  {
    $this->db->insert('logs', array(  'event_time'=>$event_time,
                                      'event_type'=>$event_type,
                                      'controller'=>$controller,
                                      'method'=>$method,
                                      'info'=>$info)); 
  }
}

?>