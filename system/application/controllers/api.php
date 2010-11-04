<?
class Api extends Controller
{
    
	function Api()
	{
		parent::Controller();
		
		$this->load->library('FAL_front', 'fal_front');
		$this->load->helper('vivagrams');
		
    $this->load->model('User_Model', '', TRUE);
    $this->load->model('Plan_Model', '', TRUE);
    $this->load->model('Gram_Model', '', TRUE);
    $this->load->model('Message_Model', '', TRUE);
    
    $this->load->model('Command_Model', '', TRUE);
    $this->load->model('Log_Model', '', TRUE);
    
    $this->load->model('Userprofile', '', TRUE);
	}
	
  function response()
  {
    $sender = $this->uri->segment(3);
    $msg = getvar("msg", "");
    $medium = "";
    
    $log = array();
    $log["input"] = $_SERVER['REQUEST_URI'];
    
    // See if sender is just numbers
    if (strlen($sender) == strlen(digitsonly($sender)))
    {
      $sender = digitsonly($sender);
      if (strlen($sender) == 11 && $sender{0} == "1")
      {
        // Drop the leading 1 if included
        $sender = substr($sender, 1);
      }
      if (strlen($sender) == 10)
      {
        // We're sure this looks like a U.S. phone number
        $medium = "SMS";
      }
    }
    // See if sender is a phone number
    // .... eventually
    
    // Move on as long as we've made sense of the sender
    if ($medium != "")
    {
      $user = $this->User_Model->get_user_by_name($sender);
      if (empty($user) || !isset($user["user_id"]) || !($user["user_id"] > 0))
      {
        $log["error"] = "User not found: $sender";
        $user = array("user_id"=>-1);
      } else
      {
        // Load basic commands
        $global_commands = $this->Command_Model->get_commands_by_user_id(0);
        // Load user commands
        //$my_commands = $this->Command_Model->get_commands_by_user_id($user["user_id"]);
        
        // If it's a command, we'll put it here
        $command = array();
        
        $first = "";
        $i = 0;
        $newmsg = "";
        // pull out the first alphabetical string
        while ($i < strlen($msg) && preg_match("/[a-z]/i", $msg{$i}))
        {
          $first .= strtolower($msg{$i});
          $i++;
        }
        // Copy remaining to new message var. If $first is a command, the rest is the new message
        while ($i < strlen($msg))
        {
          $newmsg .= $msg{$i};
          $i++;
        }
        
        foreach ($global_commands as $cmd)
        {
          if ($cmd["command"] == $first)
          {
            $command = $cmd;
          }
        }
        
        // If $command was filled, let's process the command
        if (!empty($command))
        {
          $msg = $newmsg;
          $this->run_command($user, $command["action"], $msg);
        } else
        {
          // Respond to a message, if we're awaiting a response
          $messages = $this->Message_Model->get_unresponded_messages_by_user($user["user_id"]);
          if (count($messages) > 0)
          {
            $this->Message_Model->update_message($messages[0]["message_id"], array("response"=>date("Y-m-d H:i:s"), "response_text"=>$msg));
          }
        }
      }
    }
    $m = "Message from " . $sender . ": " . $msg;
    echo $m;
    $log["sender"] = $sender;
    $log["msg"] = $msg;
    $log["medium"] = $medium;
    $log["user"] = $user["user_id"];
    $this->Log_Model->log(date('Y-m-d H:i:s'), (isset($log["error"]) ? "error" : "status"), "api", "response", json_encode($log));
  }
  
	function get()
	{
    $action = strtolower($this->uri->segment(3));
    
    $fail = json_encode(array("message"=>"failed"));
    
    // TIME
    $year = intval(getvar('year', intval(date('Y', time()))));
    $month = intval(getvar('month', intval(date('n', time()))));
    $day = intval(getvar('day', intval(date('j', time()))));
    $starttime = getvar('starttime', '');
    
    if ($starttime != '')
    {
        $starttime = strtotime($starttime);
    }
    $endtime = getvar('starttime', '');
    if ($endtime != '')
    {
        $endtime = strtotime($endtime);
    }
    
    // FILTER
    // $example = getvar('example', '');
    
    // STRUCTURE
    $format = strtolower(getvar('format', 'json'));
    $callback = getvar('callback', '');
    
    if ($action == "grams")
    {
      // get grams by user
      if (isValidUser())
      {
        // currently authenticated user by browser session
        $user_id = getUserProperty('id');
        $plan = $this->Plan_Model->get_plan_by_user_id($user_id);
        $grams = $this->Gram_Model->get_grams_by_plan_id($plan["plan_id"]);
        
        foreach ($grams as $k => $gram)
        {
          $grams[$k] = $this->_public_gram($gram);
        }
        
        $str = "[]";
        if (count($grams) > 1)
        {
          $str = json_encode($grams);
        } else
        if (count($grams) == 1)
        {
          $str = "[" . json_encode($grams) . "]";
        }
        echo $str;
        return;
      } else
      {
        // later we can support authentication
        
      }
      return $fail;
    } else
    if ($action == "responses")
    {
      // get responses by user
      if (isValidUser())
      {
        // currently authenticated user by browser session
        $user_id = getUserProperty('id');
        $messages = $this->Message_Model->get_responded_messages_by_user($user_id);
        
        foreach ($messages as $k => $message)
        {
          $messages[$k] = $this->_public_message($message);
        }
        
        $str = "[]";
        if (count($messages) > 1)
        {
          $str = json_encode($messages);
        } else
        if (count($messages) == 1)
        {
          $str = "[" . json_encode($messages) . "]";
        }
        echo $str;
        return;
      } else
      {
        // not logged in
      }
    } else
    {
      if ($action == "responses_by_gram")
      {
        // get responses by user
        if (isValidUser())
        {
          // currently authenticated user by browser session
          $user_id = getUserProperty('id');
          $plan = $this->Plan_Model->get_plan_by_user_id($user_id);
          $grams = $this->Gram_Model->get_grams_by_plan_id($plan["plan_id"]);
          $messages = $this->Message_Model->get_responded_messages_by_user($user_id);
          
          $newgrams = array();
          foreach ($grams as $k => $gram)
          {
            $gram = $this->_public_gram($gram);
            $newgrams[$gram["gram_id"]] = $gram;
            $newgrams[$gram["gram_id"]]["messages"] = array();
          }
          $grams = $newgrams;
          foreach ($messages as $k => $message)
          {
            $message = $this->_public_message($message);
            if (isset($grams[$message["gram_id"]]["messages"]))
            {
              $grams[$message["gram_id"]]["messages"][] = $message;
            }
          }

          $str = "[]";
          if (count($grams) > 1)
          {
            $str = json_encode($grams);
          } else
          if (count($grams) == 1)
          {
            $str = "[" . json_encode($grams) . "]";
          }
          echo $str;
          return;
        }
      } else
      {
        
      }
      return $fail;
    }
  }
  
  function gram ()
  {
    $action = strtolower($this->uri->segment(3));
    $target = $this->uri->segment(4);
    $fail = json_encode(array("message"=>"failed"));
    
    if ($action == "create")
    {
      // /api/gram/create/$response_type
      if (strtolower($target) == "amount")
      {
        $response_type = "amount";
      } else
      {
        $response_type = "boolean";
      }
      $resolution = 15;
      $plan = $this->Plan_Model->get_plan_by_user_id(getUserProperty('id'));
      $gram = array(  "plan_id"=>$plan["plan_id"], 
                      "time_of_day"=>floor((time()-strtotime(date("n/j/Y", time())))/$resolution)*$resolution, 
                      "message"=>"", 
                      "response_type"=>$response_type);
      
      $gram_id = $this->Gram_Model->create_gram($gram);
      $gram = $this->Gram_Model->get_gram_by_gram_id($gram_id);
      
      echo $this->load->view('widgets/editgram', array("gram"=>$gram), true);
    } else
    if ($action == "update")
    {
      // /api/gram/update/$gram_id
      $gram_id = intval($target);
      $gram = $this->Gram_Model->get_gram_by_gram_id($gram_id);
      $plan = $this->Plan_Model->get_plan_by_plan_id($gram["plan_id"]);
      if ($plan["user_id"] == getUserProperty('id'))
      {
        $today = strtotime(date("n/j/Y", time()));
        $time_of_day = strtotime(date("n/j/Y ", time()) . $this->input->post("time_of_day"));
        $time_of_day -= $today;
        $message = $this->input->post("message");
        
        $this->Gram_Model->update_gram($gram_id, array("message"=>$message, "time_of_day"=>$time_of_day));
        
        echo json_encode(array("message"=>"success"));
        return;
      }
      echo $fail;
    } else
    if ($action == "delete")
    {
      // /api/gram/delete/$gram_id
      $gram_id = intval($target);
      $gram = $this->Gram_Model->get_gram_by_gram_id($gram_id);
      $plan = $this->Plan_Model->get_plan_by_plan_id($gram["plan_id"]);
      if ($plan["user_id"] == getUserProperty('id'))
      {
        $this->Gram_Model->delete_gram($gram_id);
      }
    }
  }
  
  function user ()
  {
    $action = strtolower($this->uri->segment(3));
    $target = $this->uri->segment(4);
    $fail = json_encode(array("message"=>"failed"));
    
    // UNAUTHENTICATED API ENDPOINTS
    
    if (!isValidUser())
    {
      $fail = json_encode(array("message"=>"Must be logged in to do that."));
      echo $fail;
      return;
    }
    
    // AUTHENTICATED API ENDPOINTS
    
    if ($action == "dismiss_welcome")
    {
      $profile_data = array("welcome_message_seen"=>1);
      $this->Userprofile->updateUserProfile(getUserProperty('id'), $profile_data);
      echo json_encode(array("message"=>"success"));
      return;
    }
  }
  
  function run_command ($user, $action, $content)
  {
    //echo "run_command: ".$user["user_id"].", $action, $content<br />";
    if ($action == "confirm")
    {
      // GO = phone number confirmation
      $this->Userprofile->updateUserProfile($user["user_id"], array("confirmed_number"=>1));
    } else
    if ($action == "notifications:on")
    {
      // Turn notifications on, if the number is confirmed (?)
      if ($user["confirmed_number"] == 1)
      {
        $this->Userprofile->updateUserProfile($user["user_id"], array("notifications"=>1));
      } else
      {
        // Well, maybe "on" should be synonymous with "go"....
      }
    } else
    if ($action == "notifications:off")
    {
      // Turn notifications off
      $this->Userprofile->updateUserProfile($user["user_id"], array("notifications"=>0));
    } else
    if ($action == "skip")
    {
      // Skip current question
      $messages = $this->Message_Model->get_unresponded_messages_by_user($user["user_id"]);
      if (count($messages) > 0)
      {
        $data = array(  "response"=>date("Y-m-d H:i:s"),
                        "response_text"=>"skip"
                        );
        $this->Message_Model->update_message($messages[0]["message_id"], $data);
      }
    } else
    if ($action == "undo")
    {
      // Delete the last response from the user and resend the question
      $messages = $this->Message_Model->get_responded_messages_by_user($user["user_id"]);
      if (count($messages) > 0)
      {
        $data = array(  "response"=>"0000-00-00 00:00:00",
                        "response_text"=>"",
                        "sent"=>"0000-00-00 00:00:00"
                        );
        $this->Message_Model->update_message($messages[count($messages)-1]["message_id"], $data);
      }
    } else
    if ($action == "help")
    {
      // Send a help message to the user
    }
  }
  
  function _public_gram ($orig_gram)
  {
    $gram = array();
    $allowed_fields = array("gram_id", "plan_id", "user_id", "time_of_day", "message", "response_type");
    foreach ($allowed_fields as $field)
    {
      $gram[$field] = $orig_gram[$field];
    }
    return $gram;
  }
  
  function _public_message ($orig_message)
  {
    $message = array();
    $allowed_fields = array("message_id", "user_id", "gram_id", "message", "response", "response_text");
    foreach ($allowed_fields as $field)
    {
      $message[$field] = $orig_message[$field];
    }
    return $message;
  }
}

?>