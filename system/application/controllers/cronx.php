<?php

class Cronx extends Controller {
    function __construct() {
        parent::Controller();
        $this->process_queue();

    }

    function index() {
    }
    
    function process_queue() {
        $this->load->model('Gram_Model', '', TRUE);
        $this->load->model('Message_Model', '', TRUE);
        //$user = $this->User_Model->get_user_by_name($user_name);

        echo 'Hello world!';
    }
}

?>
