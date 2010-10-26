<?php

class Cronx extends Controller {
  
  var $max_sms = 1;
  
    function __construct() {
        parent::Controller();

        // Load models
        $this->load->model('Gram_Model', '', TRUE);
        $this->load->model('Message_Model', '', TRUE);
    }

    function index() {
      
    }
    
    // Create new messages from grams in last interval
    function gram() {

        // Constants
        define('INTERVAL', 15); // in minutes
        define('MINUTES', 60); // seconds per minute
        define('HOURS', 3600); // seconds per hour

        // Get current time by hours/minutes/seconds
        $hour = date('G'); //8*HOURS;
        $minute = date('i'); //8*HOURS;
        $second = date('s'); //8*HOURS;

        // Calculate current time and start time in seconds
        $time = ceil(($hour*HOURS + $minute*MINUTES + $second)/(INTERVAL*MINUTES))*(INTERVAL*MINUTES);
        //$time = 8*HOURS;
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
        
        echo "Time of day: $hour:$minute:$second -> $start_time<br />";
        echo "Grams for: " . date('Y-m-d H:i:s', $midnight_time+$start_time) . " - " . date('Y-m-d H:i:s', $midnight_time+$time) . "<br />";
        
        echo "Grams to send: ".count($grams).":<br />";
        foreach($grams as $gram) {
            $gram_time_with_date = $midnight_time + $gram['time_of_day'];
            $message = $gram['message'];
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
            echo "<pre>" . print_r($gram, true) . "</pre>";
        }
    }

    // Send unsent messages
    function message() {
        $unsent_messages = $this->Message_Model->get_unsent_messages(date('Y-m-d H:i:s'));
        var_dump($unsent_messages);
        
        //$this->Message_Model->send_message($unsent_messages[0]['message_id']);
        foreach($unsent_messages as $message) {
            // Send to Tropo
            $user = $message['user_name'];
            $this->send_message($message['user_name'], $message['message']);
            
            $this->Message_Model->send_message($message['message_id']);
        }
    }
    
    function send_message ($recipient, $message) {
      $dev = true;
      $msg = urlencode($message['message']);
      $url = "http://api.tropo.com/1.0/sessions?action=create&token=d61d3c07322a2541ae6006f4c74900777b23d859e7aefd19e7c9141691d24f80312a5ced9ac42d688c0f1921&messageto=";
      $url .= urlencode($recipient);
      $url .= "&mynetwork=SMS&outboundmessage=";
      $url .= urlencode($message);
      if ($dev)
      {
        echo "Send message: $url<br />";
      } else
      {
        $ch = curl_init();
        //curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //$str = curl_exec($ch);
        curl_close($ch);
      }
    }
}

?>
