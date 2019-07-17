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
class Index extends MY_Controller {

	private $_view_folder 	= "index/";
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
        $header = array();
        $data   = array();
        $footer = array();

        $this->_render_page_frontend($this->_view_folder."index", $header, $data, $footer);
    }
}