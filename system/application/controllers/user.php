<?
class User extends Controller
{
    var $errors = array();
    var $messages = array();
    
    function User()
    {
        parent::Controller();
        
        $this->load->library('FAL_front', 'fal_front');
    }
    
    function view()
    {
      $this->load->library('FAL_front', 'fal_front');
    	$this->load->model('Event_Model', '', TRUE);
    	$this->load->model('User_Model', '', TRUE);
    	$user_name = $this->uri->segment(3);
      
  	  $user = $this->User_Model->get_user_by_name($user_name);
	    
      $user_events = $this->Event_Model->get_events_by_user_id($user['id']);
      
      $contacts = $this->User_Model->get_user_contacts($user['id']);
      
      $data = array();
      $data['user'] = $user;
      $data['user_events'] = $user_events;
      $data['contacts'] = $contacts;
      $data['contact_count'] = $this->User_Model->count_contacts($user['id']);
      $data['iscontact'] = $this->User_Model->is_contact(getUserProperty('id'), $user['id']);
      
      $this->load->view('templates/header', $header_info);
  		$this->load->view('user/viewuser', $data);
  		$this->load->view('templates/footer');
    }
    
    function profile()
    {
        $this->load->library('FAL_front', 'fal_front');
    	$this->load->model('User_Model', '', TRUE);
    	$this->load->model('Tag_Model', '', TRUE);
        if (!isValidUser())
        {
            redirect($this->config->item('FAL_login_uri'), 'location');
        } else
        {
            //$this->_profile_settings();
        }
        
        $data = array();
        $data['tags'] = "";
        
        $this->load->view('templates/header');
		$this->load->view('profile', $data);
		$this->load->view('templates/footer');
    }
    
    function update()
    {
    	$this->load->model('Tag_Model', '', TRUE);
        $user_id = getUserProperty('id');
    	
        $format = "json";
        $field = $this->uri->segment(3);
        $value = $this->uri->segment(4);
        
        if ($field == "mytype")
        {
            $mytype = "";
            $types = array("developer", "designer", "support", "marketing");
        } else
        if ($field == "tags")
        {
            $tagstrs = explode(",", $value);
            $tags = array();
            
            if (count($tagstrs) > 0 && $tagstrs[0] != "")
            {
                $tags = $this->Tag_Model->get_tags_from_strs($tagstrs);
            
                for ($i=0; $i<count($tagstrs); $i++)
                {
                    $found = false;
                    for ($j=0; $j<count($tags); $j++)
                    {
                        if ($tags[$j]['tag_text'] == $this->Tag_Model->cleanTag($tagstrs[$i]))
                        {
                            $found = true;
                        }
                    }
                    if (!$found)
                    {
                        $this->Tag_Model->create_tag($tagstrs[$i]);
                    }
                }
            
                $tags = $this->Tag_Model->get_tags_from_strs($tagstrs);
            }
            
            $this->Tag_Model->set_user_tags($user_id, $tags);
            
            $output = array();
            $output["status"] = "success";
            $output["message"] = "Tags saved successfully";
            echo json_encode($output);
        }
    }
    
    function _profile_settings()
    {
        $user_id = getUserProperty('id');
        $user_name = getUserName();
        
        $header_info = array ('page_title' => 'Profile');
        $data = array();
        
        if (isset($_POST['update_profile']))
        {
            $this->_process_profile();
        } else
        if (isset($_POST['custom_email']))
        {
            $this->_process_email_settings();
        } else
        if (isset($_POST['change_password']))
        {
            $this->_change_password();
        }
        
        
        $profile = $this->freakauth_light->_getUserProfile(getUserProperty('id'));
        $profile['user_name'] = getUserProperty('user_name');
        $email_notice = explode(",", $profile['email_notice']);
        
        $data['profile'] = $profile;
        $data['email_notice'] = $email_notice;
        
        $data['topics'] = $this->Tag_Model->get_topics_with_user($user_id);
        $data['tags'] = $this->Tag_Model->get_user_tags_by_user_id($user_id);
        
        $data['errors'] = $this->errors;
        
		$this->load->view('templates/header', $header_info);
		$this->load->view('user/preferences', $data);
		$this->load->view('templates/footer');
    }
    
    function _process_profile()
    {
        $this->load->model('Userprofile');
        
        $profile = array(   'display_name' => htmlentities($this->input->post('display_name')),
                            'bio' => htmlentities($this->input->post('bio')),
                            'email' => htmlentities($this->input->post('email')),
                            'twitter' => htmlentities($this->input->post('twitter')));
        $this->Userprofile->updateUserProfile(getUserProperty('id'), $profile);
    }
    
    function _process_email_settings()
    {
        $this->load->model('Userprofile');
        
        $mytype = 
        $email_notice = array();
        $email_notice_options = array("dayof", "daybefore", "1week", "whenadded");
        
        foreach($email_notice_options as $option)
        {
            if ($this->input->post("email_" . $option) == "checked")
            {
                $email_notice[] = $option;
            }
        }
        
        $profile = array(   'email_notifications' => intval($this->input->post('email_notifications')),
                            'custom_email' => $this->input->post('custom_email', TRUE),
                            'email_notice' => implode(",", $email_notice));
        $this->Userprofile->updateUserProfile(getUserProperty('id'), $profile);
    }
    
    function _change_password()
    {
    	$this->load->model('FreakAuth_light/usermodel');
    	
    	$fail = false;
    	$old_password = $this->input->post('old_password', TRUE);
    	$password = $this->input->post('password', TRUE);
    	$password_confirm = $this->input->post('password_confirm', TRUE);
    	
  	  $user_id = getUserProperty('id');
      $user_name = getUserProperty('user_name');
  	
  	  $query = $this->usermodel->getUserByUsername($user_name);
      foreach ($query->result_array() as $row)
      {
          $user = $row;
      }
      
      if ($password != $password_confirm)
      {
          $this->errors['password_confirm'] = "Passwords didn't match.";
          $fail = true;
      }
      if ($this->freakauth_light->_encode($old_password) !== $user['password'])
      {
          $this->errors['old_password'] = "Old password incorrect.";
          $fail = true;
      }
      if (strlen($password) < 5 || strlen($password) > 25)
      {
          $this->errors['password'] = "Password must be between 5 and 25 characters.";
          $fail = true;
      }
      
      if (!$fail)
      {
          $this->usermodel->updateUser(array('id'=>$user_id), array('password'=>$this->freakauth_light->_encode($password)));
      } else
      {
          //echo "FAIL!<pre>".print_r($this->errors, true)."</pre>";
      }
    }
}
?>
