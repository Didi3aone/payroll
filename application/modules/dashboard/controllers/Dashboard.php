<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Dashboard_admin
 * @license http://it-underground.web.id/licenses/MIT  MIT License
 * @author [didi triawan] <[<diditriawan13@gmail.com>]>
 * @link https://it-underground.web.id
 * @since [< app version 1.1 > juni-2019]
 */
class Dashboard extends MY_Controller {

    private $_view_folder = "dashboard/";

    public function __construct()
    {
        parent::__construct();
        //check user login
        $this->_check_auth();
    }

    /**
	 * function index 
	 * @return void qw
	 */
    public function index()
    {
        //header
        $header = array(
            'title_tab' => 'Dashboard',
            'breadcrumb' => 'Dashboard',
            'breadcrumb_child' => 'Control Panel'
        );
  
        // data
        $data = array();

        //footer
        // disini cara pemanggilan file javascriptnya
        // posisi file ada di assets/js/pages/nama_file.js
        $footer = array(
            // 'plugin_js' => ASSETS_BACKEND_JS.'pages/dashboard.js'
        );
    
      
        //load views
        $this->_render_page_backend($this->_view_folder."index", $header, $data ,$footer);
    }
}
/* End of file Dashboard_admin.php */
