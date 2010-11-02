<?php

class Cronx extends Controller {
  
  var $max_sms = 25;
  
    function __construct() {
        parent::Controller();

        // Load models
        $this->load->model('Gram_Model', '', TRUE);
        $this->load->model('Message_Model', '', TRUE);
        
        $this->load->model('Log_Model', '', TRUE);
    }

    function index() {
      
    }
    
    // Create new messages from grams in last interval
    function gram() {
      
      if (!CRON || CRON !== true)
      {
        redirect(base_url(), "location");
        return;
      }
      
      $output = "";

        // Constants
        define('INTERVAL', 15); // in minutes
        define('MINUTES', 60); // seconds per minute
        define('HOURS', 3600); // seconds per hour

        // Get current time by hours/minutes/seconds
        $hour = date('G');
        $minute = date('i');
        $second = date('s');

        // Calculate current time and start time in seconds
        $time = ceil(($hour*HOURS + $minute*MINUTES + $second)/(INTERVAL*MINUTES))*(INTERVAL*MINUTES);
        $start_time = $time - INTERVAL*MINUTES;

        // Dealing with cron just past midnight -- need to add total seconds
        // from previous day to start time
        if($start_time < 0) {
            $start_time += 86400;
        }

        //$grams = $this->Gram_Model->get_grams_by_time_of_day($time-$interval*MINUTES, $time);
        $grams = $this->Gram_Model->get_grams_by_time_of_day($start_time, $time);
        
        // Need time from midnight, as gram time isn't date sensitive
        $midnight_time = strtotime(date('n/j/Y', time()));
        
        $output .= "Time of day: $hour:$minute:$second -> $start_time\n";
        $output .= "Grams for: " . date('Y-m-d H:i:s', $midnight_time+$start_time) . " - " . date('Y-m-d H:i:s', $midnight_time+$time) . "\n";
        
        $output .= "Grams to send: ".count($grams).":<br />";
        foreach($grams as $gram) {
            $gram_time_with_date = $midnight_time + $gram['time_of_day'];
            $message = $gram['message'];
            if (strlen($message) > 0 && $gram['notifications'] == 1)
            {
              if ($gram['response_type'] == "boolean")
              {
                $message = "Did you $message?";
              }
              $gram = array(  'user_id' => $gram['user_id'],
                              'message' => $message, 
                              'gram_id' => $gram['gram_id'], 
                              'send' => date('Y-m-d H:i:s', $gram_time_with_date)
                              //'send' => date('Y-m-d H:i:s')
                            );
              $this->Message_Model->create_message($gram);
            }
        }
        echo $output;
    }

    // Send unsent messages
    function message() {
      
      if (!CRON || CRON !== true)
      {
        redirect(base_url(), "location");
        return;
      }
      
      $output = "";
      
      $sent_count = 0;
        $unsent_messages = $this->Message_Model->get_unsent_messages(date('Y-m-d H:i:s'));
        //var_dump($unsent_messages);
        $users = array();
        
        foreach($unsent_messages as $message) {
          if ($sent_count >= $this->max_sms)
          {
            // We've reach the number of messages we want to send per minute
            return;
          } else
          {
            if (!isset($users[$message["user_id"]]))
            {
              $users[$message["user_id"]] = $this->Message_Model->get_unresponded_messages_by_user($message["user_id"]);
            }
            if (count($users[$message["user_id"]]) > 0)
            {
              $output .= "skipping (due to previous unresponded messages: ".$message["user_id"]."\n";
              // waiting for a response from this user
            } else
            if ($message['notifications'] == 1)
            {
              // Send to Tropo
              $user = $message['user_name'];
              $users[$message["user_id"]][] = $message;
              $this->_send_message($message['user_name'], $message['message']);
              
              $this->Message_Model->send_message($message['message_id']);
              $sent_count++;
            }
          }
        }
        echo $output;
    }
    
    function _send_message ($recipient, $message) {
      $dev = true;
      $log = array();
      
      $msg = urlencode($message['message']);
      $url = "http://api.tropo.com/1.0/sessions?action=create&token=d61d3c07322a2541ae6006f4c74900777b23d859e7aefd19e7c9141691d24f80312a5ced9ac42d688c0f1921&messageto=";
      $url .= urlencode($recipient);
      $url .= "&mynetwork=SMS&outboundmessage=";
      $url .= urlencode($message);
      
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      if ($dev)
      {
        $str = curl_exec($ch);
      } else
      {
        $str = "RESULT NOT AVAILABLE IN DEV MODE";
      }
      curl_close($ch);
      
      $log["info"] = $str;
      $log["url"] = $url;
      $log["recipient"] = $recipient;
      $log["message"] = $message;
      $this->Log_Model->log(date('Y-m-d H:i:s'), "tropo", "cron", "_send_message", json_encode($log));
    }
}

?>
