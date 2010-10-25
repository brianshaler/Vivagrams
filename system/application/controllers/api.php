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
	}
	
	function get()
	{
    $action = strtolower($this->uri->segment(3));
    
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
  }
  
  function gram ()
  {
    $action = strtolower($this->uri->segment(3));
    $target = $this->uri->segment(4);
    $fail = json_encode(array("message"=>"failed"));
    
    if ($action == "create")
    {
      // /api/gram/create/
      $resolution = 15;
      $plan = $this->Plan_Model->get_plan_by_user_id(getUserProperty('id'));
      $gram = array(  "plan_id"=>$plan["plan_id"], 
                      "time_of_day"=>floor((time()-strtotime(date("n/j/Y", time())))/$resolution)*$resolution, 
                      "message"=>"", 
                      "response_type"=>"bool");
      
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
}

?>