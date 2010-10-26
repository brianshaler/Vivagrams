<?
class User extends Controller
{
    var $errors = array();
    var $messages = array();
    
    function User()
    {
        parent::Controller();
        
        $this->load->library('FAL_front', 'fal_front');
    }
}
?>
