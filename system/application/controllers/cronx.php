<?php

class Cronx extends Controller {
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
        $time = $hour*HOURS + $minute*MINUTES + $second;
        $time = 8*HOURS;
        $start_time = $time - INTERVAL*MINUTES;

        // Dealing with cron just past midnight -- need to add total seconds
        // from previous day to start time
        if($start_time < 0) {
            $start_time += 86400;
        }


        //$grams = $this->Gram_Model->get_grams_by_time_frame($time-$interval*MINUTES, $time);
        $grams = $this->Gram_Model->get_grams_by_time_frame($start_time, $time);

        // Need time from midnight, as gram time isn't date sensitive
        $midnight_time = strtotime(date('n/j/Y', time()));

        foreach($grams as $gram) {
            $gram_time_with_date = $midnight_time + $gram['time_of_day'];
            $this->Message_Model->create_message(array('user_id' => 1,
                                                       'message' => $gram['message'], 
                                                       'gram_id' => $gram['gram_id'], 
                                                       //'send' => date('Y-m-d H:i:s', $gram_time_with_date),
                                                       'send' => date('Y-m-d H:i:s')
                                                   ));
        }

    }

    // Send unsent messages
    function message() {
        $unsent_messages = $this->Message_Model->get_unsent_messages(date('Y-m-d H:i:s'));
        var_dump($unsent_messages);

        $this->Message_Model->send_message($message[0]['message_id']);
        //foreach($unsent_messages as $message) {
            //$this->Message_Model->send_message($message['message_id']);
        //}


    }
}

?>
