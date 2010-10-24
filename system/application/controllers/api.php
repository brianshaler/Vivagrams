<?
class Api extends Controller
{
    
	function Api()
	{
		parent::Controller();
		
		$this->load->library('FAL_front', 'fal_front');
		$this->load->helper('vivagrams');
	}
	
	function get()
	{
    $this->load->model('User_Model', '', TRUE);
    $this->load->model('Plan_Model', '', TRUE);
    $this->load->model('Gram_Model', '', TRUE);
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
}

?>