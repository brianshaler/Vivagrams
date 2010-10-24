<?php
/**
 * Auth Controller Class
 *
 * Security controller that provides functionality to handle logins, logout, registration
 * and forgotten password requests.  
 * It also can verify the logged in status of a user and his permissions.
 *
 * The class requires the use of the DB_Session and FreakAuth libraries.
 *
 * @package     FreakAuth_light
 * @subpackage  Controllers
 * @category    Authentication
 * @author      Daniel Vecchiato (danfreak)
 * @copyright   Copyright (c) 2007, 4webby.com
 * @license		http://www.gnu.org/licenses/lgpl.html
 * @link 		http://4webby.com/freakAuth
 * @version 	1.1
 *
 */

class Sessions extends Controller
{	
	/**
	 * Initialises the controller
	 *
	 * @return Auth
	 */
    function Sessions()
    {
        parent::Controller();
        
        $this->load->library('FAL_front', 'fal_front');
    		$this->load->helper('vivagrams');
    		$this->load->helper('oauth');
    }
    
    function twitter_oauth ()
    {
      redirect(oauth_url(), 'location');
    }
	
    // --------------------------------------------------------------------
	
    /**
     * Displays the login form.
     *
     */
    function index()
    {	    	
    	$this->login();    
    }
    
    // --------------------------------------------------------------------
    
	/**
     * Displays the login form.
     *
     */
    function login()
    {	    	
    	$data['fal'] = $this->fal_front->login();
    	
    	redirect('', 'location');
    	
    	$this->load->view('templates/header', $data);
    	$this->load->view('forms/login', $data);
    	$this->load->view('templates/footer', $data);
    }
    function first_login()
    {	    	
    	$data['fal'] = $this->fal_front->login();
    	$data['message'] = "You have successfully registered! Go ahead and log in!";
    	
    	redirect('', 'location');
    	
    	$this->load->view('templates/header', $data);
    	$this->load->view('forms/login', $data);
    	$this->load->view('templates/footer', $data);
    }

    // --------------------------------------------------------------------
    
    /**
     * Handles the logout action.
     *
     */
    function logout()
    {
        $this->fal_front->logout();
    }
    
	// --------------------------------------------------------------------
	
    /**
     * Handles the post from the registration form.
     *
     */
    
    function register()
    {	        
    	$data['fal'] = $this->fal_front->register();
    	
    	redirect('', 'location');
    	
    	$this->load->view('templates/header', $data);
    	$this->load->view('forms/register', $data);
    	$this->load->view('templates/footer', $data);
    }
    
    function register_ajax()
    {
      $success = $this->fal_front->register(true);
      
      if ($success)
      {
        echo json_encode(array("message"=>"success"));
      } else
      {
        echo json_encode(array("message"=>"failed"));
      }
    }
    
    // --------------------------------------------------------------------
    
    /**
     * Handles the user activation.
     *
     */
    function activation()
    {	
		$data['fal'] = $this->fal_front->activation();
		$this->load->view($this->_container, $data); 
    }
    
	// --------------------------------------------------------------------
	
    /**
     * Handles the post from the forgotten password form.
     *
     */
    function forgotten_password()
    {	
    	$data['fal'] = $this->fal_front->forgotten_password();
    	
    	$this->load->view('templates/header', $data);
    	$this->load->view('forgotten_password', $data);
    	$this->load->view('templates/footer', $data);
    }
    
	// --------------------------------------------------------------------
	
    /**
     * Displays the forgotten password reset.
     *
     */
    function forgotten_password_reset()
    {	
       $data['heading'] = $this->lang->line('FAL_forgotten_password_label');
       $data['fal'] = $this->fal_front->forgotten_password_reset();
	   $this->load->view($this->_container, $data);      
    }

    
    // --------------------------------------------------------------------
    
    /**
     * Function that handles the change password procedure
     * needed to let the user set the password he wants after the
     * forgotten_password_reset() procedure
     *
     */
    function changepassword()
    {
       $data['heading'] = $this->lang->line('FAL_change_password_label');
       $data['fal'] = $this->fal_front->changepassword();
	   $this->load->view($this->_container, $data);     
    }
}
?>