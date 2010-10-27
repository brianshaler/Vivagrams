<?php

class Profile extends Controller {
    
	function Profile()
	{
		parent::Controller();
		
		$this->load->library('FAL_front', 'fal_front');
		$this->load->helper('vivagrams');
		$this->load->helper('oauth');
		$this->load->helper('form');
	}
	
	function index()
	{
        $this->load->model('User_Model', '', TRUE);
        $this->load->model('Usermodel', '', TRUE);
        $this->load->model('Userprofile', '', TRUE);

        if (isValidUser())
        {
            $user = $this->User_Model->get_user_by_id(getUserProperty('id'));
        }
        else
        {
            redirect("", "location");
            return;
        }
            
        if(!empty($_POST))
        {
            $data = array('notifications' => $this->input->post('notifications'));
            $this->Userprofile->updateUserProfile(getUserProperty('id'), $data);

            $data = array('user_name' => $this->input->post('phone'), 
            'password' => '');

        }

        //var_dump($user);
  	
        $this->load->view('templates/header', array('user' => $user));
        $this->load->view('user/profile', $user);
        $this->load->view('templates/footer');
	}
}	
?>
