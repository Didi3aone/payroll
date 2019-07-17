<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * index admin class , manage login,logout,register forgot password
 * project finte (free internet for everything)
 * @license [MIT LICENSE]
 * @author [didi triawan] <[<diditriawan13@gmail.com>]>
 * @link(it-underground.web.id)
 * @since [< version 2.1 > Juni-2019] [<lts version>]
 */
class Index_admin extends MX_Controller {

	private $_view_folder 	= "index";
	private $_folder_js		= "";

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('Form', 'Cookie', 'String'));
	}

	/**
	 * function index load ui login
	 * @return 
	 */
	public function index()
	{
		// ambil cookie
        $cookie = get_cookie('finte_dev');
        // cek session
        if ($this->session->userdata(IS_LOGIN) == TRUE) {
			redirect('admin?login(TRUE)&'.URL_HACKED.'&'.URL_ENCODE);
        } else if($cookie <> '') {
            // cek cookie
            $row = $this->Global_model->set_model('tbl_users')->mode(array(
				'type' => SINGLE_ROW,
				'conditions' => array(
					'cookie' => $cookie
				)
			));

            if ($row) {
				$this->_set_session($row);
				redirect('admin?login(TRUE)&'.URL_HACKED.'&'.URL_ENCODE);
            } else {
				$data['title_tab'] = APP_NAME;
				
                $this->load->view(LAYOUT_BACKEND_HEADER_SIGN, $data);
				$this->load->view($this->_view_folder."/layout-login", $data);
				$this->load->view(LAYOUT_BACKEND_FOOTER_SIGN, $data);
            }
        } else {
			$data['title_tab'] = APP_NAME;
			
			$this->load->view(LAYOUT_BACKEND_HEADER_SIGN, $data);
			$this->load->view($this->_view_folder."/layout-login", $data);
			$this->load->view(LAYOUT_BACKEND_FOOTER_SIGN, $data);
		}	
	}

	/**
	 * [proses_login]
	 */
	public function proses_login()
	{
		//inisisal
		$message['is_error']  = true;
		$message['error_msg'] = "";

		//decode json
		$post_data = json_decode(file_get_contents('php://input'),true);
		// print_array($post_data);die;
		
		$user   = (isset($post_data['username'])) ? (string)sql_injection($post_data['username'],"string") : "";
		$pass   = (isset($post_data['password'])) ? sql_injection($post_data['password'],"string") : "";
		$cookie = (isset($post_data['remember'])) ? $post_data['remember'] : "";

		$check_login = $this->Global_model->set_model('tbl_users','tu','id')->mode(array(
			"type" 			=> SINGLE_ROW,
			"select"		=> "*",
			"joined"		=> array(
				"tbl_users_role tur" => array('tur.id' => 'tu.role_id')
			),
			"conditions" 	=> array(
				"username" => $user
			)
		));

		if(!empty($check_login) && password_verify($pass, $check_login['password'])) {
			$data = $check_login;

			// print_r($cookie);die();
			$this->_set_session($data);

			if ($cookie == 1) {
				$key = md5('finte_dev-'.date('YmdHis').'-'.mt_rand(100, 199));
				set_cookie('finte_dev', $key, 3600*24*30); // set expired 30 hari kedepan
				
				$this->Global_model->set_model('tbl_users')->mode(array(
					'type'  => UPDATES,
					'datas' => array(
						'cookie' => $key
					),
					'conditions' => array(
						'id' => $data['id']
					)
				));
	
				$this->insert_other_info($data['id'], $data['username']);
				$this->user_activity($data['username'], "LOGIN", ACTIVITY_LOGIN);
	
				$message['is_error']  = false;
				$message['error_msg'] = "sukses";
				$message['redirect']  = "admin?login(TRUE)&".URL_HACKED."&".URL_ENCODE."";
			}
		} else {
			$message['is_error']  = true;
			$message['error_msg'] = "Username atau password yang anda masukan salah.";
		}
		//set output to json
		$this->output->set_content_type('application/json')->set_output(json_encode(
			$message
		));
		
	}

	/**
	 * [insert_other_info description]
	 * @param  [int] $user_id [get user_id]
	 * @return [void] true         
	 */
	private function insert_other_info($user_id,$username)
	{
		$this->Global_model->set_model("tbl_users")->mode(array(
			"type" 		=> UPDATES,
			"datas" 	=> array(
				"ip_address"	=> get_client_ip(),
				"status_login"	=> "LOGIN",
				"login_time" 	=> NOW
			),
			"conditions" => array(
				"id" => $user_id
			)
		));
	}

	/**
	 * [user_activity save activity user to database]
	 * @param  string $username [get username]
	 */
	private function user_activity($username = "", $title = "", $activity)
	{
		//GET city by ip address
		$ip = $_SERVER['REMOTE_ADDR'];
		$result = json_decode(file_get_contents("http://ipinfo.io/{$ip}"));

		$data = array(
			"username" 				=> $username,
			"title_activity"		=> $title,
			"user_activity"			=> $activity,
			"activity_date" 		=> date('Y-m-d H:i:s'),
			"user_ip_address"		=> get_client_ip(),
			"user_browser"			=> user_agent()['browser'],
			"user_platform"		    => user_agent()['platform'],
			"user_mobile"			=> user_agent()['mobile'],
			"user_city_activity" 	=> (isset($result->city)) ? $result->city : NULL,
		);

		$this->Global_model->set_model("tbl_log_activityuser")->mode(array(
			"type" 		=> INSERTS,
			"datas" 	=> $data
		));
	}

	/**
	 * [_set_session]
	 * @param 
	 * array $data 
	 */
	protected function _set_session( $data = array())
	{
		$sess_data = array(
			'IS_LOGIN' 			=> TRUE,
			'id' 	   			=> $data['id'],
			'username_login' 	=> $data['username'],
			'ip_address'		=> $data['ip_address']
		);

		$this->session->set_userdata($sess_data);
	}

	/**
	 * [logout]
	 */
	public function logout()
	{
		$id 		= set_session('id');
		$username   = set_session('username_login');
		
		$this->Global_model->set_model("tbl_users")->mode(array(
			"type"  => UPDATES,
			"datas" => array(
				"status_LOGIN" 	=> "LOGOUT",
				"ip_address"	=> "",
				"logout_time"	=> NOW
			),
			"conditions" => array(
				"id" => $id
			)
		));

		//save_log
		$this->user_activity($username, "LOGOUT", ACTIVITY_LOGOUT);	
		//router disconnected
		disconnect_router();
		//update field status to 0 = DISCONNECTED
		$update_status = $this->Global_model->set_model('tbl_router')->mode(array(
			'type' => UPDATES,
			'datas' => array(
				'status' => STATUS_DISCONNECT
			),
			'conditions' => array(
				'hash_id' => set_session('hash_id')
			)
		));
		// delete_cookie('cms_compro');
		$this->session->sess_destroy();
		redirect('Auth?login(FALSE)&'.URL_HACKED.'&'.URL_ENCODE,'refresh');
	}
}

/* End of file Index_admin.php */
/* Location: ./application/modules/user/controllers/Index_admin.php */