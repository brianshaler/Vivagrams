<?php

class Comingsoon extends Controller {
    
	function Comingsoon()
	{
		parent::Controller();
		
		$this->load->library('FAL_front', 'fal_front');
		$this->load->helper('vivagrams');
		$this->load->helper('oauth');
	}
	
	function twitter_oauth ()
	{
    $this->load->view('templates/header');
    $this->load->view('comingsoon/twitter_oauth');
    $this->load->view('templates/footer');
  }
  
  function iphone_app ()
  {
    $this->load->view('templates/header');
    $this->load->view('comingsoon/iphone_app');
    $this->load->view('templates/footer');
  }
}

?>