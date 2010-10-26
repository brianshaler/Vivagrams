<?php

class Stats extends Controller {
    
	function Stats()
	{
		parent::Controller();
		
		$this->load->library('FAL_front', 'fal_front');
		$this->load->helper('vivagrams');
		$this->load->helper('oauth');
	}
	
	function index()
	{
  	$this->load->model('User_Model', '', TRUE);
  	$this->load->model('Plan_Model', '', TRUE);
  	$this->load->model('Gram_Model', '', TRUE);
  	$this->load->model('Message_Model', '', TRUE);
  	
  	if (isValidUser())
  	{
  	  $user = $this->User_Model->get_user_by_id(getUserProperty('id'));
	  } else
	  {
	    redirect("", "location");
	    return;
    }
    
    $messages = $this->Message_Model->get_messages_by_user_id($user["user_id"]);
  	
		$this->load->view('templates/header', array("user"=>$user));
    $this->load->view('dashboard/stats', array("messages"=>$messages));
		$this->load->view('templates/footer');
	}
}	
?>