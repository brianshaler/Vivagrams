<?php

class Welcome extends Controller {
    
	function Welcome()
	{
		parent::Controller();
		
		$this->load->library('FAL_front', 'fal_front');
	}
	
	function index()
	{
		if (isValidUser())
		{
    		$this->load->view('templates/header');
            $this->load->view('templates/welcome');
    		$this->load->view('templates/footer');
		} else
		{
		    redirect('', 'location');
	    }
	}
}

?>