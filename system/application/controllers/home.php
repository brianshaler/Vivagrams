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
  	$this->load->model('Plan_Model', '', TRUE);
  	$this->load->model('Gram_Model', '', TRUE);
  	
		$this->load->view('templates/header');
		if (!isValidUser())
		{
    	$data['fal'] = $this->fal_front->register();
      $this->load->view('templates/home', $data);
    } else
    {
      $plan = $this->Plan_Model->get_plan_by_user_id(getUserProperty('id'));
      echo "<pre>Plan: ".print_r($plan, true)."</pre>\n";
      $grams = $this->Gram_Model->get_grams_by_plan_id($plan["plan_id"]);
      echo "<pre>Grams: ".print_r($grams, true)."</pre>\n";
      
      $this->load->view('dashboard/main', array("grams"=>$grams));
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