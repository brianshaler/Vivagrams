<?php

class Cronx extends Controller {
    function __construct() {
        parent::Controller();
        $this->process_queue();

    }

    function index() {
    }
    
    function process_queue() {
        // Load models
        $this->load->model('Gram_Model', '', TRUE);
        $this->load->model('Message_Model', '', TRUE);
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
        $time = 8 * 3600; // for testing
        $start_time = $time - INTERVAL*MINUTES;

        // Dealing with cron just past midnight -- need to add total seconds
        // from previous day to start time
        if($start_time < 0) {
            $start_time += 86400;
        }


        //$grams = $this->Gram_Model->get_grams_by_time_frame($time-$interval*MINUTES, $time);
        $grams = $this->Gram_Model->get_grams_by_time_frame($start_time, $time);


        foreach($grams as $gram) {
            $this->Message_Model->create_message();
        }
	//function create_message ($data)
	//{
		//$this->db->insert('messages', array( 'message_id' => intval($data['message_id']),
												//'user_id' => intval($data['user_id']),
												//'gram_id' => intval($data['gram_id']),
												//'message' => $data['message'],
												//'send' => $data['send'],
												//'sent' => $data['sent'],
												//'response' => $data['response'],
												//'response_text' => $data['response_text'])); 
    }
}

?>
