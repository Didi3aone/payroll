<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package Dropdown
 * @license http://it-underground.web.id/licenses/MIT  MIT License
 * @author [didi triawan] <[<diditriawan13@gmail.com>]>
 * @link https://it-underground.web.id
 * @since [< app version 1.1 > juni-2019]
 */
class Dropdown extends MY_Controller {


    public function __construct()
    {
        parent::__construct();
        //check user login
        $this->_check_auth();
    }

    //get user role
    public function UserRole($selected = '')
	{
		$get = $this->Global_model->set_model('tbl_users_role','tur','id')->mode(array(
			'type'          => GET_ALL_DATA,
			'return_object' => true
        ));
        
		return options($get, 'id', $selected, 'name');
	}
}