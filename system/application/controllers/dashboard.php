<?php

class Dashboard extends Controller {
    
	function Dashboard ()
	{
		parent::Controller();
		
		$this->load->library('FAL_front', 'fal_front');
	}
}

?>