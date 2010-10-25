<?php

class Twitter_oauth extends Controller {
    
	function Twitter_oauth()
	{
		parent::Controller();
		
		$this->load->library('FAL_front', 'fal_front');
		$this->load->helper('vivagrams');
		$this->load->helper('oauth');
	}
	
	function index()
	{
  	$this->load->model('User_Model', '', TRUE);
  	$this->load->model('FreakAuth_light/usermodel');
  	$data = array();
  	
	  $token = get_oauth_token();
	  //echo "<pre>token: " . $token->oauth_token . "\ntoken secret: " . $token->oauth_token_secret . "</pre>\n";
	  if ($token && $token->oauth_token && $token->oauth_token_secret)
	  {
	    // stuff
      set_oauth_usertoken($token->oauth_token, $token->oauth_token_secret);
	    $user_name = "@" . get_screen_name();
	    $password = $token->oauth_token.",".$token->oauth_token_secret;
	    
	    $user = $this->User_Model->get_user_by_name($user_name);
  	  if (isset($user["user_name"]))
  	  {
  	    // update tokens in db
  	    $user = $this->User_Model->update_user_by_name($user_name, array("oauth"=>$password, 'password'=>$this->freakauth_light->_encode($password)));
  	    $_POST["user_name"] = $user_name;
  	    $_POST["password"] = $password;
  	    $data['fal'] = $this->fal_front->login();
  	    //echo "User exists<br />";
      	
	    } else
	    {
	      // create new user
	      //$user = $this->Usermodel->insertUser(array("user_name"=>$user_name, "oauth"=>$password, "role"=>"user"));
  	    $_POST["user_name"] = $user_name;
  	    $_POST["password"] = $password;
      	$data['fal'] = $this->fal_front->register();
  	    //echo "User '$user_name' does not exist<br />\n";
        //echo "<pre>" . print_r($user, true) . "</pre>\n";
      }
    }
    
    //echo "<pre>" . print_r($data, true) . "</pre>";
    
    //redirect('', 'location');
	}
	
	function test()
	{
	  $token = "6114312-5CUNdeBy0qSlTxVMFKhUtyCKJCuE0aSPAk92KywYp0";
    $tokensecret = "1d73s5Xp2UlabZeLSpHcAKDpGzrTZ2gGTC0rN33Cc";
    
    set_oauth_usertoken($token, $tokensecret);
    
    //echo get_screen_name();
  }
}

?>