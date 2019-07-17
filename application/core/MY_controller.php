<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * MY_Controller
 * project cms compro
 * @license [MIT LICENSE]
 * @author [didi triawan] <[<diditriawan13@gmail.com>]>
 * @link(it-underground.web.id)
 * @since [< version 2.1 > Juni-2019] [<lts version>]
 */
class MY_Controller extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }

    /** 
     * @author 
     * @param $view string 
     *        $data array
     * @return 
     */
    protected function _render_page_backend($view = "" , $header = array(), $data = array(), $footer = array())
    {
        $this->load->view(LAYOUT_BACKEND_HEADER_ADMIN, $header);
        $this->load->view($view, $data);
        $this->load->view(LAYOUT_BACKEND_FOOTER_ADMIN, $footer);
    }

    /** 
     * @author 
     * @param $view string 
     *        $data array
     * @return 
     */
    protected function _render_page_frontend($view = "" , $header = array(), $data = array(), $footer = array())
    {
        $this->load->view(LAYOUT_FRONTEND_HEADER, $header);
        $this->load->view($view, $data);
        $this->load->view(LAYOUT_FRONTEND_FOOTER, $footer);
    }

    /** 
     * @author 
     * @return 
     */
    protected function _check_auth()
    {
        if ($this->session->userdata(IS_LOGIN) == FALSE) {
            redirect(base_url().'Auth?login(FALSE)&'.URL_HACKED.'&'.URL_ENCODE);
        }
    }

    /** 
     * @author 
     * @return 
     */
    protected function user_activity($username = "", $type = "", $activity)
	{
        //GET city by ip address
        $ip = $_SERVER['REMOTE_ADDR'];
        $result = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));
        
		$data = array(
			"username" 				=> $username,
			"title_activity"		=> $type,
			"user_activity"			=> $activity,
			"activity_date" 		=> date('Y-m-d H:i:s'),
			"user_ip_address"		=> get_client_ip(),
			"user_browser"			=> user_agent()['browser'],
			"user_platform"		    => user_agent()['platform'],
			"user_mobile"			=> user_agent()['mobile'],
			"user_city_activity" 	=> (isset($result->city)) ? $result->city : NULL
		);

		$this->Global_model->set_model("tbl_log_activityuser")->mode(array(
			"type" 		=> INSERTS,
			"datas" 	=> $data
		));
    }
}