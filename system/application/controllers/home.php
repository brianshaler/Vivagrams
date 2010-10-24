<?php

class Home extends Controller {
    
	function Home()
	{
		parent::Controller();
		
		$this->load->library('FAL_front', 'fal_front');
		$this->load->helper('vivagrams');
		$this->load->helper('oauth');
	}
	
	function index()
	{
		$this->load->view('templates/header');
		if (!isValidUser())
		{
    	$data['fal'] = $this->fal_front->register();
      $this->load->view('templates/home', $data);
    } else
    {
        $this->load->view('user/user_home');
    }
		$this->load->view('templates/footer');
	}
	
	function handler()
	{
    $req = $this->uri->uri_string();
    
    return;
    /** /
    if ($req == "/sitemap.xml" || $req == "sitemap.xml")
    {
      $this->_generate_sitemap("sitemap");
      return;
    }
    /**/
    
    header("HTTP/1.1 404 Not Found");
	  $this->load->view('templates/header');
    $this->load->view('errors/notfound');
	  $this->load->view('templates/footer');
  }
}

/* End of file home.php */
/* Location: ./system/application/controllers/home.php */