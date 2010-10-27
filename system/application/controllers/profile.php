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
            $profile_data = array('notifications' => $this->input->post('notifications'));
            $user_data = array('user_name' => $this->input->post('phone'));
            if(!empty($_POST['password']))
            {
                $user_data['password'] = $this->freakauth_light->_encode($this->input->post('password'));
            }
            $this->Userprofile->updateUserProfile(getUserProperty('id'), $profile_data);
            $this->User_Model->update_user_by_id(getUserProperty('id'), $user_data);
            redirect('/profile');
        }

        $this->load->view('templates/header', $user);
        $this->load->view('user/profile', $user);
        $this->load->view('templates/footer');
	}
}	
?>
