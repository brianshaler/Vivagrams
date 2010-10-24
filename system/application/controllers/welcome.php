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
    		$this->load->view('pages/header');
            $this->load->view('pages/welcome');
    		$this->load->view('pages/footer');
		} else
		{
		    redirect('', 'location');
	    }
	}
}

?>